<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/15
 * Time: 21:44
 */

namespace CommonClass\Order;


class ApproveDealFactory
{

    /**
     * 配置
     */
    private $_configNode = array(
        'leader' => 'to exclusive2',
        'chiefleader' => 'to exclusive3',
        'storehouse' => 'to complete'
    );

    /**
     * 订单
     */
    private $_orderId = null;

    /**
     * 类型
     */
    private $_type = null;

    /**
     * 备注
     */
    private $_remark = null;


    /**
     * 初始化
     */
    public function initi($varOrderId , $varType , $varRemark){
        $this->_orderId = $varOrderId;
        $this->_type = $varType;
        $this->_remark = $varRemark;
    }

    /**
     * 启动
     */
    public function process(){
        $StatmentList = array();
        $needWrToDb = $this->_dealApproveToFlower();
        $StatmentList = array_merge($needWrToDb , $StatmentList);

        if($this->_type == 'cancel' ){
            $ReBackObj = new \CommonClass\Order\Dealpackage\RebackOrderGoods();
            $ReBackObj->initi($this->_orderId);
            $reBackInfo = $ReBackObj->prcessToSQL();
            $StatmentList = array_merge($reBackInfo , $StatmentList);
        }
        $this->_writeToDb($StatmentList);



    }

    /**
     * 同意
     */
    private function _dealApproveToFlower(){
        $LogInfo = new \CommonClass\Login\ProcessLoginInfo();
        $uid = $LogInfo->getLoginInfo()['id'];
        $orderInfoFromDb = M('ysy_order')->where("order_id = {$this->_orderId}")->find();
        $ExceutionService = new \Vendor\Jbpm\Service\ExecutionService();
        if($this->_type == 'agree'){
            $this->_configNode[$orderInfoFromDb['status']];
            if(!$this->_configNode[$orderInfoFromDb['status']]) return false;
            $translate = $this->_configNode[$orderInfoFromDb['status']];
        }else if($this->_type == 'cancel'){
            $translate = 'to cancel';
        }else{
            $translate = 'to retreat';
        }
        $res = $ExceutionService->completeTask($orderInfoFromDb['flowerid'] , $translate);
        $ExceutionObj = reset($res->getExecution()['updata']);
        $tmp = array();
        if($ExceutionObj){
            $tmp = array(
                'flowerid' => $ExceutionObj['where']['dbid'],
                'status' => $ExceutionObj['data']['activityname']
            );
        }else{
            $ExceutionObj = $res->getHistProcinst();
            $tmp['status'] = reset($ExceutionObj['updata'])['data']['endactivity'];
            $tmp['flowerid'] = reset($ExceutionObj['updata'])['where']['dbid'];
        }
        $StatementList = array();
        $CommonObj = new \CommonClass\DbModel\CombinStatement('ysy_order');
        $CommonObj->where("order_id = {$this->_orderId}")->update(array('flowerid' => $tmp['flowerid'] , 'status' => $tmp['status'] ));
        $StatementList[] = $CommonObj;
        $insertLog = array(
            'orderid' => $this->_orderId,
            'nodename' => $tmp['status'],
            'uid' => $uid,
            'addtime' => time(),
            'remark' => $this->_remark
        );
        $CommonObj = new \CommonClass\DbModel\CombinStatement('ysy_approvelog');
        $CommonObj->insert($insertLog);
        $StatementList[] = $CommonObj;
        return $StatementList;

    }

    /**
     * 写入数据库
     */
    private function _writeToDb($varData){
        $flag = true;
        $model = new \Think\Model();
        $model->startTrans();
        try{
            foreach($varData as $k => $v){
                $dbFlag = $v->run();
            }
//            $model->rollback();
            $model->commit();
        }catch (\Exception $e){
            $model->rollback();
            $flag = false;
        }
        die('333');
        return $flag;
    }


    /**
     * 不同意
     */
    private function _disAgreeApprove(){

    }

    /**
     * 撤销
     */
    private function _cancelApprove(){

    }


}
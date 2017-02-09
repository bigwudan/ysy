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

        $needWrToDb = $this->_dealApproveToFlower();
        if($this->_type == 'cancel'){
            $ReBackObj = new \CommonClass\Order\Dealpackage\RebackOrderGoods();
            $ReBackObj->initi($this->_orderId);
            $reBackInfo = $ReBackObj->prcessToSQL();
            $needWrToDb['stock'] = reset($reBackInfo);
        }

        $this->_writeToDb($needWrToDb);



    }

    /**
     * 同意
     */
    private function _dealApproveToFlower(){

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
        $order = array(
            'where' => array('order_id' => $this->_orderId),
            'update' => array(
                'flowerid'=>$tmp['flowerid'],
                'status' => $tmp['status']
            )
        );
        $log = array(
            'insert' => array(
                'orderid' => $this->_orderId,
                'status' => $this->_type,
                'nodename' => $tmp['status'],
                'uid' => 1,
                'addtime' => time(),
                'remark' => $this->_remark
            )
        );
        $resArr = array(
            'order' => $order,
            'log' => $log
        );

        return $resArr;

    }

    /**
     * 写入数据库
     */
    private function _writeToDb($varData){
        if(!$varData) return false;
        $model = new \Think\Model();
        $model->startTrans();
        $flag = true;
        try{
            if(!empty($varData['stock'])){
                foreach($varData['stock'] as $k => $v){
                    $v['where']['format_id'] = intval($v['where']['format_id']);
                    $flagOfDb = M('ysy_stock')->where("format_id={$v['where']['format_id']}")->setInc('goods_num' , $v['num']);
                    if(!$flagOfDb) new \Exception('ysy_order');
                }
            }
            $flagOfDb = M('ysy_order')->where("order_id = {$varData['order']['where']['order_id']}")->save($varData['order']['update']);
            if(!$flagOfDb) new \Exception('ysy_order');
            $flagOfDb = M('ysy_approvelog')->add($varData['log']['insert']);
            if(!$flagOfDb) new \Exception('ysy_approvelog-updata');
            $model->commit();
        }catch (\Exception $e){
            $model->rollback();
            $flag = false;
        }
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
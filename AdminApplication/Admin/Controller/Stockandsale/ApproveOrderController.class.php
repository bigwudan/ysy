<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/19
 * Time: 8:32
 */

namespace Admin\Controller\Stockandsale;

use Think\Controller;
class ApproveOrderController extends Controller
{
    /**
     * 初始化
     */
    protected function _initialize(){
        $obj = new \Admin\Common\AdminAuthor();
        $obj->init();
        $user = new \Admin\Controller\Body\BodyController();
        $body = $user->bodyFactory($obj->getAuthorList());
        $this->assign('body' , $body);
    }

    /**
     * 显示历史信息
     */
    public function index(){
        $GetNeedApproveList = new \CommonClass\Order\GetNeedApproveListFromDb();
        $uid = session('uid');
        $GetNeedApproveList->initi($uid);
        $count = $GetNeedApproveList->getCountByUid();
        $Page       = new \Think\NewPage($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $showPage       = $Page->show();// 分页显示输出
        $pageList = array(
            'firstRow' => $Page->firstRow,
            'listRows' => $Page->listRows,
        );
        $dataList = $GetNeedApproveList->getOrderOfApproveList($pageList);
        $this->assign('showPage' , $showPage);
        $this->assign('dataListFromDb' , $dataList);
        $this->display('/Stockandsale/ApproveOrder');
    }

    /**
     * 显示单个订单
     */
    public function actionRequestService(){
        $type = I('type');
        if($type == 'show'){
            $html = $this->_getGoodsInfoByOrderId();
            die($html);
        }else{
            $html = $this->_processSubmit();

        }

    }

    private function _processSubmit(){
        $id = intval(I('id'));
        $approveType = trim(I('approvetype'));
        $remark = trim(strip_tags(I('remark')));
        $expressNum = trim(I('expressnum'));
        $expressTime = intval(strtotime(trim(I('expresstime'))));
        $ApproveDealObj = new \CommonClass\Order\ApproveDealFactory();
        $ApproveDealObj->initi($id , $approveType , $remark);
        $ApproveDealObj->process();

        if($expressTime){
            $falg = M('ysy_order')->where("order_id = {$id}")->save(array('expressnum' => $expressNum , 'expresstime' => $expressTime));
        }

    }


    private function _getGoodsInfoByOrderId(){
        $orderId = intval(I('orderid'));
        $obj = new \CommonClass\Order\GetOrderInfo();
        $obj->initi($orderId);
        $orderBase = $obj->getOrderbase();
        $orderInfo = $obj->getOrderInfo();
        $log = $obj->getLog();
        $html = $this->_processHtmlOrderInfo($orderBase , $orderInfo , $log);
        return $html;
    }

    /**
     * 组合成html
     */
    private function _processHtmlOrderInfo($varOrderBase , $varOrderInfo , $varLog){


        $orderInfoStr = '';
        foreach($varOrderInfo as $k => $v){
            $tmpCount = $k +1;
            $orderInfoStr .="<h4>订单{$tmpCount}</h4><p>商品名称:{$v['packagename']}</p><p>单价:{$v['price']}</p><p>数量:{$v['num']}</p>";
        }

        $logStr = '';
        foreach($varLog as $k => $v){
            if($v['nodename'] == 'cancel'){
                $tmpStatus = '撤销';
            }elseif($v['nodename'] == 'retreat'){
                $tmpStatus = '退回';
            }else{
                $tmpStatus = '同意';
            }
            $logStr .= "<p>{$tmpStatus} 审批人：{$v['realname']} 备注:{$v['remark']}</p>";
        }

        $storeStr = '';
        if($varOrderBase['status'] == 'storehouse'){
            $storeStr ='<div class="form-group"><label for="message-text" class="control-label">发货日期</label><input class="form-control" name=\'expresstime\' type="date"  ></div><div class="form-group"><label for="message-text" class="control-label">快递号</label><input class="form-control" name=\'expressnum\'  ></div>';
        }



$temple =<<<EOT
                <h3>订单基础信息</h3>
                <p>姓名:{$varOrderBase['rece_name']}</p>
                <p>地址:{$varOrderBase['rece_addr']}</p>
                <p>电话:{$varOrderBase['rece_tel']}</p>
                <p>业务员:{$varOrderBase['realname']}</p>
                <hr>
                <h3>订单详情信息</h3>
                {$orderInfoStr}
                <hr>
                <h3>审批日志</h3>
                {$logStr}
                <hr>
                <h3>审批</h3>
                <form id="approve-form">
                    <input type='hidden' name='id' value="{$varOrderBase['orderId']}">
                    <div class="form-group">
                        <label class="radio-inline">
                            <input checked='true' type="radio" name="approvetype" id="inlineRadio1" value="agree"> 同意
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="approvetype" id="inlineRadio2" value="disagree"> 拒绝
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="approvetype" id="inlineRadio3" value="cancel"> 撤销
                        </label>
                    </div>

                    {$storeStr}

                    <div class="form-group">
                        <label for="message-text" class="control-label">备注:</label>
                        <textarea name='remark' class="form-control" id="message-text"></textarea>
                    </div>
                </form>
EOT;

        return $temple;

    }



}
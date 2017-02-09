<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/16
 * Time: 15:03
 */

namespace DingTalk\Controller\ApproveCenter;
use Think\Controller;

class ApproveCenterController extends Controller
{


    /**
     * 主页
     */
    public function index(){
        $this->display('approvecenter/approvecenter');
    }


    /**
     * 查询服务
     */
    public function _waitOfMyApproveList(){
        $orderList = M('ysy_order')->select();
        $html = '';
        foreach($orderList as $k => $v){

            $tmpUrl = U('ApproveCenter/ApproveCenter/actionApproveInfo')."?id={$v['order_id']}";

            $tmp =<<<EOT
<div class="tabone pl10">
	<a href="{$tmpUrl}" class="bbt pt10 pb10 pr10 clearfix block">
		<div class="fl ell-width">
			<p class="ellipsis ft14">{$v['addtime']}</p>
			<p class="c999 ft12">{$v['addtime']}</p>
		</div>
		<p class="fr orange ft16 pt10">{$v['status']}</p>
	</a>
</div>
EOT;
            $html .=$tmp;
        }
        return $html;
    }


    /**
     * 待我审批
     */
    public function actionWaitOfMyApprove(){

        $html = $this->_waitOfMyApproveList();
        $this->assign('html' , $html);

        $this->display('approvecenter/waitofmyapprove');
    }

    /**
     * 我发起的
     */
    public function actionMyApprove(){

        $this->display('approvecenter/myapprove');
    }

    /**
     * 申请详情
     */
    public function actionApproveInfo(){
        $id = intval(I('id'));
        $orderList = M('ysy_order')->alias('yo')
            ->field("yo.* , yog.* , ygp.packagename")
            ->join('think_ysy_ordergoods AS yog ON yo.order_id = yog.order_id')
            ->join('think_ysy_goodspackage AS ygp ON yog.package_id = ygp.id')
            ->select();

        $this->assign('order' , $orderList);
        $this->assign('orderid' , $id);

        $this->display('approvecenter/approveinfo');
    }

    /**
     * 处理提交的数据
     */
    public function actionApproveService(){
        $id = intval(I('id'));
        $approveType = trim(I('approvetype'));
        $remark = trim(strip_tags(I('remark')));
        $ApproveDealObj = new \CommonClass\Order\ApproveDealFactory();
        $ApproveDealObj->initi($id , $approveType , $remark);
        $ApproveDealObj->process();

    }




}
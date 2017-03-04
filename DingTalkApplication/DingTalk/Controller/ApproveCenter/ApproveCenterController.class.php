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

    private $_status = array(
        "leader"=>'销售主管审批',
        "chiefleader"=>'销售经理审批',
        "storehouse"=>'库管审批',
        "complete"=>'审批通过',
        "cancel"=>'撤销',
        "retreat"=>'退回',
    );


    /**
     * 主页
     */
    public function index(){
        $LoginInfo = new \CommonClass\Login\ProcessLoginInfo();
        $loginInfo = $LoginInfo->getLoginInfo();
        if(empty($loginInfo)) die('login');
        $this->display('approvecenter/approvecenter');
    }

    /**
     * 查询服务
     */
    public function _waitOfMyApproveList($varPage = 0){
        $LogObj=new \CommonClass\Login\ProcessLoginInfo();
        $page = $varPage;
        $uid = $LogObj->getLoginInfo()['id'];
        $where = " AND wp.userid = {$uid}";
        $orderList = M('workflow_participation')->alias('wp')
            ->field("wp.userid , o.order_id , o.order_user , o.addtime , o.status , u.realname as order_realname")
            ->join("think_workflow_task as wt ON wp.task = wt.dbid")
            ->join("think_ysy_order as o ON o.flowerid = wt.execution")
            ->join("think_user as u ON u.id = o.order_user")
            ->limit("{$page} , 10")
            ->order('wp.addtime desc')
            ->where("1 = 1 {$where}")
            ->select();

        return $orderList;

    }

    /**
     * ajax请求
     */
    public function actionRequestService(){
        $type = trim(I('type'));
        if($type == 'showwaitofmyapprove'){
            $res = $this->_selectWaitOfMyApprove();
        }else{
            $res = $this->_selectMyApprove();
        }
        die($res);
    }

    /**
     * 得到需要我审批的订单
     */
    private function _selectMyApprove(){
        $pageNum = I('pagenum');
        $dataOfHtml = $this->_showOfMyApproveList($pageNum);
        $html = '';
        foreach($dataOfHtml as $k => $v){
            $hrefTmp = U('ApproveCenter/ApproveCenter/actionApproveInfo');
            $v['addtime'] = date("Y-m-d H:i:s",$v['addtime']);
            $html .=<<<EOT
					<div class="tabone pl10">
						<a href="{$hrefTmp}?id={$v['order_id']}&type=show" class="bbt pt10 pb10 pr10 clearfix block">
							<div class="fl ell-width">
								<p class="ellipsis ft14">{$v['order_realname']}的申请</p>
								<p class="c999 ft12">{$v['addtime']}</p>
							</div>
							<p class="fr orange ft16 pt10">
							    {$this->_status[$v['status']]}
							</p>
						</a>
					</div>
EOT;
        }
        return $html;
    }

    /**
     * 得到需要我审批的订单
     */
    private function _selectWaitOfMyApprove(){
        $pageNum = I('pagenum');
        $dataOfHtml = $this->_waitOfMyApproveList($pageNum);
        $html = '';
        foreach($dataOfHtml as $k => $v){
            $hrefTmp = U('ApproveCenter/ApproveCenter/actionApproveInfo');
            $v['addtime'] = date("Y-m-d H:i:s",$v['addtime']);
            $html .=<<<EOT
					<div class="tabone pl10">
						<a href="{$hrefTmp}?id={$v['order_id']}" class="bbt pt10 pb10 pr10 clearfix block">
							<div class="fl ell-width">
								<p class="ellipsis ft14">{$v['order_realname']}的申请</p>
								<p class="c999 ft12">{$v['addtime']}</p>
							</div>
							<p class="fr orange ft16 pt10">
							    {$this->_status[$v['status']]}
							</p>
						</a>
					</div>
EOT;
        }
        return $html;
    }


    /**
     * 待我审批
     */
    public function actionWaitOfMyApprove(){
        $approveList = $this->_waitOfMyApproveList();
        $this->assign('approveList' , $approveList);
        $this->display('approvecenter/waitofmyapprove');
    }

    /**
     * 我发起的
     */
    public function actionMyApprove(){
        $approveList = $this->_showOfMyApproveList();
        $this->assign('approveList' , $approveList);
        $this->display('approvecenter/myapprove');
    }

    /**
     * 显示
     */
    private function _showOfMyApproveList($varPage = 0){
        $LogObj=new \CommonClass\Login\ProcessLoginInfo();
        $uid = $LogObj->getLoginInfo()['id'];
        $where = " AND o.order_user = {$uid}";
        $orderList = M('ysy_order')->alias('o')
            ->field("o.order_id , o.order_user , o.addtime , o.status , u.realname as order_realname")
            ->join("think_user as u ON u.id = o.order_user")
            ->where("1 = 1 {$where}")
            ->limit("{$varPage} , 10")
            ->order('o.addtime desc')
            ->select();
        return $orderList;
    }


    /**
     * 申请详情
     */
    public function actionApproveInfo(){
        $id = intval(I('id'));
        $type = I('type');
        $OrderInfo = new \CommonClass\Order\GetOrderInfo();
        $OrderInfo->initi($id);
        $orderBase = $OrderInfo->getOrderbase();
        $orderInfo = $OrderInfo->getOrderInfo();
        $log = $OrderInfo->getLog();
        $OrderTypeObj = new \CommonClass\Config\BaseConfig();
        $orderType = $OrderTypeObj->getOrderType();


        $this->assign('type' , $type);
        $this->assign('orderType' , $orderType);
        $this->assign('orderBase' , $orderBase);
        $this->assign('orderInfo' , $orderInfo);
        $this->assign('log' , $log);
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
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
        $LoginInfo = new \CommonClass\Login\ProcessLoginInfo();
        $loginInfo = $LoginInfo->getLoginInfo();
        if(empty($loginInfo)) die('login');
        $this->display('approvecenter/approvecenter');
    }

    /**
     * 查询服务
     */
    public function _waitOfMyApproveList(){
        $LogObj=new \CommonClass\Login\ProcessLoginInfo();
        $uid = $LogObj->getLoginInfo()['id'];
        $where = " AND wp.userid = {$uid}";
        $orderList = M('workflow_participation')->alias('wp')
            ->field("wp.userid , o.order_id , o.order_user , o.addtime , o.status , u.realname as order_realname")
            ->join("think_workflow_task as wt ON wp.task = wt.dbid")
            ->join("think_ysy_order as o ON o.flowerid = wt.execution")
            ->join("think_user as u ON u.id = o.order_user")
            ->where("1 = 1 {$where}")
            ->select();

        return $orderList;

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
    private function _showOfMyApproveList(){
        $LogObj=new \CommonClass\Login\ProcessLoginInfo();
        $uid = $LogObj->getLoginInfo()['id'];
        $where = " AND o.order_user = {$uid}";
        $orderList = M('ysy_order')->alias('o')
            ->field("o.order_id , o.order_user , o.addtime , o.status , u.realname as order_realname")

            ->join("think_user as u ON u.id = o.order_user")
            ->where("1 = 1 {$where}")
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
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
     * 待我审批
     */
    public function actionWaitOfMyApprove(){
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
        $this->display('approvecenter/approveinfo');

    }

}
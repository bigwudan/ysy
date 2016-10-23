<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/23
 * Time: 7:55
 */
namespace Admin\Controller\Ticket;

use Think\Controller;

class EditTicketController extends Controller
{
    /**
     * 初始化
     */
    protected function _initialize(){
        $obj = new \Admin\Common\AdminAuthor();
        $obj->init();
    }
    /**
     * 选择条件
     */
    private function _getWhere(){

        return '';
    }


    /**
     * 分配卷
     */
    public function actionViewTicket(){
        $where = $this->_getWhere();
        $count      = M('ticket')->where("1 = 1 {$where}")->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $ticketData = M('ticket')->where("1 = 1 {$where}")->limit($Page->firstRow.','.$Page->listRows)->select();
        $user = new \Admin\Controller\Body\BodyController();
        $mainHeadHtml = $user->operationHead();
        $this->assign('show' , $show);
        $this->assign('ticketData' ,  $ticketData);
        $this->assign('head' , $mainHeadHtml);
        $this->display('/Ticket/EditTicket');
    }




}
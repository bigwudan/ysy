<?php
namespace Home\Controller\Ticket;

use Think\Controller;

class TicketController extends Controller
{
    public function actionShowTicket(){
        $token = md5(time());
        session('token',$token);
        $this->assign('token',$token);
        $this->display('/Ticket/Ticket');
    }
    public function actionSubmit(){
        var_dump(I('token'));
        die('xxx');

    }


}
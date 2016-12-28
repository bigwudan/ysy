<?php
namespace Home\Controller\Ticket;

use Think\Controller;

class TicketController extends Controller
{


    /**
     * 初始化
     */
    public function actionIndex(){
        $this->display('/Ticket/Ticket');
    }

    /**
     * ajax数据
     */
    public function actionCheckTicketAjax(){
        $num = trim($_GET['num']);
        $checkNum = trim($_GET['checknum']);
        if(!$num || !$checkNum){
            die('1');
        }
        $ticketData = M('ticket')->where("number = '{$num}' AND checknum = '{$checkNum}'")->find();
        if(!$ticketData){
            die('2');
        }
        if($ticketData['is_spend'] == 1){
            die('3');
        }else{
            die('4');
        }
    }

    public function actionSubmit(){
        $num = trim(I('number'));
        $checkNum = trim(I('checknum'));
        if(!$num || !$checkNum){
            die('填写正确卷号或验证码');
        }
        $ticketData = M('ticket')->where("number = '{$num}' AND checknum = '{$checkNum}'")->find();
        if(!$ticketData){
            die('填写正确卷号或验证码');
        }
        if($ticketData['is_spend'] == 1){
            die('该卷号已经消费');
        }else{
            $token = md5(time());
            session('token',$token);
            $this->assign('num' , $num);
            $this->assign('checkNum' , $checkNum);
            $this->assign('token',$token);
            $this->assign('id',$ticketData['id']);
            $this->display('/writeaddr');
        }
        die('');
    }

    public function actionSucess(){
        $token = I('token');
        $id = intval(I('id'));
        $num = trim(I('number'));
        $checkNum = trim(I('checknum'));
        $rec_name = strip_tags(trim(I('rec_name')));
        $rec_addr = strip_tags(trim(I('rec_addr')));
        $rec_tel = intval(I('rec_tel'));

        if(!preg_match('/\d{8,}/',I('rec_tel'))){
            die('电话号码有错,至少8位');
        }

        $remark = strip_tags(trim(I('remark')));
        $rec_province = strip_tags(trim(I('rec_province')));
        $sessToken = session('token');
        $ticketData = M('ticket')->where("number = '{$num}' AND checknum = '{$checkNum}'")->find();
        if(!$ticketData){
            die('填写正确卷号或验证码');
        }
        if($ticketData['is_spend'] == 1){
            die('该卷号已经消费');
        }

        if(!$sessToken){
            die('登录异常');
        }
        if($sessToken === $token){
            $ip = $_SERVER["REMOTE_ADDR"] ? $_SERVER["REMOTE_ADDR"] : '0';
            $upData = array(
                'rec_name' => $rec_name,
                'rec_addr' => $rec_addr,
                'rec_tel' => $rec_tel,
                'remark' => $remark,
                'rec_province' => $rec_province,
                'ip' => $ip,
                'is_spend' => 1,
                'time' => time()
            );
            $data = M('ticket')->where("id = {$id}")->limit('1')->save($upData);
            session('token',null);
            if(!$data){
                die('更新失败');
            }else{
                $this->display('/sucess');
            }
        }else{
            session('token',null);
            die('登陆异常');
        }

    }

}
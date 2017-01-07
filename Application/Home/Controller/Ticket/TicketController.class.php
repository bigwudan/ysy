<?php
namespace Home\Controller\Ticket;

use Think\Controller;

class TicketController extends Controller
{


    /**
     * 初始化
     */
    public function actionIndex(){
        $code = I('code');
        $this->assign('code' , $code);
        $this->display('/Ticket/TicketBeg');
    }

    /**
     *
     */
    public function actionShowTicket(){
        $code = I('code');
        $this->assign('code' , $code);
        $this->display('/Ticket/Ticket');
    }


    /**
     * ajax数据
     */
    public function actionCheckTicketAjax(){
        $num = trim($_GET['num']);
        $category = trim($_GET['category']);
        $res = $this->_checkNumAndCate($num , $category);

        if($res['error'] === 0){
            die('4');
        }else{
            die("{$res['error']}");
        }
    }

    public function actionSubmit(){
        $num = trim(I('number'));
        $category = trim(I('category'));
        $res = $this->_checkNumAndCate($num , $category);
        if($res['error'] === 0){
            $token = md5(time());
            session('token',$token);
            $this->assign('num' , $num);
            $this->assign('code' , $category);
            $this->assign('token',$token);
            $this->display('/writeaddr');
        }else{
            die("异常");
        }
    }

    private function _checkNumAndCate($varNum , $varCate){
        $num = $varNum;
        $category = $varCate;
        if(!in_array($category , array('398' , '598' , '888'))){
            return array('error' => 1);
        }
        if(mb_strlen($num,'utf-8') !== 7){
            return array('error' => 1);
        }
        preg_match('/^0{4,6}(\d{1,3})$/', $num, $matches);
        $num = intval($matches[1]);
        if(!$num){
            return array('error' => 1);
        }
        $ticketData = M('ticket')->where("number = '{$num}' AND category = '{$category}'")->find();
        if(!$ticketData){
            return array('error' => 1);
        }
        if($ticketData['is_spend'] == 1){
            return array('error' => 2);
        }else{
            return array('error' => 0);
        }

    }


    public function actionSucess(){
        $token = I('token');
        $sessToken = session('token');
//        if($sessToken !== $token || !$sessToken){
//            die('登录异常');
//        }

        $num = trim(I('number'));
        $category = trim(I('category'));

        $res = $this->_checkNumAndCate($num , $category);
        if($res['error'] !== 0){
            die("异常");
        }
        $rec_name = strip_tags(trim(I('rec_name')));
        $rec_addr = strip_tags(trim(I('rec_addr')));
        $rec_tel = intval(I('rec_tel'));
        if(!preg_match('/\d{8,}/',I('rec_tel'))){
            die('电话号码有错,至少8位');
        }
        $remark = strip_tags(trim(I('remark')));
        $rec_province = strip_tags(trim(I('rec_province')));
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
            $num = intval($num);
            $data = M('ticket')->where("number = '{$num}' AND category = '{$category}'")->limit('1')->save($upData);
            session('token',null);
            if(!$data){
                die('更新失败');
            }else{
                $this->display('/sucessindex');
            }
        }else{
            session('token',null);
            die('登陆异常');
        }

    }

    /**
     * 初始化数据库
     */
    public function initiSql(){

        $str = '000000221';
        //$str = mb_strlen($str,'utf-8');

        $pattern = '/^0{4,6}(\d{1,3})$/';
        $da = preg_match($pattern, $str, $matches);
        var_dump($matches);


        die('xxx');

        $cate = '398';
        $insert = array();
        for($num = 1 ; $num <= 200 ; $num ++){
            array_push($insert , array('id' => $num , 'category' => $cate));
        }
        $flag = M('ticket')->addAll($insert);

        $cate = '598';
        $insert = array();
        for($num = 1 ; $num <= 200 ; $num ++){
            array_push($insert , array('id' => $num , 'category' => $cate));
        }
        $flag = M('ticket')->addAll($insert);

        $cate = '888';
        $insert = array();
        for($num = 1 ; $num <= 200 ; $num ++){
            array_push($insert , array('id' => $num , 'category' => $cate));
        }
        $flag = M('ticket')->addAll($insert);

        die('xxx');
    }

}
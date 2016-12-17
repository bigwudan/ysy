<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/22
 * Time: 22:24
 */
namespace Admin\Controller\Login;

use Think\Controller;

class LoginController extends Controller
{
    public function index(){
        die('xx');
    }

    public function actionLogin()
    {
        $this->display('/Login/Login');
    }

    /**
     * 登录验证
     */
    public function actionCheckUserInfo(){
        $userName = trim(I('username'));
        $passWord = md5(trim(I('password')));
        $userFromDb = M('user')->where("username = '{$userName}' AND password = '{$passWord}'")->find();
        if($userFromDb){
            session('uid',$userFromDb['id']);
            $url = U('/statistics');
            $this->success('登陆成功', $url);
        }else{
            $this->error('登陆失败','actionLogin');
        }
    }

    /**
     * 清理session
     */
    public function actionClearSession(){
        session('uid',null);
        $url = U('/Login/Login/actionLogin');
        $this->error('请登录', $url);
    }


}
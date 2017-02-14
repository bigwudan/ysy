<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/16
 * Time: 15:03
 */

namespace DingTalk\Controller\Login;
use Think\Controller;

class LoginByHtmlController extends Controller
{

    /**
     * 主页
     */
    public function index(){
        $this->display('Login/loginbyhtml');
    }

    /**
     * 提交
     */
    public function actionSubmit(){
        $name = trim(I('loginname'));
        $password = md5(trim(I('loginpassword')));
        $loginInfo = M('user')->where("username='{$name}' and password = '{$password}' ")->find();

        if($loginInfo){
            $LoginObj = new \CommonClass\Login\ProcessLoginInfo();
            $flag = $LoginObj->setLoginInfo($loginInfo['id']);

            $url = U('/ApproveCenter/ApproveCenter');

            $this->success('登陆成功', $url);
        }else{


            $this->error('登陆失败');


        }


        die('xxx');
    }

}
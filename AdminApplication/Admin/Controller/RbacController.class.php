<?php
namespace Admin\Controller;

use Think\Controller;

class RbacController extends Controller
{
    /**
     * 初始化
     */
    protected function _initialize(){
        $obj = new \Admin\Common\AdminAuthor();
        $obj->init();
        $user = new \Admin\Controller\Body\BodyController();
        $body = $user->bodyFactory($obj->getAuthorList());
        $this->assign('body' , $body);
    }

    public function index()
    {

        $this->display('/Rbac/Rbac');

    }

    public function actionWudan(){

        die('aaaaaaa');
    }

}
<?php
namespace Admin\Controller\Rbac;

use Think\Controller;

class TestController extends Controller
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

    public function index(){
//        $this->display('/Rbac/test');die();
        $CustimerObj = new \CommonClass\Statistics\CustomerStatis();
        $list = [1,2];
        $CustimerObj->initi($list);
        $data = $CustimerObj->factoryModel('salesman' , 'goodsnum');

        $jsonData = json_encode($data , JSON_UNESCAPED_UNICODE);

        $this->assign('jsonData' , $jsonData);
        $this->display('/Rbac/test');
    }





}
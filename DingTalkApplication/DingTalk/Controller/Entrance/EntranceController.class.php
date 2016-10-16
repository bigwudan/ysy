<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/16
 * Time: 15:03
 */

namespace DingTalk\Controller\Entrance;
use Think\Controller;

class EntranceController extends Controller
{
    /**
     * 初始化
     */
    protected function _initialize(){
        $obj = new \DingTalk\Common\AdminAuthor();
        $obj->init();
    }
    /**
     *
     */
    public function actionTest(){
//        $obj = new \Vendor\Rbac\MyRbac();
//        $obj->test();
        die('xxx');
    }
}
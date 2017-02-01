<?php
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2016/12/12
 * Time: 15:46
 */

namespace Admin\Controller;
use Think\Controller;

class StockandsaleController extends Controller {
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
        $this->display('/Statistics/Statistics');
    }

}
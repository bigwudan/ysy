<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/16
 * Time: 15:03
 */

namespace DingTalk\Controller\OrderProcess;
use Think\Controller;

class OrderApproveController extends Controller
{
    /**
     * 主页
     */
    public function index(){
        $this->display('/orderprocess/orderapprove');

    }
}
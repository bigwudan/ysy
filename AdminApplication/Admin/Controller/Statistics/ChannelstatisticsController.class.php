<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/17
 * Time: 16:00
 */

namespace Admin\Controller\Statistics;

use Think\Controller;
class ChannelstatisticsController extends Controller
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
        $goodsname = M('order')->field('goodsname')->group('goodsname')->where('goodsname != "" AND channel in ("个人" , "团购" , "渠道")')->select();

        $this->assign('goodsname' , $goodsname);
        $this->display('/Statistics/Channelstatistics');

    }

    /**
     * 显示
     */
    public function actionAjaxFactory(){
        $goodsName = I('goodsname');
        $ChannelObj = new \CommonClass\Statistics\ChannelStatis();
        $data = $ChannelObj->initi($goodsName);
        $data = $ChannelObj->factoryModel('channel' , 'totalprice');
        $data = json_encode($data);
        die($data);
    }




}
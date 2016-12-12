<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/12
 * Time: 20:57
 */

namespace Admin\Controller\Statistics;

use Think\Controller;
class GoodsstylestatisticsController extends Controller
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
        $GoodsStyle = new \CommonClass\Statistics\GoodsStyleStatis();
        $GoodsStyle->initi();
        $goodStyle = $GoodsStyle->getGoodStyle();
        $this->assign('goodStyle' , $goodStyle);
        $this->display('/Statistics/Goodsstylestatistics');
    }

    public function goodStyleAjax(){
        $str = I('data');
        $str = htmlspecialchars_decode($str);
        $data = json_decode($str,true);
        $GoodsStyle = new \CommonClass\Statistics\GoodsStyleStatis();
        $GoodsStyle->getDataByGoodStyle($data);
        $data = $GoodsStyle->factoryModel('goodsstyle' , 'totalprice');
        $jsonData = json_encode($data , JSON_UNESCAPED_UNICODE);
        die($jsonData);
    }

}
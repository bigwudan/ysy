<?php
namespace Admin\Controller\Rbac;

use Think\Controller;

class TestController extends Controller
{
    /**
     * 初始化
     */
    protected function _initialize(){
//        $obj = new \Admin\Common\AdminAuthor();
//        $obj->init();
//        $user = new \Admin\Controller\Body\BodyController();
//        $body = $user->bodyFactory($obj->getAuthorList());
//        $this->assign('body' , $body);
    }

    public function index(){



        $GoodsStyle = new \CommonClass\Statistics\GoodsStyleStatis();

        $GoodsStyle->initi();
        $goodStyle = $GoodsStyle->getGoodStyle();
        $this->assign('goodStyle' , $goodStyle);
        $this->display('/Rbac/testgoodstyle');
        die('');


//        $this->display('/Rbac/test');die();
        $CustimerObj = new \CommonClass\Statistics\CustomerStatis();
        $list = [1,2];
        $CustimerObj->initi();
        $data = $CustimerObj->factoryModel('customername' , 'totalprice');
        $jsonData = json_encode($data , JSON_UNESCAPED_UNICODE);
        $this->assign('jsonData' , $jsonData);
        $this->display('/Rbac/test');
    }

    /**
     * ajax请求
     */
    public function goodStyleAjax(){
        $str = I('data');
        $type = I('type');
        $str = htmlspecialchars_decode($str);
        $data = json_decode($str,true);
        $GoodsStyle = new \CommonClass\Statistics\GoodsStyleStatis();
        $GoodsStyle->getDataByGoodStyle($data);
        $typeStr = $type == 0 ? 'goodsnum' : 'totalprice';
        $data = $GoodsStyle->factoryModel('goodsstyle' , $typeStr);
        $jsonData = json_encode($data , JSON_UNESCAPED_UNICODE);
        die($jsonData);
    }


}
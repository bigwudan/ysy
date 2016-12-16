<?php
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2016/12/12
 * Time: 14:57
 */

namespace Admin\Controller\Statistics;
use Think\Controller;

class CustomerstatisticsController extends Controller {
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
        $flag = 1;
        if($flag == 0){
            $typeStr = 'totalprice';
        }else{
            $typeStr = 'goodsnum';
        }
        $data = M('order')->field('customername')->group('customername')->where('customername != ""')->select();


        $CustimerObj = new \CommonClass\Statistics\CustomerStatis();
        $customList = $CustimerObj->initi('个人');
        $data = $CustimerObj->factoryModel('customername' , $typeStr);


        $jsonData = json_encode(reset($data));
        $this->assign('jsonData' , $jsonData);
        $this->assign('flag' , $flag);
        $this->display('/Statistics/Customerstatistics');
        die();

        $this->assign('goodsname' , $data);



        $CustimerObj = new \CommonClass\Statistics\CustomerStatis();
        $CustimerObj->initi();
        $data = $CustimerObj->factoryModel('customername' , $typeStr);
        $jsonData = json_encode($data , JSON_UNESCAPED_UNICODE);

        $this->assign('jsonData' , $jsonData);
        $this->assign('flag' , $flag);
        $this->display('/Statistics/Customerstatistics');
    }

    public function actionTest(){
    }
}
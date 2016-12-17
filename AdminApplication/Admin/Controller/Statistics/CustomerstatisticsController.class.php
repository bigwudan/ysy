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
        $customerList = M('order')->field('customername')->group('customername')->where('customername != ""')->select();
        $CustimerObj = new \CommonClass\Statistics\CustomerStatis();
        $customList = $CustimerObj->initi('个人');
        $data = $CustimerObj->factoryModel('customername' , $typeStr);


        $jsonData = json_encode(reset($data));
        $this->assign('customerList' , $customerList);
        $this->assign('jsonData' , $jsonData);
        $this->assign('flag' , $flag);
        $this->display('/Statistics/Customerstatistics');

    }

    /**
     * actionAjaxFactory
     */
    public function actionAjaxFactory(){
        $mode = intval(I('mode'));
        $customername = trim(I('customer'));
        if(!$customername){
            return array('error'=>1 , 'msg'=>'no customername');
        }
        $typeStr = $mode == 1 ? 'totalprice' : 'goodsnum';
        $CustimerObj = new \CommonClass\Statistics\CustomerStatis();
        $customList = $CustimerObj->initi($customername);
        $data = $CustimerObj->factoryModel('customername' , $typeStr);
        $jsonData = json_encode(reset($data));
        die($jsonData);
    }
}
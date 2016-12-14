<?php
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2016/12/12
 * Time: 14:40
 */
namespace Admin\Controller\Statistics;
use Think\Controller;
class SalerstatisticsController extends Controller {


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
        $flag = intval(I('type'));
        if($flag == 0){
            $typeStr = 'totalprice';
        }else{
            $typeStr = 'goodsnum';
        }
        $CustimerObj = new \CommonClass\Statistics\CustomerStatis();
        $CustimerObj->initi();
        $data = $CustimerObj->factoryModel('salesman' , $typeStr);
        $jsonData = json_encode($data , JSON_UNESCAPED_UNICODE);

        $this->assign('jsonData' , $jsonData);
        $this->assign('flag' , $flag);
        $this->display('/Statistics/Salerstatistics');
    }


    public function actionCsvToSql(){
        $fileStr = file('test1.csv');
        unset($fileStr[0]);
        $newList = array();
        foreach($fileStr as $k => $v){
            $fileList = explode(',' , $v);
            $newList[]=$this->processOrderCate($fileList);
        }
        if(!empty($newList)){
            $flag = M('order')->addAll($newList);
        }
        var_dump($flag);
        die('111');

    }

    public function actionTest(){
    }

    /**
     * 处理字符串函数
     * @param $varData 需要处理的数据
     * @return array
     */
    public function processOrderCate($varData){
//        $orderCate = array(
//            'salesman' => '' ,
//            'xiatime' => '',
//            'ordertime' => 0,
//            'channel' => '',
//            'customerfresh' => '',
//            'customername' => '',
//            'industrycate' => '',
//            'recvpeople' => '',
//            'paycate' => '',
//            'sendcate' => '',
//            'leader' => '',
//            'goodsname' => '',
//            'goodsstyle' => '',
//            'goodprice' => 0.00,
//            'goodsnum' => 0,
//            'totalprice' =>0,
//        );

        $orderCate = array();

        $orderCate['salesman'] = $varData[0] ? trim($varData[0]) : '';
        $orderCate['xiatime'] = $varData[1] ? trim($varData[1]) : '';
        $orderCate['ordertime'] = $varData[7] ? strtotime($varData[7]) : 0;
        $orderCate['channel'] = $varData[2] ? trim($varData[2]) : 0;
        $orderCate['customerfresh'] = $varData[3] ? trim($varData[3]) : '';
        $orderCate['customername'] = $varData[4] ? trim($varData[4]) : '';
        $orderCate['industrycate'] = $varData[5] ? trim($varData[5]) : '';
        $orderCate['recvpeople'] = $varData[6] ? trim($varData[6]) : '';
        $orderCate['paycate'] = $varData[8] ? trim($varData[8]) : '';
        $orderCate['sendcate'] = $varData[9] ? trim($varData[9]) : '';
        $orderCate['leader'] = $varData[10] ? trim($varData[10]) : '';
        $orderCate['goodsname'] = $varData[11] ? trim($varData[11]) : '';
        $orderCate['goodsstyle'] = $varData[12] ? trim($varData[12]) : '';
        $orderCate['goodprice'] = $varData[13] ? trim($varData[13]) : 0.00;
        $orderCate['goodsnum'] = $varData[14] ? trim($varData[14]) : 0;
        $orderCate['totalprice'] = $varData[15] ? trim($varData[15]) : 0.00;
        return $orderCate;
    }




}
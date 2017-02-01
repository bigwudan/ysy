<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/17
 * Time: 16:00
 */

namespace Admin\Controller\Stockandsale;

use Think\Controller;
class CheckinController extends Controller
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
        $unitDataFromDb = M('ysy_unit')->select();
        $formatDataFromDb = M('ysy_format')->select();
        $dataListFromService = array(
            'unit' => json_encode($unitDataFromDb , JSON_UNESCAPED_UNICODE),
            'format' => json_encode($formatDataFromDb , JSON_UNESCAPED_UNICODE),
        );
        $this->assign('dataListFromService' , $dataListFromService);
        $this->display('/Stockandsale/Checkin');
    }

    /**
     * 显示
     */
    public function actionRequestService(){
        $type = I('type');
        if($type == 'checkin'){
            $this->_checkIn();
        }
    }


    /**
     * 入库单
     */
    private function _checkIn(){
        $CheckInObj = new \CommonClass\Stockandsale\CheckIn();
        $CheckInObj->initi(I('data'));
        $checkDataList = $CheckInObj->processData();
        $ProcessStockObj = new \CommonClass\Stockandsale\ProcessStock();
        $ProcessStockObj->initi($checkDataList);
        $stockList = $ProcessStockObj->processData();

        $CheckInUpdataObj = new \CommonClass\Stockandsale\CheckInUpdata();

        $CheckInUpdataObj->initi($checkDataList , $stockList);
        $CheckInUpdataObj->processData();

        die('xxx');
    }




}
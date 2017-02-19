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

    /**
     * 显示历史信息
     */
    public function index(){
        $where = '';
        $count = M('ysy_checkin')->where("1 = 1 {$where}")->count();
        $Page       = new \Think\NewPage($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $showPage       = $Page->show();// 分页显示输出
        $checkInFromDb = M('ysy_checkin')->where("1 = 1 {$where}")->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('showPage' , $showPage);
        $this->assign('checkInFromDb' , $checkInFromDb);
        $this->display('/Stockandsale/CheckInList');
    }


    /**
     * 新增入库单
     */
    public function actionEditCheckIn(){
        $checkInJson = 0;
        if($checkId = intval(I('checkin'))){
            $checkInListFromDb = M('ysy_checkin')
                ->alias('c')
                ->join('RIGHT JOIN think_ysy_checkingoods AS cg ON c.checkin_id = cg.checkin_id')
                ->where("c.checkin_id={$checkId}")
                ->select();
            $checkInJson = json_encode($checkInListFromDb , JSON_UNESCAPED_UNICODE);
        }
        $goodsDataFromDb = M('ysy_goods')->select();
        $dataListFromService = array(
            'goods' => json_encode($goodsDataFromDb , JSON_UNESCAPED_UNICODE),
        );
        $this->assign('checkId' , $checkId);
        $this->assign('checkInJson' , $checkInJson);
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
        $checkin = intval(I('checkin'));
        $CheckInObj = new \CommonClass\Stockandsale\CheckIn();
        $CheckInObj->initi(I('data'),$checkin);
        $checkDataList = $CheckInObj->processData();
        $ProcessStockObj = new \CommonClass\Stockandsale\ProcessStock();
        $ProcessStockObj->initi($checkDataList,$checkin);
        $stockList = $ProcessStockObj->processData();
        $RunCombinObj = new \CommonClass\DbModel\RunCombinStatement();
        $RunCombinObj->add($stockList);
        $flag = true;
        $Model = new \Think\Model();
        $Model->db()->startTrans();
        try{
            $RunCombinObj->run();
            $Model->db()->commit();
        }catch (\Exception $e){
            $Model->db()->rollback();
            $flag = false;
        }
        die('xxxxxx');
        return $flag;
    }




}
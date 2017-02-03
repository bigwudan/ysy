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
        $goodsPackageList= $this->_getGoodsPackage();
        $goodsPackageList = json_encode($goodsPackageList , JSON_UNESCAPED_UNICODE);
        $ConfigObj = new \CommonClass\Config\BaseConfig();


        $configList = array(
            'sendType' => $ConfigObj->getSendType(),
            'orderType' => $ConfigObj->getOrderType(),
        );
        $this->assign('goodsPackageList' , $goodsPackageList);
        $this->assign('configList' , json_encode($configList , JSON_UNESCAPED_UNICODE));
        $this->assign('sendType',$ConfigObj->getSendType());

        $this->display('/orderprocess/orderapprove');
    }

    /**
     * 得到商品
     */
    private function _getGoodsPackage(){
        $goodsPackageFromDb = M('ysy_goodspackage')->where('status = 0')->select();
        return $goodsPackageFromDb;
    }

    /**
     * ajax服务器
     */
    public function actionRequestService(){
        $type = trim(I('type'));
        if($type == 'changepackage'){
            $res = $this->_getGoodsPackageInfo();
            die($res);
        }
    }

    /**
     * 获得商品详情
     */
    private function _getGoodsPackageInfo(){
        $id = intval(I('id'));
        $packagePriceFromDb = M('ysy_packageprice')->where("packageid = {$id}")->select();
        if(!$packagePriceFromDb) return false;
        $packageInfoFromDb = M('ysy_goodspackageinfo')->where("packageid = {$id}")->select();
        if(!$packageInfoFromDb) return false;
        $flag = true;
        $minList = array();
        foreach($packageInfoFromDb as $k => $v){
            $tmpList = M('ysy_stock')->where("format_id={$v['format_id']}")->find();
            if(!$tmpList || $tmpList['goods_num'] == 0){
                $flag = false;
                break;
            }
            $tmpNum = intval($tmpList['goods_num'] / $v['num']);
            if($tmpNum == 0){
                $flag = false;
                break;
            }
            array_push($minList , $tmpNum);
        }
        sort($minList);
        $min = $minList[0];
        $priceList = $packagePriceFromDb;

        $responsejson = array(
            'min' => $min,
            'priceList' => $priceList

        );
        return json_encode($responsejson ,JSON_UNESCAPED_UNICODE);
    }

}
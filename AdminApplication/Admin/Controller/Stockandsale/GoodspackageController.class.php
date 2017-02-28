<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/17
 * Time: 16:00
 */

namespace Admin\Controller\Stockandsale;

use Think\Controller;
class GoodspackageController extends Controller
{

    /**
     * 订单信息
     */
    private $_orderType = array('销售订单','送样订单','赠送订单','兑券订单','损耗订单','次品销售订单','预售订单订单');






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
        $goodsPackList = M('ysy_goodspackage')->select();
        $this->assign('goodsPackList' , $goodsPackList);
        $this->display('/Stockandsale/GoodsPackageList');
    }


    /**
     * 分类得到商品
     */
    private function _getGoodsByFormatType($varFormatType){
        $GoodsAndFormatObj = new \CommonClass\Stockandsale\GoodsAndFormatClassify();
        $dataOfFormatBeList = $GoodsAndFormatObj->getByFormat(\CommonClass\Config\BaseConfig::getClassify()[$varFormatType]);

        $formatList = array();
        foreach($dataOfFormatBeList as $k => $v){
            array_push($formatList , $v['format_id']);
        }
        $formatList = implode(',' , $formatList);
        $goodsList = M('ysy_goods')
            ->alias('g')
            ->where("g.format_id in ({$formatList})")
            ->select();
        return $goodsList;
    }

    /**
     * 编辑
     */
    public function actionEditGoodsPackage(){
        $packageId = intval(I('packageid'));
        $goodsFromDb['goods'] = $this->_getGoodsByFormatType('goods');
        $goodsFromDb['pack'] = $this->_getGoodsByFormatType('pack');
        if($packageId){
            $goodsPackeageFromDb = M('ysy_goodspackage')->alias('gp')
                ->join("think_ysy_goodspackageinfo as gs ON gp.id = gs.packageid ")
                ->where("gp.id = {$packageId}")
                ->select();
            $goodsPackeageInfo = array();

            foreach($goodsPackeageFromDb as $k => $v){

                foreach($goodsFromDb['goods'] as $k1 => $v1){
                    if($v1['goods_id'] == $v['goods_id']){
                        $goodsPackeageInfo['goods'][] = $v;
                        break;
                    }
                }
                foreach($goodsFromDb['pack'] as $k1 => $v1){
                    if($v1['goods_id'] == $v['goods_id']){
                        $goodsPackeageInfo['pack'][] = $v;
                        break;
                    }
                }
            }


            $goodsPackeagePriceFromDb = M('ysy_packageprice')->where("packageid = {$packageId}")->select();
        }

        //$goodsFromDb = M('ysy_goods')->field('goods_id , goods_name')->select();
        $goodsJson = json_encode($goodsFromDb , JSON_UNESCAPED_UNICODE);
        $orderType = array(
            array('销售订单', 0),
            array('送样订单', 0),
            array('赠送订单', 0),
            array('兑券订单', 0),
            array('损耗订单', 0),
            array('次品销售订单', 0),
            array('预售订单订单', 0),
        );
        $this->assign('goodsPackeageJson' , json_encode($goodsPackeageInfo , JSON_UNESCAPED_UNICODE));
        $this->assign('goodsPackeageFromDb' , $goodsPackeageFromDb);
        $this->assign('goodsPackeagePriceFromDb' , $goodsPackeagePriceFromDb);
        $this->assign('packageId' , $packageId);
        $this->assign('goodsJson' , $goodsJson);
        $this->assign('orderType' , $orderType);
        $this->display('/Stockandsale/GoodsPackage');
    }

    /**
     *
     */
    public function actionRequestService(){
        $type = I('type');
        if($type == 'package'){
            $this->_package();
        }

    }

    /**
     *
     */
    private function _package(){
        $data = I('data');
        $packageIdFromRequest = intval(I('packageid'));

        if($packageIdFromRequest){
            $packageId =  $packageIdFromRequest;
        }else{
            $packageId =  time();

        }
        $goodspackage = array();
        $goodspackage['id'] = $packageId;

        $goodspackage['addtime'] = time();

        $goodspackage['uid'] = session('uid');

        $packageprice = array();
        $goodspackageinfo = array();
        foreach($data as $k => $v){
            if($v['name'] == 'packagename'){
                $goodspackage['packagename'] = $v['value'];
            }elseif($v['name'] == 'remark'){
                $goodspackage['remark'] = $v['value'];
            }elseif(strstr($v['name'] , 'packageprice-')){
                $tmp = intval(substr($v['name'] , 13));
                array_push($packageprice ,array('packageid' => $packageId , 'ordertype' => $tmp , 'price' => $v['value']) );
            }else{
                array_push($goodspackageinfo , $v);
            }
        }



        $goodspackageinfoList = array();
        for($num = 0 ; $num < count($goodspackageinfo) ; $num = $num + 2){
            array_push($goodspackageinfoList , array(
                'packageid' => $packageId,
                'goods_id' => $goodspackageinfo[$num]['value'],
                'num' => $goodspackageinfo[$num+1]['value'],
                'addtime' => time(),

            ));
        }
        $flag = true;
        $Model = new \Think\Model();
        $Model->db()->startTrans();
        try{
            if($packageIdFromRequest){
                $flag = M('ysy_goodspackage')->where("id = {$packageIdFromRequest}")->save($goodspackage);
            }else{
                $flag = M('ysy_goodspackage')->add($goodspackage);
            }
            if(!$flag) E('新增失败');

            if($packageIdFromRequest){
                $flag =  M('ysy_packageprice')->where("packageid = {$packageIdFromRequest}")->delete();
                if(!$flag) E('新增失败');
            }
            if($packageIdFromRequest){
                $flag =  M('ysy_goodspackageinfo')->where("packageid = {$packageIdFromRequest}")->delete();
                if(!$flag) E('新增失败');
            }
            $flag =  M('ysy_packageprice')->addAll($packageprice);
            if(!$flag) E('新增失败');
            $flag = M('ysy_goodspackageinfo')->addAll($goodspackageinfoList);
            if(!$flag) E('新增失败');
            $Model->db()->commit();
        }catch (\Exception $e){
            $Model->db()->rollback();
            $flag = false;
        }
        return $flag;
    }

}
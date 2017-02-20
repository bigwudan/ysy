<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/15
 * Time: 21:44
 */

namespace CommonClass\Order\Dealpackage;


class RebackOrderGoods
{
    /**
     * 数据
     */
    private $_orderId = null;

    /**
     * 初始化
     */
    public function initi($varOrderId){
        $this->_orderId = $varOrderId;
    }

    /**
     * 处理
     */
    public function prcessToSQL(){
        $dataFormDb = M('ysy_ordergoods')->where("order_id = {$this->_orderId}")->select();
        if(!$dataFormDb) return false;
        $DealObj = new \CommonClass\Order\Dealpackage\BaseDealPackage();
        $StatmentObjList = array();
        foreach($dataFormDb as $k => $v){
            if($v['ordertype'] == 6) continue;
            $DealObj->initi($v);
            $StatmentObjList = array_merge($StatmentObjList , $DealObj->prcessToSQL());
            if(!$StatmentObjList) return false;
        }
        return $StatmentObjList;
    }

    /**
     * 处理
     */
    public function getGoodsInfoByOrderId(){
        $resultList = array();
        $dataFormDb = M('ysy_ordergoods')->where("order_id = {$this->_orderId}")->select();
        if(!$dataFormDb) return false;
        foreach($dataFormDb as $k => $v){
            if($v['ordertype'] == 6) continue;
            $tmpList = $this->getSingleGoodsInfoAndNumByPackageId($v['package_id'] , $v['num']);
            $resultList = array_merge($resultList , $tmpList);
        }
        $resList = array();
        foreach($resultList as $k => $v){
            $resList[$v['goods_id']] += $v['num'];
        }
        return $resList;
    }

    /**
     * 处理num
     * @param int $varPackageId
     * @return array
     */
    public function getSingleGoodsInfoAndNumByPackageId($varPackageId , $varNUm){
        $resultList = array();
        $goodsPackageInfo = M('ysy_goodspackageinfo')->where("packageid = {$varPackageId}")->select();
        if(!$goodsPackageInfo) return false;
        foreach($goodsPackageInfo as $k => $v){
            $tmpNum = $v['num'] * $varNUm;
            $tmpList = array(
                'num' => $tmpNum,
                'goods_id' => $v['goods_id']
            );
            array_push($resultList , $tmpList);
        }
        return $resultList;
    }


}
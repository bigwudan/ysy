<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/15
 * Time: 21:44
 */

namespace CommonClass\Order;


class ProcessOrderInfoService
{

    /**
     * 数据
     */
    private $_data = null;

    /**
     * 订单号
     */
    private $_orderId = null;

    /**
     * 初始化
     */
    public function initi($varData , $varOrderId){
        $this->_data = $varData;
        $this->_orderId = $varOrderId;
    }

    /**
     * 操作
     */
    public function process(){
        $res['order'] = $this->_dealOrderInfo($this->_data['order'] , $this->_orderId);
        $res['OrderGoods']['insert'] = $this->_dealOrderGoods($this->_data['goodsPack']);
        $res['stock']['dec'] = $this->_dealPackageFactory($this->_data['goodsPack'] , $this->_orderId);
        return $res;
    }

    /**
     * 处理ordergoods
     */
    private function _dealOrderGoods($varOrderData){
        return $varOrderData;
    }

    /**
     * 处理orderinfo
     * @param $varOrderData array
     */
    private function _dealOrderInfo($varOrderData , $varOrderId){
        $res['insert'] = $varOrderData;
        return $res;
    }

    /**
     * 处理goodspackage
     */
    private function _dealPackageFactory($varPackage , $varOrderId){
        $stockSqlDec = array();
        foreach($varPackage as $k => $v){
            if($v['ordertype'] == 6) continue;
            $DealObj = new \CommonClass\Order\Dealpackage\BaseDealPackage();
            $DealObj->initi($v);
            $tmp = $DealObj->prcessToSQL();
            if($tmp === false) return false;
            $stockSqlDec = array_merge($stockSqlDec , $tmp);
        }

        return $stockSqlDec;
    }

}
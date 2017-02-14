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
     * CombinStatement
     */
    private $_combinStatementList = array();

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
        $tmpList = $this->_dealOrderInfo($this->_data['order'] , $this->_orderId);
        $this->_combinStatementList[] = $tmpList;
        $tmpList = array();
        $tmpList[] = $this->_dealOrderGoods($this->_data['goodsPack']);
        $this->_combinStatementList = array_merge($this->_combinStatementList , $tmpList);
        $tmpList = $this->_dealPackageFactory($this->_data['goodsPack']);
        $this->_combinStatementList = array_merge($this->_combinStatementList , $tmpList);
        return $this->_combinStatementList;
    }

    /**
     * 处理ordergoods
     */
    private function _dealOrderGoods($varOrderData){

        $obj = new \CommonClass\DbModel\CombinStatement('ysy_ordergoods');
        $res = $obj->insert($varOrderData);
        return $res;
    }

    /**
     * 处理orderinfo
     * @param $varOrderData array
     */
    private function _dealOrderInfo($varOrderData , $varOrderId){
        $CombinObj = new \CommonClass\DbModel\CombinStatement('ysy_order');
        if($varOrderId){
//            $res['update']['where'] = array('order_id' => $varOrderId);
//            $res['update']['data'] = $varOrderData;
            $res = $CombinObj->where("order_id = {$varOrderId}")->update($varOrderData);
        }else{
//            $res['insert'] = $varOrderData;
            $res = $CombinObj->insert($varOrderData);
        }
        return $res;
    }

    /**
     * 处理goodspackage
     */
    private function _dealPackageFactory($varPackage){
        $CommObjList = array();
        foreach($varPackage as $k => $v){
            if($v['ordertype'] == 6) continue;
            $DealObj = new \CommonClass\Order\Dealpackage\BaseDealPackage();
            $DealObj->initi($v);
            $tmp = $DealObj->prcessToSQL();
            $CommObjList = array_merge($CommObjList , $tmp);
        }
        return $CommObjList;
    }

}
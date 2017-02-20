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
     * 返回数据
     */
    private $_reBackGoods = null;

    /**
     * 初始化
     */
    public function initi($varData , $varOrderId , $varReBackGoods){
        $this->_data = $varData;
        $this->_orderId = $varOrderId;
        $this->_reBackGoods = $varReBackGoods;
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
        if($tmpList['error'] === 1){
            return $tmpList;
        }
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
     * @return array
     */
    private function _dealOrderInfo($varOrderData , $varOrderId){
        $CombinObj = new \CommonClass\DbModel\CombinStatement('ysy_order');
        if($varOrderId){
            $res = $CombinObj->where("order_id = {$varOrderId}")->update($varOrderData);
        }else{
            $res = $CombinObj->insert($varOrderData);
        }
        return $res;
    }

    /**
     * 处理goodspackage
     */
    private function _dealPackageFactory($varPackage){
        $CommonObjList = array();
        $tmpReBackList = array();
        foreach($varPackage as $k => $v){
            if($v['ordertype'] == 6) continue;
            $ReBackObj = new \CommonClass\Order\Dealpackage\RebackOrderGoods();
            $tmpList = $ReBackObj->getSingleGoodsInfoAndNumByPackageId($v['package_id'] , $v['num']);
            $tmpReBackList = array_merge($tmpReBackList , $tmpList);
        }
        $res = array();
        foreach($tmpReBackList as $k => $v){
            $res[$v['goods_id']] += $v['num'];
        }

        $kList = array_keys($res);
        $kList = implode(',' , $kList);
        $stockList = M('ysy_stock')->where("goods_id in ($kList)")->select();
        $tmpStockList = array();
        foreach($stockList as $k => $v){
            $tmpStockList[$v['goods_id']] = $v['goods_num'];
        }
        if($this->_reBackGoods){
            foreach($this->_reBackGoods as $k => $v){
                $CommonObj = new \CommonClass\DbModel\CombinStatement('ysy_stock');
                $CommonObj->where("goods_id = {$k}")->inc(array('name' => 'goods_num' , 'value' => $v));
                $CommonObjList[] = $CommonObj;
                $tmpStockList[$k] = $tmpStockList[$k] + $v;
            }
        }
        $flag = true;
        foreach($res as $k => $v){
            if($v > $tmpStockList[$k]){
                $flag = $k;
                break;
                //return array('error'=>1 , 'msg' =>  $k);
            }else{
                $CommonObj = new \CommonClass\DbModel\CombinStatement('ysy_stock');
                $CommonObj->where("goods_id = {$k}")->dec(array('name' => 'goods_num' , 'value' => $v));
                $CommonObjList[] = $CommonObj;
            }
        }
        if($flag === true){
            return $CommonObjList;
        }else{
            return array('error'=>1 , 'msg' => $flag );
        }
    }

}
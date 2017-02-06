<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/15
 * Time: 21:44
 */

namespace CommonClass\Order;


class AssembleOrderOfForm
{
    private $_orderId = null;
    private $_orderDataOfForm = null;
    public function initi($varData , $varOrderId){
        $this->_orderDataOfForm = $varData;
        $this->_orderId = $varOrderId;
    }

    /**
     * 验证数据
     */
    private function _checkDataOfForm(){
        foreach($this->_orderDataOfForm as $k => $v){
            if($v['name'] == 'price[]' || $v['name'] == 'deliveryttpe' || $v['name'] == 'orderid'){
                if($v['value'] == ''){
                    return array('error'=>1 , 'msg' => '价格异常');
                }
            }else{
                if(!$v['value']){
                    return array('error'=>1 , 'msg' => '信息不完整');
                }
            }
        }
        return true;
    }


    /**
     * 组合数据
     */
    public function processData(){
        $res = $this->_checkDataOfForm();
        if($res !== true){
            return $res;
        }
        if($this->_orderId){
            $orderId = $this->_orderId;
        }else{
            $orderId = time();
        }
        $goodspackageinfo = array();
        $orderInfo = array();
        $orderInfo['addtime'] = time();
        $orderInfo['belonger'] = 1;
        $orderInfo['order_id'] = $orderId;
        foreach($this->_orderDataOfForm as $k => $v){
            if($v['name'] == 'package_id[]' || $v['name'] == 'ordertype[]' || $v['name'] == 'num[]' || $v['name'] == 'price[]'){
                array_push($goodspackageinfo , $v);
            }else{
                $orderInfo[$v['name']] = $v['value'];
            }
        }
        $orderInfo['requireddeliverytime'] = strtotime($orderInfo['requireddeliverytime']);
        $newGoodsPackeInfo = array();
        for($num = 0 ; $num < count($goodspackageinfo) ; $num=$num+4){
            $newGoodsPackeInfo[] = array(
                'price' => $goodspackageinfo[$num]['value'],
                'package_id' => $goodspackageinfo[$num+1]['value'],
                'ordertype' => $goodspackageinfo[$num+2]['value'],
                'num' => $goodspackageinfo[$num+3]['value'],
                'order_id' => $orderId,
            );
        }
        return array(
            'goodsPack' => $newGoodsPackeInfo,
            'order' => $orderInfo
        );
    }


}
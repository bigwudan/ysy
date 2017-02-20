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
     * @param array $varData 数据
     * @return array
     */
    private function _checkDataOfForm($varData){
        $orderList = $varData['order'];
        $goodsPackList = $varData['goodsPack'];
        if(!$orderList['rece_tel']) return array('error'=>1 , 'msg' => '填写客户电话');
        if(empty($varData['order'])) return array('error'=>1 , 'msg' => '填写订单申请');
        if(!intval($orderList['order_id'])) return array('error'=>1 , 'msg' => '订单号错误');
        if(!$orderList['requireddeliverytime']) return array('error'=>1 , 'msg' => '填写发货时间');
        if(empty($goodsPackList)) return array('error'=>1 , 'msg' => '商品为空');
        foreach($goodsPackList as $k => $v){
            if(!$v['price']) return array('error'=>1 , 'msg' => '商品价格错误');
            if(!intval($v['package_id'])) return array('error'=>1 , 'msg' => '商品号错误');
            if($v['ordertype'] === '请选择商品') return array('error'=>1 , 'msg' => '订单类型错误');
            if(!intval($v['num'])) return array('error'=>1 , 'msg' => '商品数量错误');
        }
        return true;
    }
    /**
     * 组合数据
     */
    public function processData(){
        $orderInfo = $this->_processOrder();
        $res = $this->_checkDataOfForm($orderInfo);
        if($res === true){
            return $orderInfo;
        }else{
            return $res;
        }
    }

    /**
     * 处理订单
     */
    private function _processOrder(){
        $UserObj = new \CommonClass\Login\ProcessLoginInfo();
        $uid = $UserObj->getLoginInfo()['id'];
        if($this->_orderId){
            $orderId = $this->_orderId;
        }else{
            $orderId = time();
        }
        $goodspackageinfo = array();
        $orderInfo = array();
        $orderInfo['addtime'] = time();
        $orderInfo['order_id'] = $orderId;
        foreach($this->_orderDataOfForm as $k => $v){
            if($v['name'] == 'package_id[]' || $v['name'] == 'ordertype[]' || $v['name'] == 'num[]' || $v['name'] == 'price[]'){
                array_push($goodspackageinfo , $v);
            }else{
                $orderInfo[$v['name']] = $v['value'];
            }
        }
        $orderInfo['requireddeliverytime'] = strtotime($orderInfo['requireddeliverytime']);
        $orderInfo['order_user'] = $uid;
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
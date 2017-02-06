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
        if($dataFormDb) return false;
        $DealObj = new \CommonClass\Order\Dealpackage\BaseDealPackage();
        $stock = array();
        foreach($dataFormDb as $k => $v){
            if($v['ordertype'] == 6) continue;
            $DealObj->initi($v);
            $stock = array_merge($stock , $DealObj->prcessToSQL());
            if(!$stock) return false;
        }
        $orderGoods = array('order_id' => $this->_orderId);
        return array('stock' => $stock , 'orderGoods' => $orderGoods);
    }

}
<?php
namespace CommonClass\Config;
/**
* Created by PhpStorm.
* User: Administrator
* Date: 2016/10/16
* Time: 9:32
*/
class BaseConfig
{
    /**
     *
     */
    private $_sendType = array('物流' , '自提');

    /**
     * 订单信息
     */
    private $_orderType = array('销售订单','送样订单','赠送订单','兑券订单','损耗订单','次品销售订单','预售订单订单');

    /**
     * 得到物流信息
     */
    public function getSendType(){

        return $this->_sendType;
    }

    /**
     * 订单信息
     */
    public function getOrderType(){
        return $this->_orderType;
    }


}
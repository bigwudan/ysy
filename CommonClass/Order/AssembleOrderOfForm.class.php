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
     * 组合数据
     */
    public function processData(){
        $goodspackageinfo = array();
        foreach($this->_orderDataOfForm as $k => $v){

            if($v['name'] == 'package_id[]' || $v['name'] == 'ordertype[]' || $v['name'] == 'num[]'){

                array_push($goodspackageinfo , $v);
            }


        }
        var_dump($goodspackageinfo);
        die();
    }


}
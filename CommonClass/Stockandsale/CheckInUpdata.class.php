<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/15
 * Time: 21:44
 */

namespace CommonClass\Stockandsale;


class CheckInUpdata
{

    /**
     * checkingoods
     */
    private $_checkInGoods = null;

    /**
     * stockList
     */
    private $_stockList = null;

    /**
     * 初始化
     * @param $varCheckingoods array
     * @param $varStockList array
     * @return array
     */
    public function initi($varCheckingoods , $varStockList){
        $this->_checkInGoods = $varCheckingoods;
        $this->_stockList = $varStockList;
    }

    /**
     * 组合数据
     */
    public function processData(){

        $Model = new \Think\Model();
        $Model->db()->startTrans();
        $flag = M('ysy_checkin')->add($this->_checkInGoods['checkin']);

        //checkingoods
        $flag = M('ysy_checkingoods')->addAll($this->_checkInGoods['checkingoods']);
        $Model->db()->commit();
        die();




    }


}
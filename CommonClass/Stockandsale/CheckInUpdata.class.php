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
        $flag = true;
        try{
            $Model = new \Think\Model();
            $Model->db()->startTrans();
            if(isset($this->_checkInGoods['checkInUp'])){
                $flag = M('ysy_checkin')->where("checkin_id = {$this->_checkInGoods['checkInUp']['checkin_id']}")->save($this->_checkInGoods['checkInUp']);
            }else{
                $flag = M('ysy_checkin')->add($this->_checkInGoods['checkInAdd']);
            }
            if(!$flag) E('新增失败');
            if($this->_stockList['checkInGoodsDel']){
                $flag = M('ysy_checkingoods')->where("checkin_id = {$this->_stockList['checkInGoodsDel']['where']}")->delete();
                if(!$flag) E('新增失败');

            }
            $flag = M('ysy_checkingoods')->addAll($this->_checkInGoods['checkingoods']);
            if(!$flag) E('新增失败');
            if($this->_stockList['stockDec']){
                foreach($this->_stockList['stockDec'] as $k => $v){
                    $flag = $Model->db()->execute("update think_ysy_stock SET goods_num = goods_num - {$v['data']['goods_num']} , goods_weight = goods_weight - {$v['data']['goods_weight']} where format_id = {$v['where']['format_id']}");
                    if(!$flag) E('新增失败');
                }
            }
            foreach($this->_stockList['stockAdd'] as $k => $v){
                $flag = $Model->db()->execute("update think_ysy_stock SET goods_num = goods_num + {$v['data']['goods_num']} , goods_weight = goods_weight + {$v['data']['goods_weight']} where format_id = {$v['where']['format_id']}");
                if(!$flag) E('新增失败');
            }
            $Model->db()->commit();
        }catch (\Exception $e){
            $Model->db()->rollback();
            $flag = false;
        }
        return $flag;
    }


}
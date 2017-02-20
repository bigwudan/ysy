<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/15
 * Time: 21:44
 */

namespace CommonClass\Stockandsale;


class ProcessStock
{
    /**
     * 数据
     */
    private $_dataFromClient = null;

    /**
     *
     */
    private $_checkIn = null;

    /**
     * 初始化
     * @param $varData array
     * @param $varCheckIn array
     * @return array
     */
    public function initi($varData , $varCheckIn){
        $this->_dataFromClient = $varData;
        $this->_checkIn = $varCheckIn;
    }

    /**
     * 组合数据
     */
    public function processData(){
        $DbObjOfResultList = array();
        if($this->_dataFromClient['checkInAdd']){
            $DbModelObj = new \CommonClass\DbModel\CombinStatement('ysy_checkin');
            $DbObjOfResultList[] = $DbModelObj->insert($this->_dataFromClient['checkInAdd']);
        }else{
            $DbModelObj = new \CommonClass\DbModel\CombinStatement('ysy_checkin');
            $DbObjOfResultList[] = $DbModelObj->where("checkin_id = {$this->_checkIn}")->update($this->_dataFromClient['checkInUp']);
        }
        if($this->_checkIn){
            $checkinGoodsList = M('ysy_checkingoods')->where("checkin_id = {$this->_checkIn}")->select();
            $DbModelObj = new \CommonClass\DbModel\CombinStatement('ysy_checkingoods');
            $DbObjOfResultList[] = $DbModelObj->where("checkin_id = {$this->_checkIn}")->del();
            foreach($checkinGoodsList as $k => $v){
                $DbModelObj = new \CommonClass\DbModel\CombinStatement('ysy_stock');
                $DbObjOfResultList[] = $DbModelObj->execute("update think_ysy_stock SET goods_num = goods_num - {$v['goodsnum']} , goods_weight = goods_weight - {$v['grossweight']} where goods_id = {$v['goods_id']}");
            }
        }
        foreach($this->_dataFromClient['checkingoods'] as $k => $v){
            $DbModelObj = new \CommonClass\DbModel\CombinStatement('ysy_checkingoods');
            $DbObjOfResultList[] = $DbModelObj->insert($v);
            $DbModelObj = new \CommonClass\DbModel\CombinStatement('ysy_stock');
            $DbObjOfResultList[] = $DbModelObj->execute("update think_ysy_stock SET goods_num = goods_num + {$v['goodsnum']} , goods_weight = goods_weight + {$v['grossweight']} where goods_id = {$v['goods_id']}");
        }
        return $DbObjOfResultList;
    }


}
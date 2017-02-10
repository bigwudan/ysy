<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/15
 * Time: 21:44
 */

namespace CommonClass\Stockandsale;


class CheckIn
{
    /**
     * 数据
     */
    private $_dataFromClient = null;

    /**
     * checkIn
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
        if(!$count = count($this->_dataFromClient)){
            return false;
        }
        $checkId =  time();
        $dataList =array();
        $data = $this->_dataFromClient;
        for($num = 0 ; $num < $count ; $num = $num + 4){
            array_push($dataList , array(
                'goods_id' => $data[$num]['value'],
                'goodsnum' => $data[$num+1]['value'],
                'grossweight' => $data[$num+2]['value'],
                'weight' => $data[$num+3]['value'],
                'checkin_id' => $checkId
            ));
        }
        if($this->_checkIn){
            $checkId =  $this->_checkIn;
            $list = array(
                'checkInUp' => array(
                    'checkin_id' => intval($checkId),
                    'addtime' => time(),
                    'uid' =>session('uid')
                ),
                'checkingoods' =>$dataList
            );
        }else{
            $list = array(
                'checkInAdd' => array(
                    'checkin_id' => $checkId,
                    'addtime' => time(),
                    'uid' =>session('uid')
                ),
                'checkingoods' =>$dataList
            );
        }
        $flag = $this->_checkData($list);
        if(!$flag) return false;
        return $list;
    }

    /**
     * 验证数据完整性和准确性
     */
    private function _checkData($varNeedData){
        if(empty($varNeedData)) return false;
        $data = $varNeedData['checkingoods'];
        foreach($data as $k => $v){
            if(!$v['checkin_id'] || !$v['goods_id'] || !$v['goodsnum']){
                return false;
            }
        }
        return true;
    }


}
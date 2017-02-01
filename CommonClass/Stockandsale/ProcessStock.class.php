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
        $stock = array();
        $checkingoods = 0;
        $stockDec = 0;
        if($this->_checkIn){
            $checkingoods = array(
                'condition' => 'del',
                'where' => $this->_checkIn

            );
            $data = M('ysy_checkingoods')->where("checkin_id = {$this->_checkIn}")->select();
            $stockDec = array();
            foreach($data as $k => $v){
                $stockDec[] = array(
                    'where' => array(
                        'format_id' => $v['format_id']
                    ),
                    'condition' => 'dec',
                    'data' => array(
                        'goods_num' => $v['goodsnum'],
                        'goods_weight' => $v['weight'],
                    )
                );
            }
        }
        foreach($this->_dataFromClient['checkingoods'] as $k => $v){
            $stock[] = array(
                'where' => array(
                    'format_id' => $v['format_id']
                ),
                'condition' => 'add',
                'data' => array(
                    'goods_num' => $v['goodsnum'],
                    'goods_weight' => $v['weight'],
                )
            );
        }
        $res = array(
            'checkInGoodsDel' => $checkingoods,
            'stockDec' =>$stockDec,
            'stockAdd' => $stock
        );
        return $res;
    }


}
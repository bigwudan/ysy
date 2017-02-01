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
     * 初始化
     * @param $varData array
     * @return array
     */
    public function initi($varData){
        $this->_dataFromClient = $varData;
    }

    /**
     * 组合数据
     */
    public function processData(){
        $stock = array();
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
        return $stock;
    }


}
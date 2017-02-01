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
        if(!$count = count($this->_dataFromClient)){
            return false;
        }
        $checkId = date('Ymdhis');
        $dataList =array();
        $data = $this->_dataFromClient;
        for($num = 0 ; $num < $count ; $num = $num + 4){
            array_push($dataList , array(
                'format_id' => $data[$num]['value'],
                'goodsnum' => $data[$num+1]['value'],
                'grossweight' => $data[$num+2]['value'],
                'weight' => $data[$num+3]['value'],
                'checkin_id' => $checkId
            ));
        }

        $list = array(
            'checkin' => array(
                'checkin_id' => $checkId,
                'addtime' => time(),
                'uid' =>session('uid')
            ),
            'checkingoods' =>$dataList
        );
        return $list;
    }


}
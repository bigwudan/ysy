<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/15
 * Time: 21:15
 */

namespace CommonClass\Statistics;


class GoodStatis extends \CommonClass\Statistics\StatisAbstract
{
    public function initi()
    {

    }

    public function getGoodsNumByGood($varGoodName){
        $Model = new \Think\Model();
        $data = $Model->db()->query("select * from think_order where goodsname = '{$varGoodName}' AND ordertime !=0");
        if(empty($data)){
            return array('error' => 1 , 'msg'=>'11');
        }else{
            $this->_dataInfo = $data;
            return $data;
        }
    }

}
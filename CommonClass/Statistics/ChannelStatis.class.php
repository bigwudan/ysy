<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/15
 * Time: 21:44
 */

namespace CommonClass\Statistics;


class ChannelStatis extends \CommonClass\Statistics\StatisAbstract
{
    /**
     * 初始化
     * @return array
     */
    public function initi(){
        $Model = new \Think\Model();
        $data = $Model->db()->query("select * from think_order where ordertime != 0 AND channel in ('个人','团购','渠道')");
        $this->_dataInfo = $data;
        if(empty($data)){
            return array('error' => 1 , 'msg' => 'sql is null');
        }else{
            return $data;
        }
    }
}
<?php
namespace CommonClass\Statistics;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/11
 * Time: 11:26
 */
class CustomerStatis extends \CommonClass\Statistics\StatisAbstract
{
    /**
     * 初始化
     * @return array
     */
    public function initi($varCustomer = null){
        $where = "";
        if($varCustomer){
            $where = "AND customername = '{$varCustomer}'";
        }
        $Model = new \Think\Model();
        $data = $Model->db()->query("select * from think_order where ordertime != 0 {$where}");
        $this->_dataInfo = $data;
        if(empty($data)){
            return array('error' => 1 , 'msg' => 'sql is null');
        }else{
            return $data;
        }
    }




}
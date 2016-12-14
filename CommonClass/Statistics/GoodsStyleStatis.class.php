<?php

/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2016/12/12
 * Time: 10:09
 */

namespace CommonClass\Statistics;


class GoodsStyleStatis extends \CommonClass\Statistics\StatisAbstract {

    /**
     * 商品格式
     */
    private $_goodStyle = null;


    /**
     * 初始化
     * @return array
     */
    public function initi(){
        $Model = new \Think\Model();
        $data = $Model->db()->query("select goodsname ,goodsstyle from think_order GROUP BY goodsstyle");
        if(empty($data)) return array('error' => 1 , 'msg' => 'sql null');
        $this->_goodStyle = $data;
        $data = $Model->db()->query("select * from think_order where ordertime !=0");
        $this->_dataInfo = $data;
        if(empty($data)){
            return array('error' => 1 , 'msg' => 'sql is null');
        }else{
            $this->_dataInfo = $data;
            return $data;
        }
    }

    /**
     * 得到goodStyle
     */
    public function getGoodStyle(){
        return $this->_goodStyle;
    }

    /**
     * 依据条件得到data
     * @param $varData array 条件数据
     * @return array
     */
    public function getDataByGoodStyle($varData){
        $tmp = null;
        $newData = array();
        if(!empty($varData)){
            foreach($varData as $k => $v){
                $newData[] = "'{$v}'";
            }
            $tmp = implode(',' , $newData);
            $Model = new \Think\Model();
            $data = $Model->db()->query("select * from think_order where goodsstyle in ($tmp) AND ordertime !=0");
            if(empty($data)){
                return array('error' => 1 , 'msg' => 'no sql');
            }else{
                $this->_dataInfo = $data;
                return $data;
            }
        }
    }
}
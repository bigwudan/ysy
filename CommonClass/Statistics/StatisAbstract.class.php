<?php
namespace CommonClass\Statistics;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/11
 * Time: 11:30
 */

namespace CommonClass\Statistics;


abstract class StatisAbstract
{
    /**
     * 原始数据
     */
    protected $_dataInfo = null;

    /**
     * 初始化
     */
    abstract function initi();

    /**
     * 执行程序
     */
    protected function _processDataInfo(){
        var_dump($this->_dataInfo);
    }

    /**
     * 依靠分组
     * @param $varType 类型
     * @return array
     */
    protected function _processDataByType($varType){
        $newData = array();
        foreach($this->_dataInfo as $k => $v){
            $v[$varType] && $newData[$v[$varType]][] = $v;
        }
        return $newData;
    }

    /**
     * 分类别
     */
    protected function _processDataByCate($varData , $varCata){
        $newData = array();
        foreach($varData as $k => $v){
            foreach($v as $k1 => $v1){
                $tmpTime = date('Y-n' , $v1['ordertime'] );
                $newData[$k][$tmpTime] = $newData[$tmpTime] + $v1[$varCata];
            }
        }
        return $newData;
    }


    /**
     * 工厂方法
     * @param $varType string 类型
     * @param $varCate string 类型
     * @return array
     */
    public function factoryModel($varType , $varCate){
        $data = $this->_processDataByType($varType);
        if(empty($data)) return array('error' => 1 , 'msg' => __CLASS__);
        $data = $this->_processDataByCate($data , $varCate);
        if(empty($data)) return array('error' => 1 , 'msg' => __CLASS__);
        return $data;
    }



}
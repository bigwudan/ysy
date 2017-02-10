<?php
namespace CommonClass\DbModel;
/**
* Created by PhpStorm.
* User: Administrator
* Date: 2016/10/16
* Time: 9:32
*/
class RunCombinStatement
{
    /**
     * 组合数据
     */
    private $_combinStatementList = array();

    /**
     * 新增
     */
    public function add($varCombinStateObj){
        $this->_combinStatementList[] = $varCombinStateObj;

    }

    /**
     * 运行
     */
    public function run(){
        $flag = true;
        foreach($this->_combinStatementList as $k => $v){
            $flag = $v->run();
            if(!$flag) E('新增失败');
        }
        return $flag;
    }

    /**
     * 得到$_combinStatementList
     */
    public function getCombinStatementList(){
        return $this->_combinStatementList;
    }


    
    
}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/19
 * Time: 22:14
 */

namespace Org\Jbmp\HandlerClass;


class AssmebleHistProcinst
{
    /**
     *
     */
    private $_varsList = null;

    /**
     *
     */
    private $_executionObj = null;

    /**
     *
     */
    private $_targetNode = null;

    /**
     * 结果
     */
    private $_execution = null;

    /**
     *
     */
    private $_num = null;

    /**
     *
     */
    private $_histProcinst = null;


    /**
     * 初始化
     */
    public function initi($varExecution  ,  $varTargetNode , $varNum,  $execution ){
        $this->_executionObj = $varExecution;
        $this->_targetNode = $varTargetNode;
        $this->_num = $varNum;
        $this->_execution = $execution;
        return $this;
    }

    /**
     *
     */
    public function process(){
        $currNode  =  $this->_executionObj->getCurrNode();
        if($currNode['nodeName'] == 'start'){
            $histProcinst = $this->_processInsert();
        }else{
            $histProcinst = array();
        }
        $this->_histProcinst  = $histProcinst;
        return $histProcinst;
    }


    /**
     * 得到num
     */
    public function getNum(){
        return $this->_num;
    }

    /**
     * 处理开始
     */
    private function _processInsert(){
        if($firstExecution = current($this->_execution['insert'])){
            $histProcinst['insert'][$firstExecution['dbid']] = array(
                'dbid' => $firstExecution['dbid'],
                'id' => $firstExecution['id'],
                'procdefid' => $this->_executionObj->getRule()['rulename'],
                'key' => '',
                'start' => time(),
                'end' => 0,
                'duration' =>0,
                'state' => 'active',
                'endactivity' => ''

            );
        }
        $this->_histProcinst = $histProcinst;
        return $histProcinst;
    }

}
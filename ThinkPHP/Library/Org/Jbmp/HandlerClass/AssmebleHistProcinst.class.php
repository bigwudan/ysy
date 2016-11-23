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
            $histProcinst['insert'] = $this->_processInsert();
        }elseif($this->_targetNode->getTargetNodeList()['nodeName'] == 'end') {
            $histProcinst['updata'] = $this->_processUpdata();
        }else{
            $histProcinst = array();
        }
        return $histProcinst;
    }


    /**
     * 得到num
     */
    public function getNum(){
        return $this->_num;
    }

    /**
     * 更新
     */
    private function _processUpdata(){
        $data = $this->_executionObj->getExecution();
        $histProcinst[$data['instance']] = array(
            'state' => 'ended',
            'end' => time(),
            'duration' => time() - $this->_executionObj->getHistProcinst()['start'],
            'endactivity' => $this->_targetNode->getTargetNodeList()['name']
        );
        return $histProcinst;

    }

    /**
     * 处理开始
     */
    private function _processInsert(){
        if($firstExecution = current($this->_execution['insert'])){
            $histProcinst[$firstExecution['dbid']] = array(
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
        return $histProcinst;
    }

}
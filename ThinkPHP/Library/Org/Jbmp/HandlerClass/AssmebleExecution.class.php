<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/19
 * Time: 21:41
 */
namespace Org\Jbmp\HandlerClass;
class AssmebleExecution
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
     * 初始化
     * @param $varExecution
     * @param $varTargetNode
     * @param $varNum
     * @param $varVars
     * @return array
     */
    public function initi($varExecution  ,  $varTargetNode , $varNum,  $varVars = array()){
        $this->_executionObj = $varExecution;
        $this->_targetNode = $varTargetNode;
        $this->_num = $varNum;
        $varVars && $this->_varsList = $varVars;
        return $this;
    }

    /**
     *
     */
    public function process(){
        $currNode  =  $this->_executionObj->getCurrNode();
        if($currNode['nodeName'] == 'start'){
            $execution = $this->_processInsert();
        }else{
            $execution = $this->_processBelongToCommon();
        }
        $this->_execution  = $execution;
        return $execution;
    }


    /**
     * 处理其他
     */
    private function _processBelongToCommon(){
        $execution = $this->_executionObj->getExecution();
        $where = array();
        $where['dbid'] = $execution['dbid'];
        $targetNodeList = $this->_targetNode->getTargetNodeList();
        $upData = array(
            'activityname' => $targetNodeList['name'],
            'hisactinst' => 0
        );
        $this->_num =$this->_num + 1;
        $tmpExecution['updata'] = array(
            array(
                'where'=>$where,
                'data'=>$upData
            )
        );
        return $tmpExecution;
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
        $hasVars  =  $this->_varsList ? 1 :  0;
        if($this->_targetNode->getTargetNodeList()['nodeName'] == 'fork'){

            $execution['insert'][$this->_num] = array(
                'dbid' => $this->_num,
                'activityname'  => '',
                'procdefid' => $this->_executionObj->getRule()['rulename'],
                'hasvars' => $hasVars,
                'key' => '',
                'id' => "{$this->_executionObj->getRule()['rulename']}.{$this->_num}",
                'state' => 'inactive-concurrent-root',
                'priority' => 0,
                'hisactinst' => 0,
                'parent' => 0,
                'parentidx' => 0,
                'instance' => $this->_num
            );
            $this->_num =$this->_num + 1;

            $mainId = current($execution['insert'])['id'];
            foreach($this->_targetNode->getForkTargetNodeList() as $k => $v){
                $execution['insert'][$this->_num] = array(
                    'dbid' => $this->_num,
                    'activityname'  => $v['name'],
                    'procdefid' => $this->_executionObj->getRule()['rulename'],
                    'hasvars' => $hasVars,
                    'key' => '',
                    'id' => "{$mainId}.to {$v['name']}.{$this->_num}",
                    'state' => 'active-concurrent',
                    'priority' => 0,
                    'hisactinst' => 0,
                    'parent' => current($execution['insert'])['dbid'],
                    'parentidx' => 0,
                    'instance' => $this->_num
                );
                $this->_num =$this->_num + 1;
            }
        }else{
            $execution['insert'][$this->_num] =  array(
                'dbid' => $this->_num,
                'activityname'  => $this->_targetNode->getTargetNodeList()['name'],
                'procdefid' => $this->_executionObj->getRule()['rulename'],
                'hasvars' => $hasVars,
                'key' => '',
                'id' => "{$this->_executionObj->getRule()['rulename']}.{$this->_num}",
                'state' => 'active-root',
                'priority' => 0,
                'hisactinst' => 0,
                'parent' => 0,
                'parentidx' => 0,
                'instance' => $this->_num
            );
            $this->_num =$this->_num + 1;
        }
        return $execution;
    }

}
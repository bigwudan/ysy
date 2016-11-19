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
            $execution = $this->_processBelongToStart();
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
    private function _processBelongToStart(){
        $hasVars  =  $this->_varsList ? 1 :  0;
        if($this->_targetNode->getTargetNodeList()['nodeName'] == 'fork'){
            $execution['insert']['forkmain'] = array(
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
            foreach($this->_targetNode->getForkTargetNodeList() as $k => $v){
                $execution['insert']['fork'][] = array(
                    'dbid' => $this->_num,
                    'activityname'  => $v['name'],
                    'procdefid' => $this->_executionObj->getRule()['rulename'],
                    'hasvars' => $hasVars,
                    'key' => '',
                    'id' => "{$execution['insert']['forkmain']['id']}.to {$v['name']}.{$this->_num}",
                    'state' => 'active-concurrent',
                    'priority' => 0,
                    'hisactinst' => 0,
                    'parent' => $execution['insert']['forkmain']['dbid'],
                    'parentidx' => 0,
                    'instance' => $this->_num
                );
                $this->_num =$this->_num + 1;
            }
        }else{
            $execution['insert'][] =  array(
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
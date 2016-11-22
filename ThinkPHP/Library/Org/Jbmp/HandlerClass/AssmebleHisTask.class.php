<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/20
 * Time: 21:09
 */

namespace Org\Jbmp\HandlerClass;


class AssmebleHisTask
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
     * task
     */
    private $_task = null;

    /**
     *
     */
    private $_histActinst = null;

    /**
     *
     */
    private $_tmpTask = null;

    /**
     * 初始化
     */
    public function initi($varExecution  ,  $varTargetNode , $varNum,  $execution , $task ,$tmpTask ){
        $this->_executionObj = $varExecution;
        $this->_targetNode = $varTargetNode;
        $this->_num = $varNum;
        $this->_execution = $execution;
        $this->_task = $task;
        $this->_tmpTask = $tmpTask;
        return $this;
    }

    /**
     *
     */
    public function process(){
        $currNode  =  $this->_executionObj->getCurrNode();
        $histTask = array();
        if($currNode['nodeName'] == 'start'){
            $histTask = $this->_processInsert();
        }else{
            $histTaskUp = $this->_processUpdata();
            if($histTaskUp){
                $histTask = array_merge($histTaskUp , $histTask);
            }
            $histTaskInsert = $this->_processInsert();
            if($histTaskInsert){
                $histTask = array_merge($histTaskInsert , $histTask);
            }
        }
        return $histTask;
    }


    /**
     * 更新
     */
    private function _processUpdata(){
        $hisTask = $this->_executionObj->getHisTask();
        $this->_targetNode->getTargetNodeList();
        $where['dbid'] = $hisTask['dbid'];
        $upData = array(
            'outcome' => $this->_targetNode->getTargetNodeList()['name'],
            'state' => 'complete',
            'end' => time(),
            'duration' =>time() - $hisTask['create']
        );
        $tmpHistTask['updata'] = array(
            $hisTask['dbid'] =>array(
                'where'=>$where,
                'data'=>$upData)
        );
        return $tmpHistTask;
    }


    /**
     * 插入
     */
    private function _processInsert(){
        if($this->_tmpTask){
            foreach($this->_task['insert'] as $k => $v){
                $hisTask['insert'][$v['dbid']] = array(
                    'dbid' => $v['dbid'],
                    'execution' => $v['execution_id'],
                    'outcome' => '',
                    'assignee' => '',
                    'priority' => 0,
                    'state' => 'open',
                    'create' => time(),
                    'end' => 0,
                    'duration' => 0
                );
            }
        }else{
            if($this->_targetNode->getTargetNodeList()['nodeName'] == 'task'){
                $execution = $this->_executionObj->getExecution();
                $tmpExecution = current($this->_execution['insert'])['id'] ? current($this->_execution['insert'])['id'] : $execution['id'];
                $hisTask['insert'][current($this->_task['insert'])['dbid']] = array(
                    'dbid' => current($this->_task['insert'])['dbid'],
                    'execution' => $tmpExecution,
                    'outcome' => '',
                    'assignee' => '',
                    'priority' => 0,
                    'state' => 'open',
                    'create' => time(),
                    'end' => 0,
                    'duration' => 0
                );
            }else{
                $hisTask = array();
            }
        }
        return $hisTask;
    }

}
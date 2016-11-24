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
     * task
     */
    private $_task = null;




    /**
     * 初始化
     */
    public function initi($varExecution  ,  $varTargetNode , $varNum,  $execution , $task){
        $this->_executionObj = $varExecution;
        $this->_targetNode = $varTargetNode;
        $this->_num = $varNum;
        $this->_execution = $execution;
        $this->_task = $task;
        return $this;
    }

    /**
     *
     */
    public function process(){
        $currNode  =  $this->_executionObj->getCurrNode();
        $histTask = array();
        if($currNode['nodeName'] == 'start'){
            $histTask['insert'] = $this->_processInsert();
        }else{
            if($this->_executionObj->getCurrNode()['nodeName'] == 'task'){
                if($tmp = $this->_processUpdata()){
                    $histTask['updata'] = $tmp;
                }
            }
            if($tmp = $this->_processInsert()){
                $histTask['insert'] = $tmp;
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
        $hisTask['dbid']  = array(
            'where'=>$where,
            'data'=>$upData
        );
        return $hisTask;
    }

    /**
     * 插入
     */
    private function _processInsert(){
        if($this->_targetNode->getClassName() == 'fork'){
            $tmp = $this->_targetNode->getForkTargetNodeList();
            $taskList = array();
            foreach($tmp as $k => $v){
                $v['nodeName'] == 'task' && array_push($taskList , $v);
            }
        }
        if($taskList){
            foreach($this->_task['insert'] as $k => $v){
                $hisTask[$v['dbid']] = array(
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
        }elseif($this->_targetNode->getTargetNodeList()['nodeName'] == 'task'){
            $tmpTask = array();
            if($this->_executionObj->getCurrNode()['nodeName'] == 'start'){
                foreach($this->_execution['insert'] as $k => $v){
                    $tmpTask['execution_id'] = $v['id'];
                    $tmpTask['execution'] = $v['dbid'];
                    break;
                }
            }else{
                foreach($this->_task['insert'] as $k => $v){
                    $tmpTask['execution_id'] = $v['execution_id'];
                    $tmpTask['execution'] = $v['dbid'];
                    break;
                }
            }
            $hisTask[$tmpTask['execution']] = array(
                'dbid' => $tmpTask['execution'],
                'execution' => $tmpTask['execution_id'],
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
        return $hisTask;
    }

}
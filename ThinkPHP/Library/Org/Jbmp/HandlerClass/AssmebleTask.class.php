<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/20
 * Time: 20:37
 */

namespace Org\Jbmp\HandlerClass;


class AssmebleTask
{
    /**
     * 参数
     */
    private $_varsList = null;

    /**
     * executionObj对象
     */
    private $_executionObj = null;

    /**
     *  targetNode对象
     */
    private $_targetNode = null;

    /**
     * 结果
     */
    private $_execution = null;

    /**
     * 累加数
     */
    private $_num = null;

    /**
     * 初始化
     * @param $varExecutionObj object 对象execution
     * @param $varTargetNode object 对象targetNode
     * @param $varNum int 累加数
     * @param $varExecution array executin数组
     * @param $varVars array $varVars数组
     * @return array
     */
    public function initi($varExecutionObj  ,  $varTargetNode , $varNum, $varExecution ,$varVars = array()){
        $this->_executionObj = $varExecutionObj;
        $this->_targetNode = $varTargetNode;
        $this->_execution = $varExecution;
        $this->_num = $varNum;
        $varVars && $this->_varsList = $varVars;
        return $this;
    }

    /**
     * 运行
     */
    public function process(){
        $currNode  =  $this->_executionObj->getCurrNode();
        $task = array();
        if($currNode['nodeName'] == 'start'){
            $task['insert'] = $this->_processInsert();
        }else{
            if($tmp = $this->_processDel()){
                $task['del'] = $tmp;
            }
            if($tmp = $this->_processInsert()){
                $task['insert'] = $tmp;
            }
        }
        return $task;
    }

    /**
     * 删除
     */
    private function _processDel(){
        if(($this->_targetNode->getClassName() == 'join') && ($this->_targetNode->getHasFinishJoin())){
            $data = $this->_targetNode->getJoinExecution();
            if($data['inActive']){
                foreach($data['inActive'] as $k => $v){
                    $v['texecution'] && $task[$v['texecution']] = $v['texecution'];
                }
            }
            if($data['subActiveFork']){
                foreach($data['subActiveFork'] as $k => $v){
                    $v['texecution'] && $task[$v['texecution']] = $v['texecution'];
                }
            }
        }else if($this->_executionObj->getCurrNode()['nodeName'] == 'task'){
            $tmpTask = $this->_executionObj->getTask();
            $task[$tmpTask['dbid']] = $tmpTask['dbid'];
        }
        return $task;
    }

    /**
     * 插入
     * @return array
     */
    private function _processInsert(){
        if($this->_targetNode->getClassName() == 'fork'){
            $tmp = $this->_targetNode->getForkTargetNodeList();
            $taskList = array();
            foreach($tmp as $k => $v){
                $v['nodeName'] == 'task' && array_push($taskList , $v);
            }
        }
        $task = array();
        if($taskList){
            $task = $this->_processInsertTargetOfForkTask($taskList);
        }else if($this->_targetNode->getTargetNodeList()['nodeName'] == 'task'){
            $task = $this->_processInsertTargetOfTask();
        }
        return $task;
    }

    /**
     * inser fork task
     * @param $varTaskList array task数组
     * @return array
     */
    private function _processInsertTargetOfForkTask($varTaskList){
        $hasVars  =  $this->_varsList ? 1 :  0;
        foreach($varTaskList as $k => $v){
            $tmp = array();
            foreach($this->_execution['insert'] as $k1 => $v1){
                if($v['name'] == $v1['activityname']){
                    $tmp['execution_id'] = $v1['id'];
                    $tmp['execution'] = $v1['dbid'];
                    $tmp['procinst'] = $v1['instance'];
                    break;
                }
            }
            $task[$this->_num] = array(
                'dbid' => $this->_num,
                'name' => $v['name'],
                'state' => 'open',
                'assignee' => '',
                'priority' => 0,
                'create' => time(),
                'execution_id' => $tmp['execution_id'],
                'activity_name' => $v['name'],
                'hasvars' => $hasVars,
                'execution' => $tmp['execution'],
                'procinst' => $tmp['procinst']
            );
            $this->_num =$this->_executionObj->countNum($this->_num);
        }
        return $task;

    }

    /**
     * insert task
     * @return array
     */
    private function _processInsertTargetOfTask(){
        $hasVars  =  $this->_varsList ? 1 :  0;
        if(($this->_targetNode->getClassName()=='join') && $this->_targetNode->getHasFinishJoin()){
            $tmpTask = array();
            $tmpTask = $this->_targetNode->getJoinExecution()['pActive'];
            $task[$this->_num] = array(
                'dbid' => $this->_num,
                'name' => $this->_targetNode->getTargetNodeList()['name'],
                'state' => 'open',
                'assignee' => '',
                'priority' => 0,
                'create' => time(),
                'execution_id' => $tmpTask['id'],
                'activity_name' => $this->_targetNode->getTargetNodeList()['name'],
                'hasvars' => $hasVars,
                'execution' => $tmpTask['dbid'],
                'procinst' => $tmpTask['instance']
            );
        }else{
            $execution = $this->_executionObj->getExecution();//??
            $tmpTask = array();
            if($this->_executionObj->getCurrNode()['nodeName'] == 'start'){
                foreach($this->_execution['insert'] as $k => $v){
                    $tmpTask['execution_id'] = $v['id'];
                    $tmpTask['execution'] = $v['dbid'];
                    $tmpTask['procinst'] = $v['dbid'];
                    break;
                }
            }else{
                $tmpTask['execution_id'] = $execution['id'];
                $tmpTask['execution'] = $execution['dbid'];
                $tmpTask['procinst'] = $execution['instance'];
            }
            $task[$this->_num] = array(
                'dbid' => $this->_num,
                'name' => $this->_targetNode->getTargetNodeList()['name'],
                'state' => 'open',
                'assignee' => '',
                'priority' => 0,
                'create' => time(),
                'execution_id' => $tmpTask['execution_id'],
                'activity_name' => $this->_targetNode->getTargetNodeList()['name'],
                'hasvars' => $hasVars,
                'execution' => $tmpTask['execution'],
                'procinst' => $tmpTask['procinst']
            );
        }
        $this->_num =$this->_executionObj->countNum($this->_num);
        return $task;
    }

    /**
     * 得到num
     * @return int
     */
    public function getNum(){
        return $this->_num;
    }


    /**
     * 插入
     * @return array
     */
    private function _processInsertBak(){
        $hasVars  =  $this->_varsList ? 1 :  0;
        if($this->_targetNode->getClassName() == 'fork'){
            $tmp = $this->_targetNode->getForkTargetNodeList();
            $taskList = array();
            foreach($tmp as $k => $v){
                $v['nodeName'] == 'task' && array_push($taskList , $v);
            }
        }
        if($taskList){
            foreach($taskList as $k => $v){
                $tmp = array();
                foreach($this->_execution['insert'] as $k1 => $v1){
                    if($v['name'] == $v1['activityname']){
                        $tmp['execution_id'] = $v1['id'];
                        $tmp['execution'] = $v1['dbid'];
                        $tmp['procinst'] = $v1['instance'];
                        break;
                    }
                }
                $task[$this->_num] = array(
                    'dbid' => $this->_num,
                    'name' => $v['name'],
                    'state' => 'open',
                    'assignee' => '',
                    'priority' => 0,
                    'create' => time(),
                    'execution_id' => $tmp['execution_id'],
                    'activity_name' => $v['name'],
                    'hasvars' => $hasVars,
                    'execution' => $tmp['execution'],
                    'procinst' => $tmp['procinst']
                );
                $this->_num =$this->_executionObj->countNum($this->_num);
            }
        }else if($this->_targetNode->getTargetNodeList()['nodeName'] == 'task'){
            if(($this->_targetNode->getClassName()=='join') && $this->_targetNode->getHasFinishJoin()){
                $tmpTask = array();
                $tmpTask = $this->_targetNode->getJoinExecution()['pActive'];
                $task[$this->_num] = array(
                    'dbid' => $this->_num,
                    'name' => $this->_targetNode->getTargetNodeList()['name'],
                    'state' => 'open',
                    'assignee' => '',
                    'priority' => 0,
                    'create' => time(),
                    'execution_id' => $tmpTask['id'],
                    'activity_name' => $this->_targetNode->getTargetNodeList()['name'],
                    'hasvars' => $hasVars,
                    'execution' => $tmpTask['dbid'],
                    'procinst' => $tmpTask['instance']
                );
            }else{
                $execution = $this->_executionObj->getExecution();//??
                $tmpTask = array();
                if($this->_executionObj->getCurrNode()['nodeName'] == 'start'){
                    foreach($this->_execution['insert'] as $k => $v){
                        $tmpTask['execution_id'] = $v['id'];
                        $tmpTask['execution'] = $v['dbid'];
                        $tmpTask['procinst'] = $v['dbid'];
                        break;
                    }
                }else{
                    $tmpTask['execution_id'] = $execution['id'];
                    $tmpTask['execution'] = $execution['dbid'];
                    $tmpTask['procinst'] = $execution['instance'];
                }
                $task[$this->_num] = array(
                    'dbid' => $this->_num,
                    'name' => $this->_targetNode->getTargetNodeList()['name'],
                    'state' => 'open',
                    'assignee' => '',
                    'priority' => 0,
                    'create' => time(),
                    'execution_id' => $tmpTask['execution_id'],
                    'activity_name' => $this->_targetNode->getTargetNodeList()['name'],
                    'hasvars' => $hasVars,
                    'execution' => $tmpTask['execution'],
                    'procinst' => $tmpTask['procinst']
                );
            }
            $this->_num =$this->_executionObj->countNum($this->_num);
        }else{
            $task = array();
        }

        return $task;
    }


}
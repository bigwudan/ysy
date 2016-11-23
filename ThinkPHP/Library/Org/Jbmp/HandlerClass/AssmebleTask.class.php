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
     * @param $varTmpTask
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
                $taskDel['del'] = $tmp;
            }
            if($tmp = $this->_processInsert()){
                $taskDel['insert'] = $tmp;
            }
        }
        return $task;
    }

    /**
     * 删除
     */
    private function _processDel(){
        if(($this->_targetNode->getClassName()) == 'join' && ($this->_targetNode->getHasFinishJoin())){
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
        }else{
            $tmpTask = $this->_executionObj->getTask();
            $task[$tmpTask['dbid']] = $tmpTask['dbid'];
        }
        return $task;
    }


    private function _processInsert(){
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
                $this->_num = $this->_num + 1;
            }
        }else if($this->_targetNode->getTargetNodeList()['nodeName'] == 'task'){
                $execution = $this->_executionObj->getExecution();//??
                $tmpTask = array();
                if($this->_executionObj->getCurrNode()['nodeName']){
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
                $this->_num = $this->_num + 1;
        }else{
            $task = array();
        }

        return $task;
    }

    /**
     * 得到num
     */
    public function getNum(){
        return $this->_num;
    }

}
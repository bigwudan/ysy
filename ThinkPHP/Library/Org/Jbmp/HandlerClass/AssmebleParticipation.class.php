<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/20
 * Time: 21:19
 */

namespace Org\Jbmp\HandlerClass;


class AssmebleParticipation
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
        $participation = array();
        if($currNode['nodeName'] == 'start'){
            $participation['insert'] = $this->_processInsert();
        }else{

            if($tmp = $this->_processDel()){
                $participation['del'] = $tmp;
            }

            if($tmp = $this->_processInsert()){
                $participation['insert'] = $tmp;
            }
        }
        return $participation;
    }

    /**
     * 删除
     */
    public function _processDel(){
        if(method_exists($this->_executionObj , 'getParticipation')){
            $tmpParticipation = $this->_executionObj->getParticipation();
            foreach($tmpParticipation as $k => $v){
                $participation[$v['dbid']] = $v['dbid'];
            }
        }else{
            $participation = array();
        }

        return $participation;
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
            foreach($taskList as $k => $v){
                $tmp = array();
                foreach($this->_task['insert'] as $k1 => $v1){
                    if($v1['name'] == $v['name']){
                        $tmp['task'] = $v1['dbid'];
                        break;
                    }
                }
                foreach($v['candidate'] as $k2 => $v2){
                    foreach($v2 as $k3 => $v3){
                        if($k == 'groupid'){
                            $tmpUserId = 0;
                            $tmpGroupId = $v3;
                        }else{
                            $tmpUserId = $v3;
                            $tmpGroupId = 0;
                        }
                        $participation[$this->_num] = array(
                            'dbid' => $this->_num,
                            'groupid' => $tmpGroupId,
                            'userid' => $tmpUserId,
                            'type' => 'candidate',
                            'task' => $tmp['task']
                        );
                        $this->_num =$this->_executionObj->countNum($this->_num);
                    }
                }
            }
        }else{
            $candidateList = $this->_targetNode->getCandidate();
            $participation = array();
            foreach($candidateList as $k => $v){
                foreach($v as $k1 => $v1){
                    if($k == 'groupid'){
                        $tmpUserId = 0;
                        $tmpGroupId = $v1;
                    }else{
                        $tmpUserId = $v1;
                        $tmpGroupId = 0;
                    }
                    $participation[$this->_num] = array(
                        'dbid' => $this->_num,
                        'groupid' => $tmpGroupId,
                        'userid' => $tmpUserId,
                        'type' => 'candidate',
                        'task' => current($this->_task['insert'])['dbid']
                    );
                    $this->_num =$this->_executionObj->countNum($this->_num);
                }
            }
        }
        return $participation;
    }

    /**
     * 得到num
     */
    public function getNum(){
        return $this->_num;
    }

}
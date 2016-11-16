<?php
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2016/11/15
 * Time: 11:35
 */

namespace Org\Jbmp\Service;


class AssembleExecutionAndTarget {

    private $_executionObj  =  null;
    private $_targetNode = null;
    private $_num = null;
    private $_varsList = array();
    private $_insertVars = null;
    private $_execution =  null;
    private $_histProcinst = null;
    private $_histActinst = null;
    private $_variable = null;
    private $_task = null;
    private $_hisTask = null;
    private $_participation = null;
    private $_tmpTask = array();



    /**
     * @param $varExecution
     * @param $varTargetNode
     * @param $varVars
     */

    public function initi($varExecution  ,  $varTargetNode ,  $varVars = array()){
        $this->_executionObj = $varExecution;
        $this->_targetNode = $varTargetNode;
        $this->_varsList = $varVars;
        $this->_num  =  $this->_executionObj->getProperty();
        $this->_num =  $this->_num + \Org\Jbmp\Config\CommonConfig::getProperty()['totalsum'];
    }

    public function process(){
        $this->_processExecution();
        $this->_processHistProcinst();
        if($tmp = $this->_targetNode->getForkTargetNodeList()){
            $this->_tmpTask = $this->_getTaskByFork($tmp);
        }
        if($this->_targetNode->getTargetNodeList()['nodeName'] == 'task' || $this->_tmpTask  ){
            $this->_processTask();
            $this->_processHisTask();
            $this->_processParticipation();
        }
        $this->_processHistActinst();
        if($this->_varsList){
            $this->_processVarsList();
        }
        die(__CLASS__);
    }

    /**
     * 从fork得到task
     */
    private function _getTaskByFork($varData){
        $taskList = array();
        foreach($varData as $k => $v){
            $v['nodeName'] == 'task' && array_push($taskList , $v);
        }
        return $taskList;
    }

    /**
     * 静态公共方法组合数组
     * @param array $varVarsList 组合insert临时参数
     * @param int $varTaskId 组合insert临时参数
     * @return array
     */
    private function _constructVarsList($varVarsList){
        $modelList = array(
            'execution_id'=>0,
            'class'=>'',
            'task_id' => 0,
            'key' => '',
            'string_value' => '',
            'int_value' => 0,
            'double_value' => 0
        );
        $insertVarsList = array();
        foreach($varVarsList as $k => $v){
            $tmp = $modelList;
            $tmp['execution_id'] = $v['execution_id'];
            $tmp['task_id'] = 0;
            $tmp['key'] = $v['key'];
            $tmp[$v['type']."_value"] = $v['value'];
            $tmp['class'] = str_replace('_value','',$v['type']);
            $insertVarsList[] = $tmp;
        }
        $this->_insertVars = $insertVarsList ;

        return $insertVarsList;
    }


    private function _processHisTask(){
        if($this->_tmpTask){
            foreach($this->_task['insert'] as $k => $v){
                $hisTask['insert'][] = array(
                    'dbid' => $v['dbid'],
                    'execution' => $v['execution_id'],
                    'outcome' => '',
                    'assignee' => '',
                    'priority' => 0,
                    'state' => '',
                    'create' => time(),
                    'end' => 0,
                    'duration' => 0
                );
            }
        }else{
            $hisTask['insert'][] = array(
                'dbid' => $this->_task['insert'][0]['dbid'],
                'execution' => $this->_execution['insert'][0]['id'],
                'outcome' => '',
                'assignee' => '',
                'priority' => 0,
                'state' => '',
                'create' => time(),
                'end' => 0,
                'duration' => 0
            );
        }
        $this->_hisTask = $hisTask;
    }

    private function _processParticipation(){
        if($this->_tmpTask){
            foreach($this->_tmpTask as $k => $v){
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

                        $participation['insert'][] = array(
                            'dbid' => $this->_num,
                            'groupid' => $tmpGroupId,
                            'userid' => $tmpUserId,
                            'type' => 'candidate',
                            'task' => $tmp['task']
                        );
                        $this->_num = $this->_num + 1;
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
                    $participation['insert'][] = array(
                        'dbid' => $this->_num,
                        'groupid' => $tmpGroupId,
                        'userid' => $tmpUserId,
                        'type' => 'candidate',
                        'task' => $this->_task['insert'][0]['dbid']
                    );
                    $this->_num = $this->_num + 1;
                }
            }
        }

        $this->_participation = $participation;
    }

    private function _processVarsList(){
        $tmpDbid = $this->_execution['insert'][0]['dbid'] ? $this->_execution['insert'][0]['dbid'] : $this->_execution['insert']['forkmain']['dbid'];
        for($num = 0 ; $num < 2 ; $num++){
            $this->_variable['insert'][] = array(
                'dbid' => $this->_num,
                'class' => 'string',
                'key' => 'username',
                'execution' => $tmpDbid,
                'string_value' => 'wudan'.$num
            );
            $this->_num = $this->_num +1;
        }
    }

    private function _processExecution(){
        $hasVars  =  $this->_varsList ? 1 :  0;
        $currNode  =  $this->_executionObj->getCurrNode();;
        if($currNode['nodeName'] == 'start'){
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
        }else{
        }
        $this->_execution  = $execution;
    }

    private function _processTask(){
        $hasVars  =  $this->_varsList ? 1 :  0;
        if($this->_tmpTask){
            foreach($this->_tmpTask as $k => $v){
                $tmp = array();
                foreach($this->_execution['insert']['fork'] as $k1 => $v1){
                    if($v['name'] == $v1['activityname']){
                        $tmp['execution_id'] = $v1['id'];
                        $tmp['execution'] = $v1['dbid'];
                        $tmp['procinst'] = $v1['instance'];
                        break;
                    }
                }

                $task['insert'][] = array(
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
        }else{
            $task['insert'][] = array(
                'dbid' => $this->_num,
                'name' => $this->_targetNode->getTargetNodeList()['name'],
                'state' => 'open',
                'assignee' => '',
                'priority' => 0,
                'create' => time(),
                'execution_id' => $this->_execution['insert'][0]['id'],
                'activity_name' => $this->_targetNode->getTargetNodeList()['name'],
                'hasvars' => $hasVars,
                'execution' => $this->_execution['insert'][0]['dbid'],
                'procinst' => $this->_execution['insert'][0]['dbid']
            );
            $this->_num = $this->_num + 1;
        }
        $this->_task = $task;
    }


    private function _processHistActinst(){
        if($this->_execution['insert']){
            if($this->_execution['insert']['forkmain']){
                foreach($this->_execution['insert']['fork'] as $k => $v){
                    $tmpTargetNode = $this->_targetNode->getForkTargetNodeList()[$k];
                    $histActinst['insert'][] = array(
                        'dbid' => $this->_num,
                        'hprocid' => $this->_execution['insert']['forkmain']['instance'],
                        'type' => $tmpTargetNode['nodeName'],
                        'execution' => $v['dbid'],
                        'activity_name' => $tmpTargetNode['name'],
                        'start' => time(),
                        'end'  => 0,
                        'duration' => 0,
                        'transition' => "",
                        'htask' => 0

                    );
                    $this->_execution['insert']['fork'][$k]['hisactinst'] = $this->_num;
                    $this->_num = $this->_num + 1;
                }
            }else{
                if($decision = $this->_targetNode->getDecision()){
                    $histActinst['insert'][] = array(
                        'dbid' => $this->_num,
                        'hprocid' => $this->_execution['insert'][0]['instance'],
                        'type' => $decision['nodeName'],
                        'execution' => $this->_execution['insert'][0]['dbid'],
                        'activity_name' => $decision['name'],
                        'start' => time(),
                        'end'  => time(),
                        'duration' => 0,
                        'transition' => "to {$this->_targetNode->getTargetNodeList()['name']}",
                        'htask' => 0

                    );
                    $this->_num = $this->_num + 1;
                }
                $histActinst['insert'][] = array(
                    'dbid' => $this->_num,
                    'hprocid' => $this->_execution['insert'][0]['instance'],
                    'type' => $this->_targetNode->getTargetNodeList()['nodeName'],
                    'execution' => $this->_execution['insert'][0]['dbid'],
                    'activity_name' => $this->_targetNode->getTargetNodeList()['name'],
                    'start' => time(),
                    'end'  => 0,
                    'duration' => 0,
                    'transition' => '',
                    'htask' => 0

                );
                $this->_execution['insert'][0]['hisactinst'] = $this->_num;
                $this->_num = $this->_num + 1;
            }
        }
        $this->_histActinst = $histActinst;
    }

    private function _processHistProcinst(){
        if($this->_execution['insert']){
            if($this->_execution['insert']['forkmain']){
                $histProcinst['insert'][] = array(
                    'dbid' => $this->_execution['insert']['forkmain']['dbid'],
                    'id' => $this->_execution['insert']['forkmain']['id'],
                    'procdefid' => $this->_executionObj->getRule()['rulename'],
                    'key' => '',
                    'start' => time(),
                    'end' => 0,
                    'duration' =>0,
                    'state' => 'active',
                    'endactivity' => ''
                );
            }else{
                $histProcinst['insert'][] = array(
                    'dbid' => $this->_execution['insert'][0]['dbid'],
                    'id' => $this->_execution['insert'][0]['id'],
                    'procdefid' => $this->_executionObj->getRule()['rulename'],
                    'key' => '',
                    'start' => time(),
                    'end' => 0,
                    'duration' =>0,
                    'state' => 'active',
                    'endactivity' => ''

                );
            }
        }
        $this->_histProcinst = $histProcinst;
    }

}
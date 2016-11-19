<?php
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2016/11/15
 * Time: 11:35
 */

namespace Org\Jbmp\Service;


class AssembleExecutionAndTarget {

    private $_translateInfoObj = null;
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


    /**
     *
     */
    public function getProcessTranslateInfo(){
        $TranslateInfoObj = new \Org\Jbmp\Translate\TranslateInfoClass();
        $this->_execution && $TranslateInfoObj->setExecution($this->_execution);
        $this->_histProcinst && $TranslateInfoObj->setHistprocinst($this->_histProcinst);
        $this->_task && $TranslateInfoObj->setTask($this->_task);
        $this->_hisTask && $TranslateInfoObj->setHisttask($this->_hisTask);
        $this->_participation && $TranslateInfoObj->setParticipation($this->_participation);
        $this->_histActinst && $TranslateInfoObj->setHistactinst($this->_histActinst);
        $this->_variable && $TranslateInfoObj->setVariable($this->_variable);

        $this->_translateInfoObj = $TranslateInfoObj;
        //var_dump($this->_execution);
        //var_dump($this->_histProcinst);
        //var_dump($this->_task);
        //var_dump($this->_participation);
        //var_dump($this->_histActinst);
        //var_dump($this->_variable);
        return $TranslateInfoObj;
    }

    public function process(){
        $this->_processExecution();
        $this->_processHistProcinst();
        if(method_exists($this->_targetNode , 'getForkTargetNodeList')){
            $tmp = $this->_targetNode->getForkTargetNodeList();
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
        return $this->getProcessTranslateInfo();
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
        $obj = new \Org\Jbmp\HandlerClass\AssmebleExecution();
        $this->_execution = $obj->initi($this->_executionObj , $this->_targetNode , $this->_num ,  $this->_varsList)->process();
        $this->_num = $obj->getNum();

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
        $obj = new \Org\Jbmp\HandlerClass\AssmebleHistActinst();
        $this->_histProcinst = $obj->initi($this->_executionObj , $this->_targetNode , $this->_num ,  $this->_execution , $this->_task)->process();
        $this->_num = $obj->getNum();
        die('xxxx');

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
        if($this->_task['insert']){
            foreach($histActinst['insert'] as $k => $v){
                foreach($this->_task['insert'] as $k1 => $v1){
                    if($v1['activity_name'] == $v['activity_name']){
                        $histActinst['insert'][$k]['htask'] = $v1['dbid'];
                        break;
                    }
                }
            }
        }
        $this->_histActinst = $histActinst;
    }

    private function _processHistProcinst(){
        $obj = new \Org\Jbmp\HandlerClass\AssmebleHistProcinst();
        $this->_histProcinst = $obj->initi($this->_executionObj , $this->_targetNode , $this->_num ,  $this->_execution)->process();
        $this->_num = $obj->getNum();
   }

}
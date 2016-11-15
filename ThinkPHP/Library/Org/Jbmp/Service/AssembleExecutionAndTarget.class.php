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

    private $_dbid = array(



    );

    private $_insertVars = null;

    private $_execution =  null;

    private $_histProcinst = null;

    private $_histActinst = null;



    /**
     * @param $varExecution
     * @param $varTargetNode
     * @param $varVars
     */

    public function initi($varExecution  ,  $varTargetNode ,  $varVars = array()){
        $this->_executionObj = $varExecution;
        $this->_targetNode = $varTargetNode;
        $this->_num  =  $this->_executionObj->getProperty();
        $this->_num =  $this->_num + \Org\Jbmp\Config\CommonConfig::getProperty()['totalsum'];
    }

    public function process(){
        $this->_processExecution();
        $this->_processHistProcinst();
        $this->_processTask();
        $this->_processHisTask();
        $this->_processHistActinst();
        $this->_processParticipation();
        $this->_processVarsList();
        die('xxx');
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

    }

    private function _processParticipation(){


    }

    private function _processVarsList(){



    }

    private function _processExecution(){
        $hasVars  =  $this->_insertVars ? 1 :  0;
        $currNode  =  $this->_executionObj->getCurrNode();;
        if($currNode['nodeName'] == 'start'){
            $execution['insert'][] =  array(
                'dbid' => $this->_num,
                'activityname'  => $this->_targetNode->getTargetNodeList()['name'],
                'procdefid' => $this->_executionObj->getRule()['rulename'],
                'hasvars' => $hasVars,
                'key' => '',
                'id' => "{$this->_executionObj->getRule()['rulename']}.{$this->_num}",
                'state' => 'active-root',
                'priority' => 0,
                'hisactinst' => $this->_num+1,
                'parent' => 0,
                'parentidx' => 0,
                'instance' => $this->_num
            );
            $this->_num =$this->_num + 2;

        }else{
        }
        $this->_execution  = $execution;
    }

    private function _processTask(){

    }


    private function _processHistActinst(){

        if($this->_execution['insert']){
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


        }
        $this->_histActinst = $histActinst;
    }

    private function _processHistProcinst(){

        if($this->_execution['insert']){
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

        $this->_histProcinst = $histProcinst;

    }

}
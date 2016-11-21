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
        $obj = new \Org\Jbmp\HandlerClass\AssmebleHisTask();
        $this->_hisTask = $obj->initi($this->_executionObj , $this->_targetNode , $this->_num ,  $this->_execution , $this->_task , $this->_tmpTask)->process();
    }

    private function _processParticipation(){
        $obj = new \Org\Jbmp\HandlerClass\AssmebleParticipation();
        $this->_participation = $obj->initi($this->_executionObj , $this->_targetNode , $this->_num ,  $this->_execution , $this->_task , $this->_tmpTask)->process();
        $this->_num = $obj->getNum();
    }

    private function _processVarsList(){
        $obj = new \Org\Jbmp\HandlerClass\AssmebleVariable();
        $obj->initi($this->_executionObj , $this->_targetNode , $this->_num ,  $varVars = array() , $this->_execution);
        $this->_variable = $obj->process();
        $this->_num = $obj->getNum();

        var_dump($this->_variable);
        die();

    }

    private function _processExecution(){
        $obj = new \Org\Jbmp\HandlerClass\AssmebleExecution();
        $this->_execution = $obj->initi($this->_executionObj , $this->_targetNode , $this->_num ,  $this->_varsList)->process();
        $this->_num = $obj->getNum();
    }

    private function _processTask(){
        $obj = new \Org\Jbmp\HandlerClass\AssmebleTask();
        $this->_task = $obj->initi($this->_executionObj , $this->_targetNode , $this->_num ,  $this->_execution , $this->_varsList , $this->_tmpTask)
            ->process();
        $this->_num = $obj->getNum();
    }


    private function _processHistActinst(){
        $obj = new \Org\Jbmp\HandlerClass\AssmebleHistActinst();
        $this->_histActinst = $obj->initi($this->_executionObj , $this->_targetNode , $this->_num ,  $this->_execution , $this->_task)->process();
        $this->_execution = $obj->getExecution();
        $this->_task = $obj->getTask();
        $this->_num = $obj->getNum();
    }

    private function _processHistProcinst(){
        $obj = new \Org\Jbmp\HandlerClass\AssmebleHistProcinst();
        $this->_histProcinst = $obj->initi($this->_executionObj , $this->_targetNode , $this->_num ,  $this->_execution)->process();
        $this->_num = $obj->getNum();
   }

}
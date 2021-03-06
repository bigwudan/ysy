<?php
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2016/11/15
 * Time: 11:35
 */

namespace Org\Jbmp\Service;


class AssembleExecutionAndTarget {
    /**
     * data
     */
    private $_translateInfoObj = null;

    /**
     * data
     */
    private $_executionObj  =  null;

    /**
     * data
     */
    private $_targetNode = null;

    /**
     * data
     */
    private $_num = null;

    /**
     * data
     */
    private $_varsList = array();

    /**
     * data
     */
    private $_execution =  null;

    /**
     * data
     */
    private $_histProcinst = null;

    /**
     * data
     */
    private $_histActinst = null;

    /**
     * data
     */
    private $_variable = null;

    /**
     * data
     */
    private $_task = null;

    /**
     * data
     */
    private $_hisTask = null;

    /**
     * data
     */
    private $_participation = null;

    /**
     * data
     */
    private $_tmpTask = array();

    /**
     * @param $varExecution
     * @param $varTargetNode
     * @param $varVars
     * @return array
     */
    public function initi($varExecution  ,  $varTargetNode ,  $varVars = array()){
        $this->_executionObj = $varExecution;
        $this->_targetNode = $varTargetNode;
        $this->_varsList = $varVars;
        $this->_num  =  $this->_executionObj->getProperty();
        $this->_num =  $this->_num + \Org\Jbmp\Config\CommonConfig::getProperty()['totalsum'];
    }

    /**
     * 得到translateinfo
     * @return array
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
        $TranslateInfoObj->setVersionNum($this->_executionObj->getVersionNum());
        $this->_translateInfoObj = $TranslateInfoObj;
        //var_dump($this->_execution);die('222');
        //var_dump($this->_histProcinst);die('3333');
        //var_dump($this->_task);die('111');
        //var_dump($this->_hisTask);die('4444');
        //var_dump($this->_participation);die('555');
        //var_dump($this->_histActinst);die('666');
        //var_dump($this->_variable);die('777');
        //die('xxxx');
        return $TranslateInfoObj;
    }

    /**
     * 执行
     * @return array
     */
    public function process(){
        $this->_processExecution();
        $this->_processHistProcinst();
        $taskList = array();
        if($this->_targetNode->getClassName() == 'fork'){
            $tmp = $this->_targetNode->getForkTargetNodeList();
            foreach($tmp as $k => $v){
                $v['nodeName'] == 'task' && array_push($taskList , $v);
            }
        }
        if( $this->_executionObj->getCurrNode()['nodeName'] == 'task'|| $this->_targetNode->getTargetNodeList()['nodeName'] == 'task' || $taskList  ){
            $this->_processTask();
            $this->_processHisTask();
            $this->_processParticipation();
        }
        $this->_processHistActinst();
        if($this->_varsList || $this->_targetNode->getTargetNodeList()['nodeName'] == 'end'){
            $this->_processVarsList();
        }
        return $this->getProcessTranslateInfo();
    }


    /**
     * 执行
     */
    private function _processHisTask(){
        $obj = new \Org\Jbmp\HandlerClass\AssmebleHisTask();
        $this->_hisTask = $obj->initi($this->_executionObj , $this->_targetNode , $this->_num ,  $this->_execution , $this->_task)->process();
    }
    /**
     * 执行
     */
    private function _processParticipation(){
        $obj = new \Org\Jbmp\HandlerClass\AssmebleParticipation();
        $this->_participation = $obj->initi($this->_executionObj , $this->_targetNode , $this->_num ,  $this->_execution , $this->_task)->process();
        $this->_num = $obj->getNum();
    }

    /**
     * 执行
     */
    private function _processVarsList(){
        $obj = new \Org\Jbmp\HandlerClass\AssmebleVariable();
        $obj->initi($this->_executionObj , $this->_targetNode , $this->_num ,  $this->_varsList , $this->_execution);
        $this->_variable = $obj->process();
        $this->_num = $obj->getNum();
    }

    /**
     * 执行
     */
    private function _processExecution(){
        $obj = new \Org\Jbmp\HandlerClass\AssmebleExecution();
        $this->_execution = $obj->initi($this->_executionObj , $this->_targetNode , $this->_num ,  $this->_varsList)->process();
        $this->_num = $obj->getNum();
    }

    /**
     * 执行
     */
    private function _processTask(){
        $obj = new \Org\Jbmp\HandlerClass\AssmebleTask();
        $this->_task = $obj->initi($this->_executionObj , $this->_targetNode , $this->_num ,  $this->_execution , $this->_varsList)
            ->process();

        $this->_num = $obj->getNum();
    }

    /**
     * 执行
     */
    private function _processHistActinst(){
        $obj = new \Org\Jbmp\HandlerClass\AssmebleHistActinst();
        $this->_histActinst = $obj->initi($this->_executionObj , $this->_targetNode , $this->_num ,  $this->_execution , $this->_task)->process();
        $this->_execution = $obj->getExecution();
        $this->_task = $obj->getTask();
        $this->_num = $obj->getNum();
    }

    /**
     * 执行
     */
    private function _processHistProcinst(){
        $obj = new \Org\Jbmp\HandlerClass\AssmebleHistProcinst();
        $this->_histProcinst = $obj->initi($this->_executionObj , $this->_targetNode , $this->_num ,  $this->_execution)->process();
        $this->_num = $obj->getNum();
   }

}
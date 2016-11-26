<?php
namespace Org\Jbmp\Service;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/13
 * Time: 9:07
 */
class ExecutionService
{

    /**
     * execution id号
     */
    private $_execution = null;

    /**
     * translate 跳转的对象 string
     */
    private $_translate = null;

    /**
     * variable 参数
     */
    private $_variable = null;

    /**
     * executionClass 处理的对象
     */
    private $_executionClass = null;


    /**
     * 启动模板
     * @param $varModelName string 模板名称
     * @param $varVars array 参数
     */
    public function startProcessInstanceById($varModelName , $varVars = null){
        $obj = new \Org\Jbmp\ProcessDataBase\SelectDataFromDb();
        $rule = $obj->getRuleByModuleName($varModelName);
        $property = $obj->getProperty();
        $StartObj = new \Org\Jbmp\ExecutionClass\StartExecutionClass();
        $StartObj->setRule($rule);
        $StartObj->setProperty($property['value']);
        $XmlObj = new \Org\Jbmp\ProcessFunction\XmlEngine();
        $obj = $XmlObj->getDbToXmlObj($rule['rule']);
        $StartObj->setXmlObj($obj);
        $this->_executionClass = $StartObj;
        $this->_variable = $varVars;
        $TranObj = $this->_onTranslate();
        $obj = new \Org\Jbmp\ProcessDataBase\WriteToDataBase();
        $obj->initi($TranObj);
        $obj->writeToDataBase();
        die('wudan');

    }

    /**
     * 普通方法
     */
    public function completeCommon($varExecution , $varTranslate = null , $varVariable = null){
        $this->_execution = $varExecution;
        $this->_translate = $varTranslate;
        $this->_variable = $varVariable;
        $this->_executionClass = new \Org\Jbmp\ExecutionClass\StateExecutionClass();
        $this->_getDataFromDataBaseByExecution();
        $TranObj = $this->_onTranslate();
        $obj = new \Org\Jbmp\ProcessDataBase\WriteToDataBase();
        $obj->initi($TranObj);
        $obj->writeToDataBase();
        die('wudan');

    }

    /**
     * 得到task
     * @param $varExecution int
     * @param $varTranslate string
     */
    public function completeTask($varExecution , $varTranslate = null , $varVariable = null){
        $this->_execution = $varExecution;
        $this->_translate = $varTranslate;
        $this->_variable = $varVariable;
        $this->_executionClass = new \Org\Jbmp\ExecutionClass\TaskExecutionClass();
        $this->_getDataFromDataBaseByExecution();
        $TranObj = $this->_onTranslate();
        $obj = new \Org\Jbmp\ProcessDataBase\WriteToDataBase();
        $obj->initi($TranObj);
        $obj->writeToDataBase();
        die('wwww');
    }

    /**
     * 从数据库得到数据
     */
    private function _getDataFromDataBaseByExecution(){
        $ExecutionObj = $this->_executionClass;
        $obj = new \Org\Jbmp\ProcessDataBase\SelectDataFromDb();
        $data = $obj->getDataFromDataBaseByExecution($this->_execution);
        $property = $obj->getProperty();
        $execution = array(
            'dbid' => $data['edbid'],
            'activityname' => $data['eactivityname'],
            'procdefid' => $data['eprocdefid'],
            'hasvars' => $data['ehasvars'],
            'key' => $data['ekey'],
            'id' => $data['eid'],
            'state' => $data['estate'],
            'priority' => $data['epriority'],
            'hisactinst' => $data['ehisactinst'],
            'parent' => $data['eparent'],
            'parentidx' => $data['eparentidx'],
            'instance' => $data['einstance'],
        );
        $histActinst = array(
            'dbid' => $data['hadbid'],
            'hprocid' => $data['hahprocid'],
            'type' => $data['hatype'],
            'execution' => $data['haexecution'],
            'activity_name' => $data['haactivity_name'],
            'start' => $data['hastart'],
            'end' => $data['haend'],
            'duration' => $data['haduration'],
            'transition' => $data['hatransition'],
            'htask' => $data['hahtask'],
        );


        $histProcinst = array(
            'dbid' => $data['hpdbid'],
            'id' => $data['hpid'],
            'procdefid' => $data['hpprocdefid'],
            'key' => $data['hpkey'],
            'start' => $data['hpstart'],
            'end' => $data['hpend'],
            'duration' => $data['hpduration'],
            'state' => $data['hpstate'],
            'endactivity' => $data['hpendactivity']
        );

        $histTask = array(
            'dbid' => $data['htdbid'],
            'execution' => $data['htexecution'],
            'outcome' => $data['htoutcome'],
            'assignee' => $data['htassignee'],
            'priority' => $data['htpriority'],
            'state' => $data['htstate'],
            'create' => $data['htcreate'],
            'end' => $data['htend'],
            'duration' => $data['htduration'],
        );
        $rule = array(
            'moduleid' => $data['mrmoduleid'],
            'rule' => $data['mrrule'],
            'rulename' => $data['mrrulename'],
            'addtime' => $data['mraddtime'],
            'creater' => $data['mrcreater']
        );
        $task = array(
            'dbid' => $data['tdbid'] ,
            'name' => $data['tname'],
            'state' => $data['tstate'],
            'assignee' => $data['tassignee'],
            'priority' => $data['tpriority'],
            'create' => $data['tcreate'],
            'execution_id' => $data['texecution_id'],
            'activity_name' => $data['tactivity_name'],
            'hasvars' => $data['thasvars'],
            'execution' => $data['texecution'],
            'procinst' => $data['tprocinst']
        );
        $ExecutionObj->setProperty($property['value']);
        $ExecutionObj->setExecution($execution);
        $ExecutionObj->setHistActinst($histActinst);
        $ExecutionObj->setHistProcinst($histProcinst);
        $ExecutionObj->setRule($rule);
        if($task['dbid']){
            $ExecutionObj->setHistTask($histTask);
            $ExecutionObj->setTask($task);
            $taskData = $obj->getParticipationFromDataBaseByTask($task['dbid']);
            $ExecutionObj->setParticipation($taskData);
        }
        if($execution['hasvars']){
            $variable = $obj->getVariableFromDataBaseByTask($execution['dbid']);
            $ExecutionObj->setVariable($this->_assembleVariable($variable));
        }
        $XmlObj = new \Org\Jbmp\ProcessFunction\XmlEngine();
        $obj = $XmlObj->getDbToXmlObj($rule['rule']);
        $ExecutionObj->setXmlObj($obj);
        $this->_executionClass = $ExecutionObj;
    }

    /**
     * 组合参数
     * @param $varVariable array 数组
     * @return array
     */
    private function _assembleVariable($varVariable){
        $newVarList = array();
        foreach($varVariable as $k => $v){
            $newVarList[] = array(
                'dbid' => $v['dbid'],
                'key' => $v['key'],
                'value' => $v["{$v['class']}_value"]
            );
        }
        return $newVarList;
    }


    /**
     * 启动转换
     */
    private function _onTranslate(){
        $TranslateObj = new \Org\Jbmp\Translate\TranslateFactory();
        $TranslateObj->initi($this->_executionClass , $this->_translate);
        $obj =  $TranslateObj->translate();
        $vars = $this->_variable;
        if($obj->getClassName() == 'decision'){
            if($obj->getVariableExecution()){
                $vars = $this->_variable ? array_merge($this->_variable , $obj->getVariableExecution()) : $obj->getVariableExecution();
            }
        }
        $AssembleObj = new \Org\Jbmp\Service\AssembleExecutionAndTarget();
        $AssembleObj->initi($this->_executionClass , $obj , $vars);
        $Translateobj = $AssembleObj->process();
        return $Translateobj;

    }



}
<?php
namespace Vendor\Jbpm\Service;
/**
 * wudan 吴丹 创建于 2016-11-29 17:38:30
ExecutionService
 */
class ExecutionService{
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
     * @return array
     */

    public function startProcessInstanceById($varModelName , $varVars = null){
        $this->_variable = $varVars;
        $obj = new \Vendor\Jbpm\Processdatabase\SelectData();
        $rule = $obj->getRuleByModuleName($varModelName);
        if(!$rule['rule']){
            return array('error' => 1 , 'msg' => 'sql worry');
        }
        $property = $obj->getProperty();
        $StartObj = new \Vendor\Jbpm\Executionclass\StartExecutionClass();
        $StartObj->setRule($rule);
        $StartObj->setProperty($property['value']);
        $XmlObj = new \Vendor\Jbpm\Processdatabase\XmlEngine();
        $obj = $XmlObj->getDbToXmlObj($rule['rule']);
        if(!$obj){
            return array('error' => 1 , 'msg' => 'load xml worry');
        }
        $flag = $StartObj->setXmlObj($obj);
        if(!$flag){
            return array('error' =>1 , 'msg' => 'currnode worry');
        }
        $this->_executionClass = $StartObj;
        $TranObj = $this->_onTranslate();
        if(!$TranObj){
            return array('error' =>1 , 'msg' => 'translate worry');
        }
        $obj = new \Vendor\Jbpm\Processdatabase\WriteToDataBase();
        $obj->initi($TranObj);
        return $obj->writeToDataBase();
    }



    /**
     * 普通方法
     * @param $varExecution int 数据
     * @param $varTranslate string 转换数据
     * @param $varVariable array 参数
     * @return array
     */

    public function completeCommon($varExecution , $varTranslate = null , $varVariable = null){
        $this->_execution = $varExecution;
        $this->_translate = $varTranslate;
        $this->_variable = $varVariable;
        $this->_executionClass = new \Vendor\Jbpm\Executionclass\StateExecutionClass();
        $this->_getDataFromDataBaseByExecution();
        $TranObj = $this->_onTranslate();
        $obj = new \Vendor\Jbpm\Processdatabase\WriteToDataBase();
        $obj->initi($TranObj);
        return $obj->writeToDataBase();
    }



    /**
     * 得到task
     * @param $varExecution int 数据
     * @param $varTranslate string 转换数据
     * @param $varVariable array 参数
     * @return array
     */

    public function completeTask($varExecution , $varTranslate = null , $varVariable = null){
        $this->_execution = $varExecution;
        $this->_translate = $varTranslate;
        $this->_variable = $varVariable;
        $this->_executionClass = new \Vendor\Jbpm\Executionclass\TaskExecutionClass();
        $this->_getDataFromDataBaseByExecution();
        $TranObj = $this->_onTranslate();
        $obj = new \Vendor\Jbpm\Processdatabase\WriteToDataBase();
        $obj->initi($TranObj);
        return $obj->writeToDataBase();
    }



    /**
     * 从数据库得到数据
     */

    private function _getDataFromDataBaseByExecution(){
        $ExecutionObj = $this->_executionClass;
        $obj = new \Vendor\Jbpm\Processdatabase\SelectData();
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
            $ExecutionObj->setDbVars($this->_assembleVariable($variable));
        }
        $XmlObj = new \Vendor\Jbpm\Processfunction\XmlEngine();
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
     * @return object
     */

    private function _onTranslate(){
        if($this->_variable){
            $this->_executionClass->setIntroduceVars($this->_variable);
        }
        $TranslateObj = new \Vendor\Jbpm\Translate\TranslateFactory();
        $TranslateObj->initi($this->_executionClass , $this->_translate);
        $obj =  $TranslateObj->translate();
        if(!$obj) return false;
        $AssembleObj = new \Vendor\Jbpm\Service\AssembleExecutionAndTarget();
        $AssembleObj->initi($this->_executionClass , $obj);
        $Translateobj = $AssembleObj->process();
        return $Translateobj;
    }
}
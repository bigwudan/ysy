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
     * @param $varVars array 输入传入参数
     */
    public function startProcessInstanceById($varModelName , $varVars = null){
        $this->_variable = $varVars;
        $obj = new \Org\Jbmp\ProcessDataBase\SelectDataFromDb();
        $rule = $obj->getRuleByModuleName($varModelName);
        if(!$rule) return array('error'=>1 , 'errormsg'=>'read-rule-error');
        $property = $obj->getProperty();
        if(!$property) return array('error'=>1 , 'errormsg'=>'read-property-error');
        $StartObj = new \Org\Jbmp\ExecutionClass\StartExecutionClass();
        $StartObj->setRule($rule);
        $StartObj->setProperty($property['value']);
        $XmlObj = new \Org\Jbmp\ProcessFunction\XmlEngine();
        $obj = $XmlObj->getDbToXmlObj($rule['rule']);
        if(!$obj) return array('error'=>1 , 'errormsg'=>'getDbToXmlObj(-error');
        $res =  $StartObj->setXmlObj($obj);
        if($res['error'] == 1){
            return $res;
        }
        $this->_executionClass = $StartObj;
        $TranObj = $this->_onTranslate();
        if($TranObj['error'] == 1){
            return $TranObj;
        }
        $obj = new \Org\Jbmp\ProcessDataBase\WriteToDataBase();
        $obj->initi($TranObj);
        $obj->writeToDataBase();
        die('wudan');

    }

    /**
     * 普通方法
     * @param $varExecution int 数据
     * @param $varTranslate string 转换数据
     * @param $varVariable array 参数
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
     * @param $varExecution int 数据
     * @param $varTranslate string 转换数据
     * @param $varVariable array 参数
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
     * @return object
     */
    private function _onTranslate(){
        $this->_executionClass->setVariable($this->_processVariable());
        $TranslateObj = new \Org\Jbmp\Translate\TranslateFactory();
        $TranslateObj->initi($this->_executionClass , $this->_translate);
        $obj =  $TranslateObj->translate();
        if($obj['error'] == 1){
            return $obj;
        }
        $AssembleObj = new \Org\Jbmp\Service\AssembleExecutionAndTarget();
        $AssembleObj->initi($this->_executionClass , $obj , $this->_variable);
        $Translateobj = $AssembleObj->process();
        return $Translateobj;
    }

    /**
     * 加入varabile
     */
    private function _processVariable(){
        $tmp = null;
        $this->_executionClass->getVariable() && $tmp = $this->_executionClass->getVariable();
        $this->_variable && $this->_toRepeatVariable($this->_variable , $tmp);
        return $tmp;
    }



    /**
     * 组合variable
     * @param $varVariable array 参数
     * @param $varExecutionObj object 对象
     * @return array
     */
    private function _toRepeatVariable($varVariable , $varVarDb = null){
        $newList = array();
        if($varVarDb){
            foreach($varVariable as $k => $v){
                $flag = 0;
                foreach($varVarDb as $k1 => $v1){
                    if($v['key'] == $v1['key']){
                        $flag = 1;
                        break;
                    }
                }
                $flag == 0 && array_push($newList , $v);
            }
            $variable = array_merge($varVariable , $newList);
        }else{
            $variable = $varVariable;
        }
        return $variable;
    }


}
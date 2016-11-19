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
        $FranslateObj = new \Org\Jbmp\Translate\TranslateFactory();
        $FranslateObj->initi($StartObj);
        $obj =  $FranslateObj->translate();
        $AssembleObj = new \Org\Jbmp\Service\AssembleExecutionAndTarget();
        $AssembleObj->initi($StartObj , $obj , $varVars);
        $Translateobj = $AssembleObj->process();

        $obj = new \Org\Jbmp\ProcessDataBase\WriteToDataBase();
        $obj->initi($Translateobj);

        $obj->writeToDataBase();

        die();

    }

    /**
     * 得到task
     * @param $varExecution int
     * @param $varTranslate string
     */
    public function completeTask($varExecution , $varTranslate = null , $varVariable = null){
        $TaskExecutionObj = new \Org\Jbmp\ExecutionClass\TaskExecutionClass();
        $obj = new \Org\Jbmp\ProcessDataBase\SelectDataFromDb();
        $data = $obj->getDataFromDataBaseByExecution($varExecution);
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
            'dbid' => $data['hpdbid'],
            'hprocid' => $data['hprocid'],
            'type' => $data['hptype'],
            'execution' => $data['hpexecution'],
            'activity_name' => $data['hpactivity_name'],
            'start' => $data['hpstart'],
            'end' => $data['hpend'],
            'duration' => $data['hpduration'],
            'transition' => $data['hptransition'],
            'htask' => $data['hphtask'],
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
        $TaskExecutionObj->setExecution($execution);
        $TaskExecutionObj->setHistActinst($histActinst);
        $TaskExecutionObj->setHistProcinst($histProcinst);
        $TaskExecutionObj->setHistTask($histTask);
        $TaskExecutionObj->setRule($rule);
        $TaskExecutionObj->setTask($task);
        $data = $obj->getParticipationFromDataBaseByTask($task['dbid']);
        $TaskExecutionObj->setParticipation($data);
        if($execution['hasvars']){
            $variable = $obj->getVariableFromDataBaseByTask($execution['dbid']);
            $TaskExecutionObj->setVariable($variable);
        }
        $XmlObj = new \Org\Jbmp\ProcessFunction\XmlEngine();
        $obj = $XmlObj->getDbToXmlObj($rule['rule']);
        $TaskExecutionObj->setXmlObj($obj);
        $FranslateObj = new \Org\Jbmp\Translate\TranslateFactory();
        $FranslateObj->initi($TaskExecutionObj , $varTranslate);
        $obj =  $FranslateObj->translate();
        $AssembleObj = new \Org\Jbmp\Service\AssembleExecutionAndTarget();
        $AssembleObj->initi($FranslateObj , $obj , $varVariable);
        $Translateobj = $AssembleObj->process();
        die('11');


        die();
    }


}
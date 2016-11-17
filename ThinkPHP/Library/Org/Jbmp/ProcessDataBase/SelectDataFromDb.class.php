<?php
namespace Org\Jbmp\ProcessDataBase;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/14
 * Time: 21:39
 */
class SelectDataFromDb
{
    /**
     * 更加模板名称查询查询rule
     * @param $varModuleName string 名称
     * @return array
     */
    public function getRuleByModuleName($varModuleName){
        $data = M('flow_modulerule')->where("rulename = '{$varModuleName}'")->find();
        return $data;
    }

    /**
     * 得到getProperty
     */
    public function getProperty(){
        if($data = M('flow_property')->find()){
            return $data;
        }else{
            $data['key'] = 'next.dbid';
            $data['version'] = 1;
            $data['value'] = 1;
            M('flow_property')->add($data);
            return $data;
        }
    }

    /**
     * 得到task
     * @param $varExecution int 数组
     */
    public function getDataFromDataBaseByExecution($varExecution){
        $data = M('flow_execution')->alias('e')
            ->field("t.dbid as taskid , e.hasvars as hasvars , e.dbid as executionid")
            ->join('think_flow_histactinst AS ha ON e.hisactinst = ha.dbid')
            ->join('think_flow_histprocinst AS hp ON e.instance = hp.dbid')
            ->join('think_flow_histtask AS ht ON e.id = ht.execution')
            ->join('think_flow_modulerule AS mr ON e.procdefid = mr.rulename')
            ->join('think_flow_task AS t ON e.dbid = t.execution')
            ->where("e.dbid = {$varExecution}")->find();
        $baseDataBase = $data;

        $property = $this->getProperty();
        $participation = $this->getParticipationFromDataBaseByTask($data['taskid']);
        $variable = null;
        if($data['hasvars']){
            $variable = $this->getVariableFromDataBaseByTask($data['executionid']);
        }



        var_dump($data);
        die();
    }

    /**
     * 得到participation
     * @param $varTask int
     * @return array
     */
    public function getParticipationFromDataBaseByTask($varTask){
        $data = M('flow_participation')->where("task={$varTask}")->select();
        return $data;
    }

    /**
     * 得到participation
     * @param $varExecution int
     * @return array
     */
    public function getVariableFromDataBaseByTask($varExecution){
        $data = M('flow_variable')->where("execution={$varExecution}")->select();
        return $data;
    }

}
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
            ->field("e.dbid as edbid , e.activityname as eactivityname , e.procdefid as eprocdefid,e.hasvars as ehasvars,e.key as ekey,e.id as eid,e.state as estate,e.priority as epriority,e.hisactinst as ehisactinst,e.parent as eparent,e.parentidx as eparentidx,e.instance as einstance,
                ha.dbid as hadbid,ha.hprocid as hahprocid,ha.type as hatype,ha.execution as haexecution,ha.activity_name as haactivity_name,ha.start as hastart,ha.end as haend,ha.duration as haduration,ha.transition as hatransition,ha.htask as hahtask,
                hp.dbid as hpdbid,hp.id as hpid,hp.procdefid as hpprocdefid,hp.key as hpkey,hp.start as hpstart,hp.end as hpend,hp.duration as hpduration,hp.state as hpstate,hp.endactivity as hpendactivity,
                ht.dbid as htdbid,ht.execution as htexecution,ht.outcome as htoutcome,ht.assignee as htassignee,ht.priority as htpriority,ht.state as htstate,ht.create as htcreate,ht.end as htend,ht.duration as htduration,
                moduleid as mrmoduleid,rule as mrrule,rulename as mrrulename,addtime as mraddtime,creater as mrcreater,
	            t.dbid as tdbid,t.name as tname ,t.state as tstate ,t.assignee as tassignee ,t.priority as tpriority,t.create as tcreate,t.execution_id as texecution_id,t.activity_name as tactivity_name,t.hasvars as thasvars,t.execution as texecution,t.procinst as tprocinst
            ")
            ->join('left join think_flow_histactinst AS ha ON e.hisactinst = ha.dbid')
            ->join('left join think_flow_histprocinst AS hp ON e.instance = hp.dbid')
            ->join('left join think_flow_histtask AS ht ON e.id = ht.execution')
            ->join('left join think_flow_modulerule AS mr ON e.procdefid = mr.rulename')
            ->join('left join think_flow_task AS t ON e.dbid = t.execution')
            ->where("e.dbid = {$varExecution}")->find();
        return $data;

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

    /**
     * 通过parentid 查找所有的fork 子项目
     * @param $varParent int 父级id
     * @return array
     */
    public function getSubForkDataBaseByParent($varParent){
        if(!$varParent){
            return array();
        }
        $data = M('flow_execution')->alias('e')
            ->field("e.* , t.execution as texecution")
            ->join('left join think_flow_task AS t ON e.dbid = t.execution')
            ->where("e.parent = {$varParent} OR e.dbid = {$varParent}")
            ->select();
        return $data;
    }

}
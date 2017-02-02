<?php
namespace Vendor\Jbpm\Processdatabase;
/**
 * wudan 吴丹 创建于 2016-11-29 17:35:29
selectdata
 */
class SelectData{
    /**

     * 更加模板名称查询查询rule

     * @param $varModuleName string 名称

     * @return array

     */

    public function getRuleByModuleName($varModuleName){
//        $data = \EDB::table(\TAB_workflow_deployment::tableName())->whereRaw("rulename='{$varModuleName}'")->first();
        $data = M('flow_modulerule')->where("rulename='{$varModuleName}'")->find();
        return $data;
    }



    /**

     * 得到getProperty

     * @return array

     */

    public function getProperty(){



        if($data = M('flow_num')->find()){
            return $data;
        }else{
            $data['key'] = 'next.dbid';
            $data['version'] = 0;
            $data['value'] = 1;
            M('flow_num')->add($data);
            return $data;
        }

    }



    /**

     * 得到task

     * @param $varExecution int 数组

     * @return array

     */

    public function getDataFromDataBaseByExecution($varExecution){
        $data = \EDB::table(\TAB_workflow_execution::tableName() . " AS e")
            ->selectRaw("e.dbid as edbid , e.activityname as eactivityname , e.procdefid as eprocdefid,e.hasvars as ehasvars,e.key as ekey,e.id as eid,e.state as estate,e.priority as epriority,e.hisactinst as ehisactinst,e.parent as eparent,e.parentidx as eparentidx,e.instance as einstance,
                ha.dbid as hadbid,ha.hprocid as hahprocid,ha.type as hatype,ha.execution as haexecution,ha.activity_name as haactivity_name,ha.start as hastart,ha.end as haend,ha.duration as haduration,ha.transition as hatransition,ha.htask as hahtask,
                hp.dbid as hpdbid,hp.id as hpid,hp.procdefid as hpprocdefid,hp.key as hpkey,hp.start as hpstart,hp.end as hpend,hp.duration as hpduration,hp.state as hpstate,hp.endactivity as hpendactivity,
                ht.dbid as htdbid,ht.execution as htexecution,ht.outcome as htoutcome,ht.assignee as htassignee,ht.priority as htpriority,ht.state as htstate,ht.create as htcreate,ht.end as htend,ht.duration as htduration,
                moduleid as mrmoduleid,rule as mrrule,rulename as mrrulename,mr.addtime as mraddtime,creater as mrcreater,
                t.dbid as tdbid,t.name as tname ,t.state as tstate ,t.assignee as tassignee ,t.priority as tpriority,t.create as tcreate,t.execution_id as texecution_id,t.activity_name as tactivity_name,t.hasvars as thasvars,t.execution as texecution,t.procinst as tprocinst
            ")
            ->leftJoin(\TAB_workflow_hist_actinst::tableName() . " AS ha" , "e.hisactinst" , "=" , "ha.dbid")
            ->leftJoin(\TAB_workflow_hist_procinst::tableName() . " AS hp" , "e.instance" , "=" , "hp.dbid")
            ->leftJoin(\TAB_workflow_deployment::tableName(). " AS mr"  , 'e.procdefid' ,  '=' , 'mr.rulename')
            ->leftJoin(\TAB_workflow_task::tableName() . " AS t" , 'e.dbid' , '=' , 't.execution')
            ->leftJoin(\TAB_workflow_hist_task::tableName() . " AS ht" , "t.dbid" , "=" , "ht.dbid")
            ->whereRaw("e.dbid = {$varExecution}")->first();
        return $data;
    }



    /**

     * 得到participation

     * @param $varTask int

     * @return array

     */

    public function getParticipationFromDataBaseByTask($varTask){
        $data = \EDB::table(\TAB_workflow_participation::tableName())->whereRaw("task = {$varTask}")->get();
        return $data;
    }



    /**

     * 得到participation

     * @param $varExecution int

     * @return array

     */

    public function getVariableFromDataBaseByTask($varExecution){
        $data = \EDB::table(\TAB_workflow_variable::tableName())->whereRaw("execution={$varExecution}")->get();
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
        $data = \EDB::table(\TAB_workflow_execution::tableName() . " AS e")
            ->selectRaw("e.* , t.execution as texecution")
            ->leftJoin(\TAB_workflow_task::tableName() . " AS t" , "e.dbid" , "=" , "t.execution")
            ->whereRaw("e.parent = {$varParent} OR e.dbid = {$varParent}")
            ->get();
        return $data;

    }

}
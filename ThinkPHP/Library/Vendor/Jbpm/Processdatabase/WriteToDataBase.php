<?php
namespace Vendor\Jbpm\Handlerclass;
/**
 * wudan 吴丹 创建于 2016-11-29 17:36:15
WriteToDataBase
 */
class WriteToDataBase{
    /**
     * 对象
     */

    private $_translateInfoObj = null;



    /**
     * 写入数据库
     * @param $varTranslateInfoObj array 对象
     * @return array
     */

    public function initi($varTranslateInfoObj){
        $this->_translateInfoObj = $varTranslateInfoObj;
    }



    /**
     * 得到
     * @return array
     */

    public function getTranslateInfoObj(){
        return $this->_translateInfoObj;
    }



    /**

     * 写入数据库

     * @return array

     */

    public function writeToDataBase(){
        $versionNum = $this->_translateInfoObj->getVersionNum();
        $totalsum = \epet\hr\workuserflower\config\CommonConfig::getProperty()['totalsum'];
        $totalsum = $versionNum * $totalsum;
        $execution = $this->_translateInfoObj->getExecution();
        $histProcinst = $this->_translateInfoObj->getHistProcinst();
        $task = $this->_translateInfoObj->getTask();
        $participation = $this->_translateInfoObj->getParticipation();
        $histActinst = $this->_translateInfoObj->getHistActinst();
        $variable = $this->_translateInfoObj->getVariable();
        $histtask = $this->_translateInfoObj->getHisttask();
        \DB::beginTransaction();
        try{
            //execution
            if($execution['insert']){
                $flag = \EDB::table(\TAB_workflow_execution::tableName())->insert(array_merge($execution['insert']));
                if(!$flag) new \Exception('executionerror-insert');
            }

            if($execution['updata']){
                foreach($execution['updata'] as $k => $v){
                    $flag = \EDB::table(\TAB_workflow_execution::tableName())->whereRaw("dbid = {$v['where']['dbid']}")->update($v['data']);
                    if(!$flag) new \Exception('executionerror-updata');
                }
            }

            if($execution['del']){
                $tmpDel = implode(',' , array_values($execution['del']));
                $tmpDel = " dbid in ($tmpDel)";
                $flag = \EDB::table(\TAB_workflow_execution::tableName())->whereRaw($tmpDel)->delete();
                if(!$flag) new \Exception('executionerror-del');
            }

            //histProcinst

            if($histProcinst['insert']){
                $flag = \EDB::table(\TAB_workflow_hist_procinst::tableName())->insert(array_merge($histProcinst['insert']));
                if(!$flag){
                    new \Exception('histProcinsterror-insert');
                }
            }

            if($histProcinst['updata']){
                foreach($histProcinst['updata'] as $k => $v){
                    $flag = \EDB::table(\TAB_workflow_hist_procinst::tableName())->whereRaw("dbid = {$v['where']['dbid']}")->update($v['data']);
                    if(!$flag) new \Exception('histProcinsterror-updata');
                }
            }

            //task
            if($task['insert']){
                $flag = \EDB::table(\TAB_workflow_task::tableName())->insert(array_merge($task['insert']));
                if(!$flag){
                    new \Exception('taskerror');
                }
            }

            if($task['del']){
                $tmpDel = implode(',' , array_values($task['del']));
                $tmpDel = " dbid in ($tmpDel)";
                $flag = \EDB::table(\TAB_workflow_task::tableName())->whereRaw($tmpDel)->delete();
                if(!$flag) new \Exception('taskerror-del');
            }

            //participation
            if($participation['insert']){
                $flag = \EDB::table(\TAB_workflow_participation::tableName())->insert(array_merge($participation['insert']));
                if(!$flag) new \Exception('participationerror-insert');
            }

            if($participation['del']){
                $tmpDel = implode(',' , array_values($participation['del']));
                $tmpDel = " dbid in ($tmpDel)";
                $flag = \EDB::table(\TAB_workflow_participation::tableName())->whereRaw($tmpDel)->delete();
                if(!$flag) new \Exception('participationerror-del');
            }

            //histActinst
            if($histActinst['insert']){
                $flag = \EDB::table(\TAB_workflow_hist_actinst::tableName())->insert(array_merge($histActinst['insert']));
                if(!$flag){
                    new \Exception('histActinsterror');
                }
            }

            if($histActinst['updata']){
                foreach($histActinst['updata'] as $k => $v){
                    $flag = \EDB::table(\TAB_workflow_hist_actinst::tableName())->whereRaw("dbid = {$v['where']['dbid']}")->update($v['data']);
                    if(!$flag) new \Exception('histActinsterror-updata');
                }
            }
            //variable
            if($variable['insert']){
                $flag = \EDB::table(\TAB_workflow_variable::tableName())->insert(array_merge($variable['insert']));
                if(!$flag){
                    new \Exception('variableerror');
                }
            }
            if(!empty($variable['del'])){
                $tmpDel = implode(',' , array_values($variable['del']));
                $tmpFlag = $variable['insert'] ? 'dbid' : 'execution';
                $tmpDel = " {$tmpFlag} in ($tmpDel)";
                $flag = \EDB::table(\TAB_workflow_variable::tableName())->whereRaw($tmpDel)->delete();
                if(!$flag) new \Exception('variableerror-del');
            }
            //histtask
            if($histtask['insert']){
                $flag = \EDB::table(\TAB_workflow_hist_task::tableName())->insert(array_merge($histtask['insert']));
                if(!$flag) new \Exception('histtaskerror-insert');
            }
            if($histtask['updata']){
                foreach($histtask['updata'] as $k => $v){
                    $flag = \EDB::table(\TAB_workflow_hist_task::tableName())->whereRaw("dbid = {$v['where']['dbid']}")->update($v['data']);
                    if(!$flag) new \Exception('histtaskerror-updata');
                }
            }
            $flag = \EDB::table(\TAB_workflow_num::tableName())->increment('value' , $totalsum);
            if(!$flag){
                new \Exception('error');
            }
            \DB::commit();
            return $this->_translateInfoObj;
        }catch (RUNError $e){
            \DB::rollBack($e);
            return array('error'=>1 , 'errormsg'=>'sql-error');
        }
    }
}
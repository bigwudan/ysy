<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/16
 * Time: 21:22
 */

namespace Vendor\Jbpm\Processdatabase;


class WriteToDataBase
{

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
        $Dao = M();
        $versionNum = $this->_translateInfoObj->getVersionNum();
        $totalsum = \Vendor\Jbpm\Config\CommonConfig::getProperty()['totalsum'];
        $totalsum = $versionNum * $totalsum;
        $execution = $this->_translateInfoObj->getExecution();
        $histProcinst = $this->_translateInfoObj->getHistProcinst();
        $task = $this->_translateInfoObj->getTask();
        $participation = $this->_translateInfoObj->getParticipation();
        $histActinst = $this->_translateInfoObj->getHistActinst();
        $variable = $this->_translateInfoObj->getVariable();
        $histtask = $this->_translateInfoObj->getHisttask();
        $model = new \Think\Model();
        $model->startTrans();
        try{
            //execution
            if($execution['insert']){
                $flag = M('workflow_execution')->addAll(array_merge($execution['insert']));
                if(!$flag) new \Exception('executionerror-insert');
            }
            if($execution['updata']){
                foreach($execution['updata'] as $k => $v){
                    $flag = M('workflow_execution')->where("dbid = {$v['where']['dbid']}")->save($v['data']);
                    if(!$flag) new \Exception('executionerror-updata');
                }
            }
            if($execution['del']){
                $tmpDel = implode(',' , array_values($execution['del']));
                $tmpDel = " dbid in ($tmpDel)";
                $flag = M('workflow_execution')->where($tmpDel)->delete();
                if(!$flag) new \Exception('executionerror-del');
            }

            //histProcinst
            if($histProcinst['insert']){
                $flag = M('workflow_hist_procinst')->addAll(array_merge($histProcinst['insert']));
                if(!$flag){
                    new \Exception('histProcinsterror-insert');
                }
            }
            if($histProcinst['updata']){
                foreach($histProcinst['updata'] as $k => $v){
                    $flag = M('workflow_hist_procinst')->where("dbid = {$v['where']['dbid']}")->save($v['data']);
                    if(!$flag) new \Exception('histProcinsterror-updata');
                }
            }

            //task
            if($task['insert']){
                $flag = M('workflow_task')->addAll(array_merge($task['insert']));
                if(!$flag){
                    new \Exception('taskerror');
                }
            }
            if($task['del']){
                $tmpDel = implode(',' , array_values($task['del']));
                $tmpDel = " dbid in ($tmpDel)";
                $flag = M('workflow_task')->where($tmpDel)->delete();
                if(!$flag) new \Exception('taskerror-del');
            }

            //participation
            if($participation['insert']){
                $flag = M('workflow_participation')->addAll(array_merge($participation['insert']));
                if(!$flag) new \Exception('participationerror-insert');
            }
            if($participation['del']){
                $tmpDel = implode(',' , array_values($participation['del']));
                $tmpDel = " dbid in ($tmpDel)";
                $flag = M('workflow_participation')->where($tmpDel)->delete();
                if(!$flag) new \Exception('participationerror-del');
            }

            //histActinst
            if($histActinst['insert']){
                $flag = M('workflow_hist_actinst')->addAll(array_merge($histActinst['insert']));
                if(!$flag){
                    new \Exception('histActinsterror');
                }
            }
            if($histActinst['updata']){
                foreach($histActinst['updata'] as $k => $v){
                    $flag = M('workflow_hist_actinst')->where("dbid = {$v['where']['dbid']}")->save($v['data']);
                    if(!$flag) new \Exception('histActinsterror-updata');
                }
            }

            //variable
            if($variable['insert']){
                $flag = M('workflow_variable')->addAll(array_merge($variable['insert']));
                if(!$flag){
                    new \Exception('variableerror');
                }
            }
            if($variable['del']){
                $tmpDel = implode(',' , array_values($variable['del']));
                $tmpDel = " execution in ($tmpDel)";
                $flag = M('workflow_variable')->where($tmpDel)->delete();
                if(!$flag) new \Exception('variableerror-del');
            }

            //histtask
            if($histtask['insert']){
                $flag = M('workflow_hist_task')->addAll(array_merge($histtask['insert']));
                if(!$flag) new \Exception('histtaskerror-insert');
            }
            if($histtask['updata']){
                foreach($histtask['updata'] as $k => $v){
                    $flag = M('workflow_hist_task')->where("dbid = {$v['where']['dbid']}")->save($v['data']);
                    if(!$flag) new \Exception('histtaskerror-updata');
                }
            }
            $flag = $Dao->execute("update think_workflow_num set version = version + {$versionNum} , value = value + {$totalsum}");
            if(!$flag){
                new \Exception('error');
            }
            $model->commit();
            return array();
        }catch (\Exception $e){
            $model->rollback();
            return array('error'=>1 , 'errormsg'=>'sql-error');
        }
    }



}
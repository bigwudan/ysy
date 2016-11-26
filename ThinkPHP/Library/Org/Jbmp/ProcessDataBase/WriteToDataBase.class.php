<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/16
 * Time: 21:22
 */

namespace Org\Jbmp\ProcessDataBase;


class WriteToDataBase
{

    /**
     * 对象
     */
    private $_translateInfoObj = null;

    /**
     * 写入数据库
     * @param $varTranslateInfoObj array 对象
     */
    public function initi($varTranslateInfoObj){
        $this->_translateInfoObj = $varTranslateInfoObj;
    }

    /**
     * 得到
     */
    public function getTranslateInfoObj(){
        return $this->_translateInfoObj;
    }

    /**
     * 写入数据库
     */
    public function writeToDataBase(){
        $Dao = M();
        $versionNum = $this->_translateInfoObj->getVersionNum();
        $totalsum = \Org\Jbmp\Config\CommonConfig::getProperty()['totalsum'];
        $totalsum = $versionNum * $totalsum;
        $execution = $this->_translateInfoObj->getExecution();
        $histProcinst = $this->_translateInfoObj->getHistProcinst();
        $task = $this->_translateInfoObj->getTask();
        $participation = $this->_translateInfoObj->getParticipation();
        $histActinst = $this->_translateInfoObj->getHistActinst();
        $variable = $this->_translateInfoObj->getVariable();
        $histtask = $this->_translateInfoObj->getHisttask();

        var_dump($histActinst);
        die();
        $model = new \Think\Model();
        $model->startTrans();
        try{
            //execution
            if($execution['insert']){
                $flag = M('flow_execution')->addAll(array_merge($execution['insert']));
                if(!$flag) new \Exception('executionerror-insert');
            }
            if($execution['updata']){
                foreach($execution['updata'] as $k => $v){
                    $flag = M('flow_execution')->where("dbid = {$v['where']['dbid']}")->save($v['data']);
                    if(!$flag) new \Exception('executionerror-updata');
                }
            }
            if($execution['del']){
                $tmpDel = implode(',' , array_values($execution['del']));
                $tmpDel = " dbid in ($tmpDel)";
                $flag = M('flow_execution')->where($tmpDel)->delete();
                if(!$flag) new \Exception('executionerror-del');
            }

            //histProcinst
            if($histProcinst['insert']){
                $flag = M('flow_histprocinst')->addAll(array_merge($histProcinst['insert']));
                if(!$flag){
                    new \Exception('histProcinsterror-insert');
                }
            }
            if($histProcinst['updata']){
                foreach($histProcinst['updata'] as $k => $v){
                    $flag = M('flow_histprocinst')->where("dbid = {$v['where']['dbid']}")->save($v['data']);
                    if(!$flag) new \Exception('histProcinsterror-updata');
                }
            }

            //task
            if($task['insert']){
                $flag = M('flow_task')->addAll(array_merge($task['insert']));
                if(!$flag){
                    new \Exception('taskerror');
                }
            }
            if($task['del']){
                $tmpDel = implode(',' , array_values($task['del']));
                $tmpDel = " dbid in ($tmpDel)";
                $flag = M('flow_task')->where($tmpDel)->delete();
                if(!$flag) new \Exception('taskerror-del');
            }

            //participation
            if($participation['insert']){
                $flag = M('flow_participation')->addAll(array_merge($participation['insert']));
                if(!$flag) new \Exception('participationerror-insert');
            }
            if($participation['del']){
                $tmpDel = implode(',' , array_values($participation['del']));
                $tmpDel = " dbid in ($tmpDel)";
                $flag = M('flow_participation')->where($tmpDel)->delete();
                if(!$flag) new \Exception('participationerror-del');
            }

            //histActinst
            if($histActinst['insert']){
                $flag = M('flow_histactinst')->addAll(array_merge($histActinst['insert']));
                if(!$flag){
                    new \Exception('histActinsterror');
                }
            }
            if($histActinst['updata']){
                foreach($histActinst['updata'] as $k => $v){
                    $flag = M('flow_histactinst')->where("dbid = {$v['where']['dbid']}")->save($v['data']);
                    if(!$flag) new \Exception('histActinsterror-updata');
                }
            }

            //variable
            if($variable['insert']){
                $flag = M('flow_variable')->addAll(array_merge($variable['insert']));
                if(!$flag){
                    new \Exception('variableerror');
                }
            }
            if($variable['del']){
                $tmpDel = implode(',' , array_values($variable['del']));
                $tmpDel = " execution in ($tmpDel)";
                $flag = M('flow_variable')->where($tmpDel)->delete();
                if(!$flag) new \Exception('variableerror-del');
            }

            //histtask
            if($histtask['insert']){
                $flag = M('flow_histtask')->addAll(array_merge($histtask['insert']));
                if(!$flag) new \Exception('histtaskerror-insert');
            }
            if($histtask['updata']){
                foreach($histtask['updata'] as $k => $v){
                    $flag = M('flow_histtask')->where("dbid = {$v['where']['dbid']}")->save($v['data']);
                    if(!$flag) new \Exception('histtaskerror-updata');
                }
            }
            $flag = $Dao->execute("update think_flow_property set version = version + {$versionNum} , value = value + {$totalsum}");
            if(!$flag){
                new \Exception('error');
            }
            $model->commit();
            return array();
        }catch (\Exception $e){
            $model->rollback();
            var_dump($e->getMessage());
            return array('error'=>1 , 'errormsg'=>'sql-error');
        }
    }



}
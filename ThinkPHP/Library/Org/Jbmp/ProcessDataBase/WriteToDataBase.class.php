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
     * 写入数据库
     */
    public function writeToDataBase(){
        $Dao = M();
        $totalsum = \Org\Jbmp\Config\CommonConfig::getProperty()['totalsum'];
        $execution = $this->_translateInfoObj->getExecution();
        $execution = $this->_processExecution($execution);
        $histProcinst = $this->_translateInfoObj->getHistProcinst();
        $task = $this->_translateInfoObj->getTask();
        $participation = $this->_translateInfoObj->getParticipation();
        $histActinst = $this->_translateInfoObj->getHistActinst();
        $variable = $this->_translateInfoObj->getVariable();
        $histtask = $this->_translateInfoObj->getHisttask();
        $model = new \Think\Model();
        $model->startTrans();
        try{
            $flag = M('flow_execution')->addAll($execution['insert']);
            if(!$flag){
                new \Exception('error');
            }
            $flag = M('flow_histprocinst')->addAll($histProcinst['insert']);
            if(!$flag){
                new \Exception('error');
            }
            $flag = M('flow_task')->addAll($task['insert']);
            if(!$flag){
                new \Exception('error');
            }
            $flag = M('flow_participation')->addAll($participation['insert']);
            if(!$flag){
                new \Exception('error');
            }
            $flag = M('flow_histactinst')->addAll($histActinst['insert']);
            if(!$flag){
                new \Exception('error');
            }
            $flag = M('flow_variable')->addAll($variable['insert']);
            if(!$flag){
                new \Exception('error');
            }
            $flag = M('flow_histtask')->addAll($histtask['insert']);
            if(!$flag){
                new \Exception('error');
            }
            $flag = $Dao->execute("update think_flow_property set version = version + 1 , value = value + {$totalsum}");
            if(!$flag){
                new \Exception('error');
            }
            $model->commit();
        }catch (\Exception $e){
            $model->rollback();
        }

        die('11');
    }

    /**
     *
     */
    private function _processExecution($varExecution){
        $tmpExecution = array();
        if(array_key_exists('forkmain' , $varExecution['insert'])){
            $tmpExecution['insert'][] = $varExecution['insert']['forkmain'];
            foreach($varExecution['insert']['fork'] as $k => $v){
                $tmpExecution['insert'][] = $v;
            }
        }else{
            $tmpExecution = $varExecution;
        }
        return $tmpExecution;
    }

}
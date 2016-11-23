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
        $histProcinst = $this->_translateInfoObj->getHistProcinst();
        $task = $this->_translateInfoObj->getTask();
        $participation = $this->_translateInfoObj->getParticipation();
        $histActinst = $this->_translateInfoObj->getHistActinst();
        $variable = $this->_translateInfoObj->getVariable();
        $histtask = $this->_translateInfoObj->getHisttask();
        $model = new \Think\Model();
        $model->startTrans();
        try{
            if($execution['insert']){
                $flag = M('flow_execution')->addAll(array_merge($execution['insert']));
                if(!$flag){
                    new \Exception('executionerror');
                }
            }

            if($histProcinst['insert']){
                $flag = M('flow_histprocinst')->addAll(array_merge($histProcinst['insert']));
                if(!$flag){
                    new \Exception('histProcinsterror');
                }
            }

            if($task['insert']){
                $flag = M('flow_task')->addAll(array_merge($task['insert']));
                if(!$flag){
                    new \Exception('taskerror');
                }
            }


            if($participation['insert']){
                $flag = M('flow_participation')->addAll(array_merge($participation['insert']));
                if(!$flag){
                    new \Exception('participationerror');
                }
            }

            if($histActinst['insert']){
                $flag = M('flow_histactinst')->addAll(array_merge($histActinst['insert']));
                if(!$flag){
                    new \Exception('histActinsterror');
                }
            }


            if($variable['insert']){
                $flag = M('flow_variable')->addAll(array_merge($variable['insert']));
                if(!$flag){
                    new \Exception('variableerror');
                }
            }


            if($histtask['insert']){
                $flag = M('flow_histtask')->addAll(array_merge($histtask['insert']));
                if(!$flag){
                    new \Exception('histtaskerror');
                }

            }
            $flag = $Dao->execute("update think_flow_property set version = version + 1 , value = value + {$totalsum}");
            if(!$flag){
                new \Exception('error');
            }
            $model->commit();
        }catch (\Exception $e){
            $model->rollback();
            var_dump($e->getMessage());
        }
        die('over');
    }



}
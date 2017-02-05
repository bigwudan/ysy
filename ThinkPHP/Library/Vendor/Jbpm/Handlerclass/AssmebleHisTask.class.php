<?php
namespace Vendor\Jbpm\Handlerclass;
/**
 * wudan 吴丹 创建于 2016-11-29 17:28:48
AssmebleHisTask
 */
class AssmebleHisTask{
    /**

     * execution对象

     */

    private $_executionObj = null;



    /**

     * targetNode对象

     */

    private $_targetNode = null;



    /**

     * 结果

     */

    private $_execution = null;



    /**

     * 累加数

     */

    private $_num = null;



    /**

     * task

     */

    private $_task = null;









    /**

     * 初始化

     * @param $varExecution object 对象execution

     * @param $varTargetNode object 对象targetNode

     * @param $varNum int 累加数

     * @param $execution array executin数组

     * @param $task array task数组

     * @return array

     */

    public function initi($varExecution  ,  $varTargetNode , $varNum,  $execution , $task){

        $this->_executionObj = $varExecution;

        $this->_targetNode = $varTargetNode;

        $this->_num = $varNum;

        $this->_execution = $execution;

        $this->_task = $task;

        return $this;

    }



    /**

     *

     */

    public function process(){

        $currNode  =  $this->_executionObj->getCurrNode();

        $histTask = array();

        if($currNode['nodeName'] == 'start'){

            $histTask['insert'] = $this->_processInsert();

        }else{

            if($this->_executionObj->getCurrNode()['nodeName'] == 'task'){

                if($tmp = $this->_processUpdata()){

                    $histTask['updata'] = $tmp;

                }

            }

            if($tmp = $this->_processInsert()){

                $histTask['insert'] = $tmp;

            }

        }

        return $histTask;

    }





    /**

     * 更新

     */

    private function _processUpdata(){

        $hisTaskFromDb = $this->_executionObj->getHistTask();

        $this->_targetNode->getTargetNodeList();

        $where['dbid'] = $hisTaskFromDb['dbid'];

        $upData = array(

            'outcome' => $this->_targetNode->getTargetNodeList()['name'],

            'state' => 'complete',

            'end' => time(),

            'duration' =>time() - $hisTaskFromDb['create']

        );

        $hisTask[$hisTaskFromDb['dbid']]  = array(

            'where'=>$where,

            'data'=>$upData

        );

        return $hisTask;

    }



    /**

     * 插入

     */

    private function _processInsert(){

        if($this->_targetNode->getClassName() == 'fork'){

            $tmp = $this->_targetNode->getForkTargetNodeList();

            $taskList = array();

            foreach($tmp as $k => $v){

                $v['nodeName'] == 'task' && array_push($taskList , $v);

            }

        }

        if($taskList){

            foreach($this->_task['insert'] as $k => $v){

                $hisTask[$v['dbid']] = array(

                    'dbid' => $v['dbid'],

                    'execution' => $v['execution_id'],

                    'outcome' => '',

                    'assignee' => '',

                    'priority' => 0,

                    'state' => 'open',

                    'create' => time(),

                    'end' => 0,

                    'duration' => 0

                );

            }

        }elseif($this->_targetNode->getTargetNodeList()['nodeName'] == 'task'){

            $tmpTask = array();

            foreach($this->_task['insert'] as $k => $v){

                $tmpTask['execution_id'] = $v['execution_id'];

                $tmpTask['execution'] = $v['dbid'];

                break;

            }

            $hisTask[$tmpTask['execution']] = array(

                'dbid' => $tmpTask['execution'],

                'execution' => $tmpTask['execution_id'],

                'outcome' => '',

                'assignee' => '',

                'priority' => 0,

                'state' => 'open',

                'create' => time(),

                'end' => 0,

                'duration' => 0

            );

        }else{

            $hisTask = array();

        }

        return $hisTask;

    }

}
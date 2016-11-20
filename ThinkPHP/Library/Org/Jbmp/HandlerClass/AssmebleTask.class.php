<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/20
 * Time: 20:37
 */

namespace Org\Jbmp\HandlerClass;


class AssmebleTask
{
    /**
     *
     */
    private $_varsList = null;

    /**
     *
     */
    private $_executionObj = null;

    /**
     *
     */
    private $_targetNode = null;

    /**
     * 结果
     */
    private $_execution = null;

    /**
     *
     */
    private $_num = null;

    /**
     * 初始化
     * @param $varExecution
     * @param $varTargetNode
     * @param $varNum
     * @param $varVars
     * @return array
     */
    public function initi($varExecutionObj  ,  $varTargetNode , $varNum, $varExecution ,$varVars = array()){
        $this->_executionObj = $varExecutionObj;
        $this->_targetNode = $varTargetNode;
        $this->_execution = $varExecution;
        $this->_num = $varNum;
        $varVars && $this->_varsList = $varVars;
        return $this;
    }

    /**
     * 运行
     */
    public function process(){
        $currNode  =  $this->_executionObj->getCurrNode();
        if($currNode['nodeName'] == 'start'){
            $task = $this->_processInsert();
        }else{
            $task = $this->_processBelongToCommon();
        }
        return $task;
    }

    private function _processInsert(){
        $hasVars  =  $this->_varsList ? 1 :  0;
        if($this->_tmpTask){
            foreach($this->_tmpTask as $k => $v){
                $tmp = array();
                foreach($this->_execution['insert']['fork'] as $k1 => $v1){
                    if($v['name'] == $v1['activityname']){
                        $tmp['execution_id'] = $v1['id'];
                        $tmp['execution'] = $v1['dbid'];
                        $tmp['procinst'] = $v1['instance'];
                        break;
                    }
                }

                $task['insert'][] = array(
                    'dbid' => $this->_num,
                    'name' => $v['name'],
                    'state' => 'open',
                    'assignee' => '',
                    'priority' => 0,
                    'create' => time(),
                    'execution_id' => $tmp['execution_id'],
                    'activity_name' => $v['name'],
                    'hasvars' => $hasVars,
                    'execution' => $tmp['execution'],
                    'procinst' => $tmp['procinst']
                );
                $this->_num = $this->_num + 1;
            }
        }else{
            $task['insert'][$this->_num] = array(
                'dbid' => $this->_num,
                'name' => $this->_targetNode->getTargetNodeList()['name'],
                'state' => 'open',
                'assignee' => '',
                'priority' => 0,
                'create' => time(),
                'execution_id' => current($this->_execution['insert'])['id'],
                'activity_name' => $this->_targetNode->getTargetNodeList()['name'],
                'hasvars' => $hasVars,
                'execution' => current($this->_execution['insert'])['dbid'],
                'procinst' => current($this->_execution['insert'])['dbid']
            );
            $this->_num = $this->_num + 1;
        }
        return $task;
    }

    /**
     * 得到num
     */
    public function getNum(){

        return $this->_num;
    }

}
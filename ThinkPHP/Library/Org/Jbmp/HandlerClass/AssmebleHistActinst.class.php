<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/19
 * Time: 22:31
 */

namespace Org\Jbmp\HandlerClass;


class AssmebleHistActinst
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
     *
     */
    private $_histProcinst = null;

    /**
     * task
     */
    private $_task = null;

    /**
     *
     */
    private $_histActinst = null;

    /**
     * 初始化
     */
    public function initi($varExecution  ,  $varTargetNode , $varNum,  $execution , $task ){
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
        if($currNode['nodeName'] == 'start'){
            $histActinst = $this->_processInsert();
        }else{
            $histActinst = $this->_processBelongToCommon();
        }
        $this->_histActinst  = $histActinst;
        return $histActinst;
    }


    /**
     * 得到num
     */
    public function getNum(){
        return $this->_num;
    }
    /**
     * 处理其他
     */
    private function _processBelongToCommon(){
        $histActinst = $this->_executionObj->getHistActinst();
        $where = array();
        $where['dbid'] = $histActinst['dbid'];
        $targetNodeList = $this->_targetNode->getTargetNodeList();
        $upData = array(
            'transition' => "to {$targetNodeList['name']}",
            'end' => time(),
            'duration' => time() - $histActinst['start'],
        );
        $tmpHistActinst['updata'] = array(
            $histActinst['dbid'] =>array('where'=>$where,'data'=>$upData)
        );
        return $tmpHistActinst;
    }
    /**
     * 处理开始
     */
    private function _processInsert(){
        if($this->_execution['insert']){
            if($this->_execution['insert']['forkmain']){
                foreach($this->_execution['insert']['fork'] as $k => $v){
                    $tmpTargetNode = $this->_targetNode->getForkTargetNodeList()[$k];
                    $histActinst['insert'][] = array(
                        'dbid' => $this->_num,
                        'hprocid' => $this->_execution['insert']['forkmain']['instance'],
                        'type' => $tmpTargetNode['nodeName'],
                        'execution' => $v['dbid'],
                        'activity_name' => $tmpTargetNode['name'],
                        'start' => time(),
                        'end'  => 0,
                        'duration' => 0,
                        'transition' => "",
                        'htask' => 0

                    );
                    $this->_execution['insert']['fork'][$k]['hisactinst'] = $this->_num;
                    $this->_num = $this->_num + 1;
                }
            }else{
                if($decision = $this->_targetNode->getDecision()){
                    $histActinst['insert'][$this->_num] = array(
                        'dbid' => $this->_num,
                        'hprocid' => current($this->_execution['insert'])['instance'],
                        'type' => $decision['nodeName'],
                        'execution' => current($this->_execution['insert'])['dbid'],
                        'activity_name' => $decision['name'],
                        'start' => time(),
                        'end'  => time(),
                        'duration' => 0,
                        'transition' => "to {$this->_targetNode->getTargetNodeList()['name']}",
                        'htask' => 0

                    );
                    $this->_num = $this->_num + 1;
                }
                $histActinst['insert'][$this->_num] = array(
                    'dbid' => $this->_num,
                    'hprocid' => current($this->_execution['insert'])['instance'],
                    'type' => $this->_targetNode->getTargetNodeList()['nodeName'],
                    'execution' => current($this->_execution['insert'])['dbid'],
                    'activity_name' => $this->_targetNode->getTargetNodeList()['name'],
                    'start' => time(),
                    'end'  => 0,
                    'duration' => 0,
                    'transition' => '',
                    'htask' => 0

                );
                $this->_execution['insert'][current($this->_execution['insert'])['dbid']]['hisactinst'] = $this->_num;
                $this->_num = $this->_num + 1;
            }
        }
        if($this->_task['insert']){
            foreach($histActinst['insert'] as $k => $v){
                foreach($this->_task['insert'] as $k1 => $v1){
                    if($v1['activity_name'] == $v['activity_name']){
                        $histActinst['insert'][$k]['htask'] = $v1['dbid'];
                        break;
                    }
                }
            }
        }
        $this->_histActinst = $histActinst;

    }

    /**
     * 得到execution
     */
    public function getExecution(){
        return $this->_execution;
    }

}
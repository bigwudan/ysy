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
     * task
     */
    private $_task = null;


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
        $histActinst = array();
        if($currNode['nodeName'] == 'start'){
            $histActinst['insert'] = $this->_processInsert();
        }else{
            if($tmp = $this->_processUpdata()){
                $histActinst['updata'] = $tmp;
            }
            if($this->_targetNode->getTargetNodeList()['nodeName'] != 'end'){
                if($tmp = $this->_processInsert()){
                    $histActinst['insert'] = $tmp;
                }
            }
        }
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
    private function _processUpdata(){

        if(($this->_targetNode->getClassName() == 'join') && ($this->_targetNode->getHasFinishJoin())){
                $currNodeObj = $this->_executionObj->getCurrNode();
                $joinExecution = $this->_targetNode->getJoinExecution();
                $histActinst = $this->_executionObj->getHistActinst();
                $tmpHisActinst = 0;
                foreach($joinExecution['subActiveFork'] as $k => $v){
                    if($v['activityname'] == $currNodeObj['name']){
                        $tmpHisActinst = $v['hisactinst'];
                        break;
                    }
                }
                $where['dbid'] = $tmpHisActinst;
                $upData = array(
                    'transition' => "to {$this->_targetNode->getTargetNodeList()['name']}",
                    'end' => time(),
                    'duration' => time() - $histActinst['start'],
                );
        }else{
            $histActinst = $this->_executionObj->getHistActinst();
            $where = array();
            $where['dbid'] = $histActinst['dbid'];
            $targetNodeList = $this->_targetNode->getTargetNodeList();
            $upData = array(
                'transition' => "to {$targetNodeList['name']}",
                'end' => time(),
                'duration' => time() - $histActinst['start'],
            );
        }
        $tmpHistActinst = array(
            $histActinst['dbid'] =>array('where'=>$where,'data'=>$upData)
        );
        return $tmpHistActinst;
    }


    /**
     * 处理开始
     */
    private function _processInsert(){
        if(($this->_targetNode->getClassName() == 'join') && ($this->_targetNode->getHasFinishJoin())){
            $histActinst[$this->_num] = array(
                'dbid' => $this->_num,
                'hprocid' => $this->_executionObj->getExecution()['instance'],
                'type' => $this->_targetNode->getTargetNodeList()['nodeName'],
                'execution' => current($this->_execution['updata'])['where']['dbid'],
                'activity_name' => current($this->_execution['updata'])['data']['activityname'],
                'start' => time(),
                'end'  => 0,
                'duration' => 0,
                'transition' => "",
                'htask' => 0
            );
            $this->_num = $this->_num + 1;
        }else if($this->_targetNode->getClassName() == 'fork'){
				$tmpNum = 0;
                foreach($this->_execution['insert'] as $k => $v) {
                    $tmpNum++;
                    if(($this->_executionObj->getCurrNode()['nodeName'] == 'start') && ($tmpNum == 1)){
                        continue;
                    }
                    $tmpTargetNode = $this->_targetNode->getForkTargetNodeList();
                    $tmpTarget = array();
                    foreach ($tmpTargetNode as $k1 => $v1) {
                        if ($v1['name'] == $v['activityname']) {
                            $tmpTarget = $v1;
                            break;
                        }
                    }
                    $histActinst[$this->_num] = array(
                        'dbid' => $this->_num,
                        'hprocid' => current($this->_execution['insert'])['instance'],
                        'type' => $tmpTarget['nodeName'],
                        'execution' => $v['dbid'],
                        'activity_name' => $tmpTarget['name'],
                        'start' => time(),
                        'end' => 0,
                        'duration' => 0,
                        'transition' => "",
                        'htask' => 0

                    );
                    $this->_execution['insert'][$k]['hisactinst'] = $this->_num;
                    $this->_num = $this->_num + 1;

                }

        }elseif($this->_targetNode->getTargetNodeList()['nodeName'] == 'join'){
            return array();
        }else{
            if($this->_executionObj->getCurrNode()['nodeName'] == 'start'){

                foreach($this->_execution['insert'] as $k => $v){
                    $tmpExecution = $v['dbid'];
                    break;
                }
                $tmpProcid = $tmpExecution;
            }else{

                $tmpProcid = $this->_executionObj->getHistprocinst()['dbid'];
                foreach($this->_execution['updata'] as $k => $v){
                    $tmpExecution = $v['where']['dbid'];
                    break;
                }
            }
            if($decision = $this->_targetNode->getDecision()){
                $histActinst[$this->_num] = array(
                    'dbid' => $this->_num,
                    'hprocid' => $tmpProcid,
                    'type' => $decision['nodeName'],
                    'execution' => $tmpExecution,
                    'activity_name' => $decision['name'],
                    'start' => time(),
                    'end'  => time(),
                    'duration' => 0,
                    'transition' => "to {$this->_targetNode->getTargetNodeList()['name']}",
                    'htask' => 0

                );
                $this->_num = $this->_num + 1;
            }

            $histActinst[$this->_num] = array(
                'dbid' => $this->_num,
                'hprocid' => $tmpProcid,
                'type' => $this->_targetNode->getTargetNodeList()['nodeName'],
                'execution' => $tmpExecution,
                'activity_name' => $this->_targetNode->getTargetNodeList()['name'],
                'start' => time(),
                'end'  => 0,
                'duration' => 0,
                'transition' => "",
                'htask' => 0

            );

            if($this->_executionObj->getCurrNode()['nodeName'] == 'start'){
                foreach($this->_execution['insert'] as $k => $v){
                    $this->_execution['insert'][$k]['hisactinst'] = $this->_num;
                }
            }else{
                foreach($this->_execution['updata'] as $k => $v){
                    $this->_execution['updata'][$k]['data']['hisactinst'] = $this->_num;
                }
            }
            $this->_num = $this->_num + 1;
        }

        if($this->_task['insert']){
            foreach($histActinst as $k => $v){
                foreach($this->_task['insert'] as $k1 => $v1){
                    if($v1['activity_name'] == $v['activity_name']){
                        $histActinst[$k]['htask'] = $v1['dbid'];
                        break;
                    }
                }
            }
        }
        return $histActinst;
    }



    /**
     * 处理开始
     */
    private function _processInsertbak(){
        if(($this->_targetNode->getClassName() == 'join') && ($this->_targetNode->getHasFinishJoin())){
            $histActinst[$this->_num] = array(
                'dbid' => $this->_num,
                'hprocid' => $this->_executionObj->getExecution()['instance'],
                'type' => $this->_targetNode->getTargetNodeList()['nodeName'],
                'execution' => current($this->_execution['updata'])['where']['dbid'],
                'activity_name' => current($this->_execution['updata'])['data']['activityname'],
                'start' => time(),
                'end'  => 0,
                'duration' => 0,
                'transition' => "",
                'htask' => 0
            );
            $this->_num = $this->_num + 1;
        }else if($this->_execution['updata'] && current($this->_execution['updata'])){
            if($this->_targetNode->getClassName() == 'fork'){
                $histActinst['insert'][$this->_num] = array(
                    'dbid' => $this->_num,
                    'hprocid' => $this->_executionObj->getExecution()['instance'],
                    'type' => 'fork',
                    'execution' => current($this->_execution['updata'])['where']['dbid'],
                    'activity_name' => current($this->_execution['updata'])['data']['activityname'],
                    'start' => time(),
                    'end'  => 0,
                    'duration' => 0,
                    'transition' => "",
                    'htask' => 0
                );
                foreach($this->_execution['updata'] as $k => $v){
                    $this->_execution['updata'][$k]['data']['hisactinst'] = $this->_num;
                    break;
                }
                $this->_num = $this->_num + 1;
                $tmpTargetNode = $this->_targetNode->getForkTargetNodeList();
                foreach($this->_execution['insert'] as $k => $v){
                    $tmpTarget = array();
                    foreach($tmpTargetNode as $k1 => $v1){
                        if($v1['name'] == $v['activityname']){
                            $tmpTarget = $v1;
                            break;
                        }
                    }
                    $histActinst['insert'][$this->_num] = array(
                        'dbid' => $this->_num,
                        'hprocid' => $this->_executionObj->getExecution()['instance'],
                        'type' => $tmpTarget['nodeName'],
                        'execution' => $v['dbid'],
                        'activity_name' => $tmpTarget['name'],
                        'start' => time(),
                        'end'  => 0,
                        'duration' => 0,
                        'transition' => "",
                        'htask' => 0

                    );
                    $this->_execution['insert'][$k]['hisactinst'] = $this->_num;
                    $this->_num = $this->_num + 1;
                }

            }else{
                if($this->_targetNode->getTargetNodeList()['nodeName'] == 'join'){
                    $histActinst['insert'] = array();
                    return $histActinst;
                }else{
                    if($decision = $this->_targetNode->getDecision()){
                        $histActinst['insert'][$this->_num] = array(
                            'dbid' => $this->_num,
                            'hprocid' => $this->_executionObj->getHistprocinst()['dbid'],
                            'type' => $decision['nodeName'],
                            'execution' => current($this->_execution['updata'])['where']['dbid'],
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
                        'hprocid' => $this->_executionObj->getHistprocinst()['dbid'],
                        'type' => $this->_targetNode->getTargetNodeList()['nodeName'],
                        'execution' => current($this->_execution['updata'])['where']['dbid'],
                        'activity_name' => $this->_targetNode->getTargetNodeList()['name'],
                        'start' => time(),
                        'end'  => 0,
                        'duration' => 0,
                        'transition' => "",
                        'htask' => 0

                    );
                    foreach($this->_execution['updata'] as $k => $v){
                        $this->_execution['updata'][$k]['data']['hisactinst'] = $this->_num;
                    }
                    $this->_num = $this->_num + 1;
                }
            }
        }else if($this->_execution['insert']){
            if($this->_targetNode->getClassName() == 'fork'){
                $tmpNum = 0;
                foreach($this->_execution['insert'] as $k => $v){
                    $tmpNum++;
                    if($tmpNum == 1) continue;
                    $tmpTargetNode = $this->_targetNode->getForkTargetNodeList();
                    $tmpTarget = array();
                    foreach($tmpTargetNode as $k1 => $v1){
                        if($v1['name'] == $v['activityname']){
                            $tmpTarget = $v1;
                            break;
                        }
                    }
                    $histActinst['insert'][$this->_num] = array(
                        'dbid' => $this->_num,
                        'hprocid' => current($this->_execution['insert'])['instance'],
                        'type' => $tmpTarget['nodeName'],
                        'execution' => $v['dbid'],
                        'activity_name' => $tmpTarget['name'],
                        'start' => time(),
                        'end'  => 0,
                        'duration' => 0,
                        'transition' => "",
                        'htask' => 0

                    );
                    $this->_execution['insert'][$k]['hisactinst'] = $this->_num;
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
        return $histActinst;
    }

    /**
     * 得到execution
     */
    public function getExecution(){
        return $this->_execution;
    }

    /**
     * 得到task
     */
    public function getTask(){
        return $this->_task;
    }

}
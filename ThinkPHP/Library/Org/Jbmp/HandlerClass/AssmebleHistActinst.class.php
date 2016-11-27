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
     * execution对象
     */
    private $_executionObj = null;

    /**
     * 对象
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
    public function initi($varExecution  ,  $varTargetNode , $varNum,  $execution , $task ){
        $this->_executionObj = $varExecution;
        $this->_targetNode = $varTargetNode;
        $this->_num = $varNum;
        $this->_execution = $execution;
        $this->_task = $task;
        return $this;
    }

    /**
     * 处理
     * @return array
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
     * @return int
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
                'transition' => "to {$this->_targetNode->getInitialTargetNodeList()['name']}",
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
        $histActinst = array();
        if(($this->_targetNode->getClassName() == 'join') && ($this->_targetNode->getHasFinishJoin())){
            $histActinst = $this->_processInsertTargetOfFinishJoin();
        }else if($this->_targetNode->getClassName() == 'fork'){
            $histActinst = $this->_processInsertTargetOfFinishFork();
        }elseif($this->_targetNode->getTargetNodeList()['nodeName'] == 'join'){
            $histActinst = array();
        }else{
            $histActinst = $this->_processInsertTargetOfCommon();
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
     * insert 对象完成join
     * @return obect
     */
    private function _processInsertTargetOfFinishJoin(){
        $ruleName = $this->_executionObj->getRule()['rulename'];
        $tmpHistActinst = array();
        $executionK = 0;
        foreach($this->_execution['updata'] as $k => $v){
            $tmpHistActinst['activity_name'] = $v['data']['activityname'];
            $tmpHistActinst['execution'] = $v['where']['dbid'];
            $executionK = $k;
            break;
        }
        if($this->_targetNode->getInitialTargetNodeList()['translate']['nodeName'] == 'decision'){
            $histActinst[$this->_num] = array(
                'dbid' => $this->_num,
                'hprocid' => $this->_executionObj->getExecution()['instance'],
                'type' => $this->_targetNode->getInitialTargetNodeList()['translate']['nodeName'],
                'execution' => $ruleName.".".$tmpHistActinst['execution'],
                'activity_name' => $this->_targetNode->getInitialTargetNodeList()['translate']['name'],
                'start' => time(),
                'end'  => time(),
                'duration' => 0,
                'transition' => "{$tmpHistActinst['activity_name']}",
                'htask' => 0
            );
            $this->_num =$this->_executionObj->countNum($this->_num);
        }
        $histActinst[$this->_num] = array(
            'dbid' => $this->_num,
            'hprocid' => $this->_executionObj->getExecution()['instance'],
            'type' => $this->_targetNode->getTargetNodeList()['nodeName'],
            'execution' => $ruleName.".".$tmpHistActinst['execution'],
            'activity_name' => $tmpHistActinst['activity_name'],
            'start' => time(),
            'end'  => 0,
            'duration' => 0,
            'transition' => "",
            'htask' => 0
        );
        $this->_execution['updata'][$executionK]['data']['hisactinst'] = $this->_num;
        $this->_num =$this->_executionObj->countNum($this->_num);
        return $histActinst;
    }

    /**
     * insert 对象完成fork
     * @return object
     */
    private function _processInsertTargetOfFinishFork(){
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
            foreach($this->_execution['insert'] as $k1 => $v1){
                $tmpHprocid = $v1['instance'];
                break;
            }
            $histActinst[$this->_num] = array(
                'dbid' => $this->_num,
                'hprocid' => $tmpHprocid,
                'type' => $tmpTarget['nodeName'],
                'execution' => $v['id'],
                'activity_name' => $tmpTarget['name'],
                'start' => time(),
                'end' => 0,
                'duration' => 0,
                'transition' => "",
                'htask' => 0

            );
            $this->_execution['insert'][$k]['hisactinst'] = $this->_num;
            $this->_num =$this->_executionObj->countNum($this->_num);
        }
        return $histActinst;
    }

    /**
     * insert通常
     * @return object
     */
    private function _processInsertTargetOfCommon(){
        $ruleName = $this->_executionObj->getRule()['rulename'];
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
        if($this->_targetNode->getClassName() == 'decision'){
            $histActinst[$this->_num] = array(
                'dbid' => $this->_num,
                'hprocid' => $tmpProcid,
                'type' => 'decision',
                'execution' => $ruleName.".".$tmpExecution,
                'activity_name' => $this->_targetNode->getDecision()['name'],
                'start' => time(),
                'end'  => time(),
                'duration' => 0,
                'transition' => "to {$this->_targetNode->getTargetNodeList()['name']}",
                'htask' => 0

            );
            $this->_num =$this->_executionObj->countNum($this->_num);
            $histActinst[$this->_num] = array(
                'dbid' => $this->_num,
                'hprocid' => $tmpProcid,
                'type' => $this->_targetNode->getTargetNodeList()['nodeName'],
                'execution' => $ruleName.".".$tmpExecution,
                'activity_name' => $this->_targetNode->getTargetNodeList()['name'],
                'start' => time(),
                'end'  => 0,
                'duration' => 0,
                'transition' => "",
                'htask' => 0

            );
        }else{
            $histActinst[$this->_num] = array(
                'dbid' => $this->_num,
                'hprocid' => $tmpProcid,
                'type' => $this->_targetNode->getTargetNodeList()['nodeName'],
                'execution' => $ruleName.".".$tmpExecution,
                'activity_name' => $this->_targetNode->getTargetNodeList()['name'],
                'start' => time(),
                'end'  => 0,
                'duration' => 0,
                'transition' => "",
                'htask' => 0
            );
        }
        if($this->_executionObj->getCurrNode()['nodeName'] == 'start'){
            foreach($this->_execution['insert'] as $k => $v){
                $this->_execution['insert'][$k]['hisactinst'] = $this->_num;
            }
        }else{
            foreach($this->_execution['updata'] as $k => $v){
                $this->_execution['updata'][$k]['data']['hisactinst'] = $this->_num;
            }
        }
        $this->_num =$this->_executionObj->countNum($this->_num);
        return $histActinst;
    }

    /**
     * 得到execution
     * @return object
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


    /**
     * 处理开始备份
     */
    private function _processInsertBak(){
        $ruleName = $this->_executionObj->getRule()['rulename'];
        if(($this->_targetNode->getClassName() == 'join') && ($this->_targetNode->getHasFinishJoin())){
            $tmpHistActinst = array();
            $executionK = 0;
            foreach($this->_execution['updata'] as $k => $v){
                $tmpHistActinst['activity_name'] = $v['data']['activityname'];
                $tmpHistActinst['execution'] = $v['where']['dbid'];
                $executionK = $k;
                break;
            }
            if($this->_targetNode->getInitialTargetNodeList()['translate']['nodeName'] == 'decision'){
                $histActinst[$this->_num] = array(
                    'dbid' => $this->_num,
                    'hprocid' => $this->_executionObj->getExecution()['instance'],
                    'type' => $this->_targetNode->getInitialTargetNodeList()['translate']['nodeName'],
                    'execution' => $ruleName.".".$tmpHistActinst['execution'],
                    'activity_name' => $this->_targetNode->getInitialTargetNodeList()['translate']['name'],
                    'start' => time(),
                    'end'  => time(),
                    'duration' => 0,
                    'transition' => "{$tmpHistActinst['activity_name']}",
                    'htask' => 0
                );
                $this->_num =$this->_executionObj->countNum($this->_num);
            }
            $histActinst[$this->_num] = array(
                'dbid' => $this->_num,
                'hprocid' => $this->_executionObj->getExecution()['instance'],
                'type' => $this->_targetNode->getTargetNodeList()['nodeName'],
                'execution' => $ruleName.".".$tmpHistActinst['execution'],
                'activity_name' => $tmpHistActinst['activity_name'],
                'start' => time(),
                'end'  => 0,
                'duration' => 0,
                'transition' => "",
                'htask' => 0
            );
            $this->_execution['updata'][$executionK]['data']['hisactinst'] = $this->_num;
            $this->_num =$this->_executionObj->countNum($this->_num);

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
                foreach($this->_execution['insert'] as $k1 => $v1){
                    $tmpHprocid = $v1['instance'];
                    break;
                }
                $histActinst[$this->_num] = array(
                    'dbid' => $this->_num,
                    'hprocid' => $tmpHprocid,
                    'type' => $tmpTarget['nodeName'],
                    'execution' => $v['id'],
                    'activity_name' => $tmpTarget['name'],
                    'start' => time(),
                    'end' => 0,
                    'duration' => 0,
                    'transition' => "",
                    'htask' => 0

                );
                $this->_execution['insert'][$k]['hisactinst'] = $this->_num;
                $this->_num =$this->_executionObj->countNum($this->_num);
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
            if($this->_targetNode->getClassName() == 'decision'){
                $histActinst[$this->_num] = array(
                    'dbid' => $this->_num,
                    'hprocid' => $tmpProcid,
                    'type' => 'decision',
                    'execution' => $ruleName.".".$tmpExecution,
                    'activity_name' => $this->_targetNode->getDecision()['name'],
                    'start' => time(),
                    'end'  => time(),
                    'duration' => 0,
                    'transition' => "to {$this->_targetNode->getTargetNodeList()['name']}",
                    'htask' => 0

                );
                $this->_num =$this->_executionObj->countNum($this->_num);
                $histActinst[$this->_num] = array(
                    'dbid' => $this->_num,
                    'hprocid' => $tmpProcid,
                    'type' => $this->_targetNode->getTargetNodeList()['nodeName'],
                    'execution' => $ruleName.".".$tmpExecution,
                    'activity_name' => $this->_targetNode->getTargetNodeList()['name'],
                    'start' => time(),
                    'end'  => 0,
                    'duration' => 0,
                    'transition' => "",
                    'htask' => 0

                );
            }else{
                $histActinst[$this->_num] = array(
                    'dbid' => $this->_num,
                    'hprocid' => $tmpProcid,
                    'type' => $this->_targetNode->getTargetNodeList()['nodeName'],
                    'execution' => $ruleName.".".$tmpExecution,
                    'activity_name' => $this->_targetNode->getTargetNodeList()['name'],
                    'start' => time(),
                    'end'  => 0,
                    'duration' => 0,
                    'transition' => "",
                    'htask' => 0
                );
            }
            if($this->_executionObj->getCurrNode()['nodeName'] == 'start'){
                foreach($this->_execution['insert'] as $k => $v){
                    $this->_execution['insert'][$k]['hisactinst'] = $this->_num;
                }
            }else{
                foreach($this->_execution['updata'] as $k => $v){
                    $this->_execution['updata'][$k]['data']['hisactinst'] = $this->_num;
                }
            }
            $this->_num =$this->_executionObj->countNum($this->_num);
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


}
<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/19
 * Time: 21:41
 */
namespace Org\Jbmp\HandlerClass;
class AssmebleExecution
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
    public function initi($varExecution  ,  $varTargetNode , $varNum,  $varVars = array()){
        $this->_executionObj = $varExecution;
        $this->_targetNode = $varTargetNode;
        $this->_num = $varNum;
        $varVars && $this->_varsList = $varVars;
        return $this;
    }

    /**
     *
     */
    public function process(){
        $currNode  =  $this->_executionObj->getCurrNode();
        $execution = array();
        if($currNode['nodeName'] == 'start'){
            $execution['insert'] = $this->_processInsert();
        }else{
            if($tmp = $this->_processDel()){
                $execution['del'] = $tmp;
            }
            if($this->_targetNode->getTargetNodeList()['nodeName'] != 'end'){
                if($tmp = $this->_processUpdata()){
                    $execution['updata'] = $tmp;
                }
                if($tmp = $this->_processInsert($execution)){
                    $execution['insert'] = $tmp;
                }
            }
        }
        return $execution;
    }

    /**
     * 删除
     */
    private function _processDel(){
        $executionDel = array();
        if($this->_targetNode->getClassName() == 'join'){
            if($this->_targetNode->getHasFinishJoin()){
                $data = $this->_targetNode->getJoinExecution();
                $data['inActive'];
                $data['subActiveFork'];
                if($data['inActive']){
                    foreach($data['inActive'] as $k => $v){
                        $executionDel[$v['dbid']] = $v['dbid'];
                    }
                }
                if($data['subActiveFork']){
                    foreach($data['subActiveFork'] as $k => $v){
                        $executionDel[$v['dbid']] = $v['dbid'];
                    }
                }
                if($this->_targetNode->getTargetNodeList()['nodeName'] == 'end' ){
                    $executionDel[$data['pActive']['dbid']] = $data['pActive']['dbid'];
                }
            }
        }elseif($this->_targetNode->getTargetNodeList()['nodeName'] == 'end'){
            $executionDel[$this->_executionObj->getExecution()['dbid']] = $this->_executionObj->getExecution()['dbid'];
        }else{
            $executionDel = array();
        }

        return $executionDel;
    }


    /**
     * 处理其他
     */
    private function _processUpdata(){
        $execution = array();
        if(($this->_targetNode->getClassName() == 'join') && $this->_targetNode->getHasFinishJoin()){
            $data = $this->_targetNode->getJoinExecution()['pActive'];
            $where = $data['dbid'];
            $upData = array(
                'activityname' => $this->_targetNode->getTargetNodeList()['name'],
                'state' => 'active-root'
            );
        }else{
            $execution = $this->_executionObj->getExecution();
            $where = array();
            $where['dbid'] = $execution['dbid'];
            $targetNodeList = $this->_targetNode->getTargetNodeList();
            if($targetNodeList['nodeName'] == 'join'){
                $upData = array(
                    'activityname' => $targetNodeList['name'],
                    'state' => 'inactive-join'
                );
            }elseif($targetNodeList['nodeName'] == 'fork'){
                $upData = array(
                    'activityname' => $targetNodeList['name'],
                    'hisactinst' => 0,
                    'state' => 'inactive-concurrent-root'
                );
            }else{
                $upData = array(
                    'activityname' => $targetNodeList['name'],
                    'hisactinst' => 0
                );
            }
        }
        $tmpExecution= array(
            $where['dbid'] =>
                array(
                    'where'=>$where,
                    'data'=>$upData
                )
        );
        return $tmpExecution;
    }

    /**
     * 得到num
     */
    public function getNum(){
        return $this->_num;
    }

    /**
     * 处理开始
     */
    private function _processInsert($varExecution){
        $hasVars  =  $this->_varsList ? 1 :  0;
        $execution = array();
        if($this->_targetNode->getTargetNodeList()['nodeName'] == 'fork'){
            if($this->_executionObj->getCurrNode()['nodeName'] == 'start'){
                $execution[$this->_num] = array(
                    'dbid' => $this->_num,
                    'activityname'  => '',
                    'procdefid' => $this->_executionObj->getRule()['rulename'],
                    'hasvars' => $hasVars,
                    'key' => '',
                    'id' => "{$this->_executionObj->getRule()['rulename']}.{$this->_num}",
                    'state' => 'inactive-concurrent-root',
                    'priority' => 0,
                    'hisactinst' => 0,
                    'parent' => 0,
                    'parentidx' => 0,
                    'instance' => $this->_num
                );
                $this->_num =$this->_num + 1;
            }
            if($this->_executionObj->getCurrNode()['nodeName'] == 'start'){
                foreach($execution as $k => $v){
                    $tmpExecution = array();
                    $tmpExecution['mainid'] = $v['id'];
                    $tmpExecution['parent'] = $v['dbid'];
                    $tmpExecution['instance'] = $v['dbid'];
                    break;
                }
            }else{
                foreach($varExecution['updata'] as $k => $v){
                    $tmpExecution = array();
                    $tmpExecution['mainid'] = ['where']['dbid'];
                    $tmpExecution['parent'] = ['where']['dbid'];
                    $tmpExecution['instance'] = ['where']['dbid'];
                    break;
                }
            }
            foreach($this->_targetNode->getForkTargetNodeList() as $k => $v){
                $execution[$this->_num] = array(
                    'dbid' => $this->_num,
                    'activityname'  => $v['name'],
                    'procdefid' => $this->_executionObj->getRule()['rulename'],
                    'hasvars' => $hasVars,
                    'key' => '',
                    'id' => "{$tmpExecution['mainid']}.to {$v['name']}.{$this->_num}",
                    'state' => 'active-concurrent',
                    'priority' => 0,
                    'hisactinst' => 0,
                    'parent' => $tmpExecution['parent'],
                    'parentidx' => 0,
                    'instance' => $tmpExecution['instance']
                );
                $this->_num =$this->_num + 1;
            }
        }elseif($this->_executionObj->getCurrNode()['nodeName'] == 'start'){
            $execution[$this->_num] =  array(
                'dbid' => $this->_num,
                'activityname'  => $this->_targetNode->getTargetNodeList()['name'],
                'procdefid' => $this->_executionObj->getRule()['rulename'],
                'hasvars' => $hasVars,
                'key' => '',
                'id' => "{$this->_executionObj->getRule()['rulename']}.{$this->_num}",
                'state' => 'active-root',
                'priority' => 0,
                'hisactinst' => 0,
                'parent' => 0,
                'parentidx' => 0,
                'instance' => $this->_num
            );
            $this->_num =$this->_num + 1;
        }else{
            return array();
        }


        return $execution;
    }

}
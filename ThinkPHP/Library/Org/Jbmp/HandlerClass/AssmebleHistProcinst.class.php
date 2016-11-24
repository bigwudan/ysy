<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/19
 * Time: 22:14
 */

namespace Org\Jbmp\HandlerClass;


class AssmebleHistProcinst
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
     * 初始化
     */
    public function initi($varExecution  ,  $varTargetNode , $varNum,  $execution ){
        $this->_executionObj = $varExecution;
        $this->_targetNode = $varTargetNode;
        $this->_num = $varNum;
        $this->_execution = $execution;
        return $this;
    }

    /**
     *
     */
    public function process(){
        $currNode  =  $this->_executionObj->getCurrNode();
        if($currNode['nodeName'] == 'start'){
            $histProcinst['insert'] = $this->_processInsert();
        }elseif($this->_targetNode->getTargetNodeList()['nodeName'] == 'end') {
            $histProcinst['updata'] = $this->_processUpdata();
        }else{
            $histProcinst = array();
        }
        return $histProcinst;
    }


    /**
     * 得到num
     */
    public function getNum(){
        return $this->_num;
    }

    /**
     * 更新
     */
    private function _processUpdata(){
        $data = $this->_executionObj->getExecution();
        $upData = array(
            'state' => 'ended',
            'end' => time(),
            'duration' => time() - $this->_executionObj->getHistProcinst()['start'],
            'endactivity' => $this->_targetNode->getTargetNodeList()['name']
        );
        $where['dbid'] = $data['instance'];
        $histProcinst[$data['instance']] = array(
            'where'=>$where,
            'data'=>$upData
        );
        return $histProcinst;
    }

    /**
     * 处理开始
     */
    private function _processInsert(){
        $tmp = array();
        foreach($this->_execution['insert'] as $k => $v){
            $tmp = $v;
            break;
        }
        if($tmp){
            $histProcinst[$tmp['dbid']] = array(
                'dbid' => $tmp['dbid'],
                'id' => $tmp['id'],
                'procdefid' => $this->_executionObj->getRule()['rulename'],
                'key' => '',
                'start' => time(),
                'end' => 0,
                'duration' =>0,
                'state' => 'active',
                'endactivity' => ''

            );
        }
        return $histProcinst;
    }

}
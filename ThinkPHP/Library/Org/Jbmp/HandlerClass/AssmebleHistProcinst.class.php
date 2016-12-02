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
     * executionobj对象
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
     * 初始化
     * @param $varExecution object 对象execution
     * @param $varTargetNode object 对象targetNode
     * @param $varNum int 累加数
     * @param $execution array executin数组
     * @return array
     */
    public function initi($varExecution  ,  $varTargetNode , $varNum,  $execution ){
        $this->_executionObj = $varExecution;
        $this->_targetNode = $varTargetNode;
        $this->_num = $varNum;
        $this->_execution = $execution;
        return $this;
    }

    /**
     * 执行
     * @return array
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
     * @return int
     */
    public function getNum(){
        return $this->_num;
    }

    /**
     * 更新
     * @return array
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
     * @return array
     */
    private function _processInsert(){
        $tmp = array();
        $tmp = reset($this->_execution['insert']);
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
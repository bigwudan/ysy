<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/20
 * Time: 15:39
 */

namespace Org\Jbmp\HandlerClass;


class AssmebleVariable
{
    /**
     * 参数数组
     */
    private $_varsList = null;

    /**
     * execution对象
     */
    private $_executionObj = null;

    /**
     * target对象
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
     * @param $varExecutionObj object 对象execution
     * @param $varTargetNode object 对象targetNode
     * @param $varNum int 累加数
     * @param $varVars array 参数
     * @param $varExecution array 参数
     * @return array
     */
    public function initi($varExecutionObj  ,  $varTargetNode , $varNum,  $varVars = array() , $varExecution){
        $this->_executionObj = $varExecutionObj;
        $this->_targetNode = $varTargetNode;
        $this->_execution = $varExecution;
        $this->_num = $varNum;
        $varVars && $this->_varsList = $varVars;
        return $this;
    }

    /**
     * 执行
     * @return array
     */
    public function process(){
        if($this->_execution['del']){
            $variable['del'] = $this->_processDel();
        }else{
            $variable['insert'] = $this->_processInsert();
        }
        return $variable;
    }

    /**
     * 删除
     * @return array
     */
    private function _processDel(){
        $variable= $this->_execution['del'];
        return $variable;
    }

    /**
     * 更新
     * @return array
     */
    private function _processInsert(){
        $tmpDbid = 0;
        if($this->_executionObj->getCurrNode()['nodeName'] == 'start'){
            $tmpDbid = reset($this->_execution['insert'])['dbid'];
        }else{
            $tmpDbid = reset($this->_execution['updata'])['where']['dbid'];
        }
        foreach($this->_varsList as $k => $v){
            $modelList = array(
                'dbid' => 0,
                'class' => '',
                'key' => '',
                'execution' => 0,
                'double_value' => 0,
                'int_value' => 0,
                'string_value' => '',
                'text_value' => '',
                'addtime' => time()
            );
            $modelList['dbid'] = $this->_num;
            $modelList['class'] =$v['class'];
            $modelList['key'] = $v['key'];
            $modelList['execution'] =$tmpDbid;
            $modelList[$v['class'].'_value'] = $v['value'];
            $variable[$this->_num] = $modelList;
            $this->_num =$this->_executionObj->countNum($this->_num);
        }
        return $variable;
    }

    /**
     * 得到num
     * @return int
     */
    public function getNum(){
        return $this->_num;
    }

}
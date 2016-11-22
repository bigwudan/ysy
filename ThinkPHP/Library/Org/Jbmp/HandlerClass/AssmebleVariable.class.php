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
     *
     */
    private $_variable = null;

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
     */
    public function initi($varExecution  ,  $varTargetNode , $varNum,  $varVars = array() , $varExecution){
        $this->_executionObj = $varExecution;
        $this->_targetNode = $varTargetNode;
        $this->_execution = $varExecution;
        $this->_num = $varNum;
        $varVars && $this->_varsList = $varVars;
        return $this;
    }

    /**
     *
     */
    public function process(){
        if($this->_targetNode->getTargetNodeList()['nodeName'] == 'end'){
            $variable = $this->_processDel();
        }else{
            $variable = $this->_processInsert();
        }
        return $variable;
    }

    /**
     * 删除
     */
    private function _processDel(){
        $variable['del'] = $this->_execution['del'];
        return $variable;
    }
    /**
     * 更新
     */
    private function _processInsert(){
        $tmpDbid = current($this->_execution['insert'])['dbid'] ? current($this->_execution['insert'])['dbid'] : current($this->_execution['updata'])['where']['dbid'] ;
        for($num = 0 ; $num < 2 ; $num++){
            $variable['insert'][$this->_num] = array(
                'dbid' => $this->_num,
                'class' => 'string',
                'key' => 'username',
                'execution' => $tmpDbid,
                'string_value' => 'wudan'.$num
            );
            $this->_num = $this->_num +1;
        }
        return $variable;
    }

    /**
     * 得到num
     */
    public function getNum(){
        return $this->_num;
    }

}
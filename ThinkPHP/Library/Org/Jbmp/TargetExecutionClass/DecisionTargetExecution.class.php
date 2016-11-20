<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/15
 * Time: 22:35
 */

namespace Org\Jbmp\TargetExecutionClass;


class DecisionTargetExecution extends \Org\Jbmp\TargetExecutionClass\CommonTargetExecutionClass
{
    /**
     * 执行命令
     */
    public function process(){
        $this->_decision = $this->_targetNodeList;
        $target = $this->_dealhandler();
        $this->_translate($target);
    }

    /**
     * 执行handler程序
     */
    private function _dealhandler(){
        if($this->_targetNodeList['handler']){
            $className = $this->_targetNodeList['handler'];
            $testClass = new $className();
            $toName = $testClass->decide($this->_executionObj);
        }
        foreach($this->_targetNodeList['transitionList']  as $k => $v){
            if($v['name'] === $toName){
                $transitionList = $v['to'];
                break;
            }
        }
        return $transitionList;
    }

    /**
     * 执行跳转
     * @param $varData 数据
     */
    private function _translate($varData){
        $xmlObj = $this->_executionObj->getXmlObj();
        $XmlEngine = new \Org\Jbmp\ProcessFunction\XmlEngine();
        $res = $XmlEngine->getActionXml( $xmlObj , $varData);
        $this->_commonTarget($res);
        $res['nodeName'] == 'task' && $this->_taskTarget($res);
    }

    /**
     * 通常的处理
     * @param $varData 数据
     */
    private function _commonTarget($varData){
        $this->_targetNodeList = $varData;
    }

    /**
     * 处理task
     * @param $varData 数据
     */
    private function _taskTarget($varData){
        $TaskObj = new \Org\Jbmp\TargetExecutionClass\TaskTargetExecutionClass();
        $this->_candidate = $TaskObj->processCandidate($varData);
    }


}
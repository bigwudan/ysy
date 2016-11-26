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
     * 类名称
     */
    private $_className = 'decision';

    /**
     * 需要executionVar
     */
    private $_variableExecution = null;

    /**
     * variable
     */
    private $_variable = null;

    /**
     * 获得类名
     */
    public function getClassName(){
        return $this->_className;
    }
    /**
     * 执行命令
     */
    public function process(){
        $this->_decision = $this->_targetNodeList;
        $target = $this->_dealhandler();
        $this->_translate($target);
    }

    /**
     * 得到variableExecution
     */
    public function getVariableExecution(){
        return $this->_variableExecution;
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

        if($toName['variable']){
            $this->_variable = $this->_assembleVariable($toName['variable']);
            $this->_variableExecution = $toName['variable'];
        }

        foreach($this->_targetNodeList['transitionList']  as $k => $v){
            if($v['name'] === $toName['target']){
                $transitionList = $v['to'];
                break;
            }
        }
        if(!$transitionList) die('no decision');
        return $transitionList;
    }

    /**
     * 组合variable
     */
    private function _assembleVariable($varVariable){
        $variable = $this->_executionObj->getVariable();
        $newList = array();
        foreach($varVariable as $k => $v){
            $flag = 0;
            foreach($variable as $k1 => $v1){
                if($v['key'] == $v1['key']){
                    $flag = 1;
                    break;
                }
            }
            $flag == 0 && array_push($newList , $v);
        }
        $variable = array_merge($variable , $newList);
        return $variable;
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
        $this->_candidate = $TaskObj->processCandidate($varData , $this->_variable);
    }


}
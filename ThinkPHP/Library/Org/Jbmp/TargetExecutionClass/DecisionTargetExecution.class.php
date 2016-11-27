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
        $result = $this->dealhandler($this->_targetNodeList , $this->_executionObj);
        $this->_variable = $result['variable'];
        $this->_variableExecution = $result['variableExecution'];
        $transalteList = $this->translate($result['transitionList'] , $this->_executionObj , $this->_variable);
        $this->_targetNodeList = $transalteList['targetNodeList'];
        $transalteList['candidate'] && $this->_candidate = $transalteList['candidate'];
    }

    /**
     * 得到variableExecution
     * @return array
     */
    public function getVariableExecution(){
        return $this->_variableExecution;
    }


    /**
     * 执行handler程序
     * @param $varTargetNodeList array 数据
     * @param $varExecutionObj object 对象
     * @return array
     */
    public function dealhandler($varTargetNodeList , $varExecutionObj){
        if($varTargetNodeList['handler']){
            $className = $varTargetNodeList['handler'];
            $testClass = new $className();
            $toName = $testClass->decide($varExecutionObj);
        }
        $result = array();
        if($toName['variable']){
            $result['variable'] = $this->_assembleVariable($toName['variable'] , $varExecutionObj);
            $result['variableExecution'] = $toName['variable'];
        }
        foreach($varTargetNodeList['transitionList']  as $k => $v){
            if($v['name'] === $toName['target']){
                $transitionList = $v['to'];
                break;
            }
        }
        $result['transitionList'] = $transitionList;
        if(!$transitionList) die('no decision');
        return $result;
    }

    /**
     * 组合variable
     * @param $varVariable array 参数
     * @param $varExecutionObj object 对象
     * @return array
     */
    private function _assembleVariable($varVariable , $varExecutionObj){
        $variable = $varExecutionObj->getVariable();
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
     * @param $varExecutionObj string 数据
     * @return array
     */
    public function translate($varData , $varExecutionObj , $varVariable = null){
        $xmlObj = $varExecutionObj->getXmlObj();
        $XmlEngine = new \Org\Jbmp\ProcessFunction\XmlEngine();
        $res = $XmlEngine->getActionXml( $xmlObj , $varData);
        $result['targetNodeList'] = $this->_commonTarget($res);
        if($res['nodeName'] == 'task'){
            $result['candidate'] = $this->_taskTarget($res , $varVariable);
        }
        return $result;
    }

    /**
     * 通常的处理
     * @param $varData 数据
     * @return array
     */
    private function _commonTarget($varData){
        return $varData;
    }

    /**
     * 处理task
     * @param $varData 数据
     * @param $varVariable 数据
     * @return array
     */
    private function _taskTarget($varData , $varVariable){
        $TaskObj = new \Org\Jbmp\TargetExecutionClass\TaskTargetExecutionClass();
        return $TaskObj->processCandidate($varData , $varVariable);
    }


}
<?php
namespace Vendor\Jbpm\Translate;
/**
 * wudan 吴丹 创建于 2016-11-29 17:42:47
TranslateFactory
 */
class TranslateFactory{
    /**

     * execuiton对象

     */

    private $_executionObj= null;



    /**

     * 转换参数

     */

    private $_transition =  null;



    /**
     * 初始化
     * @param $varExecutionObj execution
     * @param $varTransition 转换参数
     */

    public function initi($varExecutionObj , $varTransition = null){
        $this->_executionObj = $varExecutionObj;
        $this->_transition = $varTransition;
    }



    /**
     * 转换
     * @return object
     */

    public function translate(){
        $target = $this->_begTranslate();
        if(!$target){
            return false;
        }
        return $this->_assignTargetClass($target);
    }



    /**

     * 开始

     * @return array

     */

    private function _begTranslate(){
        $currNode =  $this->_executionObj->getCurrNode();
        $target =  null;
        if($this->_transition){
            $flag = 0;
            foreach($currNode['transitionList'] as $k => $v){
                if($v['name'] == $this->_transition){
                    $target = $v['to'];
                    $flag = 1;
                    break;
                }
            }
            if(!$flag) die('no to');
        }else{
            $target = $currNode['transitionList'][0]['to'];
        }
        $XmlObj  =  new \Vendor\Jbpm\Processfunction\XmlEngine();
        $targetNodeList = $XmlObj->getActionXml( $this->_executionObj->getXmlObj() ,  $target);
        return $targetNodeList;
    }



    /**
     * 分配对象
     * @param $varTargetNodeList 对象
     * @return object
     */

    private function _assignTargetClass($varTargetNodeList){
        if($varTargetNodeList['nodeName'] == 'task'){
            $obj =  new \Vendor\Jbpm\Targetexecutionclass\TaskTargetExecutionClass();
            $obj->initi($this->_executionObj ,  $varTargetNodeList);
            if(!$obj->process()) return false;
        }elseif($varTargetNodeList['nodeName'] == 'decision'){
            $obj =  new \Vendor\Jbpm\Targetexecutionclass\DecisionTargetExecution();
            $obj->initi($this->_executionObj ,  $varTargetNodeList);
            if(!$obj->process()) return false;
        }elseif($varTargetNodeList['nodeName'] == 'fork'){
            $obj =  new \Vendor\Jbpm\Targetexecutionclass\ForkTargetExecution();
            $obj->initi($this->_executionObj ,  $varTargetNodeList);
            if(!$obj->process()) return false;
        }elseif($varTargetNodeList['nodeName'] == 'join'){
            $obj = new \Vendor\Jbpm\Targetexecutionclass\JoinTargetExecution();
            $obj->initi($this->_executionObj ,  $varTargetNodeList);
            if(!$obj->process()) return false;
        }else{
            $obj =  new \Vendor\Jbpm\Targetexecutionclass\StateTargetExecutinClass();
            $obj->initi($this->_executionObj ,  $varTargetNodeList);
        }
        return $obj;
    }

}
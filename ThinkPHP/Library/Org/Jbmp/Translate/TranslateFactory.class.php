<?php
namespace Org\Jbmp\Translate;
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2016/11/15
 * Time: 10:50
 */

class TranslateFactory {

    private $_executionObj= null;

    private $_transition =  null;

    /**
     * @param $varExecutionObj
     * @param $varTransition
     */
    public function initi($varExecutionObj , $varTransition = null){
        $this->_executionObj = $varExecutionObj;
        $this->_transition = $varTransition;

    }

    /**
     */

    public function translate(){
        $target = $this->_begTranslate();
        return $this->_assignTargetClass($target);
    }

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
        $XmlObj  =  new \Org\Jbmp\ProcessFunction\XmlEngine();
        $targetNodeList = $XmlObj->getActionXml( $this->_executionObj->getXmlObj() ,  $target);
        return $targetNodeList;
    }

    private function _assignTargetClass($varTargetNodeList){
        if($varTargetNodeList['nodeName'] == 'task'){
            $obj =  new \Org\Jbmp\TargetExecutionClass\TaskTargetExecutionClass();
            $obj->initi($this->_executionObj ,  $varTargetNodeList);
            $obj->process();
        }elseif($varTargetNodeList['nodeName'] == 'decision'){
            $obj =  new \Org\Jbmp\TargetExecutionClass\DecisionTargetExecution();
            $obj->initi($this->_executionObj ,  $varTargetNodeList);
            $obj->process();
        }elseif($varTargetNodeList['nodeName'] == 'fork'){
            $obj =  new \Org\Jbmp\TargetExecutionClass\ForkTargetExecution();
            $obj->initi($this->_executionObj ,  $varTargetNodeList);
            $obj->process();
        }elseif($varTargetNodeList['nodeName'] == 'join'){
            $obj = new \Org\Jbmp\TargetExecutionClass\JoinTargetExecution();
            $obj->initi($this->_executionObj ,  $varTargetNodeList);
            $obj->process();
        }else{
            $obj =  new \Org\Jbmp\TargetExecutionClass\StateTargetExecutinClass();
            $obj->initi($this->_executionObj ,  $varTargetNodeList);
        }
        return $obj;
    }


}
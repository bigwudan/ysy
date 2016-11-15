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
     *
     */
    public function initi($varExecutionObj , $varTransition = null){
        $this->_executionObj = $varExecutionObj;
        $this->_transition = $varTransition;

    }

    /**
     * @param $varExecutionObj
     * @param null $varTransition
     */

    public function translate(){
        $target = $this->_begTranslate();
        return $this->_assignTargetClass($target);
    }

    private function _begTranslate(){
        $currNode =  $this->_executionObj->getCurrNode();
        $target =  null;
        if($this->_transition){
            foreach($currNode['transitionList'] as $k => $v){
                if($v['name'] == $this->_transition){
                    $target = $v['to'];
                    break;
                }
            }
        }else{
            $target = $currNode['transitionList'][0];
        }
        $XmlObj  =  new \Org\Jbmp\ProcessFunction\XmlEngine();
        $targetNodeList = $XmlObj->getActionXml( $this->_executionObj->getXmlObj() ,  $target['to']);
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
        }else{
            $obj =  new \Org\Jbmp\TargetExecutionClass\StateTargetExecutinClass();
            $obj->initi($this->_executionObj ,  $varTargetNodeList);
        }
        return $obj;
    }


}
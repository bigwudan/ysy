<?php
namespace Vendor\Jbpm\Targetexecutionclass;
/**
 * wudan 吴丹 创建于 2016-11-29 17:39:52
DecisionTargetExecution
 */
class DecisionTargetExecution extends \epet\hr\workuserflower\targetexecutionclass\CommonTargetExecutionClass{
    /**

     * 类名称

     */

    private $_className = 'decision';


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
        if(!$result){
            return false;
        }
        $result['vars'] && $this->_executionObj->setRunVars($result['vars']);
        $transalteList = $this->translate($result['transitionList'] , $this->_executionObj);
        if(!$transalteList){
            return false;
        }
        $this->_targetNodeList = $transalteList['targetNodeList'];
        $transalteList['candidate'] && $this->_candidate = $transalteList['candidate'];
        return true;
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
            $decideClass = new $className();
            if(!$decideClass) return false;
            $toName = $decideClass->decide($varExecutionObj);
            if(!$toName) return false;
        }else{
            return false;
        }
        $result = array();
        if($toName['variable']){
            $result['vars'] = $toName['variable'];
        }
        foreach($varTargetNodeList['transitionList']  as $k => $v){
            if($v['name'] === $toName['target']){
                $transitionList = $v['to'];
                break;
            }
        }
        $result['transitionList'] = $transitionList;
        if(!$transitionList) return false;
        return $result;
    }



//    /**
//
//     * 组合variable
//
//     * @param $varVariable array 参数
//
//     * @param $varExecutionObj object 对象
//
//     * @return array
//
//     */
//
//    private function _assembleVariable($varVariable , $varExecutionObj){
//        $variable = $varExecutionObj->getVariable();
//        $newList = array();
//        foreach($varVariable as $k => $v){
//            $flag = 0;
//            foreach($variable as $k1 => $v1){
//                if($v['key'] == $v1['key']){
//                    $flag = 1;
//                    break;
//                }
//            }
//            $flag == 0 && array_push($newList , $v);
//
//        }
//        $variable = array_merge($variable , $newList);
//        return $variable;
//
//    }



    /**

     * 执行跳转

     * @param $varData 数据

     * @param $varExecutionObj string 数据

     * @param $varVariable string 数据

     * @return array

     */

    public function translate($varData , $varExecutionObj){
        $xmlObj = $varExecutionObj->getXmlObj();
        $XmlEngine = new \epet\hr\workuserflower\processfunction\XmlEngine();
        $res = $XmlEngine->getActionXml( $xmlObj , $varData);
        if(!$res) return false;
        $result['targetNodeList'] = $this->_commonTarget($res);
        if($res['nodeName'] == 'task'){
            $result['candidate'] = $this->_taskTarget($res , $varExecutionObj);
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

     * @param $varExecutionObj 数据

     * @return array

     */

    private function _taskTarget($varData , $varExecutionObj){
        $TaskObj = new \epet\hr\workuserflower\targetexecutionclass\TaskTargetExecutionClass();
        return $TaskObj->processCandidate($varData , $varExecutionObj);
    }

}
<?php
namespace Vendor\Jbpm\Targetexecutionclass;
/**
 * wudan 吴丹 创建于 2016-11-29 17:40:47
ForkTargetExecution
 */
class ForkTargetExecution extends \epet\hr\workuserflower\targetexecutionclass\CommonTargetExecutionClass{
    /**

     * fork

     */

    private $_forkTargetNodeList = array();



    /**

     * 类名称

     */

    private $_className = 'fork';



    /**

     * 获得类名

     */

    public function getClassName(){

        return $this->_className;

    }



    /**

     * 设置

     */

    public function setForkTargetNodeList($varData){

        $this->_forkTargetNodeList = $varData;

    }



    /**

     * 获得

     */

    public function getForkTargetNodeList(){

        return $this->_forkTargetNodeList;

    }





    /**

     * 执行命令

     */

    public function process(){

        $this->_dealhandler();

    }



    /**

     * 执行handler程序

     */

    private function _dealhandler(){

        $transitionList = $this->_targetNodeList['transitionList'];

        foreach($transitionList as $k => $v){

            $transition[] = $this->_translate($v['to']);

        }

        $this->_forkTargetNodeList = $transition;

    }



    /**

     * 跳转

     * @param $varDataName string

     * @return array

     */

    private function _translate($varDataName){
        $xmlObj = $this->_executionObj->getXmlObj();
        $XmlEngine = new \epet\hr\workuserflower\processfunction\XmlEngine();
        $res = $XmlEngine->getActionXml( $xmlObj , $varDataName);
        if($res['nodeName'] == 'task'){
            $res['candidate'] = $this->_taskTarget($res);
        }else if($res['nodeName'] == 'decision'){
            $DecisionObj = new \epet\hr\workuserflower\targetexecutionclass\DecisionTargetExecution();
            $DescisionResult = $DecisionObj->dealhandler($res , $this->_executionObj);
            $transalteList = $DecisionObj->translate($DescisionResult['transitionList'] , $this->_executionObj , $DescisionResult['variable']);
            $tranList = $transalteList['targetNodeList'];
            if(!empty($transalteList['candidate'])){
                $tranList['candidate'] = $transalteList['candidate'];
            }
            $tranList['beforeTransalet'] = $res;
            $res = $tranList;
        }
        return $res;
    }



    /**

     * 处理task

     */

    private function _taskTarget($varData){
        $TaskObj = new \epet\hr\workuserflower\targetexecutionclass\TaskTargetExecutionClass();
        return $TaskObj->processCandidate($varData , $this->_beforeAssembleVariable);
    }

}
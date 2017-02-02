<?php
namespace Vendor\Jbpm\Targetexecutionclass;
/**
 * wudan 吴丹 创建于 2016-11-29 17:39:32
CommonTargetExecutionClass
 */
class CommonTargetExecutionClass{
    /**

     * xml对象

     */

    protected $_executionObj = null;



    /**

     * transition

     */

    protected $_targetNodeList  =  null;



    /**

     * 候选对象

     */

    protected $_candidate = null;



    /**

     * 得到数据

     */

    protected $_decision = null;



    /**

     * 得到组合后的参数数据

     */

    protected $_beforeAssembleVariable = null;

    /**

     * 需要executionVar

     */

    protected $_variableExecution = null;



    /**

     * variable

     */

    protected $_variable = null;



    /**

     * @param $varExecutionObj

     * @param null $varTargetNodeList

     */



    public function initi( $varExecutionObj , $varTargetNodeList = null ){
        $this->_executionObj =  $varExecutionObj;
        $this->_targetNodeList =  $varTargetNodeList;

    }



    /**

     * 执行

     */

    public function process(){



    }



    /**

     * 设置

     * @param $varDecision

     */

    public function setDecision($varDecision){

        $this->_decision = $varDecision;

    }



    /**

     * 得到decision

     * @return null

     */

    public function getDecision(){

        return $this->_decision;

    }



    /**

     * 得到targetNodelist

     * @return null

     */

    public function getTargetNodeList(){

        return $this->_targetNodeList;

    }



    /**

     * 设置candidate

     * @param $varCandidate 设置candidate

     */

    protected function _setCandidate($varCandidate){

        $this->_candidate = $varCandidate;

    }



    /**

     * 得到candidate

     * @return null

     */

    public function getCandidate(){

        return $this->_candidate;

    }

    /**
     * 得到executionVar
     * @return array;
     */
    public function getExecutionVar(){
        return $this->_variableExecution;
    }

    /**
     * 得到variable
     * @return array;
     */
    public function getVariable(){
        return $this->_variable;
    }

}
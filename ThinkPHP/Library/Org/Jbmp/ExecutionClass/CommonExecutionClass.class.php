<?php
namespace Org\Jbmp\ExecutionClass;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/14
 * Time: 21:50
 */
class CommonExecutionClass
{
    /**
     * 规则
     */
    protected $_rule = array();

    /**
     * $property
     */
    protected $_property = array();

    /**
     * xmlRuleObj
     */
    protected $_xmlRuleObj = array();

    /**
     * 得到当前的位置
     */
    protected $_currNode = array();

    /**
     * executin
     */
    protected $_executin = array();

    /**
     * 得到histactinst
     */
    protected $_histActinst = array();

    /**
     * 得到$histProcinst
     */
    protected $_histProcinst = array();

    /**
     *
     */
    protected $_histTask = array();

    /**
     *
     */
    protected $_variable = array();

    /**
     * 设置rule
     * @param $varRule
     */
    public function setRule($varRule){
        $this->_rule = $varRule;
    }

    /**
     * 得到rule
     */
    public function getRule(){
        return $this->_rule;
    }

    /**
     * 设置property
     * @param $varProperty 设置
     */
    public function setProperty($varProperty){
        $this->_property = $varProperty;
    }

    /**
     * 得到
     */
    public function getProperty(){
        return $this->_property;
    }

    /**
     * 设置xml对象
     * @param $varXmlObj 数据
     */
    public function setXmlObj($varXmlObj){
        $this->_xmlRuleObj = $varXmlObj;
        $this->setNode();
    }

    /**
     * 得到xml对象
     */
    public function getXmlObj(){
        return $this->_xmlRuleObj;
    }

    /**
     * 得到当前的node
     */
    public function setNode(){
        $obj =  new \Org\Jbmp\ProcessFunction\XmlEngine();
        (!$this->_execution) && ($this->_execution['activityname'] = null);
        $res =  $obj->getActionXml($this->_xmlRuleObj , $this->_execution['activityname']);
        $this->_currNode = $res;
    }

    /**
     * 得到node
     */
    public function getCurrNode(){
        return $this->_currNode;
    }

    /**
     * 设置execution
     */
    public function setExecution($varExecution){
        $this->_execution = $varExecution;
    }

    /**
     *  得到execution
     */
    public function getExecution(){
        return $this->_execution;
    }

    /**
     * histactinst
     */
    public function setHistActinst($varHistActinst){
        return $this->_histActinst = $varHistActinst;
    }

    /**
     * 得到$varHistactinst
     */
    public function getHistActinst(){
        return $this->_histActinst;
    }

    /**
     * set$histProcinst
     */
    public function setHistProcinst($varHistProcinst){
        $this->_histProcinst = $varHistProcinst;
    }

    /**
     * 得到$varHistProcinst
     */
    public function getHistProcinst(){
        return $this->_histProcinst;
    }

    /**
     * 设置参数
     */
    public function setVariable($varVariable){
        $this->_variable =$varVariable;
    }

    /**
     * 得到
     */
    public function getVariable(){
        return $this->_variable;
    }


}
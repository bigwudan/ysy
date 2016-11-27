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
     * 获得property
     */
    protected $_property = array();

    /**
     * 得到xmlRuleObj
     */
    protected $_xmlRuleObj = array();

    /**
     * 得到当前的位置
     */
    protected $_currNode = array();

    /**
     * 得到executin
     */
    protected $_execution = array();

    /**
     * 得到histactinst
     */
    protected $_histActinst = array();

    /**
     * 得到$histProcinst
     */
    protected $_histProcinst = array();

    /**
     * 得到histTask
     */
    protected $_histTask = array();

    /**
     * 得到参数
     */
    protected $_variable = array();

    /**
     * 设置计数版本
     */
    protected $_versionNum = 1;

    /**
     * 设置rule
     * @param $varRule string 规则
     */
    public function setRule($varRule){
        $this->_rule = $varRule;
    }

    /**
     * 得到rule
     * @return array
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
     * @return array
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
     * @param $varExecution array execution对象
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
     * @param $varHistActinst array histactinst数据
     * @return array
     */
    public function setHistActinst($varHistActinst){
        return $this->_histActinst = $varHistActinst;
    }

    /**
     * 得到$varHistactinst
     * @return array
     */
    public function getHistActinst(){
        return $this->_histActinst;
    }

    /**
     * 设置$histProcinst
     * @param $varHistProcinst array histprocinst数据
     */
    public function setHistProcinst($varHistProcinst){
        $this->_histProcinst = $varHistProcinst;
    }

    /**
     * 得到$varHistProcinst
     * @return array
     */
    public function getHistProcinst(){
        return $this->_histProcinst;
    }

    /**
     * 设置参数
     * @param $varVariable array 参数
     */
    public function setVariable($varVariable){
        $this->_variable =$varVariable;
    }

    /**
     * 得到
     * @return array
     */
    public function getVariable(){
        return $this->_variable;
    }

    /**
     * 得到计数版本号
     * @return array
     */
    public function getVersionNum(){
        return $this->_versionNum;
    }

    /**
     * 计数当前累计数，超过自动扩大空间
     * @param $varNum int 当前计数器数
     * @return array
     */
    public function countNum($varNum){
        $varNum = $varNum + 1;
        $totalSum = \Org\Jbmp\Config\CommonConfig::getProperty()['totalsum'];
        if(($varNum%$totalSum) == 0){
            $this->_versionNum++;
            $varNum = $varNum + $totalSum;
        }
        return $varNum;
    }



}
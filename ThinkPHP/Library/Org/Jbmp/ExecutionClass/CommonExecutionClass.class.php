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

    protected $_currNode = array();

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
        if($this->_execution){
            $this->_execution['activityname'] = null;
        }
        $res =  $obj->getActionXml($this->_xmlRuleObj , $this->_execution['activityname']);
        $this->_currNode = $res;
    }

    /**
     * 得到node
     */
    public function getCurrNode(){
        return $this->_currNode;
    }


}
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
    }

    /**
     * 得到xml对象
     */
    public function getXmlObj(){
        return $this->_xmlRuleObj;
    }


}
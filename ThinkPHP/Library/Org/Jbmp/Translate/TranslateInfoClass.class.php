<?php
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2016/11/16
 * Time: 16:56
 */

namespace Org\Jbmp\Translate;


class TranslateInfoClass {

    /**
     * _versionNum
     */
    private $_versionNum = array();


    /**
     * execution
     */
    private $_execution = array();

    /**
     * histactinst
     */
    private $_histActinst = array();

    /**
     * histprocinst
     */
    private $_histProcinst = array();

    /**
     * histtask
     */
    private $_histTask = array();

    /**
     * participation
     */
    private $_participation = array();

    /**
     * property
     */
    private $_property = array();

    /**
     * task
     */
    private $_task = array();

    /**
     * variable
     */
    private $_variable = array();

    /**
     *
     */
    public function setExecution($varData){
        $this->_execution = $varData;

    }

    /**
     *
     */
    public function getExecution(){
        return $this->_execution;
    }

    /**
     *
     */
    public function setHistactinst($varData){
        $this->_histActinst = $varData;

    }

    /**
     *
     */
    public function getHistactinst(){
        return $this->_histActinst;
    }

    /**
     *
     */
    public function setHistprocinst($varData){
        $this->_histProcinst = $varData;

    }

    /**
     *
     */
    public function getHistprocinst(){
        return $this->_histProcinst;
    }

    /**
     *
     */
    public function setHisttask($varData){
        $this->_histTask = $varData;

    }

    /**
     *
     */
    public function getHisttask(){
        return $this->_histTask;
    }


    /**
     *
     */
    public function setParticipation($varData){
        $this->_participation = $varData;

    }

    /**
     *
     */
    public function getParticipation(){
        return $this->_participation;
    }

    /**
     *
     */
    public function setProperty($varData){
        $this->_property = $varData;

    }

    /**
     *
     */
    public function getProperty(){
        return $this->_property;
    }

    /**
     *
     */
    public function setTask($varData){
        $this->_task = $varData;

    }

    /**
     *
     */
    public function getTask(){
        return $this->_task;
    }

    /**
     *
     */
    public function setVariable($varData){
        $this->_variable = $varData;

    }

    /**
     *
     */
    public function getVariable(){
        return $this->_variable;
    }

    /**
     * 得到计数版本号
     */
    public function getVersionNum(){
        return $this->_versionNum;
    }

    /**
     * 设置计数版本号
     * @param $varVersionNum int 版本号
     */
    public function setVersionNum($varVersionNum){
        $this->_versionNum = $varVersionNum;
    }

}
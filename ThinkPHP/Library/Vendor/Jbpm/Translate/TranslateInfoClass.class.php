<?php
namespace Vendor\Jbpm\Translate;
/**
 * wudan 吴丹 创建于 2016-11-29 17:43:09
TranslateInfoClass
 */
class TranslateInfoClass{
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

     * 设置

     * @param $varData

     */

    public function setExecution($varData){

        $this->_execution = $varData;

    }



    /**

     * 得到

     * @return array

     */

    public function getExecution(){

        return $this->_execution;

    }



    /**

     * 设置

     * @param $varData

     */

    public function setHistactinst($varData){

        $this->_histActinst = $varData;

    }



    /**

     * 得到

     * @return array

     */

    public function getHistactinst(){

        return $this->_histActinst;

    }



    /**

     * 设置

     * @param $varData

     */

    public function setHistprocinst($varData){

        $this->_histProcinst = $varData;

    }



    /**

     * 得到

     * @return array

     */

    public function getHistprocinst(){

        return $this->_histProcinst;

    }



    /**

     * 设置

     * @param $varData

     */

    public function setHisttask($varData){

        $this->_histTask = $varData;

    }



    /**

     * 得到

     * @return array

     */

    public function getHisttask(){

        return $this->_histTask;

    }





    /**

     * 设置

     * @param $varData array

     */

    public function setParticipation($varData){

        $this->_participation = $varData;



    }



    /**

     * 得到

     * @return array

     */

    public function getParticipation(){

        return $this->_participation;

    }



    /**

     * 设置

     * @param $varData

     */

    public function setProperty($varData){

        $this->_property = $varData;

    }



    /**

     * 得到property

     * @return array

     */

    public function getProperty(){

        return $this->_property;

    }



    /**

     * 设置task

     * @param $varData array 参数

     */

    public function setTask($varData){

        $this->_task = $varData;



    }



    /**

     * 得到task

     * @return array

     */

    public function getTask(){

        return $this->_task;

    }



    /**

     * 得到参数

     * @param $varData 得到参数

     */

    public function setVariable($varData){

        $this->_variable = $varData;



    }



    /**

     * 获得参数

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

     * 设置计数版本号

     * @param $varVersionNum int 版本号

     */

    public function setVersionNum($varVersionNum){
        $this->_versionNum = $varVersionNum;
    }

}
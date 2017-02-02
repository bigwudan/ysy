<?php
namespace Vendor\Jbpm\Executionclass;
/**
 * wudan 吴丹 创建于 2016-11-29 17:26:05
对象
 */
class TaskExecutionClass extends \Vendor\Jbpm\Executionclass\CommonExecutionClass{
    /**
     * histTask
     */

    protected $_histTask = array();



    /**
     * task
     */

    protected $_task = array();



    /**
     * 设置participation
     */

    protected $_participation = array();





    /**
     * 设置
     * @param $varHistTask array 参数
     * @return array
     */

    public function setHistTask($varHistTask){
        return $this->_histTask = $varHistTask;
    }



    /**
     * 得到HistTask
     * @return array
     */

    public function getHistTask(){
        return $this->_histTask;
    }



    /**
     * 设置task
     * @param $varTask array task数据
     * @return array
     */

    public function setTask($varTask){
        return $this->_task = $varTask;
    }



    /**
     * 得到task
     * @return array
     */

    public function getTask(){
        return $this->_task;
    }



    /**
     * 设置participation
     * @param $varParticipation array 参数
     */

    public function setParticipation($varParticipation){
        $this->_participation = $varParticipation;
    }



    /**
     * 得到participation
     * @return array
     */

    public function getParticipation(){
       return $this->_participation;
    }
}
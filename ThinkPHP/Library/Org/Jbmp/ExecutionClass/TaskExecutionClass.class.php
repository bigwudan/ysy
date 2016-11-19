<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/19
 * Time: 11:42
 */

namespace Org\Jbmp\ExecutionClass;


class TaskExecutionClass extends \Org\Jbmp\ExecutionClass\CommonExecutionClass
{
    /**
     *
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
     */
    public function setHistTask($varHistTask){
        return $this->_histTask = $varHistTask;
    }

    /**
     * 得到
     */
    public function getHisTask(){
        return $this->_histTask;
    }

    /**
     *
     */
    public function setTask($varTask){
        return $this->_task = $varTask;
    }

    /**
     * @return array
     */
    public function getTask(){
        return $this->_task;
    }

    /**
     *
     */
    public function setParticipation($varParticipation){
        $this->_participation = $varParticipation;
    }

    /**
     *
     */
    public function getParticipation(){
        return $this->_participation;
    }
}
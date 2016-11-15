<?php
namespace Org\Jbmp\TargetExecutionClass;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/14
 * Time: 22:51
 */
class CommonTargetExecutionClass
{

    /**
     * xml对象
     */
    protected $_executionObj = null;

    /**
     * transition
     */
    protected $_targetNodeList  =  null;

    protected $_candidate = null;



    public function initi( $varExecutionObj , $varTargetNodeList = null){
        $this->_executionObj =  $varExecutionObj;
        $this->_targetNodeList =  $varTargetNodeList;
    }

    public function process(){

    }

    public function getTargetNodeList(){
        return $this->_targetNodeList;
    }

    protected function _setCandidate($varCandidate){
        $this->_candidate = $varCandidate;
    }

    public function getCandidate(){
        return $this->_candidate;
    }
}
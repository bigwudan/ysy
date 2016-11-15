<?php
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2016/11/15
 * Time: 11:35
 */

namespace Org\Jbmp\Service;


class AssembleExecutionAndTarget {

    private $_executionObj  =  null;
    private $_targetNode = null;

    private $_num = null;



    /**
     * @param $varExecution
     * @param $varTargetNode
     */

    public function initi($varExecution  ,  $varTargetNode){

        $this->_executionObj = $varExecution;
        $this->_targetNode = $varTargetNode;

    }

    public function process(){

        $this->_processExecution();

        die('xxx');
    }

    private function _processExecution(){

        $currNode  =  $this->_executionObj->getCurrNode();;



        if($currNode['nodeName'] == 'start'){

            $execution =  1;

        }else{


        }



    }


}
<?php
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2016/11/15
 * Time: 13:51
 */

namespace Org\Jbmp\ProcessDataBase;


class NeedWriteDbClass {

    private $_execution = array();

    /**
     * execution
     */
    public function setExecution($varExecution){
        $this->_execution =$varExecution;
    }

    public function getExecution(){

        return $this->_execution;
    }

}
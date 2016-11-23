<?php
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2016/11/22
 * Time: 17:05
 */

namespace Org\Jbmp\TargetExecutionClass;


class EndTargetExecution extends \Org\Jbmp\TargetExecutionClass\CommonTargetExecutionClass {

    /**
     * 类名称
     */
    private $_className = 'end';

    /**
     * 获得类名
     */
    public function getClassName(){
        return $this->_className;
    }

}
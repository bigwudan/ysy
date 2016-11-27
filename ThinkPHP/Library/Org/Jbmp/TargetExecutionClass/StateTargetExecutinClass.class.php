<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/14
 * Time: 22:54
 */

namespace Org\Jbmp\TargetExecutionClass;


class StateTargetExecutinClass extends \Org\Jbmp\TargetExecutionClass\CommonTargetExecutionClass
{
    /**
     * 类名称
     */
    private $_className = 'state';

    /**
     * 获得类名
     * @return array
     */
    public function getClassName(){
        return $this->_className;
    }
}
<?php
namespace Vendor\Jbpm\Targetexecutionclass;
/**
 * wudan 吴丹 创建于 2016-11-29 17:41:34
StateTargetExecutinClass
 */
class StateTargetExecutinClass extends \Vendor\Jbpm\Targetexecutionclass\CommonTargetExecutionClass{
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
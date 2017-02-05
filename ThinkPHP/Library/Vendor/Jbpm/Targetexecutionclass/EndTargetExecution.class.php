<?php
namespace Vendor\Jbpm\Targetexecutionclass;
/**
 * wudan 吴丹 创建于 2016-11-29 17:40:15
EndTargetExecution
 */
class EndTargetExecution extends \Vendor\Jbpm\Targetexecutionclass\CommonTargetExecutionClass{
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
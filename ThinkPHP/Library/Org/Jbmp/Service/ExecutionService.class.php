<?php
namespace Org\Jbmp\Service;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/13
 * Time: 9:07
 */
class ExecutionService
{

    /**
     * 启动模板
     * @param $varModelName string 模板名称
     */
    public function startProcessInstanceById($varModelName){
        $obj = new \Org\Jbmp\ProcessDataBase\SelectDataFromDb();
        $rule = $obj->getRuleByModuleName($varModelName);
        $property = $obj->getProperty();
        $StartObj = new \Org\Jbmp\ExecutionClass\StartExecutionClass();
        $StartObj->setRule($rule);
        $StartObj->setProperty($property['value']);
        $XmlObj = new \Org\Jbmp\ProcessFunction\XmlEngine();
        $obj = $XmlObj->getDbToXmlObj($rule['rule']);
        $StartObj->setXmlObj($obj);
        $FranslateObj = new \Org\Jbmp\Translate\FranslateFactory();
        $FranslateObj->initi($StartObj);
        $obj =  $FranslateObj->translate();

        $AssembleObj = new \Org\Jbmp\Service\AssembleExecutionAndTarget();

        $AssembleObj->initi($StartObj , $obj);
        $AssembleObj->process();


    }



}
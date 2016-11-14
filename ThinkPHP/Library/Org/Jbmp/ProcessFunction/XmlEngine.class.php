<?php
namespace Org\Jbmp\ProcessFunction;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/14
 * Time: 22:31
 */
class XmlEngine
{
    /**
     * 获得xml函数
     * @param string $varXmlData xml字符串
     * @return array
     */
    public function getDbToXmlObj($varXmlData){
        $xmlDocument = new \DOMDocument();
        if($xmlDocument->loadXML($varXmlData)){
            return $xmlDocument;
        }else{
            return false;
        }
    }
}
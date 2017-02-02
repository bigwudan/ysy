<?php
namespace Vendor\Jbpm\Processfunction;
/**
 * wudan 吴丹 创建于 2016-11-29 17:37:05
XmlEngine
 */
class XmlEngine{
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



    /**

     * 判断当前对象

     * @param $varXmlObj object 获得当前varXmlObj对象

     * @param $actionName string 获得当前action对象

     * @return array

     */

    public function getActionXml($varXmlObj , $actionName = null){
        if($actionName){
            $xPathObj = new \DOMXPath($varXmlObj);
            $actionNode = $xPathObj->query('*[@name="'.$actionName.'"]')->item(0);
        }else{
            $actionNode = $varXmlObj->getElementsByTagName('start')->item(0);
        }
        return $this->_dealSourceXml($actionNode);
    }



    /**

     * 得到源对象

     * @param xml $actionNode 节点对象

     * @return array

     */

    private function _dealSourceXml($actionNode){
        $nodeName = $actionNode->nodeName;
        $name = $actionNode->getAttribute('name');
        $attributeList = $this->_getAttributeList($actionNode);
        $transitionList = $this->_getTransitionList($actionNode);
        $sourceXmlList = array(
            'nodeName' => $nodeName,
            'name' => $name,
            'attributeList' => $attributeList,
            'transitionList' => $transitionList
        );
        if($nodeName == 'decision'){
            if($actionNode->getElementsByTagName('handler')->length){
                $handerNode = $actionNode->getElementsByTagName('handler')->item(0);
                $sourceXmlList['handler'] = trim($handerNode->getAttribute('class'));
            }
        }
        return $sourceXmlList;
    }

    /**

     * 得到属性数组

     * @param xmldocument $varXmlDocument 对象

     * @return array

     */

    private function _getAttributeList($varXmlDocument){

        $attributeList = array();

        $attributeXmlList = $varXmlDocument->attributes;

        if(!$attributeXmlList->length) return array();

        for($i = 0 ; $i < $attributeXmlList->length ; $i++){

            $tmpXml = $attributeXmlList->item($i);

            $attributeList[$i]['nodeName'] = $tmpXml->nodeName;

            $attributeList[$i]['nodeValue'] = $tmpXml->nodeValue;

            $attributeList[$i]['nodeType'] = $tmpXml->nodeType;

        }

        return $attributeList;

    }



    /**

     * 得到属性数组

     * @param xmlDocuement  $varXmlDocument 对象

     * @return array

     */

    private function _getTransitionList($varXmlDocument){

        $transitionXmlList = $varXmlDocument->getElementsByTagName('transition');

        $transitionList = array();

        if(!$transitionXmlList->length) return array();

        for($i = 0 ; $i < $transitionXmlList->length ; $i++){

            $tmpXml = $transitionXmlList->item($i);

            $transitionList[$i]['name'] = $tmpXml->getAttribute('name');

            $transitionList[$i]['to'] = $tmpXml->getAttribute('to');

        }

        return $transitionList;

    }

}
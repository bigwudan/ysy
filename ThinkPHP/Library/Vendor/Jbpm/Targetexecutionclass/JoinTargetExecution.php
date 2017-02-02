<?php
namespace Vendor\Jbpm\Targetexecutionclass;
/**
 * wudan 吴丹 创建于 2016-11-29 17:41:10
JoinTargetExecution
 */
class JoinTargetExecution extends \epet\hr\workuserflower\targetexecutionclass\CommonTargetExecutionClass{
    /**

     *  参数

     */

    private $_variable = null;



    /**

     * 是否完成

     */

    private $_hasFinishJoin = 0;



    /**

     * JoinExecution

     */

    private $_joinExecution = array();



    /**

     * 类名称

     */

    private $_className = 'join';



    /**

     * 初始的targetNodeList

     */

    private $_initialTargetNodeList = null;



    /**

     *  variableExecution

     */

    private $_variableExecution = null;



    /**

     * 得到初始targetNodeList

     */

    public function getInitialTargetNodeList(){

        return $this->_initialTargetNodeList;

    }





    /**

     * 获得类名

     * @return array

     */

    public function getClassName(){

        return $this->_className;

    }



    /**

     * 执行

     */

    public function process()

    {

        $this->_variable = $this->_executionObj->getVariable();

        $multiplicityNum = 0;

        $this->_initialTargetNodeList = $this->_targetNodeList;

        foreach($this->_targetNodeList['attributeList'] as $k => $v){

            if($v['nodeName'] == 'multiplicity'){

                $multiplicityNum = $v['nodeValue'];

                break;

            }

        }

        $this->_checkFinishFork($multiplicityNum);

    }



    /**

     * 检查是否整体完成

     * @param $varMulti int 需要完成的fork数量

     */

    private function _checkFinishFork($varMulti = 0){
        $obj = new \epet\hr\workuserflower\processdatabase\SelectData();
        $subForkDb = $obj->getSubForkDataBaseByParent($this->_executionObj->getExecution()['parent']);
        foreach($subForkDb as $k => $v){

            if($v['parent'] == 0){

                $this->_joinExecution['pActive'] = $v;

                unset($subForkDb[$k]);

            }

        }

        $subInActiveFork = array();

        $subActiveFork = array();

        foreach($subForkDb as $k => $v){

            if($v['state'] == 'inactive-join'){

                array_push($subInActiveFork , $v);

            }else{

                array_push($subActiveFork , $v);

            }

        }

        $this->_joinExecution['inActive'] = $subInActiveFork;

        $this->_joinExecution['subActiveFork'] = $subActiveFork;

        $flag = 0;

        if((count($subInActiveFork) + 1 == $varMulti) || (count($subForkDb) == count($subInActiveFork) + 1) ){

            $flag = 1;

        }

        $this->_hasFinishJoin = $flag;

        if($flag){

            $this->_translate($this->_targetNodeList['transitionList'][0]['to']);

        }

    }



    /**

     * 得到active

     * @return array

     */

    public function getJoinExecution(){

        return $this->_joinExecution;

    }









    /**

     * 得到是否完成状态

     * @return array

     */

    public function getHasFinishJoin(){

        return $this->_hasFinishJoin;

    }





    /**

     * 执行跳转

     * @param $varData 数据

     */

    private function _translate($varData){

        $xmlObj = $this->_executionObj->getXmlObj();
        $XmlEngine = new \epet\hr\workuserflower\processfunction\XmlEngine();
        $res = $XmlEngine->getActionXml( $xmlObj , $varData);
        $this->_initialTargetNodeList['translate'] = $res;
        if($res['nodeName'] == 'decision'){
            $this->_processDecision($res);
        }else{
            $this->_commonTarget($res);
            $res['nodeName'] == 'task' && $this->_taskTarget($res);
        }

    }



    /**

     * 处理decision

     * @param $varData object 对象

     */

    public function _processDecision($varData){
        $DecisionObj = new \epet\hr\workuserflower\targetexecutionclass\DecisionTargetExecution();
        $result = $DecisionObj->dealhandler($varData , $this->_executionObj);
        $this->_variable = $result['variable'];
        $this->_variableExecution = $result['variableExecution'];
        $translateList = $DecisionObj->translate($result['transitionList'] , $this->_executionObj , $result['variable']);
        $this->_targetNodeList = $translateList['targetNodeList'];
        if($this->_targetNodeList['nodeName'] == 'task'){
            $this->_candidate = $translateList['candidate'];
        }

    }





    /**

     * 通常的处理

     * @param $varData 数据

     */

    private function _commonTarget($varData){

        $this->_targetNodeList = $varData;

    }



    /**

     * 处理task

     * @param $varData 数据

     */

    private function _taskTarget($varData){
        $TaskObj = new \epet\hr\workuserflower\targetexecutionclass\TaskTargetExecutionClass();
        $this->_candidate = $TaskObj->processCandidate($varData , $this->_variable);
    }



    /**

     * 得到getVariableExecution

     */

    public function getVariableExecution(){
        return $this->_variableExecution;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2016/11/22
 * Time: 10:21
 */

namespace Org\Jbmp\TargetExecutionClass;


class JoinTargetExecution extends \Org\Jbmp\TargetExecutionClass\CommonTargetExecutionClass {


    /**
     * 是否完成
     */
    private $_hasFinishJoin = 0;

    /**
     * JoinExecution
     */
    private $_joinExecution = array();



    public function process()
    {
        $multiplicityNum = 0;
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
        $obj = new \Org\Jbmp\ProcessDataBase\SelectDataFromDb();
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
     */
    public function getJoinExecution(){
        return $this->_joinExecution;
    }




    /**
     * 得到是否完成状态
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
        $XmlEngine = new \Org\Jbmp\ProcessFunction\XmlEngine();
        $res = $XmlEngine->getActionXml( $xmlObj , $varData);
        $this->_commonTarget($res);
        $res['nodeName'] == 'task' && $this->_taskTarget($res);
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
        $TaskObj = new \Org\Jbmp\TargetExecutionClass\TaskTargetExecutionClass();
        $this->_candidate = $TaskObj->processCandidate($varData);
    }


}
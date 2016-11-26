<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/15
 * Time: 21:03
 */

namespace Org\Jbmp\TargetExecutionClass;


class TaskTargetExecutionClass extends \Org\Jbmp\TargetExecutionClass\CommonTargetExecutionClass
{
    /**
     * 类名称
     */
    private $_className = 'task';

    /**
     * 获得类名
     */
    public function getClassName(){
        return $this->_className;
    }

    public function process()
    {
        $this->_executionObj;
        $this->_candidate = $this->processCandidate($this->_targetNodeList);
    }

    public function processCandidate($varTargetNodeList , $varVariable = null){
        $attrList = $varTargetNodeList['attributeList'];
        $candidate = array();
        foreach($attrList as $k => $v){
            if($v['nodeName'] == 'candidate-groups' || $v['nodeName'] == 'candidate-users'){
                $matches = array();
                $pattern = '/#{(\S*)}/i';
                preg_match($pattern, $v['nodeValue'], $matches);
                if($matches[1]){
                    $tmpCandidate = $this->_buildCandidateByVariable($varVariable , $matches[1]);
                }else{
                    $tmpCandidate = explode(',' , $v['nodeValue']);
                }
            }
            if($v['nodeName'] == 'candidate-groups'){
                $candidate['groupid'] = $tmpCandidate;
                break;
            }elseif($v['nodeName'] == 'candidate-users'){
                $candidate['userid'] = $tmpCandidate;
                break;
            }
        }
        return $candidate;
    }

    /**
     * 通过variable转出成candidiate
     * @param $varVariable  参数
     * @param $varNodeValue 参数
     * @return array
     */
    private function _buildCandidateByVariable($varVariable , $varNodeValue){
        $varNodeValue = explode(',' , $varNodeValue);
        $resList = array();
        foreach($varNodeValue as $k => $v){
            foreach($varVariable as $k1 => $v1){
                if($v == $v1['key']){
                    $resList[] = $v1['value'];
                    break;
                }
            }
        }
        return $resList;
    }
}
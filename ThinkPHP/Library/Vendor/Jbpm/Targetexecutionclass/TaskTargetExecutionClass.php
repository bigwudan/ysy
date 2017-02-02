<?php
namespace Vendor\Jbpm\Targetexecutionclass;
/**
 * wudan 吴丹 创建于 2016-11-29 17:42:00
TaskTargetExecutionClass
 */
class TaskTargetExecutionClass extends \epet\hr\workuserflower\targetexecutionclass\CommonTargetExecutionClass{
    /**
     * 类名称
     */
    private $_className = 'task';

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
    public function process(){
        $this->_candidate = $this->processCandidate($this->_targetNodeList , $this->_executionObj);
        return $this->_candidate;
    }

    /**
     * @param $varTargetNodeList array 对象
     * @param $varExecutionObj null 参数
     * @return array
     */
    public function processCandidate($varTargetNodeList , $varExecutionObj = null){
        $attrList = $varTargetNodeList['attributeList'];
        $candidate = array();
        foreach($attrList as $k => $v){
            if($v['nodeName'] == 'candidate-groups' || $v['nodeName'] == 'candidate-users'){
                $matches = array();
                $pattern = '/#{(\S*)}/i';
                preg_match($pattern, $v['nodeValue'], $matches);
                if($matches[1]){
                    $tmpCandidate = $this->_buildCandidateByVariable($varExecutionObj , $matches[1]);
                }else{
                    $tmpCandidate = explode(',' , $v['nodeValue']);
                }
                if(!$tmpCandidate) break;
                if($v['nodeName'] == 'candidate-groups'){
                    $candidate['groupid'] = $tmpCandidate;
                    break;
                }elseif($v['nodeName'] == 'candidate-users'){
                    $candidate['userid'] = $tmpCandidate;
                    break;
                }
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
        $varList = $varVariable->getRunVars() ? $varVariable->getRunVars() : $varVariable->getIntroduceVars();
        foreach ($varList as $k => $v){
            if($v['key'] == $varNodeValue){
                $tmp = explode(',' , $v['value']);
                foreach ($tmp as $k => $v){
                    $resList[] = $v;
                }
                break;
            }
        }
        return $resList;

    }

}
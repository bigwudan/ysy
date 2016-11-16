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

    public function process()
    {
        $this->_executionObj;
        $this->_candidate = $this->getCandidate($this->_targetNodeList);
    }

    public function getCandidate($varTargetNodeList){
        $attrList = $varTargetNodeList['attributeList'];
        $candidate = array();
        foreach($attrList as $k => $v){
            if($v['nodeName'] == 'candidate-groups'){
                $candidate['groupid'] = explode(',' , $v['nodeValue']);
                break;
            }elseif($v['nodeName'] == 'candidate-users'){
                $candidate['userid'] = explode(',' , $v['nodeValue']);
                break;
            }
        }
        return $candidate;
    }

}
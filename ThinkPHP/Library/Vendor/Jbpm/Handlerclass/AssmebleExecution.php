<?php
namespace Vendor\Jbpm\Handlerclass;
/**
 * wudan 吴丹 创建于 2016-11-29 17:27:44
execution对象
 */
class AssmebleExecution{

    /**
     *  得到executionobj
     */
    private $_executionObj = null;

    /**
     * 得到targetNode
     */
    private $_targetNode = null;

    /**
     * 得到num
     */
    private $_num = null;

    /**
     * 初始化
     * @param $varExecution object 对象execution
     * @param $varTargetNode object 对象targetNode
     * @param $varNum int 累加数
     * @return array
     */

    public function initi($varExecution  ,  $varTargetNode , $varNum){
        $this->_executionObj = $varExecution;
        $this->_targetNode = $varTargetNode;
        $this->_num = $varNum;
        return $this;

    }



    /**

     * 执行程序

     * @return object

     */

    public function process(){

        $currNode  =  $this->_executionObj->getCurrNode();

        $execution = array();

        if($currNode['nodeName'] == 'start'){

            $execution['insert'] = $this->_processInsert();

        }else{

            if($tmp = $this->_processDel()){

                $execution['del'] = $tmp;

            }

            if($this->_targetNode->getTargetNodeList()['nodeName'] != 'end'){

                if($tmp = $this->_processUpdata()){

                    $execution['updata'] = $tmp;

                }

                if($tmp = $this->_processInsert($execution)){

                    $execution['insert'] = $tmp;

                }

            }

        }

        return $execution;

    }



    /**

     * 删除

     * @return array

     */

    private function _processDel(){

        $executionDel = array();

        if($this->_targetNode->getClassName() == 'join'){

            if($this->_targetNode->getHasFinishJoin()){

                $data = $this->_targetNode->getJoinExecution();

                $data['inActive'];

                $data['subActiveFork'];

                if($data['inActive']){

                    foreach($data['inActive'] as $k => $v){

                        $executionDel[$v['dbid']] = $v['dbid'];

                    }

                }

                if($data['subActiveFork']){

                    foreach($data['subActiveFork'] as $k => $v){

                        $executionDel[$v['dbid']] = $v['dbid'];

                    }

                }

                if($this->_targetNode->getTargetNodeList()['nodeName'] == 'end' ){

                    $executionDel[$data['pActive']['dbid']] = $data['pActive']['dbid'];

                }

            }

        }elseif($this->_targetNode->getTargetNodeList()['nodeName'] == 'end'){

            $executionDel[$this->_executionObj->getExecution()['dbid']] = $this->_executionObj->getExecution()['dbid'];

        }else{

            $executionDel = array();

        }



        return $executionDel;

    }





    /**

     * 处理更新

     */

    private function _processUpdata(){

        $execution = array();

        if(($this->_targetNode->getClassName() == 'join') && $this->_targetNode->getHasFinishJoin()){

            $data = $this->_targetNode->getJoinExecution()['pActive'];

            $where['dbid'] = $data['dbid'];

            $upData = array(

                'activityname' => $this->_targetNode->getTargetNodeList()['name'],

                'state' => 'active-root',

                'hisactinst' => 0

            );

        }else{

            $execution = $this->_executionObj->getExecution();

            $where = array();

            $where['dbid'] = $execution['dbid'];

            $targetNodeList = $this->_targetNode->getTargetNodeList();

            if($targetNodeList['nodeName'] == 'join'){

                $upData = array(

                    'activityname' => $targetNodeList['name'],

                    'state' => 'inactive-join'

                );

            }elseif($targetNodeList['nodeName'] == 'fork'){

                $upData = array(

                    'activityname' => $targetNodeList['name'],

                    'hisactinst' => 0,

                    'state' => 'inactive-concurrent-root'

                );

            }else{

                $upData = array(

                    'activityname' => $targetNodeList['name'],

                    'hisactinst' => 0

                );

            }

        }

        $tmpExecution= array(

            $where['dbid'] =>

                array(

                    'where'=>$where,

                    'data'=>$upData

                )

        );

        return $tmpExecution;

    }



    /**

     * 得到num

     * @return int

     */

    public function getNum(){

        return $this->_num;

    }



    /**

     * 处理开始

     * @param $varExecution object 对象

     * @return object

     */

    private function _processInsert($varExecution = null){

        $execution = array();

        if($this->_targetNode->getTargetNodeList()['nodeName'] == 'fork'){

            $execution = $this->_processInsertTargetOfFork($varExecution);

        }elseif($this->_executionObj->getCurrNode()['nodeName'] == 'start'){

            $execution = $this->_processInsertTargetOfStart();

        }

        return $execution;

    }





    /**

     * insert处理start

     * @return object

     */

    private function _processInsertTargetOfStart(){
        if(!empty($this->_executionObj->getIntroduceVars()) || !empty($this->_executionObj->getRunVars())){
            $hasVars = 1;
        }else{
            $hasVars = 0;
        }
        $execution[$this->_num] =  array(
            'dbid' => $this->_num,
            'activityname'  => $this->_targetNode->getTargetNodeList()['name'],
            'procdefid' => $this->_executionObj->getRule()['rulename'],
            'hasvars' => $hasVars,
            'key' => '',
            'id' => "{$this->_executionObj->getRule()['rulename']}.{$this->_num}",
            'state' => 'active-root',
            'priority' => 0,
            'hisactinst' => 0,
            'parent' => 0,
            'parentidx' => 0,
            'instance' => $this->_num,
            'addtime' => time()

        );
        $this->_num =$this->_executionObj->countNum($this->_num);
        return $execution;
    }



    /**

     * insert处理fork

     * @param $varExecution Object 对象

     * @return object

     */

    private function _processInsertTargetOfFork($varExecution = null){
        if(!empty($this->_executionObj->getIntroduceVars()) || !empty($this->_executionObj->getRunVars())){
            $hasVars = 1;
        }else{
            $hasVars = 0;
        }
        if($this->_executionObj->getCurrNode()['nodeName'] == 'start'){
            $execution[$this->_num] = array(
                'dbid' => $this->_num,
                'activityname'  => '',
                'procdefid' => $this->_executionObj->getRule()['rulename'],
                'hasvars' => $hasVars,
                'key' => '',
                'id' => "{$this->_executionObj->getRule()['rulename']}.{$this->_num}",
                'state' => 'inactive-concurrent-root',
                'priority' => 0,
                'hisactinst' => 0,
                'parent' => 0,
                'parentidx' => 0,
                'instance' => $this->_num,
                'addtime' => time()
            );

            $this->_num =$this->_executionObj->countNum($this->_num);

        }

        if($this->_executionObj->getCurrNode()['nodeName'] == 'start'){

            foreach($execution as $k => $v){

                $tmpExecution = array();

                $tmpExecution['mainid'] = $v['id'];

                $tmpExecution['parent'] = $v['dbid'];

                $tmpExecution['instance'] = $v['dbid'];

                break;

            }

        }else{

            foreach($varExecution['updata'] as $k => $v){

                $tmpExecution = array();

                $tmpExecution['mainid'] = $v['where']['dbid'];

                $tmpExecution['parent'] = $v['where']['dbid'];

                $tmpExecution['instance'] = $v['where']['dbid'];

                break;

            }

        }

        foreach($this->_targetNode->getForkTargetNodeList() as $k => $v){

            $execution[$this->_num] = array(

                'dbid' => $this->_num,

                'activityname'  => $v['name'],

                'procdefid' => $this->_executionObj->getRule()['rulename'],

                'hasvars' => $hasVars,

                'key' => '',

                'id' => "{$this->_executionObj->getRule()['rulename']}.{$tmpExecution['mainid']}.to {$v['name']}.{$this->_num}",

                'state' => 'active-concurrent',

                'priority' => 0,

                'hisactinst' => 0,

                'parent' => $tmpExecution['parent'],

                'parentidx' => 0,

                'instance' => $tmpExecution['instance'],
                'addtime' => time()

            );

            $this->_num =$this->_executionObj->countNum($this->_num);

        }

        return $execution;



    }

}
<?php
namespace Org\Jbmp\JbmpTestUnit\ModeRule;
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2016/11/15
 * Time: 10:50
 */

class StateModeRule {

    /**
     * rule_string
     */
    protected $_rule = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>

<process name="demo" xmlns="http://jbpm.org/4.4/jpdl">
   <start name="start1" g="334,44,48,48">
      <transition name="to state1" to="state1" g="-56,-22"/>
   </start>
   <state name="state1" g="347,168,92,52">
      <transition name="to end1" to="end1" g="-50,-22"/>
   </state>
   <end name="end1" g="400,301,48,48"/>

</process>
EOT;

    /**
     * 名称
     */
    protected $_ruleName = 'state';




    /**
     * 单元测试
     * @param $varModeName string 模板名称
     * @param $varRunCommand string 运行命令
     *
     */
    public function initi($varModeName , $varRunCommand){


    }

    /**
     * 调出配置项
     */
    protected function _state1ConfigRule(){
        $execution = array(
            'dbid' => 11,
            'activityname' => 'state1',
            'procdefid' => 'teststate',
            'hasvars' => 1,
            'key' => '',
            'id' => 'teststate.11',
            'state' => 'active-root',
            'priority' => 0,
            'hisactinst' => 12,
            'parent' => 0,
            'parentidx' => 0,
            'instance' => 11,
        );

        $histactinst = array(
            'dbid' => 12,
            'hprocid' => 11 ,
            'type' => 'state' ,
            'execution' => 'teststate.11' ,
            'activity_name' => 'state1' ,
            'start' => 'inore' ,
            'end' => 'inore',
            'duration' => 'inore',
            'transition' => '' ,
            'htask' => 0,
        );

        $histprocinst = array(
            'dbid' => 11,
            'id' => 'teststate.11',
            'procdefid' => 'teststate',
            'key' => '',
            'start' => 'inore',
            'end' => 'inore',
            'duration' =>'inore',
            'state' =>'active',
            'endactivity' => '',
        );

    }




}
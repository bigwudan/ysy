<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/27
 * Time: 20:57
 */

namespace Org\Jbmp\TestHander;


class test2Hander
{
    /**
     * 测试
     */
    public function decide($varExecution){
        $res = array();

        $tmp3 = array(
            'class' => 'string',
            'key' => 'team1',
            'value' => 't111'
        );

        $tmp1 = array(
            'class' => 'string',
            'key' => 'team2',
            'value' => 't222'
        );

        $res['variable'] = array($tmp3 , $tmp1);
        $res['target'] = 'to task2';
        return $res;
    }
}
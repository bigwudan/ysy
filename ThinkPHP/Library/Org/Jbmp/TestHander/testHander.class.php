<?php
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2016/11/16
 * Time: 10:35
 */
namespace Org\Jbmp\TestHander;
class testHander {
    /**
     * 测试
     */
    public function decide($varExecution){
        $res = array();

        $tmp3 = array(
            'class' => 'int',
            'key' => 'user1',
            'value' => 12

        );

        $tmp4 = array(
            'class' => 'int',
            'key' => 'user2',
            'value' => 233


        );
        $res['variable'] = array($tmp3 , $tmp4);
        $res['target'] = 'to task1';
        return $res;
    }



}
<?php
namespace CommonClass\Data;
/**
* Created by PhpStorm.
* User: Administrator
* Date: 2016/10/16
* Time: 9:32
*/
class TestData
{
    /**
    * 初始化
    */
    public function __construct(){
        $Model = new \Think\Model();
        //$dbObj = $Model->query("select * from think_user");
        $data = $Model->db()->query("select * from think_user");
        var_dump($data);
        die('111');
    }
    
    public function actionTest(){
        die('xxx');
    }

    
    
}
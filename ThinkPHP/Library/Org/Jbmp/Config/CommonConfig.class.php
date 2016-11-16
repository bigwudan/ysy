<?php
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2016/11/15
 * Time: 13:59
 */
namespace Org\Jbmp\Config;
class CommonConfig {
    private static $_property = array(
        'totalsum' => 100

    );

    public static function getProperty(){
        return self::$_property;
    }


}
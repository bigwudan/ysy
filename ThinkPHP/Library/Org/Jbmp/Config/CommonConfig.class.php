<?php
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2016/11/15
 * Time: 13:59
 */
namespace Org\Jbmp\Config;
class CommonConfig {

    /**
     * 累加参数
     */

    private static $_property = array(
        'totalsum' => 10
    );

    /**
     * 获得累加参数
     * @return array
     */

    public static function getProperty(){
        return self::$_property;
    }


}
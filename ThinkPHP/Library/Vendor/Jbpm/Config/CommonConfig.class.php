<?php
namespace Vendor\Jbpm\Config;
/**
 * wudan 吴丹 创建于 2016-11-29 17:20:11
工作流配置文件
 */
class CommonConfig{
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
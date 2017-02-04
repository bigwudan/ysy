<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/15
 * Time: 21:44
 */

namespace CommonClass\Order\Dealpackage;


interface IDealPackage
{
    /**
     * 初始化
     */
    public function initi($varData);

    /**
     * 处理
     */
    public function prcessToSQL();

}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/14
 * Time: 16:52
 */

namespace Vendor\Rbac;


interface IRbac
{
    /**
     * @param $varUid
     * @param string $checkType
     */
    public static function checkAccess($varUid , $checkType = 'module');

}
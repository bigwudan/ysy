<?php
namespace DingTalk\Common;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/16
 * Time: 22:10
 */
class AdminAuthor
{
    /**
     * 初始化
     */
    public function init(){
        $this->_checkAuthor(1);
    }

    /**
     * 验证权限
     * @param int uid
     */
    private function _checkAuthor($varUid){
        $obj = new \Vendor\Rbac\MyRbac();
        $res = $obj->checkAccess($varUid);
        var_dump($res);
    }
}
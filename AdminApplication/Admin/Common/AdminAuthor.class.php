<?php
namespace Admin\Common;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/16
 * Time: 22:04
 */
class AdminAuthor
{
    /**
     * 初始化
     */
    public function init(){
        $uid = session('uid');
        if($uid == '2'){
            return true;
        }
        if($uid){
            $this->_checkAuthor($uid);
        }else{
            $url = U('/Login/Login/actionLogin');
            header("Location: {$url}");
        }
    }
    /**
     * 验证权限
     * @param int uid
     */
    private function _checkAuthor($varUid){
        $obj = new \Vendor\Rbac\MyRbac();
        $res = $obj->checkAccess($varUid , 'action');
        if(!$res){
            die('no enter');
        }
    }
}
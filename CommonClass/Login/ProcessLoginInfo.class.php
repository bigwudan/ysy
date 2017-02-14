<?php
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2017-02-14
 * Time: 11:05
 */

namespace CommonClass\Login;


class ProcessLoginInfo {
    /**
     * 存入数据
     */
    public function setLoginInfo($varUid){
        $userInfo = M('user')->field("id , username , realname")->where("id = {$varUid}")->find();
        $userInfoOfSerialize = serialize($userInfo);
        $userInfoOfSerialize = base64_encode($userInfoOfSerialize);
        return cookie('logininfo',$userInfoOfSerialize);
    }

    /**
     * 得到uidInfo
     */
    public function getLoginInfo(){
        if($logInfo = cookie('logininfo')){
            return unserialize(base64_decode($logInfo));
        }
    }


}
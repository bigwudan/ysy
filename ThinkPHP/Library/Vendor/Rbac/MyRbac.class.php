<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/14
 * Time: 16:52
 */


/*

CREATE TABLE `think_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `think_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

CREATE TABLE `think_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

CREATE TABLE `think_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `think_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `logintime` int(10) unsigned NOT NULL,
  `loginip` varchar(30) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;




 */
namespace Vendor\Rbac;

class MyRbac implements IRbac{

    /**
     * @param $varUid
     * @param string $checkType
     */

    public static function checkAccess($varUid , $checkType = 'module'){
        $authorList = self::_authorListByUid($varUid);
        if($checkType === 'module'){
            $res = self::_checkModule($authorList);
        }else if($checkType === 'controll'){
            $res = self::_checkControll($authorList);
        }else{
            $res = self::_checkAction($authorList);
        }
        return $res;
    }

    /**
     * @param $varAuthorList
     */
    private static function _checkModule($varAuthorList){
        return $varAuthorList['module'][MODULE_NAME];
    }

    /**
     * @param $varAuthorList
     */
    private static function _checkControll($varAuthorList){
        return $varAuthorList['controll'][MODULE_NAME][CONTROLLER_NAME];
    }

    /**
     * @param $varAuthorList
     */
    private static function _checkAction($varAuthorList){
        return $varAuthorList['action'][MODULE_NAME][CONTROLLER_NAME][ACTION_NAME];
    }
    /**
     * @param $varUid 用户uid
     * @return mixed
     */
    private static function _authorListByUid($varUid){
        $data = M('user')->alias('u')
            ->field(" u.username as username , ru.user_id , ru.role_id , r.name as role_name , a.node_id , n.name as node_name , n.title as node_title , n.pid , n.level")
            ->join('think_role_user AS ru ON ru.user_id = u.id')
            ->join('think_role AS r ON r.id = ru.role_id')
            ->join('think_access AS a ON a.role_id = r.id')
            ->join('think_node AS n ON a.node_id = n.id')
            ->where("ru.user_id = {$varUid}")->select();
        $moduleArr = array();
        if($data){
            foreach($data as $k => $v){
                if($v['level'] == 1){
                    $moduleArr[$v['node_name']] = $v['node_id'];
                }
            }
        }
        $controllArr = array();
        if($moduleArr){
            foreach($moduleArr as $k => $v){
                foreach($data as $k1 => $v1){
                    if($v == $v1['pid']){
                        $controllArr[$k][$v1['node_name']] = $v1['node_id'];
                    }
                }
            }
        }
        $actionArr = array();
        if($controllArr){
            foreach($controllArr as $k => $v){
                foreach($v as $k1 => $v1){
                    foreach($data as $k2 => $v2){
                        if($v1 == $v2['pid']){
                            $actionArr[$k][$k1][$v2['node_name']] = $v2['node_id'];
                        }
                    }
                }
            }
        }
        $res = array(
            'module' => $moduleArr,
            'controll' => $controllArr,
            'action' => $actionArr
        );
        return $res;
    }
}
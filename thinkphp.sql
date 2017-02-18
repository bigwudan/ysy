/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : thinkphp

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2017-02-18 22:29:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `think_access`
-- ----------------------------
DROP TABLE IF EXISTS `think_access`;
CREATE TABLE `think_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_access
-- ----------------------------
INSERT INTO `think_access` VALUES ('2', '15', '0', null);
INSERT INTO `think_access` VALUES ('2', '14', '0', null);
INSERT INTO `think_access` VALUES ('2', '12', '0', null);
INSERT INTO `think_access` VALUES ('2', '7', '0', null);
INSERT INTO `think_access` VALUES ('2', '6', '0', null);
INSERT INTO `think_access` VALUES ('2', '4', '0', null);
INSERT INTO `think_access` VALUES ('2', '8', '0', null);
INSERT INTO `think_access` VALUES ('2', '9', '0', null);
INSERT INTO `think_access` VALUES ('2', '10', '0', null);
INSERT INTO `think_access` VALUES ('2', '11', '0', null);
INSERT INTO `think_access` VALUES ('2', '5', '0', null);
INSERT INTO `think_access` VALUES ('2', '19', '0', null);
INSERT INTO `think_access` VALUES ('2', '18', '0', null);
INSERT INTO `think_access` VALUES ('2', '17', '0', null);
INSERT INTO `think_access` VALUES ('2', '13', '0', null);
INSERT INTO `think_access` VALUES ('2', '7', '0', null);
INSERT INTO `think_access` VALUES ('2', '6', '0', null);
INSERT INTO `think_access` VALUES ('2', '3', '0', null);
INSERT INTO `think_access` VALUES ('2', '8', '0', null);
INSERT INTO `think_access` VALUES ('2', '9', '0', null);
INSERT INTO `think_access` VALUES ('2', '10', '0', null);
INSERT INTO `think_access` VALUES ('2', '5', '0', null);
INSERT INTO `think_access` VALUES ('2', '2', '0', null);
INSERT INTO `think_access` VALUES ('2', '1', '0', null);
INSERT INTO `think_access` VALUES ('2', '16', '0', null);
INSERT INTO `think_access` VALUES ('2', '20', '0', null);
INSERT INTO `think_access` VALUES ('2', '21', '0', null);
INSERT INTO `think_access` VALUES ('2', '22', '0', null);
INSERT INTO `think_access` VALUES ('2', '34', '0', null);
INSERT INTO `think_access` VALUES ('2', '23', '0', null);
INSERT INTO `think_access` VALUES ('2', '24', '0', null);
INSERT INTO `think_access` VALUES ('2', '25', '0', null);
INSERT INTO `think_access` VALUES ('2', '26', '0', null);
INSERT INTO `think_access` VALUES ('2', '27', '0', null);
INSERT INTO `think_access` VALUES ('2', '28', '0', null);
INSERT INTO `think_access` VALUES ('2', '29', '0', null);
INSERT INTO `think_access` VALUES ('2', '30', '0', null);
INSERT INTO `think_access` VALUES ('2', '31', '0', null);
INSERT INTO `think_access` VALUES ('2', '33', '0', null);
INSERT INTO `think_access` VALUES ('2', '32', '0', null);
INSERT INTO `think_access` VALUES ('2', '34', '0', null);
INSERT INTO `think_access` VALUES ('2', '35', '0', null);
INSERT INTO `think_access` VALUES ('2', '36', '0', null);
INSERT INTO `think_access` VALUES ('2', '37', '0', null);
INSERT INTO `think_access` VALUES ('2', '38', '0', null);
INSERT INTO `think_access` VALUES ('2', '39', '0', null);
INSERT INTO `think_access` VALUES ('2', '40', '0', null);
INSERT INTO `think_access` VALUES ('2', '41', '0', null);
INSERT INTO `think_access` VALUES ('3', '1', '0', null);
INSERT INTO `think_access` VALUES ('3', '31', '0', null);
INSERT INTO `think_access` VALUES ('3', '38', '0', null);
INSERT INTO `think_access` VALUES ('3', '27', '0', null);
INSERT INTO `think_access` VALUES ('3', '35', '0', null);
INSERT INTO `think_access` VALUES ('3', '36', '0', null);
INSERT INTO `think_access` VALUES ('3', '37', '0', null);
INSERT INTO `think_access` VALUES ('3', '39', '0', null);
INSERT INTO `think_access` VALUES ('3', '41', '0', null);
INSERT INTO `think_access` VALUES ('3', '40', '0', null);
INSERT INTO `think_access` VALUES ('3', '29', '0', null);
INSERT INTO `think_access` VALUES ('3', '42', '0', null);
INSERT INTO `think_access` VALUES ('2', '42', '0', null);
INSERT INTO `think_access` VALUES ('2', '43', '0', null);
INSERT INTO `think_access` VALUES ('3', '6', '0', null);
INSERT INTO `think_access` VALUES ('3', '42', '0', null);
INSERT INTO `think_access` VALUES ('3', '43', '0', null);
INSERT INTO `think_access` VALUES ('3', '3', '0', null);
INSERT INTO `think_access` VALUES ('2', '44', '0', null);
INSERT INTO `think_access` VALUES ('2', '45', '0', null);
INSERT INTO `think_access` VALUES ('2', '46', '0', null);
INSERT INTO `think_access` VALUES ('2', '47', '0', null);
INSERT INTO `think_access` VALUES ('2', '48', '0', null);
INSERT INTO `think_access` VALUES ('2', '49', '0', null);
INSERT INTO `think_access` VALUES ('2', '50', '0', null);
INSERT INTO `think_access` VALUES ('2', '51', '0', null);
INSERT INTO `think_access` VALUES ('2', '52', '0', null);
INSERT INTO `think_access` VALUES ('2', '53', '0', null);
INSERT INTO `think_access` VALUES ('2', '54', '0', null);
INSERT INTO `think_access` VALUES ('2', '55', '0', null);

-- ----------------------------
-- Table structure for `think_log`
-- ----------------------------
DROP TABLE IF EXISTS `think_log`;
CREATE TABLE `think_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `action` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `action` (`action`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_log
-- ----------------------------
INSERT INTO `think_log` VALUES ('1', '1', '1477190842', '127.0.0.1', 'a:5:{s:5:\"amout\";i:2;s:11:\"recvcompany\";s:3:\"234\";s:7:\"saleuid\";i:234;s:8:\"deadline\";i:1475596800;s:5:\"begid\";i:1000;}', 'actionDistributeTicketToDb');

-- ----------------------------
-- Table structure for `think_node`
-- ----------------------------
DROP TABLE IF EXISTS `think_node`;
CREATE TABLE `think_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL,
  `sort` smallint(6) unsigned NOT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_node
-- ----------------------------
INSERT INTO `think_node` VALUES ('1', 'Admin', '后台管理', '1', '', '1', '0', '1', '');
INSERT INTO `think_node` VALUES ('2', 'rbac', '权限管理', '1', '', '2', '1', '2', '/Rbac/Rbac/actionOperationUser');
INSERT INTO `think_node` VALUES ('3', 'Ticket', '对卷管理', '1', '', '3', '1', '2', '/Ticket/AllocationTicket/actionViewTicket');
INSERT INTO `think_node` VALUES ('5', 'actionManageRole', '角色管理', '1', '', '0', '2', '3', '');
INSERT INTO `think_node` VALUES ('6', 'EditTicket', '显示卷号', '1', '', '0', '3', '3', '');
INSERT INTO `think_node` VALUES ('7', 'editarticle', '修改文章', '1', '', '0', '3', '3', '');
INSERT INTO `think_node` VALUES ('8', 'OperationUser111', '添加角色', '1', '', '1', '2', '3', '');
INSERT INTO `think_node` VALUES ('9', 'actionAddNode', '添加权限', '1', '', '1', '2', '3', '');
INSERT INTO `think_node` VALUES ('10', 'actionManageNode', '权限管理', '1', '', '1', '2', '3', '');
INSERT INTO `think_node` VALUES ('11', 'OperationUser', '添加用户', '1', '', '1', '2', '3', '');
INSERT INTO `think_node` VALUES ('15', 'test', 'testRar', '0', '', '1212', '2', '3', '');
INSERT INTO `think_node` VALUES ('16', 'Home', 'home', '1', '', '1', '0', '1', '');
INSERT INTO `think_node` VALUES ('17', 'Index', 'Index', '1', '', '2', '16', '2', '');
INSERT INTO `think_node` VALUES ('18', 'actionOperationRole', 'actionTest', '1', '', '3', '2', '3', '');
INSERT INTO `think_node` VALUES ('19', 'DingTalk', '顶钉管理', '1', '', '1', '0', '1', '');
INSERT INTO `think_node` VALUES ('20', 'Entrance/Entrance', '入口文件', '1', '', '1', '19', '2', '');
INSERT INTO `think_node` VALUES ('21', 'actionOperationUser', 'test', '1', '', '1', '23', '4', '');
INSERT INTO `think_node` VALUES ('22', 'actionViewTicket', '预览对卷', '1', '', '1', '3', '3', '');
INSERT INTO `think_node` VALUES ('23', 'rbac', '单个权限', '1', '', '0', '2', '3', '');
INSERT INTO `think_node` VALUES ('24', 'index', 'testindex', '1', '', '1', '15', '4', '');
INSERT INTO `think_node` VALUES ('25', 'index', 'rbacindex', '1', '', '1', '23', '4', '');
INSERT INTO `think_node` VALUES ('26', 'index', '管理用户', '1', '', '1', '11', '4', '');
INSERT INTO `think_node` VALUES ('27', 'statistics', '智能报表', '1', '', '0', '1', '2', '/Statistics/Salerstatistics/actionTest');
INSERT INTO `think_node` VALUES ('28', 'Salerstatistics', '销售员统计', '1', '', '0', '27', '3', '');
INSERT INTO `think_node` VALUES ('29', 'Customerstatistics', '客户统计', '1', '', '1', '27', '3', '');
INSERT INTO `think_node` VALUES ('30', 'index', 'index', '1', '', '0', '28', '4', '');
INSERT INTO `think_node` VALUES ('31', 'index', 'index', '1', '', '0', '29', '4', '');
INSERT INTO `think_node` VALUES ('32', 'Goodsstylestatistics', '规格统计', '1', '', '0', '27', '3', '');
INSERT INTO `think_node` VALUES ('33', 'index', 'index', '1', '', '0', '32', '4', '');
INSERT INTO `think_node` VALUES ('34', 'goodStyleAjax', 'goodStyleAjax', '1', '', '0', '32', '4', '');
INSERT INTO `think_node` VALUES ('35', 'Singlegoodstatistics', '商品统计', '1', '', '0', '27', '3', '');
INSERT INTO `think_node` VALUES ('36', 'index', 'index', '1', '', '0', '35', '4', '');
INSERT INTO `think_node` VALUES ('37', 'actionAjaxFactory', 'actionAjaxFactory', '1', '', '0', '35', '4', '');
INSERT INTO `think_node` VALUES ('38', 'actionAjaxFactory', 'actionAjaxFactory', '1', '', '0', '29', '4', '');
INSERT INTO `think_node` VALUES ('39', 'Channelstatistics', '渠道统计', '1', '', '0', '27', '3', '');
INSERT INTO `think_node` VALUES ('40', 'index', 'index', '1', '', '0', '39', '4', '');
INSERT INTO `think_node` VALUES ('41', 'actionAjaxFactory', 'actionAjaxFactory', '1', '', '0', '39', '4', '');
INSERT INTO `think_node` VALUES ('42', 'index', 'index', '1', '', '1', '6', '4', '');
INSERT INTO `think_node` VALUES ('43', 'actionFactoryCenter', 'actionFactoryCenter', '1', '', '0', '6', '4', '');
INSERT INTO `think_node` VALUES ('44', 'stockandsale', '进销存', '1', '', '0', '1', '2', '/Statistics/Salerstatistics/actionTest');
INSERT INTO `think_node` VALUES ('45', 'Checkin', '入库', '1', '', '0', '44', '3', '');
INSERT INTO `think_node` VALUES ('46', 'index', 'index', '1', '', '0', '45', '4', '');
INSERT INTO `think_node` VALUES ('47', 'actionRequestService', 'actionRequestService', '1', '', '0', '45', '4', '');
INSERT INTO `think_node` VALUES ('48', 'actionEditCheckIn', 'actionEditCheckIn', '1', '', '0', '45', '4', '');
INSERT INTO `think_node` VALUES ('49', 'Goodspackage', '组合商品', '1', '', '0', '44', '3', '');
INSERT INTO `think_node` VALUES ('50', 'index', 'index', '1', '', '0', '49', '4', '');
INSERT INTO `think_node` VALUES ('51', 'actionEditGoodsPackage', 'actionEditGoodsPackage', '1', '', '0', '49', '4', '');
INSERT INTO `think_node` VALUES ('52', 'actionRequestService', 'actionRequestService', '0', '', '0', '49', '4', '');
INSERT INTO `think_node` VALUES ('53', 'ManageGoods', '管理商品', '1', '', '0', '44', '3', '');
INSERT INTO `think_node` VALUES ('54', 'index', 'index', '1', '', '0', '53', '4', '');
INSERT INTO `think_node` VALUES ('55', 'actionRequestService', 'actionRequestService', '1', '', '0', '53', '4', '');

-- ----------------------------
-- Table structure for `think_order`
-- ----------------------------
DROP TABLE IF EXISTS `think_order`;
CREATE TABLE `think_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `salesman` char(30) NOT NULL COMMENT '业务员名字',
  `xiatime` char(30) NOT NULL COMMENT '下单日期',
  `ordertime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下单时间',
  `channel` char(30) NOT NULL COMMENT '订单渠道',
  `customerfresh` char(30) NOT NULL,
  `customername` char(30) NOT NULL COMMENT '客户名称',
  `industrycate` char(30) NOT NULL COMMENT '行业类别',
  `recvpeople` char(30) NOT NULL COMMENT '收货人',
  `paycate` char(30) NOT NULL COMMENT '付款方式',
  `sendcate` char(30) NOT NULL COMMENT '配送方式',
  `leader` char(30) NOT NULL COMMENT '隶属人',
  `goodsname` char(30) NOT NULL COMMENT '商品名称',
  `goodsstyle` char(30) NOT NULL COMMENT '商品规格',
  `goodprice` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '单价',
  `goodsnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品数量',
  `totalprice` decimal(10,2) unsigned DEFAULT '0.00' COMMENT '总价格',
  PRIMARY KEY (`id`),
  KEY `salesman` (`salesman`),
  KEY `customername` (`customername`),
  KEY `goodsnum` (`goodsnum`),
  KEY `totalprice` (`totalprice`),
  KEY `goodsname` (`goodsname`),
  KEY `goodsstyle` (`goodsstyle`)
) ENGINE=MyISAM AUTO_INCREMENT=1966 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_order
-- ----------------------------

-- ----------------------------
-- Table structure for `think_role`
-- ----------------------------
DROP TABLE IF EXISTS `think_role`;
CREATE TABLE `think_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_role
-- ----------------------------
INSERT INTO `think_role` VALUES ('1', '超级管理员', '0', '1', '全部权限');
INSERT INTO `think_role` VALUES ('2', '普通管理员', '0', '1', '普通员工');
INSERT INTO `think_role` VALUES ('3', '统计管理员', '0', '0', '678');
INSERT INTO `think_role` VALUES ('4', '1212', null, '1', '3434');

-- ----------------------------
-- Table structure for `think_role_user`
-- ----------------------------
DROP TABLE IF EXISTS `think_role_user`;
CREATE TABLE `think_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_role_user
-- ----------------------------
INSERT INTO `think_role_user` VALUES ('2', '1');
INSERT INTO `think_role_user` VALUES ('3', '4');
INSERT INTO `think_role_user` VALUES ('1', '4');
INSERT INTO `think_role_user` VALUES ('3', '5');

-- ----------------------------
-- Table structure for `think_ticket`
-- ----------------------------
DROP TABLE IF EXISTS `think_ticket`;
CREATE TABLE `think_ticket` (
  `number` int(10) unsigned NOT NULL COMMENT '卷号',
  `is_spend` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '是否消费',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '消费时间',
  `ip` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'ip字段',
  `rec_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `rec_addr` varchar(200) CHARACTER SET utf8 NOT NULL,
  `rec_tel` bigint(40) unsigned NOT NULL DEFAULT '0',
  `remark` varchar(255) CHARACTER SET utf8 NOT NULL,
  `adminuid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '后台确认人',
  `adminremark` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '后台确认',
  `wuliunum` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '物流',
  `rec_province` char(10) CHARACTER SET utf8 NOT NULL COMMENT '省',
  `category` char(30) CHARACTER SET utf8 NOT NULL DEFAULT '398',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `id` (`number`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of think_ticket
-- ----------------------------

-- ----------------------------
-- Table structure for `think_ticketlog`
-- ----------------------------
DROP TABLE IF EXISTS `think_ticketlog`;
CREATE TABLE `think_ticketlog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `orderid` int(10) unsigned NOT NULL COMMENT '订单号',
  `uid` int(10) unsigned NOT NULL COMMENT '操作人id',
  `remark` varchar(255) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `ip` varchar(100) NOT NULL COMMENT 'ip地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_ticketlog
-- ----------------------------
INSERT INTO `think_ticketlog` VALUES ('1', '1', '1', '{\"is_spend\":\"0\",\"rec_name\":\"123\",\"rec_province\":\"\",\"rec_addr\":\"123\",\"rec_tel\":\"2147483647\",\"wuliunum\":\"\",\"adminremark\":\"\",\"mode\":\"uporder\"}', '1483839196', '127.0.0.1');
INSERT INTO `think_ticketlog` VALUES ('2', '1', '1', '{\"is_spend\":\"0\",\"rec_name\":\"\\u6536\\u8d27\\u4eba\\u59d3\\u540d\",\"rec_province\":\"\\u6536\\u8d27\\u4eba\\u7701\",\"rec_addr\":\"\\u6536\\u8d27\\u4eba\\u5730\\u5740\",\"rec_tel\":\"11111\",\"wuliunum\":\"\\u7269\\u6d41\\u53f7\",\"adminremark\":\"\\u5ba2\\u670d\\u5907\\u6ce8\",\"mode\":\"uporder\"}', '1483839215', '127.0.0.1');
INSERT INTO `think_ticketlog` VALUES ('3', '4', '1', '{\"is_spend\":\"1\",\"rec_name\":\"\\u59d3\\u540d\",\"rec_province\":\"\\u6536\\u8d27\\u4eba\\u7701\",\"rec_addr\":\"\\u5730\\u5740\",\"rec_tel\":\"2147483647\",\"wuliunum\":\"\\u7269\\u6d41\\u53f7\",\"adminremark\":\"\\u5ba2\\u670d\\u5907\\u6ce8\",\"mode\":\"uporder\"}', '1483840356', '127.0.0.1');

-- ----------------------------
-- Table structure for `think_user`
-- ----------------------------
DROP TABLE IF EXISTS `think_user`;
CREATE TABLE `think_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `logintime` int(10) unsigned NOT NULL,
  `loginip` varchar(30) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `realname` varchar(255) NOT NULL,
  `depid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属部门',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_user
-- ----------------------------
INSERT INTO `think_user` VALUES ('1', 'wudan', '883327915c4022331b5abcb9da2a390c', '1471740719', '123.23', '0', '吴丹', '0');
INSERT INTO `think_user` VALUES ('2', 'admin', '883327915c4022331b5abcb9da2a390c', '1471740719', '121', '0', '', '0');
INSERT INTO `think_user` VALUES ('3', '34545', 'd41d8cd98f00b204e9800998ecf8427e', '1471740719', '12', '0', '', '0');
INSERT INTO `think_user` VALUES ('4', 'w1212', 'c20ad4d76fe97759aa27a0c99bff6710', '1471740719', '1433', '0', '', '0');
INSERT INTO `think_user` VALUES ('5', 'lvwei', '883327915c4022331b5abcb9da2a390c', '0', '', '0', '', '0');

-- ----------------------------
-- Table structure for `think_workflow_deployment`
-- ----------------------------
DROP TABLE IF EXISTS `think_workflow_deployment`;
CREATE TABLE `think_workflow_deployment` (
  `moduleid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '模板id',
  `rule` text NOT NULL COMMENT '规则',
  `rulename` varchar(255) NOT NULL COMMENT '规则名称',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `creater` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建人',
  PRIMARY KEY (`moduleid`),
  UNIQUE KEY `rulename` (`rulename`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='模版';

-- ----------------------------
-- Records of think_workflow_deployment
-- ----------------------------
INSERT INTO `think_workflow_deployment` VALUES ('1', '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n\r\n<process name=\"demo\" xmlns=\"http://jbpm.org/4.4/jpdl\">\r\n   <start g=\"160,16,48,48\" name=\"start1\">\r\n      <transition g=\"-79,-22\" name=\"to exclusive1\" to=\"exclusive1\"/>\r\n   </start>\r\n   <decision g=\"267,106,48,48\" name=\"exclusive1\">\r\n   <handler class=\"\\CommonClass\\Order\\WorkFlowHandle\\HandleLeader\" />\r\n      <transition g=\"-52,-22\" name=\"to leader\" to=\"leader\"/>\r\n   </decision>\r\n   <task candidate-users=\"#{leader}\" g=\"114,129,92,52\" name=\"leader\">\r\n      <transition g=\"-79,-22\" name=\"to exclusive2\" to=\"exclusive2\"/>\r\n	  <transition g=\"-79,-22\" name=\"to cancel\" to=\"cancel\"/>\r\n	  <transition g=\"-79,-22\" name=\"to retreat\" to=\"retreat\"/>\r\n   </task>\r\n   <decision g=\"267,106,48,48\" name=\"exclusive2\">\r\n   <handler class=\"\\CommonClass\\Order\\WorkFlowHandle\\HandleChiefLeader\" />\r\n      <transition g=\"-52,-22\" name=\"to chiefleader\" to=\"chiefleader\"/>\r\n   </decision>\r\n   <task candidate-users=\"#{chiefleader}\" g=\"114,129,92,52\" name=\"chiefleader\">\r\n      <transition g=\"-79,-22\" name=\"to exclusive3\" to=\"exclusive3\"/>\r\n	  <transition g=\"-79,-22\" name=\"to cancel\" to=\"cancel\"/>\r\n	  <transition g=\"-79,-22\" name=\"to retreat\" to=\"retreat\"/>\r\n   </task>\r\n   <decision g=\"267,106,48,48\" name=\"exclusive3\">\r\n   <handler class=\"\\CommonClass\\Order\\WorkFlowHandle\\HandleStoreHouse\" />\r\n      <transition g=\"-52,-22\" name=\"to storehouse\" to=\"storehouse\"/>\r\n   </decision>\r\n   <task candidate-users=\"#{storehouse}\" g=\"114,129,92,52\" name=\"storehouse\">\r\n      <transition g=\"-79,-22\" name=\"to complete\" to=\"complete\"/>\r\n   </task>\r\n   <state name=\"retreat\">\r\n		<transition g=\"-79,-22\" name=\"to exclusive1\" to=\"exclusive1\"/>\r\n		<transition g=\"-79,-22\" name=\"to cancel\" to=\"cancel\"/>\r\n   </state>\r\n   <end name=\"complete\" />\r\n   <end name=\"cancel\" /> \r\n</process>', 'orderapprove', '0', '0');

-- ----------------------------
-- Table structure for `think_workflow_execution`
-- ----------------------------
DROP TABLE IF EXISTS `think_workflow_execution`;
CREATE TABLE `think_workflow_execution` (
  `dbid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '主键id',
  `activityname` varchar(255) NOT NULL COMMENT '当前活动节点名称',
  `procdefid` varchar(255) NOT NULL COMMENT '模板名称',
  `hasvars` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否有参数',
  `key` varchar(255) NOT NULL COMMENT '实例的表的名称+id',
  `id` varchar(255) NOT NULL COMMENT '模版+dbid',
  `state` varchar(255) NOT NULL COMMENT '状态active-root,inactive-concurrent-root,inactive-join,active-concurrent',
  `priority` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '优先级',
  `hisactinst` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '历史实例',
  `parent` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级execution,dbid',
  `parentidx` tinyint(1) unsigned NOT NULL COMMENT '父级execution,dbid',
  `instance` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '历史实例id',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`dbid`),
  UNIQUE KEY `id` (`id`),
  KEY `key` (`key`),
  KEY `instance` (`instance`),
  KEY `hisactinst` (`hisactinst`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='运行实例';

-- ----------------------------
-- Records of think_workflow_execution
-- ----------------------------
INSERT INTO `think_workflow_execution` VALUES ('11', 'leader', 'orderapprove', '1', '', 'orderapprove.11', 'active-root', '0', '15', '0', '0', '11', '1486282219');
INSERT INTO `think_workflow_execution` VALUES ('21', 'leader', 'orderapprove', '1', '', 'orderapprove.21', 'active-root', '0', '25', '0', '0', '21', '1486366089');
INSERT INTO `think_workflow_execution` VALUES ('31', 'leader', 'orderapprove', '1', '', 'orderapprove.31', 'active-root', '0', '35', '0', '0', '31', '1486368131');
INSERT INTO `think_workflow_execution` VALUES ('41', 'chiefleader', 'orderapprove', '1', '', 'orderapprove.41', 'active-root', '0', '84', '0', '0', '41', '1486368729');
INSERT INTO `think_workflow_execution` VALUES ('51', 'storehouse', 'orderapprove', '1', '', 'orderapprove.51', 'active-root', '0', '73', '0', '0', '51', '1487339825');
INSERT INTO `think_workflow_execution` VALUES ('91', 'leader', 'orderapprove', '1', '', 'orderapprove.91', 'active-root', '0', '95', '0', '0', '91', '1487423526');
INSERT INTO `think_workflow_execution` VALUES ('101', 'leader', 'orderapprove', '1', '', 'orderapprove.101', 'active-root', '0', '105', '0', '0', '101', '1487423620');
INSERT INTO `think_workflow_execution` VALUES ('111', 'storehouse', 'orderapprove', '1', '', 'orderapprove.111', 'active-root', '0', '133', '0', '0', '111', '1487424287');

-- ----------------------------
-- Table structure for `think_workflow_hist_actinst`
-- ----------------------------
DROP TABLE IF EXISTS `think_workflow_hist_actinst`;
CREATE TABLE `think_workflow_hist_actinst` (
  `dbid` int(10) unsigned NOT NULL COMMENT '主键dbid',
  `hprocid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '历史procid',
  `type` varchar(255) NOT NULL COMMENT '状态实例state',
  `execution` varchar(255) NOT NULL COMMENT 'execution id',
  `activity_name` varchar(255) NOT NULL COMMENT '当前活动名称',
  `start` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  `end` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `duration` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '持续时间',
  `transition` varchar(255) NOT NULL COMMENT '转换方向',
  `htask` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '任务历史',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`dbid`),
  KEY `hprocid` (`hprocid`),
  KEY `htask` (`htask`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='历史实例';

-- ----------------------------
-- Records of think_workflow_hist_actinst
-- ----------------------------
INSERT INTO `think_workflow_hist_actinst` VALUES ('14', '11', 'decision', 'orderapprove.11', 'exclusive1', '1486282219', '1486282219', '0', 'to leader', '0', '1486282219');
INSERT INTO `think_workflow_hist_actinst` VALUES ('15', '11', 'task', 'orderapprove.11', 'leader', '1486282219', '0', '0', '', '12', '1486282219');
INSERT INTO `think_workflow_hist_actinst` VALUES ('24', '21', 'decision', 'orderapprove.21', 'exclusive1', '1486366089', '1486366089', '0', 'to leader', '0', '1486366089');
INSERT INTO `think_workflow_hist_actinst` VALUES ('25', '21', 'task', 'orderapprove.21', 'leader', '1486366089', '0', '0', '', '22', '1486366089');
INSERT INTO `think_workflow_hist_actinst` VALUES ('34', '31', 'decision', 'orderapprove.31', 'exclusive1', '1486368131', '1486368131', '0', 'to leader', '0', '1486368131');
INSERT INTO `think_workflow_hist_actinst` VALUES ('35', '31', 'task', 'orderapprove.31', 'leader', '1486368131', '0', '0', '', '32', '1486368131');
INSERT INTO `think_workflow_hist_actinst` VALUES ('44', '41', 'decision', 'orderapprove.41', 'exclusive1', '1486368729', '1486368729', '0', 'to leader', '0', '1486368729');
INSERT INTO `think_workflow_hist_actinst` VALUES ('45', '41', 'task', 'orderapprove.41', 'leader', '1486368729', '1487423450', '1054721', 'to chiefleader', '42', '1486368729');
INSERT INTO `think_workflow_hist_actinst` VALUES ('54', '51', 'decision', 'orderapprove.51', 'exclusive1', '1487339825', '1487339825', '0', 'to leader', '0', '1487339825');
INSERT INTO `think_workflow_hist_actinst` VALUES ('55', '51', 'task', 'orderapprove.51', 'leader', '1487339825', '1487409509', '69684', 'to chiefleader', '52', '1487339825');
INSERT INTO `think_workflow_hist_actinst` VALUES ('63', '51', 'decision', 'orderapprove.51', 'exclusive2', '1487409509', '1487409509', '0', 'to chiefleader', '0', '1487409509');
INSERT INTO `think_workflow_hist_actinst` VALUES ('64', '51', 'task', 'orderapprove.51', 'chiefleader', '1487409509', '1487423325', '13816', 'to storehouse', '61', '1487409509');
INSERT INTO `think_workflow_hist_actinst` VALUES ('72', '51', 'decision', 'orderapprove.51', 'exclusive3', '1487423325', '1487423325', '0', 'to storehouse', '0', '1487423325');
INSERT INTO `think_workflow_hist_actinst` VALUES ('73', '51', 'task', 'orderapprove.51', 'storehouse', '1487423325', '0', '0', '', '71', '1487423325');
INSERT INTO `think_workflow_hist_actinst` VALUES ('83', '41', 'decision', 'orderapprove.41', 'exclusive2', '1487423450', '1487423450', '0', 'to chiefleader', '0', '1487423450');
INSERT INTO `think_workflow_hist_actinst` VALUES ('84', '41', 'task', 'orderapprove.41', 'chiefleader', '1487423450', '0', '0', '', '81', '1487423450');
INSERT INTO `think_workflow_hist_actinst` VALUES ('94', '91', 'decision', 'orderapprove.91', 'exclusive1', '1487423526', '1487423526', '0', 'to leader', '0', '1487423526');
INSERT INTO `think_workflow_hist_actinst` VALUES ('95', '91', 'task', 'orderapprove.91', 'leader', '1487423526', '0', '0', '', '92', '1487423526');
INSERT INTO `think_workflow_hist_actinst` VALUES ('104', '101', 'decision', 'orderapprove.101', 'exclusive1', '1487423620', '1487423620', '0', 'to leader', '0', '1487423620');
INSERT INTO `think_workflow_hist_actinst` VALUES ('105', '101', 'task', 'orderapprove.101', 'leader', '1487423620', '0', '0', '', '102', '1487423620');
INSERT INTO `think_workflow_hist_actinst` VALUES ('114', '111', 'decision', 'orderapprove.111', 'exclusive1', '1487424287', '1487424287', '0', 'to leader', '0', '1487424287');
INSERT INTO `think_workflow_hist_actinst` VALUES ('115', '111', 'task', 'orderapprove.111', 'leader', '1487424287', '1487424341', '54', 'to chiefleader', '112', '1487424287');
INSERT INTO `think_workflow_hist_actinst` VALUES ('123', '111', 'decision', 'orderapprove.111', 'exclusive2', '1487424341', '1487424341', '0', 'to chiefleader', '0', '1487424341');
INSERT INTO `think_workflow_hist_actinst` VALUES ('124', '111', 'task', 'orderapprove.111', 'chiefleader', '1487424341', '1487424376', '35', 'to storehouse', '121', '1487424341');
INSERT INTO `think_workflow_hist_actinst` VALUES ('132', '111', 'decision', 'orderapprove.111', 'exclusive3', '1487424376', '1487424376', '0', 'to storehouse', '0', '1487424376');
INSERT INTO `think_workflow_hist_actinst` VALUES ('133', '111', 'task', 'orderapprove.111', 'storehouse', '1487424376', '0', '0', '', '131', '1487424376');
INSERT INTO `think_workflow_hist_actinst` VALUES ('144', '141', 'decision', 'orderapprove.141', 'exclusive1', '1487424483', '1487424483', '0', 'to leader', '0', '1487424483');
INSERT INTO `think_workflow_hist_actinst` VALUES ('145', '141', 'task', 'orderapprove.141', 'leader', '1487424483', '1487424509', '26', 'to chiefleader', '142', '1487424483');
INSERT INTO `think_workflow_hist_actinst` VALUES ('153', '141', 'decision', 'orderapprove.141', 'exclusive2', '1487424509', '1487424509', '0', 'to chiefleader', '0', '1487424509');
INSERT INTO `think_workflow_hist_actinst` VALUES ('154', '141', 'task', 'orderapprove.141', 'chiefleader', '1487424509', '1487424712', '203', 'to storehouse', '151', '1487424509');
INSERT INTO `think_workflow_hist_actinst` VALUES ('163', '141', 'decision', 'orderapprove.141', 'exclusive3', '1487424712', '1487424712', '0', 'to storehouse', '0', '1487424712');
INSERT INTO `think_workflow_hist_actinst` VALUES ('164', '141', 'task', 'orderapprove.141', 'storehouse', '1487424712', '1487425503', '791', 'to complete', '161', '1487424712');
INSERT INTO `think_workflow_hist_actinst` VALUES ('184', '181', 'decision', 'orderapprove.181', 'exclusive1', '1487425655', '1487425655', '0', 'to leader', '0', '1487425655');
INSERT INTO `think_workflow_hist_actinst` VALUES ('185', '181', 'task', 'orderapprove.181', 'leader', '1487425655', '1487425819', '164', 'to retreat', '182', '1487425655');
INSERT INTO `think_workflow_hist_actinst` VALUES ('191', '181', 'state', 'orderapprove.181', 'retreat', '1487425819', '1487427598', '1779', 'to leader', '0', '1487425819');
INSERT INTO `think_workflow_hist_actinst` VALUES ('203', '181', 'decision', 'orderapprove.181', 'exclusive1', '1487427598', '1487427598', '0', 'to leader', '0', '1487427598');
INSERT INTO `think_workflow_hist_actinst` VALUES ('204', '181', 'task', 'orderapprove.181', 'leader', '1487427598', '1487428102', '504', 'to cancel', '201', '1487427598');

-- ----------------------------
-- Table structure for `think_workflow_hist_procinst`
-- ----------------------------
DROP TABLE IF EXISTS `think_workflow_hist_procinst`;
CREATE TABLE `think_workflow_hist_procinst` (
  `dbid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '主键id',
  `id` varchar(255) NOT NULL COMMENT '主键',
  `procdefid` varchar(255) NOT NULL COMMENT '规则名称',
  `key` varchar(255) NOT NULL COMMENT '业务实例',
  `start` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  `end` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `duration` int(10) unsigned NOT NULL COMMENT '间隔时间',
  `state` varchar(255) NOT NULL COMMENT '状态',
  `endactivity` varchar(255) NOT NULL COMMENT '结束的节点名称',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  PRIMARY KEY (`dbid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='历史运行个例';

-- ----------------------------
-- Records of think_workflow_hist_procinst
-- ----------------------------
INSERT INTO `think_workflow_hist_procinst` VALUES ('11', 'orderapprove.11', 'orderapprove', '', '1486282219', '0', '0', 'active', '', '0');
INSERT INTO `think_workflow_hist_procinst` VALUES ('21', 'orderapprove.21', 'orderapprove', '', '1486366089', '0', '0', 'active', '', '0');
INSERT INTO `think_workflow_hist_procinst` VALUES ('31', 'orderapprove.31', 'orderapprove', '', '1486368131', '0', '0', 'active', '', '0');
INSERT INTO `think_workflow_hist_procinst` VALUES ('41', 'orderapprove.41', 'orderapprove', '', '1486368729', '0', '0', 'active', '', '0');
INSERT INTO `think_workflow_hist_procinst` VALUES ('51', 'orderapprove.51', 'orderapprove', '', '1487339825', '0', '0', 'active', '', '0');
INSERT INTO `think_workflow_hist_procinst` VALUES ('91', 'orderapprove.91', 'orderapprove', '', '1487423526', '0', '0', 'active', '', '0');
INSERT INTO `think_workflow_hist_procinst` VALUES ('101', 'orderapprove.101', 'orderapprove', '', '1487423620', '0', '0', 'active', '', '0');
INSERT INTO `think_workflow_hist_procinst` VALUES ('111', 'orderapprove.111', 'orderapprove', '', '1487424287', '0', '0', 'active', '', '0');
INSERT INTO `think_workflow_hist_procinst` VALUES ('141', 'orderapprove.141', 'orderapprove', '', '1487424483', '1487425503', '1020', 'ended', 'complete', '0');
INSERT INTO `think_workflow_hist_procinst` VALUES ('181', 'orderapprove.181', 'orderapprove', '', '1487425655', '1487428102', '2447', 'ended', 'cancel', '0');

-- ----------------------------
-- Table structure for `think_workflow_hist_task`
-- ----------------------------
DROP TABLE IF EXISTS `think_workflow_hist_task`;
CREATE TABLE `think_workflow_hist_task` (
  `dbid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '主键id',
  `execution` varchar(255) NOT NULL COMMENT 'execution+id',
  `outcome` varchar(255) NOT NULL COMMENT '结束节点',
  `assignee` varchar(255) NOT NULL COMMENT '分配人',
  `priority` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '优先级',
  `state` varchar(255) NOT NULL COMMENT '完成状态complete',
  `create` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `end` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `duration` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '持续时间',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  PRIMARY KEY (`dbid`),
  KEY `execution` (`execution`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='历史任务';

-- ----------------------------
-- Records of think_workflow_hist_task
-- ----------------------------
INSERT INTO `think_workflow_hist_task` VALUES ('12', 'orderapprove.11', '', '', '0', 'open', '1486282219', '0', '0', '0');
INSERT INTO `think_workflow_hist_task` VALUES ('22', 'orderapprove.21', '', '', '0', 'open', '1486366089', '0', '0', '0');
INSERT INTO `think_workflow_hist_task` VALUES ('32', 'orderapprove.31', '', '', '0', 'open', '1486368131', '0', '0', '0');
INSERT INTO `think_workflow_hist_task` VALUES ('42', 'orderapprove.41', 'chiefleader', '', '0', 'complete', '1486368729', '1487423450', '1054721', '0');
INSERT INTO `think_workflow_hist_task` VALUES ('52', 'orderapprove.51', 'chiefleader', '', '0', 'complete', '1487339825', '1487409509', '69684', '0');
INSERT INTO `think_workflow_hist_task` VALUES ('61', 'orderapprove.51', 'storehouse', '', '0', 'complete', '1487409509', '1487423325', '13816', '0');
INSERT INTO `think_workflow_hist_task` VALUES ('71', 'orderapprove.51', '', '', '0', 'open', '1487423325', '0', '0', '0');
INSERT INTO `think_workflow_hist_task` VALUES ('81', 'orderapprove.41', '', '', '0', 'open', '1487423450', '0', '0', '0');
INSERT INTO `think_workflow_hist_task` VALUES ('92', 'orderapprove.91', '', '', '0', 'open', '1487423526', '0', '0', '0');
INSERT INTO `think_workflow_hist_task` VALUES ('102', 'orderapprove.101', '', '', '0', 'open', '1487423620', '0', '0', '0');
INSERT INTO `think_workflow_hist_task` VALUES ('112', 'orderapprove.111', 'chiefleader', '', '0', 'complete', '1487424287', '1487424341', '54', '0');
INSERT INTO `think_workflow_hist_task` VALUES ('121', 'orderapprove.111', 'storehouse', '', '0', 'complete', '1487424341', '1487424376', '35', '0');
INSERT INTO `think_workflow_hist_task` VALUES ('131', 'orderapprove.111', '', '', '0', 'open', '1487424376', '0', '0', '0');
INSERT INTO `think_workflow_hist_task` VALUES ('142', 'orderapprove.141', 'chiefleader', '', '0', 'complete', '1487424483', '1487424509', '26', '0');
INSERT INTO `think_workflow_hist_task` VALUES ('151', 'orderapprove.141', 'storehouse', '', '0', 'complete', '1487424509', '1487424712', '203', '0');
INSERT INTO `think_workflow_hist_task` VALUES ('161', 'orderapprove.141', 'complete', '', '0', 'complete', '1487424712', '1487425503', '791', '0');
INSERT INTO `think_workflow_hist_task` VALUES ('182', 'orderapprove.181', 'retreat', '', '0', 'complete', '1487425655', '1487425819', '164', '0');
INSERT INTO `think_workflow_hist_task` VALUES ('201', 'orderapprove.181', 'cancel', '', '0', 'complete', '1487427598', '1487428102', '504', '0');

-- ----------------------------
-- Table structure for `think_workflow_num`
-- ----------------------------
DROP TABLE IF EXISTS `think_workflow_num`;
CREATE TABLE `think_workflow_num` (
  `key` varchar(255) NOT NULL COMMENT '版本id',
  `version` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '版本',
  `value` varchar(255) NOT NULL COMMENT '当前累计值',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='计时器';

-- ----------------------------
-- Records of think_workflow_num
-- ----------------------------
INSERT INTO `think_workflow_num` VALUES ('next.dbid', '21', '211', '0');

-- ----------------------------
-- Table structure for `think_workflow_participation`
-- ----------------------------
DROP TABLE IF EXISTS `think_workflow_participation`;
CREATE TABLE `think_workflow_participation` (
  `dbid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '主键id',
  `groupid` varchar(255) NOT NULL COMMENT '部门id',
  `userid` varchar(255) NOT NULL COMMENT 'uid',
  `type` varchar(255) NOT NULL COMMENT '类型candidate',
  `task` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '任务id',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  PRIMARY KEY (`dbid`),
  KEY `FK_PART_TASK` (`task`),
  KEY `groupid` (`groupid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='参与者';

-- ----------------------------
-- Records of think_workflow_participation
-- ----------------------------
INSERT INTO `think_workflow_participation` VALUES ('13', '0', '1', 'candidate', '12', '0');
INSERT INTO `think_workflow_participation` VALUES ('23', '0', '1', 'candidate', '22', '0');
INSERT INTO `think_workflow_participation` VALUES ('33', '0', '1', 'candidate', '32', '0');
INSERT INTO `think_workflow_participation` VALUES ('82', '0', '1', 'candidate', '81', '0');
INSERT INTO `think_workflow_participation` VALUES ('93', '0', '1', 'candidate', '92', '0');
INSERT INTO `think_workflow_participation` VALUES ('103', '0', '1', 'candidate', '102', '0');

-- ----------------------------
-- Table structure for `think_workflow_task`
-- ----------------------------
DROP TABLE IF EXISTS `think_workflow_task`;
CREATE TABLE `think_workflow_task` (
  `dbid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '主键id',
  `name` varchar(255) NOT NULL COMMENT '姓名',
  `state` varchar(255) NOT NULL COMMENT '类型',
  `assignee` varchar(255) NOT NULL COMMENT '分配人',
  `priority` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '优先级',
  `create` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `execution_id` varchar(255) NOT NULL COMMENT 'executionid',
  `activity_name` varchar(255) NOT NULL COMMENT '当前名称',
  `hasvars` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '是否有参数',
  `execution` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'execution',
  `procinst` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '历史procinstid',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  PRIMARY KEY (`dbid`),
  KEY `execution` (`execution`),
  KEY `execution_id` (`execution_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务例子';

-- ----------------------------
-- Records of think_workflow_task
-- ----------------------------
INSERT INTO `think_workflow_task` VALUES ('12', 'leader', 'open', '', '0', '1486282219', 'orderapprove.11', 'leader', '1', '11', '11', '0');
INSERT INTO `think_workflow_task` VALUES ('22', 'leader', 'open', '', '0', '1486366089', 'orderapprove.21', 'leader', '1', '21', '21', '0');
INSERT INTO `think_workflow_task` VALUES ('32', 'leader', 'open', '', '0', '1486368131', 'orderapprove.31', 'leader', '1', '31', '31', '0');
INSERT INTO `think_workflow_task` VALUES ('71', 'storehouse', 'open', '', '0', '1487423325', 'orderapprove.51', 'storehouse', '1', '51', '51', '0');
INSERT INTO `think_workflow_task` VALUES ('81', 'chiefleader', 'open', '', '0', '1487423450', 'orderapprove.41', 'chiefleader', '1', '41', '41', '0');
INSERT INTO `think_workflow_task` VALUES ('92', 'leader', 'open', '', '0', '1487423526', 'orderapprove.91', 'leader', '1', '91', '91', '0');
INSERT INTO `think_workflow_task` VALUES ('102', 'leader', 'open', '', '0', '1487423620', 'orderapprove.101', 'leader', '1', '101', '101', '0');
INSERT INTO `think_workflow_task` VALUES ('131', 'storehouse', 'open', '', '0', '1487424376', 'orderapprove.111', 'storehouse', '1', '111', '111', '0');

-- ----------------------------
-- Table structure for `think_workflow_variable`
-- ----------------------------
DROP TABLE IF EXISTS `think_workflow_variable`;
CREATE TABLE `think_workflow_variable` (
  `dbid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '主键id',
  `class` varchar(255) NOT NULL COMMENT '类型',
  `key` varchar(255) NOT NULL COMMENT '键',
  `execution` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'execution',
  `double_value` double NOT NULL DEFAULT '0' COMMENT 'double数量',
  `int_value` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '整型',
  `string_value` varchar(255) NOT NULL COMMENT '字符型',
  `text_value` longtext NOT NULL COMMENT '文本型',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`dbid`),
  KEY `execution` (`execution`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='流程参数';

-- ----------------------------
-- Records of think_workflow_variable
-- ----------------------------
INSERT INTO `think_workflow_variable` VALUES ('16', 'int', 'leader', '11', '0', '1', '', '', '1486282219');
INSERT INTO `think_workflow_variable` VALUES ('26', 'int', 'leader', '21', '0', '1', '', '', '1486366089');
INSERT INTO `think_workflow_variable` VALUES ('36', 'int', 'leader', '31', '0', '1', '', '', '1486368131');
INSERT INTO `think_workflow_variable` VALUES ('46', 'int', 'leader', '41', '0', '1', '', '', '1486368729');
INSERT INTO `think_workflow_variable` VALUES ('56', 'int', 'leader', '51', '0', '1', '', '', '1487339825');
INSERT INTO `think_workflow_variable` VALUES ('65', 'int', 'chiefleader', '51', '0', '1', '', '', '1487409509');
INSERT INTO `think_workflow_variable` VALUES ('74', 'int', 'leader', '51', '0', '1', '', '', '1487423325');
INSERT INTO `think_workflow_variable` VALUES ('85', 'int', 'chiefleader', '41', '0', '1', '', '', '1487423450');
INSERT INTO `think_workflow_variable` VALUES ('96', 'int', 'leader', '91', '0', '1', '', '', '1487423526');
INSERT INTO `think_workflow_variable` VALUES ('106', 'int', 'leader', '101', '0', '1', '', '', '1487423620');
INSERT INTO `think_workflow_variable` VALUES ('116', 'int', 'leader', '111', '0', '1', '', '', '1487424287');
INSERT INTO `think_workflow_variable` VALUES ('125', 'int', 'chiefleader', '111', '0', '1', '', '', '1487424341');
INSERT INTO `think_workflow_variable` VALUES ('134', 'int', 'leader', '111', '0', '1', '', '', '1487424376');

-- ----------------------------
-- Table structure for `think_ysy_address`
-- ----------------------------
DROP TABLE IF EXISTS `think_ysy_address`;
CREATE TABLE `think_ysy_address` (
  `tel` char(20) NOT NULL DEFAULT '0',
  `addr` char(30) NOT NULL,
  `name` char(10) NOT NULL,
  PRIMARY KEY (`tel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_ysy_address
-- ----------------------------
INSERT INTO `think_ysy_address` VALUES ('1', '2', '3');

-- ----------------------------
-- Table structure for `think_ysy_approvelog`
-- ----------------------------
DROP TABLE IF EXISTS `think_ysy_approvelog`;
CREATE TABLE `think_ysy_approvelog` (
  `orderid` int(11) unsigned NOT NULL,
  `nodename` char(255) NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_ysy_approvelog
-- ----------------------------
INSERT INTO `think_ysy_approvelog` VALUES ('1487064770', 'cancel', '1', '0', '');
INSERT INTO `think_ysy_approvelog` VALUES ('1487064770', 'disable', '1', '0', '1');
INSERT INTO `think_ysy_approvelog` VALUES ('1487339825', 'chiefleader', '1', '1487409509', '1212');
INSERT INTO `think_ysy_approvelog` VALUES ('1487424286', 'chiefleader', '1', '1487424341', '567657');
INSERT INTO `think_ysy_approvelog` VALUES ('1487424286', 'storehouse', '1', '1487424376', '567567');
INSERT INTO `think_ysy_approvelog` VALUES ('1487424482', 'chiefleader', '1', '1487424509', '456456');
INSERT INTO `think_ysy_approvelog` VALUES ('1487424482', 'storehouse', '1', '1487424712', '56757567567567');
INSERT INTO `think_ysy_approvelog` VALUES ('1487424482', 'complete', '1', '1487425503', '567567678678');
INSERT INTO `think_ysy_approvelog` VALUES ('1487425655', 'retreat', '1', '1487425819', '123123');
INSERT INTO `think_ysy_approvelog` VALUES ('1487425655', 'cancel', '1', '1487428102', '567567');

-- ----------------------------
-- Table structure for `think_ysy_checkin`
-- ----------------------------
DROP TABLE IF EXISTS `think_ysy_checkin`;
CREATE TABLE `think_ysy_checkin` (
  `checkin_id` int(10) unsigned NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '加入时间',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建人',
  PRIMARY KEY (`checkin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_ysy_checkin
-- ----------------------------
INSERT INTO `think_ysy_checkin` VALUES ('1486714488', '1486716966', '1');
INSERT INTO `think_ysy_checkin` VALUES ('2147483647', '1485965580', '1');

-- ----------------------------
-- Table structure for `think_ysy_checkingoods`
-- ----------------------------
DROP TABLE IF EXISTS `think_ysy_checkingoods`;
CREATE TABLE `think_ysy_checkingoods` (
  `cg_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `checkin_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goodsnum` int(10) unsigned NOT NULL DEFAULT '0',
  `grossweight` int(10) unsigned NOT NULL DEFAULT '0',
  `weight` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cg_id`),
  KEY `checkin_id` (`checkin_id`,`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_ysy_checkingoods
-- ----------------------------
INSERT INTO `think_ysy_checkingoods` VALUES ('121', '2147483647', '3', '11', '22', '33');
INSERT INTO `think_ysy_checkingoods` VALUES ('122', '2147483647', '4', '66', '77', '88');
INSERT INTO `think_ysy_checkingoods` VALUES ('137', '1486716966', '20', '33', '55', '77');
INSERT INTO `think_ysy_checkingoods` VALUES ('138', '1486716966', '21', '44', '66', '88');

-- ----------------------------
-- Table structure for `think_ysy_department`
-- ----------------------------
DROP TABLE IF EXISTS `think_ysy_department`;
CREATE TABLE `think_ysy_department` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `depname` char(30) NOT NULL,
  `leader` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '领导人',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级部门',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_ysy_department
-- ----------------------------

-- ----------------------------
-- Table structure for `think_ysy_format`
-- ----------------------------
DROP TABLE IF EXISTS `think_ysy_format`;
CREATE TABLE `think_ysy_format` (
  `format_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '规格id',
  `format_name` char(20) NOT NULL,
  `format_remark` varchar(255) NOT NULL,
  `format_pid` int(10) unsigned NOT NULL DEFAULT '0',
  `unit_id` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '0删除1显示',
  PRIMARY KEY (`format_id`),
  KEY `format_pid` (`format_pid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_ysy_format
-- ----------------------------
INSERT INTO `think_ysy_format` VALUES ('1', '苹果', '', '0', '0', '1');
INSERT INTO `think_ysy_format` VALUES ('2', '梨', '', '0', '0', '1');
INSERT INTO `think_ysy_format` VALUES ('3', '苹果50G', '', '1', '0', '1');
INSERT INTO `think_ysy_format` VALUES ('4', '梨10G', '', '2', '0', '1');

-- ----------------------------
-- Table structure for `think_ysy_goods`
-- ----------------------------
DROP TABLE IF EXISTS `think_ysy_goods`;
CREATE TABLE `think_ysy_goods` (
  `goods_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品编号',
  `format_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '规格',
  `remark` varchar(255) NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `status` tinyint(10) unsigned NOT NULL DEFAULT '1' COMMENT '0删除1开始',
  `goods_name` char(20) NOT NULL COMMENT '商品名称',
  PRIMARY KEY (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_ysy_goods
-- ----------------------------
INSERT INTO `think_ysy_goods` VALUES ('20', '1', '', '1486478222', '1', '324');
INSERT INTO `think_ysy_goods` VALUES ('21', '3', '', '1486692858', '1', '你好我是吴丹');

-- ----------------------------
-- Table structure for `think_ysy_goodspackage`
-- ----------------------------
DROP TABLE IF EXISTS `think_ysy_goodspackage`;
CREATE TABLE `think_ysy_goodspackage` (
  `id` int(10) unsigned NOT NULL COMMENT '包id',
  `packagename` char(30) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0正常1删除2不显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_ysy_goodspackage
-- ----------------------------
INSERT INTO `think_ysy_goodspackage` VALUES ('0', 'test22', '11', '1487054487', '1', '0');
INSERT INTO `think_ysy_goodspackage` VALUES ('2', '212', '232', '1232', '0', '0');
INSERT INTO `think_ysy_goodspackage` VALUES ('1486733119', '12', '12', '1487054413', '1', '0');
INSERT INTO `think_ysy_goodspackage` VALUES ('1486733142', '2222', '12555', '1486822492', '1', '0');
INSERT INTO `think_ysy_goodspackage` VALUES ('1486733192', 'wudan222', 'wudan333', '1486821166', '1', '0');
INSERT INTO `think_ysy_goodspackage` VALUES ('1487055184', 'wudanTest', 'wudanTest', '1487055184', '1', '0');
INSERT INTO `think_ysy_goodspackage` VALUES ('2147483647', '商品', '22', '1486819758', '1', '0');

-- ----------------------------
-- Table structure for `think_ysy_goodspackageinfo`
-- ----------------------------
DROP TABLE IF EXISTS `think_ysy_goodspackageinfo`;
CREATE TABLE `think_ysy_goodspackageinfo` (
  `packageid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '包id',
  `goods_id` int(11) unsigned NOT NULL DEFAULT '0',
  `num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '数量',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间',
  UNIQUE KEY `packageid` (`packageid`,`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_ysy_goodspackageinfo
-- ----------------------------
INSERT INTO `think_ysy_goodspackageinfo` VALUES ('1486733119', '20', '1', '1487054413');
INSERT INTO `think_ysy_goodspackageinfo` VALUES ('1486733119', '21', '1', '1487054413');
INSERT INTO `think_ysy_goodspackageinfo` VALUES ('1486733142', '20', '1', '1486822492');
INSERT INTO `think_ysy_goodspackageinfo` VALUES ('1486733142', '21', '1', '1486822492');
INSERT INTO `think_ysy_goodspackageinfo` VALUES ('1486819758', '20', '1', '1486819758');
INSERT INTO `think_ysy_goodspackageinfo` VALUES ('1486819758', '21', '1', '1486819758');
INSERT INTO `think_ysy_goodspackageinfo` VALUES ('1486821166', '20', '1', '1486821166');
INSERT INTO `think_ysy_goodspackageinfo` VALUES ('1486821166', '21', '1', '1486821166');
INSERT INTO `think_ysy_goodspackageinfo` VALUES ('1487054487', '20', '1', '1487054487');
INSERT INTO `think_ysy_goodspackageinfo` VALUES ('1487054487', '21', '2', '1487054487');
INSERT INTO `think_ysy_goodspackageinfo` VALUES ('1487055184', '20', '1', '1487055184');
INSERT INTO `think_ysy_goodspackageinfo` VALUES ('1487055184', '21', '2', '1487055184');

-- ----------------------------
-- Table structure for `think_ysy_order`
-- ----------------------------
DROP TABLE IF EXISTS `think_ysy_order`;
CREATE TABLE `think_ysy_order` (
  `order_id` int(10) unsigned NOT NULL,
  `order_user` int(10) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '加入时间',
  `isolder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `requireddeliverytime` int(10) unsigned NOT NULL DEFAULT '0',
  `deliveryttpe` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `remark` varchar(255) NOT NULL,
  `belonger` int(10) unsigned NOT NULL DEFAULT '0',
  `rece_name` char(20) NOT NULL,
  `rece_addr` char(30) NOT NULL,
  `rece_tel` char(30) NOT NULL,
  `status` char(20) NOT NULL,
  `flowerid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '流程id',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_ysy_order
-- ----------------------------
INSERT INTO `think_ysy_order` VALUES ('1486366087', '1', '1486366087', '0', '1486310400', '1', '0.00', '', '1', '3', '2', '1', '', '0');
INSERT INTO `think_ysy_order` VALUES ('1486368130', '1', '1486368130', '0', '1486310400', '1', '0.00', '', '1', '3', '2', '1', '', '0');
INSERT INTO `think_ysy_order` VALUES ('1486368728', '1', '1486368728', '0', '1486310400', '1', '0.00', '', '1', '3', '2', '1', 'leader', '41');
INSERT INTO `think_ysy_order` VALUES ('1487064770', '1', '1487064770', '1', '1487001600', '0', '0.00', '', '1', '3', '2', '1', '', '0');
INSERT INTO `think_ysy_order` VALUES ('1487339550', '0', '1487339550', '0', '1500134400', '1', '0.00', '', '1', '23', '23', '2', '', '0');
INSERT INTO `think_ysy_order` VALUES ('1487339825', '1', '1487339825', '0', '1500134400', '1', '0.00', '', '1', '23', '23', '2', 'chiefleader', '51');
INSERT INTO `think_ysy_order` VALUES ('1487423526', '1', '1487423526', '1', '1487347200', '0', '0.00', '', '1', '3', '2', '1', 'leader', '91');
INSERT INTO `think_ysy_order` VALUES ('1487424482', '1', '1487424482', '1', '1487347200', '0', '0.00', '', '1', '3', '2', '1', 'complete', '141');
INSERT INTO `think_ysy_order` VALUES ('1487425655', '1', '1487425655', '1', '1487347200', '0', '0.00', '', '1', '3', '2', '1', 'cancel', '181');

-- ----------------------------
-- Table structure for `think_ysy_ordergoods`
-- ----------------------------
DROP TABLE IF EXISTS `think_ysy_ordergoods`;
CREATE TABLE `think_ysy_ordergoods` (
  `package_id` int(10) unsigned NOT NULL DEFAULT '0',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `num` int(10) unsigned NOT NULL DEFAULT '0',
  `ordertype` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  UNIQUE KEY `package_id` (`package_id`,`order_id`,`ordertype`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_ysy_ordergoods
-- ----------------------------
INSERT INTO `think_ysy_ordergoods` VALUES ('1486733119', '1487064770', '2', '0', '11.00');
INSERT INTO `think_ysy_ordergoods` VALUES ('1486733119', '1487423526', '1', '0', '11.00');
INSERT INTO `think_ysy_ordergoods` VALUES ('1486733119', '1487423620', '1', '0', '11.00');
INSERT INTO `think_ysy_ordergoods` VALUES ('1486733119', '1487424151', '1', '0', '11.00');
INSERT INTO `think_ysy_ordergoods` VALUES ('1486733119', '1487425655', '1', '0', '11.00');
INSERT INTO `think_ysy_ordergoods` VALUES ('1486733142', '1487339550', '1', '0', '12.23');
INSERT INTO `think_ysy_ordergoods` VALUES ('1486733142', '1487339825', '1', '0', '12.23');
INSERT INTO `think_ysy_ordergoods` VALUES ('1486733142', '1487424286', '1', '0', '12.23');
INSERT INTO `think_ysy_ordergoods` VALUES ('1486733142', '1487424482', '1', '0', '12.23');
INSERT INTO `think_ysy_ordergoods` VALUES ('1487055184', '1487064770', '1', '0', '1.00');
INSERT INTO `think_ysy_ordergoods` VALUES ('1487055184', '1487339550', '2', '0', '1.00');
INSERT INTO `think_ysy_ordergoods` VALUES ('1487055184', '1487339825', '2', '0', '1.00');
INSERT INTO `think_ysy_ordergoods` VALUES ('2147483647', '1486366087', '1', '1', '3.00');
INSERT INTO `think_ysy_ordergoods` VALUES ('2147483647', '1486368130', '1', '1', '3.00');
INSERT INTO `think_ysy_ordergoods` VALUES ('2147483647', '1486368728', '1', '1', '3.00');
INSERT INTO `think_ysy_ordergoods` VALUES ('2147483647', '2147483647', '10', '2', '4.00');
INSERT INTO `think_ysy_ordergoods` VALUES ('2147483647', '2147483647', '20', '5', '7.00');

-- ----------------------------
-- Table structure for `think_ysy_packageprice`
-- ----------------------------
DROP TABLE IF EXISTS `think_ysy_packageprice`;
CREATE TABLE `think_ysy_packageprice` (
  `packageid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '组合商品id',
  `ordertype` int(10) unsigned NOT NULL COMMENT '订单类型',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '价格',
  `addtime` int(10) unsigned NOT NULL,
  `bonus` decimal(5,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '提成',
  UNIQUE KEY `package` (`packageid`,`ordertype`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_ysy_packageprice
-- ----------------------------
INSERT INTO `think_ysy_packageprice` VALUES ('1486733119', '0', '11.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486733119', '1', '2.30', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486733119', '2', '23.30', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486733119', '3', '12.30', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486733119', '4', '12.30', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486733119', '5', '12.50', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486733119', '6', '2.30', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486733142', '0', '12.23', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486733142', '1', '2.30', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486733142', '2', '23.30', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486733142', '3', '12.30', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486733142', '4', '12.30', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486733142', '5', '12.50', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486733142', '6', '2.30', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486819758', '0', '2.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486819758', '1', '3.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486819758', '2', '4.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486819758', '3', '5.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486819758', '4', '6.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486819758', '5', '7.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486819758', '6', '1.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486821166', '0', '12.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486821166', '1', '22.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486821166', '2', '12.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486821166', '3', '12.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486821166', '4', '22.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486821166', '5', '22.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1486821166', '6', '33.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1487054487', '0', '1.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1487054487', '1', '2.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1487054487', '2', '3.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1487054487', '3', '4.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1487054487', '4', '5.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1487054487', '5', '6.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1487054487', '6', '8.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1487055184', '0', '1.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1487055184', '1', '2.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1487055184', '2', '3.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1487055184', '3', '4.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1487055184', '4', '5.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1487055184', '5', '6.00', '0', '0.00');
INSERT INTO `think_ysy_packageprice` VALUES ('1487055184', '6', '7.00', '0', '0.00');

-- ----------------------------
-- Table structure for `think_ysy_stock`
-- ----------------------------
DROP TABLE IF EXISTS `think_ysy_stock`;
CREATE TABLE `think_ysy_stock` (
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_num` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_weight` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_ysy_stock
-- ----------------------------
INSERT INTO `think_ysy_stock` VALUES ('20', '18', '55');
INSERT INTO `think_ysy_stock` VALUES ('21', '25', '66');
INSERT INTO `think_ysy_stock` VALUES ('111', '140', '63');
INSERT INTO `think_ysy_stock` VALUES ('222', '270', '128');

-- ----------------------------
-- Table structure for `think_ysy_unit`
-- ----------------------------
DROP TABLE IF EXISTS `think_ysy_unit`;
CREATE TABLE `think_ysy_unit` (
  `unit_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `unit_name` char(20) NOT NULL COMMENT '单位名称',
  `unit_remark` varchar(255) NOT NULL COMMENT '备注',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '加入时间',
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_ysy_unit
-- ----------------------------
INSERT INTO `think_ysy_unit` VALUES ('1', '个', '', '0');
INSERT INTO `think_ysy_unit` VALUES ('2', '箱', '', '0');
INSERT INTO `think_ysy_unit` VALUES ('3', '斤', '', '0');

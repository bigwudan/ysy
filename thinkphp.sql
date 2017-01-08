/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : thinkphp

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2017-01-08 12:03:47
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

-- ----------------------------
-- Table structure for `think_flow_execution`
-- ----------------------------
DROP TABLE IF EXISTS `think_flow_execution`;
CREATE TABLE `think_flow_execution` (
  `dbid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '主键id',
  `activityname` varchar(255) NOT NULL,
  `procdefid` varchar(255) NOT NULL COMMENT '模板名称',
  `hasvars` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '是否有参数',
  `key` varchar(255) NOT NULL COMMENT '实例的表的名称+id',
  `id` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL COMMENT '状态active-root,inactive-concurrent-root,inactive-join,active-concurrent',
  `priority` int(10) NOT NULL,
  `hisactinst` int(10) unsigned NOT NULL DEFAULT '0',
  `parent` int(10) NOT NULL,
  `parentidx` tinyint(3) NOT NULL,
  `instance` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '历史实例id',
  PRIMARY KEY (`dbid`),
  UNIQUE KEY `id` (`id`),
  KEY `key` (`key`),
  KEY `instance` (`instance`),
  KEY `hisactinst` (`hisactinst`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_flow_execution
-- ----------------------------

-- ----------------------------
-- Table structure for `think_flow_histactinst`
-- ----------------------------
DROP TABLE IF EXISTS `think_flow_histactinst`;
CREATE TABLE `think_flow_histactinst` (
  `dbid` int(10) unsigned NOT NULL,
  `hprocid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '历史procid',
  `type` varchar(255) NOT NULL COMMENT '状态实例state',
  `execution` varchar(255) NOT NULL DEFAULT '' COMMENT 'execution id',
  `activity_name` varchar(255) NOT NULL,
  `start` varchar(255) NOT NULL,
  `end` varchar(255) NOT NULL,
  `duration` int(10) unsigned NOT NULL,
  `transition` varchar(255) NOT NULL,
  `htask` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '任务历史',
  PRIMARY KEY (`dbid`),
  KEY `hprocid` (`hprocid`),
  KEY `htask` (`htask`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_flow_histactinst
-- ----------------------------
INSERT INTO `think_flow_histactinst` VALUES ('14', '11', 'decision', 'test1.11', 'exclusive1', '1480410246', '1480410246', '0', 'to task1', '0');
INSERT INTO `think_flow_histactinst` VALUES ('15', '11', 'task', 'test1.11', 'task1', '1480410246', '1480410570', '324', 'to task2', '12');
INSERT INTO `think_flow_histactinst` VALUES ('24', '11', 'task', 'test1.11', 'task2', '1480410570', '1480410636', '66', 'to end1', '21');

-- ----------------------------
-- Table structure for `think_flow_histprocinst`
-- ----------------------------
DROP TABLE IF EXISTS `think_flow_histprocinst`;
CREATE TABLE `think_flow_histprocinst` (
  `dbid` int(10) NOT NULL,
  `id` varchar(255) NOT NULL,
  `procdefid` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `start` int(10) unsigned NOT NULL,
  `end` int(10) unsigned NOT NULL,
  `duration` int(10) NOT NULL,
  `state` varchar(255) NOT NULL,
  `endactivity` varchar(255) NOT NULL,
  PRIMARY KEY (`dbid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_flow_histprocinst
-- ----------------------------
INSERT INTO `think_flow_histprocinst` VALUES ('11', 'test1.11', 'test1', '', '1480410241', '1480410636', '395', 'ended', 'end1');

-- ----------------------------
-- Table structure for `think_flow_histtask`
-- ----------------------------
DROP TABLE IF EXISTS `think_flow_histtask`;
CREATE TABLE `think_flow_histtask` (
  `dbid` int(10) NOT NULL,
  `execution` varchar(255) NOT NULL COMMENT 'execution+id',
  `outcome` varchar(255) NOT NULL COMMENT '结束节点',
  `assignee` varchar(255) NOT NULL COMMENT '分配人',
  `priority` int(10) unsigned NOT NULL DEFAULT '0',
  `state` varchar(255) NOT NULL COMMENT 'complete',
  `create` int(10) unsigned NOT NULL DEFAULT '0',
  `end` int(10) unsigned NOT NULL DEFAULT '0',
  `duration` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`dbid`),
  KEY `execution` (`execution`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_flow_histtask
-- ----------------------------
INSERT INTO `think_flow_histtask` VALUES ('12', 'test1.11', 'task2', '', '0', 'complete', '1480410243', '1480410570', '327');
INSERT INTO `think_flow_histtask` VALUES ('21', 'test1.11', 'end1', '', '0', 'complete', '1480410570', '1480410636', '66');

-- ----------------------------
-- Table structure for `think_flow_modulerule`
-- ----------------------------
DROP TABLE IF EXISTS `think_flow_modulerule`;
CREATE TABLE `think_flow_modulerule` (
  `moduleid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '模板id',
  `rule` text NOT NULL,
  `rulename` varchar(255) NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `creater` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建人',
  PRIMARY KEY (`moduleid`),
  UNIQUE KEY `rulename` (`rulename`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_flow_modulerule
-- ----------------------------
INSERT INTO `think_flow_modulerule` VALUES ('7', '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n\r\n<process name=\"demo\" xmlns=\"http://jbpm.org/4.4/jpdl\">\r\n   <start g=\"160,16,48,48\" name=\"start1\">\r\n      <transition g=\"-79,-22\" name=\"to exclusive1\" to=\"exclusive1\"/>\r\n   </start>\r\n   <state g=\"495,422,9,5\" name=\"state4\"/>\r\n   <end g=\"336,385,48,48\" name=\"end1\"/>\r\n   <decision g=\"267,106,48,48\" name=\"exclusive1\">\r\n   <handler class=\"\\Org\\Jbmp\\TestHander\\testHander\" />\r\n      <transition g=\"-52,-22\" name=\"to task1\" to=\"task1\"/>\r\n   </decision>\r\n   <task candidate-users=\"#{user1}\" g=\"114,129,92,52\" name=\"task1\">\r\n      <transition g=\"-79,-22\" name=\"to exclusive2\" to=\"exclusive2\"/>\r\n   </task>\r\n   <decision g=\"89,202,48,48\" name=\"exclusive2\">\r\n   <handler class=\"Org\\Jbmp\\TestHander\\test2Hander\" />\r\n      <transition g=\"-52,-22\" name=\"to task2\" to=\"task2\"/>\r\n   </decision>\r\n   <task candidate-groups=\"#{team1,team2}\" g=\"57,280,92,52\" name=\"task2\">\r\n      <transition g=\"-50,-22\" name=\"to end1\" to=\"end1\"/>\r\n   </task>\r\n</process>', 'test', '0', '0');
INSERT INTO `think_flow_modulerule` VALUES ('8', '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n\r\n<process name=\"demo\" xmlns=\"http://jbpm.org/4.4/jpdl\">\r\n   <start g=\"178,-11,48,48\" name=\"start1\">\r\n      <transition name=\"to exclusive1\" to=\"exclusive1\" g=\"-79,-22\"/>\r\n   </start>\r\n   <state g=\"495,422,9,5\" name=\"state4\"/>\r\n   <end g=\"155,397,48,48\" name=\"end1\"/>\r\n   <decision name=\"exclusive1\" g=\"203,88,48,48\">\r\n   <handler class=\"Org\\Jbmp\\TestHander\\testHander\" />\r\n      <transition name=\"to state1\" to=\"state1\" g=\"-56,-22\"/>\r\n      <transition name=\"to task1\" to=\"task1\" g=\"-52,-22\"/>\r\n   </decision>\r\n   <state name=\"state1\" g=\"73,208,92,52\">\r\n      <transition name=\"to end1\" to=\"end1\" g=\"-50,-22\"/>\r\n   </state>\r\n   <task name=\"task1\" g=\"241,204,92,52\" candidate-users=\"#{user1}\">\r\n      <transition name=\"to task2\" to=\"task2\" g=\"-52,-22\"/>\r\n   </task>\r\n   <task name=\"task2\" g=\"254,315,92,52\" candidate-groups=\"#{team1,team2}\">\r\n      <transition name=\"to end1\" to=\"end1\" g=\"-50,-22\"/>\r\n   </task>\r\n</process>', 'test1', '0', '0');

-- ----------------------------
-- Table structure for `think_flow_participation`
-- ----------------------------
DROP TABLE IF EXISTS `think_flow_participation`;
CREATE TABLE `think_flow_participation` (
  `dbid` int(10) NOT NULL,
  `groupid` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL COMMENT 'candidate',
  `task` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '任务id',
  PRIMARY KEY (`dbid`),
  KEY `FK_PART_TASK` (`task`),
  KEY `groupid` (`groupid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_flow_participation
-- ----------------------------

-- ----------------------------
-- Table structure for `think_flow_property`
-- ----------------------------
DROP TABLE IF EXISTS `think_flow_property`;
CREATE TABLE `think_flow_property` (
  `key` varchar(255) NOT NULL,
  `version` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '版本',
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_flow_property
-- ----------------------------
INSERT INTO `think_flow_property` VALUES ('next.dbid', '3', '31');

-- ----------------------------
-- Table structure for `think_flow_task`
-- ----------------------------
DROP TABLE IF EXISTS `think_flow_task`;
CREATE TABLE `think_flow_task` (
  `dbid` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `assignee` varchar(255) NOT NULL,
  `priority` int(11) unsigned NOT NULL DEFAULT '0',
  `create` int(10) unsigned NOT NULL DEFAULT '0',
  `execution_id` varchar(255) NOT NULL,
  `activity_name` varchar(255) NOT NULL,
  `hasvars` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `execution` int(10) unsigned NOT NULL DEFAULT '0',
  `procinst` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`dbid`),
  KEY `execution` (`execution`),
  KEY `execution_id` (`execution_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_flow_task
-- ----------------------------

-- ----------------------------
-- Table structure for `think_flow_variable`
-- ----------------------------
DROP TABLE IF EXISTS `think_flow_variable`;
CREATE TABLE `think_flow_variable` (
  `dbid` int(10) NOT NULL,
  `class` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `execution` int(10) NOT NULL,
  `double_value` double NOT NULL,
  `int_value` int(20) NOT NULL,
  `string_value` varchar(255) NOT NULL,
  `text_value` longtext NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`dbid`),
  KEY `execution` (`execution`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_flow_variable
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

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
INSERT INTO `think_order` VALUES ('1314', '吴春华', '9月10日', '1473436800', '赠送', '', '个人', '', '杨国强', '', '自提', '吴春华', '蓝莓酒（半甜型）', '瓶', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1315', '吴春华', '9月10日', '1473523200', '个人', '', '个人', '', '谭其', '', '顺丰', '吴春华', '月饼', '海上明月', '200.00', '1', '200.00');
INSERT INTO `think_order` VALUES ('1316', '吴春华', '9月10日', '1473523200', '个人', '', '个人', '', '张春梅', '', '顺丰', '吴春华', '月饼', '海上明月', '200.00', '1', '200.00');
INSERT INTO `think_order` VALUES ('1317', '吴春华', '9月10日', '1473523200', '个人', '', '个人', '', '杨小生', '', '顺丰', '吴春华', '月饼', '海上明月', '200.00', '1', '200.00');
INSERT INTO `think_order` VALUES ('1318', '吴春华', '9月10日', '1473523200', '个人', '', '个人', '', '刘琼辉', '', '顺丰', '吴春华', '月饼', '海上明月', '200.00', '1', '200.00');
INSERT INTO `think_order` VALUES ('1319', '林魏莉', '9月10日', '1473436800', '个人', '', '个人', '', '喻老师', '', '公司配送', '林魏莉', '月饼', '海上明月', '200.00', '1', '200.00');
INSERT INTO `think_order` VALUES ('1320', '林魏莉', '9月10日', '1473436800', '个人', '', '个人', '', '周梅', '', '公司配送', '林魏莉', '月饼', '海上明月', '200.00', '1', '200.00');
INSERT INTO `think_order` VALUES ('1321', '林魏莉', '9月10日', '1473436800', '个人', '', '个人', '', '朱例颖', '', '公司配送', '林魏莉', '月饼', '海上明月', '200.00', '1', '200.00');
INSERT INTO `think_order` VALUES ('1322', '林魏莉', '9月10日', '1473436800', '个人', '', '个人', '', '丁老师', '', '公司配送', '林魏莉', '月饼', '海上明月', '200.00', '1', '200.00');
INSERT INTO `think_order` VALUES ('1323', '邓倩', '9月10日', '1473436800', '个人', '', '个人', '', '兰春', '', '顺丰', '邓倩', '月饼', '秋月明辉', '120.00', '1', '120.00');
INSERT INTO `think_order` VALUES ('1324', '邓倩', '9月10日', '1473436800', '个人', '', '个人', '', '牟春', '', '顺丰', '邓倩', '月饼', '秋月明辉', '120.00', '1', '120.00');
INSERT INTO `think_order` VALUES ('1325', '邓倩', '9月10日', '1473436800', '个人', '', '个人', '', '陈伟', '', '顺丰', '邓倩', '月饼', '秋月明辉', '120.00', '1', '120.00');
INSERT INTO `think_order` VALUES ('1326', '邓倩', '9月10日', '1473609600', '个人', '', '个人', '', '熊勇', '转账', '顺丰', '邓倩', '月饼', '秋月明辉', '120.00', '1', '120.00');
INSERT INTO `think_order` VALUES ('1327', '吴春华', '9月11日', '1473523200', '个人', '', '个人', '', '赵锡丽', '', '顺丰', '吴春华', '月饼', '秋月明辉', '120.00', '1', '120.00');
INSERT INTO `think_order` VALUES ('1328', '李宝华', '9月11日', '1473523200', '个人', '', '个人', '', '许老师', '', '公司配送', '李宝华', '月饼', '海上明月', '200.00', '1', '200.00');
INSERT INTO `think_order` VALUES ('1329', '邓倩', '9月11日', '0', '团购', '', '重庆银行大礼堂支行', '', '张成', '', '顺丰', '邓倩', '月饼', '秋月明辉', '198.00', '1', '198.00');
INSERT INTO `think_order` VALUES ('1330', '邓倩', '9月11日', '0', '团购', '', '重庆银行大礼堂支行', '', '张明', '', '顺丰', '邓倩', '月饼', '秋月明辉', '198.00', '1', '198.00');
INSERT INTO `think_order` VALUES ('1331', '邓倩', '9月11日', '0', '团购', '', '重庆银行大礼堂支行', '', '曾臻', '', '顺丰', '邓倩', '月饼', '秋月明辉', '198.00', '1', '198.00');
INSERT INTO `think_order` VALUES ('1332', '邓倩', '9月11日', '0', '团购', '', '重庆银行大礼堂支行', '', '袁媛', '', '顺丰', '邓倩', '月饼', '秋月明辉', '198.00', '1', '198.00');
INSERT INTO `think_order` VALUES ('1333', '邓倩', '9月11日', '0', '团购', '', '重庆银行大礼堂支行', '', '柏女士', '', '顺丰', '邓倩', '月饼', '秋月明辉', '198.00', '2', '396.00');
INSERT INTO `think_order` VALUES ('1334', '梁琳', '9月11日', '1473696000', '团购', '', '农业银行三亚湾支行', '', '王行长', '', '公司配送', '梁琳', '月饼', '海上明月', '288.00', '7', '2016.00');
INSERT INTO `think_order` VALUES ('1335', '谭盛予', '9月11日', '1473523200', '团购', '', '腾江科技', '', '夏云雪', '', '顺丰', '谭盛予', '月饼', '海上明月', '318.00', '1', '318.00');
INSERT INTO `think_order` VALUES ('1336', '谭盛予', '9月11日', '1473523200', '团购', '', '腾江科技', '', '黄发有', '', '顺丰', '谭盛予', '月饼', '海上明月', '318.00', '1', '318.00');
INSERT INTO `think_order` VALUES ('1337', '谭盛予', '9月11日', '1473523200', '团购', '', '腾江科技', '', '姜国厚', '', '顺丰', '谭盛予', '月饼', '海上明月', '318.00', '1', '318.00');
INSERT INTO `think_order` VALUES ('1338', '谭盛予', '9月11日', '1473523200', '团购', '', '腾江科技', '', '姜宽', '', '顺丰', '谭盛予', '月饼', '海上明月', '318.00', '1', '318.00');
INSERT INTO `think_order` VALUES ('1339', '谭盛予', '9月11日', '1473523200', '团购', '', '腾江科技', '', '姚长风', '', '顺丰', '谭盛予', '月饼', '海上明月', '318.00', '1', '318.00');
INSERT INTO `think_order` VALUES ('1340', '谭盛予', '9月11日', '1473523200', '团购', '', '腾江科技', '', '叶延平', '', '顺丰', '谭盛予', '月饼', '海上明月', '318.00', '1', '318.00');
INSERT INTO `think_order` VALUES ('1341', '谭盛予', '9月11日', '1473523200', '团购', '', '腾江科技', '', '辛鹏', '', '顺丰', '谭盛予', '月饼', '海上明月', '318.00', '1', '318.00');
INSERT INTO `think_order` VALUES ('1342', '谭盛予', '9月11日', '1473523200', '团购', '', '腾江科技', '', '信长青', '', '顺丰', '谭盛予', '月饼', '秋月明辉', '188.00', '1', '188.00');
INSERT INTO `think_order` VALUES ('1343', '谭盛予', '9月11日', '1473523200', '团购', '', '腾江科技', '', '朱剑波', '', '顺丰', '谭盛予', '月饼', '秋月明辉', '188.00', '1', '188.00');
INSERT INTO `think_order` VALUES ('1344', '谭盛予', '9月11日', '1473523200', '团购', '', '腾江科技', '', '刘苏华', '', '顺丰', '谭盛予', '月饼', '秋月明辉', '188.00', '1', '188.00');
INSERT INTO `think_order` VALUES ('1345', '谭盛予', '9月11日', '1473523200', '团购', '', '腾江科技', '', '董贺楠', '', '顺丰', '谭盛予', '月饼', '秋月明辉', '188.00', '1', '188.00');
INSERT INTO `think_order` VALUES ('1346', '谭盛予', '9月11日', '1473523200', '团购', '', '腾江科技', '', '谭中林', '', '顺丰', '谭盛予', '月饼', '秋月明辉', '188.00', '1', '188.00');
INSERT INTO `think_order` VALUES ('1347', '谭盛予', '9月11日', '1473523200', '团购', '', '腾江科技', '', '胡海滨', '', '顺丰', '谭盛予', '月饼', '秋月明辉', '188.00', '1', '188.00');
INSERT INTO `think_order` VALUES ('1348', '谭盛予', '9月11日', '1473523200', '团购', '', '腾江科技', '', '芦方文', '', '顺丰', '谭盛予', '月饼', '秋月明辉', '188.00', '1', '188.00');
INSERT INTO `think_order` VALUES ('1349', '谭盛予', '9月11日', '1473523200', '团购', '', '腾江科技', '', '汪恭升', '', '顺丰', '谭盛予', '月饼', '秋月明辉', '188.00', '1', '188.00');
INSERT INTO `think_order` VALUES ('1350', '谭盛予', '9月11日', '0', '团购', '', '腾江科技', '', '杜玉杰', '', '顺丰', '谭盛予', '月饼', '秋月明辉', '188.00', '1', '188.00');
INSERT INTO `think_order` VALUES ('1351', '李宝华', '9月11日', '1473609600', '渠道送样', '', '个人', '', '易诗群', '', '公司配送', '李宝华', '月饼', '', '0.00', '0', '0.00');
INSERT INTO `think_order` VALUES ('1352', '李宝华', '9月11日', '1473609600', '渠道送样', '', '个人', '', '易诗群', '', '公司配送', '李宝华', '月饼', '', '0.00', '0', '0.00');
INSERT INTO `think_order` VALUES ('1353', '吴春华', '9月11日', '1473609600', '团购', '', '重庆讯房网络科技有限公司', '', '刘钰', '转账', '公司配送', '吴春华', '月饼', '秋月明辉', '188.00', '23', '4324.00');
INSERT INTO `think_order` VALUES ('1354', '谭盛予', '9月11日', '1473609600', '个人', '', '个人', '', '熊茜', '', '', '谭盛予', '月饼', '秋月明辉', '120.00', '1', '120.00');
INSERT INTO `think_order` VALUES ('1355', '谭盛予', '9月11日', '1473609600', '渠道', '', '怀创', '', '吴健', '', '', '谭盛予', '月饼', '秋月明辉', '120.00', '1', '120.00');
INSERT INTO `think_order` VALUES ('1356', '谭盛予', '9月11日', '1473609600', '个人', '', '个人', '', '杨晓', '', '', '谭盛予', '月饼', '秋月明辉', '120.00', '11', '1320.00');
INSERT INTO `think_order` VALUES ('1357', '', '9月11日', '0', '个人', '', '个人', '', '杨晓', '', '', '', '月饼', '秋月明辉', '200.00', '3', '600.00');
INSERT INTO `think_order` VALUES ('1358', '冯明亮', '9月12日', '0', '个人', '', '个人', '', '朱小丰', '', '自提', '冯明亮', '月饼', '海上明月', '288.00', '6', '1728.00');
INSERT INTO `think_order` VALUES ('1359', '梁琳', '9月12日', '0', '团购', '', '浦发银行重庆分行', '', '陈怡', '', '', '梁琳', '月饼', '秋月明辉', '200.00', '5', '1000.00');
INSERT INTO `think_order` VALUES ('1360', '邓倩', '9月12日', '0', '个人', '', '个人', '', '杨老师', '', '', '邓倩', '月饼', '秋月明辉', '120.00', '5', '600.00');
INSERT INTO `think_order` VALUES ('1361', '邓倩', '9月12日', '0', '团购', '', '重庆银行大礼堂支行', '', '余主任', '', '', '邓倩', '月饼', '秋月明辉', '198.00', '5', '990.00');
INSERT INTO `think_order` VALUES ('1362', '谭盛予', '9月12日', '0', '团购', '', '嘉滨苑', '', '', '', '', '谭盛予', '月饼', '秋月明辉', '188.00', '10', '1880.00');
INSERT INTO `think_order` VALUES ('1363', '林魏莉', '9月12日', '0', '团购', '', '西演集团', '', '', '', '', '林魏莉', '月饼', '海上明月', '288.00', '1', '288.00');
INSERT INTO `think_order` VALUES ('1364', '林魏莉', '9月12日', '0', '团购', '', '西演集团', '', '', '', '', '林魏莉', '月饼', '秋月明辉', '188.00', '8', '1504.00');
INSERT INTO `think_order` VALUES ('1365', '周川宁', '9月12日', '0', '个人', '', '个人', '', '周川宁', '', '', '周川宁', '月饼', '海上明月', '190.00', '1', '190.00');
INSERT INTO `think_order` VALUES ('1366', '周川宁', '9月12日', '0', '个人', '', '个人', '', '周川宁', '', '', '周川宁', '月饼', '秋月明辉', '100.00', '9', '900.00');
INSERT INTO `think_order` VALUES ('1367', '吴春华', '9月12日', '0', '团购', '', '九龙坡公安局', '', '罗书记', '', '', '吴春华', '月饼', '秋月明辉', '150.00', '19', '2850.00');
INSERT INTO `think_order` VALUES ('1368', '林魏莉', '9月13日', '0', '个人', '', '个人', '', '张彦兵', '', '', '林魏莉', '月饼', '海上明月', '200.00', '1', '200.00');
INSERT INTO `think_order` VALUES ('1369', '梁琳', '9月13日', '0', '渠道', '', '杨斌', '', '郭俊', '', '', '梁琳', '月饼', '秋月明辉', '100.00', '73', '7300.00');
INSERT INTO `think_order` VALUES ('1370', '梁琳', '9月13日', '0', '团购', '', '重庆银行小龙坎支行', '', '黄勇', '', '', '梁琳', '月饼', '海上明月', '288.00', '3', '864.00');
INSERT INTO `think_order` VALUES ('1371', '梁琳', '9月13日', '0', '赠送', '', '重庆银行小龙坎支行', '', '苏行长', '', '', '梁琳', '月饼', '海上明月', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1372', '邓倩', '9月13日', '0', '团购', '', '重庆银行大礼堂支行', '', '余主任', '', '', '邓倩', '月饼', '秋月明辉', '198.00', '3', '594.00');
INSERT INTO `think_order` VALUES ('1373', '邓倩', '9月13日', '0', '团购', '', '重庆银行大礼堂支行', '', '王渝', '', '', '邓倩', '月饼', '秋月明辉', '198.00', '1', '198.00');
INSERT INTO `think_order` VALUES ('1374', '李宝华', '9月13日', '0', '会员', '', '发改委', '', '王主任', '扣费', '', '李宝华', '月饼', '海上明月', '315.00', '1', '315.00');
INSERT INTO `think_order` VALUES ('1375', '林魏莉', '9月13日', '0', '个人', '', '个人', '', '胡天明', '', '', '林魏莉', '月饼', '秋月明辉', '120.00', '6', '720.00');
INSERT INTO `think_order` VALUES ('1376', '李宝华', '9月13日', '0', '个人', '', '个人', '', '', '', '', '李宝华', '月饼', '海上明月', '200.00', '5', '1000.00');
INSERT INTO `think_order` VALUES ('1377', '谭盛予', '9月13日', '0', '渠道', '', '江口醇', '', '小唐', '', '', '谭盛予', '月饼', '秋月明辉', '120.00', '2', '240.00');
INSERT INTO `think_order` VALUES ('1378', '谭盛予', '9月13日', '0', '渠道', '', '何苗苗', '', '刘莉', '', '', '谭盛予', '月饼', '海上明月', '200.00', '2', '400.00');
INSERT INTO `think_order` VALUES ('1379', '谭盛予', '9月13日', '0', '渠道', '', '何苗苗', '', '刘莉', '', '', '谭盛予', '月饼', '秋月明辉', '120.00', '4', '480.00');
INSERT INTO `think_order` VALUES ('1380', '谭盛予', '9月13日', '0', '渠道', '', '怀创', '', '贺怀梦', '', '', '谭盛予', '月饼', '海上明月', '200.00', '6', '1200.00');
INSERT INTO `think_order` VALUES ('1381', '吴春华', '9月13日', '0', '个人', '', '个人', '', '刘泱', '', '', '吴春华', '月饼', '秋月明辉', '188.00', '5', '940.00');
INSERT INTO `think_order` VALUES ('1382', '梁琳', '9月13日', '0', '个人', '', '个人', '', '许晗', '', '', '梁琳', '月饼', '秋月明辉', '198.00', '1', '198.00');
INSERT INTO `think_order` VALUES ('1383', '谭盛予', '9月14日', '0', '渠道', '', '怀创', '', '王进荣', '', '', '谭盛予', '月饼', '秋月明辉', '120.00', '4', '480.00');
INSERT INTO `think_order` VALUES ('1384', '梁琳', '9月14日', '0', '个人', '', '个人', '', '许晗', '', '', '梁琳', '月饼', '秋月明辉', '120.00', '2', '240.00');
INSERT INTO `think_order` VALUES ('1385', '谭盛予', '9月14日', '0', '渠道', '', '怀创', '', '桑建', '', '', '谭盛予', '月饼', '秋月明辉', '120.00', '1', '120.00');
INSERT INTO `think_order` VALUES ('1386', '谭盛予', '9月14日', '0', '个人', '', '个人', '', '肖露', '', '', '谭盛予', '月饼', '秋月明辉', '120.00', '1', '120.00');
INSERT INTO `think_order` VALUES ('1387', '谭盛予', '9月14日', '0', '渠道', '', '江口醇', '', '小唐', '', '', '谭盛予', '蓝莓酒（半甜型）', '瓶', '70.00', '24', '1680.00');
INSERT INTO `think_order` VALUES ('1388', '谭盛予', '9月14日', '0', '渠道', '', '怀创', '', '贺怀梦', '', '', '谭盛予', '蜂蜜', '', '50.00', '2', '100.00');
INSERT INTO `think_order` VALUES ('1389', '谭盛予', '9月14日', '0', '渠道', '', '怀创', '', '贺怀梦', '', '', '谭盛予', '果酱', '', '50.00', '2', '100.00');
INSERT INTO `think_order` VALUES ('1390', '谭盛予', '9月14日', '0', '员工', '', '个人', '', '谭盛予', '', '自提', '谭盛予', '蓝莓酒（半甜型）', '瓶', '70.00', '6', '420.00');
INSERT INTO `think_order` VALUES ('1391', '林魏莉', '9月18日', '0', '个人', '', '个人', '', '', '', '', '林魏莉', '月饼', '海上明月', '200.00', '2', '400.00');
INSERT INTO `think_order` VALUES ('1392', '邓倩', '9月20日', '1474387200', '个人', '', '个人', '', '陆老师', '转账', '巴伦支', '邓倩', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1393', '邓倩', '9月20日', '1474387200', '个人', '', '个人', '', '冯老师', '转账', '巴伦支', '邓倩', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1394', '梁琳', '9月21日', '1474387200', '赠送', '', '个人', '', '陈凤', '赠送', '自提', '梁琳', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1395', '邓倩', '9月21日', '1474387200', '个人', '', '个人', '', '杨老师', '转账', '巴伦支', '邓倩', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1396', '梁琳', '9月21日', '1474387200', '赠送', '', '浙商银行重庆分行', '', '金总', '赠送', '自送', '梁琳', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1397', '梁琳', '9月21日', '1474387200', '赠送', '', '重庆银行小龙坎支行', '', '苏行长', '赠送', '自送', '梁琳', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1398', '梁琳', '9月21日', '1474387200', '赠送', '', '博恩集团', '', '魏总', '赠送', '自送', '梁琳', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1399', '邓倩', '9月21日', '1474387200', '赠送', '', '德高广告', '', '马女士', '赠送', '巴伦支', '邓倩', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1400', '邓倩', '9月21日', '1474387200', '赠送', '', '重庆银行大礼堂支行', '', '周卫东', '赠送', '巴伦支', '邓倩', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1401', '谭盛予', '9月21日', '1474387200', '个人', '', '个人', '', '蔡小姐', '现金', '顺丰', '谭盛予', '石榴', '6个装', '158.00', '3', '474.00');
INSERT INTO `think_order` VALUES ('1402', '张蓉', '9月21日', '1474387200', '赠送', '', '童家桥税务', '', '胡涛（所长）', '赠送', '自送', '张蓉', '石榴', '6个装', '0.00', '3', '0.00');
INSERT INTO `think_order` VALUES ('1403', '邓倩', '9月21日', '1474473600', '团购', '', '大礼堂客户张韬', '', '张韬', '转账', '巴伦支', '邓倩', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1404', '邓倩', '9月21日', '1474473600', '团购', '', '大礼堂客户陈先生', '', '陈先生', '转账', '巴伦支', '邓倩', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1405', '谭盛予', '9月21日', '1474387200', '渠道赠送', '', '修源堂', '', '沈总', '送样', '自送', '谭盛予', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1406', '李宝华', '9月21日', '1474473600', '赠送', '', '个人', '', '刘梅', '赠送', '巴伦支', '李宝华', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1407', '蒋娟', '9月21日', '1474387200', '员工折扣', '', '员工折扣', '', '蒋娟', '现金', '自提', '蒋娟', '石榴', '6个装', '126.00', '1', '126.00');
INSERT INTO `think_order` VALUES ('1408', '林魏莉', '9月21日', '1474387200', '员工折扣', '', '员工折扣', '', '林魏莉', '现金', '自提', '林魏莉', '石榴', '6个装', '126.00', '2', '252.00');
INSERT INTO `think_order` VALUES ('1409', '李宝华', '9月21日', '1474473600', '会员', '', '会员', '', '李老师', '现金', '巴伦支', '李宝华', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1410', '李宝华', '9月21日', '1474473600', '会员', '', '会员', '', '纪老师', '现金', '自送', '李宝华', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1411', '梁琳', '9月21日', '1474387200', '个人', '', '个人', '', '屈少东', '现金', '顺丰', '梁琳', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1412', '梁琳', '9月21日', '1474819200', '赠送', '', '重大支行', '', '杨兴梅', '赠送', '公司配送', '梁琳', '石榴', '6个装', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1413', '李宝华', '9月21日', '1474473600', '会员', '', '会员', '', '何晓舟・廖院长', '现金', '自送', '李宝华', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1414', '邓倩', '9月21日', '1474473600', '个人', '', '个人', '', '贺敏', '转账', '巴伦支', '邓倩', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1415', '邓倩', '9月21日', '1474473600', '团购', '', '重庆银行大礼堂支行', '', '万女士', '转账', '巴伦支', '邓倩', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1416', '李宝华', '9月21日', '1474473600', '团购', '', '重庆银行大礼堂支行', '', '大礼堂支行', '转账', '公司配送', '李宝华', '石榴', '6个装', '158.00', '10', '1580.00');
INSERT INTO `think_order` VALUES ('1417', '李宝华', '9月21日', '1474473600', '赠送', '', '重庆银行大礼堂支行', '', '方行长', '赠送', '公司配送', '李宝华', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1418', '邓倩', '9月21日', '1474473600', '团购', '', '重庆银行大礼堂支行', '', '何女士', '转账', '巴伦支', '邓倩', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1419', '邓倩', '9月21日', '1474473600', '团购', '', '重庆银行大礼堂支行', '', '邓先生', '转账', '巴伦支', '邓倩', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1420', '邓倩', '9月21日', '1474473600', '团购', '', '重庆银行大礼堂支行', '', '邓女士', '转账', '巴伦支', '邓倩', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1421', '李宝华', '9月21日', '1474473600', '赠送', '', '重庆银行高新支行', '', '重庆高新支行', '赠送', '公司配送', '李宝华', '石榴', '6个装', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1422', '梁琳', '9月21日', '1474387200', '赠送', '', '易极付', '', '王希娅', '赠送', '自提', '梁琳', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1423', '林魏莉', '9月21日', '1474905600', '个人', '', '个人', '', '杨丽琳', '转账', '顺丰', '林魏莉', '玫瑰香葡萄', '5斤/件', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1424', '谭盛予', '9月22日', '1474473600', '个人', '', '个人', '', '张典', '现金', '巴伦支', '谭盛予', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1425', '林魏莉', '9月22日', '1474473600', '员工折扣', '', '员工折扣', '', '林魏莉', '现金', '自提', '林魏莉', '石榴', '6个装', '126.00', '1', '126.00');
INSERT INTO `think_order` VALUES ('1426', '何程', '9月22日', '1474473600', '赠送', '', '个人', '', '秦琴', '赠送', '巴伦支', '何程', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1427', '谭盛予', '9月22日', '1474473600', '个人', '', '个人', '', '陈广・邢艳', '现金', '顺丰', '谭盛予', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1428', '谭盛予', '9月22日', '1474560000', '个人', '', '个人', '', '周洲', '现金', '巴伦支', '谭盛予', '石榴', '6个装', '178.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1429', '谭盛予', '9月22日', '1474473600', '个人', '', '个人', '', '唐力', '现金', '巴伦支', '谭盛予', '石榴', '6个装', '178.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1430', '吴勇', '9月22日', '1474473600', '团购', '', '远达环保', '', '袁莱', '转账', '公司配送', '吴勇', '石榴', '6个装', '158.00', '8', '1264.00');
INSERT INTO `think_order` VALUES ('1431', '', '9月22日', '0', '赠送', '', '远达环保', '', '袁莱', '', '', '', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1432', '邓倩', '9月22日', '1474560000', '团购', '', '重庆银行大礼堂支行', '', '张女士', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1433', '邓倩', '9月22日', '1474560000', '个人', '', '个人', '', '刁丽', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1434', '童云', '9月22日', '1474473600', '员工折扣', '', '员工折扣', '', '童云', '现金', '自提', '童云', '石榴', '6个装', '126.00', '1', '126.00');
INSERT INTO `think_order` VALUES ('1435', '邓倩', '9月22日', '1474560000', '个人', '', '个人', '', '侯老师', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1436', '邓倩', '9月22日', '1474560000', '团购', '', '重庆银行大礼堂支行', '', '申女士', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1437', '谭盛予', '9月22日', '1474473600', '员工折扣', '', '员工折扣', '', '谭盛予', '现金', '自提', '谭盛予', '石榴', '6个装', '126.00', '3', '378.00');
INSERT INTO `think_order` VALUES ('1438', '邓倩', '9月22日', '1474560000', '团购', '', '重庆银行大礼堂支行', '', '薛云红', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1439', '李宝华', '9月22日', '1474560000', '团购', '', '重庆银行大礼堂支行', '', '大礼堂', '转账', '公司配送', '李宝华', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1440', '邓倩', '9月22日', '1474560000', '团购', '', '重庆银行大礼堂支行', '', '黄先生', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1441', '林魏莉', '9月22日', '1474560000', '员工折扣', '', '员工折扣', '', '孙秋', '转账', '顺丰', '林魏莉', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1442', '李宝华', '9月22日', '1474560000', '团购', '', '重庆银行大礼堂支行', '', '大礼堂支行', '转账', '公司配送', '李宝华', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1443', '林魏莉', '9月22日', '1474560000', '个人', '', '个人', '', '杨满英', '转账', '公司配送', '林魏莉', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1444', '邓倩', '9月22日', '1474560000', '个人', '', '个人', '', '何玉红', '转账', '公司配送', '邓倩', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1445', '邓倩', '9月22日', '1474560000', '团购', '', '重庆银行大礼堂支行', '', '周丽', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1446', '周川宁', '9月23日', '1474560000', '员工折扣', '', '员工折扣', '', '周絮', '现金', '顺丰', '周川宁', '石榴', '6个装', '126.00', '1', '126.00');
INSERT INTO `think_order` VALUES ('1447', '周川宁', '9月23日', '1474560000', '员工折扣', '', '员工折扣', '', '施建儿', '现金', '顺丰', '周川宁', '石榴', '6个装', '126.00', '1', '126.00');
INSERT INTO `think_order` VALUES ('1448', '谭盛予', '9月23日', '1474560000', '个人', '', '个人', '', '于学飞', '现金', '顺丰', '谭盛予', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1449', '林魏莉', '9月23日', '1474560000', '员工折扣', '', '员工折扣', '', '周梅', '现金', '顺丰', '林魏莉', '石榴', '6个装', '126.00', '1', '126.00');
INSERT INTO `think_order` VALUES ('1450', '林魏莉', '9月23日', '1474560000', '个人', '', '个人', '', '柳信维', '现金', '顺丰', '林魏莉', '石榴', '6个装', '126.00', '1', '126.00');
INSERT INTO `think_order` VALUES ('1451', '林魏莉', '9月23日', '1474560000', '员工折扣', '', '员工折扣', '', '王静', '现金', '顺丰', '林魏莉', '石榴', '6个装', '126.00', '1', '126.00');
INSERT INTO `think_order` VALUES ('1452', '林魏莉', '9月23日', '1474560000', '个人', '', '个人', '', '喻正华', '现金', '顺丰', '林魏莉', '石榴', '6个装', '126.00', '1', '126.00');
INSERT INTO `think_order` VALUES ('1453', '林魏莉', '9月23日', '1475078400', '个人', '', '个人', '', '杨满英', '转账', '公司配送', '林魏莉', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1454', '邓倩', '9月23日', '1474819200', '团购', '', '个人', '', '邓娅玲', '转账', '公司配送', '邓倩', '石榴', '6个装', '158.00', '3', '474.00');
INSERT INTO `think_order` VALUES ('1455', '李宝华', '9月23日', '1474560000', '渠道赠送', '', '个人', '', '杨茂昌', '赠送', '自送', '李宝华', '石榴', '6个装', '0.00', '3', '0.00');
INSERT INTO `think_order` VALUES ('1456', '林魏莉', '9月23日', '1474560000', '渠道送样', '', '谢灏', '', '张老师', '现金', '公司配送', '林魏莉', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1457', '林魏莉', '9月23日', '1474560000', '赠送', '', '个人', '', '于勇', '赠送', '自提', '林魏莉', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1458', '周川宁', '9月23日', '1474819200', '赠送', '', '个人', '', '刘帆', '赠送', '顺丰', '周川宁', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1459', '邓倩', '9月23日', '1474819200', '个人', '', '个人', '', '杨雪飞', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1460', '邓倩', '9月23日', '1474819200', '个人', '', '个人', '', '杨老师', '转账', '顺丰', '邓倩', '玫瑰香葡萄', '5斤/件', '158.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1461', '邓倩', '9月23日', '1474819200', '个人', '', '个人', '', '马兰', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1462', '邓倩', '9月23日', '1474819200', '个人', '', '个人', '', '马兰', '转账', '顺丰', '邓倩', '玫瑰香葡萄', '5斤/件', '158.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1463', '邓倩', '9月23日', '1474819200', '个人', '', '个人', '', '王晓波', '转账', '公司配送', '邓倩', '石榴', '6个装', '158.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1464', '邓倩', '9月23日', '1474819200', '个人', '', '个人', '', '李静', '转账', '公司配送', '邓倩', '石榴', '6个装', '158.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1465', '微店', '9月23日', '1474819200', '微店订单', '', '微店订单', '', '王羚又', '', '顺丰', '微店', '石榴', '6个装', '178.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1466', '微店', '9月23日', '1474819200', '微店订单', '', '微店订单', '', '陈思宇', '', '顺丰', '微店', '石榴', '6个装', '178.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1467', '邓倩', '9月24日', '1474819200', '个人', '', '个人', '', '邓昭茂', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1468', '邓倩', '9月24日', '1474819200', '个人', '', '个人', '', '邓昭茂', '转账', '顺丰', '邓倩', '玫瑰香葡萄', '5斤/件', '158.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1469', '林魏莉', '9月24日', '1474819200', '渠道', '', '谢灏', '', '李仁兰', '现金', '顺丰', '林魏莉', '石榴', '6个装', '158.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1470', '童云', '9月24日', '1474819200', '员工折扣', '', '员工折扣', '', '张弦', '现金', '顺丰', '童云', '石榴', '6个装', '126.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1471', '吴勇', '9月24日', '1474819200', '赠送', '', '个人', '', '岳梅', '赠送', '顺丰', '吴勇', '石榴', '6个装', '0.00', '1', '356.00');
INSERT INTO `think_order` VALUES ('1472', '邓倩', '9月25日', '1474819200', '个人', '', '个人', '', '韩彦秋', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '2', '356.00');
INSERT INTO `think_order` VALUES ('1473', '李宝华', '9月25日', '1474819200', '赠送', '', '个人', '', '周卫东', '赠送', '顺丰', '李宝华', '玫瑰香葡萄', '5斤/件', '0.00', '1', '356.00');
INSERT INTO `think_order` VALUES ('1474', '邓倩', '9月25日', '1474819200', '个人', '', '个人', '', '贺敏', '转账', '顺丰', '邓倩', '玫瑰香葡萄', '5斤/件', '158.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1475', '梁琳', '9月26日', '1474819200', '个人', '', '个人', '', '陈凤', '现金', '顺丰', '梁琳', '石榴', '6个装', '158.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1476', '梁琳', '9月26日', '1474819200', '个人', '', '个人', '', '刘家琳', '现金', '顺丰', '梁琳', '石榴', '6个装', '158.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1477', '梁琳', '9月26日', '1474819200', '个人', '', '个人', '', '孙佳', '现金', '顺丰', '梁琳', '石榴', '6个装', '158.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1478', '梁琳', '9月26日', '1474819200', '个人', '', '个人', '', '邓秀兰', '现金', '顺丰', '梁琳', '石榴', '6个装', '158.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1479', '微店', '9月26日', '1474819200', '微店订单', '', '微店订单', '', '\"	甘沁灵\"', '微店结算', '顺丰', '微店', '石榴', '6个装', '178.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1480', '微店', '9月26日', '1474819200', '微店订单', '', '微店订单', '', '\"	丁颖\"', '微店结算', '顺丰', '微店', '石榴', '6个装', '178.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1481', '微店', '9月26日', '1474819200', '微店订单', '', '微店订单', '', '\"	王羚又\"', '微店结算', '顺丰', '微店', '玫瑰香葡萄', '5斤/件', '178.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1482', '林魏莉', '9月26日', '1474732800', '个人', '', '个人', '', '喻振华', '现金', '公司配送', '林魏莉', '石榴', '9个装', '158.00', '2', '178.00');
INSERT INTO `think_order` VALUES ('1483', '林魏莉', '9月26日', '1474819200', '赠送', '', '个人', '', '于勇', '', '顺丰', '林魏莉', '石榴', '6个装', '0.00', '2', '356.00');
INSERT INTO `think_order` VALUES ('1484', '林魏莉', '9月26日', '1474819200', '赠送', '', '个人', '', '于勇', '', '顺丰', '林魏莉', '玫瑰香葡萄', '5斤/件', '0.00', '2', '356.00');
INSERT INTO `think_order` VALUES ('1485', '林魏莉', '9月26日', '1474819200', '赠送', '', '成都华润', '', '姚尧', '', '顺丰', '林魏莉', '石榴', '6个装', '0.00', '1', '356.00');
INSERT INTO `think_order` VALUES ('1486', '林魏莉', '9月26日', '1474819200', '赠送', '', '成都华润', '', '姚尧', '', '顺丰', '林魏莉', '玫瑰香葡萄', '5斤/件', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1487', '邓倩', '9月26日', '1474905600', '个人', '', '个人', '', 'Cherry', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1488', '谭盛予', '9月26日', '1474819200', '个人', '', '个人', '', '赵之宁', '现金', '自提', '谭盛予', '石榴', '6个装', '158.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1489', '林魏莉', '9月26日', '1474905600', '团购', '', '个人', '', '田书韬', '转账', '公司配送', '林魏莉', '石榴', '6个装', '158.00', '5', '0.00');
INSERT INTO `think_order` VALUES ('1490', '周川宁', '9月26日', '1474905600', '员工折扣', '', '员工折扣', '', '陈杰', '现金', '顺丰', '周川宁', '石榴', '6个装', '126.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1491', '谭盛予', '9月26日', '1474819200', '赠送', '', '重庆银行渝中资金管理部', '', '周庆荣', '赠送', '公司配送', '谭盛予', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1492', '刘真', '9月26日', '1474905600', '赠送', '', '个人', '', '刘真', '赠送', '顺丰', '刘真', '玫瑰香葡萄', '5斤/件', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1493', '林魏莉', '9月26日', '1474819200', '赠送', '', '西演集团', '', '西演集团', '赠送', '自送', '林魏莉', '玫瑰香葡萄', '5斤/件', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1494', '林魏莉', '9月26日', '1474819200', '赠送', '', '西演集团', '', '西演集团', '赠送', '自送', '林魏莉', '石榴', '6个装', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1495', '林魏莉', '9月26日', '1474819200', '赠送', '', '对外文化交流中心', '', '对外文化交流中心', '赠送', '自送', '林魏莉', '玫瑰香葡萄', '5斤/件', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1496', '林魏莉', '9月26日', '1474819200', '赠送', '', '对外文化交流中心', '', '对外文化交流中心', '赠送', '自送', '林魏莉', '石榴', '6个装', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1497', '谭盛予', '9月26日', '1474819200', '员工折扣', '', '员工折扣', '', '谭盛予', '现金', '自提', '谭盛予', '玫瑰香葡萄', '5斤/件', '126.00', '2', '252.00');
INSERT INTO `think_order` VALUES ('1498', '李宝华', '9月26日', '1474905600', '赠送', '', '个人', '', '邓彦', '赠送', '顺丰', '李宝华', '玫瑰香葡萄', '5斤/件', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1499', '梁琳', '9月26日', '1474819200', '赠送', '', '重庆银行重大支行', '', '吕贝宁', '赠送', '自送', '梁琳', '玫瑰香葡萄', '5斤/件', '0.00', '3', '0.00');
INSERT INTO `think_order` VALUES ('1500', '梁琳', '9月26日', '1474819200', '赠送', '', '重庆银行小龙坎支行', '', '黄勇', '赠送', '自送', '梁琳', '石榴', '9个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1501', '梁琳', '9月26日', '0', '退货', '', '重庆银行重大支行', '', '杨兴梅', '转账', '', '梁琳', '石榴券', '6个装', '0.00', '0', '0.00');
INSERT INTO `think_order` VALUES ('1502', '谭盛予', '9月26日', '1474905600', '个人', '', '个人', '', '王果', '现金', '顺丰', '谭盛予', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1503', '蒋娟', '9月26日', '1474905600', '赠送', '', '食监局', '', '李姐', '', '自提', '蒋娟', '玫瑰香葡萄', '5斤/件', '0.00', '3', '0.00');
INSERT INTO `think_order` VALUES ('1504', '邓倩', '9月26日', '1474905600', '个人', '', '个人', '', '杨静', '', '公司配送', '邓倩', '石榴', '6个装', '158.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1505', '林魏莉', '9月26日', '1474905600', '赠送', '', '个人', '', '徐吉莉', '', '公司配送', '林魏莉', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1506', '', '9月26日', '0', '赠送', '', '个人', '', '徐吉莉', '', '公司配送', '', '玫瑰香葡萄', '5斤/件', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1507', '邓倩', '9月26日', '1474905600', '员工折扣', '', '员工折扣', '', '邓倩', '', '自提', '邓倩', '石榴', '6个装', '126.00', '5', '0.00');
INSERT INTO `think_order` VALUES ('1508', '林魏莉', '9月26日', '1475078400', '个人', '', '飞宇', '', '孙秋', '', '顺丰', '林魏莉', '玫瑰香葡萄', '5斤/件', '158.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1509', '李宝华', '9月26日', '1474905600', '赠送', '', '德高广告', '', '魏建新', '', '自送', '李宝华', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1510', '李宝华', '9月26日', '1474905600', '赠送', '', '德高广告', '', '魏建新', '', '自送', '李宝华', '玫瑰香葡萄', '5斤/件', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1511', '李宝华', '9月26日', '1474905600', '赠送', '', '重庆银行高新支行', '', '重庆银行高新支行', '', '自送', '李宝华', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1512', '李宝华', '9月26日', '1474905600', '赠送', '', '重庆银行高新支行', '', '高新支行', '', '自送', '李宝华', '玫瑰香葡萄', '5斤/件', '0.00', '3', '0.00');
INSERT INTO `think_order` VALUES ('1513', '邓倩', '9月26日', '1474905600', '团购', '', '重庆银行大阳沟支行邓静', '', '邓静', '', '公司配送', '邓倩', '玫瑰香葡萄', '5斤/件', '158.00', '15', '0.00');
INSERT INTO `think_order` VALUES ('1514', '林魏莉', '9月26日', '1474905600', '赠送', '', '个人', '', '杨夏燕', '', '公司配送', '林魏莉', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1515', '', '9月26日', '0', '赠送', '', '个人', '', '杨夏燕', '', '公司配送', '', '玫瑰香葡萄', '5斤/件', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1516', '李宝华', '9月27日', '1474905600', '赠送', '', '重庆银行大礼堂支行', '', '方行长', '', '自送', '李宝华', '玫瑰香葡萄', '5斤/件', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1517', '李宝华', '9月27日', '1474905600', '个人', '', '个人', '', '翟志涛', '', '顺丰', '李宝华', '石榴', '6个装', '158.00', '10', '0.00');
INSERT INTO `think_order` VALUES ('1518', '李宝华', '9月27日', '1474905600', '个人', '', '个人', '', '翟志涛', '', '顺丰', '李宝华', '玫瑰香葡萄', '5斤/件', '158.00', '10', '0.00');
INSERT INTO `think_order` VALUES ('1519', '梁琳', '9月27日', '1474905600', '个人', '', '个人', '', '邓海燕', '现金', '顺丰', '梁琳', '玫瑰香葡萄', '5斤/件', '126.00', '1', '126.00');
INSERT INTO `think_order` VALUES ('1520', '李宝华', '9月27日', '1474905600', '赠送', '', '公鸣律所', '', '鲁彦', '赠送', '自送', '李宝华', '玫瑰香葡萄', '5斤/件', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1521', '林魏莉', '9月27日', '1474905600', '赠送', '', '协信地产', '', '熊强', '现金', '自送', '林魏莉', '石榴', '6个装', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1522', '梁琳', '9月27日', '1474905600', '团购', '', '重庆银行两江支行', '', '刘黎', '转账', '公司配送', '梁琳', '石榴', '6个装', '158.00', '11', '1738.00');
INSERT INTO `think_order` VALUES ('1523', '梁琳', '9月27日', '1474905600', '团购', '', '重庆银行两江支行', '', '刘黎', '转账', '公司配送', '梁琳', '玫瑰香葡萄', '5斤/件', '158.00', '11', '1738.00');
INSERT INTO `think_order` VALUES ('1524', '梁琳', '9月27日', '1474905600', '团购', '', '重庆银行两江支行', '', '刘黎', '转账', '公司配送', '梁琳', '石榴券', '6个装', '158.00', '10', '1580.00');
INSERT INTO `think_order` VALUES ('1525', '梁琳', '9月27日', '1474905600', '团购', '', '重庆银行两江支行', '', '刘黎', '转账', '顺丰', '梁琳', '石榴', '6个装', '158.00', '16', '2528.00');
INSERT INTO `think_order` VALUES ('1526', '梁琳', '9月27日', '1474905600', '团购', '', '重庆银行两江支行', '', '刘黎', '转账', '顺丰', '梁琳', '玫瑰香葡萄', '5斤/件', '158.00', '7', '1106.00');
INSERT INTO `think_order` VALUES ('1527', '邓倩', '9月27日', '1474992000', '个人', '', '个人', '', '方园', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1528', '邓倩', '9月27日', '1474905600', '赠送', '', '重庆银行南坪支行', '', '重庆银行南坪支行', '', '自送', '邓倩', '石榴', '6个装', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1529', '梁琳', '9月27日', '1474905600', '赠送', '', '重庆银行两江支行', '', '刘黎/于行长', '', '自送', '梁琳', '石榴', '6个装', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1530', '谭盛予', '9月27日', '1474905600', '个人', '', '个人', '', '幸飞', '现金', '自送', '谭盛予', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1531', '李宝华', '9月27日', '1474905600', '员工折扣', '', '员工折扣', '', '詹雅婷', '现金', '自提', '李宝华', '石榴', '6个装', '158.00', '2', '252.00');
INSERT INTO `think_order` VALUES ('1532', '梁琳', '9月27日', '1475078400', '赠送', '', '重庆银行重大支行', '', '冉令', '', '顺丰', '梁琳', '玫瑰香葡萄', '5斤/件', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1533', '李宝华', '9月27日', '1474905600', '会员', '', '会员', '', '何小洲', '扣费', '自送', '李宝华', '石榴', '6个装', '158.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1534', '林魏莉', '9月27日', '1474992000', '赠送', '', '个人', '', '王旗凯', '', '公司配送', '林魏莉', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1535', '林魏莉', '9月27日', '1474992000', '赠送', '', '个人', '', '侯伟莉', '', '公司配送', '林魏莉', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1536', '邓倩', '9月27日', '1474992000', '个人', '', '个人', '', '王晓波', '转账', '公司配送', '邓倩', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1537', '李宝华', '9月27日', '1474992000', '赠送', '', '个人', '', '易先生', '', '顺丰', '李宝华', '石榴', '9个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1538', '邓倩', '9月28日', '1474992000', '个人', '', '个人', '', '李静', '转账', '公司配送', '邓倩', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1539', '邓倩', '9月28日', '1474992000', '个人', '', '个人', '', '王玉', '转账', '公司配送', '邓倩', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1540', '梁琳', '9月28日', '1475683200', '赠送', '', '重庆银行枫林秀水支行', '', '曾迅', '', '顺丰', '梁琳', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1541', '邓倩', '9月28日', '1475078400', '个人', '', '个人', '', '王玉', '转账', '公司配送', '邓倩', '玫瑰香葡萄', '5斤/件', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1542', '梁琳', '9月28日', '1475078400', '赠送', '', '重庆银行两江支行', '', '邓华', '', '顺丰', '梁琳', '玫瑰香葡萄', '5斤/件', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1543', '梁琳', '9月28日', '1475078400', '赠送', '', '三峡银行渝北支行', '', '彭主任', '', '公司配送', '梁琳', '石榴', '6个装', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1544', '吴勇', '9月28日', '1475078400', '赠送', '', '远达环保', '', '袁莱', '', '顺丰', '吴勇', '玫瑰香葡萄', '5斤/件', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1545', '邓倩', '9月28日', '1475078400', '赠送', '', '个人', '', '陈燕', '', '顺丰', '邓倩', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1546', '邓倩', '9月28日', '1475078400', '赠送', '', '个人', '', '陈燕', '', '顺丰', '邓倩', '玫瑰香葡萄', '5斤/件', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1547', '邓倩', '9月28日', '1475078400', '员工折扣', '', '员工折扣', '', '邓倩', '现金', '公司配送', '邓倩', '玫瑰香葡萄', '5斤/件', '126.00', '1', '126.00');
INSERT INTO `think_order` VALUES ('1548', '李宝华', '9月28日', '1475078400', '个人', '', '会员', '', '顾渝', '现金', '公司配送', '李宝华', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1549', '李宝华', '9月28日', '1475078400', '个人', '', '会员', '', '顾渝', '', '公司配送', '李宝华', '玫瑰香葡萄', '5斤/件', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1550', '梁琳', '9月28日', '1474992000', '赠送', '', '磁器口管委会', '', '杨主任', '', '公司配送', '梁琳', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1551', '谭盛予', '9月28日', '1475078400', '员工折扣', '', '员工折扣', '', '杨华', '现金', '自送', '谭盛予', '石榴', '6个装', '126.00', '1', '126.00');
INSERT INTO `think_order` VALUES ('1552', '谭盛予', '9月28日', '1475078400', '员工折扣', '', '员工折扣', '', '尹杰', '现金', '顺丰', '谭盛予', '石榴', '6个装', '126.00', '1', '126.00');
INSERT INTO `think_order` VALUES ('1553', '谭盛予', '9月28日', '1475078400', '员工折扣', '', '员工折扣', '', '蒋继黎', '现金', '顺丰', '谭盛予', '石榴', '6个装', '126.00', '1', '126.00');
INSERT INTO `think_order` VALUES ('1554', '李总', '9月28日', '1475078400', '团购', '', '德高广告', '', '邓彦', '转账', '公司配送', '李总', '石榴', '6个装', '158.00', '20', '3160.00');
INSERT INTO `think_order` VALUES ('1555', '李总', '9月28日', '1475078400', '团购', '', '德高广告', '', '邓彦', '转账', '公司配送', '李总', '玫瑰香葡萄', '5斤/件', '158.00', '25', '3950.00');
INSERT INTO `think_order` VALUES ('1556', '梁琳', '9月28日', '1475078400', '赠送', '', '重庆银行重大支行', '', '廖行长', '赠送', '自送', '梁琳', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1557', '梁琳', '9月28日', '1475078400', '赠送', '', '重庆银行重大支行', '', '廖行长', '赠送', '自送', '梁琳', '玫瑰香葡萄', '5斤/件', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1558', '吴春华', '9月28日', '1475164800', '渠道送样', '', 'hey cake', '', '吴春华', '送样', '自送', '吴春华', '石榴', '6个装', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1559', '吴春华', '9月28日', '1475164800', '渠道送样', '', 'hey cake', '', '吴春华', '送样', '自送', '吴春华', '玫瑰香葡萄', '5斤/件', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1560', '吴春华', '9月28日', '1475164800', '渠道送样', '', 'hey cake', '', '吴春华', '送样', '自送', '吴春华', '果酱', '瓶', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1561', '吴春华', '9月28日', '1475164800', '渠道送样', '', 'hey cake', '', '吴春华', '送样', '自送', '吴春华', '蜂蜜', '瓶', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1562', '吴春华', '9月28日', '1475164800', '渠道送样', '', 'hey cake', '', '吴春华', '送样', '自送', '吴春华', '蓝莓酒（半甜型）', '瓶', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1563', '林魏莉', '9月28日', '1475078400', '赠送', '', '大渡口融兴村镇银行', '', '刘宁', '赠送', '自送', '林魏莉', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1564', '林魏莉', '9月28日', '1475078400', '赠送', '', '大渡口融兴村镇银行', '', '刘宁', '赠送', '自送', '林魏莉', '玫瑰香葡萄', '5斤/件', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1565', '邓倩', '9月28日', '1475078400', '赠送', '', '远达环保', '', 'Cherry', '赠送', '顺丰', '邓倩', '石榴', '3个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1566', '梁琳', '9月28日', '1475078400', '个人', '', '个人', '', '邓海燕', '现金', '顺丰', '梁琳', '石榴', '6个装', '126.00', '2', '252.00');
INSERT INTO `think_order` VALUES ('1567', '梁琳', '9月28日', '1475078400', '个人', '', '个人', '', '邓海燕', '现金', '顺丰', '梁琳', '玫瑰香葡萄', '5斤/件', '126.00', '2', '252.00');
INSERT INTO `think_order` VALUES ('1568', '邓倩', '9月28日', '1475078400', '个人', '', '个人', '', '王利', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1569', '邓倩', '9月28日', '1475078400', '个人', '', '个人', '', '陈柯宇', '转账', '顺丰', '邓倩', '玫瑰香葡萄', '5斤/件', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1570', '雷琴', '9月28日', '1475078400', '员工折扣', '', '个人', '', '雷琴', '现金', '自提', '雷琴', '玫瑰香葡萄', '5斤/件', '126.00', '4', '504.00');
INSERT INTO `think_order` VALUES ('1571', '雷琴', '9月28日', '1475078400', '员工折扣', '', '员工折扣', '', '左献华', '现金', '顺丰', '雷琴', '玫瑰香葡萄', '5斤/件', '126.00', '1', '126.00');
INSERT INTO `think_order` VALUES ('1572', '微店', '9月28日', '1475078400', '微店订单', '', '微店订单', '', '甘沁灵', '微店结算', '顺丰', '微店', '石榴', '6个装', '178.00', '2', '178.00');
INSERT INTO `think_order` VALUES ('1573', '微店', '9月28日', '1476720000', '微店订单', '', '微店订单', '', '张宁萍', '微店结算', '顺丰', '微店', '石榴', '6个装', '178.00', '2', '356.00');
INSERT INTO `think_order` VALUES ('1574', '微店', '9月28日', '1476720000', '微店订单', '', '微店订单', '', '张宁萍', '微店结算', '顺丰', '微店', '玫瑰香葡萄', '5斤/件', '178.00', '2', '356.00');
INSERT INTO `think_order` VALUES ('1575', '微店', '9月28日', '1475078400', '微店订单', '', '微店订单', '', '罗小容', '微店结算', '公司配送', '微店', '玫瑰香葡萄', '5斤/件', '178.00', '2', '356.00');
INSERT INTO `think_order` VALUES ('1576', '雷琴', '9月29日', '1475078400', '员工折扣', '', '员工折扣', '', '吴清平', '现金', '顺丰', '雷琴', '玫瑰香葡萄', '5斤/件', '126.00', '1', '126.00');
INSERT INTO `think_order` VALUES ('1577', '邓倩', '9月29日', '1475078400', '个人', '', '个人', '', '邓娅玲', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '4', '632.00');
INSERT INTO `think_order` VALUES ('1578', '邓倩', '9月29日', '1475078400', '个人', '', '个人', '', '邓娅玲', '转账', '顺丰', '邓倩', '玫瑰香葡萄', '5斤/件', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1579', '吴春华', '9月29日', '1475078400', '员工折扣', '', '员工折扣', '', '吴春华', '现金', '自提', '吴春华', '石榴', '6个装', '126.00', '3', '378.00');
INSERT INTO `think_order` VALUES ('1580', '蒋娟', '9月29日', '1475078400', '赠送', '', '重庆农业协会', '', '吴春华', '', '自送', '蒋娟', '石榴', '6个装', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1581', '蒋娟', '9月29日', '1475078400', '赠送', '', '重庆农业协会', '', '吴春华', '', '自送', '蒋娟', '水果券', '张', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1582', '邓倩', '9月29日', '1475164800', '个人', '', '个人', '', '马名媛', '转账', '公司配送', '邓倩', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1583', '梁琳', '9月29日', '1475164800', '团购', '', '大渡口融兴村镇银行', '', '刘宁', '现金', '公司配送', '梁琳', '石榴', '6个装', '126.00', '15', '1890.00');
INSERT INTO `think_order` VALUES ('1584', '李宝华', '9月29日', '1475078400', '渠道送样', '', '一品仓', '', '吴春华', '', '自送', '李宝华', '石榴', '6个装', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1585', '李宝华', '9月29日', '1475078400', '渠道送样', '', '一品仓', '', '吴春华', '', '自送', '李宝华', '蓝莓酒（半甜型）', '瓶', '0.00', '13', '0.00');
INSERT INTO `think_order` VALUES ('1586', '梁琳', '9月29日', '1475942400', '赠送', '', '三峡银行龙头寺支行', '', '杨行长', '', '自送', '梁琳', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1587', '梁琳', '9月29日', '1475164800', '赠送', '', '三峡银行龙头寺支行', '', '杨行长', '', '自送', '梁琳', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1588', '李宝华', '9月30日', '1475164800', '渠道送样', '', 'hey cake', '', '吴春华', '', '自送', '李宝华', '石榴', '6个装', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1589', '李宝华', '9月30日', '1475164800', '渠道送样', '', 'hey cake', '', '吴春华', '', '自送', '李宝华', '蓝莓酒（半甜型）', '瓶', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1590', '李宝华', '9月30日', '1475164800', '渠道送样', '', 'hey cake', '', '吴春华', '', '自送', '李宝华', '蜂蜜', '瓶', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1591', '李宝华', '9月30日', '1475164800', '渠道送样', '', 'hey cake', '', '吴春华', '', '自送', '李宝华', '果酱', '瓶', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1592', '吕伟', '9月30日', '1475164800', '员工折扣', '', '员工折扣', '', '吕伟', '现金', '自提', '吕伟', '石榴', '6个装', '126.00', '2', '252.00');
INSERT INTO `think_order` VALUES ('1593', '李宝华', '9月30日', '1475164800', '团购', '', '德高广告', '', '魏建新', '现金', '公司配送', '李宝华', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1594', '梁琳', '9月30日', '1475164800', '个人', '', '张骞', '', '张骞', '现金', '顺丰', '梁琳', '蓝莓酒（半甜型）', '瓶', '128.00', '3', '384.00');
INSERT INTO `think_order` VALUES ('1595', '梁琳', '9月30日', '1475164800', '个人', '', '张骞', '', '张骞', '现金', '顺丰', '梁琳', '石榴', '6个装', '158.00', '3', '474.00');
INSERT INTO `think_order` VALUES ('1596', '李宝华', '9月30日', '1475164800', '赠送', '', '对外文化交流中心', '', '对外文化交流中心', '', '自送', '李宝华', '石榴', '6个装', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1597', '邓倩', '9月30日', '1475942400', '个人', '', '重庆银行大礼堂支行', '', '范小姐', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1598', '童云', '9月30日', '1475164800', '员工折扣', '', '员工折扣', '', '童云', '现金', '自提', '童云', '石榴', '6个装', '126.00', '1', '126.00');
INSERT INTO `think_order` VALUES ('1599', '诸仁杰', '9月30日', '1475164800', '员工折扣', '', '员工折扣', '', '诸仁杰', '现金', '自提', '诸仁杰', '石榴', '6个装', '126.00', '1', '126.00');
INSERT INTO `think_order` VALUES ('1600', '李宝华', '9月30日', '1475164800', '团购', '', '德高广告', '', '魏建新', '转账', '自送', '李宝华', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1601', '梁琳', '9月30日', '1475164800', '员工折扣', '', '员工折扣', '', '梁琳', '现金', '自提', '梁琳', '石榴', '9个装', '126.00', '2', '252.00');
INSERT INTO `think_order` VALUES ('1602', '微店', '10月4日', '1475596800', '微店订单', '', '微店订单', '', '范艳', '微店结算', '顺丰', '微店', '石榴', '6个装', '178.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1603', '微店', '10月4日', '1475596800', '微店订单', '', '微店订单', '', '沈思宇', '微店结算', '顺丰', '微店', '石榴', '6个装', '178.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1604', '邓倩', '10月5日', '1475683200', '团购', '', '个人', '', '费玲', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1605', '邓倩', '10月5日', '1475683200', '团购', '', '个人', '', '万里冰', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1606', '邓倩', '10月5日', '1475683200', '个人', '', '个人', '', '吴亚南', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1607', '邓倩', '10月5日', '1475683200', '个人', '', '个人', '', '姚娟', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1608', '邓倩', '10月6日', '1475856000', '个人', '', '个人', '', '王臻', '转账', '顺丰', '邓倩', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1609', '吴春华', '10月9日', '1475942400', '赠送', '', '华夏银行渝北支行', '', '李鹏', '', '自送', '吴春华', '石榴', '6个装', '158.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1610', '吴春华', '10月9日', '1475942400', '赠送', '', '交通银行弹子石支行', '', '郑主任', '', '自送', '吴春华', '石榴', '6个装', '158.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1611', '吴春华', '10月9日', '1475942400', '赠送', '', '奥园地产', '', '李颖', '', '自送', '吴春华', '石榴', '6个装', '158.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1612', '梁琳', '10月9日', '1475942400', '赠送', '', '三峡银行渝中支行', '', '王可可', '', '自送', '梁琳', '石榴', '6个装', '158.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1613', '梁琳', '10月9日', '1475942400', '赠送', '', '农业银行三亚湾支行', '', '王伟', '', '自送', '梁琳', '石榴', '6个装', '158.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1614', '梁琳', '10月10日', '1476028800', '赠送', '', '沙坪坝妇幼保健院', '', '王总', '', '自送', '梁琳', '石榴', '6个装', '158.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1615', '李宝华', '10月10日', '1476028800', '赠送', '', '博恩集团', '', '魏开庆', '', '自送', '李宝华', '高原苹果', 'φ85及以上', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1616', '梁琳', '10月11日', '1476115200', '赠送', '', '重庆银行两江分行', '', '邓华', '', '自送', '梁琳', '高原苹果', 'φ75-80', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1617', '梁琳', '10月11日', '1476115200', '赠送', '', '华夏银行两江支行', '', '刘行长', '', '自送', '梁琳', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1618', '梁琳', '10月11日', '1476201600', '团购', '', '重庆凌欣商贸有限公司', '', '魏良秀', '现金', '公司配送', '梁琳', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1619', '梁琳', '10月11日', '1476201600', '团购', '', '重庆凌欣商贸有限公司', '', '魏良秀', '现金', '公司配送', '梁琳', '苹果券', 'φ85及以上', '158.00', '10', '1580.00');
INSERT INTO `think_order` VALUES ('1620', '梁琳', '10月11日', '1476201600', '团购', '', '梅江园', '', '王总', '现金', '公司配送', '梁琳', '石榴', '6个装', '158.00', '17', '2686.00');
INSERT INTO `think_order` VALUES ('1621', '梁琳', '10月11日', '1476201600', '赠送', '', '重庆凌欣商贸有限公司', '', '魏总', '', '公司配送', '梁琳', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1622', '梁琳', '10月12日', '1476201600', '赠送', '', '浦发银行重庆分行', '', '刘欣', '', '自送', '梁琳', '石榴', '6个装', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1623', '吴勇', '10月12日', '1476288000', '团购', '', '远达环保', '', '袁莱', '转账', '公司配送', '吴勇', '石榴', '6个装', '158.00', '8', '1264.00');
INSERT INTO `think_order` VALUES ('1624', '李宝华', '10月13日', '1477411200', '团购', '', '重庆银行高新支行', '', '程梅', '转账', '公司配送', '李宝华', '高原苹果', 'φ85及以上', '158.00', '20', '3160.00');
INSERT INTO `think_order` VALUES ('1625', '邓倩', '10月13日', '1476633600', '个人', '', '个人', '', '辛老师', '转账', '顺丰', '邓倩', '克伦生葡萄', '5斤/件', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1626', '邓倩', '10月13日', '1476374400', '赠送', '', '大礼堂支行周婧', '', '周卫东', '', '顺丰', '邓倩', '高原苹果', 'φ85及以上', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1627', '李宝华', '10月13日', '1476374400', '赠送', '', '德高邓总', '', '马女士', '', '顺丰', '李宝华', '高原苹果', 'φ85及以上', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1628', '梁琳', '10月13日', '1476288000', '赠送', '', '磁器口街道', '', '杨主任', '', '自送', '梁琳', '高原苹果', '4个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1629', '梁琳', '10月13日', '1476288000', '赠送', '', '三峡银行龙头寺支行', '', '杨行长', '', '自送', '梁琳', '高原苹果', '4个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1630', '梁琳', '10月13日', '1476288000', '赠送', '', '梅江园', '', '王总', '', '自送', '梁琳', '高原苹果', '4个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1631', '梁琳', '10月13日', '1476288000', '赠送', '', '重庆凌欣商贸有限公司', '', '魏总', '', '自送', '梁琳', '高原苹果', '4个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1632', '梁琳', '10月13日', '1476288000', '赠送', '', '大渡口融兴村镇银行钢花支行', '', '廖行长', '', '自送', '梁琳', '高原苹果', '4个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1633', '梁琳', '10月13日', '1476288000', '赠送', '', '浦发银行渝北支行', '', '叶建斌', '', '自送', '梁琳', '高原苹果', '4个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1634', '梁琳', '10月13日', '1476288000', '赠送', '', '浦发银行渝北支行', '', '叶建斌', '', '自送', '梁琳', '石榴', '6个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1635', '林魏莉', '10月13日', '1476288000', '团购', '', '启迪协信', '', '陈可', '转账', '顺丰', '林魏莉', '石榴', '6个装', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1636', '邓倩', '10月13日', '1477238400', '个人', '', '个人', '', '陆老师', '转账', '顺丰', '邓倩', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1637', '微店', '10月13日', '1477238400', '微店订单', '', '微店订单', '', '陈思宇', '微店结算', '顺丰', '微店', '高原苹果', 'φ85及以上', '178.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1638', '林魏莉', '10月14日', '1477238400', '个人', '', '个人', '', '杨满英', '转账', '公司配送', '林魏莉', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1639', '李宝华', '10月14日', '1477238400', '个人', '', '个人', '', '徐念', '现金', '顺丰', '李宝华', '高原苹果', 'φ75-80', '158.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1640', '熊建利', '10月14日', '1476374400', '渠道送样', '', '益果园水果生活馆', '', '李经理', '', '自送', '熊建利', '石榴', '4个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1641', '梁琳', '10月15日', '1476633600', '个人', '', '个人', '', '张骞', '现金', '顺丰', '梁琳', '高原苹果', 'φ75-80', '128.00', '2', '256.00');
INSERT INTO `think_order` VALUES ('1642', '梁琳', '10月15日', '1476633600', '个人', '', '个人', '', '张骞', '现金', '顺丰', '梁琳', '克伦生葡萄', '5斤/件', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1643', '梁琳', '10月17日', '1476633600', '赠送', '', '融兴银行', '', '刘宁', '', '公司配送', '梁琳', '克伦生葡萄', '5斤/件', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1644', '梁琳', '10月17日', '1476633600', '赠送', '', '融兴银行', '', '刘宁', '', '公司配送', '梁琳', '高原苹果', '4个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1645', '邓倩', '10月17日', '1477238400', '个人', '', '个人', '', '余杰', '转账', '公司配送', '邓倩', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1646', '邓倩', '10月17日', '1477238400', '个人', '', '个人', '', '曾宁', '转账', '顺丰', '邓倩', '高原苹果', 'φ75以下', '168.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1647', '邓倩', '10月17日', '1477238400', '个人', '', '个人', '', '杨老师', '转账', '公司配送', '邓倩', '高原苹果', 'φ75-80', '128.00', '2', '256.00');
INSERT INTO `think_order` VALUES ('1648', '邓倩', '10月17日', '1476633600', '个人', '', '个人', '', '杨懿丁', '转账', '自送', '邓倩', '克伦生葡萄', '5斤/件', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1649', '邓倩', '10月17日', '1476633600', '个人', '', '个人', '', '周琼莹', '转账', '自送', '邓倩', '克伦生葡萄', '5斤/件', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1650', '童云', '10月17日', '1476892800', '个人', '', '个人', '', '张弦', '现金', '顺丰', '童云', '克伦生葡萄', '5斤/件', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1651', '梁琳', '10月17日', '1477238400', '个人', '', '个人', '', '张伟', '现金', '顺丰', '梁琳', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1652', '梁琳', '10月17日', '1477238400', '个人', '', '个人', '', '陈正全', '现金', '顺丰', '梁琳', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1653', '邓倩', '10月17日', '1476720000', '个人', '', '个人', '', '吴亚南', '转账', '顺丰', '邓倩', '克伦生葡萄', '5斤/件', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1654', '邓倩', '10月17日', '1476720000', '个人', '', '个人', '', '姚娟', '转账', '顺丰', '邓倩', '克伦生葡萄', '5斤/件', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1655', '梁琳', '10月18日', '1476720000', '赠送', '', '重大支行', '', '杨主任', '', '自送', '梁琳', '高原苹果', '4个装', '0.00', '4', '0.00');
INSERT INTO `think_order` VALUES ('1656', '梁琳', '10月18日', '1476720000', '赠送', '', '小龙坎支行', '', '苏行长', '', '自送', '梁琳', '高原苹果', '4个装', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1657', '李宝华', '10月18日', '1476720000', '渠道送样', '', '个人', '', '叶子', '', '自送', '李宝华', '高原苹果', '4个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1658', '谭盛予', '10月18日', '1476720000', '渠道送样', '', '个人', '', '赵之宁', '', '自送', '谭盛予', '高原苹果', '4个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1659', '李宝华', '10月18日', '1476720000', '渠道送样', '', '个人', '', '张总', '', '自送', '李宝华', '高原苹果', '4个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1660', '李宝华', '10月18日', '1476720000', '渠道送样', '', '个人', '', '夏春林', '', '自送', '李宝华', '高原苹果', '4个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1661', '邓倩', '10月18日', '1477238400', '个人', '', '个人', '', '韩彦秋', '转账', '顺丰', '邓倩', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1662', '邓倩', '10月18日', '1477238400', '个人', '', '个人', '', '徐倩', '转账', '顺丰', '邓倩', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1663', '梁琳', '10月18日', '1476806400', '个人', '', '个人', '', '张骞', '现金', '顺丰', '梁琳', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1664', '童云', '10月18日', '1476720000', '个人', '', '个人', '', '谭思亮', '现金', '自送', '童云', '克伦生葡萄', '5斤/件', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1665', '邓倩', '10月19日', '1477238400', '个人', '', '个人', '', '王耀丽', '转账', '顺丰', '邓倩', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1666', '梁琳', '10月19日', '1477238400', '个人', '', '个人', '', '邢凤梅', '现金', '顺丰', '梁琳', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1667', '张路', '10月19日', '1476806400', '员工折扣', '', '员工折扣', '', '张路', '现金', '自提', '张路', '克伦生葡萄', '5斤/件', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1668', '邓倩', '10月19日', '1477238400', '个人', '', '个人', '', '杨老师', '转账', '公司配送', '邓倩', '高原苹果', 'φ75-80', '128.00', '2', '256.00');
INSERT INTO `think_order` VALUES ('1669', '邓倩', '10月19日', '1477238400', '个人', '', '个人', '', '王书雨', '转账', '顺丰', '邓倩', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1670', '邓倩', '10月19日', '1477238400', '个人', '', '个人', '', '何昌芬', '转账', '顺丰', '邓倩', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1671', '微店', '10月20日', '1476892800', '微店订单', '', '微店订单', '', '李佳佳', '微店结算', '顺丰', '微店', '石榴', '6个装', '178.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1672', '谭盛予', '10月20日', '1476806400', '渠道', '', '个人', '', '赵之宁', '现金', '自提', '谭盛予', '克伦生葡萄', '5斤/件', '143.00', '1', '143.00');
INSERT INTO `think_order` VALUES ('1673', '微店', '10月21日', '1477238400', '微店订单', '', '微店订单', '', '李佳佳', '微店结算', '顺丰', '微店', '高原苹果', 'φ75-80', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1674', '微店', '10月21日', '1477238400', '微店订单', '', '微店订单', '', '谢女士', '微店结算', '顺丰', '微店', '高原苹果', 'φ75-80', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1675', '微店', '10月21日', '1477238400', '微店订单', '', '微店订单', '', '李雪芹', '微店结算', '顺丰', '微店', '高原苹果', 'φ85及以上', '178.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1676', '微店', '10月21日', '1477238400', '微店订单', '', '微店订单', '', '曾永宏', '微店结算', '顺丰', '微店', '高原苹果', 'φ85及以上', '178.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1677', '微店', '10月21日', '1477238400', '微店订单', '', '微店订单', '', '曾永宏', '微店结算', '顺丰', '微店', '高原苹果', 'φ75-80', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1678', '微店', '10月21日', '1477238400', '微店订单', '', '微店订单', '', '曾永宏', '微店结算', '顺丰', '微店', '高原苹果', 'φ75-80', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1679', '邓倩', '10月21日', '1477238400', '个人', '', '个人', '', '周琼莹', '转账', '自送', '邓倩', '高原苹果', 'φ75以下', '168.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1680', '梁琳', '10月21日', '1477238400', '个人', '', '个人', '', '杨老师', '现金', '顺丰', '梁琳', '高原苹果', 'φ75以下', '168.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1681', '吴勇', '10月21日', '1477065600', '赠送', '', '远达节能', '', '袁莱', '', '自送', '吴勇', '高原苹果', 'φ75-80', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1682', '邓倩', '10月23日', '1477238400', '个人', '', '个人', '', '杨静', '转账', '公司配送', '邓倩', '高原苹果', 'φ75以下', '168.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1683', '林魏莉', '10月23日', '1477238400', '渠道', '', '有间果铺', '', '李仁兰', '现金', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1684', '林魏莉', '10月23日', '1477238400', '渠道', '', '有间果铺', '', '谢礼琼', '现金', '公司配送', '林魏莉', '高原苹果', 'φ75以下', '188.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1685', '微店', '10月24日', '1477238400', '微店订单', '', '微店订单', '', '赵秀琼', '微店结算', '顺丰', '微店', '高原苹果', 'φ85及以上', '178.00', '1', '218.00');
INSERT INTO `think_order` VALUES ('1686', '微店', '10月24日', '1477238400', '微店订单', '', '微店订单', '', '赵秀琼', '微店结算', '顺丰', '微店', '石榴', '6个装', '178.00', '1', '208.00');
INSERT INTO `think_order` VALUES ('1687', '微店', '10月24日', '1477238400', '微店订单', '', '微店订单', '', '高英', '微店结算', '顺丰', '微店', '石榴', '6个装', '178.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1688', '林魏莉', '10月24日', '1477238400', '渠道', '', '有间果铺', '', '张全', '现金', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1689', '林魏莉', '10月24日', '1477324800', '渠道', '', '有间果铺', '', '刘艳花', '现金', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1690', '李宝华', '10月24日', '1477238400', '个人', '', '个人', '', '徐念', '现金', '顺丰', '李宝华', '克伦生葡萄', '5斤/件', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1691', '吴勇', '10月24日', '1477324800', '个人', '', '远达节能袁莱', '', '袁莱', '转账', '公司配送', '吴勇', '高原苹果', 'φ75-80', '128.00', '38', '4864.00');
INSERT INTO `think_order` VALUES ('1692', '梁琳', '10月24日', '1477238400', '赠送', '', '大渡口融兴村镇银行', '', '刘宁', '', '自送', '梁琳', '高原苹果', 'φ75-80', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1693', '邓倩', '10月24日', '1477324800', '个人', '', '个人', '', '王老师', '转账', '公司配送', '邓倩', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1694', '林魏莉', '10月24日', '1477238400', '赠送', '', '个人', '', '崔勇', '', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1695', '童云', '10月24日', '1477324800', '个人', '', '个人', '', '谭思亮', '现金', '顺丰', '童云', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1696', '林魏莉', '10月24日', '1477584000', '赠送', '', '个人', '', '于勇', '', '顺丰', '林魏莉', '高原苹果', 'φ85及以上', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1697', '邓倩', '10月24日', '1477238400', '个人', '', '个人', '', '杨老师', '', '自提', '邓倩', '高原苹果', 'φ75-80', '128.00', '3', '384.00');
INSERT INTO `think_order` VALUES ('1698', '邓倩', '10月24日', '1477324800', '个人', '', '个人', '', '杨老师', '转账', '公司配送', '邓倩', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1699', '吴勇', '10月24日', '1477324800', '赠送', '', '远达环保科技陈燕', '', '陈燕', '', '公司配送', '吴勇', '高原苹果', 'φ75-80', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1700', '吴勇', '10月24日', '1477324800', '赠送', '', '远达环保工程曹婷', '', '程曹婷', '', '公司配送', '吴勇', '高原苹果', 'φ75-80', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1701', '郁生源', '10月24日', '1477238400', '员工折扣', '', '谭盛予', '', '谭盛予', '现金', '自提', '郁生源', '蓝莓果酒', '半糖型', '420.00', '1', '420.00');
INSERT INTO `think_order` VALUES ('1702', '李总', '10月24日', '1477411200', '赠送', '', '重庆银行高新支行', '', '重庆银行高新支行', '', '公司配送', '李总', '高原苹果', 'φ85及以上', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1703', '邓倩', '10月24日', '1477324800', '个人', '', '个人', '', '马兰', '转账', '顺丰', '邓倩', '高原苹果', 'φ75以下', '168.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1704', '邓倩', '10月24日', '1477324800', '个人', '', '个人', '', '赵侃', '转账', '顺丰', '邓倩', '高原苹果', 'φ85及以上', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1705', '梁琳', '10月24日', '1477324800', '团购', '', '三峡银行北部新区支行', '', '雷主任', '转账', '公司配送', '梁琳', '高原苹果', 'φ85及以上', '158.00', '10', '1580.00');
INSERT INTO `think_order` VALUES ('1706', '梁琳', '10月24日', '1477324800', '团购', '', '三峡银行北部新区支行', '', '雷主任', '转账', '公司配送', '梁琳', '石榴', '6个装', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1707', '梁琳', '10月24日', '1477324800', '赠送', '', '三峡银行北部新区支行', '', '雷主任', '', '公司配送', '梁琳', '克伦生葡萄', '5斤/件', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1708', '林魏莉', '10月24日', '1477324800', '渠道', '', '有间果铺', '', '李珊', '现金', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1709', '梁琳', '10月24日', '1477324800', '个人', '', '个人', '', '崔玉红', '现金', '顺丰', '梁琳', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1710', '林魏莉', '10月24日', '1477238400', '个人', '', '个人', '', '赵之宁', '现金', '自提', '林魏莉', '克伦生葡萄', '5斤/件', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1711', '邓倩', '10月25日', '1477324800', '个人', '', '个人', '', '杨老师', '转账', '自送', '邓倩', '高原苹果', 'φ75-80', '128.00', '4', '512.00');
INSERT INTO `think_order` VALUES ('1712', '林魏莉', '10月25日', '1477324800', '个人', '', '个人', '', '牟洪惠', '现金', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1713', '吴勇', '10月25日', '1477324800', '个人', '', '远达环保', '', '袁莱', '转账', '公司配送', '吴勇', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1714', '邓倩', '10月25日', '1477497600', '个人', '', '个人', '', '王玉', '转账', '公司配送', '邓倩', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1715', '邓倩', '10月25日', '1477497600', '个人', '', '个人', '', '王玉', '转账', '公司配送', '邓倩', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1716', '李宝华', '10月25日', '1477324800', '个人', '', '个人', '', '王黎', '现金', '自送', '李宝华', '高原苹果', 'φ75-80', '128.00', '4', '512.00');
INSERT INTO `think_order` VALUES ('1717', '梁琳', '10月25日', '1477411200', '赠送', '', '农业银行三亚湾支行', '', '王行长', '', '顺丰', '梁琳', '高原苹果', 'φ75-80', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1718', '梁琳', '10月25日', '1477411200', '赠送', '', '重庆银行两江分行', '', '刘黎', '', '顺丰', '梁琳', '高原苹果', 'φ75-80', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1719', '邓倩', '10月25日', '1477411200', '个人', '', '个人', '', '肖媛', '转账', '顺丰', '邓倩', '高原苹果', 'φ75以下', '168.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1720', '邓倩', '10月25日', '1477411200', '个人', '', '个人', '', '杨老师', '转账', '公司配送', '邓倩', '高原苹果', 'φ75以下', '168.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1721', '梁琳', '10月26日', '1477411200', '赠送', '', '重庆银行加州支行', '', '杨经理', '', '自送', '梁琳', '高原苹果', 'φ75-80', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1722', '梁琳', '10月26日', '1477411200', '赠送', '', '重庆银行分行营业部', '', '周末', '', '自送', '梁琳', '高原苹果', 'φ75-80', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1723', '谭盛予', '10月26日', '1477411200', '个人', '', '个人', '', '徐敏', '现金', '公司配送', '谭盛予', '高原苹果', 'φ75以下', '168.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1724', '谭盛予', '10月26日', '1477411200', '团购', '', '猪八戒财务部', '', '上总', '现金', '公司配送', '谭盛予', '高原苹果', 'φ75以下', '168.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1725', '谭盛予', '10月26日', '1477411200', '团购', '', '猪八戒财务部', '', '上总', '现金', '公司配送', '谭盛予', '高原苹果', 'φ75-80', '128.00', '3', '384.00');
INSERT INTO `think_order` VALUES ('1726', '谭盛予', '10月26日', '1477411200', '个人', '', '个人', '', '兰花', '现金', '自送', '谭盛予', '高原苹果', 'φ75以下', '168.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1727', '梁琳', '10月26日', '1477497600', '团购', '', '大渡口融兴村镇银行', '', '马主任', '转账', '公司配送', '梁琳', '高原苹果', 'φ75以下', '168.00', '140', '23520.00');
INSERT INTO `think_order` VALUES ('1728', '雷琴', '10月26日', '1477497600', '个人', '', '个人', '', '李红', '现金', '公司配送', '雷琴', '高原苹果', 'φ85及以上', '158.00', '5', '790.00');
INSERT INTO `think_order` VALUES ('1729', '邓文静', '10月26日', '1477411200', '赠送', '', '童家桥税务所', '', '孙所长', '', '自送', '邓文静', '苹果券', 'φ75-80', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1730', '林魏莉', '10月26日', '1477411200', '员工折扣', '', '员工折扣', '', '王艳', '现金', '自提', '林魏莉', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1731', '邓倩', '10月27日', '1477497600', '个人', '', '个人', '', '何跃容', '转账', '顺丰', '邓倩', '高原苹果', 'φ75-80', '128.00', '4', '512.00');
INSERT INTO `think_order` VALUES ('1732', '微店', '10月27日', '1477497600', '微店订单', '', '微店订单', '', '赵秀琼', '微店结算', '顺丰', '微店', '高原苹果', 'φ85及以上', '178.00', '1', '218.00');
INSERT INTO `think_order` VALUES ('1733', '李宝华', '10月27日', '1477584000', '团购', '', '重庆银行高新支行', '', '重庆银行高新支行', '转账', '公司配送', '李宝华', '高原苹果', 'φ85及以上', '158.00', '20', '3160.00');
INSERT INTO `think_order` VALUES ('1734', '梁琳', '10月27日', '1477497600', '个人', '', '个人', '', '梁琳', '现金', '自提', '梁琳', '高原苹果', 'φ75以下', '168.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1735', '童云', '10月27日', '1478188800', '个人', '', '个人', '', '谭静', '现金', '顺丰', '童云', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1736', '童云', '10月27日', '1478188800', '个人', '', '个人', '', '谭静', '现金', '顺丰', '童云', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1737', '童云', '10月27日', '1477929600', '个人', '', '个人', '', '谭静', '现金', '顺丰', '童云', '高原苹果', 'φ75-80', '128.00', '3', '384.00');
INSERT INTO `think_order` VALUES ('1738', '李宝华', '10月27日', '1477497600', '个人', '', '个人', '', '杨总', '现金', '自提', '李宝华', '高原苹果', 'φ85及以上', '158.00', '5', '790.00');
INSERT INTO `think_order` VALUES ('1739', '谭盛予', '10月27日', '1477584000', '个人', '', '个人', '', '蒋颖', '现金', '公司配送', '谭盛予', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1740', '谭盛予', '10月27日', '1477584000', '个人', '', '个人', '', '代艺红', '现金', '顺丰', '谭盛予', '高原苹果', 'φ75以下', '168.00', '1', '198.00');
INSERT INTO `think_order` VALUES ('1741', '微店', '10月28日', '1477584000', '微店订单', '', '微店订单', '', '沈老师', '微店结算', '顺丰', '微店', '高原苹果', 'φ75-80', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1742', '周川宁', '10月28日', '1477584000', '员工折扣', '', '员工折扣', '', '李琳', '现金', '顺丰', '周川宁', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1743', '李宝华', '10月28日', '1477584000', '赠送', '', '个人', '', '郑炜', '', '公司配送', '李宝华', '高原苹果', 'φ75以下', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1744', '李宝华', '10月28日', '1477584000', '赠送', '', '个人', '', '王青', '', '自送', '李宝华', '高原苹果', 'φ85及以上', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1745', '童云', '10月28日', '1477584000', '个人', '', '个人', '', '谢明亮', '现金', '自提', '童云', '高原苹果', 'φ75-80', '128.00', '2', '256.00');
INSERT INTO `think_order` VALUES ('1746', '梁琳', '10月28日', '1477584000', '个人', '', '个人', '', '王安玫', '现金', '顺丰', '梁琳', '高原苹果', 'φ75-80', '128.00', '2', '256.00');
INSERT INTO `think_order` VALUES ('1747', '童云', '10月28日', '1477584000', '个人', '', '个人', '', '江海', '现金', '自提', '童云', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1748', '李宝华', '10月28日', '1477584000', '赠送', '', '重庆银行重大支行', '', '吕行长', '', '顺丰', '李宝华', '高原苹果', 'φ85及以上', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1749', '林魏莉', '10月28日', '1477584000', '送样', '', '个人', '', '张馨文', '', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1750', '林魏莉', '10月28日', '1477584000', '送样', '', '个人', '', '占威', '', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1751', '李宝华', '10月28日', '1477584000', '赠送', '', '个人', '', '张宏宝', '', '公司配送', '李宝华', '高原苹果', 'φ75-80', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1752', '李宝华', '10月28日', '1477584000', '赠送', '', '个人', '', '司机', '', '公司配送', '李宝华', '高原苹果', 'φ75-80', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1753', '林魏莉', '10月28日', '1477584000', '送样', '', '个人', '', '马皓', '', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1754', '林魏莉', '10月28日', '1477584000', '送样', '', '个人', '', '李小艳', '', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1755', '林魏莉', '10月28日', '1477584000', '赠送', '', '个人', '', '徐吉莉', '', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1756', '林魏莉', '10月28日', '1477584000', '赠送', '', '个人', '', '杨夏燕', '', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1757', '林魏莉', '10月28日', '1477584000', '赠送', '', '个人', '', '侯伟莉', '', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1758', '李宝华', '10月28日', '1477584000', '赠送', '', '个人', '', '林青青', '', '顺丰', '李宝华', '高原苹果', 'φ75-80', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1759', '梁琳', '10月28日', '1477584000', '团购', '', '重庆银行小龙坎支行', '', '苏葵', '转账', '公司配送', '梁琳', '高原苹果', 'φ85及以上', '158.00', '10', '1580.00');
INSERT INTO `think_order` VALUES ('1760', '梁琳', '10月28日', '1477584000', '团购', '', '重庆银行小龙坎支行', '', '苏行长', '转账', '公司配送', '梁琳', '高原苹果', 'φ85及以上', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1761', '林魏莉', '10月28日', '1477584000', '赠送', '', '个人', '', '刘真', '', '顺丰', '林魏莉', '高原苹果', 'φ75-80', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1762', '林魏莉', '10月28日', '1477584000', '个人', '', '个人', '', '周梅', '现金', '顺丰', '林魏莉', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1763', '林魏莉', '10月28日', '1477584000', '个人', '', '个人', '', '许勇', '现金', '顺丰', '林魏莉', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1764', '林魏莉', '10月28日', '1477584000', '个人', '', '个人', '', '喻振华', '现金', '顺丰', '林魏莉', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1765', '林魏莉', '10月28日', '1477584000', '个人', '', '个人', '', '张彦兵', '现金', '顺丰', '林魏莉', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1766', '李宝华', '10月28日', '1477584000', '赠送', '', '个人', '', '易先生', '', '顺丰', '李宝华', '高原苹果', 'φ75-80', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1767', '李宝华', '10月28日', '1477584000', '赠送', '', '个人', '', '冯晶', '', '顺丰', '李宝华', '高原苹果', 'φ75-80', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1768', '林魏莉', '10月28日', '1477584000', '个人', '', '个人', '', '丁老师', '现金', '顺丰', '林魏莉', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1769', '林魏莉', '10月28日', '1477584000', '赠送', '', '个人', '', '王强', '', '自提', '林魏莉', '高原苹果', 'φ85及以上', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1770', '谭盛予', '10月28日', '1477584000', '个人', '', '个人', '', '孟雪', '现金', '自提', '谭盛予', '高原苹果', 'φ75以下', '168.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1771', '谭盛予', '10月28日', '1477584000', '个人', '', '', '', '孟雪', '现金', '自提', '谭盛予', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1772', '蒋娟', '10月28日', '1477584000', '赠送', '', '药监局2、有机农业3', '', '蒋娟', '', '自提', '蒋娟', '苹果券', 'φ85及以上', '0.00', '5', '0.00');
INSERT INTO `think_order` VALUES ('1773', '微店', '10月29日', '1477843200', '微店订单', '', '微店订单', '', '甘沁灵', '微店结算', '顺丰', '微店', '石榴', '6个装', '178.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1774', '微店', '10月29日', '1477843200', '微店订单', '', '微店订单', '', '尹歆', '微店结算', '顺丰', '微店', '高原苹果', 'φ75-80', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1775', '李宝华', '10月31日', '1477843200', '赠送', '', '重庆银行大礼堂支行', '', '方行长', '', '公司配送', '李宝华', '高原苹果', 'φ85及以上', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1776', '李宝华', '10月31日', '1477843200', '团购', '', '重庆银行大礼堂支行', '', '重庆银行大礼堂支行', '转账', '公司配送', '李宝华', '高原苹果', 'φ85及以上', '158.00', '10', '1580.00');
INSERT INTO `think_order` VALUES ('1777', '谭盛予', '10月31日', '1478016000', '个人', '', '个人', '', '周其仁', '现金', '公司配送', '谭盛予', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1778', '林魏莉', '10月31日', '1477843200', '渠道', '', '有间果铺', '', '甘老师', '现金', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1779', '林魏莉', '10月31日', '1477929600', '渠道', '', '有间果铺', '', '谢礼琼', '现金', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '158.00', '3', '474.00');
INSERT INTO `think_order` VALUES ('1780', '童云', '10月31日', '1477929600', '个人', '', '个人', '', '冉燕', '现金', '公司配送', '童云', '高原苹果', 'φ75以下', '168.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1781', '林魏莉', '10月31日', '1477843200', '个人', '', '个人', '', '李韬', '现金', '公司配送', '林魏莉', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1782', '林魏莉', '10月31日', '1477843200', '个人', '', '个人', '', '孙秋', '现金', '顺丰', '林魏莉', '高原苹果', 'φ75-80', '128.00', '1', '140.00');
INSERT INTO `think_order` VALUES ('1783', '李宝华', '10月31日', '1477843200', '个人', '', '个人', '', '黄俊武', '转账', '顺丰', '李宝华', '高原苹果', 'φ75-80', '128.00', '1', '140.00');
INSERT INTO `think_order` VALUES ('1784', '李宝华', '10月31日', '1477843200', '个人', '', '个人', '', '胡新星', '现金', '顺丰', '李宝华', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1785', '李宝华', '10月31日', '1477843200', '个人', '', '个人', '', '涂靖莲', '现金', '顺丰', '李宝华', '高原苹果', 'φ75以下', '168.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1786', '李宝华', '10月31日', '1477843200', '个人', '', '个人', '', '陆蔚蔚', '现金', '顺丰', '李宝华', '高原苹果', 'φ75以下', '168.00', '1', '205.00');
INSERT INTO `think_order` VALUES ('1787', '李宝华', '10月31日', '1477843200', '个人', '', '个人', '', '陈培华', '现金', '顺丰', '李宝华', '高原苹果', 'φ75以下', '168.00', '2', '410.00');
INSERT INTO `think_order` VALUES ('1788', '梁琳', '10月31日', '1477843200', '赠送', '', '华夏银行渝中分行', '', '张好/曹行长', '', '自送', '梁琳', '高原苹果', 'φ75以下', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1789', '林魏莉', '10月31日', '1477843200', '渠道赠送', '', '卡思5号', '', '卡思5号', '', '自送', '林魏莉', '苹果券', 'φ75-80', '0.00', '30', '0.00');
INSERT INTO `think_order` VALUES ('1790', '林魏莉', '10月31日', '1477843200', '渠道赠送', '', '卡思5号', '', '卡思5号', '', '自送', '林魏莉', '蓝莓果酒', '非甜型', '0.00', '30', '0.00');
INSERT INTO `think_order` VALUES ('1791', '张路', '10月31日', '1477843200', '个人', '', '个人', '', '张路', '现金', '自提', '张路', '高原苹果', '10元3斤/件', '10.00', '11', '110.00');
INSERT INTO `think_order` VALUES ('1792', '林魏莉', '10月31日', '1477843200', '个人', '', '个人', '', '纪翔', '现金', '自提', '林魏莉', '高原苹果', 'φ75-80', '128.00', '2', '256.00');
INSERT INTO `think_order` VALUES ('1793', '林魏莉', '10月31日', '1477929600', '个人', '', '个人', '', '秦琴', '现金', '公司配送', '林魏莉', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1794', '李宝华', '11月1日', '1477929600', '团购', '', '德高广告', '', '德高广告', '转账', '公司配送', '李宝华', '高原苹果', 'φ75-80', '128.00', '33', '4224.00');
INSERT INTO `think_order` VALUES ('1795', '李宝华', '11月1日', '1477929600', '赠送', '', '个人', '', '德高广告', '', '公司配送', '李宝华', '高原苹果', 'φ85及以上', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1796', '大礼堂团购客户', '11月1日', '1477929600', '团购', '', '个人', '', '余周利', '转账', '公司配送', '大礼堂团购客户', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1797', '大礼堂团购客户', '11月1日', '1477929600', '团购', '', '个人', '', '蒲金刚', '转账', '公司配送', '大礼堂团购客户', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1798', '大礼堂团购客户', '11月1日', '1477929600', '团购', '', '个人', '', '周丽', '转账', '顺丰', '大礼堂团购客户', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1799', '熊建利', '11月1日', '1477497600', '渠道', '', '欧蕴尚品汇', '', '黄万丹', '现金', '公司配送', '熊建利', '石榴', '斤', '10.00', '91', '910.00');
INSERT INTO `think_order` VALUES ('1800', '梁琳', '11月1日', '1477929600', '赠送', '', '个人', '', '陈正全', '', '顺丰', '梁琳', '高原苹果', '2个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1801', '谭盛予', '11月1日', '1477929600', '个人', '', '个人', '', '王玲', '现金', '顺丰', '谭盛予', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1802', '张路', '11月1日', '1477929600', '个人', '', '个人', '', '张路', '现金', '自提', '张路', '高原苹果', '10元3斤/件', '10.00', '14', '140.00');
INSERT INTO `think_order` VALUES ('1803', '李宝华', '11月2日', '1478016000', '团购', '', '大礼堂支行', '', '大礼堂支行', '转账', '公司配送', '李宝华', '高原苹果', 'φ85及以上', '158.00', '3', '474.00');
INSERT INTO `think_order` VALUES ('1804', '大礼堂团购', '11月2日', '1478016000', '团购', '', '个人', '', '方明娟', '转账', '公司配送', '大礼堂团购', '高原苹果', 'φ85及以上', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1805', '熊建利', '11月2日', '1478016000', '渠道', '', '欧蕴尚品汇', '', '欧蕴尚品汇', '现金', '公司配送', '熊建利', '石榴', '斤', '6.00', '300', '1800.00');
INSERT INTO `think_order` VALUES ('1806', '李宝华', '11月2日', '1478016000', '个人', '', '个人', '', '杭虎', '现金', '自提', '李宝华', '高原苹果', 'φ75以下', '168.00', '2', '336.00');
INSERT INTO `think_order` VALUES ('1807', '李宝华', '11月2日', '1478016000', '个人', '', '个人', '', '杭虎', '现金', '自提', '李宝华', '克伦生葡萄', '5斤/件', '98.00', '3', '294.00');
INSERT INTO `think_order` VALUES ('1808', '李宝华', '11月2日', '1478016000', '个人', '', '个人', '', '杭虎', '现金', '自提', '李宝华', '石榴', '9个装', '98.00', '3', '294.00');
INSERT INTO `think_order` VALUES ('1809', '李宝华', '11月2日', '1478016000', '个人', '', '个人', '', '杭虎', '现金', '自提', '李宝华', '高原苹果', 'φ75-80', '128.00', '2', '256.00');
INSERT INTO `think_order` VALUES ('1810', '郁生源', '11月2日', '1478016000', '员工折扣', '', '员工折扣', '', '谭盛予', '现金', '自提', '郁生源', '高原苹果', 'φ75-80', '128.00', '5', '640.00');
INSERT INTO `think_order` VALUES ('1811', '林魏莉', '11月2日', '1478016000', '个人', '', '个人', '', '刘英悦', '现金', '顺丰', '林魏莉', '高原苹果', 'φ75-80', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1812', '林魏莉', '11月2日', '1478016000', '个人', '', '个人', '', '李炜', '现金', '顺丰', '林魏莉', '高原苹果', 'φ75-80', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1813', '谭盛予', '11月2日', '1478016000', '个人', '', '个人', '', '赵之宁', '现金', '自提', '谭盛予', '克伦生葡萄', '5斤/件', '98.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1814', '李宝华', '11月2日', '1478102400', '团购', '', '个人', '', '王黎', '转账', '公司配送', '李宝华', '高原苹果', 'φ75-80', '128.00', '4', '512.00');
INSERT INTO `think_order` VALUES ('1815', '李宝华', '11月2日', '1478016000', '个人', '', '个人', '', '刀刀', '现金', '顺丰', '李宝华', '高原苹果', 'φ75以下', '168.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1816', '大礼堂支行介绍', '11月2日', '1478016000', '赠送', '', '重庆银行南坪支行', '', '重庆银行南坪支行', '', '自送', '大礼堂支行介绍', '高原苹果', 'φ85及以上', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1817', '梁琳', '11月2日', '1478016000', '团购', '', '三峡银行北部新区支行', '', '雷主任', '转账', '公司配送', '梁琳', '高原苹果', 'φ85及以上', '158.00', '10', '1580.00');
INSERT INTO `think_order` VALUES ('1818', '李宝华', '11月2日', '1478102400', '个人', '', '个人', '', '刘艳玮', '现金', '顺丰', '李宝华', '高原苹果', 'φ75-80', '128.00', '1', '140.00');
INSERT INTO `think_order` VALUES ('1819', '林魏莉', '11月3日', '1478102400', '赠送', '', '水投集团', '', '张小林', '', '自送', '林魏莉', '高原苹果', 'φ75-80', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1820', '邓倩', '11月3日', '1478188800', '个人', '', '个人', '', '王耀丽', '转账', '公司配送', '邓倩', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1821', '李宝华', '11月3日', '1478102400', '团购', '', '重庆银行山峡广场支行', '', '苏葵', '转账', '公司配送', '李宝华', '高原苹果', 'φ85及以上', '158.00', '6', '948.00');
INSERT INTO `think_order` VALUES ('1822', '李宝华', '11月3日', '1478102400', '团购', '', '重庆银行重大支行', '', '杨主任', '转账', '公司配送', '李宝华', '高原苹果', 'φ85及以上', '158.00', '6', '948.00');
INSERT INTO `think_order` VALUES ('1823', '邓倩', '11月3日', '1478102400', '个人', '', '个人', '', '樊女士', '转账', '自送', '邓倩', '苹果券', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1824', '熊建利', '11月3日', '1478102400', '渠道送样', '', '贺兰亭酒庄', '', '皮总', '', '自送', '熊建利', '蓝莓果酒', '半甜型', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1825', '吴春华', '11月3日', '1478102400', '个人', '', '个人', '', '吴春华', '现金', '自提', '吴春华', '高原苹果', 'φ75以下', '168.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1826', '林魏莉', '11月3日', '1478102400', '团购', '', '大渡口融兴村镇银行', '', '马主任', '转账', '公司配送', '林魏莉', '高原苹果', 'φ75以下', '168.00', '12', '2016.00');
INSERT INTO `think_order` VALUES ('1827', '林魏丽', '11月3日', '1478188800', '赠送', '', '浙商银行重庆分行', '', '金涛', '赠送', '公司配送', '林魏丽', '高原苹果', 'φ75-80', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1828', '林魏丽', '11月3日', '1478188800', '赠送', '', '华夏银行渝北支行', '', '任行长', '赠送', '公司配送', '林魏丽', '高原苹果', 'φ75-80', '0.00', '3', '0.00');
INSERT INTO `think_order` VALUES ('1829', '林魏丽', '11月3日', '1478188800', '赠送', '', '华夏银行渝北支行', '', '任行长', '赠送', '公司配送', '林魏丽', '蓝莓果酒', '非甜型', '0.00', '6', '0.00');
INSERT INTO `think_order` VALUES ('1830', '微店', '11月3日', '1478188800', '微店订单', '', '微店订单', '', '刘敏才', '微店结算', '顺丰', '微店', '高原苹果', 'φ85及以上', '178.00', '1', '178.00');
INSERT INTO `think_order` VALUES ('1831', '林魏丽', '11月3日', '1478188800', '赠送', '', '奥园地产', '', '李颖', '赠送', '公司配送', '林魏丽', '高原苹果', 'φ75-80', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1832', '林魏莉', '11月4日', '1478188800', '渠道', '', '有间果铺', '', '李老师', '现金', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1833', '林魏莉', '11月4日', '1478188800', '渠道', '', '有间果铺', '', '李仁兰', '现金', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1834', '谭盛予', '11月4日', '1478188800', '个人', '', '龙老师', '', '龙老师', '现金', '公司配送', '谭盛予', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1835', '吴春华', '11月4日', '1478188800', '个人', '', '个人', '', '吴春华', '现金', '自提', '吴春华', '高原苹果', 'φ75以下', '168.00', '3', '504.00');
INSERT INTO `think_order` VALUES ('1836', '张路', '11月4日', '1478188800', '个人', '', '个人', '', '张路', '现金', '自提', '张路', '高原苹果', '10元3斤/件', '10.00', '19', '190.00');
INSERT INTO `think_order` VALUES ('1837', '张路', '11月4日', '1478188800', '个人', '', '个人', '', '张路', '现金', '自提', '张路', '克伦生葡萄', '斤', '5.00', '156', '782.50');
INSERT INTO `think_order` VALUES ('1838', '吴春华', '11月4日', '1478188800', '个人', '', '个人', '', '吴春华', '现金', '自提', '吴春华', '高原苹果', 'φ75以下', '168.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1839', '林魏莉', '11月4日', '1478188800', '个人', '', '个人', '', '韩梅', '现金', '顺丰', '林魏莉', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1840', '李宝华', '11月4日', '1478188800', '团购', '', '重庆银行重大支行', '', '杨主任', '转账', '公司配送', '李宝华', '高原苹果', 'φ85及以上', '158.00', '10', '1580.00');
INSERT INTO `think_order` VALUES ('1841', '李宝华', '11月4日', '1478448000', '团购', '', '重庆银行重大支行', '', '杨主任', '转账', '公司配送', '李宝华', '高原苹果', 'φ85及以上', '158.00', '23', '3634.00');
INSERT INTO `think_order` VALUES ('1842', '李宝华', '11月4日', '1478448000', '团购', '', '重庆银行重大支行', '', '杨主任', '转账', '公司配送', '李宝华', '苹果券', 'φ85及以上', '158.00', '71', '11218.00');
INSERT INTO `think_order` VALUES ('1843', '公共', '11月7日', '1478448000', '个人', '', '个人', '', '陈小姐', '转账', '公司配送', '公共', '高原苹果', 'φ75以下', '168.00', '2', '336.00');
INSERT INTO `think_order` VALUES ('1844', '李宝华', '11月7日', '1478448000', '个人', '', '个人', '', '魏建新', '转账', '公司配送', '李宝华', '高原苹果', 'φ85及以上', '158.00', '6', '948.00');
INSERT INTO `think_order` VALUES ('1845', '李宝华', '11月7日', '1478448000', '赠送', '', '个人', '', '王主任', '', '自送', '李宝华', '高原苹果', 'φ85及以上', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1846', '李宝华', '11月7日', '1478448000', '赠送', '', '个人', '', '王主任', '', '自送', '李宝华', '高原苹果', 'φ75以下', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1847', '李宝华', '11月7日', '1478448000', '团购', '', '重庆银行大礼堂支行', '', '重庆银行大礼堂支行', '转账', '公司配送', '李宝华', '高原苹果', 'φ85及以上', '158.00', '5', '790.00');
INSERT INTO `think_order` VALUES ('1848', '李宝华', '11月7日', '1478534400', '赠送', '', 'HeyCake', '', '袁经理', '', '公司配送', '李宝华', '高原苹果', 'φ85及以上', '0.00', '3', '0.00');
INSERT INTO `think_order` VALUES ('1849', '李宝华', '11月8日', '1478534400', '个人', '', '个人', '', '方翥', '转账', '自送', '李宝华', '高原苹果', 'φ85及以上', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1850', '李宝华', '11月8日', '1478620800', '团购', '', '德高广告', '', '德高广告', '转账', '公司配送', '李宝华', '高原苹果', 'φ75-80', '128.00', '60', '7680.00');
INSERT INTO `think_order` VALUES ('1851', '李宝华', '11月8日', '1478534400', '赠送', '', '重庆银行西郊支行', '', '向上', '', '自送', '李宝华', '高原苹果', 'φ75-80', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1852', '李宝华', '11月8日', '1478534400', '赠送', '', '个人', '', '段蓉・张译心', '', '自送', '李宝华', '高原苹果', 'φ85及以上', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1853', '邓倩', '11月8日', '1478534400', '个人', '', '光大银行公司管理部', '', '徐小乔', '转账', '顺丰', '邓倩', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1854', '李宝华', '11月8日', '1478534400', '赠送', '', '个人', '', '张译心', '', '自送', '李宝华', '高原苹果', 'φ75-80', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1855', '李宝华', '11月8日', '1478534400', '赠送', '', '个人', '', '黄剑', '', '自提', '李宝华', '高原苹果', 'φ75-80', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1856', '李宝华', '11月8日', '1478620800', '个人', '', '个人', '', '杨晴', '现金', '顺丰', '李宝华', '高原苹果', 'φ75-80', '128.00', '2', '256.00');
INSERT INTO `think_order` VALUES ('1857', '微店', '11月9日', '1478620800', '微店订单', '', '微店订单', '', '高英', '微店结算', '顺丰', '微店', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1858', '熊建利', '11月9日', '1478620800', '渠道送样', '', '盘溪批发市场', '', '本福果业', '', '公司配送', '熊建利', '石榴', '4个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1859', '林魏丽', '11月9日', '1478620800', '渠道', '', '有间果铺', '', '黄萍', '现金', '顺丰', '林魏丽', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1860', '童云', '11月9日', '1478620800', '个人', '', '个人', '', '刘艳花', '现金', '顺丰', '童云', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1861', '童云', '11月9日', '1478620800', '个人', '', '个人', '', '刘艳花', '现金', '顺丰', '童云', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1862', '李宝华', '11月9日', '1478620800', '赠送', '', '个人', '', '沈铁梅', '', '自送', '李宝华', '高原苹果', 'φ85及以上', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1863', '李宝华', '11月9日', '1478620800', '赠送', '', '个人', '', '沈铁梅', '', '自送', '李宝华', '高原苹果', 'φ75以下', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1864', '德高广告团', '11月9日', '1478620800', '团购', '', '德高广告团', '', '李元聪', '转账', '顺丰', '德高广告团', '高原苹果', 'φ85及以上', '158.00', '6', '948.00');
INSERT INTO `think_order` VALUES ('1865', '德高广告团', '11月9日', '1478620800', '团购', '', '德高广告团', '', '汪媛媛', '转账', '顺丰', '德高广告团', '高原苹果', 'φ85及以上', '158.00', '3', '474.00');
INSERT INTO `think_order` VALUES ('1866', '德高广告团', '11月9日', '1478620800', '团购', '', '德高广告团', '', '马明媛', '转账', '顺丰', '德高广告团', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1867', '德高广告团', '11月9日', '1478620800', '团购', '', '德高广告团', '', '邱朝举', '转账', '顺丰', '德高广告团', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1868', '德高广告团', '11月9日', '1478620800', '团购', '', '德高广告团', '', '李恩政', '转账', '顺丰', '德高广告团', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1869', '德高广告团', '11月9日', '1478620800', '团购', '', '德高广告团', '', '阎家旭', '转账', '顺丰', '德高广告团', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1870', '德高广告团', '11月9日', '1478620800', '团购', '', '德高广告团', '', '徐刚', '转账', '顺丰', '德高广告团', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1871', '李宝华', '11月9日', '1478707200', '团购', '', '华夏银行渝中支行', '', '王珏', '转账', '公司配送', '李宝华', '高原苹果', 'φ75-80', '128.00', '9', '1152.00');
INSERT INTO `think_order` VALUES ('1872', '李宝华', '11月9日', '1478707200', '团购', '', '华夏银行渝中支行', '', '王珏', '转账', '公司配送', '李宝华', '高原苹果', 'φ75以下', '168.00', '3', '504.00');
INSERT INTO `think_order` VALUES ('1873', '李宝华', '11月9日', '1478707200', '团购', '', '重庆银行高新支行', '', '重庆银行高新支行', '转账', '公司配送', '李宝华', '高原苹果', 'φ75-80', '128.00', '80', '10240.00');
INSERT INTO `think_order` VALUES ('1874', '李宝华', '11月9日', '1478707200', '团购', '', '重庆银行高新支行', '', '重庆银行高新支行', '转账', '公司配送', '李宝华', '高原苹果', '8个装', '64.00', '16', '1024.00');
INSERT INTO `think_order` VALUES ('1875', '林魏丽', '11月9日', '1478707200', '渠道', '', '有间果铺', '', '王小梅', '现金', '顺丰', '林魏丽', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1876', '李宝华', '11月10日', '1478707200', '赠送', '', '重庆银行建北支行', '', '马又佳', '', '自送', '李宝华', '高原苹果', 'φ75-80', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1877', '李宝华', '11月10日', '1478707200', '赠送', '', '重庆银行渝北支行', '', '王行长', '', '自送', '李宝华', '高原苹果', 'φ75-80', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1878', '李宝华', '11月10日', '1478707200', '团购', '', '重庆银行高新支行', '', '重庆银行高新支行', '转账', '公司配送', '李宝华', '高原苹果', 'φ85及以上', '158.00', '10', '1580.00');
INSERT INTO `think_order` VALUES ('1879', '梁琳', '11月10日', '1478793600', '个人', '', '华夏银行渝中支行娟娟', '', '老师', '现金', '公司配送', '梁琳', '高原苹果', 'φ75-80', '128.00', '2', '256.00');
INSERT INTO `think_order` VALUES ('1880', '李宝华', '11月11日', '1478793600', '赠送', '', '个人', '', '林魏莉', '', '自送', '李宝华', '高原苹果', 'φ75-80', '0.00', '6', '0.00');
INSERT INTO `think_order` VALUES ('1881', '微店', '11月11日', '1478793600', '微店订单', '', '微店订单', '', '施胥狄', '现金', '顺丰', '微店', '高原苹果', 'φ75-80', '128.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1882', '熊建利', '11月11日', '1478793600', '渠道', '', '本福果业', '', '沈伊', '现金', '公司配送', '熊建利', '石榴', '9个装', '60.00', '30', '1800.00');
INSERT INTO `think_order` VALUES ('1883', '谭盛予', '11月11日', '1478793600', '员工折扣', '', '员工折扣', '', '谭盛予', '现金', '自送', '谭盛予', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1884', '梁琳', '11月11日', '1478793600', '团购', '', '三峡银行北部新区支行', '', '雷姐', '转账', '公司配送', '梁琳', '高原苹果', 'φ85及以上', '158.00', '5', '790.00');
INSERT INTO `think_order` VALUES ('1885', '邓倩', '11月11日', '1478793600', '个人', '', '个人', '', '刘年华', '转账', '顺丰', '邓倩', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1886', '熊建利', '11月11日', '1478793600', '渠道', '', '周凤', '', '周凤', '现金', '自提', '熊建利', '石榴', '斤', '7.00', '86', '608.00');
INSERT INTO `think_order` VALUES ('1887', '林魏莉', '11月11日', '1478793600', '渠道', '', '有间果铺', '', '吴利平', '现金', '顺丰', '林魏莉', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1888', '李宝华', '11月11日', '1478793600', '团购', '', '大礼堂支行', '', '大礼堂支行', '转账', '自送', '李宝华', '苹果券', 'φ85及以上', '158.00', '3', '474.00');
INSERT INTO `think_order` VALUES ('1889', '熊建利', '11月11日', '1478793600', '渠道', '', '周凤', '', '周凤', '现金', '自提', '熊建利', '高原苹果', '斤', '5.00', '53', '268.00');
INSERT INTO `think_order` VALUES ('1890', '谭盛予', '11月11日', '1478793600', '渠道', '', '玲玲', '', '玲玲', '现金', '顺丰', '谭盛予', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1891', '李宝华', '11月14日', '1479052800', '赠送', '', '陈谋', '', '陈谋', '', '自送', '李宝华', '高原苹果', 'φ75-80', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1892', '梁琳', '11月14日', '1479052800', '赠送', '', '陈静', '', '陈静', '', '自送', '曹华', '高原苹果', 'φ75-80', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1893', '谭盛予', '11月14日', '1479052800', '个人', '', '贺怀梦', '', '贺怀梦', '现金', '公司配送', '谭盛予', '高原苹果', 'φ75-80', '128.00', '6', '768.00');
INSERT INTO `think_order` VALUES ('1894', '梁琳', '11月14日', '1479052800', '团购', '', '三峡银行北部新区支行', '', '雷主任', '转账', '公司配送', '梁琳', '高原苹果', 'φ85及以上', '158.00', '20', '3160.00');
INSERT INTO `think_order` VALUES ('1895', '熊建利', '11月14日', '1478966400', '渠道', '', '重庆影视频道健康才有戏', '', '熊建利', '现金', '公司配送', '熊建利', '高原苹果', '2个装', '16.00', '10', '160.00');
INSERT INTO `think_order` VALUES ('1896', '邓倩', '11月14日', '1479052800', '团购', '', '重庆银行高新支行', '', '重庆银行高新支行', '转账', '公司配送', '李宝华', '高原苹果', 'φ85及以上', '158.00', '20', '3160.00');
INSERT INTO `think_order` VALUES ('1897', '熊建利', '11月14日', '1478966400', '渠道送样', '', '恒智礼品', '', '朱凤英', '', '自提', '熊建利', '高原苹果', '4个装', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1898', '李宝华', '11月14日', '1479052800', '个人', '', '个人', '', '李宝华', '现金', '公司配送', '李宝华', '高原苹果', '75果8个装', '30.00', '40', '1200.00');
INSERT INTO `think_order` VALUES ('1899', '李宝华', '11月14日', '1479225600', '个人', '', '个人', '', '李宝华', '现金', '公司配送', '李宝华', '高原苹果', '75果8个装', '30.00', '30', '900.00');
INSERT INTO `think_order` VALUES ('1900', '李宝华', '11月14日', '1479052800', '赠送', '', '个人', '', '李莉', '', '自送', '李宝华', '高原苹果', 'φ75-80', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1901', '谭盛予', '11月15日', '1479139200', '渠道', '', '有间果铺', '', '邱老师', '现金', '顺丰', '林魏丽', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1902', '谭盛予', '11月15日', '1479139200', '个人', '', '个人', '', '朱建伟', '现金', '顺丰', '林魏丽', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1903', '谭盛予', '11月15日', '1479139200', '员工折扣', '', '员工折扣', '', '谭盛予', '现金', '自提', '谭盛予', '高原苹果', 'φ75-80', '128.00', '2', '256.00');
INSERT INTO `think_order` VALUES ('1904', '邓倩', '11月15日', '1479139200', '个人', '', '个人', '', '何高华', '转账', '顺丰', '邓倩', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1905', '邓倩', '11月15日', '1479139200', '个人', '', '个人', '', '刘颖', '转账', '顺丰', '邓倩', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1906', '邓倩', '11月15日', '1479139200', '个人', '', '个人', '', '黄渭', '转账', '顺丰', '邓倩', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1907', '谭盛予', '11月15日', '1479225600', '个人', '', '个人', '', '许菲', '现金', '顺丰', '谭盛予', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1908', '谭盛予', '11月15日', '1479225600', '个人', '', '个人', '', '颜茂竹', '现金', '顺丰', '谭盛予', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1909', '谭盛予', '11月15日', '1479225600', '个人', '', '个人', '', '严老师', '现金', '顺丰', '谭盛予', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1910', '谭盛予', '11月15日', '1479225600', '渠道', '', '有间果铺', '', '李仁兰', '现金', '顺丰', '林魏丽', '高原苹果', 'φ85及以上', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1911', '邓倩', '11月16日', '1479225600', '团购', '', '德高广告', '', '德高广告', '转账', '公司配送', '李宝华', '高原苹果', 'φ85及以上', '158.00', '5', '790.00');
INSERT INTO `think_order` VALUES ('1912', '邓倩', '11月16日', '1479225600', '团购', '', '个人', '', '熊萍', '转账', '公司配送', '德高团购', '高原苹果', 'φ85及以上', '158.00', '6', '948.00');
INSERT INTO `think_order` VALUES ('1913', '邓倩', '11月16日', '1479312000', '个人', '', '个人', '', '周琼莹', '转账', '公司配送', '邓倩', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1914', '李宝华', '11月16日', '1479225600', '个人', '', '个人', '', '韩玲', '转账', '顺丰', '李宝华(冯晶)', '高原苹果', 'φ75以下', '168.00', '4', '627.00');
INSERT INTO `think_order` VALUES ('1915', '李宝华', '11月16日', '1479312000', '个人', '', '快达旅行社', '', '罗老师', '转账', '公司配送', '李宝华', '高原苹果', 'φ75-80', '128.00', '2', '256.00');
INSERT INTO `think_order` VALUES ('1916', '李茜', '11月16日', '1479225600', '渠道', '', '成都农博会', '', '李茜', '现金', '公司配送', '李茜', '蓝莓果酒', '500ML/瓶', '31.00', '24', '744.00');
INSERT INTO `think_order` VALUES ('1917', '李茜', '11月16日', '1479225600', '渠道', '', '成都农博会', '', '李茜', '现金', '公司配送', '李茜', '蓝莓果酱', '瓶', '33.00', '42', '1386.00');
INSERT INTO `think_order` VALUES ('1918', '李茜', '11月16日', '1479225600', '渠道', '', '成都农博会', '', '李茜', '现金', '公司配送', '李茜', '蜂蜜', '瓶', '18.00', '65', '1170.00');
INSERT INTO `think_order` VALUES ('1919', '李茜', '11月16日', '1479225600', '渠道', '', '成都农博会', '', '李茜', '现金', '公司配送', '李茜', '高原苹果', '个', '14.00', '38', '532.00');
INSERT INTO `think_order` VALUES ('1920', '李茜', '11月16日', '1479225600', '渠道', '', '成都农博会', '', '李茜', '现金', '公司配送', '李茜', '高原苹果', '个', '0.00', '26', '0.00');
INSERT INTO `think_order` VALUES ('1921', '邓倩', '11月16日', '1479225600', '赠送', '', '重庆银行朝天门支行', '', '重庆银行朝天门支行', '', '自送', '李宝华', '高原苹果', 'φ75-80', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1922', '林魏莉', '11月16日', '1479312000', '团购', '', '江北区司法局', '', '钱伟', '现金', '公司配送', '李宝华', '高原苹果', 'φ75-80', '128.00', '15', '1920.00');
INSERT INTO `think_order` VALUES ('1923', '林魏莉', '11月16日', '1479312000', '团购', '', '江北区司法局', '', '钱伟', '现金', '公司配送', '李宝华', '苹果券', 'φ75-80', '128.00', '2', '256.00');
INSERT INTO `think_order` VALUES ('1924', '邓倩', '11月17日', '1479312000', '团购', '', '远达环保袁莱', '', '远达环保袁莱', '转账', '公司配送', '吴勇', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1925', '林魏莉', '11月17日', '1479312000', '赠送', '', '个人', '', '钱伟', '', '公司配送', '李宝华', '高原苹果', 'φ75-80', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1926', '李宝华', '11月17日', '1479312000', '个人', '', '个人', '', '曲主任', '转账', '公司配送', '李宝华（何总）', '高原苹果', 'φ75-80', '128.00', '2', '256.00');
INSERT INTO `think_order` VALUES ('1927', '熊建利', '11月17日', '1479312000', '换货', '', '个人', '', '黄店长', '', '公司配送', '熊建利', '石榴', '个', '0.00', '6', '0.00');
INSERT INTO `think_order` VALUES ('1928', '林魏莉', '11月17日', '1479312000', '个人', '', '个人', '', '于勇', '现金', '顺丰', '林魏莉', '高原苹果', 'φ75以下', '168.00', '1', '207.00');
INSERT INTO `think_order` VALUES ('1929', '梁琳', '11月17日', '1479312000', '团购', '', '重大支行', '', '刘倩', '转账', '公司配送', '梁琳', '高原苹果', 'φ85及以上', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1930', '李宝华', '11月17日', '1479398400', '个人', '', '土地中心', '', '杭虎', '现金', '自提', '李宝华', '高原苹果', 'φ75-80', '128.00', '10', '1280.00');
INSERT INTO `think_order` VALUES ('1931', '林魏莉', '11月17日', '1479398400', '团购', '', '维权协会其中一个兑券客户', '', '唐萌', '现金', '公司配送', '李宝华', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1932', '林魏莉', '11月17日', '1479398400', '退货', '', '维权协会其中一个兑券客户', '', '唐萌', '现金', '公司配送', '李宝华', '高原苹果', 'φ75-80', '128.00', '0', '0.00');
INSERT INTO `think_order` VALUES ('1933', '梁琳', '11月17日', '1479312000', '退货', '', '个人', '', '刘倩', '转账', '公司配送', '梁琳', '高原苹果', 'φ85及以上', '158.00', '0', '0.00');
INSERT INTO `think_order` VALUES ('1934', '张路', '11月18日', '1479398400', '个人', '', '个人', '', '张路', '现金', '自提', '张路', '高原苹果', '斤', '5.00', '21', '109.00');
INSERT INTO `think_order` VALUES ('1935', '张路', '11月18日', '1479398400', '个人', '', '个人', '', '张路', '现金', '自提', '张路', '石榴', '斤', '7.00', '21', '148.00');
INSERT INTO `think_order` VALUES ('1936', '李宝华', '11月18日', '1479398400', '赠送', '', '个人', '', '黄勤', '', '自送', '李宝华', '高原苹果', 'φ75-80', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1937', '谭盛予', '11月18日', '1479398400', '渠道', '', '有间果铺', '', '李老师', '现金', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1938', '童云', '11月18日', '1479657600', '个人', '', '个人', '', '谭静', '现金', '顺丰', '童云', '高原苹果', 'φ75-80', '128.00', '2', '256.00');
INSERT INTO `think_order` VALUES ('1939', '谭盛予', '11月18日', '1479398400', '个人', '', '个人', '', '谭盛予', '现金', '自提', '郁生源', '高原苹果', 'φ75-80', '128.00', '3', '384.00');
INSERT INTO `think_order` VALUES ('1940', '谭盛予', '11月18日', '1479398400', '个人', '', '个人', '', '谭盛予', '现金', '自提', '郁生源', '蓝莓果酒', '500ML/瓶', '100.00', '2', '200.00');
INSERT INTO `think_order` VALUES ('1941', '林魏莉', '11月18日', '1479398400', '个人', '', '个人', '', '曾医生', '现金', '自提', '林魏莉', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1942', '梁琳', '11月18日', '1479657600', '个人', '', '个人', '', '金涛・张旗', '现金', '顺丰', '林魏莉', '高原苹果', 'φ85及以上', '158.00', '2', '316.00');
INSERT INTO `think_order` VALUES ('1943', '邓倩', '11月21日', '1479657600', '团购', '', '德高广告', '', '德高广告', '转账', '公司配送', '李宝华', '高原苹果', 'φ75-80', '128.00', '20', '2560.00');
INSERT INTO `think_order` VALUES ('1944', '胡微', '11月21日', '1479657600', '赠送', '', '沙坪坝国税专管员', '', '胡涛', '', '公司配送', '胡微', '高原苹果', 'φ75-80', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1945', '充值扣除', '11月21日', '1479657600', '会员', '', '会员', '', '王青', '会员扣费', '公司配送', '李宝华', '高原苹果', 'φ85及以上', '158.00', '7', '1106.00');
INSERT INTO `think_order` VALUES ('1946', '邓倩', '11月21日', '1479657600', '团购', '', '重庆银行高新支行', '', '重庆银行高新支行', '转账', '公司配送', '李宝华', '高原苹果', 'φ85及以上', '158.00', '10', '1580.00');
INSERT INTO `think_order` VALUES ('1947', '李宝华', '11月21日', '1479657600', '赠送', '', '个人', '', '王老师', '', '自送', '李宝华', '高原苹果', 'φ75-80', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1948', '李宝华', '11月21日', '1479657600', '赠送', '', '个人', '', '王老师', '', '自送', '李宝华', '高原苹果', 'φ75以下', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1949', '梁琳', '11月21日', '1479744000', '团购', '', '奥园', '', '张海涛', '转账', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '158.00', '10', '1580.00');
INSERT INTO `think_order` VALUES ('1950', '梁琳', '11月21日', '1479744000', '团购', '', '奥园', '', '裴卿', '转账', '顺丰', '林魏莉', '高原苹果', 'φ85及以上', '158.00', '20', '3160.00');
INSERT INTO `think_order` VALUES ('1951', '梁琳', '11月21日', '1479744000', '团购', '', '奥园', '', '曾欣', '转账', '公司配送', '林魏莉', '高原苹果', 'φ85及以上', '158.00', '10', '1580.00');
INSERT INTO `think_order` VALUES ('1952', '梁琳', '11月21日', '1479744000', '团购', '', '三峡银行北部新区支行', '', '雷姐', '转账', '公司配送', '梁琳', '高原苹果', 'φ85及以上', '158.00', '20', '3160.00');
INSERT INTO `think_order` VALUES ('1953', '胡微', '11月22日', '1479744000', '赠送', '', '税务局', '', '胡涛', '', '', '胡微', '高原苹果', 'φ75-80', '0.00', '2', '0.00');
INSERT INTO `think_order` VALUES ('1954', '胡微', '11月22日', '1479744000', '赠送', '', '税务局', '', '胡涛', '', '', '胡微', '高原苹果', 'φ75-80', '0.00', '0', '0.00');
INSERT INTO `think_order` VALUES ('1955', '谭盛予', '11月22日', '1479830400', '个人', '', '向婧', '', '向婧', '现金', '公司配送', '谭盛予', '高原苹果', 'φ75以下', '168.00', '1', '168.00');
INSERT INTO `think_order` VALUES ('1956', '邓倩', '11月22日', '1479830400', '团购', '', '渝中区实验幼儿园', '', '渝中区实验幼儿园', '转账', '公司配送', '邓倩', '高原苹果', '斤', '8.00', '51', '410.56');
INSERT INTO `think_order` VALUES ('1957', '吕伟', '11月23日', '0', '员工折扣', '', '员工折扣', '', '吕伟', '现金', '自提', '吕伟', '高原苹果', 'φ85及以上', '158.00', '1', '158.00');
INSERT INTO `think_order` VALUES ('1958', '微店', '11月23日', '1479830400', '微店订单', '', '微店订单', '', '关先生', '微店结算', '公司配送', '微店', '高原苹果', 'φ85及以上', '0.00', '3', '0.00');
INSERT INTO `think_order` VALUES ('1959', '邓倩', '11月24日', '1479916800', '个人', '', '个人', '', '杨雪飞', '转账', '公司配送', '邓倩', '高原苹果', 'φ75-80', '128.00', '2', '256.00');
INSERT INTO `think_order` VALUES ('1960', '谭盛予', '11月24日', '1480003200', '个人', '', '个人', '', '张世光', '现金', '顺丰', '谭盛予', '高原苹果', 'φ75-80', '128.00', '1', '128.00');
INSERT INTO `think_order` VALUES ('1961', '张路', '11月25日', '1480003200', '个人', '', '个人', '', '附近居民', '现金', '自提', '张路', '高原苹果', '斤', '5.00', '9', '47.00');
INSERT INTO `think_order` VALUES ('1962', '梁琳', '11月28日', '1480348800', '团购', '', '奥园地产', '', '解景', '转账', '顺丰', '林魏莉', '高原苹果', 'φ85及以上', '170.00', '10', '1700.00');
INSERT INTO `think_order` VALUES ('1963', '梁琳', '11月29日', '1480262400', '赠送', '', '重庆银行小龙坎支行', '', '晏小川', '', '公司配送', '梁琳', '高原苹果', 'φ85及以上', '0.00', '1', '0.00');
INSERT INTO `think_order` VALUES ('1964', '邓倩', '11月29日', '1480348800', '团购', '', '渝中区实验幼儿园', '', '柯老师', '转账', '公司配送', '邓倩', '高原苹果', '斤', '8.00', '51', '414.40');
INSERT INTO `think_order` VALUES ('1965', '邓倩', '11月30日', '1480435200', '赠送', '', '渝中区实验幼儿园', '', '柯老师', '', '公司配送', '邓倩', '高原苹果', '斤', '0.00', '3', '0.00');

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
) ENGINE=InnoDB AUTO_INCREMENT=601 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of think_ticket
-- ----------------------------
INSERT INTO `think_ticket` VALUES ('1', '1', '1483781002', '127.0.0.1', '收货人姓名', '收货人地址', '11111', '123', '0', '客服备注', '物流号', '收货人省', '398', '1');
INSERT INTO `think_ticket` VALUES ('2', '1', '1483781062', '127.0.0.1', '234', '324', '2147483647', '123123123123', '0', '', '', '', '398', '2');
INSERT INTO `think_ticket` VALUES ('3', '1', '1483781149', '127.0.0.1', '567', '567', '2147483647', '53453', '0', '', '', '', '398', '3');
INSERT INTO `think_ticket` VALUES ('4', '1', '1483840303', '127.0.0.1', '姓名', '地址', '2147483647', '用户备注', '0', '客服备注', '物流号', '收货人省', '398', '4');
INSERT INTO `think_ticket` VALUES ('5', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '5');
INSERT INTO `think_ticket` VALUES ('6', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '6');
INSERT INTO `think_ticket` VALUES ('7', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '7');
INSERT INTO `think_ticket` VALUES ('8', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '8');
INSERT INTO `think_ticket` VALUES ('9', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '9');
INSERT INTO `think_ticket` VALUES ('10', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '10');
INSERT INTO `think_ticket` VALUES ('11', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '11');
INSERT INTO `think_ticket` VALUES ('12', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '12');
INSERT INTO `think_ticket` VALUES ('13', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '13');
INSERT INTO `think_ticket` VALUES ('14', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '14');
INSERT INTO `think_ticket` VALUES ('15', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '15');
INSERT INTO `think_ticket` VALUES ('16', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '16');
INSERT INTO `think_ticket` VALUES ('17', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '17');
INSERT INTO `think_ticket` VALUES ('18', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '18');
INSERT INTO `think_ticket` VALUES ('19', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '19');
INSERT INTO `think_ticket` VALUES ('20', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '20');
INSERT INTO `think_ticket` VALUES ('21', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '21');
INSERT INTO `think_ticket` VALUES ('22', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '22');
INSERT INTO `think_ticket` VALUES ('23', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '23');
INSERT INTO `think_ticket` VALUES ('24', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '24');
INSERT INTO `think_ticket` VALUES ('25', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '25');
INSERT INTO `think_ticket` VALUES ('26', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '26');
INSERT INTO `think_ticket` VALUES ('27', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '27');
INSERT INTO `think_ticket` VALUES ('28', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '28');
INSERT INTO `think_ticket` VALUES ('29', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '29');
INSERT INTO `think_ticket` VALUES ('30', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '30');
INSERT INTO `think_ticket` VALUES ('31', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '31');
INSERT INTO `think_ticket` VALUES ('32', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '32');
INSERT INTO `think_ticket` VALUES ('33', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '33');
INSERT INTO `think_ticket` VALUES ('34', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '34');
INSERT INTO `think_ticket` VALUES ('35', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '35');
INSERT INTO `think_ticket` VALUES ('36', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '36');
INSERT INTO `think_ticket` VALUES ('37', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '37');
INSERT INTO `think_ticket` VALUES ('38', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '38');
INSERT INTO `think_ticket` VALUES ('39', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '39');
INSERT INTO `think_ticket` VALUES ('40', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '40');
INSERT INTO `think_ticket` VALUES ('41', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '41');
INSERT INTO `think_ticket` VALUES ('42', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '42');
INSERT INTO `think_ticket` VALUES ('43', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '43');
INSERT INTO `think_ticket` VALUES ('44', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '44');
INSERT INTO `think_ticket` VALUES ('45', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '45');
INSERT INTO `think_ticket` VALUES ('46', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '46');
INSERT INTO `think_ticket` VALUES ('47', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '47');
INSERT INTO `think_ticket` VALUES ('48', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '48');
INSERT INTO `think_ticket` VALUES ('49', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '49');
INSERT INTO `think_ticket` VALUES ('50', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '50');
INSERT INTO `think_ticket` VALUES ('51', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '51');
INSERT INTO `think_ticket` VALUES ('52', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '52');
INSERT INTO `think_ticket` VALUES ('53', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '53');
INSERT INTO `think_ticket` VALUES ('54', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '54');
INSERT INTO `think_ticket` VALUES ('55', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '55');
INSERT INTO `think_ticket` VALUES ('56', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '56');
INSERT INTO `think_ticket` VALUES ('57', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '57');
INSERT INTO `think_ticket` VALUES ('58', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '58');
INSERT INTO `think_ticket` VALUES ('59', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '59');
INSERT INTO `think_ticket` VALUES ('60', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '60');
INSERT INTO `think_ticket` VALUES ('61', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '61');
INSERT INTO `think_ticket` VALUES ('62', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '62');
INSERT INTO `think_ticket` VALUES ('63', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '63');
INSERT INTO `think_ticket` VALUES ('64', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '64');
INSERT INTO `think_ticket` VALUES ('65', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '65');
INSERT INTO `think_ticket` VALUES ('66', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '66');
INSERT INTO `think_ticket` VALUES ('67', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '67');
INSERT INTO `think_ticket` VALUES ('68', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '68');
INSERT INTO `think_ticket` VALUES ('69', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '69');
INSERT INTO `think_ticket` VALUES ('70', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '70');
INSERT INTO `think_ticket` VALUES ('71', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '71');
INSERT INTO `think_ticket` VALUES ('72', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '72');
INSERT INTO `think_ticket` VALUES ('73', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '73');
INSERT INTO `think_ticket` VALUES ('74', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '74');
INSERT INTO `think_ticket` VALUES ('75', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '75');
INSERT INTO `think_ticket` VALUES ('76', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '76');
INSERT INTO `think_ticket` VALUES ('77', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '77');
INSERT INTO `think_ticket` VALUES ('78', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '78');
INSERT INTO `think_ticket` VALUES ('79', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '79');
INSERT INTO `think_ticket` VALUES ('80', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '80');
INSERT INTO `think_ticket` VALUES ('81', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '81');
INSERT INTO `think_ticket` VALUES ('82', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '82');
INSERT INTO `think_ticket` VALUES ('83', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '83');
INSERT INTO `think_ticket` VALUES ('84', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '84');
INSERT INTO `think_ticket` VALUES ('85', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '85');
INSERT INTO `think_ticket` VALUES ('86', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '86');
INSERT INTO `think_ticket` VALUES ('87', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '87');
INSERT INTO `think_ticket` VALUES ('88', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '88');
INSERT INTO `think_ticket` VALUES ('89', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '89');
INSERT INTO `think_ticket` VALUES ('90', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '90');
INSERT INTO `think_ticket` VALUES ('91', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '91');
INSERT INTO `think_ticket` VALUES ('92', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '92');
INSERT INTO `think_ticket` VALUES ('93', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '93');
INSERT INTO `think_ticket` VALUES ('94', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '94');
INSERT INTO `think_ticket` VALUES ('95', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '95');
INSERT INTO `think_ticket` VALUES ('96', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '96');
INSERT INTO `think_ticket` VALUES ('97', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '97');
INSERT INTO `think_ticket` VALUES ('98', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '98');
INSERT INTO `think_ticket` VALUES ('99', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '99');
INSERT INTO `think_ticket` VALUES ('100', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '100');
INSERT INTO `think_ticket` VALUES ('101', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '101');
INSERT INTO `think_ticket` VALUES ('102', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '102');
INSERT INTO `think_ticket` VALUES ('103', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '103');
INSERT INTO `think_ticket` VALUES ('104', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '104');
INSERT INTO `think_ticket` VALUES ('105', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '105');
INSERT INTO `think_ticket` VALUES ('106', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '106');
INSERT INTO `think_ticket` VALUES ('107', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '107');
INSERT INTO `think_ticket` VALUES ('108', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '108');
INSERT INTO `think_ticket` VALUES ('109', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '109');
INSERT INTO `think_ticket` VALUES ('110', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '110');
INSERT INTO `think_ticket` VALUES ('111', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '111');
INSERT INTO `think_ticket` VALUES ('112', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '112');
INSERT INTO `think_ticket` VALUES ('113', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '113');
INSERT INTO `think_ticket` VALUES ('114', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '114');
INSERT INTO `think_ticket` VALUES ('115', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '115');
INSERT INTO `think_ticket` VALUES ('116', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '116');
INSERT INTO `think_ticket` VALUES ('117', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '117');
INSERT INTO `think_ticket` VALUES ('118', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '118');
INSERT INTO `think_ticket` VALUES ('119', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '119');
INSERT INTO `think_ticket` VALUES ('120', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '120');
INSERT INTO `think_ticket` VALUES ('121', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '121');
INSERT INTO `think_ticket` VALUES ('122', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '122');
INSERT INTO `think_ticket` VALUES ('123', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '123');
INSERT INTO `think_ticket` VALUES ('124', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '124');
INSERT INTO `think_ticket` VALUES ('125', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '125');
INSERT INTO `think_ticket` VALUES ('126', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '126');
INSERT INTO `think_ticket` VALUES ('127', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '127');
INSERT INTO `think_ticket` VALUES ('128', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '128');
INSERT INTO `think_ticket` VALUES ('129', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '129');
INSERT INTO `think_ticket` VALUES ('130', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '130');
INSERT INTO `think_ticket` VALUES ('131', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '131');
INSERT INTO `think_ticket` VALUES ('132', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '132');
INSERT INTO `think_ticket` VALUES ('133', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '133');
INSERT INTO `think_ticket` VALUES ('134', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '134');
INSERT INTO `think_ticket` VALUES ('135', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '135');
INSERT INTO `think_ticket` VALUES ('136', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '136');
INSERT INTO `think_ticket` VALUES ('137', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '137');
INSERT INTO `think_ticket` VALUES ('138', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '138');
INSERT INTO `think_ticket` VALUES ('139', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '139');
INSERT INTO `think_ticket` VALUES ('140', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '140');
INSERT INTO `think_ticket` VALUES ('141', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '141');
INSERT INTO `think_ticket` VALUES ('142', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '142');
INSERT INTO `think_ticket` VALUES ('143', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '143');
INSERT INTO `think_ticket` VALUES ('144', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '144');
INSERT INTO `think_ticket` VALUES ('145', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '145');
INSERT INTO `think_ticket` VALUES ('146', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '146');
INSERT INTO `think_ticket` VALUES ('147', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '147');
INSERT INTO `think_ticket` VALUES ('148', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '148');
INSERT INTO `think_ticket` VALUES ('149', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '149');
INSERT INTO `think_ticket` VALUES ('150', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '150');
INSERT INTO `think_ticket` VALUES ('151', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '151');
INSERT INTO `think_ticket` VALUES ('152', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '152');
INSERT INTO `think_ticket` VALUES ('153', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '153');
INSERT INTO `think_ticket` VALUES ('154', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '154');
INSERT INTO `think_ticket` VALUES ('155', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '155');
INSERT INTO `think_ticket` VALUES ('156', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '156');
INSERT INTO `think_ticket` VALUES ('157', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '157');
INSERT INTO `think_ticket` VALUES ('158', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '158');
INSERT INTO `think_ticket` VALUES ('159', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '159');
INSERT INTO `think_ticket` VALUES ('160', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '160');
INSERT INTO `think_ticket` VALUES ('161', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '161');
INSERT INTO `think_ticket` VALUES ('162', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '162');
INSERT INTO `think_ticket` VALUES ('163', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '163');
INSERT INTO `think_ticket` VALUES ('164', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '164');
INSERT INTO `think_ticket` VALUES ('165', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '165');
INSERT INTO `think_ticket` VALUES ('166', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '166');
INSERT INTO `think_ticket` VALUES ('167', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '167');
INSERT INTO `think_ticket` VALUES ('168', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '168');
INSERT INTO `think_ticket` VALUES ('169', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '169');
INSERT INTO `think_ticket` VALUES ('170', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '170');
INSERT INTO `think_ticket` VALUES ('171', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '171');
INSERT INTO `think_ticket` VALUES ('172', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '172');
INSERT INTO `think_ticket` VALUES ('173', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '173');
INSERT INTO `think_ticket` VALUES ('174', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '174');
INSERT INTO `think_ticket` VALUES ('175', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '175');
INSERT INTO `think_ticket` VALUES ('176', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '176');
INSERT INTO `think_ticket` VALUES ('177', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '177');
INSERT INTO `think_ticket` VALUES ('178', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '178');
INSERT INTO `think_ticket` VALUES ('179', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '179');
INSERT INTO `think_ticket` VALUES ('180', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '180');
INSERT INTO `think_ticket` VALUES ('181', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '181');
INSERT INTO `think_ticket` VALUES ('182', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '182');
INSERT INTO `think_ticket` VALUES ('183', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '183');
INSERT INTO `think_ticket` VALUES ('184', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '184');
INSERT INTO `think_ticket` VALUES ('185', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '185');
INSERT INTO `think_ticket` VALUES ('186', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '186');
INSERT INTO `think_ticket` VALUES ('187', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '187');
INSERT INTO `think_ticket` VALUES ('188', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '188');
INSERT INTO `think_ticket` VALUES ('189', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '189');
INSERT INTO `think_ticket` VALUES ('190', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '190');
INSERT INTO `think_ticket` VALUES ('191', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '191');
INSERT INTO `think_ticket` VALUES ('192', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '192');
INSERT INTO `think_ticket` VALUES ('193', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '193');
INSERT INTO `think_ticket` VALUES ('194', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '194');
INSERT INTO `think_ticket` VALUES ('195', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '195');
INSERT INTO `think_ticket` VALUES ('196', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '196');
INSERT INTO `think_ticket` VALUES ('197', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '197');
INSERT INTO `think_ticket` VALUES ('198', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '198');
INSERT INTO `think_ticket` VALUES ('199', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '199');
INSERT INTO `think_ticket` VALUES ('200', '0', '0', '', '', '', '0', '', '0', '', '', '', '398', '200');
INSERT INTO `think_ticket` VALUES ('1', '1', '1483840837', '127.0.0.1', '姓名', '1212', '2147483647', '121212', '0', '', '', '', '598', '201');
INSERT INTO `think_ticket` VALUES ('2', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '202');
INSERT INTO `think_ticket` VALUES ('3', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '203');
INSERT INTO `think_ticket` VALUES ('4', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '204');
INSERT INTO `think_ticket` VALUES ('5', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '205');
INSERT INTO `think_ticket` VALUES ('6', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '206');
INSERT INTO `think_ticket` VALUES ('7', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '207');
INSERT INTO `think_ticket` VALUES ('8', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '208');
INSERT INTO `think_ticket` VALUES ('9', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '209');
INSERT INTO `think_ticket` VALUES ('10', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '210');
INSERT INTO `think_ticket` VALUES ('11', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '211');
INSERT INTO `think_ticket` VALUES ('12', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '212');
INSERT INTO `think_ticket` VALUES ('13', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '213');
INSERT INTO `think_ticket` VALUES ('14', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '214');
INSERT INTO `think_ticket` VALUES ('15', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '215');
INSERT INTO `think_ticket` VALUES ('16', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '216');
INSERT INTO `think_ticket` VALUES ('17', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '217');
INSERT INTO `think_ticket` VALUES ('18', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '218');
INSERT INTO `think_ticket` VALUES ('19', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '219');
INSERT INTO `think_ticket` VALUES ('20', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '220');
INSERT INTO `think_ticket` VALUES ('21', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '221');
INSERT INTO `think_ticket` VALUES ('22', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '222');
INSERT INTO `think_ticket` VALUES ('23', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '223');
INSERT INTO `think_ticket` VALUES ('24', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '224');
INSERT INTO `think_ticket` VALUES ('25', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '225');
INSERT INTO `think_ticket` VALUES ('26', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '226');
INSERT INTO `think_ticket` VALUES ('27', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '227');
INSERT INTO `think_ticket` VALUES ('28', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '228');
INSERT INTO `think_ticket` VALUES ('29', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '229');
INSERT INTO `think_ticket` VALUES ('30', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '230');
INSERT INTO `think_ticket` VALUES ('31', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '231');
INSERT INTO `think_ticket` VALUES ('32', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '232');
INSERT INTO `think_ticket` VALUES ('33', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '233');
INSERT INTO `think_ticket` VALUES ('34', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '234');
INSERT INTO `think_ticket` VALUES ('35', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '235');
INSERT INTO `think_ticket` VALUES ('36', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '236');
INSERT INTO `think_ticket` VALUES ('37', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '237');
INSERT INTO `think_ticket` VALUES ('38', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '238');
INSERT INTO `think_ticket` VALUES ('39', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '239');
INSERT INTO `think_ticket` VALUES ('40', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '240');
INSERT INTO `think_ticket` VALUES ('41', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '241');
INSERT INTO `think_ticket` VALUES ('42', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '242');
INSERT INTO `think_ticket` VALUES ('43', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '243');
INSERT INTO `think_ticket` VALUES ('44', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '244');
INSERT INTO `think_ticket` VALUES ('45', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '245');
INSERT INTO `think_ticket` VALUES ('46', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '246');
INSERT INTO `think_ticket` VALUES ('47', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '247');
INSERT INTO `think_ticket` VALUES ('48', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '248');
INSERT INTO `think_ticket` VALUES ('49', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '249');
INSERT INTO `think_ticket` VALUES ('50', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '250');
INSERT INTO `think_ticket` VALUES ('51', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '251');
INSERT INTO `think_ticket` VALUES ('52', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '252');
INSERT INTO `think_ticket` VALUES ('53', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '253');
INSERT INTO `think_ticket` VALUES ('54', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '254');
INSERT INTO `think_ticket` VALUES ('55', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '255');
INSERT INTO `think_ticket` VALUES ('56', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '256');
INSERT INTO `think_ticket` VALUES ('57', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '257');
INSERT INTO `think_ticket` VALUES ('58', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '258');
INSERT INTO `think_ticket` VALUES ('59', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '259');
INSERT INTO `think_ticket` VALUES ('60', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '260');
INSERT INTO `think_ticket` VALUES ('61', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '261');
INSERT INTO `think_ticket` VALUES ('62', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '262');
INSERT INTO `think_ticket` VALUES ('63', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '263');
INSERT INTO `think_ticket` VALUES ('64', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '264');
INSERT INTO `think_ticket` VALUES ('65', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '265');
INSERT INTO `think_ticket` VALUES ('66', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '266');
INSERT INTO `think_ticket` VALUES ('67', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '267');
INSERT INTO `think_ticket` VALUES ('68', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '268');
INSERT INTO `think_ticket` VALUES ('69', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '269');
INSERT INTO `think_ticket` VALUES ('70', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '270');
INSERT INTO `think_ticket` VALUES ('71', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '271');
INSERT INTO `think_ticket` VALUES ('72', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '272');
INSERT INTO `think_ticket` VALUES ('73', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '273');
INSERT INTO `think_ticket` VALUES ('74', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '274');
INSERT INTO `think_ticket` VALUES ('75', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '275');
INSERT INTO `think_ticket` VALUES ('76', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '276');
INSERT INTO `think_ticket` VALUES ('77', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '277');
INSERT INTO `think_ticket` VALUES ('78', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '278');
INSERT INTO `think_ticket` VALUES ('79', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '279');
INSERT INTO `think_ticket` VALUES ('80', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '280');
INSERT INTO `think_ticket` VALUES ('81', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '281');
INSERT INTO `think_ticket` VALUES ('82', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '282');
INSERT INTO `think_ticket` VALUES ('83', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '283');
INSERT INTO `think_ticket` VALUES ('84', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '284');
INSERT INTO `think_ticket` VALUES ('85', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '285');
INSERT INTO `think_ticket` VALUES ('86', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '286');
INSERT INTO `think_ticket` VALUES ('87', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '287');
INSERT INTO `think_ticket` VALUES ('88', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '288');
INSERT INTO `think_ticket` VALUES ('89', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '289');
INSERT INTO `think_ticket` VALUES ('90', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '290');
INSERT INTO `think_ticket` VALUES ('91', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '291');
INSERT INTO `think_ticket` VALUES ('92', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '292');
INSERT INTO `think_ticket` VALUES ('93', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '293');
INSERT INTO `think_ticket` VALUES ('94', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '294');
INSERT INTO `think_ticket` VALUES ('95', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '295');
INSERT INTO `think_ticket` VALUES ('96', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '296');
INSERT INTO `think_ticket` VALUES ('97', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '297');
INSERT INTO `think_ticket` VALUES ('98', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '298');
INSERT INTO `think_ticket` VALUES ('99', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '299');
INSERT INTO `think_ticket` VALUES ('100', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '300');
INSERT INTO `think_ticket` VALUES ('101', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '301');
INSERT INTO `think_ticket` VALUES ('102', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '302');
INSERT INTO `think_ticket` VALUES ('103', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '303');
INSERT INTO `think_ticket` VALUES ('104', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '304');
INSERT INTO `think_ticket` VALUES ('105', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '305');
INSERT INTO `think_ticket` VALUES ('106', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '306');
INSERT INTO `think_ticket` VALUES ('107', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '307');
INSERT INTO `think_ticket` VALUES ('108', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '308');
INSERT INTO `think_ticket` VALUES ('109', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '309');
INSERT INTO `think_ticket` VALUES ('110', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '310');
INSERT INTO `think_ticket` VALUES ('111', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '311');
INSERT INTO `think_ticket` VALUES ('112', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '312');
INSERT INTO `think_ticket` VALUES ('113', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '313');
INSERT INTO `think_ticket` VALUES ('114', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '314');
INSERT INTO `think_ticket` VALUES ('115', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '315');
INSERT INTO `think_ticket` VALUES ('116', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '316');
INSERT INTO `think_ticket` VALUES ('117', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '317');
INSERT INTO `think_ticket` VALUES ('118', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '318');
INSERT INTO `think_ticket` VALUES ('119', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '319');
INSERT INTO `think_ticket` VALUES ('120', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '320');
INSERT INTO `think_ticket` VALUES ('121', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '321');
INSERT INTO `think_ticket` VALUES ('122', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '322');
INSERT INTO `think_ticket` VALUES ('123', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '323');
INSERT INTO `think_ticket` VALUES ('124', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '324');
INSERT INTO `think_ticket` VALUES ('125', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '325');
INSERT INTO `think_ticket` VALUES ('126', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '326');
INSERT INTO `think_ticket` VALUES ('127', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '327');
INSERT INTO `think_ticket` VALUES ('128', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '328');
INSERT INTO `think_ticket` VALUES ('129', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '329');
INSERT INTO `think_ticket` VALUES ('130', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '330');
INSERT INTO `think_ticket` VALUES ('131', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '331');
INSERT INTO `think_ticket` VALUES ('132', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '332');
INSERT INTO `think_ticket` VALUES ('133', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '333');
INSERT INTO `think_ticket` VALUES ('134', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '334');
INSERT INTO `think_ticket` VALUES ('135', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '335');
INSERT INTO `think_ticket` VALUES ('136', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '336');
INSERT INTO `think_ticket` VALUES ('137', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '337');
INSERT INTO `think_ticket` VALUES ('138', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '338');
INSERT INTO `think_ticket` VALUES ('139', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '339');
INSERT INTO `think_ticket` VALUES ('140', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '340');
INSERT INTO `think_ticket` VALUES ('141', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '341');
INSERT INTO `think_ticket` VALUES ('142', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '342');
INSERT INTO `think_ticket` VALUES ('143', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '343');
INSERT INTO `think_ticket` VALUES ('144', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '344');
INSERT INTO `think_ticket` VALUES ('145', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '345');
INSERT INTO `think_ticket` VALUES ('146', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '346');
INSERT INTO `think_ticket` VALUES ('147', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '347');
INSERT INTO `think_ticket` VALUES ('148', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '348');
INSERT INTO `think_ticket` VALUES ('149', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '349');
INSERT INTO `think_ticket` VALUES ('150', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '350');
INSERT INTO `think_ticket` VALUES ('151', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '351');
INSERT INTO `think_ticket` VALUES ('152', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '352');
INSERT INTO `think_ticket` VALUES ('153', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '353');
INSERT INTO `think_ticket` VALUES ('154', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '354');
INSERT INTO `think_ticket` VALUES ('155', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '355');
INSERT INTO `think_ticket` VALUES ('156', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '356');
INSERT INTO `think_ticket` VALUES ('157', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '357');
INSERT INTO `think_ticket` VALUES ('158', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '358');
INSERT INTO `think_ticket` VALUES ('159', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '359');
INSERT INTO `think_ticket` VALUES ('160', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '360');
INSERT INTO `think_ticket` VALUES ('161', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '361');
INSERT INTO `think_ticket` VALUES ('162', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '362');
INSERT INTO `think_ticket` VALUES ('163', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '363');
INSERT INTO `think_ticket` VALUES ('164', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '364');
INSERT INTO `think_ticket` VALUES ('165', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '365');
INSERT INTO `think_ticket` VALUES ('166', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '366');
INSERT INTO `think_ticket` VALUES ('167', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '367');
INSERT INTO `think_ticket` VALUES ('168', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '368');
INSERT INTO `think_ticket` VALUES ('169', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '369');
INSERT INTO `think_ticket` VALUES ('170', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '370');
INSERT INTO `think_ticket` VALUES ('171', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '371');
INSERT INTO `think_ticket` VALUES ('172', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '372');
INSERT INTO `think_ticket` VALUES ('173', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '373');
INSERT INTO `think_ticket` VALUES ('174', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '374');
INSERT INTO `think_ticket` VALUES ('175', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '375');
INSERT INTO `think_ticket` VALUES ('176', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '376');
INSERT INTO `think_ticket` VALUES ('177', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '377');
INSERT INTO `think_ticket` VALUES ('178', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '378');
INSERT INTO `think_ticket` VALUES ('179', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '379');
INSERT INTO `think_ticket` VALUES ('180', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '380');
INSERT INTO `think_ticket` VALUES ('181', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '381');
INSERT INTO `think_ticket` VALUES ('182', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '382');
INSERT INTO `think_ticket` VALUES ('183', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '383');
INSERT INTO `think_ticket` VALUES ('184', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '384');
INSERT INTO `think_ticket` VALUES ('185', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '385');
INSERT INTO `think_ticket` VALUES ('186', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '386');
INSERT INTO `think_ticket` VALUES ('187', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '387');
INSERT INTO `think_ticket` VALUES ('188', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '388');
INSERT INTO `think_ticket` VALUES ('189', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '389');
INSERT INTO `think_ticket` VALUES ('190', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '390');
INSERT INTO `think_ticket` VALUES ('191', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '391');
INSERT INTO `think_ticket` VALUES ('192', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '392');
INSERT INTO `think_ticket` VALUES ('193', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '393');
INSERT INTO `think_ticket` VALUES ('194', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '394');
INSERT INTO `think_ticket` VALUES ('195', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '395');
INSERT INTO `think_ticket` VALUES ('196', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '396');
INSERT INTO `think_ticket` VALUES ('197', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '397');
INSERT INTO `think_ticket` VALUES ('198', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '398');
INSERT INTO `think_ticket` VALUES ('199', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '399');
INSERT INTO `think_ticket` VALUES ('200', '0', '0', '', '', '', '0', '', '0', '', '', '', '598', '400');
INSERT INTO `think_ticket` VALUES ('1', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '401');
INSERT INTO `think_ticket` VALUES ('2', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '402');
INSERT INTO `think_ticket` VALUES ('3', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '403');
INSERT INTO `think_ticket` VALUES ('4', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '404');
INSERT INTO `think_ticket` VALUES ('5', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '405');
INSERT INTO `think_ticket` VALUES ('6', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '406');
INSERT INTO `think_ticket` VALUES ('7', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '407');
INSERT INTO `think_ticket` VALUES ('8', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '408');
INSERT INTO `think_ticket` VALUES ('9', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '409');
INSERT INTO `think_ticket` VALUES ('10', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '410');
INSERT INTO `think_ticket` VALUES ('11', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '411');
INSERT INTO `think_ticket` VALUES ('12', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '412');
INSERT INTO `think_ticket` VALUES ('13', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '413');
INSERT INTO `think_ticket` VALUES ('14', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '414');
INSERT INTO `think_ticket` VALUES ('15', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '415');
INSERT INTO `think_ticket` VALUES ('16', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '416');
INSERT INTO `think_ticket` VALUES ('17', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '417');
INSERT INTO `think_ticket` VALUES ('18', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '418');
INSERT INTO `think_ticket` VALUES ('19', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '419');
INSERT INTO `think_ticket` VALUES ('20', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '420');
INSERT INTO `think_ticket` VALUES ('21', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '421');
INSERT INTO `think_ticket` VALUES ('22', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '422');
INSERT INTO `think_ticket` VALUES ('23', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '423');
INSERT INTO `think_ticket` VALUES ('24', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '424');
INSERT INTO `think_ticket` VALUES ('25', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '425');
INSERT INTO `think_ticket` VALUES ('26', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '426');
INSERT INTO `think_ticket` VALUES ('27', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '427');
INSERT INTO `think_ticket` VALUES ('28', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '428');
INSERT INTO `think_ticket` VALUES ('29', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '429');
INSERT INTO `think_ticket` VALUES ('30', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '430');
INSERT INTO `think_ticket` VALUES ('31', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '431');
INSERT INTO `think_ticket` VALUES ('32', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '432');
INSERT INTO `think_ticket` VALUES ('33', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '433');
INSERT INTO `think_ticket` VALUES ('34', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '434');
INSERT INTO `think_ticket` VALUES ('35', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '435');
INSERT INTO `think_ticket` VALUES ('36', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '436');
INSERT INTO `think_ticket` VALUES ('37', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '437');
INSERT INTO `think_ticket` VALUES ('38', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '438');
INSERT INTO `think_ticket` VALUES ('39', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '439');
INSERT INTO `think_ticket` VALUES ('40', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '440');
INSERT INTO `think_ticket` VALUES ('41', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '441');
INSERT INTO `think_ticket` VALUES ('42', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '442');
INSERT INTO `think_ticket` VALUES ('43', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '443');
INSERT INTO `think_ticket` VALUES ('44', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '444');
INSERT INTO `think_ticket` VALUES ('45', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '445');
INSERT INTO `think_ticket` VALUES ('46', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '446');
INSERT INTO `think_ticket` VALUES ('47', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '447');
INSERT INTO `think_ticket` VALUES ('48', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '448');
INSERT INTO `think_ticket` VALUES ('49', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '449');
INSERT INTO `think_ticket` VALUES ('50', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '450');
INSERT INTO `think_ticket` VALUES ('51', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '451');
INSERT INTO `think_ticket` VALUES ('52', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '452');
INSERT INTO `think_ticket` VALUES ('53', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '453');
INSERT INTO `think_ticket` VALUES ('54', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '454');
INSERT INTO `think_ticket` VALUES ('55', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '455');
INSERT INTO `think_ticket` VALUES ('56', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '456');
INSERT INTO `think_ticket` VALUES ('57', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '457');
INSERT INTO `think_ticket` VALUES ('58', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '458');
INSERT INTO `think_ticket` VALUES ('59', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '459');
INSERT INTO `think_ticket` VALUES ('60', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '460');
INSERT INTO `think_ticket` VALUES ('61', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '461');
INSERT INTO `think_ticket` VALUES ('62', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '462');
INSERT INTO `think_ticket` VALUES ('63', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '463');
INSERT INTO `think_ticket` VALUES ('64', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '464');
INSERT INTO `think_ticket` VALUES ('65', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '465');
INSERT INTO `think_ticket` VALUES ('66', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '466');
INSERT INTO `think_ticket` VALUES ('67', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '467');
INSERT INTO `think_ticket` VALUES ('68', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '468');
INSERT INTO `think_ticket` VALUES ('69', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '469');
INSERT INTO `think_ticket` VALUES ('70', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '470');
INSERT INTO `think_ticket` VALUES ('71', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '471');
INSERT INTO `think_ticket` VALUES ('72', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '472');
INSERT INTO `think_ticket` VALUES ('73', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '473');
INSERT INTO `think_ticket` VALUES ('74', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '474');
INSERT INTO `think_ticket` VALUES ('75', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '475');
INSERT INTO `think_ticket` VALUES ('76', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '476');
INSERT INTO `think_ticket` VALUES ('77', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '477');
INSERT INTO `think_ticket` VALUES ('78', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '478');
INSERT INTO `think_ticket` VALUES ('79', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '479');
INSERT INTO `think_ticket` VALUES ('80', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '480');
INSERT INTO `think_ticket` VALUES ('81', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '481');
INSERT INTO `think_ticket` VALUES ('82', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '482');
INSERT INTO `think_ticket` VALUES ('83', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '483');
INSERT INTO `think_ticket` VALUES ('84', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '484');
INSERT INTO `think_ticket` VALUES ('85', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '485');
INSERT INTO `think_ticket` VALUES ('86', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '486');
INSERT INTO `think_ticket` VALUES ('87', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '487');
INSERT INTO `think_ticket` VALUES ('88', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '488');
INSERT INTO `think_ticket` VALUES ('89', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '489');
INSERT INTO `think_ticket` VALUES ('90', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '490');
INSERT INTO `think_ticket` VALUES ('91', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '491');
INSERT INTO `think_ticket` VALUES ('92', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '492');
INSERT INTO `think_ticket` VALUES ('93', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '493');
INSERT INTO `think_ticket` VALUES ('94', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '494');
INSERT INTO `think_ticket` VALUES ('95', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '495');
INSERT INTO `think_ticket` VALUES ('96', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '496');
INSERT INTO `think_ticket` VALUES ('97', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '497');
INSERT INTO `think_ticket` VALUES ('98', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '498');
INSERT INTO `think_ticket` VALUES ('99', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '499');
INSERT INTO `think_ticket` VALUES ('100', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '500');
INSERT INTO `think_ticket` VALUES ('101', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '501');
INSERT INTO `think_ticket` VALUES ('102', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '502');
INSERT INTO `think_ticket` VALUES ('103', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '503');
INSERT INTO `think_ticket` VALUES ('104', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '504');
INSERT INTO `think_ticket` VALUES ('105', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '505');
INSERT INTO `think_ticket` VALUES ('106', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '506');
INSERT INTO `think_ticket` VALUES ('107', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '507');
INSERT INTO `think_ticket` VALUES ('108', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '508');
INSERT INTO `think_ticket` VALUES ('109', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '509');
INSERT INTO `think_ticket` VALUES ('110', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '510');
INSERT INTO `think_ticket` VALUES ('111', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '511');
INSERT INTO `think_ticket` VALUES ('112', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '512');
INSERT INTO `think_ticket` VALUES ('113', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '513');
INSERT INTO `think_ticket` VALUES ('114', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '514');
INSERT INTO `think_ticket` VALUES ('115', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '515');
INSERT INTO `think_ticket` VALUES ('116', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '516');
INSERT INTO `think_ticket` VALUES ('117', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '517');
INSERT INTO `think_ticket` VALUES ('118', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '518');
INSERT INTO `think_ticket` VALUES ('119', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '519');
INSERT INTO `think_ticket` VALUES ('120', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '520');
INSERT INTO `think_ticket` VALUES ('121', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '521');
INSERT INTO `think_ticket` VALUES ('122', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '522');
INSERT INTO `think_ticket` VALUES ('123', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '523');
INSERT INTO `think_ticket` VALUES ('124', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '524');
INSERT INTO `think_ticket` VALUES ('125', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '525');
INSERT INTO `think_ticket` VALUES ('126', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '526');
INSERT INTO `think_ticket` VALUES ('127', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '527');
INSERT INTO `think_ticket` VALUES ('128', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '528');
INSERT INTO `think_ticket` VALUES ('129', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '529');
INSERT INTO `think_ticket` VALUES ('130', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '530');
INSERT INTO `think_ticket` VALUES ('131', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '531');
INSERT INTO `think_ticket` VALUES ('132', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '532');
INSERT INTO `think_ticket` VALUES ('133', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '533');
INSERT INTO `think_ticket` VALUES ('134', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '534');
INSERT INTO `think_ticket` VALUES ('135', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '535');
INSERT INTO `think_ticket` VALUES ('136', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '536');
INSERT INTO `think_ticket` VALUES ('137', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '537');
INSERT INTO `think_ticket` VALUES ('138', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '538');
INSERT INTO `think_ticket` VALUES ('139', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '539');
INSERT INTO `think_ticket` VALUES ('140', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '540');
INSERT INTO `think_ticket` VALUES ('141', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '541');
INSERT INTO `think_ticket` VALUES ('142', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '542');
INSERT INTO `think_ticket` VALUES ('143', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '543');
INSERT INTO `think_ticket` VALUES ('144', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '544');
INSERT INTO `think_ticket` VALUES ('145', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '545');
INSERT INTO `think_ticket` VALUES ('146', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '546');
INSERT INTO `think_ticket` VALUES ('147', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '547');
INSERT INTO `think_ticket` VALUES ('148', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '548');
INSERT INTO `think_ticket` VALUES ('149', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '549');
INSERT INTO `think_ticket` VALUES ('150', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '550');
INSERT INTO `think_ticket` VALUES ('151', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '551');
INSERT INTO `think_ticket` VALUES ('152', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '552');
INSERT INTO `think_ticket` VALUES ('153', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '553');
INSERT INTO `think_ticket` VALUES ('154', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '554');
INSERT INTO `think_ticket` VALUES ('155', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '555');
INSERT INTO `think_ticket` VALUES ('156', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '556');
INSERT INTO `think_ticket` VALUES ('157', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '557');
INSERT INTO `think_ticket` VALUES ('158', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '558');
INSERT INTO `think_ticket` VALUES ('159', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '559');
INSERT INTO `think_ticket` VALUES ('160', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '560');
INSERT INTO `think_ticket` VALUES ('161', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '561');
INSERT INTO `think_ticket` VALUES ('162', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '562');
INSERT INTO `think_ticket` VALUES ('163', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '563');
INSERT INTO `think_ticket` VALUES ('164', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '564');
INSERT INTO `think_ticket` VALUES ('165', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '565');
INSERT INTO `think_ticket` VALUES ('166', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '566');
INSERT INTO `think_ticket` VALUES ('167', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '567');
INSERT INTO `think_ticket` VALUES ('168', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '568');
INSERT INTO `think_ticket` VALUES ('169', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '569');
INSERT INTO `think_ticket` VALUES ('170', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '570');
INSERT INTO `think_ticket` VALUES ('171', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '571');
INSERT INTO `think_ticket` VALUES ('172', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '572');
INSERT INTO `think_ticket` VALUES ('173', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '573');
INSERT INTO `think_ticket` VALUES ('174', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '574');
INSERT INTO `think_ticket` VALUES ('175', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '575');
INSERT INTO `think_ticket` VALUES ('176', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '576');
INSERT INTO `think_ticket` VALUES ('177', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '577');
INSERT INTO `think_ticket` VALUES ('178', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '578');
INSERT INTO `think_ticket` VALUES ('179', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '579');
INSERT INTO `think_ticket` VALUES ('180', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '580');
INSERT INTO `think_ticket` VALUES ('181', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '581');
INSERT INTO `think_ticket` VALUES ('182', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '582');
INSERT INTO `think_ticket` VALUES ('183', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '583');
INSERT INTO `think_ticket` VALUES ('184', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '584');
INSERT INTO `think_ticket` VALUES ('185', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '585');
INSERT INTO `think_ticket` VALUES ('186', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '586');
INSERT INTO `think_ticket` VALUES ('187', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '587');
INSERT INTO `think_ticket` VALUES ('188', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '588');
INSERT INTO `think_ticket` VALUES ('189', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '589');
INSERT INTO `think_ticket` VALUES ('190', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '590');
INSERT INTO `think_ticket` VALUES ('191', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '591');
INSERT INTO `think_ticket` VALUES ('192', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '592');
INSERT INTO `think_ticket` VALUES ('193', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '593');
INSERT INTO `think_ticket` VALUES ('194', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '594');
INSERT INTO `think_ticket` VALUES ('195', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '595');
INSERT INTO `think_ticket` VALUES ('196', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '596');
INSERT INTO `think_ticket` VALUES ('197', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '597');
INSERT INTO `think_ticket` VALUES ('198', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '598');
INSERT INTO `think_ticket` VALUES ('199', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '599');
INSERT INTO `think_ticket` VALUES ('200', '0', '0', '', '', '', '0', '', '0', '', '', '', '888', '600');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_user
-- ----------------------------
INSERT INTO `think_user` VALUES ('1', 'wudan', '883327915c4022331b5abcb9da2a390c', '1471740719', '123.23', '0', '');
INSERT INTO `think_user` VALUES ('2', 'admin', '883327915c4022331b5abcb9da2a390c', '1471740719', '121', '0', '');
INSERT INTO `think_user` VALUES ('3', '34545', 'd41d8cd98f00b204e9800998ecf8427e', '1471740719', '12', '0', '');
INSERT INTO `think_user` VALUES ('4', 'w1212', 'c20ad4d76fe97759aa27a0c99bff6710', '1471740719', '1433', '0', '');
INSERT INTO `think_user` VALUES ('5', 'lvwei', '883327915c4022331b5abcb9da2a390c', '0', '', '0', '');

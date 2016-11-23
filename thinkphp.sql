/*
Navicat MySQL Data Transfer

Source Server         : wwewe
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : thinkphp

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-11-23 17:55:12
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
INSERT INTO `think_flow_execution` VALUES ('101', 'state1', 'test2', '1', '', 'test2.101', 'active-root', '0', '102', '0', '0', '101');
INSERT INTO `think_flow_execution` VALUES ('201', 'task1', 'test2', '1', '', 'test2.201', 'active-root', '0', '206', '0', '0', '201');
INSERT INTO `think_flow_execution` VALUES ('301', '', 'test2', '1', '', 'test2.301', 'inactive-concurrent-root', '0', '0', '0', '0', '301');
INSERT INTO `think_flow_execution` VALUES ('302', 'state1', 'test2', '1', '', 'test2.301.to state1.302', 'active-concurrent', '0', '307', '301', '0', '302');
INSERT INTO `think_flow_execution` VALUES ('303', 'task1', 'test2', '1', '', 'test2.301.to task1.303', 'active-concurrent', '0', '308', '301', '0', '303');
INSERT INTO `think_flow_execution` VALUES ('401', 'task1', 'test2', '1', '', 'test2.401', 'active-root', '0', '405', '0', '0', '401');
INSERT INTO `think_flow_execution` VALUES ('501', '', 'fork', '1', '', 'fork.501', 'inactive-concurrent-root', '0', '0', '0', '0', '501');
INSERT INTO `think_flow_execution` VALUES ('502', 'state1', 'fork', '1', '', 'fork.501.to state1.502', 'active-concurrent', '0', '507', '501', '0', '501');
INSERT INTO `think_flow_execution` VALUES ('503', 'task1', 'fork', '1', '', 'fork.501.to task1.503', 'active-concurrent', '0', '508', '501', '0', '501');
INSERT INTO `think_flow_execution` VALUES ('601', 'state1', 'test1', '1', '', 'test1.601', 'active-root', '0', '602', '0', '0', '601');

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
INSERT INTO `think_flow_histactinst` VALUES ('102', '101', 'state', '101', 'state1', '1479695941', '0', '0', '', '0');
INSERT INTO `think_flow_histactinst` VALUES ('205', '201', 'decision', '201', 'exclusive1', '1479697004', '1479697004', '0', 'to task1', '0');
INSERT INTO `think_flow_histactinst` VALUES ('206', '201', 'task', '201', 'task1', '1479697004', '0', '0', '', '202');
INSERT INTO `think_flow_histactinst` VALUES ('307', '303', 'state', '302', 'state1', '1479697653', '0', '0', '', '0');
INSERT INTO `think_flow_histactinst` VALUES ('308', '303', 'task', '303', 'task1', '1479697653', '0', '0', '', '304');
INSERT INTO `think_flow_histactinst` VALUES ('405', '401', 'task', '401', 'task1', '1479698009', '0', '0', '', '402');
INSERT INTO `think_flow_histactinst` VALUES ('507', '501', 'state', '502', 'state1', '1479780260', '0', '0', '', '0');
INSERT INTO `think_flow_histactinst` VALUES ('508', '501', 'task', '503', 'task1', '1479780260', '0', '0', '', '504');
INSERT INTO `think_flow_histactinst` VALUES ('602', '601', 'state', '601', 'state1', '1479866569', '0', '0', '', '0');

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
INSERT INTO `think_flow_histprocinst` VALUES ('101', 'test2.101', 'test2', '', '1479695941', '0', '0', 'active', '');
INSERT INTO `think_flow_histprocinst` VALUES ('201', 'test2.201', 'test2', '', '1479697004', '0', '0', 'active', '');
INSERT INTO `think_flow_histprocinst` VALUES ('301', 'test2.301', 'test2', '', '1479697653', '0', '0', 'active', '');
INSERT INTO `think_flow_histprocinst` VALUES ('401', 'test2.401', 'test2', '', '1479698009', '0', '0', 'active', '');
INSERT INTO `think_flow_histprocinst` VALUES ('501', 'fork.501', 'fork', '', '1479780260', '0', '0', 'active', '');
INSERT INTO `think_flow_histprocinst` VALUES ('601', 'test1.601', 'test1', '', '1479866569', '0', '0', 'active', '');

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
  PRIMARY KEY (`dbid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_flow_histtask
-- ----------------------------
INSERT INTO `think_flow_histtask` VALUES ('202', 'test2.201', '', '', '0', '', '1479697004', '0', '0');
INSERT INTO `think_flow_histtask` VALUES ('304', 'test2.301.to task1.303', '', '', '0', '', '1479697653', '0', '0');
INSERT INTO `think_flow_histtask` VALUES ('402', 'test2.401', '', '', '0', '', '1479698009', '0', '0');
INSERT INTO `think_flow_histtask` VALUES ('504', 'fork.501.to task1.503', '', '', '0', 'open', '1479780260', '0', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_flow_modulerule
-- ----------------------------
INSERT INTO `think_flow_modulerule` VALUES ('1', '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n\r\n<process name=\"demo\" xmlns=\"http://jbpm.org/4.4/jpdl\">\r\n   <start name=\"start1\" g=\"158,62,48,48\">\r\n      <transition name=\"to 审批\" to=\"审批\" g=\"-45,-22\"/>\r\n   </start>\r\n   <end name=\"end1\" g=\"169,281,48,48\"/>\r\n   <state name=\"审批\" g=\"151,174,92,52\">\r\n      <transition name=\"to end1\" to=\"end1\" g=\"-50,-22\"/>\r\n   </state>\r\n</process>', 'demo', '0', '0');
INSERT INTO `think_flow_modulerule` VALUES ('2', '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n\r\n<process name=\"qingjia2\" xmlns=\"http://jbpm.org/4.4/jpdl\">\r\n   <start name=\"start1\" g=\"130,19,48,48\">\r\n      <transition name=\"to exclusive1\" to=\"exclusive1\" g=\"-56,-22\"/>\r\n   </start>\r\n   <state name=\"填写请假单\" g=\"108,82,92,52\">\r\n      <transition name=\"to exclusive1\" to=\"exclusive1\" g=\"-79,-22\"/>\r\n   </state>\r\n   <state name=\"经理审批\" g=\"60,208,92,52\">\r\n      <transition name=\"to end1\" to=\"end1\" g=\"-50,-22\"/>\r\n   </state>\r\n   <state name=\"老板审批\" g=\"199,206,92,52\">\r\n      <transition name=\"to end1\" to=\"end1\" g=\"-50,-22\"/>\r\n   </state>\r\n   <end name=\"end1\" g=\"126,312,48,48\"/>\r\n   <decision name=\"exclusive1\" g=\"138,146,48,48\">\r\n   <handler class=\"Org\\Jbmp\\TestHander\\testHander\" />\r\n      <transition name=\"to 经理审批\" to=\"经理审批\" g=\"-69,-22\"/>\r\n      <transition name=\"to 老板审批\" to=\"老板审批\" g=\"-69,-22\"/>\r\n   </decision>\r\n</process>', 'decision', '0', '0');
INSERT INTO `think_flow_modulerule` VALUES ('3', '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n\r\n<process name=\"task01\" xmlns=\"http://jbpm.org/4.4/jpdl\">\r\n   <start g=\"196,-13,48,48\" name=\"start1\">\r\n      <transition g=\"-52,-22\" name=\"to fork1\" to=\"fork1\"/>\r\n   </start>\r\n   <end g=\"280,342,48,48\" name=\"end1\"/>\r\n   <fork g=\"228,100,48,48\" name=\"fork1\">\r\n      <transition g=\"-56,-22\" name=\"to state1\" to=\"state1\"/>\r\n      <transition g=\"-52,-22\" name=\"to task1\" to=\"task1\"/>\r\n   </fork>\r\n   <join g=\"268,265,48,48\" multiplicity=\"1\" name=\"join1\">\r\n      <transition g=\"-50,-22\" name=\"to end1\" to=\"end1\"/>\r\n   </join>\r\n   <state g=\"128,164,92,52\" name=\"state1\">\r\n      <transition g=\"-49,-22\" name=\"to join1\" to=\"join1\"/>\r\n   </state>\r\n   <task g=\"334,173,92,52\" name=\"task1\" candidate-users=\"user1,user2\">\r\n      <transition g=\"-49,-22\" name=\"to join1\" to=\"join1\"/>\r\n   </task>\r\n</process>', 'fork', '0', '0');
INSERT INTO `think_flow_modulerule` VALUES ('4', '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n\r\n<process name=\"task01\" xmlns=\"http://jbpm.org/4.4/jpdl\">\r\n   <start g=\"196,-13,48,48\" name=\"start1\">\r\n      <transition name=\"to state1\" to=\"state1\" g=\"-56,-22\"/>\r\n   </start>\r\n   <end g=\"280,342,48,48\" name=\"end1\"/>\r\n   <state name=\"state1\" g=\"177,143,92,52\">\r\n      <transition name=\"to state2\" to=\"state2\" g=\"-56,-22\"/>\r\n   </state>\r\n   <state name=\"state2\" g=\"219,241,92,52\">\r\n      <transition name=\"to end1\" to=\"end1\" g=\"-50,-22\"/>\r\n   </state>\r\n</process>', 'test1', '0', '0');
INSERT INTO `think_flow_modulerule` VALUES ('5', '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n\r\n<process name=\"task01\" xmlns=\"http://jbpm.org/4.4/jpdl\">\r\n   <start g=\"291,2,48,48\" name=\"start1\">\r\n      <transition g=\"-52,-22\" name=\"to task1\" to=\"task1\"/>\r\n   </start>\r\n   <end g=\"254,299,48,48\" name=\"end1\"/>\r\n   <task candidate-groups=\"team1,team2\" g=\"237,82,92,52\" name=\"task1\">\r\n      <transition name=\"to fork1\" to=\"fork1\" g=\"-52,-22\"/>\r\n   </task>\r\n   <fork name=\"fork1\" g=\"264,161,48,48\">\r\n      <transition name=\"to state1\" to=\"state1\" g=\"-56,-22\"/>\r\n      <transition name=\"to task2\" to=\"task2\" g=\"-52,-22\"/>\r\n   </fork>\r\n   <state name=\"state1\" g=\"177,233,92,52\">\r\n      <transition name=\"to end1\" to=\"end1\" g=\"-50,-22\"/>\r\n   </state>\r\n   <task name=\"task2\" g=\"335,253,92,52\" candidate-groups=\"team1,team2\">\r\n      <transition name=\"to end1\" to=\"end1\" g=\"-50,-22\"/>\r\n   </task>\r\n</process>', 'test2', '0', '0');
INSERT INTO `think_flow_modulerule` VALUES ('6', '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n\r\n<process name=\"task01\" xmlns=\"http://jbpm.org/4.4/jpdl\">\r\n   <start name=\"start1\" g=\"296,34,48,48\">\r\n      <transition name=\"to state1\" to=\"state1\" g=\"-56,-22\"/>\r\n   </start>\r\n   <state name=\"state1\" g=\"287,115,92,52\">\r\n      <transition name=\"to state2\" to=\"state2\" g=\"-56,-22\"/>\r\n   </state>\r\n   <state name=\"state2\" g=\"290,201,92,52\">\r\n      <transition name=\"to end1\" to=\"end1\" g=\"-50,-22\"/>\r\n   </state>\r\n   <end name=\"end1\" g=\"344,302,48,48\"/>\r\n</process>', 'test', '0', '0');

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
  KEY `FK_PART_TASK` (`task`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_flow_participation
-- ----------------------------
INSERT INTO `think_flow_participation` VALUES ('203', 'team1', '0', 'candidate', '202');
INSERT INTO `think_flow_participation` VALUES ('204', 'team2', '0', 'candidate', '202');
INSERT INTO `think_flow_participation` VALUES ('305', 'user1', '0', 'candidate', '304');
INSERT INTO `think_flow_participation` VALUES ('306', 'user2', '0', 'candidate', '304');
INSERT INTO `think_flow_participation` VALUES ('403', 'team1', '0', 'candidate', '402');
INSERT INTO `think_flow_participation` VALUES ('404', 'team2', '0', 'candidate', '402');
INSERT INTO `think_flow_participation` VALUES ('505', 'user1', '0', 'candidate', '504');
INSERT INTO `think_flow_participation` VALUES ('506', 'user2', '0', 'candidate', '504');

-- ----------------------------
-- Table structure for `think_flow_property`
-- ----------------------------
DROP TABLE IF EXISTS `think_flow_property`;
CREATE TABLE `think_flow_property` (
  `key` varchar(255) NOT NULL,
  `version` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_flow_property
-- ----------------------------
INSERT INTO `think_flow_property` VALUES ('next.dbid', '7', '601');

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
  PRIMARY KEY (`dbid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_flow_task
-- ----------------------------
INSERT INTO `think_flow_task` VALUES ('202', 'task1', 'open', '', '0', '1479697004', 'test2.201', 'task1', '1', '201', '201');
INSERT INTO `think_flow_task` VALUES ('304', 'task1', 'open', '', '0', '1479697653', 'test2.301.to task1.303', 'task1', '1', '303', '303');
INSERT INTO `think_flow_task` VALUES ('402', 'task1', 'open', '', '0', '1479698009', 'test2.401', 'task1', '1', '401', '401');
INSERT INTO `think_flow_task` VALUES ('504', 'task1', 'open', '', '0', '1479780260', 'fork.501.to task1.503', 'task1', '1', '503', '503');

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
  PRIMARY KEY (`dbid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_flow_variable
-- ----------------------------
INSERT INTO `think_flow_variable` VALUES ('103', 'string', 'username', '101', '0', '0', 'wudan0', '', '0');
INSERT INTO `think_flow_variable` VALUES ('104', 'string', 'username', '101', '0', '0', 'wudan1', '', '0');
INSERT INTO `think_flow_variable` VALUES ('207', 'string', 'username', '201', '0', '0', 'wudan0', '', '0');
INSERT INTO `think_flow_variable` VALUES ('208', 'string', 'username', '201', '0', '0', 'wudan1', '', '0');
INSERT INTO `think_flow_variable` VALUES ('309', 'string', 'username', '303', '0', '0', 'wudan0', '', '0');
INSERT INTO `think_flow_variable` VALUES ('310', 'string', 'username', '303', '0', '0', 'wudan1', '', '0');
INSERT INTO `think_flow_variable` VALUES ('406', 'string', 'username', '401', '0', '0', 'wudan0', '', '0');
INSERT INTO `think_flow_variable` VALUES ('407', 'string', 'username', '401', '0', '0', 'wudan1', '', '0');
INSERT INTO `think_flow_variable` VALUES ('509', 'string', 'username', '501', '0', '0', 'wudan0', '', '0');
INSERT INTO `think_flow_variable` VALUES ('510', 'string', 'username', '501', '0', '0', 'wudan1', '', '0');
INSERT INTO `think_flow_variable` VALUES ('603', 'string', 'username', '601', '0', '0', 'wudan0', '', '0');
INSERT INTO `think_flow_variable` VALUES ('604', 'string', 'username', '601', '0', '0', 'wudan1', '', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_node
-- ----------------------------
INSERT INTO `think_node` VALUES ('1', 'Admin', '后台管理', '1', '', '1', '0', '1', '');
INSERT INTO `think_node` VALUES ('2', 'rbac', '权限管理', '1', '', '2', '1', '2', '/Rbac/Rbac/actionOperationUser');
INSERT INTO `think_node` VALUES ('3', 'Ticket/AllocationTicket', '对卷管理', '1', '', '3', '1', '2', '/Ticket/AllocationTicket/actionViewTicket');
INSERT INTO `think_node` VALUES ('5', 'actionManageRole', '角色管理', '1', '', '0', '2', '3', '');
INSERT INTO `think_node` VALUES ('6', 'actionEditTicket', '显示卷号', '1', '', '0', '3', '3', '');
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
INSERT INTO `think_role` VALUES ('3', '678', '0', '0', '678');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_user
-- ----------------------------
INSERT INTO `think_user` VALUES ('1', 'wudan', '883327915c4022331b5abcb9da2a390c', '1471740719', '123.23', '0', '');
INSERT INTO `think_user` VALUES ('2', 'admin', '883327915c4022331b5abcb9da2a390c', '1471740719', '121', '0', '');
INSERT INTO `think_user` VALUES ('3', '34545', 'd41d8cd98f00b204e9800998ecf8427e', '1471740719', '12', '0', '');
INSERT INTO `think_user` VALUES ('4', 'w1212', 'c20ad4d76fe97759aa27a0c99bff6710', '1471740719', '1433', '0', '');

/*
Navicat MySQL Data Transfer

Source Server         : zcjc
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : zzb

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2016-08-04 00:40:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for adv
-- ----------------------------
DROP TABLE IF EXISTS `adv`;
CREATE TABLE `adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL DEFAULT '0' COMMENT '图片url',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '跳转链接url',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除，0默认，1删除',
  `register_date` int(11) NOT NULL DEFAULT '0' COMMENT '发布时间',
  `update_date` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of adv
-- ----------------------------
INSERT INTO `adv` VALUES ('1', '/Uploads/2015-12-01/565d4c4e45b35.jpg', 'www.baidu.com', '0', '1446768638', '0');
INSERT INTO `adv` VALUES ('2', '/Uploads/2015-12-01/565d4b870ad26.jpg', 'www.baidu.com', '0', '1446714968', '0');
INSERT INTO `adv` VALUES ('3', '/Uploads/2015-12-01/565d49e9d7435.jpg', 'www.baidu.com', '0', '1453686464', '0');

-- ----------------------------
-- Table structure for advert
-- ----------------------------
DROP TABLE IF EXISTS `advert`;
CREATE TABLE `advert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agent_id` int(10) NOT NULL DEFAULT '0' COMMENT '归属代理商ID',
  `name` varchar(200) NOT NULL DEFAULT '' COMMENT '赞助商',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '赞助商地址',
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '赞助商手机号',
  `coin` int(10) NOT NULL DEFAULT '0' COMMENT '赞助的能量币',
  `income` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '广告收入',
  `status` int(1) NOT NULL DEFAULT '1',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of advert
-- ----------------------------
INSERT INTO `advert` VALUES ('28', '24', '再次赞助代理商2', '啊啊啊', '122232423', '1000', '0.00', '1', '2016-07-22 12:53:51');
INSERT INTO `advert` VALUES ('29', '24', '啊啊啊啊', '三大大啊', '23434223', '100', '0.00', '1', '2016-07-22 12:53:48');
INSERT INTO `advert` VALUES ('30', '25', '赞助新代理', '哈哈哈哈', '432432323', '1100', '0.00', '1', '2016-07-22 12:53:45');
INSERT INTO `advert` VALUES ('31', '26', '3633', '新督路沒ㄌ', '1258963200', '520', '0.00', '1', '2016-07-22 12:53:41');
INSERT INTO `advert` VALUES ('34', '34', '张魁', '上海市', '11223213', '211', '100.00', '1', '2016-07-22 13:09:57');

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '文章标题',
  `content` text COMMENT '文章内容',
  `img` text COMMENT '文章插图',
  `teacher_id` int(10) NOT NULL DEFAULT '0' COMMENT '老师ID',
  `student_id` int(10) NOT NULL DEFAULT '0' COMMENT '学生ID',
  `school_id` int(10) NOT NULL DEFAULT '0' COMMENT '学校ID',
  `class_id` int(10) NOT NULL DEFAULT '0' COMMENT '班级ID',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `is_pass` int(1) NOT NULL DEFAULT '0' COMMENT '是否通过审核，0=》待审核 1=》通过审核 2=》审核失败未通过',
  `pass_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '审核通过时间',
  `see_num` int(10) NOT NULL DEFAULT '0' COMMENT '观看次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES ('15', '风行啊', '啊啊啊啊', '[{\"thumb\":\".\\/Uploads\\/2016-05-08\\/119_572eded9d733c.jpg\",\"unfold\":\".\\/Uploads\\/2016-05-08\\/600_572eded9d733c.jpg\",\"source\":\".\\/Uploads\\/2016-05-08\\/572eded9d733c.jpg\"},{\"thumb\":\".\\/Uploads\\/2016-05-08\\/119_572ee35dd6fcc.jpg\",\"unfold\":\".\\/Uploads\\/2016-05-08\\/600_572ee35dd6fcc.jpg\",\"source\":\".\\/Uploads\\/2016-05-08\\/572ee35dd6fcc.jpg\"},{\"thumb\":\".\\/Uploads\\/2016-05-08\\/119_572ee35fb4d56.jpg\",\"unfold\":\".\\/Uploads\\/2016-05-08\\/600_572ee35fb4d56.jpg\",\"source\":\".\\/Uploads\\/2016-05-08\\/572ee35fb4d56.jpg\"}]', '114', '0', '4', '69', '2016-05-08 14:57:36', '0', '0000-00-00 00:00:00', '1290');
INSERT INTO `articles` VALUES ('16', '大大撒', '是大阿斯达', '[{\"thumb\":\".\\/Uploads\\/2016-05-08\\/119_572edeebc7956.jpg\",\"unfold\":\".\\/Uploads\\/2016-05-08\\/600_572edeebc7956.jpg\",\"source\":\".\\/Uploads\\/2016-05-08\\/572edeebc7956.jpg\"}]', '114', '0', '4', '69', '2016-05-08 14:38:37', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `articles` VALUES ('27', '选个学生', '选个学生吧', '[{\"thumb\":\".\\/Uploads\\/2016-05-08\\/119_572ee8bb54c0a.jpg\",\"unfold\":\".\\/Uploads\\/2016-05-08\\/600_572ee8bb54c0a.jpg\",\"source\":\".\\/Uploads\\/2016-05-08\\/572ee8bb54c0a.jpg\"}]', '114', '39', '4', '69', '2016-05-08 15:20:28', '2', '0000-00-00 00:00:00', '5');
INSERT INTO `articles` VALUES ('29', '1212', '121121', '[{\"thumb\":\".\\/Uploads\\/2016-05-11\\/119_5732c8b394b5f.jpg\",\"unfold\":\".\\/Uploads\\/2016-05-11\\/600_5732c8b394b5f.jpg\",\"source\":\".\\/Uploads\\/2016-05-11\\/5732c8b394b5f.jpg\"}]', '114', '0', '4', '69', '2016-05-11 13:52:54', '0', '0000-00-00 00:00:00', '0');
INSERT INTO `articles` VALUES ('30', '小衣老师发个搞1', '哈哈哈哈哈', '[{\"thumb\":\".\\/Uploads\\/2016-05-16\\/119_5739d744b16e3.jpg\",\"unfold\":\".\\/Uploads\\/2016-05-16\\/600_5739d744b16e3.jpg\",\"source\":\".\\/Uploads\\/2016-05-16\\/5739d744b16e3.jpg\"}]', '173', '44', '20', '76', '2016-05-16 22:20:53', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `articles` VALUES ('31', '小衣给学生2发稿', '发稿吧哈哈', '[{\"thumb\":\".\\/Uploads\\/2016-05-16\\/119_5739d75aec7d3.jpg\",\"unfold\":\".\\/Uploads\\/2016-05-16\\/600_5739d75aec7d3.jpg\",\"source\":\".\\/Uploads\\/2016-05-16\\/5739d75aec7d3.jpg\"}]', '173', '45', '20', '76', '2016-05-16 22:21:16', '2', '0000-00-00 00:00:00', '0');
INSERT INTO `articles` VALUES ('32', '小二老师给学生1发稿', '按时打算', '[{\"thumb\":\".\\/Uploads\\/2016-05-16\\/119_5739d781e0250.jpg\",\"unfold\":\".\\/Uploads\\/2016-05-16\\/600_5739d781e0250.jpg\",\"source\":\".\\/Uploads\\/2016-05-16\\/5739d781e0250.jpg\"}]', '174', '46', '20', '77', '2016-05-16 22:21:54', '1', '0000-00-00 00:00:00', '1');
INSERT INTO `articles` VALUES ('33', '小二老师给学生2发稿', '发货发的撒加快和', '[{\"thumb\":\".\\/Uploads\\/2016-05-16\\/119_5739d79020922.jpg\",\"unfold\":\".\\/Uploads\\/2016-05-16\\/600_5739d79020922.jpg\",\"source\":\".\\/Uploads\\/2016-05-16\\/5739d79020922.jpg\"}]', '174', '47', '20', '77', '2016-05-16 22:22:09', '2', '0000-00-00 00:00:00', '0');
INSERT INTO `articles` VALUES ('34', '接口测试文章', '接口测试的内容，啦啦啦啦啦啦啦', null, '154', '116', '4', '69', '2016-07-11 15:09:53', '0', '0000-00-00 00:00:00', '0');
INSERT INTO `articles` VALUES ('35', 'test title', 'test content', null, '114', '116', '5', '71', '2016-07-18 01:21:29', '0', '0000-00-00 00:00:00', '0');
INSERT INTO `articles` VALUES ('36', '123', '6547893214', null, '114', '129', '5', '71', '2016-07-18 03:25:25', '0', '0000-00-00 00:00:00', '0');
INSERT INTO `articles` VALUES ('37', '123', '6547893214', null, '114', '129', '5', '71', '2016-07-18 03:25:32', '0', '0000-00-00 00:00:00', '0');
INSERT INTO `articles` VALUES ('38', '123', '6547893214', null, '114', '129', '5', '71', '2016-07-18 03:25:57', '0', '0000-00-00 00:00:00', '0');
INSERT INTO `articles` VALUES ('39', '标这客', '找的內容写好', null, '114', '167', '5', '71', '2016-07-18 03:56:05', '0', '0000-00-00 00:00:00', '0');
INSERT INTO `articles` VALUES ('40', '你好', '好多个国际在线专稿：据韩联社7月19日报道，韩国总理黄教安19日表示中韩关系已高度发展，大可不必忧虑中国或许会因韩美部署“萨德”而对韩国进行经济报复。', null, '114', '146', '5', '71', '2016-07-18 08:17:14', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `articles` VALUES ('47', 'qqq', '历史上，固原曾有“苦瘠甲天下”之称，', null, '114', '129', '5', '71', '2016-07-18 15:42:05', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `articles` VALUES ('48', '111', '1111', null, '114', '129', '5', '71', '2016-07-18 15:44:01', '0', '0000-00-00 00:00:00', '0');
INSERT INTO `articles` VALUES ('49', '11', '111', null, '114', '129', '5', '71', '2016-07-18 15:45:06', '0', '0000-00-00 00:00:00', '0');
INSERT INTO `articles` VALUES ('50', '2222', '2222222222222222', null, '114', '129', '5', '71', '2016-07-18 16:02:48', '0', '0000-00-00 00:00:00', '0');
INSERT INTO `articles` VALUES ('51', '11111', '11111111111', null, '114', '129', '5', '71', '2016-07-18 16:05:27', '0', '0000-00-00 00:00:00', '0');
INSERT INTO `articles` VALUES ('52', '1234511', '22222111', null, '114', '129', '5', '71', '2016-07-18 16:05:35', '1', '0000-00-00 00:00:00', '0');
INSERT INTO `articles` VALUES ('54', '66588', '内容丰富1', null, '114', '129', '5', '71', '2016-07-19 08:09:22', '0', '0000-00-00 00:00:00', '0');
INSERT INTO `articles` VALUES ('55', '黑化皇妃', '化工厂吃', null, '114', '151', '5', '71', '2016-07-19 09:58:03', '0', '0000-00-00 00:00:00', '0');

-- ----------------------------
-- Table structure for auth_group
-- ----------------------------
DROP TABLE IF EXISTS `auth_group`;
CREATE TABLE `auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_group
-- ----------------------------
INSERT INTO `auth_group` VALUES ('13', '超级管理员', '1', '1,2,5,6,7,8');
INSERT INTO `auth_group` VALUES ('8', '代理商', '1', '5,6,8');

-- ----------------------------
-- Table structure for auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `auth_group_access`;
CREATE TABLE `auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_group_access
-- ----------------------------
INSERT INTO `auth_group_access` VALUES ('1', '13');
INSERT INTO `auth_group_access` VALUES ('2', '2');
INSERT INTO `auth_group_access` VALUES ('9', '2');
INSERT INTO `auth_group_access` VALUES ('10', '1');
INSERT INTO `auth_group_access` VALUES ('11', '1');
INSERT INTO `auth_group_access` VALUES ('12', '6');
INSERT INTO `auth_group_access` VALUES ('12', '7');
INSERT INTO `auth_group_access` VALUES ('13', '8');
INSERT INTO `auth_group_access` VALUES ('14', '13');
INSERT INTO `auth_group_access` VALUES ('16', '1');
INSERT INTO `auth_group_access` VALUES ('17', '1');
INSERT INTO `auth_group_access` VALUES ('18', '1');
INSERT INTO `auth_group_access` VALUES ('19', '1');
INSERT INTO `auth_group_access` VALUES ('20', '1');
INSERT INTO `auth_group_access` VALUES ('21', '1');
INSERT INTO `auth_group_access` VALUES ('22', '8');
INSERT INTO `auth_group_access` VALUES ('23', '13');
INSERT INTO `auth_group_access` VALUES ('24', '8');
INSERT INTO `auth_group_access` VALUES ('25', '0');
INSERT INTO `auth_group_access` VALUES ('26', '8');
INSERT INTO `auth_group_access` VALUES ('27', '8');
INSERT INTO `auth_group_access` VALUES ('28', '8');
INSERT INTO `auth_group_access` VALUES ('29', '8');
INSERT INTO `auth_group_access` VALUES ('30', '13');
INSERT INTO `auth_group_access` VALUES ('31', '13');
INSERT INTO `auth_group_access` VALUES ('32', '13');
INSERT INTO `auth_group_access` VALUES ('34', '8');
INSERT INTO `auth_group_access` VALUES ('35', '13');

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_rule
-- ----------------------------
INSERT INTO `auth_rule` VALUES ('1', 'Admin/Manage/', '系统管理', '1', '1', '');
INSERT INTO `auth_rule` VALUES ('2', 'Admin/User/', '会员管理', '1', '1', '');
INSERT INTO `auth_rule` VALUES ('7', 'Admin/Habbit/', '习惯库管理', '1', '1', '');
INSERT INTO `auth_rule` VALUES ('5', 'Admin/School/', '学校管理', '1', '1', '');
INSERT INTO `auth_rule` VALUES ('6', 'Admin/Agent/', '代理商', '1', '1', '');
INSERT INTO `auth_rule` VALUES ('8', 'Admin/Bookmanage/', '图书借阅管理', '1', '1', '');

-- ----------------------------
-- Table structure for balance_info
-- ----------------------------
DROP TABLE IF EXISTS `balance_info`;
CREATE TABLE `balance_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `type` int(3) NOT NULL DEFAULT '0' COMMENT '收支类型：1收入，2提现',
  `coin` int(11) NOT NULL DEFAULT '0' COMMENT '变动金额',
  `total_coin` int(11) NOT NULL DEFAULT '0' COMMENT '剩余金额（操作完成后的余额）',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of balance_info
-- ----------------------------
INSERT INTO `balance_info` VALUES ('1', '114', '2', '-100', '1600', '2016-05-10 21:50:42');
INSERT INTO `balance_info` VALUES ('2', '114', '2', '-999', '601', '2016-05-10 21:50:48');
INSERT INTO `balance_info` VALUES ('3', '114', '2', '-100', '501', '2016-05-10 22:00:07');
INSERT INTO `balance_info` VALUES ('4', '192', '2', '30', '30', '2016-07-12 11:02:52');

-- ----------------------------
-- Table structure for bookinfo
-- ----------------------------
DROP TABLE IF EXISTS `bookinfo`;
CREATE TABLE `bookinfo` (
  `barcode` varchar(30) DEFAULT NULL,
  `bookname` varchar(70) DEFAULT NULL,
  `typeid` int(10) unsigned DEFAULT NULL,
  `author` varchar(30) DEFAULT NULL,
  `translator` varchar(30) DEFAULT NULL,
  `ISBN` varchar(20) DEFAULT NULL,
  `rent` float(8,2) DEFAULT NULL,
  `price` float(8,2) DEFAULT NULL,
  `page` int(10) unsigned DEFAULT NULL,
  `bookcase` int(10) unsigned DEFAULT NULL,
  `number` int(11) DEFAULT NULL COMMENT '总数量',
  `outdepot` int(11) DEFAULT '0' COMMENT '出库数',
  `storage` int(10) unsigned DEFAULT NULL,
  `inTime` timestamp NULL DEFAULT NULL,
  `operator` varchar(30) DEFAULT NULL,
  `del` tinyint(1) DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bookinfo
-- ----------------------------
INSERT INTO `bookinfo` VALUES ('123456789', 'PHP数据库系统开发完全手册', '1', '邹天思、潘凯华、刘中华', 'me', '7-121', '12.00', '65.00', '530', '46', '666', '2', '545', '2015-12-06 00:00:00', 'Tsoft', '0', '5');
INSERT INTO `bookinfo` VALUES ('123454321', 'PHP程序开发范例宝典', '2', '邹天思、潘凯华', 'hehe', '7-111', '13.00', '89.00', '730', '46', '234', '1', '299', '2015-12-07 02:02:58', 'Tsoft', '0', '6');
INSERT INTO `bookinfo` VALUES ('987654321', 'PHP函数参考大全', '3', '邹天思、潘凯华', 'me', '7-115', '14.00', '99.00', '950', '46', '123', '3', '799', '2015-11-06 22:58:58', 'mr', '0', '2');
INSERT INTO `bookinfo` VALUES ('9787115154101', 'Visual Basic控件参考大全', '5', '高春艳、刘彬彬', '无', '7-115', '33.00', '86.00', '777', '50', '65', '2', '10', '2015-12-04 23:58:58', 'Tsoft', '0', '20');

-- ----------------------------
-- Table structure for borrow
-- ----------------------------
DROP TABLE IF EXISTS `borrow`;
CREATE TABLE `borrow` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned DEFAULT NULL,
  `bookid` int(10) DEFAULT NULL,
  `rental` int(10) DEFAULT NULL COMMENT '租书费用',
  `schoolid` int(10) DEFAULT NULL,
  `borrowTime` date DEFAULT NULL,
  `backTime` date DEFAULT NULL,
  `operator` varchar(30) DEFAULT NULL,
  `ifback` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of borrow
-- ----------------------------
INSERT INTO `borrow` VALUES ('1', '156', '6', '23', '4', '2007-01-01', '2016-07-28', 'Tsoft', '1');
INSERT INTO `borrow` VALUES ('2', '157', '2', '32', '5', '2007-12-06', '2016-07-30', 'Tsoft', '1');
INSERT INTO `borrow` VALUES ('3', '158', '2', '34', '20', '2007-12-07', '2008-01-06', 'Tsoft', '0');
INSERT INTO `borrow` VALUES ('4', '157', '20', '27', '20', '2007-12-06', '2016-07-29', 'Tsoft', '0');
INSERT INTO `borrow` VALUES ('5', '157', '2', '45', '4', '2007-12-05', '2016-07-29', 'Tsoft', '1');
INSERT INTO `borrow` VALUES ('6', '158', '20', '12', '4', '2007-12-06', '2007-12-06', 'Tsoft', '1');
INSERT INTO `borrow` VALUES ('7', '158', '20', '34', '5', '2007-12-06', '2007-12-06', 'Tsoft', '1');
INSERT INTO `borrow` VALUES ('8', '157', '5', '22', '20', '2007-12-06', '2008-01-05', 'Tsoft', '1');
INSERT INTO `borrow` VALUES ('9', '156', '2', '7', '24', '2007-12-06', '2008-01-05', 'Tsoft', '1');
INSERT INTO `borrow` VALUES ('10', '156', '5', '3', '5', '2007-12-06', '2007-12-06', 'Tsoft', '1');

-- ----------------------------
-- Table structure for child
-- ----------------------------
DROP TABLE IF EXISTS `child`;
CREATE TABLE `child` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL COMMENT '班级id',
  `name` char(10) DEFAULT NULL COMMENT '姓名',
  `card` char(20) DEFAULT NULL COMMENT '//卡号',
  `info` char(250) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT '0' COMMENT '1男 0 女',
  `state` tinyint(1) DEFAULT '1',
  `birthday` int(10) DEFAULT NULL,
  `coin` int(11) NOT NULL DEFAULT '0' COMMENT '能量币 预留字段',
  PRIMARY KEY (`id`),
  KEY `pid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of child
-- ----------------------------
INSERT INTO `child` VALUES ('25', '115', '4', '69', '赵信', '32562326', '《三体2》启动筹备，剧情将会紧接《三体1》，坚持忠于小说的改编原则，两部片的故事情节上有较为紧还会有进一步的增加。', '1', '1', '632592000', '0');
INSERT INTO `child` VALUES ('26', '116', '4', '69', '清风', '3222222', '222', '1', '1', '1424793600', '0');
INSERT INTO `child` VALUES ('35', '129', '5', '71', '云中歌', null, null, '0', '1', '1424966400', '0');
INSERT INTO `child` VALUES ('36', '130', '4', '70', '路飞', null, '999999999999999', '1', '1', '1423929600', '0');
INSERT INTO `child` VALUES ('37', '131', '4', '69', '战五渣', null, null, '1', '1', '1424793600', '0');
INSERT INTO `child` VALUES ('41', '167', '5', '71', 'Robert', null, null, '1', '1', '1462809600', '0');
INSERT INTO `child` VALUES ('44', '175', '20', '76', '小衣学生1', null, null, '1', '1', '0', '0');
INSERT INTO `child` VALUES ('45', '176', '20', '76', '小衣学生2', null, null, '1', '1', '0', '0');
INSERT INTO `child` VALUES ('46', '177', '20', '77', '小二学生1', null, null, '0', '1', '0', '0');
INSERT INTO `child` VALUES ('47', '178', '20', '77', '小二学生2', null, null, '1', '1', '0', '0');
INSERT INTO `child` VALUES ('49', '186', '5', '71', '天才老师', null, null, '1', '1', null, '0');
INSERT INTO `child` VALUES ('51', '188', '4', '73', '我是老师啊', null, null, '1', '1', null, '0');
INSERT INTO `child` VALUES ('52', '189', '4', '69', '天才一班老师', null, null, '1', '1', null, '0');
INSERT INTO `child` VALUES ('53', '-4', '4', '69', '天才一班老师', null, null, '1', '1', null, '0');
INSERT INTO `child` VALUES ('54', '-5', '5', '71', '心里李小龙', null, null, '0', '1', null, '0');
INSERT INTO `child` VALUES ('55', '193', '4', '69', 'test', null, null, '1', '1', '0', '0');
INSERT INTO `child` VALUES ('56', '-4', '4', '69', 'aaaaa', null, null, '1', '1', null, '0');

-- ----------------------------
-- Table structure for class
-- ----------------------------
DROP TABLE IF EXISTS `class`;
CREATE TABLE `class` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_name` char(10) DEFAULT NULL,
  `class_info` varchar(100) DEFAULT NULL,
  `school_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `school` (`school_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of class
-- ----------------------------
INSERT INTO `class` VALUES ('69', '天才一班', '好好学习哟', '4');
INSERT INTO `class` VALUES ('70', '天才二班', '', '4');
INSERT INTO `class` VALUES ('71', '天才三班', '', '5');
INSERT INTO `class` VALUES ('73', '神话班', '有钱人才能上的班', '4');
INSERT INTO `class` VALUES ('76', '小衣班', '', '20');
INSERT INTO `class` VALUES ('77', '小二班', '', '20');

-- ----------------------------
-- Table structure for code
-- ----------------------------
DROP TABLE IF EXISTS `code`;
CREATE TABLE `code` (
  `code` varchar(10) NOT NULL DEFAULT '',
  `user` varchar(45) NOT NULL DEFAULT '',
  UNIQUE KEY `code` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='验证码';

-- ----------------------------
-- Records of code
-- ----------------------------
INSERT INTO `code` VALUES ('701566', '13181038186');
INSERT INTO `code` VALUES ('243162', '13260446052');
INSERT INTO `code` VALUES ('849669', '13260446055');
INSERT INTO `code` VALUES ('219064', '13266816551');
INSERT INTO `code` VALUES ('294771', '13718886526');
INSERT INTO `code` VALUES ('042341', '13770209899');
INSERT INTO `code` VALUES ('036718', '13962214729');
INSERT INTO `code` VALUES ('519594', '15123036810');
INSERT INTO `code` VALUES ('670736', '15557173016');
INSERT INTO `code` VALUES ('623413', '15624501317');
INSERT INTO `code` VALUES ('662804', '15926385951');
INSERT INTO `code` VALUES ('974584', '15951610685');
INSERT INTO `code` VALUES ('841695', '17701567376');
INSERT INTO `code` VALUES ('094497', '18301811239');

-- ----------------------------
-- Table structure for fee
-- ----------------------------
DROP TABLE IF EXISTS `fee`;
CREATE TABLE `fee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `fee` int(11) NOT NULL DEFAULT '0' COMMENT '缴纳金额',
  `term` tinyint(1) NOT NULL COMMENT '学期 1=》第一学期 2=》第二学期',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已经缴纳',
  `year` varchar(4) DEFAULT NULL COMMENT '学年',
  `class_name` varchar(50) DEFAULT NULL COMMENT '班级名称',
  `dateline` int(11) NOT NULL DEFAULT '0' COMMENT '缴纳时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fee
-- ----------------------------
INSERT INTO `fee` VALUES ('4', '167', '500', '1', '1', '2016', '天才三班', '1462847297');

-- ----------------------------
-- Table structure for growing
-- ----------------------------
DROP TABLE IF EXISTS `growing`;
CREATE TABLE `growing` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `info` text CHARACTER SET utf8 NOT NULL,
  `dateline` int(10) NOT NULL,
  `school_id` int(10) NOT NULL,
  `uid` int(10) NOT NULL COMMENT '//发布者',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=gbk COMMENT='校园动态';

-- ----------------------------
-- Records of growing
-- ----------------------------
INSERT INTO `growing` VALUES ('25', '人生总会有选择的?', '1446453451', '4', '112');
INSERT INTO `growing` VALUES ('26', '不到最后结局，何必绝望？', '1446453548', '4', '112');
INSERT INTO `growing` VALUES ('27', '小女生都长大成人，往事又何必再问..', '1446529098', '4', '112');
INSERT INTO `growing` VALUES ('28', '你的背包，背到现在还没烂，却以成为我心里的别一半...', '1446530927', '4', '112');
INSERT INTO `growing` VALUES ('29', '刘诗诗..', '1446533186', '4', '112');
INSERT INTO `growing` VALUES ('30', '画心..', '1446618021', '4', '112');
INSERT INTO `growing` VALUES ('31', '梦中人..', '1446618073', '4', '112');
INSERT INTO `growing` VALUES ('32', '想你的365天里......', '1446618150', '4', '112');
INSERT INTO `growing` VALUES ('33', 'fdfdf', '1446618587', '4', '112');
INSERT INTO `growing` VALUES ('34', '分享图片', '1446618615', '4', '112');
INSERT INTO `growing` VALUES ('35', '54584641', '1446618798', '4', '112');
INSERT INTO `growing` VALUES ('36', 'fdfdfd', '1446618984', '4', '112');
INSERT INTO `growing` VALUES ('37', 'gfgfg', '1446619074', '4', '114');
INSERT INTO `growing` VALUES ('38', 'fdfdfdfd', '1446619128', '4', '114');
INSERT INTO `growing` VALUES ('39', '爱上你的笑容..', '1446619295', '4', '114');
INSERT INTO `growing` VALUES ('40', '爱就爱了...', '1446619345', '5', '114');
INSERT INTO `growing` VALUES ('41', '分享图片', '1446620275', '5', '114');
INSERT INTO `growing` VALUES ('42', '小思思..', '1446620464', '5', '114');
INSERT INTO `growing` VALUES ('43', '小丑女..', '1446620524', '5', '114');
INSERT INTO `growing` VALUES ('44', '分享图片', '1446621882', '0', '114');
INSERT INTO `growing` VALUES ('45', '分享图片', '1446621930', '0', '114');
INSERT INTO `growing` VALUES ('46', '分享图片', '1446622003', '0', '114');
INSERT INTO `growing` VALUES ('47', '分享图片', '1446622059', '0', '114');
INSERT INTO `growing` VALUES ('48', '分享图片', '1446622112', '0', '114');
INSERT INTO `growing` VALUES ('49', '人生..', '1446622218', '0', '114');
INSERT INTO `growing` VALUES ('50', '分享图片', '1446622259', '0', '114');
INSERT INTO `growing` VALUES ('51', '分享图片', '1446622328', '0', '114');
INSERT INTO `growing` VALUES ('52', '测试..', '1446622444', '0', '114');
INSERT INTO `growing` VALUES ('53', '分享图片', '1446622769', '0', '114');
INSERT INTO `growing` VALUES ('54', '分享图片', '1446622918', '0', '114');
INSERT INTO `growing` VALUES ('55', '分享图片', '1446623070', '0', '114');
INSERT INTO `growing` VALUES ('56', '分享图片', '1446623098', '0', '114');
INSERT INTO `growing` VALUES ('57', '分享图片', '1446623183', '0', '114');
INSERT INTO `growing` VALUES ('58', '分享图片', '1446623229', '0', '114');
INSERT INTO `growing` VALUES ('59', '分享图片', '1446623257', '0', '114');
INSERT INTO `growing` VALUES ('60', '鬼吹灯..', '1446628161', '0', '114');
INSERT INTO `growing` VALUES ('61', '天天见到你...', '1446780676', '0', '115');
INSERT INTO `growing` VALUES ('62', '人生如梦', '1446780727', '0', '115');
INSERT INTO `growing` VALUES ('63', '我来测试下头像/', '1446791573', '0', '114');
INSERT INTO `growing` VALUES ('64', '测试第二次', '1446791598', '0', '114');
INSERT INTO `growing` VALUES ('65', '测试第三次', '1446791629', '0', '114');
INSERT INTO `growing` VALUES ('66', '分享图片', '1446791792', '0', '114');
INSERT INTO `growing` VALUES ('67', '分享图片', '1446791912', '0', '114');
INSERT INTO `growing` VALUES ('68', '分享图片', '1446792001', '0', '114');
INSERT INTO `growing` VALUES ('69', '分享图片', '1446792085', '0', '114');
INSERT INTO `growing` VALUES ('70', '测试一个..', '1446792417', '0', '116');
INSERT INTO `growing` VALUES ('71', '今天天气不错哈', '1448425546', '0', '124');
INSERT INTO `growing` VALUES ('72', '分享图片', '1451017697', '0', '135');
INSERT INTO `growing` VALUES ('73', 'dasd', '1451020165', '0', '135');
INSERT INTO `growing` VALUES ('74', 'dssdafd', '1451020204', '0', '135');
INSERT INTO `growing` VALUES ('75', '33333', '1462350431', '0', '154');
INSERT INTO `growing` VALUES ('76', '333', '1462406605', '0', '154');
INSERT INTO `growing` VALUES ('77', '试试吧', '1463325139', '0', '115');

-- ----------------------------
-- Table structure for growing_child
-- ----------------------------
DROP TABLE IF EXISTS `growing_child`;
CREATE TABLE `growing_child` (
  `growing_id` int(10) DEFAULT NULL COMMENT '//动态ID',
  `cid` int(10) DEFAULT NULL COMMENT '//学生ID'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of growing_child
-- ----------------------------
INSERT INTO `growing_child` VALUES ('25', '23');
INSERT INTO `growing_child` VALUES ('26', '22');
INSERT INTO `growing_child` VALUES ('26', '24');
INSERT INTO `growing_child` VALUES ('27', '22');
INSERT INTO `growing_child` VALUES ('28', '23');
INSERT INTO `growing_child` VALUES ('29', '26');
INSERT INTO `growing_child` VALUES ('30', '22');
INSERT INTO `growing_child` VALUES ('31', '25');
INSERT INTO `growing_child` VALUES ('32', '23');
INSERT INTO `growing_child` VALUES ('33', '22');
INSERT INTO `growing_child` VALUES ('34', '22');
INSERT INTO `growing_child` VALUES ('35', '25');
INSERT INTO `growing_child` VALUES ('36', '24');
INSERT INTO `growing_child` VALUES ('37', '26');
INSERT INTO `growing_child` VALUES ('38', '25');
INSERT INTO `growing_child` VALUES ('39', '23');
INSERT INTO `growing_child` VALUES ('40', '24');
INSERT INTO `growing_child` VALUES ('41', '27');
INSERT INTO `growing_child` VALUES ('42', '25');
INSERT INTO `growing_child` VALUES ('43', '23');
INSERT INTO `growing_child` VALUES ('44', '22');
INSERT INTO `growing_child` VALUES ('44', '24');
INSERT INTO `growing_child` VALUES ('45', '24');
INSERT INTO `growing_child` VALUES ('46', '24');
INSERT INTO `growing_child` VALUES ('47', '22');
INSERT INTO `growing_child` VALUES ('48', '22');
INSERT INTO `growing_child` VALUES ('49', '22');
INSERT INTO `growing_child` VALUES ('50', '25');
INSERT INTO `growing_child` VALUES ('51', '27');
INSERT INTO `growing_child` VALUES ('52', '24');
INSERT INTO `growing_child` VALUES ('53', '22');
INSERT INTO `growing_child` VALUES ('54', '22');
INSERT INTO `growing_child` VALUES ('55', '22');
INSERT INTO `growing_child` VALUES ('56', '22');
INSERT INTO `growing_child` VALUES ('57', '22');
INSERT INTO `growing_child` VALUES ('58', '25');
INSERT INTO `growing_child` VALUES ('59', '22');
INSERT INTO `growing_child` VALUES ('60', '24');
INSERT INTO `growing_child` VALUES ('61', '22');
INSERT INTO `growing_child` VALUES ('62', '24');
INSERT INTO `growing_child` VALUES ('63', '22');
INSERT INTO `growing_child` VALUES ('64', '22');
INSERT INTO `growing_child` VALUES ('65', '23');
INSERT INTO `growing_child` VALUES ('66', '27');
INSERT INTO `growing_child` VALUES ('67', '22');
INSERT INTO `growing_child` VALUES ('68', '22');
INSERT INTO `growing_child` VALUES ('69', '24');
INSERT INTO `growing_child` VALUES ('70', '22');
INSERT INTO `growing_child` VALUES ('71', '24');
INSERT INTO `growing_child` VALUES ('72', '25');
INSERT INTO `growing_child` VALUES ('72', '40');
INSERT INTO `growing_child` VALUES ('73', '36');
INSERT INTO `growing_child` VALUES ('74', '26');
INSERT INTO `growing_child` VALUES ('75', '36');
INSERT INTO `growing_child` VALUES ('76', '26');
INSERT INTO `growing_child` VALUES ('77', '41');

-- ----------------------------
-- Table structure for img
-- ----------------------------
DROP TABLE IF EXISTS `img`;
CREATE TABLE `img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data` char(200) CHARACTER SET utf8 DEFAULT NULL,
  `gid` int(10) unsigned DEFAULT NULL COMMENT '//配图绑定动态的ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of img
-- ----------------------------
INSERT INTO `img` VALUES ('30', '{\"thumb\":\".\\/Uploads\\/2015-11-02\\/180_563720bfed41b.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-02\\/550_563720bfed41b.jpg\",\"source\":\".\\/Uploads\\/2015-11-02\\/563720bfed41b.jpg\"}', '25');
INSERT INTO `img` VALUES ('31', '{\"thumb\":\".\\/Uploads\\/2015-11-02\\/180_563721185d78c.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-02\\/550_563721185d78c.jpg\",\"source\":\".\\/Uploads\\/2015-11-02\\/563721185d78c.jpg\"}', '26');
INSERT INTO `img` VALUES ('32', '{\"thumb\":\".\\/Uploads\\/2015-11-02\\/180_563721209a223.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-02\\/550_563721209a223.jpg\",\"source\":\".\\/Uploads\\/2015-11-02\\/563721209a223.jpg\"}', '26');
INSERT INTO `img` VALUES ('33', '{\"thumb\":\".\\/Uploads\\/2015-11-03\\/180_56384f3431edb.png\",\"unfold\":\".\\/Uploads\\/2015-11-03\\/550_56384f3431edb.png\",\"source\":\".\\/Uploads\\/2015-11-03\\/56384f3431edb.png\"}', '28');
INSERT INTO `img` VALUES ('34', '{\"thumb\":\".\\/Uploads\\/2015-11-03\\/180_56384f39f2a2e.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-03\\/550_56384f39f2a2e.jpg\",\"source\":\".\\/Uploads\\/2015-11-03\\/56384f39f2a2e.jpg\"}', '28');
INSERT INTO `img` VALUES ('35', '{\"thumb\":\".\\/Uploads\\/2015-11-03\\/180_56384f47e94f5.png\",\"unfold\":\".\\/Uploads\\/2015-11-03\\/550_56384f47e94f5.png\",\"source\":\".\\/Uploads\\/2015-11-03\\/56384f47e94f5.png\"}', '28');
INSERT INTO `img` VALUES ('36', '{\"thumb\":\".\\/Uploads\\/2015-11-03\\/180_5638583c2c208.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-03\\/550_5638583c2c208.jpg\",\"source\":\".\\/Uploads\\/2015-11-03\\/5638583c2c208.jpg\"}', '29');
INSERT INTO `img` VALUES ('37', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639a5f51b6fa.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639a5f51b6fa.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639a5f51b6fa.jpg\"}', '34');
INSERT INTO `img` VALUES ('38', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639ac69b0006.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639ac69b0006.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639ac69b0006.jpg\"}', '41');
INSERT INTO `img` VALUES ('39', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639ad1f36063.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639ad1f36063.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639ad1f36063.jpg\"}', '42');
INSERT INTO `img` VALUES ('40', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639ad69d2958.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639ad69d2958.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639ad69d2958.jpg\"}', '43');
INSERT INTO `img` VALUES ('41', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b2abcb801.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b2abcb801.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b2abcb801.jpg\"}', '44');
INSERT INTO `img` VALUES ('42', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b2b05b425.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b2b05b425.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b2b05b425.jpg\"}', '44');
INSERT INTO `img` VALUES ('43', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b2e0549ad.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b2e0549ad.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b2e0549ad.jpg\"}', '45');
INSERT INTO `img` VALUES ('44', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b2e4d5548.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b2e4d5548.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b2e4d5548.jpg\"}', '45');
INSERT INTO `img` VALUES ('45', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b32a2ba4c.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b32a2ba4c.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b32a2ba4c.jpg\"}', '46');
INSERT INTO `img` VALUES ('46', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b32e3bd04.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b32e3bd04.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b32e3bd04.jpg\"}', '46');
INSERT INTO `img` VALUES ('47', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b364df2cb.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b364df2cb.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b364df2cb.jpg\"}', '47');
INSERT INTO `img` VALUES ('48', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b3694146c.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b3694146c.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b3694146c.jpg\"}', '47');
INSERT INTO `img` VALUES ('49', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b3968be23.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b3968be23.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b3968be23.jpg\"}', '48');
INSERT INTO `img` VALUES ('50', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b39a3bdb5.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b39a3bdb5.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b39a3bdb5.jpg\"}', '48');
INSERT INTO `img` VALUES ('51', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b3f9d25ca.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b3f9d25ca.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b3f9d25ca.jpg\"}', '49');
INSERT INTO `img` VALUES ('52', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b3fda5015.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b3fda5015.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b3fda5015.jpg\"}', '49');
INSERT INTO `img` VALUES ('53', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b427538e4.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b427538e4.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b427538e4.jpg\"}', '50');
INSERT INTO `img` VALUES ('54', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b42b2bd07.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b42b2bd07.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b42b2bd07.jpg\"}', '50');
INSERT INTO `img` VALUES ('55', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b46deb6bb.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b46deb6bb.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b46deb6bb.jpg\"}', '51');
INSERT INTO `img` VALUES ('56', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b471e84d7.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b471e84d7.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b471e84d7.jpg\"}', '51');
INSERT INTO `img` VALUES ('57', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b4d87c5c1.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b4d87c5c1.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b4d87c5c1.jpg\"}', '52');
INSERT INTO `img` VALUES ('58', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b4dd1cb89.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b4dd1cb89.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b4dd1cb89.jpg\"}', '52');
INSERT INTO `img` VALUES ('59', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b627030de.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b627030de.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b627030de.jpg\"}', '53');
INSERT INTO `img` VALUES ('60', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b62abaf1c.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b62abaf1c.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b62abaf1c.jpg\"}', '53');
INSERT INTO `img` VALUES ('61', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b6ba6fcd7.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b6ba6fcd7.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b6ba6fcd7.jpg\"}', '54');
INSERT INTO `img` VALUES ('62', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b6be14c9f.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b6be14c9f.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b6be14c9f.jpg\"}', '54');
INSERT INTO `img` VALUES ('63', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b7538096a.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b7538096a.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b7538096a.jpg\"}', '55');
INSERT INTO `img` VALUES ('64', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b756d2e91.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b756d2e91.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b756d2e91.jpg\"}', '55');
INSERT INTO `img` VALUES ('65', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b77484f4b.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b77484f4b.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b77484f4b.jpg\"}', '56');
INSERT INTO `img` VALUES ('66', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b7789752c.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b7789752c.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b7789752c.jpg\"}', '56');
INSERT INTO `img` VALUES ('67', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b7c3a2618.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b7c3a2618.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b7c3a2618.jpg\"}', '57');
INSERT INTO `img` VALUES ('68', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b7c79f04c.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b7c79f04c.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b7c79f04c.jpg\"}', '57');
INSERT INTO `img` VALUES ('69', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b7f0503db.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b7f0503db.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b7f0503db.jpg\"}', '58');
INSERT INTO `img` VALUES ('70', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b7f51e80d.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b7f51e80d.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b7f51e80d.jpg\"}', '58');
INSERT INTO `img` VALUES ('71', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b812bdda5.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b812bdda5.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b812bdda5.jpg\"}', '59');
INSERT INTO `img` VALUES ('72', '{\"thumb\":\".\\/Uploads\\/2015-11-04\\/180_5639b8166aa6e.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-04\\/550_5639b8166aa6e.jpg\",\"source\":\".\\/Uploads\\/2015-11-04\\/5639b8166aa6e.jpg\"}', '59');
INSERT INTO `img` VALUES ('73', '{\"thumb\":\".\\/Uploads\\/2015-11-06\\/180_563c1efe5d454.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-06\\/550_563c1efe5d454.jpg\",\"source\":\".\\/Uploads\\/2015-11-06\\/563c1efe5d454.jpg\"}', '61');
INSERT INTO `img` VALUES ('74', '{\"thumb\":\".\\/Uploads\\/2015-11-06\\/180_563c1f294e004.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-06\\/550_563c1f294e004.jpg\",\"source\":\".\\/Uploads\\/2015-11-06\\/563c1f294e004.jpg\"}', '62');
INSERT INTO `img` VALUES ('75', '{\"thumb\":\".\\/Uploads\\/2015-11-06\\/180_563c49a347e30.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-06\\/550_563c49a347e30.jpg\",\"source\":\".\\/Uploads\\/2015-11-06\\/563c49a347e30.jpg\"}', '64');
INSERT INTO `img` VALUES ('76', '{\"thumb\":\".\\/Uploads\\/2015-11-06\\/180_563c49ba5eab8.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-06\\/550_563c49ba5eab8.jpg\",\"source\":\".\\/Uploads\\/2015-11-06\\/563c49ba5eab8.jpg\"}', '65');
INSERT INTO `img` VALUES ('77', '{\"thumb\":\".\\/Uploads\\/2015-11-06\\/180_563c49c309d47.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-06\\/550_563c49c309d47.jpg\",\"source\":\".\\/Uploads\\/2015-11-06\\/563c49c309d47.jpg\"}', '65');
INSERT INTO `img` VALUES ('78', '{\"thumb\":\".\\/Uploads\\/2015-11-06\\/180_563c4a6a0320e.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-06\\/550_563c4a6a0320e.jpg\",\"source\":\".\\/Uploads\\/2015-11-06\\/563c4a6a0320e.jpg\"}', '66');
INSERT INTO `img` VALUES ('79', '{\"thumb\":\".\\/Uploads\\/2015-11-06\\/180_563c4ae03f5f9.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-06\\/550_563c4ae03f5f9.jpg\",\"source\":\".\\/Uploads\\/2015-11-06\\/563c4ae03f5f9.jpg\"}', '67');
INSERT INTO `img` VALUES ('80', '{\"thumb\":\".\\/Uploads\\/2015-11-06\\/180_563c4b3b1b885.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-06\\/550_563c4b3b1b885.jpg\",\"source\":\".\\/Uploads\\/2015-11-06\\/563c4b3b1b885.jpg\"}', '68');
INSERT INTO `img` VALUES ('81', '{\"thumb\":\".\\/Uploads\\/2015-11-06\\/180_563c4b8c95c3b.jpg\",\"unfold\":\".\\/Uploads\\/2015-11-06\\/550_563c4b8c95c3b.jpg\",\"source\":\".\\/Uploads\\/2015-11-06\\/563c4b8c95c3b.jpg\"}', '69');
INSERT INTO `img` VALUES ('82', '', '72');
INSERT INTO `img` VALUES ('83', '', '72');
INSERT INTO `img` VALUES ('84', '', '72');
INSERT INTO `img` VALUES ('85', '', '73');
INSERT INTO `img` VALUES ('86', '{\"thumb\":\"\\/Uploads\\/2016-05-04\\/180_5729b25409316.jpg\",\"unfold\":\"\\/Uploads\\/2016-05-04\\/550_5729b25409316.jpg\",\"source\":\"\\/Uploads\\/2016-05-04\\/5729b25409316.jpg\"}', '75');
INSERT INTO `img` VALUES ('87', '{\"thumb\":\"\\/Uploads\\/2016-05-05\\/180_572a8dc461761.jpg\",\"unfold\":\"\\/Uploads\\/2016-05-05\\/550_572a8dc461761.jpg\",\"source\":\"\\/Uploads\\/2016-05-05\\/572a8dc461761.jpg\"}', '76');

-- ----------------------------
-- Table structure for infos
-- ----------------------------
DROP TABLE IF EXISTS `infos`;
CREATE TABLE `infos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT NULL,
  `school_id` int(10) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  `content` text,
  `dateline` int(10) DEFAULT NULL,
  `class_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='新闻';

-- ----------------------------
-- Records of infos
-- ----------------------------
INSERT INTO `infos` VALUES ('23', '135', '4', '个性', '明天缴学费', '1449549353', '69');
INSERT INTO `infos` VALUES ('19', '135', '5', '明天天气不错!', '准备带小朋友出去旅游', '1448001534', '69');
INSERT INTO `infos` VALUES ('22', '135', '4', '天天向上', '天天向上', '1448007153', '71');
INSERT INTO `infos` VALUES ('28', '154', '4', '11111111', '111111111111111', '1462540454', null);
INSERT INTO `infos` VALUES ('30', '170', '20', '明天出去玩吧', '玩一玩', '1463409521', null);

-- ----------------------------
-- Table structure for infos_img
-- ----------------------------
DROP TABLE IF EXISTS `infos_img`;
CREATE TABLE `infos_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data` char(150) DEFAULT NULL,
  `iid` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of infos_img
-- ----------------------------
INSERT INTO `infos_img` VALUES ('11', '{\"thumb\":\".\\/Uploads\\/2015-11-20\\/119_564ebffd4e4e8.jpg\",\"source\":\".\\/Uploads\\/2015-11-20\\/564ebffd4e4e8.jpg\"}', '19');
INSERT INTO `infos_img` VALUES ('25', '{\"thumb\":\".\\/Uploads\\/2015-12-08\\/119_56665e191e62c.jpg\",\"source\":\".\\/Uploads\\/2015-12-08\\/56665e191e62c.jpg\"}', '23');
INSERT INTO `infos_img` VALUES ('24', '{\"thumb\":\"\\/Uploads\\/2016-05-06\\/119_572c98a4c8f11.jpg\",\"source\":\"\\/Uploads\\/2016-05-06\\/572c98a4c8f11.jpg\"}', '28');
INSERT INTO `infos_img` VALUES ('26', '{\"thumb\":\"\\/Uploads\\/2016-05-06\\/119_572c98cf4469f.jpg\",\"source\":\"\\/Uploads\\/2016-05-06\\/572c98cf4469f.jpg\"}', '23');

-- ----------------------------
-- Table structure for knowledge
-- ----------------------------
DROP TABLE IF EXISTS `knowledge`;
CREATE TABLE `knowledge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `picture` varchar(255) NOT NULL DEFAULT '',
  `addtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of knowledge
-- ----------------------------
INSERT INTO `knowledge` VALUES ('1', null, '0-1岁百科', '', '0');

-- ----------------------------
-- Table structure for manage
-- ----------------------------
DROP TABLE IF EXISTS `manage`;
CREATE TABLE `manage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `manager` char(20) CHARACTER SET latin1 NOT NULL COMMENT '管理员帐号',
  `password` char(40) CHARACTER SET latin1 NOT NULL COMMENT '管理员密码',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '代理商地址',
  `pid` int(10) NOT NULL COMMENT '省',
  `cid` int(10) NOT NULL COMMENT '市',
  `aid` int(10) NOT NULL COMMENT '县/区',
  `rate` varchar(3) NOT NULL DEFAULT '0' COMMENT '收入利率',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '代理商姓名',
  `adv_coin` int(10) NOT NULL DEFAULT '0' COMMENT '广告收入',
  `article` int(10) NOT NULL DEFAULT '0' COMMENT '文章收入',
  `habit_coin` int(10) NOT NULL DEFAULT '0' COMMENT '习惯库收入',
  `total_coin` int(10) NOT NULL DEFAULT '0' COMMENT '总收入',
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '电话',
  `real_name` varchar(255) NOT NULL DEFAULT '' COMMENT '联系人',
  `mail` varchar(255) NOT NULL DEFAULT '' COMMENT '邮箱',
  `create` int(10) unsigned NOT NULL COMMENT '创建的时间',
  `last_login` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录的时间',
  `last_ip` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录的IP',
  `admin` varchar(20) NOT NULL DEFAULT 'admin' COMMENT '添加者',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manage
-- ----------------------------
INSERT INTO `manage` VALUES ('1', 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', '0', '0', '0', '', '不是代理23', '0', '0', '0', '0', '180043223', '英志223', 'dsaa@qq.com23', '1463244423', '1470205081', '2130706433', 'admin');
INSERT INTO `manage` VALUES ('23', 'testAdmin', '7c4a8d09ca3762af61e59520943dc26494f8941b', '3', '0', '0', '0', '0', '', '0', '0', '0', '0', '', '', '', '1463221127', '0', '0', 'admin');
INSERT INTO `manage` VALUES ('24', 'dailishang', '7c4a8d09ca3762af61e59520943dc26494f8941b', '南七家2', '0', '0', '0', '79', '衣英志代理商2', '948', '0', '0', '948', '18500635782', '衣英志2', '846828918@qq.com2', '1463228272', '0', '0', 'admin');
INSERT INTO `manage` VALUES ('26', '999', '7c4a8d09ca3762af61e59520943dc26494f8941b', '成都青洋区', '0', '0', '0', '10', '123', '52', '0', '0', '52', '15836952', '1233333', '6583205552@qq.com', '1468670434', '1468950109', '1987237174', 'admin');
INSERT INTO `manage` VALUES ('27', 'bbbbbb', '7c4a8d09ca3762af61e59520943dc26494f8941b', '--', '0', '0', '0', '100', 'bbbbbb', '0', '1', '0', '0', '13333333333', 'bbbbbb', 'aaaaa@aa.com', '1468672810', '1470193027', '2130706433', 'admin');
INSERT INTO `manage` VALUES ('34', 'zhangkui', '7c4a8d09ca3762af61e59520943dc26494f8941b', '河南省-信阳市-固始县', '16', '166', '1499', '', 'zhangkui', '10', '1', '0', '0', '111', 'zhangkui', '', '1469078265', '0', '0', 'admin');
INSERT INTO `manage` VALUES ('35', '111', '3f196cfb6c4cffe3002c0495a1bc822521b6aa36', '', '18', '193', '1719', '0', '1111', '0', '1', '0', '0', '111', '111111111', '', '1469081731', '0', '0', 'admin');

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT NULL,
  `cid` int(10) DEFAULT NULL,
  `read` tinyint(1) DEFAULT '0' COMMENT '是否阅读',
  `content` char(200) DEFAULT NULL,
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES ('1', '130', '137', '0', 'fdfddfdf', '1448590814');
INSERT INTO `message` VALUES ('2', '130', '113', '0', 'fdfddfdf', '1448590814');
INSERT INTO `message` VALUES ('3', '130', '113', '0', '过来', '1448591241');
INSERT INTO `message` VALUES ('4', '130', '114', '0', '测试', '1448593575');
INSERT INTO `message` VALUES ('5', '130', '114', '0', '测试一条', '1448603370');
INSERT INTO `message` VALUES ('6', '114', '130', '0', '路飞收...', '1448603534');
INSERT INTO `message` VALUES ('7', '130', '132', '0', '测试....', '1448603724');
INSERT INTO `message` VALUES ('8', '130', '113', '0', '你在哪里...', '1448605360');
INSERT INTO `message` VALUES ('9', '130', '114', '0', '还不回来?', '1448606206');
INSERT INTO `message` VALUES ('10', '114', '130', '0', '你是谁？', '1448608307');
INSERT INTO `message` VALUES ('11', '114', '137', '0', '你在哪里？', '1448611016');
INSERT INTO `message` VALUES ('12', '114', '137', '0', '快点回话?', '1448611043');
INSERT INTO `message` VALUES ('13', '114', '124', '0', '你快回来?', '1448611390');
INSERT INTO `message` VALUES ('14', '124', '116', '0', '过来', '1448612661');
INSERT INTO `message` VALUES ('15', '116', '124', '0', '你不过来？', '1448612815');
INSERT INTO `message` VALUES ('16', '124', '116', '0', '看我不打死你', '1448613068');
INSERT INTO `message` VALUES ('17', '116', '124', '0', 'GOGOGO!', '1448613299');
INSERT INTO `message` VALUES ('18', '115', '124', '0', '快到碗里来---', '1448613417');
INSERT INTO `message` VALUES ('19', '124', '115', '0', '你才到碗里去 (*v*)!', '1448613471');
INSERT INTO `message` VALUES ('20', '115', '112', '0', '我是谁？', '1448613790');
INSERT INTO `message` VALUES ('21', '115', '116', '0', '我是谁？', '1448613790');
INSERT INTO `message` VALUES ('22', '124', '130', '0', '你吼.', '1449050169');
INSERT INTO `message` VALUES ('23', '135', '136', '0', '33333', '1461968962');
INSERT INTO `message` VALUES ('24', '135', '138', '0', '我', '1461968991');
INSERT INTO `message` VALUES ('25', '114', '159', '0', 'dd', '1462252197');
INSERT INTO `message` VALUES ('26', '114', '124', '0', 'xbfdf', '1462252318');
INSERT INTO `message` VALUES ('27', '135', '159', '0', '333', '1462320254');
INSERT INTO `message` VALUES ('28', '154', '130', '0', '3333', '1462340318');
INSERT INTO `message` VALUES ('29', '154', '130', '0', '333', '1462438275');
INSERT INTO `message` VALUES ('30', '154', '159', '0', '320', '1462439127');
INSERT INTO `message` VALUES ('31', '154', '140', '0', '320', '1462439127');
INSERT INTO `message` VALUES ('32', '114', '159', '0', 'ddddd', '1462439339');
INSERT INTO `message` VALUES ('33', '114', '158', '0', 'ddddd', '1462439339');
INSERT INTO `message` VALUES ('34', '154', '159', '0', '333222222222222222222222222222', '1462439588');
INSERT INTO `message` VALUES ('35', '154', '140', '0', '333222222222222222222222222222', '1462439588');
INSERT INTO `message` VALUES ('36', '154', '131', '0', '1111', '1462798723');
INSERT INTO `message` VALUES ('37', '114', '141', '0', '哈哈哈哈', '1463296365');

-- ----------------------------
-- Table structure for nav
-- ----------------------------
DROP TABLE IF EXISTS `nav`;
CREATE TABLE `nav` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `text` char(20) DEFAULT NULL COMMENT '菜单名称',
  `url` char(20) NOT NULL DEFAULT '' COMMENT '//模块链接',
  `iconCls` char(20) NOT NULL COMMENT '//图标',
  `state` char(10) DEFAULT NULL COMMENT '菜单状态',
  `nid` int(10) DEFAULT '0' COMMENT '菜单层次',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of nav
-- ----------------------------
INSERT INTO `nav` VALUES ('1', '系统管理', '', 'icon-config', 'closed', '0');
INSERT INTO `nav` VALUES ('11', '学校管理', '', 'icon-school', 'closed', '0');
INSERT INTO `nav` VALUES ('3', '管理员管理', '/Manage/index', 'icon-admin', 'open', '1');
INSERT INTO `nav` VALUES ('4', '会员管理', '', 'icon-vip', 'closed', '0');
INSERT INTO `nav` VALUES ('5', '会员列表', '/User/index', 'icon-user', 'open', '4');
INSERT INTO `nav` VALUES ('12', '学校列表', '/School/index', 'icon-book', 'open', '11');
INSERT INTO `nav` VALUES ('10', '权限控制', '/AuthGroup/index', 'icon-suo', 'open', '1');
INSERT INTO `nav` VALUES ('14', '代理商', '', 'icon-user', 'closed', '0');
INSERT INTO `nav` VALUES ('15', '习惯作品', '/Habit/index', '', 'open', '14');
INSERT INTO `nav` VALUES ('16', '广告收入', '/Advert/index', '', 'open', '14');
INSERT INTO `nav` VALUES ('17', '全国代理', '/Agent/index', '', 'open', '14');
INSERT INTO `nav` VALUES ('18', '我的资料', '/Set/index', '', 'open', '14');
INSERT INTO `nav` VALUES ('19', '公司新闻', '/New/index', '', 'open', '14');
INSERT INTO `nav` VALUES ('20', '习惯库管理', '', 'icon-user', 'closed', '0');
INSERT INTO `nav` VALUES ('21', '习惯作品', '/Habit/lists', '', 'open', '20');
INSERT INTO `nav` VALUES ('22', '图书借阅管理', '', 'icon-book', 'closed', '0');
INSERT INTO `nav` VALUES ('23', '出版商管理', '/Publishing/index', '', 'open', '22');
INSERT INTO `nav` VALUES ('24', '书本库存管理', '/Stock/index', '', 'open', '22');
INSERT INTO `nav` VALUES ('25', '借书管理', '/Bookborrow/index', '', 'open', '22');
INSERT INTO `nav` VALUES ('26', '还书管理', '/Bookback/index', '', 'open', '22');

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '发布者ID',
  `title` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `see` int(10) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('1', '114', 'biaoti', '内容', '1002', '2016-07-20 16:29:14');
INSERT INTO `news` VALUES ('2', '1', '再来写一个新闻吧', '应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊。\n应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊。\n应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊。\n应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊应该多写点内容啊啊。\n', '18', '2016-07-21 16:40:32');

-- ----------------------------
-- Table structure for opus
-- ----------------------------
DROP TABLE IF EXISTS `opus`;
CREATE TABLE `opus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT NULL,
  `cid` int(10) DEFAULT NULL,
  `name` char(10) DEFAULT NULL,
  `school_id` int(10) DEFAULT NULL,
  `class_id` int(10) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  `content` text,
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of opus
-- ----------------------------
INSERT INTO `opus` VALUES ('23', '154', '25', '赵信', '4', '69', '333', '222222222222', '1462458826');
INSERT INTO `opus` VALUES ('22', '135', '37', '战五渣', '4', '69', '33333333333', '33333333333', '1462288208');
INSERT INTO `opus` VALUES ('24', '114', '25', '赵信', '4', '69', '赵信这个孩子啊', '废了', '1462678066');

-- ----------------------------
-- Table structure for opus_img
-- ----------------------------
DROP TABLE IF EXISTS `opus_img`;
CREATE TABLE `opus_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data` char(200) DEFAULT NULL,
  `oid` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of opus_img
-- ----------------------------
INSERT INTO `opus_img` VALUES ('40', '', '10');
INSERT INTO `opus_img` VALUES ('44', '{\"thumb\":\"\\/Uploads\\/2016-05-12\\/119_5734287ed18a0.jpg\",\"unfold\":\"\\/Uploads\\/2016-05-12\\/600_5734287ed18a0.jpg\",\"source\":\"\\/Uploads\\/2016-05-12\\/5734287ed18a0.jpg\"}', '24');
INSERT INTO `opus_img` VALUES ('37', '{\"thumb\":\"\\/Uploads\\/2016-05-05\\/119_572b5c97d6f33.png\",\"unfold\":\"\\/Uploads\\/2016-05-05\\/600_572b5c97d6f33.png\",\"source\":\"\\/Uploads\\/2016-05-05\\/572b5c97d6f33.png\"}', '23');
INSERT INTO `opus_img` VALUES ('36', '{\"thumb\":\"\\/Uploads\\/2016-05-05\\/119_572b59c838fe7.jpg\",\"unfold\":\"\\/Uploads\\/2016-05-05\\/600_572b59c838fe7.jpg\",\"source\":\"\\/Uploads\\/2016-05-05\\/572b59c838fe7.jpg\"}', '23');
INSERT INTO `opus_img` VALUES ('33', '{\"thumb\":\"\\/Uploads\\/2016-05-03\\/119_5728bf4eb5ec3.jpg\",\"unfold\":\"\\/Uploads\\/2016-05-03\\/600_5728bf4eb5ec3.jpg\",\"source\":\"\\/Uploads\\/2016-05-03\\/5728bf4eb5ec3.jpg\"}', '22');
INSERT INTO `opus_img` VALUES ('34', '{\"thumb\":\"\\/Uploads\\/2016-05-04\\/119_57293c9ca3f01.jpg\",\"unfold\":\"\\/Uploads\\/2016-05-04\\/600_57293c9ca3f01.jpg\",\"source\":\"\\/Uploads\\/2016-05-04\\/57293c9ca3f01.jpg\"}', '22');

-- ----------------------------
-- Table structure for pay_articles
-- ----------------------------
DROP TABLE IF EXISTS `pay_articles`;
CREATE TABLE `pay_articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL DEFAULT '0' COMMENT '文章ID',
  `coin` int(11) NOT NULL DEFAULT '0' COMMENT '能量币',
  `teacher_id` int(11) NOT NULL DEFAULT '0',
  `school_id` int(11) NOT NULL DEFAULT '0',
  `class_id` int(11) NOT NULL DEFAULT '0',
  `student_id` int(11) NOT NULL DEFAULT '0' COMMENT '学生ID',
  `is_pay` int(1) NOT NULL DEFAULT '0' COMMENT '是否支付 0=》未支付 1=》支付成功',
  `pay_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '支付时间',
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `school_id` (`school_id`),
  KEY `student_id` (`student_id`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_articles
-- ----------------------------
INSERT INTO `pay_articles` VALUES ('1', '27', '1000', '114', '4', '69', '25', '1', '0000-00-00 00:00:00');
INSERT INTO `pay_articles` VALUES ('2', '15', '99', '114', '4', '69', '25', '1', '2016-05-07 20:04:42');

-- ----------------------------
-- Table structure for pay_article_list
-- ----------------------------
DROP TABLE IF EXISTS `pay_article_list`;
CREATE TABLE `pay_article_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `pay_child_id` int(11) NOT NULL DEFAULT '0' COMMENT '支付学生ID',
  `pay_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pay_coin` int(11) NOT NULL DEFAULT '0' COMMENT '支付能量币',
  `teacher_id` int(11) NOT NULL DEFAULT '0' COMMENT '老师的用户ID',
  `total_coin` int(11) NOT NULL DEFAULT '0' COMMENT '累计赚取能量币',
  `class_id` int(11) NOT NULL DEFAULT '0' COMMENT '班级ID',
  `school_id` int(11) NOT NULL DEFAULT '0' COMMENT '园内数据',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_article_list
-- ----------------------------
INSERT INTO `pay_article_list` VALUES ('1', '27', '114', '39', '2016-05-10 21:18:24', '1000', '114', '1000', '0', '0');
INSERT INTO `pay_article_list` VALUES ('2', '27', '115', '35', '2016-05-10 21:18:26', '100', '114', '1100', '0', '0');
INSERT INTO `pay_article_list` VALUES ('3', '27', '116', '36', '2016-05-10 21:18:29', '100', '114', '1200', '0', '0');
INSERT INTO `pay_article_list` VALUES ('4', '27', '124', '37', '2016-05-10 21:18:32', '100', '114', '1300', '0', '0');

-- ----------------------------
-- Table structure for points
-- ----------------------------
DROP TABLE IF EXISTS `points`;
CREATE TABLE `points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `integral` smallint(6) DEFAULT '0' COMMENT '当天产生积分数',
  `is_report` tinyint(1) DEFAULT '0' COMMENT '是否当天已经报道 1=》是 0=》否',
  `all_integral` int(10) DEFAULT '0' COMMENT '总额',
  `reporttime` int(11) DEFAULT NULL COMMENT '报到时间',
  `updatetime` int(11) DEFAULT NULL COMMENT '报道类型积分产生时间',
  `addtime` int(11) DEFAULT NULL COMMENT '产生积分时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of points
-- ----------------------------
INSERT INTO `points` VALUES ('1', '116', '1', '0', '3', '1462326415', '1462326415', '1462326231');
INSERT INTO `points` VALUES ('2', '149', '1', '1', '2', '1462760221', '1462760221', '1462434740');

-- ----------------------------
-- Table structure for publishing
-- ----------------------------
DROP TABLE IF EXISTS `publishing`;
CREATE TABLE `publishing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ISBN` varchar(20) DEFAULT NULL,
  `pubname` varchar(30) DEFAULT NULL,
  `address` varchar(120) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `contacts` varchar(30) DEFAULT NULL COMMENT '联系人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of publishing
-- ----------------------------
INSERT INTO `publishing` VALUES ('1', '7-115', '清华出版社', '北京', '15151515151', '43243242', '876548@qq.com', '王社长');
INSERT INTO `publishing` VALUES ('2', '7-111', '机械工业出版', '江苏', '15151515151', '432355', '43454@qq.com', '李社长');
INSERT INTO `publishing` VALUES ('3', '7-121', '人民邮电出版社', '湖北', '15151515151', '434525', '987987@qq.com', '赵社长');
INSERT INTO `publishing` VALUES ('4', '100', '商务印书馆 ', '北京市-北京市-西城区', '15031234341', '43543543', '43243252@qq.com', '赵馆长');

-- ----------------------------
-- Table structure for result
-- ----------------------------
DROP TABLE IF EXISTS `result`;
CREATE TABLE `result` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT NULL,
  `name` char(10) DEFAULT NULL COMMENT '//科目名',
  `school_id` int(10) DEFAULT NULL,
  `class_id` int(10) DEFAULT NULL,
  `score` float(4,1) DEFAULT NULL,
  `dateline` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of result
-- ----------------------------
INSERT INTO `result` VALUES ('12', '116', '生物', '4', '69', '99.0', '1448985600');
INSERT INTO `result` VALUES ('3', '130', '语文', '4', '70', '58.0', '1446566400');
INSERT INTO `result` VALUES ('4', '115', '数学', '4', '69', '92.5', '1446480000');
INSERT INTO `result` VALUES ('5', '115', '语文', '4', '69', '95.5', '1462204800');
INSERT INTO `result` VALUES ('6', '129', '化学', '5', '71', '12.0', '1446652800');
INSERT INTO `result` VALUES ('9', '131', '语文', '4', '69', '95.0', '1448899200');
INSERT INTO `result` VALUES ('10', '134', '英语', '4', '69', '29.0', '1448985600');
INSERT INTO `result` VALUES ('11', '136', '化学', '4', '69', '99.0', '1450886400');
INSERT INTO `result` VALUES ('13', '131', '', '4', '69', '0.0', '0');
INSERT INTO `result` VALUES ('14', '134', '3', '4', '69', '100.0', '1461945600');
INSERT INTO `result` VALUES ('15', '136', '3333', '4', '69', '100.0', '1461945600');
INSERT INTO `result` VALUES ('16', '25', '3333', null, null, '666.0', '1461168000');
INSERT INTO `result` VALUES ('17', '25', '3333', null, null, '666.0', '1461168000');
INSERT INTO `result` VALUES ('18', '25', '3333', null, null, '666.0', '1461168000');
INSERT INTO `result` VALUES ('19', '25', '3333', null, null, '666.0', '1461168000');
INSERT INTO `result` VALUES ('20', '1', '333', null, null, '333.0', '1462204800');

-- ----------------------------
-- Table structure for school
-- ----------------------------
DROP TABLE IF EXISTS `school`;
CREATE TABLE `school` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `agent` varchar(20) NOT NULL COMMENT '代理商',
  `name` char(20) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `content` text,
  `cover` varchar(50) DEFAULT NULL,
  `is_up` tinyint(1) DEFAULT '0',
  `mobile` char(11) DEFAULT NULL,
  `dateline` char(10) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of school
-- ----------------------------
INSERT INTO `school` VALUES ('4', 'admin', '建湖县2222', '重庆沙坪坝区', 'Marvel公司的历史可以追溯到1939年。当时公司名\n漫威333\n为及时漫画（Timely Comics）；1951年更名为亚特拉斯漫画（Atlas Comics），而在1961年正式更名为Marvel Comics，并确定了正式的标记：在漫画封面的左上角，设置一个长方框，里面有着当期主角的形象，下面是“Marvel Comics Group”的字样。因为Marvel有“惊奇、奇迹”的意思，所以在中国一度被称为“惊奇漫画”，2010年9月Marvel将中文名称正式定为“漫威”。2011年4月29日，在第七届中国国际动漫产业博览会B馆漫威展区里，Marvel宣布其中文名“漫威”正式登陆中国。\n漫威的创立者是出版商马丁·古德曼，古德曼早先致力于创办通俗杂志，题材涵盖西部故事、侦探、冒险和科幻等许多方面。到1938年，他决定寻找新的发展方向——新奇，华丽，还要有引人入胜的激烈场面——漫画正是这样的东西。尽管当时DC漫画公司已经抢得了先机，推出了两大王牌角色超人和蝙蝠侠，不过凭借新奇的点子和精彩的创意，漫威还是独辟蹊径，创造出了令人难忘的新角色。\n1939年，一本叫做《Motion Pictures Funnies Weekly》的漫画在电影院作为赠品发行，Namor the Sub-Mariner（海王子纳摩）在其中初次登场。他是人类与鱼类的结合体，可以在水下生活。这是漫威的第一位超级英雄——比公司的成立还要早半年。之后，这个故事经过少许扩展，被重新收录在一个新出版的系列中。而这个新的漫画刊物的名字将成就一个漫画帝国的英名——《Marvel Comics》。', './Uploads/2015-12-08/56664a3dc26b3.jpg', '1', '15216232151', '1447641710', null, null);
INSERT INTO `school` VALUES ('5', 'admin', '爱宝宝幼儿园', '北京市朝阳区天门外', null, null, '1', '15213251268', '1447641801', null, null);
INSERT INTO `school` VALUES ('25', 'admin', '11111', '111111111111111', null, null, '1', '15123036810', '1469000338', null, null);
INSERT INTO `school` VALUES ('20', 'admin', '小衣学校', '小衣学校地址', null, null, '1', '18500635780', '1463405777', null, null);
INSERT INTO `school` VALUES ('24', 'admin', ' 湖屋学校', ' 湖屋学校', null, null, '1', '15123036850', '1468673224', null, null);
INSERT INTO `school` VALUES ('27', 'admin', 'qwrqr', '山西省-太原市-迎泽区', null, null, '1', '15606093673', '1469082459', null, null);
INSERT INTO `school` VALUES ('28', 'bbbbbb', 'wrqwrqw', '山西省-阳泉市-平定县', null, null, '1', '15606093674', '1469082729', null, null);

-- ----------------------------
-- Table structure for score_record
-- ----------------------------
DROP TABLE IF EXISTS `score_record`;
CREATE TABLE `score_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `article_id` int(11) DEFAULT '0',
  `addtime` int(11) DEFAULT '0',
  `is_do` char(4) DEFAULT '',
  `daytime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of score_record
-- ----------------------------
INSERT INTO `score_record` VALUES ('2', '149', '27', '1469032707', 'Y', '1468972818');
INSERT INTO `score_record` VALUES ('3', '149', '27', '1469105091', 'N', '1469059269');
INSERT INTO `score_record` VALUES ('4', '25', '27', '1469106887', 'N', '1469059200');
INSERT INTO `score_record` VALUES ('5', '25', '27', '1469106940', 'N', '1469059200');
INSERT INTO `score_record` VALUES ('6', '25', '27', '1469107045', 'N', '1469059200');
INSERT INTO `score_record` VALUES ('7', '25', '27', '1469107546', 'N', '1469059200');
INSERT INTO `score_record` VALUES ('8', '25', '27', '1469107930', 'N', '1469059200');
INSERT INTO `score_record` VALUES ('9', '25', '27', '1469108426', 'N', '1469059200');
INSERT INTO `score_record` VALUES ('10', '25', '27', '1469110853', 'N', '1469059200');
INSERT INTO `score_record` VALUES ('11', '25', '27', '1469160682', 'Y', '1469145600');
INSERT INTO `score_record` VALUES ('12', '25', '27', '1469161886', 'Y', '1469145600');
INSERT INTO `score_record` VALUES ('13', '25', '27', '1469163800', 'Y', '1469145600');
INSERT INTO `score_record` VALUES ('14', '25', '27', '1469168584', 'N', '1469145600');
INSERT INTO `score_record` VALUES ('15', '25', '27', '1469168755', 'Y', '1469145600');
INSERT INTO `score_record` VALUES ('16', '25', '27', '1469169286', 'N', '1469145600');
INSERT INTO `score_record` VALUES ('17', '25', '27', '1469171466', 'Y', '1469145600');

-- ----------------------------
-- Table structure for showm
-- ----------------------------
DROP TABLE IF EXISTS `showm`;
CREATE TABLE `showm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `child_id` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(50) DEFAULT NULL,
  `picture` varchar(255) NOT NULL DEFAULT '',
  `addtime` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL DEFAULT '',
  `school_id` int(11) DEFAULT NULL,
  `class_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of showm
-- ----------------------------
INSERT INTO `showm` VALUES ('1', '25', null, '', '0', '手工', null, '69');
INSERT INTO `showm` VALUES ('2', '25', null, '', '0', '制作', null, '69');

-- ----------------------------
-- Table structure for story
-- ----------------------------
DROP TABLE IF EXISTS `story`;
CREATE TABLE `story` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT NULL,
  `school_id` int(10) DEFAULT NULL,
  `title` char(20) DEFAULT NULL,
  `url` char(100) DEFAULT NULL,
  `content` text,
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='求知与展示';

-- ----------------------------
-- Records of story
-- ----------------------------
INSERT INTO `story` VALUES ('26', '135', '4', '333333333', 'http://www.dayanzai.me/axure-rp-pro.html', '33333333333', '1462320330');
INSERT INTO `story` VALUES ('27', '154', '4', '666', 'http://www.dayanzai.me/axure-rp-pro.html', '333', '1462406575');

-- ----------------------------
-- Table structure for story_img
-- ----------------------------
DROP TABLE IF EXISTS `story_img`;
CREATE TABLE `story_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data` char(200) DEFAULT NULL,
  `sid` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of story_img
-- ----------------------------
INSERT INTO `story_img` VALUES ('41', '{\"thumb\":\"\\/Uploads\\/2016-05-04\\/119_57293cbd56a15.jpg\",\"unfold\":\"\\/Uploads\\/2016-05-04\\/600_57293cbd56a15.jpg\",\"source\":\"\\/Uploads\\/2016-05-04\\/57293cbd56a15.jpg\"}', '26');
INSERT INTO `story_img` VALUES ('46', '{\"thumb\":\"\\/Uploads\\/2016-05-05\\/119_572b599cee79f.png\",\"unfold\":\"\\/Uploads\\/2016-05-05\\/600_572b599cee79f.png\",\"source\":\"\\/Uploads\\/2016-05-05\\/572b599cee79f.png\"}', '27');
INSERT INTO `story_img` VALUES ('45', '{\"thumb\":\"\\/Uploads\\/2016-05-05\\/119_572a8dae03a4a.jpg\",\"unfold\":\"\\/Uploads\\/2016-05-05\\/600_572a8dae03a4a.jpg\",\"source\":\"\\/Uploads\\/2016-05-05\\/572a8dae03a4a.jpg\"}', '27');
INSERT INTO `story_img` VALUES ('47', '{\"thumb\":\"\\/Uploads\\/2016-05-05\\/119_572b59f510516.jpg\",\"unfold\":\"\\/Uploads\\/2016-05-05\\/600_572b59f510516.jpg\",\"source\":\"\\/Uploads\\/2016-05-05\\/572b59f510516.jpg\"}', '27');

-- ----------------------------
-- Table structure for teacher
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT NULL,
  `school_id` int(10) DEFAULT NULL,
  `class_id` int(10) DEFAULT NULL,
  `content` char(200) DEFAULT NULL,
  `name` char(10) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `birthday` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teacher
-- ----------------------------
INSERT INTO `teacher` VALUES ('2', '114', '4', '69', '世界名牌大学毕业', '李老师', '1', '1423929600');
INSERT INTO `teacher` VALUES ('3', '141', '4', '71', '世界第一大学毕业', '刘老师', '0', '1424793600');
INSERT INTO `teacher` VALUES ('4', '142', '4', '71', '大专毕业', '方老师', '1', '653846400');
INSERT INTO `teacher` VALUES ('5', '143', '4', '73', '其实，纳摩并不像超级英雄，反倒像是英雄们常常对抗的怪物。他父亲是人类，母亲是水下世界的公主。半人半鱼的他不仅外貌怪异，其行为也颇值得推敲：长大成人的纳摩因为他那美丽的王国被毁', '华老师', '1', '1424793600');
INSERT INTO `teacher` VALUES ('6', '160', '4', '69', 'wodememe', 'ceshi8', '1', '-69235200');
INSERT INTO `teacher` VALUES ('7', '161', '4', '70', 'asdf', 'ceshi9', '1', '589734000');
INSERT INTO `teacher` VALUES ('8', null, '20', '77', 'asdasdas', '测试老师', '1', '0');
INSERT INTO `teacher` VALUES ('9', '193', '4', '69', null, 'test', '1', null);

-- ----------------------------
-- Table structure for tuition
-- ----------------------------
DROP TABLE IF EXISTS `tuition`;
CREATE TABLE `tuition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) DEFAULT NULL COMMENT '班级id',
  `tuition` smallint(6) DEFAULT NULL COMMENT '学费',
  `year` varchar(4) CHARACTER SET utf8 DEFAULT NULL COMMENT '年份',
  `term` tinyint(1) DEFAULT NULL COMMENT '学期 1=》第一学期 2=》第二学期',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tuition
-- ----------------------------
INSERT INTO `tuition` VALUES ('7', '69', '300', '2016', '1', '1463035357');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick_name` char(10) DEFAULT NULL COMMENT '姓名',
  `user` char(20) DEFAULT NULL,
  `password` char(40) DEFAULT NULL,
  `mobile` char(20) DEFAULT NULL,
  `email` char(50) DEFAULT NULL,
  `cover` char(200) DEFAULT NULL,
  `rule1_name` char(10) DEFAULT '爸爸',
  `class_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `rule2_name` char(10) DEFAULT '妈妈',
  `f_cover` char(200) DEFAULT NULL,
  `m_cover` char(200) DEFAULT NULL,
  `group_id` tinyint(1) DEFAULT '4',
  `sex` tinyint(1) DEFAULT '0',
  `state` tinyint(1) DEFAULT '1' COMMENT '//人员状态，在读还是毕业,0为毕业',
  `one` tinyint(1) DEFAULT '0' COMMENT '//是否重未登陆0为是1为否',
  `birthday` int(10) DEFAULT NULL,
  `reg_time` int(10) NOT NULL,
  `last_login` int(10) DEFAULT NULL,
  `last_ip` int(10) DEFAULT NULL,
  `f_mobile` char(20) DEFAULT NULL,
  `m_mobile` char(20) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('114', '老师', '123', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13718720398', '469675010@qq.com', '{\"big\":\".\\/Uploads\\/face\\/114.jpg\",\"small\":\".\\/Uploads\\/face\\/114_small.jpg\"}', '大王', '71', '5', '小王', null, null, '3', '0', '1', '1', '632592000', '1445651915', '1468850712', '1987404239', null, null, null);
INSERT INTO `user` VALUES ('115', '院长', '456', '7c4a8d09ca3762af61e59520943dc26494f8941b', '456', '4696701010@qq.com', '{\"big\":\".\\/Uploads\\/face\\/115.jpg\",\"small\":\".\\/Uploads\\/face\\/115_small.jpg\"}', '电光', '69', '5', '神光', null, null, '2', '1', '1', '1', '632592000', '1445740994', '1464141768', '2130706433', '13266816551', '15626154412', null);
INSERT INTO `user` VALUES ('116', '清风', '15215162348', '7c4a8d09ca3762af61e59520943dc26494f8941b', '15215162348', '', null, '明月', '69', '4', '水心', null, null, '4', '1', '1', '1', '1424793600', '1446168130', '1448613112', '2130706433', '15625112211', '13255116541', null);
INSERT INTO `user` VALUES ('124', '香妃', '15215163256', '7c4a8d09ca3762af61e59520943dc26494f8941b', '15215163256', '46965482@qq.com', '{\"big\":\".\\/Uploads\\/face\\/124.jpg\",\"small\":\".\\/Uploads\\/face\\/124_small.jpg\"}', '', '69', '4', '', null, null, '2', '0', '1', '1', '1423929600', '1447659865', '1449018584', '2130706433', null, null, null);
INSERT INTO `user` VALUES ('129', '云中歌', '15215162358', '7c4a8d09ca3762af61e59520943dc26494f8941b', '15215162358', '4652358@qq.com', '{\"big\":\".\\/Uploads\\/face\\/129.jpg\",\"small\":\".\\/Uploads\\/face\\/129_small.jpg\"}', '飞飞1', '71', '5', '飞飞2', null, null, '4', '0', '1', '0', '1424966400', '1447664757', '1468729412', '2147483647', null, null, null);
INSERT INTO `user` VALUES ('130', '路飞', '15215163258', '7c4a8d09ca3762af61e59520943dc26494f8941b', '15215163258', '', '{\"big\":\".\\/Uploads\\/face\\/130.jpg\",\"small\":\".\\/Uploads\\/face\\/130_small.jpg\"}', '山治', '70', '4', '娜美', null, null, '4', '1', '1', '1', '1423929600', '1447747589', '1449127035', '2130706433', null, null, null);
INSERT INTO `user` VALUES ('131', '战五渣', '15213263584', '7c4a8d09ca3762af61e59520943dc26494f8941b', '15213263584', '', null, '战役', '69', '4', '圣战', null, null, '4', '1', '1', '1', '1424793600', '1447826549', '1449126238', '2130706433', null, null, null);
INSERT INTO `user` VALUES ('135', 'admin', 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', '15123036810', '910804085@qq.com', '{\"big\":\".\\/Uploads\\/face\\/135.jpg\",\"small\":\".\\/Uploads\\/face\\/135_small.jpg\"}', '', '73', '4', '', null, null, '2', '1', '1', '1', '1423929600', '1447896743', '1468988654', '1987237174', null, null, null);
INSERT INTO `user` VALUES ('140', '李老师', '15215132123', '7c4a8d09ca3762af61e59520943dc26494f8941b', '15215132123', '65232548@qq.com', '{\"big\":\".\\/Uploads\\/face\\/140.jpg\",\"small\":\".\\/Uploads\\/face\\/140_small.jpg\"}', '爸爸', '69', '4', '妈妈', null, null, '3', '1', '1', '1', '1423929600', '1448852666', '1449473692', '2130706433', null, null, null);
INSERT INTO `user` VALUES ('141', '刘老师', '13216235842', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13216235842', 'dgfgfhj@qq.com', '{\"big\":\".\\/Uploads\\/face\\/141.jpg\",\"small\":\".\\/Uploads\\/face\\/141_small.jpg\"}', '爸爸', '70', '4', '妈妈', null, null, '3', '0', '1', '0', '1424793600', '1448852697', '1449473747', '2130706433', null, null, null);
INSERT INTO `user` VALUES ('142', '方老师', '15232632158', '7c4a8d09ca3762af61e59520943dc26494f8941b', '15232632158', 'hhgjh@qq.com', null, '爸爸', '73', '4', '妈妈', null, null, '3', '1', '1', '1', '653846400', '1448852734', '1449126068', '2130706433', null, null, null);
INSERT INTO `user` VALUES ('143', '华老师', '15215162321', '7c4a8d09ca3762af61e59520943dc26494f8941b', '15215162321', '5523@qq.com', '{\"big\":\".\\/Uploads\\/face\\/143.jpg\",\"small\":\".\\/Uploads\\/face\\/143_small.jpg\"}', '爸爸', '73', '4', '妈妈', null, null, '3', '1', '1', '0', '1424793600', '1449127390', '1467359846', '1971863451', null, null, null);
INSERT INTO `user` VALUES ('146', '晓龙龙', '15624501317', '7c4a8d09ca3762af61e59520943dc26494f8941b', '15624501317', null, null, '爸爸', '71', '5', '妈妈', null, null, '4', '0', '1', '0', null, '1455105559', '1455497471', '466712729', null, null, null);
INSERT INTO `user` VALUES ('148', '三十六', '13260446055', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13260446055', null, null, '爸爸', '71', '5', '妈妈', null, null, '4', '0', '1', '0', null, '1455191781', '1455191915', '2095960775', null, null, null);
INSERT INTO `user` VALUES ('149', 'youer', '15123036810', '7c4a8d09ca3762af61e59520943dc26494f8941b', '15123036810', null, null, '爸爸', '70', '4', '妈妈', null, null, '4', '0', '1', '1', null, '1455344638', '1469359597', '0', null, null, null);
INSERT INTO `user` VALUES ('150', '车厚德爸爸', '13770209899', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13770209899', null, null, '爸爸', '71', '5', '妈妈', null, null, '4', '0', '1', '0', null, '1455508763', '1462161209', '2130706433', null, null, null);
INSERT INTO `user` VALUES ('151', '小龙哥', '13181038186', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13181038186', null, null, '爸爸', '71', '5', '妈妈', null, null, '4', '0', '1', '0', null, '1458033425', '1458045104', '2147483647', null, null, null);
INSERT INTO `user` VALUES ('152', 'Marks', '13266816551', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13266816551', null, null, '爸爸', '69', '4', '妈妈', null, null, '4', '0', '1', '0', null, '1459762470', '1459762473', '1856816913', null, null, null);
INSERT INTO `user` VALUES ('153', '华仔', '15557173016', '7c4a8d09ca3762af61e59520943dc26494f8941b', '15557173016', null, null, '爸爸', '69', '4', '妈妈', null, null, '4', '0', '1', '0', null, '1461115634', '1461118733', '2147483647', null, null, null);
INSERT INTO `user` VALUES ('154', 'ceshi1', '18259120457', '7c4a8d09ca3762af61e59520943dc26494f8941b', '18259120457', '18259120457@qq.com', null, '', '69', '4', '', null, null, '3', '0', '1', '1', '0', '1461998571', '1463784320', '1996787061', null, null, null);
INSERT INTO `user` VALUES ('155', 'er', '18259120456', '7c4a8d09ca3762af61e59520943dc26494f8941b', '18259120456', 'fr@qq.com', null, '', '69', '4', '', null, null, '3', '0', '1', '0', '0', '1462001008', '1463748711', '1928522492', null, null, null);
INSERT INTO `user` VALUES ('156', 'ceshi2', '18259120455', '7c4a8d09ca3762af61e59520943dc26494f8941b', '18259120455', 'e@qq.com', null, '', '69', '4', '', null, null, '3', '0', '1', '0', '0', '1462001615', null, null, null, null, null);
INSERT INTO `user` VALUES ('157', 'ceshi3', '18259120454', '7c4a8d09ca3762af61e59520943dc26494f8941b', '18259120454', 'w@qq.com', null, '', '69', '4', '', null, null, '3', '0', '1', '0', '0', '1462001672', null, null, null, null, null);
INSERT INTO `user` VALUES ('158', 'ceshi4', '18259120453', '7c4a8d09ca3762af61e59520943dc26494f8941b', '18259120453', '', null, '', '69', '4', '', null, null, '2', '0', '1', '0', '0', '1462002038', '1463201699', '2147483647', null, null, null);
INSERT INTO `user` VALUES ('159', 'ceshi6', '15215263746', '7c4a8d09ca3762af61e59520943dc26494f8941b', '18259120451', '', null, '', '69', '4', '', null, null, '2', '0', '1', '0', '0', '1462002824', '1462977295', '2130706433', null, null, null);
INSERT INTO `user` VALUES ('160', 'ceshi8', '18259120450', '7c4a8d09ca3762af61e59520943dc26494f8941b', '18259120450', '', null, '爸爸', '69', '4', '妈妈', null, null, '3', '1', '1', '0', '-69235200', '1462010903', null, null, null, null, null);
INSERT INTO `user` VALUES ('161', 'ceshi9', '18259120459', '7c4a8d09ca3762af61e59520943dc26494f8941b', '18259120459', '', null, '爸爸', '70', '4', '妈妈', null, null, '3', '1', '1', '0', '589734000', '1462011218', '1462011248', '2130706433', null, null, null);
INSERT INTO `user` VALUES ('163', '这种情况', '13718886526', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13718886526', null, null, '爸爸', '69', '4', '妈妈', null, null, '4', '0', '1', '0', null, '1462764063', '1462764091', '2147483647', null, null, null);
INSERT INTO `user` VALUES ('164', 'test', '13962214729', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13962214729', null, null, '爸爸', '71', '5', '妈妈', null, null, '4', '0', '1', '0', null, '1462793592', '1462794278', '613762278', null, null, null);
INSERT INTO `user` VALUES ('166', '123456', '18883186588', '7c4a8d09ca3762af61e59520943dc26494f8941b', '18883186588', '', null, '', '71', '5', '', null, null, '2', '0', '1', '0', '1462377600', '1462802870', '1468729315', '2147483647', null, null, null);
INSERT INTO `user` VALUES ('167', 'Robert', '15951610685', '7c4a8d09ca3762af61e59520943dc26494f8941b', '15951610685', '123@qq.com', null, '未登记', '71', '5', '未登记', null, null, '4', '1', '1', '0', '1462809600', '1462849310', '1463547865', '2147483647', null, null, null);
INSERT INTO `user` VALUES ('173', '小衣老师', 'xiaoyilaoshi', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13718722032', 'aasas@q.q', null, '', '76', '20', '', null, null, '3', '1', '1', '0', '0', '1463408211', '1463408795', '2147483647', null, null, null);
INSERT INTO `user` VALUES ('174', '小二老师', 'xiaoerlaoshi', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13311332323', 'dfsfa@qq.com', null, '', '77', '20', '', null, null, '3', '0', '1', '0', '0', '1463408252', '1463408497', '2147483647', null, null, null);
INSERT INTO `user` VALUES ('175', '小衣学生1', '13233224523', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13233224523', 'ddaa@qq.com', null, '', '76', '20', '', null, null, '4', '1', '1', '0', '0', '1463408290', '1463814710', '1875325782', null, null, null);
INSERT INTO `user` VALUES ('176', '小衣学生2', '13134323223', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13134323223', 'dasaa@qq.com', null, '', '76', '20', '', null, null, '4', '1', '1', '0', '0', '1463408324', null, null, null, null, null);
INSERT INTO `user` VALUES ('177', '小二学生1', '13322332998', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13322332998', 'feew@qq.com', null, '', '77', '20', '', null, null, '4', '0', '1', '0', '0', '1463408360', null, null, null, null, null);
INSERT INTO `user` VALUES ('178', '小二学生2', '13722234398', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13722234398', 'fdsjhkdjsh@qq.com', null, '', '77', '20', '', null, null, '4', '1', '1', '0', '0', '1463408387', null, null, null, null, null);
INSERT INTO `user` VALUES ('180', '新老师', '13718720569', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13718720569', '434334@qq.com', null, '', '69', '4', '', null, null, '3', '1', '1', '0', '0', '1463666402', null, null, null, null, null);
INSERT INTO `user` VALUES ('181', '新老师', '13718723230', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13718723230', 'dfasasd@qq.com', null, '', '69', '4', '', null, null, '3', '1', '1', '0', '0', '1463666462', null, null, null, null, null);
INSERT INTO `user` VALUES ('182', '新老师', '15318749082', '7c4a8d09ca3762af61e59520943dc26494f8941b', '15318749082', 'fsfdssa@qq.com', null, '', '69', '4', '', null, null, '3', '1', '1', '0', '0', '1463666515', null, null, null, null, null);
INSERT INTO `user` VALUES ('183', 'laoshiaaaa', '13718720380', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13718720380', 'sdfsdds@qq.com', null, '', '70', '4', '', null, null, '3', '1', '1', '0', '0', '1463666622', null, null, null, null, null);
INSERT INTO `user` VALUES ('184', 'laoshiaaaa', '13718720399', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13718720399', 'dasadasd@qq.com', null, '', '71', '5', '', null, null, '3', '1', '1', '0', '0', '1463666705', null, null, null, null, null);
INSERT INTO `user` VALUES ('185', 'laoshi123', '13718720999', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13718720999', 'dsasaa@qq.com', null, '', '73', '4', '', null, null, '3', '1', '1', '0', '0', '1463666757', null, null, null, null, null);
INSERT INTO `user` VALUES ('186', '天才老师', '13863723241', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13863723241', 'feadaa@qq.com', null, '', '71', '5', '', null, null, '3', '1', '1', '0', '0', '1463666845', null, null, null, null, null);
INSERT INTO `user` VALUES ('188', '我是老师啊', '13718743235', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13718743235', '32233223@qq.com', null, '', '73', '4', '', null, null, '3', '1', '1', '0', '0', '1463666988', null, null, null, null, null);
INSERT INTO `user` VALUES ('189', '天才一班老师', '18900354321', '7c4a8d09ca3762af61e59520943dc26494f8941b', '18900354321', 'ddasdas@qq.com', null, '', '69', '4', '', null, null, '3', '1', '1', '0', '0', '1463667601', null, null, null, null, null);
INSERT INTO `user` VALUES ('190', '阿宝', '18301811239', '7c4a8d09ca3762af61e59520943dc26494f8941b', '18301811239', null, null, '爸爸', '73', '4', '妈妈', null, null, '4', '0', '1', '0', null, '1464173705', '1464174077', '1883350234', null, null, null);
INSERT INTO `user` VALUES ('192', 'tester', 'tester', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13723452345', null, null, '爸爸', '71', '5', '妈妈', null, null, '3', '0', '1', '0', null, '1468292571', '1468647457', '2147483647', null, null, '80');
INSERT INTO `user` VALUES ('193', 'test', '13333333333', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13333333333', 'admin@qq.com', null, '', '69', '4', '', null, null, '4', '1', '1', '0', '0', '1468672288', null, null, null, null, null);

-- ----------------------------
-- Table structure for user_sign
-- ----------------------------
DROP TABLE IF EXISTS `user_sign`;
CREATE TABLE `user_sign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(30) NOT NULL DEFAULT '',
  `day` int(11) NOT NULL DEFAULT '0',
  `register_date` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_sign
-- ----------------------------
INSERT INTO `user_sign` VALUES ('1', '13266816551', '1455206400', '1455286456');
INSERT INTO `user_sign` VALUES ('2', '15624501317', '1455206400', '1455286507');
INSERT INTO `user_sign` VALUES ('3', '15123036810', '1455292800', '1455372645');
INSERT INTO `user_sign` VALUES ('4', '13770209899', '1455465600', '1455516636');
INSERT INTO `user_sign` VALUES ('5', '15123036810', '1455897600', '1455964665');
INSERT INTO `user_sign` VALUES ('6', '15123036810', '1455984000', '1456028037');
INSERT INTO `user_sign` VALUES ('7', '15123036810', '1460908800', '1460957433');
INSERT INTO `user_sign` VALUES ('8', '15123036810', '1461081600', '1461119220');
INSERT INTO `user_sign` VALUES ('9', '', '1462377600', '1462434611');
INSERT INTO `user_sign` VALUES ('10', '15123036810', '1462377600', '1462434611');

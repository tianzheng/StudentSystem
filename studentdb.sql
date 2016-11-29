/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50051
Source Host           : localhost:3306
Source Database       : studentdb

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2014-09-17 21:56:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `t_admin`
-- ----------------------------
DROP TABLE IF EXISTS `t_admin`;
CREATE TABLE `t_admin` (
  `username` varchar(20) NOT NULL default '',
  `password` varchar(32) default NULL,
  PRIMARY KEY  (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_admin
-- ----------------------------
INSERT INTO `t_admin` VALUES ('admin', '21232f297a57a5a743894a0e4a801fc3');

-- ----------------------------
-- Table structure for `t_nation`
-- ----------------------------
DROP TABLE IF EXISTS `t_nation`;
CREATE TABLE `t_nation` (
  `nationId` int(11) NOT NULL auto_increment COMMENT '民族编号',
  `nationName` varchar(30) collate utf8_bin NOT NULL COMMENT '民族名称',
  PRIMARY KEY  (`nationId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_nation
-- ----------------------------
INSERT INTO `t_nation` VALUES ('1', '汉族');

-- ----------------------------
-- Table structure for `t_studentinfo`
-- ----------------------------
DROP TABLE IF EXISTS `t_studentinfo`;
CREATE TABLE `t_studentinfo` (
  `zkzh` varchar(30) collate utf8_bin NOT NULL COMMENT 'zkzh',
  `name` varchar(20) collate utf8_bin NOT NULL COMMENT '姓名',
  `sex` varchar(2) collate utf8_bin NOT NULL COMMENT '性别',
  `kslb` varchar(20) collate utf8_bin NOT NULL COMMENT '考生类别',
  `zzmm` varchar(20) collate utf8_bin NOT NULL COMMENT '政治面貌',
  `nation` int(11) NOT NULL COMMENT '民族',
  `byxx` varchar(30) collate utf8_bin default NULL COMMENT '毕业学校',
  `hkszd` varchar(20) collate utf8_bin NOT NULL COMMENT '户口所在地',
  `address` varchar(80) collate utf8_bin default NULL COMMENT '家庭地址',
  `telephone` varchar(30) collate utf8_bin default NULL COMMENT '联系电话',
  `zcxx` varchar(20) collate utf8_bin default NULL COMMENT '注册性质',
  `cardNumber` varchar(30) collate utf8_bin default NULL COMMENT '身份证号',
  `xjh` varchar(30) collate utf8_bin default NULL COMMENT '学籍号',
  `gysznj` varchar(20) collate utf8_bin default NULL COMMENT '高一所在年级',
  `gesznj` varchar(20) collate utf8_bin default NULL COMMENT '高二所在年级',
  `gssznj` varchar(20) collate utf8_bin default NULL COMMENT '高三所在年级',
  `memo` varchar(200) collate utf8_bin default NULL COMMENT '备注信息',
  `photo` text collate utf8_bin NOT NULL COMMENT '个人照片',
  PRIMARY KEY  (`zkzh`),
  KEY `nation` (`nation`),
  CONSTRAINT `t_studentinfo_ibfk_1` FOREIGN KEY (`nation`) REFERENCES `t_nation` (`nationId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_studentinfo
-- ----------------------------
INSERT INTO `t_studentinfo` VALUES ('2014914141', '王晓明', '女', '应届生', '团员', '1', '渠县中学', '四川渠县', '四川渠县望溪乡包山村5组', '13558690869', '自行注册', '513914199612112984', '2014305814', '渠县中学2013级', '渠县中学2013级', '渠县中学2013级', '这是个好学生', 0x2F75706C6F61642F323031342F30392F36333432343630302E6A7067);

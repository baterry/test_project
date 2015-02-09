/*
Navicat MySQL Data Transfer

Source Server         : connection
Source Server Version : 50173
Source Host           : localhost:3306
Source Database       : patients

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2015-02-09 11:57:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `add_visit`
-- ----------------------------
DROP TABLE IF EXISTS `add_visit`;
CREATE TABLE `add_visit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_date` char(255) DEFAULT NULL,
  `order_amount` int(255) DEFAULT NULL,
  `order_status` char(255) DEFAULT NULL,
  `patient_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=259 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of add_visit
-- ----------------------------

-- ----------------------------
-- Table structure for `patient_info`
-- ----------------------------
DROP TABLE IF EXISTS `patient_info`;
CREATE TABLE `patient_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `lastname` text NOT NULL,
  `birthday` text NOT NULL,
  `address` text NOT NULL,
  `phone` int(11) NOT NULL,
  `email` text NOT NULL,
  `leye` int(11) NOT NULL,
  `reye` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of patient_info
-- ----------------------------

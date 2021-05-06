/*
Navicat MySQL Data Transfer

Source Server         : 39.108.144.247
Source Server Version : 50557
Source Host           : 39.108.144.247:3306
Source Database       : yzcd.kailly.com

Target Server Type    : MYSQL
Target Server Version : 50557
File Encoding         : 65001

Date: 2019-11-13 14:40:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for z_abouts
-- ----------------------------
DROP TABLE IF EXISTS `z_abouts`;
CREATE TABLE `z_abouts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video` varchar(255) NOT NULL DEFAULT '' COMMENT '视频',
  `content` text COMMENT '内容详情',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='关于我们';

-- ----------------------------
-- Records of z_abouts
-- ----------------------------
INSERT INTO `z_abouts` VALUES ('1', '/uploads/20191010/7c041aef20bcff62f443f229113bf77e.mp4', '<p>关于我们<img class=\"fr-fin\" data-fr-image-preview=\"false\" alt=\"Image title\" src=\"/uploads/20191010/d23e8813d448db795c331f45de13da2b.png\" width=\"300\"></p>', '1', '1570689343', '1570689986');

-- ----------------------------
-- Table structure for z_access
-- ----------------------------
DROP TABLE IF EXISTS `z_access`;
CREATE TABLE `z_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(50) NOT NULL COMMENT '权限名称',
  `url` varchar(100) NOT NULL COMMENT '页面URL',
  `parameter` varchar(255) NOT NULL DEFAULT '' COMMENT '参数',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 0生效 1无效',
  `pid` int(11) NOT NULL COMMENT '权限分类ID',
  `is_nav` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否加入菜单 1是 2否',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序 倒序',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=141 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='权限表';

-- ----------------------------
-- Records of z_access
-- ----------------------------
INSERT INTO `z_access` VALUES ('2', '管理员', 'index', '', '0', '2', '1', '9', '1514197382', '1529339312');
INSERT INTO `z_access` VALUES ('3', '角色管理', 'role', '', '0', '2', '1', '8', '1514197392', '1529339333');
INSERT INTO `z_access` VALUES ('4', '权限列表', 'node', '', '0', '2', '1', '7', '1514197402', '1529339338');
INSERT INTO `z_access` VALUES ('29', '添加/编辑角色', 'addrole', '', '0', '2', '2', '6', '1528954933', '1529339351');
INSERT INTO `z_access` VALUES ('46', '配置权限', 'access', '', '0', '2', '2', '0', '1529338363', '1529338363');
INSERT INTO `z_access` VALUES ('47', '删除角色', 'delerole', '', '0', '2', '2', '5', '1529338413', '1529339364');
INSERT INTO `z_access` VALUES ('48', '添加/编辑管理', 'addadmin', '', '0', '2', '2', '0', '1529338540', '1529338577');
INSERT INTO `z_access` VALUES ('49', '激活/冻结管理', 'isstatus', '', '0', '2', '2', '0', '1529338608', '1529338608');
INSERT INTO `z_access` VALUES ('50', '删除管理', 'deleadmin', '', '0', '2', '2', '0', '1529338626', '1529338626');
INSERT INTO `z_access` VALUES ('115', '用户列表', 'index', '', '0', '30', '1', '9', '1553070811', '1553070811');
INSERT INTO `z_access` VALUES ('137', '城市列表', 'index', '', '0', '41', '1', '1', '1571381069', '1571381069');
INSERT INTO `z_access` VALUES ('136', '关于我们', 'about', '', '0', '31', '1', '1', '1570689849', '1570689849');
INSERT INTO `z_access` VALUES ('116', '基础配置', 'index', '', '0', '31', '1', '9', '1556069491', '1556069491');
INSERT INTO `z_access` VALUES ('117', '图片管理', 'index', '', '0', '32', '1', '9', '1556071115', '1556071115');
INSERT INTO `z_access` VALUES ('118', '案例列表', 'index', '', '0', '33', '1', '1', '1566200517', '1566200517');
INSERT INTO `z_access` VALUES ('119', '品牌型号', 'brand', '', '0', '33', '1', '2', '1566208175', '1566208219');
INSERT INTO `z_access` VALUES ('120', '改装类型', 'refit', '', '0', '33', '1', '3', '1566208279', '1566208279');
INSERT INTO `z_access` VALUES ('121', '商家列表', 'shop', '', '0', '34', '1', '1', '1567823922', '1567824196');
INSERT INTO `z_access` VALUES ('122', '商品列表', 'index', '', '0', '35', '1', '1', '1567827844', '1567837423');
INSERT INTO `z_access` VALUES ('123', '商品标签', 'label', '', '0', '35', '1', '2', '1567848884', '1567848884');
INSERT INTO `z_access` VALUES ('124', '订单列表', 'order', '', '0', '35', '1', '3', '1568019520', '1568019520');
INSERT INTO `z_access` VALUES ('125', '商品列表', 'index', '', '0', '36', '1', '1', '1568600782', '1568600782');
INSERT INTO `z_access` VALUES ('126', '订单列表', 'order', '', '0', '36', '1', '2', '1568600842', '1568600842');
INSERT INTO `z_access` VALUES ('127', '商品分类', 'cate', '', '0', '36', '1', '3', '1568601228', '1568601228');
INSERT INTO `z_access` VALUES ('128', '商品品牌', 'brand', '', '0', '36', '1', '4', '1568602401', '1568602401');
INSERT INTO `z_access` VALUES ('129', '预约列表', 'index', '', '0', '37', '1', '1', '1568631406', '1568631406');
INSERT INTO `z_access` VALUES ('130', '产品列表', 'index', '', '0', '38', '1', '1', '1568691865', '1568691865');
INSERT INTO `z_access` VALUES ('131', '优惠劵列表', 'index', '', '0', '39', '1', '1', '1568705979', '1568705979');
INSERT INTO `z_access` VALUES ('132', '红包活动', 'red_act', '', '0', '39', '1', '2', '1568713775', '1568713775');
INSERT INTO `z_access` VALUES ('133', '优惠券活动', 'coupon_act', '', '0', '39', '1', '3', '1568715183', '1568715183');
INSERT INTO `z_access` VALUES ('134', '会员提现', 'user_cash', '', '0', '40', '1', '1', '1569649065', '1569649065');
INSERT INTO `z_access` VALUES ('135', '商家提现', 'shop_cash', '', '0', '40', '1', '2', '1569649083', '1569649083');
INSERT INTO `z_access` VALUES ('138', '通知列表', 'index', '', '0', '42', '1', '1', '1572229895', '1572229895');
INSERT INTO `z_access` VALUES ('140', '弹框通知', 'index', '', '0', '44', '1', '1', '1572504621', '1572504621');

-- ----------------------------
-- Table structure for z_access_role
-- ----------------------------
DROP TABLE IF EXISTS `z_access_role`;
CREATE TABLE `z_access_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `rid` int(11) NOT NULL COMMENT '角色ID',
  `acc_id` int(11) NOT NULL COMMENT '权限ID',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='角色权限关系表';

-- ----------------------------
-- Records of z_access_role
-- ----------------------------
INSERT INTO `z_access_role` VALUES ('1', '1', '6', '1514197463');
INSERT INTO `z_access_role` VALUES ('2', '1', '1', '1514198168');
INSERT INTO `z_access_role` VALUES ('4', '1', '7', '1514361292');
INSERT INTO `z_access_role` VALUES ('5', '1', '8', '1514455230');
INSERT INTO `z_access_role` VALUES ('6', '1', '9', '1514455230');
INSERT INTO `z_access_role` VALUES ('7', '1', '10', '1514455230');
INSERT INTO `z_access_role` VALUES ('8', '1', '11', '1514455230');
INSERT INTO `z_access_role` VALUES ('9', '2', '1', '1526385621');
INSERT INTO `z_access_role` VALUES ('25', '5', '2', '1529338677');
INSERT INTO `z_access_role` VALUES ('26', '5', '3', '1529338677');
INSERT INTO `z_access_role` VALUES ('30', '6', '58', '1546409369');
INSERT INTO `z_access_role` VALUES ('31', '6', '59', '1546409369');
INSERT INTO `z_access_role` VALUES ('32', '6', '60', '1546409369');
INSERT INTO `z_access_role` VALUES ('33', '6', '61', '1546409369');
INSERT INTO `z_access_role` VALUES ('34', '6', '62', '1546409369');
INSERT INTO `z_access_role` VALUES ('35', '6', '63', '1546409369');
INSERT INTO `z_access_role` VALUES ('36', '6', '64', '1546409369');
INSERT INTO `z_access_role` VALUES ('37', '6', '65', '1546409369');

-- ----------------------------
-- Table structure for z_access_type
-- ----------------------------
DROP TABLE IF EXISTS `z_access_type`;
CREATE TABLE `z_access_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(50) NOT NULL COMMENT '控制器名称',
  `url` varchar(50) NOT NULL COMMENT '控制器',
  `icon` varchar(255) NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序 倒序',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='权限分类表';

-- ----------------------------
-- Records of z_access_type
-- ----------------------------
INSERT INTO `z_access_type` VALUES ('2', '后台管理', 'admins', 'icon-shezhi', '99', '1514197373', '1531962285');
INSERT INTO `z_access_type` VALUES ('41', '城市管理', 'citys', '', '0', '1571381036', '1571381095');
INSERT INTO `z_access_type` VALUES ('30', '用户管理', 'user', 'icon-jiaosequnti', '0', '1553070786', '1553070786');
INSERT INTO `z_access_type` VALUES ('31', '网站配置', 'config', 'icon-peizhiguanli', '98', '1556069463', '1556069463');
INSERT INTO `z_access_type` VALUES ('32', '轮播图', 'banner', 'icon-tupian-xianxing', '8', '1556070894', '1556070894');
INSERT INTO `z_access_type` VALUES ('33', '案例管理', 'example', 'icon-xinwenzixun-xianxing', '0', '1566197266', '1566208351');
INSERT INTO `z_access_type` VALUES ('34', '商家管理', 'shop', 'icon-dianpu', '0', '1567823900', '1567824172');
INSERT INTO `z_access_type` VALUES ('35', '商家商城', 'rgoods', 'icon-cangkucangchu-xianxing', '0', '1567827824', '1567836712');
INSERT INTO `z_access_type` VALUES ('36', '积分商城', 'point', 'icon-dianpu', '0', '1568600747', '1568600747');
INSERT INTO `z_access_type` VALUES ('37', '服务预约', 'reserves', 'icon-liebiao', '0', '1568631063', '1568632528');
INSERT INTO `z_access_type` VALUES ('38', '联保管理', 'repair', 'icon-guize', '0', '1568691826', '1568691826');
INSERT INTO `z_access_type` VALUES ('39', '活动管理', 'activity', 'icon-zhinengyouhua', '0', '1568705958', '1568705958');
INSERT INTO `z_access_type` VALUES ('40', '提现管理', 'cash', '', '0', '1569649047', '1569649106');
INSERT INTO `z_access_type` VALUES ('42', '站内通知', 'notices', '', '0', '1572229864', '1572229864');
INSERT INTO `z_access_type` VALUES ('44', '信息管理', 'others', '', '0', '1572504599', '1572504599');

-- ----------------------------
-- Table structure for z_activities
-- ----------------------------
DROP TABLE IF EXISTS `z_activities`;
CREATE TABLE `z_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `pic` varchar(100) NOT NULL DEFAULT '' COMMENT '封面图',
  `descs` varchar(255) NOT NULL DEFAULT '' COMMENT '简介',
  `content` text COMMENT '内容详情',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1优惠券活动；2红包活动',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='活动通知';

-- ----------------------------
-- Records of z_activities
-- ----------------------------
INSERT INTO `z_activities` VALUES ('1', '赢100元红包', '/uploads/20190929/37276802b332b887b13f82d56c83bd97.png', '赢100元红包', '<p>赢100元红包<img class=\"fr-fin\" data-fr-image-preview=\"false\" alt=\"Image title\" src=\"/uploads/20190929/27973bf22d0bddfb8179292578453f64.png\" width=\"300\"><br></p>', '2', '1', '1568714696', '1569724214');
INSERT INTO `z_activities` VALUES ('2', '免费领取优惠券', '/uploads/20190929/04cb4a9012b7277a72110e34d4b51e77.png', '免费领取优惠券', '<p>免费领取优惠券<img class=\"fr-fin\" data-fr-image-preview=\"false\" alt=\"Image title\" src=\"/uploads/20190929/4425f652ff8de1b315abf2124646a432.png\" width=\"300\"><br></p>', '1', '1', '1568715277', '1569724289');

-- ----------------------------
-- Table structure for z_address
-- ----------------------------
DROP TABLE IF EXISTS `z_address`;
CREATE TABLE `z_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '收件人',
  `phone` varchar(15) NOT NULL DEFAULT '' COMMENT '手机号码',
  `province` varchar(50) NOT NULL DEFAULT '' COMMENT '省',
  `city` varchar(50) NOT NULL DEFAULT '' COMMENT '市',
  `area` varchar(50) NOT NULL DEFAULT '' COMMENT '区',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '详细地址',
  `default` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1默认',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='收货地址';

-- ----------------------------
-- Records of z_address
-- ----------------------------

-- ----------------------------
-- Table structure for z_admin
-- ----------------------------
DROP TABLE IF EXISTS `z_admin`;
CREATE TABLE `z_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(50) NOT NULL COMMENT '管理员名称',
  `admin_user` varchar(50) NOT NULL COMMENT '账号',
  `password` char(32) DEFAULT NULL COMMENT '密码',
  `addtime` int(11) DEFAULT NULL COMMENT '注册时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `forst` int(1) NOT NULL DEFAULT '0' COMMENT '是否冻结 0否 1是',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of z_admin
-- ----------------------------
INSERT INTO `z_admin` VALUES ('1', '超级管理员', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1514163261', '1526385304', '0');

-- ----------------------------
-- Table structure for z_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `z_admin_role`;
CREATE TABLE `z_admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(50) NOT NULL COMMENT '角色名称',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态 0有效 1无效',
  `desc` varchar(200) NOT NULL DEFAULT '' COMMENT '角色描述',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户角色表';

-- ----------------------------
-- Records of z_admin_role
-- ----------------------------
INSERT INTO `z_admin_role` VALUES ('7', '测试', '0', '测试', '1572423981', '1572423981');

-- ----------------------------
-- Table structure for z_admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `z_admin_roles`;
CREATE TABLE `z_admin_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `aid` int(11) NOT NULL COMMENT '管理员ID',
  `rid` int(11) NOT NULL COMMENT '角色ID',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='用户角色关系表';

-- ----------------------------
-- Records of z_admin_roles
-- ----------------------------
INSERT INTO `z_admin_roles` VALUES ('3', '6', '2', '1526384853');
INSERT INTO `z_admin_roles` VALUES ('4', '2', '5', '1528873113');
INSERT INTO `z_admin_roles` VALUES ('7', '9', '6', '1546427140');
INSERT INTO `z_admin_roles` VALUES ('8', '7', '6', '1547003146');

-- ----------------------------
-- Table structure for z_attr
-- ----------------------------
DROP TABLE IF EXISTS `z_attr`;
CREATE TABLE `z_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL COMMENT 'reserve_goods表id',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '属性名称',
  `shop_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '门店合伙人购买价格',
  `city_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '城市合伙人购买价格',
  `number` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `city_percent_one` varchar(5) NOT NULL DEFAULT '' COMMENT '城市合伙人一级分红比例',
  `city_percent_second` varchar(5) NOT NULL DEFAULT '' COMMENT '城市合伙人二级分红比例',
  `shop_percent_one` varchar(5) NOT NULL DEFAULT '' COMMENT '门店合伙人一级分红比例',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='商品属性';

-- ----------------------------
-- Records of z_attr
-- ----------------------------

-- ----------------------------
-- Table structure for z_bank
-- ----------------------------
DROP TABLE IF EXISTS `z_bank`;
CREATE TABLE `z_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '银行名称',
  `bank_code` varchar(100) NOT NULL DEFAULT '' COMMENT '银行编号',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:显示，2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='银行表';

-- ----------------------------
-- Records of z_bank
-- ----------------------------
INSERT INTO `z_bank` VALUES ('1', '工商银行', '1002', '1', '1513905946', '0');
INSERT INTO `z_bank` VALUES ('2', '农业银行', '1005', '1', '1513910945', '0');
INSERT INTO `z_bank` VALUES ('3', '中国银行', '1026', '1', '1513910976', '0');
INSERT INTO `z_bank` VALUES ('4', '建设银行', '1003', '1', '1513953375', '0');
INSERT INTO `z_bank` VALUES ('5', '招商银行', '1001', '1', '1513953434', '0');
INSERT INTO `z_bank` VALUES ('10', '邮储银行', '1066', '1', '1513953434', '0');
INSERT INTO `z_bank` VALUES ('11', '交通银行', '1020', '1', '1513953434', '0');
INSERT INTO `z_bank` VALUES ('12', '浦发银行', '1004', '1', '1513953434', '0');
INSERT INTO `z_bank` VALUES ('13', '民生银行', '1006', '1', '1513953434', '0');
INSERT INTO `z_bank` VALUES ('14', '兴业银行', '1009', '1', '1513953434', '0');
INSERT INTO `z_bank` VALUES ('15', '平安银行', '1010', '1', '1513953434', '0');
INSERT INTO `z_bank` VALUES ('16', '中信银行', '1021', '1', '1513953434', '0');
INSERT INTO `z_bank` VALUES ('17', '华夏银行', '1025', '1', '1513953434', '0');
INSERT INTO `z_bank` VALUES ('18', '广发银行', '1027', '1', '1513953434', '0');
INSERT INTO `z_bank` VALUES ('19', '光大银行', '1022', '1', '1513953434', '0');
INSERT INTO `z_bank` VALUES ('20', '北京银行', '4836', '1', '1513953434', '0');
INSERT INTO `z_bank` VALUES ('21', '宁波银行', '1056', '1', '1513953434', '0');
INSERT INTO `z_bank` VALUES ('22', '上海银行', '1024', '1', '1513953434', '0');

-- ----------------------------
-- Table structure for z_banner
-- ----------------------------
DROP TABLE IF EXISTS `z_banner`;
CREATE TABLE `z_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '广告标题',
  `pic` varchar(255) NOT NULL DEFAULT '' COMMENT '图片地址',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '跳转地址',
  `url_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '跳转类型 1页面 2小程序',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序 倒序',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型 1首页 2预约装修页面',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='广告图';

-- ----------------------------
-- Records of z_banner
-- ----------------------------
INSERT INTO `z_banner` VALUES ('1', '测试', '/uploads/20190929/bcec8ae095242ab6ee3b1255ed018b29.png', '', '2', '9', '1', '1556071739', '1569720493');
INSERT INTO `z_banner` VALUES ('5', '测试1 ', '/uploads/20190929/7dbdd0bba974c671facf98d41237b9aa.png', '', '2', '2', '1', '1569750245', '1569751180');

-- ----------------------------
-- Table structure for z_brand
-- ----------------------------
DROP TABLE IF EXISTS `z_brand`;
CREATE TABLE `z_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topid` int(11) NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `sort` int(11) NOT NULL DEFAULT '1' COMMENT '排序 倒序',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='品牌型号表';

-- ----------------------------
-- Records of z_brand
-- ----------------------------
INSERT INTO `z_brand` VALUES ('17', '16', '飞度', '1', '5', '1569721269', '1569721269');
INSERT INTO `z_brand` VALUES ('16', '0', '本田', '1', '99', '1569721253', '1569721253');
INSERT INTO `z_brand` VALUES ('12', '0', '丰田', '1', '100', '1569720864', '1569720864');
INSERT INTO `z_brand` VALUES ('13', '12', '凯美瑞', '1', '100', '1569720882', '1569720882');
INSERT INTO `z_brand` VALUES ('14', '12', '皇冠', '1', '99', '1569720896', '1569720896');
INSERT INTO `z_brand` VALUES ('15', '12', '霸道', '1', '98', '1569720907', '1569720907');
INSERT INTO `z_brand` VALUES ('18', '16', '思域', '1', '100', '1569721309', '1569721309');

-- ----------------------------
-- Table structure for z_car_lamp
-- ----------------------------
DROP TABLE IF EXISTS `z_car_lamp`;
CREATE TABLE `z_car_lamp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `img` text COMMENT '图片',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:显示，2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='车灯表';

-- ----------------------------
-- Records of z_car_lamp
-- ----------------------------

-- ----------------------------
-- Table structure for z_cases
-- ----------------------------
DROP TABLE IF EXISTS `z_cases`;
CREATE TABLE `z_cases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL DEFAULT '0' COMMENT '品牌型号id/brand表主键',
  `refit_id` int(11) NOT NULL DEFAULT '0' COMMENT '改装类型id/refit表主键id',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '案例名称',
  `use_time` varchar(15) NOT NULL DEFAULT '' COMMENT '服务用时',
  `money` varchar(15) NOT NULL DEFAULT '' COMMENT '参考价格',
  `min_money` int(5) NOT NULL DEFAULT '0' COMMENT '最低价格',
  `max_money` int(5) NOT NULL DEFAULT '0' COMMENT '最高价格',
  `old_img` varchar(255) NOT NULL DEFAULT '' COMMENT '服务前图片',
  `new_img` varchar(255) NOT NULL DEFAULT '' COMMENT '服务后图片',
  `content` text COMMENT '服务详情',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '门店id',
  `shop_name` varchar(100) NOT NULL DEFAULT '' COMMENT '门店名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='案例信息表';

-- ----------------------------
-- Records of z_cases
-- ----------------------------

-- ----------------------------
-- Table structure for z_cash
-- ----------------------------
DROP TABLE IF EXISTS `z_cash`;
CREATE TABLE `z_cash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id/商家id',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '提现金额',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1用户；2商家',
  `examine` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1申请中；2审核通过；3审核不通过',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='提现明细表';

-- ----------------------------
-- Records of z_cash
-- ----------------------------

-- ----------------------------
-- Table structure for z_city
-- ----------------------------
DROP TABLE IF EXISTS `z_city`;
CREATE TABLE `z_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '类型id',
  `province_id` int(11) NOT NULL DEFAULT '0',
  `province` varchar(100) NOT NULL DEFAULT '' COMMENT '省',
  `city` varchar(100) NOT NULL DEFAULT '' COMMENT '城市名称',
  `num` int(11) NOT NULL DEFAULT '1' COMMENT '门店入驻数量',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='可入驻城市';

-- ----------------------------
-- Records of z_city
-- ----------------------------
INSERT INTO `z_city` VALUES ('2', '1', '440000', '广东省', '广州市', '10', '1', '1571379461', '1571379461');
INSERT INTO `z_city` VALUES ('4', '3', '440000', '广东省', '清远市', '1', '1', '1571379868', '1571474446');
INSERT INTO `z_city` VALUES ('5', '1', '440000', '广东省', '深圳市', '10', '1', '1571479475', '1571479475');
INSERT INTO `z_city` VALUES ('6', '2', '140000', '山西省', '太原市', '10', '1', '1571797335', '1571797335');
INSERT INTO `z_city` VALUES ('8', '1', '110000', '北京市', '东城区', '1', '1', '1572418762', '1572418830');
INSERT INTO `z_city` VALUES ('9', '3', '210000', '辽宁省', '锦州市', '1', '1', '1572419005', '1572419005');

-- ----------------------------
-- Table structure for z_city_cate
-- ----------------------------
DROP TABLE IF EXISTS `z_city_cate`;
CREATE TABLE `z_city_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '类型名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='城市类型';

-- ----------------------------
-- Records of z_city_cate
-- ----------------------------
INSERT INTO `z_city_cate` VALUES ('1', '大中城市', '1', '0', '0');
INSERT INTO `z_city_cate` VALUES ('2', '中小城市', '1', '0', '0');
INSERT INTO `z_city_cate` VALUES ('3', '小城市', '1', '0', '0');

-- ----------------------------
-- Table structure for z_config
-- ----------------------------
DROP TABLE IF EXISTS `z_config`;
CREATE TABLE `z_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `back_img` varchar(255) NOT NULL DEFAULT '' COMMENT '邀请码背景图',
  `city_bonus_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '城市分红续期费用',
  `shop_bonus_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '门店分红续期费用',
  `city_time` int(11) NOT NULL DEFAULT '0' COMMENT '城市合伙人分红期限',
  `shop_time` int(11) NOT NULL DEFAULT '0' COMMENT '门店合伙人分红期限',
  `city_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '城市合伙人费用',
  `shop_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '门店合伙人费用',
  `city_contract` text COMMENT '城市合伙人合同',
  `shop_contract` text COMMENT '门店合伙人合同',
  `reserve_notice` text COMMENT '预约须知',
  `cash_explain` text COMMENT '提现说明',
  `rule` text COMMENT '优惠券使用规则',
  `about` text COMMENT '关于我们',
  `red_start_time` int(11) NOT NULL DEFAULT '0' COMMENT '红包发放开始时间',
  `red_end_time` int(11) NOT NULL DEFAULT '0' COMMENT '红包发放结束时间',
  `min_red` decimal(3,2) NOT NULL DEFAULT '0.00' COMMENT '红包最低金额',
  `max_red` decimal(3,2) NOT NULL DEFAULT '0.00' COMMENT '红包最高金额',
  `point` int(11) NOT NULL DEFAULT '0' COMMENT '邀请可得积分',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '网站标题',
  `logo` varchar(255) NOT NULL DEFAULT '' COMMENT '网站logo',
  `appid` varchar(100) NOT NULL DEFAULT '' COMMENT '微信APPID',
  `appsecret` varchar(255) NOT NULL DEFAULT '' COMMENT 'appsecret',
  `key` varchar(255) NOT NULL DEFAULT '' COMMENT '微信支付key',
  `mchid` int(11) NOT NULL DEFAULT '0' COMMENT '商户号',
  `fare_money` int(11) NOT NULL DEFAULT '0' COMMENT '运费',
  `work_time` varchar(255) NOT NULL COMMENT '门店地址',
  `cust_tel` varchar(255) NOT NULL DEFAULT '' COMMENT '客服电话',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '门店介绍',
  `long` varchar(255) NOT NULL DEFAULT '' COMMENT '经度',
  `lat` varchar(255) NOT NULL DEFAULT '' COMMENT '纬度',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `p_point` int(11) NOT NULL DEFAULT '0' COMMENT '分销获得积分',
  `bonus_time` int(3) NOT NULL DEFAULT '0' COMMENT '分红到账期限/天',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='配置表';

-- ----------------------------
-- Records of z_config
-- ----------------------------
INSERT INTO `z_config` VALUES ('1', '/uploads/20191030/6814219436ec302430f53ce545c69f4e.png', '2.00', '1.00', '99', '1', '20000.00', '5000.00', '<p><span style=\"color: rgb(102, 102, 102); font-family: \" neue\",=\"\" helvetica,=\"\" \"pingfang=\"\" sc\",=\"\" tahoma,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" right;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" display:=\"\" !important;=\"\" float:=\"\" none;\"=\"\">门店合伙人合同</span><br></p>', '<h2>杜玛柯门店合伙人协议书</h2><p>甲方：<u>杜马柯(</u><u>中国)</u><u>营运中心</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u></p><p>乙方：<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u></p><p>甲、乙双方本着自愿、平等、公平、诚实、信用的原则，经友好协商，根据中华人民共和国有关<a title=\"法律\">法律</a>、<a title=\"法规\">法规</a>的规定签定本协议，由双方共同遵守。</p><p><b>、授权经销产品、区域市场、年度销售目标及合同期限：</b></p><p>1、为更规范地服务经销商及消费者，甲方根据乙方的要求和对乙方的经营能力的审核，同意乙方加入  <u>杜马柯中国</u>的销售网络，授权乙方经营<u>杜玛珂线下</u>系列产品 授权期限为一年，乙方可在协议期满前三个月内向甲方提出续签合作协议的请求，经甲方同意可以续签《代理商年度合作协议书》、乙方享有优先签约权。 （空白区域额按系统注册信息为准、授权日期为总部审核通过后开始）</p><p>经甲乙双方协商，乙方若连续三个月累计销售不满1.5万元的最低销售额，将取消合伙人资格以及分红。</p><p>经甲乙双方共同探讨及深入评估商圈，不限区域 不限数量开展杜玛珂门店合伙人，建立起不低于<u> 10 </u>家终端样板形象店铺，具体标准以甲方设计出具的《杜玛珂终端VI形象体系》为依据；</p><p><b>区域保护、窜货管理及品牌加盟费的收取与处罚：</b></p><p>1、在签订本合同时，乙方必须向甲方交纳品牌加盟费<u> </u><u>¥5000 </u>元、大写：<u>伍仟元整</u><u> </u>；乙方承诺品牌加盟费于签订该合同时即汇款至甲方账户。交纳品牌加盟费的目的，是表示乙方保证全面履行本合同约定的义务，以及认同杜玛珂的营销体系和支持投入。</p><p>2、 品牌加盟费：甲乙双方约定在本合同终止后甲方不予返还品牌加盟费。</p><p>3、 如乙方没有完成本合同约定的年度销售额、或乙方有严重违反该合同的行为如跨区域窜货、扰乱价格体系、泄露甲方商业机密等，甲方有权对乙方发起处罚情节严重者取消资格扣除加盟费。</p><p>4、乙方应该严格按照合同区域从事销售活动，坚决杜绝任何窜货行为，如有窜货现象，第一次厂家将给予窜货乙方1000元罚款，并责令该乙方第一时间收回窜货。发现乙方出现再次窜货，每次扣除加盟费2000元，扣除部分将补齐5000元。情节严重的，甲方有权取消窜货代理商的代理资格。</p><p>6、公司严控网络销售，一切未经公司授权的网络销售，均视为假冒伪劣产品，由此造成的扣分、封店等后果，公司不承担责任。如代理商区域有客户想做网络销售，必须先经公司备案、授权，而且按公司要求的网络价格标价，方可上线。</p><p><b>合伙人机制、退出机制</b></p><p>1、成为城市合伙人可获得专属分享码，合伙人可通过朋友圈分享杜玛珂项目。凡是通过合伙人分享注册的合作门店均和合伙人有利益关系，门店合伙人分红期限为一年。（具体分红比例可查询系统后台）</p><p>2、分享成功后合作门店每月进货金额分红比例系统自动核算，分红款实时到账可以自行查询。</p><p>3、合同到期后或取消合同后分红权同时暂停或取消。</p><p>4、乙方应严格按照公司制定的价格体系执行，发现低于规定价格，一次扣罚加盟费1000元第二次2000元，第三次停止合作，终止分红权。</p><p>5，凡是本合同终止或解除时，乙方不得继续使用“杜玛珂”品牌、“杜玛珂”商标，不得销售本品牌的标识、服务标志等一切含甲方标识的装饰用具、店面装修、灯箱、宣传品等，否则甲方有权要求乙方支付赔偿金五万元，如对甲方造成其它损失则乙方应另行承担赔偿责任。 </p><p>6,&nbsp; 杜玛珂小程序每年600元服务器费用，第一年免费。</p><p><b>订货交付、结算支付方式及价格体系、营销政策：</b></p><p>1、订货交付：乙方注册登录杜玛珂小程序 ，商家商城自行选购产品，问题可以联系客服人员。乙方尽量提前5个工作日上订货数量明细。工厂只按线上收到订单发货，不接受微信、电话等其他途径接单。</p><p>2、支付结算方式：乙方可利用杜玛珂官方小程序下单平台下单支付，平台价格均为代理价，后台收到单后客户会第一时间和乙方确认产品发货时间。甲方业务人员不接收现金，不代收货款。</p><p>3、交货方式：国内一律采用物流或快递运输，甲方可代办发运，乙方自提，乙方付运费。货到乙方当地城市后，在当地的仓储费用由乙方负责。如乙方对运输方式有特殊要求，应在订单中注明，并承担相应的运费。</p><p>4、乙方在收到货物后应立即进行验收，如有毁损（失），应于货运公司交涉解决、与甲方无关；乙方提货后，由乙方承担保证商品质量和安全的责任，乙方在保管和销售甲方产品过程中，由于管理、经营不善出现问题（如鼠咬、被盗等），由此引发的经济责任和损失全部由乙方承担。</p><p>5、乙方若两日内对数量和货物无异议，视同乙方无异议处理。若乙方对货物和数量有异议，应在两日内通过邮件、传真等通知甲方，否则甲方视为验收合格，概不负责。</p><p><b>第四条、售后服务：</b></p><p>1、甲方对所售产品提供两年的质保期，自产品出厂日期算起。</p><p>2、对甲方所售乙方在质保期内的产品，发生质量问题的，甲方负责给予维修，保证不影响乙方的正常销售，不负责退调换货。</p><p>3、乙方发回甲方进行售后处理货物的运输费用由甲方承担，甲方维修后重新发给乙方的售后货物运费由乙方承担。</p><p>4、对确系甲方产品缺陷等甲方设计或生产产品质量问题的，甲方给予乙方无条件退调换货，所需费用由甲方承担。</p><p>5、若因乙方原因导致库存过剩或滞销的货物，不得退调换货。</p><p>6、任何方式的售后服务事项，必须由乙方向甲方提出申请，经甲方同意后方可发回，否则甲方有权拒收且所涉费用支出由乙方承担。 </p><p><b>第五条、</b><b>甲方权利与义务：</b></p><p>1、根据甲方的工作安排和乙方的实际需要，甲方有义务对乙方进行产品知识培训、技术指导、营销支持等工作；甲方负责品牌的整体营销策划及推广，并协助乙方所代理经销区域或市场的相关推广活动的策划和管理；甲方协助乙方所代理经销区域或市场的终端建设、维护，不定期派驻业务代表提供培训及业务指导（如乙方需要甲方人员协助乙方开展工作所需费用由乙方承担）。</p><p>2、甲方保证产品质量，承担因产品质量问题而发生的一切费用，<u>甲方品牌有的产品，乙方不得再代理或者售卖其他品牌同类型、同等功能功效的产品，否则甲方有权取消乙方的代理资格！</u></p><p>3、<u>甲方保证依约履行供货义务，在合作期间不得再开发其他代理商、经销商，保证约定的乙方所经营的区域市场的独家经营权。</u>甲方如遇交通路障、雨雪风灾、地震或国家政策等不可抗力因素不能准时交货，乙方不得以任何理由要求赔偿。</p><p>4、甲方有权力对乙方销售渠道的甲方产品核实价格体系，防止因暴利或其他原因提高或降低产品销售价格造成市场紊乱，违反上述约定，甲方有权终止合同。</p><p>5、乙方所在地的甲方业务人员没有权利对此合同进行变更或承诺合同以外的内容，如有必要需取得甲方的书面盖章确认方为有效；甲方工作人员对乙方的承诺（包括文件）应有甲方的书面盖章证明方能有效，否则，甲方不为此承担责任。</p><p>6、甲方为使乙方所辖区域更好运营，开发和提供适销产品，保证产品质量符合标准，合理定价，最大限度保证乙方的供应；如遇原材料价格波动、成本上涨等不可抗力因素，甲方有权力调整相关产品价格并及时通知乙方。</p><p><b>第六条、</b><b>乙方权利与义务：</b></p><p>乙方保证其经营区域内销售渠道的正常供货和合理库存、不得断货，乙方必须保证杜玛珂品牌系列产品的市场销售价格体系符合甲方规定。</p><p>乙方负责所代理经销区域市场的终端建设、维护及相关费用，乙方负责所代理经销区域或市场的相关推广活动的策划、管理和执行。</p><p>乙方有义务向甲方反馈当地市场本合同产品和同类产品的信息、零售额及消费者对甲方产品的态度、建议等信息，有责任全力配合甲方的各项宣传、促销活动。</p><p>乙方需要遵守并维护甲方制定的市场规则及销售价格体系、未经甲方同意不得以各种形式跨区域窜货销售，不得泄露本协议的内容、甲方的供货价格、技术要素等商业机密。</p><p>乙方有义务对返修品全部检测、尽量控制误返，把返回甲方的返修品或不良品备注清晰，按甲方指定的物流方式发回给甲方。</p><p>乙方保证尊重甲方知识产权，在当地范围内有责任保护甲方的知识产权，并有义务协助甲方处理该地区内侵犯甲方知识产权的事件；在乙方违背本协议即违法经营、制假、售假、恶意窜货、等严重侵害甲方合法权益等行为时，本协议视作立即终止。甲方有权依法提请司法和执法机关追索乙方的赔偿责任和法律责任，与此同时乙方必须：</p><p>　　（1）结清与甲方的财务往来账款。 </p><p>　　（2）不得再进行销售甲方的商品。 </p><p>（3）必须承担客户后续服务成本，包括退货、维修、索赔等。</p><p>7、未经甲方同意，乙方不得转让合伙人经营权。</p><p><b>第七条、</b>订立本协议的目的在于确保甲、乙双方忠实地履行本协议规定的双方的职责和权利。乙方作为单独的企业法人或经营者进行经济活动。因此，他必须遵守对所有企业法人或经营者共同的法律要求，特别是有关资格的规则以及社会的、财务的商业要求。作为一个企业法人或经营者，乙方应就其活动自负一切风险和从合法经营中获利。</p><p><b>第八条、</b> 如双方因不可抗力，或非双方所能控制或所能预见事件的发生，包括自然灾害、战争、政府行为、社会骚乱等情况而不能履行其业务，本协议的履行可以终止。如发生不可抗力事件，援引不可抗力的当事人必须在<u>15</u>天内或通讯障碍消除之日起<u>3</u>天内以书面的方式，必要时以传真或电传的方式，立即通知另一方当事人该事件的发生。如果他在上述期限内未能这样做，他将不能继续从本条协议中获益。&nbsp; </p><p><b>第九条、</b>如果产生有关本协议的存在、效力、履行、解释、终止的争议，双方应通过友好协商解决， 如果争议发生之日起三个月内通过协商不能解决的，或者任何一方拒绝协商的，则任何一方均可诉请本协议签定地人<a title=\"民法\">民法</a>院裁决；</p><p><b>第十条、<u>乙方必须上传营业执照复印件、法人身份证复印件并加盖公司公章，签订该年度合作协议书。</u></b>本协议一式两份，甲乙双方各备案一份，具备同等法律效力；乙方兹承认签署本协议，并已阅读及明白本协议所列条款所包含的规定。　</p>', '<p>预约须知sss</p>', '<p>提现说明111111</p>', '<p><span style=\"color: rgb(102, 102, 102); font-family: \" neue\",=\"\" helvetica,=\"\" \"pingfang=\"\" sc\",=\"\" tahoma,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" right;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" display:=\"\" !important;=\"\" float:=\"\" none;\"=\"\">优惠券规则</span><br></p>', '<p><span style=\"color: rgb(102, 102, 102); font-family: \" neue\",=\"\" helvetica,=\"\" \"pingfang=\"\" sc\",=\"\" tahoma,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" right;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" display:=\"\" !important;=\"\" float:=\"\" none;\"=\"\">关于我们</span><br></p>', '2332800', '1572500165', '5.00', '9.99', '200', '悦照车灯', '/uploads/20191030/a031908472bf978ad3a8acbbb261fdf7.png', 'wx2fadae8fb59b2737', '315669a73323216dbb57153441e02ff3', 'yzcdkailiyuezhaochedeng123456789', '1550007821', '10', '广州市天河区车陂南', '020-864556213', '营业时间 11:00 - 18:00 （周一至周六） 限时买一送一（特价商品除外）', '113.402870', '23.125220', '1551341451', '1572420040', '10', '30');

-- ----------------------------
-- Table structure for z_coupon
-- ----------------------------
DROP TABLE IF EXISTS `z_coupon`;
CREATE TABLE `z_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` varchar(255) NOT NULL DEFAULT '' COMMENT '商家ID',
  `coupon_code` varchar(100) NOT NULL DEFAULT '' COMMENT '券码',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `full_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '条件金额',
  `less_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '折扣金额',
  `day` int(11) NOT NULL DEFAULT '0' COMMENT '领取后的有效天数',
  `start_time` int(11) NOT NULL DEFAULT '0' COMMENT '领取开始时间',
  `end_time` int(11) NOT NULL DEFAULT '0' COMMENT '领取结束时间',
  `set_num` int(11) NOT NULL DEFAULT '0' COMMENT '已领取数',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '发放时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `num` int(5) DEFAULT '1' COMMENT '一人能领多少张',
  `status` tinyint(1) DEFAULT '1' COMMENT '1显示；2隐藏',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='优惠劵';

-- ----------------------------
-- Records of z_coupon
-- ----------------------------

-- ----------------------------
-- Table structure for z_feedback
-- ----------------------------
DROP TABLE IF EXISTS `z_feedback`;
CREATE TABLE `z_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `content` text COMMENT '反馈内容',
  `contact` varchar(255) NOT NULL DEFAULT '' COMMENT '联系方式',
  `img` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:显示，2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='反馈表';

-- ----------------------------
-- Records of z_feedback
-- ----------------------------

-- ----------------------------
-- Table structure for z_goods
-- ----------------------------
DROP TABLE IF EXISTS `z_goods`;
CREATE TABLE `z_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0' COMMENT '商品标题',
  `old_title` varchar(255) NOT NULL DEFAULT '' COMMENT '副标题',
  `type_id` int(11) NOT NULL DEFAULT '0' COMMENT '分类ID',
  `pic` varchar(255) NOT NULL DEFAULT '' COMMENT '封面',
  `images` text COMMENT '相册',
  `desc` text COMMENT '详情',
  `pay_num` int(11) NOT NULL DEFAULT '0' COMMENT '销量',
  `keep` int(11) NOT NULL DEFAULT '0' COMMENT '收藏数',
  `is_reco` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否推荐 1否 2是',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '上下架 1上架 2下架',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='商品';

-- ----------------------------
-- Records of z_goods
-- ----------------------------
INSERT INTO `z_goods` VALUES ('2', '超级苏丹王黄金果肉榴莲', '', '5', '/uploads/20190321/96153de40672a1f3a7cd99a3f9fbc7cd.png', '/uploads/20190321/d2d2fc42de94f34756576ad8fa618e7d.png', '<p>暂无信息</p>', '0', '0', '1', '1', '1553140342', '1553140342');
INSERT INTO `z_goods` VALUES ('3', '海鲜比萨', '', '5', '/uploads/20190321/efd8a0a306cb3b2a0c18df8d7d6c0741.png', '/uploads/20190321/aeb6c91e9d6a70a2983419630a7b9175.png', '<p>暂无信息</p>', '0', '0', '1', '1', '1553140410', '1553140410');
INSERT INTO `z_goods` VALUES ('4', '和风照烧鸡比萨', '', '5', '/uploads/20190321/b3c30b1a4432e3800a72b4a231b265f2.png', '/uploads/20190321/9be2b84518826dac38d8e76dc1afb0a1.png', '<p>暂无信息</p>', '0', '0', '1', '1', '1553140466', '1553140466');
INSERT INTO `z_goods` VALUES ('5', '核桃仁烤鸡比萨', '', '5', '/uploads/20190321/0f4665bdf62c2c167c2f2ee3d1dd7057.jpg', '/uploads/20190321/868272e5a938a54560c44fd562e27169.jpg', '<p>暂无信息</p>', '0', '0', '1', '1', '1553140527', '1553140527');
INSERT INTO `z_goods` VALUES ('6', '京酱烤鸭比萨', '', '5', '/uploads/20190321/8490716dfda6647381b9608636ab90ba.jpg', '/uploads/20190321/de41c5795cfc6bf6ddcd6933778dccf7.jpg', '<p>暂无信息</p>', '0', '0', '1', '1', '1553140570', '1553140570');
INSERT INTO `z_goods` VALUES ('7', '水果什锦比萨', '', '5', '/uploads/20190321/8a3c5ed8500c2be02ace37deb33a7657.png', '/uploads/20190321/7441fb24a379b35d47c20abdb3246fa9.png', '<p>暂无信息</p>', '0', '0', '1', '1', '1553140633', '1553140633');
INSERT INTO `z_goods` VALUES ('8', '莓莓拿铁咖啡', '品味生活', '1', '/uploads/20190321/b6b4c116711646878cb088a76b4e13f4.jpg', '/uploads/20190321/cfe1641aac512805e7af01f614707147.jpg', '<p>暂无信息</p>', '0', '0', '1', '1', '1553140714', '1553218784');
INSERT INTO `z_goods` VALUES ('9', '鲜橙水果茶', '', '4', '/uploads/20190321/89347cfa811312c4a5d04ee010d38fe7.jpg', '/uploads/20190321/d41cae894d19f0cc1ceae8500571a04b.jpg', '<p>暂无信息</p>', '0', '0', '1', '1', '1553160532', '1553160532');
INSERT INTO `z_goods` VALUES ('10', '鲜芋青稞牛奶', '营养美味', '3', '/uploads/20190322/142b57d1f8c6123ac694960e69fda411.jpg', '/uploads/20190322/9899dd6b231488594cceaf188a3d1487.jpg', '<p>暂无信息</p>', '0', '0', '1', '1', '1553218853', '1553218853');
INSERT INTO `z_goods` VALUES ('11', '法式奶霜烤茶', '', '2', '/uploads/20190322/afeeb5c7b6250b600d61cb616d747f93.jpg', '/uploads/20190322/bc7efba02d2cd18c015523cfdd907efa.jpg', '<p>暂无信息</p>', '0', '0', '1', '1', '1553218941', '1553218941');
INSERT INTO `z_goods` VALUES ('12', '草莓果茶', '新鲜水果', '4', '/uploads/20190322/269052072dd245a1e0f837bd919e3d8e.jpg', '/uploads/20190322/d6fc1cd4f2dee1417e39038795e66dfd.jpg', '<p>暂无信息</p>', '0', '0', '1', '1', '1553226712', '1553226712');
INSERT INTO `z_goods` VALUES ('13', '草莓红果果', '', '4', '/uploads/20190322/065dd4f3ec4e12dc73aece4f627ed23f.jpg', '/uploads/20190322/9582862798e147b09ac01413452a2864.jpg', '<p>暂无信息</p>', '0', '0', '1', '1', '1553226813', '1553226813');
INSERT INTO `z_goods` VALUES ('14', '商品名称', '', '0', '/uploads/20190907/428da159f3cf52f15a5fc0ae54717a78.png', null, '<p><span style=\"color: rgb(102, 102, 102); font-family: &quot; Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: right; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">商品详情</span><span style=\"color: rgb(102, 102, 102); font-family: &quot; Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: right; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">商品详情</span><span style=\"color: rgb(102, 102, 102); font-family: &quot; Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: right; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">商品详情</span><span style=\"color: rgb(102, 102, 102); font-family: &quot; Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: right; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">商品详情</span><img class=\"fr-fin\" data-fr-image-preview=\"false\" alt=\"Image title\" src=\"/uploads/20190907/717f2265dc0fe8eac95278942a4e8237.png\" width=\"300\"><br></p>', '0', '0', '1', '1', '1567844883', '1567844883');

-- ----------------------------
-- Table structure for z_goods_attr
-- ----------------------------
DROP TABLE IF EXISTS `z_goods_attr`;
CREATE TABLE `z_goods_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '属性名称',
  `goods_id` int(11) NOT NULL COMMENT '商品ID',
  `ap_id` int(11) NOT NULL COMMENT 'sku id 用于初始化',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='商品属性';

-- ----------------------------
-- Records of z_goods_attr
-- ----------------------------
INSERT INTO `z_goods_attr` VALUES ('1', '大小', '1', '1', '1553140300', '1553140316');
INSERT INTO `z_goods_attr` VALUES ('2', '大小', '2', '1', '1553140377', '1553140377');
INSERT INTO `z_goods_attr` VALUES ('3', '大小', '3', '1', '1553140446', '1553140446');
INSERT INTO `z_goods_attr` VALUES ('4', '大小', '4', '1', '1553140502', '1553140502');
INSERT INTO `z_goods_attr` VALUES ('5', '大小', '5', '1', '1553140544', '1553140544');
INSERT INTO `z_goods_attr` VALUES ('6', '大小', '6', '1', '1553140614', '1553140614');
INSERT INTO `z_goods_attr` VALUES ('7', '大小', '7', '1', '1553140671', '1553140671');
INSERT INTO `z_goods_attr` VALUES ('8', '规格', '8', '1', '1553147957', '1553147957');
INSERT INTO `z_goods_attr` VALUES ('9', '糖度', '8', '2', '1553147957', '1553147957');
INSERT INTO `z_goods_attr` VALUES ('10', '温度', '8', '3', '1553147957', '1553147957');
INSERT INTO `z_goods_attr` VALUES ('11', '规格', '9', '1', '1553160659', '1553160659');
INSERT INTO `z_goods_attr` VALUES ('12', '规格', '10', '1', '1553218889', '1553218889');
INSERT INTO `z_goods_attr` VALUES ('13', '规格', '11', '1', '1553218965', '1553226605');
INSERT INTO `z_goods_attr` VALUES ('14', '规格', '12', '1', '1553226744', '1553226744');
INSERT INTO `z_goods_attr` VALUES ('19', '规格', '13', '1', '1553235009', '1553235067');
INSERT INTO `z_goods_attr` VALUES ('20', '温度', '13', '2', '1553235009', '1553235067');

-- ----------------------------
-- Table structure for z_goods_spec
-- ----------------------------
DROP TABLE IF EXISTS `z_goods_spec`;
CREATE TABLE `z_goods_spec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '属性名称',
  `goods_id` int(11) NOT NULL COMMENT '商品ID',
  `goods_attr_id` int(11) NOT NULL DEFAULT '0' COMMENT '属性ID',
  `ap_id` int(11) NOT NULL DEFAULT '0' COMMENT 'sku id 用于初始化',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='商品属性';

-- ----------------------------
-- Records of z_goods_spec
-- ----------------------------
INSERT INTO `z_goods_spec` VALUES ('1', '10寸', '1', '1', '1', '1553140300', '1553140316');
INSERT INTO `z_goods_spec` VALUES ('2', '12寸', '1', '1', '2', '1553140300', '1553140316');
INSERT INTO `z_goods_spec` VALUES ('3', '10寸', '2', '2', '1', '1553140377', '1553140377');
INSERT INTO `z_goods_spec` VALUES ('4', '10寸', '3', '3', '1', '1553140446', '1553140446');
INSERT INTO `z_goods_spec` VALUES ('5', '16寸', '3', '3', '2', '1553140446', '1553140446');
INSERT INTO `z_goods_spec` VALUES ('6', '6寸', '4', '4', '1', '1553140502', '1553140502');
INSERT INTO `z_goods_spec` VALUES ('7', '10寸', '4', '4', '2', '1553140502', '1553140502');
INSERT INTO `z_goods_spec` VALUES ('8', '10寸', '5', '5', '1', '1553140544', '1553140544');
INSERT INTO `z_goods_spec` VALUES ('9', '4寸', '6', '6', '1', '1553140614', '1553140614');
INSERT INTO `z_goods_spec` VALUES ('10', '10寸', '6', '6', '2', '1553140614', '1553140614');
INSERT INTO `z_goods_spec` VALUES ('11', '12寸', '6', '6', '3', '1553140614', '1553140614');
INSERT INTO `z_goods_spec` VALUES ('12', '6寸', '7', '7', '1', '1553140671', '1553140671');
INSERT INTO `z_goods_spec` VALUES ('13', '12寸', '7', '7', '2', '1553140671', '1553140671');
INSERT INTO `z_goods_spec` VALUES ('14', '常规', '8', '8', '1', '1553147957', '1553147957');
INSERT INTO `z_goods_spec` VALUES ('15', '浓缩咖啡', '8', '8', '2', '1553147957', '1553147957');
INSERT INTO `z_goods_spec` VALUES ('16', '常规', '8', '9', '3', '1553147957', '1553147957');
INSERT INTO `z_goods_spec` VALUES ('17', '半塘', '8', '9', '4', '1553147957', '1553147957');
INSERT INTO `z_goods_spec` VALUES ('18', '加糖', '8', '9', '5', '1553147957', '1553147957');
INSERT INTO `z_goods_spec` VALUES ('19', '微糖', '8', '9', '6', '1553147957', '1553147957');
INSERT INTO `z_goods_spec` VALUES ('20', '常规冰', '8', '10', '7', '1553147957', '1553147957');
INSERT INTO `z_goods_spec` VALUES ('21', '多冰', '8', '10', '8', '1553147957', '1553147957');
INSERT INTO `z_goods_spec` VALUES ('22', '少冰', '8', '10', '9', '1553147957', '1553147957');
INSERT INTO `z_goods_spec` VALUES ('23', '去冰', '8', '10', '10', '1553147957', '1553147957');
INSERT INTO `z_goods_spec` VALUES ('24', '中杯', '9', '11', '1', '1553160659', '1553160659');
INSERT INTO `z_goods_spec` VALUES ('25', '大杯', '9', '11', '2', '1553160659', '1553160659');
INSERT INTO `z_goods_spec` VALUES ('26', '中杯', '10', '12', '1', '1553218889', '1553218889');
INSERT INTO `z_goods_spec` VALUES ('27', '大杯', '10', '12', '2', '1553218889', '1553218889');
INSERT INTO `z_goods_spec` VALUES ('28', '中杯', '11', '13', '1', '1553218965', '1553226605');
INSERT INTO `z_goods_spec` VALUES ('29', '中杯', '12', '14', '1', '1553226744', '1553226744');
INSERT INTO `z_goods_spec` VALUES ('30', '大杯', '12', '14', '2', '1553226744', '1553226744');
INSERT INTO `z_goods_spec` VALUES ('41', '中杯', '13', '19', '1', '1553235009', '1553235067');
INSERT INTO `z_goods_spec` VALUES ('42', '大杯', '13', '19', '2', '1553235009', '1553235067');
INSERT INTO `z_goods_spec` VALUES ('43', '常规', '13', '20', '3', '1553235009', '1553235067');
INSERT INTO `z_goods_spec` VALUES ('44', '去冰', '13', '20', '4', '1553235009', '1553235067');

-- ----------------------------
-- Table structure for z_goods_type
-- ----------------------------
DROP TABLE IF EXISTS `z_goods_type`;
CREATE TABLE `z_goods_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '分类名称',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(11) NOT NULL DEFAULT '1' COMMENT '排序 倒序',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='商品分类';

-- ----------------------------
-- Records of z_goods_type
-- ----------------------------
INSERT INTO `z_goods_type` VALUES ('1', '咖啡时光', '0', '8', '1553135831', '1553139854');
INSERT INTO `z_goods_type` VALUES ('2', '暖饮轻食', '0', '1', '1553136159', '1553136159');
INSERT INTO `z_goods_type` VALUES ('3', '牧场牛奶', '0', '1', '1553136169', '1553136169');
INSERT INTO `z_goods_type` VALUES ('4', '新鲜果茶', '0', '7', '1553136177', '1553139861');
INSERT INTO `z_goods_type` VALUES ('5', '美味披萨', '0', '9', '1553139654', '1553139845');
INSERT INTO `z_goods_type` VALUES ('6', '品牌1', '0', '1', '1566437516', '1566437516');

-- ----------------------------
-- Table structure for z_goods_val
-- ----------------------------
DROP TABLE IF EXISTS `z_goods_val`;
CREATE TABLE `z_goods_val` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `attr_spec` varchar(255) NOT NULL DEFAULT '' COMMENT '商品规格属性值 示例： 1:2 1为属性 2为规格',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `old_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价格',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `pay_num` int(11) NOT NULL DEFAULT '0' COMMENT '销量',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='商品规格属性值';

-- ----------------------------
-- Records of z_goods_val
-- ----------------------------
INSERT INTO `z_goods_val` VALUES ('1', '1', '1:1', '68.00', '68.00', '99', '0', '1553140300', '1553140316');
INSERT INTO `z_goods_val` VALUES ('2', '1', '1:2', '98.00', '98.00', '99', '0', '1553140300', '1553140316');
INSERT INTO `z_goods_val` VALUES ('3', '2', '2:3', '64.00', '64.00', '99', '0', '1553140377', '1553140377');
INSERT INTO `z_goods_val` VALUES ('4', '3', '3:4', '64.00', '64.00', '99', '0', '1553140446', '1553140446');
INSERT INTO `z_goods_val` VALUES ('5', '3', '3:5', '118.00', '118.00', '99', '0', '1553140446', '1553140446');
INSERT INTO `z_goods_val` VALUES ('6', '4', '4:6', '48.00', '48.00', '99', '0', '1553140502', '1553140502');
INSERT INTO `z_goods_val` VALUES ('7', '4', '4:7', '65.00', '65.00', '99', '0', '1553140502', '1553140502');
INSERT INTO `z_goods_val` VALUES ('8', '5', '5:8', '67.00', '67.00', '99', '0', '1553140544', '1553140544');
INSERT INTO `z_goods_val` VALUES ('9', '6', '6:9', '29.00', '29.00', '99', '0', '1553140614', '1553140614');
INSERT INTO `z_goods_val` VALUES ('10', '6', '6:10', '67.00', '67.00', '99', '0', '1553140614', '1553140614');
INSERT INTO `z_goods_val` VALUES ('11', '6', '6:11', '94.00', '94.00', '99', '0', '1553140614', '1553140614');
INSERT INTO `z_goods_val` VALUES ('12', '7', '7:12', '63.00', '63.00', '99', '0', '1553140671', '1553140671');
INSERT INTO `z_goods_val` VALUES ('13', '7', '7:13', '96.00', '96.00', '99', '0', '1553140671', '1553140671');
INSERT INTO `z_goods_val` VALUES ('14', '8', '8:14,9:16,10:20', '23.00', '23.00', '99', '0', '1553147957', '1553147957');
INSERT INTO `z_goods_val` VALUES ('15', '8', '8:14,9:16,10:21', '23.00', '23.00', '99', '0', '1553147957', '1553147957');
INSERT INTO `z_goods_val` VALUES ('16', '8', '8:14,9:16,10:22', '23.00', '23.00', '99', '0', '1553147957', '1553147957');
INSERT INTO `z_goods_val` VALUES ('17', '8', '8:14,9:16,10:23', '23.00', '23.00', '99', '0', '1553147957', '1553147957');
INSERT INTO `z_goods_val` VALUES ('18', '8', '8:14,9:17,10:20', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('19', '8', '8:14,9:17,10:21', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('20', '8', '8:14,9:17,10:22', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('21', '8', '8:14,9:17,10:23', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('22', '8', '8:14,9:18,10:20', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('23', '8', '8:14,9:18,10:21', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('24', '8', '8:14,9:18,10:22', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('25', '8', '8:14,9:18,10:23', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('26', '8', '8:14,9:19,10:20', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('27', '8', '8:14,9:19,10:21', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('28', '8', '8:14,9:19,10:22', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('29', '8', '8:14,9:19,10:23', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('30', '8', '8:15,9:16,10:20', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('31', '8', '8:15,9:16,10:21', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('32', '8', '8:15,9:16,10:22', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('33', '8', '8:15,9:16,10:23', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('34', '8', '8:15,9:17,10:20', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('35', '8', '8:15,9:17,10:21', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('36', '8', '8:15,9:17,10:22', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('37', '8', '8:15,9:17,10:23', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('38', '8', '8:15,9:18,10:20', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('39', '8', '8:15,9:18,10:21', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('40', '8', '8:15,9:18,10:22', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('41', '8', '8:15,9:18,10:23', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('42', '8', '8:15,9:19,10:20', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('43', '8', '8:15,9:19,10:21', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('44', '8', '8:15,9:19,10:22', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('45', '8', '8:15,9:19,10:23', '23.00', '23.00', '99', '0', '1553147958', '1553147958');
INSERT INTO `z_goods_val` VALUES ('46', '9', '11:24', '18.00', '18.00', '99', '0', '1553160659', '1553160659');
INSERT INTO `z_goods_val` VALUES ('47', '9', '11:25', '23.00', '23.00', '99', '0', '1553160659', '1553160659');
INSERT INTO `z_goods_val` VALUES ('48', '10', '12:26', '18.00', '18.00', '99', '0', '1553218889', '1553218889');
INSERT INTO `z_goods_val` VALUES ('49', '10', '12:27', '22.00', '22.00', '99', '0', '1553218889', '1553218889');
INSERT INTO `z_goods_val` VALUES ('50', '11', '13:28', '16.00', '17.00', '99', '0', '1553218965', '1553226605');
INSERT INTO `z_goods_val` VALUES ('51', '12', '14:29', '17.00', '17.00', '99', '0', '1553226744', '1553226744');
INSERT INTO `z_goods_val` VALUES ('52', '12', '14:30', '22.00', '22.00', '99', '0', '1553226744', '1553226744');
INSERT INTO `z_goods_val` VALUES ('57', '13', '19:41,20:43', '17.00', '17.00', '0', '0', '1553235009', '1553235067');
INSERT INTO `z_goods_val` VALUES ('58', '13', '19:41,20:44', '17.00', '17.00', '0', '0', '1553235009', '1553235067');
INSERT INTO `z_goods_val` VALUES ('59', '13', '19:42,20:43', '26.00', '26.00', '0', '0', '1553235009', '1553235067');
INSERT INTO `z_goods_val` VALUES ('60', '13', '19:42,20:44', '26.00', '26.00', '0', '0', '1553235009', '1553235067');

-- ----------------------------
-- Table structure for z_label
-- ----------------------------
DROP TABLE IF EXISTS `z_label`;
CREATE TABLE `z_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '标签名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `topid` int(11) NOT NULL DEFAULT '0' COMMENT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='标签';

-- ----------------------------
-- Records of z_label
-- ----------------------------
INSERT INTO `z_label` VALUES ('1', '汽车美容', '1', '1567849061', '1569723450', '0');
INSERT INTO `z_label` VALUES ('2', '汽车改装', '1', '1567849061', '1567849061', '0');
INSERT INTO `z_label` VALUES ('4', '改装', '1', '1571796915', '1571796915', '0');

-- ----------------------------
-- Table structure for z_logistics
-- ----------------------------
DROP TABLE IF EXISTS `z_logistics`;
CREATE TABLE `z_logistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '公司名称',
  `code` varchar(20) DEFAULT '' COMMENT '物流公司编码',
  `icon` varchar(255) NOT NULL DEFAULT '' COMMENT '图标',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1是正常 2是禁用',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `is_deleted` tinyint(1) unsigned DEFAULT '0' COMMENT '0未删除  1已删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='物流公司';

-- ----------------------------
-- Records of z_logistics
-- ----------------------------
INSERT INTO `z_logistics` VALUES ('1', '顺丰快递', 'shunfeng', '/uploads/20180831/89a2dd5a8ca2b18b8602d75e6d6369d0.jpg', '1', '1533696253', '1535696767', '0');
INSERT INTO `z_logistics` VALUES ('2', '圆通快递', 'yuantong', '/uploads/20180831/3065473ec818687511d1b6b4668297c5.png', '1', '1533696555', '1535684389', '0');
INSERT INTO `z_logistics` VALUES ('3', '天天快递', 'tiantian', '/uploads/20180831/7b24c54f66a32f26a8e378d4f0e94cf0.png', '1', '1533696572', '1535684496', '0');
INSERT INTO `z_logistics` VALUES ('14', '信丰快递', 'xinfengwuliu', '/uploads//20181205/34d3d9a760de5c2e2258117197645e83.jpg', '1', '1544009426', '1544009544', '0');
INSERT INTO `z_logistics` VALUES ('7', '韵达快递', 'yunda', '/uploads/20180831/41bb9273acb9f31d6bad4b9f22397389.png', '1', '1535684855', '1535700224', '0');
INSERT INTO `z_logistics` VALUES ('8', '申通快递', 'shentong', '/uploads/20180831/73a63f8249e16fef5ad1a28a4ed50b76.png', '1', '1535684907', '1535700225', '0');
INSERT INTO `z_logistics` VALUES ('9', 'EMS', 'ems', '/uploads/20180831/09a3921b32f57c1c6dabfe00bd8337c1.jpg', '1', '1535685425', '1535685515', '0');
INSERT INTO `z_logistics` VALUES ('13', '中通快递', 'zhongtong', '/uploads//20181205/494a7ebc8ff9a8e8a7d92604c844e84c.jpg', '1', '1543989260', '1543989298', '0');
INSERT INTO `z_logistics` VALUES ('12', '德邦快递', 'debangwuliu', '/uploads//20181109/6c0c8636b07733034fdf05993795a4e9.jpg', '1', '1541732933', '1541732933', '0');

-- ----------------------------
-- Table structure for z_money_change
-- ----------------------------
DROP TABLE IF EXISTS `z_money_change`;
CREATE TABLE `z_money_change` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '门店id',
  `order_sn` varchar(30) NOT NULL DEFAULT '' COMMENT '订单号',
  `money` varchar(20) NOT NULL DEFAULT '',
  `bonus_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '分红金额，发放时用到',
  `type` int(255) NOT NULL DEFAULT '1' COMMENT '1提现申请；2预付款收入；3结账收入；4商家购买产品支出；5提现成功；6提现失败;7分红收入',
  `msg` varchar(255) NOT NULL COMMENT '描述',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `bank_id` int(11) NOT NULL DEFAULT '0' COMMENT '银行id',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '银行名称',
  `bank_code` varchar(30) NOT NULL DEFAULT '' COMMENT '银行编号',
  `bank_num` varchar(50) NOT NULL DEFAULT '' COMMENT '银行卡号',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '提现人姓名',
  `cash_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1提现到银行卡；2提现到微信',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '分红到账状态：1未到账；2已到账；3取消发放',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商家余额变化记录';

-- ----------------------------
-- Records of z_money_change
-- ----------------------------

-- ----------------------------
-- Table structure for z_notice
-- ----------------------------
DROP TABLE IF EXISTS `z_notice`;
CREATE TABLE `z_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text COMMENT '内容详情',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1商家通知；2用户通知',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='站内通知';

-- ----------------------------
-- Records of z_notice
-- ----------------------------
INSERT INTO `z_notice` VALUES ('2', '通知1', '<p>通知通知<img class=\"fr-fin\" data-fr-image-preview=\"false\" alt=\"Image title\" src=\"/uploads/20191028/23edda1bf312a981ada9d1a465ca4f66.png\" width=\"300\"></p>', '1', '1', '1572229987', '1572229987');

-- ----------------------------
-- Table structure for z_order
-- ----------------------------
DROP TABLE IF EXISTS `z_order`;
CREATE TABLE `z_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(30) NOT NULL DEFAULT '' COMMENT '订单号',
  `shop_id` int(11) DEFAULT '0' COMMENT '商家id/shop表id',
  `buy_num` int(11) DEFAULT '0' COMMENT '购买总数',
  `all_money` decimal(10,2) DEFAULT '0.00' COMMENT '订单总价',
  `pay_money` decimal(10,2) DEFAULT '0.00' COMMENT '实际支付金额',
  `remarks` varchar(255) NOT NULL DEFAULT '' COMMENT '订单备注',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '联系人',
  `phone` varchar(15) NOT NULL DEFAULT '' COMMENT '联系电话',
  `province` varchar(30) NOT NULL DEFAULT '' COMMENT '省',
  `city` varchar(30) NOT NULL DEFAULT '' COMMENT '市',
  `area` varchar(30) NOT NULL DEFAULT '' COMMENT '区',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '详细地址',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1待付款；2未发货；3已发货；4已完成',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `is_look` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1未阅；2已阅',
  `logistics_state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发货状态(0未发货,1已发货,2已签收)',
  `logistics_id` int(11) NOT NULL DEFAULT '0' COMMENT '发货快递公司ID',
  `logistics_name` varchar(255) NOT NULL DEFAULT '' COMMENT '发货快递公司名称',
  `logistics_code` varchar(255) NOT NULL DEFAULT '' COMMENT '发货快递公司编码',
  `logistics_no` varchar(100) NOT NULL DEFAULT '' COMMENT '发货快递单号',
  `logistics_time` int(11) NOT NULL DEFAULT '0' COMMENT '发货时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of z_order
-- ----------------------------

-- ----------------------------
-- Table structure for z_order_list
-- ----------------------------
DROP TABLE IF EXISTS `z_order_list`;
CREATE TABLE `z_order_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '商家id/shop表id',
  `order_sn` varchar(30) NOT NULL DEFAULT '' COMMENT '订单号',
  `buy_num` int(11) NOT NULL DEFAULT '0' COMMENT '购买数量',
  `goods_id` int(10) NOT NULL DEFAULT '0' COMMENT 'reserve_goods表id',
  `label_id` int(11) NOT NULL DEFAULT '0' COMMENT '标签id',
  `label_name` varchar(50) NOT NULL DEFAULT '' COMMENT '标签名称',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '商品名称',
  `img` varchar(255) NOT NULL DEFAULT '' COMMENT '商品封面图',
  `front_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '预付款',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `goods_attr_id` int(10) NOT NULL DEFAULT '0' COMMENT '商品规格id',
  `goods_attr` varchar(1000) NOT NULL DEFAULT '' COMMENT '商品规格',
  `repair_time` int(11) NOT NULL DEFAULT '0' COMMENT '联保时长/天',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `city_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '城市合伙人购买价格',
  `shop_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '门店合伙人购买价格',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单商品表';

-- ----------------------------
-- Records of z_order_list
-- ----------------------------

-- ----------------------------
-- Table structure for z_other
-- ----------------------------
DROP TABLE IF EXISTS `z_other`;
CREATE TABLE `z_other` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text COMMENT '内容详情',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1弹框通知',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='其他';

-- ----------------------------
-- Records of z_other
-- ----------------------------
INSERT INTO `z_other` VALUES ('1', '祝大家2020新年快', '<p>祝大家新年快祝大家新年快祝大家新年快祝大家新年快祝大家新年快祝大家新年快祝大家新年快祝大家新年快</p>', '1', '1', '1572504095', '1572506525');

-- ----------------------------
-- Table structure for z_point_change
-- ----------------------------
DROP TABLE IF EXISTS `z_point_change`;
CREATE TABLE `z_point_change` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '门店id',
  `order_sn` varchar(30) NOT NULL DEFAULT '' COMMENT '订单号',
  `point` varchar(10) NOT NULL DEFAULT '' COMMENT '积分',
  `type` int(255) DEFAULT '1' COMMENT '1邀请获得；2消费获得；3分销获得；4使用',
  `msg` varchar(255) DEFAULT NULL COMMENT '描述',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='积分变化记录';

-- ----------------------------
-- Records of z_point_change
-- ----------------------------

-- ----------------------------
-- Table structure for z_point_goods
-- ----------------------------
DROP TABLE IF EXISTS `z_point_goods`;
CREATE TABLE `z_point_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '分类id',
  `brand_id` int(11) NOT NULL DEFAULT '0' COMMENT '品牌id',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '品名',
  `img` varchar(255) NOT NULL DEFAULT '' COMMENT '封面图',
  `images` varchar(1000) NOT NULL DEFAULT '' COMMENT '相册',
  `point` int(11) NOT NULL DEFAULT '0' COMMENT '需要的积分',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `freight` varchar(10) NOT NULL DEFAULT '' COMMENT '运费',
  `type` varchar(50) NOT NULL DEFAULT '' COMMENT '型号',
  `content` text COMMENT '内容详情',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='积分兑换商品';

-- ----------------------------
-- Records of z_point_goods
-- ----------------------------

-- ----------------------------
-- Table structure for z_point_goods_attr
-- ----------------------------
DROP TABLE IF EXISTS `z_point_goods_attr`;
CREATE TABLE `z_point_goods_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `point_goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '积分商品id',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `point` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='积分商品规格';

-- ----------------------------
-- Records of z_point_goods_attr
-- ----------------------------

-- ----------------------------
-- Table structure for z_point_goods_brand
-- ----------------------------
DROP TABLE IF EXISTS `z_point_goods_brand`;
CREATE TABLE `z_point_goods_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `topid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='积分商品品牌';

-- ----------------------------
-- Records of z_point_goods_brand
-- ----------------------------

-- ----------------------------
-- Table structure for z_point_goods_cate
-- ----------------------------
DROP TABLE IF EXISTS `z_point_goods_cate`;
CREATE TABLE `z_point_goods_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `topid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='积分商品分类';

-- ----------------------------
-- Records of z_point_goods_cate
-- ----------------------------

-- ----------------------------
-- Table structure for z_point_order
-- ----------------------------
DROP TABLE IF EXISTS `z_point_order`;
CREATE TABLE `z_point_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(30) NOT NULL DEFAULT '' COMMENT '订单号',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id/user表id',
  `all_num` int(11) NOT NULL DEFAULT '0' COMMENT '商品兑换总数',
  `use_point` int(11) NOT NULL DEFAULT '0' COMMENT '使用总积分',
  `all_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总价格',
  `remarks` varchar(255) NOT NULL DEFAULT '' COMMENT '订单备注',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `freight` int(11) NOT NULL DEFAULT '0' COMMENT '运费',
  `addr_id` int(11) NOT NULL DEFAULT '0' COMMENT '地址id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '收件人',
  `phone` varchar(15) NOT NULL DEFAULT '' COMMENT '联系电话',
  `province` varchar(30) NOT NULL DEFAULT '' COMMENT '省',
  `city` varchar(30) NOT NULL DEFAULT '' COMMENT '市',
  `area` varchar(30) NOT NULL DEFAULT '' COMMENT '区',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '详细地址',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1待兑换；2未发货；3已发货；4已完成',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `logistics_state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发货状态(0未发货,1已发货,2已签收)',
  `logistics_id` int(11) NOT NULL DEFAULT '0' COMMENT '发货快递公司ID',
  `logistics_name` varchar(255) NOT NULL DEFAULT '' COMMENT '发货快递公司名称',
  `logistics_code` varchar(255) NOT NULL DEFAULT '' COMMENT '发货快递公司编码',
  `logistics_no` varchar(255) NOT NULL DEFAULT '' COMMENT '发货快递单号',
  `logistics_time` int(11) NOT NULL DEFAULT '0' COMMENT '发货时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of z_point_order
-- ----------------------------

-- ----------------------------
-- Table structure for z_point_order_list
-- ----------------------------
DROP TABLE IF EXISTS `z_point_order_list`;
CREATE TABLE `z_point_order_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id/user表id',
  `order_sn` varchar(30) NOT NULL DEFAULT '' COMMENT '订单号',
  `buy_num` int(11) NOT NULL DEFAULT '0' COMMENT '购买数量',
  `point_goods_id` int(10) NOT NULL DEFAULT '0' COMMENT 'point_goods表id',
  `cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '标签id',
  `cate_name` varchar(50) NOT NULL DEFAULT '' COMMENT '标签名称',
  `brand_id` int(11) NOT NULL DEFAULT '0' COMMENT '品牌id',
  `brand_name` varchar(50) DEFAULT '' COMMENT '品牌名称',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '商品名称',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '品名',
  `type` varchar(50) NOT NULL DEFAULT '' COMMENT '型号',
  `img` varchar(255) NOT NULL DEFAULT '' COMMENT '商品封面图',
  `images` varchar(1000) NOT NULL DEFAULT '' COMMENT '相册',
  `point` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `freight` int(11) NOT NULL DEFAULT '0' COMMENT '运费',
  `goods_attr_id` int(10) NOT NULL DEFAULT '0' COMMENT '商品规格id/point_goods_attr表id',
  `goods_attr` varchar(1000) NOT NULL DEFAULT '' COMMENT '商品规格',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单商品表';

-- ----------------------------
-- Records of z_point_order_list
-- ----------------------------

-- ----------------------------
-- Table structure for z_red_pack
-- ----------------------------
DROP TABLE IF EXISTS `z_red_pack`;
CREATE TABLE `z_red_pack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `look_uid` int(11) NOT NULL DEFAULT '0' COMMENT '访问人id',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `money` varchar(10) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1注册领取；2预付款领取；3分享领取；4提现申请；5提现成功；6提现失败',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `bank_id` int(11) NOT NULL DEFAULT '0' COMMENT '银行id',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '银行名称',
  `bank_code` varchar(30) NOT NULL DEFAULT '' COMMENT '银行编号',
  `bank_num` varchar(50) NOT NULL DEFAULT '' COMMENT '银行卡号',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '提现人姓名',
  `cash_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1提现到银行卡；2提现到微信',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='红包明细表';

-- ----------------------------
-- Records of z_red_pack
-- ----------------------------

-- ----------------------------
-- Table structure for z_refit
-- ----------------------------
DROP TABLE IF EXISTS `z_refit`;
CREATE TABLE `z_refit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topid` int(11) NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `sort` int(11) NOT NULL DEFAULT '1' COMMENT '排序 倒序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='改装信息表';

-- ----------------------------
-- Records of z_refit
-- ----------------------------
INSERT INTO `z_refit` VALUES ('5', '0', '升级LED头灯', '2', '1', '1566459903', '1566459903');
INSERT INTO `z_refit` VALUES ('4', '0', '透镜改装', '1', '1', '1566459888', '1566459888');
INSERT INTO `z_refit` VALUES ('6', '0', '车灯', '100', '1', '1569720848', '1569720848');
INSERT INTO `z_refit` VALUES ('7', '0', '车灯', '99', '1', '1572229683', '1572229683');

-- ----------------------------
-- Table structure for z_reserve
-- ----------------------------
DROP TABLE IF EXISTS `z_reserve`;
CREATE TABLE `z_reserve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(100) NOT NULL DEFAULT '' COMMENT '预约单号',
  `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '门店id',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级id',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `label_id` int(11) NOT NULL DEFAULT '0' COMMENT '标签id',
  `label_name` varchar(50) NOT NULL DEFAULT '' COMMENT '标签名称',
  `shop_gid` int(11) NOT NULL DEFAULT '0' COMMENT 'shop_goods主键',
  `res_gid` int(11) NOT NULL DEFAULT '0' COMMENT '预约商品id/reserve_goods表主键',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `img` varchar(255) NOT NULL DEFAULT '' COMMENT '封面图片',
  `buy_num` int(11) NOT NULL DEFAULT '0' COMMENT '购买数量',
  `front_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '预付款',
  `wait_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '待付款',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `all_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总价格',
  `pay_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际支付金额',
  `pay_allmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际支付总金额',
  `coupon_id` int(11) NOT NULL DEFAULT '0' COMMENT '优惠券id',
  `coupon_money` int(11) NOT NULL DEFAULT '0' COMMENT '优惠金额',
  `repair_time` int(11) NOT NULL DEFAULT '0' COMMENT '联保时长/年',
  `reserve_time` int(11) NOT NULL DEFAULT '0' COMMENT '预约时间',
  `end_time` int(11) NOT NULL DEFAULT '0' COMMENT '联保到期时间',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '姓名',
  `phone` varchar(15) NOT NULL DEFAULT '' COMMENT '手机号',
  `car_number` varchar(15) NOT NULL DEFAULT '' COMMENT '车牌号',
  `goods_num` varchar(50) NOT NULL DEFAULT '' COMMENT '产品序列号',
  `refund_reason` varchar(255) NOT NULL DEFAULT '' COMMENT '退款原因',
  `fail_reason` varchar(255) NOT NULL DEFAULT '' COMMENT '退款失败原因',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1待支付；2未服务(已支付定金)；3已服务(已支付总金)；4取消中(申请退款)；5已取消(已退款)；6申请失败(退款失败)',
  `serial_num` varchar(255) NOT NULL DEFAULT '' COMMENT '使用的序列号',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `point` int(11) NOT NULL DEFAULT '0' COMMENT '可得积分',
  `is_look` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1未阅；2已阅',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='预约信息表';

-- ----------------------------
-- Records of z_reserve
-- ----------------------------

-- ----------------------------
-- Table structure for z_reserve_goods
-- ----------------------------
DROP TABLE IF EXISTS `z_reserve_goods`;
CREATE TABLE `z_reserve_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label_id` int(11) NOT NULL DEFAULT '0' COMMENT '标签id',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `img` varchar(255) NOT NULL DEFAULT '' COMMENT '封面图',
  `video` varchar(255) NOT NULL DEFAULT '' COMMENT '视频',
  `front_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '预付款',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `point` int(11) NOT NULL DEFAULT '0' COMMENT '可得积分',
  `repair_time` int(11) NOT NULL DEFAULT '0' COMMENT '联保时长/年',
  `content` text COMMENT '内容详情',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='产品表';

-- ----------------------------
-- Records of z_reserve_goods
-- ----------------------------

-- ----------------------------
-- Table structure for z_serial_num
-- ----------------------------
DROP TABLE IF EXISTS `z_serial_num`;
CREATE TABLE `z_serial_num` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attr_id` int(10) DEFAULT '0' COMMENT 'attr表id',
  `number` varchar(255) NOT NULL DEFAULT '' COMMENT '序列号',
  `state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1未使用；2已使用',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品序列号';

-- ----------------------------
-- Records of z_serial_num
-- ----------------------------

-- ----------------------------
-- Table structure for z_shop
-- ----------------------------
DROP TABLE IF EXISTS `z_shop`;
CREATE TABLE `z_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invite_code` varchar(40) NOT NULL DEFAULT '' COMMENT '邀请码',
  `top_code` varchar(40) NOT NULL DEFAULT '' COMMENT '上级邀请码',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `shop_name` varchar(50) NOT NULL DEFAULT '' COMMENT '门店名称',
  `city_id` int(11) NOT NULL DEFAULT '0' COMMENT 'citys表id',
  `province` varchar(50) NOT NULL DEFAULT '' COMMENT '省',
  `city` varchar(50) NOT NULL DEFAULT '' COMMENT '市',
  `area` varchar(50) NOT NULL DEFAULT '' COMMENT '区',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '详细地址',
  `lng` varchar(200) NOT NULL DEFAULT '' COMMENT '经度',
  `lat` varchar(200) NOT NULL DEFAULT '' COMMENT '纬度',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '负责人姓名',
  `phone` varchar(30) NOT NULL DEFAULT '' COMMENT '负责人电话',
  `tel` varchar(30) NOT NULL DEFAULT '' COMMENT '其他电话',
  `telephone` varchar(30) NOT NULL DEFAULT '' COMMENT '服务电话',
  `job_time` varchar(100) NOT NULL DEFAULT '' COMMENT '营业时间',
  `project` varchar(255) NOT NULL DEFAULT '' COMMENT '本店经营项目',
  `other_project` varchar(255) NOT NULL DEFAULT '' COMMENT '其他经营项目',
  `other_project_img` varchar(255) NOT NULL DEFAULT '' COMMENT '其他项目图片',
  `pwd` varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
  `license` varchar(255) NOT NULL DEFAULT '' COMMENT '营业执照',
  `idcard_img` varchar(255) NOT NULL DEFAULT '' COMMENT '身份证图片',
  `examine` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态：0申请中；1审核通过；2未通过',
  `pic` varchar(255) NOT NULL DEFAULT '' COMMENT '店铺图片',
  `img` varchar(255) NOT NULL DEFAULT '' COMMENT '店铺相册',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '合作类型：1城市合伙人；2门店合伙人',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `examine_time` int(11) NOT NULL DEFAULT '0' COMMENT '审核时间',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商家余额',
  `term` int(3) NOT NULL DEFAULT '0' COMMENT '分红期限/年',
  `end_time` int(11) NOT NULL DEFAULT '0' COMMENT '分红到期时间',
  `state` tinyint(11) NOT NULL DEFAULT '1' COMMENT '1未付款；2已付款；3已过期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='门店表';

-- ----------------------------
-- Records of z_shop
-- ----------------------------
INSERT INTO `z_shop` VALUES ('1', '874830', '123', '1', '门店1', '2', '广东省', '广州市', '', '广州天河东圃', '113.399551', '23.124001', '阿瑟', '13111111111', '13122222222', '', '', '本店项目', '其他项目', '/uploads/20191112/255a15572eca1b286783cf0e552f2bea.jpg,/uploads/20191112/9b614c6681c471ec1e8a4276e453f90f.jpg', 'f379eaf3c831b04de153469d1bec345e', '/uploads/20191112/7383b055a9935bcaf8aa18a01e381792.jpg,/uploads/20191112/c7ee9b5259ce7da5d16d3f317d13912d.jpg', '/uploads/20191112/f4f2d46e33baaedd0ba1d930e7b59a16.jpg,/uploads/20191112/25d74b180181a4d110ca55bc06bb79af.jpg', '1', '', '/uploads/20191112/0e22a9ea0c012fcc005643cbb7b370b4.jpg,/uploads/20191112/bdcfacc52223b86b27bfbe32295c1477.jpg,/uploads/20191112/b8c4530c45e1bc13eda4026b9960f539.jpg,/uploads/20191112/73c7ece462ace2769623d90ae456864a.jpg', '1', '1', '1573627135', '1573525531', '1573627135', '0.00', '0', '0', '1');

-- ----------------------------
-- Table structure for z_shop_goods
-- ----------------------------
DROP TABLE IF EXISTS `z_shop_goods`;
CREATE TABLE `z_shop_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(100) NOT NULL DEFAULT '' COMMENT '订单号',
  `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '商家id/shop表id',
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT 'reserve_goods表id',
  `label_id` int(11) NOT NULL DEFAULT '0' COMMENT '标签id',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `img` varchar(255) NOT NULL DEFAULT '' COMMENT '封面图',
  `video` varchar(255) NOT NULL DEFAULT '' COMMENT '视频',
  `front_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '预付款',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `point` int(11) NOT NULL DEFAULT '0' COMMENT '可得积分',
  `repair_time` int(11) NOT NULL DEFAULT '0' COMMENT '联保时长/天',
  `content` text COMMENT '内容详情',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='门店商品';

-- ----------------------------
-- Records of z_shop_goods
-- ----------------------------

-- ----------------------------
-- Table structure for z_shop_goods_attr
-- ----------------------------
DROP TABLE IF EXISTS `z_shop_goods_attr`;
CREATE TABLE `z_shop_goods_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(100) NOT NULL DEFAULT '' COMMENT '订单号',
  `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '门店id',
  `attr_id` int(11) NOT NULL DEFAULT '0' COMMENT 'attr主键id',
  `shop_goods_id` int(11) NOT NULL COMMENT 'shop_goods表id',
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '平台商品id',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '属性名称',
  `city_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '城市合伙人购买价格',
  `shop_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '门店合伙人购买价格',
  `number` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1显示；2隐藏',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `city_percent_one` varchar(5) NOT NULL DEFAULT '' COMMENT '城市合伙人一级分红比例',
  `city_percent_second` varchar(5) NOT NULL DEFAULT '' COMMENT '城市合伙人二级分红比例',
  `shop_percent_one` varchar(5) NOT NULL DEFAULT '' COMMENT '门店合伙人一级分红比例',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='门店商品属性';

-- ----------------------------
-- Records of z_shop_goods_attr
-- ----------------------------

-- ----------------------------
-- Table structure for z_shop_register_pay
-- ----------------------------
DROP TABLE IF EXISTS `z_shop_register_pay`;
CREATE TABLE `z_shop_register_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(30) NOT NULL DEFAULT '' COMMENT '订单号',
  `shop_id` int(11) DEFAULT '0' COMMENT '商家id/shop表id',
  `pay_money` decimal(10,2) DEFAULT '0.00' COMMENT '实际支付金额',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `term` int(11) NOT NULL DEFAULT '0' COMMENT '期限',
  `end_time` int(11) NOT NULL DEFAULT '0' COMMENT '到期时间',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '注册类型：1城市合伙人；2门店合伙人',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1待支付；2已支付',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商家注册支付表';

-- ----------------------------
-- Records of z_shop_register_pay
-- ----------------------------

-- ----------------------------
-- Table structure for z_shop_serial_num
-- ----------------------------
DROP TABLE IF EXISTS `z_shop_serial_num`;
CREATE TABLE `z_shop_serial_num` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(100) NOT NULL DEFAULT '' COMMENT '订单号',
  `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '商家id',
  `shop_attr_id` int(10) NOT NULL DEFAULT '0' COMMENT 'shop_goods_attr表id',
  `number` varchar(255) NOT NULL DEFAULT '' COMMENT '序列号',
  `state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1未使用；2已使用',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `phone` varchar(15) NOT NULL DEFAULT '' COMMENT '会员手机号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品序列号';

-- ----------------------------
-- Records of z_shop_serial_num
-- ----------------------------

-- ----------------------------
-- Table structure for z_user
-- ----------------------------
DROP TABLE IF EXISTS `z_user`;
CREATE TABLE `z_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `head_img` varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '姓名',
  `phone` varchar(15) NOT NULL DEFAULT '' COMMENT '手机号',
  `pwd` varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
  `car_type` varchar(255) NOT NULL DEFAULT '' COMMENT '车型',
  `license_plate` varchar(100) NOT NULL DEFAULT '' COMMENT '车牌',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别 1男 2女',
  `province` varchar(255) NOT NULL DEFAULT '' COMMENT '省份',
  `city` varchar(255) NOT NULL DEFAULT '' COMMENT '城市',
  `openid` varchar(255) NOT NULL DEFAULT '' COMMENT '用户openid',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1 正常 2冻结',
  `subscribe` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否关注公众号 1表示关注 0表示未关注',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `point` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `token` varchar(100) NOT NULL DEFAULT '',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of z_user
-- ----------------------------
INSERT INTO `z_user` VALUES ('1', '哎呀จุ๊บ', 'https://wx.qlogo.cn/mmopen/vi_32/wdp7zUIbdd2EuQicJJTiaSLaxKAicD6CXgbVI6IdbLU7ibupcYS0cecypcLPk4iaFmJFS97iccdgcW6Auu9YRjUQLFyA/132', '姓名', '13111111111', '', '车型', '车牌', '1', '广东', '广州', 'oI9l45NEbc6BXa6AZBC7GHZ-8mrk', '1', '0', '1569720582', '1573175092', '0', 'c0ae7ac7deda9de3bfc809d66a503539', '0.00', '0');
INSERT INTO `z_user` VALUES ('2', '12', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTI2xqHWrQib19WFBNW7cOShbUs4doPfZcho2Xkn6vMOdI3upHbA0Ng9rick9tBzVJmibAKicicfd1Tcp8g/132', '吴敌', '13189176760', '', '红旗带话筒', '粤V888888', '1', '广东', '揭阳', 'oI9l45Ln8GMipe3wkV_PSuBPmyeg', '1', '0', '1569720633', '1569753774', '0', '13b19a15ada472d1d9af443ce2adc8a5', '0.00', '1');
INSERT INTO `z_user` VALUES ('4', 'A\\ud83d\\udc8b网站建设、全国营销', 'https://wx.qlogo.cn/mmopen/vi_32/yjtM0zicoXItzPukIGllBdViaWibupm1CCA3jicibWNsyKRHVjRgSFJ9mp5gugyCdR9Fm2g7XJdSQDTTf97plpia38iaw/132', '', '', '', '', '', '1', '江西', '赣州', 'oI9l45HJ9Y91e8k8_m5m5VxvUgmE', '1', '0', '1569737997', '1571968205', '0', '5a8d1f897e184682dcdd9b0b7ccbfa97', '0.00', '15');
INSERT INTO `z_user` VALUES ('5', 'C.C', 'https://wx.qlogo.cn/mmopen/vi_32/hMTrLEeChV3U2aGiaDS7NA8afSzEvX68GA74X3SZqeM71FxIpgNibNXh7NZSPzMA9jyYDTEVxVvG9yqY45fQchbA/132', '', '', '', '', '', '2', '', '', 'oI9l45HdS5RCqKvAYjNPqmQAgs4M', '2', '0', '1569752947', '1572856361', '0', 'ff963de9fc77906865f919928cebd624', '0.00', '0');
INSERT INTO `z_user` VALUES ('7', '鉍', 'https://wx.qlogo.cn/mmopen/vi_32/kTXq3PElnds8oh8hKONAoTsy4bhibuGyZ3Dm4JxIr3DqrRVXkPpD1WvfykGGNhGvJnYS0LKUYSYGKgBQZ5VDFJw/132', '', '', '', '', '', '1', '广东', '汕尾', 'oI9l45IY3eUA2v_NYsA8PCM7AoRc', '1', '0', '1569754432', '1572420927', '0', '9b1b59f09c6ddef3787ec1db0de01183', '0.00', '0');
INSERT INTO `z_user` VALUES ('8', '\\ud83c\\udfb4', 'https://wx.qlogo.cn/mmopen/vi_32/avC9ZIVDVYaCollCRNQzxxkTVAnzhTUFAPoF4TFOtUDAIYts0juW7ic4eTNic926T1o2cu4k1X3pRC7hbSj43Fbw/132', '', '', '', '', '', '1', '广东', '揭阳', 'oI9l45LxgBEaiZUbB3GWcIBPWqg4', '1', '0', '1569845632', '1569845632', '0', 'e3ff2512a94c0435cb7ff7dc36fc5911', '0.00', '0');
INSERT INTO `z_user` VALUES ('9', '乐享东艺总部一张冉', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83erPkNNWvbrDKWkyrLME1CYibicKhy1byeCCoVOKrB9EG01ibiaQ0at9j6u1lYt6lfSibICHI9p6Bnlqicsg/132', '张冉', '13803367401', '', 'jeep', '冀A188M8', '1', '河北', '石家庄', 'oI9l45DWVof26NFUBDPToTHuWxBo', '1', '0', '1570333620', '1570333620', '0', '1d1dee12196b8482e1e775ec7949c077', '0.00', '0');
INSERT INTO `z_user` VALUES ('10', '悦照车灯', 'https://wx.qlogo.cn/mmopen/vi_32/SzDibyiad8PiaGCEcLfpmlqMfpkSicrFoUWsqWiajO7ibDhaAYD2Zr2dwibms94ewIRLKHyfu4LTbIQ4ib2Micias3ZN4nYw/132', '', '', '', '', '', '1', '广东', '广州', 'oI9l45JoYSAHbJGe8EC0HnyBG1CY', '1', '0', '1570334182', '1570334182', '0', '419be49456335216785e38ccf9dd7dfe', '0.00', '0');
INSERT INTO `z_user` VALUES ('11', '谜一样的男人', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKfFk0I54QjIPxhRzxku1ptz4H5EG08TDIeyxwBbK0lu1SqYiaibB8PUeEDmD2MicaH6cHsQBFeh7Dcw/132', '', '', '', '', '', '1', '⁡⁢', '受相关部门保护  不予公开', 'oI9l45CCq2h93SNCJ_Se6vkv2-LU', '1', '0', '1570586995', '1570586995', '0', '73f02f973875666a4342b058e0f8e198', '0.00', '0');
INSERT INTO `z_user` VALUES ('12', '离机', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTL1Isv9dibicmgcjKfEx7Jp1pKCt5Akbr7Mic2eBWYyVqCKqLLBgBgGCg7dNiahldxOiaQMwQYAe5QH1icg/132', '', '', '', '', '', '0', '', '', 'oI9l45JBJ_uGWVVCDW1N0iIEhYsI', '1', '0', '1570587570', '1570587570', '0', '44472527945c6e6b8be0e53079800dae', '0.00', '0');
INSERT INTO `z_user` VALUES ('13', 'Leong', 'https://wx.qlogo.cn/mmopen/vi_32/HnBaia1K1icyKSxACicDicg35tBbWChiaBJaIxiaicZThYmEOYsrz9t6CHMIJKicNFpTlIBmWgnoYelibuxQ52y89ModlIg/132', '', '', '', '', '', '2', '广东', '湛江', 'oI9l45Gfrzzzkss6tGLVRiDS5Vno', '1', '0', '1571724112', '1571724112', '0', '8f953e01001d455c7f5a1838abf1ad77', '0.00', '0');
INSERT INTO `z_user` VALUES ('14', 'Tina', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTI60Bmoc1CkZYQ1UIv13vIVjI6TCeKmw6HbDvmQPA7ggohy2iaW7jCvIwTTYR2gk8SBKqzPkWBTHfQ/132', '', '', '', '', '', '2', '', '', 'oI9l45GrY4rMGlLkurv6cVe6Hmqo', '1', '0', '1571725698', '1571725698', '0', 'c714fb7744274862c32d61aac0dd11d2', '0.00', '0');
INSERT INTO `z_user` VALUES ('15', '\\ud83c\\uddf1 \\ud83c\\uddef \\ud83c\\udde8', 'https://wx.qlogo.cn/mmopen/vi_32/at0f2hZI1icia2PE24GC0z81NkN9xqEIzrVVvnEfzbjWuWPgOyPLu71ofAdALcyw3wKAhicxSsFL7WeolR9C0vEKw/132', '姓名', '13111111111', '', '车型', '车牌', '1', '广东', '广州', 'oI9l45FwfS9tflzLDESfCcGj5Jbw', '1', '0', '1571752808', '1573261530', '0', '38f81120b889b33419ccf273e369cf26', '0.00', '0');
INSERT INTO `z_user` VALUES ('16', '岁月如歌', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIILItkz2Uojibc79xpqJsmaM5SWPVzyFYNN3ibhlA3xZnJEYAStn5IUrc5TOCibVtupHY5zcv1aSLEQ/132', '', '', '', '', '', '1', '广东', '广州', 'oI9l45GPNN4JhvXhMTgQgmFfYolQ', '1', '0', '1571756076', '1571756076', '0', 'ca4714ec046e3cedf20f81eb295fc6c3', '0.00', '0');
INSERT INTO `z_user` VALUES ('17', '郑慧芸', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKNWjk8eowANC0hCXfYvCvwRzQzRVA4mzg3EJNVewJ7BzoFm2iauaYbH3SU1FkhAKBPLN1S80nlQnA/132', '', '', '', '', '', '2', '广东', '广州', 'oI9l45AHCkT6F4AXjsmbo11wxCOY', '1', '0', '1571918138', '1571918138', '0', '6be826907593ce5e414af9bf6929d730', '0.00', '0');
INSERT INTO `z_user` VALUES ('18', '李瑞明', 'https://wx.qlogo.cn/mmopen/vi_32/ccCGDRLarBTD9uicQjbUp091EubUhLwqN1mBH7xSaMiaxokNE9o6eDcE506dPpoY7S8YdqMgSCpQNdCymgFE2gGA/132', '李', '18588875935', '', '奥迪A6', '粤A88888', '1', '广东', '广州', 'oI9l45A5Z9LUDoC_A3Ph0gE4r6WE', '1', '0', '1571919518', '1571919518', '0', 'f01275790ac1898e9ec4f97afa71d9ad', '0.00', '0');
INSERT INTO `z_user` VALUES ('19', 'Aimee', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTI5N17mzayc5D6uO20cJiaHAh4zRvC0TDARFlW4v5jUEqibsknQl1jqE5KBROoYsu5wXa3picxIpy5Iw/132', '', '', '', '', '', '2', '', '', 'oI9l45H-Bgnh67UkAvc-_8fF_AXU', '1', '0', '1572072107', '1572072107', '0', 'ba42feaf06ca83bd716a6d40676cc9fd', '0.00', '18');
INSERT INTO `z_user` VALUES ('20', 'Mark', 'https://wx.qlogo.cn/mmopen/vi_32/VpVV7icv5Y4RwTiaPDf06Nb9IQhO6ic5wDVpubFQWV4SCC4uHBQ39iawZF6J522XAeq7BbPkSsicdOwxJjuqMjs6zEQ/132', '', '', '', '', '', '1', '广东', '广州', 'oI9l45IdRmutpoAXLq-eW7P94yBA', '1', '0', '1572073584', '1572073584', '0', 'fb6a3084defdf029051d78b18da9d139', '0.00', '0');
INSERT INTO `z_user` VALUES ('21', '蓝色妖姬', 'https://wx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEKYa5XAbMIGrnxesicbNicLnXnpKTehJhnpOyLLz7ADaQWh5exHXjm00psE8NdwxSspEw9Oa2mrQtbw/132', '', '', '', '', '', '1', 'Guangdong', 'Shenzhen', 'oI9l45GhW0I7WN0T_1xD98kK5hT0', '1', '0', '1572659825', '1572659825', '0', 'd4198a464b4c30536958dfe9beab34d2', '0.00', '0');
INSERT INTO `z_user` VALUES ('22', '\\ud83c\\udf38满满\\ud83d\\udc51', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIDX3BMTshjB6gMaoVAlqR0NAq5lIBX32sym1NFoxPdxJEgeHxgqIdUMox8BAG0Bn1pym9BicvHr5w/132', '', '', '', '', '', '2', '广东', '广州', 'oI9l45Mkmx9a1skqQOSVrEVT52Qs', '1', '0', '1572830813', '1572830813', '0', 'c291fcf942729b561ceceead340c4f20', '0.00', '0');
INSERT INTO `z_user` VALUES ('23', '豪仔', 'https://wx.qlogo.cn/mmopen/vi_32/ZRSVXKs2hboy0A3zxTyg84icicNiajIOq2VVEueiaN1DiaSoUz8Lh9pgcnrcTMkBI3zyx5ttjtLnQiaD4MGCvm4TiaZOA/132', '', '', '', '', '', '1', '广东', '汕头', 'oI9l45KKQAIGp3yalLybpav2_8Y4', '1', '0', '1573086696', '1573086696', '0', 'f20d86ddd0d343ea65964aeb06aa5641', '0.00', '0');
INSERT INTO `z_user` VALUES ('24', '小何V8', 'https://wx.qlogo.cn/mmopen/vi_32/kfOyA3dldfGe2fCnibM9PRiar8S59qBx56JdDQ1xXia4ibjE099BS12tlfWu0Vtu8WR7GGsrzmkDxVUd9RPpjXSrtA/132', '', '', '', '', '', '1', '广东', '茂名', 'oI9l45OZ089wsvTUsiJku3t5Sxwk', '1', '0', '1573093408', '1573093408', '0', '6d3675bb9142d4feeeba090e817c7fe4', '0.00', '0');
INSERT INTO `z_user` VALUES ('25', '辛福', 'https://wx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEIovR9aSfWXURkia6cJRuymR8K12MvV8bQENtwIsCRlbQNEQib4KDOgD8ibVs7kHf21xlCIEgIC6GPmg/132', '', '', '', '', '', '2', 'Anhui', 'Xuancheng', 'oI9l45Hx4SjRxhNERhsxl-XY6vxk', '1', '0', '1573107706', '1573107706', '0', '2a92bd1bb2c8c0a34271d3e2693ac441', '0.00', '0');
INSERT INTO `z_user` VALUES ('26', 'Lemon-雷勇', 'https://wx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEKkmnLkafOOwQf4oF6cbXTLUOhfVo9SaclmXYflEOJRIHUWDL8Qia3846y0hqIREHiaLAqsQxovlQ6w/132', '', '', '', '', '', '1', '湖北', '武汉', 'oI9l45LiQrfkE2tH1Hv_hNYOAyOQ', '1', '0', '1573116669', '1573116669', '0', '27547f465932e5e6692b7e98afae8237', '0.00', '18');
INSERT INTO `z_user` VALUES ('27', '超_越梦想', 'https://wx.qlogo.cn/mmopen/vi_32/INc61dATFS8HfyZiazQzPibeFy0k5LaicpLic14A4oRtvp10kZ4BBn5eoFfbZ0EI8qR3gSlNMuPpXgoOUKYXnk9IFg/132', '', '', '', '', '', '2', 'Shandong', 'Yantai', 'oI9l45FDuEqDhj9xv-v346BzAoy0', '1', '0', '1573209023', '1573209023', '0', 'e8a48afd3d3918f0c37fff0c7e3604b4', '0.00', '0');
INSERT INTO `z_user` VALUES ('28', '金鑫', 'https://wx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEIVYicfd2Vw8fhicgJJRqS5em80a62wicXGgj60Y94ppW0bTyNeib2Qm171eCaGJOwV3NbklFqO353knw/132', '', '', '', '', '', '1', 'Anhui', 'Bengbu', 'oI9l45Ma9QxwN-WwBfljX6NuB34Q', '1', '0', '1573265460', '1573265460', '0', '628444ee66bfed985781795559da2f18', '0.00', '0');
INSERT INTO `z_user` VALUES ('29', '秦R', 'https://wx.qlogo.cn/mmopen/vi_32/lbpZI5quY0ibkicqc9DrBpl9fhFwqlcokiaH2vTwlfpibicp0ialtiaYw9fbKxl3iauC1YRDuib7PduJODjupZZLVSmhcNA/132', '', '', '', '', '', '1', '广东', '广州', 'oI9l45DPDOP4zXoqTfI4vn2diwmo', '1', '0', '1573542159', '1573542159', '0', 'aff0e3df71e16ec522fe81eb36c143b4', '0.00', '0');

-- ----------------------------
-- Table structure for z_user_coupon
-- ----------------------------
DROP TABLE IF EXISTS `z_user_coupon`;
CREATE TABLE `z_user_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` varchar(255) NOT NULL DEFAULT '' COMMENT '商家ID',
  `uid` varchar(255) NOT NULL DEFAULT '' COMMENT '用户ID',
  `coupon_id` int(10) DEFAULT '0' COMMENT '优惠券id',
  `coupon_code` varchar(100) NOT NULL DEFAULT '' COMMENT '券码',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `full_price` decimal(10,2) DEFAULT '0.00' COMMENT '条件金额',
  `less_price` decimal(10,2) DEFAULT '0.00' COMMENT '折扣金额',
  `day` int(11) DEFAULT '0' COMMENT '领取后的有效天数',
  `start_time` int(11) DEFAULT '0' COMMENT '领取开始时间',
  `end_time` int(11) DEFAULT NULL COMMENT '领取结束时间',
  `add_time` int(11) DEFAULT '0' COMMENT '领取时间',
  `status` tinyint(1) DEFAULT '1' COMMENT '1未使用2已使用',
  `day_time` int(11) DEFAULT '0' COMMENT '优惠券到期时间',
  `num` int(5) DEFAULT '1' COMMENT '一人能领多少张',
  `erm` varchar(255) NOT NULL DEFAULT '' COMMENT '优惠券二维码',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户优惠券表';

-- ----------------------------
-- Records of z_user_coupon
-- ----------------------------
DROP TRIGGER IF EXISTS `del_bank`;
DELIMITER ;;
CREATE TRIGGER `del_bank` AFTER DELETE ON `z_bank` FOR EACH ROW begin
     delete from tbkl_bank where bank_cate_id = old.id;
end
;;
DELIMITER ;

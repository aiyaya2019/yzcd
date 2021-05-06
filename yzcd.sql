/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : yzcd

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-11-13 14:41:51
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
INSERT INTO `z_abouts` VALUES ('1', '/uploads/20191010/964b4213751a94714ba8b76ccf0cbe58.mp4', '<p>aaaa11122222dfsdf<img class=\"fr-fin\" data-fr-image-preview=\"false\" alt=\"Image title\" src=\"/uploads/20191010/b281a8b412927f0ca312501518dd845e.png\" width=\"300\"></p>', '1', '1570689343', '1570689343');

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
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='权限表';

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
INSERT INTO `z_access` VALUES ('114', '商品分类', 'type', '', '0', '29', '1', '8', '1553050672', '1553050672');
INSERT INTO `z_access` VALUES ('113', '商品列表', 'index', '', '0', '29', '1', '9', '1552891706', '1552891706');
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
INSERT INTO `z_access` VALUES ('134', '会员提现', 'user_cash', '', '0', '40', '1', '1', '1569642180', '1569642180');
INSERT INTO `z_access` VALUES ('135', '商家提现', 'shop_cash', '', '0', '40', '1', '2', '1569642199', '1569642199');
INSERT INTO `z_access` VALUES ('136', '关于我们', 'about', '', '0', '31', '1', '1', '1570688581', '1570688581');
INSERT INTO `z_access` VALUES ('137', '城市列表', 'index', '', '0', '41', '1', '1', '1571283506', '1571283506');
INSERT INTO `z_access` VALUES ('138', '通知列表', 'index', '', '0', '42', '1', '1', '1572227278', '1572227278');
INSERT INTO `z_access` VALUES ('139', '弹框通知', 'index', '', '0', '43', '1', '1', '1572503932', '1572503932');

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
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='权限分类表';

-- ----------------------------
-- Records of z_access_type
-- ----------------------------
INSERT INTO `z_access_type` VALUES ('2', '后台管理', 'admins', 'icon-shezhi', '99', '1514197373', '1531962285');
INSERT INTO `z_access_type` VALUES ('29', '商品管理', 'goods', 'icon-shangpin', '9', '1552891675', '1552891692');
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
INSERT INTO `z_access_type` VALUES ('40', '提现管理', 'cash', 'icon-zhuanzhang', '0', '1569642157', '1569642254');
INSERT INTO `z_access_type` VALUES ('41', '城市控制器', 'citys', 'icon-guize', '0', '1571283347', '1571284112');
INSERT INTO `z_access_type` VALUES ('42', '站内通知', 'notices', 'icon-fasongxinxi', '0', '1572227251', '1572227659');
INSERT INTO `z_access_type` VALUES ('43', '信息管理', 'others', 'icon-xiaoxizhongxin', '0', '1572503869', '1572504001');

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
INSERT INTO `z_activities` VALUES ('1', '标题', '/uploads/20190917/86f5b4d1a8e56618018a0c3454022797.png', '简介简介简介', '<p><span style=\"color: rgb(102, 102, 102); font-family: \" neue\",=\"\" helvetica,=\"\" \"pingfang=\"\" sc\",=\"\" tahoma,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" right;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" display:=\"\" !important;=\"\" float:=\"\" none;\"=\"\">详情</span><span style=\"color: rgb(102, 102, 102); font-family: \" neue\",=\"\" helvetica,=\"\" \"pingfang=\"\" sc\",=\"\" tahoma,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" right;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" display:=\"\" !important;=\"\" float:=\"\" none;\"=\"\">详情</span><br></p>', '2', '1', '1568714696', '1568714924');
INSERT INTO `z_activities` VALUES ('2', '优惠券活动1', '/uploads/20190917/81eed9152f15248326c13977df1ddeba.png', '简介简介', '<p><span style=\"color: rgb(102, 102, 102); font-family: \" neue\",=\"\" helvetica,=\"\" \"pingfang=\"\" sc\",=\"\" tahoma,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" right;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" display:=\"\" !important;=\"\" float:=\"\" none;\"=\"\">详情</span><span style=\"color: rgb(102, 102, 102); font-family: \" neue\",=\"\" helvetica,=\"\" \"pingfang=\"\" sc\",=\"\" tahoma,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" right;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" display:=\"\" !important;=\"\" float:=\"\" none;\"=\"\">详情</span><br></p>', '1', '1', '1568715277', '1568715333');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='收货地址';

-- ----------------------------
-- Records of z_address
-- ----------------------------
INSERT INTO `z_address` VALUES ('1', '1', '收件人1', '13111111111', '广东省', '广州市', '天河区', '东圃', '1', '1', '0', '1569059088');
INSERT INTO `z_address` VALUES ('2', '1', '收件人', '13111111111', '广东省', '广州市', '天河区', '东圃', '2', '1', '0', '1569059088');
INSERT INTO `z_address` VALUES ('3', '1', '收件人', '13111111111', '广东省', '广州市', '天河区', '东圃', '2', '1', '0', '1569059088');
INSERT INTO `z_address` VALUES ('4', '1', '收件人', '13111111111', '广东省', '广州市', '天河区', '东圃', '2', '1', '1569057613', '1569059088');

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户角色表';

-- ----------------------------
-- Records of z_admin_role
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='商品属性';

-- ----------------------------
-- Records of z_attr
-- ----------------------------
INSERT INTO `z_attr` VALUES ('21', '1', '135cm', '500.00', '600.00', '96', '1', '1568274030', '1571460074', '', '', '');
INSERT INTO `z_attr` VALUES ('23', '5', '160cm', '650.00', '700.00', '195', '1', '1568274578', '1571470665', '0.04', '0.02', '0.01');
INSERT INTO `z_attr` VALUES ('24', '1', '140cm', '600.00', '700.00', '100', '1', '1571468932', '1571468932', '', '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='广告图';

-- ----------------------------
-- Records of z_banner
-- ----------------------------
INSERT INTO `z_banner` VALUES ('1', '测试', '/uploads/20190424/0f2db67071c929fc38baa066c6243a12.jpg', '', '2', '9', '1', '1556071739', '1556071739');
INSERT INTO `z_banner` VALUES ('3', '1', '/uploads/20190929/4fa9ecc7e29d750f9024086c6cd67465.png', '1', '2', '1', '1', '1569747023', '1569747023');
INSERT INTO `z_banner` VALUES ('4', 'test', '/uploads/20190929/50fb4a5baf55cb16f6b662f15d87349b.png', '1', '2', '1', '1', '1569747112', '1569747112');

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='品牌型号表';

-- ----------------------------
-- Records of z_brand
-- ----------------------------
INSERT INTO `z_brand` VALUES ('10', '7', '型号1', '1', '2', '1566460377', '1566460377');
INSERT INTO `z_brand` VALUES ('9', '0', '品牌3', '1', '3', '1566460361', '1566460361');
INSERT INTO `z_brand` VALUES ('7', '0', '品牌2', '1', '2', '1566455289', '1566455289');
INSERT INTO `z_brand` VALUES ('11', '7', '型号2', '1', '3', '1566460385', '1566460385');

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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='车灯表';

-- ----------------------------
-- Records of z_car_lamp
-- ----------------------------
INSERT INTO `z_car_lamp` VALUES ('1', '1', '123', '1', '1566724114', '0');
INSERT INTO `z_car_lamp` VALUES ('3', '1', '1233', '1', '1566724114', '0');
INSERT INTO `z_car_lamp` VALUES ('4', '1', '4566', '1', '1569402514', '0');
INSERT INTO `z_car_lamp` VALUES ('5', '1', '/uploads/20190928/4b0068f05f61c54d3091727c9ecd089e.png', '1', '1569660019', '1569660019');
INSERT INTO `z_car_lamp` VALUES ('6', '1', '/uploads/20190928/1b5633caa3fd140633275f77b72cd123.jpg', '1', '1569660019', '1569660019');
INSERT INTO `z_car_lamp` VALUES ('7', '1', '/uploads/20190928/cccd3b8d3679c07173ff10028d66466e.png', '1', '1569660019', '1569660019');
INSERT INTO `z_car_lamp` VALUES ('8', '1', '/uploads/20190928/5fea71f3f1892b23240c957989249f7f.png', '1', '1569660019', '1569660019');
INSERT INTO `z_car_lamp` VALUES ('9', '1', '/uploads/20190928/4b0068f05f61c54d3091727c9ecd089e.png', '1', '1569660043', '1569660043');
INSERT INTO `z_car_lamp` VALUES ('10', '1', '/uploads/20190928/1b5633caa3fd140633275f77b72cd123.jpg', '0', '1569660043', '1569660043');
INSERT INTO `z_car_lamp` VALUES ('11', '1', '/uploads/20190928/cccd3b8d3679c07173ff10028d66466e.png', '0', '1569660043', '1569660043');
INSERT INTO `z_car_lamp` VALUES ('12', '1', '/uploads/20190928/5fea71f3f1892b23240c957989249f7f.png', '0', '1569660043', '1569660043');
INSERT INTO `z_car_lamp` VALUES ('13', '1', '/uploads/20190928/73c995684de7a739ed17f7a632fe77fb.png', '0', '1569660043', '1569660043');
INSERT INTO `z_car_lamp` VALUES ('14', '1', '/uploads/20190928/8757ae09657ef0f4d8a2963bd16c3246.jpg', '0', '1569660043', '1569660043');
INSERT INTO `z_car_lamp` VALUES ('15', '1', '/uploads/20190928/05eabbb9ea583335b22a03a959bd7c17.png', '0', '1569660043', '1569660043');
INSERT INTO `z_car_lamp` VALUES ('16', '1', '/uploads/20190928/cff57811e09919805137ffcec6e9752c.jpg', '0', '1569660043', '1569660043');
INSERT INTO `z_car_lamp` VALUES ('17', '1', '/uploads/20190928/201d5639f51fe414fcf8ea906bd81a23.png', '0', '1569660043', '1569660043');
INSERT INTO `z_car_lamp` VALUES ('18', '1', '/uploads/20190928/b7dfd7289ee173acfc2090a8db5c3c6c.jpg', '0', '1569660155', '1569660155');
INSERT INTO `z_car_lamp` VALUES ('19', '1', '/uploads/20190928/2c1bf3661b06c0312f127194305bb44d.png', '0', '1569660155', '1569660155');
INSERT INTO `z_car_lamp` VALUES ('20', '1', '/uploads/20190928/240c752d4f7bef4376d2ad5194709c66.png', '0', '1569660155', '1569660155');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='案例信息表';

-- ----------------------------
-- Records of z_cases
-- ----------------------------
INSERT INTO `z_cases` VALUES ('4', '7', '4', '案例2', '2h', '200', '0', '0', '/uploads/20190822/8cc4310460db73aa2d439a4d4e295a55.png', '/uploads/20190822/823356f8a7295e81ebdff03607c1b550.png', '<p><span =\"\"=\"\" pingfang=\"\" style=\"color: rgb(102, 102, 102);\"><span style=\"color: rgb(102, 102, 102); font-family: &quot; Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">案例详情</span><span style=\"color: rgb(102, 102, 102); font-family: &quot; Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">案例详情</span><span style=\"color: rgb(102, 102, 102); font-family: &quot; Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">案例详情</span><span style=\"color: rgb(102, 102, 102); font-family: &quot; Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">案例详情</span><img class=\"fr-fin\" data-fr-image-preview=\"false\" alt=\"Image title\" src=\"/uploads/20190822/7e8e32487bea4010e2c917f41f2b8ad0.png\" width=\"300\"><br></span></p>', '1', '1566469321', '1566469591', '0', '');
INSERT INTO `z_cases` VALUES ('3', '10', '5', '案例标题', '3', '3', '0', '0', '/uploads/20190822/fea752f9055416a98e780b092422d454.png', '/uploads/20190822/00cd2e9a43979673e8383c3cd9200b1d.png', '<p>3</p>', '1', '1566466368', '1566469280', '0', '');
INSERT INTO `z_cases` VALUES ('5', '0', '0', '', '', '', '0', '0', '', '', null, '1', '1571367506', '1571367506', '0', '');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='可入驻城市';

-- ----------------------------
-- Records of z_city
-- ----------------------------
INSERT INTO `z_city` VALUES ('2', '1', '440000', '广东省', '广州市', '10', '1', '1571379461', '1571379461');
INSERT INTO `z_city` VALUES ('5', '1', '440000', '广东省', '深圳市', '10', '1', '1571479420', '1571479420');
INSERT INTO `z_city` VALUES ('4', '3', '440000', '广东省', '清远市', '5', '1', '1571379868', '1571379868');

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
  `red_start_time` int(11) NOT NULL,
  `red_end_time` int(11) NOT NULL,
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
  `bonus_time` int(3) NOT NULL DEFAULT '1' COMMENT '分红到账期限/天',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='配置表';

-- ----------------------------
-- Records of z_config
-- ----------------------------
INSERT INTO `z_config` VALUES ('1', '/uploads/20191030/d487be8d28d624762728fbf4e250d60f.png', '2.00', '1.00', '1', '1', '20.00', '10.00', '<p><br></p>', '<p><br></p>', '<p>预约须知sss</p>', '<p>提现说明111111</p>', '<p><span style=\"color: rgb(102, 102, 102); font-family: \" neue\",=\"\" helvetica,=\"\" \"pingfang=\"\" sc\",=\"\" tahoma,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" right;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" display:=\"\" !important;=\"\" float:=\"\" none;\"=\"\">优惠券规则</span><br></p>', '<p><span style=\"color: rgb(102, 102, 102); font-family: \" neue\",=\"\" helvetica,=\"\" \"pingfang=\"\" sc\",=\"\" tahoma,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" right;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" display:=\"\" !important;=\"\" float:=\"\" none;\"=\"\">关于我们</span><br></p>', '1572278400', '1572451200', '0.01', '0.20', '200', '悦照车灯', '/uploads/20191030/fd363b5ca680b45e9af3fd247009dc25.png', 'wx2fadae8fb59b2737', '315669a73323216dbb57153441e02ff3', 'yzcdkailiyuezhaochedeng123456789', '1550007821', '10', '广州市天河区车陂南', '020-864556213', '营业时间 11:00 - 18:00 （周一至周六） 限时买一送一（特价商品除外）', '113.402870', '23.125220', '1551341451', '1572402839', '0', '2');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='优惠劵';

-- ----------------------------
-- Records of z_coupon
-- ----------------------------
INSERT INTO `z_coupon` VALUES ('3', '1,2,13,14', '945987514619713400', '', '300.00', '50.00', '3', '1568649600', '1569600000', '0', '1568711847', '1568711847', '1', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='反馈表';

-- ----------------------------
-- Records of z_feedback
-- ----------------------------
INSERT INTO `z_feedback` VALUES ('1', '1', '反馈内容', '13111111111', '123', '0', '1569400234', '1569400234');
INSERT INTO `z_feedback` VALUES ('2', '1', '反馈内容', '13111111111', '123', '1', '1569400273', '1569400273');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='标签';

-- ----------------------------
-- Records of z_label
-- ----------------------------
INSERT INTO `z_label` VALUES ('1', '汽车美容1', '1', '1567849061', '1567850417', '0');
INSERT INTO `z_label` VALUES ('2', '汽车改装', '1', '1567849061', '1567849061', '0');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='站内通知';

-- ----------------------------
-- Records of z_notice
-- ----------------------------
INSERT INTO `z_notice` VALUES ('1', '通知11', '<p>sdfddfdsf</p>', '1', '1', '1572229598', '1572229760');

-- ----------------------------
-- Table structure for z_order
-- ----------------------------
DROP TABLE IF EXISTS `z_order`;
CREATE TABLE `z_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(30) NOT NULL DEFAULT '' COMMENT '订单号',
  `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '商家id/shop表id',
  `buy_num` int(11) NOT NULL DEFAULT '0' COMMENT '购买总数',
  `all_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单总价',
  `pay_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际支付金额',
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of z_order
-- ----------------------------
INSERT INTO `z_order` VALUES ('1', '1', '0', '0', '0.00', '0.00', '', '0', '', '', '', '', '', '', '3', '0', '0', '1');

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
INSERT INTO `z_other` VALUES ('1', '通知通知1', '<p>通知内容<span style=\"color: rgb(102, 102, 102); font-family: \" neue\",=\"\" helvetica,=\"\" \"pingfang=\"\" sc\",=\"\" tahoma,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" left;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" display:=\"\" !important;=\"\" float:=\"\" none;\"=\"\">通知内容</span><span style=\"color: rgb(102, 102, 102); font-family: \" neue\",=\"\" helvetica,=\"\" \"pingfang=\"\" sc\",=\"\" tahoma,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" left;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" display:=\"\" !important;=\"\" float:=\"\" none;\"=\"\">通知内容</span><span style=\"color: rgb(102, 102, 102); font-family: \" neue\",=\"\" helvetica,=\"\" \"pingfang=\"\" sc\",=\"\" tahoma,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" left;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" display:=\"\" !important;=\"\" float:=\"\" none;\"=\"\">通知内容</span></p>', '1', '1', '1572504095', '1572504115');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='积分变化记录';

-- ----------------------------
-- Records of z_point_change
-- ----------------------------
INSERT INTO `z_point_change` VALUES ('1', '1', '0', '2019092411:29:421', '-200', '2', '积分兑换商品', '1569295782', '1569295782');
INSERT INTO `z_point_change` VALUES ('2', '1', '1', '201909251526272', '100', '1', '购买获得积分', '1569295782', '1569295782');
INSERT INTO `z_point_change` VALUES ('3', '2', '1', '201909251526272', '+100', '2', '消费获得积分', '1571025098', '1571025098');
INSERT INTO `z_point_change` VALUES ('4', '2', '1', '201909251526272', '+52', '2', '消费获得积分', '1571033371', '1571033371');
INSERT INTO `z_point_change` VALUES ('5', '2', '1', '201909251526272', '+200', '3', '分销获得积分', '1571034639', '1571034639');
INSERT INTO `z_point_change` VALUES ('6', '2', '1', '201909251526272', '+52', '2', '消费获得积分', '1571034639', '1571034639');
INSERT INTO `z_point_change` VALUES ('7', '2', '1', '201909251526272', '+5', '3', '分销获得积分', '1571034728', '1571034728');
INSERT INTO `z_point_change` VALUES ('8', '2', '1', '201909251526272', '+52', '2', '消费获得积分', '1571034728', '1571034728');
INSERT INTO `z_point_change` VALUES ('9', '2', '1', '201909251526272', '+5', '3', '分销获得积分', '1571034849', '1571034849');
INSERT INTO `z_point_change` VALUES ('10', '2', '1', '201909251526272', '+52', '2', '消费获得积分', '1571034849', '1571034849');
INSERT INTO `z_point_change` VALUES ('11', '2', '1', '201909251526272', '+5', '3', '分销获得积分', '1571034960', '1571034960');
INSERT INTO `z_point_change` VALUES ('12', '2', '1', '201909251526272', '+52', '2', '消费获得积分', '1571034960', '1571034960');
INSERT INTO `z_point_change` VALUES ('13', '1', '1', '201909251526272', '+5', '3', '分销获得积分', '1571035043', '1571035043');
INSERT INTO `z_point_change` VALUES ('14', '2', '1', '201909251526272', '+52', '2', '消费获得积分', '1571035043', '1571035043');
INSERT INTO `z_point_change` VALUES ('15', '1', '0', '', '+200', '1', '邀请获得积分', '1571036749', '1571036749');
INSERT INTO `z_point_change` VALUES ('18', '1', '0', '', '+200', '1', '邀请获得积分', '1571036878', '1571036878');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='积分兑换商品';

-- ----------------------------
-- Records of z_point_goods
-- ----------------------------
INSERT INTO `z_point_goods` VALUES ('1', '5', '1', '商品名称11', '品名', '/uploads/20190916/bd3aa5da2e57c2beccfd8e84c665150b.png', '/uploads/20190916/66e4f7f0cbaa2af272431abfd77ee617.png,/uploads/20190916/33437c3164c836c7d1fc893822a7184a.png', '200', '100.00', '10', '型号型号', '<p><span style=\"color: rgb(102, 102, 102); font-family: \" neue\",=\"\" helvetica,=\"\" \"pingfang=\"\" sc\",=\"\" tahoma,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" right;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" display:=\"\" !important;=\"\" float:=\"\" none;\"=\"\">商品详情</span><span style=\"color: rgb(102, 102, 102); font-family: \" neue\",=\"\" helvetica,=\"\" \"pingfang=\"\" sc\",=\"\" tahoma,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" right;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" display:=\"\" !important;=\"\" float:=\"\" none;\"=\"\">商品详情</span><br></p>', '2', '1568615056', '1568626757');
INSERT INTO `z_point_goods` VALUES ('3', '1', '1', '商品名称', '品名', '/uploads/20190916/06d2e345e71352e26f4db91841a40ab2.png', '/uploads/20190916/8dd198bdb077d99c96998e35d581cb01.png,/uploads/20190916/ff02d769aed3437583cb953d0c5c06a5.png', '200', '100.00', '0', '型号', '<p>而入</p>', '1', '1568615502', '1568615502');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='积分商品规格';

-- ----------------------------
-- Records of z_point_goods_attr
-- ----------------------------
INSERT INTO `z_point_goods_attr` VALUES ('2', '1', '32cm', '150', '250.00', '199', '2', '1568617049', '1568617190');
INSERT INTO `z_point_goods_attr` VALUES ('3', '1', '30cm', '80', '120.00', '200', '1', '1568617170', '1568617170');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='积分商品品牌';

-- ----------------------------
-- Records of z_point_goods_brand
-- ----------------------------
INSERT INTO `z_point_goods_brand` VALUES ('1', '秀木镂1', '1', '1568604535', '1568604623', '0');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='积分商品分类';

-- ----------------------------
-- Records of z_point_goods_cate
-- ----------------------------
INSERT INTO `z_point_goods_cate` VALUES ('1', '汽车挂饰1', '1', '1568603690', '1568603827', '0');
INSERT INTO `z_point_goods_cate` VALUES ('5', '挂饰2', '1', '1568626747', '1568626747', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of z_point_order
-- ----------------------------
INSERT INTO `z_point_order` VALUES ('1', '123', '2', '1', '100', '1000.00', '备注', '1568510828', '0', '0', '联系人', '13111111111', '广东省', '广州市', '天河区', '详细地址', '1', '0', '0', '0', '0', '', '', '', '0');
INSERT INTO `z_point_order` VALUES ('2', '456', '2', '2', '400', '1000.00', '备注', '1568510828', '0', '0', '联系人', '13122222222', '广东省', '广州市', '天河区', '详细地址', '3', '0', '1571907788', '1', '1', '顺丰快递', 'shunfeng', '555', '1571907788');
INSERT INTO `z_point_order` VALUES ('3', '2019092411:29:421', '1', '1', '200', '100.00', '订单备注', '1568510828', '10', '1', '收件人1', '13111111111', '广东省', '广州市', '天河区', '东圃', '1', '1569295782', '1569295782', '0', '0', '', '', '', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='订单商品表';

-- ----------------------------
-- Records of z_point_order_list
-- ----------------------------
INSERT INTO `z_point_order_list` VALUES ('1', '1', '123', '1', '1', '1', '汽车美容1', '0', '', '汽车玻璃贴膜', '', '', '/uploads/20190828/e39401f2c250c907d3feddd5a76b2ddd.png', '200.00', '100', '1000.00', '0', '21', '21', '1', '0', '0');
INSERT INTO `z_point_order_list` VALUES ('2', '1', '123', '1', '1', '1', '汽车美容1', '0', '', '汽车玻璃贴膜', '', '', '/uploads/20190828/e39401f2c250c907d3feddd5a76b2ddd.png', '200.00', '100', '1000.00', '0', '21', '21', '1', '0', '0');
INSERT INTO `z_point_order_list` VALUES ('3', '1', '2019092411:29:421', '1', '1', '1', '汽车挂饰1', '1', '秀木镂1', '商品名称11', '品名', '型号型号', '/uploads/20190916/bd3aa5da2e57c2beccfd8e84c665150b.png', '/uploads/20190916/66e4f7f0cbaa2af272431abfd77ee617.png,/uploads/20190916/33437c3164c836c7d1fc893822a7184a.png', '200', '100.00', '10', '2', '{\"id\":2,\"point_goods_id\":1,\"title\":\"32cm\",\"point\":150,\"price\":\"250.00\",\"stock\":200,\"status\":2,\"add_time\":\"2019-09-16 14:57\",\"update_time\":\"2019-09-16 14:59\"}', '1', '1569295782', '1569295782');
INSERT INTO `z_point_order_list` VALUES ('4', '1', '2019092411:29:421', '1', '1', '1', '汽车挂饰1', '1', '秀木镂1', '商品名称11', '品名', '型号型号', '/uploads/20190916/bd3aa5da2e57c2beccfd8e84c665150b.png', '/uploads/20190916/66e4f7f0cbaa2af272431abfd77ee617.png,/uploads/20190916/33437c3164c836c7d1fc893822a7184a.png', '200', '100.00', '10', '2', '{\"id\":2,\"point_goods_id\":1,\"title\":\"32cm\",\"point\":150,\"price\":\"250.00\",\"stock\":200,\"status\":2,\"add_time\":\"2019-09-16 14:57\",\"update_time\":\"2019-09-16 14:59\"}', '1', '1569295782', '1569295782');

-- ----------------------------
-- Table structure for z_red_pack
-- ----------------------------
DROP TABLE IF EXISTS `z_red_pack`;
CREATE TABLE `z_red_pack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `look_uid` int(11) NOT NULL DEFAULT '0' COMMENT '访问人的id',
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='红包明细表';

-- ----------------------------
-- Records of z_red_pack
-- ----------------------------
INSERT INTO `z_red_pack` VALUES ('1', '5', '0', '活动领取', '+1.23456', '1', '1', '1569574612', '0', '0', '', '', '', '', '1');
INSERT INTO `z_red_pack` VALUES ('2', '1', '0', '新人注册领取', '0.02', '127', '1', '1569576769', '1569576769', '0', '', '', '', '', '1');
INSERT INTO `z_red_pack` VALUES ('3', '1', '0', '新人注册领取', '0.02', '127', '1', '1569576789', '1569576789', '0', '', '', '', '', '1');
INSERT INTO `z_red_pack` VALUES ('4', '1', '0', '新人注册领取', '0.02', '127', '1', '1569576834', '1569576834', '0', '', '', '', '', '1');
INSERT INTO `z_red_pack` VALUES ('5', '1', '0', '新人注册领取', '0.02', '127', '1', '1569576920', '1569576920', '0', '', '', '', '', '1');
INSERT INTO `z_red_pack` VALUES ('6', '1', '0', '新人注册领取', '0.02', '127', '1', '1569576929', '1569576929', '0', '', '', '', '', '1');
INSERT INTO `z_red_pack` VALUES ('7', '1', '0', '新人注册领取', '0.02', '127', '1', '1569576958', '1569576958', '0', '', '', '', '', '1');
INSERT INTO `z_red_pack` VALUES ('8', '5', '0', '新人注册领取', '0.02', '127', '1', '1569576966', '1569576966', '0', '', '', '', '', '1');
INSERT INTO `z_red_pack` VALUES ('9', '6', '0', '新人注册领取', '0.02', '127', '1', '1569576975', '1569576975', '0', '', '', '', '', '1');
INSERT INTO `z_red_pack` VALUES ('10', '1', '0', '提现', '-0.5', '5', '1', '1569631277', '1569631277', '0', '', '', '', '', '1');
INSERT INTO `z_red_pack` VALUES ('11', '1', '0', '提现', '-0.5', '4', '1', '1569632559', '1569632559', '1', '工商银行', '1002', '456456', '提现人姓名', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='改装信息表';

-- ----------------------------
-- Records of z_refit
-- ----------------------------
INSERT INTO `z_refit` VALUES ('5', '0', '升级LED头灯', '2', '1', '1566459903', '1566459903');
INSERT INTO `z_refit` VALUES ('4', '0', '透镜改装', '1', '1', '1566459888', '1566459888');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='预约信息表';

-- ----------------------------
-- Records of z_reserve
-- ----------------------------
INSERT INTO `z_reserve` VALUES ('1', '123', '1', '0', '1', '1', '是的', '0', '1', '汽车玻璃贴膜', '/uploads/20190828/e39401f2c250c907d3feddd5a76b2ddd.png', '1', '200.00', '800.00', '1000.00', '0.00', '200.00', '1000.00', '0', '0', '1567845973', '1567845973', '1567845973', '名字', '13111111111', '粤A 123', '产品序列号', '退款原因', '退款失败原因', '1567845973', '3', '1232a', '1567845973', '1571024794', '0', '1');
INSERT INTO `z_reserve` VALUES ('2', '201909241933361', '1', '0', '1', '1', '汽车美容1', '1', '1', '汽车玻璃贴膜', '/uploads/20190828/e39401f2c250c907d3feddd5a76b2ddd.png', '2', '400.00', '1600.00', '1000.00', '2000.00', '400.00', '200.00', '0', '0', '1', '1569859200', '0', '姓名', '13111111111', '粤A 123', '', '', '', '0', '1', '', '1569324816', '1569324816', '0', '1');
INSERT INTO `z_reserve` VALUES ('3', '201909251521001', '5', '0', '1', '1', '汽车美容1', '1', '1', '汽车玻璃贴膜', '/uploads/20190828/e39401f2c250c907d3feddd5a76b2ddd.png', '2', '400.00', '1600.00', '1000.00', '2000.00', '400.00', '200.00', '0', '0', '1', '0', '0', '姓名', '13111111111', '粤A 123', '', '', '', '0', '1', '', '1569396060', '1569396060', '0', '1');
INSERT INTO `z_reserve` VALUES ('4', '201909251523032', '5', '1', '2', '1', '汽车美容1', '1', '1', '汽车玻璃贴膜', '/uploads/20190828/e39401f2c250c907d3feddd5a76b2ddd.png', '2', '400.00', '1600.00', '1000.00', '2000.00', '400.00', '200.00', '0', '0', '1', '0', '0', '姓名', '13111111111', '粤A 123', '', '', '', '0', '1', '', '1569396183', '1569396183', '0', '1');
INSERT INTO `z_reserve` VALUES ('5', '201909251524192', '1', '1', '2', '1', '汽车美容1', '1', '1', '汽车玻璃贴膜', '/uploads/20190828/e39401f2c250c907d3feddd5a76b2ddd.png', '2', '400.00', '1600.00', '1000.00', '2000.00', '400.00', '200.00', '0', '0', '1', '0', '0', '姓名', '13111111111', '粤A 123', '', '', '拒绝原因', '0', '4', '', '1569396259', '1572839846', '0', '1');
INSERT INTO `z_reserve` VALUES ('6', '201909251526272', '9', '1', '2', '1', '汽车美容1', '1', '1', '汽车玻璃贴膜', '/uploads/20190828/e39401f2c250c907d3feddd5a76b2ddd.png', '2', '400.00', '1600.00', '1000.00', '2000.00', '400.00', '200.00', '0', '0', '1', '1569859200', '0', '姓名', '13111111111', '粤A 123', '', '', '', '0', '3', '1232a', '1569396387', '1571035043', '52', '1');

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
  `repair_time` int(11) DEFAULT '0' COMMENT '联保时长/年',
  `content` text COMMENT '内容详情',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1显示；2隐藏',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='产品表';

-- ----------------------------
-- Records of z_reserve_goods
-- ----------------------------
INSERT INTO `z_reserve_goods` VALUES ('1', '1', '汽车玻璃贴膜', '/uploads/20190828/e39401f2c250c907d3feddd5a76b2ddd.png', '/uploads/20190909/cc78477881cafc097e9dcd7b7cb6a0d6.mp4', '200.00', '1000.00', '500', '2', '详情详情详情详情', '2', '0', '1572423878');
INSERT INTO `z_reserve_goods` VALUES ('4', '1', '商品名称3', '/uploads/20190907/20c0655c55e31947c4d1b81b9714e361.png', '', '26.00', '100.00', '51', '1', '<p>tgyjhgtf</p>', '1', '1567846900', '1567846913');
INSERT INTO `z_reserve_goods` VALUES ('3', '1', '商品名称22', '/uploads/20190907/4a8fd668b20b2c10d4047c389bb43499.png', '', '25.00', '100.00', '50', '1', '<p><span style=\"color: rgb(102, 102, 102); font-family: \" neue\",=\"\" helvetica,=\"\" \"pingfang=\"\" sc\",=\"\" tahoma,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" right;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" display:=\"\" !important;=\"\" float:=\"\" none;\"=\"\">商品详情</span><span style=\"color: rgb(102, 102, 102); font-family: \" neue\",=\"\" helvetica,=\"\" \"pingfang=\"\" sc\",=\"\" tahoma,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" right;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" display:=\"\" !important;=\"\" float:=\"\" none;\"=\"\">商品详情</span><img class=\"fr-fin\" data-fr-image-preview=\"false\" alt=\"Image title\" src=\"/uploads/20190907/7a923c186b159de69c996a756aff1c29.png\" width=\"300\"><br></p>', '1', '1567845973', '1567846184');
INSERT INTO `z_reserve_goods` VALUES ('5', '1', '商品名称44', '/uploads/20190907/88828e57bdcc897bac6c63de56b14f6d.png', '/uploads/20190907/25b71e123bb87c0b709415c33a198143.mp4', '25.00', '150.00', '55', '1', '<p><span style=\"color: rgb(102, 102, 102); font-family: \" neue\",=\"\" helvetica,=\"\" \"pingfang=\"\" sc\",=\"\" tahoma,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" right;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" display:=\"\" !important;=\"\" float:=\"\" none;\"=\"\">商品详情</span><span style=\"color: rgb(102, 102, 102); font-family: \" neue\",=\"\" helvetica,=\"\" \"pingfang=\"\" sc\",=\"\" tahoma,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" right;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" display:=\"\" !important;=\"\" float:=\"\" none;\"=\"\">商品详情</span><span style=\"color: rgb(102, 102, 102); font-family: \" neue\",=\"\" helvetica,=\"\" \"pingfang=\"\" sc\",=\"\" tahoma,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" right;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" display:=\"\" !important;=\"\" float:=\"\" none;\"=\"\">商品详情</span><img class=\"fr-fin\" data-fr-image-preview=\"false\" alt=\"Image title\" src=\"/uploads/20190907/6a97d46cc4b4a0800614094c4c667c34.png\" width=\"300\"><br></p>', '1', '1567848381', '1567848511');
INSERT INTO `z_reserve_goods` VALUES ('6', '2', 'qwe', '/uploads/20191024/917ab514ff0886b83bd5c91895b86189.png', '/uploads/20191024/706988bc370d076f14be6ccd41bcc7b8.mp4', '1.00', '1.00', '1', '1', '<p>1</p>', '1', '1571908276', '1571908276');

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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='商品序列号';

-- ----------------------------
-- Records of z_serial_num
-- ----------------------------
INSERT INTO `z_serial_num` VALUES ('19', '23', '1232', '1', '1', '1568275601', '1568275743');
INSERT INTO `z_serial_num` VALUES ('11', '21', '456', '1', '1', '1568015801', '1568015801');
INSERT INTO `z_serial_num` VALUES ('12', '1', '789', '1', '1', '1568015801', '1568015801');
INSERT INTO `z_serial_num` VALUES ('13', '1', '1122', '1', '1', '1568015801', '1568015801');
INSERT INTO `z_serial_num` VALUES ('14', '1', '1455', '1', '1', '1568015801', '1568015801');
INSERT INTO `z_serial_num` VALUES ('15', '1', '1788', '1', '1', '1568015801', '1568015801');
INSERT INTO `z_serial_num` VALUES ('18', '5', '666', '1', '1', '1568019388', '1568019388');
INSERT INTO `z_serial_num` VALUES ('17', '1', '2454', '1', '1', '1568015801', '1568015801');
INSERT INTO `z_serial_num` VALUES ('20', '23', '1234', '1', '1', '1568275763', '1568275763');

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
  `term` int(3) NOT NULL DEFAULT '0' COMMENT '分红期限',
  `end_time` int(11) NOT NULL DEFAULT '0' COMMENT '分红到期时间',
  `state` tinyint(11) NOT NULL DEFAULT '1' COMMENT '1未付款；2已付款；3已过期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='门店表';

-- ----------------------------
-- Records of z_shop
-- ----------------------------
INSERT INTO `z_shop` VALUES ('8', '950441', '', '1', '门店名称1', '2', '广东省', '广州市', '', '东圃', '113.27324', '23.15792', '负责人姓名', '负责人电话', '其他电话', '', '', '本店经营项目', '其他经营项目', '/uploads/20190916/06d2e345e71352e26f4db91841a40ab2.png,/uploads/20190916/06d2e345e71352e26f4db91841a40ab2.png', '202cb962ac59075b964b07152d234b70', '/uploads/20190916/06d2e345e71352e26f4db91841a40ab2.png,/uploads/20190916/06d2e345e71352e26f4db91841a40ab2.png', '/uploads/20190916/06d2e345e71352e26f4db91841a40ab2.png,/uploads/20190916/06d2e345e71352e26f4db91841a40ab2.png', '1', '/uploads/20191007/61bd9863b359aae9dd9b15d58fcb61e4.png', '/uploads/20190916/06d2e345e71352e26f4db91841a40ab2.png,/uploads/20190916/06d2e345e71352e26f4db91841a40ab2.png', '1', '1', '1571390219', '1571388513', '1571901533', '0.00', '1', '1603437533', '2');
INSERT INTO `z_shop` VALUES ('9', '950442', '950441', '2', '门店名称2', '4', '广东省', '清远市', '', '清远市', '113.27324', '23.15792', '负责人姓名', '负责人电话', '其他电话', '', '', '本店经营项目', '其他经营项目', '/uploads/20190916/06d2e345e71352e26f4db91841a40ab2.png,/uploads/20190916/06d2e345e71352e26f4db91841a40ab2.png', '202cb962ac59075b964b07152d234b70', '/uploads/20190916/06d2e345e71352e26f4db91841a40ab2.png,/uploads/20190916/06d2e345e71352e26f4db91841a40ab2.png', '/uploads/20190916/06d2e345e71352e26f4db91841a40ab2.png,/uploads/20190916/06d2e345e71352e26f4db91841a40ab2.png', '1', '/uploads/20191007/61bd9863b359aae9dd9b15d58fcb61e4.png', '/uploads/20190916/06d2e345e71352e26f4db91841a40ab2.png,/uploads/20190916/06d2e345e71352e26f4db91841a40ab2.png', '2', '1', '1571390219', '1571388513', '1571390219', '0.00', '0', '0', '1');

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
  `stock` int(11) DEFAULT '0' COMMENT '库存',
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
  `attr_id` int(11) NOT NULL DEFAULT '0' COMMENT 'attr主键id',
  `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '门店id',
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='商家注册支付表';

-- ----------------------------
-- Records of z_shop_register_pay
-- ----------------------------
INSERT INTO `z_shop_register_pay` VALUES ('1', '201910241159058', '8', '20.00', '1571901533', '1', '1603437533', '1', '2', '1571889545', '1571901533');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of z_user
-- ----------------------------
INSERT INTO `z_user` VALUES ('1', '%F0%9F%87%B2+%F0%9F%87%B7+%C2%B7%F0%9F%87%B5+%F0%9F%87%AF%F0%9F%99%83', 'http://thirdwx.qlogo.cn/mmopen/vi_32/pVxaShmrVyq13RzPdicSh04Xp0vuJ79HMIAD3xSdt2srVtTy664eUicFibmPfLjZiae8PV5YhoJFrt57ZbUNb4Pv0w/132', '姓名', '13111111111', '', 'SUV', '粤 A 123', '1', '贵州', '六盘水', 'oZp0Dj6poA0nph11n453vOO8P0lQ', '1', '1', '1548405755', '1550213346', '205', '', '99.04', '0');
INSERT INTO `z_user` VALUES ('2', '%E7%91%8B%E7%91%8B', 'http://thirdwx.qlogo.cn/mmopen/vi_32/QOiaNght8yARcd9zYdtYA0otfa12tK7IJ924Em8NYSPnPlia3Y6kn3ceib7ofMicQaFRz5DIZ5WqEHztJ7NwoMAZUQ/132', '姓名', '13111111111', '', '车型', '车牌', '2', '湖南', '衡阳', 'oZp0Dj9ZBXO2C3qs6Wimn0t7zn4A', '1', '1', '1548410208', '1548494906', '52', '', '0.00', '1');
INSERT INTO `z_user` VALUES ('3', '%E6%B1%AA%E5%A4%A7%E9%94%A4', 'http://thirdwx.qlogo.cn/mmopen/vi_32/icSQJC8EphXssCW07lCQvc0IGXfycNOEWTwkkWKx2r6tdwGSRAsTQUn2q6xB91zE77ORL8wzaNJffaicwVLI9oTg/132', '姓名', '13111111111', '', '车型', '车牌', '1', '广东', '广州', 'oZp0Dj2f5SYOoJhgSdII6LvByJZ8', '2', '1', '1548410474', '1570844130', '0', '', '0.00', '1');
INSERT INTO `z_user` VALUES ('4', '%E9%99%86%E5%B0%8F%E5%85%AD++%E3%81%A4%E3%80%82', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eq0vTOMBPqwJic8qicgxus8cmuauXZkcNa33ictJwOuPWJRwbh5VFAUGEUBbkKV0eOUUaNBmbwBbRrwA/132', '', '', '', '', '', '2', '广东', '广州', 'oZp0Dj6fGZ1AR2f_kTHqKL8JW7DY', '1', '0', '1548468641', '1548468641', '0', '', '0.00', '0');
INSERT INTO `z_user` VALUES ('5', '%F0%9F%92%AB+%E7%B3%96%E4%B8%8D%E7%94%9C+%F0%9F%92%83', 'http://thirdwx.qlogo.cn/mmopen/vi_32/pERa7xlXibPibNO3XzaQebZXkmLEV5NYbLEHUYn3Mld5icl8gnJe5AC0VEfGE2QtNd6iaJ68hog1VZDbb8QJUnKJCg/132', '', '', '', '', '', '2', '', '', 'oZp0Dj1GoThv__QezJCBk0mR3VVg', '1', '0', '1548471977', '1570843505', '0', '', '0.02', '0');

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
  `erm` varchar(255) DEFAULT '' COMMENT '优惠券二维码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户优惠券表';

-- ----------------------------
-- Records of z_user_coupon
-- ----------------------------
INSERT INTO `z_user_coupon` VALUES ('1', '1,2,13,14', '1', '3', '945987514619713400', '标题', '3001.00', '50.00', '3', '1569600000', '1572192000', '1569718589', '3', '1569977789', '1', '');
INSERT INTO `z_user_coupon` VALUES ('2', '1,2,13,14', '2', '3', '945987514619713400', '标题', '300.00', '50.00', '3', '1569600000', '1572192000', '1569718589', '2', '1569977789', '1', '');
DROP TRIGGER IF EXISTS `del_bank`;
DELIMITER ;;
CREATE TRIGGER `del_bank` AFTER DELETE ON `z_bank` FOR EACH ROW begin
     delete from tbkl_bank where bank_cate_id = old.id;
end
;;
DELIMITER ;

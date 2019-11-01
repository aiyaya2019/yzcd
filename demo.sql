/*
 Navicat MySQL Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50714
 Source Host           : localhost:3306
 Source Schema         : meijiazhangshi

 Target Server Type    : MySQL
 Target Server Version : 50714
 File Encoding         : 65001

 Date: 24/04/2019 10:23:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for z_access
-- ----------------------------
DROP TABLE IF EXISTS `z_access`;
CREATE TABLE `z_access`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '权限名称',
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '页面URL',
  `parameter` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '参数',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态 0生效 1无效',
  `pid` int(11) NOT NULL COMMENT '权限分类ID',
  `is_nav` tinyint(1) NOT NULL DEFAULT 2 COMMENT '是否加入菜单 1是 2否',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序 倒序',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 118 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '权限表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_access
-- ----------------------------
INSERT INTO `z_access` VALUES (2, '管理员', 'index', '', 0, 2, 1, 9, 1514197382, 1529339312);
INSERT INTO `z_access` VALUES (3, '角色管理', 'role', '', 0, 2, 1, 8, 1514197392, 1529339333);
INSERT INTO `z_access` VALUES (4, '权限列表', 'node', '', 0, 2, 1, 7, 1514197402, 1529339338);
INSERT INTO `z_access` VALUES (29, '添加/编辑角色', 'addrole', '', 0, 2, 2, 6, 1528954933, 1529339351);
INSERT INTO `z_access` VALUES (46, '配置权限', 'access', '', 0, 2, 2, 0, 1529338363, 1529338363);
INSERT INTO `z_access` VALUES (47, '删除角色', 'delerole', '', 0, 2, 2, 5, 1529338413, 1529339364);
INSERT INTO `z_access` VALUES (48, '添加/编辑管理', 'addadmin', '', 0, 2, 2, 0, 1529338540, 1529338577);
INSERT INTO `z_access` VALUES (49, '激活/冻结管理', 'isstatus', '', 0, 2, 2, 0, 1529338608, 1529338608);
INSERT INTO `z_access` VALUES (50, '删除管理', 'deleadmin', '', 0, 2, 2, 0, 1529338626, 1529338626);
INSERT INTO `z_access` VALUES (115, '用户列表', 'index', '', 0, 30, 1, 9, 1553070811, 1553070811);
INSERT INTO `z_access` VALUES (114, '商品分类', 'type', '', 0, 29, 1, 8, 1553050672, 1553050672);
INSERT INTO `z_access` VALUES (113, '商品列表', 'index', '', 0, 29, 1, 9, 1552891706, 1552891706);
INSERT INTO `z_access` VALUES (116, '基础配置', 'index', '', 0, 31, 1, 9, 1556069491, 1556069491);
INSERT INTO `z_access` VALUES (117, '图片管理', 'index', '', 0, 32, 1, 9, 1556071115, 1556071115);

-- ----------------------------
-- Table structure for z_access_role
-- ----------------------------
DROP TABLE IF EXISTS `z_access_role`;
CREATE TABLE `z_access_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `rid` int(11) NOT NULL COMMENT '角色ID',
  `acc_id` int(11) NOT NULL COMMENT '权限ID',
  `addtime` int(11) NULL DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 38 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '角色权限关系表' ROW_FORMAT = Fixed;

INSERT INTO `z_access_role` VALUES (1, 1, 6, 1514197463);
INSERT INTO `z_access_role` VALUES (2, 1, 1, 1514198168);
INSERT INTO `z_access_role` VALUES (4, 1, 7, 1514361292);
INSERT INTO `z_access_role` VALUES (5, 1, 8, 1514455230);
INSERT INTO `z_access_role` VALUES (6, 1, 9, 1514455230);
INSERT INTO `z_access_role` VALUES (7, 1, 10, 1514455230);
INSERT INTO `z_access_role` VALUES (8, 1, 11, 1514455230);
INSERT INTO `z_access_role` VALUES (9, 2, 1, 1526385621);
INSERT INTO `z_access_role` VALUES (25, 5, 2, 1529338677);
INSERT INTO `z_access_role` VALUES (26, 5, 3, 1529338677);
INSERT INTO `z_access_role` VALUES (30, 6, 58, 1546409369);
INSERT INTO `z_access_role` VALUES (31, 6, 59, 1546409369);
INSERT INTO `z_access_role` VALUES (32, 6, 60, 1546409369);
INSERT INTO `z_access_role` VALUES (33, 6, 61, 1546409369);
INSERT INTO `z_access_role` VALUES (34, 6, 62, 1546409369);
INSERT INTO `z_access_role` VALUES (35, 6, 63, 1546409369);
INSERT INTO `z_access_role` VALUES (36, 6, 64, 1546409369);
INSERT INTO `z_access_role` VALUES (37, 6, 65, 1546409369);

-- ----------------------------
-- Table structure for z_access_type
-- ----------------------------
DROP TABLE IF EXISTS `z_access_type`;
CREATE TABLE `z_access_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '控制器名称',
  `url` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '控制器',
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序 倒序',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '权限分类表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_access_type
-- ----------------------------
INSERT INTO `z_access_type` VALUES (2, '后台管理', 'admins', 'icon-shezhi', 99, 1514197373, 1531962285);
INSERT INTO `z_access_type` VALUES (29, '商品管理', 'goods', 'icon-shangpin', 9, 1552891675, 1552891692);
INSERT INTO `z_access_type` VALUES (30, '用户管理', 'user', 'icon-jiaosequnti', 0, 1553070786, 1553070786);
INSERT INTO `z_access_type` VALUES (31, '网站配置', 'config', 'icon-peizhiguanli', 98, 1556069463, 1556069463);
INSERT INTO `z_access_type` VALUES (32, '轮播图', 'banner', 'icon-tupian-xianxing', 8, 1556070894, 1556070894);

-- ----------------------------
-- Table structure for z_admin
-- ----------------------------
DROP TABLE IF EXISTS `z_admin`;
CREATE TABLE `z_admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '管理员名称',
  `admin_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '账号',
  `password` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '密码',
  `addtime` int(11) NULL DEFAULT NULL COMMENT '注册时间',
  `update_time` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  `forst` int(1) NOT NULL DEFAULT 0 COMMENT '是否冻结 0否 1是',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_admin
-- ----------------------------
INSERT INTO `z_admin` VALUES (1, '超级管理员', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1514163261, 1526385304, 0);

-- ----------------------------
-- Table structure for z_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `z_admin_role`;
CREATE TABLE `z_admin_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '角色名称',
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '状态 0有效 1无效',
  `desc` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '角色描述',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户角色表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for z_admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `z_admin_roles`;
CREATE TABLE `z_admin_roles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `aid` int(11) NOT NULL COMMENT '管理员ID',
  `rid` int(11) NOT NULL COMMENT '角色ID',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户角色关系表' ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of z_admin_roles
-- ----------------------------
INSERT INTO `z_admin_roles` VALUES (3, 6, 2, 1526384853);
INSERT INTO `z_admin_roles` VALUES (4, 2, 5, 1528873113);
INSERT INTO `z_admin_roles` VALUES (7, 9, 6, 1546427140);
INSERT INTO `z_admin_roles` VALUES (8, 7, 6, 1547003146);

-- ----------------------------
-- Table structure for z_banner
-- ----------------------------
DROP TABLE IF EXISTS `z_banner`;
CREATE TABLE `z_banner`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '广告标题',
  `pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图片地址',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '跳转地址',
  `url_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '跳转类型 1页面 2小程序',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序 倒序',
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '类型 1首页 2预约装修页面',
  `add_time` int(11) NOT NULL DEFAULT 0 COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '广告图' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_banner
-- ----------------------------
INSERT INTO `z_banner` VALUES (1, '测试', '/uploads/20190424/0f2db67071c929fc38baa066c6243a12.jpg', '', 1, 9, 1, 1556071739, 1556071739);

-- ----------------------------
-- Table structure for z_config
-- ----------------------------
DROP TABLE IF EXISTS `z_config`;
CREATE TABLE `z_config`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '网站标题',
  `logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '网站logo',
  `appid` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '微信APPID',
  `appsecret` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'appsecret',
  `key` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '微信支付key',
  `mchid` int(11) NOT NULL DEFAULT 0 COMMENT '商户号',
  `fare_money` int(11) NOT NULL DEFAULT 0 COMMENT '运费',
  `work_time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '门店地址',
  `cust_tel` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '客服电话',
  `desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '门店介绍',
  `long` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '经度',
  `lat` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '纬度',
  `add_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '配置表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_config
-- ----------------------------
INSERT INTO `z_config` VALUES (1, '美家装饰', '/uploads/20190330/87923715f7d3c1722d0be82c440860b8.jpg', 'wxce3f2855099a8374', 'fbb662e0d11613c255cbe0a9e27c75ee', 'e0069ba4feeced842617256a79a04feb', 1530854171, 10, '广州市天河区车陂南', '020-864556213', '营业时间 11:00 - 18:00 （周一至周六） 限时买一送一（特价商品除外）', '113.402870', '23.125220', 1551341451, 1556069721);

-- ----------------------------
-- Table structure for z_goods
-- ----------------------------
DROP TABLE IF EXISTS `z_goods`;
CREATE TABLE `z_goods`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '商品标题',
  `old_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '副标题',
  `type_id` int(11) NOT NULL DEFAULT 0 COMMENT '分类ID',
  `pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '封面',
  `images` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '相册',
  `desc` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '详情',
  `pay_num` int(11) NOT NULL DEFAULT 0 COMMENT '销量',
  `keep` int(11) NOT NULL DEFAULT 0 COMMENT '收藏数',
  `is_reco` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否推荐 1否 2是',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '上下架 1上架 2下架',
  `add_time` int(11) NOT NULL DEFAULT 0 COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_goods
-- ----------------------------
INSERT INTO `z_goods` VALUES (1, '超级豪华比萨', '', 5, '/uploads/20190321/dd7ddd3c418deba938aa5d5b7abc7117.png', '/uploads/20190321/456a7d6a3581e06e8c15686ad3c8b46e.png', '<p>暂无信息</p>', 0, 0, 1, 1, 1553140099, 1553140099);
INSERT INTO `z_goods` VALUES (2, '超级苏丹王黄金果肉榴莲', '', 5, '/uploads/20190321/96153de40672a1f3a7cd99a3f9fbc7cd.png', '/uploads/20190321/d2d2fc42de94f34756576ad8fa618e7d.png', '<p>暂无信息</p>', 0, 0, 1, 1, 1553140342, 1553140342);
INSERT INTO `z_goods` VALUES (3, '海鲜比萨', '', 5, '/uploads/20190321/efd8a0a306cb3b2a0c18df8d7d6c0741.png', '/uploads/20190321/aeb6c91e9d6a70a2983419630a7b9175.png', '<p>暂无信息</p>', 0, 0, 1, 1, 1553140410, 1553140410);
INSERT INTO `z_goods` VALUES (4, '和风照烧鸡比萨', '', 5, '/uploads/20190321/b3c30b1a4432e3800a72b4a231b265f2.png', '/uploads/20190321/9be2b84518826dac38d8e76dc1afb0a1.png', '<p>暂无信息</p>', 0, 0, 1, 1, 1553140466, 1553140466);
INSERT INTO `z_goods` VALUES (5, '核桃仁烤鸡比萨', '', 5, '/uploads/20190321/0f4665bdf62c2c167c2f2ee3d1dd7057.jpg', '/uploads/20190321/868272e5a938a54560c44fd562e27169.jpg', '<p>暂无信息</p>', 0, 0, 1, 1, 1553140527, 1553140527);
INSERT INTO `z_goods` VALUES (6, '京酱烤鸭比萨', '', 5, '/uploads/20190321/8490716dfda6647381b9608636ab90ba.jpg', '/uploads/20190321/de41c5795cfc6bf6ddcd6933778dccf7.jpg', '<p>暂无信息</p>', 0, 0, 1, 1, 1553140570, 1553140570);
INSERT INTO `z_goods` VALUES (7, '水果什锦比萨', '', 5, '/uploads/20190321/8a3c5ed8500c2be02ace37deb33a7657.png', '/uploads/20190321/7441fb24a379b35d47c20abdb3246fa9.png', '<p>暂无信息</p>', 0, 0, 1, 1, 1553140633, 1553140633);
INSERT INTO `z_goods` VALUES (8, '莓莓拿铁咖啡', '品味生活', 1, '/uploads/20190321/b6b4c116711646878cb088a76b4e13f4.jpg', '/uploads/20190321/cfe1641aac512805e7af01f614707147.jpg', '<p>暂无信息</p>', 0, 0, 1, 1, 1553140714, 1553218784);
INSERT INTO `z_goods` VALUES (9, '鲜橙水果茶', '', 4, '/uploads/20190321/89347cfa811312c4a5d04ee010d38fe7.jpg', '/uploads/20190321/d41cae894d19f0cc1ceae8500571a04b.jpg', '<p>暂无信息</p>', 0, 0, 1, 1, 1553160532, 1553160532);
INSERT INTO `z_goods` VALUES (10, '鲜芋青稞牛奶', '营养美味', 3, '/uploads/20190322/142b57d1f8c6123ac694960e69fda411.jpg', '/uploads/20190322/9899dd6b231488594cceaf188a3d1487.jpg', '<p>暂无信息</p>', 0, 0, 1, 1, 1553218853, 1553218853);
INSERT INTO `z_goods` VALUES (11, '法式奶霜烤茶', '', 2, '/uploads/20190322/afeeb5c7b6250b600d61cb616d747f93.jpg', '/uploads/20190322/bc7efba02d2cd18c015523cfdd907efa.jpg', '<p>暂无信息</p>', 0, 0, 1, 1, 1553218941, 1553218941);
INSERT INTO `z_goods` VALUES (12, '草莓果茶', '新鲜水果', 4, '/uploads/20190322/269052072dd245a1e0f837bd919e3d8e.jpg', '/uploads/20190322/d6fc1cd4f2dee1417e39038795e66dfd.jpg', '<p>暂无信息</p>', 0, 0, 1, 1, 1553226712, 1553226712);
INSERT INTO `z_goods` VALUES (13, '草莓红果果', '', 4, '/uploads/20190322/065dd4f3ec4e12dc73aece4f627ed23f.jpg', '/uploads/20190322/9582862798e147b09ac01413452a2864.jpg', '<p>暂无信息</p>', 0, 0, 1, 1, 1553226813, 1553226813);

-- ----------------------------
-- Table structure for z_goods_attr
-- ----------------------------
DROP TABLE IF EXISTS `z_goods_attr`;
CREATE TABLE `z_goods_attr`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '属性名称',
  `goods_id` int(11) NOT NULL COMMENT '商品ID',
  `ap_id` int(11) NOT NULL COMMENT 'sku id 用于初始化',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品属性' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_goods_attr
-- ----------------------------
INSERT INTO `z_goods_attr` VALUES (1, '大小', 1, 1, 1553140300, 1553140316);
INSERT INTO `z_goods_attr` VALUES (2, '大小', 2, 1, 1553140377, 1553140377);
INSERT INTO `z_goods_attr` VALUES (3, '大小', 3, 1, 1553140446, 1553140446);
INSERT INTO `z_goods_attr` VALUES (4, '大小', 4, 1, 1553140502, 1553140502);
INSERT INTO `z_goods_attr` VALUES (5, '大小', 5, 1, 1553140544, 1553140544);
INSERT INTO `z_goods_attr` VALUES (6, '大小', 6, 1, 1553140614, 1553140614);
INSERT INTO `z_goods_attr` VALUES (7, '大小', 7, 1, 1553140671, 1553140671);
INSERT INTO `z_goods_attr` VALUES (8, '规格', 8, 1, 1553147957, 1553147957);
INSERT INTO `z_goods_attr` VALUES (9, '糖度', 8, 2, 1553147957, 1553147957);
INSERT INTO `z_goods_attr` VALUES (10, '温度', 8, 3, 1553147957, 1553147957);
INSERT INTO `z_goods_attr` VALUES (11, '规格', 9, 1, 1553160659, 1553160659);
INSERT INTO `z_goods_attr` VALUES (12, '规格', 10, 1, 1553218889, 1553218889);
INSERT INTO `z_goods_attr` VALUES (13, '规格', 11, 1, 1553218965, 1553226605);
INSERT INTO `z_goods_attr` VALUES (14, '规格', 12, 1, 1553226744, 1553226744);
INSERT INTO `z_goods_attr` VALUES (19, '规格', 13, 1, 1553235009, 1553235067);
INSERT INTO `z_goods_attr` VALUES (20, '温度', 13, 2, 1553235009, 1553235067);

-- ----------------------------
-- Table structure for z_goods_spec
-- ----------------------------
DROP TABLE IF EXISTS `z_goods_spec`;
CREATE TABLE `z_goods_spec`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '属性名称',
  `goods_id` int(11) NOT NULL COMMENT '商品ID',
  `goods_attr_id` int(11) NOT NULL DEFAULT 0 COMMENT '属性ID',
  `ap_id` int(11) NOT NULL DEFAULT 0 COMMENT 'sku id 用于初始化',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品属性' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_goods_spec
-- ----------------------------
INSERT INTO `z_goods_spec` VALUES (1, '10寸', 1, 1, 1, 1553140300, 1553140316);
INSERT INTO `z_goods_spec` VALUES (2, '12寸', 1, 1, 2, 1553140300, 1553140316);
INSERT INTO `z_goods_spec` VALUES (3, '10寸', 2, 2, 1, 1553140377, 1553140377);
INSERT INTO `z_goods_spec` VALUES (4, '10寸', 3, 3, 1, 1553140446, 1553140446);
INSERT INTO `z_goods_spec` VALUES (5, '16寸', 3, 3, 2, 1553140446, 1553140446);
INSERT INTO `z_goods_spec` VALUES (6, '6寸', 4, 4, 1, 1553140502, 1553140502);
INSERT INTO `z_goods_spec` VALUES (7, '10寸', 4, 4, 2, 1553140502, 1553140502);
INSERT INTO `z_goods_spec` VALUES (8, '10寸', 5, 5, 1, 1553140544, 1553140544);
INSERT INTO `z_goods_spec` VALUES (9, '4寸', 6, 6, 1, 1553140614, 1553140614);
INSERT INTO `z_goods_spec` VALUES (10, '10寸', 6, 6, 2, 1553140614, 1553140614);
INSERT INTO `z_goods_spec` VALUES (11, '12寸', 6, 6, 3, 1553140614, 1553140614);
INSERT INTO `z_goods_spec` VALUES (12, '6寸', 7, 7, 1, 1553140671, 1553140671);
INSERT INTO `z_goods_spec` VALUES (13, '12寸', 7, 7, 2, 1553140671, 1553140671);
INSERT INTO `z_goods_spec` VALUES (14, '常规', 8, 8, 1, 1553147957, 1553147957);
INSERT INTO `z_goods_spec` VALUES (15, '浓缩咖啡', 8, 8, 2, 1553147957, 1553147957);
INSERT INTO `z_goods_spec` VALUES (16, '常规', 8, 9, 3, 1553147957, 1553147957);
INSERT INTO `z_goods_spec` VALUES (17, '半塘', 8, 9, 4, 1553147957, 1553147957);
INSERT INTO `z_goods_spec` VALUES (18, '加糖', 8, 9, 5, 1553147957, 1553147957);
INSERT INTO `z_goods_spec` VALUES (19, '微糖', 8, 9, 6, 1553147957, 1553147957);
INSERT INTO `z_goods_spec` VALUES (20, '常规冰', 8, 10, 7, 1553147957, 1553147957);
INSERT INTO `z_goods_spec` VALUES (21, '多冰', 8, 10, 8, 1553147957, 1553147957);
INSERT INTO `z_goods_spec` VALUES (22, '少冰', 8, 10, 9, 1553147957, 1553147957);
INSERT INTO `z_goods_spec` VALUES (23, '去冰', 8, 10, 10, 1553147957, 1553147957);
INSERT INTO `z_goods_spec` VALUES (24, '中杯', 9, 11, 1, 1553160659, 1553160659);
INSERT INTO `z_goods_spec` VALUES (25, '大杯', 9, 11, 2, 1553160659, 1553160659);
INSERT INTO `z_goods_spec` VALUES (26, '中杯', 10, 12, 1, 1553218889, 1553218889);
INSERT INTO `z_goods_spec` VALUES (27, '大杯', 10, 12, 2, 1553218889, 1553218889);
INSERT INTO `z_goods_spec` VALUES (28, '中杯', 11, 13, 1, 1553218965, 1553226605);
INSERT INTO `z_goods_spec` VALUES (29, '中杯', 12, 14, 1, 1553226744, 1553226744);
INSERT INTO `z_goods_spec` VALUES (30, '大杯', 12, 14, 2, 1553226744, 1553226744);
INSERT INTO `z_goods_spec` VALUES (41, '中杯', 13, 19, 1, 1553235009, 1553235067);
INSERT INTO `z_goods_spec` VALUES (42, '大杯', 13, 19, 2, 1553235009, 1553235067);
INSERT INTO `z_goods_spec` VALUES (43, '常规', 13, 20, 3, 1553235009, 1553235067);
INSERT INTO `z_goods_spec` VALUES (44, '去冰', 13, 20, 4, 1553235009, 1553235067);

-- ----------------------------
-- Table structure for z_goods_type
-- ----------------------------
DROP TABLE IF EXISTS `z_goods_type`;
CREATE TABLE `z_goods_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '分类名称',
  `pid` int(11) NOT NULL DEFAULT 0 COMMENT '上级分类ID',
  `sort` int(11) NOT NULL DEFAULT 1 COMMENT '排序 倒序',
  `add_time` int(11) NOT NULL DEFAULT 0 COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品分类' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_goods_type
-- ----------------------------
INSERT INTO `z_goods_type` VALUES (1, '咖啡时光', 0, 8, 1553135831, 1553139854);
INSERT INTO `z_goods_type` VALUES (2, '暖饮轻食', 0, 1, 1553136159, 1553136159);
INSERT INTO `z_goods_type` VALUES (3, '牧场牛奶', 0, 1, 1553136169, 1553136169);
INSERT INTO `z_goods_type` VALUES (4, '新鲜果茶', 0, 7, 1553136177, 1553139861);
INSERT INTO `z_goods_type` VALUES (5, '美味披萨', 0, 9, 1553139654, 1553139845);

-- ----------------------------
-- Table structure for z_goods_val
-- ----------------------------
DROP TABLE IF EXISTS `z_goods_val`;
CREATE TABLE `z_goods_val`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL DEFAULT 0 COMMENT '商品ID',
  `attr_spec` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品规格属性值 示例： 1:2 1为属性 2为规格',
  `price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '价格',
  `old_price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '市场价格',
  `stock` int(11) NOT NULL DEFAULT 0 COMMENT '库存',
  `pay_num` int(11) NOT NULL DEFAULT 0 COMMENT '销量',
  `add_time` int(11) NOT NULL DEFAULT 0 COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 61 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品规格属性值' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_goods_val
-- ----------------------------
INSERT INTO `z_goods_val` VALUES (1, 1, '1:1', 68.00, 68.00, 99, 0, 1553140300, 1553140316);
INSERT INTO `z_goods_val` VALUES (2, 1, '1:2', 98.00, 98.00, 99, 0, 1553140300, 1553140316);
INSERT INTO `z_goods_val` VALUES (3, 2, '2:3', 64.00, 64.00, 99, 0, 1553140377, 1553140377);
INSERT INTO `z_goods_val` VALUES (4, 3, '3:4', 64.00, 64.00, 99, 0, 1553140446, 1553140446);
INSERT INTO `z_goods_val` VALUES (5, 3, '3:5', 118.00, 118.00, 99, 0, 1553140446, 1553140446);
INSERT INTO `z_goods_val` VALUES (6, 4, '4:6', 48.00, 48.00, 99, 0, 1553140502, 1553140502);
INSERT INTO `z_goods_val` VALUES (7, 4, '4:7', 65.00, 65.00, 99, 0, 1553140502, 1553140502);
INSERT INTO `z_goods_val` VALUES (8, 5, '5:8', 67.00, 67.00, 99, 0, 1553140544, 1553140544);
INSERT INTO `z_goods_val` VALUES (9, 6, '6:9', 29.00, 29.00, 99, 0, 1553140614, 1553140614);
INSERT INTO `z_goods_val` VALUES (10, 6, '6:10', 67.00, 67.00, 99, 0, 1553140614, 1553140614);
INSERT INTO `z_goods_val` VALUES (11, 6, '6:11', 94.00, 94.00, 99, 0, 1553140614, 1553140614);
INSERT INTO `z_goods_val` VALUES (12, 7, '7:12', 63.00, 63.00, 99, 0, 1553140671, 1553140671);
INSERT INTO `z_goods_val` VALUES (13, 7, '7:13', 96.00, 96.00, 99, 0, 1553140671, 1553140671);
INSERT INTO `z_goods_val` VALUES (14, 8, '8:14,9:16,10:20', 23.00, 23.00, 99, 0, 1553147957, 1553147957);
INSERT INTO `z_goods_val` VALUES (15, 8, '8:14,9:16,10:21', 23.00, 23.00, 99, 0, 1553147957, 1553147957);
INSERT INTO `z_goods_val` VALUES (16, 8, '8:14,9:16,10:22', 23.00, 23.00, 99, 0, 1553147957, 1553147957);
INSERT INTO `z_goods_val` VALUES (17, 8, '8:14,9:16,10:23', 23.00, 23.00, 99, 0, 1553147957, 1553147957);
INSERT INTO `z_goods_val` VALUES (18, 8, '8:14,9:17,10:20', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (19, 8, '8:14,9:17,10:21', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (20, 8, '8:14,9:17,10:22', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (21, 8, '8:14,9:17,10:23', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (22, 8, '8:14,9:18,10:20', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (23, 8, '8:14,9:18,10:21', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (24, 8, '8:14,9:18,10:22', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (25, 8, '8:14,9:18,10:23', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (26, 8, '8:14,9:19,10:20', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (27, 8, '8:14,9:19,10:21', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (28, 8, '8:14,9:19,10:22', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (29, 8, '8:14,9:19,10:23', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (30, 8, '8:15,9:16,10:20', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (31, 8, '8:15,9:16,10:21', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (32, 8, '8:15,9:16,10:22', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (33, 8, '8:15,9:16,10:23', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (34, 8, '8:15,9:17,10:20', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (35, 8, '8:15,9:17,10:21', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (36, 8, '8:15,9:17,10:22', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (37, 8, '8:15,9:17,10:23', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (38, 8, '8:15,9:18,10:20', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (39, 8, '8:15,9:18,10:21', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (40, 8, '8:15,9:18,10:22', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (41, 8, '8:15,9:18,10:23', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (42, 8, '8:15,9:19,10:20', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (43, 8, '8:15,9:19,10:21', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (44, 8, '8:15,9:19,10:22', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (45, 8, '8:15,9:19,10:23', 23.00, 23.00, 99, 0, 1553147958, 1553147958);
INSERT INTO `z_goods_val` VALUES (46, 9, '11:24', 18.00, 18.00, 99, 0, 1553160659, 1553160659);
INSERT INTO `z_goods_val` VALUES (47, 9, '11:25', 23.00, 23.00, 99, 0, 1553160659, 1553160659);
INSERT INTO `z_goods_val` VALUES (48, 10, '12:26', 18.00, 18.00, 99, 0, 1553218889, 1553218889);
INSERT INTO `z_goods_val` VALUES (49, 10, '12:27', 22.00, 22.00, 99, 0, 1553218889, 1553218889);
INSERT INTO `z_goods_val` VALUES (50, 11, '13:28', 16.00, 17.00, 99, 0, 1553218965, 1553226605);
INSERT INTO `z_goods_val` VALUES (51, 12, '14:29', 17.00, 17.00, 99, 0, 1553226744, 1553226744);
INSERT INTO `z_goods_val` VALUES (52, 12, '14:30', 22.00, 22.00, 99, 0, 1553226744, 1553226744);
INSERT INTO `z_goods_val` VALUES (57, 13, '19:41,20:43', 17.00, 17.00, 0, 0, 1553235009, 1553235067);
INSERT INTO `z_goods_val` VALUES (58, 13, '19:41,20:44', 17.00, 17.00, 0, 0, 1553235009, 1553235067);
INSERT INTO `z_goods_val` VALUES (59, 13, '19:42,20:43', 26.00, 26.00, 0, 0, 1553235009, 1553235067);
INSERT INTO `z_goods_val` VALUES (60, 13, '19:42,20:44', 26.00, 26.00, 0, 0, 1553235009, 1553235067);

-- ----------------------------
-- Table structure for z_user
-- ----------------------------
DROP TABLE IF EXISTS `z_user`;
CREATE TABLE `z_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户昵称',
  `head_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户头像',
  `sex` tinyint(1) NOT NULL DEFAULT 1 COMMENT '性别 1男 2女',
  `province` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '省份',
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '城市',
  `openid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户openid',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态 1 正常 2冻结',
  `subscribe` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否关注公众号 1表示关注 0表示未关注',
  `add_time` int(11) NOT NULL DEFAULT 0 COMMENT '注册时间',
  `update_time` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_user
-- ----------------------------
INSERT INTO `z_user` VALUES (1, '%F0%9F%87%B2+%F0%9F%87%B7+%C2%B7%F0%9F%87%B5+%F0%9F%87%AF%F0%9F%99%83', 'http://thirdwx.qlogo.cn/mmopen/vi_32/pVxaShmrVyq13RzPdicSh04Xp0vuJ79HMIAD3xSdt2srVtTy664eUicFibmPfLjZiae8PV5YhoJFrt57ZbUNb4Pv0w/132', 1, '贵州', '六盘水', 'oZp0Dj6poA0nph11n453vOO8P0lQ', 1, 1, 1548405755, 1550213346);
INSERT INTO `z_user` VALUES (2, '%E7%91%8B%E7%91%8B', 'http://thirdwx.qlogo.cn/mmopen/vi_32/QOiaNght8yARcd9zYdtYA0otfa12tK7IJ924Em8NYSPnPlia3Y6kn3ceib7ofMicQaFRz5DIZ5WqEHztJ7NwoMAZUQ/132', 2, '湖南', '衡阳', 'oZp0Dj9ZBXO2C3qs6Wimn0t7zn4A', 1, 1, 1548410208, 1548494906);
INSERT INTO `z_user` VALUES (3, '%E6%B1%AA%E5%A4%A7%E9%94%A4', 'http://thirdwx.qlogo.cn/mmopen/vi_32/icSQJC8EphXssCW07lCQvc0IGXfycNOEWTwkkWKx2r6tdwGSRAsTQUn2q6xB91zE77ORL8wzaNJffaicwVLI9oTg/132', 1, '广东', '广州', 'oZp0Dj2f5SYOoJhgSdII6LvByJZ8', 1, 1, 1548410474, 1548495003);
INSERT INTO `z_user` VALUES (4, '%E9%99%86%E5%B0%8F%E5%85%AD++%E3%81%A4%E3%80%82', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eq0vTOMBPqwJic8qicgxus8cmuauXZkcNa33ictJwOuPWJRwbh5VFAUGEUBbkKV0eOUUaNBmbwBbRrwA/132', 2, '广东', '广州', 'oZp0Dj6fGZ1AR2f_kTHqKL8JW7DY', 1, 0, 1548468641, 1548468641);
INSERT INTO `z_user` VALUES (5, '%F0%9F%92%AB+%E7%B3%96%E4%B8%8D%E7%94%9C+%F0%9F%92%83', 'http://thirdwx.qlogo.cn/mmopen/vi_32/pERa7xlXibPibNO3XzaQebZXkmLEV5NYbLEHUYn3Mld5icl8gnJe5AC0VEfGE2QtNd6iaJ68hog1VZDbb8QJUnKJCg/132', 2, '', '', 'oZp0Dj1GoThv__QezJCBk0mR3VVg', 1, 0, 1548471977, 1548471977);

SET FOREIGN_KEY_CHECKS = 1;

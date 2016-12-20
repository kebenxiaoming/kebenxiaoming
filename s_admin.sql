-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016-12-06 08:20:22
-- 服务器版本: 5.5.53-0ubuntu0.14.04.1
-- PHP 版本: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `s_admin`
--

-- --------------------------------------------------------

--
-- 表的结构 `darling_article`
--

CREATE TABLE IF NOT EXISTS `darling_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL COMMENT '分类id',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `views` int(5) NOT NULL DEFAULT 0 COMMENT '阅读数',
  `pics` varchar(255) DEFAULT NULL,
  `description` varchar(520) NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '状态1：可用；0：不可用',
  `sort` int(5) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- 表的结构 `darling_file`
--

CREATE TABLE IF NOT EXISTS `darling_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文件ID',
  `name` char(50) NOT NULL DEFAULT '' COMMENT '原始文件名',
  `savename` char(225) NOT NULL DEFAULT '' COMMENT '保存名称',
  `savepath` char(225) NOT NULL DEFAULT '' COMMENT '文件保存路径',
  `ext` char(5) NOT NULL DEFAULT '' COMMENT '文件后缀',
  `mime` char(40) NOT NULL DEFAULT '' COMMENT '文件mime类型',
  `size` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `location` varchar(500) NOT NULL DEFAULT '0' COMMENT '文件保存位置',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '远程地址',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `ossres` varchar(255) DEFAULT NULL COMMENT 'oss返回的完整文件路径',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='文件表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `darling_file`
--

INSERT INTO `darling_file` (`id`, `name`, `savename`, `savepath`, `ext`, `mime`, `size`, `md5`, `sha1`, `location`, `url`, `create_time`, `ossres`) VALUES
(6, '1269fa1fa7.jpg', '68cdc7dcb9b0fb80b4e4a6f4d8587fe4.jpg', '20161206/68cdc7dcb9b0fb80b4e4a6f4d8587fe4.jpg', 'jpg', '', 768774, 'baf46c63d1d09ea3ab613f73736bec1c', '210557ead1ba77b7a9faec5bfd4b2214c7244489', '/usr/share/nginx/html/uploads/20161206/68cdc7dcb9b0fb80b4e4a6f4d8587fe4.jpg', '', 1481006044, NULL),
(5, '1.jpg', '57295f3fd3c811b62646fbfea17b5b9e.jpg', '20161206/57295f3fd3c811b62646fbfea17b5b9e.jpg', 'jpg', '', 151855, '0e6dda7cd91063966caf0baf1b80f659', '434d2b487044b05687d0b126c8c0e04e04ea750a', '/usr/share/nginx/html/uploads/20161206/57295f3fd3c811b62646fbfea17b5b9e.jpg', '', 1480995661, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `darling_menu_url`
--

CREATE TABLE IF NOT EXISTS `darling_menu_url` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(50) NOT NULL,
  `menu_url` varchar(255) NOT NULL,
  `module_id` int(11) NOT NULL,
  `is_show` tinyint(4) NOT NULL COMMENT '是否在sidebar里出现',
  `online` int(11) NOT NULL DEFAULT '1' COMMENT '在线状态，还是下线状态，即可用，不可用。',
  `shortcut_allowed` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '是否允许快捷访问',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `menu_desc` varchar(255) DEFAULT NULL,
  `father_menu` int(11) NOT NULL DEFAULT '0' COMMENT '上一级菜单',
  PRIMARY KEY (`menu_id`),
  UNIQUE KEY `menu_url` (`menu_url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='功能链接（菜单链接）' AUTO_INCREMENT=29 ;

--
-- 转存表中的数据 `darling_menu_url`
--

INSERT INTO `darling_menu_url` (`menu_id`, `menu_name`, `menu_url`, `module_id`, `is_show`, `online`, `shortcut_allowed`, `sort`, `menu_desc`, `father_menu`) VALUES
(1, '首页', 'Index/index', 1, 0, 1, 1, 0, '后台首页', 0),
(2, '账号列表', 'User/index', 1, 1, 1, 1, 0, '账号列表', 0),
(3, '修改账号', 'User/edit', 1, 0, 1, 0, 0, '修改账号', 2),
(4, '新建账号', 'User/add', 1, 0, 1, 1, 0, '新建账号', 2),
(5, '个人信息', 'User/profile', 1, 0, 1, 1, 0, '个人信息', 0),
(6, '账号组成员', 'User/showGroup', 1, 0, 1, 0, 0, '显示账号组详情及该组成员', 7),
(7, '账号组管理', 'Group/index', 1, 1, 1, 1, 4, '增加管理员', 0),
(8, '修改账号组', 'Group/edit', 1, 0, 1, 0, 0, '修改账号组', 7),
(9, '新建账号组', 'Group/add', 1, 0, 1, 1, 0, '新建账号组', 7),
(10, '权限管理', 'Group/group_role', 1, 1, 1, 1, 3, '用户权限依赖于账号组的权限', 0),
(11, '菜单模块', 'Module/index', 1, 1, 1, 1, 0, '菜单里的模块', 0),
(12, '编辑菜单模块', 'Module/edit', 1, 0, 1, 0, 0, '编辑模块', 11),
(13, '添加菜单模块', 'Module/add', 1, 0, 1, 1, 0, '添加菜单模块', 11),
(14, '功能列表', 'Menu/index', 1, 1, 1, 1, 0, '菜单功能及可访问的链接', 0),
(15, '增加功能', 'Menu/add', 1, 0, 1, 1, 0, '增加功能', 14),
(16, '功能修改', 'Menu/edit', 1, 0, 1, 0, 0, '修改功能', 14),
(17, '设置模板', '/panel/set.php', 1, 0, 1, 1, 0, '设置模板', 0),
(19, '菜单链接列表', '/panel/module.php', 1, 0, 1, 0, 0, '显示模块详情及该模块下的菜单', 11),
(20, '登入', 'Login/index', 1, 0, 1, 1, 0, '登入页面', 0),
(21, '操作记录', 'Syslog/index', 1, 1, 1, 1, 2, '用户操作的历史行为', 0),
(22, '系统信息', 'System/index', 1, 1, 1, 1, 0, '显示系统相关信息', 0),
(24, '博客列表', 'Blog/index', 8, 1, 1, 1, 1, '博客列表', 0),
(27, '添加博客', 'Blog/add', 8, 0, 1, 1, 1, '添加博客', 24),
(28, '编辑博客', 'Blog/edit', 8, 0, 1, 1, 2, '编辑博客', 24);

-- --------------------------------------------------------

--
-- 表的结构 `darling_module`
--

CREATE TABLE IF NOT EXISTS `darling_module` (
  `module_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(50) NOT NULL,
  `module_url` varchar(128) NOT NULL,
  `module_sort` int(11) unsigned NOT NULL DEFAULT '1',
  `module_desc` varchar(255) DEFAULT NULL,
  `module_icon` varchar(32) DEFAULT 'icon-th' COMMENT '菜单模块图标',
  `online` int(11) NOT NULL DEFAULT '1' COMMENT '模块是否在线',
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='菜单模块' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `darling_module`
--

INSERT INTO `darling_module` (`module_id`, `module_name`, `module_url`, `module_sort`, `module_desc`, `module_icon`, `online`) VALUES
(1, '网站管理', 'Index/index', 1, '配置网站的相关信息', 'icon-th', 1),
(8, '博客模块', 'Blog/index', 2, '我的博客', 'icon-th', 1);

-- --------------------------------------------------------

--
-- 表的结构 `darling_system`
--

CREATE TABLE IF NOT EXISTS `darling_system` (
  `key_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `key_value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`key_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='系统配置表';

--
-- 转存表中的数据 `darling_system`
--

INSERT INTO `darling_system` (`key_name`, `key_value`) VALUES
('timezone', '"Asia/Shanghai"');

-- --------------------------------------------------------

--
-- 表的结构 `darling_sys_log`
--

CREATE TABLE IF NOT EXISTS `darling_sys_log` (
  `op_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL,
  `action` varchar(255) NOT NULL,
  `class_name` varchar(255) NOT NULL COMMENT '操作了哪个类的对象',
  `class_obj` varchar(32) NOT NULL COMMENT '操作的对象是谁，可能为对象的ID',
  `result` text NOT NULL COMMENT '操作的结果',
  `op_time` int(11) NOT NULL,
  PRIMARY KEY (`op_id`),
  KEY `op_time` (`op_time`),
  KEY `class_name` (`class_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='操作日志表' AUTO_INCREMENT=378 ;

--
-- 转存表中的数据 `darling_sys_log`
--

INSERT INTO `darling_sys_log` (`op_id`, `user_name`, `action`, `class_name`, `class_obj`, `result`, `op_time`) VALUES
(283, 'admin', 'MODIFY', 'UserGroup', '4', '{"group_id":"4","group_role":"1,5,8,11"}', 1475203109),
(284, 'admin', 'MODIFY', 'UserGroup', '4', '{"group_id":"4","group_role":"1,5,8"}', 1475203115),
(285, 'admin', 'ADD', 'UserGroup', '1', '{"group_name":"adf","group_desc":"adfsa","group_role":"1,5,17,18,22,23,24,25","owner_id":1}', 1475203599),
(286, 'admin', 'MODIFY', 'Module', '4', '{"module_id":4,"module_name":"\\u4ea7\\u54c1\\u7ba1\\u7406","module_url":"\\/product\\/index.php","module_sort":"2","module_desc":"\\u4ea7\\u54c1\\u7ba1\\u7406"}', 1475206034),
(287, 'admin', 'MODIFY', 'Module', '6', '{"module_id":"6","module_name":"\\u8bbe\\u8ba1\\u5e08\\u7ba1\\u740611","module_url":"\\/designer\\/index,php","module_sort":"2","module_desc":"\\u8bbe\\u8ba1\\u5e08\\u7ba1\\u7406"}', 1475206401),
(288, 'admin', 'MODIFY', 'Module', '6', '{"module_id":"6","module_name":"\\u8bbe\\u8ba1\\u5e08\\u7ba1\\u7406","module_url":"\\/designer\\/index,php","module_sort":"2","module_desc":"\\u8bbe\\u8ba1\\u5e08\\u7ba1\\u7406"}', 1475206409),
(289, 'admin', 'ADD', 'Module', '1', '{"module_name":"sfsadf","module_url":"Module\\/add","module_sort":"12","module_desc":"aqefdasqrd"}', 1475206884),
(290, 'admin', 'DEL', 'Module', '9', '{"module_id":9,"module_name":"sfsadf","module_url":"Module\\/add","module_sort":12,"module_desc":"aqefdasqrd","module_icon":"icon-th","online":1}', 1475206889),
(291, 'admin', 'MODIFY', 'MenuUrl', '123', '{"menu_name":"\\u8054\\u7edc\\u8be6\\u60c5","menu_url":"Contact\\/show","module_id":"7","is_show":"0","father_menu":"0","online":"1","shortcut_allowed":"0","sort":"0","menu_desc":"\\u663e\\u793a\\u8054\\u7edc\\u8be6\\u60c5\\u963f\\u9053\\u592b","menu_id":123}', 1475215593),
(292, 'admin', 'MODIFY', 'MenuUrl', '123', '{"menu_name":"\\u8054\\u7edc\\u8be6\\u60c5","menu_url":"Contact\\/show","module_id":"7","is_show":"0","father_menu":"0","online":"1","shortcut_allowed":"0","sort":"0","menu_desc":"\\u663e\\u793a\\u8054\\u7edc\\u8be6\\u60c5","menu_id":123}', 1475215600),
(293, 'admin', 'ADD', 'MenuUrl', '1', '{"menu_name":"\\u6d4b\\u8bd5","menu_url":"Test\\/index","module_id":"6","is_show":"1","father_menu":"0","shortcut_allowed":"0","sort":"0","menu_desc":"\\u5566\\u5566\\u5566"}', 1475215979),
(294, 'admin', 'MODIFY', 'MenuUrl', '124', '{"menu_name":"\\u6d4b\\u8bd5","menu_url":"Test\\/index","module_id":"6","is_show":"1","father_menu":"0","online":"1","shortcut_allowed":"0","sort":"0","menu_desc":"\\u5566\\u5566\\u5566sdf","menu_id":124}', 1475215991),
(295, 'admin', 'DEL', 'MenuUrl', '124', '{"menu_id":124,"menu_name":"\\u6d4b\\u8bd5","menu_url":"Test\\/index","module_id":6,"is_show":1,"online":1,"shortcut_allowed":0,"sort":0,"menu_desc":"\\u5566\\u5566\\u5566sdf","father_menu":0}', 1475216017),
(296, 'admin', 'DEL', 'Module', '6', '{"module_id":6,"module_name":"\\u8bbe\\u8ba1\\u5e08\\u7ba1\\u7406","module_url":"\\/designer\\/index,php","module_sort":2,"module_desc":"\\u8bbe\\u8ba1\\u5e08\\u7ba1\\u7406","module_icon":"icon-font","online":1}', 1475216048),
(297, 'admin', 'DEL', 'Module', '7', '{"module_id":7,"module_name":"\\u8054\\u7edc\\u7ba1\\u7406","module_url":"\\/contact\\/index.php","module_sort":1,"module_desc":"\\u8054\\u7edc\\u7ba1\\u7406","module_icon":"icon-headphones","online":1}', 1475216052),
(298, 'admin', 'DEL', 'Module', '5', '{"module_id":5,"module_name":"\\u7ecf\\u9500\\u5546\\u7ba1\\u7406","module_url":"\\/dealer\\/index.php","module_sort":1,"module_desc":"\\u7ecf\\u9500\\u5546\\u7ba1\\u7406","module_icon":"icon-user","online":1}', 1475216055),
(299, 'admin', 'DEL', 'Module', '4', '{"module_id":4,"module_name":"\\u4ea7\\u54c1\\u7ba1\\u7406","module_url":"\\/product\\/index.php","module_sort":2,"module_desc":"\\u4ea7\\u54c1\\u7ba1\\u7406","module_icon":"icon-align-justify","online":1}', 1475216059),
(300, 'admin', 'MODIFY', 'Module', '1', '{"module_id":"1","module_name":"\\u7f51\\u7ad9\\u7ba1\\u7406","module_url":"Index\\/index","module_sort":"1","module_desc":"\\u914d\\u7f6e\\u7f51\\u7ad9\\u7684\\u76f8\\u5173\\u4fe1\\u606f"}', 1475216070),
(301, 'admin', 'ADD', 'Module', '1', '{"module_name":"\\u6d4b\\u8bd5\\u6a21\\u5757","module_url":"Test\\/index","module_sort":"2","module_desc":"\\u5566\\u5566"}', 1475216127),
(302, 'admin', 'ADD', 'MenuUrl', '1', '{"menu_name":"\\u6d4b\\u8bd5\\u5217\\u8868","menu_url":"Test\\/index","module_id":"8","is_show":"1","father_menu":"0","shortcut_allowed":"1","sort":"0","menu_desc":"\\u5475\\u5475\\u5475"}', 1475216224),
(303, 'admin', 'MODIFY', 'UserGroup', '1', '{"group_id":1,"group_role":"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,117,125"}', 1475216233),
(304, 'admin', 'MODIFY', 'MenuUrl', '117', '{"menu_name":"\\u6587\\u4ef6\\u4e0a\\u4f20","menu_url":"File\\/upload","module_id":"8","is_show":"1","father_menu":"0","online":"1","shortcut_allowed":"1","sort":"1","menu_desc":"\\u6587\\u4ef6\\u4e0a\\u4f20\\u63a7\\u5236","menu_id":117}', 1475216258),
(305, 'admin', 'MODIFY', 'UserGroup', '1', '{"group_name":"\\u8d85\\u7ea7\\u7ba1\\u7406\\u5458\\u7ec4","group_desc":"\\u4e07\\u80fd\\u7684\\u4e0d\\u662f\\u795e\\uff0c\\u662f\\u7a0b\\u5e8f\\u5458bbb","group_id":1}', 1475216542),
(306, 'admin', 'MODIFY', 'UserGroup', '1', '{"group_name":"\\u8d85\\u7ea7\\u7ba1\\u7406\\u5458\\u7ec4","group_desc":"\\u4e07\\u80fd\\u7684\\u4e0d\\u662f\\u795e\\uff0c\\u662f\\u7a0b\\u5e8f\\u5458\\uff0c\\u54c8\\u54c8\\u54c8","group_id":1}', 1475216553),
(307, 'admin', 'ADD', 'UserGroup', '1', '{"group_name":"\\u6d4b\\u8bd5\\u8d26\\u53f7\\u7ec4","group_desc":"\\u5566\\u5566\\u5566\\u5566","group_role":"1,5,17,18,22,23,24,25","owner_id":1}', 1475216632),
(308, 'admin', 'MODIFY', 'MenuUrl', '3', '{"menu_name":"\\u4fee\\u6539\\u8d26\\u53f7","menu_url":"User\\/edit","module_id":"1","is_show":"0","father_menu":"2","online":"1","shortcut_allowed":"0","sort":"0","menu_desc":"\\u4fee\\u6539\\u8d26\\u53f7","menu_id":3}', 1475905662),
(309, 'admin', 'MODIFY', 'User', '1', '{"user_id":"26","user_name":"demo","real_name":"sunny","mobile":"15812345678","email":"yuwenqi@osadmin.org","user_desc":"\\u9ed8\\u8ba4\\u7528\\u6237\\u7ec4\\u6210\\u5458","user_group":"1"}', 1475905681),
(310, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.130"}', 1475905772),
(311, 'admin', 'DEL', 'User', '26', '{"user_id":26,"user_name":"demo","password":"e10adc3949ba59abbe56e057f20f883e","real_name":"sunny","mobile":"15812345678","email":"yuwenqi@osadmin.org","user_desc":"\\u9ed8\\u8ba4\\u7528\\u6237\\u7ec4\\u6210\\u5458","login_time":1468824260,"status":1,"login_ip":"192.168.18.113","user_group":1,"template":"schoolpainting","shortcuts":"","show_quicknote":0}', 1475906111),
(312, 'admin', 'ADD', 'User', '1', '{"user_name":"sunny","password":"96e79218965eb72c92a549dd5a330112","real_name":"kebenxiaoming","mobile":"15866863307","email":"xiaoyao_xiao@126.com","user_desc":"lalallal","user_group":"1"}', 1475906230),
(313, 'sunny', 'LOGIN', 'User', '38', '{"IP":"192.168.18.130"}', 1475906254),
(314, 'sunny', 'MODIFY', 'User', '1', '{"user_id":"38","user_name":"sunny","real_name":"kebenxiaoming","mobile":"15866863307","email":"xiaoyao_xiao@126.com","user_desc":"lalallal","user_group":"5"}', 1475906325),
(315, 'sunny', 'LOGIN', 'User', '38', '{"IP":"192.168.18.130"}', 1475906419),
(316, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.130"}', 1475906434),
(317, 'admin', 'MODIFY', 'MenuUrl', '24', '{"menu_name":"\\u6d4b\\u8bd5\\u5217\\u8868","menu_url":"Test\\/index","module_id":"8","is_show":"1","father_menu":"0","online":"1","sort":"1","menu_desc":"\\u5475\\u5475\\u5475","menu_id":24}', 1475907403),
(318, 'admin', 'ADD', 'MenuUrl', '1', '{"menu_name":"\\u6d4b\\u8bd51","menu_url":"Test\\/aa","module_id":"8","is_show":"1","father_menu":"0","sort":"0","menu_desc":"aaaaa"}', 1475907461),
(319, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.130"}', 1475908095),
(320, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.130"}', 1475908222),
(321, 'admin', 'MODIFY', 'User', '1', '{"user_id":"38","user_name":"sunny","real_name":"kebenxiaoming","mobile":"15866863307","email":"xiaoyao_xiao@126.com","user_desc":"lalallal1111","user_group":"5"}', 1475914886),
(322, 'admin', 'MODIFY', 'User', '1', '{"user_id":"1","user_name":"admin","real_name":"SomewhereYu","mobile":"13800138001","email":"admin@osadmin.org","user_desc":"\\u521d\\u59cb\\u7684\\u8d85\\u7ea7\\u7ba1\\u7406\\u5458!","user_group":"5"}', 1475917866),
(323, 'admin', 'MODIFY', 'User', '1', '{"user_id":"1","user_name":"admin","real_name":"SomewhereYu","mobile":"13800138001","email":"admin@osadmin.org","user_desc":"\\u521d\\u59cb\\u7684\\u8d85\\u7ea7\\u7ba1\\u7406\\u5458!","user_group":"1"}', 1475917870),
(324, 'admin', 'MODIFY', 'User', '1', '{"user_id":"38","user_name":"sunny","real_name":"kebenxiaoming","mobile":"15866863307","email":"xiaoyao_xiao@126.com","user_desc":"lalallal1111","user_group":"3"}', 1475917957),
(325, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.130"}', 1475918776),
(326, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.130"}', 1475918796),
(327, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.130"}', 1475919208),
(328, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.130"}', 1475919254),
(329, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.130"}', 1475919307),
(330, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.130"}', 1475979133),
(331, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.130"}', 1475979168),
(332, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.130"}', 1475979202),
(333, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.130"}', 1475979495),
(334, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.130"}', 1476064693),
(335, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.130"}', 1476086906),
(336, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.130"}', 1476780988),
(337, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.134"}', 1477633952),
(338, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.134"}', 1477637882),
(339, 'admin', 'ADD', 'UserGroup', '1', '{"group_name":"adf","group_desc":"adfadf","group_role":"1,5,17,18,22,23,24,25","owner_id":1}', 1477638005),
(340, 'admin', 'MODIFY', 'UserGroup', '1', '{"group_name":"\\u8d85\\u7ea7\\u7ba1\\u7406\\u5458\\u7ec4","group_desc":"\\u4e07\\u80fd\\u7684\\u4e0d\\u662f\\u795e\\uff0c\\u662f\\u7a0b\\u5e8f\\u5458,sadfdsa","group_id":1}', 1477638060),
(341, 'admin', 'MODIFY', 'Module', '8', '{"module_id":"8","module_name":"\\u6d4b\\u8bd5\\u6a21\\u5757","module_url":"Test\\/index","module_sort":"3","module_desc":"\\u5566\\u5566"}', 1477638283),
(342, 'admin', 'MODIFY', 'Module', '8', '{"module_id":"8","module_name":"\\u6d4b\\u8bd5\\u6a21\\u5757","module_url":"Test\\/index","module_sort":"2","module_desc":"\\u5566\\u5566"}', 1477638294),
(343, 'admin', 'DEL', 'User', '38', '{"user_id":38,"user_name":"sunny","password":"96e79218965eb72c92a549dd5a330112","real_name":"kebenxiaoming","mobile":"15866863307","email":"xiaoyao_xiao@126.com","user_desc":"lalallal1111","login_time":1475906419,"status":1,"login_ip":"192.168.18.130","user_group":3,"template":"default","shortcuts":null,"show_quicknote":0}', 1477638331),
(344, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.222"}', 1480407125),
(345, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.222"}', 1480572728),
(346, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.222"}', 1480650361),
(347, 'admin', 'ADD', 'User', '4', '{"user_name":"demo","password":"96e79218965eb72c92a549dd5a330112","real_name":"\\u54c8\\u54c8\\u54c8","mobile":"15866863307","email":"xiaoyao_xiao@126.com","user_desc":"saaaaaaaaaaaaaa","user_group":"1"}', 1480669327),
(348, 'admin', 'MODIFY', 'User', '1', '{"user_id":"4","user_name":"demo","real_name":"\\u54c8\\u54c8\\u54c8111","mobile":"15866863307","email":"xiaoyao_xiao@126.com","user_desc":"saaaaaaaaaaaaaa","user_group":"1"}', 1480670180),
(349, 'admin', 'DEL', 'User', '4', '{"user_id":"4","user_name":"demo","password":"96e79218965eb72c92a549dd5a330112","real_name":"\\u54c8\\u54c8\\u54c8111","mobile":"15866863307","email":"xiaoyao_xiao@126.com","user_desc":"saaaaaaaaaaaaaa","login_time":null,"status":"1","login_ip":null,"user_group":"1","template":"default","shortcuts":null,"show_quicknote":"0"}', 1480670390),
(350, 'admin', 'LOGIN', 'User', '1', '{"IP":"192.168.18.222"}', 1480900228),
(351, 'admin', 'MODIFY', 'UserGroup', '1', '{"group_name":"\\u8d85\\u7ea7\\u7ba1\\u7406\\u5458\\u7ec4","group_desc":"\\u4e07\\u80fd\\u7684\\u4e0d\\u662f\\u795e\\uff0c\\u662f\\u7a0b\\u5e8f\\u5458","group_id":"1"}', 1480901950),
(352, 'admin', 'MODIFY', 'UserGroup', '1', '{"group_name":"\\u8d85\\u7ea7\\u7ba1\\u7406\\u5458\\u7ec4","group_desc":"\\u4e07\\u80fd\\u7684\\u4e0d\\u662f\\u795e\\uff0c\\u662f\\u7a0b\\u5e8f\\u5458","group_id":"1"}', 1480901972),
(353, 'admin', 'MODIFY', 'UserGroup', '1', '{"group_name":"\\u8d85\\u7ea7\\u7ba1\\u7406\\u5458\\u7ec4","group_desc":"\\u4e07\\u80fd\\u7684\\u4e0d\\u662f\\u795e\\uff0c\\u662f\\u7a0b\\u5e8f\\u5458","group_id":"1"}', 1480902560),
(354, 'admin', 'ADD', 'UserGroup', '6', '{"group_name":"adf","group_desc":"test","group_role":"1,5,17,18,22,23,24,25","owner_id":"1"}', 1480902849),
(355, 'admin', 'MODIFY', 'UserGroup', '1', '{"group_id":1,"group_role":"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26"}', 1480903846),
(356, 'admin', 'MODIFY', 'UserGroup', '1', '{"group_id":1,"group_role":"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26"}', 1480904287),
(357, 'admin', 'ADD', 'UserGroup', '7', '{"group_name":"\\u6d4b\\u8bd5\\u8d26\\u53f7\\u7ec4","group_desc":"\\u5566\\u5566\\u5566","group_role":"1,5,17,18,22,23,24,25","owner_id":"1"}', 1480904302),
(358, 'admin', 'MODIFY', 'Module', '8', '{"module_id":"8","module_name":"\\u6d4b\\u8bd5\\u6a21\\u57571","module_url":"Test\\/index","module_sort":"2","module_desc":"\\u5566\\u5566"}', 1480907600),
(359, 'admin', 'ADD', 'Module', '9', '{"module_name":"\\u6d4b\\u8bd5\\u6a21\\u5757123","module_url":"Module\\/add","module_sort":"3","module_desc":"\\u554a\\u554a\\u554a\\u554a\\u554a\\u554a"}', 1480908090),
(360, 'admin', 'ADD', 'Module', '10', '{"module_name":"\\u6d4b\\u8bd5\\u6a21\\u5757123","module_url":"Module\\/add","module_sort":"2","module_desc":" "}', 1480908125),
(361, 'admin', 'DEL', 'Module', '10', '{"module_id":"10","module_name":"\\u6d4b\\u8bd5\\u6a21\\u5757123","module_url":"Module\\/add","module_sort":"2","module_desc":" ","module_icon":"icon-th","online":"1"}', 1480908128),
(362, 'admin', 'MODIFY', 'Module', '8', '{"module_id":"8","module_name":"\\u6d4b\\u8bd5\\u6a21\\u5757","module_url":"Test\\/index","module_sort":"2","module_desc":"\\u5566\\u5566"}', 1480909407),
(363, 'admin', 'ADD', 'MenuUrl', '26', '{"menu_name":"\\u6d4b\\u8bd51","menu_url":"User\\/edit22","module_id":"8","is_show":"1","father_menu":"2","sort":"3","menu_desc":"\\u554a\\u554a\\u554a\\u554a\\u554a\\u554a\\u554a"}', 1480909911),
(364, 'admin', 'MODIFY', 'MenuUrl', '26', '{"menu_name":"\\u6d4b\\u8bd51","menu_url":"User\\/edit23","module_id":"8","is_show":"1","father_menu":"2","sort":"3","menu_desc":"\\u554a\\u554a\\u554a\\u554a\\u554a\\u554a\\u554a","menu_id":26}', 1480910346),
(365, 'admin', 'MODIFY', 'MenuUrl', '26', '{"menu_name":"\\u6d4b\\u8bd51","menu_url":"User\\/edit23","module_id":"8","is_show":"0","father_menu":"2","sort":"3","menu_desc":"\\u554a\\u554a\\u554a\\u554a\\u554a\\u554a\\u554a","menu_id":26}', 1480910363),
(366, 'admin', 'DEL', 'MenuUrl', '26', '{"menu_id":"26","menu_name":"\\u6d4b\\u8bd51","menu_url":"User\\/edit23","module_id":"8","is_show":"0","online":"1","shortcut_allowed":"1","sort":"3","menu_desc":"\\u554a\\u554a\\u554a\\u554a\\u554a\\u554a\\u554a","father_menu":"2"}', 1480910423),
(367, 'admin', 'MODIFY', 'User', '1', '{"user_id":"1","user_name":"admin","real_name":"yourname","mobile":"13800138001","email":"admin@osadmin.org","user_desc":"\\u521d\\u59cb\\u7684\\u8d85\\u7ea7\\u7ba1\\u7406\\u5458!","user_group":"1"}', 1480915894),
(368, 'admin', 'MODIFY', 'Module', '8', '{"module_id":"8","module_name":"\\u535a\\u5ba2\\u6a21\\u5757","module_url":"Blog\\/index","module_sort":"2","module_desc":"\\u6211\\u7684\\u535a\\u5ba2"}', 1480920422),
(369, 'admin', 'DEL', 'MenuUrl', '25', '{"menu_id":"25","menu_name":"\\u6d4b\\u8bd51","menu_url":"Test\\/aa","module_id":"8","is_show":"1","online":"1","shortcut_allowed":"1","sort":"0","menu_desc":"aaaaa","father_menu":"0"}', 1480920431),
(370, 'admin', 'MODIFY', 'MenuUrl', '24', '{"menu_name":"\\u6d4b\\u8bd5\\u5217\\u8868","menu_url":"Blog\\/index","module_id":"8","is_show":"1","father_menu":"0","sort":"1","menu_desc":"\\u535a\\u5ba2\\u5217\\u8868","menu_id":24}', 1480920602),
(371, 'admin', 'MODIFY', 'MenuUrl', '24', '{"menu_name":"\\u535a\\u5ba2\\u5217\\u8868","menu_url":"Blog\\/index","module_id":"8","is_show":"1","father_menu":"0","sort":"1","menu_desc":"\\u535a\\u5ba2\\u5217\\u8868","menu_id":24}', 1480920620),
(372, 'admin', 'LOGIN', 'User', '1', '{"IP":"219.146.83.91"}', 1480992870),
(373, 'admin', 'LOGIN', 'User', '1', '{"IP":"219.146.83.91"}', 1481005789),
(374, 'admin', 'ADD', 'MenuUrl', '27', '{"menu_name":"\\u6dfb\\u52a0\\u535a\\u5ba2","menu_url":"Blog\\/add","module_id":"8","is_show":"0","father_menu":"24","sort":"1","menu_desc":"\\u6dfb\\u52a0\\u535a\\u5ba2"}', 1481005821),
(375, 'admin', 'ADD', 'MenuUrl', '28', '{"menu_name":"\\u7f16\\u8f91\\u535a\\u5ba2","menu_url":"Blog\\/edit","module_id":"8","is_show":"0","father_menu":"24","sort":"2","menu_desc":"\\u7f16\\u8f91\\u535a\\u5ba2"}', 1481005847),
(376, 'admin', 'MODIFY', 'UserGroup', '1', '{"group_id":1,"group_role":"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28"}', 1481005852),
(377, 'admin', 'DEL', 'MenuUrl', '23', '{"menu_id":"23","menu_name":"\\u6587\\u4ef6\\u4e0a\\u4f20","menu_url":"File\\/upload","module_id":"8","is_show":"1","online":"1","shortcut_allowed":"1","sort":"1","menu_desc":"\\u6587\\u4ef6\\u4e0a\\u4f20\\u63a7\\u5236","father_menu":"0"}', 1481006186);

-- --------------------------------------------------------

--
-- 表的结构 `darling_user`
--

CREATE TABLE IF NOT EXISTS `darling_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `real_name` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_desc` varchar(255) DEFAULT NULL,
  `login_time` int(11) DEFAULT NULL COMMENT '登录时间',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `login_ip` varchar(32) DEFAULT NULL,
  `user_group` int(11) NOT NULL COMMENT ' 账号组：1:超级管理员；3：经销商管理；4：设计师',
  `template` varchar(32) NOT NULL DEFAULT 'default' COMMENT '主题模板',
  `shortcuts` text COMMENT '快捷菜单',
  `show_quicknote` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示quicknote',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='后台用户' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `darling_user`
--

INSERT INTO `darling_user` (`user_id`, `user_name`, `password`, `real_name`, `mobile`, `email`, `user_desc`, `login_time`, `status`, `login_ip`, `user_group`, `template`, `shortcuts`, `show_quicknote`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'yourname', '13800138001', 'admin@osadmin.org', '初始的超级管理员!', 1481005789, 1, '219.146.83.91', 1, 'schoolpainting', '10,105', 0);

-- --------------------------------------------------------

--
-- 表的结构 `darling_user_group`
--

CREATE TABLE IF NOT EXISTS `darling_user_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(32) DEFAULT NULL,
  `group_role` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT '初始权限为1,5,17,18,22,23,24,25',
  `owner_id` int(11) DEFAULT NULL COMMENT '创建人ID',
  `group_desc` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`group_id`),
  KEY `OWNER` (`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='账号组' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `darling_user_group`
--

INSERT INTO `darling_user_group` (`group_id`, `group_name`, `group_role`, `owner_id`, `group_desc`) VALUES
(1, '超级管理员组', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28', 1, '万能的不是神，是程序员'),
(7, '测试账号组', '1,5,17,18,22,23,24,25', 1, '啦啦啦');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 01 月 15 日 07:23
-- 服务器版本: 5.5.8
-- PHP 版本: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `mysimplecms`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `last_login_ip` varchar(32) NOT NULL DEFAULT '',
  `last_login_time` varchar(32) NOT NULL DEFAULT '',
  `state` tinyint(4) NOT NULL DEFAULT '0',
  `group_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `user_name`, `password`, `last_login_ip`, `last_login_time`, `state`, `group_id`) VALUES
(5, 'admin', '123', '127.0.0.1', '1408176183', 0, 0),
(13, 'admin23', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `admin_access`
--

CREATE TABLE IF NOT EXISTS `admin_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin_access`
--

INSERT INTO `admin_access` (`role_id`, `node_id`, `level`, `module`) VALUES
(2, 7, 3, NULL),
(2, 4, 3, NULL),
(2, 2, 2, NULL),
(2, 1, 1, NULL),
(3, 1, 1, NULL),
(3, 2, 2, NULL),
(3, 7, 3, NULL),
(11, 108, 3, NULL),
(11, 107, 3, NULL),
(11, 106, 3, NULL),
(11, 88, 3, NULL),
(11, 7, 3, NULL),
(11, 4, 3, NULL),
(11, 2, 2, NULL),
(11, 1, 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_node`
--

CREATE TABLE IF NOT EXISTS `admin_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=109 ;

--
-- 转存表中的数据 `admin_node`
--

INSERT INTO `admin_node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`) VALUES
(1, 'MySimpleCMS', '信息管理系统', 1, NULL, NULL, 0, 1),
(2, 'Admin', '权限管理', 0, NULL, NULL, 1, 2),
(4, 'add_node_ok', '添加权限', 1, NULL, NULL, 2, 3),
(7, 'del_node', '删除权限', 1, NULL, NULL, 2, 3),
(88, 'sdfd', '212', 1, NULL, NULL, 0, 3);

-- --------------------------------------------------------

--
-- 表的结构 `admin_role`
--

CREATE TABLE IF NOT EXISTS `admin_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `admin_role`
--

INSERT INTO `admin_role` (`id`, `name`, `pid`, `status`, `remark`) VALUES
(2, '超级管理员', NULL, 1, '角色1'),
(3, '管理员', NULL, 1, ''),
(4, '会员', NULL, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `admin_role_user`
--

CREATE TABLE IF NOT EXISTS `admin_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin_role_user`
--

INSERT INTO `admin_role_user` (`role_id`, `user_id`) VALUES
(2, '5'),
(3, '21'),
(0, '23'),
(3, '20'),
(2, '24');

-- --------------------------------------------------------

--
-- 表的结构 `ad_list`
--

CREATE TABLE IF NOT EXISTS `ad_list` (
  `list_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_id` int(11) NOT NULL DEFAULT '0',
  `ad_url` text NOT NULL,
  `img_path` text NOT NULL,
  `img_alt` text NOT NULL,
  `img_name` text,
  `sort` int(11) NOT NULL DEFAULT '0',
  `ad_state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`list_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `ad_list`
--


-- --------------------------------------------------------

--
-- 表的结构 `ad_location`
--

CREATE TABLE IF NOT EXISTS `ad_location` (
  `loca_id` int(11) NOT NULL AUTO_INCREMENT,
  `loca_name` text,
  `ad_description` text,
  `ad_type` int(11) NOT NULL DEFAULT '0',
  `ad_state` int(11) NOT NULL DEFAULT '1',
  `ad_pics` text NOT NULL,
  `ad_key` varchar(32) NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`loca_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `ad_location`
--

INSERT INTO `ad_location` (`loca_id`, `loca_name`, `ad_description`, `ad_type`, `ad_state`, `ad_pics`, `ad_key`, `sort`) VALUES
(3, '首页顶部轮播3', '首页顶部轮播', 0, 0, 'a:1:{i:0;a:5:{s:8:"pic_name";s:5:"logo2";s:7:"pic_alt";s:5:"logo2";s:8:"pic_path";s:17:"53d9ea5222672.gif";s:4:"sort";s:1:"2";s:7:"pic_url";s:13:"www.tudou.com";}}', 'top', 4),
(4, '首页公告标题', '首页公告标题', 0, 1, 'a:1:{i:0;a:5:{s:8:"pic_name";s:13:"download_pic2";s:7:"pic_alt";s:13:"download_pic2";s:8:"pic_path";s:17:"53e446141c1b6.jpg";s:4:"sort";i:0;s:7:"pic_url";s:0:"";}}', 'BigTitle', 1);

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_cagtegory` varchar(32) NOT NULL DEFAULT '',
  `article_title` text NOT NULL,
  `article_keywords` text NOT NULL,
  `article_source` text NOT NULL,
  `article_description` text NOT NULL,
  `article_content` text NOT NULL,
  `article_time` varchar(32) NOT NULL DEFAULT '',
  `article_thumb` text NOT NULL,
  `article_catalog` varchar(32) NOT NULL DEFAULT '',
  `article_position` text NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  `article_tpl` text NOT NULL,
  `article_related` varchar(32) NOT NULL DEFAULT '',
  `article_url` varchar(128) NOT NULL DEFAULT '',
  `article_download` text NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `article_tags` text NOT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`article_id`, `article_cagtegory`, `article_title`, `article_keywords`, `article_source`, `article_description`, `article_content`, `article_time`, `article_thumb`, `article_catalog`, `article_position`, `state`, `article_tpl`, `article_related`, `article_url`, `article_download`, `sort`, `article_tags`) VALUES
(45, '18', 'ESSENZA', '', '', 'the origin of the design is the natural old timber embracing the modern feeling of cement.\r\nThe intensity of the deep surface reminds the texture of aged timber.  \r\nThe mix with cement effect allows the colors to be refreshing and unique to this range.', 'the origin of the design is the natural old timber embracing the modern feeling of cement.<br />\r\nThe intensity of the deep surface reminds the texture of aged timber. <br />\r\nThe mix with cement effect allows the colors to be refreshing and unique to this range.<br />\r\nEssenza shows the latest fashion of home decoration incorporating traditional element to develop this great new generation of porcelain tiles.<br />', '1408291200', '53f1c65fae7c1.jpg', '', '', 0, '', '43', '', '53f1c833a26d2.zip', 0, ''),
(41, '15', 'Floor Catalogue', '', '', 'Floor Catalogue', 'Floor CatalogueFloor CatalogueFloor CatalogueFloor Catalogue', '1408291200', '53ec4f854c882.jpg', '', '', 1, '', '', '', '53f20339e6e29.rar', 0, ''),
(42, '15', 'Floor Catalogue', '', '', 'Floor CatalogueFloor Catalogue', 'Floor CatalogueFloor CatalogueFloor CatalogueFloor CatalogueFloor CatalogueFloor Catalogue', '1408291200', '53ec52f277b2c.jpg', '', '', 0, '', '', '', '53f2036d4330b.rar', 0, ''),
(43, '18', 'UMBRIA', '', '', 'Deep feeling of the full body with great subtle natural sandstone movement. \r\nThis unique design is the connoisseur and home deco’s specialist’s favorite. \r\nThe finesse of the colors and the breathtaking interacting tonalities create a real chef d’oeuvre.\r\nA guaranteed success for your projects with this collection that can be used as well as floor or wall tiles and as well on residential or commercial surfaces.', 'Deep feeling of the full body with great subtle natural sandstone movement. <br />\r\nThis unique design is the connoisseur and home deco’s specialist’s favorite. <br />\r\nThe finesse of the colors and the breathtaking interacting tonalities create a real chef d’oeuvre.<br />\r\nA guaranteed success for your projects with this collection that can be used as well as floor or wall tiles and as well on residential or commercial surfaces.<br />', '1408291200', '53f1b719cf727.jpg', '', '', 0, '', '', '', '', 0, ''),
(33, '17', '首页大字公告', '', '', 'Lorem ipsum dolor sit amset,consecteur adipiscing elit', '', '0', '', '', '', 1, '', '', '', '', 0, ''),
(34, '14', 'news1', '', '', 'Lorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset.Lorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset.Lorem ipsum dolor sit amset.', 'Lorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset,consecteur adipiscing elit', '1407081600', '53f1cc9a71489.jpg', '', '', 1, '', '', '', '', 2, ''),
(35, '14', 'news', '', '', 'Lorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset.Lorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset.Lorem ipsum dolor sit amset.', 'Lorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset.Lorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset.Lorem ipsum dolor sit amset.', '1408291200', '53f1f4997089b.jpg', '', '', 0, '', '', '', '', 0, ''),
(36, '17', 'About US', '', '', 'Lorem ipsum dolor sit amset,consecteur adipiscing elit.Lorem ipsum dolor sit amset,consecteur adipiscing elit.Lorem ipsum dolor sit amset,consecteur adipiscing elit.Lorem ipsum dolor sit amset,consecteur adipiscing elit.Lorem ipsum dolor sit amset,consecteur adipiscing elit.Lorem ipsum dolor sit amset,consecteur adipiscing elit.Lorem ipsum dolor sit amset,consecteur adipiscing elit.Lorem ipsum dolor sit amset,consecteur adipiscing elit.Lorem ipsum dolor sit amset,consecteur adipiscing elit222', '关于我们Lorem ipsum dolor sit amset,consecteur adipiscing elit.Lorem ipsum dolor sit amset,consecteur adipiscing elit.Lorem ipsum dolor sit amset,consecteur adipiscing elit.Lorem ipsum dolor sit amset,consecteur adipiscing elit.Lorem ipsum dolor sit amset,consecteur adipiscing elit.Lorem ipsum dolor sit amset,consecteur adipiscing elit.Lorem ipsum dolor sit amset,consecteur adipiscing elit.Lorem ipsum dolor sit amset,consecteur adipiscing elit.Lorem ipsum dolor sit amset,consecteur adipiscing elit222', '-28800', '', '画册1', '', 1, '', '', '', '', 0, ''),
(46, '14', 'news2', '新闻2', '', 'Lorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset.Lorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset.Lorem ipsum dolor sit amset.', 'Lorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset.Lorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset.Lorem ipsum dolor sit amset.', '1408291200', '53f1ead239b77.jpg', '', '', 0, '', '', '', '', 0, ''),
(47, '14', 'news3', '新闻3', '', 'Lorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset.Lorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset.Lorem ipsum dolor sit amset.', '', '1408291200', '53f1eae209459.jpg', '', '', 0, '', '', '', '', 0, ''),
(48, '14', 'News4', '', '', 'Lorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset.Lorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset.Lorem ipsum dolor sit amset.', 'Lorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset,consecteur adipiscing elit<span>Lorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset,consecteur adipiscing elitLorem ipsum dolor sit amset,consecteur adipiscing elit</span>', '1408291200', '53f1eaf3095d5.jpg', '', '', 0, '', '', '', '', 0, ''),
(49, '14', '标题:', '', '', '', '', '', '', '', '', 1, '', '', '', '', 0, ''),
(52, '14', '标题:', '关键词:', '文章来源:', '文章摘要:', '<span style="color:#555555;font-family:Arial, Helvetica, sans-serif;font-size:14px;font-weight:bold;line-height:18.2000007629395px;background-color:#F3F3F3;">文章内容:<span style="color:#555555;font-family:Arial, Helvetica, sans-serif;font-size:14px;font-weight:bold;line-height:18.2000007629395px;background-color:#F3F3F3;">文章<span style="color:#E53333;">内容:</span></span><span style="color:#555555;font-family:Arial, Helvetica, sans-serif;font-size:14px;font-weight:bold;line-height:18.2000007629395px;background-color:#F3F3F3;"><span style="color:#E53333;">文章</span>内容:</span><span style="color:#555555;font-family:Arial, Helvetica, sans-serif;font-size:14px;font-weight:bold;line-height:18.2000007629395px;background-color:#F3F3F3;">文章内容:</span></span>', '1410710400', '5416436caec23.jpg', '', '1-2', 0, 'content.html', ' ', 'www.baidu.com', '5416436cb233a.jpg', 2, '1-2'),
(51, '14', '标题:', '关键词', '文章来源:', '文章摘要:', '<span style="color:#555555;font-family:Arial, Helvetica, sans-serif;font-size:14px;font-weight:bold;line-height:18.2000007629395px;background-color:#F3F3F3;">文章<span style="color:#E53333;">内容:</span></span><span style="color:#E53333;font-family:Arial, Helvetica, sans-serif;font-size:14px;font-weight:bold;line-height:18.2000007629395px;background-color:#F3F3F3;">文章内容:</span><span style="color:#555555;font-family:Arial, Helvetica, sans-serif;font-size:14px;font-weight:bold;line-height:18.2000007629395px;background-color:#F3F3F3;">文章内容:</span><span style="color:#555555;font-family:Arial, Helvetica, sans-serif;font-size:14px;font-weight:bold;line-height:18.2000007629395px;background-color:#F3F3F3;">文章内容:</span><span style="color:#555555;font-family:Arial, Helvetica, sans-serif;font-size:14px;font-weight:bold;line-height:18.2000007629395px;background-color:#F3F3F3;">文章内容:</span>', '1410537600', '5413c02a1d2da.jpg', '', '1-2', 0, 'content.html', ' ', '来源URL:', '', 21, '1-2'),
(54, '16', '标题', '', '', '', '<span style="color:#555555;font-family:Arial, Helvetica, sans-serif;font-size:14px;font-weight:bold;line-height:18.2000007629395px;background-color:#FFFFFF;">文章内容<span style="color:#E53333;">:</span></span><span style="color:#E53333;font-family:Arial, Helvetica, sans-serif;font-size:14px;font-weight:bold;line-height:18.2000007629395px;background-color:#FFFFFF;">文章内容:</span><span style="color:#555555;font-family:Arial, Helvetica, sans-serif;font-size:14px;font-weight:bold;line-height:18.2000007629395px;background-color:#FFFFFF;">文章内容:</span><span style="color:#555555;font-family:Arial, Helvetica, sans-serif;font-size:14px;font-weight:bold;line-height:18.2000007629395px;background-color:#FFFFFF;">文章内容:</span><span style="color:#555555;font-family:Arial, Helvetica, sans-serif;font-size:14px;font-weight:bold;line-height:18.2000007629395px;background-color:#FFFFFF;">文章内容:</span>', '0', '', '', '', 0, '0', ' ', '', '', 0, ''),
(55, '14', '标题:', '', '', '', '', '0', '', '', '', 0, '0', '34-35', '', '', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `baseinfo`
--

CREATE TABLE IF NOT EXISTS `baseinfo` (
  `base_id` int(11) NOT NULL AUTO_INCREMENT,
  `base_name` text,
  `base_value` text,
  `sort` int(11) NOT NULL DEFAULT '0',
  `engname` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`base_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `baseinfo`
--

INSERT INTO `baseinfo` (`base_id`, `base_name`, `base_value`, `sort`, `engname`) VALUES
(3, '0', '', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `catalog_pic`
--

CREATE TABLE IF NOT EXISTS `catalog_pic` (
  `catalog_id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_name` text NOT NULL,
  `catalog_desc` text NOT NULL,
  `catalog_type` varchar(32) NOT NULL DEFAULT '',
  `article_id` int(11) NOT NULL DEFAULT '0',
  `pictureurls` text NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`catalog_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `catalog_pic`
--

INSERT INTO `catalog_pic` (`catalog_id`, `catalog_name`, `catalog_desc`, `catalog_type`, `article_id`, `pictureurls`, `sort`, `state`) VALUES
(10, '产品', '产品', '', 47, 'a:4:{i:0;a:6:{s:8:"pic_name";s:11:"UMBRIA GRIS";s:8:"pic_path";s:17:"53f1b7f4eb54c.jpg";s:7:"pic_alt";s:11:"UMBRIA GRIS";s:4:"sort";i:0;s:7:"pic_con";s:0:"";s:8:"pic_desc";s:0:"";}i:1;a:6:{s:8:"pic_name";s:14:"UMBRIA-ARGENTO";s:8:"pic_path";s:17:"53f1b7f523dd1.jpg";s:7:"pic_alt";s:14:"UMBRIA-ARGENTO";s:4:"sort";i:0;s:7:"pic_con";s:0:"";s:8:"pic_desc";s:0:"";}i:2;a:6:{s:8:"pic_name";s:13:"UMBRIA-AVORIO";s:8:"pic_path";s:17:"53f1b7f547a94.jpg";s:7:"pic_alt";s:13:"UMBRIA-AVORIO";s:4:"sort";s:1:"0";s:7:"pic_con";s:0:"";s:8:"pic_desc";s:0:"";}i:3;a:6:{s:8:"pic_name";s:13:"UMBRIA-BIANCO";s:8:"pic_path";s:17:"53f1b7f566480.jpg";s:7:"pic_alt";s:13:"UMBRIA-BIANCO";s:4:"sort";i:0;s:7:"pic_con";s:0:"";s:8:"pic_desc";s:0:"";}}', 0, 1),
(11, '背景', '背景', '', 47, 'a:1:{i:0;a:6:{s:8:"pic_name";s:3:"ppp";s:8:"pic_path";s:17:"53f1b82b133b8.jpg";s:7:"pic_alt";s:3:"ppp";s:4:"sort";i:0;s:7:"pic_con";s:0:"";s:8:"pic_desc";s:0:"";}}', 1, 1),
(12, '产品', '产品', '', 45, 'a:4:{i:0;a:6:{s:8:"pic_name";s:15:"ESSENZA-ARGENTO";s:8:"pic_path";s:17:"53f1c68f9989d.jpg";s:7:"pic_alt";s:15:"ESSENZA-ARGENTO";s:4:"sort";i:0;s:7:"pic_con";s:0:"";s:8:"pic_desc";s:0:"";}i:1;a:6:{s:8:"pic_name";s:14:"ESSENZA-AVORIO";s:8:"pic_path";s:17:"53f1c68fc4b27.jpg";s:7:"pic_alt";s:14:"ESSENZA-AVORIO";s:4:"sort";i:0;s:7:"pic_con";s:0:"";s:8:"pic_desc";s:0:"";}i:2;a:6:{s:8:"pic_name";s:14:"ESSENZA-BIANCO";s:8:"pic_path";s:17:"53f1c68fe38d3.jpg";s:7:"pic_alt";s:14:"ESSENZA-BIANCO";s:4:"sort";i:0;s:7:"pic_con";s:0:"";s:8:"pic_desc";s:0:"";}i:3;a:6:{s:8:"pic_name";s:12:"ESSENZA-GRIS";s:8:"pic_path";s:17:"53f1c6900f17c.jpg";s:7:"pic_alt";s:12:"ESSENZA-GRIS";s:4:"sort";i:0;s:7:"pic_con";s:0:"";s:8:"pic_desc";s:0:"";}}', 0, 1),
(13, '背景', '背景', '', 45, 'a:1:{i:0;a:6:{s:8:"pic_name";s:9:"铺贴图";s:8:"pic_path";s:17:"53f1c69946691.jpg";s:7:"pic_alt";s:9:"铺贴图";s:4:"sort";i:0;s:7:"pic_con";s:0:"";s:8:"pic_desc";s:0:"";}}', 1, 1),
(14, '新闻画册', '新闻画册', '', 34, 'a:3:{i:0;a:6:{s:8:"pic_name";s:4:"big1";s:8:"pic_path";s:17:"53f1f7f053498.jpg";s:7:"pic_alt";s:4:"big1";s:4:"sort";i:0;s:7:"pic_con";s:0:"";s:8:"pic_desc";s:0:"";}i:1;a:6:{s:8:"pic_name";s:4:"big2";s:8:"pic_path";s:17:"53f1f7f079b60.jpg";s:7:"pic_alt";s:4:"big2";s:4:"sort";i:0;s:7:"pic_con";s:0:"";s:8:"pic_desc";s:0:"";}i:2;a:6:{s:8:"pic_name";s:4:"big3";s:8:"pic_path";s:17:"53f1f7f09bf1a.jpg";s:7:"pic_alt";s:4:"big3";s:4:"sort";i:0;s:7:"pic_con";s:0:"";s:8:"pic_desc";s:0:"";}}', 1, 1),
(15, '画册159', '', '', 0, '', 159, 1),
(16, '画册666', '', '', 47, '', 666, 1),
(17, '画册444', '', '', 47, '', 444, 1);

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(64) NOT NULL DEFAULT '',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `thumb` text NOT NULL,
  `path` text NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  `cat_title` text NOT NULL,
  `cat_keywords` text NOT NULL,
  `cat_descripton` text NOT NULL,
  `cat_main_tpl` text NOT NULL,
  `cat_list_tpl` text NOT NULL,
  `cat_con_tpl` text NOT NULL,
  `is_single` int(11) NOT NULL DEFAULT '0',
  `cat_single_tpl` text NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `parent_id`, `sort`, `thumb`, `path`, `state`, `cat_title`, `cat_keywords`, `cat_descripton`, `cat_main_tpl`, `cat_list_tpl`, `cat_con_tpl`, `is_single`, `cat_single_tpl`) VALUES
(13, 'Collection', 0, 1, '', '0/13', 1, '', '', '', 'category_collection.html', 'list_collection.html', '', 0, ''),
(14, 'News', 0, 2, '', '0/14', 1, '', '', '', 'category_news.html', 'list_news.html', 'content_news.html', 0, ''),
(15, 'Downloads', 0, 3, '', '0/15', 1, '', '', '', '', '', '', 1, 'single_downloads.html'),
(16, 'Contacts', 0, 4, '', '0/16', 1, '', '', '', '', '', '', 1, 'single_contact.html'),
(17, '首页', 0, 0, '', '0/17', 0, '', '', '', '', '', '', 0, ''),
(18, 'Floor', 13, 1, '53e44b8a1c4f9.jpg', '0/13/18', 1, '', '', '', '', 'list_collection.html', 'content.html', 0, ''),
(19, 'Wall', 13, 3, '53f1ca7f86a32.jpg', '0/13/19', 1, '', '', '', '', 'list_collection.html', '', 0, ''),
(20, 'Deco', 13, 2, '53e44cf8e4915.jpg', '0/13/20', 1, '', '', '', '', 'list_collection.html', '', 0, ''),
(25, '子2', 17, 11, '541141015e356.jpg', '0/17/25', 1, 'Title', 'Keywords', 'Descripton', 'category.html', 'list.html', 'content.html', 1, 'single.html');

-- --------------------------------------------------------

--
-- 表的结构 `cm_list`
--

CREATE TABLE IF NOT EXISTS `cm_list` (
  `list_id` int(11) NOT NULL AUTO_INCREMENT,
  `list_name` varchar(255) NOT NULL COMMENT '联动菜单名称',
  `list_desc` text NOT NULL COMMENT '简述',
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `cm_list`
--

INSERT INTO `cm_list` (`list_id`, `list_name`, `list_desc`) VALUES
(4, 'category', '内容分类');

-- --------------------------------------------------------

--
-- 表的结构 `cm_list_item`
--

CREATE TABLE IF NOT EXISTS `cm_list_item` (
  `list_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `list_id` int(11) NOT NULL,
  `item_desc` varchar(155) NOT NULL,
  `item_parent` int(11) NOT NULL,
  `item_thumb` varchar(255) NOT NULL,
  `item_sort` int(11) NOT NULL,
  PRIMARY KEY (`list_item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `cm_list_item`
--

INSERT INTO `cm_list_item` (`list_item_id`, `list_id`, `item_desc`, `item_parent`, `item_thumb`, `item_sort`) VALUES
(1, 2, '分类1', 0, '', 0),
(2, 2, '分类2fgsdfsdf', 1, '', 0),
(3, 2, 'fenlei 3', 0, '', 0),
(4, 2, '', 0, '', 0),
(5, 3, '111', 0, '', 0),
(6, 3, '222', 5, '', 0),
(7, 3, '333', 0, '', 0),
(8, 4, '内容一级分类', 0, '', 0),
(9, 4, '内容2级分类', 8, '', 2),
(10, 4, '内容3级分类', 9, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `cm_table`
--

CREATE TABLE IF NOT EXISTS `cm_table` (
  `table_id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(256) NOT NULL COMMENT '表名称',
  PRIMARY KEY (`table_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `cm_table`
--

INSERT INTO `cm_table` (`table_id`, `table_name`) VALUES
(1, 'admin'),
(2, 'test_user'),
(4, 'test_goods'),
(7, 'content');

-- --------------------------------------------------------

--
-- 表的结构 `cm_table_column`
--

CREATE TABLE IF NOT EXISTS `cm_table_column` (
  `tab_col_id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) NOT NULL COMMENT '字段所属table',
  `column_name` varchar(255) NOT NULL COMMENT '字段（name）',
  `column_type` varchar(100) NOT NULL COMMENT '字段类型',
  `is_add` tinyint(4) NOT NULL COMMENT '0添加不显示，1显示',
  `is_edit` tinyint(4) NOT NULL COMMENT '编辑0不显示，1显示',
  `is_list` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否列表',
  `column_default_value` text NOT NULL,
  `column_desc` varchar(255) NOT NULL DEFAULT '',
  `column_help` varchar(255) NOT NULL,
  `column_error_message` varchar(255) NOT NULL,
  `column_attrs` text NOT NULL COMMENT '表单配置属性',
  `column_sort` int(11) NOT NULL COMMENT '字段显示排序',
  `is_validate` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0为不需要，1为需要',
  `min_length` int(11) NOT NULL DEFAULT '0' COMMENT '最小长度',
  `max_length` int(11) NOT NULL DEFAULT '999999' COMMENT '最大长度',
  `validate_regexp` varchar(255) NOT NULL COMMENT '验证所用正则',
  PRIMARY KEY (`tab_col_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

--
-- 转存表中的数据 `cm_table_column`
--

INSERT INTO `cm_table_column` (`tab_col_id`, `table_id`, `column_name`, `column_type`, `is_add`, `is_edit`, `is_list`, `column_default_value`, `column_desc`, `column_help`, `column_error_message`, `column_attrs`, `column_sort`, `is_validate`, `min_length`, `max_length`, `validate_regexp`) VALUES
(2, 3, '', '', 0, 0, 0, '', '', '', '', '', 0, 0, 0, 999999, ''),
(4, 3, 'user_type2', 'select', 1, 1, 0, '', '用户分类2', '帮现', '第三方', 'a:5:{s:4:"type";s:1:"1";s:9:"value_key";s:5:"value";s:10:"value_desc";s:4:"desc";s:8:"data_sql";s:25:"select * from dr_category";s:5:"lists";a:3:{i:0;a:2:{s:5:"value";s:1:"0";s:4:"desc";s:3:"是";}i:1;a:2:{s:5:"value";s:1:"1";s:4:"desc";s:3:"否";}i:2;a:2:{s:5:"value";s:1:"2";s:4:"desc";s:6:"不选";}}}', 0, 0, 0, 999999, ''),
(5, 3, 'user_type_3', 'select', 1, 1, 0, '', '用户姓名23', '二df', '第三方', 'a:5:{s:4:"type";s:1:"1";s:9:"value_key";s:5:"value";s:10:"value_desc";s:4:"desc";s:8:"data_sql";s:25:"select * from dr_category";s:5:"lists";a:3:{i:0;a:2:{s:5:"value";s:1:"0";s:4:"desc";s:3:"是";}i:1;a:2:{s:5:"value";s:1:"1";s:4:"desc";s:3:"否";}i:2;a:2:{s:5:"value";s:0:"";s:4:"desc";s:0:"";}}}', 0, 0, 0, 999999, ''),
(7, 2, 'goods_name', 'singleErea', 1, 1, 0, '', '商品名称', '二df', '第三方', '', 0, 0, 0, 999999, ''),
(8, 2, 'goods_desc', 'multiErea', 1, 1, 0, '', '商品简述', 'df二', '第三方', '', 0, 0, 0, 999999, ''),
(9, 2, 'goods_detail', 'edictor', 1, 1, 0, '', '商品详细', 'df二', '第三方', '', 0, 0, 0, 999999, ''),
(13, 2, 'goods_thumb', 'singlePic', 1, 1, 0, '', '商品缩略图', 'df二', '第三方', '', 0, 0, 0, 999999, ''),
(14, 2, 'goods_pics', 'multiPic', 1, 1, 0, '', '商品图集', 'df二', '第三方', 'a:1:{s:9:"pic_attrs";a:0:{}}', 0, 1, 2, 44, 'notempty'),
(18, 2, 'goods_cat', 'select', 1, 1, 0, '', '商品分类', '帮现', '第三方', 'a:6:{s:4:"type";s:1:"2";s:9:"value_key";s:5:"value";s:10:"value_desc";s:4:"desc";s:8:"data_sql";s:25:"select * from dr_category";s:7:"list_id";s:1:"3";s:5:"lists";a:3:{i:0;a:2:{s:5:"value";s:1:"0";s:4:"desc";s:3:"是";}i:1;a:2:{s:5:"value";s:1:"1";s:4:"desc";s:3:"fou";}i:2;a:2:{s:5:"value";s:0:"";s:4:"desc";s:0:"";}}}', 0, 0, 0, 999999, ''),
(19, 2, 'goods_if_show', 'radio', 1, 1, 0, '', '商品显示', '帮现', '第三方', 'a:2:{s:4:"type";i:1;s:5:"lists";a:2:{i:0;a:2:{s:5:"value";s:1:"0";s:4:"desc";s:3:"是";}i:1;a:2:{s:5:"value";s:1:"1";s:4:"desc";s:3:"否";}}}', 0, 0, 0, 999999, ''),
(21, 2, 'goods_date', 'date', 1, 1, 0, '', '商品显示', '帮现', '第三方', '', 0, 0, 0, 999999, ''),
(22, 2, 'goods_date_time', 'date_time', 1, 1, 0, '', '商品日期', '帮现', '第三方', '', 0, 0, 0, 999999, ''),
(23, 2, 'goods_hobbies', 'checkedbox', 1, 1, 0, '', '商品爱好', '帮现', '第三方', 'a:2:{s:4:"type";i:1;s:5:"lists";a:3:{i:0;a:2:{s:5:"value";s:1:"0";s:4:"desc";s:6:"篮球";}i:1;a:2:{s:5:"value";s:1:"1";s:4:"desc";s:6:"足球";}i:2;a:2:{s:5:"value";s:0:"";s:4:"desc";s:0:"";}}}', 0, 0, 0, 999999, ''),
(24, 3, '', 'primaryKey', 0, 0, 0, '', '', '', '', '', 0, 0, 0, 999999, ''),
(25, 4, 'goods_id', 'primaryKey', 0, 0, 0, '', '', '', '', '', 0, 0, 0, 999999, ''),
(27, 4, 'goods_name', 'singleErea', 1, 1, 0, '', '商品名称', '二dfsdfasdf', '第三方', '', 0, 0, 0, 999999, ''),
(29, 4, 'goods_desc', 'multiErea', 1, 1, 0, '', '用户姓名', '二df', '第三方', '', 0, 0, 0, 999999, ''),
(30, 4, 'goods_thumb', 'singleErea', 1, 1, 0, '', '商品缩略图', '二df', '帮现', '', 0, 0, 0, 999999, ''),
(31, 4, 'goods_pics', 'multiPic', 1, 1, 0, '', '商品图集', '二df', '帮现', 'a:0:{}', 0, 0, 0, 999999, ''),
(32, 4, 'goods_cat', 'select', 1, 1, 0, '', '商品分类', '二df', '第三方', 'a:6:{s:4:"type";s:1:"2";s:9:"value_key";s:5:"value";s:10:"value_desc";s:4:"desc";s:8:"data_sql";s:30:"select * from fs_test_category";s:7:"list_id";s:1:"4";s:5:"lists";a:2:{i:0;a:2:{s:5:"value";s:1:"0";s:4:"desc";s:3:"是";}i:1;a:2:{s:5:"value";s:1:"1";s:4:"desc";s:3:"否";}}}', 0, 0, 0, 999999, ''),
(33, 4, 'goods_if_show', 'radio', 1, 1, 0, '', '显示', '帮现', '第三方', 'a:2:{s:4:"type";i:1;s:5:"lists";a:2:{i:0;a:2:{s:5:"value";s:1:"0";s:4:"desc";s:3:"是";}i:1;a:2:{s:5:"value";s:1:"1";s:4:"desc";s:3:"否";}}}', 0, 0, 0, 999999, ''),
(34, 4, 'date', 'date', 1, 1, 0, '', '日期', '帮现', '第三方', '', 0, 0, 0, 999999, ''),
(35, 4, 'date_time', 'date_time', 1, 1, 0, '', '日期时间', '帮现', '第三方', '', 0, 0, 0, 999999, ''),
(36, 4, 'date_time_range', 'date_time_range', 1, 1, 0, '', '商品分类对方答复', '二df', '帮现', '', 0, 0, 0, 999999, ''),
(37, 4, 'date_range', 'date_range', 1, 1, 0, '', '日期范围', '帮现', '第三方', '', 0, 0, 0, 999999, ''),
(38, 4, 'hobbies', 'checkedbox', 1, 1, 0, '', '爱红啊', '二df', '用户头像', 'a:5:{s:4:"type";s:1:"1";s:9:"value_key";s:3:"234";s:10:"value_desc";s:3:"435";s:8:"data_sql";s:22:"select * from category";s:5:"lists";a:3:{i:0;a:2:{s:5:"value";s:1:"0";s:4:"desc";s:6:"篮球";}i:1;a:2:{s:5:"value";s:1:"1";s:4:"desc";s:6:"足球";}i:2;a:2:{s:5:"value";s:1:"2";s:4:"desc";s:6:"水球";}}}', 0, 0, 0, 999999, '0'),
(39, 4, 'singleppic', 'singlePic', 1, 1, 0, '', '单图片', '单图片帮助', '单图片错误信息', '', 0, 0, 0, 999999, ''),
(40, 4, 'ppccii', 'multiPic', 1, 1, 0, '', '多图片', '多图片', '多图片', 'a:2:{i:0;a:4:{s:3:"key";s:2:"11";s:4:"desc";s:2:"11";s:4:"type";s:1:"0";s:4:"sort";s:1:"0";}i:1;a:4:{s:3:"key";s:2:"22";s:4:"desc";s:2:"22";s:4:"type";s:1:"0";s:4:"sort";s:1:"0";}}', 0, 0, 0, 999999, ''),
(42, 4, 'cid', 'special', 1, 1, 0, '', 'fdsf', 'fdsfsd', 'fdsfsd', '', 0, 0, 0, 999999, ''),
(49, 7, 'id', 'primaryKey', 0, 0, 0, '', '主键（自增）', '', '', '', 0, 0, 0, 999999, ''),
(50, 7, 'cat_id', 'select', 1, 1, 0, '', '所属分类', '(必填)', '(必填)', 'a:6:{s:4:"type";s:1:"2";s:9:"value_key";s:0:"";s:10:"value_desc";s:0:"";s:8:"data_sql";s:0:"";s:7:"list_id";s:1:"4";s:5:"lists";a:1:{i:0;a:2:{s:5:"value";s:0:"";s:4:"desc";s:0:"";}}}', 0, 1, 1, 999999, '0'),
(51, 7, 'title', 'singleErea', 1, 1, 1, '', '标题', '标题', '必须为4-14位', '', 0, 1, 4, 8, 'notempty'),
(52, 7, 'inputtime', 'date', 1, 1, 1, '', '时间', '时间', '', '', 0, 1, 0, 999999, 'notempty'),
(53, 7, 'thumb', 'singlePic', 1, 1, 0, '', '缩略图', '缩略图', '', '', 0, 0, 0, 999999, 'notempty'),
(54, 7, 'content', 'edictor', 1, 1, 0, '内容', '内容', '内容', '', '', 3, 0, 0, 999999, 'notempty'),
(55, 7, 'sort', 'singleErea', 1, 1, 0, '0', '排序', '排序', '排序', '', 0, 1, 0, 999999, 'num1'),
(59, 7, 'pics', 'multiPic', 1, 1, 0, '', '文章图册', '文章图册', '文章图册', 'a:1:{s:9:"pic_attrs";a:5:{i:0;a:4:{s:3:"key";s:4:"name";s:4:"desc";s:12:"图片名称";s:9:"attr_type";s:1:"1";s:4:"sort";s:1:"0";}i:1;a:4:{s:3:"key";s:3:"alt";s:4:"desc";s:9:"图片ALT";s:9:"attr_type";s:1:"1";s:4:"sort";s:1:"1";}i:2;a:4:{s:3:"key";s:4:"sort";s:4:"desc";s:12:"图片排序";s:9:"attr_type";s:1:"1";s:4:"sort";s:1:"2";}i:3;a:4:{s:3:"key";s:4:"href";s:4:"desc";s:12:"图片链接";s:9:"attr_type";s:1:"1";s:4:"sort";s:1:"3";}i:4;a:4:{s:3:"key";s:7:"content";s:4:"desc";s:12:"图片描述";s:9:"attr_type";s:1:"3";s:4:"sort";s:1:"4";}}}', 1, 0, 2, 55, 'username'),
(60, 2, 'teest', 'singleErea', 1, 1, 0, '22', 'ffee', 'fsdfd', 'dsfsaf', '', 60, 1, 2, 16, 'num'),
(61, 7, 'description', 'multiErea', 1, 1, 0, '', '文章简介', '文章简介', '选填', '', 2, 1, 0, 999999, 'notempty'),
(63, 7, 'date_time', 'date_time', 1, 1, 0, '', '日期时间', '日期时间', '日期时间', '', 0, 1, 0, 999999, 'date_time'),
(65, 7, 'radio', 'radio', 1, 1, 0, '', '状态', '单选', '单选', 'a:2:{s:4:"type";i:1;s:5:"lists";a:2:{i:0;a:2:{s:5:"value";s:1:"1";s:4:"desc";s:3:"是";}i:1;a:2:{s:5:"value";s:1:"0";s:4:"desc";s:3:"否";}}}', 65, 0, 0, 999999, 'notempty'),
(67, 7, 'add_time', 'hidden_date', 1, 1, 0, '', '添加时间', '添加时间', '添加时间', '1', 67, 0, 0, 999999, '0'),
(69, 7, 'acce_id', 'foreignKey', 1, 1, 0, '', 'fds', 'fdsf', 'fds', 'a:2:{s:10:"table_name";s:5:"admin";s:11:"column_name";s:2:"id";}', 69, 0, 0, 999999, '0');

-- --------------------------------------------------------

--
-- 表的结构 `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `inputtime` varchar(150) NOT NULL DEFAULT '',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `sort` varchar(255) NOT NULL DEFAULT '',
  `pics` text NOT NULL,
  `description` text NOT NULL,
  `date_time` varchar(150) NOT NULL DEFAULT '',
  `radio` tinyint(4) DEFAULT '0',
  `add_time` varchar(150) NOT NULL DEFAULT '',
  `acce_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `content`
--

INSERT INTO `content` (`id`, `cat_id`, `title`, `inputtime`, `thumb`, `content`, `sort`, `pics`, `description`, `date_time`, `radio`, `add_time`, `acce_id`) VALUES
(1, 0, '测试文章1', '0', '', '测试文章1内容', '0', '', '', '', 0, '', 0),
(2, 9, '测试文章2', '1421078400', '/Public/uploads/2015-01/54acadc940c42.jpg', '文章2内容', '3', '', '', '', 0, '', 0),
(3, 9, '文章3', '1420041600', '/Public/uploads/2015-01/54acdc6937ed2.jpg', '文章3内容3', '0', 'a:2:{i:0;a:6:{s:3:"url";s:41:"/Public/uploads/2015-01/54acdc8047941.jpg";s:4:"name";s:1:"1";s:3:"alt";s:1:"1";s:4:"sort";s:1:"1";s:4:"href";s:1:"1";s:7:"content";s:1:"1";}i:1;a:6:{s:3:"url";s:41:"/Public/uploads/2015-01/54acdc880c381.jpg";s:4:"name";s:1:"2";s:3:"alt";s:1:"2";s:4:"sort";s:1:"2";s:4:"href";s:1:"2";s:7:"content";s:1:"2";}}', '', '', 0, '', 0),
(4, 9, '文章4', '1420041600', '/Public/uploads/2015-01/54acdc6937ed2.jpg', '文章3内容4', '4', 'a:3:{i:0;a:6:{s:3:"url";s:41:"/Public/uploads/2015-01/54acdc8047941.jpg";s:4:"name";s:1:"1";s:3:"alt";s:1:"1";s:4:"sort";s:1:"1";s:4:"href";s:1:"1";s:7:"content";s:1:"1";}i:1;a:6:{s:3:"url";s:41:"/Public/uploads/2015-01/54acdc880c381.jpg";s:4:"name";s:1:"2";s:3:"alt";s:1:"2";s:4:"sort";s:1:"2";s:4:"href";s:1:"2";s:7:"content";s:1:"2";}i:2;a:6:{s:3:"url";s:41:"/Public/uploads/2015-01/54acec6e18d30.jpg";s:4:"name";s:1:"3";s:3:"alt";s:1:"3";s:4:"sort";s:1:"3";s:4:"href";s:1:"3";s:7:"content";s:1:"3";}}', '', '', 0, '', 0),
(5, 9, '文章4', '1420041600', '/Public/uploads/2015-01/54acdc6937ed2.jpg', '', '4', 'a:3:{i:0;a:6:{s:3:"url";s:41:"/Public/uploads/2015-01/54acdc8047941.jpg";s:4:"name";s:1:"1";s:3:"alt";s:1:"1";s:4:"sort";s:1:"1";s:4:"href";s:1:"1";s:7:"content";s:1:"1";}i:1;a:6:{s:3:"url";s:41:"/Public/uploads/2015-01/54acdc880c381.jpg";s:4:"name";s:1:"2";s:3:"alt";s:1:"2";s:4:"sort";s:1:"2";s:4:"href";s:1:"2";s:7:"content";s:1:"2";}i:2;a:6:{s:3:"url";s:41:"/Public/uploads/2015-01/54acec6e18d30.jpg";s:4:"name";s:1:"3";s:3:"alt";s:1:"3";s:4:"sort";s:1:"3";s:4:"href";s:1:"3";s:7:"content";s:1:"3";}}', '', '', 0, '', 0),
(6, 9, '文章4', '1420041600', '/Public/uploads/2015-01/54acdc6937ed2.jpg', '', '4', 'a:3:{i:0;a:6:{s:3:"url";s:41:"/Public/uploads/2015-01/54acdc8047941.jpg";s:4:"name";s:1:"1";s:3:"alt";s:1:"1";s:4:"sort";s:1:"1";s:4:"href";s:1:"1";s:7:"content";s:1:"1";}i:1;a:6:{s:3:"url";s:41:"/Public/uploads/2015-01/54acdc880c381.jpg";s:4:"name";s:1:"2";s:3:"alt";s:1:"2";s:4:"sort";s:1:"2";s:4:"href";s:1:"2";s:7:"content";s:1:"2";}i:2;a:6:{s:3:"url";s:41:"/Public/uploads/2015-01/54acec6e18d30.jpg";s:4:"name";s:1:"3";s:3:"alt";s:1:"3";s:4:"sort";s:1:"3";s:4:"href";s:1:"3";s:7:"content";s:1:"3";}}', '发的', '', 0, '', 0),
(7, 9, '文章4', '1420041600', '/Public/uploads/2015-01/54acdc6937ed2.jpg', '文章3内容88999', '3', 'a:3:{i:0;a:6:{s:3:"url";s:41:"/Public/uploads/2015-01/54acdc8047941.jpg";s:4:"name";s:1:"1";s:3:"alt";s:1:"1";s:4:"sort";s:1:"1";s:4:"href";s:1:"1";s:7:"content";s:1:"1";}i:1;a:6:{s:3:"url";s:41:"/Public/uploads/2015-01/54acdc880c381.jpg";s:4:"name";s:1:"2";s:3:"alt";s:1:"2";s:4:"sort";s:1:"2";s:4:"href";s:1:"2";s:7:"content";s:1:"2";}i:2;a:6:{s:3:"url";s:41:"/Public/uploads/2015-01/54acec6e18d30.jpg";s:4:"name";s:1:"3";s:3:"alt";s:1:"3";s:4:"sort";s:1:"3";s:4:"href";s:1:"3";s:7:"content";s:1:"3";}}', '打发打发', '', 0, '', 0),
(8, 9, '测试CM', '1420041600', '/Public/uploads/2015-01/54af4f87eca71.jpg', '<span style="color:#555555;font-family:Arial, Helvetica, sans-serif;font-size:14px;font-weight:bold;line-height:18.2000007629395px;background-color:#FFFFFF;">内容22234455</span>', '2', 'a:1:{i:0;a:6:{s:3:"url";s:41:"/Public/uploads/2015-01/54af4f5285495.jpg";s:4:"name";s:1:"1";s:3:"alt";s:1:"2";s:4:"sort";s:1:"4";s:4:"href";s:1:"3";s:7:"content";s:1:"5";}}', '文章简介', '1420792330', 0, '1420792343', 0),
(9, 9, '123456uu', '1420041600', '/Public/uploads/2015-01/54af9d54ed495.jpg', '', '23', 'a:0:{}', 'dffd', '1420276777', 1, '1420795245', 0),
(10, 8, '标题:', '1419868800', '', '', '0', 'a:0:{}', '文章简介:', '1417594354', 1, '1420877565', 0),
(11, 8, '房顶222', '1420128000', '', '222222', '0', 'a:0:{}', 'fdfd', '1420609972', 1, '1421301291', 6);

-- --------------------------------------------------------

--
-- 表的结构 `con_position`
--

CREATE TABLE IF NOT EXISTS `con_position` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_name` text NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`position_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `con_position`
--

INSERT INTO `con_position` (`position_id`, `position_name`, `cat_id`, `sort`, `state`) VALUES
(1, '首页左侧', 0, 0, 1),
(2, '首页右侧', 0, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `friend_link`
--

CREATE TABLE IF NOT EXISTS `friend_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `friend_name` varchar(64) NOT NULL DEFAULT '',
  `friend_url` text NOT NULL,
  `friend_thumb` varchar(32) NOT NULL DEFAULT '',
  `friend_desc` text NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `friend_link`
--


-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  `company` char(32) NOT NULL DEFAULT '',
  `mail` varchar(32) NOT NULL DEFAULT '',
  `message_con` text NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `message`
--


-- --------------------------------------------------------

--
-- 表的结构 `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tags_id` int(11) NOT NULL AUTO_INCREMENT,
  `tags_name` text NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tags_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `tags`
--

INSERT INTO `tags` (`tags_id`, `tags_name`, `cat_id`, `sort`, `state`) VALUES
(1, 'PHP', 0, 0, 1),
(2, 'JAVA', 0, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `test_goods`
--

CREATE TABLE IF NOT EXISTS `test_goods` (
  `goods_id` int(11) NOT NULL,
  `goods_name` varchar(255) NOT NULL DEFAULT '',
  `goods_desc` text CHARACTER SET utf8 NOT NULL,
  `goods_thumb` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `goods_pics` text CHARACTER SET utf8 NOT NULL,
  `goods_cat` int(11) DEFAULT '0',
  `goods_if_show` tinyint(4) DEFAULT '0',
  `date` varchar(150) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `date_time` varchar(150) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `date_time_range` varchar(150) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `date_range` varchar(150) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `hobbies` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `singleppic` varchar(255) NOT NULL DEFAULT '',
  `ppccii` text NOT NULL,
  PRIMARY KEY (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `test_goods`
--


-- --------------------------------------------------------

--
-- 表的结构 `test_o`
--

CREATE TABLE IF NOT EXISTS `test_o` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `test_o`
--


-- --------------------------------------------------------

--
-- 表的结构 `test_user`
--

CREATE TABLE IF NOT EXISTS `test_user` (
  `user_id` int(11) NOT NULL,
  `goods_name` varchar(255) NOT NULL DEFAULT '',
  `goods_desc` text NOT NULL,
  `goods_detail` text NOT NULL,
  `goods_thumb` varchar(255) NOT NULL DEFAULT '',
  `goods_pics` text NOT NULL,
  `goods_cat` int(11) DEFAULT '0',
  `goods_if_show` tinyint(4) DEFAULT '0',
  `goods_date` varchar(150) NOT NULL DEFAULT '',
  `goods_date_time` varchar(150) NOT NULL DEFAULT '',
  `goods_hobbies` varchar(500) NOT NULL DEFAULT '',
  `teest` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `test_user`
--


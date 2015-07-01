-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 05 月 29 日 03:52
-- 服务器版本: 5.5.8
-- PHP 版本: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `mycms`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `user_name`, `password`, `last_login_ip`, `last_login_time`, `state`, `group_id`) VALUES
(6, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '127.0.0.1', '1432871514', 0, 0);

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `admin_node`
--


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
  KEY `status` (`status`),
  FULLTEXT KEY `remark` (`remark`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admin_role`
--


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
(0, '6');

-- --------------------------------------------------------

--
-- 表的结构 `advertise`
--

CREATE TABLE IF NOT EXISTS `advertise` (
  `advertise_id` int(11) NOT NULL AUTO_INCREMENT,
  `advertise_sort` int(11) NOT NULL DEFAULT '0',
  `siteid` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `pics` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`advertise_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `advertise`
--


-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_sort` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `catalog` text NOT NULL,
  `description` text NOT NULL,
  `datetime` varchar(150) NOT NULL DEFAULT '',
  `positions` varchar(500) NOT NULL DEFAULT '',
  `siteid` varchar(255) NOT NULL DEFAULT '',
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  `hits_ips` text NOT NULL COMMENT '点击量IP',
  `favor` int(11) NOT NULL DEFAULT '0',
  `favor_ips` text NOT NULL COMMENT '点赞IP记录',
  `eng_title` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`article_id`, `article_sort`, `title`, `keywords`, `thumb`, `content`, `catalog`, `description`, `datetime`, `positions`, `siteid`, `cat_id`, `hits`, `hits_ips`, `favor`, `favor_ips`, `eng_title`) VALUES
(20, 54, '企业介绍', '', '', '企业介绍内容', 'a:0:{}', '企业介绍描述', '1432172464', '', '1', 49, 0, '', 0, '', ''),
(21, 1431310665, '经营范围', '', '/Public/uploads/pics/2015-05/5550114786cb8.jpg', '经营范围内容', 'a:0:{}', '经营范围描述', '1431310665', '', '1', 55, 0, '', 0, '', ''),
(22, 1432105614, '案例1', '', '/Public/uploads/pics/2015-05/555410b64b517.jpg', '1999年初2，上海市又一座标志性建筑傲然屹立黄浦江畔，人们期待已久的世界第三、亚洲第二、中国内地第一的88层金茂大厦（Jinmao Tower）终于推向市场，这幢集现代办公楼、豪华五星级酒店、商业会展、高档宴会、观光、娱乐、商场等综合设施于一体，深富中华民族文化内涵，溶汇西方建筑艺术的智慧型摩天大楼，已成为当今沪上最方便舒适、最灵活安全的办公、金融、商贸、娱乐和餐饮的理想活动场所。 　　金茂大厦于1992年12月17日被批准立项，1994年5月10日动工，1997年8月28日结构封顶，至1999年3月18日开张营业，当年8月28日全面营业。金茂大厦占地2.3公顷，塔楼高420.5米，总建筑面积29万平方米。 　　金茂大厦是由美国最大的建筑师-工程师事务所之一的SOM建筑设计事务所建造的。', 'a:2:{i:0;a:6:{s:3:"url";s:48:"/./Public/uploads/pics/2015-05/5554110916340.jpg";s:4:"name";s:0:"";s:3:"alt";s:0:"";s:4:"sort";s:1:"1";s:4:"href";s:0:"";s:7:"content";s:0:"";}i:1;a:6:{s:3:"url";s:48:"/./Public/uploads/pics/2015-05/555412132c95d.jpg";s:4:"name";s:0:"";s:3:"alt";s:0:"";s:4:"sort";s:1:"3";s:4:"href";s:0:"";s:7:"content";s:0:"";}}', '1999年初2，上海市又一座标志性建筑傲然屹立黄浦江畔，人们期待已久的世界第三、亚洲第二、中国内地第一的88层金茂大厦（Jinmao Tower）终于推向市场，这幢集现代办公楼、豪华五星级酒店、商业会展、高档宴会、观光、娱乐、商场等综合设施于一体，深富中华民族文化内涵，溶汇西方建筑艺术的智慧型摩天大楼，已成为当今沪上最方便舒适、最灵活安全的办公、金融、商贸、娱乐和餐饮的理想活动场所。 　　金茂大厦于1992年12月17日被批准立项，1994年5月10日动工，1997年8月28日结构封顶，至1999年3月18日开张营业，当年8月28日全面营业。金茂大厦占地2.3公顷，塔楼高420.5米，总建筑面积29万平方米。 　　金茂大厦是由美国最大的建筑师-工程师事务所之一的SOM建筑设计事务所建造的。', '1432105614', '3', '1', 57, 0, '', 0, '', 'Shanghai jingmao'),
(24, 1431314402, '企业动态文章1', '', '', '企业动态文章1内容', 'a:0:{}', '企业动态文章1描述', '1431314402', '', '1', 60, 1, 'a:1:{i:0;s:9:"127.0.0.1";}', 1, 'a:1:{i:0;s:9:"127.0.0.1";}', ''),
(25, 1432173090, '最具价值的装修经验', '', '', '<p style="text-align:left;">\r\n	<span style="line-height:1.5;"> &nbsp; &nbsp; &nbsp; &nbsp;内容提示：如果你不是专业人士，那么八成会对家装过程不甚了解，倘若别人再提上几句家装术语，就更让你一头雾水了。别着急，我们收集了家装“前辈们”最具价值的装修经验，用“不专业”的语言，让大家轻轻松松掌握家装需要注意的问题。</span> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong><span style="font-size:16px;">关于水电</span></strong> \r\n</p>\r\n<p>\r\n	1.防水施工宜采用涂膜防水。\r\n</p>\r\n2.防水工程应在隐蔽工程施工完成并验收后进行。<br />\r\n3.防水施工完成后要做2次蓄水试验。<br />\r\n4.浴室防水层应该不低于1.8cm。<br />\r\n5.地漏、护阳角、管道等地方要多做1次防水工程。<br />\r\n6.地漏应选用防臭型。<br />\r\n7.冷热水管应该是左热、右冷。<br />\r\n8.水管尽量不要从地上走。<br />\r\n9.冷水管在墙表要有1cm的保护层，热水管在墙表要有1.5cm的保护层，因此槽要开得深。<br />\r\n10.装PPR管要考虑贴好瓷砖的厚度，这样管子才不会露出来。<br />\r\n11.经常做饭的人都知道，烧菜通常只需要几分钟，而洗菜却需要很长时间，所以水门一定要买大的。<br />\r\n12.水龙头和台盆要配套，否则很可能装不上去。<br />\r\n13.安装马桶时不能用水泥，要用硅胶。<br />\r\n14.马桶、水龙头安装好以后一定要注意保护。<br />\r\n15.购买马桶时要考虑马桶的坑距。<br />\r\n16.在安装洗衣机之前要考虑是采用上排水还是下排水。<br />\r\n17.卫浴间里最好不要安装电话，很容易受潮。<br />\r\n18.在卫浴间里安装镜子之前要先考虑好尺寸，否则镜前灯很容易安装过高。<br />\r\n19.卫浴间的管道最好留检修孔。<br />\r\n20.强电、弱电不能穿在同一根管子里。<br />\r\n21.插座的接线原则是左零、右相、上接地。<br />\r\n22.电源插座距地30cm，开关距地140cm。<br />\r\n23.开关不要装在门的背后。<br />\r\n24.居室内的插座多多益善。<br />\r\n25.大功率电器要用16A插座，如空调等。<br />\r\n26.暗盒一定要选用优质的。<br />\r\n27.暗盒要和面板配套，否则有可能装不上。<br />\r\n28.PVC电线管内，电线截面面积不得超过电线管截面面积的40%。<br />\r\n29.在卧室里安装空调的话，不能对着床。<br />\r\n30.空调开洞应向外倾斜，否则下雨的话雨水会进来。<br />\r\n31.灯具尽量考虑双控。<br />\r\n32.卫浴间最好安装防溅插座。<br />\r\n33.阳台上尽量也要安装插座。<br />\r\n34.电线槽要横平竖直排好，方便以后使用。<br />\r\n35.公用烟道应安装止逆阀。<br />\r\n<p>\r\n	<strong><span style="font-size:16px;"><br />\r\n</span></strong> \r\n</p>\r\n<p>\r\n	<strong><span style="font-size:16px;">关于泥工</span></strong> \r\n</p>\r\n1.水泥超过出厂日期3个月就不能使用了。<br />\r\n2.不同品种、标号的水泥不能混用。<br />\r\n3.黄砂一定要用河砂，用嘴尝味道就可以判断，由于河砂不含盐，所以不应该是咸的。<br />\r\n4.墙、地砖要浸水2个小时以上，阴干后才能贴。<br />\r\n5.墙、地砖宁可多买几片，不要少买，否则容易出现色差。<br />\r\n6.一面墙上不能有两排非整砖。<br />\r\n7.插缝完成后要立即对瓷砖进行清理。<br />\r\n8.地面贴浅色大理石砖，石材的背面要做防水。<br />\r\n9.阳角处要割45度角。<br />\r\n10.地砖要向地漏处倾斜，否则容易积水。<br />\r\n11.墙砖碰到管道口要采用套割的形式，这样看起来还是整块的砖。<br />\r\n12.地面大理石宜干铺。<br />\r\n13.地砖一定要选用耐脏、防滑的，不要只图好看。<br />\r\n14.亚光瓷砖很难清理，不建议选购。<br />\r\n15.阳台上的地砖铺设时要注意排水方向。<br />\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<span style="font-size:16px;"><strong>关<span style="font-size:18px;">于木工</span></strong></span> \r\n</p>\r\n1.地龙骨最好用烘干落叶松。<br />\r\n2.大块的木板材购买后就应该锯开并风干。<br />\r\n3.木工进场先要弹房子水平线。<br />\r\n4.花色面板一进场就要用油漆刷1遍，且要防止被弄脏。<br />\r\n5.吊扇不能装在吊顶龙骨上。<br />\r\n6.花色面板施工时要预先挑色。<br />\r\n7.吊顶的吊筋距离墙边不得大于300mm。<br />\r\n8.石膏板要用沉头自攻螺丝固定，且要进入板面1-2mm，并做防锈处理，不能用枪钉。<br />\r\n9.石膏板与钉子之间的距离不得大于200mm。<br />\r\n10.石膏板应与墙保持3mm的间隙，以便进行防裂处理。<br />\r\n11.石膏板阳角处最好做阳角条进行保护。<br />\r\n12.木门的上下冒头处要刷油漆。<br />\r\n13.卫浴间门套的底部要刷防水。<br />\r\n14.各个房间的房门大小应该一致。<br />\r\n15.家具尽量购买成品，不要让木工做，否则很容易出现各种各样的问题。<br />\r\n16.最好选购整体橱柜，与家具一样，也不要让木工做，否则不仅质量很可能不过关，设计也不够好。<br />\r\n17.木工做的移门不要采用暗轨道，否则以后不好维修。<br />\r\n18.面积较小的卫浴间应尽量多做移门，因为移门比开门要节约空间。<br />\r\n19.地板木龙骨平整度的误差应不超过5mm。<br />\r\n20.毛地板应铺成30度或45度，板和板之间要留2-3mm间隙，且缝要错开。<br />\r\n21.地板和墙之间要留8-10mm的缝。<br />\r\n22.复合地板长度超过8m时要考虑伸缩缝。<br />\r\n23.尽量少用中密度板做门套。<br />\r\n24.铰链和五金一定要选用优质产品。<br />\r\n25.浴霸要装在木龙骨上，不能直接装在吊顶上。<br />\r\n<p>\r\n	<strong><span style="font-size:18px;"><br />\r\n</span></strong> \r\n</p>\r\n<p>\r\n	<strong><span style="font-size:18px;">关于油漆</span></strong> \r\n</p>\r\n1.中、深色乳胶漆施工时尽量不要掺水，否则容易出现色差。<br />\r\n2.石膏板接缝处要上绷带，否则几个月后很容易裂开。<br />\r\n3.墙面有缝隙的地方要上涤纶布。<br />\r\n4.墙面原有的腻子最好铲除，或者刷1遍胶水封固。<br />\r\n5.尽量买知名品牌的油漆，无论装修公司或工头如何推荐，没名气的尽量不要用。<br />\r\n6.天气太潮湿的时候不要刷油漆。<br />\r\n7.下一道油漆的施工必须等前一道油漆干透后进行，同理，油漆、涂料的打磨也要等完全干透后进行。<br />\r\n8.金属面的油漆要做防锈处理。<br />\r\n9.气温太低会造成漆面起皱、橘皮等现象，严重影响施工质量，所以当气温低于5度时，是不适合进行油漆施工的。<br />\r\n10.对房门进行油漆涂刷时，要用美纹纸贴住铰链和门锁。<br />\r\n11.天气太热时，在涂刷过油漆后，要注意通风。<br />\r\n12.贴墙纸时，要在墙上刷清油。<br />\r\n13.贴墙纸时，应事先把开关、插座的面板卸下来。<br />\r\n14.亮光、丝光的乳胶漆要一次完成，否则很容易出现色差。<br />\r\n15.踢脚线安装好后要用腻子和乳胶漆补缝。<br />\r\n<div>\r\n	<br />\r\n</div>', 'a:0:{}', '内容提示：如果你不是专业人士，那么八成会对家装过程不甚了解，倘若别人再提上几句家装术语，就更让你一头雾水了。别着急，我们收集了家装“前辈们”最具价值的装修经验，用“不专业”的语言，让大家轻轻松松掌握家装需要注意的问题。', '1432173090', '', '1', 61, 0, '', 0, '', ''),
(26, 1432176682, '建筑装饰:传统主业放缓 新业务正稳步推进', '', '/Public/uploads/pics/2015-05/555d481f97f89.jpg', '<div style="text-align:left;">\r\n	<span style="font-size:14px;"><strong>核心观点: </strong></span><span style="font-size:14px;">传统业务收入持续放缓,龙头公司盈利能力有所提升。</span> \r\n</div>\r\n<span style="font-size:14px;"> 投资增速下行已经影响到整个装饰行业的景气程度,有些公司甚至出现了负增长。装饰公司2014年的的订单情况也不乐观。金螳螂、亚厦股份、广田股份、洪涛股份2014年、2015年1季度的毛利率有所提升。龙头公司在投资下行时,主动利用信息技术提高毛利率,能体现出更好的经营稳定性。2014年,金螳螂、亚厦股份、洪涛股份的净利润增速高于毛利增速,主要是公司经营效率持续提升。与住宅地产相关业务较多的东易日盛、广田股份、瑞和股份以及全筑股份的净利率有所降低。 </span><br />\r\n<span style="font-size:14px;"> 装饰企业占用流动资金不多,但有上升趋势。 </span><br />\r\n<span style="font-size:14px;"> 2014年,大部分装饰公司的收现比有所下降,主要原因是投资不断下行使得建筑企业资金链条偏紧,结算周期拉长;装饰公司为了保持收入的快速增长可能会放宽一些项目的收款时限。同时,大部分公司主动把资金压力向供应商转移,付现比有所下降。部分装饰公司对流动资金的占用呈缓慢上升趋势。由于投资特别是房地产投资下行,这一趋势可能会持续。 </span><br />\r\n<span style="font-size:14px;"> 新业务稳步推进,收入增量将在未来逐步体现。 </span><br />\r\n<span style="font-size:14px;"> 在目前投资下行的形势下,众多装饰公司在时下纷纷选择转型或触网,主动去适应行业的变化。从各公司2014年年报来看,互联网 、金融 、医疗 、智能家居 、3D 打印 等关键词频频出现,可见是未来装饰行业的发展方向。从披露的情况来看,新业务的进展都在稳步推进。家装e 站预计在2015年完成2000家左右的城市综合服务商布局。随着加盟商在全国各地覆盖,家装业务所带来的收入增量预计将在未来陆续体现出来。 </span><br />\r\n<p>\r\n	<span style="font-size:18px;"></span> \r\n</p>\r\n<p>\r\n	<span style="font-size:18px;"><strong><br />\r\n</strong></span> \r\n</p>\r\n<p>\r\n	<span style="font-size:14px;"><strong>投资建议：</strong></span> \r\n</p>\r\n<span style="font-size:14px;"> 综上所述,经济、投资的加速下行已经显着体现在装饰公司的业绩中,不仅对订单和收入有所影响,回款的压力也在加大。但是,传统业务的下沉不应该成为关注的重点。我们更应该看到众多装饰公司为脱离周期和转型做出的努力:通过触网 或转型大力开拓新业务,资产运作培育新的盈利点。民营装饰龙头公司机制活、资产轻、转型易,在极大的市场容量中有充足的闪转腾挪余地。我们应相信民营龙头公司未来在装饰市场中不断整合甚至颠覆原有盈利模式和竞争格局的实力。我们看好这些行业和公司的未来发展,维持对装饰行业的买入评级。 </span><br />\r\n<p>\r\n	<span style="font-size:18px;"><br />\r\n</span> \r\n</p>\r\n<p>\r\n	<span style="font-size:14px;"><strong>风险提示：</strong></span> \r\n</p>\r\n<span style="font-size:14px;"> 投资下滑速度超出预期,严重影响装饰企业订单,进而影响公司业绩;新业务低于预期;回款速度低于预期。</span>', 'a:0:{}', '', '1432176682', '', '1', 59, 1, 'a:1:{i:0;s:9:"127.0.0.1";}', 1, 'a:1:{i:0;s:9:"127.0.0.1";}', ''),
(28, 1431595349, '企业介绍', '', '/Public/uploads/pics/2015-05/555469539e192.jpg', '广东建大照明有限公司是中国大地上一颗璀璨的明珠，成立于2003年，是一家集研发、生产、销售、服务于一体的专业照明企业。拥有各种先进的专业检测设备，一流的自动生产流水线。能够生产LED中高档室内及户外灯具，目前公司专注生产LED系列平板灯，借助集团小富科技有限公司专业制作导光板的技术及成本优势，以单品制胜取市场。', 'a:0:{}', '广东建大照明有限公司是中国大地上一颗璀璨的明珠，成立于2003年，是一家集研发、生产、销售、服务于一体的专业照明企业。拥有各种先进的专业检测设备，一流的自动生产流水线。能够生产LED中高档室内及户外灯具，目前公司专注生产LED系列平板灯，借助集团小富科技有限公司专业制作导光板的技术及成本优势，以单品制胜取市场。', '1431595349', '', '2', 62, 0, '', 0, '', ''),
(29, 1431593581, '轮播图1', '', '/Public/uploads/pics/2015-05/5554626a24be7.jpg', '', 'a:0:{}', '', '1431593581', '', '2', 68, 0, '', 0, '', ''),
(30, 1431593877, '轮播图2', '', '/Public/uploads/pics/2015-05/55546393ca1ef.jpg', '', 'a:0:{}', '', '1431593877', '', '2', 68, 0, '', 0, '', ''),
(31, 1431595620, '企业荣誉', '', '/Public/uploads/pics/2015-05/55546a6391041.jpg', '企业荣誉内容', 'a:0:{}', '企业荣誉描述', '1431595620', '', '2', 62, 0, '', 0, '', ''),
(32, 1431595661, '团队风采', '', '/Public/uploads/pics/2015-05/55546a8b889f9.jpg', '团队风采内容', 'a:0:{}', '团队风采', '1431595661', '', '2', 62, 0, '', 0, '', ''),
(33, 1431595688, '联系我们', '', '/Public/uploads/pics/2015-05/55546aa6f02d3.jpg', '联系我们内容', 'a:0:{}', '联系我们', '1431595688', '', '2', 62, 0, '', 0, '', ''),
(34, 1431654650, '集团管理', '', '', '集团管理内容', 'a:0:{}', '', '1431654650', '', '2', 45, 0, '', 0, '', ''),
(35, 1431656291, '足迹遍布', '', '', '足迹遍布内容', 'a:0:{}', '', '1431656291', '', '1', 56, 0, '', 0, '', ''),
(36, 1431656327, '经营范围', '', '', '经营范围内容', 'a:0:{}', '', '1431656327', '', '2', 55, 0, '', 0, '', ''),
(37, 1431668360, '案例2', '', '/Public/uploads/pics/2015-05/55558687348f4.jpg', '', 'a:0:{}', '', '1431668360', '3', '1', 57, 0, '', 0, '', 'Case'),
(38, 1431668397, '案例3', '', '/Public/uploads/pics/2015-05/555586aa4b2f9.jpg', '', 'a:0:{}', '', '1431668397', '3', '1', 57, 0, '', 0, '', ''),
(39, 1431668497, '案例4', '', '/Public/uploads/pics/2015-05/5555870ed4951.jpg', '', 'a:0:{}', '', '1431668497', '3', '1', 57, 0, '', 0, '', ''),
(40, 1432175317, '轮播图1', '', '/Public/uploads/pics/2015-05/55558b8ad2f03.jpg', '', 'a:2:{i:0;a:6:{s:3:"url";s:46:"/Public/uploads/pics/2015-05/555d42594d6a9.jpg";s:4:"name";s:0:"";s:3:"alt";s:0:"";s:4:"sort";s:1:"1";s:4:"href";s:0:"";s:7:"content";s:0:"";}i:1;a:6:{s:3:"url";s:46:"/Public/uploads/pics/2015-05/555d4262b5f87.jpg";s:4:"name";s:0:"";s:3:"alt";s:0:"";s:4:"sort";s:1:"2";s:4:"href";s:0:"";s:7:"content";s:0:"";}}', '', '1432175317', '2', '1', 72, 0, '', 0, '', ''),
(41, 1432175145, '轮播图2', '', '/Public/uploads/pics/2015-05/555d41655ae44.jpg', '', 'a:1:{i:0;a:6:{s:3:"url";s:46:"/Public/uploads/pics/2015-05/555d41416a22a.jpg";s:4:"name";s:0:"";s:3:"alt";s:0:"";s:4:"sort";s:1:"1";s:4:"href";s:0:"";s:7:"content";s:0:"";}}', '', '1432175145', '1', '1', 72, 0, '', 0, '', ''),
(43, 1432102858, '联系我们', '联系我们', '', '<p class="\\" \\\\"\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"msonormal\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\"\\\\"\\""=""> <span style="font-size:16px;line-height:2;">网址：xfjz168.com</span> \r\n	</p>\r\n<p class="\\" \\\\"\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"msonormal\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\"\\\\"\\""=""> <span style="font-size:16px;line-height:2;"> 电话：4008-971-388</span> \r\n</p>\r\n<p class="\\" \\\\"\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"msonormal\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\"\\\\"\\""=""> <span style="font-size:16px;line-height:2;"> 传真：020-28319699</span> \r\n	</p>\r\n<p class="\\" \\\\"\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"msonormal\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\"\\\\"\\""=""> <span style="font-size:16px;line-height:2;"> 邮箱：2840652873@qq.com</span> \r\n</p>\r\n<p class="\\" \\\\"\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"msonormal\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\"\\\\"\\""=""> <span style="font-size:16px;line-height:2;">地址</span><span style="font-size:16px;line-height:2;">: <span style="line-height:2;">广东省广州市天河区黄村西路粤安工业园</span><span style="line-height:2;">A</span><span style="line-height:2;">栋</span><span style="line-height:2;">3</span><span style="line-height:2;">楼</span></span> \r\n	</p>\r\n<p class="\\" \\\\"\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"msonormal\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\"\\\\"\\""=""><br />\r\n</p>\r\n<p class="\\" \\\\"\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"msonormal\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\"\\\\"\\""=""><br />\r\n	</p>\r\n<p class="\\" \\\\"\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"msonormal\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\"\\\\"\\""=""> <span style="font-size:16px;line-height:2;"><span style="line-height:2;"><img src="/Public/uploads/pics/2015-05/555c278a3ad8b.jpg" alt="" /><br />\r\n</span></span> \r\n</p>\r\n<p class="\\" \\\\"\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"msonormal\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\"\\\\"\\""=""><br />\r\n	</p>\r\n	<p>\r\n		<br />\r\n	</p>\r\n<p class="\\" \\\\"\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"msonormal\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\"\\\\"\\""=""><br />\r\n</p>\r\n<p class="\\" \\\\"\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"msonormal\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\\"\\\\\\\\"\\\\"\\""=""><br />\r\n	</p>\r\n	<p>\r\n		<br />\r\n	</p>', 'a:0:{}', '', '1432102858', '', '1', 52, 0, '', 0, '', ''),
(46, 1432096163, ' ', ' ', ' ', ' ', 'a:0:{}', ' ', '1432096163', '', ' ', 0, 0, '', 0, '', ' '),
(47, 1432170414, '集团企业', '集团企业', '', '<p style="text-align:left;">\r\n	&nbsp; &nbsp; &nbsp; &nbsp; <span style="font-family:KaiTi_GB2312;font-size:16px;">小富投资集团本着多元化发展的战略理念，旗下企业涉及化妆品、保健品、照明灯具、导光材料制造及土建装修等不同行业。旗下子公司有：小富电子商务有限公司、小富节能科技有限公司、小富建装有限公司、高康化妆品制造有限责任公司、养美医药有限责任公司、广东建大照明有限公司，小富集团致力于打造自有品牌，决心将旗下“高康”“养美”“建大”“小富”等品牌发展成业界的一流品牌，并在国内外市场上形成销售一条龙覆盖。</span>\r\n</p>\r\n<p style="text-align:center;">\r\n	<br />\r\n<span style="font-size:18px;"></span> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>', 'a:0:{}', '', '1432170414', '', '1', 45, 0, '', 0, '', ''),
(48, 1432105903, '案例一', '', '/Public/uploads/pics/2015-05/555c320d10190.jpg', '<span>1999年初2，上海市又一座标志性建筑傲然屹立黄浦江畔，人们期待已久的世界第三、亚洲第二、中国内地第一的88层金茂大厦（Jinmao Tower）终于推向市场，这幢集现代办公楼、豪华五星级酒店、商业会展、高档宴会、观光、娱乐、商场等综合设施于一体，深富中华民族文化内涵，溶汇西方建筑艺术的智慧型摩天大楼，已成为当今沪上最方便舒适、最灵活安全的办公、金融、商贸、娱乐和餐饮的理想活动场所。 　　金茂大厦于1992年12月17日被批准立项，1994年5月10日动工，1997年8月28日结构封顶，至1999年3月18日开张营业，当年8月28日全面营业。金茂大厦占地2.3公顷，塔楼高420.5米，总建筑面积29万平方米。 　　金茂大厦是由美国最大的建筑师-工程师事务所之一的SOM建筑设计事务所建造的。</span>', 'a:2:{i:0;a:6:{s:3:"url";s:46:"/Public/uploads/pics/2015-05/555c33771ce6e.jpg";s:4:"name";s:0:"";s:3:"alt";s:0:"";s:4:"sort";s:1:"1";s:4:"href";s:0:"";s:7:"content";s:0:"";}i:1;a:6:{s:3:"url";s:46:"/Public/uploads/pics/2015-05/555c338ab679f.jpg";s:4:"name";s:0:"";s:3:"alt";s:0:"";s:4:"sort";s:1:"2";s:4:"href";s:0:"";s:7:"content";s:0:"";}}', '1999年初2，上海市又一座标志性建筑傲然屹立黄浦江畔，人们期待已久的世界第三、亚洲第二、中国内地第一的88层金茂大厦（Jinmao Tower）终于推向市场，这幢集现代办公楼、豪华五星级酒店、商业会展、高档宴会、观光、娱乐、商场等综合设施于一体，深富中华民族文化内涵，溶汇西方建筑艺术的智慧型摩天大楼，已成为当今沪上最方便舒适、最灵活安全的办公、金融、商贸、娱乐和餐饮的理想活动场所。 　　金茂大厦于1992年12月17日被批准立项，1994年5月10日动工，1997年8月28日结构封顶，至1999年3月18日开张营业，当年8月28日全面营业。金茂大厦占地2.3公顷，塔楼高420.5米，总建筑面积29万平方米。 　　金茂大厦是由美国最大的建筑师-工程师事务所之一的SOM建筑设计事务所建造的。', '1432105903', '', '1', 58, 1, 'a:1:{i:0;s:9:"127.0.0.1";}', 0, '', 'shanghai jingmao'),
(49, 1432171700, '我国文化建筑装饰业深度分析', '', '', '&nbsp; &nbsp; &nbsp; &nbsp; 随着技术进步和人们对生活质量要求的日益提高，文化建筑装饰行业已经发展成为集建筑学、声学、光学、美学、人居环境等多学科及建材、冶金、精加工、机械制造等多种产业的综合体。<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;——科学理解文化建筑装饰业的行业定义<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp; 文化建筑是公共文化场馆和文化建筑的总称，主要包括剧院影剧院类演艺场所、博物馆、展览馆、图书馆、古旧建筑、宗教建筑、文化中心等。在我国，文化建筑装饰行业属于公共建筑装饰业的一个细分行业，由于文化场馆对其艺术形象和功能的较高要求，文化建筑装饰行业必须与所装饰的客体有机结合，成为统一、和谐的整体，以便丰富艺术形象，扩大艺术表现力，加强审美效果，并提高其功能、经济价值和社会效益。<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;——客观认识文化建筑装饰业的发展现状<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp; 文化建筑装饰行业的发展状况与文化建筑的现状息息相关，近年来，我国文化建筑建设取得了巨大进步，但与国外发达国家相比，文化建筑的规模仍然较小。<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;截至2013年底，我国拥有公共图书馆3112座，较2012年增加36座，每百万人拥有公共图书馆数为2.30座，而美国平均每1.3万人就拥有一座图书馆；2013年，我国各类博物馆的数量是3476座，平均每百万人口拥有2.75个博物馆；2013年底，我国演艺类场所数量为1344个，每百万人拥有演艺类场所数量仅为0.99个。从上述数据可以看出，我国各类文化场馆的人均占有量与发达国家的人均占有量相比，存在着巨大的落差，文化建筑建设还有巨大的市场空间需要开拓和填补。<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp; 2013年，中美两国文化产业增加值占GDP比重分别为3.6%和11%，两国的文化产业规模差距巨大。作为文化载体的重要组成部分——文化建筑，其在两国的建设规模上，也存在着非常明显的差距。<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;从文化建筑的现状看，伴随着我国经济的迅猛发展以及居民人均文化消费额的快速增长，我国文化建筑无论是在建设水平还是在建设规模上，与几十年前相比都有了质的飞跃。与之相对应，文化建筑装饰行业也随着文化建筑建设市场的发展，得到了快速、有质量的增长。<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;从市场发展前景看，我国文化建筑建设市场虽然有着巨大的发展空间，但与国外发达国家相比，过低的文化建筑人均占有率和偏小的文化建筑建设市场，表明我国的文化建筑建设市场发展仍处于初级阶段，正是由于这种初级的发展阶段，才更显现出我国文化建筑建设市场的发展空间和潜力。<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp; 近年来，国家高度重视发展文化产业，我国出台多个涉及文化产业的政策性文件，在财税、金融、准入、土地等多方面给予文化产业优惠政策，扶持文化产业发展。2012年，文化部正式向社会发布《文化部“十二五”时期文化产业倍增计划》，提出了“十二五”期间文化部门管理的文化产业增加值年平均现价增长速度高于20%，2015年比2010年至少翻一番。<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;——准确掌握文化建筑装饰业的市场规模<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp; 文化建筑装饰行业作为公共建筑装饰行业中重要的细分行业之一，近年来，其增速远高于公共建筑装饰行业的增速，2010年，我国文化建筑装饰市场规模仅71.05亿元，到2014年，文化建筑装饰行业的市场规模已接近300亿元，年复合增长率超过30%。<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;预计2015年文化建筑装饰的市场规模将达365.47亿元，2019年将达834.84亿元。未来几年，我国文化建筑装饰行业的市场前景极为广阔。<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp; 在过去的十年里，随着一、二线城市经济的发展，地方政府财政收入的快速增加以及人们对精神文化消费需求的日益增长，剧院类建筑如雨后春笋般地出现在一、二线城市，特别是近两年来，随着中西部地区的开发以及三四线城市经济的崛起，各地又掀起新一轮建设剧院类建筑的热潮。<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;2009年，我国32个城市拥有的剧场数量为595座，到2013年已达882座，年均复合增长率为10.34%。同时，目前我国约有2/3的剧院需要进行重新改造以满足专业的演出要求，因此，未来剧院类建筑装饰不管是新增还是存量市场都拥有较大的发展空间。<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;据我们了解，随着人们生活水平的提高，人均文化消费水平逐年提高，无论是老年人的休闲娱乐、中青年的社交需求或少年儿童学习艺术的需求，都需要有一个文化建筑进行承载，社区剧场、校园剧场等多功能剧场无疑是最合适和经济实用的场所，也将成为未来剧场乃至文化建筑市场增长的重要方向。多功能剧场包括企业总部剧场、校园剧场、社区剧场、主题秀剧场等。 &nbsp; &nbsp; &nbsp; &nbsp; 《第二次全国基本单位普查公报》显示：我国共有79.2万个居(村)委会，3600个县(级市)，360个地级市，近3000所大学。如果未来社区剧院进行规模推广，以其中百分之一的居(村)委会有条件或者能力改造现有建筑物成为社区剧场为依据测算，全国范围内起码有近8000个社区剧场需要改造，以每个社区剧场的改造费用为300万元 500万元之间为标准，则全国社区剧场的市场容量将在240亿元 400亿元之间。<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;近年来，由于受文化产业政策的扶持，我国博物馆数量有了很大程度的增长。2013年我国各类博物馆的数量是3476座，2009 2013年平均复合增长率为11.46%。<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp; 截至2013年底，我国共有公共图书馆3112座。近年来我国公共图书馆数量保持持续增长的态势，三年来年均复合增长率为2.57%。随着我国经济和文化产业的持续发展，预计2014年以及2015年新建公共图书馆的数量将稳步上升，为装饰装修市场带来持续增长的需求。<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;——全面看待建筑装饰业的竞争格局<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp; 国内早期承接文化建筑装饰项目的主要是具有全国范围施工能力的综合性大型装饰公司，如金螳螂、洪涛股份、广田股份、瑞和股份等。上述企业凭借其完备的资质、丰富的行业经验和覆盖范围广阔的营销网络，成为了早期文化建筑装饰项目的主要施工方。<br />', 'a:0:{}', '提要：随着技术进步和人们对生活质量要求的日益提高，文化建筑装饰行业已经发展成为集建筑学、声学、光学、美学、人居环境等多学科及建材、冶金、精加工、机械制造等多种产业的综合体。', '1432171700', '', '1', 59, 3, '', 0, '', ''),
(51, 1432175575, '轮播图1', '', '/Public/uploads/pics/2015-05/555d43303c6c3.jpg', '', 'a:2:{i:0;a:6:{s:3:"url";s:46:"/Public/uploads/pics/2015-05/555d43408cb9c.jpg";s:4:"name";s:0:"";s:3:"alt";s:0:"";s:4:"sort";s:1:"1";s:4:"href";s:0:"";s:7:"content";s:0:"";}i:1;a:6:{s:3:"url";s:46:"/Public/uploads/pics/2015-05/555d434eb2f9e.jpg";s:4:"name";s:0:"";s:3:"alt";s:0:"";s:4:"sort";s:1:"2";s:4:"href";s:0:"";s:7:"content";s:0:"";}}', '', '1432175575', '2', '2', 72, 0, '', 0, '', ''),
(52, 1432187265, 'Introduction', '', '', 'Introduction', 'a:0:{}', '', '1432187265', '', '3', 78, 0, '', 0, '', ''),
(53, 1432187277, 'Honor', '', '', 'Honor', 'a:0:{}', '', '1432187277', '', '3', 79, 0, '', 0, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `art_position`
--

CREATE TABLE IF NOT EXISTS `art_position` (
  `art_position_id` int(11) NOT NULL AUTO_INCREMENT,
  `art_position_sort` int(11) NOT NULL DEFAULT '0',
  `pos_name` varchar(255) NOT NULL DEFAULT '',
  `siteid` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`art_position_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `art_position`
--

INSERT INTO `art_position` (`art_position_id`, `art_position_sort`, `pos_name`, `siteid`) VALUES
(1, 0, '首页文章', '1'),
(2, 0, '首页产品推荐', '1'),
(3, 1431662081, '手机站收首页案例推荐', '1');

-- --------------------------------------------------------

--
-- 表的结构 `catalog`
--

CREATE TABLE IF NOT EXISTS `catalog` (
  `catalog_id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_sort` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `content` text NOT NULL,
  `siteid` varchar(255) NOT NULL DEFAULT '',
  `hits` int(11) NOT NULL DEFAULT '0',
  `positions` varchar(500) NOT NULL DEFAULT '',
  `favor` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `hits_ips` text NOT NULL,
  `favor_ips` text NOT NULL,
  PRIMARY KEY (`catalog_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `catalog`
--

INSERT INTO `catalog` (`catalog_id`, `catalog_sort`, `title`, `thumb`, `description`, `content`, `siteid`, `hits`, `positions`, `favor`, `cat_id`, `hits_ips`, `favor_ips`) VALUES
(1, 1, 'ccc1', '', '', '', '1', 0, '', 0, 93, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_sort` int(11) NOT NULL DEFAULT '0',
  `cat_name` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `is_show` tinyint(4) DEFAULT '0',
  `is_single` tinyint(4) DEFAULT '0',
  `parent_id` int(11) DEFAULT '0',
  `cate_tpl` text NOT NULL,
  `list_tpl` text NOT NULL,
  `show_tpl` text NOT NULL,
  `single_tpl` text NOT NULL,
  `siteid` varchar(255) NOT NULL DEFAULT '',
  `module_id` int(11) DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `sort` varchar(255) NOT NULL DEFAULT '',
  `eng_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`category_id`, `category_sort`, `cat_name`, `thumb`, `is_show`, `is_single`, `parent_id`, `cate_tpl`, `list_tpl`, `show_tpl`, `single_tpl`, `siteid`, `module_id`, `title`, `keywords`, `description`, `sort`, `eng_name`) VALUES
(44, 1431334412, '关于我们', '', 0, 1, 0, 'category_about.html', 'list_about.html', '', '', '1', 13, '', '', '', '', 'About'),
(45, 1431334432, '集团企业', '', 0, 0, 0, '', '', '', 'single_jituan.html', '1', 13, '', '', '', '', 'GROUP'),
(46, 1431334461, '经营领域', '', 0, 1, 0, 'category_jingying.html', 'list_jingying.html', '', '', '1', 13, '', '', '', '', 'BUSINESS'),
(47, 1431572470, '品牌案例', '', 0, 1, 0, 'category_case.html', 'list_case.html', 'show_case.html', '', '1', 13, '', '', '', '', 'GALLERY'),
(48, 1431334506, '资讯中心', '', 0, 1, 0, 'category_news.html', 'list_news.html', 'show_news.html', '', '1', 13, '', '', '', '', 'NEWS'),
(49, 1431076952, '企业介绍', '/Public/uploads/pics/2015-05/554c80577342b.jpg', 0, 1, 44, '', '', '', '', '1', 0, '', '', '', '', ''),
(50, 1431076967, '企业荣誉', '/Public/uploads/pics/2015-05/554c806598c80.jpg', 0, 1, 44, '', '', '', '', '1', 0, '', '', '', '', ''),
(51, 1431076987, '团队风采', '/Public/uploads/pics/2015-05/554c807976432.jpg', 0, 1, 44, '', '', '', '', '1', 0, '', '', '', '', ''),
(52, 1431077011, '联系我们', '/Public/uploads/pics/2015-05/554c80906514c.jpg', 0, 1, 44, '', '', '', '', '1', 0, '', '', '', '', ''),
(55, 1431311950, '经营范围', '/Public/uploads/pics/2015-05/5550164d5882d.jpg', 0, 1, 46, '', '', '', '', '1', 0, '', '', '', '', ''),
(56, 1431311424, '足迹遍布', '/Public/uploads/pics/2015-05/5550143f61065.jpg', 0, 1, 46, '', '', '', '', '1', 0, '', '', '', '', ''),
(57, 1431312085, '工程案例', '/Public/uploads/pics/2015-05/555016d35cc71.jpg', 0, 1, 47, '', '', '', '', '1', 0, '', '', '', '', ''),
(58, 1431312037, '家装案例', '/Public/uploads/pics/2015-05/555016a3d5b4e.jpg', 0, 1, 47, '', '', '', '', '1', 0, '', '', '', '', ''),
(59, 1431312715, '行业资讯', '/Public/uploads/pics/2015-05/5550194a89f7d.jpg', 0, 1, 48, '', '', '', '', '1', 0, '', '', '', '', ''),
(60, 1431312702, '企业动态', '/Public/uploads/pics/2015-05/5550193d4d32c.jpg', 0, 1, 48, '', '', '', '', '1', 0, '', '', '', '', ''),
(61, 1432174853, '装修课堂', '/Public/uploads/pics/2015-05/55501930b1b4e.jpg', 0, 1, 48, '', '', '', 'single_ketang.html', '1', 0, '', '', '', '', ''),
(72, 1431669506, '手机站手机轮播图', '', 1, 0, 0, '', '', '', '', '1', 13, '', '', '', '', ''),
(78, 1432179239, 'Introduction', '', 0, 1, 73, '', '', '', '', '3', 0, '', '', '', '', ''),
(79, 1432179257, 'Honor', '', 0, 1, 73, '', '', '', '', '3', 0, '', '', '', '', ''),
(80, 1432179277, 'Style', '', 0, 1, 73, '', '', '', '', '3', 0, '', '', '', '', ''),
(81, 1432179298, 'Contact', '', 0, 1, 73, '', '', '', '', '3', 0, '', '', '', '', ''),
(90, 90, 'ttttt', '', 0, 1, 52, '', '', '', '', '1', 0, '', '', '', '', ''),
(92, 91, 'tttt', '', 1, 0, 0, '', '', '', '', '1', 20, '', '', '', '', ''),
(93, 93, 'ccc', '', 1, 0, 0, '', '', '', '', '1', 23, '', '', '', '', ''),
(94, 94, 'oooo', '', 1, 0, 0, '', '', '', '', '1', 22, '', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `cm_list`
--

CREATE TABLE IF NOT EXISTS `cm_list` (
  `list_id` int(11) NOT NULL AUTO_INCREMENT,
  `list_name` varchar(255) NOT NULL COMMENT '联动菜单名称',
  `list_desc` text NOT NULL COMMENT '简述',
  PRIMARY KEY (`list_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `cm_list`
--

INSERT INTO `cm_list` (`list_id`, `list_name`, `list_desc`) VALUES
(1, 'category', '文章分类');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `cm_list_item`
--

INSERT INTO `cm_list_item` (`list_item_id`, `list_id`, `item_desc`, `item_parent`, `item_thumb`, `item_sort`) VALUES
(1, 1, '文章一级别分类', 0, '', 0),
(2, 1, '文章二级分类', 1, '', 0),
(3, 1, '文章3级分类', 2, '', 0),
(4, 1, '文章3级分类', 2, '', 0),
(5, 1, '文章12分类', 1, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `cm_table`
--

CREATE TABLE IF NOT EXISTS `cm_table` (
  `table_id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(256) NOT NULL COMMENT '表名称',
  `description` varchar(255) DEFAULT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `list_button` text NOT NULL COMMENT '列表按钮',
  `search_option` text NOT NULL COMMENT '搜索设置',
  PRIMARY KEY (`table_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- 转存表中的数据 `cm_table`
--

INSERT INTO `cm_table` (`table_id`, `table_name`, `description`, `pid`, `list_button`, `search_option`) VALUES
(11, 'website', '站点', 0, 'a:2:{i:0;a:2:{s:4:"href";s:20:"Website/Website_edit";s:4:"desc";s:6:"编辑";}i:1;a:2:{s:4:"href";s:19:"Website/Website_del";s:4:"desc";s:6:"删除";}}', ''),
(13, 'article', '内容', 15, 'a:2:{i:0;a:2:{s:4:"href";s:20:"Article/Article_edit";s:4:"desc";s:6:"编辑";}i:1;a:2:{s:4:"href";s:19:"Article/Article_del";s:4:"desc";s:6:"删除";}}', 'a:2:{i:0;a:2:{s:10:"tab_col_id";s:2:"82";s:5:"match";s:4:"like";}i:1;a:2:{s:10:"tab_col_id";s:2:"83";s:5:"match";s:4:"like";}}'),
(14, 'web_baseinfo', '站点基础信息', 0, 'a:2:{i:0;a:2:{s:4:"href";s:30:"Web_baseinfo/Web_baseinfo_edit";s:4:"desc";s:6:"编辑";}i:1;a:2:{s:4:"href";s:29:"Web_baseinfo/Web_baseinfo_del";s:4:"desc";s:6:"删除";}}', ''),
(15, 'category', '栏目', 0, 'a:3:{i:0;a:3:{s:11:"otherParams";a:0:{}s:4:"desc";s:6:"编辑";s:4:"href";s:22:"Category/Category_edit";}i:1;a:3:{s:11:"otherParams";a:0:{}s:4:"desc";s:6:"删除";s:4:"href";s:21:"Category/Category_del";}i:2;a:3:{s:11:"otherParams";a:0:{}s:4:"desc";s:12:"文章管理";s:4:"href";s:21:"Content/module2action";}}', ''),
(18, 'art_position', '推荐位', 0, 'a:2:{i:0;a:2:{s:4:"href";s:30:"Art_position/Art_position_edit";s:4:"desc";s:6:"编辑";}i:1;a:2:{s:4:"href";s:29:"Art_position/Art_position_del";s:4:"desc";s:6:"删除";}}', ''),
(20, 'product', '产品', 15, 'a:2:{i:0;a:2:{s:4:"href";s:20:"Product/Product_edit";s:4:"desc";s:6:"编辑";}i:1;a:2:{s:4:"href";s:19:"Product/Product_del";s:4:"desc";s:6:"删除";}}', ''),
(21, 'friend_links', '友情链接', 0, 'a:2:{i:0;a:2:{s:4:"href";s:30:"Friend_links/Friend_links_edit";s:4:"desc";s:6:"编辑";}i:1;a:2:{s:4:"href";s:29:"Friend_links/Friend_links_del";s:4:"desc";s:6:"删除";}}', ''),
(22, 'others', '其他', 15, 'a:2:{i:0;a:2:{s:4:"href";s:18:"Others/Others_edit";s:4:"desc";s:6:"编辑";}i:1;a:2:{s:4:"href";s:17:"Others/Others_del";s:4:"desc";s:6:"删除";}}', ''),
(23, 'catalog', '画册', 15, 'a:2:{i:0;a:2:{s:4:"href";s:20:"Catalog/Catalog_edit";s:4:"desc";s:6:"编辑";}i:1;a:2:{s:4:"href";s:19:"Catalog/Catalog_del";s:4:"desc";s:6:"删除";}}', ''),
(25, 'advertise', '广告', 0, 'a:2:{i:0;a:2:{s:4:"href";s:24:"Advertise/Advertise_edit";s:4:"desc";s:6:"编辑";}i:1;a:2:{s:4:"href";s:23:"Advertise/Advertise_del";s:4:"desc";s:6:"删除";}}', '');

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
  `is_search` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否搜索字段',
  `column_default_value` text NOT NULL,
  `column_desc` varchar(255) NOT NULL DEFAULT '',
  `column_help` varchar(255) NOT NULL,
  `column_error_message` varchar(255) NOT NULL,
  `column_attrs` text NOT NULL COMMENT '表单配置属性',
  `list_attr` varchar(500) NOT NULL DEFAULT '',
  `cm_table_column_sort` int(11) NOT NULL COMMENT '字段显示排序',
  `is_validate` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0为不需要，1为需要',
  `min_length` int(11) NOT NULL DEFAULT '0' COMMENT '最小长度',
  `max_length` int(11) NOT NULL DEFAULT '999999' COMMENT '最大长度',
  `validate_regexp` varchar(255) NOT NULL COMMENT '验证所用正则',
  `is_excel_in` int(11) NOT NULL DEFAULT '0' COMMENT '是否为Excel导入，0为否',
  `is_excel_empty_in` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否允许Excel空导入，默认为0：否',
  `is_excel_match` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否为Excel导出，0为否',
  `is_excel_out` int(11) NOT NULL DEFAULT '0' COMMENT '是否为Excel导出，0为否',
  `excel_match_method` varchar(50) NOT NULL COMMENT 'excel匹配方式',
  `excel_in_map` text NOT NULL COMMENT '映射关系',
  `excel_in_sort` tinyint(4) NOT NULL DEFAULT '10' COMMENT 'excel导入字段顺序',
  `excel_match_logic` varchar(50) NOT NULL COMMENT '匹配逻辑',
  `excel_out_map` text NOT NULL COMMENT '导出映射关系',
  `excel_out_sort` tinyint(4) NOT NULL DEFAULT '10' COMMENT '导出顺序',
  PRIMARY KEY (`tab_col_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=193 ;

--
-- 转存表中的数据 `cm_table_column`
--

INSERT INTO `cm_table_column` (`tab_col_id`, `table_id`, `column_name`, `column_type`, `is_add`, `is_edit`, `is_list`, `is_search`, `column_default_value`, `column_desc`, `column_help`, `column_error_message`, `column_attrs`, `list_attr`, `cm_table_column_sort`, `is_validate`, `min_length`, `max_length`, `validate_regexp`, `is_excel_in`, `is_excel_empty_in`, `is_excel_match`, `is_excel_out`, `excel_match_method`, `excel_in_map`, `excel_in_sort`, `excel_match_logic`, `excel_out_map`, `excel_out_sort`) VALUES
(65, 11, 'website_id', 'primaryKey', 1, 1, 1, 0, '', '主键（自增）', '', '', '', '', 0, 0, 0, 999999, '', 0, 0, 0, 0, '', '', 10, '', '', 10),
(66, 11, 'webname', 'singleErea', 1, 1, 1, 0, '', '站点名称', '站点名称', '', '', '', 66, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(67, 11, 'weburl', 'singleErea', 1, 1, 1, 0, '', '站点模板目录', '站点目录', '', '', '', 102, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(69, 13, 'article_id', 'primaryKey', 0, 1, 1, 0, '', '主键（自增）', '', '', '', '', 0, 0, 0, 999999, '', 0, 0, 0, 0, '', '', 10, '', '', 10),
(70, 14, 'web_baseinfo_id', 'primaryKey', 1, 1, 1, 0, '', '主键（自增）', '', '', '', '', 0, 0, 0, 999999, '', 0, 0, 0, 0, '', '', 10, '', '', 10),
(72, 14, 'info_key', 'singleErea', 1, 1, 1, 0, '', '信息键', '信息键', '', '', '', 72, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(73, 14, 'info_val', 'singleErea', 1, 1, 1, 0, '', '信息值', '信息值', '', '', '', 73, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(75, 15, 'category_id', 'primaryKey', 1, 1, 1, 0, '', '主键（自增）', '', '', '', '', 0, 0, 0, 999999, '', 0, 0, 0, 0, '', '', 10, '', '', 10),
(76, 15, 'cat_name', 'singleErea', 1, 1, 1, 0, '', '栏目名称', '栏目名称', '', '', '', 76, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(78, 15, 'thumb', 'singlePic', 1, 1, 1, 0, '', '缩略图', '缩略图', '', '', '', 81, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(79, 15, 'is_show', 'radio', 1, 1, 1, 0, '', '显示', '显示', '', 'a:2:{s:4:"type";i:1;s:5:"lists";a:2:{i:0;a:2:{s:5:"value";s:1:"0";s:4:"desc";s:3:"是";}i:1;a:2:{s:5:"value";s:1:"1";s:4:"desc";s:3:"否";}}}', '', 147, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(80, 15, 'is_single', 'radio', 1, 1, 0, 0, '', '是否单页', '是否单页', '', 'a:2:{s:4:"type";i:1;s:5:"lists";a:2:{i:0;a:2:{s:5:"value";s:1:"0";s:4:"desc";s:3:"是";}i:1;a:2:{s:5:"value";s:1:"1";s:4:"desc";s:3:"否";}}}', '', 146, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(82, 13, 'title', 'singleErea', 1, 1, 1, 1, '', '标题', '标题', '', '', '', 83, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(83, 13, 'keywords', 'singleErea', 1, 1, 0, 1, '', '关键词', '关键词', '', '', '', 88, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(85, 13, 'thumb', 'singlePic', 1, 1, 1, 0, '', '缩略图', '(手机站-新闻，建议250X150)', '', '', '', 89, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(86, 13, 'content', 'edictor', 1, 1, 0, 0, '', '内容', '内容', '内容', '', '', 101, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(87, 13, 'catalog', 'multiPic', 1, 1, 0, 0, '', '画册', '画册', '', 'a:1:{s:9:"pic_attrs";a:5:{i:0;a:4:{s:3:"key";s:4:"name";s:4:"desc";s:12:"图片名称";s:9:"attr_type";s:1:"1";s:4:"sort";s:1:"0";}i:1;a:4:{s:3:"key";s:3:"alt";s:4:"desc";s:9:"图片ALT";s:9:"attr_type";s:1:"1";s:4:"sort";s:1:"1";}i:2;a:4:{s:3:"key";s:4:"sort";s:4:"desc";s:12:"图片排序";s:9:"attr_type";s:1:"1";s:4:"sort";s:1:"2";}i:3;a:4:{s:3:"key";s:4:"href";s:4:"desc";s:12:"图片链接";s:9:"attr_type";s:1:"1";s:4:"sort";s:1:"3";}i:4;a:4:{s:3:"key";s:7:"content";s:4:"desc";s:12:"图片描述";s:9:"attr_type";s:1:"3";s:4:"sort";s:1:"4";}}}', '', 96, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(88, 13, 'description', 'multiErea', 1, 1, 0, 0, '', '描述', '描述', '', '', '', 97, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(89, 13, 'datetime', 'hidden_date', 1, 1, 0, 0, '', '时间', '时间', '', '1', '', 114, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(93, 18, 'art_position_id', 'primaryKey', 1, 1, 1, 0, '', '主键（自增）', '', '', '', '', 0, 0, 0, 999999, '', 0, 0, 0, 0, '', '', 10, '', '', 10),
(94, 18, 'pos_name', 'singleErea', 1, 1, 1, 0, '', '推荐位置', '推荐位置', '', '', '', 94, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(96, 13, 'positions', 'checkedbox', 1, 1, 0, 0, '', '推荐位', '推荐位', '', 'a:5:{s:4:"type";s:1:"0";s:9:"value_key";s:15:"art_position_id";s:10:"value_desc";s:8:"pos_name";s:8:"data_sql";s:30:"SELECT *  FROM  `art_position`";s:5:"lists";a:1:{i:0;a:2:{s:5:"value";s:0:"";s:4:"desc";s:0:"";}}}', '', 172, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(97, 13, 'siteid', 'session', 1, 1, 0, 0, '', '所属站点', '所属站点', '', '', '', 113, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(98, 18, 'siteid', 'session', 1, 1, 0, 0, '', '所属站点', '所属站点', '', '', '', 98, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(99, 15, 'siteid', 'session', 1, 1, 0, 0, '', '所属站点', '所属站点', '', '', '', 148, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(100, 14, 'siteid', 'session', 1, 1, 0, 0, '', '所属站点', '所属站点', '', '', '', 100, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(101, 13, 'cat_id', 'foreignKey', 1, 1, 0, 0, '', '所属分类', '所属分类', '', 'a:2:{s:10:"table_name";s:8:"category";s:11:"column_name";s:11:"category_id";}', '', 168, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(102, 11, 'siteUrl', 'singleErea', 1, 1, 0, 0, '', '站点地址', '站点地址', '', '', '', 67, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(104, 13, 'hits', 'special', 0, 1, 0, 0, '', '点击量', '点击量', '', '', '', 105, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(105, 13, 'favor', 'special', 0, 0, 0, 0, '', '点赞量', '点赞量', '', '', '', 104, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(115, 20, 'product_id', 'primaryKey', 0, 0, 1, 0, '', '主键（自增）', '', '', '', '', 0, 0, 0, 999999, '', 0, 0, 0, 0, '', '', 10, '', '', 10),
(116, 21, 'friend_links_id', 'primaryKey', 0, 0, 1, 0, '', '主键（自增）', '', '', '', '', 0, 0, 0, 999999, '', 0, 0, 0, 0, '', '', 10, '', '', 10),
(117, 22, 'others_id', 'primaryKey', 1, 1, 1, 0, '', '主键（自增）', '', '', '', '', 0, 0, 0, 999999, '', 0, 0, 0, 0, '', '', 10, '', '', 10),
(118, 23, 'catalog_id', 'primaryKey', 0, 0, 1, 0, '', '主键（自增）', '', '', '', '', 0, 0, 0, 999999, '', 0, 0, 0, 0, '', '', 10, '', '', 10),
(120, 15, 'module_id', 'select', 1, 1, 0, 0, '', '所属模型', '所属模型', '', 'a:6:{s:4:"type";s:1:"0";s:9:"value_key";s:8:"table_id";s:10:"value_desc";s:10:"table_name";s:8:"data_sql";s:26:"SELECT *  FROM  `cm_table`";s:7:"list_id";s:1:"0";s:5:"lists";a:1:{i:0;a:2:{s:5:"value";s:0:"";s:4:"desc";s:0:"";}}}', '', 167, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(121, 20, 'title', 'singleErea', 1, 1, 1, 0, '', '标题', '标题', '标题必填(2到30字)', '', '', 122, 1, 4, 60, 'notempty', 0, 0, 0, 0, '', '', 10, '', '', 10),
(122, 20, 'thumb', 'singlePic', 1, 1, 1, 0, '', '缩略图', '缩略图', '', '', '', 123, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(123, 20, 'description', 'multiErea', 1, 1, 0, 0, '', '描述', '描述', '', '', '', 124, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(124, 20, 'content', 'edictor', 1, 1, 0, 0, '', '内容', '内容', '', '', '', 154, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(125, 20, 'siteid', 'session', 1, 1, 0, 0, '', '所属站点', '所属站点', '', '', '', 128, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(126, 20, 'hits', 'special', 0, 0, 0, 0, '', '点击量', '点击量', '', '', '', 126, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(127, 20, 'favor', 'special', 0, 0, 0, 0, '', '点赞量', 'favor', '', '', '', 127, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(128, 20, 'positions', 'checkedbox', 1, 1, 0, 0, '', '推荐位', '推荐位', '', 'a:5:{s:4:"type";s:1:"0";s:9:"value_key";s:15:"art_position_id";s:10:"value_desc";s:8:"pos_name";s:8:"data_sql";s:30:"SELECT *  FROM  `art_position`";s:5:"lists";a:1:{i:0;a:2:{s:5:"value";s:0:"";s:4:"desc";s:0:"";}}}', '', 172, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(129, 22, 'title', 'singleErea', 1, 1, 1, 0, '', '标题', '标题', '', '', '', 129, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(130, 22, 'thumb', 'singlePic', 1, 1, 1, 0, '', '缩略图', '缩略图', '', '', '', 130, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(131, 22, 'description', 'multiErea', 1, 1, 0, 0, '', '描述', '描述', '', '', '', 131, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(132, 22, 'content', 'edictor', 1, 1, 0, 0, '', '内容', '内容', '', '', '', 132, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(133, 22, 'siteid', 'session', 1, 1, 0, 0, '', '所属站点', '所属站点', '', '', '', 133, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(134, 22, 'hits', 'special', 1, 1, 0, 0, '', '点击量', '点击量', '', '', '', 134, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(135, 22, 'favor', 'special', 1, 1, 0, 0, '', '点赞量', '点赞量', '', '', '', 135, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(136, 22, 'positions', 'checkedbox', 1, 1, 0, 0, '', '推荐位置', '推荐位置', '', 'a:5:{s:4:"type";s:1:"0";s:9:"value_key";s:15:"art_position_id";s:10:"value_desc";s:8:"pos_name";s:8:"data_sql";s:30:"SELECT *  FROM  `art_position`";s:5:"lists";a:1:{i:0;a:2:{s:5:"value";s:0:"";s:4:"desc";s:0:"";}}}', '', 172, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(137, 23, 'title', 'singleErea', 1, 1, 1, 0, '', '标题', '标题', '', '', '', 137, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(138, 23, 'thumb', 'singlePic', 1, 1, 1, 0, '', '缩略图', '缩略图', '', '', '', 138, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(139, 23, 'description', 'multiErea', 1, 1, 0, 0, '', '描述', '描述', '', '', '', 139, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(140, 23, 'content', 'edictor', 1, 1, 0, 0, '', '内容', '内容', '', '', '', 140, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(141, 23, 'siteid', 'session', 1, 1, 0, 0, '', '所属站点', '所属站点', '', '', '', 141, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(142, 23, 'hits', 'special', 0, 0, 0, 0, '', '点击量', '点击量', '', '', '', 142, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(144, 23, 'positions', 'checkedbox', 1, 1, 0, 0, '', '推荐位置', '推荐位置', '', 'a:5:{s:4:"type";s:1:"0";s:9:"value_key";s:15:"art_position_id";s:10:"value_desc";s:8:"pos_name";s:8:"data_sql";s:30:"SELECT *  FROM  `art_position`";s:5:"lists";a:1:{i:0;a:2:{s:5:"value";s:0:"";s:4:"desc";s:0:"";}}}', '', 172, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(145, 23, 'favor', 'special', 0, 0, 0, 0, '', '点赞量', '点赞量', '', '', '', 145, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(146, 15, 'title', 'singleErea', 1, 1, 0, 0, '', 'title', 'title', '', '', '', 80, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(147, 15, 'keywords', 'singleErea', 1, 1, 0, 0, '', 'Keywords', 'Keywords', '', '', '', 99, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(148, 15, 'description', 'multiErea', 1, 1, 0, 0, '', 'Description', 'Description', '', '', '', 120, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(149, 23, 'cat_id', 'foreignKey', 1, 1, 0, 0, '', '所属分类', '所属分类', '', 'a:2:{s:10:"table_name";s:8:"category";s:11:"column_name";s:11:"category_id";}', '', 149, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(150, 22, 'cat_id', 'foreignKey', 1, 1, 0, 0, '', '所属分类', '所属分类', '', 'a:2:{s:10:"table_name";s:8:"category";s:11:"column_name";s:11:"category_id";}', '', 150, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(151, 20, 'cat_id', 'foreignKey', 1, 1, 0, 0, '', '所属分类', '所属分类', '', 'a:2:{s:10:"table_name";s:8:"category";s:11:"column_name";s:11:"category_id";}', '', 151, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(157, 25, 'advertise_id', 'primaryKey', 0, 0, 1, 0, '', '主键（自增）', '', '', '', '', 0, 0, 0, 999999, '', 0, 0, 0, 0, '', '', 10, '', '', 10),
(159, 25, 'siteid', 'session', 1, 1, 0, 0, '', '所属站点', '所属站点', '', '', '', 159, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(160, 25, 'title', 'singleErea', 1, 1, 1, 0, '', '广告位名称', '广告位名称', '', '', '', 160, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(162, 25, 'thumb', 'singlePic', 1, 1, 0, 0, '', '广告位缩略图', '广告位缩略图', '', '', '', 163, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(163, 25, 'pics', 'multiPic', 1, 1, 0, 0, '', '广告列表', '广告列表', '', 'a:1:{s:9:"pic_attrs";a:5:{i:0;a:4:{s:3:"key";s:4:"name";s:4:"desc";s:12:"图片名称";s:9:"attr_type";s:1:"1";s:4:"sort";s:1:"0";}i:1;a:4:{s:3:"key";s:3:"alt";s:4:"desc";s:9:"图片ALT";s:9:"attr_type";s:1:"1";s:4:"sort";s:1:"1";}i:2;a:4:{s:3:"key";s:4:"sort";s:4:"desc";s:12:"图片排序";s:9:"attr_type";s:1:"1";s:4:"sort";s:1:"2";}i:3;a:4:{s:3:"key";s:4:"href";s:4:"desc";s:12:"图片链接";s:9:"attr_type";s:1:"1";s:4:"sort";s:1:"3";}i:4;a:4:{s:3:"key";s:7:"content";s:4:"desc";s:12:"图片描述";s:9:"attr_type";s:1:"3";s:4:"sort";s:1:"4";}}}', '', 164, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(164, 25, 'description', 'multiErea', 1, 1, 0, 0, '', '广告位置描述', '广告位置描述', '', '', '', 162, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(166, 15, 'sort', 'singleErea', 1, 1, 0, 0, '', '排序', '排序', '', '', '', 166, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(167, 15, 'eng_name', 'singleErea', 1, 1, 0, 0, '', '英文名称', '英文名称', '', '', '', 79, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(168, 13, 'eng_title', 'singleErea', 1, 1, 0, 0, '', '英文名称', '英文名称', '', '', '', 87, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(186, 21, 'thumb', 'singlePic', 1, 1, 1, 0, '', '缩略图', '缩略图', '', '', '', 185, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(187, 21, 'url', 'singleErea', 1, 1, 1, 0, '', '链接地址', '链接地址', '', '', '', 186, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(185, 21, 'name', 'singleErea', 1, 1, 1, 0, '', '名称', '名称', '', '', '', 172, 1, 0, 999999, 'notempty', 0, 0, 0, 0, '', '', 10, '', '', 10),
(174, 15, 'category_sort', 'singleErea', 1, 1, 0, 0, '', '排序', '排序', '', '', '', 172, 0, 0, 999999, '', 0, 0, 0, 0, '', '', 10, '', '', 10),
(175, 13, 'article_sort', 'singleErea', 1, 1, 1, 0, '', '排序', '排序', '', '', '', 112, 0, 0, 999999, '', 0, 0, 0, 0, '', '', 10, '', '', 10),
(176, 20, 'product_sort', 'singleErea', 1, 1, 1, 0, '', '排序', '排序', '', '', '', 155, 0, 0, 999999, '', 0, 0, 0, 0, '', '', 10, '', '', 10),
(177, 23, 'catalog_sort', 'singleErea', 1, 1, 1, 0, '', '排序', '排序', '', '', '', 144, 0, 0, 999999, '', 0, 0, 0, 0, '', '', 10, '', '', 10),
(178, 22, 'others_sort', 'singleErea', 1, 1, 1, 0, '', '排序', '排序', '', '', '', 136, 0, 0, 999999, '', 0, 0, 0, 0, '', '', 10, '', '', 10),
(179, 20, 'hits_ips', 'special', 0, 0, 0, 0, '', '记录点击过的IP', '记录点击过的IP', '', '', '', 179, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(180, 20, 'favor_ips', 'special', 0, 0, 0, 0, '', '点赞IP记录', '点赞IP记录', '', '', '', 180, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(181, 23, 'hits_ips', 'special', 0, 0, 0, 0, '', '点击量IP', '点击量IP', '', '', '', 181, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(182, 23, 'favor_ips', 'special', 0, 0, 0, 0, '', '点赞IP记录', '点赞IP记录', '', '', '', 182, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(183, 22, 'hits_ips', 'special', 0, 0, 0, 0, '', '点击量IP', '点击量IP', '', '', '', 183, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(184, 22, 'favor_ips', 'special', 0, 0, 0, 0, '', '点赞IP', '点赞IP', '', '', '', 184, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(188, 21, 'description', 'multiErea', 1, 1, 0, 0, '', '备注', '', '', '', '', 187, 0, 0, 999999, '0', 0, 0, 0, 0, '', '', 10, '', '', 10),
(189, 21, 'friend_links_sort', 'singleErea', 1, 1, 0, 0, '', '排序', '排序', '', '', '', 188, 0, 0, 999999, '', 0, 0, 0, 0, '', '', 10, '', '', 10),
(190, 25, 'advertise_sort', 'singleErea', 1, 1, 1, 0, '', '排序', '排序', '', '', '', 172, 0, 0, 999999, '', 0, 0, 0, 0, '', '', 10, '', '', 10),
(191, 14, 'web_baseinfo_sort', 'singleErea', 1, 1, 0, 0, '', '排序', '排序', '', '', '', 172, 0, 0, 999999, '', 0, 0, 0, 0, '', '', 10, '', '', 10),
(192, 11, 'website_sort', 'singleErea', 1, 1, 0, 0, '', '排序', '排序', '', '', '', 172, 0, 0, 999999, '', 0, 0, 0, 0, '', '', 10, '', '', 10);

-- --------------------------------------------------------

--
-- 表的结构 `friend_links`
--

CREATE TABLE IF NOT EXISTS `friend_links` (
  `friend_links_id` int(11) NOT NULL AUTO_INCREMENT,
  `friend_links_sort` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  PRIMARY KEY (`friend_links_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `friend_links`
--


-- --------------------------------------------------------

--
-- 表的结构 `others`
--

CREATE TABLE IF NOT EXISTS `others` (
  `others_id` int(11) NOT NULL AUTO_INCREMENT,
  `others_sort` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `content` text NOT NULL,
  `siteid` varchar(255) NOT NULL DEFAULT '',
  `hits` int(11) NOT NULL DEFAULT '0',
  `favor` int(11) NOT NULL DEFAULT '0',
  `positions` varchar(500) NOT NULL DEFAULT '',
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `hits_ips` text NOT NULL,
  `favor_ips` text NOT NULL,
  PRIMARY KEY (`others_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `others`
--

INSERT INTO `others` (`others_id`, `others_sort`, `title`, `thumb`, `description`, `content`, `siteid`, `hits`, `favor`, `positions`, `cat_id`, `hits_ips`, `favor_ips`) VALUES
(1, 1, '2333', '', '', '', '1', 0, 0, '', 94, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_sort` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `content` text NOT NULL,
  `siteid` varchar(255) NOT NULL DEFAULT '',
  `hits` int(11) NOT NULL DEFAULT '0',
  `favor` int(11) NOT NULL DEFAULT '0',
  `positions` varchar(500) NOT NULL DEFAULT '',
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `hits_ips` text NOT NULL,
  `favor_ips` text NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `product`
--

INSERT INTO `product` (`product_id`, `product_sort`, `title`, `thumb`, `description`, `content`, `siteid`, `hits`, `favor`, `positions`, `cat_id`, `hits_ips`, `favor_ips`) VALUES
(1, 1, '1111111', '', '', '', '1', 0, 0, '', 92, '', ''),
(2, 2, '5555555', '', '', '', '1', 0, 0, '', 92, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `website`
--

CREATE TABLE IF NOT EXISTS `website` (
  `website_id` int(11) NOT NULL AUTO_INCREMENT,
  `website_sort` int(11) NOT NULL DEFAULT '0',
  `webname` varchar(255) NOT NULL DEFAULT '',
  `weburl` varchar(255) NOT NULL DEFAULT '',
  `siteUrl` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`website_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `website`
--

INSERT INTO `website` (`website_id`, `website_sort`, `webname`, `weburl`, `siteUrl`) VALUES
(1, 1431670216, '中文站点', 'default', 'http://jz.izhanyun.com/'),
(2, 1432178718, '手机站', 'mobile', 'http://jz.izhanyun.com/index.php/Content/index/siteid/2'),
(3, 1432015785, 'PC英文站', 'english', 'http://jz.izhanyun.com/index.php/Content/index/siteid/3');

-- --------------------------------------------------------

--
-- 表的结构 `web_baseinfo`
--

CREATE TABLE IF NOT EXISTS `web_baseinfo` (
  `web_baseinfo_id` int(11) NOT NULL AUTO_INCREMENT,
  `web_baseinfo_sort` int(11) NOT NULL DEFAULT '0',
  `info_key` varchar(255) NOT NULL DEFAULT '',
  `info_val` varchar(255) NOT NULL DEFAULT '',
  `siteid` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`web_baseinfo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `web_baseinfo`
--

INSERT INTO `web_baseinfo` (`web_baseinfo_id`, `web_baseinfo_sort`, `info_key`, `info_val`, `siteid`) VALUES
(1, 1431999484, 'title', '小富建装工程', '1'),
(2, 1431999511, 'description', '小富建装工程', '1'),
(3, 1431999505, 'keywords', '小富建装工程', '1');

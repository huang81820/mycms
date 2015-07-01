<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<title><?php echo ($seo_title); ?></title>
<meta name="keywords" content="<?php echo ($seo_keywords); ?>" />
<meta name="description" content="<?php echo ($seo_description); ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="__PUBLIC__/statics/mobile/css/styles.css" rel="stylesheet">
<script  src="__PUBLIC__/statics/mobile/js/jquery.js" type="text/javascript" ></script>
<script src="__PUBLIC__/statics/mobile/js/swipe.js"></script>

<script>
$(document).ready(function(){
	$('#nav_btn').click(function(){
		
		$('#site_nav').slideToggle();return false;
	});
	
	$('#site_nav_top').click(function(){
		$('#site_nav').slideUp();
	});
	
	
	$('#play li').each(function(){
		$('.ban-position').append('<canvas height="20" width="20"></canvas>');
	});
	$('.ban-position canvas').eq(0).attr('class','canvas-on');
	$("#play_wrap").Swipe({
			auto: 4000,
 			continuous: true,
			disableScroll:false,
			callback: function(index, elem) {
				$(".ban-position canvas").eq(index).addClass("canvas-on").siblings("canvas").removeClass("canvas-on");
				}
	});
	
});
</script>
</head>

<body>

<div id="wrap">
	<div id="site_nav">
		<img id="site_nav_top" src="__PUBLIC__/statics/mobile/images/site_nav_top.png" />
		<ul id="site_nav_list">
				<li><a href="<?php echo ($siteUrl); ?>">首页</a></li>
			<?php $cate = get_category(0,1); ?>
			<?php foreach($cate as $value){ ?>
				<li><a href="<?php echo (CAT_PATH); ?>/<?php echo ($value[category_id]); ?>"><?php echo ($value['cat_name']); ?></a></li>
			<?php } ?>
		</ul>
	</div>
	
	<div id="top">
		<a href="<?php echo ($siteUrl); ?>"><img id="logo" src="__PUBLIC__/statics/mobile/images/logo.png" /></a>
		
		<a id="nav_btn" href="#"></a>
		
	</div>
	<div class="position">
		<div class='position_con'>
			<?php echo ($site_nav); ?>
		</div>
	</div>
	
	<div class="width96 martop20 nor_con"  >
		<p id="news_tit"><?php echo ($show_title); ?></p>
		<p id="news_time"><?php echo date('Y-m-d',$show_datetime); ?></p>
		<div class="nor_con martop20">
			<?php echo ($show_content); ?>
		</div>
	</div>
	
	<div class='fixed_height400'></div>
	
	
<div id="footer">
		<img id="bottom_logo" src="__PUBLIC__/statics/mobile/images/bottom_logo.png" />
		<div id="footer_con">
			<p id="footer_con1">联系方式</p>
			<p class="footer_con_nor">咨询电话：（020）28053916/28053918</p>
			<p class="footer_con_nor">邮编：510660    财富热线：4006-922-338</p>
			<p class="footer_con_nor">地址:广州市天河区黄村路51号粤安工业园B栋</p>
			<p class="footer_con_nor">友情链接： www.xiaofu168.com</p>
		</div>
	</div>
	  
	


</div>

</body>
</html>
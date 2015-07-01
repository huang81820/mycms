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
	
	
	$('.upscroll').click(function(e){
		$('html,body').animate({'scrollTop':0},400);
		e.preventDefault();
	});
	
});
</script>
</head>

<body>

	<div class="wrap">

		<div class="top100">
			<div class="top_center">
				<a href="__APP__/Content/index">
					<img class="top_img1" src="__PUBLIC__/statics/default/images/logo.png" style="margin-left:20px;"/>
					<img class="top_img2" src="__PUBLIC__/statics/default/images/ming.png"/>
				</a>
				
				<div class="search_weop">
					<div class="top_zi">
						<div class="zi_weap">
						<!--
							<span class="shou_zi">设为首页</span>
							<span class="shou_zi">收藏</span>
						-->
						</div>
						<div class="sea_input_weap">
                            <form action="__APP__/Content/search/module_id/20" method="POST" >
                                <input type="text" class="sea_input" name="search_key"/>
                                <input type="submit" class="sub_input" value=""/>
                            </form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--结束头部-->
<style>
.cat_uol_li{ width:200px;}
</style>

<div class="m_lkuai" style="margin:0 auto">
	<div class="m_lkuai_l">
		<a href="__APP__/Content/lists/cat_id/102">
			<img src='__PUBLIC__/statics/default/images/pro2.png'/>
		</a>
	</div>
	<div class="m_lkuai_r">
		<a href="#">
			<img src='__PUBLIC__/statics/default/images/pro3.png'/>
		</a>
	</div>
</div>

<div class="md10"></div>

<ul class="cat_uol">
	<li class="cat_uol_li">
		<a class="cat_asdf <?php if(cat_id()==105){ echo 'cat_asdf_active'; }?>" href="__APP__/Content/lists/cat_id/105">美派简介</a>
	</li>
	<li class="cat_uol_li">
		<a class="cat_asdf <?php if(cat_id()==106){ echo 'cat_asdf_active'; }?>" href="__APP__/Content/lists/cat_id/106">品牌背景</a>
	</li>
	<li class="cat_uol_li">
		<a class="cat_asdf <?php if(cat_id()==108){ echo 'cat_asdf_active'; }?>" href="__APP__/Content/lists/cat_id/108">合作伙伴</a>
	</li>
	<li class="cat_uol_li">
		<a class="cat_asdf <?php if(cat_id()==107){ echo 'cat_asdf_active'; }?>" href="__APP__/Content/lists/cat_id/107">美派新闻</a>
	</li>
</ul>

<div class="md20"></div>

<div class="pro_ge_f"></div>
<div class="md20"></div>

<?php $arts = cat2article(cat_id(),$is_all=1,$num=20,$order='no'); ?>
<ul class="new_ulsd">
	<?php foreach($arts['lists'] as $art){ ?>
	<li>
		<a href="<?php echo (CON_PATH); ?>/<?php echo ($art[article_id]); ?>/cat_id/<?php echo ($art[cat_id]); ?>">
			<img src='<?php echo ($art["thumb"]); ?>' />
			<div class="new_title_list">
				<div class="md30"></div>
				<div class="md30"></div>
				<p class="newa_title_head"><?php echo ($art["title"]); ?></p>
				<p class="newa_title_time"><?php echo (date("Y-m-d H:i",$art["datetime"])); ?></p>
			</div>
		</a>
	</li>
	<?php } ?>
	
	
	
</ul>

<div class="md50"></div>
<div class="md50"></div>














		<!--开始脚部-->
		<div class="clear"></div>
		
		
		<div class="md10"></div>
		
		<p class="cor_foorer">COPYRIGHT  ©2015 MEIPMG.COM</p>
		
		<div class="md10"></div>
		
	</div>

</body>
</html>
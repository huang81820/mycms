<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
<title><?php echo ($seo_title); ?></title>
<meta name="keywords" content="<?php echo ($seo_keywords); ?>" />
<meta name="description" content="<?php echo ($seo_description); ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link  href="__PUBLIC__/statics/default/css/index.css" rel="stylesheet" type="text/css" />
<script src="__PUBLIC__/statics/default/js/jquery.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
	var height = $(window).height();
	var height2 = $(document).height();
	//$('#main').css({'height':height2-130});
	
	(function(){
		$('#main_left').mouseover(function(){
			$(this).css({'background':'url(__PUBLIC__/statics/default/images/main_left_bg2.png) no-repeat left top'});
		}).mouseout(function(){
			$(this).css({'background':'url(__PUBLIC__/statics/default/images/main_left_bg.png) no-repeat left top'});
		});
		
		$('#main_right').mouseover(function(){
			$(this).css({'background':'url(__PUBLIC__/statics/default/images/main_right_bg2.png) no-repeat right top'});
		}).mouseout(function(){
			$(this).css({'background':'url(__PUBLIC__/statics/default/images/main_right_bg.png) no-repeat right top'});
		});
		
	})();
	
	(function(){
		$('#nav li').mouseover(function(){
			$(this).find('.sub_nav').stop(true,false).slideDown();
			$(this).find('.nav_a,.nav_p').css({'color':'#f5a925'});
		}).mouseout(function(){
			$(this).find('.sub_nav').stop(true,true).slideUp();
			$(this).find('.nav_a,.nav_p').css({'color':'white'});
		});;
	})();
	
	(function(){
		$('#side_nav2 li').mouseover(function(){
			$(this).css({'border-bottom':'1px solid #ffa200'});
			$(this).find('a').css({'background':'url(__PUBLIC__/statics/default/images/side_nav_bg.jpg) no-repeat left 8px','color':'#ffa200'});
		}).mouseout(function(){
			$(this).css({'border-bottom':'1px solid white'});
			$(this).find('a').css({'background':'none','color':'white'});
		});
		
		var cat_id = $('#side_nav2').attr('cat_id');
		
		$('#side_nav2 li').each(function(){
			var cat_id_i = $(this).attr('cat_id');
			if(cat_id==cat_id_i){
				$(this).css({'border-bottom':'1px solid #ffa200'});
				$(this).find('a').css({'background':'url(__PUBLIC__/statics/default/images/side_nav_bg.jpg) no-repeat left 8px','color':'#ffa200'});
			}
		});
		//$('#side_nav2 li').eq(0).css({'border-bottom':'1px solid #ffa200'});
		//$('#side_nav2 li').eq(0).find('a').css({'background':'url(__PUBLIC__/statics/default/images/side_nav_bg.jpg) no-repeat left 8px','color':'#ffa200'});
	})();
});
</script>
</head>

<body>

<div id="wrap">

	<div id="top">
		<div id="top_con">
			<a id="logo" href="<?php echo ($siteUrl); ?>"><img src="__PUBLIC__/statics/default/images/logo.png" /></a>
			<ul id="nav">
				<li>
					<a class="nav_a" href="<?php echo ($siteUrl); ?>">首页</a>
					<p class="nav_p">HOME</p>
					
				</li>
				<?php $cate = get_category(); ?>
				<?php foreach($cate as $value){ ?>
				<li>
					<a class="nav_a" href="<?php echo (CAT_PATH); ?>/<?php echo ($value[category_id]); ?>"><?php echo ($value['cat_name']); ?></a>
					<p class="nav_p" ><?php echo ($value['eng_name']); ?></p>
					<div class="sub_nav">
					<?php $sub_cat = get_category($value['category_id']) ?>
					<?php foreach($sub_cat as $sub_catRow){ ?>
						<a href="<?php echo (CAT_PATH); ?>/<?php echo ($sub_catRow[category_id]); ?>"><?php echo ($sub_catRow['cat_name']); ?></a>
					<?php } ?>
					</div>
				</li>
				<?php } ?>
				
				
			</ul>
		</div>
	</div>
	<div id="main">
		
		<div id="main_con">
			<div id="main_left">
				<p class="appli_tit_desc0">装修案例</p>
				<p class="appli_tit_desc0_eng">Decoration Case</p>
				<a href="<?php echo (CAT_PATH); ?>/58"><img id="appli_left_pic" src="__PUBLIC__/statics/default/images/appli_left.png" /></a>
				<p class="appli_tit_desc1">经典演绎	浪漫体现</p>
				<p class="appli_tit_desc2">Classical Interpretation of Romantic expression</p>
				<div class="more">
					<a class="more_desc" href="<?php echo (CAT_PATH); ?>/58">了解详情</a>
					<a class="more_btn" href="#"></a>
				</div>
			</div>
			<div id="main_right">
				<p class="appli_tit_desc0">工程案例</p>
				<p class="appli_tit_desc0_eng">Engineering case</p>
				<a href="<?php echo (CAT_PATH); ?>/57"><img id="appli_left_right" src="__PUBLIC__/statics/default/images/right_appli.png" /></a>
				<p class="appli_tit_desc1" style="text-align:right;" >只做吊顶	专业取胜</p>
				<p class="appli_tit_desc2" style="text-align:right" >Only do the ceiling professional win</p>
				<div class="more2">
					<a class="more_desc2" href="<?php echo (CAT_PATH); ?>/57">了解详情</a>
					<a class="more_btn2" href="#"></a>
				</div>
			</div>
		</div>
		
		
	<div id="footer_b" style="position:absolute;bottom:0">
				<p>粤ICP备14012495号-1 | 版权所有 2001-2014 @广东小富建装有限公司 技术支持：爱皮皮科技有限公司</p>
	</div>
	
	</div>
</div>
                           

</body>

</html>
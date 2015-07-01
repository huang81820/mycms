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
	
	<div id="main_contact">
		<div id="main_contact_con">
			<img src="<?php echo ($list_thumb); ?>" />
			<div id="contact_con_left">
				<div id="side_nav_wrap">
					<div id="side_nav_con">
						<img id="about_tit" src="__PUBLIC__/statics/default/images/about_tit.png" />
						<ul id="side_nav2" cat_id="<?php echo cat_id(); ?>" >
							<?php $subcat = sub_cat(top_parent(cat_id())) ?>
							<?php foreach($subcat as $subcatRow){ ?>
							<li cat_id="<?php echo ($subcatRow[category_id]); ?>"><a href="<?php echo (CAT_PATH); ?>/<?php echo ($subcatRow[category_id]); ?>"><?php echo ($subcatRow['cat_name']); ?></a></li>
							<?php } ?>	
						</ul>
						<div class="clear"></div>
					</div>
					<div id="side_nav_bo_bg"></div>
				</div>
			</div>
			<div id="contact_con_right">
				<div id="contact_con_right_mid">
					<div id="contact_tit">
						<span id="contact_tit_desc"><?php echo ($list_cat_name); ?></span>
						<span id="contact_tit_btn"></span>
					</div>
					<div id="contact_con_con">
						<?php $art = cat2article(cat_id(),$is_all=1,$num=1) ?>
						<?php echo ($art['lists'][0]['content']); ?>
					</div>
				</div>
				<div id="contact_con_right_bo"></div>
			</div>
		</div>
		



		
		
	</div>
	<div id="footer">
			
			<div id="footer_top">
				<div id="footer_top_con">
					<img id="footer_logo" src="__PUBLIC__/statics/default/images/footer_logo.png" />
					
					<div id="footer_contact">
						<p id="footer_contact_tit">联系方式</p>
						<p class="footer_contact_desc">咨询电话：（020）28053916/28053918  传真：（020）28053928</p>
						<p class="footer_contact_desc">邮编：510660    财富热线：4006-922-338</p>
						<p class="footer_contact_desc">地址:广州市天河区黄村路51号粤安工业园B栋</p>
						<p class="footer_contact_desc">友情链接： www.xiaofu168.com</p>
						
					</div>
				</div>
			</div>
			
			<div id="footer_b">
				<p>粤ICP备14012495号-1 | 版权所有 2001-2014 @广东小富建装有限公司 技术支持：爱皮皮科技有限公司</p>
			</div>
	</div>
</div>
                           

</body>

</html>
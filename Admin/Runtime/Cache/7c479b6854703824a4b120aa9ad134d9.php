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
<script>
$(document).ready(function(){
	$('.cat_uol li a').click(function(){
	
		var index = $(this).parent().index();
		$('.cat_uol li a').removeClass('cat_asdf_active');
		
		$('.pro_ul').hide();
		$('.pro_ul').eq(index).show();
		$(this).addClass('cat_asdf_active');
		return false;
	}).eq(0).trigger('click');
	
	
	
	
	

	
});
</script>	
		
		<div class="play_center">
			<div id="play_wrap">
				<ul id="play">
					<?php $ad = getByModules(25,'advertise_id=1',1); ?>				
					<?php $picArr = unserialize($ad[0]['pics']); ?>
					
					
					<?php foreach($picArr as $pic){?>
						<li><a href="<?php echo $pic['href'];?>" ><img src="<?php echo $pic['url'];?>"  /></a></li>
						<?php } ?>
					
					
				</ul>
				<nav class="ban-position">
					
				</nav>
			</div>
			
			<div class="clear"></div>
			
			
			<div class="m_lkuai">
				<div class="m_lkuai_l">
					<a href="__APP__/Content/lists/cat_id/102">
						<img src='__PUBLIC__/statics/default/images/pro2.png'/>
					</a>
				</div>
				<div class="m_lkuai_r">
					<a href="__APP__/Content/lists/cat_id/105">
						<img src='__PUBLIC__/statics/default/images/pro3.png'/>
					</a>
				</div>
			</div>
			
			<div class="md20"></div>
			
			<p class="tui_title"> 推荐产品<p>
			<p class="tui_title2">Favorite Designs<p>
			
			<div class="md10"></div>
			
			
			<ul class="cat_uol">
				<li class="cat_uol_li">
					<a class="cat_asdf cat_asdf_active" href="#">小美系列</a>
				</li>
				<li class="cat_uol_li">
					<a class="cat_asdf" href="#">美木系列</a>
				</li>
				<li class="cat_uol_li">
					<a class="cat_asdf" href="#">小资系列</a>
				</li>
				<li class="cat_uol_li">
					<a class="cat_asdf" href="#">小白系列</a>
					
					
					
					
				</li>
				<li class="cat_uol_li">
					<a class="cat_asdf" href="#">小 S 系列</a>
				</li>
				<li class="cat_uol_li">
					<a class="cat_asdf" href="#">专家级产品</a>
				</li>
			</ul>
			
			<div class="md10"></div>
			
			<?php $posid = array(14,15,17,18,19,20)?>
			
			<?php foreach($posid as $val){?>
			
			<?php $art2 = pos2art($val,20,30); ?>	
			<ul class="pro_ul" style="display:none; min-height:300px;">
				<?php foreach($art2 as $artRow2){ ?>
				<li>
					<a href="{$Think.const.CON_PATH}/<?php echo ($artRow2[product_id]); ?>/cat_id/<?php echo ($artRow2[cat_id]); ?>">
						<img src="<?php echo ($artRow2['thumb']); ?>" />
						<p class="pro_name"><?php echo ($artRow2['title']); ?></p>
						<p class="pro_name2">规格：<?php echo ($artRow2['guige']); ?></p>
					</a>
				</li>
				<?php } ?>
				
			</ul>
			<?php } ?>
			
			
			<div class="md20"></div>
			
			
			
		</div>
		
		<div class="clear"></div>
		
		<div class="footer_b upscroll">
			<img class="footdfer" src='__PUBLIC__/statics/default/images/back.png' style="display:inline-block"/>
			<span>返回顶部</span>
		</div>
		
		
		<!--开始脚部-->
		<div class="clear"></div>
		
		
		<div class="md10"></div>
		
		<p class="cor_foorer">COPYRIGHT  ©2015 MEIPMG.COM</p>
		
		<div class="md10"></div>
		
	</div>

</body>
</html>
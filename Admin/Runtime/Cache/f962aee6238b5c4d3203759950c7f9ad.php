<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link   href="__PUBLIC__/statics/default/css/index.css" rel="stylesheet" type="text/css" />
<script src="__PUBLIC__/statics/default/js/jquery.js" type="text/javascript" ></script>
<script>
$(document).ready(function(){
	$('#play li').each(function(){
		$('#play_nav_con').append('<li></li>');
	});
	$('#play_nav_con li').eq(0).css({'background':'url(__PUBLIC__/statics/default/images/play_nav_act.png) no-repeat'});
	
	$('#play_nav_con').css({'width':$('#play_nav_con li').length*20});
	var width = $('#play_nav_con li').length*20+64+14;
	$('#play_nav').css({'width':width});//alert(width);
	$('#play_nav').css({'left':($(document).width()-width)/2});
	
	(function(){
		var timer = null;
		var length = $('#play li').length;
		var now = 0;
		var is_on = length>0?1:0;
		
		if(is_on==1){
			timer = setInterval(function(){
				now = (now+1)%length;
				move(now);
			},5000);
		}
		
		$('#play').mouseover(function(){
			clearInterval(timer);
		}).mouseout(function(){
			if(is_on==1){
				timer = setInterval(function(){
					now = (now+1)%length;
					move(now);
				},5000);
			}
		});
		
		$('#play_pre').click(function(){
			now = (now-1)%length;
			move(now);
		});
		$('#play_next').click(function(){
			now = (now+1)%length;
			move(now);
		});
		
		
		function move(now){
			$('#play li').fadeOut();
			$('#play li').eq(now).fadeIn();
			$('#play_nav_con li').css({'background':'url(__PUBLIC__/statics/default/images/play_nav_nor.png) no-repeat'});
			$('#play_nav_con li').eq(now).css({'background':'url(__PUBLIC__/statics/default/images/play_nav_act.png) no-repeat'});
		}
	})();
	
});
</script>
</head>

<body>

<div id="wrap">
	<div id="top">
		<div id="top_con">
			<a href="<?php echo ($siteUrl); ?>"><img id="logo" src="__PUBLIC__/statics/default/images/logo.png" /></a>
			<div id="search">
				<form action="__APP__/Content/search/module_id/20" method="POST" >
					<input id="search_txt" type="text" name="search_key"  />
					<input id="search_sub" type="image" src="__PUBLIC__/statics/default/images/sub_btn.png" />
				</form>
			</div>
			<div id="lan"> 
				<a href="#">中文</a>&nbsp;&nbsp;
				<a href="#">ENGLISH</a>
				
			</div>
			
			<ul id="nav">
				<li id="index_nav"><a href="<?php echo ($siteUrl); ?>" style="color:white" >首页</a></li>
				<?php $cate = get_category(); ?>
				<?php foreach($cate as $value){ ?>
					<li><a href="<?php echo (CAT_PATH); ?>/<?php echo ($value[category_id]); ?>"><?php echo ($value['cat_name']); ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<div id="com_desc_wrap">
		<img src="__PUBLIC__/statics/default/images/join_bg.jpg" />
	</div>
	
	<div id="com_desc_con">
		<div id="com_desc_con_con">
			<div id="com_desc_tit">
				<p id="com_desc_tit_con">加入我们</p>
				<span id="com_desc_tit_bg"></span>
			</div>
			
			<div id="nor_con_wrap">
				<?php $art28 = cat2article(28,1,100); ?>
				
				<?php echo ($art28['lists'][0]['content']); ?>
			</div>
		</div>
		<div id="com_desc_con_bo"></div>
		<div id="com_desc_side2">
			
		</div>
	</div>
	
<div id="footer">
		<p>ADD:北京朝阳区建国路朗园Vintage 21#106   TEL：010-51120052  MAIL；business@de-cham.com    版权所有：德成顾问机构 ICO备：888888888</p>
	</div>
	
	
</div>
                           

</body>

</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>铂仓客户信息管理中心</title>

<link rel="stylesheet" href="__PUBLIC__/css/style2.css" type="text/css" media="screen" />
	
<script type="text/javascript" src="__PUBLIC__/scripts/jquery-1.3.2.min.js"></script>
<script>
$(document).ready(function(){
	$("#main-nav li ul li a").click(function(){ //alert('aa');return false;
		$("#main-nav li ul").hide();
		$("#main-nav li .nav-top-item").removeClass('current');
		
		$(this).parent().parent().slideDown();
		$(this).parent().parent().parent().find('.nav-top-item').addClass('current');
		
		$("#main-nav li ul li a").removeClass('current');
		$(this).addClass('current');
		
		
		
		
	})

	$("#main-nav li ul").hide(); 
	$("#main-nav li a.current").parent().find("ul").slideToggle("slow"); 
		
	$("#main-nav li a.nav-top-item").click( 
		function () {
			$(this).parent().siblings().find("ul").slideUp("normal"); // Slide up all sub menus except the one clicked
			$(this).next().slideToggle("normal"); // Slide down the clicked sub menu
			//return false;
		}
	);
	
	
})
</script>

</head>
	<body><div id="body-wrapper"> 
		
		<div id="sidebar"><div id="sidebar-wrapper"> 
			
			<h1 id="sidebar-title"><a href="#">Simpla Admin</a></h1>
		  
			
			<a href="#"><img id="logo" src="__PUBLIC__/images/logo.png" alt="Simpla Admin logo" /></a>
		  
			
			<div id="profile-links">
				<h4 style="color:#CCC">信息管理中心</h4>
			</div>        
			
			<ul id="main-nav" > 
				
				<li>
					<a href="#" class="nav-top-item no-submenu"> 
					请选择操作
					</a>       
				</li>
				
				<li> 
					<a href="#" class="nav-top-item"> 
					管理员管理
					</a>
					<ul>
						<li><a href="__APP__/Admin/admin" target="right" >管理员列表</a></li>
						<li><a href="__APP__/Admin/node" target="right" >权限管理</a></li>  
						<li><a href="__APP__/Admin/role" target="right" >角色管理</a></li>
						<li><a href="<?php echo U('Model/table_list');?>" target="right" >模型管理</a></li>
						<li><a href="<?php echo U('Model/list_list');?>" target="right" >全局分类</a></li>
					</ul>
				</li>
				
				<li>
					<a href="#" class="nav-top-item current">
					内容管理
					</a>
					<ul>
						<li><a class="current" href="__APP__/Category/Category_list" target="right" >栏目管理</a></li>
						
						<li><a href="__APP__/Website/Website_list" target="right" >站点管理</a></li>
						
						<li><a href="__APP__/Advertise/Advertise_list" target="right" >广告管理</a></li>
						<li><a href="__APP__/Art_position/Art_position_list" target="right" >推荐位管理</a></li>
						<li><a href="__APP__/Friend_links/Friend_links_list" target="right" >友情链接管理</a></li>
						<li><a href="__APP__/Web_baseinfo/Web_baseinfo_list" target="right" >站点基本信息管理</a></li>
						<li><a href="__APP__/Content/gen_index" target="right" >静态化首页/清理缓存</a></li>
					</ul>
				</li>
				
				
				
			</ul> 
			
			
			
		</div></div>
		
		

	</div></body>
</html>
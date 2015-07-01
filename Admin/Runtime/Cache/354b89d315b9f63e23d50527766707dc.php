<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="__PUBLIC__/css/style.css" type="text/css" media="screen" /><!--后台模板CSS-->
<script charset="utf-8" type="text/javascript" src="__PUBLIC__/scripts/jquery.js"></script>  <!--JQ-->
<title>信息管理中心</title>
<script>
$(document).ready(function(){
	
	$('#site').change(function(){
		var value = $(this).val();
		
		if(value!=0){
			$.get('__APP__/Index/chageSite',{'siteid':value},function(data){
				if(data==1){
					alert('设置成功');
					var txt='';
					$('#site option[value='+value+']');
					txt = $('#site option[value='+value+']').attr('txt');
					$('#now_site').html(txt);
					window.parent.frames.location.href='__APP__/Index/main';
				}else{
					alert('设置失败');
				}
			});
			
		}
	});
});
</script>
<style>
body{padding-left:30px;}
#site{ float:right; margin-top:20px;margin-right:50px;}
h2{width:350px;float:left; margin-top:20px; }
#now_wrap{ margin-top:20px; display:block;  float:right; width:350px; font-size:18px; line-height:35px;}
#now_site{ color:red; font-weight:bolder;}
</style>

	
<script type="text/javascript" src="__PUBLIC__/scripts/jquery-1.3.2.min.js"></script>
<script>
$(document).ready(function(){
	var otxt = $('option[selected="true"]');
	var txt  = otxt.attr('txt');
	$('#now_site').html(txt);
});
</script>

</head>
<body>
<h2 style="">欢迎:  <?php echo ($_SESSION['username']); ?></h2>

<select id="site" class="selectArea" >
	<option value="0" >---切换站点---</option>
	<?php foreach($websiteInfo as $row){ ?>
		<option value="<?php echo ($row['website_id']); ?>" <?php if(get_site_id()==$row['website_id']){echo 'selected="true"';} ?> txt="<?php echo ($row['webname']); ?>" >---<?php echo ($row['webname']); ?>---</option>
	<?php } ?>
	
</select>
<span id="now_wrap">
	当前操作站点：
	<strong id="now_site"></strong>
</span>









</body>
</html>
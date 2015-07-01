<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simpla Admin</title>
<link rel="stylesheet" href="__PUBLIC__/css/style.css" type="text/css" media="screen" />
<script type="text/javascript" src="__PUBLIC__/scripts/jquery.js"></script>


<script src="__PUBLIC__/scripts/dragSort/move.js"></script>			<!--拖拽所用运动框架-->
<script src="__PUBLIC__/scripts/dragSort/dragSort.js"></script>		<!--表格拖拽-->
<script src="__PUBLIC__/scripts/dragSort/Fast_radio_set.js"></script> <!--异步radio-->
<script src="__PUBLIC__/scripts/dragSort/Message_box.js"></script>    <!--消息盒子-->
<script src="__PUBLIC__/scripts/My97DatePicker/WdatePicker.js"></script>    <!--日期-->



</head>
<body id="DD_MODEL_DD">
	<div id="body-wrapper"> 
		<div id="main-content"> 
			<div class="content-box" style="min-height:600px;">

				
				 
<style>

table tr td{border:1px solid #dddddd}
</style>

<div class="content-box-header CM_header">
					
	<h3><font color='red'><?php echo ($list["list_name"]); ?></font>添加菜单选项</h3>
	
	<ul id="my_tab">
		
		<li><a id="" href="<?php echo U('Model/add_list_item');?>" >菜单预览</a></li>
		
	</ul>
	<div class="clear"></div>
</div> 
				



					
<form action="<?php echo U('Model/do_add_list_item');?>" method="post">				
<table class="add_type">

	

			<thead>
				<tr>
					<td>父级分类</td>
					
					<td><?php echo ($select); ?></td>				
				</tr>
				
				<tr>
					<td>分类名称</td>
					
					<td><input class="singleErea" type="text" name="item_desc" /></td>		
				</tr>
				
				<tr>
					<td>排序</td>
					
					<td><input class="singleErea" type="text" value="0" name="item_sort" /> </td>				
				</tr>
				
				
				
				
				<td>操作</td>
					<input type="hidden" name="list_id" value="<?php echo ($list_id); ?>"/>
					<td><input class="button" type="submit" value="提交" /> </td>				
				</tr>
				
			</thead>
			<tbody>
				
	
			</tbody>
</table>
</form>			
		
						
				</div>

			<div class="clear"></div>
		
		</div> 

	</div>
	
</body>
</html>
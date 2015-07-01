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

<script>
$(document).ready(function(){
	$('#list_add_column').click(function(){
	
		var str='';
		str+='<div>名称（中文）:<input class="singleErea" type="text"  name="list_add_column_desc[]"   value="<?php echo $one_column['column_desc']?>" /> 列名:<font color="red"><?php echo ($list_info["list_name"]); ?></font>_<input class="singleErea" type="text"  name="list_add_column_name[]"   value="" />列类型:<select name="list_column_type[]"><option value="singleErea">singleErea</option><option value="multiErea">multiErea</option><option value="singlePic">singlePic</option></select><font color="blue" class="list_column_delete" style="cursor:pointer">[ - ]</font></div>';
	
		$('#list_column_wrap').append(str);
	});
	
	
	$('#list_column_wrap').delegate('.list_column_delete','click',function(){
		$(this).parent().remove();
	});
});
</script>


<div class="content-box-header CM_header">
					
	<h3><font color='red'><?php echo ($list_info["list_name"]); ?></font>菜单编辑</h3>
	
	<ul id="my_tab">
		<!--
		<li><a id="" href="<?php echo U('Model/add_list_item');?>" >菜单预览</a></li>
		-->
	</ul>
	<div class="clear"></div>
</div> 
				
<div class="content-box-content CM_boxList">
	
	<div class="tab-content default-tab" id="tab1">
					
		<hr/>
				
		<form action="<?php echo U('Model/do_edit_list');?>" method="post">				
			<table class="add_type add_type">				
				<thead>
					<tr>
						<td>分类菜单名称</td>
						
						<td><?php echo ($list_info["list_name"]); ?></td>				
					</tr>
					
					<tr>
						<td>描述</td>
						
						<td><input class="singleErea" type="text" name="item_desc" value="<?php echo ($list_info["list_desc"]); ?>"/></td>				
					</tr>
					
					
					
					
					<tr >
						<td>扩展<span id="list_add_column" style="color:red; cursor:pointer">[ + ]</span></td>
						
						<td id="list_column_wrap">
						
							<?php $expand_column = unserialize( $list_info['expand_column'] );?>
							
							<?php foreach($expand_column as $key=>$one_column){?>
							<div >
								名称（中文）:<input class="singleErea" type="text"  name="list_add_column_desc[]"   value="<?php echo $one_column['column_desc']?>" /> 
								列名:
								<font color="red">
									
									<?php echo $list_info['list_name'];?>_<input class="singleErea" type="text"  name="list_add_column_name[]"   value="<?php echo $one_column['column_show_name']?>" /> 
								</font>
								列类型:
								<select name="list_column_type[]">
									<option <?php if($one_column['column_type']=='singleErea') echo 'selected="true"';?> value="singleErea">singleErea</option>
									<option <?php if($one_column['column_type']=='multiErea') echo 'selected="true"';?> value="multiErea">multiErea</option>
									<option <?php if($one_column['column_type']=='singlePic') echo 'selected="true"';?> value="singlePic">singlePic</option>
								</select>
								
								<font color="blue" class="list_column_delete" style="cursor:pointer">[ - ]</font>
							</div>
							
							<?php } ?>
						</td>				
					</tr>
					
					
					
					
					
					<td>操作</td>				
						<input type="hidden" name="list_id" value="<?php echo ($list_info["list_id"]); ?>"/>
						<td><input class="button" type="submit" value="提交" /> </td>				
					</tr>
					
				</thead>
				<tbody>
					
		
				</tbody>
			</table>
		</form>	
		
	</div> 
					
</div> 		
		
						
				</div>

			<div class="clear"></div>
		
		</div> 

	</div>
	
</body>
</html>
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
table tr td{ border:1px solid gray}
</style>
<script>
$(document).ready(function(){
	(function(){
		$('#DD_ADD_EXCEL_IN_ROW').click(function(){
			$('#DD_ADD_EXCEL_IN_ROW_LISTS').append($('#DD_ADD_EXCEL_IN_ROW_NEW').html());
		});
		
		$('body').delegate('.DD_ADD_EXCEL_IN_ROW_DELETE','click',function(){
			$(this).parent().remove();
		});
		
	})();
});



</script>
<div class="content-box-header CM_header">
					
	<h3>
		<a href="<?php echo U('Model/table_list');?>">
			<font color="red"><<模型列表 &nbsp; &nbsp; &nbsp;</font>
		</a>		
		<font color="red"><?php echo ($table["table_name"]); ?>--</font>的字段列表
	</h3>
	
	<ul id="my_tab">
		
	</ul>
	
	<div class="clear"></div>
</div> 
				
				
<div class="content-box-content CM_boxList">
	
	<div class="tab-content default-tab" id="tab1">
		<form action="__APP__/Model/set_excel_maps" method="POST" >
		<table>
			
		
			<tr>
				<td>映射类型:</td>
				<td>
					原样导入：<input type="radio" name="map_type" value="origin" <?php if($mapInfo['map_type'] == 'origin' ): ?>checked="true"<?php endif; ?> checked="true"  />  &nbsp;&nbsp;
					菜单列表：<input type="radio" name="map_type" value="list" <?php if($mapInfo['map_type'] == 'list' ): ?>checked="true"<?php endif; ?> />  &nbsp;&nbsp;
					自定义值：<input type="radio" name="map_type" value="items" <?php if($mapInfo['map_type'] == 'items' ): ?>checked="true"<?php endif; ?> />  &nbsp;&nbsp;
					<?php if($vo['column_type'] == 'select' ): ?>Select：  <input type="radio" name="map_type" value="select" <?php if($mapInfo['map_type'] == 'select' ): ?>checked="true"<?php endif; ?> />    &nbsp;&nbsp;<?php endif; ?>
				</td>
			</tr>
			
			<tr>
				<td>分类列表:</td>
				<td>
					<select name="map_list_id" class="selectArea" >
						<option value="0" >--请选择分类列表--</option>
						<?php foreach($cm_list_info as $val){ ?>
						<option <?php if($mapInfo['map_list_id']==$val['list_id']){echo 'selected="true"'; } ?> value="<?php echo ($val['list_id']); ?>" >--<?php echo ($val['list_name']); ?>--</option>
						<?php } ?>
					</select>
				</td>
			</tr>
			
			<tr>
				<td>导入字段顺序:</td>
				<td>
					<input class="singleErea" type="text" name="excel_in_sort" value="<?php echo $vo['excel_in_sort']==''?'10':$vo['excel_in_sort']; ?>"  />
				</td>
			</tr>
			
			<tr>
				<td>自定义值:</td>
				<td>
					<span id="DD_ADD_EXCEL_IN_ROW" style="color:red;cursor:pointer;">[ + ]</span>
				</td>
			</tr>
			<tr>
				<td></td>
				<td id="DD_ADD_EXCEL_IN_ROW_LISTS" >
				<?php foreach($mapInfo['map_lists'] as $map_lists_row){ ?>
					<div style="margin-top:4px;">
						值：<input class="singleErea" type="text" name="excel_in_key[]" value="<?php echo ($map_lists_row['key']); ?>" />&nbsp;
						描述：<input class="singleErea" type="text" name="excel_in_desc[]" value="<?php echo ($map_lists_row['desc']); ?>" />&nbsp;
						<span class="DD_ADD_EXCEL_IN_ROW_DELETE" style="color:blue;cursor:pointer;" >[ - ] </span>
					</div>
				<?php } ?>
					
				</td>
			</tr>
			
			<tr>
				<td colspan='2' style="text-align:center">
					<input type="hidden" name="tab_col_id" value="<?php echo ($vo["tab_col_id"]); ?>" />
					<input class="button" type="submit" value="提交" />
				</td>
				
			</tr>
			<div id="DD_ADD_EXCEL_IN_ROW_NEW" style="display:none">
				<div style="margin-top:4px;">
					值：<input class="singleErea" type="text" name="excel_in_key[]" />&nbsp;
					描述：<input class="singleErea" type="text" name="excel_in_desc[]" />&nbsp;
					<span class="DD_ADD_EXCEL_IN_ROW_DELETE" style="color:blue;cursor:pointer;" >[ - ] </span>
				</div>
			</div>
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
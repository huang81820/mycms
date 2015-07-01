<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simpla Admin</title>

<link rel="stylesheet" href="__PUBLIC__/css/style.css" type="text/css" media="screen" /><!--后台模板CSS-->
<script charset="utf-8" type="text/javascript" src="__PUBLIC__/scripts/jquery.js"></script>  <!--JQ-->
<script charset="utf-8" type="text/javascript" src="__PUBLIC__/scripts/common.js"></script>  <!--公共JS-->
<script charset="utf-8" src="__PUBLIC__/scripts/formvalidator4.1.3/formValidator-4.1.3.js" type="text/javascript" charset="UTF-8"></script><!--表单验证插件-->
<script charset="utf-8" src="__PUBLIC__/scripts/formvalidator4.1.3/formValidatorRegex.js" type="text/javascript" charset="UTF-8"></script><!--表单验证正则库-->
<script charset="utf-8" type="text/javascript" src="__PUBLIC__/scripts/makeMUltiPicDialog.js"></script><!--kindeditor表单组件类-->
<link rel="stylesheet" href="__PUBLIC__/scripts/editor/themes/default/default.css" /><!--kindeditor-->
<script charset="utf-8" src="__PUBLIC__/scripts/editor/kindeditor.js"></script>		<!--kindeditor-->
<script charset="utf-8" src="__PUBLIC__/scripts/editor/lang/zh_CN.js"></script>		<!--kindeditor-->
<script charset="utf-8" src="__PUBLIC__/scripts/My97DatePicker/WdatePicker.js"></script><!--日期插件-->
<script charset="utf-8" src="__PUBLIC__/scripts/buildPicDialog.js"></script>			<!--图片放大插件-->
<script charset="utf-8" src="__PUBLIC__/scripts/dragSort/move.js"></script>			<!--拖拽所用运动框架-->
<script charset="utf-8" src="__PUBLIC__/scripts/dragSort/dragSort.js"></script>		<!--表格拖拽-->
<script charset="utf-8" src="__PUBLIC__/scripts/dragSort/Fast_radio_set.js"></script> <!--异步radio-->
<script charset="utf-8" src="__PUBLIC__/scripts/dragSort/Message_box.js"></script>    <!--消息盒子-->
<script charset="utf-8" src="__PUBLIC__/scripts/jquery.animate-colors-min.js"></script>    <!--jquery支持颜色animate插件-->


<script>

$(document).ready(function(){

	new buildPicDialog('.toBig',{'width':'600'});  <!--实例化图片放大类-->
});

</script>


<script>
$(document).ready(function(){
	new buildPicDialog('.toBig',{'width':'600'});
});
</script>



</head>
<body>
	<div id="body-wrapper"> 
		<div id="main-content"> 
			


			<div class="content-box">
				
				<div class="content-box-header">
					
					<h3>修改表信息</h3>
					
					<ul id="my_tab">
						<li><a href="__APP__/Model/table_list" >模型列表</a></li>
								
					</ul>
					<div class="clear"></div>
				</div> 
			
			
			<div class="content-box-content" >
				
				<form action="__APP__/Model/table_editok" method="POST" >
					<table>
						<tr>
							<td>表名称</td>
							<td><input class="singletext" type="text" name="table_name" value="<?php echo ($tableInfo['table_name']); ?>" /></td>
						</tr>
						
						<tr>
							<td>描述</td>
							<td><input class="singletext" type="text" name="description" value="<?php echo ($tableInfo['description']); ?>" /></td>
						</tr>
						
						<tr>
							<td>层级关系</td>
							<td>
							<select class="selectArea" name="pid">
							
								<option value="0" >---顶层关系---</option>
								<?php foreach($select_data as $table_row){ ?>
								
								<option value="<?php echo ($table_row['table_id']); ?>" <?php if($table_row['table_id']==$tableInfo['pid']){ echo 'selected="true"'; } ?>  >
								<?php
 echo str_repeat('|----',($table_row['deep']-1)); ?>
								
								<?php echo ($table_row['table_name']); ?>
								</option>
								
								<?php } ?>
							</select>
							</td>
						</tr>
						<input type="hidden" name="table_id" value="<?php echo ($tableInfo['table_id']); ?>"  />
						<tr>
							<td>操作</td>
							<td><input class="button" type="submit"  value="提交" /></td>
						</tr>
					</table>
				</form>
			</div>
				
				
			</div>
			
			<div class="clear"></div>
			
			
			
		</div> 

	</div>
	
</body>
</html>
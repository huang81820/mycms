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


</head>
<body>
	<div id="body-wrapper"> 
		<div id="main-content"> 
			<div class="content-box">
				
				<div class="content-box-header">
					
					<h3>列表</h3>
					
					<ul id="my_tab">	
						
						<li><?php echo ($excel_btn); ?></li>
						<li>&nbsp;<?php echo ($add_btn); ?></li>
					</ul>
					<div class="clear"></div>
				</div> 
				
				
				<div class="content-box-content">
					
					<table>
						<tr>
							<td>ID</td>
							<td>分类名称</td>
							<td>缩略图</td>
							<td>排序</td>
							<td>操作</td>
						</tr>
					<?php foreach($cat_list as $val){ ?>
						<tr>
							<td><?php echo ($val['category_id']); ?></td>
							<td style="text-indent:<?php echo ($val['deep']-1)*30; ?>px;"><?php echo ($val['cat_name']); ?></td>
							<td><img class="toBig" src="<?php echo ($val['thumb']); ?>" width='28' height='28' /></td>
							<td><?php echo ($val['category_sort']); ?></td>
							<td>
							<?php if($val['deep'] != 1): endif; ?>
								<a href="__APP__/Content/module2actions/category_id/<?php echo ($val['category_id']); ?>">内容管理</a>&nbsp;|
							
								<a href="__APP__/Category/Category_edit/category_id/<?php echo ($val['category_id']); ?>">编辑</a>&nbsp;|
								<a href="__APP__/Category/Category_del/category_id/<?php echo ($val['category_id']); ?>">删除</a>
							</td>
						</tr>
					<?php } ?>
					</table>
				</div> 
				
			</div>
		<div class="clear"></div>
			
		</div> 
</div>
	
</body>
</html>
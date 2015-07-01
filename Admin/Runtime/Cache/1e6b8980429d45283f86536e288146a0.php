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

				
				 
<style>table tr td{border:1px solid #dddddd}</style>

<div class="content-box-header CM_header">
					
	<h3><font color='red'><?php echo ($list["list_name"]); ?></font>菜单选项列表</h3>
	
	<ul id="my_tab">
		<li><a id="" href="<?php echo U('Model/add_list_item',array('list_id'=>$list['list_id']));?>" >添加选项</a></li>
		
		
	</ul>
	<div class="clear"></div>
</div> 
				
				
<div class="content-box-content CM_boxList">
	
	<div class="tab-content default-tab" >
					
		<div style="margin-bottom:16px; margin-top:4px;">菜单预览：&nbsp;<?php echo ($test_select); ?></div>
		<hr/>


					
					
		<table>
			<thead>
				<tr>
					<td><input type="checkbox" value="0"  class="SELECT_ALL"/></td>
					
					<td>ID</td>
					<td>菜单名称</td>
					<td>菜单排序</td>
					

					<td>操作</td>


				</tr>
			</thead>
			<tbody>
				
			<?php if(is_array($list_item)): foreach($list_item as $key=>$vo): ?><tr>
					<td><input type="checkbox" value="<?php echo ($vo["list_item_id"]); ?>" /></td>
					
					<td><?php echo ($vo["list_item_id"]); ?></td>
					<td style="text-indent:<?php echo ($vo['deep'] * 20 -20); ?>px;"><?php echo ($vo["item_desc"]); ?></td>
					<td><?php echo ($vo["item_sort"]); ?></td>
				


					<td>
						<a href="<?php echo U('Model/edit_list_item',array('list_item_id'=>$vo['list_item_id'],'list_id'=>$list['list_id']) ) ;?>" title="修改"><img src="__PUBLIC__/images/icons/pencil.png" alt="Edit" /></a>
						
						<a onclick="return confirm('是否确定要删除该分类菜单？');" href="<?php echo U('Model/del_list',array('list_id'=>$vo['list_id'])) ;?>" title="删除"><img src="__PUBLIC__/images/icons/cross.png" alt="Delete" /></a> 
						 
					</td>
				</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>	
		
						
				</div>

			<div class="clear"></div>
		
		</div> 

	</div>
	
</body>
</html>
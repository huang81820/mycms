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

<div class="content-box-header CM_header" >
					
	<h3>联动菜单列表</h3>
	
	<ul id="my_tab">
		<li><a id="" href="#" ></a></li>
	
	</ul>
	<div class="clear"></div>
</div> 
				
				
<div class="content-box-content">
	
	<div class="tab-content default-tab" id="tab1">
	
		<form action="__APP__/Model/do_add_list" method="post">
			<div style="margin-bottom:16px;">
			分类菜单名称：<input type="text" name="list_name"/>&nbsp;&nbsp;&nbsp;
			
			
			分类菜单简述：<input type="text" name="list_desc"/>&nbsp;&nbsp;
			<input class="norbtn"  type="submit" value="提交"/>
			</div>
		</form>
		<hr/>
										
						
		<table>
			<thead>
				<tr>
					<td><input type="checkbox" value="0"  class="SELECT_ALL"/></td>
					
					<td>ID</td>
					<td>菜单名称</td>
					<td>菜单简述</td>
					

					<td>操作</td>


				</tr>
			</thead>
			<tbody>
				
			<?php if(is_array($list_list)): foreach($list_list as $key=>$vo): ?><tr>
					<td><input style="height:12px;"  type="checkbox" value="<?php echo ($vo["hnews_id"]); ?>" /></td>
					
					<td><?php echo ($vo["list_id"]); ?></td>
					<td><?php echo ($vo["list_name"]); ?></td>
					<td><?php echo ($vo["list_desc"]); ?></td>
				


					<td>
					<a href="<?php echo U('Model/edit_list',array('list_id'=>$vo['list_id']) ) ;?>" title="菜单编辑">菜单编辑</a>&nbsp;&nbsp;|&nbsp;&nbsp;
						<a href="<?php echo U('Model/list_item',array('list_id'=>$vo['list_id']) ) ;?>" title="字段管理">菜单管理</a>&nbsp;&nbsp;|&nbsp;&nbsp;
						<a onclick="return confirm('是否确定要删除该菜单？');" href="<?php echo U('Model/del_list',array('list_id'=>$vo['list_id'])) ;?>" title="删除">删除</a> 
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
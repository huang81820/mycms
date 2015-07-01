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

table tr td{border:1px solid #dddddd; }
table thead tr td{ text-align:center}
</style>

<div class="content-box-header CM_header">
					
	<h3>Table列表</h3>
	
	<ul id="my_tab">
		<li><a id="" href="{:U('Model/add_table')" ></a></li>
		
		
	</ul>
	<div class="clear"></div>
</div> 
				
				
<div class="content-box-content CM_boxList">
	
	<div class="tab-content default-tab" id="tab1">
					
		<form action="__APP__/Model/add_table" method="post">
			<div style="margin-bottom:20px;">
			表名称：<input type="text" name="table_name"/>&nbsp;&nbsp;&nbsp;
			
			
			
			
			缔属关系：
			<select name="pid">
				<option value="0" >---顶层关系---</option>
				<?php if(is_array($select_data)): foreach($select_data as $key=>$table_row): ?><option value="<?php echo ($table_row['table_id']); ?>"  >
				<?php
 echo str_repeat('&nbsp;',($table_row['deep']-1)*3); ?>
				
				<?php echo ($table_row['table_name']); ?>
				</option><?php endforeach; endif; ?>
				
			</select>
			&nbsp;&nbsp;&nbsp;
			描述：<input type="text" name="description" />&nbsp;&nbsp;&nbsp;
			<input class="norbtn" type="submit" value="提交"/>
			</div>
		</form>
		<hr/>
					
		<table>
			<thead>
				<tr>
					
					
					<td>ID</td>
					<td>表名称</td>
					<td>描述</td>
					<td>功能地址</td>

					<td>操作</td>


				</tr>
			</thead>
			<tbody>
				
			<?php if(is_array($select_data)): foreach($select_data as $key=>$vo): ?><tr>
					
					
					<td><?php echo ($vo["table_id"]); ?></td>
					<td style="font-weight:600; font-size:16px;">
						
						<?php
 $str=str_repeat('|--',($vo['deep']-1)); echo $str; echo ($vo["table_name"]); ?>
						
					</td>
					<td><?php echo ($vo["description"]); ?></td>
					<td><a href="__APP__/<?php echo ucfirst($vo['table_name']).'/'.ucfirst($vo['table_name']).'_list' ?>"><?php echo ucfirst($vo['table_name']).'/'.ucfirst($vo['table_name']).'_list' ?><a></td>

					<td style="text-align:center">
						<a href="<?php echo U('Model/table_edit',array('table_id'=>$vo['table_id']) ) ;?>" title="编辑">编辑</a>&nbsp;|&nbsp;
						<a href="<?php echo U('Model/table_column_list',array('table_id'=>$vo['table_id']) ) ;?>" title="字段管理">字段管理</a>&nbsp;|&nbsp;
						<a href="<?php echo U('Model/table_list_manage',array('table_id'=>$vo['table_id']) ) ;?>" title="列表管理">列表管理</a>&nbsp;|&nbsp;
						<a href="<?php echo U('Model/table_list_search',array('table_id'=>$vo['table_id']) ) ;?>" title="搜索器配置">搜索器配置</a>&nbsp;|&nbsp;
						<a id="" href="<?php echo U('Model/excel_options',array('table_id'=>$vo['table_id']));?>" >Excel配置</a>&nbsp;|&nbsp;
						<a onclick="return confirm('是否确定要删除该数据表？');" href="<?php echo U('Model/del_table',array('table_id'=>$vo['table_id'])) ;?>" title="删除">删除</a> 
						 
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
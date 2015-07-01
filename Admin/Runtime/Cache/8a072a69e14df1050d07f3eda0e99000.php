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






.active {border:3px dashed red; background:#eeeeee}
.mytable{ width:100%; display:table;  position:relative}
.mytable > div {width:100%;  display:table-row;height:30px; line-height:30px;  text-align:center}
.list_cell{ display:table-cell;  border:#CCC 1px solid;font-size:14px;}

.mytable > div{width:100%; height:30px;} 

</style>
<script>
$(document).ready(function(){
	new dragSort('ul1','cm_table_column','<?php echo U("Model/changeListSort");?>');
		
	new Fast_radio_set('ul1','cm_table_column','<?php echo U('Model/ajax_set_is');?>','__PUBLIC__/images/status0.png','__PUBLIC__/images/status1.png');
	
	//new dragSort('ul2','drag_span','<?php echo U("Model/changeListSort");?>');
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
		<li><a id="" href="<?php echo U('Model/add_table_column',array('table_id'=>$table['table_id']));?>" >添加字段&nbsp;</a></li>
		<li><a id="" href="<?php echo U('Model/Test_from',array('table_id'=>$table['table_id']));?>" >  |  表单预览</a></li>
	</ul>
	
	<div class="clear"></div>
</div> 
				
				
<div class="content-box-content CM_boxList">
	
	<div class="tab-content default-tab" id="tab1">
		
		<div style="clear:both">
				
				<div id="ul1" class="dragSort">
					<div class="table_thead">
						<span class="drag_span"> <input type="checkbox"   class="SELECT_ALL"/> </span>
						<span class="drag_span"> ID</span>
						<span class="drag_span"> 字段名称</span>
						<span class="drag_span"> 字段描述</span>
						<span class="drag_span"> 字段类型</span>
						<span class="drag_span">  添加</span>
						<span class="drag_span">  编辑</span>
						<span class="drag_span">  列表</span>
						<span class="drag_span">  搜索</span>
						<span class="drag_span">操作</span>
					</div>
				<?php if(is_array($tab_col_list)): foreach($tab_col_list as $key=>$vo): ?><div class="table_row">
						<span  class="drag_span"> <input type="checkbox" value="<?php echo ($vo["tab_col_id"]); ?>"  /> </span>
						<span  class="drag_span"> <?php echo ($vo["tab_col_id"]); ?></span>
						<span  class="drag_span"> <?php echo ($vo["column_name"]); ?></span>
						<span  class="drag_span"> <?php echo ($vo["column_desc"]); ?></span>
						<span  class="drag_span"> <?php echo ($vo["column_type"]); ?></span>
						
						
						<span  class="drag_span">
							
								<img class="ajax_set" columnname="is_add" rowid="<?php echo ($vo["tab_col_id"]); ?>" val="<?php echo ($vo["is_add"]); ?>" src="__PUBLIC__/images/status<?php echo ($vo["is_add"]); ?>.png" />									
							
						</span>
						<span  class="drag_span">															
							<img class="ajax_set" columnname="is_edit" rowid="<?php echo ($vo["tab_col_id"]); ?>" val="<?php echo ($vo["is_edit"]); ?>" src="__PUBLIC__/images/status<?php echo ($vo["is_edit"]); ?>.png" />	
						</span>
						<span  class="drag_span">
							<?php if(($vo["column_type"] == 'primaryKey') OR ($vo["column_type"] == 'multiErea') OR ($vo["column_type"] == 'multiPic') OR ($vo["column_type"] == 'edictor') OR ($vo["column_type"] == 'checkedbox') OR ($vo["column_type"] == 'file') OR ($vo["column_type"] == 'date_range') OR ($vo["column_type"] == 'date_time_range')): ?><img src="__PUBLIC__/images/icons/exclamation.png" />
							<?php else: ?>
								<img class="ajax_set" columnname="is_list" rowid="<?php echo ($vo["tab_col_id"]); ?>" val="<?php echo ($vo["is_list"]); ?>" src="__PUBLIC__/images/status<?php echo ($vo["is_list"]); ?>.png" /><?php endif; ?>
						</span>
						
						<span  class="drag_span">
							<?php if(($vo["column_type"] == 'date_range') OR ($vo["column_type"] == 'date_time_range') OR ($vo["column_type"] == 'primaryKey') OR ($vo["column_type"] == 'multiPic') OR ($vo["column_type"] == 'edictor') OR ($vo["column_type"] == 'checkedbox') OR ($vo["column_type"] == 'file') OR ($vo["column_type"] == 'multiErea') OR ($vo["column_type"] == 'singlePic')): ?><img src="__PUBLIC__/images/icons/exclamation.png" />
							<?php else: ?>
							<img class="ajax_set" columnname="is_search" rowid="<?php echo ($vo["tab_col_id"]); ?>" val="<?php echo ($vo["is_search"]); ?>" src="__PUBLIC__/images/status<?php echo ($vo["is_search"]); ?>.png" /><?php endif; ?>
						</span>
						
						<span  class="drag_span">
							<?php if($vo["column_type"] != 'primaryKey'): ?><a href="<?php echo U('Model/edit_column',array('tab_col_id'=>$vo['tab_col_id'],'table_id'=>$table['table_id']) ) ;?>" title="修改"><img src="__PUBLIC__/images/icons/pencil.png" alt="Edit" /></a><?php endif; ?> 
							 
							 <a onclick="return confirm('是否确定要删除该字段？');" href="<?php echo U('Model/del_column',array('tab_col_id'=>$vo['tab_col_id'])) ;?>" title="删除"><img src="__PUBLIC__/images/icons/cross.png" alt="Delete" /></a> 
						</span>
					</div><?php endforeach; endif; ?>
				</div>
				

<!--
				<div class="mytable" id="ul2">
					<div class="row_wrap" >
						<span class="list_cell" > <input type="checkbox" value="<?php echo ($vo["tab_col_id"]); ?>"  class="SELECT_ALL"/> </span>
						<span class="list_cell">  ID</span>
						<span class="list_cell">  字段名称</span>
						<span class="list_cell">  字段描述</span>
						<span class="list_cell">  字段类型</span>
						<span class="list_cell">  添加</span>
						<span class="list_cell">  编辑</span>
						<span class="list_cell">  列表</span>
						
						<span class="list_cell">  操作</span>								
					</div>
				<?php if(is_array($tab_col_list)): foreach($tab_col_list as $key=>$vo): ?><div class="row_wrap" id="aa">
						<span class="list_cell"> <input type="checkbox" value="<?php echo ($vo["tab_col_id"]); ?>"  class="SELECT_ALL"/>  </span>
						<span class="list_cell"><?php echo ($vo["tab_col_id"]); ?></span>
						<span class="list_cell"><?php echo ($vo["column_name"]); ?></span>
						<span class="list_cell"><?php echo ($vo["column_desc"]); ?></span>
						<span class="list_cell"><?php echo ($vo["column_type"]); ?></span>
						
						<span class="list_cell">
							<?php if($vo["is_add"] == 0): ?><img rowid="<?php echo ($vo["tab_col_id"]); ?>" val="0" src="__PUBLIC__/images/cross_circle.png" /><?php endif; ?>
							<?php if($vo["is_add"] == 1): ?><img rowid="<?php echo ($vo["tab_col_id"]); ?>" val="1" src="__PUBLIC__/images/tick_circle.png" /><?php endif; ?>
						</span>
						<span class="list_cell">															
							<?php if($vo["is_edit"] == 0): ?><img val="0" src="__PUBLIC__/images/cross_circle.png" /><?php endif; ?>
							<?php if($vo["is_edit"] == 1): ?><img val="1" src="__PUBLIC__/images/tick_circle.png" /><?php endif; ?>
						</span>
						<span class="list_cell">
							
							<?php if($vo["is_list"] == 0): ?><img val="0" src="__PUBLIC__/images/cross_circle.png" /><?php endif; ?>
							<?php if($vo["is_list"] == 1): ?><img val="1" src="__PUBLIC__/images/tick_circle.png" /><?php endif; ?>
						</span>
					
						
						<span class="list_cell"> 
							<a href="<?php echo U('Model/edit_column',array('tab_col_id'=>$vo['tab_col_id'],'table_id'=>$table['table_id']) ) ;?>" title="修改"><img src="__PUBLIC__/images/icons/pencil.png" alt="Edit" /></a>
							</if> 
							 
							 <a onclick="return confirm('是否确定要删除该字段？');" href="<?php echo U('Model/del_column',array('tab_col_id'=>$vo['tab_col_id'])) ;?>" title="删除"><img src="__PUBLIC__/images/icons/cross.png" alt="Delete" /></a> 
						</span>
						
					</div><?php endforeach; endif; ?>
				</div>
-->		
				<div style="clear:both"></div>
			</div>
		</div> 
					
</div> 
		
		
						
				</div>

			<div class="clear"></div>
		
		</div> 

	</div>
	
</body>
</html>
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
	
	(function(){
		$('.ajax_set_options').change(function(){
			var value = $(this).val();
			var column_name = $(this).attr('name');
			var tab_col_id = $(this).attr('tab_col_id');
			$.get('<?php echo U("Model/ajax_set_excel_in_match");?>',{'value':value,'tab_col_id':tab_col_id,'column_name':column_name},function(data){
				if(data=='1'){
					Message('操作成功');
				}else{
					Message('操作失败');
				}
			});
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
		
		<div style="clear:both">
				
				<div id="ul1" class="dragSort">
					<div class="table_thead">
						
						<span class="drag_span"> ID</span>
						<span class="drag_span"> 字段名称</span>
						<span class="drag_span"> 字段描述</span>
						<span class="drag_span"> 字段类型</span>
						
						<span class="drag_span">  导入</span>
						<span class="drag_span">允许为空</span>
						<span class="drag_span">是否导入查重</span>
						
						<span class="drag_span">查重方式</span>
						<span class="drag_span">查重逻辑</span>
						<span class="drag_span">导入映射</span>
						
						<span class="drag_span">  导出</span>
						<span class="drag_span">导出映射</span>
					</div>
				<?php if(is_array($tab_col_list)): foreach($tab_col_list as $key=>$vo): ?><div class="table_row">
						
						<span  class="drag_span"> <?php echo ($vo["tab_col_id"]); ?></span>
						<span  class="drag_span"> <?php echo ($vo["column_name"]); ?></span>
						<span  class="drag_span"> <?php echo ($vo["column_desc"]); ?></span>
						<span  class="drag_span"> <?php echo ($vo["column_type"]); ?></span>
						
						
						
						<span  class="drag_span">
							<?php if(($vo["column_type"] == 'primaryKey') OR ($vo["column_type"] == 'multiErea') OR ($vo["column_type"] == 'multiPic') OR ($vo["column_type"] == 'edictor') OR ($vo["column_type"] == 'checkedbox') OR ($vo["column_type"] == 'file') OR ($vo["column_type"] == 'date_range') OR ($vo["column_type"] == 'date_time_range')): ?><img src="__PUBLIC__/images/icons/exclamation.png" />
							<?php else: ?>
								<img class="ajax_set" columnname="is_excel_in" rowid="<?php echo ($vo["tab_col_id"]); ?>" val="<?php echo ($vo["is_excel_in"]); ?>" src="__PUBLIC__/images/status<?php echo ($vo["is_excel_in"]); ?>.png" /><?php endif; ?>
						</span>
						
						<span  class="drag_span">
							<?php if(($vo["column_type"] == 'date_range') OR ($vo["column_type"] == 'date_time_range') OR ($vo["column_type"] == 'primaryKey') OR ($vo["column_type"] == 'multiPic') OR ($vo["column_type"] == 'edictor') OR ($vo["column_type"] == 'checkedbox') OR ($vo["column_type"] == 'file') OR ($vo["column_type"] == 'multiErea') OR ($vo["column_type"] == 'singlePic')): ?><img src="__PUBLIC__/images/icons/exclamation.png" />
							<?php else: ?>
							<img class="ajax_set" columnname="is_excel_empty_in" rowid="<?php echo ($vo["tab_col_id"]); ?>" val="<?php echo ($vo["is_excel_empty_in"]); ?>" src="__PUBLIC__/images/status<?php echo ($vo["is_excel_empty_in"]); ?>.png" /><?php endif; ?>
						</span>
						
						<span  class="drag_span">
							<?php if(($vo["column_type"] == 'date_range') OR ($vo["column_type"] == 'date_time_range') OR ($vo["column_type"] == 'primaryKey') OR ($vo["column_type"] == 'multiPic') OR ($vo["column_type"] == 'edictor') OR ($vo["column_type"] == 'checkedbox') OR ($vo["column_type"] == 'file') OR ($vo["column_type"] == 'multiErea') OR ($vo["column_type"] == 'singlePic')): ?><img src="__PUBLIC__/images/icons/exclamation.png" />
							<?php else: ?>
							<img class="ajax_set" columnname="is_excel_match" rowid="<?php echo ($vo["tab_col_id"]); ?>" val="<?php echo ($vo["is_excel_match"]); ?>" src="__PUBLIC__/images/status<?php echo ($vo["is_excel_match"]); ?>.png" /><?php endif; ?>
						</span>
						
						
						
						<span  class="drag_span">
							<?php if(($vo["column_type"] == 'primaryKey') OR ($vo["column_type"] == 'multiErea') OR ($vo["column_type"] == 'multiPic') OR ($vo["column_type"] == 'edictor') OR ($vo["column_type"] == 'checkedbox') OR ($vo["column_type"] == 'file') OR ($vo["column_type"] == 'date_range') OR ($vo["column_type"] == 'date_time_range')): ?><img src="__PUBLIC__/images/icons/exclamation.png" />
							<?php else: ?>
								<select class="ajax_set_options" name="excel_match_method" tab_col_id="<?php echo ($vo["tab_col_id"]); ?>" >
									<?php if($vo["excel_match_method"] == 'eq'): endif; ?>
									<option value="">匹配方式</option>
									<option value="eq" <?php if($vo["excel_match_method"] == 'eq'): ?>selected="true"<?php endif; ?> >-eq-</option>
									<option value="like" <?php if($vo["excel_match_method"] == 'like'): ?>selected="true"<?php endif; ?> >-like-</option>
								</select><?php endif; ?>
							
						</span>
						
						<span  class="drag_span">
							<?php if(($vo["column_type"] == 'primaryKey') OR ($vo["column_type"] == 'multiErea') OR ($vo["column_type"] == 'multiPic') OR ($vo["column_type"] == 'edictor') OR ($vo["column_type"] == 'checkedbox') OR ($vo["column_type"] == 'file') OR ($vo["column_type"] == 'date_range') OR ($vo["column_type"] == 'date_time_range')): ?><img src="__PUBLIC__/images/icons/exclamation.png" />
							<?php else: ?>
								<select class="ajax_set_options" name="excel_match_logic" tab_col_id="<?php echo ($vo["tab_col_id"]); ?>" >
									<option value="">匹配逻辑</option>
									<option value="AND" <?php if($vo["excel_match_logic"] == 'AND'): ?>selected="true"<?php endif; ?> >-AND-</option>
									<option value="OR" <?php if($vo["excel_match_logic"] == 'OR'): ?>selected="true"<?php endif; ?> >-OR-</option>
								</select><?php endif; ?>
						</span>
						
						<span  class="drag_span">
							<?php if(($vo["column_type"] == 'primaryKey') OR ($vo["column_type"] == 'multiErea') OR ($vo["column_type"] == 'multiPic') OR ($vo["column_type"] == 'edictor') OR ($vo["column_type"] == 'checkedbox') OR ($vo["column_type"] == 'file') OR ($vo["column_type"] == 'date_range') OR ($vo["column_type"] == 'date_time_range')): ?><img src="__PUBLIC__/images/icons/exclamation.png" />
							<?php else: ?>
								<a href="<?php echo U('Model/table_excel_in_map',array('tab_col_id'=>$vo['tab_col_id']));?>">导入映射</a><?php endif; ?>
						</span>
						
						
						<span  class="drag_span">
							<?php if(($vo["column_type"] == 'date_range') OR ($vo["column_type"] == 'date_time_range') OR ($vo["column_type"] == 'primaryKey') OR ($vo["column_type"] == 'multiPic') OR ($vo["column_type"] == 'edictor') OR ($vo["column_type"] == 'checkedbox') OR ($vo["column_type"] == 'file') OR ($vo["column_type"] == 'multiErea') OR ($vo["column_type"] == 'singlePic')): ?><img src="__PUBLIC__/images/icons/exclamation.png" />
							<?php else: ?>
							<img class="ajax_set" columnname="is_excel_out" rowid="<?php echo ($vo["tab_col_id"]); ?>" val="<?php echo ($vo["is_excel_out"]); ?>" src="__PUBLIC__/images/status<?php echo ($vo["is_excel_out"]); ?>.png" /><?php endif; ?>
						</span>
						
						<span  class="drag_span">
							<?php if(($vo["column_type"] == 'primaryKey') OR ($vo["column_type"] == 'multiErea') OR ($vo["column_type"] == 'multiPic') OR ($vo["column_type"] == 'edictor') OR ($vo["column_type"] == 'checkedbox') OR ($vo["column_type"] == 'file') OR ($vo["column_type"] == 'date_range') OR ($vo["column_type"] == 'date_time_range')): ?><img src="__PUBLIC__/images/icons/exclamation.png" />
							<?php else: ?>
								<a href="<?php echo U('Model/table_excel_out_map',array('tab_col_id'=>$vo['tab_col_id']));?>">导出映射</a><?php endif; ?>
						</span>
					</div><?php endforeach; endif; ?>
				</div>
				

	
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
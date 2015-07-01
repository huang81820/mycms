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
					
	<h3>搜索器设置</h3>
	
	
	<div class="clear"></div>
</div> 
				
				
<div class="content-box-content CM_boxList">
	
	<div class="tab-content default-tab" id="tab1">
					
		
		<form action="__APP__/Model/set_search_option" method="post">			
		<table>
			<thead>
				<tr>
					
					
					<td>列名</td>
					<td>列类型</td>
					

					<td>匹配方式</td>


				</tr>
			</thead>
			<tbody>
				
			<?php if(is_array($search_column)): foreach($search_column as $key=>$vo): ?><tr>
					
					
					<td><?php echo ($vo["column_name"]); ?></td>
					<td><?php echo ($vo["column_type"]); ?></td>
				


					<td>
						<input type="hidden" value="<?php echo ($vo["tab_col_id"]); ?>+<?php echo ($vo["column_type"]); ?>" name="tab_col_id[]" />
					<?php if($vo["column_type"] == 'singleErea' ): ?><select name="match_method_<?php echo ($vo["tab_col_id"]); ?>">
							<?php if(is_array($search_option)): foreach($search_option as $key2=>$vo2): if( $vo['tab_col_id'] == $vo2['tab_col_id']) { $select_option = $vo2['match']; } endforeach; endif; ?>
							<option value="="    <?php if($select_option == 'eq'): ?>selected="true"<?php endif; ?>  >=</option>
							<option value="like" <?php if($select_option == 'like'): ?>selected="true"<?php endif; ?>>like</option>
							<option value="<"    <?php if($select_option == 'lt'): ?>selected="true"<?php endif; ?>  >></option>
							<option value=">"    <?php if($select_option == 'gt'): ?>selected="true"<?php endif; ?>  ><</option>
						</select><?php endif; ?>
					
					<?php if($vo["column_type"] == 'foreignKey' ): if(is_array($search_option)): foreach($search_option as $key2=>$vo2): if( $vo['tab_col_id'] == $vo2['tab_col_id']) { $is_defaule_search = $vo2['is_defaule_search']; } endforeach; endif; ?>
						默认搜索：&nbsp;&nbsp;
						是:&nbsp;<input type="radio" name="is_defaule_search" value="1" <?php if($is_defaule_search == '1' ): ?>checked="true"<?php endif; ?> />&nbsp;
						否:&nbsp;<input type="radio" name="is_defaule_search" value="0" <?php if($is_defaule_search == '0' ): ?>checked="true"<?php endif; ?> <?php if($is_defaule_search == '' ): ?>checked="true"<?php endif; ?> /><?php endif; ?>
						 
					</td>
				</tr><?php endforeach; endif; ?>
			
				<tr>
					<td colspan="3" style="text-align:center">
						<input type="hidden" value="<?php echo ($table_id); ?>" name="table_id" /> 
						<input type="submit" class="button" /> 
						
						
					</td>
				</tr>
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
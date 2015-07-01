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
.myclear{ clear:both}
</style>

<script>
$(document).ready(function(){
	
	
	
	$('table').delegate('.DD_ADD_LIST_params','click',function(){
		
		var row_index = $(this).attr('row_index');
		var input_wrap = $(this).parent().parent().find('.DD_ADD_LIST_PARAM_WRAP');
		
		
		var options = '<?php if(is_array($all_column)): foreach($all_column as $key=>$vo): ?><option value="<?php echo ($vo["column_name"]); ?>"><?php echo ($vo["column_name"]); ?></option><?php endforeach; endif; ?>';	
		
		var str='';
		str += '<select class="list_params_select_class" name="other_params_value_'+row_index+'[]" >';
		str += '<option value="0">无</option>';
		str += options;
		str += '</select><div class="myclear"></div>';
		input_wrap.append(str);
	});
	
	
	$('table').delegate('.DD_DEL_LIST_params','click',function(){
		
		var select = $(this).parent().parent().find('.list_params_select_class').last();
		
		select.remove();
		
	});
	
	
	
	
	$('#DD_DEL_LIST_params').click(function(){
		var last = $(this).parent().parent().find('select[name="other_params_value[]"]').last();
		
		//alert(br.length);
		
		if(  $('.list_params_select_class').length>1   ){
			last.remove();
		}
		
	});
	
	$('#DD_ADD_LIST_button').click(function(){
		
		var now_index = $('.list_button_row_active').length;
	//alert(now_index);
		var html = $('#list_button_row').html();
		var str='';
		str+='<tr class="list_button_row_active">';
		str+=html;
		str+='</tr>';
		
		$('#list_button_table tbody').append(str);
		
		//alert($('.list_button_row_active').length);
		$('.list_button_row_active').last().find('.DD_ADD_LIST_params').attr('row_index',now_index);
		$('.list_button_row_active').last().find('.DD_DEL_LIST_params').attr('row_index',now_index);
		
	});
	$('#DD_DEL_LIST_button').click(function(){
		$('.list_button_row_active').last().remove();
	});
	
	$('#list_button_table').delegate('.DD_DEL_button','click',function(){
		if(confirm('你确认删除该按钮？')){
		
			$(this).parent().parent().remove();
		}
	})
	
});



</script>


<div class="content-box-header CM_header" >
					
	<h3>联动菜单列表</h3>
	
	<ul id="my_tab">
		<li><a id="" href="#" ></a></li>
		
		
		
		
	</ul>
	<div class="clear"></div>
</div> 
								
<div class="content-box-content">
	
	<div class="tab-content default-tab" id="tab1">
					
		
		<hr/>
					
				

					
		<form action="__APP__/Model/do_edit_list_attr" method="post">			
		<table id="list_button_table">

			

					<thead>
						<tr>
							
							
							
							<td>列名</td>
							<td>列类型</td>
							

							<td colspan='2'>操作</td>
							

						</tr>
					</thead>
					<tbody>
						
					<?php if(is_array($list_column)): foreach($list_column as $key=>$vo): ?><tr>
							
							
							<td><?php echo ($vo["column_name"]); ?></td>
							<td><?php echo ($vo["column_type"]); ?></td>
							
						
			
			
							<td colspan="2" >
								<?php if(($vo["column_type"] == 'singleErea') OR ($vo["column_type"] == 'multiErea') OR ($vo["column_type"] == 'edictor')): ?>长度：<input class="singleErea" type="text" name="list_congif[]" value="<?php echo ($vo["list_attr"]); ?>"/> 
											<input type="hidden" name="column_ids[]" value="<?php echo ($vo["tab_col_id"]); ?>"/><?php endif; ?>
							
								<?php if(($vo["column_type"] == 'date') OR ($vo["column_type"] == 'date_time') OR ($vo["column_type"] == 'date_range')OR ($vo["column_type"] == 'date_time_range')): ?>格式：<input class="singleErea" type="text" name="list_congif[]"  value="<?php echo ($vo["list_attr"]); ?>"/>	
									<input type="hidden" name="column_ids[]" value="<?php echo ($vo["tab_col_id"]); ?>"/><?php endif; ?>
														
							</td>
							
						</tr><?php endforeach; endif; ?>
					
					<tr>
						<td colspan="3" style="text-align:center">操作按钮
							<span id="DD_ADD_LIST_button" style="color:red; cursor:pointer">[ + ]</span>
							<span id="DD_DEL_LIST_button" style="color:green; cursor:pointer">[ - ]</span>
						</td>
						<td>删除</td>
					</tr>
					
					<?php if(is_array($table_button)): foreach($table_button as $key_row=>$vo): ?><tr class="list_button_row_active" style="-display:none">				
						<td>按钮名称:<input class="singleErea" type="text" name="list_button_name[]" value="<?php echo ($vo["desc"]); ?>"/></td>
						<td colspan="1">
							按钮连接:  <input class="singleErea" type="text" name="list_button_href[]"  value="<?php echo ($vo["href"]); ?>" />
							
						</td>
						<td colspan="1">
							<div style="float:left">
								<span class="DD_ADD_LIST_params" style="color:red; cursor:pointer" row_index="<?php echo ($key_row); ?>">[ + ]</span>
								<span class="DD_DEL_LIST_params" style="color:green; cursor:pointer" row_index="<?php echo ($key_row); ?>" >[ - ]</span>值:
							</div>
							
							<div style="float:left" class="DD_ADD_LIST_PARAM_WRAP">
									<?php if(is_array($vo["otherParams"])): foreach($vo["otherParams"] as $key2=>$vo2): ?><select class="list_params_select_class" name="other_params_value_<?php echo ($key_row); ?>[]"  >
											<option value="0">无</option>
											<?php if(is_array($all_column)): foreach($all_column as $key=>$vo3): ?><option value="<?php echo ($vo3["column_name"]); ?>" <?php if($vo2["value"] == $vo3["column_name"] ): ?>selected="true"<?php endif; ?> ><?php echo ($vo3["column_name"]); ?></option><?php endforeach; endif; ?>								
									</select>
									<div class="myclear"></div><?php endforeach; endif; ?>	
									
								
							</div>	
							
						</td>
						<td >
							<a class="DD_DEL_button" href="#" style="color:blue; cursor:pointer;font-weight:400;" >[ - ]</a>
						</td>

					</tr><?php endforeach; endif; ?>
					
					
					</tbody>
					<tfoot>
						<tr>
							<td colspan="4" style="text-align:center">
								<input type="submit" value="提交" class="button"/>
								<input type="hidden" name="table_id" value="<?php echo ($table_id); ?>"/>
							</td>
						</tr>
					
					</tfoot>
		</table>
		</form>
	</div>
</div>
		<table style="display:none">
			<tr id="list_button_row" >				
				<td>按钮名称:<input class="singleErea" type="text" name="list_button_name[]"/></td>
				<td colspan="1">
					按钮连接:  <input class="singleErea" type="text" name="list_button_href[]"  />
					
				</td>
				<td colspan="1">
					<div style="float:left">
						<span class="DD_ADD_LIST_params" style="color:red; cursor:pointer">[ + ]</span>
						<span class="DD_DEL_LIST_params" style="color:green; cursor:pointer">[ - ]</span>值:
					</div>
					
					<div style="float:left" class="DD_ADD_LIST_PARAM_WRAP">
						<!--
							<select class="list_params_select_class" name="other_params_value[]"  >
									<option value="0">无</option>
									<?php if(is_array($all_column)): foreach($all_column as $key=>$vo): ?><option value="<?php echo ($vo["column_name"]); ?>"><?php echo ($vo["column_name"]); ?></option><?php endforeach; endif; ?>								
							</select>
							
							<div class="myclear"></div>
						-->
					</div>	
					
				</td>
				
				<td >
					<a class="DD_DEL_button" href="#" style="color:blue; cursor:pointer;font-weight:400;" >[ - ]</a>
				</td>
			</tr>
		</table>				
		
						
				</div>

			<div class="clear"></div>
		
		</div> 

	</div>
	
</body>
</html>
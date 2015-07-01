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
.DD_ACTIVE_LAYER{display:none}
table tr td{border:1px solid #dddddd}
</style>


<script>
$(document).ready(function(){

	//根据表单类型显示相应输入项
	$('select[name=column_type]').change(function(){
		var column_type = $(this).attr('value');
		$('.DD_ACTIVE_LAYER').hide();
		switch( column_type )
		{
			case 'select':
				
				$('.DD_SELECT_LAYER').show();
				break;
			case 'lianDong':
				
				$('.DD_SELECT_LAYER').show();
				break;
				
			case 'multiPic':
				
				$('.DD_MPIC_LAYER').show();
				break;
			case 'radio':
				
				$('.DD_RADIO_LAYER').show();
				break;
			case 'checkedbox':
				
				$('.DD_CHECKBOX_LAYER').show();
				break;
				
				
			case 'special':
			
				$('.DD_SPECIAL_LAYER').show();
				break;
				
			case 'hidden_date':
				
				$('.DD_HIDDENDATE_LAYER').show();
				break;
			case 'foreignKey':
				  
				$('.DD_FOREIGNKEY_LAYER').show();
				break;
		}
		
	});
	
	//下拉表单事件的闭包
	(function(){
		//添加键值组
		$('#DD_ADD_SELECT_STATIC_INPUT').click(function(){
			var input_wrap = $('#DD_SELECT_STATIC_INPUT');
			var str='';
			str += '<div class="DD_SELECT_STATIC_INPUT_WRAP">';
			str += '键：<input class="singleMinText" type="text" name="select_static_key[]" style="width:120px;" /> ';
			str += '值：<input class="singleMinText" type="text" name="select_static_value[]" style="width:120px;" /></br>';
			str += '</div>';
			input_wrap.append(str);
		});
	
		$('#DD_DEL_SELECT_STATIC_INPUT').click(function(){
			var last = $('.DD_SELECT_STATIC_INPUT_WRAP').last();
			if(  $('.DD_SELECT_STATIC_INPUT_WRAP').length>1   ){
				last.remove();
			}
			
		});
		
		//使用静态数据时 设置默认键值 
		$('input[name=selectType]').click(function(){
		alert( $(this).val());
			if( $(this).val() == 1 ){
				$('input[name=select_value_key]').val('value');
				$('input[name=select_value_desc]').val('desc');
			}
		});
		
	})();
	
	
	(function(){
		var input_type = "<?php echo ($inputType); ?>";
		if(input_type!=''){
			
			$('select[name=column_type]').val(input_type).trigger('change');
			
		}
		
	})();
	
	//多图片事件
	(function(){
		$('#DD_ADD_MPIC_STATIC_INPUT').click(function(){
			var input_wrap = $('#DD_MPIC_STATIC_INPUT');
			var str='';
			str += '<div class="DD_MPIC_STATIC_INPUT_WRAP">';
			str += '属性name：<input class="singleMinText" type="text"  name="mpic_attr_name[]" style="width:100px"/> &nbsp;&nbsp;';
			str += '属性提示：<input class="singleMinText" type="text"  name="mpic_attr_desc[]" style="width:100px"/> &nbsp;&nbsp;';
			
			str += '组件类型：<select class="selectArea" name="mpic_attr_type[]" style="width:100px"> ';
			str += '<option value="1">单行文本</option>   <option value="3">编辑器</option>	';
			str += '</select> &nbsp;&nbsp;';
			
			str += '排序：<input class="singleMinText" type="text" value="0" name="mpic_attr_sort[]" style="width:100px"/> ';
			str += '</div>';
			input_wrap.append(str);
			

		});
	
		$('#DD_DEL_MPIC_STATIC_INPUT').click(function(){
			var last = $('.DD_MPIC_STATIC_INPUT_WRAP').last();
			if(  $('.DD_MPIC_STATIC_INPUT_WRAP').length>1   ){
				last.remove();
			}
			
		});
		
	})();
	
	
	//radio相关处理
	(function(){
		$('#DD_ADD_RADIO_STATIC_INPUT').click(function(){
			var input_wrap = $('#DD_RADIO_STATIC_INPUT');
			var str='';
			str += '<div class="DD_RADIO_STATIC_INPUT_WRAP">';
			str += '键：<input class="singleMinText" type="text" name="radio_static_key[]" style="width:120px;" /> ';
			str += '值：<input class="singleMinText" type="text" name="radio_static_value[]" style="width:120px;" /></br>';
			str += '</div>';
			
			input_wrap.append(str);
		});
		
		$('#DD_DEL_RADIO_STATIC_INPUT').click(function(){
			var last = $('.DD_RADIO_STATIC_INPUT_WRAP').last();
			if(  $('.DD_RADIO_STATIC_INPUT_WRAP').length>1   ){
				last.remove();
			}
			
		});
		
	})();
	
	
	
	//checkbox相关处理
	(function(){
		$('#DD_ADD_CHECKBOX_STATIC_INPUT').click(function(){
			var input_wrap = $('#DD_CHECKBOX_STATIC_INPUT');
			var str='';
			str += '<div class="DD_CHECKOX_STATIC_INPUT_WRAP">';
			str += '键：<input class="singleMinText" type="text" name="checkbox_static_key[]" style="width:120px;" /> ';
			str += '值：<input class="singleMinText" type="text" name="checkbox_static_value[]" style="width:120px;" /></br>';
			str += '</div>';
			
			input_wrap.append(str);
		});
		
		$('#DD_DEL_CHECKBOX_STATIC_INPUT').click(function(){
			var last = $('.DD_CHECKOX_STATIC_INPUT_WRAP').last();
			if(  $('.DD_CHECKOX_STATIC_INPUT_WRAP').length>1   ){
				last.remove();
			}
			
		});
		
	})();
	
	//特殊字段
	
	(function(){
		$('#special_data_type').change(function(){
			var value=$(this).val();
			if(value=='INT'){
				$('#data_type_default_value').val('0');
			}
			if(value=='VARCHAR(500)'){
				$('#data_type_default_value').val('');
			}
			if(value=='TEXT'){
				$('#data_type_default_value').val('');
			}
		});
	})();
	
	//关联字段---
	(function(){
		$('#FOREIGNKEY_TABLES').change(function(){
			var table_name=$(this).val();
			$.post('__APP__/Model/AjaxGetTableColumn',{'table_name':table_name},function(data){
				$('#FOREIGNKEY_COLUMNS_WRAP').html(data);
			});
		});
	})();
});
</script>



<div class="content-box-header CM_header">
					
	<h3>
		<a href="<?php echo U('Model/table_column_list',array('table_id'=>$table['table_id']));?>">
			<font color="red">
				<?php echo ($table["table_name"]); ?>
			</font>
		</a>
		表添加字段
	</h3>
	
	<ul id="my_tab">
		<li><a id="" href="" ></a></li>
	</ul>
	<div class="clear"></div>
</div> 
				
				
<div class="content-box-content CM_boxList">
	
	<div class="tab-content default-tab" id="tab1">







		<form action="<?php echo U('Model/do_add_column');?>" method="post">
				
				<table>
					
					<tbody>
						
					
						
						
						<tr>
							<td>字段名称（英文）：</td>
							
							<td><input class="singleMinText" type="text" value="" name="column_name"/></td>

						</tr>
						<tr>
							<td>字段描述（中文）：</td>
							
							<td> <input class="singleMinText" type="text"  name="column_desc"/> </td>
						</tr>
						<tr>
							<td>添加显示：</td>
							
							<td>
								是：<input type="radio" value="1"  name="is_add" checked="true" />&nbsp;&nbsp;
								
								否：<input type="radio" value="0"  name="is_add"/>
							
							</td>
						</tr>
						
						<tr>
							<td>编辑显示：</td>
							
							<td>
								是：<input type="radio" value="1"  name="is_edit" checked="true" />&nbsp;&nbsp;
								
								否：<input type="radio" value="0"  name="is_edit"/>					
							</td>
						</tr>
						
				
						
						<tr>
							<td>输入帮助：</td>
							
							<td> <input class="singleMinText" type="text"  name="column_help"/> </td>
						</tr>
						
						<tr>
							<td>错误提示信息：</td>
							
							<td> <input class="singleMinText" type="text"  name="column_error_message"/> </td>
						</tr>
						
						<tr>
							<td>字段默认值：</td>
							
							<td> <input class="singleMinText" type="text"  name="column_default_value" value="" /> </td>
						</tr>
						
						
						
						
						<tr>
							<td>字段类型：</td>
							
							<td>
								<select class="selectArea" name="column_type">
									
									<option value="singleErea">单行文本</option>
									<option value="multiErea">多行文本</option>
									<option value="edictor">编辑器</option>
									<option value="foreignKey">关联外键</option>
									<option value="hidden">隐藏域</option>
									<option value="singlePic">单图片</option>
									<option value="multiPic">多图片</option>
									<option value="select">下拉列表</option>
									<option value="radio">单选按钮</option>
									<option value="date">日期</option>
									<option value="hidden_date">自动完成日期</option>
									<option value="date_time">日期时间</option>
									<option value="date_range">日期范围</option>							
									<option value="date_time_range">日期时间范围</option>
									<option value="checkedbox">多选按钮</option>
									<option value="special">特殊</option>
									<option value="session">全局值</option>
									<option value="file">文件上传</option>
									<option value="lianDong">联动菜单</option>
									
								</select>
							</td>
						</tr>
						
						<!--下拉列表-->
						<tr class="DD_SELECT_LAYER DD_ACTIVE_LAYER">
							<td>数据源：</td>
							
							<td>
								数据库：<input type="radio" value="0" name="selectType" checked="true"/>&nbsp;&nbsp;&nbsp;
								静态：<input type="radio" value="1" name="selectType"/>
								分类菜单：<input type="radio" value="2" name="selectType"/>
							</td>
						</tr>
						<tr class="DD_SELECT_LAYER DD_ACTIVE_LAYER">
							<td>键值对应：</td>
							
							<td>
								键：<input class="singleMinText" type="text"  name="select_value_key"/>&nbsp;&nbsp;&nbsp;
								值：<input class="singleMinText" type="text"  name="select_value_desc"/>&nbsp;&nbsp;&nbsp;
								父id名称：<input class="singleMinText" type="text"  name="select_value_parent"/>
							</td>
						</tr>
						<tr class="DD_SELECT_LAYER DD_ACTIVE_LAYER">
							<td>获取数据SQL:</td>
							
							<td>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input class="singleMinText" type="text" name="selectSQL" style="width:360px;" />
							</td>
						</tr>
						
						<tr class="DD_SELECT_LAYER DD_ACTIVE_LAYER">
							<td>静态数据:
								
								<span id="DD_ADD_SELECT_STATIC_INPUT" style="color:red; cursor:pointer">[ + ]</span>
							
								<span id="DD_DEL_SELECT_STATIC_INPUT" style="color:green; cursor:pointer">[ - ]</span>
							</td>
							
							<td id="DD_SELECT_STATIC_INPUT">
								<div class="DD_SELECT_STATIC_INPUT_WRAP">
									键：<input class="singleMinText" type="text" name="select_static_key[]" style="width:120px;" />
									值：<input class="singleMinText" type="text" name="select_static_value[]" style="width:120px;" /></br>
								</div>	
								
							</td>
						</tr>
						<tr class="DD_SELECT_LAYER DD_ACTIVE_LAYER">
							<td>分类菜单：</td>
							
							<td><?php echo ($CM_MenuList); ?></td>
						</tr>
						<!--结束下拉列表-->
						
						<!--多图片-->			
						<tr class="DD_MPIC_LAYER DD_ACTIVE_LAYER">
							<td>图片属性：
								
								<span id="DD_ADD_MPIC_STATIC_INPUT" style="color:red; cursor:pointer">[ + ]</span>
							
								<span id="DD_DEL_MPIC_STATIC_INPUT" style="color:green; cursor:pointer">[ - ]</span>
							</td>
							
							<td id="DD_MPIC_STATIC_INPUT">
							
								
									<div class="DD_MPIC_STATIC_INPUT_WRAP">
										属性name：<input class="singleMinText" type="text"  name="mpic_attr_name[]" style="width:100px" value="name" />&nbsp;&nbsp;
										属性提示：<input class="singleMinText" type="text"  name="mpic_attr_desc[]" style="width:100px" value="图片名称" />&nbsp;&nbsp;
										
										组件类型：<select class="selectArea" name="mpic_attr_type[]" style="width:100px">
														<option value="1">单行文本</option>
														<option value="3">编辑器</option>							
													</select>&nbsp;&nbsp;
										排序：<input class="singleMinText" type="text" value="0" name="mpic_attr_sort[]" style="width:100px"/><br>
										
										属性name：<input class="singleMinText" type="text"  name="mpic_attr_name[]" style="width:100px" value="alt" />&nbsp;&nbsp;
										属性提示：<input class="singleMinText" type="text"  name="mpic_attr_desc[]" style="width:100px" value="图片ALT"/>&nbsp;&nbsp;
										
										组件类型：<select class="selectArea" name="mpic_attr_type[]" style="width:100px">
														<option value="1">单行文本</option>
														<option value="3">编辑器</option>							
													</select>&nbsp;&nbsp;
										排序：<input class="singleMinText" type="text" value="1" name="mpic_attr_sort[]" style="width:100px"/><br>
										
										属性name：<input class="singleMinText" type="text"  name="mpic_attr_name[]" style="width:100px" value="sort" />&nbsp;&nbsp;
										属性提示：<input class="singleMinText" type="text"  name="mpic_attr_desc[]" style="width:100px" value="图片排序" />&nbsp;&nbsp;
										
										组件类型：<select class="selectArea" name="mpic_attr_type[]" style="width:100px">
														<option value="1">单行文本</option>
														<option value="3">编辑器</option>							
													</select>&nbsp;&nbsp;
										排序：<input class="singleMinText" type="text" value="2" name="mpic_attr_sort[]" style="width:100px"/><br>
										
										属性name：<input class="singleMinText" type="text"  name="mpic_attr_name[]" style="width:100px" value="href" />&nbsp;&nbsp;
										属性提示：<input class="singleMinText" type="text"  name="mpic_attr_desc[]" style="width:100px" value="图片链接" />&nbsp;&nbsp;
										
										组件类型：<select class="selectArea" name="mpic_attr_type[]" style="width:100px">
														<option value="1">单行文本</option>
														<option value="3">编辑器</option>							
													</select>&nbsp;&nbsp;
										排序：<input class="singleMinText" type="text" value="3" name="mpic_attr_sort[]" style="width:100px"/><br>
										
										属性name：<input class="singleMinText" type="text"  name="mpic_attr_name[]" style="width:100px" value="content" />&nbsp;&nbsp;
										属性提示：<input class="singleMinText" type="text"  name="mpic_attr_desc[]" style="width:100px" value="图片描述" />&nbsp;&nbsp;
										
										组件类型：<select class="selectArea" name="mpic_attr_type[]" style="width:100px">
														<option value="1">单行文本</option>
														<option value="3" selected="selected" >编辑器</option>							
													</select>&nbsp;&nbsp;
										排序：<input class="singleMinText" type="text" value="4" name="mpic_attr_sort[]" style="width:100px"/><br>
									</div>	
								
							
							</td>
						</tr>
						<!--结束多图片-->
						
						
						
						<!--radio-->			
						<tr class="DD_RADIO_LAYER DD_ACTIVE_LAYER">
							<td>静态数据：
								
								<span id="DD_ADD_RADIO_STATIC_INPUT" style="color:red; cursor:pointer">[ + ]</span>
							
								<span id="DD_DEL_RADIO_STATIC_INPUT" style="color:green; cursor:pointer">[ - ]</span>
							</td>
							
							<td id="DD_RADIO_STATIC_INPUT">
							
							
								<div class="DD_RADIO_STATIC_INPUT_WRAP">
									键：<input class="singleMinText" type="text" name="radio_static_key[]" style="width:120px;" />
									值：<input class="singleMinText" type="text" name="radio_static_value[]" style="width:120px;" /></br>
								</div>
							
							
							</td>
						</tr>
						<!--结束radio-->
						
						
						<!--checkedbox-->	

						<tr class="DD_CHECKBOX_LAYER DD_ACTIVE_LAYER">
							<td>数据源：</td>
							
							<td>
								数据库：
								<input type="radio" value="0" name="checkboxType" <?php if($inputInfo['column_attrs']['type'] ==0) echo 'checked=true';?>/>&nbsp;&nbsp;&nbsp;
								静态：
								<input type="radio" value="1" name="checkboxType" <?php if($inputInfo['column_attrs']['type'] ==1) echo 'checked=true';?>/>
							</td>
						</tr>
						<tr class="DD_CHECKBOX_LAYER DD_ACTIVE_LAYER">
							<td>键值对应：</td>
							
							<td>
								键：<input class="singleMinText" type="text"  name="checkbox_value_key"  value="<?php echo ($inputInfo["column_attrs"]["value_key"]); ?>"/>&nbsp;&nbsp;&nbsp;
								值：<input class="singleMinText" type="text"  name="checkbox_value_desc" value="<?php echo ($inputInfo["column_attrs"]["value_desc"]); ?>"/>
							</td>
						</tr>
						<tr class="DD_CHECKBOX_LAYER DD_ACTIVE_LAYER">
							<td>获取数据SQL:</td>
							
							<td>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input class="singleMinText" type="text" name="checkboxSQL" style="width:360px;" value="<?php echo ($inputInfo["column_attrs"]["data_sql"]); ?>"/>
							</td>
						</tr>
						
						
						<tr class="DD_CHECKBOX_LAYER DD_ACTIVE_LAYER">
							<td>静态数据：
								
								<span id="DD_ADD_CHECKBOX_STATIC_INPUT" style="color:red; cursor:pointer">[ + ]</span>
							
								<span id="DD_DEL_CHECKBOX_STATIC_INPUT" style="color:green; cursor:pointer">[ - ]</span>
							</td>
							
							<td id="DD_CHECKBOX_STATIC_INPUT">
							
							<?php foreach($inputInfo['column_attrs']['lists'] as $key=>$val) {?>	
								
							<?php } ?>
							<div class="DD_CHECKOX_STATIC_INPUT_WRAP">
								键：<input class="singleMinText" type="text" name="checkbox_static_key[]" style="width:120px;" value="<?php echo $val['value']?>"/>
								值：<input class="singleMinText" type="text" name="checkbox_static_value[]" style="width:120px;" value="<?php echo $val['desc']?>"/></br>
							</div>
							
							</td>
						</tr>
						<!--结束checkedbox-->
						
						
						<!--
							特殊字段
						-->
						<tr class="DD_SPECIAL_LAYER DD_ACTIVE_LAYER">
							<td>数据类型:</td>
							
							<td>
								<select id="special_data_type" class="selectArea" name="data_type" >
									
									<option value="INT">---INT---</option>
									<option value="VARCHAR(500)">---VARCHAR(500)---</option>
									<option value="TEXT">---TEXT---</option>
								</select>
								默认值：<input class="singleMinText" id="data_type_default_value" type="text" name="data_type_default_value" value="0" />
							</td>
						</tr>
						
						
						<!--
							隐藏式日期
						-->
						<tr class="DD_HIDDENDATE_LAYER DD_ACTIVE_LAYER">
							<td>是否在修改同时更改:</td>
							
							<td>
								是：<input type="radio" name="hidden_time_is_synchronization" />
								否：<input type="radio" name="hidden_time_is_synchronization" checked="true" />
							</td>
						</tr>
						
						
						<!--
							关联外键
						-->
						<tr class="DD_FOREIGNKEY_LAYER DD_ACTIVE_LAYER">
							<td>关联的表信息:</td>
							
							<td>
								<select name="foreignKey_table" id="FOREIGNKEY_TABLES" class="selectArea" style="float:left">
									<option value="0">---关联表---</option>
									<?php foreach($allTables as $singleTable){ ?>
										<option value="<?php echo $singleTable['table_name'] ?>"><?php echo $singleTable['table_name'] ?></option>
									<?php } ?>
								</select>
								
								<div id="FOREIGNKEY_COLUMNS_WRAP" style="float:left; margin-left:20px;"></div>
								
							</td>
						</tr>
						
						<!--开始联动菜单-->
						
						
						
						<!--结束联动菜单-->
						
						
						<tr>
							<td>是否需要验证：</td>
							
							<td>
								是：<input type="radio" name="is_validate" value="1" />
								否：<input type="radio" name="is_validate" value="0" checked="true" />
							</td>
						</tr>
						
						<tr>
							<td>长度验证：</td>
							
							<td>
								最小：<input class="singleMinText" style="width:120px;" type="text" name="min_length" value="0" />
								最大：<input class="singleMinText" style="width:120px;" type="text" name="max_length" value="999999" />
							</td>
						</tr>
						
						<tr>
							<td>正则验证：</td>
							
							<td>
								<select class="selectArea" name="validate_regexp">
									<option value="0">---请选择验证类型---</option>
									
									<option value="notempty">非空</option>
									<option value="username">用户注册,匹配由数字、26个英文字母或者下划线</option>
									<option value="date_time">日期时间</option>
									<option value="email">邮件</option>
									<option value="mobile">手机</option>
									<option value="intege">整数</option>
									<option value="intege1">正整数</option>
									<option value="num1">正数（正整数 + 0）</option>
									<option value="num">数字</option>
									
									<option value="idcard">身份证</option>
									<option value="letter">字母</option>
									
									<option value="num2">负数（负整数 + 0）</option>
									<option value="intege2">负整数</option>
									<option value="decmal">浮点数</option>
									<option value="decmal1">正浮点数</option>
									<option value="decmal2">负浮点数</option>
									
									
									<option value="decmal3">浮点数</option>
									<option value="decmal4">非负浮点数（正浮点数 + 0）</option>
									
									<option value="url">url</option>
									<option value="chinese">仅中文</option>
									<option value="zipcode">邮编</option>
									
									<option value="ip4">ip地址</option>
									
									<option value="date">日期</option>
									
									<option value="qq">QQ号码</option>
									<option value="tel">电话号码的函数(包括验证国内区号,国际区号,分机号)</option>
									
									
									<option value="letter_u">大写字母</option>
									<option value="letter_l">小写字母</option>
									
									
								</select>
							</td>
						</tr>
						
						
						
						
						
						
						<tr >
							<td></td>
							<td><input class="button" type="submit"  value="提交"/> </td>
							
							<input type="hidden" name="table_id" value="<?php echo ($table['table_id']); ?>"/>
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
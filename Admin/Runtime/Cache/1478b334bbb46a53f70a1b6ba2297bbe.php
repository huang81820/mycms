<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

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

<script>
	$(document).ready(function(){
		(function(){
			var input_type = "<?php echo ($inputType); ?>";
			if(input_type!=''){			
				$('select[name=column_type]').val(input_type);			
			}		
		})();
		
			//选中正则类型
		
		(function(){
			var input_type = "<?php echo ($inputInfo["validate_regexp"]); ?>";
			if(input_type!=''){			
				$('select[name="validate_regexp"]').val(input_type);			
			}		
		})();
	});
</script>


<div class="content-box-header CM_header ">
					
	<h3>
		<a href="<?php echo U('Model/table_column_list',array('table_id'=>$table['table_id']));?>">
			<font color="red"><?php echo ($table["table_name"]); ?> </font>
		</a>--表的字段--
		
		<font color="red"><?php echo ($inputInfo["column_type"]); ?></font>--修改				

	</h3>
	
	<ul id="my_tab">
		<li><a id="" href="<?php echo U('Model/add_table_column',array('table_id'=>$table['table_id']));?>" ></a></li>
	</ul>
	<div class="clear"></div>
</div> 
				
				
<div class="content-box-content CM_boxList">
	
	<div class="tab-content default-tab" id="tab1">
	
		<form action="<?php echo U('Model/do_edit_column');?>" method="post">
		<table class="">			
			<tbody>			
				<tr>
					<td>字段名称（英文abc）：</td>
					
					<td><input class="singletext" type="text" value="<?php echo ($inputInfo["column_name"]); ?>" name="column_name" readonly/></td>

				</tr>
				<tr>
					<td>字段描述（中文）：</td>
					
					<td> <input class="singletext" type="text"  name="column_desc" value="<?php echo ($inputInfo["column_desc"]); ?>"/> </td>
				</tr>
				<tr>
					<td>添加显示：</td>
					
					<td>
						是<input type="radio" value="1"  name="is_add"  <?php if($inputInfo["is_add"] == 1): ?>checked="true"<?php endif; ?>  />&nbsp;&nbsp;
						
						否<input type="radio" value="0"  name="is_add"  <?php if($inputInfo["is_add"] == 0): ?>checked="true"<?php endif; ?>/>
					
					</td>
				</tr>
				
				<tr>
					<td>编辑显示：</td>
					
					<td>
						是<input type="radio" value="1"  name="is_edit" <?php if($inputInfo["is_edit"] == 1): ?>checked="true"<?php endif; ?>/>&nbsp;&nbsp;
						
						否<input type="radio" value="0"  name="is_edit" <?php if($inputInfo["is_edit"] == 0): ?>checked="true"<?php endif; ?>/>					
					</td>
				</tr>
				

				
				<tr>
					<td>输入帮助：</td>
					
					<td> <input class="singletext" type="text"  name="column_help"  value="<?php echo ($inputInfo["column_help"]); ?>"/> </td>
				</tr>
				
				<tr>
					<td>错误提示信息：</td>
					
					<td> <input class="singletext" type="text"  name="column_error_message"  value="<?php echo ($inputInfo["column_error_message"]); ?>"/> </td>
				</tr>
				
				<tr>
					<td>字段默认值：</td>
					
					<td> <input class="singleMinText" type="text"  name="column_default_value" value="<?php echo ($inputInfo["column_default_value"]); ?>" /> </td>
				</tr>
				
				<tr>
					<td>字段排序：</td>
					
					<td> <input class="singleMinText" type="text"  name="column_sort" value="<?php echo ($inputInfo["column_sort"]); ?>" /> </td>
				</tr>
				
				
				<tr>
					<td>字段类型：</td>
					
					<td>
						<select class="selectArea" name="column_type"  onfocus="this.defOpt=this.selectedIndex" onchange="this.selectedIndex=this.defOpt;">
							
							<option value="singleErea">单行文本</option>
							<option value="multiErea">多行文本</option>
							<option value="edictor">编辑器</option>
							<option value="hidden">隐藏域</option>
							<option value="singlePic">单图片</option>
							<option value="multiPic">多图片</option>
							<option value="select">下拉列表</option>
							<option value="radio">单选按钮</option>
							<option value="date">日期</option>
							<option value="date_time">日期时间</option>
							<option value="date_range">日期范围</option>
							<option value="checkedbox">多选按钮</option>
							<option value="file">文件上传</option>
							<option value="lianDong">联动菜单</option>
							
						</select>
					</td>
				</tr>
				
				
				<tr>
					<td>是否需要验证：</td>
					
					<td>
						是：<input type="radio" name="is_validate" value="1" <?php if($inputInfo["is_validate"] == 1): ?>checked="true"<?php endif; ?>  />
						否：<input type="radio" name="is_validate" value="0" <?php if($inputInfo["is_validate"] == 0): ?>checked="true"<?php endif; ?>  />
					</td>
				</tr>
				
				<tr>
					<td>长度验证：</td>
					
					<td>
						最小：<input class="singleMinText" style="width:120px;" type="text" name="min_length" value="<?php echo ($inputInfo["min_length"]); ?>" />
						最大：<input class="singleMinText" style="width:120px;" type="text" name="max_length" value="<?php echo ($inputInfo["max_length"]); ?>" />
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
					<td>操作：</td>
					<td >
					
					<input type="hidden" name="tab_col_id" value="<?php echo ($inputInfo["tab_col_id"]); ?>"/>
					<input class="button" type="submit"  value="提交"/> 
					
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
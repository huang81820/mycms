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
					
					<h3>添加文章</h3>
					
					<ul id="my_tab">
						<li><a href="#" ></a></li>
								
					</ul>
					<div class="clear"></div>
				</div> 
			
			<form action="__APP__/Admin/updateAdmin_ok" method="POST" enctype="multipart/form-data"    >
				<div class="content-box-content add_type" >
					<table>
						<tbody>
							<tr>
								<td>所属用户组：</td>
								<td id="role_id">
									<select name="role_id">
										<option value=0 >---用户组---</option>
										<?php foreach($role_info as $val){ ?>
											<option value="<?php echo $val['id']; ?>" <?php if($val['id']==$admin_info['group_id']){echo 'selected=selected';} ?>  ><?php echo $val['name']; ?></option>	
										<?php } ?>
									</select>	
								</td>
								<td id="type" style="color:red">(必填)</td>
								</tr>
							<tr>
								<td>管理员用户名:</td>
								<td><input class="singleErea" type="text" name="user_name" value="<?php echo ($admin_info["user_name"]); ?>"  /></td>
								<td id="user_name" style="color:red">(必填)</td>
							</tr>
								
							<tr>
								<td>密码:</td>
								<td><input class="singleErea" type="password" name="password"  /></td>
								<td id="password" style="color:red">(必填)</td>
							</tr>
								
							<tr>
								<td>确认密码:</td>
								<td><input class="singleErea" type="password" name="password2"  /> </td>
								<td id="password2" style="color:red">(必填)</td>
							</tr>
								
							<tr>
								<td>状态:</td>
								<td><input id="checkbox" type="checkbox" name="state" <?php if($admin_info['state']==0){ echo 'checked';} ?> /></td>
								<td id="password2" style="color:red">(必填)</td>
							</tr>
							<input type="hidden" name="id" value="<?php echo ($admin_info["id"]); ?>" />		
							<tr>
								<td>操作:</td>
								<td><input class="button" style=" height:26px;" type="submit" value="确认添加" /></td>
								<td></td>
							</tr>	
						</tbody>	
					</table>
				</div>
			</form>
				
			</div>
			
			<div class="clear"></div>
			
			
			
		</div> 

	</div>
	
</body>
</html>
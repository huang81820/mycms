<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>内容管理中心</title>
<link rel="stylesheet" href="__PUBLIC__/css/style_login.css" type="text/css" media="screen" />

<script language="JavaScript">
 function fleshVerify(){ 
    
    var time = new Date().getTime();
    document.getElementById('verifyImg').src='__APP__/Escape/verify/'+time;
 }
 </script>
</head>
  <body id="login">
<div id="login-wrapper" class="png_bg" method="POST">
			<div id="login-top">
			<h1 style="color:white; display:block">内容管理中心</h1>
				<!-- Logo (221px width) -->
				<!--
				<img id="logo" src="__PUBLIC__/images/logo.png" alt="Simpla Admin logo" />
				-->
			</div> <!-- End #logn-top -->
			<div style="height:70px;margin:0 auto; width:100%; text-align:center; font-size:28px;">
			内容管理中心
			</div>

			<div id="login-content" style="padding-left:16px;">
				
				<form action="__APP__/Escape/checkLogin">
				
					
					
					<p>
						<label>用户名：</label>
						<input class="text-input" type="text" name="admin_name" style="border-radius: 4px;"/>
					</p>
					<div class="clear"></div>
					<p>
						<label>密码：</label>
						<input class="text-input" type="password" name="admin_pw" style="border-radius: 4px;" />
					</p>
					<div class="clear"></div>
					<p style="position: relative">
						<label>验证码：</label>
						<input class="text-input" type="'text'" name="verify"  style="border-radius: 4px;background-color: rgb(250, 255, 189);" />
						<img id="verifyImg" style="position:absolute; left:312px;height:25px; top:2px;" src='__APP__/Escape/verify/' onclick="fleshVerify()" />
					</p>
					<div class="clear"></div>
					
					
					<p>
						<input class="button" type="submit" value="&nbsp;&nbsp;登陆&nbsp;&nbsp;" style="float:right;border-radius: 4px; margin-right:37px;" />
					</p>
					
				</form>
			</div> <!-- End #login-content -->
			
		</div> <!-- End #login-wrapper -->

  </body>
</html>
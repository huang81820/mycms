<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo ($seo_title); ?></title>
<meta name="keywords" content="<?php echo ($seo_keywords); ?>" />
<meta name="description" content="<?php echo ($seo_description); ?>" />
<link href="__PUBLIC__/statics/default/css/styles.css" rel="stylesheet">
<link href="__PUBLIC__/statics/default/css/animation.css" rel="stylesheet">

<!-- 返回顶部调用 begin -->
<link href="__PUBLIC__/statics/default/css/view.css" rel="stylesheet">
<link href="__PUBLIC__/statics/default/css/lrtk.css" rel="stylesheet">
<link href="__PUBLIC__/statics/default/js/jquery.js" rel="stylesheet">
<link href="__PUBLIC__/statics/default/js/js.js" rel="stylesheet">

<!-- 返回顶部调用 end-->
<!--[if lt IE 9]>
<script src="js/modernizr.js"></script>
<![endif]-->
</head>
<body>
<header>
  <nav id="nav">
    <ul>
      <li><a <?php  if( ( !cat_id() ) &&( !id()) ){ echo 'style="color: #993333; background: rgba(20, 20, 20, 0.8); box-shadow: 0px 1px 0px rgba(255,255,255,.1), inset 0px 1px 1px rgba(0,0,0,.7); border-radius: 6px;"';} ?> href="<?php echo ($siteUrl); ?>" >首页</a></li>
	  <?php $cate = get_category(); ?>
	  <?php foreach($cate as $value){ ?>
	  <li><a <?php if($value['category_id']==cat_id()){ echo 'style="color: #993333; background: rgba(20, 20, 20, 0.8); box-shadow: 0px 1px 0px rgba(255,255,255,.1), inset 0px 1px 1px rgba(0,0,0,.7); border-radius: 6px;"';} ?> href="<?php echo (CAT_PATH); ?>/<?php echo ($value[category_id]); ?>" title="个人博客模板"><?php echo ($value['cat_name']); ?></a></li>
	  <?php } ?>
	  <li><a <?php if(19==cat_id()){ echo 'style="color: #993333; background: rgba(20, 20, 20, 0.8); box-shadow: 0px 1px 0px rgba(255,255,255,.1), inset 0px 1px 1px rgba(0,0,0,.7); border-radius: 6px;"';} ?> href="__APP__/Content/show_ex/cat_id/19" title="个人博客模板">案例</a></li>
    </ul>
    <script src="js/silder.js"></script><!--获取当前页导航 高亮显示标题--> 
  </nav>
</header>
<!--header end-->



<div id="mainbody">
  <div class="info">
    <figure> <img src="__PUBLIC__/statics/default/images/anli.jpg"  alt="Panama Hat">
      <figcaption><strong>渡人如渡己，渡已，亦是渡</strong> 当我们被误解时，会花很多时间去辩白。 但没有用，没人愿意听，大家习惯按自己的所闻、理解做出判别，每个人其实都很固执。与其努力且痛苦的试图扭转别人的评判，不如默默承受，给大家多一点时间和空间去了解。而我们省下辩解的功夫，去实现自身更久远的人生价值。其实，渡人如渡己，渡已，亦是渡人。</figcaption>
    </figure>
    <div class="card">
      <h1>我的名片</h1>
<p>网名：</p>
<p>职业：Web前端工程师，PHP工程师</p>
<p>电话：13425663554</p>
<p>Email：710735664@qq.com</p>
<ul class="linkmore">
	<li><a href="/" class="talk" title="给我留言"></a></li>
	<li><a href="/" class="address" title="联系地址"></a></li>
	<li><a href="/" class="email" title="给我写信"></a></li>
	<li><a href="/" class="photos" title="生活照片"></a></li>
	<li><a href="/" class="heart" title="关注我"></a></li>
</ul>


    </div>
  </div>
  <!--info end-->
  <div class="blank"></div>
  <div class="position">现在位置：<?php echo ($site_nav); ?></div>
  <div class="blogs">
	<?php foreach($ex_lists['lists'] as $val){ ?>
		<div class="viny" >
			<dl>
			  <dt class="art" style="background:none"><a href="<?php echo ($val['link']); ?>" target="_blank" ><img src="<?php echo ($val['thumb']); ?>" alt="<?php echo ($val['name']); ?>"></a></dt>
			  <dd>名称：<?php echo ($val['name']); ?></dd>
			  <dd>类型：<?php echo ($val['type']); ?></dd>
			  <dd>时间：<?php echo (date('Y-m-d',$val['time'])); ?></dd>
			</dl>
		</div>
	<?php  } ?>
	
	 
  </div>
  <!--blogs end--> 
</div>
<!--mainbody end-->
<footer >
  
  <div class="footer-bottom">
    <p><a href="#"></a></p>
  </div>
</footer>
<!-- jQuery仿腾讯回顶部和建议 代码开始 -->
<div id="tbox"> <a id="togbook" href="/e/tool/gbook/?bid=1"></a> <a id="gotop" href="javascript:void(0)"></a> </div>
<!-- 代码结束 -->
</body>
</html>
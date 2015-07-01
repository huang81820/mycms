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
    <figure> <img src="__PUBLIC__/statics/default/images/music.jpg"  alt="Panama Hat">
      <figcaption>
	  <strong>音乐</strong> 
	  
	  喜欢音乐，喜欢那熟悉的旋律陶醉我的性情。也喜欢流行音乐，看看那诗一般的歌词，一边听一边品味，就好像有个之心朋友在讲述一个动人的故事。
	  完全沉醉其中，仿佛自己就是故事的主人公，听着听着，思绪便随歌曲飞扬！ 
	  喜欢不同节奏的音乐带来的不同感受，喜欢这来自心灵深处的舞动独白。喜欢音乐，大概就是为了能更好地生活，在简单的生活中，
	  寻找自己的旋律，工作以后，音乐似乎也成了我生活中的不可缺少的一部分！
	  </figcaption>
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
	
   
    <!--bloglist end-->
    
		
      
      
      
      
      <div class="viny" >
        <dl>
          <dt class="art"><img src="__PUBLIC__/statics/default/images/artwork.png" alt="专辑"></dt>
          <dd class="icon-song"><span></span>南方姑娘</dd>
          <dd class="icon-artist"><span></span>歌手：赵雷</dd>
          <dd class="icon-album"><span></span>所属专辑：《赵小雷》</dd>
          <dd class="icon-like"><span></span><a href="/">喜欢</a></dd>
          <dd class="music">
				<audio src="__PUBLIC__/statics/default/images/nf.mp3" controls></audio>
          </dd>
          <!--也可以添加loop属性 音频加载到末尾时，会重新播放-->
        </dl>
      </div>
	  
    <!---->
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
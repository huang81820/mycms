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
    <figure> 
		  <img src="__PUBLIC__/statics/default/images/html.jpg"  alt="Panama Hat">
		  <figcaption><strong>HTML</strong> 
			超文本标记语言或超文本链接标示语言（标准通用标记语言下的一个应用）HTML（HyperText Mark-up Language）是一种制作万维网页面的标准语言，是万维网浏览器使用的一种语言，它消除了不同计算机之间信息交流的障碍。
	它是目前网络上应用最为广泛的语言，也是构成网页文档的主要语言。HTML文件是由HTML命令组成的描述性文本，HTML命令可以说明文字、图形、动画、声音、表格、链接等。HTML文件的结构包括头部（Head）、主体（Body）两大部分，其中头部描述浏览器所需的信息，而主体则包含所要说明的具体内容。
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
   <?php $art = cat2article(cat_id(),0); ?>
    <ul class="bloglist">
	<?php foreach($art['lists'] as $artRow){ ?>
	
      <li>
        <div class="arrow_box">
          <div class="ti"></div>
          <!--三角形-->
          <div class="ci"></div>
          <!--圆形-->
          <h2 class="title"><a href="<?php echo (CON_PATH); ?>/<?php echo ($artRow[article_id]); ?>" ><?php echo ($artRow['title']); ?></a></h2>
          <ul class="textinfo">
            
            <p><?php echo ($artRow['description']); ?></p>
          </ul>
          <ul class="details">
            <li class="likes"><a href="#"><?php echo ($artRow['favor']); ?></a></li>
            <li class="comments"><a href="#"><?php echo ($artRow['hits']); ?></a></li>
            <li class="icon-time"><a href="#"><?php echo (date('Y-m-d H:i:s',$artRow['datetime'])); ?></a></li>
          </ul>
        </div>
        <!--arrow_box end--> 
      </li>
    <?php } ?>
      <li class="page"><?php echo ($art['page']); ?></li>
    </ul>
    <!--bloglist end-->
    <aside>
		
      <div class="tuijian">
        <h2>最新文章</h2>
        <?php $art2 = cat2article(cat_id()); ?>
        <ol>
		<?php foreach($art2['lists'] as $artKey=>$artRow){ ?>
          <li><span><strong><?php echo $artKey+1; ?></strong></span><a href="<?php echo (CON_PATH); ?>/<?php echo ($artRow[article_id]); ?>"><?php echo ($artRow[title]); ?></a></li>
        <?php } ?>
      </div>
      
      <div class="clicks">
        <h2>热门点击</h2>
		<?php $hits_art = hits2art(cat_id(),$num=10); ?>
        <ol>
		<?php foreach($hits_art as $hitsRow){ ?>
			<li><span><a href="<?php echo (CAT_PATH); ?>/<?php echo ($hitsRow['cat_id']); ?>"><?php echo ($hitsRow['cat_name']); ?></a></span><a href="<?php echo (CON_PATH); ?>/<?php echo ($hitsRow['article_id']); ?>"><?php echo ($hitsRow['title']); ?></a></li>
        <?php } ?> 
        </ol>
      </div>
	  
      <div class="search">
	<form class="searchform" method="get" action="#">
		<input type="text" name="s" value="Search" onfocus="this.value=''" onblur="this.value='Search'">
	</form>
</div>
      <!--
<div class="viny" style="width:280px;">
	<dl>
	  <dt class="art"><img src="__PUBLIC__/statics/default/images/artwork.png" alt="专辑"></dt>
	  <dd class="icon-song"><span></span>南方姑娘</dd>
	  <dd class="icon-artist"><span></span>歌手：赵雷</dd>
	  <dd class="icon-album"><span></span>所属专辑：《赵小雷》</dd>
	  <dd class="icon-like"><span></span><a href="/">喜欢</a></dd>
	  <dd class="music">
			<audio src="__PUBLIC__/statics/default/images/nf.mp3" controls></audio>
	  </dd>
	  
	</dl>
</div>
-->
    </aside>
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
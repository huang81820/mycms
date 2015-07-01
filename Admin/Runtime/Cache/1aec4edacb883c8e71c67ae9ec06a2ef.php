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
    </ul>
    <script src="js/silder.js"></script><!--获取当前页导航 高亮显示标题--> 
  </nav>
</header>
<!--header end-->



<div id="mainbody">
  <div class="info">
    <figure> <img src="__PUBLIC__/statics/default/images/art.jpg"  alt="Panama Hat">
      <figcaption><strong>渡人如渡己，渡已，亦是渡</strong> 当我们被误解时，会花很多时间去辩白。 但没有用，没人愿意听，大家习惯按自己的所闻、理解做出判别，每个人其实都很固执。与其努力且痛苦的试图扭转别人的评判，不如默默承受，给大家多一点时间和空间去了解。而我们省下辩解的功夫，去实现自身更久远的人生价值。其实，渡人如渡己，渡已，亦是渡人。</figcaption>
    </figure>
    <div class="card">
      <h1>我的名片2</h1>
      <p>网名：DanceSmile | 即步非烟</p>
      <p>职业：Web前端设计师、网页设计</p>
      <p>电话：13662012345</p>
      <p>Email：dancesmiling@qq.com</p>
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
  <div class="blogs">
   <?php $art = cat2article(cat_id(),0); ?>
    <ul class="bloglist">
	<?php foreach($art as $artRow){ ?>
	
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
            <li class="likes"><a href="#">10</a></li>
            <li class="comments"><a href="#">34</a></li>
            <li class="icon-time"><a href="#"><?php echo (date('Y-m-d H:i:s',$artRow['datetime'])); ?></a></li>
          </ul>
        </div>
        <!--arrow_box end--> 
      </li>
    <?php } ?>
      
    </ul>
    <!--bloglist end-->
    <aside>
      <div class="tuijian">
        <h2>最新文章</h2>
        <?php $art = pos2art(1) ?>
		
        <ol>
		<?php foreach($art as $artKey=>$artRow){ ?>
          <li><span><strong>1</strong></span><a href="<?php echo (CON_PATH); ?>/<?php echo ($artRow[article_id]); ?>"><?php echo ($artRow[title]); ?></a></li>
        <?php } ?>
		</ol>
      </div>
      
      
      <div class="search">
        <form class="searchform" method="get" action="#">
          <input type="text" name="s" value="Search" onfocus="this.value=''" onblur="this.value='Search'">
        </form>
      </div>
      <div class="viny">
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
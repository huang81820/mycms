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



<div id="mainbody" style="margin-bottom:36px;">
  <div class="blogs">
    <div id="index_view">
      <div id="show_pos">位置：<?php echo ($site_nav); ?></div>
      <h1 class="c_titile"><?php echo ($show_title); ?></h1>
      <p class="box">发布时间：<?php echo (date('Y-m-d H:i:s',$show_datetime)); ?><span></span>阅读（<?php echo ($show_hits); ?>）</p>
      <div>
		<?php echo ($show_content); ?>
		<?php echo ($next); ?>
	  </div>
      
      <div class="otherlink">
        <h2>相关文章<?php echo ($show_cat_id); ?></h2>
		<?php $relatedArt = cat2article($show_cat_id,1,3); ?>
		
		
        <ul>
			<?php foreach($relatedArt['lists'] as $val){ ?>
			<li><a href="<?php echo (CON_PATH); ?>/<?php echo ($val['article_id']); ?>" title="<?php echo ($val['title']); ?>"><?php echo ($val['title']); ?></a></li>
			<?php  } ?>
	   </ul>
      </div>
    </div>
    <!--bloglist end-->
    <aside>
      <div class="search">
        <form class="searchform" method="get" action="#">
          <input type="text" name="s" value="Search" onfocus="this.value=''" onblur="this.value='Search'">
        </form>
      </div>
      <div class="sunnav">
        <ul>
          <li><a href="/web/" target="_blank" title="网站建设">网站建设</a></li>
          <li><a href="/newshtml5/" target="_blank" title="HTML5 / CSS3">HTML5 / CSS3</a></li>
          <li><a href="/jstt/" target="_blank" title="技术探讨">技术探讨</a></li>
          <li><a href="/news/s/" target="_blank" title="慢生活">慢生活</a></li>
        </ul>
      </div>
      <div class="tuijian">
        <h2>栏目更新</h2>
        <?php $art2 = cat2article($show_cat_id); ?>
        <ol>
		<?php foreach($art2['lists'] as $artKey=>$artRow){ ?>
          <li><span><strong><?php echo $artKey+1; ?></strong></span><a href="<?php echo (CON_PATH); ?>/<?php echo ($artRow[article_id]); ?>"><?php echo ($artRow[title]); ?></a></li>
        <?php } ?>
		</ol>
      </div>
     
      <div class="clicks">
			<h2>热门点击</h2>
			<?php $hits_art = hits2art($show_cat_id,$num=10); ?>
			<ol>
			<?php foreach($hits_art as $hitsRow){ ?>
				<li><span><a href="<?php echo (CAT_PATH); ?>/<?php echo ($hitsRow['cat_id']); ?>"><?php echo ($hitsRow['cat_name']); ?></a></span><a href="<?php echo (CON_PATH); ?>/<?php echo ($hitsRow['article_id']); ?>"><?php echo ($hitsRow['title']); ?></a></li>
			<?php } ?> 
			</ol>
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
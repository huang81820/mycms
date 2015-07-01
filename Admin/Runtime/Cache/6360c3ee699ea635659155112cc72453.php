<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo ($seo_title); ?></title>

<link  href="__PUBLIC__/statics/default/css/index.css" rel="stylesheet" type="text/css" />
<script src="__PUBLIC__/statics/default/js/jquery.js" type="text/javascript"></script>
<script src="__PUBLIC__/statics/default/js/Slider.js" type="text/javascript"></script>
</head>




<body>

	<div class="top100">
    	<div class="top_center">
        	<img class="top_img1" src="__PUBLIC__/statics/default/images/logo.png"/>
            <img class="top_img2" src="__PUBLIC__/statics/default/images/ming.png"/>
            
            
            <div class="search_weop">
            	<div class="top_zi">
                    <div class="zi_weap">
                        <span class="shou_zi">设为首页</span>
                        <span class="shou_zi">收藏</span>
                    </div>
                    <div class="sea_input_weap">
                    	<input type="text" class="sea_input"/>
                        <input type="submit" class="sub_input" value=""/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   	<div class="nav100">
    	<div class="nav_center">
        <ul  class="nav_ul">
			
        	<li class="nav_li <?php if(is_index()==1){ echo 'active_li'; } ?>"><a href="__APP__/Content/index">首页</a></li>
            <li class="nav_li <?php if(cat_id()==57||cat_id()==58||cat_id()==96||cat_id()==97||cat_id()==98){ echo 'active_li'; } ?>"><a href="__APP__/Content/lists/cat_id/57">铺贴解决方案</a></li>
            <li class="nav_li <?php if(cat_id()==102||cat_id()==100||cat_id()==101||cat_id()==103||cat_id()==104){ echo 'active_li'; } ?>"><a href="__APP__/Content/lists/cat_id/102">优质产品</a></li>
            <li class="nav_li"><a href="#">网上商城</a></li>
            <li class="nav_li"><a href="#">加盟美派</a></li>
            <li class="nav_li"><a href="__APP__/Content/lists/cat_id/105">关于美派</a></li>
        </ul>
        </div>
    </div>
    <!--结束头部-->

<div class="md20"></div>

<ul class="fangan_ul">

	<li><a href="__APP__/Content/lists/cat_id/105" class="fangan_ul_a_d <?php if(cat_id()==105) {echo 'fangan_li_nor'; } ?>">美派简介</a></li>
	<li><a href="__APP__/Content/lists/cat_id/106" class="fangan_ul_a_d <?php if(cat_id()==106) {echo 'fangan_li_nor'; } ?>">品牌背景</a></li>
	<li><a href="__APP__/Content/lists/cat_id/107" class="fangan_ul_a_d <?php if(cat_id()==107) {echo 'fangan_li_nor'; } ?>">美派新闻</a></li>
	<li><a href="__APP__/Content/lists/cat_id/105" class="fangan_ul_a_d">美国达泰瓷砖</a></li>
	<li><a href="__APP__/Content/lists/cat_id/105" class="fangan_ul_a_d">意大利马拉齐</a></li>

</ul>

<div class="md30"></div>



<div class="site_yrl"><?php echo ($site_nav); ?></div>

<div class="md30"></div>

<div class="single_center" style="min-height:400px;">
	<p class="mei_jian_title"><?php echo ($show_title); ?></p>
	<p class="time_sho"><?php echo (date("Y-m-d H:i",$show_datetime)); ?></p>
	<div class="single_contetn">
		<div class="md20">
			
		</div>
		<?php echo ($show_content); ?>
		
		
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>










<div class="md30"></div>

<div class="clear"></div>


<div class="footer_cor">
	版权所有：佛山美派美居建材有限公司 粤ICP备15032499号-1 建议使用IE8以上浏览器
</div>


<div class="md50"></div>



</body>
</html>
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
            <li class="nav_li"><a href="__APP__/Content/lists/cat_id/44">关于美派</a></li>
        </ul>
        </div>
    </div>
    <!--结束头部-->
	
	<div class="md10"></div>
	
	
	<div class="site_yrl"><?php echo ($site_nav); ?></div>
	
	<div class="md30"></div>
	
	
	<div class="df_about_us">
	123
	
	</div>
	
	
	
	
	
	
	
</body>
</html>
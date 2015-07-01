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
            <li class="nav_li <?php if(cat_id()==57){ echo 'active_li'; } ?>"><a href="__APP__/Content/lists/cat_id/57">铺贴解决方案</a></li>
            <li class="nav_li <?php if(cat_id()==99){ echo 'active_li'; } ?>"><a href="__APP__/Content/lists/cat_id/99">优质产品</a></li>
            <li class="nav_li"><a href="#">网上商城</a></li>
            <li class="nav_li"><a href="#">加盟美派</a></li>
            <li class="nav_li"><a href="__APP__/Content/lists/cat_id/44">关于美派</a></li>
        </ul>
        </div>
    </div>
    <!--结束头部-->

<div class="md20"></div>

<ul class="fangan_ul">
	<?php $subcat = sub_cat(top_parent(cat_id())) ?>
	
	<?php foreach($subcat as $subcatRow){ ?>
	<li><a href="<?php echo (CAT_PATH); ?>/<?php echo ($subcatRow[category_id]); ?>" class="<?php if(cat_id()==$subcatRow['category_id']) {echo 'fangan_li_nor'; } ?>"><?php echo ($subcatRow['cat_name']); ?></a></li>
	<?php } ?>	
	
	
	
</ul>

<div class="md30"></div>

<p class="list_pro_title">美木系列</p>
<p class="list_pro_title2">MEI MU</p>
<p class="list_pro_title3">美木系列崇尚大自然与人文生活结合，</p>

<div class="md20"></div>

<div class="pro_play">
	
</div>

<div class="md50"></div>
<div class="md20"></div>


<?php $pros = cat2article($cat_id=cat_id(),$is_all=1,$num=50,$order='no')?>
	


<div class="width1000_pro">
	<ul class="pro_ul">
		<?php if(is_array($pros["lists"])): foreach($pros["lists"] as $key=>$vo): ?><li class="pro_li">
				<a href="<?php echo (CON_PATH); ?>/<?php echo ($vo[product_id]); ?>/cat_id/<?php echo ($vo[cat_id]); ?>">
					<img class="pro_list_img" src='<?php echo ($vo["thumb"]); ?>' />
					<div class="md5"></div>
					<p class="pro_p1">DR1600601</p>
					<p class="pro_p2">规格：<?php echo ($vo["guige"]); ?></p>
				</a>
			</li><?php endforeach; endif; ?>
		<li class="pro_li">
			<img class="pro_list_img" src='' />
			<div class="md5"></div>
			<p class="pro_p1">DR1600601</p>
			<p class="pro_p2">规格：150X600MM</p>
		</li>
		
		<li class="pro_li">
			<img class="pro_list_img" src='' />
			<div class="md5"></div>
			<p class="pro_p1">DR1600601</p>
			<p class="pro_p2">规格：150X600MM</p>
		</li>
		
		<li class="pro_li">
			<img class="pro_list_img" src='' />
			<div class="md5"></div>
			<p class="pro_p1">DR1600601</p>
			<p class="pro_p2">规格：150X600MM</p>
		</li>
		
		<li class="pro_li">
			<img class="pro_list_img" src='' />
			<div class="md5"></div>
			<p class="pro_p1">DR1600601</p>
			<p class="pro_p2">规格：150X600MM</p>
		</li>
	</ul>
</div>



</body>
</html>
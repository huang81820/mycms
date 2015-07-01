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
            <li class="nav_li <?php if(cat_id()==47){ echo 'active_li'; } ?>"><a href="__APP__/Content/lists/cat_id/47">铺贴解决方案</a></li>
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

<div class="anli_banner">
	
</div>


<ul class="an_ufl">

	<?php $anlis = cat2article($cat_id=cat_id(),$is_all=1,$num=50,$order='no')?>
	
	<?php if(is_array($anlis["lists"])): foreach($anlis["lists"] as $key=>$vo): ?><li >
		<a href='<?php echo (CON_PATH); ?>/<?php echo ($vo[catalog_id]); ?>/cat_id/<?php echo ($vo[cat_id]); ?>'>
			<img class="an_img" src="" />
			<div class="md10"></div>
			
			<div class="">
				<div class="li_left_img">
					<img src='<?php echo $anli['thumb']?>' class="li_img_r"/>
					<p class="li_pe">2SR601274</p>
				</div>
				
				<div class="li_right_info">
					<div class="md20"></div>
					<p class="an_li_p1">DR9201806的客厅空间</p>
					<p class="an_li_p2">寻找城市中的宁静</p>
					<p class="an_li_p3">将木纹融入高雅中</p>
				</div>
			</div>
		</a>
	</li><?php endforeach; endif; ?>
	
	<li >
		<img class="an_img" src="" />
		<div class="md10"></div>
		
		<div class="">
			<div class="li_left_img">
				<img src='' class="li_img_r"/>
				<p class="li_pe">2SR601274</p>
			</div>
			
			<div class="li_right_info">
				<div class="md20"></div>
				<p class="an_li_p1">DR9201806的客厅空间</p>
				<p class="an_li_p2">寻找城市中的宁静</p>
				<p class="an_li_p3">将木纹融入高雅中</p>
			</div>
		</div>
	</li>
	<li >
		<img class="an_img" src="" />
		<div class="md10"></div>
		
		<div class="">
			<div class="li_left_img">
				<img src='' class="li_img_r"/>
				<p class="li_pe">2SR601274</p>
			</div>
			
			<div class="li_right_info">
				<div class="md20"></div>
				<p class="an_li_p1">DR9201806的客厅空间</p>
				<p class="an_li_p2">寻找城市中的宁静</p>
				<p class="an_li_p3">将木纹融入高雅中</p>
			</div>
		</div>
	</li>
	<li >
		<img class="an_img" src="" />
		<div class="md10"></div>
		
		<div class="">
			<div class="li_left_img">
				<img src='' class="li_img_r"/>
				<p class="li_pe">2SR601274</p>
			</div>
			
			<div class="li_right_info">
				<div class="md20"></div>
				<p class="an_li_p1">DR9201806的客厅空间</p>
				<p class="an_li_p2">寻找城市中的宁静</p>
				<p class="an_li_p3">将木纹融入高雅中</p>
			</div>
		</div>
	</li>
</ul>





</body>
</html>
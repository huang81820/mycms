<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo ($seo_title); ?></title>

<link  href="__PUBLIC__/statics/default/css/index.css" rel="stylesheet" type="text/css" />
<script src="__PUBLIC__/statics/default/js/jquery.js" type="text/javascript"></script>
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
        	<li class="nav_li active_li"><a href="#">首页首页</a></li>
            <li class="nav_li"><a href="#">首页首页</a></li>
            <li class="nav_li"><a href="#">首页首页</a></li>
            <li class="nav_li"><a href="#">首页首页</a></li>
            <li class="nav_li"><a href="#">首页首页</a></li>
            <li class="nav_li"><a href="#">首页首页</a></li>
        </ul>
        </div>
    </div>
    <!--结束头部-->
	
	<div id="main_contact">
		<div id="main_contact_con">
			<img src="<?php echo ($list_thumb); ?>" />
			<div id="contact_con_left">
				<div id="side_nav_wrap">
					<div id="side_nav_con">
						<img id="about_tit" src="__PUBLIC__/statics/default/images/case_tit.png" />
						<?php $subcat = sub_cat(top_parent(cat_id())) ?>
						<ul id="side_nav2" cat_id="<?php echo cat_id(); ?>" >
						<?php foreach($subcat as $subcatRow){ ?>
							<li cat_id="<?php echo ($subcatRow[category_id]); ?>" ><a href="<?php echo (CAT_PATH); ?>/<?php echo ($subcatRow[category_id]); ?>"><?php echo ($subcatRow['cat_name']); ?></a></li>
						<?php } ?>		
						</ul>
						<div class="clear"></div>
					</div>
					<div id="side_nav_bo_bg"></div>
				</div>
			</div>
			<div id="contact_con_right">
				<div id="contact_con_right_mid" style="margin-top:-3px;">
					
					<div id="contact_con_con">
					<?php $art = cat2article(cat_id()); ?>
						<ul id="anli_list">
						<?php foreach($art['lists'] as $key=>$artRow){ ?>
							<li>
								<div class="anli_list_tit">
									<p class="anli_list_name_ch"><?php echo ($artRow['title']); ?></p>
									<p class="anli_list_name_eng"><?php echo ($artRow['eng_title']); ?></p>
									<p class="anli_list_num">NO.<?php echo $key+1; ?></p>
								</div>
								<a href="<?php echo (CON_PATH); ?>/<?php echo ($artRow[article_id]); ?>/cat_id/<?php echo ($artRow[cat_id]); ?>">
									<img class="anli_thumb" src="<?php echo ($artRow['thumb']); ?>" width='296' height='196' />
								</a>
								<div class="anli_list_desc">
									<?php echo ($artRow['description']); ?>
								</div>
							</li>
							
						 <?php } ?>	
							
						</ul>
					</div>
				</div>
				<div id="contact_con_right_bo"></div>
			</div>
		</div>
		
</body>
</html>
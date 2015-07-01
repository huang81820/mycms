<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo ($seo_title); ?></title>

<link  href="__PUBLIC__/statics/default/css/index.css" rel="stylesheet" type="text/css" />
<script src="__PUBLIC__/statics/default/js/jquery.js" type="text/javascript"></script>
<script src="__PUBLIC__/statics/default/js/Slider.js" type="text/javascript"></script>
<script src="__PUBLIC__/statics/default/js/jsAddress.js" type="text/javascript"></script>
</head>

 <script type="text/javascript"> 
// 设置为主页 
function SetHome(obj,vrl){ 
try{ 
obj.style.behavior='url(#default#homepage)';obj.setHomePage(vrl); 
} 
catch(e){ 
if(window.netscape) { 
try { 
netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect"); 
} 
catch (e) { 
alert("此操作被浏览器拒绝！\n请在浏览器地址栏输入“about:config”并回车\n然后将 [signed.applets.codebase_principal_support]的值设置为'true',双击即可。"); 
} 
var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch); 
prefs.setCharPref('browser.startup.homepage',vrl); 
}else{ 
alert("您的浏览器不支持，请按照下面步骤操作：1.打开浏览器设置。2.点击设置网页。3.输入："+vrl+"点击确定。"); 
} 
} 
} 
// 加入收藏 兼容360和IE6 
function shoucang(sTitle,sURL) 
{ 
try 
{ 
window.external.addFavorite(sURL, sTitle); 
} 
catch (e) 
{ 
try 
{ 
window.sidebar.addPanel(sTitle, sURL, ""); 
} 
catch (e) 
{ 
alert("加入收藏失败，请使用Ctrl+D进行添加"); 
} 
} 
} 
</script>





<body>

	<div class="top100">
    	<div class="top_center">
            <a href="__APP__/Content/index">
        	    <img class="top_img1" src="__PUBLIC__/statics/default/images/logo.png"/>
                <img class="top_img2" src="__PUBLIC__/statics/default/images/ming.png"/>
            </a>
            
            <div class="search_weop">
            	<div class="top_zi">
                    <div class="zi_weap">
					
					
					
                        <a class="shou_zi" onclick="this.setHomePage('http://www.baidu.com');">设为首页</a>
                        <span class="shou_zi">收藏</span>
                    </div>

                    <div class="sea_input_weap">
                        <form action="__APP__/Content/search/module_id/20" method="POST" >
                    	    <input type="text" class="sea_input" name="search_key"/>
                            <input type="submit" class="sub_input" value=""/>
                        </form>
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
            <li class="nav_li"><a href="__APP__/Content/lists/cat_id/109">加盟美派</a></li>
            <li class="nav_li"><a href="__APP__/Content/lists/cat_id/105">关于美派</a></li>
        </ul>
        </div>
    </div>
    <!--结束头部-->

    <div class="center_border">




<div class="md20"></div>

<ul class="fangan_ul">
	<?php $subcat = sub_cat(top_parent(cat_id())) ?>
	
	<?php foreach($subcat as $subcatRow){ ?>
	<li><a href="<?php echo (CAT_PATH); ?>/<?php echo ($subcatRow[category_id]); ?>" class="fangan_ul_a_d <?php if(cat_id()==$subcatRow['category_id']) {echo 'fangan_li_nor'; } ?>"><?php echo ($subcatRow['cat_name']); ?></a></li>
	<?php } ?>	
	
	
	
</ul>

<div class="md30"></div>

<?php $ad = getByModules(25,'advertise_id=3'); ?>				
<?php $picArr = unserialize($ad[0]['pics']); ?>

<div class="anli_banner">
	<?php  $ad_img_url ==''; $ad_img_href ==''; $cat_oid = cat_id(); if( $cat_oid==57 ) { $ad_img_url = $picArr[0]['url']; $ad_img_href = $picArr[0]['href'];} if( $cat_oid==58 ) { $ad_img_url = $picArr[1]['url']; $ad_img_href = $picArr[0]['href'];} if( $cat_oid==97 ) { $ad_img_url = $picArr[2]['url']; $ad_img_href = $picArr[0]['href'];} if( $cat_oid==98 ) { $ad_img_url = $picArr[3]['url']; $ad_img_href = $picArr[0]['href'];} if( $cat_oid==96 ) { $ad_img_url = $picArr[4]['url']; $ad_img_href = $picArr[0]['href'];} ?>
	<a href='<?php echo $ad_img_href;?>'>
		<img src='<?php echo $ad_img_url;?>'  />
	</a>
</div>

<div class="md20"></div>

<ul class="an_ufl">

	<?php $anlis = cat2article($cat_id=cat_id(),$is_all=1,$num=50,$order='no')?>
	
	<?php if(is_array($anlis["lists"])): foreach($anlis["lists"] as $key=>$vo): ?><li >
		<a href='<?php echo (CON_PATH); ?>/<?php echo ($vo[catalog_id]); ?>/cat_id/<?php echo ($vo[cat_id]); ?>'>
            <div class="wrap_img">
		    	<img class="an_img" src="<?php echo $vo['thumb']?>" />
            </div>
			<div class="md10"></div>


            <?php $ids = explode(',',$vo['re_pro_ids']); if(!empty($ids[0])){ $pro = M('product')->find($ids[0]); } ?>
			<div class="">
				<div class="li_left_img">
					<img src='<?php echo $pro['thumb'];?>' class="li_img_r"/>
					<p class="li_pe"><?php echo $pro['title'];?></p>
				</div>
				
				<div class="li_right_info">
					<div class="md20"></div>
					<p class="an_li_p1"><?php echo $vo['title']?></p>
					<p class="an_li_p2"><?php echo $vo['title2']?></p>
					<p class="an_li_p3"><?php echo $vo['title3']?></p>
				</div>
			</div>
		</a>
	</li><?php endforeach; endif; ?>
	
	
</ul>

<div class="md50"></div>




</div>


<div class="md30"></div>

<div class="clear"></div>


<div class="footer_cor">
	版权所有：佛山美派美居建材有限公司 粤ICP备15032499号-1 建议使用IE8以上浏览器
</div>


<div class="md50"></div>



</body>
</html>
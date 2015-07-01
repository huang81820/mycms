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




<script>
$(document).ready(function(){
	new Slider('#focus3');
});
</script>

<div class="md20">

</div>



<div class="md30"></div>
<?php $caty = cat_id();?>

<?php if($caty == 102): ?><p class="list_pro_title">小资系列</p>
	<p class="list_pro_title2">XIAO ZI</p>
	<div class="md10"></div>
	<p class="list_pro_title3">小资系列向往西方思想生活，追求内心体验、物质、精神享受和生活品味。</p><?php endif; ?>

<?php if($caty == 103): ?><p class="list_pro_title">小白系列</p>
	<p class="list_pro_title2">XIAO BAI</p>
	<div class="md10"></div>
	<p class="list_pro_title3">小白系列追求时尚与潮流，简洁、无过多的装饰、运用浅色类材料极致发挥空间无限想象。</p><?php endif; ?>

<?php if($caty == 100): ?><p class="list_pro_title">小美系列</p>
	<p class="list_pro_title2">XIAO MEI</p>
	<div class="md10"></div>
	<p class="list_pro_title3">小美系列是自在、随意生活方式，没有太多造作的修饰与约束，从中能寻找出美式文化根基，大气而又不失自由。</p><?php endif; ?>

<?php if($caty == 101): ?><p class="list_pro_title">美木系列</p>
	<p class="list_pro_title2">MEI MU</p>
	<div class="md10"></div>
	<p class="list_pro_title3">美木系列崇尚大自然与人文生活结合，</p><?php endif; ?>

<?php if($caty == 104): ?><p class="list_pro_title">专家级产品</p>
	<p class="list_pro_title2">EXPERT LEVEL</p>
	<div class="md10"></div>
	<p class="list_pro_title3">专家级产品融合当代建筑审美及使用需求，用于多个世界著名建筑中。</p><?php endif; ?>


<div class="md20"></div>

<?php  $pr_cat_id = cat_id(); $advertise_id = 0; if( $pr_cat_id==102 ) $advertise_id=4; if( $pr_cat_id==103 ) $advertise_id=5; if( $pr_cat_id==100 ) $advertise_id=6; if( $pr_cat_id==101 ) $advertise_id=7; if( $pr_cat_id==104 ) $advertise_id=8; ?>
<?php $ad = getByModules(25,'advertise_id='.$advertise_id); ?>				
<?php $picArr = unserialize($ad[0]['pics']); ?>
<p style="text-align:right; font-size:12px; margin-bottom:8px; margin-right:40px;">搜索结果：About <span style="color:red"><?php  echo count($result); ?></span> results （Use 0.24 Second）<p>

<div class="md50"></div>
<div class="md20"></div>



	


<div class="width1000_pro">
	<ul class="pro_ul">
		<?php if(is_array($result)): foreach($result as $key=>$vo): ?><li class="pro_li">
				<a href="<?php echo (CON_PATH); ?>/<?php echo ($vo[product_id]); ?>/cat_id/<?php echo ($vo[cat_id]); ?>">
					<img class="pro_list_img" src='<?php echo ($vo["thumb"]); ?>' />
					<div class="md10"></div>
					<p class="pro_p1"><?php echo ($vo["title"]); ?></p>

				</a>
			</li><?php endforeach; endif; ?>

	</ul>
</div>





</div>


<div class="md30"></div>

<div class="clear"></div>


<div class="footer_cor">
	版权所有：佛山美派美居建材有限公司 粤ICP备15032499号-1 建议使用IE8以上浏览器
</div>


<div class="md50"></div>



</body>
</html>
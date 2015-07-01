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

	new slide('.living');
	new slide('.bedroom');
	new slide('.dinning');
	new slide('.study');
	new slide('.bathroom');
	
	
	
	$('.tui_ul li').click(function(){
		var index = $(this).index();
		$('.tui_list_ul').hide();
		$('.tui_list_ul').eq(index).stop(true,false).fadeIn();
		
		$('.tui_ul li').removeClass('tui_ul_ac').css({color:'#FFF'});
		$(this).addClass('tui_ul_ac').css({color:'#443e3e'});
	});
	
	//幻灯片
	new Slider('#focus');
});

function slide(wrap)
{
	var _This = this;
	this.index = 0;
	this.wrap = wrap;
	this.ul = '';
	this.li_length = 0;
	
	this.init = function()
	{
		_This.ul = $(_This.wrap).find('ul');
		_This.li_length = $(_This.wrap).find('ul').find('li').length;
	
		_This.ul.css({width:(260+40) * _This.li_length });
	}
	
	this.handdle_aright_btn = function(){
		$(_This.wrap).find('.aright').click(function(){ 
			if( _This.index>=(_This.li_length-3) ) return;
			
			_This.index += 1;
			$(_This.ul).stop(true,false).animate({left:-(260+40)*_This.index});
		});
		
	}
	
	
	this.handdle_aleft_btn = function(){
		$(_This.wrap).find('.aleft').click(function(){ 
			if( _This.index <= 0  ) return;
			
			_This.index -= 1;
			$(_This.ul).stop(true,false).animate({left:-(260+40)*_This.index});
		});
		
	}
	
	this.init();
	this.handdle_aright_btn();
	this.handdle_aleft_btn();
}
</script>


	
    <div class="main100">
		<div class="main_center">
				<?php $ad = getByModules(25,'advertise_id=1'); ?>				
				<?php $picArr = unserialize($ad[0]['pics']); ?>
				
				<div id="focus">
					<ul>
						<?php foreach($picArr as $pic){?>
						<li><a href="<?php echo $pic['href'];?>" ><img src="<?php echo $pic['url'];?>"  /></a></li>
						<?php } ?>
						
					</ul>
				</div>
				
				<?php $an_ad = getByModules(25,'advertise_id=2'); ?>				
				<?php $picArr = unserialize($an_ad[0]['pics']); ?>
				
				<!--开始客厅-->
				<div class="am_li_wrap">
					<div class="md30"></div>
					
					<p class="demop1">客厅案例</p>
					<p class="demop2">Living room</p>
					
					<div class="md20"></div>
					<p class="an_desc">现代小美式设计崇尚简约的设计理念，除了选材和色彩，就连造型也已经简到极致，力求与大自然零距</p>
					<p class="an_desc">离接触，实用而优雅。</p>
					
					<div class="md30"></div>
					
					<div class="anli_big_img">
						<a href="<?php echo $picArr[0]['href'];?>" >   
							<img  src='<?php echo $picArr[0]['url'];?>' class="showu_an_ad"/>
						</a>
					</div>
					
					<div class="md20"></div>
					
					<div class="an_ul_wrap living">
						<div class="an_ul_g">
							<?php $po1 = pos2art(4,23,30); ?>
							
							<ul class="an_ul">
								<?php foreach($po1 as $po){ ?>
								<li>
									<a href="<?php echo (CON_PATH); ?>/<?php echo ($po[catalog_id]); ?>/cat_id/<?php echo ($po[cat_id]); ?>">
										<img src='<?php echo $po['thumb'];?>'/>
										<div class="md5"></div>
										<p class="an_li_p"><?php echo $po['title'];?></p>
									</a>
								</li>
								<?php } ?>

								
							</ul>
						</div>
						<img src='__PUBLIC__/statics/default/images/left.png' class="aleft"/>
						<img src='__PUBLIC__/statics/default/images/right.png' class="aright"/>
					</div>
					
					<div class="md20"></div>
					
					<div class="am_ge"></div>
					
					<div class="md20"></div>
					<div class="clear"></div>
				</div>
				<!--结束客厅-->
				
				<!--开始卧室-->
				<div class="am_li_wrap">
					<div class="md30"></div>
					
					<p class="demop1">卧室案例</p>
					<p class="demop2">Bedroom</p>
					
					<div class="md20"></div>
					<p class="an_desc">卧室是人们休息和睡眠的自由生活空间。在卧室的设计上，美派美居追求的是功能与形式的完美统一、</p>
					<p class="an_desc">优雅独特、简洁明快的设计风格，而不是简单的“堆砌”和平淡的“摆放”</p>
					
					<div class="md30"></div>
					
					<div class="anli_big_img">
						<a href="<?php echo $picArr[1]['href'];?>" >   
						<img src='<?php echo $picArr[1]['url'];?>' class="showu_an_ad"/>
						</a>
					</div>
					
					<div class="md20"></div>
					
					<div class="an_ul_wrap bedroom">
						<div class="an_ul_g">
							<?php $po1 = pos2art(5,23,30); ?>
							
							<ul class="an_ul">
								<?php foreach($po1 as $po){ ?>
								<li>
									<a href="<?php echo (CON_PATH); ?>/<?php echo ($po[catalog_id]); ?>/cat_id/<?php echo ($po[cat_id]); ?>">
										<img src='<?php echo $po['thumb'];?>'/>
										<div class="md5"></div>
										<p class="an_li_p"><?php echo $po['title'];?></p>
									</a>
								</li>
								<?php } ?>

								
							</ul>
						</div>
						<img src='__PUBLIC__/statics/default/images/left.png' class="aleft"/>
						<img src='__PUBLIC__/statics/default/images/right.png' class="aright"/>
					</div>
					
					<div class="md20"></div>
					
					<div class="am_ge"></div>
					
					<div class="md20"></div>
					<div class="clear"></div>
				</div>
				<!--结束卧室-->
				
				
				<!--开始餐厅-->
				<div class="am_li_wrap">
					<div class="md30"></div>
					
					<p class="demop1">餐厅案例</p>
					<p class="demop2">Dinning Room</p>
					
					
					<div class="md20"></div>
					<p class="an_desc">卧室是人们休息和睡眠的自由生活空间。在卧室的设计上，美派美居追求的是功能与形式的完美统一、</p>
					<p class="an_desc">优雅独特、简洁明快的设计风格，而不是简单的“堆砌”和平淡的“摆放”</p>
					<div class="md30"></div>
					
					<div class="anli_big_img">
						<a href="<?php echo $picArr[2]['href'];?>" >   
						<img src='<?php echo $picArr[2]['url'];?>' class="showu_an_ad"/>
						</a>
					</div>
					
					<div class="md20"></div>
					
					<div class="an_ul_wrap dinning">
						<div class="an_ul_g">
							
							<?php $po1 = pos2art(6,23,30); ?>
							
							<ul class="an_ul">
								<?php foreach($po1 as $po){ ?>
								<li>
									<a href="<?php echo (CON_PATH); ?>/<?php echo ($po[catalog_id]); ?>/cat_id/<?php echo ($po[cat_id]); ?>">
										<img src='<?php echo $po['thumb'];?>'/>
										<div class="md5"></div>
										<p class="an_li_p"><?php echo $po['title'];?></p>
									</a>
								</li>
								<?php } ?>

								
							</ul>
							
						</div>
						<img src='__PUBLIC__/statics/default/images/left.png' class="aleft"/>
						<img src='__PUBLIC__/statics/default/images/right.png' class="aright"/>
					</div>
					
					<div class="md20"></div>
					
					<div class="am_ge"></div>
					
					<div class="md20"></div>
					<div class="clear"></div>
				</div>
				<!--结束餐厅-->
				
				
				<!--开始书房-->
				<div class="am_li_wrap">
					<div class="md30"></div>
					
					<p class="demop1">书房案例</p>
					<p class="demop2">Study Room</p>
					
					
					<div class="md20"></div>
					<p class="an_desc">书房是家庭一个独立的思考空间，拥有实用的功能。在设计中抛弃了许多不必要的附加装饰，以平面构</p>
					<p class="an_desc">成、色彩构成、立体构成为基础进行设计是美派美居对书房设计的态度。</p>
					<div class="md30"></div>
					
					<div class="anli_big_img">
						<a href="<?php echo $picArr[3]['href'];?>" >   
						<img src='<?php echo $picArr[3]['url'];?>' class="showu_an_ad"/>
						</a>
					</div>
					
					<div class="md20"></div>
					
					<div class="an_ul_wrap study">
						<div class="an_ul_g">
							
							<?php $po1 = pos2art(7,23,30); ?>
							
							<ul class="an_ul">
								<?php foreach($po1 as $po){ ?>
								<li>
									<a href="<?php echo (CON_PATH); ?>/<?php echo ($po[catalog_id]); ?>/cat_id/<?php echo ($po[cat_id]); ?>">
										<img src='<?php echo $po['thumb'];?>'/>
										<div class="md5"></div>
										<p class="an_li_p"><?php echo $po['title'];?></p>
									</a>
								</li>
								<?php } ?>

								
							</ul>
							
						</div>
						<img src='__PUBLIC__/statics/default/images/left.png' class="aleft"/>
						<img src='__PUBLIC__/statics/default/images/right.png' class="aright"/>
					</div>
					
					<div class="md20"></div>
					
					<div class="am_ge"></div>
					
					<div class="md20"></div>
					<div class="clear"></div>
				</div>
				<!--结束餐厅-->
				
				
				

				<!--开始卫生间-->
				<div class="am_li_wrap">
					<div class="md30"></div>
					
					<p class="demop1">卫生间案例</p>
					<p class="demop2">Bathroom</p>
					
					<div class="md20"></div>
					<p class="an_desc">卫生间的环境影响着我们的家庭卫生和居住的心情。在实际设计中，应该以实用大方、安全方便、易于</p>
					<p class="an_desc">清洁、美观简洁为主。</p>
					<div class="md30"></div>
					
					<div class="anli_big_img">
					<a href="<?php echo $picArr[4]['href'];?>" >   
						<img src='<?php echo $picArr[4]['url'];?>' class="showu_an_ad"/>
					</a>
					</div>
					
					<div class="md20"></div>
					
					<div class="an_ul_wrap bathroom">
						<div class="an_ul_g">
							
							<?php $po1 = pos2art(8,23,30); ?>
							
							<ul class="an_ul">
								<?php foreach($po1 as $po){ ?>
								<li>
									<a href="<?php echo (CON_PATH); ?>/<?php echo ($po[catalog_id]); ?>/cat_id/<?php echo ($po[cat_id]); ?>">
										<img src='<?php echo $po['thumb'];?>'/>
										<div class="md5"></div>
										<p class="an_li_p"><?php echo $po['title'];?></p>
									</a>
								</li>
								<?php } ?>

								
							</ul>
							
						</div>
						<img src='__PUBLIC__/statics/default/images/left.png' class="aleft"/>
						<img src='__PUBLIC__/statics/default/images/right.png' class="aright"/>
					</div>
					
					<div class="md20"></div>
					
					<div class="am_ge"></div>
					
					<div class="md20"></div>
					<div class="clear"></div>
				</div>
				<!--结束卫生间-->
				
			<div class="index_pro">
					<div class="md50"></div>
					<div class="md10"></div>
					<p class="index_tui">推荐产品</p>
					<p class="index_tui2">Most Recommended</p>
					
					<div class="md10"></div>
					<ul class="tui_ul">
						<li class="tui_li_nor ">小美系列</li>
						<li class="tui_li_nor">美木系列</li>
						<li class="tui_li_nor">小资系列</li>
						
						<li class="tui_li_nor">小白系列</li>
						<li class="tui_li_nor">专家级产品</li>
						
						
					</ul>
					<div class="md50"></div>
					
					<?php $chan_pin = pos2art(9,20,4); ?>
					
					<ul class="tui_list_ul" style="display:block">
						<?php foreach($chan_pin as $pro){ ?>
						<li>
							<img class="changjing" src='<?php echo $pro['pro_chang']?>' width='135' height="130" />
							<img class="chanpin" src='<?php echo $pro['thumb']?>' width='118' height="118" />
							<div class="md5"></div>
							<p class="jian_p1"><?php echo $pro['title']?></p>
							<p class="jian_p2"><?php echo $pro['guige']?></p>
						</li>
						<?php } ?>
						
					</ul>
					
					<?php $chan_pin = pos2art(10,20,4); ?>
					<ul class="tui_list_ul">
						<?php foreach($chan_pin as $pro){ ?>
						<li>
							<img class="changjing" src='<?php echo $pro['pro_chang']?>' width='135' height="130" />
							<img class="chanpin" src='<?php echo $pro['thumb']?>' width='118' height="118" />
							<div class="md5"></div>
							<p class="jian_p1"><?php echo $pro['title']?></p>
							<p class="jian_p2"><?php echo $pro['guige']?></p>
						</li>
						<?php } ?>
						
					</ul>
					
					<?php $chan_pin = pos2art(11,20,4); ?>
					<ul class="tui_list_ul">
						
						<?php foreach($chan_pin as $pro){ ?>
						<li>
							<img class="changjing" src='<?php echo $pro['pro_chang']?>' width='135' height="130" />
							<img class="chanpin" src='<?php echo $pro['thumb']?>' width='118' height="118" />
							<div class="md5"></div>
							<p class="jian_p1"><?php echo $pro['title']?></p>
							<p class="jian_p2"><?php echo $pro['guige']?></p>
						</li>
						<?php } ?>
					</ul>
					
					<?php $chan_pin = pos2art(12,20,4); ?>
					<ul class="tui_list_ul">
						
						<?php foreach($chan_pin as $pro){ ?>
						<li>
							<img class="changjing" src='<?php echo $pro['pro_chang']?>' width='135' height="130" />
							<img class="chanpin" src='<?php echo $pro['thumb']?>' width='118' height="118" />
							<div class="md5"></div>
							<p class="jian_p1"><?php echo $pro['title']?></p>
							<p class="jian_p2"><?php echo $pro['guige']?></p>
						</li>
						<?php } ?>
					</ul>
					
					<?php $chan_pin = pos2art(13,20,4); ?>
					<ul class="tui_list_ul">
						
						<?php foreach($chan_pin as $pro){ ?>
						<li>
							<img class="changjing" src='<?php echo $pro['pro_chang']?>' width='135' height="130" />
							<img class="chanpin" src='<?php echo $pro['thumb']?>' width='118' height="118" />
							<div class="md5"></div>
							<p class="jian_p1"><?php echo $pro['title']?></p>
							<p class="jian_p2"><?php echo $pro['guige']?></p>
						</li>
						<?php } ?>
					</ul>
				
				
				
				
				<div class="clear"></div>
			</div>
			
			<div class="md40"></div>
			
			<div class="down_btn_wrap">
				<img src='__PUBLIC__/statics/default/images/ddd.png'/>
			</div>
			
			<div class="md10"></div>
			
			<div class="shou_ce">
				<span>美派美居加盟手册</span>
				<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;美派美居产品手册</span>
			</div>
			
			
		</div>
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
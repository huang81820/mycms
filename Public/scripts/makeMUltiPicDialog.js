function makeMUltiPicDialog(button_id,name,upUrl,edictor_type,attrs){
	var _This=			this;
	this.button_id=		button_id;						//加载组件触发事件得元素
	this.name=			name;							//组建的name属性
	this.editor=		null;							//Kindeditor组件加载标识
	this.operateRange=	null;							//当前操作的范围限定
	this.attrs=			attrs;							//组件需要的额外属性
	this.drag=			null;				
	this.upUrl=			upUrl;							//文件，图片上传的URL
	this.edictor_type=	edictor_type;					//需要加载的插件类型
	this.dragWrapId =   'DD_list_'+this.button_id;
	
	
	this.makeDialogFrame=function(){
		var str='';
		str+='<style>';
		str+='.DD_wrap{ display:none;  border:2px solid black; overflow:hidden;position:fixed; z-index:2; left:0;top:0 }';
		str+='.DD_top{ width:700px; height:30px; overflow:hidden;  background:url(/Public/images/PIC_top_bg.jpg) repeat-x;background-color:black;}';
		str+='.DD_title{cursor:move;  display:block;width:500px; height:22px; line-height:22px; color:white;text-indent:8px;  float:left; font-family:"微软雅黑", "宋体", "黑体"; font-size:12px; font-size:12px;}';
		str+='.DD_close{ background:url(/Public/images/cross_circle.png); display:block; height:16px; width:16px; float:right; margin-top:6px; margin-right:10px; color:white}';
		str+='.DD_con{ height:500px; width:700px; background-color:white; -border-bottom:1px solid gray; -overflow:hidden}';
		str+='.J_selectImage,.nums_del_pics,.DD_check_all{border:1px solid #459300; background:url(/Public/images/bg-button-green.gif) repeat-x;}';


		str+='.DDD_wrap{width:700px;  }';
		str+='.DD_pic_top{height:28px; width:720px; border-bottom:1px solid black}';
		str+='.DD_pic_top span{line-height:28px; text-indent:12px; display:block; float:left; height:28px; width:200px; font-size:13px;}';
		str+='.DD_pic_top input{float:right; height:20px; width:80px; margin-top:4px; margin-right:50px;font-size:13px; color:white;cursor:pointer; }';
		str+='.DD_con2{ width:700px; background-color:white; }';
		str+='.DD_list{ width:700px;   position:relative; }';
		str+='.DD_list li{ width:102px; height:102px; float:left; margin-left:12px;margin-top:12px; display:block; position:relative;}';
		str+='.DD_list li img{border:1px solid gray;width:102px; height:102px;}';
		
		str+='.DD_picsAtttr{ padding:0px;  border:2px solid green; position:fixed;z-index:999999;display:none; top:80px; background-color:white;  top:20px;width:720px;height:400px; }';
		str+='.DD_picTit{width:100%; height:25px; background:url(/Public/images/bg-button-green.gif) repeat-x ; text-align:center; color:white; }';
		str+='.DD_picsAtttr_top{ position;relative; height:25px; width:100%; margin-bottom:10px;}';
		str+='.DD_picAttrClose{ position:absolute;right:8px;top:3px; display:block;height:25px; line-height:25px;width:16px; color:white; background:url(/Public/images/cross_circle.png) no-repeat; cursor:pointer; }';
		str+='.DD_drag_active{border:2px dashed red}';
		str+='.DD_picToBigBtn{ background-color:red;width:20px; height:19px; position:absolute; right:-9px;top:-7px;  z-index:9999;cursor:pointer;}';
		
		str+='</style>';
		
		
		
		str+='<div id="mmmm" class="DD_wrap" class="'+this.name+'" names="'+this.name+'">';
		str+='	<div class="DD_top">';
		str+='		<p class="DD_title">图片管理</p>';
		str+='		<a class="DD_close" href="#"></a>';
		str+='	</div>';
		str+='	<div class="DD_con">';
		str+='		<div class="DDD_wrap">';
		str+='			<div class="DD_pic_top">';
		str+='				<span>请选择操作 <font style="color:red;">'+this.attrs.dialogName+'</font></span>';
		str+='				<input style="" class="J_selectImage" type="button" value="批量上传" />';
		str+='				<input class="nums_del_pics" type="button" value="批量删除" />';
		str+='				<input class="DD_check_all" type="button" value="全选/全不选" is_all_check="no" />';
		str+='			</div>';
		str+='			<div class="DD_con2">';
		str+='				<ul class="DD_list" id="'+this.dragWrapId+'" >';
		if(_This.attrs.DDiv){
			str+=_This.attrs.DDiv;
		}
		str+='				</ul>';
		str+='			</div>';
		str+='		</div>';
		str+='	</div>';
		str+='</div>';
		
		
		
		return str;
	}
	
	this.addDrag = function(){
		
		
		// var oUl=$('#'+this.dragWrapId);
		// var aLi=$('li',oUl);
		var oUl=document.getElementById(this.dragWrapId);
		var aLi=oUl.getElementsByTagName('li');
		
		var aPos=[];
		var iMinZindex=2;	
		var i=0;
		
		for(i=0;i<aLi.length;i++)
		{//alert(aLi[i].offsetLeft);
			aPos[i]={left: aLi[i].offsetLeft, top: aLi[i].offsetTop};			
		}
		
		for(i=0;i<aLi.length;i++)
		{
			aLi[i].style.left=aPos[i].left+'px';
			aLi[i].style.top=aPos[i].top+'px';
			
			aLi[i].style.position='absolute';
			aLi[i].style.margin='0';
			
			aLi[i].index=i;
			$(aLi[i]).css({'z-index':'2'});
		}
		

		
		$(oUl).delegate("img","mousedown",function(ev){
		
				
		
				var oEvent=ev||event;
				var obj = $(this).parent().parent()[0];
				obj.style.zIndex=iMinZindex++;
				
				var disX=oEvent.clientX-obj.offsetLeft;
				var disY=oEvent.clientY-obj.offsetTop;
				
				document.onmousemove=function (ev)
				{
					var oEvent=ev||event;
					$(obj).css({'opacity':'0.7'});
					obj.style.left=oEvent.clientX-disX+'px';
					obj.style.top=oEvent.clientY-disY+'px';
					
					for(i=0;i<aLi.length;i++)
					{
						$(aLi[i]).removeClass('DD_drag_active');
					}
					//alert(obj);
					var oNear=_This.findNearest(obj,aLi);
					
					if(oNear)
					{
						$(oNear).addClass('DD_drag_active');
					}
					
					
					
										
				};
				document.onmouseup=function (ev)
				{				
					document.onmousemove=null;
					document.onmouseup=null;
						
						
						
					var oNear=_This.findNearest(obj,aLi);
					
					if(oNear)
					{
						/*oNear->obj
						obj->oNear*/
						$(oNear).removeClass('DD_drag_active');
						
						oNear.style.zIndex=iMinZindex++;
						obj.style.zIndex=iMinZindex++;
						
						startMove(oNear, aPos[obj.index]);
						startMove(obj, aPos[oNear.index]);
						
						var tmp=0;
						
						tmp=obj.index;
						obj.index=oNear.index;
						oNear.index=tmp;
						
						var sort1=$(oNear).find('.DD_picsAtttr').find('input[name="'+_This.button_id+'_sort[]"]');
						var sort2=$(obj).find('.DD_picsAtttr').find('input[name="'+_This.button_id+'_sort[]"]');
						var tempSort=0;   //alert($(oNear).html()+'--');
						tempSort=sort1.attr('value');	
						sort1.attr('value',sort2.attr('value'));		
						sort2.attr('value',tempSort);
						//sort1.val(sort2.attr('value'));
						//sort2.val(tempSort);
					}
					else
					{
						startMove(obj, aPos[obj.index]);
					}
					
					$(obj).css({'opacity':'1'});
				
				
					
				};
				
				clearInterval(obj.timer);
				oEvent.preventDefault();
				return false;
			
		});
	
	}
	
	this.findNearest=function(obj,aLi)	//找到碰上的，并且最近的
	{
		var iMin=999999999;
		var iMinIndex=-1;
		
		for(i=0;i<aLi.length;i++)
		{
			if(obj==aLi[i])continue;
			
			if(_This.cdTest(obj, aLi[i]))
			{
				var dis=_This.getDis(obj, aLi[i]);
				
				if(iMin>dis)
				{
					iMin=dis;
					iMinIndex=i;
				}
			}
		}
		
		if(iMinIndex==-1)
		{
			return null;
		}
		else
		{
			return aLi[iMinIndex];
		}
	}
	
	this.cdTest=function(obj1, obj2)
	{
		var l1=obj1.offsetLeft;
		var r1=obj1.offsetLeft+obj1.offsetWidth;
		var t1=obj1.offsetTop;
		var b1=obj1.offsetTop+obj1.offsetHeight;
		
		var l2=obj2.offsetLeft;
		var r2=obj2.offsetLeft+obj2.offsetWidth;
		var t2=obj2.offsetTop;
		var b2=obj2.offsetTop+obj2.offsetHeight;
		
		if(r1<l2 || l1>r2 || b1<t2 || t1>b2)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	this.getDis=function(obj1, obj2)
	{
		var a=obj1.offsetLeft-obj2.offsetLeft;
		var b=obj1.offsetTop-obj2.offsetTop;
		
		return Math.sqrt(a*a+b*b);
	}
	
	
	
	
	this.makeDialogFrameCenter=function(){
		this.operateRange=$('.DD_wrap[names="'+_This.name+'"]'); 
		$('.DD_wrap[names="'+_This.name+'"]').css({
			'left':($(window).width()-700)/2+($(document).width()-$(window).width()),
			'top':($(window).height()-500)/2+($(document).height()-$(window).height()),
		});
	}
	
	this.makeOverLayer=function(){
		
		$('body').append('<div id="multiOverLayer" style="position:fixed;width:100%; height:100%; top:0;left:0;z-index:1; background-color:white;opacity:0.6" ></div>');
	}
	
	this.loadMultiPicJs=function(){
		KindEditor.ready(function(K) {
			_This.editor = K.editor({
				allowFileManager : true,
				allowUpload : true,
				uploadJson : _This.upUrl,
			});
			var obj=_This.operateRange.find('.J_selectImage')[0]; 
			K(obj).click(function() {	
				_This.editor.loadPlugin('multiimage', function() {
					_This.editor.plugin.multiImageDialog({
						clickFn : function(urlList) {
							var odiv = _This.operateRange.find('.DD_list');
							K.each(urlList, function(i,data) {
								var pic='<li><a href="#" is_select="no" ><img  src="'+data.url+'" height="102px" width="102px" /></a>';
								pic+='<div class="toBig DD_picToBigBtn" style="background:url(/Public/images/tobig_btn.png) no-repeat;"   src="'+data.url+'" ></div>';
								pic+='<input type="hidden" name="'+_This.name+'" value="'+data.url+'" />';
								pic+=_This.attrs.attrsDiv;
								pic+='<script>';
								pic+=_This.attrs.attrJs;
								pic+='</script>';
								pic+='</li>';
								
								var exist_li = $('#'+_This.dragWrapId).find('li');
								
								var exist_li_Arr=exist_li.toArray();
								exist_li_Arr.sort(function(a,b){	
									sortA=$(a).find('.DD_picsAtttr')
										   .find('input[name="'+_This.button_id+'_sort[]"]')
										   .attr('value');
									sortB=$(b).find('.DD_picsAtttr')
										   .find('input[name="'+_This.button_id+'_sort[]"]')
										   .attr('value');
									return parseInt(sortA)-parseInt(sortB);
								});	
								
								
								
								$('#'+_This.dragWrapId).empty();
								
								for(var i=0;i<exist_li_Arr.length;i++){
									$('#'+_This.dragWrapId).append(exist_li_Arr[i]);
									
								}
								
								exist_li.each(function(){
									$(this).css({'position':'','left':'','top':'','marginLeft':'12px','marginTop':'12px'});
								});
																
								var maxNum=_This.getMaxSort();   //获取当前最大排序值+1
								
								odiv.append(pic);
								
								var olis  = $('#'+_This.dragWrapId).find('li')
											.last()
											.find('.DD_picsAtttr')
											.find('input[name="'+_This.button_id+'_sort[]"]')
											.attr('value',maxNum);
								$('#'+_This.dragWrapId).undelegate('mousedown');			
								_This.addDrag();	
							});
							_This.editor.hideDialog();
						}
					});
				});
			});
		});
	}
	
	this.getMaxSort=function(){
		var maxNum	=	0;
		var olis=$('#'+_This.dragWrapId).find('li');
		olis.each(function(){
			var osort=$(this).find('.DD_picsAtttr').find('input[name="'+_This.button_id+'_sort[]"]');
			if(osort.attr('value')==''){
				osort.attr('value',0);
			}
			if(parseInt(osort.attr('value'))>maxNum){
				maxNum	=	parseInt( osort.attr('value') );
			}
		});
		
		return parseInt(maxNum)+1;
	}
	
	this.checkAll=function()
	{
		_This.operateRange.find('.DD_check_all').click(function(e){
			var is_all_check  =  $(this).attr('is_all_check');
			if(is_all_check=='no'){
				$('#'+_This.dragWrapId).find('li a').attr('is_select','yes');
				$('#'+_This.dragWrapId).find('li a img').css({'border':'3px solid red'});
				
				$(this).attr('is_all_check','yes');
			}else{
				$('#'+_This.dragWrapId).find('li a').attr('is_select','no');
				$('#'+_This.dragWrapId).find('li a img').css({'border':'1px solid gray'});
				
				$(this).attr('is_all_check','no');
			}
		});
	}
	
	this.addSelectEvent=function(){
		_This.operateRange.delegate(".DD_list li img", "click", function(e){
			var is_select=$(this).parent().attr('is_select'); 
			if(is_select=='no'){
				$(this).css({'border':'3px solid red'});
				$(this).parent().attr('is_select','yes');
			}else{
				$(this).css({'border':'1px solid gray'});
				
				//$(this).parent().find('input').remove();
				$(this).parent().attr('is_select','no');
			}
			var OE =e||window.event;
				OE.preventDefault();
		});
	}
	
	
	
	this.addDragEvent=function(){
		//document.ondragstart = function () { return false; }; //禁止浏览器的拖拽行为 
		//document.onselectstart = function () {return false; };
		var dragObj=_This.operateRange.find('.DD_title')[0];//alert(dragObj);
		var targetObj=_This.operateRange[0];//alert(targetObj);
		this.dragObj=$(dragObj);
		this.targetObj=$(targetObj);
		this.dnr = new DragResize($(targetObj)[0], {'minWidth':150, 'minHeight':150});
		this.dragObj.mousedown(function(e){
			_This.dnr.drag(e);
		});
	}
	
	this.numsDelPics=function(){
		_This.operateRange.find('.nums_del_pics').click(function(){
			if(confirm('你确定删除选中的图片？')){
				_This.operateRange.find('a[is_select="yes"]').each(function(){
					$(this).parent().remove();
				}); 
			}
		});
	}
	
	this.addShowEvent=function(){
		$('#'+_This.button_id).click(function(){
			_This.operateRange.fadeIn(function(){
				_This.addDrag();
				_This.makeOverLayer();						//添加遮罩层
			});
		});
	}
	
	this.addCloseEvent=function(){
		_This.operateRange.find('.DD_close').click(function(){
			_This.operateRange.fadeOut();
			$('#multiOverLayer').remove();
		});
	}
	
	this.addPicsAttr=function(){
		_This.operateRange.delegate(".DD_list li img", "dblclick", function(e){
			var obj=$(this).parent().parent().find('.DD_picsAtttr');//alert(obj.length);	
			$('.DD_picsAtttr').fadeOut();
			obj.fadeIn();
			_This.setPicsAttrCenter();
			
			
		});
	}
	this.setPicsAttrCenter=function(){
		_This.operateRange.find('.DD_picsAtttr').css({
			'left':($(window).width()-720)/2,
			'top':($(window).height()-400)/2
		});
		
	}
	
	this.closePicsAttr=function(){
		_This.operateRange.delegate(".DD_picAttrClose", "click", function(e){
			_This.operateRange.find('.DD_picsAtttr').fadeOut();	
		});
	}
	
	this.makeAjaxSingleUpload=function(){
		KindEditor.ready(function(K) {
				_This.editor = K.editor({
					allowFileManager : true,
					uploadJson : _This.upUrl,
				});

				K('#cm_'+_This.button_id).click(function() {
					_This.editor.loadPlugin('image', function() {
						_This.editor.plugin.imageDialog({
							showRemote : false,
							imageUrl : K('#url3').val(),
							clickFn : function(url, title, width, height, border, align) {
								
								var oinput=$('input[name="'+_This.name+'"]');
								var toBigBtn=$('#'+_This.name+'_toBig');
								oinput.val(url);
								toBigBtn.attr('src',url);
								_This.editor.hideDialog();
							}
						});
					});
				});
			});
	}
	

	
	this.makeEditor=function(){
		KindEditor.ready(function(K) {
			_This.editor = K.create('textarea[name="'+_This.name+'"]', {
				resizeType : 1,
				allowFileManager : true,
				allowUpload : true,
				uploadJson : _This.upUrl,
			});
		});
	}
	
	this.makeFileUpload=function(){
		KindEditor.ready(function(K) {
			_This.editor = K.editor({
				allowFileManager : true,
				uploadJson : _This.upUrl,
			});
			K('#'+_This.button_id).click(function() {
				_This.editor.loadPlugin('insertfile', function() {
					_This.editor.plugin.fileDialog({
						fileUrl : K('#url').val(),
						clickFn : function(url, title) {
							var oinput=$('input[name="'+_This.name+'"]');
							
							oinput.val(url);
							_This.editor.hideDialog();
						}
					});
				});
			});
		});
	}

	this.init=function(){
		if(_This.edictor_type==1){									//图册类型
			$('#'+_This.button_id).parent().append(_This.makeDialogFrame());
			_This.makeDialogFrameCenter();
			_This.loadMultiPicJs();
			_This.addCloseEvent();
			_This.addShowEvent();
			_This.addSelectEvent();
			_This.numsDelPics();
			_This.addPicsAttr();
			_This.closePicsAttr();
			_This.checkAll();
			
			
			
			
			$(window).resize(function(){
				_This.makeDialogFrameCenter();
			});
			
			//_This.addDragEvent();
		}
		if(_This.edictor_type==2){									//单图片
			_This.makeAjaxSingleUpload();
		}
		
		if(_This.edictor_type==3){									//编辑器
			_This.makeEditor();
		}
		
		if(_This.edictor_type==4){									//-----
			_This.makeJqDialog();
		}
		
		if(_This.edictor_type==5){									//文件
			_This.makeFileUpload();
		}
		
	}
	
	_This.init();
}








//验证类    验证类		验证类    验证类		验证类    验证类		验证类    验证类		验证类    验证类		验证类    验证类

function formValidator(formId,attrs){ 
	var _This=this;
	
	this.addValidator=function(){
		for(var i in attrs){
			if(attrs[i].is_validate==1){
					new inputValidator('#'+attrs[i].column_name,attrs[i]);
			}
		}
	}
	
	
	this.init=function(){
	
		$.formValidator.initConfig({formID:formId,theme:'ArrowSolidBox',mode:'AutoTip',onError:function(msg){},inIframe:true});
	
		_This.addValidator();
	}
	
	_This.init();
}

function inputValidator(selector,attrs){
	var _This=this;
	this.attrs=attrs;
	this.selector=selector;
	
	this.checkAttrs=function(){
		if(_This.attrs.onShow===undefined){
			_This.attrs.onShow='';
		}
		if(_This.attrs.onFocus===undefined){
			_This.attrs.onFocus='';
		}
		if(_This.attrs.onCorrect===undefined){
			_This.attrs.onCorrect='正确';
		}
		if(_This.attrs.min===undefined){
			_This.attrs.min='0';
		}
		
		if(_This.attrs.max===undefined){
			_This.attrs.max='999999';
		}
		
		if(_This.attrs.onError===undefined){
			_This.attrs.onError='';
		}
		
		if(_This.attrs.dataType===undefined){
			_This.attrs.dataType='enum';
		}
		
	}
	
	
	this.addFormValidator=function(){  			
		var msg={								
			onShow		:		_This.attrs.onShow,
			onFocus		:		_This.attrs.onFocus,
			onCorrect	:		_This.attrs.onCorrect
		};
		//console.log(msg);		
		$(_This.selector).formValidator(msg)
	}
	
	this.addInputValidator=function(){
		var msg={
				min		:		_This.attrs.min,
				max		:		_This.attrs.max,
				onError	:		_This.attrs.onError
		}
		//console.log(msg);	
		$(_This.selector).inputValidator(msg)
	}
	
	this.addRegexValidator=function(){
		var msg={
				regExp		:		_This.attrs.regExp,
				dataType	:		_This.attrs.dataType,
				onError		:		_This.attrs.onError
		}
		$(_This.selector).regexValidator(msg)
	}
	
	this.init=function(){
		_This.checkAttrs();
		_This.addFormValidator();
		_This.addInputValidator();
		if(!(_This.attrs.regExp===undefined)){	
			_This.addRegexValidator();
		}
	}
	
	_This.init();
	
	
} 

//联动菜单     联动菜单    联动菜单    联动菜单    联动菜单    联动菜单    联动菜单    联动菜单

function makeLianDong(name){
	this.ul = $('#DD_LIANDONG_'+name);
	this.wrap = $('div[DD_lianDong_wrap='+name+']');
	this.hidden = $('input[name='+name+']');
	this.selectedInfo = $('div[DD_lianDong='+name+']');
	this.stack = [];
	
	this.init=function(){
		this.addShowEvent();
		this.addLianEvent();
		this.addSelectEvent();
		this.add_right_jiantou();
	} 
	
	this.add_right_jiantou = function(){
		var _This = this;
		var olis = _This.wrap.find('li');
		
		olis.each(function(){
			var sub_li = $(this).find('>ul >li');
			if(sub_li.length>0){
				//$(this).append('<img src="/Public/images/icons/lianjian.png" style="position:absolute; right:6px; top:10px" />');
				$(this).append('<font style="height:28px; line-height:28px; width:18px; position:absolute; right:-3px; top:-1px; color:#FFF"; display:block>›</font>');
			}
		});
		
		
	}
	
	this.addShowEvent=function(){
		var _This = this;
		_This.wrap.mouseover(function(){
			$(this).find('.DD_LIST_TT').show();
		});
		_This.wrap.mouseout(function(){
			$(this).find('.DD_LIST_TT').hide();
		});
	}
	
	this.addLianEvent=function(){
		var _This = this;
		_This.ul.find('li').mouseover(function(){
			_This.stack.push(this);
			document.title = _This.stack.length;
			$(this).find('>ul').stop(true,false).fadeIn('normal',function(){
				
			});
			
		});
		
		_This.ul.find('li').mouseout(function(){
			_This.stack.pop();
			document.title = _This.stack.length;
			$(this).find('>ul').stop(true,true).fadeOut('normal',function(){
				
			});
			
		});
	}
	this.addSelectEvent=function(){
		var _This = this;
		_This.ul.find('li').click(function(e){
				e.stopPropagation(); 
				_This.hidden.val( $(this).data('value') );
				_This.selectedInfo.html( $(this).data('text')  );	
				
				var stack_info = [];
				for(var i=_This.stack.length-1;i>=0;i--){
					var info = $(_This.stack[i]).data('text');
					stack_info+=info;
					if(i!=0){
						stack_info+='<font style="color:red; font-weight:700"> --></font>';
					}
				}

				_This.selectedInfo.html(stack_info );	
				_This.selectedInfo.css({background:'#000',color:'#FFF'});
				_This.selectedInfo.stop(true,false).animate({backgroundColor:'#fff',color:'#000'});			
		});
	}
	/*
	if($(this).find('>ul>li').length==0){
				_This.hidden.val( $(this).data('value') );			
				_This.selectedInfo.html( $(this).data('text')  );
							
			}
	*/
	
	this.init();
}




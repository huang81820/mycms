function buildPicDialog(selector,attrs,imgStyle){
	var _This=this;
	this.objs=selector;	
	this.attrs=attrs;			
	this.imgStyle=imgStyle==''?{}:imgStyle;

	this.addEvent=function(){
		
		$('body').delegate(_This.objs, "click", function(e){	
			var src=$(this).attr('src'); 	
			$('body').append('<div id="PicDialog_Cover" style="display:none; position:absolute; opacity:0.6; background-color:white; left:0; top:0; z-index:1000"></div>');
			$('#PicDialog_Cover').css({'width':$(document).width(),'height':$(document).height()}).fadeIn();
			
			var style='style="display:block;border:none;';
			
			for(var i in _This.imgStyle){		
				style+=i+':'+_This.imgStyle[i]+';';
			}
			style+='"';
			
		
			var imgs='<div id="PicDialog_wrap_border" style="display:none;padding:8px;position:fixed;z-index:1001; background-color:black; "><img '+style+' src="'+src+'" width='+_This.attrs.width+'  /></div>';
			$('body').append(imgs);
			var left=($(document).width()-$('#PicDialog_wrap_border').width())/2;
			$('#PicDialog_wrap_border').css({'left':left,'top':40});	 //alert($(document).scrollTop());	alert($(document).height()); //return false;
			$('#PicDialog_wrap_border').append('<img style="display:block;height:22px;width:22px;position:absolute;right:-10px;top:-8px;" id="PicDialog_close" src="/Public/images/cross_circle2.png" width="22" height="22" alt="关闭" />').slideDown();
			return false;
		});
	
		$("body").delegate("#PicDialog_close", "click", function(){
				$('body').find('#PicDialog_Cover').fadeOut().remove();
				$('body').find('#PicDialog_wrap_border').slideUp(function(){
					$(this).remove();
				})
		});
	}
	
	this.init=function(){
		
		_This.addEvent();
		
	}
	
	
	_This.init();
}
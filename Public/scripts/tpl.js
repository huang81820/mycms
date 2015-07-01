

function makeDialog(attr_json){
		$('body').append('<div id="my_cover"></div>');
		$('#my_cover').css({'width':$(window).width(),'height':$(window).height()});
		$('body').append('<div id="my_main"></div>');
		$('#my_main').css({
			'left':($(window).width()-attr_json.width)/2-80,
			'top':($(window).height()-attr_json.height)/2-50,
			'width':attr_json.width,
			'height':attr_json.height,
		});
		$('#my_main').html('<div id="my_top"><font id="mt_title">我的标题</font><a id="my_close" href="#"></a></div><div id="my_con"></div>');
		$('#my_main').fadeIn();
		$('#mt_title').html(attr_json.tittle)
		$('#my_con').html(attr_json.body);
		$("body").delegate("#my_close", "click", function(){
			closeDialog();
		});
		
}


function closeDialog(){
		$(this).unbind('click');
		$('#my_cover').animate({'opacity':0},250)
		$('#my_main').animate({'opacity':0},250,function(){
			$('#my_cover').remove();
			$('#my_main').remove();
		});
}
(function(window){
	
	function Slider(wrap){
		this.wrap = $(wrap);
		this.ul = this.wrap.find('ul');
		this.li = this.ul.find('li');
		this.timer = null;
		this.iNow = 0;
		
		this.init();	 
	}
	
	Slider.prototype.init = function(){
		var ThisSlider = this;
		var len = ThisSlider.li.length;
		
		ThisSlider.ul.css({width : len * ThisSlider.ul.width()});
		//添加半透明按钮
		var btn = "<div class='btnBg'></div><div class='btn'>";
		for(var i=0; i < len; i++) {
			btn += "<span></span>";
		}
		btn += "</div><div class='preNext pre'></div><div class='preNext next'></div>";
		ThisSlider.wrap.append(btn);
				
		ThisSlider.wrap.find('.btnBg').css("opacity",0.5);
		
		ThisSlider.wrap.find('.btn span').css("opacity",0.4).mouseover(function() {
			index = ThisSlider.wrap.find('.btn span').index(this);
			_showPic.call(ThisSlider,index);
		});
		
		_setAutoPlay.call(ThisSlider);
		
	}
	
	//设置自动播放
	var _setAutoPlay = function(){
		
		var ThisSlider = this;
		ThisSlider.wrap.on('mouseover',function(){
			clearInterval(ThisSlider.timer);	
		});
		
		ThisSlider.wrap.on('mouseout',function(){
			ThisSlider.timer = setInterval(function(){
				ThisSlider.iNow+=1;
				ThisSlider.iNow = ThisSlider.iNow == ThisSlider.li.length ? 0 :	ThisSlider.iNow;
				_showPic.call(ThisSlider,ThisSlider.iNow);
			},3000);
		});
		
		ThisSlider.wrap.trigger('mouseout');	
	}
	
	//显示 图片切换 和 按钮切换
	var _showPic = function(index){
		var nowLeft = -(index * this.wrap.width()); 
		
		this.ul.stop(true,false).animate({"left":nowLeft},300); 
		
		this.wrap.find(".btn span").stop(true,false).animate({"opacity":"0.4"},300).eq(index).stop(true,false).animate({"opacity":"1"},300);
	
		this.iNow = index;		
	}
	
	
	
	
	
	
		
	window.Slider = Slider;
	
})(window);
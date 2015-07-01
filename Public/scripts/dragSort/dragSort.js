function dragSort(dragWraperId,table_name,ajaxURL){
	
	var _This=this;
	this.oUl=document.getElementById(dragWraperId);
	this.aLi=$(this.oUl).find('.table_row,.table_thead');
	this.table_name = table_name;
	this.aPos=[];
	this.iMinZindex=2;
	this.ajaxURL=ajaxURL;
	this.width=(100/_This.aLi[0].getElementsByTagName('span').length)-0.3;
	
	//alert(this.aLi.length);
	
	//布局转换
	
	this.setPos=function(){
		//alert('b');
		for(var i=0;i<_This.aLi.length;i++)
		{	
			
			var tempSpan=_This.aLi[i].getElementsByTagName('span');		
			for(var j=0;j<tempSpan.length;j++)
			{	
				tempSpan[j].style.width=_This.width+'%';
			}
			_This.aPos[i]={left: _This.aLi[i].offsetLeft, top: _This.aLi[i].offsetTop};
		}
		
		for(var i=0;i<_This.aLi.length;i++)
		{
			_This.aLi[i].style.left=_This.aPos[i].left+'px';
			_This.aLi[i].style.top=_This.aPos[i].top+'px';
			
			_This.aLi[i].style.position='absolute';
			_This.aLi[i].style.margin='0';
			
			_This.aLi[i].index=i;
		}
		
		_This.oUl.style.height=_This.aLi.length*40+40+'px';
		//_This.oUl.style.background='red';
		
		
		
	}
	
	
	
	
	this.setDrag=function(obj)
	{
		obj.onmousedown=function (ev)
		{
			var oEvent=ev||event;
			
			obj.style.zIndex=_This.iMinZindex++;
			
			var disX=oEvent.clientX-obj.offsetLeft;
			var disY=oEvent.clientY-obj.offsetTop;
			
			document.onmousemove=function (ev)
			{
				var oEvent=ev||event;
				
				obj.style.left=oEvent.clientX-disX+'px';
				obj.style.top=oEvent.clientY-disY+'px';
				
				for(var i=0;i<_This.aLi.length;i++)
				{
					//_This.aLi[i].className='';
					$(_This.aLi[i]).removeClass('active');
				}
				
				var oNear=_This.findNearest(obj);
				
				if(oNear)
				{
					//oNear.className='active';
					$(oNear).addClass('active');
				}
				
				
			};
			
			document.onmouseup=function ()
			{
				document.onmousemove=null;
				document.onmouseup=null;
				
				var oNear=_This.findNearest(obj);
				
				if(oNear)
				{	
					//判断是否为表头，是则还原原来的位置并返回
					if($(oNear).hasClass("table_thead")){
						startMove(obj, _This.aPos[obj.index]);
						$(oNear).removeClass('active');
						return;
					}
					oNear.className='';
					
					oNear.style.zIndex=_This.iMinZindex++;
					obj.style.zIndex=_This.iMinZindex++;
					
					startMove(oNear, _This.aPos[obj.index]);
					startMove(obj, _This.aPos[oNear.index]);
					
					var tmp=0;
					
					tmp=obj.index;
					obj.index=oNear.index;
					oNear.index=tmp;
					
					//拖拽完毕执行回调函数
					var target=$(oNear).find('input[type="checkbox"]').val();
					var origin=$(obj).find('input[type="checkbox"]').val(); //alert(_This.ajaxURL);
					$.get(_This.ajaxURL,{'origin':origin,'target':target,table_name:_This.table_name},function(data){
						Message('操作成功');
					});
					
				}
				else
				{
					startMove(obj, _This.aPos[obj.index]);
				}
			};
			
			clearInterval(obj.timer);
			
			return false;
		};
	}
	
	//碰撞检测
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
	
	this.findNearest=function(obj)	//找到碰上的，并且最近的
	{
		var iMin=999999999;
		var iMinIndex=-1;
		
		for(var i=0;i<_This.aLi.length;i++)
		{
			if(obj==_This.aLi[i])continue;
			
			if(_This.cdTest(obj, _This.aLi[i]))		
			{	
				var dis=_This.getDis(obj, _This.aLi[i]);
				
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
			return _This.aLi[iMinIndex];
		}
	}
	
	
	this.init=function(){
		
		_This.setPos();
		
		//拖拽
		for(var i=1;i<_This.aLi.length;i++)
		{	
			_This.setDrag(_This.aLi[i]);
			var tempSpan=_This.aLi[i].getElementsByTagName('span');
			for(var j=0;j<tempSpan.length;j++)
			{
				if(j!=0){
					tempSpan[j].onmousedown=function(e){
						if(e && e.stopPropagation){
							e.stopPropagation();
						}else{
							window.event.cancelBubble = true;
						}
					}
				}
			}
		}
	}
	
	_This.init();
	
	
	
}

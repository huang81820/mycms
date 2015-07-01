function dragSort(dragWraperId,dragClassName,ajaxURL){
	//alert('#'+dragWraperId+' >div');
	var _This=this;
	this.oUl=document.getElementById(dragWraperId);
	this.aLi=_This.oUl.getElementsByTagName('div');
	this.aPos=[];
	this.iMinZindex=2;
	this.ajaxURL=ajaxURL;
	this.rowsWidth = [];
	this.rowsHeight = [];
	//this.width=(100/_This.aLi[0].getElementsByTagName('span').length)-0.3;
	
	
	
	//����ת��
	
	this.setPos=function(){
		
		for(var i=0;i<_This.aLi.length;i++)
		{				
			_This.aPos[i]={left: _This.aLi[i].offsetLeft, top: _This.aLi[i].offsetTop };
		}
				
		var one_row = $(_This.aLi[0]).find('>span');
		
		for(var i=0;i<one_row.length;i++)
		{	
			_This.rowsWidth[i]  = one_row[i].offsetWidth;						
			_This.rowsHeight[i] = one_row[i].offsetHeight;						
		}
		//console.log(_This.rowsWidth);
				
		for(var i=0;i<_This.aLi.length;i++)
		{
			_This.aLi[i].style.left=_This.aPos[i].left+'px';
			_This.aLi[i].style.top=_This.aPos[i].top+'px';			
			_This.aLi[i].style.position='absolute';		
			_This.aLi[i].style.margin='0';			
			_This.aLi[i].index=i;			
		}
		
		for(var i=0;i<_This.aLi.length;i++)
		{
			var set_one_row = $( _This.aLi[i] ).find('>span');
			alert(set_one_row.length);
			for(var j=0;j<set_one_row.length;j++)
			{
				set_one_row.eq(j).css({width: ( _This.rowsWidth[j]-2)+'px'  ,  height: _This.rowsHeight[j]+'px' ,'display':'block' ,'float':'left' });

				// set_one_row[j].style.width = _This.rowsWidth[j]-2+'px';
				// set_one_row[j].style.height= _This.rowsHeight[j]+'px';
				// set_one_row[j].style.display= 'block';
				// set_one_row[j].style.cssFloat= 'left';
			}
		}

		_This.oUl.style.height=_This.aLi.length*36+'px';
	
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
					//�ж��Ƿ�Ϊ��ͷ������ԭԭ����λ�ò�����
					if($(oNear).hasClass("thead")){
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
					
					//��ק���ִ�лص�����
					var target=$(oNear).find('input[type="checkbox"]').val();
					var origin=$(obj).find('input[type="checkbox"]').val(); //alert(_This.ajaxURL);
					$.get(_This.ajaxURL,{'origin':origin,'target':target},function(data){
						
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
	
	//��ײ���
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
	
	this.findNearest=function(obj)	//�ҵ����ϵģ����������
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
		
		//��ק
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
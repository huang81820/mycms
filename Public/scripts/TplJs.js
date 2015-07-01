function tplFuns(href,baseCanshu){
	var _This=this;
	this.listHref=href;
	this.baseCanshu=baseCanshu=='' ? {} : baseCanshu;
	this.deleteMsg={'1':'删除成功','2':'删除失败'};
	this.CM_listArea='CM_listArea';
	this.CM_pagination='CM_pagination';
	this.CM_ediLink='.CM_ediLink';
	this.CM_deleteLink='.CM_deleteLink';
	this.CM_header='.CM_header';
	this.CM_boxList='.CM_boxList';
	this.CM_ediBox='#CM_ediBox';
	this.CM_selectBtn='CM_selectBtn';
	this.CM_reflesh='#CM_reflesh';
	
	this.showChangeList=function(href,canshu){
		if(canshu==''){
			var canshu={};
		}
		
		for(var i in _This.baseCanshu){
			canshu[i]=_This.baseCanshu[i];
		}
		
		$.get(href,canshu,function(data){    //alert(data);return false; 
			$('#'+_This.CM_listArea).slideUp();
			var json=eval('('+data+')');
			$('#'+_This.CM_listArea).html(json.list_info);
			$('#'+_This.CM_listArea).slideDown();
			$('.'+_This.CM_pagination).html(json.page);
			var obj='.'+_This.CM_pagination+' a,.'+_This.CM_pagination+' p'; //alert(json.page);return false;
			$(obj).addClass('number');
			$('.'+_This.CM_pagination+' a').click(function(){
				var ohref=$(this).attr('href');
				_This.showChangeList(ohref,canshu);
				return false;
			});
			$('tbody tr:even').addClass("alt-row");
		});
	}
	
	
	this.setBaseSlideSet=function(){
		$("body").delegate(_This.CM_header, "click", function(){
			if($(this).parent().find(_This.CM_boxList).attr('is_current')=='yes'){
				return false;
			}
			$(_This.CM_boxList).slideUp();
			$(_This.CM_boxList).attr('is_current','no');
			$(this).parent().find(_This.CM_boxList).slideToggle();
			$(this).parent().find(_This.CM_boxList).attr('is_current','yes');
		});
		
	}
	
	this.setBaseEdiAction=function()
	{	
		$('#'+_This.CM_listArea).delegate(_This.CM_ediLink, "click", function(){				
			_This.listAreatToEdi();	
			
			$.get($(this).attr('href'),{},function(data){		
				$(_This.CM_ediBox).html('');
				$(_This.CM_ediBox).append(data);
				$('tbody tr:even').addClass("alt-row");
			});
			return false;
		});
	}
	
	this.setBaseDeleteAction=function(){	
		$('#'+_This.CM_listArea).delegate(_This.CM_deleteLink, "click", function(){				
			var This=$(this);
			if(confirm('你确定删除该记录')){
				$.get($(this).attr('href'),{},function(data){
					if(data==1){
						This.parent().parent().remove();
						alert(_This.deleteMsg[data]);
					}else{
						alert(_This.deleteMsg[data]);
					}
				});
			}
			return false;
		});
	}
	
	
	this.setBaseSelectAction=function(){	
		$('body').delegate('.'+_This.CM_selectBtn, "click", function(){	
			var data={};
			$(this).parent().find('input').each(function(){	
				var name=$(this).attr('name');
				data[name]=$(this).val();
			});
			
			$(this).parent().find('select').each(function(){	
				var name=$(this).attr('name');	
				data[name]=$(this).val();
			});
			
			_This.showChangeList(_This.listHref,data);
			
			return false;
		});
	}
	
	
	this.listAreatToEdi=function(){
		$(_This.CM_boxList).attr('is_current','no');
		$(_This.CM_boxList).slideUp();
		$(_This.CM_ediBox).attr('is_current','yes');
		$(_This.CM_ediBox).slideDown();
	}
	
	
	this.addRefleshEvent=function(){
		$('body').delegate(_This.CM_reflesh, "click", function(){	
			_This.showChangeList(_This.listHref,_This.baseCanshu);
			return false;
		});
	}
	
	
	
	
	this.init=function(){		
		_This.showChangeList(_This.listHref,_This.baseCanshu);
		_This.setBaseSlideSet();
		_This.setBaseEdiAction();
		_This.setBaseDeleteAction();
		_This.setBaseSelectAction();
		_This.addRefleshEvent();
	}
	
	
	_This.init();
	
}





$(document).ready(function(){

	//根据表单类型显示相应输入项
	$('select[name=column_type]').change(function(){
		var column_type = $(this).attr('value');
		$('.DD_ACTIVE_LAYER').hide();
		switch( column_type )
		{
			case 'select':
				
				$('.DD_SELECT_LAYER').show();
				break;
				
			case 'multiPic':
				
				$('.DD_MPIC_LAYER').show();
				break;
			case 'radio':
				
				$('.DD_RADIO_LAYER').show();
				break;
			case 'checkedbox':
				
				$('.DD_CHECKBOX_LAYER').show();
				break;
			
		}
		
	});
	
	//下拉表单事件的闭包
	(function(){
		//添加键值组
		$('#DD_ADD_SELECT_STATIC_INPUT').click(function(){
			var input_wrap = $('#DD_SELECT_STATIC_INPUT');
			var str='';
			str += '<div class="DD_SELECT_STATIC_INPUT_WRAP">';
			str += '键：<input type="text" name="select_static_key[]" style="width:120px;" /> ';
			str += '值：<input type="text" name="select_static_value[]" style="width:120px;" /></br>';
			str += '</div>';
			input_wrap.append(str);
		});
	
		$('#DD_DEL_SELECT_STATIC_INPUT').click(function(){
			var last = $('.DD_SELECT_STATIC_INPUT_WRAP').last();
			if(  $('.DD_SELECT_STATIC_INPUT_WRAP').length>1   ){
				last.remove();
			}
			
		});
		
		//使用静态数据时 设置默认键值 
		$('input[name=selectType]').click(function(){
		alert( $(this).val());
			if( $(this).val() == 1 ){
				$('input[name=select_value_key]').val('value');
				$('input[name=select_value_desc]').val('desc');
			}
		});
		
	})();
	
	
	(function(){
		var input_type = "{$inputType}";
		if(input_type!=''){
			
			$('select[name=column_type]').val(input_type).trigger('change');
			
		}
		
	})();
	
	//多图片事件
	(function(){
		$('#DD_ADD_MPIC_STATIC_INPUT').click(function(){
			var input_wrap = $('#DD_MPIC_STATIC_INPUT');
			var str='';
			str += '<div class="DD_MPIC_STATIC_INPUT_WRAP">';
			str += '属性name：<input type="text"  name="mpic_attr_name[]" style="width:100px"/> &nbsp;&nbsp;';
			str += '属性提示：<input type="text"  name="mpic_attr_desc[]" style="width:100px"/> &nbsp;&nbsp;';
			
			str += '组件类型：<select name="mpic_attr_type[]" style="width:100px"> ';
			str += '<option value="1">单行文本</option>   <option value="3">编辑器</option>	';
			str += '</select> &nbsp;&nbsp;';
			
			str += '排序：<input type="text" value="0" name="mpic_attr_sort[]" style="width:100px"/> ';
			str += '</div>';
			input_wrap.append(str);
			

		});
	
		$('#DD_DEL_MPIC_STATIC_INPUT').click(function(){
			var last = $('.DD_MPIC_STATIC_INPUT_WRAP').last();
			if(  $('.DD_MPIC_STATIC_INPUT_WRAP').length>1   ){
				last.remove();
			}
			
		});
		
	})();
	
	
	//radio相关处理
	(function(){
		$('#DD_ADD_RADIO_STATIC_INPUT').click(function(){
			var input_wrap = $('#DD_RADIO_STATIC_INPUT');
			var str='';
			str += '<div class="DD_RADIO_STATIC_INPUT_WRAP">';
			str += '键：<input type="text" name="radio_static_key[]" style="width:120px;" /> ';
			str += '值：<input type="text" name="radio_static_value[]" style="width:120px;" /></br>';
			str += '</div>';
			
			input_wrap.append(str);
		});
		
		$('#DD_DEL_RADIO_STATIC_INPUT').click(function(){
			var last = $('.DD_RADIO_STATIC_INPUT_WRAP').last();
			if(  $('.DD_RADIO_STATIC_INPUT_WRAP').length>1   ){
				last.remove();
			}
			
		});
		
	})();
	
	
	
	//checkbox相关处理
	(function(){
		$('#DD_ADD_CHECKBOX_STATIC_INPUT').click(function(){
			var input_wrap = $('#DD_CHECKBOX_STATIC_INPUT');
			var str='';
			str += '<div class="DD_CHECKOX_STATIC_INPUT_WRAP">';
			str += '键：<input type="text" name="checkbox_static_key[]" style="width:120px;" /> ';
			str += '值：<input type="text" name="checkbox_static_value[]" style="width:120px;" /></br>';
			str += '</div>';
			
			input_wrap.append(str);
		});
		
		$('#DD_DEL_CHECKBOX_STATIC_INPUT').click(function(){
			var last = $('.DD_CHECKOX_STATIC_INPUT_WRAP').last();
			if(  $('.DD_CHECKOX_STATIC_INPUT_WRAP').length>1   ){
				last.remove();
			}
			
		});
		
	})();
	
	
	
});



$(document).ready(function(){

	//根据表单类型显示相应输入项
	$('select[name=column_type]').change(function(){
		var column_type = $(this).attr('value');
		$('.DD_ACTIVE_LAYER').hide();
		switch( column_type )
		{
			case 'select':
				//alert('a');
				$('.DD_SELECT_LAYER').show();
				break;
				
			case 'multiPic':
				
				$('.DD_MPIC_LAYER').show();
				break;
			case 'radio':
				
				$('.DD_RADIO_LAYER').show();
				break;
			case 'checkedbox':
				
				$('.DD_CHECKBOX_LAYER').show();
				break;
			
		}
		
	});
	
	//下拉表单事件的闭包
	(function(){
		//添加键值组
		$('#DD_ADD_SELECT_STATIC_INPUT').click(function(){
			var input_wrap = $('#DD_SELECT_STATIC_INPUT');
			var str='';
			str += '<div class="DD_SELECT_STATIC_INPUT_WRAP">';
			str += '键：<input type="text" name="select_static_key[]" style="width:120px;" /> ';
			str += '值：<input type="text" name="select_static_value[]" style="width:120px;" /></br>';
			str += '</div>';
			alert(str);
			input_wrap.append(str);
		});
	
		$('#DD_DEL_SELECT_STATIC_INPUT').click(function(){
			var last = $('.DD_SELECT_STATIC_INPUT_WRAP').last();
			if(  $('.DD_SELECT_STATIC_INPUT_WRAP').length>1   ){
				last.remove();
			}
			
		});
		
		//使用静态数据时 设置默认键值 
		$('input[name=selectType]').click(function(){
		alert( $(this).val());
			if( $(this).val() == 1 ){
				$('input[name=select_value_key]').val('value');
				$('input[name=select_value_desc]').val('desc');
			}
		});
		
	})();
	
	
	(function(){
		var input_type = "{$inputType}";
		if(input_type!=''){
			
			$('select[name=column_type]').val(input_type).trigger('change');
			
		}
		
	})();
	
	//多图片事件
	(function(){
		$('#DD_ADD_MPIC_STATIC_INPUT').click(function(){
			var input_wrap = $('#DD_MPIC_STATIC_INPUT');
			var str='';
			str += '<div class="DD_MPIC_STATIC_INPUT_WRAP">';
			str += '属性name：<input type="text"  name="mpic_attr_name[]" style="width:100px"/> &nbsp;&nbsp;';
			str += '属性提示：<input type="text"  name="mpic_attr_desc[]" style="width:100px"/> &nbsp;&nbsp;';
			
			str += '组件类型：<select name="mpic_attr_type[]" style="width:100px"> ';
			str += '<option value="1">单行文本</option>   <option value="3">编辑器</option>	';
			str += '</select> &nbsp;&nbsp;';
			
			str += '排序：<input type="text" value="0" name="mpic_attr_sort[]" style="width:100px"/> ';
			str += '</div>';
			input_wrap.append(str);
			

		});
	
		$('#DD_DEL_MPIC_STATIC_INPUT').click(function(){
			var last = $('.DD_MPIC_STATIC_INPUT_WRAP').last();
			if(  $('.DD_MPIC_STATIC_INPUT_WRAP').length>1   ){
				last.remove();
			}
			
		});
		
	})();
	
	
	//radio相关处理
	(function(){
		$('#DD_ADD_RADIO_STATIC_INPUT').click(function(){
			var input_wrap = $('#DD_RADIO_STATIC_INPUT');
			var str='';
			str += '<div class="DD_RADIO_STATIC_INPUT_WRAP">';
			str += '键：<input type="text" name="radio_static_key[]" style="width:120px;" /> ';
			str += '值：<input type="text" name="radio_static_value[]" style="width:120px;" /></br>';
			str += '</div>';
			
			input_wrap.append(str);
		});
		
		$('#DD_DEL_RADIO_STATIC_INPUT').click(function(){
			var last = $('.DD_RADIO_STATIC_INPUT_WRAP').last();
			if(  $('.DD_RADIO_STATIC_INPUT_WRAP').length>1   ){
				last.remove();
			}
			
		});
		
	})();
	
	
	
	//checkbox相关处理
	(function(){
		$('#DD_ADD_CHECKBOX_STATIC_INPUT').click(function(){
			var input_wrap = $('#DD_CHECKBOX_STATIC_INPUT');
			var str='';
			str += '<div class="DD_CHECKOX_STATIC_INPUT_WRAP">';
			str += '键：<input type="text" name="checkbox_static_key[]" style="width:120px;" /> ';
			str += '值：<input type="text" name="checkbox_static_value[]" style="width:120px;" /></br>';
			str += '</div>';
			
			input_wrap.append(str);
		});
		
		$('#DD_DEL_CHECKBOX_STATIC_INPUT').click(function(){
			var last = $('.DD_CHECKOX_STATIC_INPUT_WRAP').last();
			if(  $('.DD_CHECKOX_STATIC_INPUT_WRAP').length>1   ){
				last.remove();
			}
			
		});
		
	})();
	
	
	
});



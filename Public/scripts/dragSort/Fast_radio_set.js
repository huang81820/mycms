//异步设置radio
function Fast_radio_set(table_id,table_name,ajax_set_url,status0_png,status1_png){
		
		var _This = this;
		this.table_name = table_name;
		this.ajax_set_button = $('#'+table_id).find('.ajax_set');
		
		this.init = function(){
			this.ajax_set_button.each(function(){
				
				$(this).click(function(){
					var This = this;
					var column_name = $(this).attr('columnname');
					var rowid = $(this).attr('rowid');
					var val = $(this).attr('val');
					var val_update= val==0 ? 1 :0;
					//alert(ajax_set_url);
					$.get(ajax_set_url,{table_name:table_name,column_name:column_name,rowid:rowid,val:val_update},function(data){
					
						
					
						if(data=='success'){
						
							Message('操作成功 ^_^');
							$(This).attr('val',val_update);
							var png = val_update == 0 ? status0_png : status1_png;
							$(This).attr('src',png);
							return;
						}
						if(data=='fail'){
						
							Message('操作失败 -_-！');
							return;
						}
						
					});
				});
			});
		}
		_This.init();
}



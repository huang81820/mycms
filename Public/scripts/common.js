$(document).ready(function(){
	
	$('tbody tr:even').addClass("alt-row");
	
	checkAll.call(window,'.cm_check_all','.cm_list_check');
	
	addBatchDelsEv();
});


function checkAll(allObj,operateObj){		
	$(allObj).click(function(){
		
		if($(this).attr('checked')=='checked'){
			$(operateObj).attr('checked',true);
		}else{
			$(operateObj).attr('checked',false);
		}
		
	});
}


function getCurrentCheck(){
	var str='';
	$('.list_check').each(function(){
		if($(this).attr('checked')=='checked'){
			str	+=	$(this).val() + ',';
		}
	});
	if(str!=''){
		return str.substr(0,str.length-1);
	}else{
		return false;
	}
}


function addBatchDelsEv(){

	$('#cm_batch_dels').click(function(){
	
	    var ids = '';
		
		$('.cm_list_check').each(function(){
			
			if($(this).attr('checked')=='checked'){
			
				ids+=$(this).attr('value')+',';
			}
			
		});
		
		ids = ids.substr(0,ids.length-1);
		
		ids = encodeURIComponent(ids);
		
		var href = $(this).attr('cm_href');
		
		window.location.href=href+'/ids/'+ids;
	});
}
	




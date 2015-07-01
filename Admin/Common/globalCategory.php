<?php


/*
*	获取分类菜单
*/
function global_cat_list(){
	
	$res=CM('cm_list')->select();
	
	return $res;
}



/*
*	获取分类菜单所有子级分类    层次为一级
*/
function global_cat_item($list_id,$parentId=0){
	
	$where['list_id']=$list_id;
	
	
		
	$where['item_parent']=0;
		
	$res=CM('cm_list_item')->where($where)->select();
		
	return $res;
	
	
}


/*
*	递归到顶级父类   
*/
function global_cat_toparent($list_item_id){
	
	$result=array();
	
	global_cat_toparent($list_item_id,$result);
	
	return $result;
}


function global_cat_toparent2($list_item_id,&$result){
	
	$where['list_item_id']=$list_item_id;
	
	$res=CM('cm_list_item')->where($where)->find();
	
	$result[]=$res;
	
	if($res['item_parent']!=0){
		
		global_cat_toparent($res['item_parent'],$result);
	}
	
}


/*
*	获取某分类下所有子分类， 层次为一级  
*/
function global_cat_child($item_parent){
	
	$where['item_parent']=$item_parent;
	
	$res=CM('cm_list_item')->where($where)->select();
	
	return $res;
}


/*
*	获取某个分类菜单的下拉列表
*/

function gen_list_Select($list_id,$selectName='',$list_item_id=0){
	
	$items = CM('cm_list_item')->where('list_id='.$list_id)->select();
	$cm_list = CM('cm_list')->where('list_id='.$list_id)->find();
	
	$items = getTree($items);
	
	$str='';
	$str.='<select name="'.$selectName.'">';
	$str.='<option value="0">---选择'.$cm_list['list_desc'].'---</option>';
		
	foreach($items as $key=>$row){
		$checked='';
		if($row['list_item_id'] == $list_item_id){
			$checked ='selected="true"';
		}
			
		$deepStr = '';
		$deepStr = str_repeat('|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$row['deep']-1);
			
		$str.='<option '.$checked.' value="'.$row['list_item_id'].'">'.$deepStr.$row['item_desc'].'</option>';
	}
	$str.='</select>';
		
		
	return $str;
}


function getTree($data,$pid=0)
{
		$tree=array();
		$deep = 0;			
		getTree99($data,$pid,$tree,$deep);		
		return $tree;
}
	
	
function getTree99($data,$pid,&$tree,&$deep)
{		
	$deep+=1;
		
	foreach($data as $key=>$val){
		if($val['item_parent']==$pid){
			$val['deep'] = $deep;
			$tree[]=$val;
			unset($data[$key]);
			getTree99($data,$val['list_item_id'],$tree,$deep);
		}
	}		
	$deep-=1;		
}


/*
*	获取分类菜单所有文章
*/

function global_get_article($cat_id){
	
	$contents	=	array();
	$result = array();
	
	$result[]=CM('cm_list_item')->where('list_item_id='.$cat_id)->find();
	
	
	$catInfo=get_child($cat_id,$result);				
	
	
	
	foreach($result as $row){
		
		$resTemp=CM('content')->where('cat_id='.$row['list_item_id'])->select();
		
		if(count($resTemp)>0){
			foreach($resTemp as $row){
				$contents[]=$row;
			}
			
		}
		
	} 
	
	return $contents;
}

function get_child($item_parent,&$result){
	
	
	$where['item_parent']=$item_parent;
	
	$res=CM('cm_list_item')->where($where)->select();
	
	if(count($res)>0){
		foreach($res as $row){
			
			$result[]=$row;
			get_child($row['list_item_id'],$result);
		}
	}
	
	
}

/*
*	统一的数据库接口
*/

function CM($table){
	
	return M($table);
}



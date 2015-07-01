<?php 


//获取站点ID

function get_site_id(){
	if(empty($_SESSION['siteid'])){
		
		$res = CMS_M('website')->order('website_id ASC')->select();
		
		if( (count($res)>0) && (empty($_SESSION['siteid'])) ) {
				
			$_SESSION['siteid'] = $res[0]['website_id'];
		}
	}
	if(empty($_SESSION['siteid'])){
		
		throw new Exception('siteid error!!');
	}
	return $_SESSION['siteid'];
}
	
	
//获取栏目列表，层次为一级
function get_category($parent_id=0,$siteid=0){
	
	$siteid = $siteid==0?get_site_id():$siteid;
	
	$where['siteid'] 	= $siteid;
	$where['parent_id'] = $parent_id;
	$where['is_show']   = '0';
	
	$res = CMS_M('category')->where($where)->order('category_sort ASC,category_id DESC')->select();
	
	return $res;
}

//获取某分类下所有文章，默认为包括子分类
function cat2article($cat_id,$is_all=1,$num=10,$order='no'){
	
	$resultAllCat = array();
	
	$articles     = array();
	
	$originCat 	  = CMS_M('category')->where('category_id='.$cat_id)->find();
	
	$resultAllCat[]= $originCat;
	
	if($is_all==1){
		
		get_child_cat($cat_id,$resultAllCat);
	}
	
	
	$ids	=	array();
	$where	=	array();
	
	foreach($resultAllCat as $row){
		
		$ids[]=$row['category_id'];
	} 
	
	$where['cat_id'] = array('in',$ids);
	
	$top_parent_id = top_parent($cat_id);
	$top_parent_cat= CMS_M('category')->where('category_id='.$top_parent_id)->find();
	
	$table  = CMS_M('cm_table')->where('table_id='.$top_parent_cat['module_id'])->find();
	$con_m 	= CMS_M($table['table_name']);
	$pk 	= $con_m->getPk();
	
	import('ORG.Util.Page');
	
	$order = $order=='no'?$table['table_name'].'_sort'.' ASC':$order;
	
	$count      = $con_m->where($where)->order($order)->count();
	$Page       = new Page($count,$num);
	$show       = $Page->show();
	
	$list = $con_m->where($where)->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();
	
	
	$articles['lists'] = $list;
	$articles['page']  = $show;
	
	return $articles;
}

//递归获取所有子级分类
function get_child_cat($cat_id,&$result){
	
	$where['parent_id'] = $cat_id;
	
	$res = CMS_M('category')->where($where)->select();
	
	if(count($res)>0){
		
		foreach($res as $row){
			
			$result[]=$row;
			
			get_child_cat($row['category_id'],$result);
		}
	}
}

//获取某分类下子分类，默认层次为1
function sub_cat($cat_id,$is_all=0){
	
	$result = array();
	
	if($is_all==0){
		
		$result = get_single_subCat($cat_id);
	}else{
		
		get_child_cat($cat_id,$result);
	}
	
	
	return $result;
}

//获取某分类下子分类，层次为1
function get_single_subCat($cat_id){
	
	$where['parent_id'] = $cat_id;
		
	
	
	$res = CMS_M('category')->where($where)->select();
	
	return $res;
}

//获取顶层分类

function top_parent($cat_id=0){
	
	$reallyCat_id = $cat_id;
	
	if($cat_id==0){
		
		$reallyCat_id=empty($_REQUEST['cat_id'])?0:$_REQUEST['cat_id'];
	}
	
	if($reallyCat_id==0){
		
		throw new Exception('cat_id has not found!'); 
	}
	
	$id = get_cat_parent($reallyCat_id);
	
	return $id;
}

//获取顶层分类，默认1为最顶层
function get_cat_parent($cat_id,$is_all=1){
	
	$top_parent_id = $cat_id;
	
	
	$res = CMS_M('category')->where('category_id='.$cat_id)->find();
	$parent_id = $res['parent_id'];
	
	if($parent_id!=0 && $is_all==1){
		
		return get_cat_parent($parent_id,$is_all);
	}else{
		if($is_all!=1){
			return $parent_id;
		}else{
			return $top_parent_id;
		}
		
	}
    
}


//根据ID获取某文章

function get_article($id=0,$module_id=0){
	
	if( $module_id==0  ){
		
		throw new Exception('get_article Param Error');
	}
	
	$table = CMS_M('cm_table')->where('table_id='.$module_id)->find();
	
	$con_m 	= CMS_M($table['table_name']);
	$pk 	= $con_m->getPk();
	
	
	if($id==0){
		
		$id = empty($_REQUEST['article_id'])?0:$_REQUEST['article_id'];
	}
	
	return $con_m->where($pk.'='.$id)->find();
}

//根据ID获取某分类

function id2category($id=0){
	
	if( $id==0  ){
		
		throw new Exception('id2category ID Error');
	}
	
	$con_m 	= CMS_M('category');
	$pk 	= $con_m->getPk();
	
	
	return $con_m->where($pk.'='.$id)->find();
}


//获取某站点下所有基本信息
function get_baseinfo(){
	
	$where['siteid'] = get_site_id();
	
	return CMS_M('web_baseinfo')->where($where)->select();
}

//根据键获取对应站点基本信息
function get_baseByKey($info_key,$siteid=0){
	
	$where['siteid']   = $siteid==0?get_site_id():$siteid;
	$where['info_key'] = trim($info_key);
	
	$res = CMS_M('web_baseinfo')->where($where)->find();
	
	return $res['info_val'];
}


//判断是否为首页

function is_index(){
	
	$cat_id = cat_id();
	$id 	= id();
	
	if(empty($cat_id)  && empty($id) ){
		return '1';
	}else{
		return '0';
	}
}


//获取栏目ID
function cat_id(){
	//throw new Exception($_REQUEST['cat_id']);
	if(!empty($_REQUEST['cat_id'])){
		
		return $_REQUEST['cat_id'];
	}else{
		
		return false;
	}
}


//获取文章ID

function id(){
	
	if(!empty($_REQUEST['id'])){
		
		return $_REQUEST['id'];
	}else{
		
		return false;
	}
}

//获取某站点首页URL

function siteUrl($siteid=0){
	
	$where['website_id']   = $siteid==0?get_site_id():$siteid;
	
	$result = CMS_M('website')->where($where)->find();
	
	return $result['siteUrl'];
}


//获取推荐位置的文章

function pos2art($pos_id=0,$module_id=0,$num=10){
	
	if( ($pos_id==0) || ($module_id==0)   ){
		
		throw new Exception('Param Error');
	}
	
	$table = CMS_M('cm_table')->where('table_id='.$module_id)->find();
	
	$sql ='select * from '.$table['table_name'].' where FIND_IN_SET('.$pos_id.',positions)  LIMIT  '.$num;
	
	$res = CMS_M()->query($sql);
	
	return $res;
	
}

//通过URL获取模板
function getCurrentTpl($siteid=0){
	
	$id = id();
	
	if( empty($id) ){
		
		
		$where['category_id'] 	= cat_id();
		
		$cate = CMS_M('category')->where($where)->find();
		
		$child = CMS_M('category')->where('parent_id='.$cate['category_id'])->find();
		
		$hasParent = $cate['parent_id']==0?0:top_parent($cate['category_id']);
		
		$topParent = $hasParent==0?$cate:CMS_M('category')->where('category_id='.$hasParent)->find();
		
		$tpl = $cate['is_single']==0?$cate['single_tpl']:(count($child)>0?($cate['cate_tpl']==''?$topParent['cate_tpl']:$cate['cate_tpl']):($cate['list_tpl']==''?$topParent['list_tpl']:$cate['list_tpl']));
		
		return substr($tpl,0,strpos($tpl,'.html'));
	}else{
		
		$where['category_id'] 		= cat_id();
		$cate = CMS_M('category')->where($where)->find();
		
		
		if($cate['show_tpl']==''){
			
			$hasParent = $cate['parent_id']==0?0:top_parent($cate['category_id']);
			$topParent = $hasParent==0?$cate:CMS_M('category')->where('category_id='.$hasParent)->find();
			$tpl = $topParent['show_tpl'];
		}else{
			
			$tpl = $cate['show_tpl'];
		}
		
		return substr($tpl,0,strpos($tpl,'.html'));
	}
	
	
}



//面包屑导航

function site_nav(){
	
	$id 	= id();
	$cat_id = cat_id();
	
	$siteUrl	='';
	$siteUrl.='<a href="'.$_SESSION['siteUrl'].'" >首页</a>&nbsp;>&nbsp;';
	
	$resList =array();
	
	if( empty($cat_id) && empty($id) ){
		
		
	}elseif(!empty($id) && !empty($cat_id) ){   //内容页
		
		
		
		get_single_parent($cat_id,$resList);
		$top_parent = $resList[count($resList)-1];
		krsort($resList);
		
		$module_id = $top_parent['module_id'];
		
		$table  = CMS_M('cm_table')->where('table_id='.$module_id)->find();
		$table_name = $table['table_name'];
		
		$con_m = CMS_M($table_name);
		$pk    = $con_m->getPk();
		$res = CMS_M($table_name)->where($pk.'='.$id)->find();
		
		foreach($resList as $val){
			
			$siteUrl.='<a href="'.CAT_PATH.'/'.$val['category_id'].'">'.$val['cat_name'].'</a>&nbsp;>&nbsp;';
		}
		
		$siteUrl.=$res['title'];
		
	}elseif( empty($id) && !empty($cat_id) ){		//分类页
		
		get_single_parent($cat_id,$resList);
		
		krsort($resList);
		
		foreach($resList as $val){
			
			$siteUrl.='<a href="'.CAT_PATH.'/'.$val['category_id'].'">'.$val['cat_name'].'</a>&nbsp;>&nbsp;';
		}
	}
	
	return  $siteUrl;
}

function get_single_parent($cat_id,&$result){
	
	$res = CMS_M('category')->where('category_id='.$cat_id)->find();
	
	$result[]	=	$res;
	
	if($res['parent_id']!=0){
		
		get_single_parent($res['parent_id'],$result);
	}else{
		return;
	}
}

//获取某模块的信息
function getByModules($module_id=0,$where_2='',$siteid=0,$order='',$num=100){
	
	if($module_id==0){
		
		throw new Exception('getByModules Param Error');
	}
	
	$table = CMS_M('cm_table')->where('table_id='.$module_id)->find();
	$table_name = $table['table_name'];
	
	$con_m 	= CMS_M($table_name);
	$pk 	= $con_m->getPk();
	
	$where='';
	
	if($siteid==0){
		$where = 'siteid='.get_site_id();
	}else{
		$where = 'siteid='.$siteid;
	}
	if(!empty($where_2)){
		$where.=' AND '.$where_2;
	}
	//echo 'abc';
	//AAA($where);
	$order	=	$order==''?$table_name.'_sort ASC,'.$pk.' DESC':$order;
	
	import('ORG.Util.Page');
	$count = $con_m->where($where)->order($order)->count();
	$Page       = new Page($count,$num);
	$show       = $Page->show();
	$list = $con_m->where($where)->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();
	
	
	$articles	=	array();
	$articles['lists'] = $list;
	$articles['page']  = $show;
	
	return $list;
	
}




//添加点击量
function addHits($article_id,$cat_id){
	
	$top_cat_id = top_parent($cat_id);
	
	$top_cat = CMS_M('category')->where('category_id='.$top_cat_id)->find();
	
	$table = CMS_M('cm_table')->where('table_id='.$top_cat['module_id'])->find();
	
	$table_name = $table['table_name'];
	
	$table_m = CMS_M($table_name);
	
	$table_m_pk = $table_m->getPk();
	
	$res = $table_m->where($table_m_pk.'='.$article_id)->find();
	
	$ips = $res['hits_ips']==''?array():unserialize($res['hits_ips']);
	
	$ipNow = get_client_ip();
	
	if(!in_array($ipNow,$ips)){
		
		$data['hits'] 		= $res['hits']+1;
		$data[$table_m_pk] = $res[$table_m_pk];
		
		$ips[]=$ipNow;
		$data['hits_ips']   = serialize($ips);	
		
		$table_m->save($data);
	}
}


//添加赞
function addFavor($article_id,$cat_id){
	
	$top_cat_id = top_parent($cat_id);
	
	$top_cat = CMS_M('category')->where('category_id='.$top_cat_id)->find();
	
	$table = CMS_M('cm_table')->where('table_id='.$top_cat['module_id'])->find();
	
	$table_name = $table['table_name'];
	
	$table_m = CMS_M($table_name);
	
	$table_m_pk = $table_m->getPk();
	
	$res = $table_m->where($table_m_pk.'='.$article_id)->find();
	
	$ips = $res['favor_ips']==''?array():unserialize($res['favor_ips']);
	
	$ipNow = get_client_ip();
	
	if(!in_array($ipNow,$ips)){
		
		$data['favor'] 		= $res['favor']+1;
		$data[$table_m_pk] = $res[$table_m_pk];
		
		$ips[]=$ipNow;
		$data['favor_ips']   = serialize($ips);	
		
		$table_m->save($data);
	}
}

//点击量排行文章
function hits2art($cat_id=0,$num=10,$is_all=1,$order=''){
	
	$top_cat_id = top_parent($cat_id);
	
	$top_cat = CMS_M('category')->where('category_id='.$top_cat_id)->find();
	
	$table = CMS_M('cm_table')->where('table_id='.$top_cat['module_id'])->find();
	
	$table_name = $table['table_name'];
	
	$table_m = CMS_M($table_name);
	
	$table_m_pk = $table_m->getPk();
	
	
		
	$resultAllCat = array();

	$articles     = array();
	
	$originCat 	  = CMS_M('category')->where('category_id='.$cat_id)->find();
	
	$resultAllCat[]= $originCat;
	
	if($is_all==1){
		
		get_child_cat($cat_id,$resultAllCat);
	}
	
	
	$ids	=	array();
	$where	=	array();
	
	foreach($resultAllCat as $row){
		
		$ids[]=$row['category_id'];
	} 
	
	$where['cat_id'] = array('in',$ids);
	
	$order = $order==''?'hits DESC,'.$table_name.'_sort ASC':$order;
	
	
	import('ORG.Util.Page');
	$count = $table_m->where($where)->order($order)->count();
	$Page       = new Page($count,$num);
	$show       = $Page->show();
	$list = $table_m->where($where)->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();
	
	foreach($list as $key=>$val){
		$where2 = array();
		$where2['category_id']=$val['cat_id'];
		$catInfo = CMS_M('category')->where($where2)->find();
		$list[$key]['cat_info'] = $catInfo;
	}
	
	$articles	=	array();
	$articles['lists'] = $list;
	$articles['page']  = $show;
	
	return $list;
	
}


function CMS_M($table){
	
	return M($table);
}
?>
<?php

class ContentAction extends MythinkAction {

    

public function _initialize(){
		
		$res = CMS_M('website')->where('website_id='.get_site_id())->find();
		
		
		if(empty($_SESSION['tplPath'])){
			
			$_SESSION['tplPath'] = 'Templates/'.trim($res['weburl']);
		}
		
		if(empty($_SESSION['siteUrl'])){
			
			$_SESSION['siteUrl'] = siteUrl(get_site_id());
		}
		
		//站点地址
		$this->assign('siteUrl',$_SESSION['siteUrl']);
		
		//面包屑导航
		$this->assign('site_nav',site_nav());
		
		$this->assign('defaultPath','./Admin/Tpl/Templates/default');
		
		$this->header();
		$this->footer();
	}
    public function liu_yan()
    {
        AAA($_REQUEST);
    }
	
    public function header(){

		$where['siteid']	=	get_site_id();
		
		$res = CMS_M('web_baseinfo')->where($where)->select();
		
		foreach($res as $key=>$val){
			
			if($val['info_key']=='title'){
				
				$title = $val['info_val'];	
				$id 	= id();
				$cat_id = cat_id();
				
				if(!empty($cat_id)){
					$all_parent = array();
					get_single_parent($cat_id,$all_parent);
					krsort($all_parent);
					foreach($all_parent as $single_Parent){
						if($single_Parent['title']==''){
							$title = $single_Parent['cat_name'].' - '.$title;
						}else{
							$title = $single_Parent['title'].' - '.$title;
						}
					}
					
				}
				
				if(!empty($cat_id) && !empty($id)){
					
					$top_parent_id = top_parent($cat_id);
					$res = CMS_M('category')->where('category_id='.$top_parent_id)->find();
				
					$table = CMS_M('cm_table')->where('table_id='.$res['module_id'])->find();
					$table_name = $table['table_name'];
					
					$table_m = CMS_M($table_name);
					$table_m_pk = CMS_M($table_name)->getPk();
					$art = CMS_M($table_name)->where($table_m_pk.'='.$id)->find();
					if($art['title']!=''){
						$title = $art['title'].' - '.$title;
					}
				}
				
				$this->assign('seo_'.$val['info_key'],$title);
			}else{
				
				$this->assign('seo_'.$val['info_key'],$val['info_val']);
			}
			
		}
		
		
	}
	
	public function footer(){
		
		//getByModules(13);
	}
	
	public function index(){
		
		if($this->is_phone()){
			
			$_SESSION['siteid'] = 2;
			
			$res = CMS_M('website')->where('website_id='.get_site_id())->find();
		
			$_SESSION['tplPath'] = 'Templates/'.trim($res['weburl']);
			
		}
		
		if(!empty($_REQUEST['siteid'])){
			
			$_SESSION['siteid'] = $_REQUEST['siteid'];
			
			$res = CMS_M('website')->where('website_id='.get_site_id())->find();
			
			$_SESSION['tplPath'] = 'Templates/'.trim($res['weburl']);
		}
		
		$this->showTpl('index');
	}
	
	
	public function lists(){
		//cat2article(22);
		$cat_id = empty($_REQUEST['cat_id'])?'0':$_REQUEST['cat_id'];
		
		if($cat_id==0){
			
			throw new Exception('CatId Error!!');
		}
		
		$catInfo = CMS_M('category')->where('category_id='.$cat_id)->find();
		//AAA($catInfo);
		foreach($catInfo as $key=>$val){
			
			$this->assign('list_'.$key,$val);
		}
		
		//getCurrentTpl();exit;
		$this->showTpl(getCurrentTpl());
	}
	
	
	public function show(){
		
		//根据ID获取记录并循环非配
		$id 	= empty($_REQUEST['id'])?'0':$_REQUEST['id'];
		$cat_id = empty($_REQUEST['cat_id'])?'0':$_REQUEST['cat_id'];
		
		if($id==0){
			
			throw new Exception('AtricleId Error!!');
		}

		$top_parent_id = top_parent($cat_id);
		
		$origin_cat= CMS_M('category')->where('category_id='.$cat_id)->find();
		$this->assign('origin_cat',$origin_cat);
		
		$top_parent_cat= CMS_M('category')->where('category_id='.$top_parent_id)->find();
		$module_id = $top_parent_cat['module_id'];
		
		$table  = CMS_M('cm_table')->where('table_id='.$module_id)->find();
		$m  = CMS_M($table['table_name']);
		$pk = $m->getPk();
		
		$res = $m->where($pk.'='.$id)->find();
		
		foreach($res as $key=>$val){
			
			$this->assign('show_'.$key,$val);
		}
		
		
		//获取上一条与下一条记录
		
		$cat_id = $res['cat_id'];
		
		$preNextInfo = $m->where('cat_id='.$cat_id)->select();
		
		$pre    = '';
		$next   = '';
		
		
		
		foreach($preNextInfo as $key=>$val2){
			
			
			$positionNow = -1;
		
			foreach($preNextInfo  as $keyPos=>$rowPos){
				
				if($rowPos[$pk]==$res[$pk]){
					
					$positionNow = $keyPos;
				}	
			}
			
			if( ($val2[$pk]==$res[$pk]) && ($positionNow)>0 ){
				
				$pre = '<a href="'.CON_PATH.'/'.$preNextInfo[$key-1][$pk].'/cat_id/'.$cat_id.'">'.$preNextInfo[$key-1]['title'].'</a>';
			}
			
			if( ($val2[$pk]==$res[$pk]) && $positionNow<(count($preNextInfo)-1) ){
				
				$next = '<a href="'.CON_PATH.'/'.$preNextInfo[$key+1][$pk].'/cat_id/'.$cat_id.'">'.$preNextInfo[$key+1]['title'].'</a>';
			}
			
		}
		
		$pre=$pre==''?'<a href="#">第一条</a>':$pre;
		$next=$next==''?'<a href="#">最后一条</a>':$next;
		
		
		$this->assign('pre',$pre);
		$this->assign('next',$next);
		
		addHits($id,$cat_id);
		//addFavor($id,$cat_id);
		
		//echo getCurrentTpl();echo '---';exit;
		$this->showTpl(getCurrentTpl());
	}
	
	
	public function showTpl($tpl){
		
		$this->display($_SESSION['tplPath'].'/'.$tpl);
		
	}
	
	
	
	
	
	public function module2actions(){
		
		$category_id = I('category_id');
		$top_parent_id = top_parent($category_id);
		$cateInfo  = CMS_M('category')->where('category_id='.$top_parent_id)->find();
		$module_id = $cateInfo['module_id'];
		
		$table  = CMS_M('cm_table')->where('table_id='.$module_id)->find();
		$table_name = $table['table_name'];
		$con_m 	= CMS_M($table_name);
		$pk 	= $con_m->getPk();
		//AAA(ucfirst($table_name).'/'.ucfirst($table_name).'_list');
		//$dir = U(ucfirst($table_name).'/'.ucfirst($table_name).'_list',array('category_id'=>$category_id,'module_id'=>$module_id));
		$this->redirect(ucfirst($table_name).'/'.ucfirst($table_name).'_list',array('category_id'=>$category_id,'module_id'=>$module_id));
	}
	
	public function search(){
		
		$module_id 	= $_REQUEST['module_id'];
		$search_key = $_REQUEST['search_key'];
		
		$table  = CMS_M('cm_table')->where('table_id='.$module_id)->find();
		$table_name = $table['table_name'];
		
		$con_m 	= CMS_M($table_name);


		
		$res = $con_m->where('title LIKE "%'.$search_key.'%"')->select();
		
		$this->assign('result',$res);
		
		$this->showTpl('search_pro');
	}
	
	
	
	public function is_phone(){
		
		$useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] :''; 

		$useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';    

		function CheckSubstrs($substrs,$text){ 

			foreach($substrs as $substr) 
			
				if(false!==strpos($text,$substr)){ 
				
				return true; 
			} 
			return false; 
		}

		$mobile_os_list		=	array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
		$mobile_token_list	=	array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod'); 

		$found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) || CheckSubstrs($mobile_token_list,$useragent); 



		if ($found_mobile){ 

			return true; 

		}else{ 

			return false; 

		} 
	}
	
	
	public function gen_index(){
		if(file_exists('./index.html')){
			
			unlink('./index.html');
		}	
		$con = $this->fetch('Templates/default/index_full');
		file_put_contents('./index.html',$con);
		
		$this->alert_back('生成首页成功！');
	}
	
	
	public function ajax_pro()
	{
		$page = empty($_REQUEST['page']) ?  1 : $_REQUEST['page'];
		
		
		$where = array('cat_id'=>$_REQUEST['cat_id']);
		
		$pageSize = 4;
		$start = ($page-1)*$pageSize;
		
		$m=$this->CM('product');
		
		
		$listInfo = $m->where($where)->order('product_sort asc')->limit($start,$pageSize)->select();
		
		
		if(count($listInfo)>0){
			$this->assign('pro_list',$listInfo);
			//echo $_SESSION['tplPath'].'/'.$tpl;exit;
			$str = $this->fetch($_SESSION['tplPath'].'/ajax_pro');
			echo $str;exit;
		}else{
			echo '-1';exit;
		}
		
		
		return $listInfo;
		
		
	}
	
	
	
	
	
	
	
	
}
?>
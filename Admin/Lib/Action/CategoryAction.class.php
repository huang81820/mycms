<?php

class CategoryAction extends CommonAction {
	
	public $cmTableName = 'Category';
	
	public function _initialize(){
		
		
	}
	
    //列表
	public function Category_list(){
		//获取格式化好的分类列表
		$res = CMS_M('category')->where('siteid='.get_site_id())->select();
		
		$res = $this->getTree($res,$pid=0);
		
		$this->assign('cat_list',$res);
		
		
		Vendor('Form.TableList');
		
		$list	 =	  new TableList();	
		
		//获取并分配添加按钮
		$add_btn = $list->gen_add_button($this->cmTableName);
		
		$this->assign('add_btn',$add_btn);
		
		
		//获取并分配Excel按钮
		$excel_btn = $list->get_excel_btn($this->cmTableName);
		
		$this->assign('excel_btn',$excel_btn);
		
		$this->display($this->cmTableName.'/list');
	}
	
	
	//添加
	public function Category_add(){
		
		$res = CMS_M('category')->where('siteid='.get_site_id())->select();
		
		$res = $this->getTree($res,$pid=0);
		
		$this->assign('cat_list',$res);
		
		
		$this->getTpls();
		
		//获取添加表单并且分配
		$TR_str = '';
		$inputArr = D($this->cmTableName)->form->inputInfoArr;
		$inputDescArr = D($this->cmTableName)->form->inputDescArr;
		//AAA($inputDescArr);
		foreach($inputArr as $key=>$one_input){
			$TR_str .= D($this->cmTableName)->form->add_tr_wraper($one_input,$inputDescArr[$key] );
			
			
		}
		//AAA($TR_str);
		$this->assign('form',$TR_str);
		
		$this->display($this->cmTableName.'/add');
	}
	
	//处理添加的数据（入库）
	public function Category_addok(){
		
		//根据表名获取提交过来的数组
		$data=D($this->cmTableName)->form->recordToBuildData('add');
		
		$data['parent_id'] 	= empty($_REQUEST['parent_id'])?  '' : trim($_REQUEST['parent_id']);
		$data['cate_tpl'] 	= empty($_REQUEST['cate_tpl'])?	  '' : trim($_REQUEST['cate_tpl']);
		$data['list_tpl']	= empty($_REQUEST['list_tpl'])?	  '' : trim($_REQUEST['list_tpl']);
		$data['show_tpl'] 	= empty($_REQUEST['cate_tpl'])?	  '' : trim($_REQUEST['show_tpl']);
		$data['single_tpl'] = empty($_REQUEST['single_tpl'])? '' : trim($_REQUEST['single_tpl']);
	
		
		$this->ADD_ONE($this->cmTableName,$data,U($this->cmTableName.'/'.$this->cmTableName.'_list'));
		
	}
	
	
	//编辑页面
	public function Category_edit(){
		
		//获取表格主建
		$pk	=	M($this->cmTableName)->getPk();
		
		$pkVal	=	$_REQUEST[$pk];
		
		$this->getTpls();
		
		//根据主键获取编辑的表单并分配
		$res=M($this->cmTableName)->where($pk.'='.$pkVal)->find();
		
		D($this->cmTableName)->form->_getEditorForm($res);
		
		$this->assign('form',D($this->cmTableName)->form->editInfo);
		
		$this->assign('res',$res);
		
		
		$res = CMS_M('category')->where('siteid='.get_site_id())->select();
		
		$res = $this->getTree($res,$pid=0);
		
		$this->assign('cat_list',$res);
		
		$this->display($this->cmTableName.'/edit');	
	}
	
	
	//处理编辑的数据（入库）
	public function Category_editok(){
		
		$pk=M($this->cmTableName)->getPk();
		
		//根据表名称获取编辑的数据数组并且入库
		$data=D($this->cmTableName)->form->recordToBuildData('edit');
		
		$data['parent_id'] 	= empty($_REQUEST['parent_id'])?  '' : trim($_REQUEST['parent_id']);
		$data['cate_tpl']   = empty($_REQUEST['cate_tpl'])?	  '' : trim($_REQUEST['cate_tpl']);
		$data['list_tpl']   = empty($_REQUEST['list_tpl'])?	  '' : trim($_REQUEST['list_tpl']);
		$data['show_tpl']   = empty($_REQUEST['cate_tpl'])?	  '' : trim($_REQUEST['show_tpl']);
		$data['single_tpl'] = empty($_REQUEST['single_tpl'])? '' : trim($_REQUEST['single_tpl']);
		$data['show_tpl'] = empty($_REQUEST['show_tpl'])? '' : trim($_REQUEST['show_tpl']);
		
		//$this->EDIT_ONE($this->cmTableName,$data,U($this->cmTableName.'/'.$this->cmTableName.'_edit',array($pk=>$_REQUEST[$pk])));	
		
		$originData = M($this->cmTableName)->where($pk.'='.$data[$pk])->find();
		
		$this->EDIT_ONE($this->cmTableName,$data,U('Category/Category_list'));	
	}
	
	
	//根据主建删除一条记录
	public function Category_del(){
	
		$pk=M($this->cmTableName)->getPk();
		
		$this->DELETE_ONE($this->cmTableName,$_REQUEST[$pk],U($this->cmTableName.'/'.$this->cmTableName.'_list'));
	}
	
	
	//批量删除
	public function Category_batch_del(){
		
		$ids = I('ids'); 
		
		$idsArr = explode(',',$ids);
		
		//根据主键数组批量删除记录
		foreach($idsArr as $val){
		
			$this->CM(strtolower($this->cmTableName))->delete($val);
		}
		
		$this->alert_jump('删除成功',U($this->cmTableName.'/'.$this->cmTableName.'_list'));
	}
	
	
	//模型Excel
	public function Category_excel(){
		
		Vendor('Form.TableList');
		
		$list	 =	  new TableList();
		
		
		//获取Excel上传表单并且分配
		$excel_btn = $list->gen_excel_form($this->cmTableName);
		$this->assign('excel_btn',$excel_btn);
		
		//组将回删按钮并分配
		$back_del_btn = '<a href="'.U('Common/del_last_excel',array('table_name'=>$this->cmTableName)).'">回删记录</a>';
		$this->assign('back_del_btn',$back_del_btn);
		
		
		//根据表名获取上次Excel导入记录，拆分数组并且分配
		$last_excel = file_get_contents('./Public/reportData/'.ucfirst($this->cmTableName).'.txt');
		
		$last_excelArr = unserialize($last_excel);
		$this->assign('table_name',$last_excelArr['table_name']);
		$this->assign('last_time',$last_excelArr['last_time']);
		$this->assign('successRows',$last_excelArr['successRows']);
		$this->assign('errorEmptyRows',$last_excelArr['errorEmptyRows']);
		$this->assign('errorRepeatRows',$last_excelArr['errorRepeatRows']);
		$this->assign('errorInsertRows',$last_excelArr['errorInsertRows']);
		$this->assign('errorDataMapRows',$last_excelArr['errorDataMapRows']);
		
		$this->display($this->cmTableName.'/excel');
	}
	
	
	
	private function getTpls(){
			
		//echo $_SESSION['tplPath'];exit;
		$result	=	array();
		$dir	=	'./Admin/Tpl/'.$_SESSION['tplPath'];
		$dir2	=	opendir($dir);
		while($fileName=readdir($dir2)){
			$file=$dir.'/'.$fileName;
			if($fileName!='.'&&$fileName!='..'){
				if(is_file($file)){
					$result[]=$fileName;
				}
			}
		}
		
		$res = $result;
		
		$category_main	=	array();
		$category_list	=	array();
		$category_con	=	array();
		$singles		=	array();
		
		foreach($res as $key=>$val){
			$cat_model='/^category.*/';
			$list_model='/^list.*/';
			$con_model='/^show.*/';
			$single_model='/^single.*/';
			if(preg_match($cat_model,$val,$arr)){
				$category_main[]=$arr[0];
			}
			if(preg_match($list_model,$val,$arr)){
				$category_list[]=$arr[0];
			}
			if(preg_match($con_model,$val,$arr)){
				$category_con[]=$arr[0];
			}
			if(preg_match($single_model,$val,$arr)){
				$singles[]=$arr[0];
			}
		}
		
		$this->assign('category_main',$category_main);
		$this->assign('category_list',$category_list);
		$this->assign('category_con',$category_con);
		$this->assign('singles',$singles);
	}
	
	
	
	public function getTree($data,$pid=0)
	{
		$tree=array();
		$deep = 0;			
		$this->getTree99($data,$pid,$tree,$deep);		
		return $tree;
	}
	
	
	private function getTree99($data,$pid,&$tree,&$deep)
	{		
		$deep+=1;
		
		foreach($data as $key=>$val){
			if($val['parent_id']==$pid){
				$val['deep'] = $deep;
				$tree[]=$val;
				unset($data[$key]);
				$this->getTree99($data,$val['category_id'],$tree,$deep);
			}
		}		
		$deep-=1;		
	}
	
	
	
	
}
?>
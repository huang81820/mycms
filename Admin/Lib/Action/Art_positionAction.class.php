<?php

class Art_positionAction extends CommonAction {
	
	public $cmTableName = 'Art_position';
	
	public function _initialize(){
		
		
	}
	
    //列表
	public function Art_position_list(){
		
		Vendor('Form.TableList');
		
		$list	 =	  new TableList();		
		
		
		//获取搜索列表条件
		$where = $list->get_search_data($this->cmTableName);
		$where['siteid'] = get_site_id();
		//根据条件获取列表
		$rs = $list->auto_gen_list($this->cmTableName,$where);
		
		//分配列表信息
		$this->assign('list',$rs['table_list']);
		//分配搜索表单信息
		$this->assign('searchForm',$rs['search_form']);
		
		
		
		//获取并分配添加按钮
		$add_btn = $list->gen_add_button($this->cmTableName);
		
		$this->assign('add_btn',$add_btn);
		
		
		//获取并分配Excel按钮
		$excel_btn = $list->get_excel_btn($this->cmTableName);
		
		$this->assign('excel_btn',$excel_btn);
		
		
		$this->display($this->cmTableName.'/list');
	}
	
	
	//添加
	public function Art_position_add(){
		
		//获取添加表单并且分配
		$this->assign('form',D($this->cmTableName)->form->_getForm());
		
		$this->display($this->cmTableName.'/add');
	}
	
	//处理添加的数据（入库）
	public function Art_position_addok(){
		
		//根据表名获取提交过来的数组
		$data=D($this->cmTableName)->form->recordToBuildData('add');
		
		$this->ADD_ONE($this->cmTableName,$data,U($this->cmTableName.'/'.$this->cmTableName.'_list'));
		
	}
	
	
	//编辑页面
	public function Art_position_edit(){
		
		//获取表格主建
		$pk	=	M($this->cmTableName)->getPk();
		
		$pkVal	=	$_REQUEST[$pk];
		
		//根据主键获取编辑的表单并分配
		$res=M($this->cmTableName)->where($pk.'='.$pkVal)->find();
		
		$this->assign('form',D($this->cmTableName)->form->setAction('__APP__/'.$this->cmTableName.'/'.$this->cmTableName.'_editok')->_getEditorForm($res));
		
		$this->display($this->cmTableName.'/edit');	
	}
	
	
	//处理编辑的数据（入库）
	public function Art_position_editok(){
		
		$pk=M($this->cmTableName)->getPk();
		
		//根据表名称获取编辑的数据数组并且入库
		$data=D($this->cmTableName)->form->recordToBuildData('edit');
		
		$this->EDIT_ONE($this->cmTableName,$data,U($this->cmTableName.'/'.$this->cmTableName.'_edit',array($pk=>$_REQUEST[$pk])));	
	}
	
	
	//根据主建删除一条记录
	public function Art_position_del(){
	
		$pk=M($this->cmTableName)->getPk();
		
		$this->DELETE_ONE($this->cmTableName,$_REQUEST[$pk],U($this->cmTableName.'/'.$this->cmTableName.'_list'));
	}
	
	
	//批量删除
	public function Art_position_batch_del(){
		
		$ids = I('ids'); 
		
		$idsArr = explode(',',$ids);
		
		//根据主键数组批量删除记录
		foreach($idsArr as $val){
		
			$this->CM(strtolower($this->cmTableName))->delete($val);
		}
		
		$this->alert_jump('删除成功',U($this->cmTableName.'/'.$this->cmTableName.'_list'));
	}
	
	
	//模型Excel
	public function Art_position_excel(){
		
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
	
	
	
	
	
	
	
	
}
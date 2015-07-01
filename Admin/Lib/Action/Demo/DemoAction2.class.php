<?php

class DemoAction extends CommonAction {
	
	public function _initialize(){
		
		
	}
	
    
	public function Demo_list(){
		
		Vendor('Form.TableList');
		
		$list	 =	  new TableList();		
		
		$rs = $list->auto_gen_list('Demo');
		
		$this->assign('list',$rs['table_list']);
		
		$this->assign('searchForm',$rs['search_form']);
		
		$this->display('Demo/list');
	}
	
	public function Demo_add(){
			
		$this->assign('form',D('Demo')->form->_getForm());
		
		$this->display('Demo/add');
	}
	
	public function Demo_addok(){
		
		$data=D('Demo')->form->recordToBuildData('add');
		
		$this->ADD_ONE('Demo',$data,U('Demo/Demo_list'));
		
	}
	
	public function Demo_edit(){
	
		$pk	=	M('Demo')->getPk();
		
		$pkVal	=	$_REQUEST[$pk];
		
		$res=M('Demo')->where($pk.'='.$pkVal)->find();
		
		$this->assign('form',D('Demo')->form->setAction('__APP__/Demo/Demo_editok')->_getEditorForm($res));
		
		$this->display('Demo/edit');	
	}
	
	public function Demo_editok(){
		
		$pk=M('Demo')->getPk();
		
		$data=D('Demo')->form->recordToBuildData('edit');
		
		$this->EDIT_ONE('Demo',$data,U('Demo/Demo_edit',array($pk=>$_REQUEST[$pk])));	
	}
	
	public function Demo_del(){
	
		$pk=M('Demo')->getPk();
		
		$this->DELETE_ONE('Demo',$_REQUEST[$pk],U('Demo/Demo_list'));
	}
	
	
	
	
	
	
	
}
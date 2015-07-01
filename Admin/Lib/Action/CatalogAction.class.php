<?php

class CatalogAction extends CommonAction {
	
	public $cmTableName = 'Catalog';
	
	public function _initialize(){
		
		
	}
	
    //列表
	public function Catalog_list(){
		
		Vendor('Form.TableList');
		
		$list	 =	  new TableList();		
		
		
		//获取搜索列表条件
		$where = $list->get_search_data($this->cmTableName);
		
		$where['siteid'] = get_site_id();
		
		if(!empty($_REQUEST['category_id'])){
			
			$where['cat_id'] = I('category_id');
		}
		
		
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
	public function Catalog_add(){
		
		//获取添加表单并且分配
		$this->assign('form',D($this->cmTableName)->form->_getForm());
		
		$this->display($this->cmTableName.'/add');
	}
	
	//处理添加的数据（入库）
	public function Catalog_addok(){
		
		//根据表名获取提交过来的数组
		$data=D($this->cmTableName)->form->recordToBuildData('add');
		
		$this->ADD_ONE($this->cmTableName,$data,U('Content/module2actions',array('category_id'=>$data['cat_id'])));
		
	}
	
	
	//编辑页面
	public function Catalog_edit(){
		
		//获取表格主建
		$pk	=	M($this->cmTableName)->getPk();
		
		$pkVal	=	$_REQUEST[$pk];
		
		//根据主键获取编辑的表单并分配
		$res=M($this->cmTableName)->where($pk.'='.$pkVal)->find();
		
		$this->assign('form',D($this->cmTableName)->form->setAction('__APP__/'.$this->cmTableName.'/'.$this->cmTableName.'_editok')->_getEditorForm($res));
		
		$this->display($this->cmTableName.'/edit');	
	}
	
	
	//处理编辑的数据（入库）
	public function Catalog_editok(){
		
		$pk=M($this->cmTableName)->getPk();
		
		//根据表名称获取编辑的数据数组并且入库
		$data=D($this->cmTableName)->form->recordToBuildData('edit');
		
		$originData = M($this->cmTableName)->where($pk.'='.$data[$pk])->find();
		
		$this->EDIT_ONE($this->cmTableName,$data,U('Content/module2actions',array('category_id'=>$originData['cat_id'])));	
	}
	
	
	//根据主建删除一条记录
	public function Catalog_del(){
	
		$pk=M($this->cmTableName)->getPk();
		
		$originData = M($this->cmTableName)->where($pk.'='.$_REQUEST[$pk])->find();
		
		$this->DELETE_ONE($this->cmTableName,$_REQUEST[$pk],U('Content/module2actions',array('category_id'=>$originData['cat_id'])));	
	}
	
	
	//批量删除
	public function Catalog_batch_del(){
		
		$ids = I('ids'); 
		
		$idsArr = explode(',',$ids);
		
		//根据主键数组批量删除记录
		foreach($idsArr as $val){
		
			$this->CM(strtolower($this->cmTableName))->delete($val);
		}
		
		$this->alert_jump('删除成功',U($this->cmTableName.'/'.$this->cmTableName.'_list'));
	}
	
	
	//模型Excel
	public function Catalog_excel(){
		
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

    public function set_relative()
    {
        Vendor('Form.Form2');

        $form = new Form();
        //$rs = M('product')->query('select * from product group by cat_id');
        //AAA($rs);
        $column_info = array(

            'column_name'=>'relative_pro',
            'column_desc'=>'关联产品',
            'attrs'=>array(

                'type'=>0,
                'value_key' =>'product_id',
                'value_desc'=>'title',
                'data_sql'  =>'select * from product',

            ),

        );

        $catalog =  $this->GET_ONE('catalog','catalog_id='.$_REQUEST['catalog_id']);
        $this->assign('catalog',$catalog);


        $checked_box_str = $form->typeToBuildInput('checkedbox',$column_info,$catalog['re_pro_ids'],'editor');

        $this->assign('checked_box_str',$checked_box_str);


        $this->assign('cat_id',$_REQUEST['cat_id']);

        $this->display();

    }

    public function save_relative()
    {
        $relative_str ='';
        foreach($_REQUEST['relative_pro'] as $key=>$val){
            if(!empty($val)){
                $relative_str.=$val.',';
            }
        };
        $relative_str =  rtrim($relative_str,',');

        $catalog_id = $_REQUEST['catalog_id'];

        $data = array();
        $data['catalog_id'] = $catalog_id;
        $data['re_pro_ids'] = $relative_str;

        $rs = M('catalog')->save($data);
        if($rs){
            $this->alert_jump('操作成功',U('Content/module2actions',array('category_id'=>$_REQUEST['cat_id'])));
        }else{
            $this->alert_back('操作失败');

        }

    }
	
	
	
	
	
	
}
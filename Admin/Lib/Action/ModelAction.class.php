<?php

// 本类由系统自动生成，仅供测试用途
class ModelAction extends MythinkAction {
	
	public  $cm_table				=   CM_TABLE;					//table主表名称
	public  $cm_table_column		=   CM_TABLE_COLUMN;			//table字段表名称名称
	public  $cm_list				=   CM_LIST;					//菜单主表名称
	public  $cm_list_item			=   CM_LIST_ITEM;				//菜单详细表名称

	public function table_column(){
		$this->assign('table_id',$_REQUEST['table_id']);
		
		$table = M($this->cm_table)->where('table_id='.$_REQUEST['table_id'])->find();

		$this->assign('table_name',$table['table_name']);
		$this->display();
	}
	
	/*
	 * 数据表列表显示
	 */
    public function table_list(){
	
		$rs = $this->ALL_LIST($this->cm_table,true,'table_id DESC');
		
		$select_data	=	$this->getTableTree($rs,$pid=0);
			
		$this->assign('table_list',$rs);
		
		$this->assign('select_data',$select_data);
		
		$this->display('table_list');
    }
	
    /*
     * 添加表
     */
	public function add_table()
	{	//var_dump($_POST);exit;
		
		$table_name  = trim( $_REQUEST['table_name'] );
		$primary_key = strtolower($table_name).'_id';
		
		if( empty($table_name) || empty($primary_key) ){
			$this->alert_back('请填写完整参数');
			exit;
			
		}
		
		$sql="select table_name from information_schema.tables where table_schema='".C('DB_NAME')."' ";
		
		$exist_tables = M()->query($sql);
				
		foreach ($exist_tables as $key=>$exist_table){
			if($exist_table['table_name'] == $table_name){
				$this->alert_back('该表的名称已经存在');
				exit;
			}
		}
		
		
		
		
		$sql='CREATE TABLE '.$table_name.'('.$primary_key. ' INT not null primary key AUTO_INCREMENT, '.$table_name.'_sort INT NOT NULL DEFAULT 0 ) default charset utf8';
		
		$data['table_name'] = $table_name;
		$data['pid'] 		= intval($_REQUEST['pid']);
		$data['description']=$_REQUEST['description'];
		
		
			
		
		
		
		//添加默认按钮
		$list_button	=	array();				
		$list_button[0]	=	Array
							(
								'href' => ucfirst($table_name).'/'.ucfirst($table_name).'_edit',
								'desc' => '编辑'
							);
		$list_button[1]	=	Array
							(
								'href' => ucfirst($table_name).'/'.ucfirst($table_name).'_del',
								'desc' => '删除'
							);
							
		$data['list_button'] = serialize($list_button);   
		$table_id = M($this->cm_table)->add($data);
		
		$colmun_data['table_id'] = $table_id;
		$colmun_data['column_desc'] = '主键（自增）';
		$colmun_data['column_name'] = $primary_key;		
		$colmun_data['column_type'] = 'primaryKey';
		$colmun_data['is_list'] = '1';
		
		
		$colmun_data_id=M($this->cm_table_column)->add($colmun_data);
		
		
		$rs = M()->query($sql);
		
		
		//添加排序字段（文本）
		
		$column_data	=	array();
		$column_data['table_id']	=	$table_id;
		$column_data['column_type']	=	'singleErea';
		$column_data['column_name']	=	$table_name.'_sort';
		$column_data['is_add']		=	'1';
		$column_data['is_edit']		=	'1';
		$column_data['column_desc']	=	'排序';
		$column_data['column_help']	=	'排序';
		
		$temp_column_insert_id = M($this->cm_table_column)->add($column_data);
		
		$sort = array();
		$sort['cm_table_column_sort'] = $temp_column_insert_id;
		
		M($this->cm_table_column)->where('tab_col_id='.$temp_column_insert_id)->save($sort);
		
		
		
		
		$this->genCode(ucfirst(strtolower($table_name)));        //生成控制器，模型，模板
		
		$this->alert_jump('添加成功',U('Model/table_list'));
		
	}
	
	/*
	 * 修改表 
	 */
	public function table_edit(){
		
		$rs = $this->ALL_LIST($this->cm_table,true,'table_id DESC');
		
		$select_data	=	$this->getTableTree($rs,$pid=0);
			
		$this->assign('select_data',$select_data);
		
		
		$res	=	$this->GET_ONE($this->cm_table,'table_id='.$_REQUEST['table_id']);
		
		$this->assign('tableInfo',$res);
		
		$this->display('Model/table_edit');
	}
	
	/*
	 * 处理修改表的信息 
	 */
	public function table_editok(){
			
		$data['table_name']   =  trim( $_REQUEST['table_name'] );
		
		$data['description']  =  trim( $_REQUEST['description'] );
		
		$data['pid']          =  intval( $_REQUEST['pid'] );
		
		$data['table_id']     =  trim( $_REQUEST['table_id'] );
		
		$this->EDIT_ONE($this->cm_table,$data,U('Model/table_edit',array('table_id'=>trim( $_REQUEST['table_id'] ))));
	}
	
	/*
	 * 删除表 
	 */
	public function del_table()
	{
		$table_id = $_REQUEST['table_id'];
		
		$table = M($this->cm_table)->where('table_id='.$table_id)->find();
		
		$table_name = $table['table_name'];
		
		//删除字段
		M($this->cm_table_column)->where('table_id='.$table_id)->delete();
		
		//删除table记录
		M($this->cm_table)->where('table_id='.$table_id)->delete();
		
		
		//删除控制器文件，模板文件，模型文件
		
		Vendor('Form.File');
		
		$file=File::getInstance();
		
		$controllerDir = './Admin/Lib/Action/'.ucfirst(strtolower($table_name)).'Action.class.php';
		
		$modelDir	   = './Admin/Lib/Model/'.ucfirst(strtolower($table_name)).'Model.class.php';
		
		$tplDir		   = './Admin/Tpl/'.ucfirst(strtolower($table_name));	
		
		$file::delFile($controllerDir);
		
		$file::delFile($modelDir);
		
		$file::delFile($tplDir);
		
	
	 	//删除数据库表
		$sql='DROP TABLE '.$table_name;
		M()->query($sql);
		
		$this->alert_jump('删除成功',U('Model/table_list'));
		
	}
	
	/*
	 * 管理表下的所有字段（列表）
	 */
	
	public function table_column_list()
	{
		$table_id = $_REQUEST['table_id'];
		
		
		$rs = $this->ALL_LIST($this->cm_table_column,'table_id='.$table_id,'cm_table_column_sort ASC');
		
		
		$this->assign('table',$this->GET_ONE($this->cm_table,'table_id='.$table_id));
		
		
		$this->assign('tab_col_list',$rs);
		
		$this->display('table_column_list');
			
	}
	
	/*
	 * 异步改变字段排序
	 */
    public function changeListSort(){
	
		$origin=I('origin');
		$target=I('target');
		$table_name=strtolower(trim( $_REQUEST['table_name'] ));
		
		$table_pk = $this->CM($table_name)->getPk();
		
		$originRow=$this->CM($table_name)->where($table_pk.'='.$origin)->find();
		$targetRow=$this->CM($table_name)->where($table_pk.'='.$target)->find();
			
		$list_column_name = $table_name.'_sort';		//默认的所有table的排序字段为  table_sort
		
		$originSort=$originRow[$list_column_name];
		$targetSort=$targetRow[$list_column_name];
//AAA($list_column_name.'--'.$targetSorttargetSort);

		$target_data[$list_column_name] = $targetSort;
		$origin_data[$list_column_name] = $originSort;

		$this->CM($table_name)->where($table_pk.'='.$origin)->save( $target_data );
		$this->CM($table_name)->where($table_pk.'='.$target)->save( $origin_data );
    }
	
	public function add_table_column()
	{	
		$table_id = $_REQUEST['table_id'];
		
		$this->assign('CM_MenuList',$this->cate_menu_list());
		
		$this->assign('table',$this->Get_ONE($this->cm_table,'table_id='.$table_id));
		
		$allTables=M()->query("select table_name from information_schema.tables where table_schema='".C('DB_NAME')."' ");
		
		
		$tableColumns	=	array();
		foreach($allTables as $key=>$value){
			
			$sql	=	'';
			$sql='select  column_name, column_comment  from Information_schema.columns  where table_Name ="'.$value['table_name'].'"  AND table_schema = "'.C('DB_NAME').'"';	
			
			$tableColumns[$value['table_name']]	=	M()->query($sql);
		}
		
		$this->assign('allTables',$allTables);
		
		$this->assign('tableColumns',$tableColumns);
		
		$this->display('add_table_column');
		
	}
	
	
	public function AjaxGetTableColumn(){
			
		$table_name	=	$_REQUEST['table_name'];
		$sql='select  column_name, column_comment  from Information_schema.columns  where table_Name ="'.$table_name.'"  AND table_schema = "'.C('DB_NAME').'"';	
	
		$tableColumns	=	M()->query($sql);
		
		$str='';
		$str.='<select name="foreignKey_column" class="selectArea">';
		$str.='<option value="0">---关联字段---</option>';
		foreach($tableColumns as $tableColumn){
			$str.='<option value="'.$tableColumn['column_name'].'">'.$tableColumn['column_name'].'</option>';
		}
		$str.='</select>';
		echo $str;
		exit;
	}
	
	
	public function do_add_column()
	{
		
		
		$table_id = $_REQUEST['table_id'];
		$column_type = $_REQUEST['column_type'];
		
		$operate_table = M($this->cm_table)->where('table_id='.$table_id)->find();
		$operate_table = $operate_table['table_name'] ;
		$column_name = trim( $_REQUEST['column_name'] );
		
		
		//判断表下的某个字段是否已经存在
		$sql='select  column_name, column_comment  from Information_schema.columns  where table_Name ="'.$operate_table.'"  AND table_schema = "'.C('DB_NAME').'"';		
		$exist_column = M()->query($sql);
		foreach ($exist_column as $key=>$one_column){
			
			if( $one_column['column_name'] == $column_name ){
					$this->alert_back('该字段名称已经存在');
					exit;
			}
		}
		
		
		$Model_column = M($this->cm_table_column);
		
		
		//处理通用数据
		
		if( empty($_REQUEST['table_id']) || empty($_REQUEST['table_id']) || empty($_REQUEST['table_id']) ){
			
			$this->alert_back('添加失败！！');
		}
		
		$data = array();
		$data['table_id'] = $_REQUEST['table_id'] ;
		$data['column_name'] = $_REQUEST['column_name'];
		$data['column_type'] = $_REQUEST['column_type'];
		$data['is_add'] = $_REQUEST['is_add'];
		$data['is_edit'] = $_REQUEST['is_edit'];
		$data['column_default_value'] = $_REQUEST['column_default_value'];
		$data['column_desc'] = empty( $_REQUEST['column_desc'] ) ? '' : trim( $_REQUEST['column_desc'] );
		$data['column_help'] = empty( $_REQUEST['column_help'] ) ? '' : trim( $_REQUEST['column_help'] );
		$data['column_error_message'] = empty( $_REQUEST['column_error_message'] ) ? '' : trim( $_REQUEST['column_error_message'] );
		
		//验证相关
		$data['is_validate'] = $_REQUEST['is_validate'] ;
		$data['min_length']  = trim( $_REQUEST['min_length'] ) ;
		$data['max_length'] = trim( $_REQUEST['max_length'] ) ;
		$data['validate_regexp'] = trim( $_REQUEST['validate_regexp'] ) ;
		
		
		switch($column_type){
			
			case 'singleErea': 
							
				$single_default = trim($_REQUEST['column_default_value']);
				$sql="ALTER TABLE ".$operate_table." ADD ".$column_name." VARCHAR( 255 )  NOT NULL DEFAULT '".$single_default."'  ";
	
				$column_id=$Model_column->add($data) ;
				$rs = M()->query($sql);
				
				break;
				
			case 'multiErea':
				
				$column_id=$Model_column->add($data);
			
				$sql="ALTER TABLE ".$operate_table." ADD ".$column_name." TEXT  NOT NULL DEFAULT ''  ";
				
				$rs = M()->query($sql);
				
				break;
			case 'edictor':
			
				$column_id=$Model_column->add($data);
					
				$sql="ALTER TABLE ".$operate_table." ADD ".$column_name." TEXT NOT NULL DEFAULT ''  ";
			
				$rs = M()->query($sql);
			
				break;
				
				
			case 'hidden':
					
				$column_id=$Model_column->add($data);
					
				$sql="ALTER TABLE ".$operate_table." ADD ".$column_name." INT NOT NULL DEFAULT 0  ";
					
				$rs = M()->query($sql);
					
				break;
				
			case 'singlePic':
					
				$column_id=$Model_column->add($data);
					
				$sql="ALTER TABLE ".$operate_table." ADD ".$column_name." VARCHAR( 255 )  NOT NULL DEFAULT ''  ";
					
				$rs = M()->query($sql);
					
				break;
				
			case 'multiPic':
				
				$pic_attrs=array();
			
				$attr_name       =  $_REQUEST['mpic_attr_name'] ;
				$attr_desc       =  $_REQUEST['mpic_attr_desc'] ;
				$attr_type       =  $_REQUEST['mpic_attr_type'] ;
				$attr_sort       =  $_REQUEST['mpic_attr_sort'] ;
				
				foreach ($attr_name as $key =>$pic_attr){
					$one_attr = array();
					$one_attr['key']   = $attr_name[$key];
					$one_attr['desc']  = $attr_desc[$key];
					$one_attr['attr_type']  = $attr_type[$key];
					$one_attr['sort']  = $attr_sort[$key];
					$pic_attrs[]= $one_attr;
				}
				$temp = array();
				$temp['pic_attrs'] = $pic_attrs;
				$data['column_attrs'] = serialize($temp);
				
				
				$column_id=$Model_column->add($data);
					
				$sql="ALTER TABLE ".$operate_table." ADD ".$column_name." TEXT  NOT NULL DEFAULT ''  ";
					
				$rs = M()->query($sql);
					
				break;
				
			case 'select':
			case 'select':
	
				$attr = array();
				$attr['type'] = $_REQUEST['selectType'];
				$attr['value_key'] = trim( $_REQUEST['select_value_key'] );
				$attr['value_desc'] = trim( $_REQUEST['select_value_desc'] );
				$attr['value_parent'] = trim( $_REQUEST['select_value_parent'] );
				$attr['data_sql'] = trim( $_REQUEST['selectSQL'] );
				$attr['list_id']   = trim( $_REQUEST['list_id'] );
				
				$static_data_key = $_REQUEST['select_static_key'];
				$static_data_desc = $_REQUEST['select_static_value'];
				
				$lists =array();
				foreach ($static_data_key as $key =>$select_key){
					$one_option = array();					
					//echo $select_key;exit;
					$one_option['value'] = $select_key;
					$one_option['desc'] = $static_data_desc[$key];
					$lists[]=$one_option;
															
				}
				
				$attr['lists'] = $lists;
				
				//var_dump($attr);exit;
				$data['column_attrs'] = serialize($attr);
				
				
					
				$sql="ALTER TABLE ".$operate_table." ADD ".$column_name." INT  DEFAULT 0 ";			
				
				$column_id=$Model_column->add($data);
				M()->query($sql);				
				break;
				
			case 'radio':
				
				$lists = array();
				$radio_key  =  $_REQUEST['radio_static_key'] ;
				$radio_desc =  $_REQUEST['radio_static_value'] ;
				
				foreach ($radio_key as $key=>$val){
					$one_radio = array();
					$one_radio['value'] = $radio_key[$key];
					$one_radio['desc']  = $radio_desc[$key];
						
					$lists[]=$one_radio;
				}
				
	
				$radio_attr=array();
				$radio_attr['type'] = 1;//静态数据
				$radio_attr['lists'] = $lists;
				$data['column_attrs'] = serialize($radio_attr);
			
				
				$sql="ALTER TABLE ".$operate_table." ADD ".$column_name." TINYINT  DEFAULT 0 ";
				
				$column_id=$Model_column->add($data);
				M()->query($sql);
				
				break;
				
			case 'date':
				
				$column_id=$Model_column->add($data);
				
				$sql="ALTER TABLE ".$operate_table." ADD ".$column_name." VARCHAR( 150 )  NOT NULL DEFAULT ''  ";
					
				$rs = M()->query($sql);
				
				break;
			case 'date_time':
			
				$column_id=$Model_column->add($data);
			
				$sql="ALTER TABLE ".$operate_table." ADD ".$column_name." VARCHAR( 150 )  NOT NULL DEFAULT ''  ";
					
				$rs = M()->query($sql);
			
				break;	
				
			case 'hidden_date':
			
				$data['column_attrs']		=	$_REQUEST['hidden_time_is_synchronization']=='on'?'1':'0';
				
				$column_id=$Model_column->add($data);
			
				$sql="ALTER TABLE ".$operate_table." ADD ".$column_name." VARCHAR( 150 )  NOT NULL DEFAULT ''  ";
					
				$rs = M()->query($sql);
			
				break;
			
			case 'date_range':
			
				$column_id=$Model_column->add($data);
			
				$sql="ALTER TABLE ".$operate_table." ADD ".$column_name." VARCHAR( 150 )  NOT NULL DEFAULT ''  ";
					
				$rs = M()->query($sql);
			
				break;
				
			case 'date_time_range':
					
				$column_id=$Model_column->add($data);
					
				$sql="ALTER TABLE ".$operate_table." ADD ".$column_name." VARCHAR( 150 )  NOT NULL DEFAULT ''  ";
					
				$rs = M()->query($sql);
					
				break;
				
			case 'checkedbox':
	
				$lists = array();
				$checkbox_key  =  $_REQUEST['checkbox_static_key'] ;
				$checkbox_desc =  $_REQUEST['checkbox_static_value'] ;
				
				foreach ($checkbox_key as $key=>$val){
					$one_checkbox = array();
					$one_checkbox['value'] = $checkbox_key[$key];
					$one_checkbox['desc']  = $checkbox_desc[$key];
						
					$lists[]=$one_checkbox;
				}
				//AAA($lists);
	
				$checkbox_attr=array();
				$checkbox_attr['type'] = 1;//静态数据
				$checkbox_attr['lists'] = $lists;
				$data['column_attrs'] = serialize($checkbox_attr);
				
				$column_id=$Model_column->add($data);
					
				$sql="ALTER TABLE ".$operate_table." ADD ".$column_name." VARCHAR( 500 )  NOT NULL DEFAULT ''  ";
					
				$rs = M()->query($sql);
					
				break;
			
			case 'foreignKey':
					
				$foreignKey_attr=array();
				$foreignKey_attr['table_name'] = $_REQUEST['foreignKey_table'];
				$foreignKey_attr['column_name'] = $_REQUEST['foreignKey_column'];	
				$data['column_attrs'] = serialize($foreignKey_attr);	
				
				$column_id=$Model_column->add($data);
				
				$sql="ALTER TABLE ".$operate_table." ADD ".$column_name." INT  NOT NULL DEFAULT 0  ";
					
				$rs = M()->query($sql);
					
				break;
			
			case 'file':
				$sql="ALTER TABLE ".$operate_table." ADD ".$column_name." VARCHAR( 255 )  NOT NULL DEFAULT ''  ";
	
				$column_id=$Model_column->add($data) ;
				$rs = M()->query($sql);
			break;
			
			
			case 'lianDong':
				
				$sql="ALTER TABLE ".$operate_table." ADD ".$column_name." INT  NOT NULL DEFAULT 0  ";
	//AAA($sql);
				$column_id=$Model_column->add($data) ;
				$rs = M()->query($sql);
				
			break;
			
			case 'session':
				$sql="ALTER TABLE ".$operate_table." ADD ".$column_name." VARCHAR( 255 )  NOT NULL DEFAULT ''  ";
	
				$column_id=$Model_column->add($data) ;
				$rs = M()->query($sql);
			break;
			
			case 'special':
					
				$column_id=$Model_column->add($data);
					
				$sql="ALTER TABLE ".$operate_table." ADD ".$column_name." ".$_REQUEST['data_type']."  NOT NULL DEFAULT '".$_REQUEST['data_type_default_value']."'  ";
				//echo $sql;exit;	
				$rs = M()->query($sql);
					
				break;
		}
		
		if(!empty($column_id)){
			
			M($this->cm_table_column)->where('tab_col_id='.$column_id)->save(array('cm_table_column_sort'=>$column_id));
		}
		
	
		$this->alert_jump('添加字段成功', U('Model/table_column_list',array('table_id'=>$table_id)));
	
			
				
	}
	
	public function edit_column()
	{
		$table_id 	= $_REQUEST['table_id'];
		$tab_col_id = $_REQUEST['tab_col_id'];
		
	
		$column = M($this->cm_table_column)->where('tab_col_id='.$tab_col_id)->find();
		
		$column_type = $column['column_type'];
		
		$column['column_attrs_string'] = $column['column_attrs'];
		
		$column['column_attrs'] = unserialize($column['column_attrs']);
		
		
	
		$this->assign('table',$this->Get_ONE($this->cm_table,'table_id='.$table_id));
		$this->assign('inputType',$column['column_type']);
		$this->assign('inputInfo',$column);
	
		$tpl = '';

		switch($column_type){
			case 'singleErea':
				$tpl = 'z_singleErea';
				break;
	
			case 'multiErea':
				$tpl = 'z_singleErea';
				break;
	
			case 'edictor':
				$tpl = 'z_singleErea';
				break;
	
			case 'singlePic':
				$tpl = 'z_singleErea';
				break;
	
			case 'multiPic':
				$tpl = 'z_multiPic';
				break;
	
			case 'hidden':
				$tpl = 'z_singleErea';
				break;
	
			case 'singlePic':
				$tpl = 'z_singlePic';
				break;
	
			case 'select':
				$this->assign('CM_MenuList',$this->cate_menu_list($column['column_attrs']['list_id']));
				$tpl = 'z_select';
				break;
			case 'lianDong':
				$this->assign('CM_MenuList',$this->cate_menu_list($column['column_attrs']['list_id']));
				$tpl = 'z_select';
				break;
				
			case 'radio':
				$tpl = 'z_radio';
				break;
			case 'date':
				$tpl = 'z_singleErea';
				break;
			case 'hidden_date':
				$tpl = 'z_hiddenDate';
				break;
			case 'date_time':
				$tpl = 'z_singleErea';
				break;
			case 'date_range':
				$tpl = 'z_singleErea';
				break;
			case 'date_time_range':
				$tpl = 'z_singleErea';
				break;
			case 'checkedbox':
				$tpl = 'z_checkedbox';
				break;
			case 'session':
				$tpl = 'z_session';
				break;
				
			case 'foreignKey':
				$allTables=M()->query("select table_name from information_schema.tables where table_schema='".C('DB_NAME')."' ");
				$this->assign('allTables',$allTables);
				
				
				
				$table_name	=	$column['column_attrs']['table_name'];
				$sql='select  column_name, column_comment  from Information_schema.columns  where table_Name ="'.$table_name.'"  AND table_schema = "'.C('DB_NAME').'"';	
			
				$tableColumns	=	M()->query($sql);
				
				$str='';
				$str.='<select name="foreignKey_column" class="selectArea">';
				$str.='<option value="0">---关联字段---</option>';
				foreach($tableColumns as $tableColumn){
					$selected=$column['column_attrs']['column_name']==$tableColumn['column_name']?'selected="true"':'';
					$str.='<option '.$selected.' value="'.$tableColumn['column_name'].'">'.$tableColumn['column_name'].'</option>';
				}
				$str.='</select>';
				$this->assign('foreignColumn',$str);
				
				$tpl = 'z_foreignkey';
				break;
			default:
				$tpl = 'z_singleErea';
				break;
		}
	
		$this->display($tpl);
		
		exit;

	}
	
	public function cate_menu_list($list_id=0){
		$CM_MenuList=M($this->cm_list)->select();
		
		$selectStr='';
		$selectStr.='<select class="selectArea" name="list_id">';
		$selectStr.='<option value="0">---请选择分类菜单---</option>';
		
		foreach($CM_MenuList as $row){
			$select='';
			if($row['list_id']==$list_id){$select='selected="true"';}
			$selectStr.='<option '.$select.' value="'.$row['list_id'].'">---'.$row['list_name'].'---</option>';
		}
		
		
		$selectStr.='</select>';
		return $selectStr;
	}
	
	
	
	public function del_column()
	{
		
		$tab_col_id = $_REQUEST['tab_col_id'];
	
		//获取表名称

		//获取字段名称
		$column = M($this->cm_table_column)->where('tab_col_id='.$tab_col_id)->find();
		$column_name = $column['column_name'];
		$table =  M($this->cm_table)->where('table_id='.$column['table_id'])->find();
		$table_name = $table['table_name'];
		
	
		$sql="ALTER TABLE ".$table_name." DROP ".$column_name;
			
		//删除数据库字段
		M()->query($sql);
		
		$this->DELETE_ONE($this->cm_table_column, $tab_col_id, U('Model/table_column_list',array('table_id'=>$column['table_id'])));
	
		
	}
	
	
	public function do_edit_column()
	{	
		$column_type = $_REQUEST['column_type'];
	
		$condition['tab_col_id'] = $_REQUEST['tab_col_id'];
	
		$data = array();
		$data['column_name'] = $_REQUEST['column_name'];
		//$data['column_type'] = $_REQUEST['column_type'];
		$data['is_add'] = $_REQUEST['is_add'];
		$data['is_edit'] = $_REQUEST['is_edit'];
		$data['column_default_value'] = $_REQUEST['column_default_value'];
		$data['column_sort'] = $_REQUEST['column_sort'];
		$data['column_desc'] = empty( $_REQUEST['column_desc'] ) ? '' : trim( $_REQUEST['column_desc'] );
		$data['column_help'] = empty( $_REQUEST['column_help'] ) ? '' : trim( $_REQUEST['column_help'] );
		$data['column_error_message'] = empty( $_REQUEST['column_error_message'] ) ? '' : trim( $_REQUEST['column_error_message'] );
		
		//验证相关
		$data['is_validate'] = $_REQUEST['is_validate'] ;
		$data['min_length']  = trim( $_REQUEST['min_length'] ) ;
		$data['max_length'] = trim( $_REQUEST['max_length'] ) ;
		$data['validate_regexp'] = trim( $_REQUEST['validate_regexp'] ) ;
		
		switch($column_type){
	
			case 'singleErea':
				
				M($this->cm_table_column)->where($condition)->save($data);
				break;
	
			case 'multiErea':
					
				M($this->cm_table_column)->where($condition)->save($data);
					
				break;
	
			case 'edictor':
					
				M($this->cm_table_column)->where($condition)->save($data);
					
				break;
			case 'singlePic':
					
				M($this->cm_table_column)->where($condition)->save($data);
					
				break;
			case 'multiPic':
	
				$pic_attrs=array();
	
				$attr_name       =  $_REQUEST['mpic_attr_name'] ;
				$attr_desc       =  $_REQUEST['mpic_attr_desc'] ;
				$attr_type       =  $_REQUEST['mpic_attr_type'] ;
				$attr_sort       =  $_REQUEST['mpic_attr_sort'] ;
	
				foreach ($attr_name as $key =>$pic_attr){
					$one_attr = array();
					$one_attr['key']   = $attr_name[$key];
					$one_attr['desc']  = $attr_desc[$key];
					$one_attr['attr_type']  = $attr_type[$key];
					$one_attr['sort']  = $attr_sort[$key];
					$pic_attrs[]= $one_attr;
				}
				
				$temp = array();
				$temp['pic_attrs'] = $pic_attrs;
				$data['column_attrs'] = serialize($temp);
				
				
				
				M($this->cm_table_column)->where($condition)->save($data);
					
				break;
			case 'hidden':
					
				M($this->cm_table_column)->where($condition)->save($data);
					
				break;
				
			case 'select':
			case 'lianDong':

				$attr = array();
				$attr['type']       = $_REQUEST['selectType'];
				$attr['value_key']  = trim( $_REQUEST['select_value_key'] );	//id健名
				$attr['value_desc'] = trim( $_REQUEST['select_value_desc'] );	//id对应值得健名
				$attr['value_parent'] = trim( $_REQUEST['select_value_parent'] );//父id健名
				$attr['data_sql']   = trim( $_REQUEST['selectSQL'] );
				$attr['list_id']   = trim( $_REQUEST['list_id'] );
	
				$static_data_key    = $_REQUEST['select_static_key'];
				$static_data_desc   = $_REQUEST['select_static_value'];
	
				$lists =array();
				foreach ($static_data_key as $key =>$select_key){
					$one_option = array();
				
					$one_option['value'] = $select_key;
					$one_option['desc'] = $static_data_desc[$key];
					$lists[]=$one_option;
	
				}
	
				$attr['lists'] = $lists;
	
				//var_dump($attr);exit;
				$data['column_attrs'] = serialize($attr);
				//AAA($condition);
	
				M($this->cm_table_column)->where($condition)->save($data);
					
				break;
	
			case 'radio':
	
				$lists = array();
				$radio_key  =  $_REQUEST['radio_static_key'] ;
				$radio_desc =  $_REQUEST['radio_static_value'] ;
	
				foreach ($radio_key as $key=>$val){
					$one_radio = array();
					$one_radio['value'] = $radio_key[$key];
					$one_radio['desc']  = $radio_desc[$key];
	
					$lists[]=$one_radio;
				}
	
	
				$radio_attr=array();
				$radio_attr['type'] = 1;//静态数据
				$radio_attr['lists'] = $lists;
				$data['column_attrs'] = serialize($radio_attr);
	
				M($this->cm_table_column)->where($condition)->save($data);
					
				break;
	
			case 'date':
	
				M($this->cm_table_column)->where($condition)->save($data);
					
				break;
			
			case 'hidden_date':
				
				$data['column_attrs']	=	$_REQUEST['hidden_time_is_synchronization'];
				
				M($this->cm_table_column)->where($condition)->save($data);
			
				break;
			
			case 'date_time':
					
				M($this->cm_table_column)->where($condition)->save($data);
					
				break;
			case 'date_range':
					
				M($this->cm_table_column)->where($condition)->save($data);
					
				break;
			case 'date_time_range':
					
				M($this->cm_table_column)->where($condition)->save($data);
					
				break;
			case 'checkedbox':
	
				$checkbox_attr=array();
				$checkbox_attr['type']       = $_REQUEST['checkboxType'];
				$checkbox_attr['value_key']  = trim( $_REQUEST['checkbox_value_key'] );
				$checkbox_attr['value_desc'] = trim( $_REQUEST['checkbox_value_desc'] );
				$checkbox_attr['data_sql']   = trim( $_REQUEST['checkboxSQL'] );
	
				$lists = array();
				$checkbox_key  =  $_REQUEST['checkbox_static_key'] ;
				$checkbox_desc =  $_REQUEST['checkbox_static_value'] ;
	
				foreach ($checkbox_key as $key=>$val){
					$one_checkbox = array();
					$one_checkbox['value'] = $checkbox_key[$key];
					$one_checkbox['desc']  = $checkbox_desc[$key];
	
					$lists[]=$one_checkbox;
				}
				
	
				$checkbox_attr['lists'] = $lists;
				
				$data['column_attrs'] = serialize($checkbox_attr);
	
				
				M($this->cm_table_column)->where($condition)->save($data);
					
				break;
			
			case 'session':
					
				M($this->cm_table_column)->where($condition)->save($data);
					
				break;
			
			case 'foreignKey':
			
				$foreignKey_attr=array();
				$foreignKey_attr['table_name'] = $_REQUEST['foreignKey_table'];
				$foreignKey_attr['column_name'] = $_REQUEST['foreignKey_column'];	
				$data['column_attrs'] = serialize($foreignKey_attr);
				
				M($this->cm_table_column)->where($condition)->save($data);
					
				break;
				
			
		}
	
		
		$this->success('操作成功',U('Model/edit_column' , array('tab_col_id'=>$_REQUEST['tab_col_id'] , 'column_type'=>$_REQUEST['column_type'])));
	
	}
	
	
	public function Test_from()
	{
		Vendor('Form.Form2');
		
		$table_id = $_REQUEST['table_id'];
		$tableInfo=M($this->cm_table)->where('table_id='.$table_id)->find();
	
		$test_form = new Form(U('Activity/do_add_ac'));
		
		$test_form->_addBaseElement($tableInfo['table_name']);
		
		$form = $test_form->_getForm();
			
		$this->assign('form',$form);
		$this->display('test_from');
		
	}
	
	public function list_list()
	{
		$rs = $this->ALL_LIST($this->cm_list,true,'list_id ASC');
		
		$this->assign('list_list',$rs);
		
		$this->display('list_list');
		
	}
	public function do_add_list()
	{
		$data['list_name'] = trim($_REQUEST['list_name']);
		
		$data['list_desc'] = trim($_REQUEST['list_desc']);
		
		$this->ADD_ONE($this->cm_list, $data, U('Model/list_list'));
	}
	
	
	public function del_list()
	{
		$this->DELETE_ONE($this->cm_list,$_REQUEST['list_id'],U('Model/list_list'));
	}
	
	
	public function list_item()
	{
		$list_id = $_REQUEST['list_id'];
		
		$this->assign('test_select',$this->gen_list_Select($_REQUEST['list_id'],'test_select') );
		$this->assign('list',$this->Get_ONE($this->cm_list,'list_id='.$list_id));
		
		$list_item = $this->ALL_LIST($this->cm_list_item,'list_id='.$list_id);		
		$list_item = $this->getTree($list_item);
		$this->assign('list_item',$list_item);
		
		$this->display('list_item');
	}
	
	
	public function add_list_item()
	{
		$list_id = $_REQUEST['list_id'];
		
		$this->assign('select',$this->gen_list_Select($list_id,'item_parent'));
		
		$this->assign('list_id',$list_id);
		
		$this->display('add_list_item');
	}
	
	
	public function do_add_list_item()
	{	
		$this->ADD_ONE($this->cm_list_item,$_REQUEST,U('Model/list_item',array('list_id'=>$_REQUEST['list_id'])));
	}
	
	public function edit_list()
	{
		$list_info = $this->CM('cm_list')->find($_REQUEST['list_id']);
		
		$this->assign('list_info',$list_info);
		
		$this->display('list_edit');
	}
	
	
	public function do_edit_list()
	{
		//判断表下的某个字段是否已经存在
		
		$list_id = $_REQUEST['list_id'];
		
		$list = $this->CM('cm_list')->find($_REQUEST['list_id']);
		$list_name  =  $list['list_name'];
		
		$list_expand_column = array();
	
		$sql='select  column_name, column_comment  from Information_schema.columns  where table_Name ="cm_list_item"  AND table_schema = "'.C('DB_NAME').'"';		
		$exist_column = M()->query($sql);
		//AAA($exist_column);
		//获取category的所有扩展字段
		foreach ($exist_column as $key=>$one_column){
			//如果存爱字段
			
			$expand_column = explode('_',$one_column['column_name']);
			$expand_column_name = $expand_column[0];
			//print_r($expand_column); echo '<br>';
			//如果是category开头
			if($list_name == $expand_column_name)
			{
				$one =  array();
				$one['column_name'] = $one_column['column_name'];
				$one['sign'] = 'delete';
				
				$list_expand_column[$one_column['column_name']]=$one;

			}

		}
	//AAA($list_expand_column);	
		$expands = $_REQUEST['list_add_column_name'];
		$expands_type = $_REQUEST['list_column_type'];
		$expands_desc = $_REQUEST['list_add_column_desc'];
		
		//判断操作符
		foreach( $expands as $key => $font_column_name )
		{
			if( empty($font_column_name) ) continue;
			$column_op = $list_name.'_'.$font_column_name;
			
			if( isset( $list_expand_column[$column_op] ) )
			{
				$list_expand_column[$column_op]['sign'] = 'update';
				
			}
			else
			{
				$list_expand_column[$column_op] =  array('column_show_name'=>$font_column_name,'column_name'=>$column_op,'sign'=>'insert');
			}
		}
	
		foreach($list_expand_column as $val)
		{
			if($val['sign'] =='insert')
			{
				$sql="ALTER TABLE cm_list_item ADD ".$val['column_name']." VARCHAR( 255 )  NOT NULL DEFAULT ''  ";
				M()->query($sql);
			}
			
			if($val['sign'] =='delete')
			{
				$sql="ALTER TABLE cm_list_item DROP ".$val['column_name'];			
				//删除数据库字段
				M()->query($sql);
			}
		}
		
		$now_column = array();
		$my_key=0;
		foreach($list_expand_column as $key=>$val)
		{
			if($val['sign']!='delete')
			{
				$now_column[]=array(
					'column_show_name'=>$val['column_show_name'],
					'column_name'=>$val['column_name'],
					'column_type'=>$expands_type[$my_key],
					'column_desc'=>$expands_desc[$my_key]
				);
				$my_key+=1;
			}
			
		}
		$data['expand_column'] = serialize($now_column);
		$data['list_id'] = $list_id;
		
		M('cm_list')->save($data);
		AAA($now_column);
		//AAA($now_column);
		
		
	
	//AAA($list_expand_column);
		// foreach($_REQUEST['list_add_column_name'] as $key => $list_column_name){
			
			// $flag = true;
			
			// echo $flag.'<br>';
			// if( $flag  ){
				
				
			
				// $sql="ALTER TABLE cm_list_item ADD ".$list_column_name." VARCHAR( 255 )  NOT NULL DEFAULT ''  ";
				// M()->query($sql);
			// }
		// }
	}
	
	
	public function edit_list_item()	
	{
		Vendor('Form.Form2');
		$list_id = $_REQUEST['list_id'];
		$list_item_id = $_REQUEST['list_item_id'];
		
		$item = $this->GET_ONE($this->cm_list_item,'list_item_id='.$list_item_id);
		
		//获取扩展字段
		$list = $this->GET_ONE('cm_list','list_id='.$list_id);
		$expand_column = unserialize( $list['expand_column'] );
				
		$input_data= '';
		foreach($expand_column as $key => $one_column)
		{
			$form = new Form();
			$column_info = array();
			$column_info['column_name'] = $one_column['column_name'];
			$input_str = $form->typeToBuildInput($one_column['column_type'],$column_info,$item[$one_column['column_name']],'editor');
			
			//包装td
			$input_str = $form->add_wraper($input_str,$label='td',$attr=array());
			$desc_str = $form->add_wraper($one_column['column_desc'],$label='td',$attr=array());
			
			$input_tr = $form->add_wraper($desc_str.$input_str,$label='tr',$attr=array());
			
			$input_data.=$input_tr;
		}
		
		$this->assign('expand_input_str',$input_data);
		
		
		
		$this->assign('select',$this->gen_list_Select($list_id,'item_parent',$item['item_parent']));
		
		$this->assign('item',$item);
		
		$this->assign('list_id',$list_id);
		
		$this->display('edit_list_item');
	}
	
	
	public function do_edit_list_item()
	{
	
		$this->EDIT_ONE($this->cm_list_item,$_REQUEST,U('Model/list_item',array('list_id'=>$_REQUEST['list_id'])));
	}
	

	
	
	
	private function gen_list_Select($list_id,$selectName='',$list_item_id=0)
	{
		$items = $this->ALL_LIST($this->cm_list_item,'list_id='.$list_id);
		
		$items = $this->getTree($items);
		
		$str='';
		$str.='<select name="'.$selectName.'">';
		$str.='<option value="0">---选择父级分类---</option>';
		
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
			if($val['item_parent']==$pid){
				$val['deep'] = $deep;
				$tree[]=$val;
				unset($data[$key]);
				$this->getTree99($data,$val['list_item_id'],$tree,$deep);
			}
		}		
		$deep-=1;		
	}
	
	public function getTableTree($data,$pid=0)
	{
		$tree=array();
		$deep = 0;			
		$this->getTableTree99($data,$pid,$tree,$deep);		
		return $tree;
	}
	
	
	private function getTableTree99($data,$pid,&$tree,&$deep)
	{		
		$deep+=1;
		
		foreach($data as $key=>$val){
			if($val['pid']==$pid){
				$val['deep'] = $deep;
				$tree[]=$val;
				unset($data[$key]);
				$this->getTableTree99($data,$val['table_id'],$tree,$deep);
			}
		}		
		$deep-=1;		
	}
	
	
	
	private function getTree200($data,$pid=0)
	{
		static $tree=array();
		static $deep = 0;
		
		$deep+=1;
		
		foreach($data as $key=>$val){
			if($val['item_parent']==$pid){
				$val['deep'] = $deep;
				$tree[]=$val;
				unset($data[$key]);
				$this->getTree200($data,$val['list_item_id']);
			}
		}
		
		$deep-=1;
		return $tree;
	}
	public function ajax_set_is()
	{
		$table_name = trim( $_REQUEST['table_name'] );
		$column_name = trim( $_REQUEST['column_name'] );
		
		$pk = $this->CM($table_name)->getPk();
		
		$data[$pk]  = trim( $_REQUEST['rowid'] );
		$data[$column_name] = intval( $_REQUEST['val'] );
		
		//AAA($data);
		$rs = $this->CM($table_name)->save($data);
		
		if($rs) {
			echo 'success';exit;
		}else{
			echo 'fail';exit;
		}
		
	}
	
	public function table_list_manage()
	{
		$table_id = $_REQUEST['table_id'];
		
		$condition['table_id'] = $table_id;
		
		$all_column =  M($this->cm_table_column)->where($condition)->select();
		
		$condition['is_list'] = 1;
		$list_column = M($this->cm_table_column)->where($condition)->select();
		
		$table_button = M($this->cm_table)->where('table_id='.$table_id)->find();
		$table_button = unserialize($table_button['list_button']);
		//AAA($table_button);
		$this->assign('table_button' , $table_button);
		$this->assign('list_column' , $list_column);
		$this->assign('all_column' , $all_column);
		$this->assign('table_id' , $table_id);
		
		$this->display();
		
	}
	
	public function do_edit_list_attr()
	{
	
		//列表每列的长度 和数据格式
		$ids = $_REQUEST['column_ids'];
		$list_attrs = $_REQUEST['list_congif'];
		
		foreach($list_attrs as $key=>$val){
			if(!empty($val)){
				$data=array();
				$data['list_attr'] = trim($val);
				$data['tab_col_id'] = $ids[$key];
				
				$rs =  M($this->cm_table_column)->save($data);
				
			}
		}
		
		//列表按钮
		
		$button_name = $_REQUEST['list_button_name'];
		$button_href = $_REQUEST['list_button_href'];
		
		$all_button = array();
		//AAA($button_name);
		foreach($button_name as $key=>$val){
			
			if( empty($val) || empty($button_href[$key])){
				continue;
			}
			
			$one_button = array();
			$one_button['otherParams'] = array();
			$one_button['desc'] = $val;
			$one_button['href'] = $button_href[$key];
			
			$one_button_other_params = $_REQUEST['other_params_value_'.$key];
			//AAA($one_button_other_params );   //other_params_value_0
			if(count($one_button_other_params)>0){
				
				foreach($one_button_other_params as $key2=>$value){
					$ParamsArr	=	array();
					$ParamsArr['key']	=	trim($value);
					$ParamsArr['value']	=	trim($value);
					
					$one_button['otherParams'][]	=	$ParamsArr;
				}
			}
			
			$all_button[]=$one_button;
			
		}
		//AAA($all_button);
		$table_data['table_id'] = $_REQUEST['table_id'];
		$table_data['list_button'] = serialize($all_button);
		
		//AAA($table_data);
		M($this->cm_table)->save($table_data);
		
		$this->alert_jump('保存成功',U('Model/table_list_manage',array('table_id'=>$_REQUEST['table_id'])));
	}
	
	public function table_list_search()
	{
	
		$table_id = $_REQUEST['table_id'];
		
		$condition['table_id'] = $table_id;
		$condition['is_search'] = '1';
		
		$search_column = $this->CM($this->cm_table_column)->where($condition)->select();
		$table =  $this->CM($this->cm_table)->where('table_id='.$table_id)->find();
		$search_option = unserialize($table['search_option']);
		
		$this->assign('search_column',$search_column);
		$this->assign('search_option',$search_option);
		$this->assign('table_id',$table_id);
		
		//AAA($search_column);
		$this->display();
	}
	
	public function set_search_option()
	{
		$table_id = $_REQUEST['table_id'];
		
		$search_columns = $_REQUEST['tab_col_id'];
		
		$all_search_options = array();
		
		foreach($search_columns as $key=>$one_column_value){
			
			$tempArr = explode('+',$one_column_value);
			$tab_col_id = $tempArr[0];
			$column_type = $tempArr[1];
			
			$one_condition = array();
			$one_condition['tab_col_id'] = $tab_col_id;
			
			switch($column_type){
	
				case 'singleErea':
					$match_method = $_REQUEST['match_method_'.$tab_col_id];
					
					switch($match_method){
						case '=':
							$one_condition['match'] = 'eq';
						break;
						
						case 'like':
							$one_condition['match'] = 'like';
						break;
						
						case '>':
							$one_condition['match'] = 'gt';
						break;
						
						case '<':
							$one_condition['match'] = 'lt';
						break;
					}
					
				break;
				
				case 'foreignKey':		
					
					$one_condition['match'] = 'eq';
					$one_condition['is_defaule_search'] = intval( $_REQUEST['is_defaule_search'] );
				break;
				
				case 'select':
					$one_condition['match'] = 'eq';
				break;
				
				case 'date':
					$one_condition['match'] = 'date';
				break;
				
				case 'date_time':
					$one_condition['match'] = 'date';
				break;
				
				case 'radio':
					$one_condition['match'] = 'eq';
				break;
			}
			
			$all_search_options[] = $one_condition;
		}
		$data['search_option'] = serialize($all_search_options);
		$data['table_id'] = $table_id;
		//AAA($all_search_options);
		
		$this->CM($this->cm_table)->save($data);
		
		$this->alert_jump('操作成功',U('Model/table_list_search',array('table_id'=>$table_id)));
		
	}
	
	
	public function copyAction($actionName){
	
		Vendor('Form.File');
		
		$file=File::getInstance();
	
	 	$back=$file::copyFile('./Admin/Lib/Action/Demo/DemoAction.class.php','./Admin/Lib/Action/');
		
		if($back==1){
			$is_rename=$file::reName($actionName.'Action.class.php','./Admin/Lib/Action/DemoAction.class.php');
			
			if($is_rename==1){
			
				$con=file_get_contents('./Admin/Lib/Action/'.$actionName.'Action.class.php');
				
				$str=str_replace('Demo',$actionName,$con);
				
				file_put_contents('./Admin/Lib/Action/'.$actionName.'Action.class.php',$str);
				
				$this->copyModel($actionName);
				
				$this->copyTpl($actionName);
			}else{
				die('重命名控制器失败');
			}
		}else{
			die('复制控制器失败');
		}
		
		
	 	
		
		
		
	}
	
	
	public function copyModel($modelName){
		
		Vendor('Form.File');
		
		$file=File::getInstance();
	
	 	$back=$file::copyFile('./Admin/Lib/Model/Demo/DemoModel.class.php','./Admin/Lib/Model/');
		
		if($back==1){
			$is_rename=$file::reName($modelName.'Model.class.php','./Admin/Lib/Model/DemoModel.class.php');
			
			if($is_rename==1){
			
				$con=file_get_contents('./Admin/Lib/Model/'.$modelName.'Model.class.php');
				
				$str=str_replace('DemoModel',$modelName.'Model',$con);
				
				$str=str_replace('Demo',$modelName,$str);
				
				$str=str_replace('demo',strtolower($modelName),$str);
				
				file_put_contents('./Admin/Lib/Model/'.$modelName.'Model.class.php',$str);
				
				
			}else{
				die('重命名模型失败');
			}
		}else{
			die('复制模型失败');
		}
	}
	
	
	public function copyTpl($tplName){
			
		Vendor('Form.File');
		
		$file=File::getInstance();
		
		$back=$file::copydir('./Admin/Tpl/DemoTpl','./Admin/Tpl/'.$tplName);
		
		$con=file_get_contents('./Admin/Tpl/'.$tplName.'/list.html');
		
		$str=str_replace('__APP__/Demo/Demo_add','__APP__/'.$tplName.'/'.$tplName.'_add',$con);
		
		file_put_contents('./Admin/Tpl/'.$tplName.'/list.html',$str);
	}
	
	public function genCode($modelName){
	
		$this->copyAction($modelName);
		
		
	}
	
	
	public function excel_options(){
			
		$table_id = $_REQUEST['table_id'];
		
		
		$rs = $this->ALL_LIST($this->cm_table_column,'table_id='.$table_id,'excel_in_sort ASC');
		
		
		$this->assign('table',$this->GET_ONE($this->cm_table,'table_id='.$table_id));
		
		
		$this->assign('tab_col_list',$rs);
		
		$this->display('table_excel_options');
	}
	
	
	public function table_excel_in_map(){
			
		$tab_col_id = $_REQUEST['tab_col_id'];
		
		//获取字段信息
		$res = $this->GET_ONE($this->cm_table_column,'tab_col_id='.$tab_col_id);
			
		$this->assign('vo',$res);
		
		$this->assign('mapInfo',unserialize($res['excel_in_map']));
		
		//获取菜单列表信息
		$res = $this->ALL_LIST($this->cm_list);
		
		$this->assign('cm_list_info',$res);
		
		
		$this->display('table_excel_in_map');
	}
	
	
	public function set_excel_maps(){
		
		$tab_col_id      =  $_REQUEST['tab_col_id'];
		
		$map_type        =  $_REQUEST['map_type'];
		
		$excel_in_keys   =  $_REQUEST['excel_in_key'];
		
		$excel_in_descs  =  $_REQUEST['excel_in_desc'];
		
		$map_list_id     =  $_REQUEST['map_list_id'];
		
		$excel_in_sort   =  $_REQUEST['excel_in_sort'];
		
		$resArr['map_type'] = $map_type;
		
		$resArr['map_list_id'] = $map_list_id;
		
		$tempArr=array();
		
		foreach($excel_in_keys as $in_key=>$excel_in_key){
			
			if(!empty($excel_in_key) && !empty($excel_in_descs[$in_key]) ){
				
				$one_map = array();
				$one_map['key']  = $excel_in_key;
				$one_map['desc'] = $excel_in_descs[$in_key];
				$tempArr[]=$one_map;
			}
			
		}
		
		$resArr['map_lists'] = $tempArr;
		
		$data['excel_in_map'] = serialize($resArr);
		
		$data['tab_col_id'] = $tab_col_id;
		
		$data['excel_in_sort'] = $excel_in_sort;
		
		$this->EDIT_ONE($this->cm_table_column,$data,U('Model/table_excel_in_map',array('tab_col_id'=>$tab_col_id)));
		
	}
	
	
	public function ajax_set_excel_in_match(){
			
		$tab_col_id  =  $_REQUEST['tab_col_id'];
		
		$column_name =  trim($_REQUEST['column_name']);
		
		$value 		 =  trim($_REQUEST['value']);
		
		$data['tab_col_id'] =  $tab_col_id;
		$data[$column_name] =  $value;
		
		if($this->CM($this->cm_table_column)->save($data)){
			echo '1';exit;
		}else{
			
			echo '0';exit;
		}
		exit;
	}
	
	
	public function table_excel_out_map(){
		
		$tab_col_id = $_REQUEST['tab_col_id'];
		
		//获取字段信息
		$res = $this->GET_ONE($this->cm_table_column,'tab_col_id='.$tab_col_id);
			
		$this->assign('vo',$res);
		
		$this->assign('mapInfo',unserialize($res['excel_out_map']));
		
		//获取菜单列表信息
		$res = $this->ALL_LIST($this->cm_list);
		
		$this->assign('cm_list_info',$res);
		
		$this->display('table_excel_out_map');
	}
	
	
	//设置导出MAP
	
	public function set_excel_out_maps(){
		
		$tab_col_id       =  $_REQUEST['tab_col_id'];
		
		$map_type         =  $_REQUEST['map_type'];
		
		$excel_out_keys   =  $_REQUEST['excel_out_key'];
		
		$excel_out_descs  =  $_REQUEST['excel_out_desc'];
		
		$map_list_id      =  $_REQUEST['map_list_id'];
		
		$excel_out_sort   =  $_REQUEST['excel_out_sort'];
		
		$resArr['map_type']    = $map_type;
		
		$resArr['map_list_id'] = $map_list_id;
		
		$tempArr=array();
		
		foreach($excel_out_keys as $out_key=>$excel_out_key){
			
			if(!empty($excel_out_key) && !empty($excel_out_descs[$out_key]) ){
				
				$one_map = array();
				$one_map['key']  = $excel_out_key;
				$one_map['desc'] = $excel_out_descs[$out_key];
				$tempArr[]=$one_map;
			}
			
		}
		
		$resArr['map_lists'] = $tempArr;
		
		$data['excel_out_map'] = serialize($resArr);
		
		$data['tab_col_id'] = $tab_col_id;
		
		$data['excel_out_sort'] = $excel_out_sort;
		
		$this->EDIT_ONE($this->cm_table_column,$data,U('Model/table_excel_out_map',array('tab_col_id'=>$tab_col_id)));
		
	}
	
	
	
	
	
	
	
	
	
}

?>
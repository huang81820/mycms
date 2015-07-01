<?php

class Form{
	
	public 	$formAction				=	'';							//表单action
	public 	$tableName				=	'';							//默认操作的表
	public 	$formMethod				=	'POST';						//表单提交的方式
	public 	$formTarget				=	'';							//表单提交的Target，用于非跳转表单提交
	public 	$formName				=	'';							//表单的name属性
	public 	$uploadPicPath			=	FORM_PIC_UPLOAD_PATH;		//组件的图片上传路径
	public	$uploadFilePath			=	FORM_FILE_UPLOAD_PATH;		//组件的文件上传路径
	public	$inputInfo				=	'';							//组装的所有组件的字符串
	public	$inputInfoArr				=	'';						//组装的所有组件的字符串(数组)
	public	$inputDescArr				=	'';						//组装的所有组件的描述信息(数组)
	
	public	$editInfo				=	'';							//组装编辑组件的字符串
	public 	$inputRecord			=	'';							//组装组件的历史记录,用于动态生成添加数据时的数据数组
	public 	$addData				=	'';							//入库的数组
	public	$formSubmitButton		=	'';							//表单的提交的按钮
	public 	$inputValidators		=	array();					//记录所有字段验证信息
	public  $messageColor			=	'red';						//提示信息的字体颜色
	public  $myTplEngine			= 	'';							//模板引擎
	public  $defaultTplDir			=   '../../ThinkPHP/Extend/Vendor/Form/formTpl/';
	
	public  $cm_table				=   CM_TABLE;					//table主表名称
	public  $cm_table_column		=   CM_TABLE_COLUMN;			//table字段表名称名称
	public  $cm_list				=   CM_LIST;					//菜单主表名称
	public  $cm_list_item			=   CM_LIST_ITEM;				//菜单详细表名称
	
	
	//构造函数
	public function __construct($formAction='',$formName='',$formMethod='POST',$formTarget=''){
		
		$this->formAction	=	$formAction;
		
		$this->formMethod	=	$formMethod;
		
		$this->formTarget	=	$formTarget;
		
		$this->formName		=	$formName;
		
		$this->tableName	=	$formName;
		
		$this->myTplEngine  =   Think::instance('View'); 
	}
	
	/**
		自动获取数据并添加进表，表名默认为  $formName;
	**/
	
	public function addData($cm_ok_url=''){
		
		if($cm_ok_url==''){
			return $last_insert_id=$this->CM($this->tableName)->add($this->recordToBuildData('add'));
		}else{
			if($this->CM($this->tableName)->add($this->recordToBuildData('add'))){
				$this->alert_jump('添加成功',$cm_ok_url);
			}else{
				$this->alert_back('添加失败');
			}
		}
		exit;
	}
	
	
	
	
	/**
		自动获取数据并修改update进表，表名默认为  $formName;
	**/
	
	public function saveData($cm_ok_url=''){
		if($cm_ok_url==''){
			return $this->CM($this->tableName)->save($this->recordToBuildData('edit'));
		}else{
			if($this->CM($this->tableName)->save($this->recordToBuildData('edit'))){
				$this->alert_jump('编辑成功',$cm_ok_url);
			}else{
				$this->alert_back('编辑失败');
			}
		}
		exit;
	}
	
	
	/*	添加组件的方法 :addElement
	**	$type:组件类型有：singleErea  |    multiErea	|	edictor		|	hidden	|	radio	|	select	|	singlePic
	**					  multiPic	  |	     file		|	  date		|	date_range	|	checkedbox	|	其他  |
	**	$column_info：  数组结构为：	array(
	**									'column_name'			=>		'字段名称',
	**									'column_desc'			=>		'字段描述',
	**									'column_help'			=>		'字段提示信息',
	**									'column_error_message'	=>		'错误提示信息',
	**									'attrs'					=>		'字段额外属性'
	**								)
	**					
	**	$value：	初始值或修改是需要填入的信息,默认为''
	**	$operate_type： 'add' |	'editor'  默认为'add'
	*/
	
	
	public function addElement($type,$column_info,$value='',$operate_type='add'){
	
		$temp  = $this->typeToBuildInput($type,$column_info,$value,$operate_type);
		$this->inputInfo    .= $temp;
		
		
		$this->inputInfoArr []= $temp ;
		
		$this->inputDescArr []= $column_info;
		
		$this->inputRecord[] = (array('type'=>$type,'column_info'=>$column_info,'value'=>$value,'operate_type'=>$operate_type));
	
		$InputValidators=array();
		
		$InputValidators['column_name']=$column_info['column_name'];
		
		$InputValidators['onShow']		=	$column_info['column_desc'];
		$InputValidators['onFocus']		=	$column_info['column_help'];
		$InputValidators['onError']		=	$column_info['column_error_message'];
		$InputValidators['is_validate']	=	$column_info['is_validate'];
		$InputValidators['min']			=	$column_info['min_length'];
		$InputValidators['max']			=	$column_info['max_length'];
		$InputValidators['regExp']		=	trim($column_info['validate_regexp']);
		
		$this->inputValidators[]=$InputValidators;
	}
	
	public function get_wrap_table()
	{
		//生成所有行
		$str='';
		//print_r ($this->inputInfoArr[2]);exit;
		foreach($this->inputInfoArr as $key=> $oneInput)
		{
			if(!empty($oneInput)){
				$one_tr = $this->add_tr_wraper( $oneInput ,$this->inputDescArr[$key]);
				$str.=$one_tr;
			}

		}
		
		
		if($this->formSubmitButton==''){
			$this->addSubButton();
		}
		$str.=$this->formSubmitButton;
		
		$table = $this->add_table_wraper( $str);

		$table_form = $this->add_form_wraper( $table );
		
		//添加验证器
		$table_form.='<script>$(document).ready(function(){ new formValidator("'.$this->formName.'",'.json_encode($this->inputValidators).'); }); </script>';
		
		return $table_form;
	}
	
	public function add_tr_wraper($inputStr='',$column_info)
	{	
		$column_type = $column_info['column_type'];
		
		$skip_array = array();
		$skip_array[] = 'primaryKey';
		$skip_array[] = 'session';
		$skip_array[] = 'hidden';
		$skip_array[] = 'foreignKey';
		
		if( in_array($column_type,$skip_array) ){
			return $inputStr;
		}
		
		$td_column_desc = $this->add_wraper($column_info['column_desc'],'td');

		$td_innput = $this->add_wraper($inputStr,'td');
		
		$td_column_help = $this->add_wraper($column_info['column_help'],'td');
		
		$tdX3 = $td_column_desc.$td_innput.$td_column_help;
		$tr = $this->add_wraper($tdX3,'tr');
		
		return $tr;
		
	}
	
	public function add_table_wraper($need_wrap_str)
	{//var_dump($need_wrap_str);exit;
		$table = $this->add_wraper($need_wrap_str,'table');
		
		return $table;
	}
	
	
	public function add_form_wraper($need_wrap_str)
	{
		//<form id="'.$this->formName.'" name="'.$this->formName.'" action="'.$this->formAction.'"  method="'.$this->formMethod.'" '.$target.' >';
		$form_attr  = array();
		$form_attr['id'] = $this->formName;
		$form_attr['name'] = $this->formName;
		$form_attr['action'] = $this->formAction;
		$form_attr['method'] = $this->formMethod;
		$form_attr['enctype'] = "multipart/form-data";
		
		$from = $this->add_wraper($need_wrap_str,'form',$form_attr);
		return $from;
	}

	
	
	public function add_wraper($need_wrap_str,$label='td',$attr=array())
	{
		$attr_str = '';
		foreach($attr as $key=>$one_attr){
			$attr_str.=' '.$key.'="'.$one_attr.'" ';
		}
		$str='';
		$str.='<'.$label.'  '.$attr_str.'>'.$need_wrap_str.'</'.$label.'>';
		
		return $str;
	}
	
	//添加提交的按钮
	public function addSubButton($column_desc='操作',$value='提交',$id='DD_submitBtn',$className='DD_submitBtn'){

		$str='<tr>';
		$str.='<td>'.$column_desc.'</td>';
		$str.='<td><input id="'.$id.'" class="'.$className.' button" type="submit" /></td>';
		$str.='<td><span style="color:red; display:none;"></span></td>';
		$str.='</tr>';
		$this->formSubmitButton=$str;
	}
	
	
	//通过添加的组件生成整个Form结构并以字符串返回
	public function _getForm(){
		$target='';
		if($this->getTarget()!=''){
			$target='target="'.$this->getTarget().'"';
		}
		$str.='<form id="'.$this->formName.'" name="'.$this->formName.'" action="'.$this->formAction.'"  method="'.$this->formMethod.'" '.$target.' >';
		$str.='<table>';
		
		$str.=$this->inputInfo;
		
		if($this->formSubmitButton==''){
			$this->addSubButton();
		}
		$str.=$this->formSubmitButton;
		
		$str.='</table>';
		$str.='</form>';
		$str.='<script>$(document).ready(function(){ new formValidator("'.$this->formName.'",'.json_encode($this->inputValidators).'); }); </script>';
		//file_put_contents('./test.txt',$str);
		
		return $this->get_wrap_table();
		//return $str;
	}
	
	
	
	
	
	/**读取数据库字段信息,并添加到inputInfo记录里面
	*  $table_name: 表格的名称
	**/
	
	public function _addBaseElement($table_name){
		
		$tableInfo=$this->CM($this->cm_table)->where('table_name="'.$table_name.'"')->find();
		
		$where='table_id='.$tableInfo['table_id'].' AND (is_add=1 OR column_type="primaryKey")' ;
		
		//读取数据库字段
		$columns = $this->CM($this->cm_table_column)->where($where)->order('cm_table_column_sort ASC,tab_col_id ASC')->select();
	//	AAA($columns);
		//AAA($columns  );
		//AAA($columns);
		//循环添加左右表单
		foreach($columns as $key=>$input){
			$column_info['column_type']                   = $input['column_type'];
			$column_info['column_name']                   = $input['column_name'];
			$column_info['column_desc']                   = $input['column_desc'];
			$column_info['column_help']                   = $input['column_help'];
			$column_info['column_error_message']          = $input['column_error_message'];
			$column_info['attrs']                         = unserialize( $input['column_attrs'] );
			$column_info['attrs_string']                  = $input['column_attrs'] ;
			
			$column_info['is_validate']=$input['is_validate'];
			$column_info['min_length']=$input['min_length'];
			$column_info['max_length']=$input['max_length'];
			$column_info['validate_regexp']=trim($input['validate_regexp']);
			
			
			$this->addElement($input['column_type'],$column_info,$input['column_default_value'] );
		}
		
	}
	
	
	
	
	/**获取编辑时的表单,
	*	$valueArr：某 一条记录的结果集
	*  返回String
	**/
	
	public function _getEditorForm($valueArr){
		
		$editorStr='';
		
		//AAA($valueArr);
		foreach($this->inputRecord as $key=>$column){
			foreach($valueArr as $valKey=>$singleValue)
			{
				if($valKey==$column['column_info']['column_name']){
					
				
					$inputStr = $this->typeToBuildInput($column['type'],$column['column_info'],$singleValue,'editor');
					//包装  tr td 返回一行
					$tr_input = $this->add_tr_wraper($inputStr,$column['column_info']);					
					$editorStr.=$tr_input;
				}
			}
		}
	//AAA($editorStr);
		$this->editInfo = $editorStr;
		
		if($this->formSubmitButton==''){
			$this->addSubButton();
		}
		$editorStr.=$this->formSubmitButton;
		
		//包装table
		$edit_table = $this->add_table_wraper( $editorStr);
		//包装form
		$edit_table_form = $this->add_form_wraper( $edit_table );
		
		
		
		$edit_table_form.='<script>$(document).ready(function(){ new formValidator("'.$this->formName.'",'.json_encode($this->inputValidators).'); }); </script>';

		return $edit_table_form;
	
	}
	
	
	
	
	
	//根据所添加的字段动态组装获取添加数据时的数组
	
	public function recordToBuildData($type='add'){	
		//echo '<pre>';print_r($this->inputRecord);echo '</pre>';exit;
		$data=array();
		
		foreach($this->inputRecord as $key=>$column){						
			switch($column['type']){
				case 'primaryKey':
					if($type=='edit'){
						$data[$column['column_info']['column_name']]=!empty($_REQUEST[$column['column_info']['column_name']]) ? $_REQUEST[$column['column_info']['column_name']] : 0;
					}
				break;
				
				case 'hidden':
					$data[$column['column_info']['column_name']]=isset($_REQUEST[$column['column_info']['column_name']]) ? $_REQUEST[$column['column_info']['column_name']] : ' ';
				break;
				
				case 'singleErea':
					$data[$column['column_info']['column_name']]=isset($_REQUEST[$column['column_info']['column_name']]) ? $_REQUEST[$column['column_info']['column_name']] : ' ';
				break;
				
				case 'multiErea':
					$data[$column['column_info']['column_name']]=isset($_REQUEST[$column['column_info']['column_name']]) ? $_REQUEST[$column['column_info']['column_name']] : ' ';
				break;
				
				case 'edictor':
					$data[$column['column_info']['column_name']]=isset($_REQUEST[$column['column_info']['column_name']]) ? $_REQUEST[$column['column_info']['column_name']] : ' ';
				break;
				
				case 'radio':
					$data[$column['column_info']['column_name']]=isset($_REQUEST[$column['column_info']['column_name']]) ? $_REQUEST[$column['column_info']['column_name']] : 0;
				break;
				
				case 'select':
				case 'lianDong':
					$data[$column['column_info']['column_name']]=isset($_REQUEST[$column['column_info']['column_name']]) ? $_REQUEST[$column['column_info']['column_name']] : 0;
				break;
				
				case 'singlePic':
					$data[$column['column_info']['column_name']]=isset($_REQUEST[$column['column_info']['column_name']]) ? $_REQUEST[$column['column_info']['column_name']] : ' ';
				break;
				
				case 'multiPic':
					$columnAttr=$column['column_info']['attrs'];
					$picAttrs=$columnAttr['pic_attrs'];
					$pic_Infos=array();
					if(isset($_REQUEST[$column['column_info']['column_name']])){
						foreach($_REQUEST[$column['column_info']['column_name']] as $pickey=>$val){
							$onePic=array();
							$onePic['url']	=	$val;
							foreach($picAttrs as $singlePicAttr){
								if($singlePicAttr['attr_type']!=0){
								
									$onePic[$singlePicAttr['key']]	=	$_REQUEST[$column['column_info']['column_name'].'_'.$singlePicAttr['key']][$pickey];
								}
							}
							$pic_Infos[]	=	$onePic;
						}
					}
					usort($pic_Infos,'sort_pic_fform');

					$data[$column['column_info']['column_name']]	=	serialize($pic_Infos);
				
				break;
				
				case 'hidden_date':
					if($type=='add')
					{
						
						$data[$column['column_info']['column_name']]=time();
					}
					if($type=='edit'){
						if($column['column_info']['attrs_string']==1)
						{
							$data[$column['column_info']['column_name']]=time();
						}
					}
					
				break;
				
				case 'date':
					$data[$column['column_info']['column_name']]=isset($_REQUEST[$column['column_info']['column_name']]) ? strtotime($_REQUEST[$column['column_info']['column_name']]) : ' ';
				break;
				
				case 'date_time':
					$data[$column['column_info']['column_name']]=isset($_REQUEST[$column['column_info']['column_name']]) ? strtotime($_REQUEST[$column['column_info']['column_name']]) : ' ';
				break;
				
				case 'date_range':
					if(isset($_REQUEST[$column['column_info']['column_name']])){		
						$data[$column['column_info']['column_name']]=implode(',',array_map(strtotime,$_REQUEST[$column['column_info']['column_name']]));
					}
				break;
				
				case 'date_time_range':
					if(isset($_REQUEST[$column['column_info']['column_name']])){		
						$data[$column['column_info']['column_name']]=implode(',',array_map(strtotime,$_REQUEST[$column['column_info']['column_name']]));
					}
				break;
				
				case 'checkedbox':
					if(isset($_REQUEST[$column['column_info']['column_name']])){		
						$data[$column['column_info']['column_name']]=implode(',',$_REQUEST[$column['column_info']['column_name']]);
					}
				break;
				
				case 'foreignKey':
					if($type=='add'){
						if(isset($_REQUEST[$column['column_info']['column_name']])){		
							$data[$column['column_info']['column_name']]=$_REQUEST[$column['column_info']['column_name']];
						}
					}
					
				break;
				
				case 'file':
					$data[$column['column_info']['column_name']]=isset($_REQUEST[$column['column_info']['column_name']]) ? $_REQUEST[$column['column_info']['column_name']] : ' ';
				break;
				
				case 'session':
					if($type=='add'){
						$data[$column['column_info']['column_name']]=isset($_SESSION[$column['column_info']['column_name']]) ? $_SESSION[$column['column_info']['column_name']] : ' ';
					}
					
				break;
				
				
				default:
					//$data[$column['column_info']['column_name']]=isset($_REQUEST[$column['column_info']['column_name']]) ? $_REQUEST[$column['column_info']['column_name']] : ' ';
				
			}
		}
		
		$sort_column_name = $this->tableName.'_sort';
		if(empty($_REQUEST[$sort_column_name])){
			$table_m = $this->CM($this->tableName);
			$table_m_pk = $table_m->getpk();
			
			$sql = 'SELECT max('.$table_m_pk.') from '.$this->tableName;
			$res = $table_m->query($sql);
			$max_id = $res[0]['max('.$table_m_pk.')']+1;
			
			$data[$sort_column_name] = $max_id;
		}else{
			
			$data[$sort_column_name] = $_REQUEST[$sort_column_name];
		}
		
		return $data;
	}
	

	
	
	//根据字段的类型组装加载相应的input组件
	
	public function typeToBuildInput($type,$column_info,$value='',$operate_type='add'){ //echo $operate_type.'---';exit;
		
		$id						=		$column_info['column_name'];
		$name					=		$column_info['column_name'];
		$column_desc			=		$column_info['column_desc'].':';
		$column_help			=		$column_info['column_help'];
		$column_error_message	=		$column_info['column_error_message'];
		$atttrs					=		$column_info['attrs'];
		
		
		$this->myTplEngine->assign('id',$id);
		$this->myTplEngine->assign('name',$name);
		$this->myTplEngine->assign('column_desc',$column_desc);
		$this->myTplEngine->assign('column_help',$column_help);
		$this->myTplEngine->assign('column_error_message',$column_error_message);
		$this->myTplEngine->assign('atttrs',$atttrs);
		$this->myTplEngine->assign('value',$value);
		$this->myTplEngine->assign('messageColor',$this->messageColor);
		
		switch($type){
			case 'singleErea':								//单行文本
				$style='style="height:24px; width:700px; text-align:left"';
				$this->myTplEngine->assign('style',$style);
				if($operate_type=='add'){
					
					return $this->formFetch('singleErea_add');
				}
				if($operate_type=='editor'){
					
					return $this->formFetch('singleErea_edit');
				}
				
				break;
				
			case 'password':								//密码
				$style='style="height:24px; width:170px; text-align:center"';
				$this->myTplEngine->assign('style',$style);
				if($operate_type=='add'){
					
					return $this->formFetch('password_add');
				}
				if($operate_type=='editor'){
					
					return $this->formFetch('password_edit');
				}
				break;
			
			case 'multiErea':								//多行文本
				if($operate_type=='add'){
					
					return $this->formFetch('multiErea_add');
				}
				if($operate_type=='editor'){
					
					return $this->formFetch('multiErea_edit');
				}
				break;
				
			case 'edictor':									//文本编辑器
				$this->myTplEngine->assign('uploadPicPath',U($this->uploadPicPath));
				if($operate_type=='add'){
					
					return $this->formFetch('editor_add');
				}
				
				if($operate_type=='editor'){
					
					return $this->formFetch('editor_edit');
				}
				
				break;
			
			case 'hidden':									//隐藏域
				if($operate_type=='add'){
					
					return $this->formFetch('hidden_add');
				}
				if($operate_type=='editor'){
					
					return $this->formFetch('hidden_edit');
				}
				break;
				
			case 'singlePic':								//单图片
			
				$style='style="height:22px; width:170px; text-align:center "';
				$this->myTplEngine->assign('uploadPicPath',U($this->uploadPicPath));
				$this->myTplEngine->assign('style',$style);
				
				if($operate_type=='add'){
					
					return $this->formFetch('singlePic_add');
				}
				if($operate_type=='editor'){
					
					return $this->formFetch('singlePic_edit');
				}
				
				break;

				
			case 'select':								//下拉列表
				$attrs_arr=$atttrs;
				$this->myTplEngine->assign('attrs_arr',$attrs_arr);
				if($attrs_arr['type']==0)
				{
					$result=$this->CM()->query($attrs_arr['data_sql']);
					
					if($operate_type=='add'){
						
						
						$this->myTplEngine->assign('result',$result);
						
						return $this->formFetch('select_0_add');
					}
					if($operate_type=='editor'){
						
						
						$this->myTplEngine->assign('result',$result);
						
						return $this->formFetch('select_0_edit');
					}
				}
				
				if($attrs_arr['type']==1){
					if($operate_type=='add'){
						
						$options=$attrs_arr['lists'];
						$this->myTplEngine->assign('options',$options);
						
						return $this->formFetch('select_1_add');
					}
					
					if($operate_type=='editor'){
						$options=$attrs_arr['lists'];   
						$this->myTplEngine->assign('options',$options);
						
						return $this->formFetch('select_1_edit');
					}
				}
				
				if($attrs_arr['type']==2){		
					if($operate_type=='add'){		
						$list_id=$attrs_arr['list_id'];
						$selectStr	=	$this->gen_list_Select($list_id,$name,0,$column_desc);
						$this->myTplEngine->assign('selectStr',$selectStr);
						
						return $this->formFetch('select_2_add');
					}
					
					if($operate_type=='editor'){
						$list_id=$attrs_arr['list_id'];
						$selectStr	=	$this->gen_list_Select($list_id,$name,$value,$column_desc);
						$this->myTplEngine->assign('selectStr',$selectStr);
						
						return $this->formFetch('select_2_edit');
					}
				}
				
				break;
				
			
			case 'radio': 										//单选属性框
				$attrs_arr=$atttrs;
				
				if($attrs_arr['type']==1){
					if($operate_type=='add'){
						$options=$attrs_arr['lists'];
						$this->myTplEngine->assign('options',$options);
						
						return $this->formFetch('radio_1_add');
					}
					
					if($operate_type=='editor'){		
						$options=$attrs_arr['lists'];
						$this->myTplEngine->assign('options',$options);
						
						return $this->formFetch('radio_1_edit');
					}
				}
				
				
				
				if($attrs_arr['type']==0){
					if($operate_type=='add'){
						$str='<tr>';
						$str.='<td>'.$column_desc.'</td>';
						$str.='<td>';
						$options=$attrs_arr['lists'];
						$result=$this->CM()->query($attrs_arr['table']['data_sql']);
						foreach($result as $val){
							$str.=$val[$attrs_arr['table']['value_desc']].':<input id="'.$id.'" name="'.$name.'" type="radio" value="'.$val[$attrs_arr['table']['value_key']].'"  />';
						}
						$str.='</td>';
						$str.='<td style="color:'.$this->messageColor.'" >'.$column_help.'<span style="color:red; display:none;">'.$column_error_message.'</span></td>';
						$str.='</tr>';
						return $str;
					}
					if($operate_type=='editor'){
						$str='<tr>';
						$str.='<td>'.$column_desc.'</td>';
						$str.='<td>';
						$options=$attrs_arr['lists'];
						$result=$this->CM()->query($attrs_arr['table']['data_sql']);
						foreach($result as $val){
							$check='';
							if($val[$attrs_arr['table']['value_key']]==$value){ $check=' checked="checked"';}
							$str.=$val[$attrs_arr['table']['value_desc']].':<input '.$check.' id="'.$id.'" name="'.$name.'" type="radio" value="'.$val[$attrs_arr['table']['value_key']].'"  />';
						}
						$str.='</td>';
						$str.='<td style="color:'.$this->messageColor.'" >'.$column_help.'<span style="color:red; display:none;">'.$column_error_message.'</span></td>';
						$str.='</tr>';
						return $str;
					}
				}
				break;
			
			case 'multiPic':									//多图片(多属性)
				$this->myTplEngine->assign('uploadPicPath',U($this->uploadPicPath));
				if($operate_type=='add'){
					
					$atttrsArr=$atttrs;
					$picAttrs=$atttrsArr['pic_attrs'];
					$this->myTplEngine->assign('picAttrs',$picAttrs);
					
					return $this->formFetch('multiPic_add');
				}
				
				if($operate_type=='editor'){
					$result=unserialize($value);
					$atttrsArr=$atttrs;
					$picAttrs=$atttrsArr['pic_attrs'];
					
					usort($result,'multiFormPicSort');
					$this->myTplEngine->assign('result',$result);
					$this->myTplEngine->assign('picAttrs',$picAttrs);
					
					return $this->formFetch('multiPic_edit');
				}
				break;
			
			
			
			
			case 'date':										//日期
				$style='style="height:24px; width:170px; text-align:center"';
				$this->myTplEngine->assign('style',$style);
				if($operate_type=='add'){
					
					return $this->formFetch('date_add');
				}
				
				if($operate_type=='editor'){
				
					return $this->formFetch('date_edit');
				}
				
				break;
				
			case 'date_time':										//日期时间
				$style='style="height:24px; width:170px; text-align:center"';
				$this->myTplEngine->assign('style',$style);
				if($operate_type=='add'){
				
					return $this->formFetch('date_time_add');
				}
				
				if($operate_type=='editor'){
				
					return $this->formFetch('date_time_edit');
				}
				
				break;
			
			case 'date_range':									//日期范围
				$style='style="height:24px; width:170px; text-align:center"';
				$this->myTplEngine->assign('style',$style);
				if($operate_type=='add'){
					
					return $this->formFetch('date_range_add');
				}
				if($operate_type=='editor'){
					$arr=explode(',',$value);
					$value1=count($arr)>=1?date("Y-m-d",$arr[0]):'';
					$value2=count($arr)==2?date("Y-m-d",$arr[1]):'';
					$this->myTplEngine->assign('value1',$value1);
					$this->myTplEngine->assign('value2',$value2);
					
					return $this->formFetch('date_range_edit');
				}
				
				break;
				
			case 'date_time_range':									//日期范围
				$style='style="height:24px; width:170px; text-align:center"';
				$this->myTplEngine->assign('style',$style);
				if($operate_type=='add'){
					
					return $this->formFetch('date_time_range_add');
				}
				if($operate_type=='editor'){
					$arr=explode(',',$value); //print_r($value);exit;
					$value1=count($arr)>=1?date("Y-m-d H:i:s",$arr[0]):'';
					$value2=count($arr)==2?date("Y-m-d H:i:s",$arr[1]):'';
					$this->myTplEngine->assign('value1',$value1);
					$this->myTplEngine->assign('value2',$value2);
					
					return $this->formFetch('date_time_range_edit');
				}
				
				break;
				
			
			case 'checkedbox':									//多选框
			
				$attrs_arr=$atttrs;  
				$this->myTplEngine->assign('attrs_arr',$attrs_arr);
				if($attrs_arr['type']==1){
					if($operate_type=='add'){
						$options=$attrs_arr['lists'];
						$this->myTplEngine->assign('options',$options);
						
						return $this->formFetch('checkedbox_1_add');
					}
					
					if($operate_type=='editor'){
						$valueArr=explode(',',$value);
						$options=$attrs_arr['lists'];
						$this->myTplEngine->assign('valueArr',$valueArr);
						$this->myTplEngine->assign('options',$options);
						
						return $this->formFetch('checkedbox_1_edit');
					}
					
				}else{	
					if($operate_type=='add'){
						$result=$this->CM()->query($attrs_arr['data_sql']);
						
						$this->myTplEngine->assign('result',$result);
						
						return $this->formFetch('checkedbox_0_add');
					}
					
					if($operate_type=='editor'){  
						$valueArr=explode(',',$value);
						
						$result=$this->CM()->query($attrs_arr['data_sql']);  
						$this->myTplEngine->assign('valueArr',$valueArr);
						$this->myTplEngine->assign('result',$result);
						
						return $this->formFetch('checkedbox_0_edit');
					}
					
				}
				break;
				
				
				case 'file':									//附件
					$style='style="height:24px; width:170px; text-align:center"';
					$this->myTplEngine->assign('style',$style);
					$this->myTplEngine->assign('uploadFilePath',U($this->uploadFilePath));
					
					if($operate_type=='add'){
						return $this->formFetch('file_add');
					}
					
					if($operate_type=='editor'){
						return $this->formFetch('file_edit');
					}
					
				break;
				
				case 'session':									//全局值
					
					return '';
					
				break;
				
				
				case 'primaryKey':
						if($operate_type=='add'){
							$str='';
							return $str;
						}
						
						if($operate_type=='editor'){
							$str='<input type="hidden" name="'.$name.'" value="'.$value.'" />';
							return $str;
						}
				break;
				
				case 'foreignKey':
						$foreignInfo	=	$atttrs;   //AAA($foreignInfo); 		
						if($operate_type=='add'){
							$str='<input type="hidden" name="'.$name.'" value="'.$_REQUEST[$foreignInfo['column_name']].'" />';
							return $str;
						}
						
						if($operate_type=='editor'){
							$str='';
							return $str;
						}
				break;
				
				
				
				
				case 'other' :
					if($operate_type=='add'){
						$str='<tr>';
						$str.='<td>'.$column_desc.'</td>';
						$str.='<td><input type="'.$type.'" name="'.$name.'" value="'.$value.'" /></td>';
						$str.='<td>'.$column_help.'<span style="color:red; display:none;">'.$column_error_message.'</span></td>';
						$str.='</tr>';
						return $str;
					}
					
					if($operate_type=='editor'){
						$str='<tr>';
						$str.='<td>'.$column_desc.'</td>';
						$str.='<td><input type="'.$type.'" name="'.$name.'" value="'.$value.'" /></td>';
						$str.='<td style="color:'.$this->messageColor.'" >'.$column_help.'<span style="color:red; display:none;">'.$column_error_message.'</span></td>';
						$str.='</tr>';
						return $str;
					}
					
					break;
				
				case 'special' :
					return '';
					break;
					
				case 'lianDong' :
					//echo $operate_type.'--';
					//echo '--'.$value;
					//print_r($column_info);
					$attrs_arr=$atttrs;
					
					//AAA($operate_type);
					$str='';
					$str='<style>';
					$str.='.DD_LIST_TT{ width:103px; display:none ; position:absolute; left:400px; top:-10px}';
					$str.='.DD_LIST_TT li{  width:103px; height:28px; line-height:28px; float:left; background:#000; margin-bottom:1px; color:#FFF; text-align:center; position:relative; margin-left:1px; cursor:pointer; position:relative}';
					$str.='.DD_LIST_TT li:hover{background:#6bae00; }';
					$str.='.SUB_DD_LIST{ width:103px; position:absolute; left:103px; top:-10px; display:none}';
					$str.='.DD_SELECTED_VALUE{text-align:center;border:1px solid green; width:400px;  height:28px; line-height:28px; background:#FFF; position:relative; cursor:pointer;font-size:13px;}';
					$str.='</style>';
				
					if( $attrs_arr['type']==0 )
					{
						$options = $this->CM()->query($attrs_arr['data_sql']);	
					
						$valueText = '';
						$valueParent_id = 0;
						if( $operate_type=='add'  )
						{
							$str.='<input type="hidden" name="'.$name.'"/>';
							$str.= $this->get_lian_dong($options,0,$name,$attrs_arr['value_key'],$attrs_arr['value_desc'],$attrs_arr['value_parent']);
							
							return $str;
							
						}
						
						if( $operate_type=='editor'  )
						{
							//取到文本值
							foreach($options as $key=>$val){
								if($val[$attrs_arr['value_key']] == $value){
									$valueText = $val[$attrs_arr['value_desc']];
									$valueParent_id = $val[$attrs_arr['value_parent']];
								}
							}
							//AAA($attrs_arr['value_key'].'---'.$attrs_arr['value_desc'].'---'.$attrs_arr['value_parent']);
							//去到向上递归路线 $options,$sub_id,$MapKey,$MapValue,$ParentKey
							$up_level_txt = $this->get_lian_dong_up_txt($options,$valueParent_id,$attrs_arr['value_key'],$attrs_arr['value_desc'],$attrs_arr['value_parent']);
							
							
							
							$str.='<input type="hidden" name="'.$name.'" value="'.$value.'"/>';
							$str.= $this->get_lian_dong($options,0,$name,$attrs_arr['value_key'],$attrs_arr['value_desc'],$attrs_arr['value_parent'],$up_level_txt.$valueText);
							return $str;
						}	
					}
					if($attrs_arr['type']==1)
					{
						$options=$attrs_arr['lists'];
						
						if( $operate_type=='add' )
						{
							$str.='<input type="hidden" name="'.$name.'"/>';
							$str.= $this->get_lian_dong($options,0,$name,'value','desc','parent_id');
							return $str;							
						}
						
						if( $operate_type=='editor' ){
							
							//取到文本值
							foreach($options as $key=>$val){
								if( $val['value'] == $value ){
									$valueText = $val['desc'];
								}
							}
							$str.='<input type="hidden" name="'.$name.'" value="'.$value.'"/>';
							$str.= $this->get_lian_dong($options,0,$name,'value','desc','parent_id',$valueText);
							return $str;
							
						}
						
					}
					if($attrs_arr['type']==2)
					{
						$list_id=$attrs_arr['list_id'];
						
						$options = $this->CM($this->cm_list_item)->where('list_id='.$list_id)->select();
						
						$valueText = '';
						$valueParent_id = 0;
						
						if( $operate_type=='add' ){
							$str.='<input type="hidden" name="'.$name.'" value="'.$value.'"/>';
							$str.= $this->get_lian_dong($options,0,$name,'list_item_id','item_desc','item_parent');
							return $str;
							
						}
						if($operate_type=='editor'){
						
							//取到文本值
							foreach($options as $key=>$val){
								if( $val['list_item_id'] == $value ){
									$valueText = $val['item_desc'];
									$valueParent_id = $val['item_parent'];
								}
							}
							//AAA($options );
							$str.='<input type="hidden" name="'.$name.'" value="'.$value.'"/>';
							
							$up_level_txt = $this->get_lian_dong_up_txt($options,$valueParent_id,'list_item_id','item_desc','item_parent');
							//AAA($up_level_txt);
							$str.= $this->get_lian_dong($options,0,$name,'list_item_id','item_desc','item_parent',$up_level_txt.$valueText);
							return $str;
							
						}
						
						
					}

					break;	
				
				
				
				default:										//其他
					
					return '';
				
			
		}
	}
	//处理静态变量递归问题 
	public function get_lian_dong_up_txt($options,$sub_parent_id,$MapKey,$MapValue,$ParentKey)
	{
		//获取向上递归数组
		$up_level = array();
		$up_level_arr = $this->lian_dong_up($options,$sub_parent_id,$MapKey,$MapValue,$ParentKey,$up_level);
		
		//AAA($up_level_arr);
		$up_level_arr = array_reverse($up_level_arr);
		//转换成文本
		$str='';
		foreach($up_level_arr as $key=>$val){
			$str.=$val[$MapValue].'<font style="color:red; font-weight:700"> --></font>';
		}
		return $str;
	}
	
	//联动向上递归
	private	function lian_dong_up($options,$sub_parent_id,$MapKey,$MapValue,$ParentKey,&$up_level)
	{
		//static $up_level = array();
		
		foreach($options as $key=>$val){
			if( $val[$MapKey]==$sub_parent_id ){ 
			
				$up_level[] = $val;
				unset($options[$key]);
				
				if( $val[$ParentKey] !=0){	//如果父类id不等于0 则继续向上递归
					$this->lian_dong_up($options,$val[$ParentKey],$MapKey,$MapValue,$ParentKey,$up_level);
				}
				
			}
		}		
		
		
		return $up_level;
	}
	
	//包装联动
	public function get_lian_dong($data,$tid=0,$name,$MapKey,$MapValue,$ParentKey,$valueTxt)
	{
		$str='';
		$str.='<div class="DD_SELECTED_VALUE" DD_lianDong_wrap="'.$name.'">';
		$str.='<div DD_lianDong="'.$name.'">'.$valueTxt.'</div>';
		
		$str.=$this->get_lian_tree($data,0,$name,$MapKey,$MapValue,$ParentKey);
		
		$str.='</div>';
		$str.='<script> $(document).ready(function(){ new makeLianDong("'.$name.'");  }); </script>';
		
		return $str;
	}
	
	//递归获取联动 处理静态变量问题
	private function get_lian_tree($data,$tid=0,$name,$MapKey,$MapValue,$ParentKey)
	{		
		$str='';
		$deep = 0;	
		$this->getTreeStr($data,$tid,$name,$MapKey,$MapValue,$ParentKey,$str,$deep);		
		return $str;
	}
	
	//递归获取联动
	private function getTreeStr($data,$tid=0,$name,$MapKey,$MapValue,$ParentKey,&$str,&$deep){
		$deep+=1;		
		$TreeID = 'DD_LIANDONG_'.$name;
		$css1 = 'DD_LIST_TT';
		$css2 = 'SUB_DD_LIST';
				
		$str.='<ul  id="%s" class="%s">';
		
		if($deep==1){
			$str=sprintf($str,$TreeID,$css1);
		}else{
			$str=sprintf($str,'',$css2);
		}	
		
		foreach($data as $key=>$val){
			if($val[$ParentKey]==$tid){

				$str.='<li style="font-weight:normal; font-family:Arial; font-size:12px; " data-value="'.$val[$MapKey].'"    data-text="'.$val[$MapValue].'">';
				$str.=$val[$MapValue];

				unset($data[$key]);
				$this->getTreeStr($data,$val[$MapKey],$name,$MapKey,$MapValue,$ParentKey,$str,$deep);
				$str.='</li>';				
			}
		}
		$str.='</ul>';
		$deep-=1;
		
		return $str;//递归出口 如果循环玩所有的元素都未进入深一层递归
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
	
	private function gen_list_Select($list_id,$selectName='',$list_item_id=0,$column_desc='')
	{
		
		$items = $this->CM($this->cm_list_item)->where('list_id='.$list_id)->select();
		
		$items = $this->getTree($items);
		
		$str='';
		$str.='<select style="width:176px; height:27px;"  id="'.$selectName.'" name="'.$selectName.'">';
		$str.='<option value="0">---请选择'.$column_desc.'---</option>';
		
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
	
	
	private function CM($table=''){
			
		return M($table);
	}
	
	
	
	
	
	
	
	public function setFormName($formName){
	
		$this->formName		=	$formName;
		
		return $this;
	}
	
	public function setAction($action){
	
		$this->formAction	=	$action;
		
		return $this;
	}
	
	public function getAction(){
	
		return $this->formAction;
		
		return $this;
	}
	
	public function setMethod($method){
		
		$this->formMethod	=	$method;
		
		return $this;
	}
	
	public function setTarget($target){
	
		$this->formTarget	=	$target;
		
		return $this;
	}
	
	public function getMethod(){
	
		return $this->formMethod;
		
		return $this;
	}
	
	public function getFormName(){
	
		return $this->formName;
		
		return $this;
	}
	
	
	
	public function getTarget(){
	
		return $this->formTarget;
		
		return $this;
	}
	
	
	//弹窗跳转到指定URL
	public function alert_jump($content,$ok_dir)
	{	//echo $url.'---';exit;
		header("Content-type:text/html;charset=utf-8");
		echo '<script>alert("'.$content.'");window.location.href="'.$ok_dir.'";</script>';
		exit;
	}
	//弹窗并返回
	public function alert_back($content)
	{
		header("Content-type:text/html;charset=utf-8");
		echo '<script>alert("'.$content.'");window.history.go(-1);</script>';
		exit;
	}
	
	
	public function formFetch($tpl){
		
		return $this->myTplEngine->fetch($this->defaultTplDir.$tpl);
	}
	
	
	
}


function  sort_pic_fform($a,$b){
	if ($a['sort'] == $b['sort']) return 0;
	return ($a['sort'] > $b['sort']) ? 1 : -1;
}














 ?>
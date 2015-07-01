<?php 

class TableList{

	public $Operates				=array();						//记录操作集合
	public $primaryKey				='';							//主键
	
	public  $cm_table				=   CM_TABLE;					//table主表名称
	public  $cm_table_column		=   CM_TABLE_COLUMN;			//table字段表名称名称
	public  $cm_list				=   CM_LIST;					//菜单主表名称
	public  $cm_list_item			=   CM_LIST_ITEM;				//菜单详细表名称

	public function __construct(){
		
	}
	
	
	public function auto_gen_list($tableName,$condition=true,$order='')
	{
		$where['table_name'] = $tableName;
		
		$table = M($this->cm_table)->where($where)->find();
		$table_button = unserialize( $table['list_button'] );
		
		foreach($table_button as $key => $one_button){
		
			$this->addOperate2($one_button['href'],$one_button['desc'],$one_button['otherParams']);
		}
		
		$search_form = $this->gen_search_form($table['table_id']);

		$table_list = $this->genList2($tableName,$condition);
		
		$temp['search_form'] = $search_form;
		$temp['table_list'] = $table_list;
		
		return $temp;
		//$this->addOperate()
	}
	
	public function get_search_data($table_name){
		
		$condition=array();
		
		$where['table_name'] = strtolower( trim($table_name) );
		$table = $this->CM($this->cm_table)->where($where)->find();
		
		$search_column = unserialize($table['search_option']);
		//AAA($search_column);
		foreach($search_column as $key=>$one_column){
			$column = $this->CM($this->cm_table_column)->where('tab_col_id='.$one_column['tab_col_id'])->find();
			
			$column_type = $column['column_type'];
			$column_name = $column['column_name'];
			switch($column_type){
				case 'singleErea':
					if( trim($_REQUEST[$column_name])!='' ){
						if( $one_column['match']=='like' ){
							$condition[$column_name]  =  array(trim($one_column['match']),'%'.trim($_REQUEST[$column_name]).'%');
						}else{
							$condition[$column_name]  =  array(trim($one_column['match']),trim($_REQUEST[$column_name]));
						}
					}
		
				break;
				
				case 'select':
					if(!empty($_REQUEST[$column_name])){
						$condition[$column_name] = array(trim($one_column['match']),$_REQUEST[$column_name]);
					}
					
				break;
				
				case 'date':
					$d1 = $_REQUEST[$column_name.'1'];//AAA($d1);
					$d2 = $_REQUEST[$column_name.'2'];
					$date1 = empty( $d1 ) ? 0 : strtotime($d1);
					$date2 = empty( $d2 ) ? time() : strtotime($d2);
					
					//AAA(strtotime('2015-02-13 10:27:00'));1970-01-01 08:00:00
					$condition[$column_name]  = array('between',array($date1,$date2));
				break;
				
				case 'date_time':
				
					$d1 = trim($_REQUEST[$column_name.'1']);
					$d1  = empty($d1) ? '' : substr_replace($d1," ",10,1);
				
					$d2 = trim($_REQUEST[$column_name.'2']);
					$d2  = empty($d2) ? '' : substr_replace($d2," ",10,1);
					
				
					$date_r_1 = empty( $d1 ) ? 0 : strtotime($d1);
					$date_r_2 = empty( $d2 ) ? time() : strtotime($d2);
				
					$condition[$column_name]  = array('between',array($date_r_1,$date_r_2));
					
				break;
				
				case 'foreignKey':
					
					if($one_column['is_defaule_search']==1){      //判断是否为默认搜索条件
						
						$messageArr	=	unserialize($column['column_attrs']);
						
						if(!empty($_REQUEST[$messageArr['column_name']])){
							
							$condition[$column_name] = array(trim($one_column['match']),$_REQUEST[$messageArr['column_name']]);
						}
						
						
					}
					
				break;
				
				case 'radio':
					if(isset($_REQUEST[$column_name])){
						if($_REQUEST[$column_name]!='cm_0'){
							$condition[$column_name] = array(trim($one_column['match']),$_REQUEST[$column_name]);
						}
					}
					//AAA($_REQUEST[$column_name]);
				break;
				
				
				
			}
		}
		//AAA($condition);
		return $condition;
		
	}
	
	public function gen_search_form($table_id){
		Vendor('Form.Form2');
	
		$where['table_id'] = $table_id;
		$where['is_search'] = '1';
		$search_column = $this->CM($this->cm_table_column)->where($where)->select();
		//AAA($search_column);
		$str='';
		
		
		foreach($search_column as $key =>$one_column){
			$column_type = $one_column['column_type'];
			
			switch($column_type) {
			
				case 'singleErea':
					$str.='<li>'.$one_column['column_desc'].':<input value="'.$_REQUEST[$one_column['column_name']].'" type="text" name="'.$one_column['column_name'].'" style="height:20px;"/></li>';
				break;
				
				case 'select':
					$rs = $this->built_select($one_column,$_REQUEST[$one_column['column_name']] );
					$str.=$rs;
				break;
				
				case 'date':
					
					$style='style="height:20px; width:170px; text-align:center"';
					$my_time1 = $_REQUEST[$one_column['column_name'].'1'];
					$my_time2 = $_REQUEST[$one_column['column_name'].'2'];
					
					$time1 = empty( $my_time1 ) ? 0 : strtotime( $my_time1 );
					$time2 = empty( $my_time2 ) ? time() : strtotime( $my_time2 );
					
					$str='<li>';
					$str.=$one_column['column_desc'];
					$str.=':<input readOnly '.$style.'  type="text" name="'.$one_column['column_name'].'1" value=\''.date("Y-m-d",$time1).'\'  onclick="WdatePicker()" /></td>';
					$str.='--<input readOnly '.$style.'  type="text" name="'.$one_column['column_name'].'2" value=\''.date("Y-m-d",$time2).'\'  onclick="WdatePicker()" /></td>';
					$str.='</li>';
					
				break;
				
				case 'date_time':
					
					$style='style="height:20px; width:170px; text-align:center"';
	
					$my_time1 = trim($_REQUEST[$one_column['column_name'].'1']);
					$my_time1  = empty($my_time1) ? '' : substr_replace($my_time1," ",10,1);
					
					$my_time2 = $_REQUEST[$one_column['column_name'].'2'];
					$my_time2  = empty($my_time2) ? '' : substr_replace($my_time2," ",10,1);
				
					$time1 = empty( $my_time1 ) ? 0 : strtotime( $my_time1 );
					$time2 = empty( $my_time2 ) ? time() : strtotime( $my_time2 );
					
					$str.='<li>';
					$str.=$one_column['column_desc'];
					$str.=':<input readOnly '.$style.'  type="text" name="'.$one_column['column_name'].'1" value=\''.date("Y-m-d-H:i:s",$time1).'\'  onclick="WdatePicker({dateFmt:\'yyyy-MM-dd-HH:mm:ss\'})" /></td>';
					$str.='--<input readOnly '.$style.'  type="text" name="'.$one_column['column_name'].'2" value=\''.date("Y-m-d-H:i:s",$time2).'\'  onclick="WdatePicker({dateFmt:\'yyyy-MM-dd-HH:mm:ss\'})" /></td>';
					$str.='</li>';
					
				break;
				
				case 'radio':
					
					$res = $this->CM($this->cm_table_column)->where('tab_col_id='.$one_column['tab_col_id'])->find();
					$radio_attr = unserialize( $res['column_attrs'] );
					
					$str.='<li>'.$one_column['column_desc'];
					
					$str.=':<select name="'.$res['column_name'].'">';
					$str.='<option value="cm_0">--请选择'.$res['column_desc'].'--</option>';
					foreach($radio_attr['lists'] as $key=>$one_option ){
						//判断当前option 的值是否等于 $_REQUEST的值 
						$is_selected = $one_option['value']==$_REQUEST[$one_column['column_name']] ? 'selected="true"' : '';
					
						$str.='<option '.$is_selected.' value="'.$one_option['value'].'">'.$one_option['desc'].'</option>';
					}
					$str.='</select>';
					$str.='</li>';
					
					
				break;
			}
		}
		
		
		
		
		//AAA($str);
		
		return $str;
	}
	
	
	function built_select($column_info,$value='',$operate_type='editor')
	{
		$id						=		$column_info['column_name'];
		$name					=		$column_info['column_name'];
		$column_desc			=		$column_info['column_desc'].':';
		$column_help			=		$column_info['column_help'];
		$column_error_message	=		$column_info['column_error_message'];
		$atttrs					=		$column_info['attrs'];
		
		$attrs_arr=unserialize($column_info['column_attrs']);
		
		$style='style="height:20px;"';
		//AAA($attrs_arr);
		if($attrs_arr['type']==0){
		
			if($operate_type=='editor'){
				$str='<li>';
				$str.=$column_desc;
				$str.=':<select '.$style.' name="'.$name.'">';
				$str.='<option value="0">---请选择'.$column_desc.'---</option>';
				$result=$this->CM()->query($attrs_arr['data_sql']);   //var_dump($result);exit;//print_r($result);exit;
				foreach($result as $val){
					$select='';
					if($val[$attrs_arr['value_key']]==$value){$select=' selected="selected"';}
					$str.='<option '.$select.' value="'.$val[$attrs_arr['value_key']].'">'.$val[$attrs_arr['value_desc']].'</option>';
				}
				$str.='</select>';
				$str.='</li>';
				return $str;
			}
		}
		
		if($attrs_arr['type']==1){
			
			
			if($operate_type=='editor'){
				$options=$attrs_arr['lists'];   
				$str='<li>';
				$str.=$column_desc;
				$str.=':<select '.$style.' name="'.$name.'">';
				$str.='<option value="0">---请选择'.$column_desc.'---</option>';
				foreach($options as $val){
					$select='';
					if($val['value']==$value){$select=' selected="selected"';}
					$str.='<option '.$select.' value="'.$val[$attrs_arr['value_key']].'">'.$val[$attrs_arr['value_desc']].'</option>';
				}//exit;
				$str.='</select>';
				$str.='</li>';
				return $str;
			}
		}
		
		if($attrs_arr['type']==2){		
			
			
			if($operate_type=='editor'){
				$list_id=$attrs_arr['list_id'];
				$selectStr	=	$this->gen_list_Select($list_id,$name,$value,$column_desc);
				$str='<li>';
				$str.=$column_desc.':';
				$str.=$selectStr;
				$str.='</li>';
				return $str;
			}
		}
		
		
	}
	
	
	public function addOperate2($href,$desc,$otherParams=array()){
		$templateArr	=	array();
		$templateArr['href']	=	$href;
		$templateArr['desc']	=	$desc;	
		
		
		if(count($otherParams)>0){
			$templateArr['otherParams']	=	array();
			foreach($otherParams as $key=>$value){
				$ParamsArr	=	array();
				$ParamsArr['key']	=	$value['key'];
				$ParamsArr['value']	=	$value['key'];
				
				$templateArr['otherParams'][]	=	$ParamsArr;
			}
		}
		//AAA($templateArr);
		$this->Operates[]		=	$templateArr;
		//print_r($this->Operates);exit;
		
		
		
	}
	
	public function addOperate($href,$desc,$otherParams=array()){
		$templateArr	=	array();
		$templateArr['href']	=	$href;
		$templateArr['desc']	=	$desc;	
		
		
		if(count($otherParams)>0){
			$templateArr['otherParams']	=	array();
			foreach($otherParams as $key=>$value){
				$ParamsArr	=	array();
				$ParamsArr['key']	=	$key;
				$ParamsArr['value']	=	$value;
				
				$templateArr['otherParams'][]	=	$ParamsArr;
			}
		}
		
		$this->Operates[]		=	$templateArr;
		//print_r($this->Operates);exit;
	}
	
	
	
	/*
	 * 列表自动生成（用于第二步骤）
	 * 
	 */
	
	public function genList2($tableName,$condition=true,$order=''){
		$tableInfo=$this->CM($this->cm_table)->where('table_name="'.$tableName.'"')->find();
		
		$where='table_id='.$tableInfo['table_id'].' AND is_list=1' ;
		
		//读取数据库字段
		$columns = $this->CM($this->cm_table_column)->where($where)->order('cm_table_column_sort ASC,tab_col_id ASC')->select();
	
	
		$list_table_id  = 'DD_table_'.trim($tableName); //列表id
		$list_column_name  = trim($tableName).'_sort';  //列表id
	
		$resultAndPage	=  $this->PAGE_LIST($tableName,$condition,$tableInfo['table_name'].'_sort',PAGE_SIZE);
		//AAA($resultAndPage);
		$listInfo	=	$resultAndPage['list'];
		$Page	=	$resultAndPage['page'];

		
		
		
		$str='';
		$str.='<div id="'.$list_table_id.'" class="dragSort">';
		$str.='<div class="table_thead">';
		foreach($columns as $column){
			if($column['column_type']=='primaryKey'){
				$str.='<span class="drag_span"> <input type="checkbox"   class="SELECT_ALL cm_check_all"/> </span>';
			}else{
				$str.='<span  class="drag_span" >'.$column['column_desc'].'</span>';
			}
		}
		$str.='<span  class="drag_span">操作</span>';
		$str.='</div>';
		
		foreach($listInfo as $key=>$row){
			$str.='<div class="table_row">';
			
			foreach($columns as $column){
				
				foreach($row as $result_key=>$value){
				
					if($result_key==$column['column_name'] && $column['column_type']=='primaryKey'){
						$this->primaryKey	=	$column['column_name'];
						$str.='<span  class="drag_span"><input name="'.$column['column_name'].'[]" type="checkbox" value="'.$value.'" class="cm_list_check" /></span>';
											
					}elseif($result_key==$column['column_name']  ){
						
						$column_attr = unserialize($column['column_attrs']);
						
						$str.='<span  class="drag_span">';
						switch($column['column_type']){
							case 'singleErea':
							
								$str.= empty( $column['list_attr'] ) ? $value : str_cut($value, intval($column['list_attr']) );
								break;								
							case 'multiErea':
								$str.= empty( $column['list_attr'] ) ? $value : str_cut($value, intval($column['list_attr']) );
								break;
							case 'date':
								$str.=date(trim($column['list_attr']),$value);
								break;
							case 'date_time':
								$str.=date(trim($column['list_attr']),$value);
								break;
							case 'radio':																
								$str.='<img class="ajax_set" columnname="'.$column['column_name'].'" rowid="'.$row['id'].'" val="'.$value.'" src="'.__PUBLIC__.'/images/radio'.$value.'.png" />';
								break;
							
							case 'singlePic':																
								$str.='<img class="toBig"  src="'.$value.'" width="30" height="28"/>';
								break;							
							
							case 'select':
								
								if($column_attr['type']==0){		//读取数据库
									$selected_desc = '';
								
									$result=$this->CM()->query($column_attr['data_sql']);
									foreach ($result as $select_key=>$one_select){
										if($one_select[$column_attr['value_key']] == $value){
											$selected_desc =$one_select[$column_attr['value_desc']];
										}
									}
									
									$str.=$selected_desc;
								}
								
								if($column_attr['type']==1){		//读取静态数据
									$selected_desc = '';						
									$result = $column_attr['lists'];
									foreach ($result as $select_key=>$one_select){
										if($one_select[$column_attr['value_key']] == $value){
											$selected_desc =$one_select[$column_attr['value_desc']];
										}
									}
										
									$str.=$selected_desc;
								}
								
								if($column_attr['type']==2){		//全局分类
									$selected_desc = '';
									$list_id = $column_attr['list_id'];
									
									$result = $this->CM($this->cm_list_item)->where('list_id='.$list_id)->select();

									foreach ($result as $select_key=>$one_select){
										if($one_select['list_item_id'] == $value){
											$selected_desc =$one_select['item_desc'];
										}
									}
								
									$str.=$selected_desc;
								}
								
							
								break;
						}
						$str.='</span>';
					
					}
					
				}
				
			}
			
			$str.='<span  class="drag_span">';   
			foreach($this->Operates as $OperatesKey=>$value){
				$paramArr=array();
				$paramArr["$this->primaryKey"]	=	$row[$this->primaryKey];
				//AAA($value['otherParams']);
				foreach($value['otherParams'] as $paramKey=>$singleParam){
					
					$paramArr[$singleParam['key']]	=	urlencode($row[$singleParam['key']]); //$singleParam['value'];
				}
				
				//AAA($paramArr);
				$str.='<a href="'.U($value['href'],$paramArr).'" >'.$value['desc'].'</a>';
				$str.=(count($this->Operates)-1)==$OperatesKey? '':'&nbsp;|&nbsp;';
			}
			$str.='</span>';
			
			$str.='</div>';
		}
		$str.='<div class="table_footer" style="height:30px;-background:red;">
		<input id="cm_batch_dels" type="button" class="button" value="批量删除" style="float:left;" cm_href="'.__APP__.'/'.ucfirst(strtolower($tableName)).'/'.ucfirst(strtolower($tableName)).'_batch_del" />			
		<span style="text-align:right;width:98%; line-height:0px; border:none; margin-right:20px;"  class="pagination">'.$Page.'</span></div>';
		
		$str.='</div>';  //结束table
		
		//状态0 和状态1图片
		$status_img0 = __PUBLIC__.'/images/radio0.png';
		$status_img1 = __PUBLIC__.'/images/radio1.png';
		
		$str.='<script>$(document).ready(function(){        
				new dragSort("'.$list_table_id .'","'.trim($tableName).'","'.U("Model/changeListSort").'" ); 
				new Fast_radio_set("'.$list_table_id.'","'.trim($tableName).'","'.U("Model/ajax_set_is").'","'.$status_img0.'","'.$status_img1.'");	
		});</script>';
		//AAA($str);
		return $str;
		
	}
	
	
	/*
	 * 列表自动生成（用于第一步骤）
	*
	*/
	
	public function genList($tableName,$where=true,$order=''){
		$tableInfo=$this->CM($this->cm_table)->where('table_name="'.$tableName.'"')->find();
		
		$where='table_id='.$tableInfo['table_id'].' AND is_list=1' ;
		
		//读取数据库字段
		$columns = $this->CM($this->cm_table_column)->where($where)->order('cm_table_column_sort ASC,tab_col_id ASC')->select();
	
		$resultAndPage	=  $this->PAGE_LIST($tableName);
		$listInfo	=	$resultAndPage['list'];
		$Page	=	$resultAndPage['page'];
		
		//AAA($resultAndPage);
		
		//$this->PRE($columns);
		
		
		$str='';
		$str.='<table>';
		$str.='<tr>';
		foreach($columns as $column){
			if($column['column_type']=='primaryKey'){
				$str.='<td><input type="checkbox" /></td>';
			}else{
				$str.='<td>'.$column['column_desc'].'</td>';
			}			
		}
		$str.='<td>操作</td>';
		$str.='</tr>';
		
		foreach($listInfo as $key=>$row){
			$str.='<tr>';
			
			foreach($columns as $column){
				
				foreach($row as $result_key=>$value){
				
					if($result_key==$column['column_name'] && $column['column_type']=='primaryKey'){
						$this->primaryKey	=	$column['column_name'];
						$str.='<td><input name="'.$column['column_name'].'[]" type="checkbox" value="'.$value.'" /></td>';
					
					}elseif($result_key==$column['column_name']  ){
											
						$str.='<td>';
						switch($column['column_type']){
							case 'singleErea':
							
								$str.= empty( $column['list_attr'] ) ? $value : str_cut($value, intval($column['list_attr']) );
								break;								
							case 'multiErea':
								$str.= empty( $column['list_attr'] ) ? $value : str_cut($value, intval($column['list_attr']) );
								break;
							case 'date':
								$str.=date(trim($column['list_attr']),$value);
								break;
							case 'date_time':
								$str.=date(trim($column['list_attr']),$value);
								break;
						}
						$str.='</td>';
					
					}
					
				}
				
			}
			
			$str.='<td>';
			foreach($this->Operates as $OperatesKey=>$value){
				$paramArr=array();
				$paramArr["$this->primaryKey"]	=	$row[$this->primaryKey];
				//AAA($value['otherParams']);
				foreach($value['otherParams'] as $paramKey=>$singleParam){
					
					$paramArr[$singleParam['key']]	=	urlencode($row[$singleParam['key']]); //$singleParam['value'];
				}
				
				//AAA($paramArr);
				$str.='<a href="'.U($value['href'],$paramArr).'" >'.$value['desc'].'</a>';
				$str.=(count($this->Operates)-1)==$OperatesKey? '':'&nbsp;|&nbsp;';
			}
			$str.='</td>';
			
			$str.='</tr>';
		}
		$str.='<tr><td style="text-align:right;" colspan=\'100\' class="pagination">'.$Page.'</td></tr>';
		$str.='<table>';
		//AAA($str);
		return $str;
		
	}
	
	
	private function PAGE_LIST($table,$where=true,$order='',$_pageSize=4){
		import('ORG.Util.Page');
		$count = $this->CM($table)->where($where)->count();
		
		$Page = new Page($count,$_pageSize);
		
		$rs = M($table)->where($where)->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$arr=Array(
			'page'	=>	$Page->show(),
			'list'	=>	$rs,
		);
		return $arr;
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
		$str.='<select style="width:176px; height:20px;"  id="'.$selectName.'" name="'.$selectName.'">';
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
	
	
	public function gen_add_button($table_name){
		
		$where['table_name'] = strtolower( trim($table_name) );
		
		$table = $this->CM($this->cm_table)->where($where)->find();
		
		$condition['table_id']    = $table['table_id'];
		$condition['column_type'] = 'foreignKey';
		$columns = $this->CM($this->cm_table_column)->where($condition)->select();
		
		$all_params=array();
		
		foreach($columns as $column){
			
			$attrArr = unserialize($column['column_attrs']);
			if(!empty($_REQUEST[$attrArr['column_name']])){
				
				$all_params[$attrArr['column_name']]	=	$_REQUEST[$attrArr['column_name']];
			}
		}
		
		$actionName=ucfirst($table_name).'/'.ucfirst($table_name).'_add';
		
		$str='';
		$str.='<a href="'.U($actionName,$all_params).'">添加'.$table['description'].'</a>';
		
		return $str;
	}
	
	
	public function gen_excel_form($table_name)
	{
		$str='';
		$str.='<div style="float:left">';
		$str.='<form action="'.U('Common/do_excel_in').'" method="POST" enctype="multipart/form-data" >';
		$str.='<input type="file" name="cm_excel_file_up" style="width:120px;float:left"  />';
		$str.='<input type="hidden" name="table_name" value="'.$table_name.'" />';
		$str.='<input type="submit" value="导入" class="button" style="float:left;"  />';
		$str.='</form>';
		$str.='</div>';
		$str.='<a href="__APP__/Common/excel_in_example/table_name/'.ucfirst(strtolower($table_name)).'" class="button" style="float:left; margin-left:20px;height:14px;">获取导入模板</a>';
		$str.='<a href="__APP__/Common/excel_out/table_name/'.ucfirst(strtolower($table_name)).'" class="button" style="float:left; margin-left:20px;height:14px;">导出</a>';
		
		return $str;
	}
	
	public function get_excel_btn($table_name){
		
		$table_name = ucfirst(strtolower($table_name));
		
		return '<a href="'.U($table_name.'/'.$table_name.'_excel').'">Excel</a>&nbsp;';
	}
	
	
	private function CM($table=''){
			
		return M($table);
	}
}
















?>
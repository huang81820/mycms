<?php
// 本类由系统自动生成，仅供测试用途
class CommonAction extends MythinkAction {
	
	public function _initialize(){
		
		
		if($_SESSION['islogin']!=1){
			
			$this->alert_jump('您还没登陆，请先登陆',U('Escape/login'));
		}
	}
    
	public function __construct(){
		
		parent::__construct();
	}
	
	
	public function excel_in_example(){
		
		$table_name = strtolower($_REQUEST['table_name']);
		
		$tableInfo = $this->CM('cm_table')->where('table_name="'.$table_name.'"')->find();
		
		$condition['table_id'] = $tableInfo['table_id'];
		$condition['is_excel_out'] =1;
		
		$tableExcelColumnInfo = $this->CM('cm_table_column')->where($condition)->order('excel_out_sort ASC')->select();
		
		
		vendor('Form.Excel.PHPExcel');
		$objExcel  = new PHPExcel();
		$objWriter = new PHPExcel_Writer_Excel2007($objExcel); 
		$objProps = $objExcel->getProperties ();
		$objExcel->setActiveSheetIndex( 0 );
		$objActSheet = $objExcel->getActiveSheet ();
		
		$index = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		foreach($tableExcelColumnInfo as $key=>$value){
			
			$objActSheet->setCellValue ( $index[$key].'1', $value['column_desc']);
		}
		
		$fileName = 'myExcel'.time(). '.xlsx';
		
		$outputFileName = iconv ( 'UTF-8', 'gb2312', $fileName );

		//直接导出文件

		$objWriter->save ( $outputFileName );
		
		
		vendor('Form.File');
		
		$file=File::getInstance();
		
		//$file::downloads($fileName);
		
		exit;
	}
	
	public function do_excel_in()
	{
		$table_name = strtolower($_REQUEST['table_name']);
		
		vendor('Form.Excel.PHPExcel');
		
		if(isset($_FILES['cm_excel_file_up']['name']) && $_FILES['cm_excel_file_up']['name']!='')
		{
			$excel = $this->FILE_UPLOAD('files');
			
		}else{
			$this->alert_back('请选择文件');
		}
		
		
		$excel = '.'.$excel['url'];
		
		
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($excel);
		$objWorksheet = $objPHPExcel->getActiveSheet(0);
		$highestRow = $objWorksheet->getHighestRow();
		$highestColumn = $objWorksheet->getHighestColumn();
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
		
		$excelData = array();
		for ($row = 1;$row <= $highestRow;$row++){
			for ($col = 0;$col < $highestColumnIndex;$col++){
				$excelData[$row][] =(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
			}
		}
		
		
		
		
		//忽略Excel的第一行，默认为表头信息
		unset($excelData[1]);
		
		
		
		//去掉所有记录两边的空格
		foreach($excelData as $key=>$row){
			$one_row = array();
			foreach($row as $key2=>$cell){
				$one_row[]=trim($cell);
			}
			
			$excelData[$key] = $one_row;
		}
		
		
		
		$tableInfo = $this->CM('cm_table')->where('table_name="'.$table_name.'"')->find();
		
		$condition['table_id'] = $tableInfo['table_id'];
		$condition['is_excel_in'] =1;
		
		$tableExcelColumnInfo = $this->CM('cm_table_column')->where($condition)->order('excel_in_sort ASC')->select();
		
		$successRows     = array();
		$errorEmptyRows  = array();
		$errorRepeatRows = array();
		$errorInsertRows = array();
		$errorDataMapRows= array();
		
		//当字段导入不能为空的时候，排除该记录
		foreach($excelData as $dataKey=>$dataRow){
			
			$flag = false;
			$matchCondition = 1;
			
			foreach($tableExcelColumnInfo as $excelInKey=>$excelColRow){
				
				
				if( ($excelColRow['is_excel_empty_in']==0) && empty($dataRow[$excelInKey]) ){
							
					$errorEmptyRows[]= $excelData[$dataKey];
					unset($excelData[$dataKey]);
				}
				
				
				if($excelColRow['is_excel_match']==1){
					
					$flag = true;
					if($excelColRow['excel_match_logic']=='AND'){
						
						if($excelColRow['excel_match_method']=='like'){
						
							
							$matchCondition.=' AND '.$excelColRow['column_name'].' LIKE "%'.$dataRow[$excelInKey].'%"';
						}else{
							
							$matchCondition.=' AND '.$excelColRow['column_name'].'="'.$dataRow[$excelInKey].'"';
						}
					}
					
					if($excelColRow['excel_match_logic']=='OR'){
						if($excelColRow['excel_match_method']=='like'){
						
							$matchCondition.=' OR '.$excelColRow['column_name'].' LIKE "%'.$dataRow[$excelInKey].'%"';
						}else{
							
							$matchCondition.=' OR '.$excelColRow['column_name'].'="'.$dataRow[$excelInKey].'"';
						}
					}
					
					
					
				}
			}
			
			
			if($flag){
				
				if($this->CM($table_name)->where($matchCondition)->count()>0){
					
					$errorRepeatRows[]= $excelData[$dataKey];
					unset($excelData[$dataKey]);
				}
			}
		}
		
		
		//组装数据入库
		$inData = array(); 
		foreach($excelData as $dataKey=>$dataRow){
			
			$dataFlag	=	true;
			$oneRow 	= 	array();
			
			foreach($tableExcelColumnInfo as $excelInKey=>$excelColRow){
				
				
				
				$excelColRowMap = unserialize($excelColRow['excel_in_map']);
				
				if($excelColRowMap['map_type']=='origin'){
					
					$oneRow[$excelColRow['column_name']] = $dataRow[$excelInKey];
					
				}
				
				if($excelColRowMap['map_type']=='list'){
					
					$list_id = $excelColRowMap['map_list_id'];
					
					$where = array();
					$where['list_id']  =  $list_id;
					$where['item_desc']=  $dataRow[$excelInKey];
					
					$res = $this->CM('cm_list_item')->where($where)->find();
					if(count($res)<1){
						
						$errorDataMapRows[] = $dataRow;
						$dataFlag = false;
						
					}else{
						
						$oneRow[$excelColRow['column_name']] = $res['list_item_id'];
					}
					
				}
				
				if($excelColRowMap['map_type']=='items'){
					
					$itemsFlag = false;
					$map_listsArr = $excelColRowMap['map_lists'];
					
					foreach($map_listsArr as $map_listsRow){
						
						if($map_listsRow['desc']==$dataRow[$excelInKey]){
							
							$itemsFlag = true;
							$oneRow[$excelColRow['column_name']] = $map_listsRow['key'];
						}
					}
					
					if(!$itemsFlag){
						
						$errorDataMapRows[] = $dataRow;
						$dataFlag = false;
					}
				}
				
				if($excelColRowMap['map_type']=='select'){
					
					$flagSelect = false;
					$attrArr = unserialize($excelColRow['column_attrs']);
					$result = array();
					//0为数据库类型
					if($attrArr['type']==0){
						
						$result = $this->CM()->query($attrArr['data_sql']);
						
						foreach($result as $singleRow){
							
							if($singleRow[$attrArr['value_desc']]==$dataRow[$excelInKey]){
								
								$oneRow[$excelColRow['column_name']] = $singleRow[$attrArr['value_key']];
								$flagSelect = true;
							}
						}
					}
					//1为静态数据类型
					if($attrArr['type']==1){
						
						$result = $attrArr['lists'];
						foreach($result as $singleRow){
							if($singleRow['desc']==$dataRow[$excelInKey]){
								$oneRow[$excelColRow['column_name']] = $singleRow['value'];
								$flagSelect = true;
							}
						}
					}
					//2为list类型
					if($attrArr['type']==2){
						
						$list_id = $attrArr['list_id'];
						
						$result = $this->CM('cm_list_item')->where('list_id='.$list_id)->select();
						foreach($result as $singleRow){
							
							if($singleRow['item_desc']==$dataRow[$excelInKey]){
								
								$oneRow[$excelColRow['column_name']] = $singleRow['list_item_id'];
								$flagSelect = true;
							}
						}
					}
					
					if(!$flagSelect){
						
						$errorDataMapRows[] = $dataRow;
						$dataFlag = false;
					}
					
				}
				
				
			}
			
			if($dataFlag){
				
				$inData[]	=	$oneRow;
			}
			
			
		}
		
		
		
		//数据入库
		foreach($inData as $Data){
			
			$last_id = $this->CM($table_name)->add($Data);
			if(!$last_id){
				
				$errorInsertRows[] = $Data;
			}else{
				
				$Data['excel_last_id'] = $last_id;
				$successRows[] = $Data;
			}
			
			
		}
		
		$reportData['table_name'] 		= 	$table_name;
		$reportData['last_time'] 		= 	time();
		$reportData['successRows'] 		= 	$successRows;
		$reportData['errorEmptyRows'] 	= 	$errorEmptyRows;
		$reportData['errorRepeatRows'] 	= 	$errorRepeatRows;
		$reportData['errorInsertRows'] 	= 	$errorInsertRows;
		$reportData['errorDataMapRows'] = 	$errorDataMapRows;
		
		file_put_contents('./Public/reportData/'.ucfirst($table_name).'.txt',serialize($reportData));
		
		
		$this->redirect(ucfirst($table_name).'/'.ucfirst($table_name).'_excel');
	}
	
	
	public function del_last_excel(){
		
		$table_name = strtolower(I('table_name'));
		
		$last_excel_data = file_get_contents('./Public/reportData/'.ucfirst($table_name).'.txt');
		
		$last_excelArr = unserialize($last_excel_data);
		
		if(count($last_excelArr['successRows'])<1){
		
			return;
		}
		foreach($last_excelArr['successRows'] as $value){
			
			$this->CM($table_name)->delete(intval($value['excel_last_id']));
		}
		
		$reportData['table_name'] 		= 	$table_name;
		$reportData['last_time'] 		= 	time();
		$reportData['successRows'] 		= 	array();
		$reportData['errorEmptyRows'] 	= 	array();
		$reportData['errorRepeatRows'] 	= 	array();
		$reportData['errorInsertRows'] 	= 	array();
		$reportData['errorDataMapRows'] = 	array();
		file_put_contents('./Public/reportData/'.ucfirst($table_name).'.txt',serialize($reportData));
		
		$this->alert_jump('回删成功',U(ucfirst($table_name).'/'.ucfirst($table_name).'_excel'));
	}
	
	
	
	public function excel_out(){
		
		$table_name = strtolower($_REQUEST['table_name']);
		
		$tableInfo = $this->CM('cm_table')->where('table_name="'.$table_name.'"')->find();
		
		$condition['table_id'] = $tableInfo['table_id'];
		$condition['is_excel_out'] =1;
		
		$tableExcelColumnInfo = $this->CM('cm_table_column')->where($condition)->order('excel_out_sort ASC')->select();
		
		
		vendor('Form.Excel.PHPExcel');
		$objExcel  = new PHPExcel();
		$objWriter = new PHPExcel_Writer_Excel2007($objExcel); 
		$objProps = $objExcel->getProperties ();
		$objExcel->setActiveSheetIndex( 0 );
		$objActSheet = $objExcel->getActiveSheet ();
		
		$index = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		foreach($tableExcelColumnInfo as $key=>$value){
			
			$objActSheet->setCellValue ( $index[$key].'1', $value['column_desc']);
		}
		
		$allRecord = $this->CM($table_name)->select();
		
		
		
		foreach($allRecord as $recordKey=>$Row){
			
			foreach($Row as $cellKey=>$cell){
				
				foreach($tableExcelColumnInfo as $key2=>$columnInfo){	
				
					if($columnInfo['column_name']==$cellKey){			
						//echo $index[$key2].($recordKey+2).'---'.$cell.'<br>';
						$value = '';
						
						$excel_outArr = unserialize($columnInfo['excel_out_map']);
						
						if($excel_outArr['map_type']=='origin'){ 
							
							$value = $cell;
						}
						
						if($excel_outArr['map_type']=='list'){ 
							
							$list_id = $excel_outArr['map_list_id'];
							
							$res = $this->CM('cm_list_item')->where('list_id='.$list_id)->select();
							
							foreach($res as $val){
								
								if($val['list_item_id']==$cell){
									
									$value = $val['item_desc'];
								}
							}
						}
						
						if($excel_outArr['map_type']=='items'){ 
							
							$items = $excel_outArr['map_lists'];
							
							foreach($items as $val){
								
								if($val['key']==$cell){
									
									$value = $val['desc'];
								}
							}
						}
						
						if($excel_outArr['map_type']=='select'){
							
							
							$attrArr = unserialize($columnInfo['column_attrs']);
							$result = array();
							//0为数据库类型
							if($attrArr['type']==0){
								
								$result = $this->CM()->query($attrArr['data_sql']);
								
								foreach($result as $singleRow){
									
									if($singleRow[$attrArr['value_key']]==$cell){
									
										$value = $singleRow[$attrArr['value_desc']];
										
									}
								}
							}
							//1为静态数据类型
							if($attrArr['type']==1){
								
								$result = $attrArr['lists'];
								foreach($result as $singleRow){
									if($singleRow['value']==$cell){
									
										$value = $singleRow['desc'];
									}
								}
							}
							//2为list类型
							if($attrArr['type']==2){
								
								$list_id = $attrArr['list_id'];
								
								$result = $this->CM('cm_list_item')->where('list_id='.$list_id)->select();
								foreach($result as $singleRow){
									
									if($singleRow['list_item_id']==$cell){
										
										$value = $singleRow['item_desc'];
									}
								}
							}
							
							
						}
						
						
						$objActSheet->setCellValue ($index[$key2].($recordKey+2),$value);
					}
				}
				
			}
		}
		
		//exit;
		//导出的文件名
		$fileName = 'myExcel'.time(). '.xlsx';
		
		$outputFileName = iconv ( 'UTF-8', 'gb2312', $fileName );

		//直接导出文件

		$objWriter->save ( $outputFileName );
		
		
		vendor('Form.File');
		
		$file=File::getInstance();
		
		//$file::downloads($fileName);
	}
	
	
	
	
	
	
	
	
	
	
}
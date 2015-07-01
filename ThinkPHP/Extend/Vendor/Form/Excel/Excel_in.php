<?php
	
	include('PHPExcel.php');
	$objReader = PHPExcel_IOFactory::createReader('Excel5');
    $objReader->setReadDataOnly(true);
    $objPHPExcel = $objReader->load('./myExcel.xlsx');
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
	
	print_r($excelData);
	
	
	exit;
	
	
	
	
	
	
  
   
 ?>
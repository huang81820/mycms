<?php 
include('PHPExcel.php');  

$string=file_get_contents('./mycon.txt');
$result=unserialize($string);     //要导入的数据数组

echo '<pre>';
print_r($result);
echo '</pre>';

////require_once'PHPExcel/Writer/Excel5.php';     // 用于其他低版本xls  

// or  

////require_once'PHPExcel/Writer/Excel2007.php'; // 用于excel-2007 格式  

// 创建一个处理对象实例  

$objExcel = new PHPExcel();  

// 创建文件格式写入对象实例, uncomment  

//$objWriter = new PHPExcel_Writer_Excel5($objExcel);     // 用于其他版本格式  

// or  

$objWriter = newPHPExcel_Writer_Excel2007($objExcel); // 用于2007 格式  

$objProps = $objExcel->getProperties ();

//设置创建者

$objProps->setCreator ( 'XuLulu');

//设置最后修改者

$objProps->setLastModifiedBy("XuLulu");

//描述

$objProps->setDescription("摩比班级");

//设置标题

$objProps->setTitle ( '管理器' );

//设置题目

$objProps->setSubject("OfficeXLS Test Document, Demo");

//设置关键字

$objProps->setKeywords ( '管理器' );

//设置分类

$objProps->setCategory ( "Test");

//工作表设置

$objExcel->setActiveSheetIndex( 0 );

$objActSheet = $objExcel->getActiveSheet ();

//单元格赋值   例：

$objActSheet->setCellValue ( 'A1', 'prod_id');

$objActSheet->setCellValue ( 'B1', 'prod_name');

$objActSheet->setCellValue ( 'C1', 'cat_id');

$objActSheet->setCellValue ( 'D1', 'prod_img');

$objActSheet->setCellValue ( 'E1', 'effe_drawing');

$objActSheet->setCellValue ( 'F1', 'cat_name');



foreach($result as $key=>$val){
	$objActSheet->setCellValue('A'.($key+2), $val['prod_id']);
	$objActSheet->setCellValue('B'.($key+2), $val['prod_name']);
	$objActSheet->setCellValue('C'.($key+2), $val['cat_id']);
	$objActSheet->setCellValue('D'.($key+2), $val['prod_img']);
	$objActSheet->setCellValue('E'.($key+2), $val['effe_drawing']);
	$objActSheet->setCellValue('F'.($key+2), $val['cat_name']);
}

//$objActSheet->setCellValue('A2', 2);  // 字符串内容  

//$objActSheet->setCellValue('A2', 26);            // 数值  

//$objActSheet->setCellValue('B2', '我');          // 布尔值  

//$objActSheet->setCellValue('C2', 100); // 公式

/*

$objDrawing = new PHPExcel_Worksheet_Drawing();  

$objDrawing->setName('ZealImg');  

$objDrawing->setDescription('Image inserted byZeal');  

$objDrawing->setPath('./img.png');  

$objDrawing->setHeight(100);

$objDrawing->setWidth(100);  

$objDrawing->setCoordinates('D2'); 


$objDrawing->setOffsetX(10);  

$objDrawing->setRotation(15);  

$objDrawing->getShadow()->setVisible(true);  

$objDrawing->getShadow()->setDirection(36);  

$objDrawing->setWorksheet($objActSheet);  

$objExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */

//自动设置单元格宽度   例：

//$objActSheet->getColumnDimension('A')->setAutoSize(true);
//$objActSheet->getColumnDimension('D')->setAutoSize(true);

//手动设置单元格的宽度   例：

//$objActSheet->getColumnDimension('D')->setWidth(20);
//$objActSheet->getRowDimension(2)->setRowHeight(80); 

//导出的文件名

$outputFileName = iconv ( 'UTF-8', 'gb2312', 'myExcel'.time(). '.xlsx' );

//直接导出文件

$objWriter->save ( $outputFileName );

?>
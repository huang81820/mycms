<?php


public function dao_ru()
	{
		vendor('ExcelDemo.PHPExcel');
		
		if(isset($_FILES['user_excel']['name'])&&$_FILES['user_excel']['name']!='')
		{
			$excel = $this->upload2();
		}else{
			$this->alert_back('请选择文件');
		}
		
		
		$excel = './'.$excel;
		//AAA($excel);
		
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
		//$this->PRE($excelData);
		
		/*		
			[0] => 姓名
            [1] => 手机号码
            [2] => 性别
            [3] => 出生年月
            [4] => 职务
            [5] => 学历
            [6] => 身份证号码
            [7] => 电子邮件
            [8] => 传真
            [9] => 通讯地址
            [10] => 指定联系人
            [11] => 单位名称
            [12] => 邮编
            [13] => 经营范围
            [14] => 年营业额
            [15] => 公司资产
            [16] => 企业性质				
		*/
		
		unset($excelData[1]);
		
		
		foreach($excelData as $key=>$user){
			$one_user = array();
			foreach($user as $key2=>$val2){
				$one_user[]=trim($val2);
			}
			
			$excelData[$key] = $one_user;
		}
		//$this->PRE($excelData);
		foreach($excelData as $key=>$user){
			$condition=array();
			$condition['real_name'] = trim($user[0]);
			$condition['user_phone'] = trim($user[1]);
			
			$is_has  = $this->GET_COUNT('user',$condition);
			
			
				
			
			
			
			if($is_has<=0){	
				if( (!empty($user[0]) ) && (!empty($user[1]) ) ){
					$data['real_name'] 		 = $user[0];
					$data['user_phone']  	 = $user[1];
					$data['user_sex']        = $user[2]=='男'? 1 : 2;
					$data['birth_day'] = $user[3];
					$data['now_zhiwu'] = $user[4];
					$data['xue_li']   = $user[5];
					$data['indetify'] = $user[6];
					
					
					
					$data['email'] = $user[7];
					$data['chuan_zhen'] = $user[8];			
					$data['tongxun_dizhi'] = $user[9];
					$data['point_user'] = $user[10];
				
					
					$data['com_name'] = $user[11];
					$data['you_bian'] = $user[12];
					$data['jingyin_fanwei'] = $user[13];
					$data['yingye_e'] = $user[14];
					$data['zi_chan'] = $user[15];
					$data['gongsi_xingzhi'] = $user[16];
					
					
					$data['regist_time']  = time();
					$data['is_check']  =1;
					
					M('user')->add($data);
				}
			}
			
			
		}
		
		
		
		$this->success('导入成功',U('User/user_list'));
		
		
		
	}


?>
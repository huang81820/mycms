<?php

	/*  Demo:
	 *
	 *	require_once('fileManager.class.php');
	 *	
	 *	$dir='./file';   
	 *	
	 *	$file=File::getInstance();
	 *
	 *	$file::fileList($dir);
	 * 
	 */


	class File{
		
		public static $instance	= null;
	
		/**
		 *	�õ�����ʵ��
		 *
		 *	@return Ambiguous
		 */
		public static function getInstance(){
			if(is_null(self::$instance)){
				self::$instance = new File();
			}
			return self::$instance;
		}
		
		
		
		/**
		 *	˽�л����캯��
		 */
		 
		private function __construct(){
			
		}
		
		
		
		/**
		 *	���Ի�ȡ���д��̷���
		 *
		 *	@return Array
		 */
		
		public static function getDisks(){
			$disks=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T');
			$arr='';
			foreach($disks as $val){
				$dir=$val.':';
				if(@opendir($dir)!=''){
					$arr[]=$val;
				}
			}
			return $arr;
		}
		
		
		
		/**
		 *	��ȡĿ¼���ļ�Ŀ¼��
		 
		 *	@param string $mydir   ��Ҫ������Ŀ¼
		 
		 *	@return Array      �ļ��б�����
		 */
		
		public static function fileList($mydir){
			$res=array();
			$dir=opendir($mydir);
			while($fileName=readdir($dir)){
				$file=$mydir.'/'.$fileName;
				if($fileName!='.'&& $fileName!='..'){
					if(is_dir($file)){
						$res[$fileName]=self::fileList($file);
					}else{
						$res[]=$fileName;
					}
				}
			}
			return $res; 					//echo json_encode(self::mygbk2utf8($result,'Excutefun'));
		}
		
		
		/**
		 *	����Ŀ¼��С
		 
		 *	@param string $mydir   ��Ҫ�����Ŀ¼
		 
		 *	@return int      Ŀ¼�Ĵ�С/�ֽ�
		 */
		
		
		public static function dirSize($dir){
		
			$dir2=opendir($dir);
			
			$dirsize=0;
			while($fileName=readdir($dir2)){
			
				$file=$dir.'/'.$fileName;
				
				if($fileName!='.' && $fileName!='..'){
				
					if(is_dir($file)){
					
						$dirsize+=self::dirSize($file);
					}else{
						$dirsize+=filesize($file);
					}
				}
			}
			return $dirsize;
		}
		
		
		
		
		/**
		 *	�����ļ�
		 *
		 *	@param string $mydir   ��Ҫ���ص��ļ�
		 *	
		 */
		
		
		public static function downloads($dir){
			//$dir=iconv('utf-8','gbk',$_POST['dir']);
			$dirArr=explode('/',$dir);
			$fileName=iconv('gbk','utf-8',$dirArr[count($dirArr)-1]);
			 
			if (!file_exists($dir)){
				header("Content-type: text/html; charset=utf-8");
				echo "File not found!";
				exit; 
			} else {
				$file = fopen($dir,"r"); 
				Header("Content-type: application/octet-stream");
				Header("Accept-Ranges: bytes");
				Header("Accept-Length: ".filesize($dir));
				Header("Content-Disposition: attachment; filename=".$fileName);
				echo fread($file, filesize($dir));
				fclose($file);
			}
		
		}
		
		
		
		/**
		 *	ɾ���ļ���Ŀ¼
		 *
		 *	@param string $dir   ��Ҫ���ļ���Ŀ¼
		 *
		 */
		
		public static function delFile($dir){
		
			//$dir=iconv('utf-8','gbk',$_POST['dir']);
			if(file_exists($dir)){
				if(!is_dir($dir)){
					if(unlink($dir)){
						return true;
					}else{
						return false;
					}
				}else{
					set_time_limit(0);
					self::deldir($dir);
					return true;
				}
			}else{
				return false;
			}
		}
		
		
		
		
		/**
		 *	ɾ��Ŀ¼
		 *
		 *	@param string $mydir   ��Ҫɾ����Ŀ¼
		 *
		 *	
		 */
		
		public static function deldir($dir){
			if(file_exists($dir)){
				$dirS=opendir($dir);
				while($fileName=readdir($dirS)){
					if($fileName!='.'&&$fileName!='..'){
						$file=$dir.'/'.$fileName;
						if(is_dir($file)){
							self::deldir($file);
						}else{
							unlink($file);
						}
					}
				}
				closedir($dirS);
				rmdir($dir);
			}
		}
		
		
		
		/**
		 *	����Ŀ¼
		 *
		 *	@param string $dirsrc   ��Ҫ���Ƶ�Ŀ¼
		 *
		 *	@param string $dirtarget   ���Ƶ�Ŀ��Ŀ¼
		 */
		
		
		public static function copydir($dirsrc,$dirtarget){
			if(!is_dir($dirsrc)){
				echo '�ļ�����Ŀ¼�����ܸ���';
				return;
			}
			if(!file_exists($dirtarget)){
				mkdir($dirtarget);
			}
			
			$dir=opendir($dirsrc);
			while($fileName=readdir($dir)){
				if($fileName!='.'&&$fileName!='..'){
					$fileS=$dirsrc.'/'.$fileName;
					$fileT=$dirtarget.'/'.$fileName;
					if(is_dir($fileS)){
						self::copydir($fileS,$fileT);
					}else{
						copy($fileS,$fileT);
					}
				}
			}
			closedir($dir);
					
		}
		
		
		
		
		/**
		 *	ѹ��Ŀ¼
		 *
		 *	@param string $dir   ��Ҫѹ����Ŀ¼
		 *
		 *	
		 */
		
		public static function fileToZip($dir){
			//$dir=iconv('utf-8','gbk',$_POST['dir']);
			$path=$dir;     //Ҫѹ�����ļ�
			
			$filearr=explode('/',$dir);
			$filearr2=explode('.',$filearr[count($filearr)-1]);
			$filearr[count($filearr)-1]=$filearr2[0];
			$last_name=implode('/',$filearr);			
			$filename =$last_name.'.zip'; 				//�������ɵ��ļ�������·����
				
			
			if(file_exists($filename)){
				return false;
			}
			
			set_time_limit(0);
			$zip1 = new ZipArchive();   						//ʹ�ñ��࣬linux�迪��zlib��windows��ȡ��php_zip.dllǰ��ע��   
			if ($zip1->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {   
				exit('�޷����ļ��������ļ�����ʧ��');
			}
			
			if(is_file($dir)){
				$this->fileZip($path,$zip1,$path);
			}else{
				self::dirZip($path,$zip1,$path);
			}
			$zip1->close();								//�ر�
			
			return true;
		}
		
		
		
		
		
		/**
		 *	��ѹ��һ��Ŀ¼
		 *
		 *	@param string $dir   ��Ҫ��ѹ��Ŀ¼
		 *
		 *	
		 */
		
		public static function zipToFile($dir){
		
			//$dir=iconv('utf-8','gbk',$_POST['dir']);
			$filearr=explode('/',$dir);
			$filenameArr=explode('.',$filearr[count($filearr)-1]);
			$filename=$filenameArr[0];
			$filearr[count($filearr)-1]=$filename;
			$destination=implode('/',$filearr);

			set_time_limit(0);
			self::unzip_file($dir,$destination);
		}
		
		
		private static function unzip_file($file,$destination){
		
			$zip = new ZipArchive() ; 
			
			if ($zip->open($file) !== TRUE) { 
				echo 'Could not open archive'; exit;
			} 
				
			$zip->extractTo($destination);   //Ŀ��
			
			$zip->close(); 
			
			return true;
		}
		
		
		
		
		
		private function fileZip($dir,$zip1,$sourcepath){
		
			$zip1->addFile($dir,basename($dir));
		}
		
		
		
		
		
		private function dirZip($dir,$zip1,$sourcepath){
			if(file_exists($dir)){
				$dirs=opendir($dir);
				while($filename2=readdir($dirs)){
					$file=$dir.'/'.$filename2;
					if($filename2!='.'&&$filename2!='..'){
						if(is_dir($file)){
							self::dirZip($file,$zip1,$sourcepath);
						}else{
							$filename=str_replace($sourcepath,'',$file);
							$zip1->addFile($file,$filename);
						}
					}
				}
			}
		
		}
		
		
		
		/**
		 *	����һ���ļ���Ŀ¼�Ĵ�С
		 *
		 *	@param string $dir   ��Ҫ�����С��Ŀ¼���ļ�
		 *
		 *	
		 */
		
		public static function getSize($dir){
			
			//$dir=iconv('utf-8','gbk',$_POST['dir']);
			if(is_dir($dir)){
				return self::toSize(self::dirSize($dir));
				
			}else{
				return self::toSize(filesize($dir));
				
			}
			
		}
		
		
		
		/**
		 *	���ļ��Ĵ�Сת��Ϊ��Ӧ�ĵ�λֵ
		 *
		 *	@param string $size   ��Ҫת������ֵ
		 *
		 *	
		 */
		
		
		public static function toSize($size){
		
			$dw='Bytes';
			if($size>pow(2,30)){
				$size=round($size/pow(2,30),2);
				$dw='GB';
			}else if($size>pow(2,20)){
				$size=round($size/pow(2,20),2);
				$dw='MB';
			}else if($size>pow(2,10)){
				$size=round($size/pow(2,10),2);
				$dw='KB';
			}else{
				$dw='KB';
			}
			return $size.$dw;
		}
		
		
		
		/**
		 *	�������е����еļ�����ִֵ��ĳ��ָ���ĺ���
		 *
		 *	@param array $array   ��Ҫ�����������
		 *
		 *	@param function $function   ��Ҫִ�еĺ���
		 *
		 *	@param boolean $apply_to_keys_also   �Ƿ������еļ�Ҳִ�иú���
		 *
		 *	@return array   ���ش���������
		 */
		
		
		private function mygbk2utf8($array,$function,$apply_to_keys_also = true){
			foreach($array as $key=>$value){
				if(is_array($value)){
					$array[$key]=self::mygbk2utf8($value,$function);
				}else{
					$array[$key]=self::$function($value);
				}
				
				if ($apply_to_keys_also && is_string($key)) {
					$new_key =self::$function($key);
					if ($new_key != $key) {
						$array[$new_key] = $array[$key];
						unset($array[$key]);
					}
				}
			}
			return $array;
		}

		private function Excutefun($data){
			
			return iconv('gbk','utf-8',$data);
		}
		
		
		
		
		
		/**
		 *	���ƻ����һ��Ŀ¼���ļ�
		 *
		 *	@param string $dirsrc         ��Ҫ���Ƶ�Ŀ¼���ļ�
		 *	
		 *	@param string $dirtarget      ��Ҫ���Ƶ�Ŀ��·��
		 *
		 *	@param string $file           ��Ҫ���Ƶ�����  file  �� dir
		 *
		 *	@param string $extend_type    ���Ƶ����ͣ�Ĭ��Ϊ���ƣ�copy   ���У�chief
		 */
		
		public function copyFile($dirsrc,$dirtarget,$type='file',$extend_type='copy'){
			
			$arr=explode('/',$dirsrc);
			
			$dirtarget=$dirtarget.'/'.$arr[count($arr)-1];
			
			if($type=='file'){
				if(!file_exists($dirtarget)){
					if(copy($dirsrc,$dirtarget)){
						if($extend_type=='chief'){
							unlink($dirsrc);
						}
						return 1;
					}else{
						return 0;
					}
					exit;
				}else{
					return 2;exit;
				}
			}else{
				if(file_exists($dirtarget)){
					echo 2;exit;
				}else{
					set_time_limit(0);
					$this->copydir($dirsrc,$dirtarget);
					if($extend_type=='chief'){
						$this->deldir($dirsrc);
					}
					echo 1;exit;
				}
			}
			echo 0;exit;
		}
		
		
		
		/**
		 *	������һ���ļ�
		 *
		 *	@param string $new_name   �µ��ļ����ƣ�������·����
		 *
		 *	@param string $dir        ��Ҫ���������ļ�������·����
		 */
		 
		public function reName($new_name,$dir){
			
			$arr=explode('/',$dir);
			$arr[count($arr)-1]=$new_name;
			$new_dir=implode('/',$arr);
			
			
			if(rename($dir,$new_dir)){
				return 1;exit;
			}else{
				return 0;exit;
			}
			
			return 2;exit;
		}
		
		
		
		
		
		
		
		
		
	
	}

 ?>
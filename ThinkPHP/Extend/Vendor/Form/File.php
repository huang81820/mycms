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
		 *	得到本类实例
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
		 *	私有化构造函数
		 */
		 
		private function __construct(){
			
		}
		
		
		
		/**
		 *	尝试获取所有磁盘分区
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
		 *	获取目录的文件目录树
		 
		 *	@param string $mydir   需要遍历的目录
		 
		 *	@return Array      文件列表数组
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
		 *	计算目录大小
		 
		 *	@param string $mydir   需要计算的目录
		 
		 *	@return int      目录的大小/字节
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
		 *	下载文件
		 *
		 *	@param string $mydir   需要下载的文件
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
		 *	删除文件或目录
		 *
		 *	@param string $dir   需要的文件或目录
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
		 *	删除目录
		 *
		 *	@param string $mydir   需要删除的目录
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
		 *	复制目录
		 *
		 *	@param string $dirsrc   需要复制的目录
		 *
		 *	@param string $dirtarget   复制的目标目录
		 */
		
		
		public static function copydir($dirsrc,$dirtarget){
			if(!is_dir($dirsrc)){
				echo '文件不是目录，不能复制';
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
		 *	压缩目录
		 *
		 *	@param string $dir   需要压缩的目录
		 *
		 *	
		 */
		
		public static function fileToZip($dir){
			//$dir=iconv('utf-8','gbk',$_POST['dir']);
			$path=$dir;     //要压缩的文件
			
			$filearr=explode('/',$dir);
			$filearr2=explode('.',$filearr[count($filearr)-1]);
			$filearr[count($filearr)-1]=$filearr2[0];
			$last_name=implode('/',$filearr);			
			$filename =$last_name.'.zip'; 				//最终生成的文件名（含路径）
				
			
			if(file_exists($filename)){
				return false;
			}
			
			set_time_limit(0);
			$zip1 = new ZipArchive();   						//使用本类，linux需开启zlib，windows需取消php_zip.dll前的注释   
			if ($zip1->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {   
				exit('无法打开文件，或者文件创建失败');
			}
			
			if(is_file($dir)){
				$this->fileZip($path,$zip1,$path);
			}else{
				self::dirZip($path,$zip1,$path);
			}
			$zip1->close();								//关闭
			
			return true;
		}
		
		
		
		
		
		/**
		 *	解压缩一个目录
		 *
		 *	@param string $dir   需要解压的目录
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
				
			$zip->extractTo($destination);   //目标
			
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
		 *	计算一个文件或目录的大小
		 *
		 *	@param string $dir   需要计算大小的目录或文件
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
		 *	将文件的大小转化为相应的单位值
		 *
		 *	@param string $size   需要转化的数值
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
		 *	将数组中的所有的键或者值执行某个指定的函数
		 *
		 *	@param array $array   需要被处理的数组
		 *
		 *	@param function $function   需要执行的函数
		 *
		 *	@param boolean $apply_to_keys_also   是否讲数组中的键也执行该函数
		 *
		 *	@return array   返回处理后的数组
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
		 *	复制或剪切一个目录或文件
		 *
		 *	@param string $dirsrc         需要复制的目录或文件
		 *	
		 *	@param string $dirtarget      需要复制到目标路径
		 *
		 *	@param string $file           需要复制的类型  file  或 dir
		 *
		 *	@param string $extend_type    复制的类型，默认为复制，copy   剪切：chief
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
		 *	重命名一个文件
		 *
		 *	@param string $new_name   新的文件名称（不包含路径）
		 *
		 *	@param string $dir        需要重命名的文件（包含路径）
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
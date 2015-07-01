<?php
		require_once 'UploadFile.class.php';
		require_once '../../../../myconf.php';
		session_start();
		//echo ROOT2;
		//echo dirname('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		$str =explode("\\",ROOT2);
		$name=$str[count($str)-1];
 
		//$MYDIR='http://'.$_SERVER['HTTP_HOST'].'/'.$name.'/Public/clientDB/'.$bran_id.'/roots/';
		
		$menu_id=$_SESSION['menu_id'];
		$bran_id=$_SESSION['bran_id'];
		
		$type_up=$_SESSION['type_up'];
		
		$MYDIR='http://'.$_SERVER['HTTP_HOST'].'/Public/clientDB/'.$bran_id.'/roots/';
		//echo $type_up; exit;
		if($type_up==4){
			$cata_upload_path='../../../clientDB/'.$bran_id.'/roots/cata/';
			$cata_id=$_SESSION['cata_id'];
		}
		if($type_up==2){
			$cata_upload_path='../../../clientDB/'.$bran_id.'/roots/pic/';
		}
		if($type_up==1){
			$cata_upload_path='../../../clientDB/'.$bran_id.'/roots/pic/';
		}
		
		//echo $cata_upload_path; exit;
		
		
		$upload = new UploadFile();							// 实例化上传类
		$upload->maxSize  = 3145728 ;							// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg','pdf','doc');					// 设置附件上传类型
		$dir=$cata_upload_path;
		$upload->savePath = $dir;										// 设置附件上传目录
		if(!$upload->upload()) {										// 上传错误提示错误信息
			$msg=$upload->getErrorMsg();
			echo json_encode(array('error'=>0,'message'=>$msg));
		}else{															// 上传成功 获取上传文件信息
			$info = $upload->getUploadFileInfo();
			
			$db_path2='../../../clientDB/'.$bran_id.'/branddb.sqlite';   //将图片信息插入数据库的画册详细信息
			$cl_name=$info[0]['name'];
			if($type_up==4){
				$cl_path=$info[0]['savename'];
				$sql="INSERT INTO catalog_list (`cl_name`,`cl_path`,`cata_id`) VALUES ('".$cl_name."','".$cl_path."',".$cata_id.")";
			}
			if($type_up==2){
				$cl_path=$info[0]['savename'];
				$sql="INSERT INTO pic (`pic_path`,`pic_name`,`menu_id`,`is_cont`) VALUES ('".$cl_path."','".$cl_name."',".$menu_id.",0)";
			}
			if($type_up==1){
				$cl_path=$info[0]['savename'];
				$sql="INSERT INTO pic (`pic_path`,`pic_name`,`menu_id`,`is_cont`) VALUES ('".$cl_path."','".$cl_name."',".$menu_id.",1)";
			}
			
			$conn=new SQLite3($db_path2);          //通过SQLITE3对象连接数据库
			$conn->query($sql);
			
			
			if($type_up==4){
				$url=$MYDIR.'/cata/'.$info[0]['savename'];
			}
			if($type_up==2){
				$url=$MYDIR.'/pic/'.$info[0]['savename'];
			}
			if($type_up==1){
				$url=$MYDIR.'/pic/'.$info[0]['savename'];
			}
			
			//echo $lo='http://"'.$_SERVER ['HTTP_HOST'].$_SERVER['PHP_SELF'].'../'.$info[0]['savepath'].$info[0]['savename'];  exit;
			//$url='__PUBLIC__/scripts/editor/php'.$uro; exit;
			echo json_encode(array('error'=>0,'url'=>$url));
		}
		
			
		
		
?>
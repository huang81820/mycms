<?php
// 本类由系统自动生成，仅供测试用途
class InstallAction extends Action {
    
	public function index(){
			
		$this->display();
	}
	
	public function verify(){
		import('ORG.Util.Image');
		Image::buildImageVerify(4,1,png,60,30);
	}
	
	
	public function do_install(){
		
		$verify=$this->_param('verify');
		
		if($_SESSION['verify'] != md5($verify)){
			$this->error('验证码错误！');
		}
		
		$cm_database_host=I('cm_database_host');
		$cm_database_name=I('cm_database_name');
		$cm_database_user=I('cm_database_user');
		$cm_database_pwd=I('cm_database_pwd');
		$cm_database_port=I('cm_database_port');
		
		$sql='drop database '.$cm_database_name;
		$DB_DSN='mysql://'.$cm_database_user.':'.$cm_database_pwd.'@'.$cm_database_host.':'.$cm_database_port.'/';
		
		M()->db("2",$DB_DSN)->query($sql);
		
		$sql='CREATE DATABASE '.$cm_database_name.' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci';
		
		M()->db("2",$DB_DSN)->query($sql);
		
		
		
		$sql=file_get_contents('./Admin/Conf/sql.txt');
		$sqlArr=explode('<||>',rtrim($sql,'<||>'));
		//echo '<pre>';print_r($sqlArr); echo '</pre>';exit;
		
		foreach($sqlArr as $singlesql){
			M()->db("1",$DB_DSN.$cm_database_name)->query($singlesql);
		}
		
		//echo $sql=file_get_contents('./Admin/Conf/sql.txt');
		M()->db("1",$DB_DSN.$cm_database_name)->query($sql);
		
		$config=file_get_contents('./Admin/Conf/config.php'); 		
		
		$dbname='\'DB_NAME\' => \''.$cm_database_name.'\'';
		$config = preg_replace('/\'DB_NAME\'\s+=>\s+\'.+?\'/is',$dbname,$config);
		
		$dbHost='\'DB_HOST\' => \''.$cm_database_host.'\'';
		$config = preg_replace('/\'DB_HOST\'\s+=>\s+\'.+?\'/is',$dbHost,$config);
		
		$dbUser='\'DB_USER\' => \''.$cm_database_user.'\'';
		$config = preg_replace('/\'DB_USER\'\s+=>\s+\'.+?\'/is',$dbUser,$config);
		
		$dbPwd='\'DB_PWD\' => \''.$cm_database_pwd.'\'';
		$config = preg_replace('/\'DB_PWD\'\s+=>\s+\'.{0,}?\'/is',$dbPwd,$config);
		
		$dbPwd='\'DB_PORT\' => '.$cm_database_port.',';
		$config = preg_replace('/\'DB_PORT\'\s+=>\s+.{0,}?\,/is',$dbPwd,$config);
		//echo $dbPwd.'--';exit;
		
		file_put_contents('./Admin/Conf/config.php',$config);
		
		echo '安装成功'; 
		
	}
	
	
	
	
}
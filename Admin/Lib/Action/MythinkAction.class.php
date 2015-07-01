<?php
// 本类由系统自动生成，仅供测试用途
class MythinkAction extends Action {
	
	
	public function PAGE_LIST($table,$where=true,$order='',$pageSize=PAGE_SIZE){
	   
		import('ORG.Util.Page');
		$m=$this->CM($table);
		$count=$m->where($where)->order($order)->count();
		$Page = new Page($count,$pageSize);
		$show = $Page->show();
		
		$listInfo=$m->where($where)->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign('page',$show);
		
		return $listInfo;
	}
	
	public function SQL_PAGE_LIST($table,$sql,$pageSize=PAGE_SIZE){
	   
		import('ORG.Util.Page');
		$m=$this->CM();
		$count=$m->query($sql)->count(); 
		$Page = new Page($count,PAGE_SIZE);
		$show = $Page->show();
		
		$listInfo=$m->query($sql)->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign('page',$show);
		
		return $listInfo;
	}
	
	public function SQL_ALL_LIST($table,$sql){
	   
		$m=$this->CM();
		$listInfo=$m->query($sql)->select();
		
		return $listInfo;
	}
	
	
	public function GET_ONE($table,$where=true){
		
		$m=$this->CM($table);
		
		return $m->where($where)->find();
		
	}
	
	public function ADD_ONE($table,$data,$ok_dir){
		
		
		$m= D($table);  
		//var_dump($data);exit;
		if( !$m->create($data) ){
			header("Content-type:text/html;charset=utf-8");
			exit($m->getError());				
		}
		
		$m->add($data) == true ? $this->alert_jump('操作成功',$ok_dir) : $this->alert_back('操作失败');
		
	}
	
	
	
	public function EDIT_ONE($table,$data,$ok_dir){
		
		
		$m = $this->CM_D($table);
		
		if( !$m->create($data) ){
			header("Content-type:text/html;charset=utf-8");
			exit($m->getError());				
		}
		$m->save($data) == true ? $this->alert_jump('操作成功',$ok_dir) : $this->alert_back('操作失败');
		
		exit;
	}
	
	
	
	public function GET_COUNT($table,$where=true){
		
		return $m=$this->CM($table)->where($where)->count();
		
	}
	
	
	
	public function ALL_LIST($table,$where=true,$order='')
	{
		$rs = $this->CM($table)->where($where)->order($order)->select();
		return $rs;
	}
	
	
	
	public function MULTI_DELETE($table,$where=array(),$ok_dir)
	{
		$m = M($table);
		$pk = $m->getPk();
		$condition[$pk] = array('in',$where);
		$rs = $m->where($condition)->delete();
		$rs == true?$this->alert_jump('操作成功',$ok_dir) :$this->alert_back('操作失败');
	}
	
	
	public function DELETE_ONE($table,$pk,$ok_dir)
	{
		$this->CM($table)->delete(intval($pk)) == true ? $this->alert_jump('删除成功',$ok_dir) :$this->alert_back('删除失败');
	
	}
	
	
	public function CHECK_KEY($keys)
	{
		if(is_array($keys)){
			foreach ($keys as $key=>$val){
			
				if( empty($_REQUEST[$val]) ){
					$this->alert_back('出错了');exit;
				}
			}
		}else{
			if(empty($_REQUEST[$keys])){
				$this->alert_back('出错了');exit;
			}
		}
		
	}
	
	
	public function EDITOR_UPLOAD($dirName='pics')
	{
		import('ORG.Net.UploadFile');		
		$upload = new UploadFile();
		$upload->maxSize  = UPLOAD_SIZE ;
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');
		$filedir = UPLOAD_PATH.'/'.$dirName.'/'.date('Y-m',time()).'/';
		
		if(!is_dir($filedir)){
			
			mkdir($filedir,0777);
		}
		$upload->savePath =  $filedir;
		if(!$upload->upload()) {
			header("Content-type:text/html;charset=utf-8");
			echo $upload->getErrorMsg();
			exit;
		}else{
			$info =  $upload->getUploadFileInfo();
		}
		$url=$info[0]['savepath'].$info[0]['savename'];
		$url = substr($url,1);
		//$url = ltrim('.',$url);
		
		header('Content-type: text/html; charset=UTF-8');
		
		echo json_encode( array('error' => 0, 'url' => $url,'savename'=>$info[0]['savename']) );
		exit;
	}
	
	public function EDITOR_FILE_UPLOAD($dirName='files')
	{
		import('ORG.Net.UploadFile');		
		$upload = new UploadFile();
		$upload->maxSize  = UPLOAD_SIZE ;
		$upload->allowExts  = array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2','swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb','swf', 'flv');
		$filedir = UPLOAD_PATH.'/'.$dirName.'/'.date('Y-m',time()).'/';
		
		if(!is_dir($filedir)){
			
			mkdir($filedir,0777);
		}
		$upload->savePath =  $filedir;
		if(!$upload->upload()) {
			header("Content-type:text/html;charset=utf-8");
			echo $upload->getErrorMsg();
			exit;
		}else{
			$info =  $upload->getUploadFileInfo();
		}
		$url=$info[0]['savepath'].$info[0]['savename'];
		$url = '/'.$url;
		
		header('Content-type: text/html; charset=UTF-8');
		
		echo json_encode( array('error' => 0, 'url' => $url,'savename'=>$info[0]['savename']) );
		exit;
	}
	
	public function UPLOAD($dirName='pics')
	{
		import('ORG.Net.UploadFile');		
		$upload = new UploadFile();
		$upload->maxSize  = UPLOAD_SIZE ;
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');
		$filedir = UPLOAD_PATH.'/'.$dirName.'/'.date('Y-m',time()).'/';
		//echo $filedir;exit;
		if(!is_dir($filedir)){
			
			mkdir($filedir,0777);
		}
		$upload->savePath =  $filedir;
		if(!$upload->upload()) {
			header("Content-type:text/html;charset=utf-8");
			echo $upload->getErrorMsg();
			exit;
		}else{
			$info =  $upload->getUploadFileInfo();
		}
		$url=$info[0]['savepath'].$info[0]['savename'];
		$url = '/'.$url;
		
		header('Content-type: text/html; charset=UTF-8');
		
		return array(
				'error' => 0, 
				'url' => $url,
				'savename'=>$info[0]['savename']
			) ;
	}
	
	
	public function FILE_UPLOAD($dirName='files')
	{
		import('ORG.Net.UploadFile');		
		$upload = new UploadFile();
		$upload->maxSize  = UPLOAD_SIZE ;
		$upload->allowExts  = array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2','swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb','swf', 'flv');
		$filedir = UPLOAD_PATH.'/'.$dirName.'/'.date('Y-m',time()).'/';
		
		if(!is_dir($filedir)){
			
			mkdir($filedir,0777);
		}
		$upload->savePath =  $filedir;
		if(!$upload->upload()) {
			header("Content-type:text/html;charset=utf-8");
			echo $upload->getErrorMsg();
			exit;
		}else{
			$info =  $upload->getUploadFileInfo();
		}
		$url=$info[0]['savepath'].$info[0]['savename'];
		
		
		header('Content-type: text/html; charset=UTF-8');
		
		return array(
			'error' => 0, 
			'url' => trim($url,'.'),
			'savename'=>$info[0]['savename']
		);
		
	}
	
	
	
	public function AAA($data){
		
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		
		exit;
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
	
	
	public function CM($table=''){
		
		return M($table);
	}
	
	
	public function CM_D($table=''){
		
		return D($table);
	}
   
}

?>
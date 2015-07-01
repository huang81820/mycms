<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends MythinkAction {
    public function index(){
		if(file_exists('./index.html')){
			echo file_get_contents('./index.html');
		}else{
			
			$this->redirect('__APP__/Content/index');
		}
		
    }
	
	public function admin(){
		
		$this->redirect('__APP__/Escape/login');
		//$this->display('main');
	}
	
	public function left(){
		$this->display();
	}
	
	public function right(){
		
		$this->redirect('Category/Category_list');
	}
	
	public function top(){
		
		$res = $this->CM('website')->order('website_id ASC')->select();
		
		if( (count($res)>0) && (empty($_SESSION['siteid'])) ) {
			
			$_SESSION['siteid'] = $res[0]['website_id'];
		}
		
		
		$this->assign('websiteInfo',$res);
		
		$this->display();
	}
	
	public function bottom(){
		
		$this->display();
	}
	
	
	
	public function chageSite(){
		
		if($_SESSION['siteid'] = $_REQUEST['siteid']){
			$res = CMS_M('website')->where('website_id='.get_site_id())->find();
			$_SESSION['tplPath'] = 'Templates/'.trim($res['weburl']);
			echo '1';exit;
		}else{
			echo '0';exit;
		}
		
	
		
	}
}
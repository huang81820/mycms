<?php 
class Friend_linksModel extends AdvModel{
	
	public $form	=	'';
	
	public function __construct(){
		
		Vendor('Form.Form2');
		
		$this->form	=	new Form('__APP__/Friend_links/Friend_links_addok','friend_links');
		
		$this->form	->	_addBaseElement('friend_links');
		
		parent::__construct();
	}
	
	public function _initialize(){		}
	
	
	
	protected $_auto = array (
		//array('co_if_show','0'),
		//array('co_add_time','time',1,'function'),
		//array('co_add_date','getDate',1,'callback'),

	);
	
	protected $_validate = array(		
		//array('co_content','require','评论内容必须填写！'),	
	);
	
	
	
	protected $_filter = array(
		//'co_content'=>array('trim','trim'),
	);
	
	
	function getDate(){
		//return strtotime(date('Y-m-d',time()));
	}
	
	
	

}






?>
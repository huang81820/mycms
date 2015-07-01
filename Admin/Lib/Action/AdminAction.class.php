<?php

class AdminAction extends CommonAction {
    
	public function showList(){
		
		Vendor('Form.TableList');
		$list	 =	  new TableList();
		
		$rs = $list	->genList('content');
//AAA($rs);
		$this->assign('list',$rs);
		
		$this->display('Model/table_list2');
	}
	
	
	public function showList2(){
		
		Vendor('Form.TableList');
		$list	 =	  new TableList();		
		
		$where = $list->get_search_data('content');
//AAA($where);
		$rs = $list->auto_gen_list('Content',$where);
		
		$this->assign('list',$rs['table_list']);
		$this->assign('search_form',$rs['search_form']);
		
		$this->display('Model/table_list2');
	}
	
	public function admin(){
		
		$this->assign('adminList',$this->PAGE_LIST('admin'));
		
		$this->display();
	}
	
	
	public function add_admin(){
		$res=M('admin_role')->select();
		
		$str='<select name="role_id" >';
		foreach($res as $val){
			$str.='<option value="'.$val['id'].'" >'.$val['name'].'</option>';
		}
		$str.='</select>';
		$this->assign('roleSelect',$str);
		$this->display();
		
	}
	
	
	public function add_admin_ok(){
		$role_id=I("role_id");
		$user_name=I("user_name");
		$password=I("password");
		$state=I("state")=='on'?1:0;
	
		$data['group_id']=$role_id;
		$data['user_name']=$user_name;
		$data['password']=md5(trim($password));
	
		if(M('admin')->add($data)){
			$data2['role_id']=$role_id;
			$data2['user_id']=mysql_insert_id();
			if(M('admin_role_user')->add($data2)){
				echo "<script>alert('添加成功')</script>";
			}else{
				echo "<script>alert('添加失败')</script>";
			}
		}else{
			echo "<script>alert('添加失败')</script>";
		}
	}
	
	public function updateAdmin_ok(){
		$role_id=I("role_id");
		$id=I('id');
		$password=I("password");
		$state=I("state")=='on'?0:1;
	
		$data['group_id']=$role_id;
		$data['state']=$state;
		$data['password']=md5(trim($password));
		//print_r($data);exit;
		if(M('admin')->where('id='.$id)->save($data)){
			$data2['role_id']=$role_id;
			M('admin_role_user')->where('user_id='.$id)->save($data2);
			$this->alert_jump('修改成功',U('Admin/editor_admin',array('id'=>$id)));
		}else{
			$this->alert_jump('修改失败',U('Admin/editor_admin',array('id'=>$id)));
		}
	}
	
	
	
	public function admin_del(){
		
		$this->DELETE_ONE('admin',I('id'),U('Admin/admin'));
	}
	
	
	public function editor_admin(){
		
		
		$id=I('id');
		
		$res=M('admin')->where('id='.$id)->find();
		$this->assign('admin_info',$res); 
		
		$res=M('admin_role')->select();
		$this->assign('role_info',$res);
		
		$this->display();
		
		
	}
	
	
	
	public function node(){
	
		$node_info=M('admin_node')->select();
		
		$this->assign('node_info',$node_info);
		
		$this->assign('nodeInfo',$this->PAGE_LIST('admin_node'));
		
		$this->display();
		
		
	}
	
	
	public function add_node(){
		
		$node_info=M('admin_node')->select();
		
		$this->assign('node_info',$node_info);
		
		$this->display();
	}
	
	public function add_node_ok(){
		//$this->alert_jump('22',U('Admin/node'));
		$name=I('name');
		$title=I('title');
		$status=I('status')=='on'?1:0;
		$level=I('level');
		$pid=I('pid');
		
		$data['name']=$name;
		$data['title']=$title;
		$data['status']=$status;
		$data['level']=$level;
		$data['pid']=$pid;
		
		//$this->AAA($data);
		
		$this->ADD_ONE('admin_node',$data,U('Admin/add_node'));
		
	}
	
	
	public function editor_node(){

		$id=I('id');
		$res=M('admin_node')->where('id='.$id)->find();
		$this->assign('node',$res); 
		
		$node_info=M('admin_node')->select();
		$this->assign('node_info',$node_info);
		
		$this->display();
		
	}
	
	
	public function editor_node_ok(){
		$id=I('id');
		$name=I('name');
		$title=I('title');
		$status=I('status')=='on'?1:0;
		$level=I('level');
		$pid=I('pid');
		
		$data['name']=$name;
		$data['title']=$title;
		$data['status']=$status;
		$data['level']=$level;
		$data['pid']=$pid;
		
		if(M('admin_node')->where('id='.$id)->save($data)){
			$this->alert_jump('修改成功',U('Admin/editor_node',array('id'=>$id)));
		}else{
			$this->alert_jump('修改成功',U('Admin/editor_node',array('id'=>$id)));
		}
	}
	
	
	public function del_node(){
		
		$this->DELETE_ONE('admin_node',I('id'),U('Admin/node'));
	}
	
	
	public function role(){
		
		$this->assign('roleList',$this->PAGE_LIST('admin_role'));
		
		$this->display();
	}
	
	
	public function add_role(){
		
		$this->display();
	}
	
	
	
	public function add_role_ok(){
		$name=I('name');
		$status=I('status')=='on'?1:0;
		
		$data['name']=$name;
		$data['status']=$status;
		
		$this->ADD_ONE('admin_role',$data,U('Admin/role'));
	}
	
	
	public function role_del(){
		
		$this->DELETE_ONE('admin_role',I('id'),U('Admin/role'));
	}
	
	
	public function editor_role(){
		//print_r($this->GET_ONE('admin_role','id='.I('id')));exit;
		$this->assign('role',$this->GET_ONE('admin_role','id='.I('id')));
		
		$this->display('editor_rode');
		
	}
	
	
	public function editor_role_ok(){
		$id=I('id');
		$name=I('name');
		$status=I('status')=='on'?1:0;
		
		$data['id']=$id;
		$data['name']=$name;
		$data['status']=$status;
		
		$this->EDIT_ONE('admin_role',$data,U('Admin/role'));
	}
	
	public function access(){
		$id=I('id');
		$m=new Model('admin_role');
		$res=$m->where('id='.$id)->find();
		$this->assign('role_info',$res);
		
		$m=new Model('admin_node');
		$res=$m->select();  			 //$this->AAA($res);
		$res2=$this->getNodeTree($res);	 //$this->AAA($res2);
		
		$m=new Model('admin_access');
		foreach($res as $key=>$val){
			if($m->where('role_id='.$id.' AND node_id='.$val['id'])->count()){
				$res[$key]['access']=1;
			}else{
				$res[$key]['access']=0;
			}
		}
		$this->assign('node_info',$res);
		$this->assign('id',$id);
		
		$this->display();
	}
	
	
	
	public function setAccess(){
		$role_id=I('role_id');
		$access=I('access');//print_r($access);exit;
		
		$m=new Model('admin_access');
		$m->where('role_id='.$role_id)->delete();
		
		$data=array();
		foreach($access as $val){
			$arr=explode('_',$val);
			$data[]=array(
				'role_id'=>$role_id,
				'node_id'=>$arr[0],
				'level'=>$arr[1]
			);
		}
		
		if($m->addAll($data)){
			$this->alert_jump('配置成功',U('Admin/access',array('id'=>$role_id)));
		}else{
			$this->alert_back('配置失败');
		}
	}
	
	
	private function getNodeTree($data,$pid=0){
		static $tree=array();
		foreach($data as $key=>$val){
			if($val['pid']==$pid){
				$tree[]=$val;
				unset($data[$key]);
				$this->getNodeTree($data,$val['id']);
			}
		}
		return $tree;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
}
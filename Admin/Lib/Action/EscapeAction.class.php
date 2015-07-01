<?php
class EscapeAction extends Action {
    public function login(){       //显示登陆页面
		
		$this->display();
    }
	
	public function verify(){
		import('ORG.Util.Image');
		Image::buildImageVerify(4,1,png,60,30);
	}

	
	public function checkLogin(){       //用户登陆检测，若成功，把登陆时间与IP插入数据库
		$verify=$this->_param('verify');
		//$_POST['verify'];
		if($_SESSION['verify'] != md5($verify)){
			$this->error('验证码错误！');
		}

		
		$admin_name=$this->_param('admin_name');
		$admin_pw=$this->_param('admin_pw');
		
		
		$m=new Model('admin');                                    //查看管理员表中有没有该用户信息 注：管理员与普通用户为2个表！！！
		$where='user_name="'.$admin_name.'" AND password="'.md5($admin_pw).'" AND state=0';
		$res=$m->where($where)->find();
		
		
		
		
		
		
		if(count($res)>0){                                         //判断是否有管理员信息
		
			$data['last_login_ip']=get_client_ip();
			$data['last_login_time']=time();
			
			$where='id='.$res['id'];
			$m->where($where)->save($data);
			session_start(); 
			$_SESSION['username']=$res['user_name'];
			$_SESSION['islogin']=1;
			
			//$_SESSION['level']=2;
			
			$this->redirect('Index/main');
		}else{
			$this->error('密码错误或账号不存在或者已经被禁用！',U('Escape/login'));
		}
	}
}

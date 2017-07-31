<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class user extends MY_Controller {
   
    public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty');
		$this->load_sp_menu();		  
	}

	public function login()
	{
		
		if(!empty($_POST))
		{
			$this->load->library('session');
			//验证码
			if(!isset($_POST['code'])||isset($_SESSION["authrand"])&&strtolower($_SESSION["authrand"])!==trim(strtolower($_POST['code'])))
			{
				  $_SESSION["auth"]='';
				  show_error('<p>验证码错误</p>  <p><a href="">返回</a> </p>', 403);
			}
			
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('username', '登录账户', 'required|min_length[4]'); 
			//callback_username_check function username_check
			$this->form_validation->set_rules('password', '登录密码', 'required|min_length[6]');
			if ($this->form_validation->run() == FALSE)
			{
				  show_error(validation_errors().'<p>  <a href="">返回</a> </p>', 403);
				  die;
			}	
			else
			{
				$username=$this->input->post('username',true);
				$password=$this->input->post('password',true);
			    //=========验证通过
				$this->load->model('Sp_User_model');
				$flag=$this->Sp_User_model->login($username,$password);
				if($flag===true)
					header("location:".site_url("sp_index/index"));  
			}	
			
		}
		
		$this->load->library('CI_Validationimg');
		$this->ci_smarty->assign('auth_img',$this->ci_validationimg->get_auth_img(70,30));

		//=========防止csrf攻击=============
		$this->security->get_csrf_token_name();
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$this->ci_smarty->assign('csrf',$csrf);
		$this->ci_smarty->display('login.htm');   
	}
	
	public function logout()
	{
	    delete_cookie("username");
		delete_cookie("user_id");
	
		header("location:".site_url("user/login"));  
	}
	
	//修改登录密码
	public function info_passwd()
	{
		$this->load->model('Sp_User_model');
		//获取登录id和用户名
		$id   = $this->user_id;
		$user = $this->user;
		$this->ci_smarty->assign('user',$user);

		//判断是否有数据提交
		if (!empty($_POST))
		{
			//表单验证,提交数据不能为空
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('old_pwd', '旧密码', 'required'); 
			$this->form_validation->set_rules('new_pwd', '新密码', 'required');
			$this->form_validation->set_rules('new_pwd1', '确认密码', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$ar_url=array(site_url('user/info_passwd') => '返回');
				usrl_back_msg('密码不能为空',$ar_url, $this->ci_smarty);
			}
			else
			{
				//检验两次修改密码是否一致
				$new_pwd  = $this->input->post('new_pwd',true);
				$new_pwd1 = $this->input->post('new_pwd1',true);

				if ($new_pwd != $new_pwd1) {
			  	    $ar_url=array(site_url('user/info_passwd') => '返回');
					usrl_back_msg('修改密码不一致',$ar_url, $this->ci_smarty);
				}
				else
				{			
					//检验原密码是否正确
					$old_pwd = $this->input->post('old_pwd',true);
					$res = $this->Sp_User_model->check_pass($id);
					if (md5($old_pwd) != $res['pass']) {
				  	    $ar_url=array(site_url('user/info_passwd') => '返回');
						usrl_back_msg('原密码不正确',$ar_url, $this->ci_smarty);
					}
					else
					{
						//修改密码
						$pwd = array();
						$pwd['pass'] = md5($new_pwd);
						$flag = $this->Sp_User_model->updata_passwd($id,$pwd);
						if($flag == 1)
						{
							$ar_url=array(site_url('user/info_passwd') => '返回');
							usrl_back_msg('操作成功',$ar_url, $this->ci_smarty);
						}
						else
						{
							$ar_url=array(site_url('user/info_passwd') => '返回');
							usrl_back_msg('操作失败',$ar_url, $this->ci_smarty);
						}	
					}
				}	
			}			
		}
		//加载页面
		$this->ci_smarty->display_ini('sp_pass.htm');
	}

	//修改操作密码
	public function info_act_pass()
	{
		$this->load->model('Sp_User_model');
		//获取登录id
		$id   = $this->user_id;

		//判断是否有数据提交
		if (!empty($_POST))
		{
			//表单验证,提交数据不能为空
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('old_pwd', '旧密码', 'required'); 
			$this->form_validation->set_rules('new_pwd', '新密码', 'required');
			$this->form_validation->set_rules('new_pwd1', '确认密码', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$ar_url=array(site_url('user/info_act_pass') => '返回');
				usrl_back_msg('密码不能为空',$ar_url, $this->ci_smarty);
			}
			else
			{
				//检验两次修改密码是否一致
				$new_pwd  = $this->input->post('new_pwd',true);
				$new_pwd1 = $this->input->post('new_pwd1',true);

				if ($new_pwd != $new_pwd1) {
			  	    $ar_url=array(site_url('user/info_act_pass') => '返回');
					usrl_back_msg('修改密码不一致',$ar_url, $this->ci_smarty);
				}
				else
				{			
					//检验原密码是否正确
					$old_pwd = $this->input->post('old_pwd',true);
					$res = $this->Sp_User_model->check_pass($id);
					if (md5($old_pwd) != $res['act_pass']) {
				  	    $ar_url=array(site_url('user/info_act_pass') => '返回');
						usrl_back_msg('原密码不正确',$ar_url, $this->ci_smarty);
					}
					else
					{
						//修改密码
						$pwd = array();
						$pwd['act_pass'] = md5($new_pwd);
						$flag = $this->Sp_User_model->updata_passwd($id,$pwd);
						if($flag == 1)
						{
							$ar_url=array(site_url('user/info_act_pass') => '返回');
							usrl_back_msg('操作成功',$ar_url, $this->ci_smarty);
						}
						else
						{
							$ar_url=array(site_url('user/info_act_pass') => '返回');
							usrl_back_msg('操作失败',$ar_url, $this->ci_smarty);
						}	
					}
				}	
			}			
		}
		//加载页面
		$this->ci_smarty->display_ini('sp_act_pass.htm');
	}
	//编辑用户资料
	public function info_edit()
	{
		if(!empty($_POST))
		{
			
			//表单验证
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('company','公司名称','required');
			$this->form_validation->set_rules('mobile','公司电话','required');
			$this->form_validation->set_rules('address','公司地址','required');
			$this->form_validation->set_rules('pic','营业执照','required');
			if ($this->form_validation->run() == FALSE)
			{
				$msg = array(
					'msg'  => validation_errors("<i class='icon-comment-alt'></i>"),
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}
			else
			{
				//model
				$this->load->model('Admin_Spuser_model');
				$id=$_POST['id'];
				$info_arr=array();
				$info_arr['company']=$this->input->post('company',true);
				$info_arr['mobile']=$this->input->post('mobile',true);
				$info_arr['address']=$this->input->post('address',true);
				$info_arr['status']=2;
				$info_arr['permit_pic']=copy_cpmpany_image(config_item('base_url').$this->input->post('pic',true),$this->user_id);

				$res=$this->Admin_Spuser_model->update_sp_user($info_arr,array('id'=>$id));
				if($res)
				{
					$msg=array(
						'msg'=>'操作成功',
						'type'=>3
					);
					echo json_encode($msg);
					die;
				}
				else
				{
					$msg=array(
						'msg'=>'操作失败',
						'type'=>1
					);
					echo json_encode($msg);
					die;
				}
			}
		}

			$sql="SELECT * FROM ".tab_m('sp_user')." WHERE id=".$this->user_id;
			$info=$this->db->query($sql)->row_array();
			$this->ci_smarty->assign('ueditor_auth',get_ueditor_auth($this->user_id,WEB_NAME),0);
			$this->ci_smarty->assign('re',$info);
			$this->ci_smarty->display_ini('info_edit.htm');


	}
}

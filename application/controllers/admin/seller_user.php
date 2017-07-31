<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Seller_user extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty'); 
		$this->load->model('Admin_Seller_User_model'); 
	}
	
	//分销用户列表
	public function seller_user_list()
	{       
        //***************************
		//         查询开始	
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		$wsql='';
		
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar=array('status');
			//姓名模糊查询字段
			$search_key_ar_more=array('user','company');
			foreach($_GET as $k=>$v)
			{
				$skey=substr($k,7,strlen($k)-7);  
				if($k!='search_page_num'&&substr($k,0,7)=='search_'&&!in_array($v,array('all','')))
				{
					//非模糊查询
					if(in_array($skey,$search_key_ar))
						$wsql.=" and {$skey}='{$v}'";
					//模糊查询
					if(in_array($skey,$search_key_ar_more))
						$wsql.=" and {$skey} like '%{$v}%'";	
				}
			}
		}
		
		$search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
		//===================查询 end=========================
		$this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		$sql="select  *  from  ".tab_m('seller_user')."  where  1=1  ".$wsql;
		if(!$this->ci_page->__get('totalRows'))
		{
			$query=$this->db->query($sql);
			$this->ci_page->totalRows =$query->num_rows;
		}
		
		$sql.=" limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
		$query=$this->db->query($sql);
		$res=array();

		$res['list']=$query->result_array();
		$res['page']=$this->ci_page->prompt();	
		$this->ci_smarty->assign('re',$res,1,'page');
		//查询结束
		//***************************
		$this->ci_smarty->display_ini('seller_user_list.htm');	
	}

	//添加或者修改分销用户
	public function seller_add()
	{      	
		
		//判断是否有数据提交
		if (!empty($_POST)) 
		{					
			//表单验证
			$this->load->library('MY_form_validation');		
			$this->form_validation->set_rules('user', '用户帐号', 'required|min_length[4]'); 
			$this->form_validation->set_rules('mobile', '手机号码', 'required|exact_length[11]');
			$this->form_validation->set_rules('company', '公司名称', 'required|min_length[6]');	

			//id存在可以不验证user_pwd,act_pwd
			if (!empty($_POST['id'])) 
			{
				if(!empty($_POST['user_pwd']))
					$this->form_validation->set_rules('user_pwd', '用户密码', 'required|min_length[6]');
				if(!empty($_POST['act_pwd']))
					$this->form_validation->set_rules('act_pwd', '操作密码', 'required|min_length[6]');
			}
			else
			{
				$this->form_validation->set_rules('user_pwd', '用户密码', 'required|min_length[6]');
				$this->form_validation->set_rules('act_pwd', '操作密码', 'required|min_length[6]');
			}	

			//表单验证，通过进行赋值，不通过提示错误并返回
			if ($this->form_validation->run() == FALSE)
			{
				$msg=array(
					'msg'=>validation_errors("<i class='icon-comment-alt'></i> "),
					'type'=>1
				);
				echo json_encode($msg);
				die;
			}
			else
			{
				//以数组类型添加或者修改数据库
				$seller_arr = array();
				$seller_arr['mobile']   = $this->input->post('mobile',true);
				$seller_arr['company']  = $this->input->post('company',true);
				
				//判断user_pwd，act_pass，status是否存在，存在就修改
				if(!empty($_POST['id']))
				{
					if (!empty($_POST['user_pwd'])) 
					{
						$seller_arr['pass']     = md5($this->input->post('user_pwd',true));
					}

					if (!empty($_POST['act_pwd'])) 
					{
						$seller_arr['act_pass'] = md5($this->input->post('act_pwd',true));
					}

					if (isset($_POST['status'])) 
					{
						$seller_arr['status']   = $this->input->post('status',true);
					}			
				}
				else
				{
					$seller_arr['user']      = $this->input->post('user',true);
					$seller_arr['pass']      = md5($this->input->post('user_pwd',true));
					$seller_arr['act_pass']  = md5($this->input->post('act_pwd',true));
					$seller_arr['addtime']   = date('y-m-d h:i:s');
					$seller_arr['status']    = 1;
				}
				
				//判断是否存在id，没有进行添加，有进行修改
				if (!empty($_POST['id'])) 
				{					
					$flag = $this->Admin_Seller_User_model->seller_user_updata($_POST['id'],$seller_arr);	
					if($flag===true)
					{
						//关闭窗口刷新页面	
						//$this->ci_smarty->assign('close_msg',1);
						$msg=array(
							'msg'=>"操作成功",
							'type'=>3
						);
						echo json_encode($msg);
				  	    die;
					}
					else
					{
						$msg=array(
							'msg'=>'添加失败',
							'type'=>1
						);
						echo json_encode($msg);
						die;
					}									
				}
				else
				{
					$flag = $this->Admin_Seller_User_model->seller_add($seller_arr);
					if($flag===true)
					{
						$msg=array(
							'msg'=>"操作成功",
							'type'=>3
						);
						echo json_encode($msg);
				  	    die;
					}
					else
					{
						$msg=array(
							'msg'=>'添加失败',
							'type'=>1
						);
						echo json_encode($msg);
						die;
					}
				}
			}		
		}

		//判断是否存在id，没有进行添加，有进行修改
		if (!empty($_GET['id'])) 
		{     		
     		$res = $this->Admin_Seller_User_model->get_seller_user($_GET['id']);
     		$this->ci_smarty->assign('se_res',$res);
		}

		//防止csrf攻击
		$this->security->get_csrf_token_name();
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$this->ci_smarty->assign('csrf',$csrf);
		//显示页面
		$this->ci_smarty->display_ini('seller_add.htm'); 
	}

	
}
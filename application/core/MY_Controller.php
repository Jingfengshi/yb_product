<?php
class MY_Controller extends CI_Controller{  
    public function __construct(){  
        parent::__construct();
		ob_clean();
		global $class,$method;  
		$this->class=$class;
		$this->method=$method;
		$this->db = $this->load->database('default', TRUE);
		header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");	
		//$this->benchmark->mark('my_mark_start');
		//http://codeigniter.org.cn/user_guide/database/utilities.html
		//$this->db->cache_on();
		//$query = $this->db->query("SELECT * FROM  ecs_admin_action");
		//$this->db->cache_off();
		
		//$this->db->cache_delete()
		//下面列出的方法是无法在缓存的结果对象上使用的：
		//num_fields()
		//field_names()
		//field_data()
		//free_result()
		//同时，result_id 和 conn_id 这两个 id 也无法使用，因为这两个 id 只适用于实时的数据库操作。
		$this->load->helper("cookie");  
		$this->load->helper("basefunction"); 
		$this->load->helper("url"); 
		if(!in_array(WEB_NAME,array('img','api','spopenapi','ueditor')))
		{
			//直接登陆
			if(isset($_GET['adm_auth'])&&isset($_GET['tm'])&&!empty($_GET['uid'])&&isset($_GET['adm_auth']))
			{
				if(trim($_GET['adm_auth'])==md5($_GET['tm'].config_item('cookie_authkey').$_GET['uid']))
				{
					set_encode_cookie("user_id",$_GET['uid'],30); 
					set_encode_cookie("username",urldecode($_GET['username']),30); 
					header("location:".site_url(WEB_NAME."_index/index"));   
					die;
				}
				else
				{
					echo "404";
					die;
				}
			}
			
			$this->load->model("Base_User_model");//user_model模型类实例化对象
			$this->cur_user=$this->Base_User_model->is_login(720000);//50分钟无任何操作退出
			//检测是否登陆，如果登陆，返回登陆用户信息，否则返回false
			if(empty($this->cur_user) &&$this->method!='login'){  
				header("location:".site_url("user/login"));  
				die;
			}
			else
			{
				$this->user_id=get_decode_cookie("user_id");
				$this->user=get_decode_cookie("username");;
				if(WEB_NAME=='admin')
				{	
					$this->user_group_id=$this->get_group_id();
					$this->user_type=get_decode_cookie("user_type");
					if($this->user_type==1)
					{
						//if($this->check_admin()===false)
							//die("无权限");
					}
				}
               
			    if( !empty($this->user_id) && strtolower($this->method)!='logout')
				{
					if(WEB_NAME=='sp')
					{
						$this->load->model("Admin_Spuser_model");
						$row=$this->Admin_Spuser_model->get_spuser($this->user_id,'status');
	
						if($method!='info_edit'&&($row['status']==2||$row['status']==1))
						{	
							header("location:".site_url('user/info_edit'));
							die;
						}
						
						if($row['status']<1)
						{	
							echo '已关闭';
							die;
						}	
	
						if($row['status']<=1 && strtolower($this->class."".$this->method) !='user'.'info_edit')
						{	
							header("location:".site_url("user/info_edit"));  
							die;
						}	
					}
					
					
					if(WEB_NAME=='seller')
					{
						$this->load->model("Admin_Seller_User_model");
						$row=$this->Admin_Seller_User_model->get_seller_user($this->user_id,'status');
	
						if($row['status']<1)
						{	
							echo '已关闭';
							die;
						}	
	
					}
				}
						
			}
		}
    }
	
	//加载供应商菜单
	public function load_sp_menu()
	{
		//-------------------选中标志-----------------------
		$this->ci_smarty->assign('select_class',strtolower($this->class));	
		$this->ci_smarty->assign('select_method',strtolower($this->method));
		//===================菜单===========================

		if(WEB_NAME=='seller'&&$this->user_id==2)
			require(APPPATH.'/config/menu_config_'.WEB_NAME.'_ls.php');
		else
			require(APPPATH.'/config/menu_config_'.WEB_NAME.'.php');

		$seo_tltie='';
		if(is_array($nva_menu))
			foreach($nva_menu as $k=>$v)
			{
				if(strtolower($v['action'])==strtolower($this->class.'/'.$this->method))
				{
					$seo_tltie=$v['name'];
					break;
				}
				
				foreach($v['actions'] as $kk=>$vv)
				{
					if(strtolower($kk)==strtolower($this->class.'/'.$this->method))
					{
						$seo_tltie=$v['name']."|".$vv;
						break 2;
					}
				}
			}

		if(WEB_NAME=='sp')
			$seo_tltie=$seo_tltie.",供应商后台";

		if(WEB_NAME=='seller')
			$seo_tltie=$seo_tltie.",分销商后台";

		//用户账户
		$this->ci_smarty->assign('admin',$this->user);	
		$this->ci_smarty->assign('seo_tltie',$seo_tltie);	
		//$this->ci_smarty->assign('nva_menu',$nva_menu);	
	}
	
	//检测后台菜单权限
	private function check_admin()
	{
		$this->load->model('Admin_User_model');
		$row=$this->Admin_User_model->get_group_one(array('group_perms'),$this->user_group_id);
		$str=md5(strtolower($this->class.'/'.$this->method));
		if(in_array($str,explode(',',$row['group_perms'])))
			return true;
		else
			return false;
	}
	
	//检测后台菜单权限
	private function  get_group_id()
	{
		$this->load->model('Admin_User_model');
		$row=$this->Admin_User_model->get_user(array('group_id'),$this->user_id);
		return $row['group_id'];
	}
}
?>   
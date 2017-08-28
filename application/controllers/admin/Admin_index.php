<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_index extends MY_Controller {
	
	public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty');  
	}
	
	//默认首页
	public function info()
	{
		//待发货零售订单
		//待发货批发订单
		//待审核商品
		//(分销)分期收款
		
		
		$this->ci_smarty->display_ini('info.htm');   
	}
	
	
	public function mobile_config()
	{
		
	
	}
	
	public function email_config()
	{
		if (!empty($_POST['send_email'])) {
            $this->load->library('CI_email');
            $this->ci_email->send_mail($_POST['email'], 'chenbo', '你好', '你好,这是一条信息');
        } else {
            if (!empty($_POST['config'])) {
                $is_open = $_POST['config']['is_open'];
                $type = $_POST['config']['type'];
                $SMTP_address = array_filter($_POST['config']['SMTP_address']);
                $email_address = array_filter($_POST['config']['email_address']);
                $email_pass = array_filter($_POST['config']['email_pass']);
                $config_email = array();
                foreach ($SMTP_address as $k => $v) {
                    $config_email[$k] = array('SMTP_address' => $v, 'email_address' => $email_address[$k], 'email_pass' => $email_pass[$k]);
                }

                $config_email = json_encode($config_email);
                $str = "<?php defined('BASEPATH') OR exit('No direct script access allowed'); \n";
                $str .= " \$config['is_open']='$is_open'; \n";
                $str .= " \$config['type']='$type';\n";
                $str .= " \$config['email']='$config_email';\n";
                create_file(APPPATH . "/cache/email_setting.php", $str);
            }
        }

        if (file_exists(APPPATH . "/cache/email_setting.php")) {
            require(APPPATH . "/cache/email_setting.php");
            $email = json_decode($config['email'], true);
            $this->ci_smarty->assign('wx', $config, 0);
            $this->ci_smarty->assign('email', $email, 0);
        }
        $this->ci_smarty->display_ini('email_site.htm');
	}
		
	public function web_config()
	{
		if(!empty($_POST['config']))
		{
			require(APPPATH.'/config/config_base.php');
			if(!empty($config))
			{
				if(file_exists(APPPATH."/config/config.php"))
						@unlink(APPPATH."/config/config.php");
						
				$ar=explode('.',$_POST['config']['web_base']);
				$config['cookie_prefix_tag']	= '_df_'.implode('_',$ar);
				$config['company']	=$_POST['config']['web_name'];
				$config['logo']	=$_POST['config']['pic'];
				$config['copyright']=$_POST['config']['copyright'];
				$config['cookie_authkey']=md5($config['cookie_prefix_tag']);
				$str="<?php defined('BASEPATH') OR exit('No direct script access allowed'); \n";
				
				foreach($config as $k=>$v)
				{
					if($k=='base_url')
						$str.="\$config['{$k}'] = '".$_POST['config']['web_url']."'.WEB_DIR; \n";
					elseif($k=='base_url_www')
						$str.="\$config['{$k}'] = '".$_POST['config']['web_url']."'; \n";
					elseif($k=='baseurl')
						$str.="\$config['{$k}'] = '".$_POST['config']['web_base']."'; \n";
					elseif($k=='index_page')	
						$str.="\$config['{$k}'] = INDEX_PAGE; \n";
					elseif($k=='cookie_domain')	
						$str.="\$config['{$k}'] = '.".$ar[count($ar)-2].".".$ar[count($ar)-1]."'; \n";	//tst.erp.com
					elseif($k=='cookie_prefix')	
						$str.="\$config['{$k}'] =  WEB_NAME.\$config['cookie_prefix_tag']; \n";	
					elseif(is_bool($v))	
						$str.="\$config['{$k}'] = ".($v==true?'TRUE':'FALSE')."; \n";
					elseif(is_array($v))	
						$str.="\$config['{$k}'] = array(); \n";	
					elseif(is_numeric($v))	
						$str.="\$config['{$k}'] = {$v}; \n";	
					elseif(is_null($v))	
						$str.="\$config['{$k}'] = NULL; \n";		
					else
						$str.="\$config['{$k}'] = '{$v}'; \n";
				}
				error_log($str." ?>",3,APPPATH."/config/config.php");
			}
			
			if(file_exists(APPPATH."/config/config_back.php"))
		   	   @unlink(APPPATH."/config/config_back.php");
			$str="<?php defined('BASEPATH') OR exit('No direct script access allowed'); \n";
			foreach($_POST['config']  as $k=>$v)
			{
				if(is_numeric($v))	
					$str.="\$config['{$k}'] = {$v}; \n";
				else		
					$str.="\$config['{$k}'] = '{$v}'; \n";
			}
			error_log($str." ?>",3,APPPATH."/config/config_back.php");
		}
		if(file_exists(APPPATH."/config/config_back.php"))
		{
			require(APPPATH."/config/config_back.php");
			$this->ci_smarty->assign('web_config',$config,0);
		}
		$this->ci_smarty->assign('ueditor_auth',get_ueditor_auth($this->user_id,WEB_NAME),0);
		$this->ci_smarty->display_ini('web_config.htm');
	}
	
	
	
	public function image_list()
	{
		if(isset($_GET['del_id']))
		{
			if(file_exists(APPPATH."../web".$_GET['url']))
			{
				@unlink(APPPATH."../web".$_GET['url']);
				$this->db->query("delete  from  ".tab_m('base_image')."   where  id='".$_GET['del_id']."' ");
			}
		}
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);  
                $this->ci_page->listRows = 15;

		$sql="select upload_name,url,user_id,add_time,id,size   from  ".tab_m('base_image');
		if(!$this->ci_page->__get('totalRows'))
		{
			$this->ci_page->totalRows =$this->db->query($sql)->num_rows;
		}
		$sql.=" order by id desc limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
		$res=array();
		$query=$this->db->query($sql);
		$res['list']=$query->result_array();
		$res['page']=$this->ci_page->prompt();	
		$this->ci_smarty->assign('re',$res,1,'page');
		$this->ci_smarty->display_ini('image_list.htm'); 
	}
	
    public function clear_temp()
	{
		if(!empty($_POST))
		{
			$dir=APPPATH."templates_c";
			$dh=opendir($dir);
			//读取模板缓存目录
			while ($file=readdir($dh)) {
				if($file!="." && $file!=".." ) {
				  $fullpath=$dir."/".$file;
				  if(is_dir($fullpath)) {
					
					 $dh2=opendir($fullpath);
					 //删除缓存目录下的文件 
					 while ($file_2=readdir($dh2))
					 {
						  $fullpath2=$dir."/".$file."/".$file_2; 
						  if(!is_dir( $fullpath2))
							unlink($fullpath2);
					 }
				  }
				}
			}
			$this->ci_smarty->assign('msg','清除成功'.date('Y-m-d H:i:s'));
		}
		$this->ci_smarty->display_ini('clear_temp.htm'); 
	}
	
	//后台菜单
	public function index()
	{
		require(APPPATH.'/config/menu_config_admin.php');
		if($this->user_type!=1)
		{
			//查询已有权限
			$this->load->model('Admin_User_model');
			$row=$this->Admin_User_model->get_group_one(array('group_perms'),$this->user_group_id);
			$group_perms=explode(',',$row['group_perms']);
		}
		else
			$group_perms=array();
		
		//头部-----------
		foreach($config['menu_config'] as $k=>$v)
		{
			$menu_top[$k] =$v[0];
			if($this->user_type!=1)
			{
				$falg=0;
				foreach($v[1] as $v1)
				{
					foreach($v1[1] as $kkk=>$v2)
					{
						$ar=explode(',',$v2);
						if(is_array($group_perms)&&in_array(md5(strtolower($ar[2].'/'.$ar[0])),$group_perms))
						{
							$falg=1;
						}
					}
				}
				if($falg==0)
					unset($menu_top[$k]);
			}
		}

		
		if(isset($menu_top))
			$this->ci_smarty->assign('menu_top',$menu_top);
		if(!isset($_GET['selected'])&&isset($config['menu_config']['index']))
			$menu_left=$config['menu_config']['index'][1];
		elseif(isset($_GET['selected'])&&!empty($config['menu_config'][$_GET['selected']]))
			$menu_left=$config['menu_config'][$_GET['selected']][1];
		$menu_lefts=array();
		//左边----------
		foreach($menu_left as $k=>$v1)
		{
			$menu_lefts[$k]['name']=$v1[0];
			foreach($v1[1] as $v2)
			{
				$ar=explode(',',$v2);
				if($this->user_type==1||is_array($group_perms)&&in_array(md5(strtolower($ar[2].'/'.$ar[0])),$group_perms))
				{
					$menu_lefts[$k]['list'][]=$ar;
				}
			}
			if(empty($menu_lefts[$k]['list']))
				unset($menu_lefts[$k]);
		}
		
		//登陆账号
		$this->ci_smarty->assign('index_page',INDEX_PAGE);		
		$this->ci_smarty->assign('admin',get_decode_cookie('username'));		
		$this->ci_smarty->assign('menu_left',$menu_lefts);		
		$this->ci_smarty->display('main_index.htm');   
	}
	
	
	//错误提示页面
	public function admin_msg()
	{
		$this->ci_smarty->display('admin_msg.htm');   
	}

	public function iframe()
	{
		$this->ci_smarty->assign('width',$_GET['width']);		
		$this->ci_smarty->assign('height',$_GET['height']);	
		$this->ci_smarty->assign('title',$_GET['title']);	
		unset($_GET['width'],$_GET['height'],$_GET['title']);
		$this->ci_smarty->assign('url',site_url($_GET['mothed'])."/?".url_convert($_GET));	
		$this->ci_smarty->display('iframe.htm');
	}
	
}


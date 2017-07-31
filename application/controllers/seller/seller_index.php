<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class seller_index extends MY_Controller {

	public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty');  
		$this->load_sp_menu();	  		
	}
	
	public function index()
	{

		$this->ci_smarty->display_ini('info.htm');   
	}
	
	//错误提示页面  sp_index/sp_msg
	public function seller_msg()
	{
		
		$this->ci_smarty->display('seller_msg.htm');   
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

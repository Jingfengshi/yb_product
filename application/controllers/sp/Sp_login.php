<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sp_login extends MY_Controller {
   
    public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty');
		  
	}
	
	public function index()
	{
		
		
	}
	
	public function login()
	{
		$this->ci_smarty->display('login.htm');   
	}
}

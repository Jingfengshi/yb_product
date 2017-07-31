<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Baseconf extends MY_Controller {

	public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty');  
		$this->load_sp_menu();				
	}
	
	public function logistics_company()
	{
		$this->load->model('Base_Logistics_model');
		$this->ci_smarty->assign('company',$this->Base_Logistics_model->logccom_list());
		$this->ci_smarty->display_ini('logistics_company.htm');   
	}
	
	public function logistics_list()
	{
		
		$this->ci_smarty->display_ini('logistics_list.htm');   
	}

	public function warehouse_list()
	{
		$this->load->model('Admin_Warehouse_model');
		$this->ci_smarty->assign('company',$this->Admin_Warehouse_model->warehouse_list());
		$this->ci_smarty->display_ini('warehouse_list.htm');   
	}

}

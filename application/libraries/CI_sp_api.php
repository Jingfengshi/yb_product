<?php
defined('APPPATH') or die('Access restricted!'); 
//供应商对接api
class CI_sp_api{   
	 public function __construct(){  
	 
	 } 
	 
	 //API工厂
	 public function get_object_api($api_no)
	 {
		 $apiclass='sp_api_'.$api_no;
		 require(APPPATH . 'libraries/sp_api/'.$apiclass.'.class.php'); 	
		 return new $apiclass();
	 }
	 
}
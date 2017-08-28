<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order_accountperiod_model extends CI_Model
{
	public function insert($arr)
	{
		$CI = & get_instance();
		$CI->load->model('Base_update_model');
		return $CI->Base_update_model->insert(tab_m('order_accountperiod'),$arr);
	}

	public function update($data,$where)
	{
		$CI = & get_instance();
		$CI->load->model('Base_update_model');
		return $CI->Base_update_model->update(tab_m('order_accountperiod'),$data,$where);
	}
	
	public function get_row($data,$where)
	{
		$CI = & get_instance();
		$CI->load->model('Base_update_model');
		return $CI->Base_get_model->get_row(tab_m('order_accountperiod'),$data,$where);
	}
	
}
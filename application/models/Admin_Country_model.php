<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Country_model extends CI_Model
{
	//产地管理列表
	public function country_list($page_num,$page,$search_array)
	{
		$this->db->like($search_array);
		$this->db->limit($page_num,$page);
		return $this->db->select('c_id,c_name,c_enname,c_display')
						->from(tab_m('country'))
						->get()
						->result_array();
	}
	
	//产地管理列表总共行数
	public function country_totalRows($search_array)
	{
		return $this->db->like($search_array)
						->from(tab_m('country'))
						->count_all_results();
	}
	
    //开启的产地
	public function get_show_country($c_display=0)
	{
		$this->db->where('c_display',$c_display);
		return	$this->db->select('c_id,c_name')
					 ->from(tab_m('country'))
					 ->get()
					 ->result_array();		
	}
	
	//修改产地状态
	public function update_country_display($country_arr)
	{
		return $this->db->update_batch(tab_m('country'), $country_arr,'c_id');
	}
}
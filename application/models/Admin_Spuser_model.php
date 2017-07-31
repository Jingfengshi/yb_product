<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Spuser_model  extends CI_Model
{

	//添加供应商
	function spuser_add($spuser_arr)
	{
		if (!empty($spuser_arr)) {
			$check = $this->spuser_check($spuser_arr['user']);			
		}		
		if(!empty($check)){
				return false;
		}else{
			$flag = $this->db->insert(tab_m('sp_user'),$spuser_arr);		
			if ($flag == 1) {
				return true;
			}	
		}
			
	}

	//检测用户名是否重复
	function spuser_check($user)
	{
		$this->db->where('user',$user);
		return	$this->db->select('id')
					 ->from(tab_m('sp_user'))
					 ->get()
					 ->result_array();
	}

	//通过id查询用户帐号
	function get_spuser($id,$filds='*')
	{
		$this->db->where('id',$id);
		return	$this->db->select($filds)
					 ->from(tab_m('sp_user'))
					 ->get()
					 ->row_array();
	}

	//通过id更新供应商
	function spuser_updata($id,$spuser_arr)
	{
		$this->db->where('id',$id);
		$flag = $this->db->update(tab_m('sp_user'), $spuser_arr);
		if ($flag == 1) {
			return true;
		}	
	}
	//供应商信息 修改
	/*
        传入参数
        $data       arr   修改数据
        $where_arr  arr   关键字 搜索内容

        返回值：执行条数
    */

	public function update_sp_user($data,$where_arr)
	{
		if(!is_array($data)||empty($data))
		{
			return 0;
		}
		if(!is_array($where_arr)||empty($where_arr))
		{
			return 0;
		}
		return $this->db->update(tab_m('sp_user'), $data, $where_arr);
	}
}
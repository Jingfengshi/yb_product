<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Cat extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty');
	}
	
	//商品类型列表
	public function cat_list()
	{    
		//添加分类
		if($_POST['act']=='add_cat')
		{	
		   $this->load->model('Admin_Cat_model');  
		   $cat_arr['pid'] = $this->input->post('new_pid',true);
		   $cat_arr['cat'] = $this->input->post('new_cat',true);
		   if(!empty($cat_arr['cat']))
		   {
				//添加分类
			   $this->Admin_Cat_model->cat_add($cat_arr);
		   }
		   header("location:".site_url('cat/cat_list'));
		   die;
		}	//修改分类
			
		if($_POST['act']=='edit_cat')
		{
			$this->load->model('Admin_Cat_model');  
			foreach($_POST['id'] as $id)
			{
			  if(!empty($_POST['cat'][$id])) 
			  {
				  $cat_arr['cat']=$_POST['cat'][$id];
				  $this->Admin_Cat_model->cat_updata($id,$cat_arr);
			  }
			}
			header("location:".site_url('cat/cat_list'));
			die;
		}
		
		if(!empty($_GET['del_id']))
		{
			$this->db->query("delete   from  ".tab_m('stock_cat')."  where id='".($_GET['del_id']*1)."' ");
		    $this->db->query("delete   from  ".tab_m('stock_cat')."  where pid='".($_GET['del_id']*1)."' ");
			header("location:".site_url('cat/cat_list'));
		    die;
		}
		
		$this->load->model('Admin_Cat_model');       
		$res_cat=$this->Admin_Cat_model->cat_list();
		$this->ci_smarty->assign('res_cat',$this->Admin_Cat_model->cat_list());
		$this->ci_smarty->display_ini('cat_list.htm');
	}

	
}
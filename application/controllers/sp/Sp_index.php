<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sp_index extends MY_Controller {

	public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty');  
		$this->load_sp_menu();				
	}
	
	//菜单
	public function index()
	{
		
		//零售订单
		$daifahuo=$this->db->select('a.id')
		->from(tab_m('order_ls')." as a")
		->where('a.status=1 and a.sp_userid='.$this->user_id)
		->get()->num_rows();
		$res['ls_num']=$daifahuo;
		
		//代发货订单数
		$daifahuo=$this->db->select('a.id')
		->from(tab_m('sp_order')." as a")
		->join(tab_m('order').' as b','a.order_id=b.id','left')
		->where('a.delivery_status=0 and ( b.payment_status=2  or  b.AccountPeriod_status>=2 ) and a.sp_id='.$this->user_id)
		->get()->num_rows();
		$res['daifahuo_num']=$daifahuo;
		
		
		//已上架商品数
		$yishangjia=$this->db->select('id')
		->from(tab_m('sp_product'))
		->where(array('status'=>1,'userid'=>$this->user_id))
		->get()->num_rows();
		$res['yishangjia']=$yishangjia;

		//已下架商品数
		$yixiajia=$this->db->select('id')
			->from(tab_m('sp_product'))
			->where(array('status'=>0,'userid'=>$this->user_id))
			->get()->num_rows();
		$res['yixiajia']=$yixiajia;

		//待审核商品数
		$daishenhe=$this->db->select('id')
			->from(tab_m('sp_product'))
			->where(array('status'=>-1,'userid'=>$this->user_id))
			->get()->num_rows();
		$res['daishenhe']=$daishenhe;

		$this->ci_smarty->assign('re',$res);
		$this->ci_smarty->display_ini('info.htm');   
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
	

	//错误提示页面  sp_index/sp_msg
	public function sp_msg()
	{
		$this->ci_smarty->display('sp_msg.htm');   
	}

}

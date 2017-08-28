2w<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

    public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty');
		$this->load->model('Admin_Country_model');
		$this->load_sp_menu();	
	}

	//保税产品订阅
	public function product_list()
	{
		//***************************
		//         查询开始	
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		
		if($this->user_id!=2)
			$wsql=' a.hg_type=3 and a.status=1 ';
		else	
			$wsql=' a.status=1 ';
			
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar=array('countryid','is_shop','warehouse_id','barcode');
			//姓名模糊查询字段
			$search_key_ar_more=array('id','brand','cname');
			foreach($_GET as $k=>$v)
			{
				$skey=substr($k,7,strlen($k)-7);  
				if($k!='search_page_num'&&substr($k,0,7)=='search_'&&!in_array($v,array('all','')))
				{
					//非模糊查询
					if(in_array($skey,$search_key_ar))
						$wsql.=" and a.{$skey}='{$v}'";
						
					//模糊查询
					if(in_array($skey,$search_key_ar_more))
						$wsql.=" and a.{$skey} like '{$v}'";	
				}
			}
			
			if(isset($_GET['search_is_dy'])&&$_GET['search_is_dy']!='all')
			{
				if($_GET['search_is_dy']==1)
					$wsql.=" and a.id=b.stock_id  ";
				else
					$wsql.=" and b.stock_id is NULL   ";
			}
		}
		$search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
		//===================查询 end=========================
		$this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		$sql="select  a.*,b.id  as s_id from  ".tab_m('stock')."  as  a  left join  
			 ".tab_m('seller_product')."  as  b  on  a.id=b.stock_id and b.userid=".$this->user_id."  where   ".$wsql;
			 
		if(!$this->ci_page->__get('totalRows'))
		{
			$query=$this->db->query($sql);
			$this->ci_page->totalRows =$query->num_rows;
		}
		
		$sql.=" order by a.id desc limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
		$query=$this->db->query($sql);
		$res=array();
		foreach($query->result_array() as $v)
		{
			$res['list'][]=$v;
		}
		$res['page']=$this->ci_page->prompt();
		$this->ci_smarty->assign('res_country',$this->Admin_Country_model->get_show_country());
		$this->ci_smarty->assign('re',$res,1,'page');
		//查询结束
		//***************************      
		$this->ci_smarty->display_ini('product_list.htm');   
	}
	
	//选品
	public function product_select()
	{
		$str=array('msg'=>'选品失败','type'=>1);
		if(is_array($_POST['item'])&&!empty($_POST['item']))
		{
			$nums=0;
			$this->load->model('Admin_Warehouse_model');
			$this->load->model('Seller_product_model');
		    foreach($_POST['item'] as $k=>$stock_id)
			{
				$row=$this->Seller_product_model->get_product_detail('id',array('stock_id'=>$stock_id,'userid'=>$this->user_id));
				if(empty($row))
				{
					$this->load->model('Admin_Stock_model');
					$row=$this->Admin_Stock_model
					     ->get_stock('warehouse_id,cname,country,countryid,barcode,mark_price,price',array('id'=>$stock_id));
					if(!empty($row))
					{			
					    $ar=array();	 
						$ar['userid']=$this->user_id;
						$ar['warehouse_id']=$row['warehouse_id'];
						$type=$this->Admin_Warehouse_model->get_warehouse($ar['warehouse_id'],'type');
						$ar['hg_type']=$type['type'];
						$ar['stock_id']=$stock_id;
						$ar['c_num']=0;
						$ar['online_num']=0;
						$ar['sell_num']=0;
						$ar['price']=0;
						$ar['mark_price']=0;
						$ar['status']=0; //待审核
						$this->Seller_product_model->add_product($ar); 
						$nums+=1;
					}
				}
			}
			$str=array('msg'=>'成功选品 ('.$nums.') 条数据','type'=>3);
		}	
		echo json_encode($str);
		die;
	}
}





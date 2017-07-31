<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sproduct extends MY_Controller {
    public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty');
		//$this->load->model('Sp_Product_model');  
		$this->load_sp_menu();	
	}

	//我的商品
	public function product_list()
	{
		if(isset($_GET['clear']))
		{
			$this->load->model('Seller_product_model'); 
			$this->Seller_product_model->update_product(array('c_num'=>0),array('userid'=>$this->user_id));
			header("location:".site_url($this->class."/".$this->method));
			die;
		}
		
		if(isset($_GET['explode']))
		{
			$xls_title=array(0=>"产品名称",1=>"订购数",2=>"产地",3=>"品牌",4=>"规格");
			$xls_value=$this->db->query("select b.cname as name,a.c_num,b.country,b.brand,b.gg  from "
			                             .tab_m('seller_product')." as a left join ".tab_m('stock')." as b 
										  on a.stock_id=b.id   where 
										  a.userid='".$this->user_id."' and a.c_num>0  ")->result_array();
			if(empty($xls_value))
			{
				header("location:".site_url($this->class."/".$this->method));
				die;
			}		 
			get_explode_xls($xls_title,$xls_value,date('YmdHis'));	 
		}
		
		//***************************
		//         查询开始	
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		$wsql='';
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar=array('status','stock_id');
			//姓名模糊查询字段
			$search_key_ar_more=array('cname');
			
			$search_key_bar=array('countryid','cat_id');
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
						$wsql.=" and b.{$skey} like '%{$v}%'";
						
					//模糊查询
					if(in_array($skey,$search_key_bar))
						$wsql.=" and b.{$skey}='{$v}'";		
				}
			}
			
			if(isset($_GET['search_nums'])&&$_GET['search_nums']!='all')
			{
				if($_GET['search_nums']==2)
					$wsql.=" and a.c_num>0  ";
				else
					$wsql.=" and a.c_num=0   ";
			}
		}
		
		$search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
		//===================查询 end=========================
		$this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		$sql="select  a.*,b.cname as name,b.country,b.rate,b.is_shop,b.gg,b.gn,b.cf,b.barcode  from  ".tab_m('seller_product')
		      ." as a  left join ".tab_m('stock')." as b 
		      on a.stock_id=b.id
		      where  userid='".$this->user_id."'  ".$wsql.' order by a.id DESC ';
			  
		if(!$this->ci_page->__get('totalRows'))
		{
			$query=$this->db->query($sql);
			$this->ci_page->totalRows =$query->num_rows;
		}

		$sql.=" limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
		$query=$this->db->query($sql);
		$res=array();
		
		$this->load->model('Sp_Product_model');
		foreach($query->result_array() as $v)
		{
			$d=$this->Sp_Product_model->get_product("c_num,online_num",array('stock_id'=>$v['stock_id']));	
			$v['s_num']=$d['c_num']-$d['online_num'];
			$res['list'][]=$v;
		}
		
		$res['page']=$this->ci_page->prompt();	
		$this->ci_smarty->assign('re',$res,1,'page');
		
		$this->load->model('Admin_Cat_model');  
		//获取商品类别、产地选项
		$this->ci_smarty->assign('res_stock_cat',$this->Admin_Cat_model->cat_list());
		$this->load->model('Admin_Country_model');
		$this->ci_smarty->assign('res_country',$this->Admin_Country_model->get_show_country());
		
		//查询结束
		//***************************      
		$this->ci_smarty->display_ini('sproduct_list.htm');   
	}
	
	
	//我的商品
	public function product_list_ls()
	{
		if(isset($_GET['clear']))
		{
			$this->load->model('Seller_product_model'); 
			$this->Seller_product_model->update_product(array('c_num'=>0),array('userid'=>$this->user_id));
			header("location:".site_url($this->class."/".$this->method));
			die;
		}
		
		if(isset($_GET['explode']))
		{
			$xls_title=array(0=>"产品名称",1=>"订购数",2=>"产地",3=>"品牌",4=>"规格");
			$xls_value=$this->db->query("select b.cname as name,a.c_num,b.country,b.brand,b.gg  from "
			                             .tab_m('seller_product')." as a left join ".tab_m('stock')." as b 
										  on a.stock_id=b.id   where 
										  a.userid='".$this->user_id."' and a.c_num>0  ")->result_array();
			if(empty($xls_value))
			{
				header("location:".site_url($this->class."/".$this->method));
				die;
			}		 
			get_explode_xls($xls_title,$xls_value,date('YmdHis'));	 
		}
		
		//***************************
		//         查询开始	
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		$wsql='';
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar=array('status','stock_id');
			//姓名模糊查询字段
			$search_key_ar_more=array('cname');
			
			$search_key_bar=array('countryid','cat_id','barcode');
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
						$wsql.=" and b.{$skey} like '%{$v}%'";
						
					//模糊查询
					if(in_array($skey,$search_key_bar))
						$wsql.=" and b.{$skey}='{$v}'";		
				}
			}
			
			if(isset($_GET['search_nums'])&&$_GET['search_nums']!='all')
			{
				if($_GET['search_nums']==2)
					$wsql.=" and a.c_num>0  ";
				else
					$wsql.=" and a.c_num=0   ";
			}
		}
		
		$search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
		//===================查询 end=========================
		$this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		$sql="select  a.*,b.cname as name,b.country,b.rate,b.is_shop,b.gg,b.gn,b.cf,b.barcode  from  ".tab_m('seller_product')
		      ." as a  left join ".tab_m('stock')." as b 
		      on a.stock_id=b.id
		      where  userid='".$this->user_id."'  ".$wsql.' order by a.id DESC ';
			  
		if(!$this->ci_page->__get('totalRows'))
		{
			$query=$this->db->query($sql);
			$this->ci_page->totalRows =$query->num_rows;
		}

		$sql.=" limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
		$query=$this->db->query($sql);
		$res=array();
		
		$this->load->model('Sp_Product_model');
		foreach($query->result_array() as $v)
		{
			$d=$this->Sp_Product_model->get_product("c_num,online_num",array('stock_id'=>$v['stock_id']));	
			$v['s_num']=$d['c_num']-$d['online_num'];
			$res['list'][]=$v;
		}
		
		$res['page']=$this->ci_page->prompt();	
		$this->ci_smarty->assign('re',$res,1,'page');
		
		$this->load->model('Admin_Cat_model');  
		//获取商品类别、产地选项
		$this->ci_smarty->assign('res_stock_cat',$this->Admin_Cat_model->cat_list());
		$this->load->model('Admin_Country_model');
		$this->ci_smarty->assign('res_country',$this->Admin_Country_model->get_show_country());
		
		//查询结束
		//***************************      
		$this->ci_smarty->display_ini('sproduct_list_ls.htm');   
	}
	
	//商品日志
	public function product_log()
	{       
        //***************************
		//         查询开始	
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		$wsql='';
		
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar=array('type','status');
			//姓名模糊查询字段
			$search_key_ar_more=array('seller_product_id','order_id');
			foreach($_GET as $k=>$v)
			{
				$skey=substr($k,7,strlen($k)-7);  
				if($k!='search_page_num'&&substr($k,0,7)=='search_'&&!in_array($v,array('all','')))
				{
					//非模糊查询
					if(in_array($skey,$search_key_ar))
						$wsql.=" and {$skey}='{$v}'";
					//模糊查询
					if(in_array($skey,$search_key_ar_more))
						$wsql.=" and {$skey} like '%{$v}%'";	
				}
			}
		}
		
		$search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
		//===================查询 end=========================
		$this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		$sql="select  *  from  ".tab_m('seller_product_log')."  where  userid='".$this->user_id."'  ".$wsql;
		
		if(!$this->ci_page->__get('totalRows'))
		{
			$query=$this->db->query($sql);
			$this->ci_page->totalRows =$query->num_rows;
		}
		
		$sql.=" limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
		$query=$this->db->query($sql);
		$res=array();
		$res['list']=$query->result_array();
		$res['page']=$this->ci_page->prompt();	
		$this->ci_smarty->assign('re',$res,1,'page');
		//查询结束
		//***************************
		$this->ci_smarty->display_ini('product_log.htm');	
	}
	//选品
	public function  sproduct_selected()
	{
		$id=isset($_GET['id'])?$_GET['id']*1:'';	
		if(!empty($id))
		{
			//分销表
			$this->load->model('Seller_product_model');
			$seller_product=$this->Seller_product_model
							->get_product_detail("stock_id,status,sq_status,id,price",array('id'=>$id,'userid'=>$this->user_id));
							
			//平台产品库
			$this->load->model('Admin_Stock_model');
			$stock=$this->Admin_Stock_model
						 ->get_stock("cname,gn,gg,is_shop,type,country",array('id'=>$seller_product['stock_id']));  
						  
			//分销库存
			$this->load->model('Sp_Product_model');
			$sp_product=$this->Sp_Product_model->get_product("c_num,online_num,price,status"
								,array('stock_id'=>$seller_product['stock_id']));	
										
			$de['price']=$seller_product['price'];
			if($stock['is_shop']==1&&$seller_product['sq_status']==1&&$seller_product['status']==1&&$seller_product['price']>=$sp_product['price'])
				$de['c_num']=$sp_product['c_num']-$sp_product['online_num'];
			else
				$de['c_num']=0;//禁止申请
			
			if(isset($_POST['num']))	
			{
				$_POST['num']*=1;
				if($_POST['num']<=$de['c_num']&&$_POST['num']>0)
				{
					$flag=$this->Seller_product_model->update_product(array('c_num'=>$_POST['num']),array('id'=>$id,'userid'=>$this->user_id));				
					if(!empty($flag1))	
						echo json_encode(array('type'=>1,'msg'=>'系统异常'));		
					else
						echo json_encode(array('type'=>2,'msg'=>'申请成功'));
						
					die;
				}
				else
				{
					echo json_encode(array('type'=>1,'msg'=>'申请数据不足'));
					die;
				}
			}
		
			$de['cname']=$stock['cname'];
			$de['gn']=$stock['gn'];
			$de['gg']=$stock['gg'];
			$de['id']=$seller_product['id']; 
			$de['stock_id']=$seller_product['stock_id'];  
			$de['country']=$stock['country'];
			$de['type']=$stock['type'];
			$this->ci_smarty->assign('de',$de);			  
		}
		
		$this->ci_smarty->display('sproduct_selected.htm');	
	}

	public function goods_info()
	{
		if(!empty($_GET['id']))
		{
			$id = $_GET['id'];
			//model
			$this->load->model('Seller_Product_model');
			$this->load->model('Admin_Stock_model');
			$sp_product= $this->Seller_Product_model->get_product_detail('stock_id',array('id'=>$id,'userid'=>$this->user_id));
			$res= array();
			$res['id'] =$id;
			$con=$this->Admin_Stock_model->get_stock('con',array('id'=>$sp_product['stock_id']));
			$res['con']=$con['con'];
			$this->ci_smarty->assign('re',$res,0);
		}
		$this->ci_smarty->display('goods_info.htm');
	}
	
    public function product_ls_edit_stock()
	{
		//51建仓零售
		if($this->user_id!=2)
			return '';
		$this->load->model('Seller_Product_model');
		$this->load->model('Sp_Product_model');
		$num=0;//库存成功更新条数
	
		if(is_array($_POST['item']))
		{
			foreach($_POST['item'] as $id)
			{
				$id*=1;	
				$row=$this->Seller_Product_model->get_product_detail('stock_id,online_num,ls_lock_num',array('id'=>$id,'userid'=>$this->user_id));		
				if(!empty($row))
				{
					
					$ls_lock_num=$_POST['ls_lock_num'][$id]*1;
					
					if($row['ls_lock_num']==0&&(empty($ls_lock_num)||$ls_lock_num<0))
						continue;

					//修改后的库存不能小于待发货的库存
					if($ls_lock_num<$row['online_num'])
						continue;
	
					$stock_id=$row['stock_id'];	
					
					//修改后的库存不能大于可用库存
					$de=$this->Sp_Product_model->get_product('c_num,online_num,ls_lock_num,status',array('stock_id'=>$stock_id));
					
					//下架后提交直接清零库存	
					if($de['status']!=1)	
						$ls_lock_num=0;
					
					if($de['ls_lock_num']>$ls_lock_num)
					{
						//修改 减少的数量
						$num_str="-".($de['ls_lock_num']-$ls_lock_num);
						
						//修改失败加回去
						$num_str1="+".($de['ls_lock_num']-$ls_lock_num);
						$check_num=$de['ls_lock_num']-$ls_lock_num;
						
						//已锁定库存减去要减少的库存
						if($de['online_num']-$check_num<0)
							continue;
					}
					elseif($de['ls_lock_num']<$ls_lock_num)
					{
						
						//修改 增加的数量
						$num_str="+".($ls_lock_num-$de['ls_lock_num']);
						
						//修改失败
						$num_str1=$de['ls_lock_num']-$ls_lock_num;
						
						$check_num=$ls_lock_num-$de['ls_lock_num'];
	
						//总库存必须大于要继续锁定的库存
						if($de['c_num']<$de['online_num']+$check_num)
							continue;
					}
					else
						continue;

					//排断通过后 先锁定供应库存,然后修改零售库存 目前设定零售商户唯=一  $num_str=-1
					
					$sql="update  ".tab_m('sp_product')."  set   ls_lock_num=ls_lock_num".$num_str.",online_num=online_num".$num_str
						 .",uptime='".date("Y-m-d H:i:s")."' where  online_num".$num_str.">=0  and   c_num>=online_num".$num_str."  and  stock_id='".$stock_id."' " ;
					$falg=$this->Sp_Product_model->update_product_sql($sql);
					
					if(!empty($falg))
					{
						$sql="update  ".tab_m('seller_product')." set  ls_lock_num=ls_lock_num"
							 .$num_str.",uptime='".date("Y-m-d H:i:s")."'
							 where ls_lock_num".$num_str.">=0 and  online_num<=".$ls_lock_num." and id=".$id;
						$falg=$this->Seller_Product_model->update_product_sql($sql);
						
						if(empty($falg))
						{
							 $sql="update  ".tab_m('sp_product')."  set   ls_lock_num=ls_lock_num".$num_str1.",online_num=online_num".$num_str1
								 .",uptime='".date("Y-m-d H:i:s")."' where  stock_id='".$stock_id."' " ;
							 $falg=$this->Sp_Product_model->update_product_sql($sql);
						}
						else
							$num++;											
					}
				}
			}	
			echo "成功更新".$num;
		}
		else
			"更新失败";
	}
}





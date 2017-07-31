<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Spuser extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty');  
	}
	
	//审核供应产品
	public function spuser_product_check()
	{
		$this->load->model('Sp_Product_model');
		$de=$this->Sp_Product_model->get_product("id,out_warehouse_id,stock_id,name
				,barcode,userid,c_num,online_num,send_num,sell_num
				,price,kjt_rate, out_product_id,is_split,max_num,status",$_GET['id']);
				
		$de['pro']=$this->Sp_Product_model->get_product_content("product_sp_id,pic,name,desc,brand,catname,cat_id,country,countryid,length,width,height,barcode,mark_price, cf,gn,type,mz,jz,gg,con, shop_addr,shop_type",$_GET['id']);		
		
		$this->ci_smarty->assign('de',$de);
		$this->ci_smarty->assign('ueditor_auth',get_ueditor_auth($this->user_id,WEB_NAME),0);
		$this->ci_smarty->display_ini('spuser_product_check.htm');  
	}
	
	//批量审核
	public function spuser_product_check_list()
	{
		//审核不通过
		if(!empty($_GET['nopass'])&&!empty($_GET['ids']))
		{
			$this->db->query("update ".tab_m('sp_product')."   set   status=-2  where  status=-1  and id in(".$_GET['ids'].") ");
			$msg=array(
				'msg'=>"操作成功",
				'type'=>3
			);
			echo json_encode($msg);
			die;
		}
		
		$this->load->model('Admin_Stock_model');
		$this->load->model('Sp_Product_model');	
		$this->load->model('Seller_product_model');	
		$this->load->model('Admin_Warehouse_model');	
		$de1=$this->db->query("select  `id`, `stock_id`, `name`, `barcode`, `userid`, `c_num`
		                      ,`online_num`, `send_num`, `sell_num`, `price`,`status`,`warehouse_id`
		                      from  ".tab_m('sp_product')."  where id in(".$_GET['ids'].") ")->result_array();
		$de=array();
		$error_msg='';
		foreach($de1 as $k=>$v)
		{
			if(!empty($v['stock_id']))
			{
				$sql = "select price from ".tab_m('stock')." where id = ".$v['stock_id'];
				$info=$this->db->query($sql)->row_array();
			}
			$de[$k]=$v;
			
			//修改后的供应价
			if(!empty($_POST)&&$_POST['price'][$v['id']]*1!=0&&$_POST['status'][$v['id']]==1)
			{
				if($_POST['price'][$v['id']]*1<$_POST['gprice'][$v['id']]*1)
					$error_msg.=($error_msg?',':'').$v['id'];
			}
			
			$info['price']*=1;
			if(!empty($info['price']))
				$de[$k]['g_price']=$info['price'];
			else
				$de[$k]['g_price']='';
		}
		
		if(!empty($_POST)&&!empty($error_msg))
		{
			$msg=array(
				'msg'=>"平台定价小于供应价,ID：".$error_msg,
				'type'=>1
			);
			echo json_encode($msg);
			return;
		}
		
		if(isset($_POST['price'])&&is_array($_POST['price']))
		{
			$up_num=0;
			
			foreach($de as  $k=>$v)
			{
				if(empty($_POST['status'][$v['id']]))
					continue;
				$_POST['gprice'][$v['id']]*=1;
				
				//修改后的供应价
				$v['new_gprice']=$_POST['gprice'][$v['id']]*1;
				
				//$V['prcie']  修改前的供应价
				
				//$v['g_price']  原平台定价
				
				
				if($_POST['status'][$v['id']]==1)
				{
				   $pro=$this->Sp_Product_model->get_product_content("product_sp_id,userid,name,desc,brand,catname
									,cat_id,country,countryid,length,width,height,barcode,mark_price,
									cf,gn,type,mz,jz,gg,con,shop_addr,shop_type,pic",$v['id']);	
				   $ar=array();
				   $ar['warehouse_id']=$v['warehouse_id']*1;  //
				   $ar['cname']=mysql_escape_string($v['name']);
				   $ar['ename']=''; 
				   $ar['desc'] =''; 
				   $ar['hg_type']=0;
				   $ar['brand']=$pro['brand']; 
				   $ar['catname']=$pro['catname']; 
				   $ar['cat_id']=$pro['cat_id']; 
				   $ar['country']=$pro['country']; 
				   $ar['countryid']=$pro['countryid']; 
				   $ar['length']=$pro['length']*1; 
				   $ar['width']=$pro['width']*1; 
				   $ar['height']=$pro['height']*1; 
				   $ar['barcode']=$pro['barcode']; 
				   $ar['mark_price']=$pro['mark_price']*1; 
				   $ar['price']=$_POST['price'][$v['id']]*1; //最新平台定价
				   $ar['cb_price']=$ar['price']-$v['new_gprice']; 
				   $ar['cf']=$pro['cf']; 
				   $ar['gn']= $pro['gn']; 
				   $ar['type']= $pro['type']; 
				   $ar['mz']=$pro['mz']*1; 
				   $ar['jz']=$pro['jz']*1;
				   $ar['gg']=$pro['gg'];
				   $ar['is_split']=0;
				   $ar['status']='1'; 
				   $ar['is_shop']='1'; 
				 
				   //无图 无条形码 不能审核通
				   if(empty($ar['price'])||$ar['price']<$v['new_gprice']||empty($pro['pic'])||empty($ar['mz']))	
						continue;
					
					//未绑定入库
					if(empty($v['stock_id']))
					{
						 $ar['con']=$pro['con'];
						 $v['stock_id']=$this->Admin_Stock_model->add_stock($ar);
						 if(!empty($v['stock_id']))
						 {
							$this->Sp_Product_model->update_product(array('stock_id'=>$v['stock_id'],'status'=>1,'c_num'=>$_POST['num'][$v['id']]*1),array('id'=>$v['id']));
							$up_num++;
						 }
						 unset($ar);
					}
					else
					{
						$ar=array();
						$ar['status']='1'; 
						$this->Sp_Product_model->update_product(array('status'=>1,'price'=>$v['new_gprice'],'c_num'=>$_POST['num'][$v['id']]*1),array('id'=>$v['id']));
						$this->Admin_Stock_model->update_stock($ar,array('id'=>$v['stock_id']));	
					}
					
					if(!empty($pro['pic']))
					{
						//if(!empty($v['out_product_id'])) 
						//	@copy_url_image(config_item('base_url').$pro['pic'],$v['stock_id']);
						//else
						//	@copy_url_image(config_item('base_url').$pro['pic'],$v['stock_id']);
					}	
					
					//平台定价有修改时 同时修改分销价
					if($ar['price']!=$v['g_price'])
						$this->Seller_product_model->update_product_tb($ar['price'],$v['g_price'],$v['stock_id']);
				}
				else
				{
					$up_num++;
					//下架
					$this->Sp_Product_model->update_product(array('status'=>0),array('id'=>$v['id']));
					if(!empty($v['stock_id']))
					{
						//停止销售
						$this->Admin_Stock_model->update_stock(array('status'=>0,'is_shop'=>-1,'is_shop'=>-1),array('id'=>$v['stock_id']));
						//下架
						$this->Seller_product_model->update_product(array('status'=>0),array('stock_id'=>$v['stock_id']));
					}
				}

				
				$warehouse_id=$_POST['warehouse_id'][$v['id']]*1!=0?$_POST['warehouse_id'][$v['id']]*1:$v['warehouse_id'];
				if(!empty($warehouse_id))
				{
					$this->Sp_Product_model->update_product(array('warehouse_id'=>$warehouse_id),array('id'=>$v['id']));
					if(!empty($v['stock_id']))
					{
						$row=$this->Admin_Warehouse_model->get_warehouse($warehouse_id,'type');
						$hg_type=$row['type'];
						$this->Admin_Stock_model->update_stock(array('warehouse_id'=>$warehouse_id,'hg_type'=>$hg_type),array('id'=>$v['stock_id']));
						$this->Seller_product_model->update_product(array('warehouse_id'=>$warehouse_id,'hg_type'=>$hg_type),array('stock_id'=>$v['stock_id']));
					}
				}
			}
			//关闭窗口刷新页面	
			$msg=array(
				'msg'=>$hg_type,
				'type'=>3
			);
			echo json_encode($msg);
			die;
			
		}						
		$re=array();
		
	    $this->load->model('Admin_Warehouse_model');
		$Warehouse=array();
		foreach($de as  $k=>$v)
		{   
			$pro=$this->Sp_Product_model->get_product_content("gg",$v['id']);	
			$v['gg']=$pro['gg'];
			$v['stock']=$this->db->query("select  price  from  ".tab_m('stock')."  
			                   			 where id='$v[stock_id]' limit 1 ")->row_array();	
										 			   
			if(empty($Warehouse[$v['userid']]))
				$Warehouse[$v['userid']]=$this->Admin_Warehouse_model->warehouse_where_list("name,company,id",array('sp_uid'=>$v['userid']));
				
			$v['warehouse_list']=$Warehouse[$v['userid']];			   		   
			$re[$k]=$v;
		}
		
		$this->ci_smarty->assign('warehouse',$warehouse);
		$this->ci_smarty->assign('re',$re);
		$this->ci_smarty->display_ini('spuser_product_check_list.htm');  
	}

	//供应商列表
	public function spuser_list()
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
			$search_key_ar=array('status');
			//姓名模糊查询字段
			$search_key_ar_more=array('user','company');
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
		$sql="select  *  from  ".tab_m('sp_user')."  where  1=1  ".$wsql;
		
		if(!$this->ci_page->__get('totalRows'))
		{
			$query=$this->db->query($sql);
			$this->ci_page->totalRows =$query->num_rows;
		}
		
		$sql.=" order by id desc limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
		$query=$this->db->query($sql);
		$res=array();
		$res['list']=$query->result_array();
		$res['page']=$this->ci_page->prompt();	
		$this->ci_smarty->assign('re',$res,1,'page');
		//查询结束
		//***************************
		$this->ci_smarty->display_ini('spuser_list.htm');
	}
	
	//添加或者修改供应商
	public function spuser_add()
	{
		$this->load->model('Admin_Spuser_model');				
		//判断是否有数据提交
		if (!empty($_POST)) 
		{					
			//表单验证
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('user', '用户帐号', 'required|min_length[4]'); 

			
			//id存在可以不验证user_pwd,act_pwd
			if (!empty($_POST['id'])) 
			{
				if(!empty($_POST['user_pwd']))
					$this->form_validation->set_rules('user_pwd', '用户密码', 'required|min_length[6]');
				if(!empty($_POST['act_pwd']))
					$this->form_validation->set_rules('act_pwd', '操作密码', 'required|min_length[6]');
			}
			else
			{
				$this->form_validation->set_rules('user_pwd', '用户密码', 'required|min_length[6]');
				$this->form_validation->set_rules('act_pwd', '操作密码', 'required|min_length[6]');
			}	

			//表单验证，通过进行赋值，不通过提示错误并返回
			if ($this->form_validation->run() == FALSE)
			{
				$msg=array(
					'msg'=>validation_errors("<i class='icon-comment-alt'></i> "),
					'type'=>1
				);	
				echo json_encode($msg);
				die;
			}    
			else
			{
				//以数组类型添加或者修改数据库
				$spuser_arr = array();
				
				//判断user_pwd，act_pass，status是否存在，存在就修改
				if(!empty($_POST['id']))
				{
					if (!empty($_POST['user_pwd'])) 
					{
						$spuser_arr['pass']     = md5($this->input->post('user_pwd',true));
					}
					if (!empty($_POST['act_pwd'])) 
					{
						$spuser_arr['act_pass'] = md5($this->input->post('act_pwd',true));
					}
					if (isset($_POST['status'])) 
					{
						$spuser_arr['status']   = $this->input->post('status',true);
					}
					if (isset($_POST['company']))
					{
						$spuser_arr['company']   = $this->input->post('company',true);
					}
					if (isset($_POST['mobile']))
					{
						$spuser_arr['mobile']   = $this->input->post('mobile',true);
					}



				}
				else
				{
					$spuser_arr['user']      = $this->input->post('user',true);
					$spuser_arr['company']      = $this->input->post('company',true);
					$spuser_arr['mobile']      = $this->input->post('mobile',true);
					$spuser_arr['pass']      = md5($this->input->post('user_pwd',true));
					$spuser_arr['act_pass']  = md5($this->input->post('act_pwd',true));
					$spuser_arr['addtime']   = date('y-m-d h:i:s');
					$spuser_arr['status']    = 1;
				}

				//判断是否存在id，没有进行添加，有进行修改
				if (!empty($_POST['id'])) 
				{									
					$flag = $this->Admin_Spuser_model->spuser_updata($_POST['id'],$spuser_arr);	
					if($flag===true)
					{
						//关闭窗口刷新页面	
						//$this->ci_smarty->assign('close_msg',1);
						$msg=array(
							'msg'=>"操作成功",
							'type'=>3
						);
						echo json_encode($msg);
				  	    die;
					}
					else
					{
						$msg=array(
							'msg'=>validation_errors("<i class='icon-comment-alt'></i> ").$str_msg,
							'type'=>1
						);	
						echo json_encode($msg);
						die;
					}									
				}
				else
				{
					
					$flag = $this->Admin_Spuser_model->spuser_add($spuser_arr);
					if($flag===true)
					{
						$msg=array(
							'msg'=>"操作成功",
							'type'=>3
						);
						echo json_encode($msg);
				  	    die;
					}
					else
					{
						$msg=array(
							'msg'=>validation_errors("<i class='icon-comment-alt'></i> ").$str_msg,
							'type'=>1
						);	
						echo json_encode($msg);
						die;
					}
				}
				usrl_back_msg($str_msg,$url_ar,$this->ci_smarty);
			}		
		}

		//判断是否存在id，没有进行添加，有进行修改
		if (!empty($_GET['id'])) 
		{
     		$this->ci_smarty->assign('sp_res',$this->Admin_Spuser_model->get_spuser($_GET['id']));
		}

		//防止csrf攻击
		$this->security->get_csrf_token_name();
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$this->ci_smarty->assign('csrf',$csrf);
		//加载页面
		$this->ci_smarty->display_ini('spuser_add.htm');
	}

	private function up_pic($pic,$stock_id)
	{
		@copy_url_image($pic,$stock_id);	
		$this->load->model('Sp_Product_model');
		$this->Sp_Product_model->update_product(array('pic_status'=>2),array('stock_id'=>$stock_id));
	}

	//供应商品列表
	public function spuser_product()
	{     
		if(!empty($_POST['up_pic'])&&$_POST['up_pic']==1)
		{
			if(empty($_POST['sid'])||empty($_POST['pic']))
			{
				$msg=array(
					'msg'=>'更新失败，图片信息错误',
					'type'=>1
				);	
				echo json_encode($msg);
			}
			else
			{
				$this->up_pic($_POST['pic'],$_POST['sid']);
				$msg=array(
					'msg'=>'更新成功',
					'type'=>2
				);	
				echo json_encode($msg);
			}
			die;
		}
		
		if(!empty($_POST['not_up_pic'])&&$_POST['not_up_pic']==1)
		{
			$this->load->model('Sp_Product_model');
			$this->Sp_Product_model->update_product(array('pic_status'=>0),array('id'=>$_POST['id']));
			if(empty($_POST['id'])||empty($_POST['pic']))
			{
				$msg=array(
					'msg'=>'更新失败，图片信息错误',
					'type'=>1
				);	
				echo json_encode($msg);
			}
			else
			{
				$this->up_pic($_POST['pic'],$_POST['sid']);
				$msg=array(
					'msg'=>'更新成功',
					'type'=>2
				);	
				echo json_encode($msg);
			}
			die;
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
			$search_key_ar=array('status','userid','id','stock_id','pic_status','barcode','warehouse_id');
			//姓名模糊查询字段
			$search_key_ar_more=array('name');
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
						$wsql.=" and a.{$skey} like '%{$v}%'";	
				}
			}
		}
		
		$search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
		//===================查询 end=========================
		$this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		$sql="select  a.*,b.`product_sp_id`,b.`name`,b.`brand`,b.`catname`,b.`cat_id`,b.`country`,b.`countryid`,b.`cf`,b.`gn`,b.`type`,b.`mz`,b.`jz`,b.`gg`,b.`pic` 
		      from  ".tab_m('sp_product')."  as a  left join  ".tab_m('sp_product_content')."  as b on  a.id=b.product_sp_id  where  1=1  ".$wsql;
		
		if(!$this->ci_page->__get('totalRows'))
		{
			$query=$this->db->query($sql);
			$this->ci_page->totalRows =$query->num_rows;
		}
		
		$sql.=" order by a.id desc limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
		$query=$this->db->query($sql);
		$res=array();
		$res['list']=$query->result_array();
		//model
		$this->load->model('Admin_Warehouse_model');
		$this->load->model('Sp_User_model');
		foreach ( $res['list'] as $k =>$v)
		{
			$res['list'][$k]['user_company']=$this->Sp_User_model->get_user_one(array('company'),$v['userid']);
			$res['list'][$k]['ware_house']=$this->Admin_Warehouse_model->get_warehouse($v['warehouse_id'],'name');
		}
		
		//仓库列表  供应商列表
		$this->load->model('Admin_Warehouse_model');
		$this->ci_smarty->assign('res_warehouse',$this->Admin_Warehouse_model->warehouse_list());
		$this->load->model('Sp_User_model');
		$res['sp_user']=$this->Sp_User_model->get_sp_user_list();
		$res['page']=$this->ci_page->prompt();	
		$this->ci_smarty->assign('re',$res,1,'page');
		//查询结束
		//***************************
		$this->ci_smarty->display_ini('spuser_product.htm');
	}
}
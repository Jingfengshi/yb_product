<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Order extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty');   
		$this->load_sp_menu();
	}
	
	//订单列表
	public function order_list()
	{         
        //***************************
		//         查询开始	
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		$wsql='';
		$s_status=' AND `status`!=-1';
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar=array('status','payment_status','id');
			//姓名模糊查询字段
			$search_key_ar_more=array('consignee_mobile');
			foreach($_GET as $k=>$v)
			{
				$skey=substr($k,7,strlen($k)-7);  
				if($k!='search_page_num'&&substr($k,0,7)=='search_'&&!in_array($v,array('all','')))
				{
					//非模糊查询
					if(in_array($skey,$search_key_ar))
					{
						$wsql.=" and {$skey}='{$v}'";
						if($skey=='status' && $v==-1)
						{
							$s_status=" AND `status`=-1 ";
						}
					}

					//模糊查询
					if(in_array($skey,$search_key_ar_more))
						$wsql.=" and {$skey} like '%{$v}%'";	
				}
			}
		}

		 if(!empty($_GET['search_stime']))
            $wsql.= " AND add_time>='".date("Y-m-d H:i:s",strtotime($_GET['search_stime']))."'";

        if(!empty($_GET['search_etime']))
            $wsql.= " AND add_time<='".date("Y-m-d H:i:s",strtotime( $_GET['search_etime']."+ 1 day -1second"))."'";

		$search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
		//===================查询 end=========================
		$this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		$sql="select  *  from  ".tab_m('order')."  where  userid='".$this->user_id."'  ".$wsql.$s_status.' order by  id DESC ';
		
		if(!$this->ci_page->__get('totalRows'))
		{
			$query=$this->db->query($sql);
			$this->ci_page->totalRows =$query->num_rows;
		}
		
		$sql.=" limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
		$query=$this->db->query($sql);
		$res=array();
		
		foreach($query->result_array() as $v)
		{
			$res['list'][]=$v;
		}
		
		$res['page']=$this->ci_page->prompt();	
		$this->ci_smarty->assign('re',$res,1,'page');
		
		require(APPPATH.'/config/base_config.php');
		$this->ci_smarty->assign('order_status',$config['order_status']);
		$this->ci_smarty->assign('order_payment_status',$config['order_payment_status']);
		//查询结束
		//***************************
		$this->ci_smarty->display_ini('order_list.htm');
	}
	
	//订单详情显示
	public function  order_info()
	{
		if(!empty($_GET))
		{
			$this->load->library('CI_page');
			$this->ci_page->Page();
			$this->ci_page->url=site_url($this->class."/".$this->method);
			$order_id = $_GET['id']*1;
			$this->ci_page->listRows=5;
			$sql = "select * from ".tab_m('order_pro')." where  userid='".$this->user_id."' and  `order_id`='".$order_id."' order by `sp_uid` desc";
			if(!$this->ci_page->__get('totalRows'))
			{
				$query =$this->db->query($sql);
				$this->ci_page->totalRows = $query->num_rows;
			}
			$sql.=" limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
			$de=$this->db->query($sql)->result_array();
			$res=array();
			if(!empty($de))
			{
				$res['id'] = $order_id;
				//model
				$this->load->model('Base_Order_model');
				$sp_info=$this->Base_Order_model->get_sp_order_info_result('sp_id,warehouse_id,logcs_num,delivery_time',array('order_id'=>$order_id));
	
				foreach($de as $k=> $v)
				{
					$res['order_info'][$k]=$v;
					if($v['status']==2)
					{
						foreach ( $sp_info as $k1=>$v1)
						{
							if($v['warehouse_id']==$v1['warehouse_id'])
							{
								$res['order_info'][$k]['logcs_num']=$v1['logcs_num'];
								$res['order_info'][$k]['delivery_time']=$v1['delivery_time'];
							}
	
						}
	
					}
				}
				$res['page']=$this->ci_page->prompt();
			}
			$this->ci_smarty->assign('re',$res,1,'page');
		}
		$this->ci_smarty->assign('show_ajax','1');
		$this->ci_smarty->display_ini('order_info.htm');
	}
	
	//订单地址
	public function order_address()
	{	
		if(!empty($_POST))
		{
			$this->order_address_edit();
			return;
		}
		
		if(!empty($_GET))
		{	
			//model
			$this->load->model('Base_Order_model');
			$order_id = $_GET['id'];
			$res =array();
			$res['id']=$order_id;
			$res['address']=$this->Base_Order_model->get_order_info('consignee,consignee_address,consignee_mobile,cashflow_id,id,userid'
						     ,array('id'=>$order_id,'userid'=>$this->user_id)
			                );
			if(empty($res['address']))
			{
				show_404();
			}
			$res['district']=$this->get_address_list($this->user_id);
			$this->ci_smarty->assign('re',$res);
		}
		$this->ci_smarty->assign('show_ajax',1);
		$this->ci_smarty->display_ini('order_address.htm');
	}

	//订单地址编辑
	private  function order_address_edit()
	{
		//model
		$this->load->model('Base_Order_model');
		$this->load->model('Base_District_model');
		//订单id
		$seller_order_id=$_POST['id'];
		//表单验证
		$this->load->library('MY_form_validation');
		$this->form_validation->set_rules('sh_address','收货人地址','required');
		if ($this->form_validation->run() == FALSE)
		{
			$msg = array(
				'msg'  => validation_errors("<i class='icon-comment-alt'></i>"),
				'type' => 1
			);
			echo json_encode($msg);
			die;
		}
		else
		{
			$address_id=$this->input->post('sh_address',true);
			if(empty($address_id))
			{
				$msg = array(
					'msg'  => '请选择收货地址',
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}
			//判断供应商状态
			$order_status=$this->Base_Order_model->get_seller_order_status(array('id'=>$seller_order_id,'userid'=>$this->user_id));

			if($order_status['status']==1 && $order_status['payment_status']==0)
			{
				$address_info=$this->Base_District_model->get_row(array('id'=>$address_id,'userid'=>$this->user_id));

				//获取新供应商订单运费
				$sp_order=$this->Base_Order_model->get_sp_order_info_result('warehouse_id,logcs_total_weight,id',array('order_id'=>$seller_order_id));
				$total_seller_logistics_fee=0;
				foreach ($sp_order as $k=>$v)
				{
					$temp_id=$this->search_temp_id($v['warehouse_id'],2,$address_info['provinceid']);
					if($temp_id===FALSE)
					{
						$msg = array(
							'msg'  => '仓库'.$v['warehouse_id'].'无该收货地址的运费模板，请联系管理员',
							'type' => 1
						);
						echo json_encode($msg);
						die;
					}
					else
					{
						$fee=$this->count_logistics_fee($temp_id,$v['logcs_total_weight']);
						$total_seller_logistics_fee+=$fee;
						$this->Base_Order_model->sp_order_update(array('logcs_price'=>$fee),array('id'=>$v['id']));
					}

				}

				$order_info=array(
					'logcs_price'=>$total_seller_logistics_fee,
					'consignee'=>$address_info['name'],
					'consignee_address'=>$address_info['area'].','.$address_info['address'],
					'consignee_mobile'=>$address_info['mobile']
				);
				//修改分销商订单运费
				$res=$this->Base_Order_model->order_update($order_info,array('id'=>$seller_order_id,'userid'=>$this->user_id));

				if( $res )
				{
					$msg = array(
						'msg'  => "操作成功",
						'type' => 3
					);
					echo json_encode($msg);
					die;
				}
				else
				{
					$msg = array(
						'msg'  => '提交失败',
						'type' => 1
					);
					echo json_encode($msg);
					die;
				}
			}
			else
			{
				$msg = array(
					'msg'  => '请刷新页面,再次确认订单状态',
					'type' => 3
				);
				echo json_encode($msg);
				die;
			}
		}

	}

	//订单付款
	public function order_payment()
	{
		if(!empty($_GET))
		{
			//model
			$this->load->model('Base_Order_model');
			$order_id = $_GET['id'];
			$res =array();
			$res['id']=$order_id;
			$res['address']=$this->Base_Order_model->get_order_info('consignee,consignee_address,consignee_mobile,cashflow_id,logcs_price,product_price',array('id'=>$order_id,'userid'=>$this->user_id));
			$this->ci_smarty->assign('re',$res);
		}
		$this->ci_smarty->display('order_payment.htm');
	}
	public function order_payment_done()
	{
		if(!empty($_POST))
		{
			//表单验证
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('cashflow_id','银行流水号','required');
			$this->form_validation->set_rules('payor','支付款方','required');
			if ($this->form_validation->run() == FALSE)
			{
				$msg = array(
					'msg'  => validation_errors("<i class='icon-comment-alt'></i>"),
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}
			else
			{
				//model
				$this->load->model('Base_Order_model');
				$id = $_POST['id'];
				$status=$this->Base_Order_model->get_order_info('status,payment_status',array('id'=>$id,'userid'=>$this->user_id));
				if($status['status']==2 && $status['payment_status']==0)
				{
					$address= array();
					$address['cashflow_id']=$this->input->post('cashflow_id',true);
					$address['payor']=$this->input->post('payor',true);
					$address['payment_status'] = 1;
					$address['pay_uptime'] = date('Y-m-d H:i:s',time());
					$res =  $this->Base_Order_model->order_update($address,array('id'=>$id,'userid'=>$this->user_id));

					if( $res )
					{
						$msg = array(
							'msg'  => "操作成功",
							'type' => 3
						);
						echo json_encode($msg);
						die;
					}
					else
					{
						$msg = array(
							'msg'  => '提交失败',
							'type' => 1
						);
						echo json_encode($msg);
						die;
					}
				}else
				{
					$msg = array(
						'msg'  => '请刷新页面后操作',
						'type' => 1
					);
					echo json_encode($msg);
					die;
				}


			}
		}
	}

	public function order_done()
	{
		if(!empty($_POST))
		{
				//model
				$this->load->model('Base_Order_model');
				$this->load->model('Base_District_model');
				$item=explode("-",$_POST['item']);
				//根据传递查询地址
				$address=$this->Base_District_model->get_row(array('id'=>$_POST['sh_address']*1,'userid'=>$this->user_id));
				if(empty($address))
				{
					$msg = array(
						'msg'  => '请选择正确收货地址',
						'type' => 1
					);
					echo json_encode($msg);
					die;
				}
				$order_list=$this->get_order_list($item);
				$key='order_list';
				$info=$this->explode_order($order_list,$key,$address['provinceid']);

				$new_arr=array();//订单
				$new_arr1=array();//订单详情
				$new_arr2=array();//供应商库存减少
				$new_arr3=array();//供应商订单或对账单
				$new_arr5=array();//日志
				$new_arr['product_price']=$info['total_price'];
				$new_arr['logcs_weight']=$info['total_weight'];
				$new_arr['logcs_price']=$info['total_logistics_fee'];
				$new_arr['consignee'] = $address['name'];
				$new_arr['consignee_mobile'] = $address['mobile'];
				$new_arr['consignee_address'] =$address['area'].$address['address'];
				$new_arr['userid']=$this->user_id;
				$new_arr['add_time']= date('Y-m-d H:i:s',time());

				//减去库存
				$stock_decrease=$this->stock_decrease($order_list);
				if($stock_decrease===TRUE){
					//形成订单
					$order_id=$this->Base_Order_model-> order_add_return_id($new_arr);
					foreach ($order_list as $k=>$v)
					{
						$new_arr1[$k]['sp_id']=$v['sp_id'];
						$new_arr1[$k]['warehouse_id']=$v['warehouse_id'];
						$new_arr1[$k]['sp_uid']=$v['sp_uid'];
						$new_arr1[$k]['stock_id']=$v['stock_id'];
						$new_arr1[$k]['userid']=$this->user_id;
						$new_arr1[$k]['seller_product_id']=$v['id'];
						$new_arr1[$k]['name']=$v['name'];
						$new_arr1[$k]['price']=$v['price'];
						$new_arr1[$k]['sp_price']=$v['sp_price'];
						$new_arr1[$k]['weight']=$v['mz'];
						$new_arr1[$k]['num']=$v['c_num'];
						$new_arr1[$k]['status']=0;
						$new_arr1[$k]['order_id']=$order_id;

					}
					//订单详情
					$res_seller_order=$this->Base_Order_model->order_pro_add($new_arr1);
					//供应商订单
					$new_arr4=array();
					foreach ($info as $k=>$v)
					{
						if($k==$key)
						{
							foreach ($v as $k1=>$v1)
							{
								if(is_numeric($k1))
								{
									$new_arr4[$k1]['warehouse_id']=$k1;
									$new_arr4[$k1]['sp_id']=$v1[0]['sp_uid'];
									$new_arr4[$k1]['order_id']=$order_id;
									$new_arr4[$k1]['sp_total']=$v1['total_sp_price'];
									$new_arr4[$k1]['seller_total']=$v1['total_price'];
									$new_arr4[$k1]['logcs_total_weight']=$v1['total_weight'];
									$new_arr4[$k1]['logcs_price']=$v1['logistics_fee'];
								}
							}
						}

					}
					foreach($new_arr4 as $k=>$v)
					{
						$this->db->insert(tab_m('sp_order'),$v);
						$sp_order_id=$this->db->insert_id();
						foreach ($info[$key][$k] as $k1=>$v1)
						{
							if(is_numeric($k1))
							{
								//供应商订单详情
								$new_arr5['order_id']=$order_id;
								$new_arr5['sp_order_id']=$sp_order_id;
								$new_arr5['order_id']=$v['order_id'];
								$new_arr5['seller_id']=$this->user_id;
								$new_arr5['sp_id']=$v1['sp_uid'];
								$new_arr5['add_time']=date('Y-m-d H:i:s',time());
								$new_arr5['stock_id']=$v1['stock_id'];
								$new_arr5['seller_price']=$v1['price'];
								$new_arr5['sp_price']=$v1['sp_price'];
								$new_arr5['num']=$v1['c_num'];
								$new_arr5['name']=$v1['name'];
								$new_arr5['weight']=$v1['mz'];
								$this->db->insert(tab_m('order_log'),$new_arr5);
							}

						}
					}
					if( $res_seller_order )
					{
						$msg = array(
							'msg'  => "操作成功",
							'type' => 3
						);
						echo json_encode($msg);
						die;
					}
					else
					{
						$msg = array(
							'msg'  => '提交失败',
							'type' => 1
						);
						echo json_encode($msg);
						die;
					}
				}
				else
				{

					$msg = array(
						'msg'  => $stock_decrease,
						'type' => 1
					);
					echo json_encode($msg);
					die;
				}
			}
	}

	//查看流水
	public function order_cash_info()
	{
		if(!empty($_GET))
		{
			//model
			$this->load->model('Base_Order_model');
			$order_id = $_GET['id'];
			$res =array();
			$res['id']=$order_id;
			$res['address']=$this->Base_Order_model->get_order_info('payor,cashflow_id',array('id'=>$order_id,'userid'=>$this->user_id));
			if(empty($res['address']))
			{
				show_404();
			}
			$this->ci_smarty->assign('re',$res);
		}
		$this->ci_smarty->display('order_cash_info.htm');
	}

	//作废订单
	public function order_abolish()
	{
		if(!empty($_GET))
		{
			//model
			$this->load->model('Base_Order_model');
			$order_id = $_GET['id'];

			$order_arr =array();
			$order_arr['status']=-1;
			$arr=$this->Base_Order_model->get_order_pro_info('stock_id,num',array('order_id'=>$order_id,'userid'=>$this->user_id));
			$status=$this->Base_Order_model->get_order_info('status,payment_status',array('id'=>$order_id,'userid'=>$this->user_id));

			//查询状态，防止并发
			if(!empty($arr)&&!empty($status)&&($status['status']!=-1 && $status['payment_status']==0))
			{
				//减去库存
				foreach ( $arr as $k=>$v)
				{
					$this->db->where('stock_id',$v['stock_id']);
					$this->db->set('online_num',"online_num - $v[num]",FALSE);
					$this->db->update(tab_m('sp_product'));
				}
				
				//作废sp_order
				$sql="UPDATE ".tab_m('sp_order')." SET `delivery_status`=-1 WHERE `order_id`=".$order_id;
				$this->db->query($sql);
				//作废日志
				$sql="UPDATE ".tab_m('order_log')." SET `status`=-1 WHERE `order_id`=".$order_id;
				$this->db->query($sql);

				$res =  $this->Base_Order_model->order_update($order_arr,array('id'=>$order_id ));
				if( $res )
				{
					$msg = array(
						'msg'  => "操作成功",
						'type' => 2
					);
					echo json_encode($msg);
					die;
				}
				else
				{
					$msg = array(
						'msg'  => '提交失败',
						'type' => 1
					);
					echo json_encode($msg);
					die;
				}
			}
			else
			{
				$msg = array(
					'msg'  => "请刷新页面后操作",
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}

		}
	}
	
	//确认订单
	public  function  confirm_order()
	{
		if(!empty($_POST))
		{
			$this->ci_smarty->display_ini('confirm_order.htm');
		}
	}

	//购物车列表
	public  function cart_list()
	{	

		if(!empty($_POST))
		{
			
			$this->load->model('Base_District_model');
			if(!empty($_POST['sh_address']))
			{
				//根据传递查询地址
				$default_address=$this->Base_District_model->get_row(array('id'=>$_POST['sh_address'],'userid'=>$this->user_id));
			}
			else
			{
				//查询默认地址
				$default_address=$this->Base_District_model->get_row(array('userid'=>$this->user_id,'default'=>1));
				if(empty($default_address))
				{
					$res['warning']='请先创建收货地址，并设置默认地址';
					$res['disable']=1;
				}
			}

			if(is_array($_POST['item']))
			{
				$item = $_POST['item'];
				$res['item']=implode("-",$_POST['item']);
			}
			else
			{
				$item=explode('-',$_POST['item']);
				$res['item']=$_POST['item'];
			}
			$order_result=$this->get_order_list($item);
			if(is_string($order_result))
			{
				$res['warning']=$order_result;
				$res['disable']=1;
			}
			//拆分订单
			$order=$this->explode_order($order_result,'cart_list',$default_address['provinceid']);
			if(isset($order['msg']))
			{
				$res['warning']=$order['msg'];
				$res['disable']=1;
			}
			$res=array_merge($order,$res);

			//查询收货地址
			$res['district_select']=$default_address['id'];
			$res['district']=$this->get_address_list($this->user_id);
			$this->ci_smarty->assign('re',$res);
			$this->ci_smarty->display_ini('confirm_order.htm');
		}
		else
		{

			//根据当前用户的id 和 仓库id
			$sql="SELECT `a`.`id`,`a`.`warehouse_id`,`a`.`price`,`a`.`status`,`a`.`mark_price`,`a`.`c_num`,`b`.`name`,`b`.`c_num` as num ,`b`.`online_num` FROM ".tab_m('seller_product')." AS `a` LEFT JOIN ".tab_m('sp_product')." AS `b` ON `a`.`stock_id` = `b`.`stock_id`  WHERE
         `a`.`c_num`>0 AND `a`.`userid`=".$this->user_id.' AND `a`.`status`=1 ORDER BY `a`.`warehouse_id` ';
			$sql1="SELECT `warehouse_id` FROM ".tab_m('seller_product')." WHERE `c_num`>0 AND  `userid`=".$this->user_id.' AND `status`=1 GROUP BY  `warehouse_id` ';
			$res['warehouse']=$this->db->query($sql1)->result_array();
			$res['cart_list']=$this->db->query($sql)->result_array();
			$this->ci_smarty->assign('re',$res);
			$this->ci_smarty->display_ini('cart_index.htm');
		}


	}

	//更改购物车数量
	public function cart_change()
	{
		if(!empty($_POST))
		{
			//model
			$this->load->model('Seller_product_model');
			$arr=array();
			$id=$_POST['id']*1;
			$arr['c_num']= $_POST['num']*1;
			$this->Seller_product_model->update_product($arr,array('id'=>$id,'userid'=>$this->user_id));
		}
	}

	//删除某个商品购物车数量
	public function cart_del()
	{
		if(!empty($_POST))
		{
			//model
			$this->load->model('Seller_product_model');
			$id=$_POST['id'];
			$arr['c_num']=0;
			$this->Seller_product_model->update_product($arr,array('id'=>$id,'userid'=>$this->user_id));
		}
	}


	//我的收货地址
	public function delivery_address()
	{
		//model
		$this->load->model('Base_District_model');

		if($_GET['act']=='add_delivery')
		{//添加收货地址页面显示
			$this->ci_smarty->assign('show_ajax',1);
			$this->ci_smarty->display_ini('delivery_add.htm');
			die;
		}
		if($_GET['act']=='edit')
		{
			$res=$this->Base_District_model->get_row(array('id'=>$_GET['id'],'userid'=>$this->user_id));
			$this->ci_smarty->assign('re',$res);
			$this->ci_smarty->assign('show_ajax',1);
			$this->ci_smarty->display_ini('delivery_add.htm');
			die;
		}
		if($_GET['act']=='do_add')
		{//添加收货地址
			$this->add_delivery();
			return;
		}
		if($_GET['act']=='delete')
		{//删除收货地址

			$this->delete_address();
			return;
		}
		if($_GET['act']=='setting_default')
		{//设置为默认地址
			$this->setting_default_address();
			return;
		}
		
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		$wsql=" userid=".$this->user_id;
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar=array('status','id');
			//姓名模糊查询字段
			$search_key_ar_more=array('name');
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
		$this->load->model('Base_page_model');
		if(!$this->ci_page->__get('totalRows'))
		{
			$this->ci_page->totalRows =$this->Base_page_model
				->where($wsql)
				->select_one('a.*',tab_m('delivery_address')." as a ")
				->num_rows();
		}

		$res=array();
		$de=$this->Base_page_model
			->where($wsql)
			->select_one('a.*',tab_m('delivery_address')." as a ")
			->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');
		$res['list']=$de;
		$res['page']=$this->ci_page->prompt();
		$this->ci_smarty->assign('re',$res,1,'page');
		$this->ci_smarty->display_ini('delivery_address.htm');
	}


	/**
	 * 添加编辑收货地址
	 */
	public function add_delivery()
	{
		$this->load->library('MY_form_validation');
		$this->form_validation->set_rules('name','收件人','required');
		$this->form_validation->set_rules('mobile','手机号','required');
		$this->form_validation->set_rules('zip','邮政编码','required');
		$this->form_validation->set_rules('t','省市县','required');
		$this->form_validation->set_rules('province','省','required');
		$this->form_validation->set_rules('city','市','required');
		$this->form_validation->set_rules('area','县区','required');
		$this->form_validation->set_rules('address','详细地址','required');

		if ($this->form_validation->run() == FALSE)
		{
			$msg = array(
				'msg'  => validation_errors("<i class='icon-comment-alt'></i>"),
				'type' => 1
			);
			echo json_encode($msg);
			die;
		}
		else
		{
			$district['name']=$this->input->post('name',true);
			$district['mobile']=$this->input->post('mobile',true);
			$district['provinceid']=$this->input->post('province',true);
			$district['cityid']=$this->input->post('city',true);
			$district['areaid']=$this->input->post('area',true);
			$district['area']=$this->input->post('t',true);
			$district['address']=$this->input->post('address',true);
			$district['zip']=$this->input->post('zip',true);
			$district['userid']=$this->user_id;
			$result=$this->Base_District_model->check_addrtcode($district['area']);

			if(!is_array($result))
			{
				$msg = array(
					'msg'  => $result,
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}
			if($_POST['default'])
			{
				$this->Base_District_model->set_default_address($this->user_id);
				$district['default']=$this->input->post('default',true);
			}
			else
			{
				$district['default']=0;
			}
			$district['address']=$this->input->post('address',true);

			if(!empty($_POST['id']))
			{
				$res=$this->Base_District_model->update($district,array('id'=>$_POST['id'],'userid'=>$this->user_id));
			}
			else
			{
				$res=$this->Base_District_model->insert($district);
			}

			if( $res )
			{
				$msg = array(
					'msg'  => '操作成功',
					'type' => 3,
				);
				echo json_encode($msg);
				die;
			}
			else
			{
				$msg = array(
					'msg'  => '操作失败',
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}

		}
	}

	/**
	 * 删除收货地址
	 */
	private  function delete_address()
	{
		//不能删除默认地址
		$district=$this->Base_District_model->get_row(array('id'=>$_GET['id'],'userid'=>$this->user_id));
		if($district['default']==1)
		{
			$address=$this->Base_District_model->get_list(array('userid'=>$this->user_id));
			$num=count($address);
			if($num>1)
			{
				$msg = array(
					'msg'  => '请先设置一个默认地址,再删除该地址',
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}

		}
		$res=$this->Base_District_model->delete(array('id'=>$_GET['id'],'userid'=>$this->user_id));
		if( $res )
		{
			$msg = array(
				'msg'  => '操作成功',
				'type' => 3,
			);
			echo json_encode($msg);
			die;
		}
		else
		{
			$msg = array(
				'msg'  => '操作失败',
				'type' => 1
			);
			echo json_encode($msg);
			die;
		}
	}

	/**
	 * 设置为默认地址
	 */
	private function setting_default_address()
	{
		$this->Base_District_model->set_default_address($this->user_id);
		$res=$this->Base_District_model->update(array('default'=>1),array('id'=>$_GET['id'],'userid'=>$this->user_id));
		if( $res )
		{
			$msg = array(
				'msg'  => '操作成功',
				'type' => 3,
			);
			echo json_encode($msg);
			die;
		}
		else
		{
			$msg = array(
				'msg'  => '操作失败',
				'type' => 1
			);
			echo json_encode($msg);
			die;
		}
	}

	/**
	 * 查找运费id
	 * @param $warehouse_id
	 * @param $type
	 * @param $city_id
	 * @return mixed
	 */
	private  function search_temp_id($warehouse_id,$type,$city_id)
	{
		//model
		$this->load->model('Admin_Warehouse_model');
		$this->load->model('Base_Logistics_model');
		//首先确定发货的是哪个仓库,根据仓库查找运费模板(批发、零售)
		if($type==1)
		{//零售
			$field='logistics_temp_id_ls';
		}
		elseif ($type==2)
		{//批发
			$field='logistics_temp_id';
		}
		$temp=$this->Admin_Warehouse_model->get_warehouse($warehouse_id,$field);

		$temp['id']=$temp[$field];
		//根据运费模板id  查询相应城市的运费的运费模板
		$t=$this->Base_Logistics_model->get_con_row(array('temp_id'=>$temp['id'],'define_cityid'=>$city_id));
		if(empty($t))
		{
			return FALSE;
		}
		return $t['id'];
	}


	/**
	 * 计算运费的方法
	 * @param $temp_id
	 * @param $weight
	 * @return mixed
	 */
	
	private function count_logistics_fee($temp_id,$weight)
	{
		//model
		$this->load->model('Base_Logistics_model');
		//首先要知道用的是哪个运费模板
		$logistics=$this->Base_Logistics_model->get_con_row(array('id'=>$temp_id));
		//运单重量,根据重量计算运费
		$log=array();
		if($weight<=$logistics['default_num'])
		{
			$log['fee']=$logistics['default_price'];
		}
		else
		{
			$log['fee']=ceil(($weight-$logistics['default_num'])/$logistics['add_num'])*$logistics['add_price']+$logistics['default_price'];
		}

		//返回运费
		return  round($log['fee'],2) ;
	}

	/**
	 * 查找订单列表
	 * @param $item
	 * @return array|bool
	 */
	private function get_order_list($item)
	{
		if(!is_array($item))
		{
			return FALSE;
		}
		$result = array();
		
		foreach ($item as $k=>$v)
		{
			$sql="SELECT `a`.`id`,`a`.`warehouse_id`,`a`.`status`,`a`.`price`,`a`.`mark_price`,`a`.`c_num`,`b`.`name`
				, `b`.`c_num` as num ,`c`.`mz`,`a`.`stock_id`,`b`.`price` AS sp_price,`b`.`userid` AS sp_uid,`b`.`id` AS sp_id 
				FROM ".tab_m('seller_product')." AS `a` LEFT JOIN ".tab_m('sp_product')." AS `b` ON `a`.`stock_id` = `b`.`stock_id` 
				LEFT JOIN ".tab_m('stock')."  AS `c` ON `c`.`id`=`a`.`stock_id`  WHERE
				`a`.`id`=".$v.' AND `a`.`status`=1 ';
			$result[$k]=$this->db->query($sql)->row_array();
		}
		foreach ($result as $k=>$v)
		{
			if($v['c_num']>$v['num'])
			{
				return '商品'.$v['name'].'库存不足';
			}
		}

		return $result;
	}


	/**
	 * 拆分订单  按照仓库拆分  主要用于购物车  和  形成供应商订单
	 * @param $item
	 * @param $key
	 * @return bool
	 */
	private function explode_order($item,$key,$provice_id)
	{
		$res[$key]=array();
		$msg='';
		foreach( $item  as $k =>$v)
		{
			$res[$key][$v['warehouse_id']][]= $v;
			if($this->search_temp_id($v['warehouse_id'],2,$provice_id)===FALSE)
			{
				$msg= '仓库'.$v['warehouse_id'].',暂无匹配该收货地址的运费模板，请联系网站管理员';
				$res[$key][$v['warehouse_id']]['warehouse_logstics']= '无匹配该收货地址的运费模板';

			}
			else
			{
				$temp_id=$this->search_temp_id($v['warehouse_id'],2,$provice_id);
				//model
				$this->load->model('Base_Logistics_model');
				$info=$this->Base_Logistics_model->get_con_row(array('id'=>$temp_id));
				if($info['status']!=1)
				{
					$msg= '仓库'.$v['warehouse_id'].',匹配的收货地址的运费模板还未通过审核，请联系网站管理员';
					$res[$key][$v['warehouse_id']]['warehouse_logstics']= '收货地址运费模板未通过审核';

				}
			}

		}
		$res['total_weight']=0;
		$res['total_price']=0;
		$res['total_logistics_fee']=0;
		//按仓库分订单  每个订单重量小计  价格小计
		foreach ( $res[$key] as $k=>$v)
		{
			$total_weight=0;
			$total_price=0;
			$total_sp_price=0;
			foreach ($v as $k1=>$v1)
			{
				$total_weight+=($v1['mz']*$v1['c_num']);
				$total_price+=($v1['price']*$v1['c_num']);
				$total_sp_price+=($v1['sp_price']*$v1['c_num']);
			}
			$res['total_weight']+=$total_weight;
			$res['total_price']+=$total_price;
			$res[$key][$k]['total_weight']=$total_weight;
			$res[$key][$k]['total_price']=$total_price;
			$res[$key][$k]['total_sp_price']=$total_sp_price;
			if(isset($v['warehouse_logstics']))
			{
				$res[$key][$k]['logistics_fee']=0;
			}else
			{
				$res[$key][$k]['logistics_fee']=$this->count_logistics_fee($this->search_temp_id($k,2,$provice_id),$res[$key][$k]['total_weight']);

			}
			$res['total_logistics_fee']+=$res[$key][$k]['logistics_fee'];
		}
		$msg=='' OR $res['msg']=$msg;
		return $res;

	}

	/**
	 * 删减库存
	 * @param $arr  下单的商品数组
	 * @return bool
	 */
	private function stock_decrease($arr)
	{
		$mark=1;
		$new_arr=array();
		foreach ( $arr as $k=>$v)
		{
			$sql='SELECT `online_num`,`c_num`,`name` FROM '.tab_m('sp_product').' WHERE `stock_id`='.$v['stock_id'];
			$in=$this->db->query($sql)->row_array();
			if($in['online_num']+$v['c_num']>$in['c_num'])
			{
				//如果下单数量 + 交易进行数已下单 > 库存数   说明库存不足
				$mark=2;
				return $v['name'].'库存不足';
			}
			$new_arr[$k]=$v;
		}

		if($mark==1)
		{
			foreach ( $new_arr as $k=>$v)
			{
				$this->db->where('stock_id',$v['stock_id']);
				$this->db->set('online_num',"online_num + $v[c_num]",FALSE);
				$this->db->update(tab_m('sp_product'));
			}
			return TRUE;
		}
	}

	/**
	 * 获取地址列表
	 * @param $userid
	 * @return mixed
	 */
	private function get_address_list($userid)
	{
		if(empty($userid))
		{
			return FALSE;
		}
		//model
		$this->load->model('Base_District_model');
		//查询收货地址
		$address=$this->Base_District_model->get_list(array('userid'=>$userid));
		return $address;
	}


}
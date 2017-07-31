<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Order extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty');
		$this->load_sp_menu();   
		//$this->load->model('Admin_Spuser_model');
		$this->load->model('Base_Orderls_model');

		//model
		$this->load->model('Seller_product_model');
		$this->load->model('Sp_Product_model');
	}
	
	//订单列表
	public function order_list()
	{         
        //***************************
		//         查询开始	
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		$wsql=' a.`sp_id`='.$this->user_id;
		//if(!isset($_GET['search_delivery_status']) || in_array($_GET['search_delivery_status'],array('','all')))
		//	$wsql.=' AND a.`delivery_status`!=-1';
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar=array('reconciliation_status','delivery_status','consignee_mobile','id');
			//姓名模糊查询字段
			$search_key_ar_more=array('');
			foreach($_GET as $k=>$v)
			{
				$skey=substr($k,7,strlen($k)-7);  
				if($k!='search_page_num'&&substr($k,0,7)=='search_'&&!in_array($v,array('all','')))
				{
					//非模糊查询
					if(in_array($skey,$search_key_ar))
					{
						if($skey=='consignee_mobile')
						{
							$wsql.=" and b.{$skey}='{$v}'";
						}else
						{
							$wsql.=" and a.{$skey}='{$v}'";
						}



					}

					//模糊查询
					if(in_array($skey,$search_key_ar_more))
						$wsql.=" and a.{$skey} like '%{$v}%'";

				}
			}
		}
		
   
        if(!empty($_GET['search_stime']))
            $wsql.= " AND delivery_time>='".date("Y-m-d H:i:s",strtotime($_GET['search_stime']))."'";

        if(!empty($_GET['search_etime']))
            $wsql.= " AND delivery_time<='".date("Y-m-d H:i:s",strtotime( $_GET['search_etime']."+ 1 day -1second"))."'";
		$search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
		//===================查询 end=========================
		$this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		$this->load->model('Base_page_model');
		if(!$this->ci_page->__get('totalRows'))
		{
			$this->ci_page->totalRows =$this->Base_page_model
                ->where($wsql)
                ->select_one('a.*,b.consignee,b.consignee_address,b.consignee_mobile,b.status,b.payment_status',tab_m('sp_order')." as a ")
				->left_join(tab_m('order').' as b','a.order_id=b.id')
                ->num_rows();
		}
		
        $res=array();
        $de=$this->Base_page_model
            ->where($wsql)
			->select_one('a.*,b.consignee,b.consignee_address,b.consignee_mobile,b.status,b.payment_status',tab_m('sp_order')." as a ")
			->left_join(tab_m('order').' as b','a.order_id=b.id')
            ->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');
		$res['list']=$de;
		$res['page']=$this->ci_page->prompt();	
		$this->ci_smarty->assign('re',$res,1,'page');
		require(APPPATH.'/config/base_config.php');
		$this->ci_smarty->assign('reconciliation_status',$config['reconciliation_status']);
		$this->ci_smarty->assign('delivery_status',$config['delivery_status']);
		//查询结束
		//***************************
		$this->ci_smarty->display_ini('order_list.htm');
	}

    //订单列表
	public function ls_order_list()
	{         
        //***************************
		//         查询开始	
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		$wsql=' a.`sp_userid`='.$this->user_id;
		//if(!isset($_GET['search_status']) || in_array($_GET['search_status'],array('','all')))
		//	$wsql.=' AND a.`status`!=-1';
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar=array('status','id');
			//姓名模糊查询字段
			$search_key_ar_more=array('');
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
        if(!empty($_GET['search_stime']))
            $wsql.= " AND delivery_time>='".date("Y-m-d H:i:s",strtotime($_GET['search_stime']))."'";

        if(!empty($_GET['search_etime']))
            $wsql.= " AND delivery_time<='".date("Y-m-d H:i:s",strtotime( $_GET['search_etime']."+ 1 day -1second"))."'";
		$search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
		//===================查询 end=========================
		$this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		$this->load->model('Base_page_model');
		if(!$this->ci_page->__get('totalRows'))
		{
			$this->ci_page->totalRows =$this->Base_page_model
                ->where($wsql)
                ->select_one('a.*',tab_m('order_ls')." as a ")
                ->num_rows();
		}
		
        $res=array();
        $res['list']=$this->Base_page_model
            ->where($wsql)
            ->select_one('a.*',tab_m('order_ls')." as a ")
            ->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');
		foreach($res['list'] as $k=>$v)
		{
			$res['list'][$k]['pro']=$this->Base_Orderls_model->get_pro_list('*',array('order_id'=>$v['id']),'id desc');
		}
		
		$res['page']=$this->ci_page->prompt();	
		$this->ci_smarty->assign('re',$res,1,'page');

		require(APPPATH.'/config/base_config.php');
		$this->ci_smarty->assign('delivery_status',$config['ls_order_status']);
		//查询结束
		//***************************
		$this->ci_smarty->display_ini('order_list_ls.htm');
	}

	/**
	 * 作废订单
	 */
	public function order_ls_invalid()
	{

		if(!empty($_POST))
		{
			$ids=$_POST['id'];
			$reason=$_POST['rea'];
			$invalid_time=dateformat(time());
			$item=array_filter(explode(',',$ids));
			$flag=TRUE;
			foreach ($item as $k=>$v)
			{
				$info=$this->Base_Orderls_model->get_row('status',array('id'=>$v));
				$info['status']!=1  &&  $flag=FALSE;
			}
			if($flag===FALSE)
			{
				$msg = array(
					'msg'  => '只有待发货订单可以作废',
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}

			foreach ( $item as $k=>$v)
			{
				$v*=1;
				if(empty($v))
					continue;
				$res=$this->Base_Orderls_model->update(array('close_con'=>$reason,'close_time'=>$invalid_time,'status'=>-1),array('id'=>$v,'sp_userid'=>$this->user_id));
				if(!empty($res))
				{
					$this->Base_Orderls_model->update_pro(array('status'=>-1),array('order_id'=>$v));
					//当作废订单的时候
					$ls_order_pro=$this->Base_Orderls_model->get_pro_list('stock_id,num',array('order_id'=>$v));
					foreach($ls_order_pro as $k1=>$v1)
					{
						$sql=" UPDATE ".tab_m('seller_product')." SET  `online_num`=`online_num`-".$v1['num']." WHERE `userid`=2 AND `stock_id`=".$v1['stock_id'];
						$this->Seller_product_model->update_product_sql($sql);
					}
				}
			}

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
					'msg'  => '操作失败',
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}
		}

	}



	//订单详情显示
	public function  order_info()
	{
		if(!empty($_GET))
		{
			$this->load->library('CI_page');
			$this->ci_page->Page();
			$this->ci_page->url=site_url($this->class."/".$this->method);
			$sp_order_id = $_GET['id'];
			$this->ci_page->listRows=5;
			$sql = "select a.*,b.barcode from ".tab_m('order_log')." as a left join ".tab_m('stock')." as b on a.stock_id=b.id   where `sp_order_id`=".$sp_order_id;
			if(!$this->ci_page->__get('totalRows'))
			{
				$query =$this->db->query($sql);
				$this->ci_page->totalRows = $query->num_rows;
			}
			$sql.=" limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
			$query=$this->db->query($sql);
			$res=array();
			$res['id'] = $sp_order_id;
			foreach($query->result_array() as $v)
			{
				$res['order_info'][]=$v;
			}
			$res['sp_order_id']=$sp_order_id;
			$sql="select `order_id` from ".tab_m('sp_order')." where id=".$sp_order_id;
			$order=$this->db->query($sql)->row_array();
			$sql1="select `consignee`,`consignee_address`,`consignee_mobile` from ".tab_m('order')." where id=".$order['order_id'];
			$res['order_address']=$this->db->query($sql1)->row_array();
			$res['page']=$this->ci_page->prompt();
			$this->ci_smarty->assign('re',$res,1,'page');
		}
		$this->ci_smarty->assign('show_ajax','1');
		$this->ci_smarty->display_ini('order_info.htm');
	}

	/**
	 * 供应商订单Excel导出
	 */
	public function order_table_upload()
	{
		if(!empty($_GET['temp_id']))
		{
			//model
			$this->load->model('Base_Order_model');
			$sp_order_id = $_GET['temp_id'];
			$order_title=array('产品名','条形码','供应价','数量');
			$sql="select a.name,b.barcode,a.sp_price,a.num from ".tab_m('order_log')." as a left join ".tab_m('stock')." as b on a.stock_id=b.id   where a.`sp_order_id`=".$sp_order_id.' and a.sp_id='.$this->user_id;
			$order_value=$this->db->query($sql)->result_array();
			if(empty($order_value))
			{
				show_404();
			}
			$CI = & get_instance();
			$CI->load->library('CI_xls');
			$this->ci_xls->set_data($order_title,1,1,'供应商订单');
			$order_value1=array_map(function($m){
				$arr=array();
				foreach ($m as $k=>$v)
				{
					$arr[]=$v;
				}
				return $arr;
			},$order_value);
			$j=1;
			foreach($order_value1 as $k=>$v)
			{

				$this->ci_xls->set_data($v,$j+1,1);
				$j++;
			}
			$sql="select `order_id` from ".tab_m('sp_order')." where id=".$sp_order_id;
			$order=$this->db->query($sql)->row_array();
			$sql1="select `consignee`,`consignee_address`,`consignee_mobile` from ".tab_m('order')." where id=".$order['order_id'];
			$order=$this->db->query($sql1)->row_array();
			$this->ci_xls->set_data(array(),$j+1,1);
			$orderinfo_title = array('供应商订单号','收货人','收货人地址','收货人手机');
			$this->ci_xls->set_data($orderinfo_title,$j+2,1);
			$this->ci_xls->set_data(array($sp_order_id,$order['consignee'],$order['consignee_address'],$order['consignee_mobile']),$j+3,1);
			$this->ci_xls->get_down_xls('供应商订单编号'.$sp_order_id);
			die;
		}
	}
	
	
	public function ls_order_delivery()
	{
		if(!empty($_GET))
		{
			$sp_order_id= $_GET['id'];
			$this->load->model('Base_Logistics_model');
			$res['sp_order']=$this->Base_Orderls_model->get_list('logcs_price,consignee,consignee_address,consignee_mobile,logistics_no,logcs_weight,order_id',array('id'=>$sp_order_id,'sp_userid'=>$this->user_id));
			if(empty($res['sp_order']))
			{
				show_404();
			}
			//model
			$res['id']=$sp_order_id;
			$res['logistics']= $this->Base_Logistics_model->logccom_list();
			$this->ci_smarty->assign('re',$res);
			$this->ci_smarty->assign('show_ajax',1);
			$this->ci_smarty->display_ini('ls_order_delivery.htm');
		}
		if(!empty($_POST))
		{
			//表单验证
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('logcs_num','运单号','required|alpha_numeric');
			$this->form_validation->set_rules('logistics_type','运单类型','required');
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
				$order_id=$_POST['id'];
				//查询零售订单状态
				$info=$this->Base_Orderls_model->get_row('status',array('id'=>$order_id,'sp_userid'=>$this->user_id));
				if(empty($info) && $info['status']!=1)
				{
					$msg = array(
						'msg'  => '请刷新主页面查看订单是否为待发货状态',
						'type' => 1
					);
					echo json_encode($msg);
					die;
				}
				$ls_order_arr['logistics_no'] = $this->input->post('logcs_num',true);
				$ls_order_arr['logistics_type'] = $this->input->post('logistics_type',true);
				$ls_order_arr['status']=2;
				$ls_order_arr['f_time']=dateformat(time());
				//查询订单下面包含的商品详情
				$ls_order_pro=$this->Base_Orderls_model->get_pro_list('stock_id,num',array('order_id'=>$order_id,'sp_uid'=>$this->user_id));
				//修改seller_product表  分销订阅库   零售情况下
				/**
				 * 零售订单在发货时需要修改 两个表中的7个字段
				 * seller_product表中的
				 * 销售数字sell_num +  发货数量
				 * 零售锁定库存数 ls_lock_num - 发货数量
				 * 待发货数量  online_num - 发货数量
				 *
				 * sp_product表中的
				 * 零售锁定库存数 ls_lock_num -发货数量
				 * 库存占用数 online_num - 发货数量
				 * 库存数量  c_num - 发货数量
				 * 销售数量 sell_num + 发货数量
				 *
				 */
				foreach ($ls_order_pro as $k=>$v)
				{
					$sql=" UPDATE ".tab_m('seller_product')." SET `sell_num`=`sell_num`+".$v['num'].", `ls_lock_num`=`ls_lock_num`-".$v['num']." ,  `online_num`=`online_num`-".$v['num']." WHERE `userid`=2 AND `stock_id`={$v['stock_id']} ";
					$this->Seller_product_model->update_product_sql($sql);
					$sql2="UPDATE ".tab_m('sp_product')." SET  `ls_lock_num`=`ls_lock_num`-{$v['num']} , `online_num`=`online_num`-{$v['num']}, `c_num`=`c_num`-{$v['num']},`sell_num`=`sell_num`+".$v['num']."   WHERE  `stock_id`={$v['stock_id']}  ";
					$this->Sp_Product_model->update_product_sql($sql2);
				}
				$res1=$this->Base_Orderls_model->update($ls_order_arr,array('id'=>$order_id,'sp_userid'=>$this->user_id));
				$res2=$this->Base_Orderls_model->update_pro(array('status'=>2),array('order_id'=>$order_id,'sp_uid'=>$this->user_id));

				if( $res1 && $res2 )
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
		}
	}
	
	public function order_delivery()
	{
		if(!empty($_GET))
		{
			$sp_order_id= $_GET['id'];
			$this->load->model('Base_Order_model');
			$this->load->model('Base_Logistics_model');
			if($_GET['type']=='ls')
			{
				$res['sp_order']=$this->Base_Orderls_model->get_list('logcs_price,logistics_no,logcs_weight,order_id',array('id'=>$sp_order_id));

			}
			else
			{
				$res['sp_order']=$this->Base_Order_model->get_sp_order_info('logcs_price,logcs_num,logcs_total_weight,order_id',array('id'=>$sp_order_id,'sp_id'=>$this->user_id));
				if(empty($res['sp_order']))
				{
					show_404();
				}
				$res['order']=$this->Base_Order_model->get_order_info('consignee,consignee_address,consignee_mobile',array('id'=>$res['sp_order']['order_id']));
			}


			//model
			$res['id']=$sp_order_id;
			$res['logistics']= $this->Base_Logistics_model->logccom_list();

			$this->ci_smarty->assign('re',$res);
			$this->ci_smarty->assign('show_ajax',1);
			$this->ci_smarty->display_ini('order_delivery.htm');
		}

		if(!empty($_POST))
		{
			$sp_order_id=$_POST['id'];
			//model
			$this->load->model('Base_Order_model');
			if($_POST['is_delivery']=='all')
			{
				$msg = array(
					'msg'  => '请选择是否发货',
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}
			//表单验证
			$this->load->library('MY_form_validation');
			if($_POST['is_delivery']=='1')
			{
				$this->form_validation->set_rules('logcs_num','运单号','required');
				$this->form_validation->set_rules('logistics_type','运单类型','required');
			}
			if($_POST['is_delivery']=='0')
			{
				$this->form_validation->set_rules('remark','备注信息','required');
			}

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
				if($_POST['is_delivery']=='1')
				{
					$order_id=$this->Base_Order_model->get_sp_order_info('order_id',array('id'=>$sp_order_id,'sp_id'=>$this->user_id));
					if(empty($order_id))
					{
						$msg = array(
							'msg'  => '提交失败',
							'type' => 1
						);
						echo json_encode($msg);
						die;
					}
					$id =$order_id['order_id'];
					$status=$this->Base_Order_model->get_order_info('status,payment_status',array('id'=>$id));
					$sp_status=$this->Base_Order_model->get_sp_order_info('delivery_status',array('id'=>$sp_order_id,'sp_id'=>$this->user_id));
					if(!empty($status) && !empty($sp_status) && $sp_status['delivery_status']==0 && $status['payment_status']==2 && ($status['status']==2 ||$status['status']==3))
					{
						$sp_arr['logcs_num'] = $this->input->post('logcs_num',true);
						$sp_arr['logistics_type'] = $this->input->post('logistics_type',true);
						$sp_arr['delivery_status']=1;
						$sp_arr['delivery_time']=date('Y-m-d H:i:s',time());
						$res=$this->Base_Order_model->sp_order_delivery($sp_arr,$sp_order_id,$this->user_id);
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
							'msg'  => '请刷新页面后操作',
							'type' => 1
						);
						echo json_encode($msg);
						die;
					}
				}


				if(($_POST['is_delivery']=='0'))
				{
					$order_info=$this->Base_Order_model->get_sp_order_info('order_id,delivery_status',array('id'=>$sp_order_id,'sp_id'=>$this->user_id));
					if(empty($order_info))
					{
						$msg = array(
							'msg'  => '提交失败',
							'type' => 1
						);
						echo json_encode($msg);
						die;
					}
					$id =$order_info['order_id'];
					$status=$this->Base_Order_model->get_order_info('status,payment_status,,userid',array('id'=>$id));
					$sp_status=$order_info['delivery_status'];
					if(!empty($status)  && $sp_status==0 && $status['payment_status']==2 && ($status['status']==2 ||$status['status']==3))
					{
						$remark_arr=array();
						$remark_arr['remark']=$this->input->post('remark',true);
						$remark_arr['delivery_status']=-1;

						$res=$this->Base_Order_model->sp_order_abolish($remark_arr,$sp_order_id,$this->user_id);

					}
					else
					{
						$msg = array(
							'msg'  => '请刷新页面后操作',
							'type' => 1
						);
						echo json_encode($msg);
						die;
					}
				}
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
		}


	}


}
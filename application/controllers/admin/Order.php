<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Order extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('CI_Smarty');
        $this->load_sp_menu();
        //零售订单模型
        $this->load->model('Base_Orderls_model');
        $this->load->model('Seller_product_model');
        $this->load->model('Sp_Product_model');
    }

	 //订单列表
    public function order_list_ls()
    {
        //***************************
        //         查询开始	
        $this->load->library('CI_page');
        $this->ci_page->Page();
        $this->ci_page->url=site_url($this->class."/".$this->method);

		$wsql=" 1=1 ";
			 
        if(isset($_GET))
        {
            //非模糊查询的字段
            $search_key_ar=array('status','payment_status','id','sp_userid');
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
                    }

                    //模糊查询
                    if(in_array($skey,$search_key_ar_more))
                    {
                        $wsql.=" and {$skey} like '%{$v}%'";
                    }
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
        $sql="select  *  from  ".tab_m('order_ls')." WHERE ".$wsql.' order by  id DESC ';

        if(!$this->ci_page->__get('totalRows'))
        {
            $query=$this->db->query($sql);
            $this->ci_page->totalRows =$query->num_rows;
        }

        $sql.=" limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
        $query=$this->db->query($sql);
        $res=array();

        foreach($query->result_array() as $k=>$v)
        {
            $res['list'][$k]=$v;
            $sql='SELECT company from '.tab_m('seller_user').' WHERE id='.$v['userid'];
            $company=$this->db->query($sql)->row_array();
            $res['list'][$k]['seller']=$company['company'];
        }

        $res['page']=$this->ci_page->prompt();
        $this->ci_smarty->assign('re',$res,1,'page');

        require(APPPATH.'/config/base_config.php');
        $this->ci_smarty->assign('order_status',$config['order_status']);
        $this->ci_smarty->assign('order_payment_status',$config['order_payment_status']);
        //查询结束
        //***************************
        $this->ci_smarty->display_ini('order_list_ls.htm');
    }

    public function order_ls_info()
    {
        $order_id=$this->input->get('id',true);
        //$res=$this->Base_Orderls_model->get_pro_list('*',array('order_id'=>$order_id),'id desc');
        $this->load->library('CI_page');
        $this->ci_page->Page();
        $this->ci_page->url=site_url($this->class."/".$this->method);
        $wsql='a.order_id='.$order_id;
        //===================查询 end=========================
        $this->ci_page->listRows=5;
        $this->load->model('Base_page_model');
        if(!$this->ci_page->__get('totalRows'))
        {
            $this->ci_page->totalRows =$this->Base_page_model
                ->where($wsql)
                ->select_one('a.*',tab_m('order_pro_ls')." as a ")
                ->num_rows();
        }

        $res=array();
        $de=$this->Base_page_model
            ->where($wsql)
            ->select_one('a.*',tab_m('order_pro_ls')." as a ")
            ->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');

        $res['list']=$de;
        $res['page']=$this->ci_page->prompt();
        $this->ci_smarty->assign('re',$res,1,'page');
        $this->ci_smarty->assign('show_ajax','1');
        $this->ci_smarty->display_ini('order_ls_info.htm');
    }

    //------------------------
	//账期审核
	public function order_accountperiod()
	{
		//审核分期付款 每笔账
		//如果付最后1笔款的时候 改为付款完毕
		if(!empty($_POST['act_type']))
		{
			$id=$_POST['id']*1;
			
			if($id)
			{
				$status=$_POST['act_type']*1;  //3=通过 -1=不通过
				
				$price=$_POST['payment_money'];
				$this->load->model('Base_update_model');
				
				if(in_array($status,array(-1,3)))
				{
					$flag=$this->Base_update_model->update_sql("update  ".tab_m('order_accountperiod')
						  ."  set  payment_money='".$price."',status='$status'  where  id='$id' and status=2  ");
					$price1=",payment_money=payment_money+".$price;	  
				//未付款
				}
				elseif($status==-2)
				{
					$flag=$this->Base_update_model->update_sql("update  ".tab_m('order_accountperiod')
						  ."  set  payment_money='".$price."',status='$status'  where  id='$id' and status=1  ");
					$price1='';	  	  
				}
				//查询下次付款时间 
				if($flag)
				{
					$dd=$this->db->query("SELECT  `order_id`  FROM ".tab_m('order_accountperiod')." WHERE  id=".$id."  ")->row_array();
					$da=$this->db->query("SELECT  `AccountPeriod_time`  FROM  " 
					    .tab_m('order_accountperiod')."  WHERE  `order_id`=".$dd['order_id']." and status in (-1,1)  order by  q_num asc ")->row_array();
					$d=$this->db->query("SELECT  `id`  FROM  " .tab_m('order_accountperiod')." WHERE  `order_id`=".$dd['order_id']." and status=2  ")->row_array();
					
					//有款未确认
					if(!empty($d))	
						$flag=$this->Base_update_model->update_sql("update  ".tab_m('order')
					          ."  set  AccountPeriod_End_Time='".$da['AccountPeriod_time']."'".$price1.",payment_status=1   where  id=".$dd['order_id']."  "); 
					//无已付款账单
					elseif(!empty($da)) 
						$flag=$this->Base_update_model->update_sql("update  ".tab_m('order')
					          ."  set  AccountPeriod_End_Time='".$da['AccountPeriod_time']."'".$price1.",payment_status=0    where  id=".$dd['order_id']."  "); 
					else
					{
						//查询分期付款内容
						$dnum=$this->db->query("SELECT  count(*) as num  FROM  " 
					          .tab_m('order_accountperiod')."  WHERE  `order_id`=".$dd['order_id']." and status=3   ")->row_array();
						
						if($dnum['num']==0)
							$flag=$this->Base_update_model->update_sql("update  ".tab_m('order')
					               ."  set  AccountPeriod_End_Time=NULL,AccountPeriod_status=3,payment_status=0".$price1."  where  id=".$dd['order_id']."  "); 
					    else
							$flag=$this->Base_update_model->update_sql("update  ".tab_m('order')
					               ."  set  AccountPeriod_End_Time=NULL,AccountPeriod_status=3,payment_status=2".$price1."  where  id=".$dd['order_id']."  "); 		   
					}
				}
				
				$msg = array(
								'msg'  => "操作成功",
								'type' => 2
							   );
				echo json_encode($msg);
				die;
				
			}
		}
		
		if(!empty($_GET['id']))
		{
			$this->load->model('Base_Order_model');
			$id = $_GET['id']*1;
			$res=$this->Base_Order_model->get_order_info('userid,AccountPeriod_status,AccountPeriod_type,id,status
			      ,logcs_price,product_price,status,AccountPeriod_End_Time,logcs_weight,',array('id'=>$id));
			$company = $this->db->query("SELECT `company` FROM " . tab_m('seller_user') . " WHERE id=" . $res['userid'])->row_array();
			$res['company']=$company['company'];
			$this->ci_smarty->assign('re',$res);
			$dd=$this->db->query("SELECT `order_id`,`id`,`userid`, `AccountPeriod_moeny`,`payment_money`, `payment_time`, `AccountPeriod_time`,`q_num`,`cashflow_id`,`payor`,`status` 
			                      FROM " . tab_m('order_accountperiod')." WHERE order_id=".$id."  order  by q_num asc")->result_array();
			$this->ci_smarty->assign('accountperiod',$dd);				 
		}
	    
		//初审分期 设定最近需要付款时间		
        if(!empty( $_POST['act']))
        {
            $this->load->model('Base_Order_model');
            $AccountPeriod_status = $_POST['act']*1;
            $order_id=$_POST['id'];
            $d=$this->Base_Order_model->get_order_info('status,userid,product_price,logcs_price,payment_status,AccountPeriod_status,AccountPeriod_type',array('id'=>$order_id));
            if($d['AccountPeriod_status']<2 )
            {
				//判断前面是否有未付款的内容。。。。。如有不能审核通过
				$this->load->model('Order_accountperiod_model');
				if($AccountPeriod_status==2)
				{
					$de=$this->db->query("select  id  from   ".tab_m('order_accountperiod')."   where  userid='".$d['userid']."' and  status in(0,1)  ")->row_array();
					if(!empty($de['id']))
					{
						$msg = array(
								'msg'  => "有分期未付款",
								'type' => 1
							   );
						echo json_encode($msg);
						die;
					}
				}
				
                $res=$this->Base_Order_model->order_update(array('AccountPeriod_status'=>$AccountPeriod_status),array('id'=>$order_id));
                if( $res )
                {
					$ainfo=date('Y-m-d H:i:s');
					if($AccountPeriod_status==2)
					{
						//AccountPeriod_type
						$AccountPeriod_moeny=$d['product_price']+$d['logcs_price'];
						$type=$d['AccountPeriod_type']==4?3:$d['AccountPeriod_type'];
						$AccountPeriod_moeny=ceil($AccountPeriod_moeny/$type);
						$ar=array(
								1=>array(1=>30),
								2=>array(1=>30,2=>30),
								3=>array(1=>30,2=>30,3=>15),
								4=>array(1=>30,2=>30,3=>30)
							);
						$tm=time();
						$day=0;
						$dd=$ar[$type];
						$pay_time='';
						//审核通过
						foreach($dd as $k=>$v)
						{
							$day+=$v;
							$AccountPeriod_End_Time=date('Y-m-d H:i:s',strtotime($ainfo." +".($day)." day "));
							if(empty($pay_time))
								$pay_time=$AccountPeriod_End_Time;	
							$arr=array(
									'order_id'=>$order_id,
									'userid'=>$d['userid'],
									'AccountPeriod_moeny'=>$AccountPeriod_moeny,
									'AccountPeriod_time'=>$AccountPeriod_End_Time,
									'status'=>1,
									'q_num'=>$k
						         );
							$this->Order_accountperiod_model->insert($arr);	 
						}
						
						//最近一期付款时间
						$this->Base_Order_model->order_update(array('AccountPeriod_End_Time'=>$pay_time),array('id'=>$order_id));
					}
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
            else
            {
                $msg = array(
                    'msg'  => '请刷新页面后继续操作',
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }

        }
		$this->ci_smarty->assign('show_ajax','1');
        $this->ci_smarty->display_ini('order_accountperiod.htm');
	}
	
    public function order_ls_invalid()
    {
        if(!empty($_POST))
        {
            $ids=$_POST['id'];
            $reason=$_POST['rea'];
            $invalid_time=dateformat(time());
            $item=array_filter(explode(',',$ids));
            $flag=TRUE;
            $num=0;
            foreach ( $item as $k=>$v)
            {
			    $info=$this->Base_Orderls_model->get_row('status',array('id'=>$v));
				if($info['status']==1) 
				{
					$res=$this->Base_Orderls_model->update(array('close_con'=>$reason,'close_time'=>$invalid_time,'status'=>-1),array('id'=>$v));
					if(!empty($res))
					{
						$this->Base_Orderls_model->update_pro(array('status'=>-1),array('order_id'=>$v));
						//当作废订单的时候
						$ls_order_pro=$this->Base_Orderls_model->get_pro_list('stock_id,num',array('order_id'=>$v));
						foreach($ls_order_pro as $k1=>$v1)
						{
							$sql=" UPDATE ".tab_m('seller_product')." SET  `ls_lock_num`=`ls_lock_num`-".$v['num']." ,  `online_num`=`online_num`-".$v['num']." WHERE `userid`=2 AND `stock_id`={$v['stock_id']} ";
							$this->Seller_product_model->update_product_sql($sql);
							$sql2="UPDATE ".tab_m('sp_product')." SET  `ls_lock_num`=`ls_lock_num`-{$v['num']} , `online_num`=`online_num`-{$v['num']}  WHERE  `stock_id`={$v['stock_id']}  ";
							$this->Sp_Product_model->update_product_sql($sql2);
						}
						$num++;
					}
				}
            }

            if( $res )
            {
                $msg = array(
                    'msg'  => "作废成功 ".$num." 条",
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

    //订单列表
    public function order_list()
    {
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

        $wsql='1=1';
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

                    }

                    //模糊查询
                    if(in_array($skey,$search_key_ar_more))
                    {

                        $wsql.=" and {$skey} like '%{$v}%'";
                    }
                }
            }
        }

        if(!empty($_GET['search_stime']))
            $wsql.= " AND add_time>='".date("Y-m-d H:i:s",strtotime($_GET['search_stime']))."'";

        if(!empty($_GET['search_etime']))
            $wsql.= " AND add_time<='".date("Y-m-d H:i:s",strtotime( $_GET['search_etime']."+ 1 day -1second"))."'";

	    if(!empty($_GET['search_pay_stime']))
            $wsql.= " AND AccountPeriod_End_Time>='".date("Y-m-d H:i:s",strtotime($_GET['search_pay_stime']))."'";

        if(!empty($_GET['search_pay_etime']))
            $wsql.= " AND AccountPeriod_End_Time<='".date("Y-m-d H:i:s",strtotime( $_GET['search_pay_etime']."+ 1 day -1second"))."'";

        $search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
        //===================查询 end=========================
        $this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
        $sql="select  *  from  ".tab_m('order')." WHERE ".$wsql.' order by  id DESC ';

        if(!$this->ci_page->__get('totalRows'))
        {
            $query=$this->db->query($sql);
            $this->ci_page->totalRows =$query->num_rows;
        }

        $sql.=" limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
        $query=$this->db->query($sql);
        $res=array();

        foreach($query->result_array() as $k=>$v)
        {
            $res['list'][$k]=$v;
            $sql='SELECT company from '.tab_m('seller_user').' WHERE id='.$v['userid'];
            $company=$this->db->query($sql)->row_array();
            $res['list'][$k]['seller']=$company['company'];
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


    public function order_info()
    {
        if(!empty($_GET))
        {
            $res['id']= $_GET['id'];
            $this->ci_smarty->assign('re',$res);
        }
        $this->ci_smarty->display('order_info.htm');
    }



    //订单详情显示
    public function  order_info_1()
    {
        if(!empty($_GET))
        {
            $order_id = $_GET['id'];
            $sql = "select * from ".tab_m('order_pro')." where `order_id`=".$order_id." order by sp_uid desc  ";
            $query=$this->db->query($sql);
            $res=array();
            $res['id'] = $order_id;
            $sql1="SELECT `status` from ".tab_m('order')." WHERE `id`=".$order_id;
            $res_status=$this->db->query($sql1)->row_array();
            $res['status']=$res_status['status'];
            //model
            $this->load->model('Base_Order_model');
            $sp_info=$this->Base_Order_model->get_sp_order_info_result('warehouse_id,logcs_num,delivery_time',array('order_id'=>$order_id));

            $res['order_info']=array();
            foreach($query->result_array()  as $k=> $v)
            {
                if($v['sp_uid']) {
                    $sql = "SELECT `company` FROM " . tab_m('sp_user') . " WHERE id=" . $v['sp_uid'];
                    $company = $this->db->query($sql)->row_array();
                    $res['order_info'][$k]=$v;
                    $res['order_info'][$k]['sp_company'] = $company['company'];
                }
				
                if($v['status']==2)
                {
                    foreach ( $sp_info as $k1=>$v1)
                    {
                        if($v['warehouse_id']==$v1['warehouse_id'] )
                        {
                            $res['order_info'][$k]['logcs_num']=$v1['logcs_num'];
                            $res['order_info'][$k]['delivery_time']=$v1['delivery_time'];
                        }

                    }

                }
            }

            $this->ci_smarty->assign('re',$res);
        }
        $this->ci_smarty->assign('show_ajax','1');
        $this->ci_smarty->display_ini('order_info1.htm');
    }
    
	/*
    //订单详情修改
    public  function order_pro_change()
    {
        if(!empty($_POST))
        {
            $this->load->model('Base_Order_model');
            $order_id=$_POST['order_id'];
            unset($_POST['order_id']);
            $order_pro=$_POST;
            $status=$this->Base_Order_model->get_order_info('status',array('id'=>$order_id));
            if($status['status']==1)
            {

                $order_info=$this->Base_Order_model->get_order_pro_info('stock_id,num',array('order_id'=>$order_id));
                //修改online_num(减掉原有数量)
                foreach ( $order_info as $k=>$v)
                {
                    $this->db->where('stock_id',$v['stock_id']);
                    $this->db->set('online_num',"online_num - $v[num]",FALSE);
                    $this->db->update(tab_m('sp_product'));
                }
                foreach ( $order_pro as $k=>$v)
                {
                    $this->Base_Order_model->order_pro_update(array('num'=>$v),array('id'=>$k));

                }
                //全新order_pro
                $order_info1=$this->Base_Order_model->get_order_pro_info('*',array('order_id'=>$order_id));
                //再修改online_num
                $or_arr=array();
                foreach ( $order_info1 as $k=>$v)
                {
                    //修改online_num
                    $this->db->where('stock_id',$v['stock_id']);
                    $this->db->set('online_num',"online_num + $v[num]",FALSE);
                    $this->db->update(tab_m('sp_product'));
                    //修改order_log表中的数量
                    $sql="UPDATE ".tab_m('order_log')." SET `num`={$v['num']} WHERE `order_id`={$v['order_id']} and `stock_id`={$v['stock_id']}";
                    $this->db->query($sql);
                    $or_arr['product_price']+=$order_info1[$k]['price']*$order_info1[$k]['num'];
                    $or_arr['logcs_weight']+=$order_info1[$k]['weight']*$order_info1[$k]['num'];
                }

                //修改订单价格
                $res=$this->Base_Order_model->order_update(array('product_price'=>$or_arr['product_price'],'logcs_weight'=>$or_arr['logcs_weight']),array('id'=>$order_id));

                //修改sp_order的价格
                $sql=" SELECT `sp_price`,`seller_price`,`sp_id`,`num`,`sp_order_id` FROM ".tab_m('order_log')." WHERE order_id={$order_id} ";
                $order_log=$this->db->query($sql)->result_array();
                $new_array=array();//sp_order

                foreach($order_log as $k=>$v)
                {
                    $new_array[$v['sp_id']][]=$v;
                }
                $new_arr4=array();
                foreach ($new_array as $k=>$v)
                {
                    $new_arr4[$k]['sp_id']=$k;
                    $new_arr4[$k]['order_id']=$order_id;
                    foreach ( $v as $k1=>$v1)
                    {
                        $new_arr4[$k]['id']=$v1['sp_order_id'];
                        $new_arr4[$k]['sp_total']=$v1['sp_price']*$v1['num'];
                        $new_arr4[$k]['seller_total']=$v1['seller_price']*$v1['num'];
                        $new_arr4[$k]['logcs_total_weight']=$v1['weight']*$v1['num'];
                    }
                }

                foreach ( $new_arr4 as $k=>$v)
                {
                    $this->db->update(tab_m('sp_order'),$v,array('id'=>$v['id']));
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
            else
            {
                $msg = array(
                    'msg'  => '请刷新页面后继续操作',
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }
        }
    }*/


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
            $log['fee']=($weight-$logistics['default_num'])/$logistics['add_num']*$logistics['add_price']+$logistics['default_price'];
        }

        //返回运费
        return  number_format($log['fee'],2,'.',',') ;
    }

    //订单编辑
    public function  order_edit()
    {
        if(!empty($_GET))
        {
            //model
            $this->load->model('Base_Order_model');
            $id = $_GET['id'];
            $res= array();
            $res['id'] = $id;
            $res['order']=$this->Base_Order_model->get_order_info('userid,status,logcs_price,logcs_weight',array('id'=>$id));
            $sql = "SELECT `company` FROM " . tab_m('seller_user') . " WHERE id=" . $res['order']['userid'];
            $company = $this->db->query($sql)->row_array();
            $res['company']=$company['company'];
            $this->ci_smarty->assign('re',$res);
        }
        $this->ci_smarty->display_ini('order_edit.htm');
    }
    //订单运费编辑
    public  function  order_logics_fee()
    {
        if(!empty($_GET))
        {
            //model
            $this->load->model('Base_Order_model');
            $order_id=$_GET['id'];
            
            $sp_order=$this->Base_Order_model->get_sp_order_info_result('*',array('order_id'=>$order_id));
            $order_status=$this->Base_Order_model-> get_order_info('status,payment_status',array('id'=>$order_id));
            $new_array=array();
            foreach ($sp_order as $k=>$v )
            {
                $new_array[$k]=$v;
                if(!empty($v['sp_id']))
                {
                    $sql="SELECT `company` FROM ".tab_m('sp_user')." WHERE id=".$v['sp_id'];
                    $company=$this->db->query($sql)->row_array();
                    $new_array[$k]['sp_company']=$company['company'];
				    $new_array[$k]['sp_id']=$v['sp_id'];
                }
            }
            $res['id']=$order_id;
            $res['sp_order']=$new_array;
            $this->ci_smarty->assign('re',$res);
            $this->ci_smarty->assign('order_status',$order_status);
            $this->ci_smarty->display_ini('order_logics_fee.htm');
        }
        if(!empty($_POST))
        {
            $order_id=$_POST['order_id'];
            //查询订单状态
            $this->load->model('Base_Order_model');
            $status=$this->Base_Order_model->get_order_info('status,payment_status',array('id'=>$order_id));
            if($status['status']==1)
            {
                unset($_POST['order_id']);
                $new_array=$_POST;
                foreach ( $new_array as $k=>$v)
                {
                    $arr=explode('|',$k);
                    if($arr[0]=='logcs_price')
                    {
                        $sql="UPDATE ".tab_m('sp_order')." SET `logcs_price`={$v} WHERE id=".$arr[1];
                        $this->db->query($sql);

                    }
					
                    if($arr[0]=='logcs_total_weight')
                    {
                        $sql="UPDATE ".tab_m('sp_order')." SET `logcs_total_weight`={$v} WHERE id=".$arr[1];
                        $this->db->query($sql);
                    }
                }

                $sp_order=$this->Base_Order_model->get_sp_order_info_result('logcs_price,logcs_total_weight',array('order_id'=>$order_id));
                //运费相加
                $logcs_fee=0.00;
                $logcs_weight=0;
                foreach ( $sp_order as $k=>$v)
                {
                    $logcs_fee+=$v['logcs_price'];
                    $logcs_weight+=$v['logcs_total_weight'];
                }
                $flag=$this->Base_Order_model->order_update(array('logcs_price'=>$logcs_fee,'logcs_weight'=>$logcs_weight),array('id'=>$order_id));
                if( $flag )
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
                    'msg'  => '请刷新页面后继续操作',
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }

        }
    }

    //审核操作
    public function order_action()
    {
        if(!empty($_GET))
        {
            //model
            $this->load->model('Base_Order_model');

            $id = $_GET['id'];

            $res= array();
            $res=$this->Base_Order_model->get_order_info('*',array('id'=>$id));
            $this->ci_smarty->assign('re',$res);
        }
        $this->ci_smarty->display_ini('order_action.htm');
    }

    public function order_edit_done()
    {
        if(!empty($_POST))
        {
            //model
            $this->load->model('Base_Order_model');
            //表单验证
            $this->load->library('MY_form_validation');
            $this->form_validation->set_rules('status', '订单状态', 'required');
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
                if ($_POST['status'] == -1)
                {
					//作废订单
                    $id = $_POST['id'];
                    $order = $this->Base_Order_model->get_order_info('status,AccountPeriod_status,payment_status', array('id' => $id));

					if($order['payment_status']>=1)
					{
						$msg = array(
                            'msg' => '有账务未处理完成不能作废',
                            'type' => 1
                        );
                        echo json_encode($msg);
                        die;
					}
					
					$d1=$this->db->query("select  count(*)  as  num    from   ".tab_m('sp_order')."   
						                      where  delivery_status='-1' and   order_id='$id'  ")->row_array();
					//全部分单
					$d2=$this->db->query("select  count(*)  as  num    from   ".tab_m('sp_order')."   
										  where  order_id='$id'  ")->row_array();
										  			
					if($d1['num']!=$d2['num'])
					{
						$msg = array(
                            'msg' => '供应分单未作废',
                            'type' => 1
                        );
                        echo json_encode($msg);
                        die;
							
					}
					
					if($order['AccountPeriod_status']>=2)
					{  
						if($order['AccountPeriod_status']!=3)
						{
							$msg = array(
								'msg' => '分期未销账,不能作废',
								'type' => 1
							);
							echo json_encode($msg);
							die;
						}
					}
					
					$flag=$this->db->query("update  ".tab_m('order')."  set   status=-1  where   id='".$id."'  and   status=4   ");	
					
					//已付款不能作废 申请过分期付款不能作废

					$msg = array(
						'msg' => '请刷新页面后继续操作',
						'type' => 3
					);
					echo json_encode($msg);
					die;

                }
                else
                {//审核订单

                    $id = $_POST['id'];
                    //查询运费是否已经全部填写完毕
                    $fee = $this->Base_Order_model->get_sp_order_info_result('logcs_total_weight', array('order_id' => $id));
                    foreach ($fee as $k => $v) {
                        if ($v['logcs_total_weight'] <= 0) {
                            $msg = array(
                                'msg' => '请将所有订单重量填写完毕后提交',
                                'type' => 1
                            );
                            echo json_encode($msg);
                            die;
                        }
                    }
					
                    $status = $this->Base_Order_model->get_order_info('status', array('id' => $id));
                    if ($status['status'] == 1 || $status['status'] == 2) {
						
                        $address = array();
                        $address['status'] = $this->input->post('status', true);
                        $res = $this->Base_Order_model->order_update($address, array('id' => $id));
						if(!empty($res))
						{
							if($address['status']==2) //审核通过
								$this->db->query("UPDATE ".tab_m('order_pro')." SET `status`=1 WHERE `order_id`=".$id);
							elseif($address['status']==1) //作废
								$this->db->query("UPDATE ".tab_m('order_pro')." SET `status`=0 WHERE `order_id`=".$id);
						}
                    }

                }
                if ($res) {
                    $msg = array(
                        'msg' => "操作成功",
                        'type' => 3
                    );
                    echo json_encode($msg);
                    die;
                } else {
                    $msg = array(
                        'msg' => '提交失败',
                        'type' => 1
                    );
                    echo json_encode($msg);
                    die;
                }
            }
        }

    }

    public function order_confirm_money()
    {
        if(!empty($_GET))
        {
            //model
            $this->load->model('Base_Order_model');
            $id = $_GET['id'];
            $res= array();
            $res['id'] = $id;
            $res['order']=$this->Base_Order_model->get_order_info('payor,cashflow_id,AccountPeriod_type,userid,payment_status,not_pay_money,AccountPeriod_status,AccountPeriod_End_Time ,product_price,logcs_price',array('id'=>$id));
            $sql = "SELECT `company` FROM " . tab_m('seller_user') . " WHERE id=" . $res['order']['userid'];
            $company = $this->db->query($sql)->row_array();
            $res['company']=$company['company'];
            $this->ci_smarty->assign('re',$res);
        }
        $this->ci_smarty->display_ini('order_confirm_money.htm');
    }
	
    public function order_confirm_done()
    {
        if(!empty($_POST))
        {
            //表单验证
            $this->load->library('MY_form_validation');
            $this->form_validation->set_rules('payment_status','付款状态','required');
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
                $order=$this->Base_Order_model->get_order_info('status,cashflow_id,pay_uptime,product_price
				                                                ,logcs_price,not_pay_money,userid,payor,payment_status',array('id'=>$id));
                if($order['status']>=2 && $order['payment_status']==1)
                {
                    $address= array();
                    $address['payment_status']=$this->input->post('payment_status',true);
                    $res =  $this->Base_Order_model->order_update($address,array('payment_status'=>1,'id'=>$id));
                    if( $res )
                    {
						if($address['payment_status']==2)
						{
							$this->load->model('Order_accountperiod_model');
							$this->Order_accountperiod_model->insert(
								   array(
										 'order_id'=>$id,
										 'userid'=>$order['userid'], 
										 'AccountPeriod_moeny'=>$order['product_price']+$order['logcs_price']-$order['not_pay_money'],
										 'payment_money'=>$_POST['payment_money'], 
										 'payment_time'=>$order['pay_uptime'], 
										 'q_num'=>0, 
										 'cashflow_id'=>$order['cashflow_id'], 
										 'payor'=>$order['payor'], 
										 'status'=>3
						           ));
							//销账
							$this->Base_Order_model->order_update(array('AccountPeriod_status'=>3),array('payment_status'=>2,'AccountPeriod_status'=>2,'id'=>$id));
							
							//实际付款金额
							$this->Base_Order_model->order_update(array('payment_money'=>$_POST['payment_money']*1),array('id'=>$id));
						}
						
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
                        'msg'  => '请刷新页面后继续操作',
                        'type' => 1
                    );
                    echo json_encode($msg);
                    die;
                }

            }
        }
    }
    //订单发货
    public function order_deliver()
    {
        if(!empty($_GET))
        {
            //model
            $this->load->model('Base_Order_model');
            $this->load->model('Base_Logistics_model');
            $id = $_GET['id'];
            $res['id'] = $id;
            $res['order']=$this->Base_Order_model->get_order_info('logcs_weight,logcs_price,consignee,consignee_address,consignee_mobile,userid',array('id'=>$id));
            $res['logistics']= $this->Base_Logistics_model->logccom_list();
            $sql = "SELECT `company` FROM " . tab_m('seller_user') . " WHERE id=" . $res['order']['userid'];
            $company = $this->db->query($sql)->row_array();
            $res['company']=$company['company'];

            $sp_order=$this->Base_Order_model->get_sp_order_info_result('*',array('order_id'=>$id));

            $new_array=array();
            foreach ($sp_order as $k=>$v )
            {
                $new_array[$k]=$v;
                if($v['sp_id'])
                {
                    $sql="SELECT `company` FROM ".tab_m('sp_user')." WHERE id=".$v['sp_id'];
                    $company=$this->db->query($sql)->row_array();
                    $new_array[$k]['sp_company']=$company['company'];
                }

            }
            $res['sp_order']=$new_array;
            $this->ci_smarty->assign('re',$res);
        }
        $this->ci_smarty->display_ini('order_deliver.htm');
    }


    public function order_deliver_done()
    {
        if(!empty($_POST))
        {   
            //model
            $this->load->model('Base_Order_model');
            $order_id=$_POST['id'];
            $status=$this->Base_Order_model->get_order_info('status,payment_status,AccountPeriod_type,pay_uptime,AccountPeriod_status,AccountPeriod_status,AccountPeriod_End_Time',array('id'=>$order_id));
            if($status['status']>=1&&$status['status']!=4)
            {   
				//只有在订单处于  确认付款 或 账期审核通过   和 部分发货  未发货 的状态才能修改
                unset($_POST['id']);
                $new_arr=array();
                foreach ($_POST['logcs_num'] as $k=>$v)
                {
                    if(empty($_POST['delivery_status'][$k]))
                        continue;
                    else
                    {
                        if($_POST['delivery_status'][$k]==1)
                        {
							//未付款 无分期付款
							if($status['payment_status']!=2 OR $status['AccountPeriod_status']<=1)
							{
								continue;
							}
							
							//已发货
                            if(empty($v) || empty($_POST['logistics_type'][$k]) )
                            {
                                $msg = array(
                                    'msg'  => '编号'.$k.'订单：'.'运单号或运单类型未填写',
                                    'type' => 1
                                );
                                echo json_encode($msg);
                                die;
                            }
                            $new_arr[$k]['logcs_num']=$v;
                            $new_arr[$k]['logistics_type']=$_POST['logistics_type'][$k];
                            $new_arr[$k]['delivery_status']=$_POST['delivery_status'][$k];
                            $new_arr[$k]['delivery_time']=dateformat(time());
							
							//如果是分期付款 按最后一期加7天付款 
							if($status['AccountPeriod_status']>=2)
							{
								$ar_day=array(1=>30,2=>60,3=>75,4=>90);
								$day=!empty($ar[$status['AccountPeriod_type']])?$ar[$status['AccountPeriod_type']]:90;
								$new_arr[$k]['estimated_date_payment']=date('Y-m-d H:i:s',strtotime('+'.($day+5).' day'));
							}
							//如果已经一次性付款
							elseif($status['payment_status']==2)
								$new_arr[$k]['estimated_date_payment']=date('Y-m-d H:i:s',strtotime('+30 day'));
							
							
                            //$new_arr[$k]['estimated_date_payment']=date('Y-m-d H:i:s',strtotime('+30 day',strtotime($status['AccountPeriod_End_Time'])));
                        }
                        elseif($_POST['delivery_status'][$k]==-1)
                        {//作废
                            $new_arr[$k]['delivery_status']=$_POST['delivery_status'][$k];
                        }
                    }

                }

                if(empty($new_arr))
                {
                    $msg = array(
                        'msg'  => '请填写相关信息',
                        'type' => 1
                    );
                    echo json_encode($msg);
                    die;
                }

                foreach ( $new_arr as $k=>$v )
                {
                    if($v['delivery_status']==-1)
                    {//订单作废
                        $sp_back_money=$this->Base_Order_model->get_sp_order_info('seller_total,logcs_price',array('id'=>$k));
                        $back_money=$sp_back_money['seller_total']+$sp_back_money['logcs_price'];
                        $sql='UPDATE '.tab_m('order').' SET `not_pay_money`=`not_pay_money`+'.$back_money.', `invalid_sp_order_num`=`invalid_sp_order_num`+1  WHERE id='.$order_id;
                        $this->db->query($sql);
                        $res=$this->Base_Order_model->sp_order_abolish($v,$k,0);
						
                    }
                    else
                    {//订单发货
                        $sql='UPDATE '.tab_m('order').' SET  `delivery_sp_order_num`=`delivery_sp_order_num`+1 WHERE id='.$order_id;
                        $this->db->query($sql);
                        $res=$this->Base_Order_model->sp_order_delivery($v,$k,0);
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
            else
            {
                $msg = array(
                    'msg'  => '请刷新页面后继续操作',
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }



        }
    }

    public function order_table_upload()
    {
        if(!empty($_GET['temp_id']))
        {   
            //model
            $this->load->model('Base_Order_model');
            $order_id = $_GET['temp_id'];
            $order_title=array('分销商','收货人姓名','收货人电话','收货人地址','订购总价格','付款金额','运单类型','运单号','运单重量','运费','下单时间','付款时间','发货时间');
            $order_value=$this->Base_Order_model->get_order_info('userid,consignee,consignee_mobile,consignee_address,product_price,payment_money,logistics_type,logistics_no,logcs_weight,logcs_price,add_time,pay_uptime,f_time',array('id'=>$order_id));
            $order_arr=array();
           
            $order_info=$this->Base_Order_model->get_order_pro_info('sp_id,sp_uid,stock_id,stock_id,seller_product_id,userid,name,price,sp_price,weight,num',array('order_id'=>$order_id));
            foreach($order_value as $k =>$v )
            {
                if($k=='userid')
                {
                     $sql  ='SELECT company FROM '.tab_m('seller_user').' WHERE id= '.$v['userid'];
                    $temp =$this->db->query($sql)->row_array();
                    $v = $temp['company'];
                }
                $order_arr[]=$v;
            }
            $order_info_arr=array();
            foreach ( $order_info as $k=> $v)
            {
                if($v['sp_uid'])
                {
                    $sql  ='SELECT company FROM '.tab_m('sp_user').' WHERE id='.$v['sp_uid'];
                    $temp =$this->db->query($sql)->row_array();
                    $v['sp_uid'] = $temp['company'];
                }

                if($v['userid'])
                {
                    $sql='SELECT company FROM '.tab_m('seller_user').' WHERE id='.$v['userid'];
                    $temp =$this->db->query($sql)->row_array();
                    $v['userid']= $temp['company'];
                }
                $order_info_arr[]=$v;
            }
            $order_info_title=array('供应商商品id','供应商','公共库id','分销商商品id','分销商','产品名','销售价','供应价','单位重量','数量');
            get_explode_xls($order_title,array($order_arr),"订单($order_id)表"
                ,array(array('订单详情表'
                ,$order_info_arr,$order_info_title
                )));

        }
    }

    public function sp_order_list()
    {
        if(isset($_GET['export'])) 
        {
            //model
            $this->load->model('Base_Order_model');
            $reconciliation_no=$_GET['search_reconciliation_no'];
            if( $reconciliation_no !=''){
                $sp_order=$this->Base_Order_model->get_sp_order_info_result('id,sp_id,sp_total,logcs_price,logcs_num,delivery_time,logcs_total_weight,order_id,logistics_type,reconciliation_no',
                    array('reconciliation_no'=>$reconciliation_no));
                $new_arr=array();//sp_order
                $new_arr2=array();
                foreach ( $sp_order as $k=>$v )
                {
                    $new_arr[$k]=$v;
                    if($v['sp_id'])
                    {
                        $sql="SELECT `company` FROM  ".tab_m('sp_user')." WHERE `id`=".$v['sp_id'];
                        $company=$this->db->query($sql)->row_array();

                        $new_arr[$k]['sp_id']=$company['company'];
                    }
                    if($v['logistics_type'])
                    {
                        $sql2="SELECT `title` FROM ".tab_m('logistics_temp')." WHERE id=".$v['logistics_type'];
                        $logistics_type=$this->db->query($sql2)->row_array();
                        $new_arr[$k]['logistics_type']=$logistics_type['title'];
                    }
                    if($v['id'])
                    {
                        $new_arr2[]=$this->Base_Order_model->get_sp_order_log_info_result('sp_order_id,sp_id,name,sp_price,num,weight',array('sp_order_id'=>$v['id']));
                    }
                }
				
                $new_arr4=array();
                foreach ($new_arr2 as $key => $value) 
                {   
                   $new_arr4[$key]=$value;
                   foreach ($value as $k => $v)
                   {
                       if($v['sp_id'])
                       {
                         $sql="SELECT `company` FROM  ".tab_m('sp_user')." WHERE `id`=".$v['sp_id'];
                         $company=$this->db->query($sql)->row_array();
                         $new_arr4[$key][$k]['sp_id']=$company['company'];
                       }
                   }
                   
                }
                $new_arr3=array();//order_log
                foreach ( $new_arr4 as $k=>$v)
                {
                    foreach ( $v as $k1=>$v1)
                    {
                        $new_arr3[]=$v1;
                    }
                }
                //sp_order的title
                $order_title=array('供应商订单id','供应商','供应总价','运费','运单号','发货时间','订单重量','订单id','运单类型','对账单号');
                $order_info_title=array('供应商订单id','供应商','商品名','供应单价','数量','单位重量');
                get_explode_xls($order_title,$new_arr,'对账-供应商订单',array(array('对账-供应商订单详情',$new_arr3,$order_info_title)));
            }
        }

        if(isset($_GET['export1']))
        {
            //model
            $this->load->model('Base_Order_model');
            $reconciliation_no=$_GET['search_reconciliation_no'];
            if( $reconciliation_no !=''){
                $sp_order=$this->Base_Order_model->get_sp_order_info_result('id,sp_id,sp_total,seller_total,logcs_price,logcs_num,delivery_time,logcs_total_weight,order_id,logistics_type,reconciliation_no',
                    array('reconciliation_no'=>$reconciliation_no));
                $new_arr=array();//sp_order
                $new_arr2=array();
                foreach ( $sp_order as $k=>$v )
                {
                    $new_arr[$k]=$v;
                    if($v['sp_id'])
                    {
                        $sql="SELECT `company` FROM  ".tab_m('sp_user')." WHERE `id`=".$v['sp_id'];
                        $company=$this->db->query($sql)->row_array();

                        $new_arr[$k]['sp_id']=$company['company'];
                    }
                    if($v['logistics_type'])
                    {
                        $sql2="SELECT `title` FROM ".tab_m('logistics_temp')." WHERE id=".$v['logistics_type'];
                        $logistics_type=$this->db->query($sql2)->row_array();
                        $new_arr[$k]['logistics_type']=$logistics_type['title'];
                    }
                    if($v['id'])
                    {
                        $new_arr2[]=$this->Base_Order_model->get_sp_order_log_info_result('sp_order_id,sp_id,name,sp_price,seller_price,num,weight',array('sp_order_id'=>$v['id']));
                    }

                }
                $new_arr4=array();
                foreach ($new_arr2 as $key => $value) 
                {   
                   $new_arr4[$key]=$value;
                   foreach ($value as $k => $v)
                   {
                       if($v['sp_id'])
                       {
                         $sql="SELECT `company` FROM  ".tab_m('sp_user')." WHERE `id`=".$v['sp_id'];
                         $company=$this->db->query($sql)->row_array();
                         $new_arr4[$key][$k]['sp_id']=$company['company'];
                       }
                   }
                }
                $new_arr3=array();//order_log
                foreach ( $new_arr4 as $k=>$v)
                {
                    foreach ( $v as $k1=>$v1)
                    {
                        $new_arr3[]=$v1;
                    }
                }
                //sp_order的title
                $order_title=array('供应商订单id','供应商','供应总价','分销总价','运费','运单号','发货时间','订单重量','订单id','运单类型','对账单号');
                $order_info_title=array('供应商订单id','供应商','商品名','供应单价','分销单价','数量','单位重量');
                get_explode_xls($order_title,$new_arr,'核算-供应商订单',array(array('核算-供应商订单详情',$new_arr3,$order_info_title)));


            }
        }

        $this->load->library('CI_page');
        $this->ci_page->Page();
        $this->ci_page->url=site_url($this->class."/".$this->method);
        $wsql='';
        $s_status='  `delivery_status`!=-1';
        if(isset($_GET))
        {
            //非模糊查询的字段
            $search_key_ar=array('delivery_status','payment_status','order_id','sp_id','id','reconciliation_no','reconciliation_status');
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
                        if($skey=='delivery_status' && $v==-1)
                        {
                            $s_status="  `delivery_status`=-1 ";
                        }
                    }

                    //模糊查询
                    if(in_array($skey,$search_key_ar_more))
                    {
                        $wsql.=" and {$skey} like '%{$v}%'";
                    }
                }
            }
        }

        if(!empty($_GET['search_stime']))
            $wsql.= " AND delivery_time>='".date("Y-m-d H:i:s",strtotime($_GET['search_stime']))."'";

        if(!empty($_GET['search_etime']))
            $wsql.= " AND delivery_time<='".date("Y-m-d H:i:s",strtotime( $_GET['search_etime']."+ 1 day -1second"))."'";
			
		if(!empty($_GET['search_pay_stime']))
            $wsql.= " AND estimated_date_payment>='".date("Y-m-d H:i:s",strtotime($_GET['search_pay_stime']))."'";

        if(!empty($_GET['search_pay_etime']))
            $wsql.= " AND estimated_date_payment<='".date("Y-m-d H:i:s",strtotime($_GET['search_pay_etime']."+ 1 day -1second"))."'";

        $search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
        //===================查询 end=========================
        $this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
        $sql="select  *  from  ".tab_m('sp_order')."  where ".$s_status.$wsql.' order by  order_id DESC ';

        if(!$this->ci_page->__get('totalRows'))
        {
            $query=$this->db->query($sql);
            $this->ci_page->totalRows =$query->num_rows;
        }

        $sql.=" limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
        $query=$this->db->query($sql);
        $res=array();

        foreach($query->result_array() as $k=>$v)
        {
            $res['list'][$k]=$v;
            $sql='SELECT company from '.tab_m('sp_user').' WHERE id='.$v['sp_id'];
            $company=$this->db->query($sql)->row_array();
            $res['list'][$k]['seller']=$company['company'];
            $sql="SELECT `consignee`,`consignee_address`,`consignee_mobile`,`status`,`payment_status` FROM ".tab_m('order')." WHERE id=".$v['order_id'];
            $address=$this->db->query($sql)->row_array();
            $res['list'][$k]['consignee']=$address['consignee'];
            $res['list'][$k]['consignee_address']=$address['consignee_address'];
            $res['list'][$k]['consignee_mobile']=$address['consignee_mobile'];
            $res['list'][$k]['status']=$address['status'];
            $res['list'][$k]['payment_status']=$address['payment_status'];
        }

        $res['page']=$this->ci_page->prompt();
        $this->ci_smarty->assign('re',$res,1,'page');

        require(APPPATH.'/config/base_config.php');
        $this->ci_smarty->assign('reconciliation_status',$config['reconciliation_status']);
        $this->ci_smarty->assign('delivery_status',$config['delivery_status']);
        //查询结束
        //***************************
        $this->ci_smarty->display_ini('sp_order_list.htm');
    }
	
	
    /*
    public function sp_order_info()
    {
        if(!empty($_GET))
        {
            $res['id']= $_GET['id'];
            $this->ci_smarty->assign('re',$res);
        }
        $this->ci_smarty->display('sp_order_info.htm');
    }
	*/

    public function sp_order_info()
    {
        if(!empty($_GET))
        {
            $this->load->library('CI_page');
            $this->ci_page->Page();
            $this->ci_page->url=site_url($this->class."/".$this->method);
            $sp_order_id = $_GET['id'];
            $this->ci_page->listRows=5;
            $sql = "select * from ".tab_m('order_log')." where `sp_order_id`=".$sp_order_id;
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

            $res['page']=$this->ci_page->prompt();
            $this->ci_smarty->assign('re',$res,1,'page');
        }
        $this->ci_smarty->assign('show_ajax','1');
        $this->ci_smarty->display_ini('sp_order_info1.htm');
    }

    //sp_order 生成对账号
    public  function reconciliation_no()
    {
        if(!empty($_POST))
        {
            //model
            $this->load->model('Base_Order_model');
            $s_time=$_POST['search_stime'];
            if($s_time=='')
            {
                $msg = array(
                    'msg'  => "发货开始时间没有填写",
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }
            $e_time=$_POST['search_etime'];
            if( $e_time=='')
            {

                $msg = array(
                    'msg'  => "发货结束时间没有填写",
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }
            $s_time1=date('Y-m-d H:i:s',strtotime($s_time));
            $e_time1=date('Y-m-d H:i:s',strtotime($e_time."+1 day - 1 second"));
            $sql ="SELECT `id` FROM ".tab_m('sp_order')." WHERE `reconciliation_no`=0 AND `reconciliation_status`=0 AND `delivery_time`>='{$s_time1}' AND `delivery_time`<='{$e_time1}'";
            $sp_order=$this->db->query($sql)->result_array();
            if(!empty($sp_order))
            {
                $reconciliation_no=str_replace('-','',$s_time).str_replace('-','',$e_time);
                foreach ( $sp_order as $k=>$v)
                {

                    $res=$this->Base_Order_model->sp_order_update(array('reconciliation_no'=>$reconciliation_no),array('id'=>$v['id']));

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
            else
            {
                $msg = array(
                    'msg'  => '无符合条件的订单',
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }


        }
    }


    /**
     *  给供应商结算货款
     */
    public function sp_order_payment()
    {

        if(!empty($_GET['id']))
        {
            $this->load->model('Base_Order_model');
            $this->load->model('Admin_Spuser_model');
            $id = $_GET['id'];
            $res=$this->Base_Order_model->get_sp_order_info('id,sp_id,order_id,sp_total,logcs_price',array('id'=>$id));
            $sp_user=$this->Admin_Spuser_model->get_spuser($res['sp_id'],'company');
            $res['company']= $sp_user['company'];
            $this->ci_smarty->assign('re',$res);
            $this->ci_smarty->display_ini('sp_order_payment.htm');
        }

        if(!empty($_POST))
        {
            //表单验证
            $this->load->library('MY_form_validation');
            $this->form_validation->set_rules('cashflow_id','银行流水号','required');
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
                $status=$this->Base_Order_model->get_sp_order_info('reconciliation_status,delivery_status',array('id'=>$id));

                //已发货或者未发货
                if($status['reconciliation_status']==0 && $status['delivery_status']==1)
                {
                    $address= array();
                    $remark=$this->input->post('remark',true);
                    $remark=empty($remark)?'':'暂无备注';
                    $remark_accout=json_encode(array(
                        'cashflow_id'=>$this->input->post('cashflow_id',true),
                        'remark'=>$remark
                    ));
                    $address['remark_accout']=$remark_accout;
                    $address['reconciliation_status'] = 1;
                    $address['date_payment'] = date('Y-m-d H:i:s',time());
                    $res =  $this->Base_Order_model->sp_order_update($address,array('id'=>$id));
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
                        'msg'  => '操作无效,请刷新页面确认是否已经操作',
                        'type' => 1
                    );
                    echo json_encode($msg);
                    die;
                }


            }
        }
    }
}
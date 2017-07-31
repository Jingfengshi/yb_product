<?php
if(isset($sign))
{
	if(empty($_POST['data']['order_id']))
	{
		$d=array();
		$d['code']='S01';
		$d['msg']="作废订单不能为空";
	    $d['data']=array();//作废失败
		echo json_encode($d);	
	}
	else
	{
		$order_id=trim($_POST['data']['order_id']);
		$db->query("select  status,order_id,id   from   ".tab_m('order')
				  ." where 	userid='$outapi[userid]'  and  openid='$outapi[id]'  and  out_trade_no='".mysql_escape_string($order_id)."' "); 		 
		$order=$db->fetchRow();
		if(empty($order))
		{     
			$d=array();   
			$d['code']='S02';
			$d['msg']="订单".$order_id."无效";
			$d['data']=array();//作废失败
			echo json_encode($d);	
		}
		else
		{
			if($order['status']!=3)
			{
				$db->query("select   status from ".tab_m('dosned')."  where  order_id='$order[order_id]' ");
				$de=$db->fetchRow();
				if(empty($de))
				{
					//生成作废请求数据
					/*
					$falg=$db->query("INSERT INTO  ".tab_m('51jiancang_outapi_order_close')."
							 (`userid`,`openid`, `out_trade_no`, `order_id`,`status`,`add_time`,`do_status`)
							  VALUES ('$outapi[userid]','1','$order_id','$order[order_id]','2','".date('Y-m-d H:i:s')."','1')");	
					*/	
					//  in(1,2)
					
					
					$db->query("update  ".tab_m('order')."   set  close_status=1   where   close_status=0  and  status=1  and id='$order[id]'   ");				
					$db->query("select  sp_userid,status,hg_status,close_status,order_id  from  ".tab_m('order')." 
					            where  id='$order[id]'  ");	
					$row=$db->fetchRow();
					$db->query("select  api_id as id   from  ".tab_m('sp_openapi')."  where  userid='$row[sp_userid]'  ");	
					$api=$db->fetchRow();
					$api['id']=empty($api['id'])?0:$api['id'];
					$db->query("select  id,status  from ".tab_m('dosend')."    where   type=4   and  order_id='$row[order_id]' ");
					$dosend=$db->fetchRow();
					if(empty($dosend))
					{
						if(!empty($row)&&$row['close_status']==1) 
						{
							//未申报或申报失败  //状态为海关审核中  //非正在申报
							if($row['status']!=3)	
							{	
								//锁定作废功能
								//推送订单必须先修改close_status 推送订单先 close_status=-1 锁定作废功能
								if($row['status']==2)  //说明已经申报
								{
									if(!empty($api))
									{
										$sql="INSERT INTO ".tab_m('dosend')." (`api_id`,`type`,`con`,`order_id`,`status`,`uptime`) 
											  VALUES ('$api[id]','4','无','$row[order_id]','1','".date('Y-m-d H:i:s')."')";		   
										$falg=$db->query($sql);
									}
									else
									{
									   //商户订单不需要要作废
									
									}
								}
								else
								{
									//判断是否正在推送中
									$db->query("update ".tab_m('dosend')."  set status='-2' 
									            where status in(1,-1) and type=1 and order_id='$row[order_id]' ");	   
									$db->query("INSERT INTO ".tab_m('dosend')." (`api_id`,`type`,`con`,`order_id`,`status`,`uptime`) 
										  VALUES ('$api[id]','4','无','$row[order_id]','1','".date('Y-m-d H:i:s')."')");
								}
							}
						}
					}
						  
					if(!empty($falg))
					{	
						$d=array();	  	
						$d['code']='0';
						$d['msg']="SUCCESS";
						$d['data']['status']="1";//作废提交成功
						$d['data']['con']="提交成功";//作废提交成功
						echo json_encode($d);	
					}
					else
					{
						$d=array();
						$d['code']='S03';
						$d['msg']="系统异常";
						echo json_encode($d);	
					}
				}
				else
				{
					$d=array();
					$d['code']='0';
					$d['msg']="SUCCESS";
					$d['data']['status']=$de['status'];//作废提交成功
					$str_status=array('-1'=>'作废失败已发货',2=>'正在作废申请',3=>'作废成功');
					if(!empty($str_status[$de['status']]))
						$d['data']['con']=$str_status[$de['status']];//作废提交成功
					echo json_encode($d);	
				}
			}
			else
			{
				$d=array();
				$d['code']='0';
				$d['msg']="SUCCESS";
				$d['data']['status']="-1";//作废提交成功
				$d['data']['con']="作废失败已发货";//作废提交成功
				echo json_encode($d);		 		
			}
		}
	}
}
else
	die('ERROR');

?>
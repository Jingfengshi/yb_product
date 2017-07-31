<?php
if(isset($sign))
{
	$order_id=$data['order_id'];
	$ar=explode(',',$data['order_id']);
	$num=count($ar);
	$wsql='';
	
	if(empty($ar))
		get_apiencode("S104",'无效订单号'.$ReceiveAreaName,1);
		
	if($num==1)
		$wsql="  and  order_id='$order_id'  ";
	else
		$wsql="  and  order_id in ('".implode("','",$ar)."')  ";
			
	$db->query("select  order_id,f_time as ftime,add_time as creatime,
	            logistics_type as billno_type,logistics_no as billno,status 
				from   ".tab_m('order_ls')."  where  userid='$outapi[userid]' ".$wsql);
	$d['list']=$db->getRows();
	
	if(empty($d))
		get_apiencode("S104",'无效订单号'.$ReceiveAreaName,1);
	$de['data']=$d;
	$de['code']='0';
	$de['msg']="SUCCESS";
	echo json_encode($de);
}
?>
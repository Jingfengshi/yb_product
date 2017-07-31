<?php
if(isset($sign))
{
	if(!empty($data['stime']))
    {
	   $y=substr($data['stime'],0,4);  //y
	   $m=substr($data['stime'],4,2);  //m
	   $d=substr($data['stime'],6,2);  //d
	   $h=substr($data['stime'],8,2);  //h
	   $i=substr($data['stime'],10,2); //i
	   $s=substr($data['stime'],12,2); //s
	   if(!$h)
		   $h='00';
	   if(!$i)
		   $i='00';
	   if(!$s)
		   $s='00';
	   $shy="{$y}-{$m}-{$d} $h:$i:$s";
    }
	else
	   $shy=date("Y-m-d");
	
	if(!empty($data['etime']))
    {
	   $y=substr($data['etime'],0,4);  //y
	   $m=substr($data['etime'],4,2);  //m
	   $d=substr($data['etime'],6,2);  //d
	   if(!$h)
		   $h='00';
	   if(!$i)
		   $i='00';
	   if(!$s)
		   $s='00';
	     $ehy="{$y}-{$m}-{$d} $h:$i:$s";
    }
	else
        $ehy=date("Y-m-d 23:59:59");
		   
	if($data['type']==1)
		$wsql="  and  add_time  between  '$shy'  and  '$ehy'  order by id ";
	else
		$wsql="  and  f_time  between  '$shy'  and  '$ehy'  order by id ";
		
	$db->query("select order_id,f_time as ftime,add_time as creatime,
	            logistics_type as billno_type
	           ,logistics_no as billno,status   from 
			   ".tab_m('order_ls')."  where 	userid='$outapi[userid]'   $wsql   limit 0,100 ");	
	$re=array();
	$d=array();
	$d['code']=0;
	$d['msg']="success";
	$d['stime']=$data['stime'];
	$d['etime']=$data['etime'];
	$d['data']=$re;
	echo json_encode($d);

}

?>
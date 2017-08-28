<?php
if(isset($sign))
{
	$startlimit=intval($data['startlimit']*1);
	$startlimit=$startlimit<=1?1:$startlimit;
	if(isset($data['stime']))
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
		   $shy="{$y}-{$m}-{$d} 00:00:00";
		}
		else
		   $shy=date("Y-m-d 00:00:00");
		if(!empty($data['etime']))
		{
		   $y=substr($data['etime'],0,4);  //y
		   $m=substr($data['etime'],4,2);  //m
		   $d=substr($data['etime'],6,2);  //d
		   $h=substr($data['stime'],8,2);  //h
		   $i=substr($data['stime'],10,2); //i
		   $s=substr($data['stime'],12,2); //s
		   if(!$h)
			   $h='00';
		   if(!$i)
			   $i='00';
		   if(!$s)
			   $s='00';
		   $ehy=date("Y-m-d H:i:s",strtotime("{$y}-{$m}-{$d}")+60*60*24);
		}
		else
		   $ehy=date("Y-m-d H:i:s",strtotime(date("Y-m-d"))+60*60*24);
		$wsql="  and uptime>='$shy' and uptime<='$ehy' ";
	}
	else
		$wsql="";    
	//---物流系统直邮查询--------	
	if($data['hg_type'])
		$wsql.="  and hg_type=".$data['hg_type'];    
	if(empty($startlimit))
		get_apiencode('','{"code":"S02","msg":"查询页不能为空"}',2);	
    $sql="select count(*) as num from  ".tab_m('seller_product')."  where 
		  status=1  and  userid='$outapi[userid]' {$wsql} ";
	$db->query($sql);
	$num=$db->fetchField('num');
	$page_num=10; //每页显示数
	if(ceil($num/$page_num)<$startlimit||$startlimit<0)
		get_apiencode('','{"code":"S03","msg":"超出查询范围","page_nums":"'.ceil($num/$page_num).'","nums":"'.$num.'"}',2);	
	if($startlimit>=1)
	     $startlimit=($startlimit-1)*2;
	else
	     $startlimit=0;
	$sql="select id as ProductID,stock_id,ls_lock_num as c_num,online_num,price,mark_price from   
	     ".tab_m('seller_product')."  
	     where status=1  and userid='$outapi[userid]'  {$wsql}  order by id desc limit {$startlimit},$page_num ";
	$db->query($sql);
	$re=$db->getRows();
	if(!empty($re))
	{
		$da=array();
		foreach($re as $k=>$de)
		{
			$db->query("select  warehouse_id  from  ".tab_m('stock')." where  id='$de[stock_id]' ");
			$r=$db->fetchRow();
			$de['name']=$r['name'];
			$de['warehouse_id']=$r['warehouse_id'];
			$de['barcode']=$r['barcode'];
			$de['mark_price']=$r['mark_price']>0?$r['mark_price']:$de['mark_price'];
			$de['function']=$r['gn'];
			$de['weight']=$r['mz'];
			if(file_exists($config['webpath']."../pt_image/".$de['stock_id'].".jpg"))
				$de['pic']=$config['weburl']."/pt_image/".$de['stock_id'].".jpg";
			else
				$de['pic']='';
			$da[]=$de;
			unset($re[$k],$r);
		}
		
		$data['data']['list']=$da;
		$data['data']['nums']=$num;
		$data['data']['page_nums']=ceil($num/$page_num);
		$data['code']=0;
		$data['msg']="SUCCESS";
		echo json_encode($data);
	}
	else
		echo '{"code":"S02","msg":"查询不到任何数据"}';
}
else
	die('ERROR');
?>

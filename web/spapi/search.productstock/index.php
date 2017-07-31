<?php
if(isset($sign))
{
	$startlimit=intval($_POST['data']['startlimit']*1);
	$data=$_POST['data'];
	unset($_POST);
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

	if(empty($startlimit))
		get_apiencode('','{"code":"S02","msg":"查询页不能为空"}',2);	
		
    $sql="select count(*) as num from  ".tab_m('seller_product')."  where  userid='$outapi[userid]'  and uptime>='$shy' and uptime<='$ehy' ";
	$db->query($sql);
	 
	$num=$db->fetchField('num');
	if(ceil($num/50)<$startlimit||$startlimit<0)
		get_apiencode('','{"code":"S03","msg":"超出查询范围每页50","page_nums":"'.ceil($num/50).'","nums":"'.$num.'"}',2);	
	$startlimit=$startlimit*1>=1?$startlimit:1;	
	$startlimit=($startlimit-1)*50;
	
	$sql="select id as ProductID,if(status=2,c_num,0) as c_num,
	     if(status=2,online_num,0) as online_num,status,warehouse_id,price
		 ,if(status=2,1,0) as status from   
	     ".tab_m('seller_product')." 
		 where userid='$outapi[userid]' and uptime>='$shy' and uptime<='$ehy'
		 order by status desc limit {$startlimit},50 ";
	$db->query($sql);
	$re=$db->getRows();
	
	if(!empty($re))
	{
		$data['data']['list']=$re;
		$data['data']['nums']=$num;
		$data['data']['page_nums']=ceil($num/50);
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

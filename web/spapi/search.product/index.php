<?php
if(isset($sign))
{
	$productid=$_POST['data']['ProductID']*1;
	unset($_POST);
	if(empty($productid))
		get_apiencode('','{"code":"S02","msg":"产品编号为空"}',2);	
	$sql="select  id as ProductID,stock_id,if(status=2,c_num,0) as c_num,if(status=2,online_num,0) as online_num,price,mark_price,if(status=2,1,0) as status from   
	     ".tab_m('seller_product')."  where id='$productid'  and userid='$outapi[userid]'  ";
	$db->query($sql);
	$de=$db->fetchRow();
	if($de)
	{
		$db->query("select   cname as name,con,is_split,hg_type as shop_type,mz,max_num as num_max,gn,cf,gg,brand,country,warehouse_id,con
				    from  ".tab_m('stock')." where  id='$de[stock_id]' ");
		$r=$db->fetchRow();
		$de['con']=$r['con'];
		$de['name']=$r['name'];
		$de['warehouse_id']=$r['warehouse_id'];
		$de['shop_type']=$r['shop_type'];
		$de['mark_price']=$r['mark_price'];
		$de['is_split']=$r['is_split'];
		$de['weight']=$r['mz'];
		$de['component']=$r['cf'];
		$de['function']=$r['gn'];
		$de['guige']=$r['gg'];
		$de['brand']=$r['brand'];
		$de['weight']=$r['mz'];
		$de['num_max']=$r['num_max'];
		
		$de['pic']=$config['weburl']."/pt_image/".$de['stock_id'].".jpg";
		$db->query("select  name  from  ".tab_m('stock_warehouse')." where  id='$r[warehouse_id]' ");
		$de['warehouse_name']=$db->fetchField('name');
		unset($de['stock_id']);
		$data=array();
		$data['data']=$de;
		$data['code']=0;
		$data['msg']="SUCCESS";
		echo json_encode($de);
	}
	else
		echo '{"code":"S02","msg":"查询不到该产品"}';
}
else
	die('ERROR');
?>


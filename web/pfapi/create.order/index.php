 <?php
if(isset($sign))
{
	
	/**
	 * @param $ReceiveAreaName
	 * @return array
     */
	function get_addrtcode($ReceiveAreaName)
	{
		global $db;
		
		$addr=explode(',',$ReceiveAreaName);
		
		if(count($addr)!=3)
			get_apiencode("S14",'收货省市区错误必须以英文(,)分割如:省,市,区 三级',1);
		if(!$addr[1]||!$addr[2])	
			get_apiencode("S14",'收件地省市区不完整',1);
		$city=substr($addr[0],0,6);
		$db->query("select  id  from  ".tab_m('district')."  where pid=0  and  name like '$city%' limit 1");
		$cid=$db->fetchField('id')*1;  //省ID
		$ids=substr($cid,0,2);
		$ReceiveAreaCode=1;
		if($ids)
		{  
			$code=array('北京'=>'110100','天津'=>'120100','重庆'=>'500100','上海'=>'310100');
			$ReceiveAreaCode=isset($code[$city])?$code[$city]:'';
			if(empty($ReceiveAreaCode))	
			{	 
				$area=substr($addr[1],0,9);
				if($area)
				{
					$sql="select  pid,id  from  ".tab_m('district')."  where id like '$ids%' and  
						  name like '$area%' order by id asc limit 1     ";
					$db->query($sql);
					$are=$db->fetchRow();  //市 区ID
					$ReceiveAreaCode=$are['id'];
					//----------------如果第二级不存在-------
					if(empty($ReceiveAreaCode))	
					{
						$area=substr($addr[2],0,9);
						$db->query("select  pid,id,name  from  ".tab_m('district')."  where id like '$ids%' and  
									  name like '$area%' and pid!=0 order by id desc");
						$res=$db->getRows();  //市 区ID
						
						if(empty($res))
							get_apiencode("S14",'收货地址省市区不匹配 [原地址>>'.$ReceiveAreaName,1);
						if(empty($res[1]))
						{
							$pid=$res[0]['pid'];
							$db->query("select  name  from  ".tab_m('district')."  where id='$pid' order by id desc limit 1");
							$name=$db->fetchField('name');		
							get_apiencode("S14",'收货地址不存在：推荐地址:'.$addr[0].',【'.$name.'】,'.$addr[2]." [原地址 >>".$ReceiveAreaName,1);			 
						}
						else
						{
							$name='';
							foreach($res as $v)
							{
								$db->query("select  name  from  
											 ".tab_m('district')."  where id='$v[pid]'  and pid!=0 order by id desc limit 1");
								$sname=$db->fetchField('name');	
								if($sname)		 
									$name.=($name?" 或 ":'').$sname;					 
							}
							get_apiencode("S14",'[收货地址不存在]：推荐地址:'.$addr[0].',【'.$name.'】,'.$addr[2]." [原地址 >>".$ReceiveAreaName,1);	
						}
					}
					else
					{
						if(empty($are['pid']))
							get_apiencode("S14",'收货地址第二级错误:'.$ReceiveAreaName,1);
					}
					
					//地级市级市
					if(substr($ReceiveAreaCode,4,2)!='00')
					{
						$db->query("select  id,name  from  ".tab_m('district')."  where id='$are[pid]' order by id desc ");
						$s=$db->fetchRow();  //市 区ID
						$addr[0]=$addr[0];
						$addr[3]=$addr[2];
						$addr[2]=$addr[1];
						$addr[1]=$s['name'];
						if($addr[2]==$addr[3])
							unset($addr[3]);
						$ReceiveAreaCode=$s['id'];
					}
					if(substr($ReceiveAreaCode,4,2)!='00'||substr($ReceiveAreaCode,2,2)=='00'||empty($ReceiveAreaCode))
						get_apiencode("S14",'地区省份错误 [原地址>>'.$ReceiveAreaName,1);
				}
			}
			else
			{
				$city1=substr($addr[1],0,6);
				if($city!=$city1)
				{
					$addr[0]=$addr[0];
					$addr[3]=$addr[2];
					$addr[2]=$addr[1];
					$addr[1]=$city."市";
				}
				else
					$addr[1]=$city."市";
			}
		}
		else
			get_apiencode("S14",'地区省份错误 [原地址>>'.$ReceiveAreaName,1);
		return array($ReceiveAreaCode,$addr,);
	}

	/**
	 * 查找运费id
	 * @param $warehouse_id  仓库ID
	 * @param $city_id       省编号
	 * @param $weight        重量
	 */
	function get_temp_price($warehouse_id,$city_id,$weight)
	{
		global $db;
		$db->query("select  logistics_temp_id_ls  from   ".tab_m('stock_warehouse')."  where  id='".$warehouse_id."'   limit 1  ");
		$id=$db->fetchField('logistics_temp_id_ls');
		//根据运费模板id  查询相应城市的运费的运费模板
		$db->query("select default_num,default_price,add_num,add_price  from  
				   ".tab_m('logistics_temp_con')."  where  temp_id='".$id."' and  define_cityid='".$city_id."'  and status=1  limit 1  ");
		$d=$db->fetchRow();
		$de=array();
		if(!empty($d))
		{
			if($weight<=$d['default_num'])
			   $fee=$d['default_price'];
			else
				$fee=ceil(($weight-$d['default_num'])/$d['add_num'])*$d['add_price']+$d['default_price']; 
			$de['sum_weight_price']=number_format($fee,2,'.',',');	
		}
		return $de;
	}
    
	$_POST['email']='?';
	$check_api=array(
			'order_id'=>array(0=>12,1=>get_apiencode('S12',"订单不能为空")),
			'payment_money'=>array(0=>13,1=>get_apiencode("S13","产品总价必须为大于0的数字")),
			'ReceiveName'=>array(1=>get_apiencode('S16','收货人不能为空')),
			'ReceiveAreaName'=>array(0=>17,1=>get_apiencode('S17','收货省市区错误必须以英文(,)分割如:省,市,区 三级')),
			'ReceiveAddress'=>array(1=>get_apiencode('S18','收货地址不能为空')),
			'mobile'=>array(0=>20,1=>get_apiencode('S20','手机号码格式错误')),
		 );

	/** 
	 * @param $num
	 * @param $str
	 * @return bool
	 */
	function check_api_name($num, $str)
	{
		if($num==12)
			return strlen($str)<=32;
		if($num==13)//产品总价
			return is_numeric($str)||$str>0;
		$City = array(11=>"北京",12=>"天津",13=>"河北",14=>"山西",15=>"内蒙古",21=>"辽宁",22=>"吉林",23=>"黑龙江",31=>"上海",32=>"江苏",33=>"浙江",34=>"安徽",35=>"福建",36=>"江西",37=>"山东",41=>"河南",42=>"湖北",43=>"湖南",44=>"广东",45=>"广西",46=>"海南",50=>"重庆",51=>"四川",52=>"贵州",53=>"云南",54=>"西藏",61=>"陕西",62=>"甘肃",63=>"青海",64=>"宁夏",65=>"新疆",71=>"台湾",81=>"香港",82=>"澳门",91=>"国外");
		if($num==23)   //身份证
			return ( !preg_match("/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}(\d|x|X)$/",$str)
				||!array_key_exists(substr($str,0,2),$City))||!openpi_isCnNewID($str)?FALSE:TRUE;
		if($num==20)
			return ( ! preg_match("/^1[1-9]{1}[0-9]{1}[0-9]{8}$|14[57]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/",$str))?FALSE:TRUE;
		if($num==21)
			return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
		if($num==14)
			return in_array($str,array(112,114,117,118));

		if($num==26)
			return !preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$str)||strlen($str)<6?FALSE : TRUE;

		if($num==17)
			return count(explode(',',$str))==3;
		if($num==25||$num==24)
			return is_numeric($str)||$str>=0;
		return true;
	}

	$warehouse_id='';
	$check_no_card=0;//非一般贸易
	$ProductID=array();
	$hg_type='';
	//查询订单是否是
	foreach($data['ItemList'] as $k=>$v)
	{
		if(empty($v['ProductID']))
			get_apiencode('S31','产品编码不能为空',1);

		if(in_array($v['ProductID'],$ProductID))
			get_apiencode('S31','订单中'.$ProductID.'有两个相同的产品ID请合并再提交',1);
		$ProductID[]=$v['ProductID'];

		$v['Quantity']*=1;
		if($v['Quantity']<=0||!is_int($v['Quantity']))
			get_apiencode('S32','销售数量必须是大于0的整数',1);

	    $db->query("select   stock_id    from  ".tab_m('seller_product')."  where stock_id='"
				   .$v['ProductID']."'  and  userid='".$outapi['userid']."'  limit 1  ");
				   
		$stock_id=$db->fetchField('stock_id');
		
		if(empty($stock_id))
			get_apiencode('S31','订阅编码'.$v['ProductID']."--".$stock_id." 不存在",1);
				
	    $db->query("select   status,warehouse_id    from  ".tab_m('stock')."  where id='$stock_id'   limit 1  ");  
		$stock=$db->fetchRow();
		
		if(empty($stock['warehouse_id']))
			get_apiencode('S31','订阅编码'.$v['ProductID']." 仓库异常",1);

		if(!empty($warehouse_id)&&$warehouse_id!=$stock['warehouse_id'])
			get_apiencode('S31','同一个订单不能包含多个仓库的产品',1);
			
		if(empty($warehouse_id))
			$warehouse_id=$stock['warehouse_id']*1;
				
		//是否是一般贸易
		//if($stock['hg_type']==3)
			$check_no_card=1;
	}

	//===非保税必要信息========
	if($check_no_card==1)
	{
		unset($check_api['pay_type'],$check_api['pay_number'],$check_api['IDCardNumber'],$check_api['IDCardName']);	
	}

	//不可为空
	foreach($check_api as $k=>$v)
	{
		if(empty($data[$k]))
			get_apiencode('',$v[1],2);

		if($v[0]&&!check_api_name($v[0],$data[$k]))
			get_apiencode('',$v[1],2);
	}

	//可为空
	foreach($check_api_null as $k=>$v)
	{
		if($v[0]&&!check_api_name($v[0],$data[$k]))
			get_apiencode('',$v[1],2);
	}

	//===非保税必要信息======
	if(empty($check_no_card)&&in_array($data['pay_type'],array(112,118,114)))	
	{
		$data['pay_number']=trim($data['pay_number']);
		if(!is_numeric($data['pay_number'])||strlen($data['pay_number'])<28)
			get_apiencode('S33','支付号错请使用真实的支付号',1);
	}
	

	$sql="select id,seller_price,logcs_weight  from  ".tab_m('order_ls')."  where  
		  order_id='".trim($data['order_id'])."'  and userid='$outapi[userid]'   ";
	//导入编号检测-------------

	$db->query($sql);
	$de=$db->fetchRow();
	if(!empty($de))
	{
		get_apiencode('','{"code":0,"msg":"订单号已经存在","data":{"price":'.$de['seller_price'].',"weight_price":'.$de['logcs_weight'].'}}',2);
	}

	//-----------申报价格
	$seller_price=0;
	$price_rate=0;
	$pnum=0;
	//$pname='';
	
	//-----------供应单价-------用于非对接
	$sum_sp_price=0;
	
	$ReceiveAreaName=str_replace(array(" ",','),'',$data['ReceiveAreaName']);
	$addr=get_addrtcode($data['ReceiveAreaName']);
	$data['ReceiveAreaCode']=$addr[0];
	$data['ReceiveAreaName']=$addr[1][0].",".$addr[1][1].",".$addr[1][2];
	$ReceiveAddress=str_replace(array(" ",','),'',$data['ReceiveAddress']);
	if($ReceiveAreaName==substr($ReceiveAddress,0,strlen($ReceiveAreaName)))
		$ReceiveAddress=substr($ReceiveAddress,strlen($ReceiveAreaName));
	$data['ReceiveAddress']=$addr[1][3].$ReceiveAddress;

	$sum_weight=0;  //重量
	$pnum=0;        //总产品数
	$sp_userid=0;   //供应UID

	foreach($data['ItemList'] as $k=>$v)
	{
		$v['Quantity']*=1;

		//查询分销商的产品
		$db->query("select   id,stock_id,userid,ls_lock_num-online_num as num,price as kjt_price,status  from  
		           ".tab_m('seller_product')."  where  userid='$outapi[userid]'  and  stock_id='".($v['ProductID']*1)."'   limit 1  ");  
		$de=$db->fetchRow();

		if($de['num']<0)
			get_apiencode('S32','平台编号['.$de['stock_id'].'] 库存不足',1);

		if($de['status']!=1)
			get_apiencode('S32','产品已下架',1);

		//供应商
		$db->query("select  price,userid,is_split,c_num,online_num,send_num,id,out_product_id,status  from  
		           ".tab_m('sp_product')."  where  stock_id='".$de['stock_id']."'   limit 1  ");  
		$dd=$db->fetchRow();
		
		//剩余总库存等于=总库存-已发送库存
		if($dd['c_num']-$dd['online_num']<0)
			get_apiencode('S32','平台编号['.$de['stock_id'].']  库存异常总库存请联系管理员',1);
		
		if($de['kjt_price']<$dd['price'])
			get_apiencode('S32','平台编号['.$de['stock_id'].'] 分销价小于供应价 ',1);
		
		$db->query("select  cname as name,is_shop,rate as kjt_rate,warehouse_id,is_split,mz,status,hg_type  from  
		           ".tab_m('stock')."  where  id='".$de['stock_id']."'   limit 1  ");  
		$d=$db->fetchRow();

		if(empty($de)||empty($d))
			get_apiencode('S35','查询不到该['.$v['ProductID'].'] 对接编码对应的产品',1);
			
		
		if($d['status']==-1 || $dd['status']==0 )
		{
			get_apiencode('S35','产品编号['.$v['ProductID'].']-平台编号['.$de['stock_id'].'] 暂时禁止销售',1);
		}
		
		unset($d['status']);
		$de=array_merge($de,$d);
		$sp_userid=$dd['userid'];	

		//修改改时产品下架进行修改---------或者库存有疑问下架
	    if($de['is_shop']=='-1')
			get_apiencode('S35','产品编号['.$v['ProductID'].']-平台编号['.$de['stock_id'].']平台已下架',1);
		
		
		$weight=0;	
		//----------毛重----------
	    if($de['mz']>0)		
			$weight=$de['mz']*$v['Quantity'];
		else
			get_apiencode('S35','查询不到 平台编号['.$de['stock_id'].']的毛重',1);
			
		$sum_weight+=$weight;
		if($de['num']<$v['Quantity'])
			get_apiencode('S36','平台编号['.$de['stock_id'].']库存不足目前只有'.($de['num']),1);
		
		if($de['kjt_price']*1<=0)
			get_apiencode('S36','平台编号['.$de['stock_id'].']分销定价异常',1);	
		
		//-----------分销价
		$seller_price+=$de['kjt_price']*$v['Quantity'];
		
		//-----------供价格
		$sum_sp_price+=$dd['price']*$v['Quantity'];
		
		if(empty($check_no_card))
		{
			$p_rate=$v['Quantity']*sprintf("%.2f",$de['kjt_price']*$de['kjt_rate']);
			$pnum+=$v['Quantity'];
			$price_rate+=$p_rate;
		}
	 }

	if(empty($check_no_card))
	{
		if($sum_weight>5000&&empty($check_no_card))
			 get_apiencode('S36','重量不能超过5KG',1);	
	}

	$db->query("select  logistics_temp_id_ls  from   ".tab_m('stock_warehouse')."  where  id='".$warehouse_id."'   limit 1  ");  
	$logistics_temp_id=$db->fetchField('logistics_temp_id_ls');
	if(empty($logistics_temp_id))
		get_apiencode('S77','仓库 ['.$warehouse_id."] 无运费模板",1);	
	else
	{
		$de=get_temp_price($warehouse_id,substr($data['ReceiveAreaCode'],0,2)."0000",$sum_weight);
		if(empty($de))
			get_apiencode('S78','仓库 ['.$warehouse_id."] 无该收货地址运费模板",1);
		$sum_weight_price=$de['sum_weight_price'];
	}

	$price_rate=sprintf("%.2f",$price_rate);
	$money=$price+$sum_weight_price+$price_rate;//加运费

	 //$pname=mysql_escape_string($pname);
	 if(!empty($data['create_time']))
	 {
		 $y=substr($data['create_time'],0,4);  //y
		 $m=substr($data['create_time'],4,2);  //m
		 $d=substr($data['create_time'],6,2);  //d
		 $h=substr($data['create_time'],8,2);  //h
		 $i=substr($data['create_time'],10,2); //i
		 $s=substr($data['create_time'],12,2); //s
		 if(!$h)
		    $h='00';
		 if(!$i)
			$i='00';
		 if(!$s)
			$s='00';
		 $hy=strtotime("$y-$m-$d $h:$i:$s");
		 if($hy==strtotime(''))
		 	$hy=date("Y-m-d H:i:s",time());
		 else
		 	$hy=date("Y-m-d H:i:s",$hy);
	 } 
	 else
	 	$hy=date("Y-m-d H:i:s",time());
	
	 $paytype=2;
	 $paytypestr='';	
	 $data['email']="1";	
	 $payment_name='';
	 $payment_type=0;
	 $cashflow_id=0;
	 $card_name='';
	 $card_no='';		
	 
	 /*
	 	说明： product_price  供应货值
		      payment_money  渠道销售金额
			  seller_price   平台销售货值 	
	 */

	 $sql="INSERT INTO ".tab_m('order')." 
		 (`sp_userid`, `order_id`, `userid`, `company`
		 , `warehouse_id`, `consignee`, `province_id`, `consignee_address`
		 ,`consignee_mobile`, `product_price`, `seller_price`,`logistics_type`,`logistics_no`, `rate_price`
		 ,`payment_type`,`cashflow_id`, `card_name`, `card_no`
		 ,`payment_money`, `logcs_weight`, `logcs_price`
		 ,`status`, `add_time`, `hg_status`) 
		  VALUES('$sp_userid','".$data['order_id']."','{$outapi[userid]}','".$data['company']."'
		  ,'$warehouse_id','".$data['ReceiveName']."','".$data['ReceiveAreaCode']."','".mysql_escape_string($data['ReceiveAreaName'].",".$data['ReceiveAddress'])."'
		  ,'$data[mobile]','".$sum_sp_price."','".$seller_price."','".$logistics_type."','','$rate_price'
		  ,'$payment_type','$cashflow_id','$card_name','$card_no'
		  ,'".$data['payment_money']."','$weight','$sum_weight_price'
		  ,'1','".date('Y-m-d H:i:s')."', '".$hg_type."'
		  )";
		  
	$falg=$db->query($sql);
	$order_id=$db->lastid();
	if(empty($falg)||$db->get_row_up_num()===false)
		get_apiencode('S78',"创建订单失败",1);

	foreach($data['ItemList'] as $k=>$v)
	{
		//查询分销商的产品
		$db->query("select   id,stock_id,userid,ls_lock_num-online_num as num,price as kjt_price,status  from  
		           ".tab_m('seller_product')."  where  userid='$outapi[userid]'  and  stock_id='".($v['ProductID']*1)."'   limit 1  ");
		$de=$db->fetchRow();
		$stock_id=$de['stock_id'];
		$price=$de['kjt_price'];

		//供应商
		$db->query("select id, price,userid,is_split,name,c_num,online_num,send_num,id,out_product_id,status  from  
		           ".tab_m('sp_product')."  where  stock_id='".$stock_id."'   limit 1  ");
		$dd=$db->fetchRow();

		$db->query("select  cname as name,is_shop,rate as kjt_rate,warehouse_id,is_split,mz,status,hg_type  from  
		           ".tab_m('stock')."  where  id='".$de['stock_id']."'   limit 1  ");
		$d=$db->fetchRow();
		
		$sp_id=$dd['id'];
		$sp_uid=$dd['userid'];
		$weight=$d['mz'];
		$sp_price=$dd['price'];
		$ss_price=$v['price']*1;
		
		$sql="INSERT INTO ".tab_m('order_pro')." 
			 (`sp_id`,`sp_uid`,`userid`,`stock_id`,`order_id`,
			  `name`,`sp_name`,`price`,`sp_price`,`ss_price`,`weight`,`num`,`status`) 
			 VALUES ('{$sp_id}','{$sp_uid}','{$outapi[userid]}','{$stock_id}',
			 '{$order_id}','".mysql_escape_string($v['Productname'])."','".
			 mysql_escape_string($dd['name'])."','{$price}','{$sp_price}','{$ss_price}','{$weight}',
			 '{$v[Quantity]}',0) ";
		$db->query($sql); 
		$db->query("update ".tab_m('seller_product')." set online_num=online_num+'".$v['Quantity']."'  where  id='".$de['id']."'  ");
	}

	//============================================================================
	get_apiencode('','{"code":0,"msg":"SUCCESS","data":{"price":'.$seller_price.',"weight_price":'.$sum_weight_price.'}}',2);
}
else
	die('{"code":"S2","msg":"服务器异常"}');


?>
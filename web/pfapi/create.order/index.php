 <?php
if(isset($sign))
{
	echo '<pre>';
	print_r($data);
	
	
	$seller_id=$_POST['sellerid'];//分销商id
	/**获取地址信息
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
	 * 查找订单列表
	 * @param $item
	 * @return array|bool
	 */
	function get_order_list($item)
	{
		global $seller_id;
		global $db;
		if (!is_array($item)) {
			return FALSE;
		}

		$result = array();

		foreach ($item as $k => $v) {
			$sql = "SELECT `a`.`id`,`a`.`warehouse_id`,`a`.`status`,`a`.`price`,`a`.`mark_price`,`b`.`name`
					, `b`.`c_num` as num ,`c`.`mz`,`a`.`stock_id`,`b`.`price` AS sp_price,`b`.`userid` AS sp_uid,`b`.`id` AS sp_id 
					FROM " . tab_m('seller_product') . " AS `a` LEFT JOIN " . tab_m('sp_product') . " AS `b` ON `a`.`stock_id` = `b`.`stock_id` 
					LEFT JOIN " . tab_m('stock') . "  AS `c` ON `c`.`id`=`a`.`stock_id`  WHERE
					`a`.`stock_id`=" . $v['ProductID'] . ' AND `a`.`status`=1  AND `a`.`userid`=' . $seller_id;
			$db->query($sql);
			$result[$k] = $db->fetchRow();
			$result[$k]['api_num'] = $v['Quantity'];
			$result[$k]['c_num'] = $v['Quantity'];
			$result[$k]['api_price'] = $v['Price'];
			$result[$k]['api_product_name'] = $v['Productname'];
		}
		foreach ($result as $k => $v) {
			if ($v['api_num'] > $v['num']) {
				get_apiencode("S30", '商品' . $v['name'] . '库存不足', 1);
			}
			if ($v['api_price'] != $v['price']) {
				get_apiencode("S31", '商品' . $v['name'] . '价格有误，请先同步商品', 1);
			}
		}

		return $result;
	}

	/**
	 * 查找运费id
	 * @param $warehouse_id
	 * @param $type
	 * @param $city_id
	 * @return mixed
	 */
	function search_temp_id($warehouse_id,$type,$city_id)
	{
		global $db;
		//首先确定发货的是哪个仓库,根据仓库查找运费模板(批发、零售)
		if($type==1)
		{//零售
			$field='logistics_temp_id_ls';
		}
		elseif ($type==2)
		{//批发
			$field='logistics_temp_id';
		}
		$sql="SELECT ".$field." FROM ".tab_m('stock_warehouse')." WHERE id=".$warehouse_id;
		$db->query($sql);
		$temp=$db->fetchRow();
		$temp['id']=$temp[$field];
		//根据运费模板id  查询相应城市的运费的运费模板
		$sql="SELECT * FROM ".tab_m('logistics_temp_con')." WHERE `temp_id`=".$temp['id']." AND `define_cityid`=".$city_id;
		$db->query($sql);
		$t=$db->fetchRow();
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

	function count_logistics_fee($temp_id,$weight)
	{
		global $db;
		$sql="SELECT * FROM ".tab_m('logistics_temp_con')." WHERE id=".$temp_id;
		$db->query($sql);
		$logistics=$db->fetchRow();
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
	 * 拆分订单  按照仓库拆分  主要用于购物车  和  形成供应商订单
	 * @param $item
	 * @param $key
	 * @return bool
	 */
	function explode_order($item,$key,$provice_id)
	{
		global  $db;
		$res[$key]=array();
		foreach( $item  as $k =>$v)
		{
			$res[$key][$v['warehouse_id']][]= $v;
			$temp_id=search_temp_id($v['warehouse_id'],2,$provice_id);
			if($temp_id===FALSE)
			{
				$msg= '仓库'.$v['warehouse_id'].',暂无匹配该收货地址的运费模板，请联系网站管理员';
				$res[$key][$v['warehouse_id']]['warehouse_logstics']= '无匹配该收货地址的运费模板';
				get_apiencode("S33", $msg, 1);
			}
			else
			{

				$sql="SELECT * FROM ".tab_m('logistics_temp_con')." WHERE id=".$temp_id;
				$db->query($sql);
				$info=$db->fetchRow();
				if($info['status']!=1)
				{
					$msg= '仓库'.$v['warehouse_id'].',匹配的收货地址的运费模板还未通过审核，请联系网站管理员';
					$res[$key][$v['warehouse_id']]['warehouse_logstics']= '收货地址运费模板未通过审核';
					get_apiencode("S34", $msg, 1);
	
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
				$res[$key][$k]['logistics_fee']=count_logistics_fee(search_temp_id($k,2,$provice_id),$res[$key][$k]['total_weight']);
	
			}
			$res['total_logistics_fee']+=$res[$key][$k]['logistics_fee'];
		}
		return $res;
	
	}

	/**
	 * 删减库存
	 * @param $arr  下单的商品数组
	 * @return bool
	 */
	function stock_decrease($arr)
	{
		global $db;
		$mark=1;
		$new_arr=array();
		foreach ( $arr as $k=>$v)
		{
			$sql='SELECT `online_num`,`c_num`,`name` FROM '.tab_m('sp_product').' WHERE `stock_id`='.$v['stock_id'];
			$db->query($sql);
			$in=$db->fetchRow();
			if($in['online_num']+$v['c_num']>$in['c_num'])
			{
				//如果下单数量 + 交易进行数已下单 > 库存数   说明库存不足
				$mark=2;
				get_apiencode("S33", $v['name'].'库存不足', 1);
				return $v['name'].'库存不足';
			}
			$new_arr[$k]=$v;
		}

		if($mark==1)
		{
			foreach ( $new_arr as $k=>$v)
			{
				$sql="UPDATE ".tab_m('sp_product')." SET `online_num`=`online_num`+{$v['c_num']} WHERE `stock_id`={$v['stock_id']}";
				$db->query($sql);
			}
			return TRUE;
		}
	}
	/**
	 *检查地址是否合法
	 * 获取到的是地区code
	 */
	$addr_code=get_addrtcode($data['ReceiveAreaName']);
	/**
	 * 只需要省份的code
	 */
	$province_id=substr($addr_code[0],0,2).'0000';
	//检查电话号

	//获取订单商品详情,检查库存是否不足
	$order_list=get_order_list($data['ItemList']);
	//形成格式化订单
	$key='order_list';
	$info=explode_order($order_list,$key,$province_id);
	$new_arr=array();//订单
	$new_arr1=array();//订单详情
	$new_arr2=array();//供应商库存减少
	$new_arr3=array();//供应商订单或对账单
	$new_arr5=array();//日志
	$new_arr['product_price']=$info['total_price'];
	$new_arr['logcs_weight']=$info['total_weight'];
	$new_arr['logcs_price']=$info['total_logistics_fee'];
	$new_arr['consignee'] = $data['ReceiveName'];
	$new_arr['consignee_mobile'] = $data['mobile'];
	$new_arr['consignee_address'] =$data['ReceiveAreaName'].$data['ReceiveAddress'];
	$new_arr['userid']=$seller_id;
	$new_arr['add_time']= date('Y-m-d H:i:s',time());
	$new_arr['sp_order_num']= count($info[$key]);


	//减去库存
	$stock_decrease=stock_decrease($order_list);
	if($stock_decrease===TRUE){
		//形成订单
		$sql="INSERT INTO ".tab_m('order')."(product_price,logcs_weight,logcs_price,consignee,consignee_mobile,consignee_address,userid,add_time,sp_order_num) VALUES (
		'{$new_arr['product_price']}','{$new_arr['logcs_weight']}','{$new_arr['logcs_price']}','{$new_arr['consignee']}','{$new_arr['consignee_mobile']}','{$new_arr['consignee_address']}','{$new_arr['userid']}','{$new_arr['add_time']}','{$new_arr['sp_order_num']}')";
		$db->query($sql);
		$order_id=$db->lastid();
		foreach ($order_list as $k=>$v)
		{
			$new_arr1[$k]['sp_id']=$v['sp_id'];
			$new_arr1[$k]['warehouse_id']=$v['warehouse_id'];
			$new_arr1[$k]['sp_uid']=$v['sp_uid'];
			$new_arr1[$k]['stock_id']=$v['stock_id'];
			$new_arr1[$k]['userid']=$seller_id;
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
		foreach ($new_arr1 as $k=>$v)
		{
			$sql="INSERT INTO ".tab_m('order_pro')." (sp_id,warehouse_id,sp_uid,stock_id,userid,seller_product_id,name,price,sp_price,weight,num,status,order_id) VALUES (
			'{$v['sp_id']}','{$v['warehouse_id']}','{$v['sp_uid']}','{$v['stock_id']}','{$v['userid']}','{$v['seller_product_id']}','{$v['name']}','{$v['price']}','{$v['sp_price']}','{$v['weight']}','{$v['num']}','{$v['status']}','{$v['order_id']}')";
			$db->query($sql);
		}
		
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
			$sql="INSERT INTO ".tab_m('sp_order')." (warehouse_id,sp_id,order_id,sp_total,seller_total,logcs_total_weight,logcs_price) VALUES (
			'{$v['warehouse_id']}','{$v['sp_id']}','{$v['order_id']}','{$v['sp_total']}','{$v['seller_total']}','{$v['logcs_total_weight']}','{$v['logcs_price']}')";
			$db->query($sql);
			$sp_order_id=$db->lastid();
			foreach ($info[$key][$k] as $k1=>$v1)
			{
				if(is_numeric($k1))
				{

					//供应商订单详情
					$new_arr5['order_id']=$order_id;
					$new_arr5['sp_order_id']=$sp_order_id;
					$new_arr5['order_id']=$v['order_id'];
					$new_arr5['seller_id']=$seller_id;
					$new_arr5['sp_id']=$v1['sp_uid'];
					$new_arr5['add_time']=date('Y-m-d H:i:s',time());
					$new_arr5['stock_id']=$v1['stock_id'];
					$new_arr5['seller_price']=$v1['price'];
					$new_arr5['sp_price']=$v1['sp_price'];
					$new_arr5['num']=$v1['c_num'];
					$new_arr5['name']=$v1['name'];
					$new_arr5['weight']=$v1['mz'];

					$sql="INSERT INTO ".tab_m('order_log')." (order_id,sp_order_id,order_id,seller_id,sp_id,add_time,stock_id,seller_price,sp_price,num,name,weight) VALUSE (
					'{$new_arr5['order_id']}','{$new_arr5['sp_order_id']}','{$new_arr5['order_id']}','{$new_arr5['seller_id']}','{$new_arr5['sp_id']}','{$new_arr5['add_time']}','{$new_arr5['stock_id']}','{$new_arr5['seller_price']}'
					,'{$new_arr5['sp_price']}','{$new_arr5['num']}','{$new_arr5['name']}','{$new_arr5['weight']}') ";
					$db->query($sql);
				}

			}
		}
		get_apiencode('','{"code":0,"msg":"SUCCESS","data":{"price":'.$info['total_price'].',"weight_price":'.$info['total_logistics_fee'].'}}',2);

	}
	else
	{
		get_apiencode("S33", '库存减少操作失败', 1);
	}


















}
else
	die('{"code":"S2","msg":"服务器异常"}');

?>
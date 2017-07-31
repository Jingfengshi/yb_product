<?php
$nva_menu=array(
	  			0=>array(
					 "name"=>'首页',
					 "action"=>"seller_index/index",
					 "m"=>"seller_index",
					 "ico"=>'icon-home',
					 'liclass'=>'start', //开始
					 "actions"=>array(
					  )	
				)
				,
				1=>array(
					 "name"=>'产品库',
					 "action"=>"product/product_list",
					 "m"=>"product",
					 "ico"=>'icon-table',
					 'liclass'=>'', //开始
					 "actions"=>array(
						 "product/dingyue"=>""
					  )	
				)
				,
				3=>array(
					 "name"=>'我的商品',
					 "action"=>"",
					 "m"=>"sproduct",
					 "ico"=>'icon-gift',
					 'liclass'=>'', //开始
					 "actions"=>array(
					     "sproduct/product_list"=>"我的商品",
						
					  )	
				),
				
				4=>array(
					 "name"=>'订单管理',
					 "action"=>"",
					 "m"=>"order",
					 "ico"=>'icon-table',
					 'liclass'=>'', //开始
					 "actions"=>array(
					     "order/order_list"=>"我的订单",
						 "order/delivery_address"=>"收货地址",
						 'order/cart_list'=>'购物车',
					  )	
				),
				8=>array(
					  "name"=>'账户管理',
					  "ico"=>'icon-male',
					  "m"=>"user",
					  "action"=>"",
					  'liclass'=>'', //结束的
					  "actions"=>array(
						 "user/info_passwd"=>"修改登陆密码"
					  )	
				)
			);



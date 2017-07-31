<?php
$nva_menu=array(
	  			0=>array(
					 "name"=>'首页',
					 "action"=>"sp_index/index",
					 "m"=>"sp_index",
					 "ico"=>'icon-home',
					 'liclass'=>'start', //开始
					 "actions"=>array(
					  )	
				)
				,
				2=>array(
					 "name"=>'运费模板',
					 "action"=>"",
					 "m"=>"logistics",
					 "ico"=>'icon-gift',
					 'liclass'=>'', //开始
					 "actions"=>array(
					     "logistics/company_list"=>"物流公司", 
					     "logistics/logistics_list"=>"运费模板", 
						 "logistics/logistics_add"=>""   //添加运费模板
					  )	
				)
				,
				3=>array(
					 "name"=>'我的商品',
					 "action"=>"",
					 "m"=>"product",
					 "ico"=>'icon-gift',
					 'liclass'=>'', //开始
					 "actions"=>array(
					     "product/product_list"=>"我的商品", 
						 "product/product_im"=>"导入商品", 
						 "product/product_add"=>"添加商品", 
						 "product/get_product_im"=>"",
						 "product/ajax_order_sub"=>""  //审核订单 批量作废 
					  )	
				),
				4=>array(
					"name"=>'我的订单',
					"action"=>"",
					"m"=>"order",
					"ico"=>'icon-gift',
					'liclass'=>'', //开始
					"actions"=>array(
					    "order/ls_order_list"=>"零售订单",
						"order/order_list"=>"批发订单",
						//"product/product_log"=>"商品日志",
					)
				),
				5=>array(
					  "name"=>'账户管理',
					  "ico"=>'icon-male',
					  "m"=>"user",
					  "action"=>"",
					  'liclass'=>'', //结束的
					  "actions"=>array(
						 "user/info_passwd"=>"修改登陆密码",
					     "user/info_edit"=>"提交企业资料"
					  )	
				)
			);

<?php
$nva_menu=array(
	  			0=>array(
					 "name"=>'首页',
					 "action"=>"seller_index/index",
					 "m"=>"info",
					 "ico"=>'icon-home',
					 'liclass'=>'start', //开始
					 "actions"=>array(
					  )	
				)
				,
				1=>array(
					 "name"=>'可订阅产品',
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
					 "name"=>'51建仓已订阅产品',
					 "action"=>"sproduct/product_list_ls",
					 "m"=>"sproduct",
					 "ico"=>'icon-gift',
					 'liclass'=>'', //开始
					 "actions"=>array(
					     "sproduct/product_list_ls"=>""
					  )	
				)
			);



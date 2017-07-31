<?php
$config['order_status'] = array(	
	1 => '待审核',
	2 => '已审核,待付款',
	3 => '已发货',
	4 => '交易完成',
   -1 => '已作废'
);

$config['order_payment_status'] = array(
	0 => '未付款',
	1 => '已付款,待确认',
	2 => '确认付款',
   -1 => '已退款'				
);			  

$config['stock_d_status'] = array(
	1 => '开启订阅',
    0 => '关闭订阅'				
);			  


$config['stock_k_status'] = array(
	1 => '库存可申请',
	0 => '库存不可申请',
   -1 => '关闭销售'				
);

$config['reconciliation_status']=array(
	0=>'未对账',
	1=>'已对账'
);
$config['delivery_status']=array(
	0=>'未发货',
	1=>'已发货',
   -1=>'已作废'
);

$config['order_pro_status']=array(
	0=>'未审核',
	1=>'已审核',
	2=>'已发货',
   -1=>'已作废'
);


$config['ls_order_status']=array(
	1=>'待发货',
	2=>'已发货',
   -1=>'已作废'
);

$config['ls_order_close_type']=array(
	1=>'无货',
	2=>'该地区无法发货',
    3=>'价格原因停止发货',
	4=>'其他原因停止发货'
);


$config['ls_product_status']=array(
	0=>'下架',
	1=>'上架'
);

//f_get_status

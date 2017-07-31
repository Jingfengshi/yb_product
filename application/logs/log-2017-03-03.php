<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-03-03 09:31:36 --> Query error: file:  line: ---Unknown column 'a.c.num' in 'field list' - Invalid query:  select `b`.`cname` as name, `a`.`c.num`, `a`.`price`,`b`.`mz`,`b`.`price` as sell_price,`b`.`cb_price`  from dferp_seller_product as `a` left join dferp_stock as `b` on `a`.`stock_id` = `b`.`id` where `a`.`userid`=1 and `a`.`c_num`>0
ERROR - 2017-03-03 09:31:36 --> Severity: Error --> Call to a member function result_array() on a non-object D:\phpstudy\WWW\yb_product\application\controllers\seller\Sproduct.php 40
ERROR - 2017-03-03 10:15:45 --> Query error: file:  line: ---You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.`price`-`b`.`cb_price`）as sp_price,`c`.`userid` as sp_uid,`c`.`id` as sp_id  ' at line 1 - Invalid query:  select `b`.`cname` as name, `a`.`c_num`, `a`.`price`,`b`.`mz`,（`b`.`price`-`b`.`cb_price`）as sp_price,`c`.`userid` as sp_uid,`c`.`id` as sp_id   from dferp_seller_product as `a` left join dferp_stock as `b` on `a`.`stock_id` = `b`.`id` left joindferp_sp_product as c on `c`.`stock_id`= `a`.`stock_id` where `a`.`userid`=1 and `a`.`c_num`>0
ERROR - 2017-03-03 10:15:45 --> Severity: Error --> Call to a member function result_array() on a non-object D:\phpstudy\WWW\yb_product\application\controllers\seller\Sproduct.php 42
ERROR - 2017-03-03 10:17:52 --> Query error: file:  line: ---You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.`price`-`b`.`cb_price`）as sp_price,`c`.`userid` as sp_uid,`c`.`id` as sp_id  ' at line 1 - Invalid query:  select `b`.`cname` as name, `a`.`c_num`, `a`.`price`,`b`.`mz`,（`b`.`price`-`b`.`cb_price`）as sp_price,`c`.`userid` as sp_uid,`c`.`id` as sp_id   from dferp_seller_product as `a` left join dferp_stock as `b` on `a`.`stock_id` = `b`.`id` left join dferp_sp_product as c on `c`.`stock_id`= `a`.`stock_id` where `a`.`userid`=1 and `a`.`c_num`>0
ERROR - 2017-03-03 10:17:52 --> Severity: Error --> Call to a member function result_array() on a non-object D:\phpstudy\WWW\yb_product\application\controllers\seller\Sproduct.php 42
ERROR - 2017-03-03 10:19:59 --> Query error: file:  line: ---You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.`price` - `b`.`cb_price`）as sp_price,`c`.`userid` as sp_uid,`c`.`id` as sp_id' at line 1 - Invalid query:  select `b`.`cname` as name, `a`.`c_num`, `a`.`price`,`b`.`mz`,（`b`.`price` - `b`.`cb_price`）as sp_price,`c`.`userid` as sp_uid,`c`.`id` as sp_id   from dferp_seller_product as `a` left join dferp_stock as `b` on `a`.`stock_id` = `b`.`id` left join dferp_sp_product as c on `c`.`stock_id`= `a`.`stock_id` where `a`.`userid`=1 and `a`.`c_num`>0
ERROR - 2017-03-03 10:19:59 --> Severity: Error --> Call to a member function result_array() on a non-object D:\phpstudy\WWW\yb_product\application\controllers\seller\Sproduct.php 42
ERROR - 2017-03-03 10:28:21 --> Severity: Parsing Error --> syntax error, unexpected ')' D:\phpstudy\WWW\yb_product\application\controllers\seller\Sproduct.php 53
ERROR - 2017-03-03 10:28:49 --> Query error: file:  line: ---You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'as sell_price -`b`.`cb_price`) as sp_price,`c`.`userid` as sp_uid,`c`.`id` as sp' at line 1 - Invalid query:  select `b`.`cname` as name, `a`.`c_num`, `a`.`price`,`b`.`mz`,(`b`.`price` as sell_price -`b`.`cb_price`) as sp_price,`c`.`userid` as sp_uid,`c`.`id` as sp_id   from dferp_seller_product as `a` left join dferp_stock as `b` on `a`.`stock_id` = `b`.`id` left join dferp_sp_product as c on `c`.`stock_id`= `a`.`stock_id` where `a`.`userid`=1 and `a`.`c_num`>0
ERROR - 2017-03-03 10:28:49 --> Severity: Error --> Call to a member function result_array() on a non-object D:\phpstudy\WWW\yb_product\application\controllers\seller\Sproduct.php 42
ERROR - 2017-03-03 10:40:59 --> Severity: Parsing Error --> syntax error, unexpected '}' D:\phpstudy\WWW\yb_product\application\controllers\seller\Sproduct.php 52
ERROR - 2017-03-03 10:41:01 --> Severity: Parsing Error --> syntax error, unexpected '}' D:\phpstudy\WWW\yb_product\application\controllers\seller\Sproduct.php 52
ERROR - 2017-03-03 10:41:02 --> Severity: Parsing Error --> syntax error, unexpected '}' D:\phpstudy\WWW\yb_product\application\controllers\seller\Sproduct.php 52
ERROR - 2017-03-03 10:41:07 --> Severity: Parsing Error --> syntax error, unexpected '}' D:\phpstudy\WWW\yb_product\application\controllers\seller\Sproduct.php 52
ERROR - 2017-03-03 10:50:20 --> Query error: file:  line: ---You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '`.`id` as seller_product_id, `a`.`c_num` as num, `a`.`price`,`b`.`mz` as weight,' at line 1 - Invalid query:  select `b`.`cname` as name,`a`.`stock_id`,`a`.`userid`,``a`.`id` as seller_product_id, `a`.`c_num` as num, `a`.`price`,`b`.`mz` as weight,`b`.`price`-`b`.`cb_price` as sp_price,`c`.`userid` as sp_uid,`c`.`id` as sp_id   from dferp_seller_product as `a` left join dferp_stock as `b` on `a`.`stock_id` = `b`.`id` left join dferp_sp_product as c on `c`.`stock_id`= `a`.`stock_id` where `a`.`userid`=1 and `a`.`c_num`>0
ERROR - 2017-03-03 10:50:20 --> Severity: Error --> Call to a member function result_array() on a non-object D:\phpstudy\WWW\yb_product\application\controllers\seller\Sproduct.php 42
ERROR - 2017-03-03 10:56:54 --> Query error: file: D:\phpstudy\WWW\yb_product\application\models\Base_Order_model.php line: 36---You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '0, 1) VALUES (Array, Array)' at line 1 - Invalid query: INSERT INTO `dferp_order_pro` (0, 1) VALUES (Array, Array)
ERROR - 2017-03-03 11:28:57 --> Severity: Error --> Call to undefined method Order::assign() D:\phpstudy\WWW\yb_product\application\controllers\seller\Order.php 128
ERROR - 2017-03-03 11:31:47 --> Severity: Error --> Call to undefined method Order::assign() D:\phpstudy\WWW\yb_product\application\controllers\seller\Order.php 128
ERROR - 2017-03-03 13:54:25 --> 404 Page Not Found: seller/Admin_index/admin_msg
ERROR - 2017-03-03 13:58:09 --> 404 Page Not Found: seller/Seller_index/admin_msg
ERROR - 2017-03-03 13:59:42 --> 404 Page Not Found: seller/Seller_index/admin_msg
ERROR - 2017-03-03 13:59:57 --> 404 Page Not Found: seller/Seller_index/admin_msg
ERROR - 2017-03-03 14:58:30 --> Severity: User Warning --> Smarty error: unable to read resource: "D:\phpstudy\WWW\yb_product\application\templates/seller/order_done.htm" D:\phpstudy\WWW\yb_product\application\libraries\smarty\Smarty.class.php 1121
ERROR - 2017-03-03 15:27:44 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:27:54 --> 404 Page Not Found: admin/Order/order_add
ERROR - 2017-03-03 15:32:56 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:33:00 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:33:07 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:37:22 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:37:53 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:38:28 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:43:06 --> 404 Page Not Found: admin/Order/order_add
ERROR - 2017-03-03 15:43:42 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:43:51 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:43:54 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:44:09 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:44:40 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:45:33 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:45:54 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:48:55 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:56:02 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:57:40 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:58:57 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:59:03 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:59:06 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 15:59:46 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:01:15 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:04:36 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:08:20 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:08:25 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:09:56 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:09:58 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:10:01 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:11:00 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:11:03 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:11:04 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:11:40 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:11:44 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:12:10 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:12:41 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:18:19 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:18:22 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:18:53 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:19:35 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:19:37 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:21:24 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:21:58 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:23:37 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:24:02 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:28:34 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:28:37 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:31:28 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:31:30 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:31:50 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:35:44 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:40:33 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:40:37 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:41:17 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:41:54 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:42:05 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:42:15 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:42:17 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:42:33 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:42:40 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:43:01 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:43:06 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:48:04 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:48:15 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:48:16 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:49:17 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:49:21 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:49:23 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:49:32 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:49:34 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:50:18 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:50:31 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:50:51 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:50:54 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:50:56 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:51:20 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:51:23 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:51:44 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:51:49 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:51:51 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:52:03 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:52:11 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 16:54:30 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:01:19 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:01:29 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:01:53 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:02:48 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:04:28 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:05:22 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:05:42 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:05:49 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:05:52 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:07:36 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:07:38 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:07:42 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:07:43 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:08:31 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:08:34 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:08:38 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:09:07 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:09:08 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:13:52 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:14:28 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:14:35 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:17:09 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:17:13 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:17:38 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:17:42 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:17:43 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:18:07 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:18:10 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:18:14 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:18:15 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:19:28 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:19:56 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:19:59 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:20:01 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:20:14 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:20:21 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:20:22 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:21:29 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:22:31 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:22:35 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:22:39 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:22:40 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:23:32 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:23:35 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:24:34 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:24:36 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:24:38 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:24:54 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:25:02 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:25:03 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:29:27 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:29:33 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:29:45 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:29:46 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:30:27 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:30:30 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:30:33 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:31:35 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:31:38 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:34:09 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:35:33 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:44:23 --> 404 Page Not Found: seller/Order/order_cash_info
ERROR - 2017-03-03 17:47:32 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:48:07 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:48:08 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:48:20 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:50:27 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:50:29 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:50:32 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:50:33 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:50:34 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:50:37 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:50:38 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:50:39 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:50:52 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 17:53:14 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 18:00:57 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 18:02:35 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 18:04:29 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 18:07:16 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 18:07:43 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 18:08:51 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 18:08:53 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 18:09:40 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 18:09:57 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71
ERROR - 2017-03-03 18:16:53 --> Severity: Warning --> Invalid argument supplied for foreach() D:\phpstudy\WWW\yb_product\application\core\MY_Controller.php 71

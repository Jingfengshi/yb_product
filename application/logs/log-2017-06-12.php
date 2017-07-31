ERROR - 2017-06-12 14:29:24 --> Severity: Error --> Call to a member function get_user_one() on a non-object D:\phpstudy\WWW\yb_product\application\controllers\admin\Spuser.php 474
ERROR - 2017-06-12 14:30:12 --> Query error: file: D:\phpstudy\WWW\yb_product\application\controllers\admin\Spuser.php line: 477---Unknown column 'name' in 'field list' - Invalid query: select  `name`  from  dferp_sp_user  where id='1'
ERROR - 2017-06-12 14:30:12 --> Severity: Error --> Call to a member function row_array() on a non-object D:\phpstudy\WWW\yb_product\application\models\Sp_User_model.php 39
ERROR - 2017-06-12 14:32:52 --> Query error: file: D:\phpstudy\WWW\yb_product\application\models\Admin_Warehouse_model.php line: 21---Unknown column 'Array' in 'where clause' - Invalid query: SELECT `name`
FROM `dferp_stock_warehouse`
WHERE `id` = `Array`
ERROR - 2017-06-12 14:32:52 --> Severity: Error --> Call to a member function row_array() on a non-object D:\phpstudy\WWW\yb_product\application\models\Admin_Warehouse_model.php 22
ERROR - 2017-06-12 15:05:55 --> Query error: file: D:\phpstudy\WWW\yb_product\application\models\Seller_User_model.php line: 19---Unknown column 'zjx_type' in 'field list' - Invalid query: select  `user`,`id`,`pass`,`zjx_type`  from  dferp_seller_user  where user='test'
ERROR - 2017-06-12 15:05:55 --> Severity: Error --> Call to a member function row_array() on a non-object D:\phpstudy\WWW\yb_product\application\models\Seller_User_model.php 62
ERROR - 2017-06-12 15:06:38 --> Query error: file: D:\phpstudy\WWW\yb_product\application\models\Seller_User_model.php line: 19---Unknown column 'zjx_type' in 'field list' - Invalid query: select  `user`,`id`,`pass`,`zjx_type`  from  dferp_seller_user  where user='test'
ERROR - 2017-06-12 15:06:38 --> Severity: Error --> Call to a member function row_array() on a non-object D:\phpstudy\WWW\yb_product\application\models\Seller_User_model.php 62
ERROR - 2017-06-12 15:30:17 --> Severity: Error --> Call to undefined method Seller_product_model::update_product_tb() D:\phpstudy\WWW\yb_product\application\controllers\admin\Spuser.php 196
ERROR - 2017-06-12 15:34:45 --> Query error: file: D:\phpstudy\WWW\yb_product\application\models\Sp_Product_model.php line: 59---Duplicate entry '1' for key 'product_sp_id' - Invalid query: INSERT INTO `dferp_sp_product_content` (`product_sp_id`, `userid`, `name`, `desc`, `brand`, `cat_id`, `catname`, `country`, `countryid`, `length`, `width`, `height`, `barcode`, `mark_price`, `cf`, `gn`, `type`, `mz`, `jz`, `pic`, `gg`, `con`) VALUES (1, '2', '七彩玲珑糖', '哈哈', '彩虹牌', 110200, '22', '中国', 142, 15, 15, 15, '12345465', 30, '趣味', '好吃', '食品', 100, 85, '/upload/sp/2/image/20170317/1489719662133415.png', '打大厦', '<p>的撒打算ad</p>')
ERROR - 2017-06-12 15:54:51 --> Query error: file: D:\phpstudy\WWW\yb_product\application\models\Base_page_model.php line: 45---Table 'yb_product.dferp_order_ls' doesn't exist - Invalid query: SELECT `a`.*
FROM `dferp_order_ls` as `a`
ERROR - 2017-06-12 15:54:51 --> Query error: file: D:\phpstudy\WWW\yb_product\application\models\Base_page_model.php line: 38---Table 'yb_product.dferp_order_ls' doesn't exist - Invalid query: SELECT `a`.*
FROM `dferp_order_ls` as `a`
ORDER BY `a`.`id` desc
 LIMIT 15
ERROR - 2017-06-12 15:54:51 --> Severity: Error --> Call to a member function result_array() on a non-object D:\phpstudy\WWW\yb_product\application\models\Base_page_model.php 38
ERROR - 2017-06-12 16:26:38 --> Query error: file: D:\phpstudy\WWW\yb_product\application\models\Admin_Warehouse_model.php line: 21---Unknown column 'Array' in 'where clause' - Invalid query: SELECT *
FROM `dferp_stock_warehouse`
WHERE `id` = `Array`
ERROR - 2017-06-12 16:26:38 --> Severity: Error --> Call to a member function row_array() on a non-object D:\phpstudy\WWW\yb_product\application\models\Admin_Warehouse_model.php 22
ERROR - 2017-06-12 16:28:30 --> Query error: file: D:\phpstudy\WWW\yb_product\application\models\Admin_Warehouse_model.php line: 21---Unknown column 'Array' in 'where clause' - Invalid query: SELECT *
FROM `dferp_stock_warehouse`
WHERE `id` = `Array`
ERROR - 2017-06-12 16:28:30 --> Severity: Error --> Call to a member function row_array() on a non-object D:\phpstudy\WWW\yb_product\application\models\Admin_Warehouse_model.php 22
ERROR - 2017-06-12 16:36:56 --> Severity: Parsing Error --> syntax error, unexpected T_VARIABLE D:\phpstudy\WWW\yb_product\application\controllers\sp\Logistics.php 25
ERROR - 2017-06-12 16:36:59 --> Severity: Parsing Error --> syntax error, unexpected T_VARIABLE D:\phpstudy\WWW\yb_product\application\controllers\sp\Logistics.php 25
ERROR - 2017-06-12 17:24:19 --> Severity: User Error --> Smarty error: [in cart_index.htm line 43]: syntax error: unrecognized tag: item.warehouse_id (Smarty_Compiler.class.php, line 446) D:\phpstudy\WWW\yb_product\application\libraries\smarty\Smarty.class.php 1121

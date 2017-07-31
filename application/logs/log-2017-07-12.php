<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-07-12 10:28:54 --> Severity: Warning --> include(D:\phpstudy\WWW\yb_product\application\templates_c\sp\^%%2B^2B4^2B415EA9%%order_info.htm.php) [<a href='function.include'>function.include</a>]: failed to open stream: No such file or directory D:\phpstudy\WWW\yb_product\application\libraries\smarty\Smarty.class.php 2150
ERROR - 2017-07-12 10:28:55 --> Severity: Warning --> include() [<a href='function.include'>function.include</a>]: Failed opening 'D:\phpstudy\WWW\yb_product\application\templates_c/sp/\^%%2B^2B4^2B415EA9%%order_info.htm.php' for inclusion (include_path='.;C:\php\pear') D:\phpstudy\WWW\yb_product\application\libraries\smarty\Smarty.class.php 2150
ERROR - 2017-07-12 10:58:58 --> Severity: Warning --> iconv() expects parameter 3 to be string, array given D:\phpstudy\WWW\yb_product\application\libraries\downxls\down_xls_class.php 52
ERROR - 2017-07-12 11:05:40 --> Severity: error --> Exception: Invalid cell coordinate 2 D:\phpstudy\WWW\yb_product\application\libraries\downxls\PHPExcel\Cell.php 558
ERROR - 2017-07-12 11:06:30 --> Severity: error --> Exception: Invalid cell coordinate 2 D:\phpstudy\WWW\yb_product\application\libraries\downxls\PHPExcel\Cell.php 558
ERROR - 2017-07-12 11:06:42 --> Severity: error --> Exception: Invalid cell coordinate 2 D:\phpstudy\WWW\yb_product\application\libraries\downxls\PHPExcel\Cell.php 558
ERROR - 2017-07-12 11:11:29 --> Severity: error --> Exception: Invalid cell coordinate 2 D:\phpstudy\WWW\yb_product\application\libraries\downxls\PHPExcel\Cell.php 558
ERROR - 2017-07-12 11:14:48 --> Severity: error --> Exception: Invalid cell coordinate 2 D:\phpstudy\WWW\yb_product\application\libraries\downxls\PHPExcel\Cell.php 558
ERROR - 2017-07-12 13:58:42 --> Severity: Parsing Error --> syntax error, unexpected '=' D:\phpstudy\WWW\yb_product\application\controllers\sp\Order.php 310
ERROR - 2017-07-12 14:00:36 --> Severity: Parsing Error --> syntax error, unexpected '=' D:\phpstudy\WWW\yb_product\application\controllers\sp\Order.php 310
ERROR - 2017-07-12 14:00:38 --> Severity: Parsing Error --> syntax error, unexpected '=' D:\phpstudy\WWW\yb_product\application\controllers\sp\Order.php 310
ERROR - 2017-07-12 14:01:00 --> Severity: Parsing Error --> syntax error, unexpected ',', expecting ')' D:\phpstudy\WWW\yb_product\application\controllers\sp\Order.php 312
ERROR - 2017-07-12 14:01:01 --> Severity: Parsing Error --> syntax error, unexpected ',', expecting ')' D:\phpstudy\WWW\yb_product\application\controllers\sp\Order.php 312
ERROR - 2017-07-12 15:44:08 --> Query error: file:  line: ---You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: select `consignee`,`consignee_address`,`consignee_mobile` from dferp_order where id=
ERROR - 2017-07-12 15:44:08 --> Severity: Error --> Call to a member function row_array() on a non-object D:\phpstudy\WWW\yb_product\application\controllers\sp\Order.php 262
ERROR - 2017-07-12 15:44:32 --> Query error: file:  line: ---You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: select `consignee`,`consignee_address`,`consignee_mobile` from dferp_order where id=
ERROR - 2017-07-12 15:44:32 --> Severity: Error --> Call to a member function row_array() on a non-object D:\phpstudy\WWW\yb_product\application\controllers\sp\Order.php 262
ERROR - 2017-07-12 15:44:34 --> Query error: file:  line: ---You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: select `consignee`,`consignee_address`,`consignee_mobile` from dferp_order where id=
ERROR - 2017-07-12 15:44:34 --> Severity: Error --> Call to a member function row_array() on a non-object D:\phpstudy\WWW\yb_product\application\controllers\sp\Order.php 262
ERROR - 2017-07-12 16:54:44 --> Query error: file: D:\phpstudy\WWW\yb_product\application\models\Base_page_model.php line: 58---Unknown column 'a.consignee_mobile' in 'where clause' - Invalid query: SELECT `a`.*, `b`.`consignee`, `b`.`consignee_address`, `b`.`consignee_mobile`, `b`.`status`, `b`.`payment_status`
FROM `dferp_sp_order` as `a`
LEFT JOIN `dferp_order` as `b` ON `a`.`order_id`=`b`.`id`
WHERE `a`.`sp_id` = 2 and `a`.`consignee_mobile` = '13526834708' and `b`.`consignee_mobile` = '13526834708'
ERROR - 2017-07-12 16:54:44 --> Query error: file: D:\phpstudy\WWW\yb_product\application\models\Base_page_model.php line: 51---Unknown column 'a.consignee_mobile' in 'where clause' - Invalid query: SELECT `a`.*, `b`.`consignee`, `b`.`consignee_address`, `b`.`consignee_mobile`, `b`.`status`, `b`.`payment_status`
FROM `dferp_sp_order` as `a`
LEFT JOIN `dferp_order` as `b` ON `a`.`order_id`=`b`.`id`
WHERE `a`.`sp_id` = 2 and `a`.`consignee_mobile` = '13526834708' and `b`.`consignee_mobile` = '13526834708'
ORDER BY `a`.`id` desc
 LIMIT 15
ERROR - 2017-07-12 16:54:44 --> Severity: Error --> Call to a member function result_array() on a non-object D:\phpstudy\WWW\yb_product\application\models\Base_page_model.php 51
ERROR - 2017-07-12 16:54:52 --> Query error: file: D:\phpstudy\WWW\yb_product\application\models\Base_page_model.php line: 58---Unknown column 'a.consignee_mobile' in 'where clause' - Invalid query: SELECT `a`.*, `b`.`consignee`, `b`.`consignee_address`, `b`.`consignee_mobile`, `b`.`status`, `b`.`payment_status`
FROM `dferp_sp_order` as `a`
LEFT JOIN `dferp_order` as `b` ON `a`.`order_id`=`b`.`id`
WHERE `a`.`sp_id` = 2 and `a`.`consignee_mobile` = '13526834708' and `b`.`consignee_mobile` = '13526834708'
ERROR - 2017-07-12 16:54:52 --> Query error: file: D:\phpstudy\WWW\yb_product\application\models\Base_page_model.php line: 51---Unknown column 'a.consignee_mobile' in 'where clause' - Invalid query: SELECT `a`.*, `b`.`consignee`, `b`.`consignee_address`, `b`.`consignee_mobile`, `b`.`status`, `b`.`payment_status`
FROM `dferp_sp_order` as `a`
LEFT JOIN `dferp_order` as `b` ON `a`.`order_id`=`b`.`id`
WHERE `a`.`sp_id` = 2 and `a`.`consignee_mobile` = '13526834708' and `b`.`consignee_mobile` = '13526834708'
ORDER BY `a`.`id` desc
 LIMIT 15
ERROR - 2017-07-12 16:54:52 --> Severity: Error --> Call to a member function result_array() on a non-object D:\phpstudy\WWW\yb_product\application\models\Base_page_model.php 51

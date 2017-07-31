ALTER TABLE `dferp_sp_product` ADD `ls_lock_num` INT( 8 ) NOT NULL DEFAULT '0' COMMENT '零售锁定数量' AFTER `online_num` ;
ALTER TABLE `dferp_order` ADD `order_id` VARCHAR( 18 ) NOT NULL DEFAULT '0' COMMENT '零售订单号' AFTER `sp_userid` ;
ALTER TABLE `dferp_logistics_temp` ADD `sp_userid` INT( 8 ) NOT NULL DEFAULT '0' AFTER `id` ;
ALTER TABLE `dferp_logistics_temp` ADD `status` TINYINT( 1 ) NOT NULL DEFAULT '0' COMMENT '0=待审核 1=已审核 ' AFTER `uptime` ;
ALTER TABLE `dferp_logistics_temp` ADD `company` VARCHAR( 30 ) NULL DEFAULT NULL AFTER `sp_userid` ;

CREATE TABLE IF NOT EXISTS `dferp_logistics_temp_con_show` (
  `id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `userid` int(8) NOT NULL COMMENT 'ID',
  `company` varchar(30) NOT NULL DEFAULT '',
  `temp_id` int(8) NOT NULL DEFAULT '0' COMMENT '自定义物流模板ID',
  `default_num` smallint(4) DEFAULT NULL COMMENT '默认数量',
  `default_price` float(6,2) DEFAULT NULL COMMENT '默认运费',
  `add_num` smallint(4) DEFAULT NULL COMMENT '增加数量',
  `add_price` float(6,2) DEFAULT NULL COMMENT '增加运费',
  `city_names` text COMMENT '收货城市 逗号分割',
  `cityids` text,
  PRIMARY KEY (`id`),
  KEY `temp_id` (`temp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='自定义物流模板内容表' AUTO_INCREMENT=1 ;

ALTER TABLE `dferp_logistics_temp_con_show` ADD `status` TINYINT( 1 ) NOT NULL DEFAULT '0' COMMENT '0=待审核 1=已审核' AFTER `cityids`; 
ALTER TABLE `dferp_logistics_temp_con` ADD `status` TINYINT( 1 ) NOT NULL DEFAULT '0' COMMENT '0=待审核 1=已审核' AFTER `define_city_name`; 


----------------------------------------------------------------


CREATE TABLE IF NOT EXISTS `dferp_order_ls` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'oreder_ID',
  `sp_userid` int(8) NOT NULL DEFAULT '0' COMMENT '供应商',
  `order_id` varchar(18) NOT NULL DEFAULT '0' COMMENT '零售订单号',
  `userid` int(10) DEFAULT NULL COMMENT '分销商UID 默认UID为挚捷行 ',
  `company` varchar(50) DEFAULT NULL COMMENT '挚捷行下线 [分销渠道名称]',
  `warehouse_id` int(8) NOT NULL DEFAULT '0' COMMENT '仓库编号',
  `consignee` varchar(50) DEFAULT NULL COMMENT '收货人姓名',
  `consignee_address` varchar(100) NOT NULL COMMENT '收货人地址',
  `consignee_mobile` varchar(20) NOT NULL COMMENT '收货人手机',
  `product_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '供应价格 供应商后台查看',
  `seller_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际销售金额  管理员后台查看 ',
  `logistics_type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '运单类型',
  `logistics_no` varchar(12) NOT NULL DEFAULT '0' COMMENT '运单号',
  `logcs_weight` int(8) NOT NULL DEFAULT '0' COMMENT '运单重量',
  `logcs_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '运费',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 -1 失败 1待审核提交 2已提交',
  `add_time` datetime NOT NULL COMMENT '下定单时间',
  `close_time` datetime DEFAULT NULL COMMENT '作废时间',
  `close_con` text DEFAULT NULL COMMENT '作废内容',
  `f_time` datetime DEFAULT NULL COMMENT '发货时间',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `consignee_mobile` (`consignee_mobile`),
  KEY `logistics_no` (`logistics_no`),
  KEY `warehouse_id` (`warehouse_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='导入订单表' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `dferp_order_pro_ls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sp_id` int(8) NOT NULL COMMENT '供应商品编号',
  `sp_uid` int(8) NOT NULL COMMENT '供应UID',
  `userid` int(10) NOT NULL DEFAULT '0' COMMENT '分销商UID',
  `stock_id` int(8) NOT NULL DEFAULT '0' COMMENT '公共ID',
  `order_id` int(10) NOT NULL DEFAULT '0' COMMENT 'oreder_ID',
  `name` varchar(100) NOT NULL COMMENT '产品名',
  `price` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '销售单价',
  `sp_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '供应单价',
  `weight` smallint(8) NOT NULL DEFAULT '0',
  `num` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT ' 数量',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=未发货  2=已发货',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `sp_id` (`sp_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='订单产品表' AUTO_INCREMENT=1;

----------------------------------------------------
ALTER TABLE `dferp_logistics_temp_con` ADD UNIQUE (
 `temp_id` ,
`define_cityid` 
);

ALTER TABLE `dferp_sp_product` ADD `warehouse_id`  int(8) NOT NULL DEFAULT '0'  COMMENT '仓库编号';
ALTER TABLE `dferp_seller_product` ADD `ls_lock_num` INT( 8 ) NOT NULL DEFAULT '0' COMMENT '零售锁定库存' AFTER `c_num` ;
----------------------------------------------------

CREATE TABLE IF NOT EXISTS `dferp_delivery_address` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `userid` int(8) unsigned NOT NULL COMMENT '会员ID',
  `name` varchar(40) NOT NULL COMMENT '收货人',
  `provinceid` int(6) NOT NULL COMMENT '省ID',
  `cityid` int(6) NOT NULL COMMENT '市ID',
  `areaid` int(6) NOT NULL COMMENT '区ID',
  `area` varchar(255) NOT NULL COMMENT '省市区',
  `address` varchar(50) NOT NULL COMMENT '地址',
  `zip` varchar(20) DEFAULT NULL COMMENT '邮编',
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机',
  `default` tinyint(1) DEFAULT '0' COMMENT '是否默认',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='收货地址表' AUTO_INCREMENT=1 ;
----------------------------------------------------
ALTER TABLE `dferp_sp_order` ADD `warehouse_id` INT( 8 ) NOT NULL DEFAULT '0' AFTER `sp_id` ;
ALTER TABLE `dferp_base_image` ADD `group_id` INT( 8 ) NOT NULL DEFAULT '0' AFTER `type` ;
ALTER TABLE `dferp_stock` ADD `hg_type` TINYINT( 1 ) NOT NULL DEFAULT '0' COMMENT '1=保税 2=直邮  3=一般贸易' AFTER `warehouse_id` ;
CREATE TABLE IF NOT EXISTS `dferp_base_image_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(8) NOT NULL,
  `web_filename` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '图片组名',
  `add_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `web_filename` (`web_filename`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;


--------------------------------------------------

CREATE TABLE IF NOT EXISTS `dferp_order_ls` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'oreder_ID',
  `sp_userid` int(8) NOT NULL DEFAULT '0' COMMENT '供应商',
  `order_id` varchar(18) NOT NULL DEFAULT '0' COMMENT '零售订单号',
  `userid` int(10) DEFAULT NULL COMMENT '分销商UID 默认UID为挚捷行 ',
  `company` varchar(50) DEFAULT NULL COMMENT '挚捷行下线 [分销渠道名称]',
  `warehouse_id` int(8) NOT NULL DEFAULT '0' COMMENT '仓库编号',
  `consignee` varchar(50) DEFAULT NULL COMMENT '收货人姓名',
  `province_id` int(6) NOT NULL DEFAULT '0',
  `consignee_address` varchar(100) NOT NULL COMMENT '收货人地址',
  `consignee_mobile` varchar(20) NOT NULL COMMENT '收货人手机',
  `product_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '供应价格 供应商后台查看',
  `seller_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际销售金额  管理员后台查看 ',
  `logistics_type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '运单类型',
  `logistics_no` varchar(12) NOT NULL DEFAULT '0' COMMENT '运单号',
  `rate_price` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '总税',
  `payment_type` int(3) NOT NULL DEFAULT '0' COMMENT '支付方式编号',
  `cashflow_id` varchar(48) NOT NULL DEFAULT '0' COMMENT '支付流水',
  `card_name` varchar(30) NOT NULL DEFAULT '0',
  `card_no` int(11) NOT NULL DEFAULT '0',
  `payment_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `logcs_weight` int(8) NOT NULL DEFAULT '0' COMMENT '运单重量',
  `logcs_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '运费',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 -1 失败 1待审核提交 2已提交',
  `add_time` datetime NOT NULL COMMENT '下定单时间',
  `close_time` datetime DEFAULT NULL COMMENT '作废时间',
  `close_con` text COMMENT '作废内容',
  `f_time` datetime DEFAULT NULL COMMENT '发货时间',
  `hg_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '直邮或保税 订单 0=待审核 1=已申报 2=已通关',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `consignee_mobile` (`consignee_mobile`),
  KEY `logistics_no` (`logistics_no`),
  KEY `warehouse_id` (`warehouse_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='导入订单表' AUTO_INCREMENT=100000 ;



CREATE TABLE IF NOT EXISTS `dferp_order_pro_ls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sp_id` int(8) NOT NULL COMMENT '供应商品编号',
  `sp_uid` int(8) NOT NULL COMMENT '供应UID',
  `userid` int(10) NOT NULL DEFAULT '0' COMMENT '分销商UID',
  `stock_id` int(8) NOT NULL DEFAULT '0' COMMENT '公共ID',
  `order_id` int(10) NOT NULL DEFAULT '0' COMMENT 'oreder_ID',
  `name` varchar(100) NOT NULL COMMENT '产品名',
  `price` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '销售单价',
  `sp_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '供应单价',
  `weight` smallint(8) NOT NULL DEFAULT '0',
  `num` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT ' 数量',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=未发货  2=已发货',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `sp_id` (`sp_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单产品表' AUTO_INCREMENT=1 ;

----------------------------------------------------------------------
ALTER TABLE `dferp_seller_product` ADD `hg_type` TINYINT( 1 ) NOT NULL DEFAULT '0' COMMENT '1=保税 2=直邮  3=一般贸易 ' AFTER `userid` ;
ALTER TABLE `dferp_order_pro_ls` ADD `sp_name` VARCHAR( 150 ) NULL DEFAULT NULL AFTER `name` ;
ALTER TABLE `dferp_order_pro_ls` ADD `ss_price`  decimal(8,2) NULL AFTER `status`;


ALTER TABLE `dferp_sp_product` ADD `pic_status` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '0=不通过,1=待审核,2=已审核' ;



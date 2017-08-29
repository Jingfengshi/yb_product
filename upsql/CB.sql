ALTER TABLE `dferp_order` ADD `AccountPeriod_End_Time` DATETIME NULL DEFAULT NULL COMMENT '账期截止时间' AFTER `payment_money` ;
ALTER TABLE `dferp_order` ADD `AccountPeriod_status` TINYINT( 1 ) NOT NULL DEFAULT '0' COMMENT '0=未申请 1=已申请 2=账期确认' AFTER `payment_money` ;
ALTER TABLE `dferp_sp_product` ADD `boxes_num` INT( 10 ) NOT NULL DEFAULT '0' COMMENT '每箱数量' AFTER `sell_num` ;


------------------------------------
ALTER TABLE `dferp_order` ADD `AccountPeriod_type` TINYINT( 1 ) NOT NULL DEFAULT '0' COMMENT '1=30天，2=60天，3=75天，4=90天' AFTER `AccountPeriod_status` ;
ALTER TABLE `dferp_stock_cat` ADD `profit` FLOAT( 4, 2 ) NOT NULL DEFAULT '0' COMMENT '利润' AFTER `pid` ;

CREATE TABLE IF NOT EXISTS `dferp_order_accountperiod` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'oreder_ID',
  `order_id` varchar(18) NOT NULL DEFAULT '0' COMMENT '零售订单号',
  `userid` int(10) DEFAULT '0' COMMENT '分销商UID',
  `AccountPeriod_moeny` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '该期需付款金额',
  `payment_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际付款金额',
  `payment_time` datetime DEFAULT NULL COMMENT '付款时间',
  `AccountPeriod_time` datetime DEFAULT NULL COMMENT '账期时间',
  `q_num` tinyint(1) NOT NULL DEFAULT '0',
  `cashflow_id` varchar(48) DEFAULT '0',
  `payor` varchar(40) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '-1=已作废  1=未付款  2=已付款  3=已确认付款',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `order_id` (`order_id`),
  KEY `userid` (`userid`),
  KEY `q_num` (`q_num`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='导入订单表' AUTO_INCREMENT=1;
ALTER TABLE `dferp_seller_user` ADD `api_pass` VARCHAR( 32 ) NULL DEFAULT NULL COMMENT '对接秘钥' AFTER `act_pass` ;
CREATE TABLE IF NOT EXISTS `dferp_admin_login_log` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user` char(30) NOT NULL COMMENT '帐号',
  `lastlogotime` datetime DEFAULT NULL COMMENT '登录时间',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员登陆记录' AUTO_INCREMENT=1;
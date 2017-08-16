ALTER TABLE `dferp_sp_order`
ADD COLUMN `remark_accout`  text NULL COMMENT '账期备注' AFTER `warehouse_id`,
ADD COLUMN `estimated_date_payment`  datetime NULL COMMENT '预计付款日期' AFTER `remark_accout`,
ADD COLUMN `date_payment`  datetime NULL COMMENT '付款日期' AFTER `estimated_date_payment`


ALTER TABLE `dferp_order`
ADD COLUMN `not_pay_money`  decimal(10,2) DEFAULT 0.00 COMMENT '未付款金额' AFTER `payor`



ALTER TABLE `dferp_order`
ADD COLUMN `delivery_sp_order_num`  int(4) NULL DEFAULT 0 COMMENT '发货供应商订单数' AFTER `not_pay_money`,
ADD COLUMN `invalid_sp_order_num`  int(4) NULL DEFAULT 0 AFTER `delivery_sp_order_num`,
ADD COLUMN `sp_order_num`  int(4) NULL DEFAULT 0 COMMENT '总供应商订单数' AFTER `invalid_sp_order_num`
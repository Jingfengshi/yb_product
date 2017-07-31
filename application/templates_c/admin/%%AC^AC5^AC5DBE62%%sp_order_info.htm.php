<?php /* Smarty version 2.6.20, created on 2017-07-17 16:51:18
         compiled from D:%5Cphpstudy%5CWWW%5Cyb_product%5Capplication%5Ctemplates/admin/sp_order_info.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'D:\\phpstudy\\WWW\\yb_product\\application\\templates/admin/sp_order_info.htm', 7, false),)), $this); ?>
<div class="modal-header" style="height:30px; background:#000;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; height:1em; line-height:1em; width:1em;">x</button>
    <h4 style="color:#fff; margin-top:5px;">
        【订单--<?php echo $this->_tpl_vars['re']['id']; ?>
】详情
    </h4>
</div>
<iframe src="<?php echo ((is_array($_tmp='order/sp_order_info_1')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['re']['id']; ?>
&act_id=<?php echo $this->_tpl_vars['re']['act_id']; ?>
" style="width:98%;height:300px;" ></iframe>
<div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn">Close</button>
</div>
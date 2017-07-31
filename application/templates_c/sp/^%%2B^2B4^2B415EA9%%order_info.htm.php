<?php /* Smarty version 2.6.20, created on 2017-07-12 16:05:01
         compiled from order_info.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'order_info.htm', 62, false),)), $this); ?>
<div class="tabbable tabbable-custom" style="">
    <div>
        <div class="container-fluid">
            <!-- BEGIN PAGE CONTENT-->
            <div class="portlet-body form">
                <div>
                    <table class="table  table-bordered table-hover dataTable">
                        <tr>
                            <th>收货人:<?php echo $this->_tpl_vars['re']['order_address']['consignee']; ?>
</th> <th>联系方式:<?php echo $this->_tpl_vars['re']['order_address']['consignee_mobile']; ?>
</th> <th>收货地址：<?php echo $this->_tpl_vars['re']['order_address']['consignee_address']; ?>
</th><th>  <button id="table_upload" data-id="<?php echo $this->_tpl_vars['re']['sp_order_id']; ?>
"   class="btn red mini"><i class="icon-share"></i>导出Excel表格</button></th>
                        </tr>
                    </table>
                </div>

                <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
                    <thead>
                    <tr role="heading">
                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">产品名</th>
                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">条形码</th>
                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">供应价</th>
                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">数量</th>
                    </tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <?php if ($this->_tpl_vars['re']['order_info']): ?>
                    <?php $_from = $this->_tpl_vars['re']['order_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                    <tr >

                        <td width="*"><?php echo $this->_tpl_vars['item']['name']; ?>
</td>
                        <td width="*"><?php echo $this->_tpl_vars['item']['barcode']; ?>
</td>
                        <td width="120"><?php echo $this->_tpl_vars['item']['sp_price']; ?>
</td>
                        <td width="120"><?php echo $this->_tpl_vars['item']['num']; ?>
</td>

                    </tr>
                    <?php endforeach; endif; unset($_from); ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="99">暂时无数据</td>
                    </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <div class="row-fluid">

                    <div class="clear"></div>
                    <div class="span6">
                        <div class="dataTables_paginate paging_bootstrap pagination"> <?php echo $this->_tpl_vars['re']['page']; ?>
</div>
                    </div>

                </div>

            </div>
            <!-- END FORM-->
        </div>
        <!-- END PAGE CONTENT-->
    </div>

</div>
<script>
    $('#table_upload').click(function()
    {
        var temp_id = $(this).attr('data-id');
        window.location.href = "<?php echo ((is_array($_tmp='order/order_table_upload')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?temp_id="+temp_id;
    });

</script>
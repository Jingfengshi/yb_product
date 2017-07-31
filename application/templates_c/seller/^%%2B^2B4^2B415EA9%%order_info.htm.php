<?php /* Smarty version 2.6.20, created on 2017-07-11 17:13:15
         compiled from order_info.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'f_get_status', 'order_info.htm', 27, false),array('modifier', 'number_format', 'order_info.htm', 30, false),)), $this); ?>
<div class="tabbable tabbable-custom" style="">
    <div class="tab-content">
        <div class="container-fluid">
            <!-- BEGIN PAGE CONTENT-->
            <div class="portlet-body form">

                <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
                    <thead>
                    <tr role="heading">
                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">产品名</th>
                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">状态</th>
                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">销售价</th>
                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">数量</th>
                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">合计</th>

                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">仓库号</th>
                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运单号</th>
                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">发货时间</th>
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
                        <td width="60"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['status'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'order_pro_status') : f_get_status($_tmp, 'order_pro_status')); ?>
</td>
                        <td width="60"><?php echo $this->_tpl_vars['item']['price']; ?>
</td>
                        <td width="40"><?php echo $this->_tpl_vars['item']['num']; ?>
</td>
                        <td width="60"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['num']*$this->_tpl_vars['item']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, '2', '.', ',') : number_format($_tmp, '2', '.', ',')); ?>
</td>

                        <td width="60"><?php echo $this->_tpl_vars['item']['warehouse_id']; ?>
</td>
                        <td width="100"><?php echo $this->_tpl_vars['item']['logcs_num']; ?>
</td>
                        <td width="120"><?php echo $this->_tpl_vars['item']['delivery_time']; ?>
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
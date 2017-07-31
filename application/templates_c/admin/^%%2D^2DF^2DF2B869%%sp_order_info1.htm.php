<?php /* Smarty version 2.6.20, created on 2017-07-17 16:51:20
         compiled from sp_order_info1.htm */ ?>
<div class="tabbable tabbable-custom" style="">
    <div class="tab-content">
        <div class="container-fluid">
            <!-- BEGIN PAGE CONTENT-->
            <div class="portlet-body form">

                <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
                    <thead>
                    <tr role="heading">
                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">产品名</th>
                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">分销价</th>
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
                        <td width="120"><?php echo $this->_tpl_vars['item']['seller_price']; ?>
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
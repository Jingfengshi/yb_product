<?php /* Smarty version 2.6.20, created on 2017-07-18 11:21:00
         compiled from D:%5Cphpstudy%5CWWW%5Cyb_product%5Capplication%5Ctemplates/seller/goods_info.htm */ ?>
<div class="modal-header" style="height:30px; background:#000;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; height:1em; line-height:1em; width:1em;">x</button>
    <h4 style="color:#fff; margin-top:5px;">
        【商品<?php echo $this->_tpl_vars['re']['id']; ?>
---详情】
    </h4>
</div>
<div class="modal-body">
    <div class="tabbable tabbable-custom">
        <div class="tab-content">
            <div class="container-fluid">
                <!-- BEGIN PAGE CONTENT-->
                <div class="portlet-body form">
                   <?php echo $this->_tpl_vars['re']['con']; ?>

                </div>
                <!-- END PAGE CONTENT-->
            </div>

        </div>
    </div>
</div>

<div class="modal-footer">

    <button type="button" data-dismiss="modal" class="btn">Close</button>
</div>
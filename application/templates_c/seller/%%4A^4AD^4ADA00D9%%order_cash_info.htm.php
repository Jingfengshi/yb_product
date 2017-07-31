<?php /* Smarty version 2.6.20, created on 2017-07-12 16:31:53
         compiled from D:%5Cphpstudy%5CWWW%5Cyb_product%5Capplication%5Ctemplates/seller/order_cash_info.htm */ ?>
<div class="modal-header" style="height:30px; background:#000;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; height:1em; line-height:1em; width:1em;">x</button>
    <h4 style="color:#fff; margin-top:5px;">
        【订单<?php echo $this->_tpl_vars['re']['id']; ?>
--查看流水】
    </h4>
</div>
<div class="modal-body">
    <div class="tabbable tabbable-custom">
        <div class="tab-content">
            <div class="container-fluid">
                <!-- BEGIN PAGE CONTENT-->
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action=""  class="form-horizontal" method="post"  id='form_remark'>

                        <div class="control-group">
                            <label class="control-label">银行流水<span class="required">*</span></label>
                            <div class="controls">
                                <input type="text"   value="<?php echo $this->_tpl_vars['re']['address']['cashflow_id']; ?>
"  readonly="readonly"  class="span4 m-wrap">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">支付款方<span class="required">*</span></label>
                            <div class="controls">
                                <input type="text"   value="<?php echo $this->_tpl_vars['re']['address']['payor']; ?>
"  readonly="readonly" class="span4 m-wrap">
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
                <!-- END PAGE CONTENT-->
            </div>

        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn">Close</button>
</div>


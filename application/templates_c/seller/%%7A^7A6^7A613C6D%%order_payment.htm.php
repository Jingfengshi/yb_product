<?php /* Smarty version 2.6.20, created on 2017-07-11 17:35:32
         compiled from D:%5Cphpstudy%5CWWW%5Cyb_product%5Capplication%5Ctemplates/seller/order_payment.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'D:\\phpstudy\\WWW\\yb_product\\application\\templates/seller/order_payment.htm', 148, false),)), $this); ?>
<div class="modal-header" style="height:30px; background:#000;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; height:1em; line-height:1em; width:1em;">x</button>
    <h4 style="color:#fff; margin-top:5px;">
        【订单<?php echo $this->_tpl_vars['re']['id']; ?>
--确认付款】
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
                                                <div id='alert-error_1' class="alert alert-error hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交失败</span></div>
                        <div id='alert-success_1' class="alert alert-success hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交成功</span></div>
                        <div class="row-fluid">
                            <div class="span6">
                                <p>总价：¥&nbsp;<?php echo $this->_tpl_vars['re']['address']['product_price']; ?>
</p>
                                <p>运费：¥&nbsp;<?php echo $this->_tpl_vars['re']['address']['logcs_price']; ?>
</p>
                                <p>  收货人：&nbsp;<?php echo $this->_tpl_vars['re']['address']['consignee']; ?>
</p>
                                <p>  手机：&nbsp;<?php echo $this->_tpl_vars['re']['address']['consignee_mobile']; ?>
</p>
                                <p>收货地址：&nbsp;<?php echo $this->_tpl_vars['re']['address']['consignee_address']; ?>
</p>
                                <p style="color:red">合计费用：¥&nbsp;<?php echo $this->_tpl_vars['re']['address']['logcs_price']+$this->_tpl_vars['re']['address']['product_price']; ?>
</p>
                            </div>
                            <div class="span6">
                                <p>收款方：&nbsp;上海挚捷行国际贸易有限公司</p>
                                <p>收款方账号：&nbsp;6222 2154 1223 153</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">银行流水<span class="required">*</span></label>
                            <div class="controls">
                                <input type="text" name="cashflow_id"  placeholder="请输入支付流水单号"  class="span4 m-wrap">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">支付款方<span class="required">*</span></label>
                            <div class="controls">
                                <input type="text" name="payor"  placeholder="请输入公司账户"   class="span4 m-wrap">
                                <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
">
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
    <button type="button"  class="btn red " id="df_submit">付款</button>
    <button type="button" data-dismiss="modal" class="btn">Close</button>
</div>
<script type="text/javascript" src="/static/js/jquery.validate.min.js"></script>
<script>


    var error1=$('#alert-error_1');
    var success1=$('#alert-success_1');

    var form1 = $('#form_remark');
    form1.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-inline', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
            cashflow_id: {
                required: true
            }
            ,
            payor: {
                required: true
            }


        },
        messages : {
            cashflow_id: {
                required: '银行流水号不能为空'
            }
            ,
            payor: {
                required: '支付款方不能为空'
            }


        }
        ,
        invalidHandler: function (event, validator) { //display error alert on form submit
            success1.hide();
            error1.find('span').html('请完善提交内容再提交');
            error1.show();
            App.scrollTo(error1, -200);
        },

        highlight: function (element) { // hightlight error inputs
            $(element)
                    .closest('.help-inline').removeClass('ok'); // display OK icon
            $(element)
                    .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
        },

        unhighlight: function (element) { // revert the change dony by hightlight
            $(element)
                    .closest('.control-group').removeClass('error'); // set error class to the control group
        },

        success: function (label) {
            label.addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                    .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
        },
        submitHandler: function (form) {
            /*
             $.post("?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
&act_ajax=1",form1.serialize(),function(msg){
             success1.hide();
             if(msg==1)
             {
             success1.find('span').html('订阅成功');
             success1.show();
             }
             else
             {
             error1.find('span').html(msg);
             error1.show();
             }
             });
             */
        }
    });

    $('#df_submit').bind('click',function(){
        if(form1.valid()==true){
            $modal = $('#ajax-modal');
            $('body').modalmanager('loading');
            $.fn.modal.defaults.width='';
            $.fn.modal.defaults.height='';
            $.post('<?php echo ((is_array($_tmp="order/order_payment_done")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',$('#form_remark').serialize(),function(msg){
                try
                {
                    //alert(msg);
                    eval("var str="+msg);
                    //操作成功
                    if(str.type==1)
                    {

                    }
                    else if(str.type==2)
                    {

                    }
                    else if(str.type==3)
                    {
                        window.location='<?php echo ((is_array($_tmp="order/order_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
';
                        die;

                    }
                    setTimeout(function(){
                        $modal.load('<?php echo ((is_array($_tmp="seller_index/seller_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function()
                        {
                            $modal.modal();
                        });
                    }, 300);
                }
                catch(e)
                {

                    $('body').modalmanager('removeLoading');
                   // alert(msg);
                    setTimeout(function(){
                        $modal.load('<?php echo ((is_array($_tmp="seller_index/seller_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI('系统异常'),'', function()
                        {
                            $modal.modal();
                        });
                    }, 300);
                };
            });
        }

    });






</script>

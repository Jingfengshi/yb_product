<?php /* Smarty version 2.6.20, created on 2017-07-12 15:39:11
         compiled from order_delivery.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'order_delivery.htm', 199, false),)), $this); ?>

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
                        <div class="control-group">
                            <label class="control-label">订单详情<span class="required">*</span></label>
                            <div class="controls ">
                                <h6>订单总重：<?php echo $this->_tpl_vars['re']['sp_order']['logcs_total_weight']; ?>
克</h6>
                                <h6>订单运费：<?php echo $this->_tpl_vars['re']['sp_order']['logcs_price']; ?>
¥</h6>
                                <h6>收货姓名：<?php echo $this->_tpl_vars['re']['order']['consignee']; ?>
</h6>
                                <h6>收货电话：<?php echo $this->_tpl_vars['re']['order']['consignee_mobile']; ?>
</h6>
                                <h6>收货地址：<?php echo $this->_tpl_vars['re']['order']['consignee_address']; ?>
</h6>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">是否发货<span class="required">*</span></label>
                            <div class="controls">
                                <select  size="1"  id="is_delivery"  name="is_delivery" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                                    <option value='all'>请选择</option>
                                    <option value="1">发货</option>
                                    <option value="0">不发货</option>
                                </select>

                            </div>
                        </div>
                        <div id="delivery" style="display: none">
                            <div class="control-group">
                                <label class="control-label">运单号<span class="required">*</span></label>
                                <div class="controls ">
                                    <input type="text" name="logcs_num"  value="<?php echo $this->_tpl_vars['re']['sp_order']['logcs_num']; ?>
" class="span4 m-wrap" >
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">运单类型<span class="required">*</span></label>
                                <div class="controls">
                                    <input type='hidden' name='id' value="<?php echo $this->_tpl_vars['re']['id']; ?>
">
                                    <select name="logistics_type"  size="1"   aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                                        <option value=''>请选择</option>
                                        <?php $_from = $this->_tpl_vars['re']['logistics']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['item']['type']; ?>
"><?php echo $this->_tpl_vars['item']['company']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div id="no_delivery" style="display: none">
                            <div class="control-group">
                                <label class="control-label">备注信息<span class="required">*</span></label>
                                <div class="controls ">
                                    <input type='hidden' name='id' value="<?php echo $this->_tpl_vars['re']['id']; ?>
">
                                    <textarea class="span5" name="remark" id="" cols="40" rows="10"></textarea>
                                </div>
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
    <button type="button"  class="btn green " id="df_submit">提交</button>
</div>
<script type="text/javascript" src="/static/js/jquery.validate.min.js"></script>
<script>
        $('#is_delivery').change(function(){
            var fa=$(this).val();

            if(fa==1)
            {
                $('#delivery').show();
                $('#no_delivery').hide();
            }
            else if(fa==0)
            {
                $('#no_delivery').show();
                $('#delivery').hide();
            }
            else if(fa=='all')
            {
                $('#no_delivery').hide();
                $('#delivery').hide();
            }
        })

        var error1=$('#alert-error_1');
        var success1=$('#alert-success_1');

        var form1 = $('#form_remark');
        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-inline', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                is_delivery: {
                    required: true
                }
                ,
                logistics_type: {
                    required:function(){return ! ($('#is_delivery').val()!=1);}
                }
                ,
                logcs_num:
                {
                    required:function(){return ! ($('#is_delivery').val()!=1);}
                }
                ,
                remark:{
                    required:function(){return ! ($('#is_delivery').val()!=0);}
                }

            },
            messages : {
                is_delivery: {
                    required: '是否发货必须选择'
                }
                ,
                logistics_type: {
                    required: '运单类型必须选择'
                }
                ,
                logcs_num:
                {
                    required:'运单号必须填写'
                }
                ,
                remark:{
                    required:'备注信息必须填写'
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
                $.post('<?php echo ((is_array($_tmp="order/order_delivery")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
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
                            //刷新主页面
                            window.parent.location.reload(true);

                        }
                        setTimeout(modal_msg(str.msg), 300);
                    }
                    catch(e)
                    {

                        $('body').modalmanager('removeLoading');
                       // alert(msg);
                        setTimeout(modal_msg('系统异常'), 300);
                    };
                });
            }

        });











</script>

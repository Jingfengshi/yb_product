<?php /* Smarty version 2.6.20, created on 2017-07-11 16:07:55
         compiled from order_action.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'order_action.htm', 27, false),)), $this); ?>
<div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->

    <div class="modal-body">
        <div class="tabbable tabbable-custom" id='tab_all'>
            <ul class="nav nav-tabs">

                <?php if (( $this->_tpl_vars['re']['status'] == 1 || $this->_tpl_vars['re']['status'] == 2 ) && $this->_tpl_vars['re']['payment_status'] == 0): ?>
                <li class=""><a href="#tab_1_2" data-id='tab_1_2' data-toggle="tab">审核订单</a></li>
                <?php endif; ?>
                <?php if (( $this->_tpl_vars['re']['status'] == 2 || $this->_tpl_vars['re']['status'] == 3 ) && $this->_tpl_vars['re']['payment_status'] == 2): ?>
                <li class=""><a href="#tab_1_3" data-id='tab_1_3' data-toggle="tab">订单发货</a></li>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['re']['payment_status'] == 1): ?>
                <li class=""><a href="#tab_1_4" data-id='tab_1_4' data-toggle="tab">确认付款</a></li>
                <?php endif; ?>

                <li class="active"><a href="#tab_1_1" data-id='tab_1_1' data-toggle="tab">查看订单</a></li>
                <?php if ($this->_tpl_vars['re']['status'] == 1): ?>
                <li class=""><a href="#tab_1_5" data-id='tab_1_5' data-toggle="tab">订单运费</a></li>
                <?php endif; ?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1_1">
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <iframe src="<?php echo ((is_array($_tmp='order/order_info_1')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['re']['id']; ?>
" style="width:98%;height:500px;" ></iframe>
                </div>
                <?php if (( $this->_tpl_vars['re']['status'] == 1 || $this->_tpl_vars['re']['status'] == 2 ) && $this->_tpl_vars['re']['payment_status'] == 0): ?>
                <div class="tab-pane  " id="tab_1_2">
                    <iframe src="<?php echo ((is_array($_tmp='order/order_edit')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['re']['id']; ?>
" style="width:98%;height:500px;" ></iframe>
                </div>
                <?php endif; ?>
                <?php if (( $this->_tpl_vars['re']['status'] == 2 || $this->_tpl_vars['re']['status'] == 3 ) && $this->_tpl_vars['re']['payment_status'] == 2): ?>
                <div class="tab-pane  " id="tab_1_3">
                    <iframe  style=" width:100%; height:600px;" src="<?php echo ((is_array($_tmp="order/order_deliver")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['re']['id']; ?>
"   > </iframe>
                </div>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['re']['payment_status'] == 1): ?>
                <div class="tab-pane  " id="tab_1_4">
                    <iframe  style=" width:100%; height:500px;" src="<?php echo ((is_array($_tmp="order/order_confirm_money")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['re']['id']; ?>
"   > </iframe>
                </div>
                <?php endif; ?>

                <div class="tab-pane " id="tab_1_5">
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <iframe src="<?php echo ((is_array($_tmp='order/order_logics_fee')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['re']['id']; ?>
" style="width:98%;height:500px;" ></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
<link href="/static/css/jquery.fancybox.css" rel="stylesheet">
<script src="/static/js/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" type="text/css" href="/static/css/datepicker.css">
<script type="text/javascript" src="/static/js/bootstrap-datepicker.js"></script>
<script>
    $('.form_2_select2').select2({
        placeholder: "请选择",
        allowClear: true
    });
    $('.date-picker').datepicker({
        format:'yyyy-mm-dd',
        language: 'zh-CN',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 0,
        startView: 0,
        forceParse: 0,
        showMeridian: 1
    });
    function load_ini()
    {



        bind_window();
        $('#tab_all ul.nav-tabs a').each(function(index, element) {

            var id=$(this).attr('data-id');
        });

        proj_table_upload();
        var error1 = $('#alert-error_1');
        var success1 = $('#alert-success_1');
        var form1 = $('#form_submit');
        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-inline', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                import_table: {
                    required: true
                }
            },
            messages : {
                import_table:{
                    required:'请选择上传文件',
                }
            }
            ,
            invalidHandler: function (event, validator) { //display error alert on form submit

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
            } ,

            submitHandler: function (form) {
                form.submit();
            }
        });


        var form2= $('#form2');
        $("#submit_add").click(function(){
            //encodeURI(msg)
            $modal=$('#ajax-modal');
            error1.hide();
            success1.show();
            success1.find('span').html('正在提交...........');
            $('body').modalmanager('loading');
            $.post('<?php echo ((is_array($_tmp="cash/cash_table_add_row")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form2.serialize(),function(msg){
                try
                {
                    eval("var str="+msg);
                    //操作成功
                    if(str.type==1)
                    {
                        //错误提示
                        error1.show();
                        success1.hide();
                        error1.find('span').html(str.msg);
                    }
                    else if(str.type==2)
                    {
                        //提交成功
                        error1.hide();
                        success1.show();
                        success1.find('span').html('提交成功');
                    }
                    else if(str.type==3)
                    {
                        //刷新主页面
                        f_main_index();
                        return true;
                    }

                    setTimeout(function(){
                        $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function(){
                            $modal.modal();
                        });
                    }, 300);
                }catch(e){
                    alert(msg);
                    $('body').modalmanager('removeLoading');
                    success1.hide();
                    error1.find('span').html('系统异常');
                    error1.show();
                };
            });

        });
    }

    var proj_table_upload = function()
    {
        $('#table_upload').click(function()
        {
            var temp_id = $(this).attr('data-temp-id');
            window.location.href = "<?php echo ((is_array($_tmp='cash/proj_table_upload')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?temp_id="+temp_id;
        });
    }

    var bind_window = function()
    {
        App.initFancybox();
        $.fn.modalmanager.defaults.resize = true;
        $.fn.modalmanager.defaults.spinner = '<div class="loading-spinner fade" style="width: 200px; margin-left: -100px;"><img src="/static/ajax-modal-loading.gif" align="middle">&nbsp;<span style="font-weight:300; color: #eee; font-size: 18px; font-family:Open Sans;">&nbsp;Loading...</div>';
        var $modal = $('#ajax-modal');
        $('#tab_1_2 .cash_add_proj').each(function(index,element)
        {

            $(this).bind('click',function(){
                var url    = $(this).attr('data-url');
                var id     = $(this).attr('data-id');
                var act_id = $(this).attr('data-act-id');
                var size   = $(this).attr('data-box-size').split('|');
                $('body').modalmanager('loading');
                setTimeout(function(){
                    $.fn.modal.defaults.width  =size[0]+'px';
                    $.fn.modal.defaults.height =size[1]+'px';
                    $modal.load(
                            url,
                            {
                                id:id,
                                act_id:act_id
                            },
                            function()
                            {
                                $modal.modal();
                                //$modal.css('margin-top','0');
                            });
                }, 100);


            })
        })
    }
    var win_close = function()
    {
        var $modal = $('#ajax-modal');
        $('body').modalmanager('removeLoading');
        $modal.modal('hide');
    }

</script>
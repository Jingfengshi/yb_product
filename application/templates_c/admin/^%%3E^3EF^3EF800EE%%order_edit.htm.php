<?php /* Smarty version 2.6.20, created on 2017-07-11 17:19:03
         compiled from order_edit.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'order_edit.htm', 144, false),)), $this); ?>
<div class="container-fluid">
<div class="row-fluid">
  <div class="span12">
    <div class="form">       <div id='alert-error_1' class="alert alert-error hide">
        <button class="close" data-dismiss="alert"></button>
        <span>提交失败</span> </div>
      <div id='alert-success_1' class="alert alert-success hide">
        <button class="close" data-dismiss="alert"></button>
        <span>提交成功</span> </div>
      <!-- BEGIN FORM-->
      <form action="" id="form_eidt" class="form-horizontal" method="post" >
        <table class="table table-bordered table-hover dataTable" id="table_1">
          <thead>
            <tr>
              <th bgcolor="#E2EEFE" colspan="99">订单信息</th>
            </tr>
          </thead>
          <tr>
            <th width="250px">订单编号：<?php echo $this->_tpl_vars['re']['id']; ?>
</th>
            <th width="250px">分销商：<?php echo $this->_tpl_vars['re']['company']; ?>
</th>
          </tr>
          <thead>
            <tr>
              <th bgcolor="#E2EEFE" colspan="99">订单信息修改</th>
            </tr>
          </thead>
          <tr>
            <td colspan="99"><?php if (! empty ( $this->_tpl_vars['re']['order'] )): ?>
              <div class="control-group" style="margin-top:20px;">
                <label class="control-label">订单重量<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="logcs_weight" disabled="disabled"  class="m-wrap" value="<?php echo $this->_tpl_vars['re']['order']['logcs_weight']; ?>
" >
                </div>
              </div>
              <div class="control-group" id="deliver" style="margin-top:20px;">
                <label class="control-label">订单运费<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="logcs_price" disabled="disabled" value="<?php echo $this->_tpl_vars['re']['order']['logcs_price']; ?>
" class="m-wrap"  >
                </div>
              </div>
              <div class="control-group" style="margin-top:20px;">
                <label class="control-label">订单状态<span class="required">*</span></label>
                <div class="controls">
                  <select name="status" id="status">
                    <option value=''>请选择</option>
                    <option <?php if ($this->_tpl_vars['re']['order']['status'] == 1): ?>selected="selected"<?php endif; ?> value="1">待审核
                    </option>
                    <option <?php if ($this->_tpl_vars['re']['order']['status'] == 2): ?>selected="selected"<?php endif; ?> value="2">已审核，待付款
                    </option>
                    <option <?php if ($this->_tpl_vars['re']['order']['status'] == -1): ?>selected="selected"<?php endif; ?> value="-1">作废
                    </option>
                  </select>
                </div>
              </div>
              <?php endif; ?> </td>
          </tr>
        </table>
        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
"/>
        <div class="form-actions">
          <button type="button" id='submit_eidt' class="btn red">提交</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script>

            var error1=$('#alert-error_1');
            var success1=$('#alert-success_1');
            var form1 = $('#form_eidt');
            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-inline', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {
                    status: {
                        required: true
                    }



                },
                messages : {
                    status: {
                        required: '订单状态不能为空'
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

            $("#submit_eidt").click(function(){
                if(form1.valid()==true)
                {
                    $modal=$('#ajax-modal');
                    error1.hide();
                    success1.show();
                    success1.find('span').html('正在提交...........');
                    $('body').modalmanager('loading');
                    $.post('<?php echo ((is_array($_tmp="order/order_edit_done")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form1.serialize(),function(msg)
                    {
                        try
                        {
                           //alert(msg);
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
                                location.reload();
                            }
                            else if(str.type==3)
                            {
                                //刷新主页面
                               window.parent.location.reload(true);
                                return true;
                            }
                            setTimeout(function()
                            {
                                $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function()
                                {
                                    $modal.modal();
                                });
                            }, 300);
                        }
                        catch(e)
                        {
                            $('body').modalmanager('removeLoading');
                            success1.hide();
                            error1.find('span').html('系统异常');
                            error1.show();
                        };
                    });
                }
            });
            $('#status').change(function(){
                var sta=$('#status').val();
                var deli=$('#deliver');
                if(sta==-1)
                {
                    deli.hide();

                }
                else
                {
                    deli.show();
                }
            })

    </script>
<?php /* Smarty version 2.6.20, created on 2017-07-11 15:22:57
         compiled from product_edit_batch.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'product_edit_batch.htm', 172, false),)), $this); ?>
<div class="container-fluid">

<!-- BEGIN PAGE HEADER--> 

<!-- END PAGE HEADER--> 
<!-- BEGIN PAGE CONTENT-->
<div class="row-fluid">
  <div class="span12"> 
    <!-- BEGIN VALIDATION STATES-->
    
    <div class="portlet-body form"> 
      <!-- BEGIN FORM-->
      <form action="" id="form_seller_product_check" class="form-horizontal" method="post" >
                <div id='alert-error_1' class="alert alert-error hide">
          <button class="close" data-dismiss="alert"></button>
          <span>提交失败</span> </div>
        <div id='alert-success_1' class="alert alert-success hide">
          <button class="close" data-dismiss="alert"></button>
          <span>提交成功</span> </div>
        <table class="table table-bordered table-hover dataTable">
          <thead>
            <tr>
              <th width="80" bgcolor="#E2EEFE">商品编号</th>
              <th width="120" bgcolor="#E2EEFE">分销商</th>
              <th width="*" bgcolor="#E2EEFE">中文名称</th>
              <th width="150" bgcolor="#E2EEFE">供应价格</th>
              <th width="150" bgcolor="#E2EEFE">平台定价</th>
                <th width="150" bgcolor="#E2EEFE">分销价格</th>
              <th width="150" bgcolor="#E2EEFE">市场价格</th>
              <th width="200" bgcolor="#E2EEFE">上下架</th>
            </tr>
          </thead>
          <?php $_from = $this->_tpl_vars['re']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
          <tr>
            <th> <?php echo $this->_tpl_vars['item']['id']; ?>

              <input type="hidden" name="id[<?php echo $this->_tpl_vars['item']['id']; ?>
]" value="<?php echo $this->_tpl_vars['item']['id']; ?>
">
            </th>
            <th> <?php echo $this->_tpl_vars['item']['company']; ?>
 </th>
            <th> <?php echo $this->_tpl_vars['item']['name']; ?>
 </th>

            <th>
                <input type="text" disabled="disabled" class="span4 m-wrap"   style="width: 150px;"  value="<?php echo $this->_tpl_vars['item']['g_price']; ?>
"  />
            </th>
              <th>
                  <input type="text"   class="span4 m-wrap" disabled="disabled"  style="width: 150px;" value="<?php echo $this->_tpl_vars['item']['p_price']; ?>
"  />
                  <input type="hidden" name="p_price[<?php echo $this->_tpl_vars['item']['id']; ?>
]"  value="<?php echo $this->_tpl_vars['item']['p_price']; ?>
">
              </th>
              <th>
                  <input type="text" name="price[<?php echo $this->_tpl_vars['item']['id']; ?>
]" class="span4 m-wrap"  style="width: 150px;" value="<?php if ($this->_tpl_vars['item']['price'] != 0): ?><?php echo $this->_tpl_vars['item']['price']; ?>
<?php else: ?><?php echo $this->_tpl_vars['item']['p_price']; ?>
<?php endif; ?>" />
              </th>
              <th>
                  <input type="text" name="mark_price[<?php echo $this->_tpl_vars['item']['id']; ?>
]"  style="width: 150px;" class="span4 m-wrap"  value="<?php if ($this->_tpl_vars['item']['seller_mark_price'] != 0): ?><?php echo $this->_tpl_vars['item']['seller_mark_price']; ?>
<?php else: ?><?php echo $this->_tpl_vars['item']['stock_mark_price']; ?>
<?php endif; ?> " />
                </th>
            <th> <label class="radio inline">
                <input type="radio" name="status[<?php echo $this->_tpl_vars['item']['id']; ?>
]"  value="0" <?php if ($this->_tpl_vars['item']['status'] == 0): ?>checked="checked"<?php endif; ?> >
                下架 </label>
              <label class="radio inline">
                <input type="radio" name="status[<?php echo $this->_tpl_vars['item']['id']; ?>
]"  value="1" <?php if ($this->_tpl_vars['item']['status'] == 1): ?>checked="checked"<?php endif; ?>>
                上架 </label>
            </th>
          </tr>
          <?php endforeach; endif; unset($_from); ?>
        </table>
        <div class="form-actions">
          <input type="hidden" name="<?php echo $this->_tpl_vars['csrf']['name']; ?>
" value="<?php echo $this->_tpl_vars['csrf']['hash']; ?>
">
          <button type="button" id='submit_seller_product_check' class="btn red">提交</button>
        </div>
        <div class="form-actions">
          <h5>注意事项</h5>
          <p>一般分销价为市场价的<font style="color:red">0.65</font></p>
          <p>特殊情况，请参看供应价，<font style="color:red">分销价不得小于供应价</font></p>
        </div>
      </form>
      <!-- END FORM--> 
      <!-- END VALIDATION STATES--> 
    </div>
  </div>
  <!-- END PAGE CONTENT--> 
</div>
<link href="/static/css/jquery.fancybox.css" rel="stylesheet">
<script src="/static/js/jquery.fancybox.pack.js"></script> 
<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script>
        $('.form_2_select2').select2({
            placeholder: "请选择",
            allowClear: true
        });
        function load_ini()
        {
            var error1=$('#alert-error_1');
            var success1=$('#alert-success_1');

            var form1 = $('#form_seller_product_check');


            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-inline', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {
                    "price[]": {
                        required: true
                    }
                    ,
                    "mark_price[]": {
                        required: true
                    }
                },
                messages : {
                    "price[]":{
                        required:'分销价格不能为空',
                    }
                    ,
                    "mark_price[]": {
                        required: '市场不能为空'
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

            $("#submit_seller_product_check").click(function(){

                if(form1.valid()==true) {
                    //encodeURI(msg)
                    $modal = $('#ajax-modal');
                    error1.hide();
                    success1.show();
                    success1.find('span').html('正在提交...........');
                    $('body').modalmanager('loading');
                    $.post('<?php echo ((is_array($_tmp="seller_product/product_edit_batch")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
', form1.serialize(), function (msg) {
                        try {
                            //alert(msg);
                            eval("var str=" + msg);
                            //操作成功
                            if (str.type == 1) {
                                //错误提示
                                error1.show();
                                success1.hide();
                                error1.find('span').html(str.msg);
                            }
                            else if (str.type == 2) {
                                //提交成功
                                error1.hide();
                                success1.show();
                                success1.find('span').html('提交成功');
                            }
                            else if (str.type == 3) {
                                //刷新主页面
                                f_main_index();
                                return true;
                            }
                            setTimeout(modal_msg(str.msg), 300);
                        } catch (e) {
                            alert(msg);
                            $('body').modalmanager('removeLoading');
                            success1.hide();
                            error1.find('span').html('系统异常');
                            error1.show();
                            setTimeout(modal_msg('系统异常'), 300);
                        }
                        ;
                    });
                }
            });

        }

    </script> 
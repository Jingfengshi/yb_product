<?php /* Smarty version 2.6.20, created on 2017-07-11 15:39:20
         compiled from spuser_add.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'get_company_img_url', 'spuser_add.htm', 85, false),array('modifier', 'site_url', 'spuser_add.htm', 205, false),)), $this); ?>
<div class="container-fluid"> 
  
  <!-- BEGIN PAGE HEADER-->
  
  <div class="row-fluid">
    <div class="span12"> 
    <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>供货订阅管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">供应商管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#"><?php if (empty ( $this->_tpl_vars['sp_res'] )): ?>添加供应商<?php else: ?>修改供应商<?php endif; ?></a></li>
      </ul>
    </div>
  </div>
  
  <!-- END PAGE HEADER--> 
  
  <!-- BEGIN PAGE CONTENT-->
  
  <div class="row-fluid">
        <div class="span12"> 
          
          <!-- BEGIN VALIDATION STATES-->
          
          <div class="portlet box blue">
            <div class="portlet-title">
              <div class="caption"><i class="icon-reorder"></i><?php if (empty ( $this->_tpl_vars['sp_res'] )): ?>添加供应商<?php else: ?>修改供应商<?php endif; ?></div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM-->
              <form action="" id="form_spuser_add" class="form-horizontal" method="post" >               
                
                                <div id='alert-error_1' class="alert alert-error hide">
                  <button class="close" data-dismiss="alert"></button>
                  <span>提交失败</span>
                </div>
                <div id='alert-success_1' class="alert alert-success hide">
                  <button class="close" data-dismiss="alert"></button>
                  <span>提交成功</span>
                </div>

                <div class="control-group">
                  <label class="control-label">用户账号<span class="required">*</span></label>
                  <div class="controls">
                   <?php if (empty ( $this->_tpl_vars['sp_res'] )): ?>
                      <input type="text" name="user"  class="span6 m-wrap"/>
                   <?php else: ?>
                      <label class="control-label" style="text-align:left;"><?php echo $this->_tpl_vars['sp_res']['user']; ?>
</label>
                      <input type="hidden" name="user"  value="<?php echo $this->_tpl_vars['sp_res']['user']; ?>
" class="span6 m-wrap"/>  
                   <?php endif; ?>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">用户密码<span class="required">*</span></label>
                  <div class="controls">
                    <input type="text" name="user_pwd" data-required="1" class="span6 m-wrap"/>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">操作密码<span class="required">*</span></label>
                  <div class="controls">
                    <input type="text" name="act_pwd" data-required="1" class="span6 m-wrap"/>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">手机号码<span class="required"></span></label>
                  <div class="controls">
                      <input type="text" name="mobile" value="<?php echo $this->_tpl_vars['sp_res']['mobile']; ?>
" data-required="1" class="span6 m-wrap"/>        
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">公司名称<span class="required"></span></label>
                  <div class="controls">
                      <input type="text" name="company" value="<?php echo $this->_tpl_vars['sp_res']['company']; ?>
" data-required="1" class="span6 m-wrap"/> 
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">营业执照<span class="required"></span></label>
                  <div class="controls">
                    <div  style="width:300px; height:300px; border:1px solid red; display:block;"> <img width="100%"  id='upload_pic_bg' src="<?php echo ((is_array($_tmp=$this->_tpl_vars['sp_res']['permit_pic'])) ? $this->_run_mod_handler('get_company_img_url', true, $_tmp) : get_company_img_url($_tmp)); ?>
"/> </div>
                  </div>
                </div>

                <?php if (! empty ( $this->_tpl_vars['sp_res'] )): ?>
                <div class="control-group">
                  <label class="control-label">更改状态<span class="required">*</span></label>
                    <div class="controls"> 
                      <select size="1" id="form_2_select2"  name="status" aria-controls="sample_1" class="form_2_select2 m-wrap small">
                        <option value="">请选择</option>
                        <option value="3" <?php if ($this->_tpl_vars['sp_res']['status'] == 3): ?>selected<?php endif; ?>>已审核</option>
                        <option value='2' <?php if ($this->_tpl_vars['sp_res']['status'] == 2): ?>selected<?php endif; ?>>已提交</option>
                        <option value='1' <?php if ($this->_tpl_vars['sp_res']['status'] == 1): ?>selected<?php endif; ?>>待提交</option>
                        <option value='0' <?php if ($this->_tpl_vars['sp_res']['status'] == 0): ?>selected<?php endif; ?>>已关闭</option>
                      </select>
                    </div>
                </div>
                <?php endif; ?> 
                
                <div class="form-actions">
                  <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['sp_res']['id']; ?>
"> 
                  <input type="hidden" name="<?php echo $this->_tpl_vars['csrf']['name']; ?>
" value="<?php echo $this->_tpl_vars['csrf']['hash']; ?>
">			  
                  <button type="submit" id='submit_spuser_add' class="btn green">提交</button>
                </div>
              </form>
              <!-- END FORM--> 
            </div>
          </div>
          <!-- END VALIDATION STATES--> 
        </div>
      </div>
  
  <!-- END PAGE CONTENT--> 
  
</div>

<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script>

function load_ini()
{
  var error1=$('#alert-error_1'); 
  var success1=$('#alert-success_1'); 
  
  var form1 = $('#form_spuser_add');
  form1.validate({
    errorElement: 'span', //default input error message container
    errorClass: 'help-inline', // default input error message class
    focusInvalid: false, // do not focus the last invalid input
    ignore: "",
    rules: {
      ps_name: {
        required: true
      }
      ,
      ps_user: {
        required: true
      }
    },
    messages : {
      ps_name:{
         required:'账号不能为空',
       }
      ,
      ps_user: {
        required: '登陆账号不能为空'
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
  
  $("#submit_spuser_add").click(function(){
    if(form1.valid()==true)
    {
      //encodeURI(msg)
      $modal=$('#ajax-modal');
      error1.hide();
      success1.show();
      success1.find('span').html('正在提交...........');
      $('body').modalmanager('loading');
      $.post('<?php echo ((is_array($_tmp="spuser/spuser_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form1.serialize(),function(msg){
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
          $('body').modalmanager('removeLoading');
          success1.hide();
          error1.find('span').html('系统异常');
          error1.show();
          };
      });
    }
  });
 
}

</script> 
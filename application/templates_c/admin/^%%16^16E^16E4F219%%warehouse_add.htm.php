<?php /* Smarty version 2.6.20, created on 2017-07-11 15:55:45
         compiled from warehouse_add.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'warehouse_add.htm', 129, false),)), $this); ?>
<div class="container-fluid"> 
  
  <!-- BEGIN PAGE HEADER-->
  
  <div class="row-fluid">
    <div class="span12"> 
    <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>仓库管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">仓库管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#"><?php if (empty ( $this->_tpl_vars['wa_res'] )): ?>添加仓库<?php else: ?>修改仓库<?php endif; ?></a></li>
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
              <div class="caption"><i class="icon-reorder"></i><?php if (empty ( $this->_tpl_vars['wa_res'] )): ?>添加仓库<?php else: ?>修改仓库<?php endif; ?></div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM-->
              <form action="" id="form_warehouse_add" class="form-horizontal" method="post" >               
                                <div id='alert-error_1' class="alert alert-error hide">
                  <button class="close" data-dismiss="alert"></button>
                  <span>提交失败</span>
                </div>
                <div id='alert-success_1' class="alert alert-success hide">
                  <button class="close" data-dismiss="alert"></button>
                  <span>提交成功</span>
                </div>

                <div class="control-group">
                  <label class="control-label">仓库别称<span class="required">*</span></label>
                  <div class="controls">
                    <input type="text" name="name" value="<?php echo $this->_tpl_vars['wa_res']['name']; ?>
" data-required="1" class="span6 m-wrap"/>  (如:保税区A区)
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">发货地区<span class="required">*</span></label>
                  <div class="controls">
                    <input type="text" name="hg_name" value="<?php echo $this->_tpl_vars['wa_res']['hg_name']; ?>
" data-required="1" class="span6 m-wrap"/> (如:上海保税关区)
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">仓库类型<span class="required">*</span></label>
                  <div class="controls">
                    <select name="type"  <?php if (! empty ( $this->_tpl_vars['wa_res'] )): ?>disabled="disabled" <?php endif; ?>  class="span6 m-wrap">
                    	<option value="1">保税</option>
                        <option value="2">直邮</option>
                        <option value="3">一般贸易</option>
                    </select>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">供应商名称<span class="required">*</span></label>
                  <div class="controls">
                     <input type="text"  <?php if (! empty ( $this->_tpl_vars['wa_res'] )): ?>disabled="disabled" <?php endif; ?>   name="company" value="<?php echo $this->_tpl_vars['wa_res']['company']; ?>
" data-required="1" class="ajax_search_spuser_company span4 m-wrap"/>
                    <?php if (empty ( $this->_tpl_vars['wa_res'] )): ?>
                     <button type="button" id='search_shop' class="btn green">查询供应商</button>
                    <?php endif; ?>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">供应商UID<span class="required">*</span></label>
                  <div class="controls">
                    <input type="text" name="sp_uid" <?php if (! empty ( $this->_tpl_vars['wa_res'] )): ?>disabled="disabled" <?php endif; ?> value="<?php echo $this->_tpl_vars['wa_res']['sp_uid']; ?>
" data-required="1" class="ajax_search_spuser_uid span4 m-wrap"/>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">对应供应商仓号<span class="required">*</span></label>
                  <div class="controls">
                    <input type="text" name="out_warehouse_id"  value="<?php echo $this->_tpl_vars['wa_res']['out_warehouse_id']; ?>
" data-required="1" class="ajax_search_spuser_uid span4 m-wrap"/>  ( 如某平台有很多个仓库：绑定之后在审核入库时会自动选择)
                  </div>
                </div>
                <?php if (! empty ( $this->_tpl_vars['wa_res'] )): ?>
                <div class="control-group">
                  <label class="control-label">批发运费模板ID<span class="required">*</span></label>
                  <div class="controls">
                     <input type="text"  disabled="disabled"  value="<?php echo $this->_tpl_vars['wa_res']['logistics_temp_id']; ?>
" data-required="1"
                     class="span4 m-wrap"/>
                  </div>
                </div>
                
                 <div class="control-group">
                  <label class="control-label">零售运费模板ID<span class="required">*</span></label>
                  <div class="controls">
                     <input type="text"  disabled="disabled" value="<?php echo $this->_tpl_vars['wa_res']['logistics_temp_id_ls']; ?>
" data-required="1"
                     class="span4 m-wrap"/>
                  </div>
                </div>
                <?php endif; ?>
                
                <div class="form-actions">   
                  <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['wa_res']['id']; ?>
">
                  <input type="hidden" name="<?php echo $this->_tpl_vars['csrf']['name']; ?>
" value="<?php echo $this->_tpl_vars['csrf']['hash']; ?>
">			  
                  <button type="submit" id='submit_warehouse_add' class="btn green">提交</button>
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
  $modal=$('#ajax-modal_1');	
  $('#search_shop').bind('click',function(){
	  setTimeout(function(){
	   $modal.load('<?php echo ((is_array($_tmp="base_ajax/search_spuser")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
','', function(){
		$modal.modal();
	   });
	  }, 300);
  });	
  
  var error1=$('#alert-error_1'); 
  var success1=$('#alert-success_1'); 
  var form1 = $('#form_warehouse_add');
  form1.validate({
    errorElement: 'span', //default input error message container
    errorClass: 'help-inline', // default input error message class
    focusInvalid: false, // do not focus the last invalid input
    ignore: "",
    rules: {
      name: {
        required: true
      }
      ,
      hg_name: {
        required: true
      }
	  ,
	  company:{
        required: true
      }
	  ,
	  sp_uid:{
        required: true
      }
	  ,
	  logistics_temp_id:{
        required: true
      }
    },
    messages : {
      name:{
         required:'账号不能为空',
       }
      ,
      hg_name: {
        required: '发货地区不能为空'
      }
	   ,
	  company:{
        required: '供应商名称不能为空'
      }
	  ,
	  sp_uid:{
        required: '供应商UID不能为空'
      }
	  ,
	  logistics_temp_id:{
        required: '关联运费模板不能为空'
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
  
  $("#submit_warehouse_add").click(function(){
    if(form1.valid()==true)
    {
      //encodeURI(msg)
      $modal=$('#ajax-modal');
      error1.hide();
      success1.show();
      success1.find('span').html('正在提交...........');
      $('body').modalmanager('loading');
      $.post('<?php echo ((is_array($_tmp="warehouse/warehouse_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
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
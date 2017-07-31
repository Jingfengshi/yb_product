<?php /* Smarty version 2.6.20, created on 2017-07-13 13:56:35
         compiled from product_import.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'product_import.htm', 46, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>首页</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">我的商品</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">导入商品</a></li>
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
              <div class="caption"><i class="icon-reorder"></i>导入商品</div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM-->
              <form action=""  class="form-horizontal" method="post"  id='form_11' enctype="multipart/form-data">
                <div id='alert-error_1' class="alert alert-error hide">
                  <button class="close" data-dismiss="alert"></button>
                  <span>请上传商品</span>
                </div>
                <div id='alert-success_1' class="alert alert-success hide">
                  <button class="close" data-dismiss="alert"></button>
                  <span>通过正在提交......</span>
                </div>
               <div class="control-group">
                   <label class="control-label">商品仓库<span class="required">*</span></label>
                   <div class="controls">
                       <select size="1"  id="form_2_select2" name="warehouse_id" aria-controls="sample_1" class="form_2_select2 m-wrap span6">
                       <option value=''>请选择仓库</option>
                       <?php $_from = $this->_tpl_vars['res_warehouse']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                       <option  value="<?php echo $this->_tpl_vars['item']['id']; ?>
" ><?php echo $this->_tpl_vars['item']['company']; ?>
--<?php echo $this->_tpl_vars['item']['name']; ?>
</option>
                       <?php endforeach; endif; unset($_from); ?>
                       </select>
                   </div>
               </div>
               <div class="control-group">
                  <label class="control-label">上传文件<span class="required">*</span></label>
                  <div class="controls">
                       <a href=" <?php echo ((is_array($_tmp="product/get_product_im")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
">下载文件</a>
                  </div>
                </div> 
                  
                <div class="control-group">
                  <label class="control-label">导入商品<span class="required">*</span></label>
                  <div class="controls">
                    <input type="file" name="product" data-required="1" class="span6 m-wrap"/>
                  </div>
                </div> 
               
                <div class="form-actions">
                  <button type="submit" class="btn green">提交</button>
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
	$('#form_11').validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-inline', // default input error message class
		focusInvalid: false, // do not focus the last invalid input
		ignore: "",
		rules: {
            warehouse_id: {
                required: true
            },
			product: {
				required: true
			},
		},
		messages : {
            warehouse_id:{
                required:'请选择商品仓库',
            },
			  product:{
				  required:'请上传商品',
			  },
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
}

</script> 
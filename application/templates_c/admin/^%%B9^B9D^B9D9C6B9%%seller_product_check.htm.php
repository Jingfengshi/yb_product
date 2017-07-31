<?php /* Smarty version 2.6.20, created on 2017-07-11 15:21:43
         compiled from seller_product_check.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'seller_product_check.htm', 256, false),)), $this); ?>
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
        <table class="table table-bordered table-hover dataTable">
          <thead>
            <tr>
              <th bgcolor="#E2EEFE" colspan="4">供应产品</th>
            </tr>
          </thead>
          <tr>
            <th>供应对接编号</th>
            <td><?php echo $this->_tpl_vars['de']['sp_product']['out_product_id']; ?>
</td>
            <th>供应商仓库号</th>
            <td><?php echo $this->_tpl_vars['de']['sp_product']['out_warehouse_id']; ?>
</td>
          </tr>
          <tr>
            <th>贸易类型</th>
            <td><?php if ($this->_tpl_vars['de']['warehouse']['type'] == 1): ?>保税<?php endif; ?>
              <?php if ($this->_tpl_vars['de']['warehouse']['type'] == 2): ?>直邮<?php endif; ?>
              <?php if ($this->_tpl_vars['de']['warehouse']['type'] == 3): ?>一般贸易<?php endif; ?> </td>
            <th>仓库地址</th>
            <td><?php echo $this->_tpl_vars['de']['warehouse']['hg_name']; ?>
</td>
          </tr>
          <tr>
            <th>税率</th>
            <td><?php echo $this->_tpl_vars['de']['stock']['rate']; ?>
</td>
            <th>购买上限</th>
            <td><?php echo $this->_tpl_vars['de']['sp_product']['max_num']; ?>
</td>
          </tr>
          <tr>
            <th style="color:red;">同步拿货定价</th>
            <td><?php echo $this->_tpl_vars['de']['sp_product']['price']; ?>
</td>
            <th>市场指导价</th>
            <td><?php echo $this->_tpl_vars['de']['sp_product']['mark_price']; ?>
</td>
          </tr>
          <tr>
            <th style="color:red;">毛重(g)</th>
            <td><?php echo $this->_tpl_vars['de']['stock']['mz']; ?>
</td>
            <th>净重(g)</th>
            <td><?php echo $this->_tpl_vars['de']['stock']['jz']; ?>
</td>
          </tr>
          <thead>
            <tr>
              <th bgcolor="#E2EEFE" colspan="4">商品信息</th>
            </tr>
          </thead>
          <tr>
            <th>商品条码</th>
            <td><?php echo $this->_tpl_vars['de']['stock']['barcode']; ?>
</td>
            <th>产品名称</th>
            <td><?php echo $this->_tpl_vars['de']['stock']['cname']; ?>
</td>
          </tr>
          <tr>
            <th>规格</th>
            <td><?php echo $this->_tpl_vars['de']['stock']['gg']; ?>
</td>
            <th>商品简述</th>
            <td><?php echo $this->_tpl_vars['de']['stock']['desc']; ?>
</td>
          </tr>
          <tr>
            <th>功能/用途</th>
            <td colspan="3"><?php echo $this->_tpl_vars['de']['stock']['gn']; ?>
</td>
          </tr>
          <tr>
            <th>成分</th>
            <td colspan="3"><?php echo $this->_tpl_vars['de']['stock']['cf']; ?>
</td>
          </tr>
          <tr>
            <th bgcolor="#E2EEFE" colspan="4">平台参数</th>
          </tr>
          <tr>
            <th width="100">平台编号</th>
            <td width="240"><?php echo $this->_tpl_vars['de']['stock']['id']; ?>
</td>
            <th width="100">平台仓库号</th>
            <td width="*"><?php echo $this->_tpl_vars['de']['stock']['warehouse_id']; ?>
</td>
          </tr>
          <tr>
            <th style="color:red;">平台总库存</th>
            <td><?php echo $this->_tpl_vars['de']['sp_product']['c_num']; ?>
</td>
            <th style="color:red;">平台已分配库存</th>
            <td><?php echo $this->_tpl_vars['de']['sp_product']['online_num']; ?>
</td>
          </tr>
          <tr>
            <th>平台总销售数</th>
            <td><?php echo $this->_tpl_vars['de']['sp_product']['sell_num']; ?>
 </td>
            <th>平台正在推送数</th>
            <td><?php echo $this->_tpl_vars['de']['sp_product']['send_num']; ?>
</td>
          </tr>
          <tr>
            <th>平台运营成本</th>
            <td><?php echo $this->_tpl_vars['de']['stock']['cb_price']; ?>
</td>
            <th>平台定义售价</th>
            <td><?php echo $this->_tpl_vars['de']['stock']['price']; ?>
</td>
          </tr>
          <tr>
            <th>平台定义市场价</th>
            <td><?php echo $this->_tpl_vars['de']['stock']['mark_price']; ?>
</td>
            <th>平台供货状态</th>
            <td><?php if ($this->_tpl_vars['de']['stock']['is_shop'] == -1): ?>平台禁止售<?php endif; ?> <?php if ($this->_tpl_vars['de']['stock']['is_shop'] == 1): ?>开放申请库存<?php endif; ?> <?php if ($this->_tpl_vars['de']['stock']['is_shop'] == 0): ?>停止申请库存<?php endif; ?></td>
          </tr>
          <tr>
            <th bgcolor="#E2EEFE" colspan="4">审核填写参数</th>
          </tr>
          <tr>
            <th colspan="4">               <div id='alert-error_1' class="alert alert-error hide">
                <button class="close" data-dismiss="alert"></button>
                <span>提交失败</span> </div>
              <div id='alert-success_1' class="alert alert-success hide">
                <button class="close" data-dismiss="alert"></button>
                <span>提交成功</span> </div>
              <div class="control-group">
                <label class="control-label">分销价格<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="price" class="span6 m-wrap"  style=" width:200px;" value="" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">市场价格<span class="required">*</span></label>
                <div class="controls">
                  <input type="text" name="mark_price" class="span6 m-wrap" style=" width:200px;" value="" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">上架状态<span class="required">*</span></label>
                <div class="controls">
                  <select name="status" style=" width:200px;" class="span2 m-wrap">
                    <option value="">审核状态</option>
                    <option value="0">下架</option>
                    <option value="1">上架</option>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">审核描述</label>
                <div class="controls">
                  <textarea class="span6 m-wrap" style=" width:200px;" name="con"></textarea>
                </div>
              </div>
            </th>
          </tr>
        </table>
        <div class="form-actions">
          <input type="hidden" name="id" value="">
          <input type="hidden" name="<?php echo $this->_tpl_vars['csrf']['name']; ?>
" value="<?php echo $this->_tpl_vars['csrf']['hash']; ?>
">
          <button type="button" id='submit_seller_product_check' class="btn red">提交</button>
        </div>
      </form>
      <!-- END FORM--> 
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
  
  var form1 = $('#form_seller_product_check');
  form1.validate({
    errorElement: 'span', //default input error message container
    errorClass: 'help-inline', // default input error message class
    focusInvalid: false, // do not focus the last invalid input
    ignore: "",
    rules: {
      price: {
        required: true
      }
      ,
      mark_price: {
        required: true
      }
	  ,
      status: {
        required: true
      }
    },
    messages : {
      price:{
         required:'销售价不能为空',
       }
      ,
      mark_price: {
        required: '市场价不能为空'
	  }
      ,
	  status: {
        required: '请选择上架状态'
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
    if(form1.valid()==true)
    {
		  //encodeURI(msg)
		  $modal=$('#ajax-modal');
		  error1.hide();
		  success1.show();
		  success1.find('span').html('正在提交...........');
		  $('body').modalmanager('loading');
		  $.post('<?php echo ((is_array($_tmp="seller_product/seller_product_check")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id=<?php echo $_GET['id']; ?>
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
<?php /* Smarty version 2.6.20, created on 2017-07-13 10:06:24
         compiled from product_add.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'product_add.htm', 118, false),array('modifier', 'site_url', 'product_add.htm', 368, false),array('modifier', 'get_ueditor_image_url', 'product_add.htm', 416, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
    <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>首页</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">我的商品</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#"><?php if (empty ( $this->_tpl_vars['product'] )): ?>添加商品<?php else: ?>编辑商品<?php endif; ?></a></li>
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
              <div class="caption"><i class="icon-reorder"></i><?php if (empty ( $this->_tpl_vars['product'] )): ?>添加商品<?php else: ?>编辑商品<?php endif; ?></div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM-->
              <form action="" id="form_product_add" class="form-horizontal" method="post" >               
                
                                <div class="row-fluid">
                  <div id='alert-error_1' class="alert alert-error hide">
                    <button class="close" data-dismiss="alert"></button>
                    <span>提交失败</span>
                  </div>
                  <div id='alert-success_1' class="alert alert-success hide">
                    <button class="close" data-dismiss="alert"></button>
                    <span>提交成功</span>
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span4" >
                    <label class="control-label">商品仓库<span class="required">*</span></label>
                    <div class="controls">
                      <select size="1" <?php if ($this->_tpl_vars['act'] == 2): ?>disabled="disabled"<?php endif; ?> id="form_2_select2" name="warehouse_id" aria-controls="sample_1" class="form_2_select2 m-wrap span12">
                      <option value=''>请选择仓库</option>
                      <?php $_from = $this->_tpl_vars['res_warehouse']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                      <option  value="<?php echo $this->_tpl_vars['item']['id']; ?>
}>" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['product']['info']['warehouse_id']): ?>selected="selected"<?php endif; ?>   ><?php echo $this->_tpl_vars['item']['company']; ?>
--<?php echo $this->_tpl_vars['item']['name']; ?>
</option>
                      <?php endforeach; endif; unset($_from); ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row-fluid" style="margin-top:10px;">
                  <div class="span4" >
                    <label class="control-label">商品名称<span class="required">*</span></label>
                    <div class="controls">
                      <input type="text" <?php if ($this->_tpl_vars['act'] == 2): ?>disabled="disabled"<?php endif; ?> class="span12 m-wrap" name="name" value="<?php echo $this->_tpl_vars['product']['info']['name']; ?>
"/>
                    </div>
                  </div>

                  <div class="span4" >
                    <label class="control-label">商品条码<span class="required">*</span></label>
                    <div class="controls">
                      <input type="text" <?php if ($this->_tpl_vars['act'] == 2): ?>disabled="disabled"<?php endif; ?> class="span12 m-wrap" name="barcode" value="<?php echo $this->_tpl_vars['product']['info']['barcode']; ?>
"/>
                    </div> 
                  </div> 
                </div>
                
                <div class="row-fluid" style="margin-top:10px;">
                  <div class="span4" >
                    <label class="control-label">我的售价<span class="required">*</span></label>
                    <div class="controls">
                      <input type="text" <?php if ($this->_tpl_vars['act'] == 2): ?>disabled="disabled"<?php endif; ?> class="span12 m-wrap" name="price" value="<?php echo $this->_tpl_vars['product']['info']['price']; ?>
"/>
                    </div> 
                  </div> 

                  <div class="span4" >
                    <label class="control-label">市场指导价</label>
                    <div class="controls">
                      <input type="text" <?php if ($this->_tpl_vars['act'] == 2): ?>disabled="disabled"<?php endif; ?> class="span12 m-wrap" name="mark_price" <?php if (empty ( $this->_tpl_vars['product'] )): ?>value='0'<?php else: ?>value="<?php echo $this->_tpl_vars['product']['content']['mark_price']; ?>
"<?php endif; ?>/>
                    </div>
                  </div>
                </div>
                
                <div class="row-fluid" style="margin-top:10px;">
                   <div class="span4" >
                    <label class="control-label">商品库存</label>
                    <div class="controls">
                      <input type="text" class="span12 m-wrap" name="c_num" <?php if (empty ( $this->_tpl_vars['product'] )): ?>value='0'<?php else: ?>value="<?php echo $this->_tpl_vars['product']['info']['c_num']; ?>
"<?php endif; ?>/>
                      <?php if ($this->_tpl_vars['act'] == 2): ?>
                      	  <input type="hidden" class="span12 m-wrap" name="c_num_old"  value="<?php echo $this->_tpl_vars['product']['info']['c_num']; ?>
"  />
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="span4" >
                    <label class="control-label">商品简述<span class="required">*</span></label>
                    <div class="controls">
                      <input type="text" <?php if ($this->_tpl_vars['act'] == 2): ?>disabled="disabled"<?php endif; ?> class="span12 m-wrap" name="desc" value="<?php echo $this->_tpl_vars['product']['content']['desc']; ?>
"/>
                    </div>
                  </div>  
                </div>
                
                <div class="row-fluid" style="margin-top:10px;">
                  <div class="span4" >
                    <label class="control-label">品牌<span class="required">*</span></label>
                    <div class="controls">
                      <input type="text" <?php if ($this->_tpl_vars['act'] == 2): ?>disabled="disabled"<?php endif; ?> class="span12 m-wrap" name="brand" value="<?php echo $this->_tpl_vars['product']['content']['brand']; ?>
"/>
                    </div> 
                  </div> 

                  <div class="span4">
                    <label class="control-label">商品类别<span class="required">*</span></label>
                      <div class="controls">
                        <select size="1" <?php if ($this->_tpl_vars['act'] == 2): ?>disabled="disabled"<?php endif; ?> id="form_2_select2" name="cat" aria-controls="sample_1" class="form_2_select2 m-wrap span12">
                          <option value=''>请选择商品类别</option>
                          <?php $_from = $this->_tpl_vars['res_stock_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> 
                              <?php if ($this->_tpl_vars['item']['pid'] == 0): ?>
                             	    <option disabled="disabled" value="<?php echo $this->_tpl_vars['item']['id']; ?>
|<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['cat'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
">======<?php echo $this->_tpl_vars['item']['cat']; ?>
=======</option>
                              <?php else: ?>
                              	    <option <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['product']['content']['cat_id']): ?>selected="selected"<?php endif; ?>  value="<?php echo $this->_tpl_vars['item']['id']; ?>
|<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['cat'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
">
                                      .<?php echo $this->_tpl_vars['item']['cat']; ?>

                                   </option>    
                              <?php endif; ?>
                          <?php endforeach; endif; unset($_from); ?>
                        </select>
                      </div>
                  </div>
                </div>

                <div class="row-fluid" style="margin-top:10px;">
                  <div class="span4">
                    <label class="control-label">产地<span class="required">*</span></label>
                      <div class="controls">
                        <select size="1" <?php if ($this->_tpl_vars['act'] == 2): ?>disabled="disabled"<?php endif; ?> id="form_2_select2" name="country" aria-controls="sample_1" class="form_2_select2 m-wrap span12">
                          <option value=''>请选择产地</option>
                          <?php $_from = $this->_tpl_vars['res_country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> 
                            <option <?php if ($this->_tpl_vars['item']['c_id'] == $this->_tpl_vars['product']['content']['countryid']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['c_id']; ?>
|<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['c_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
">
                              <?php echo $this->_tpl_vars['item']['c_name']; ?>

                            </option>
                            
                            
                          <?php endforeach; endif; unset($_from); ?>
                        </select>
                      </div>
                  </div>

                  <div class="span4" >
                    <label class="control-label">长度</label>
                    <div class="controls">
                      <input type="text" <?php if ($this->_tpl_vars['act'] == 2): ?>disabled="disabled"<?php endif; ?> class="span12 m-wrap" name="length" <?php if (empty ( $this->_tpl_vars['product'] )): ?>value='0'<?php else: ?>value="<?php echo $this->_tpl_vars['product']['content']['length']; ?>
"<?php endif; ?>/>
                    </div>
                  </div> 
                </div>

                <div class="row-fluid" style="margin-top:10px;">        
                  <div class="span4" >
                    <label class="control-label">宽度</label>
                    <div class="controls">
                      <input type="text" <?php if ($this->_tpl_vars['act'] == 2): ?>disabled="disabled"<?php endif; ?> class="span12 m-wrap" name="width" <?php if (empty ( $this->_tpl_vars['product'] )): ?>value='0'<?php else: ?>value="<?php echo $this->_tpl_vars['product']['content']['width']; ?>
"<?php endif; ?>/>
                    </div> 
                  </div> 
        
                  <div class="span4" >
                    <label class="control-label">高度</label>
                    <div class="controls">
                      <input type="text" <?php if ($this->_tpl_vars['act'] == 2): ?>disabled="disabled"<?php endif; ?> class="span12 m-wrap" name="height" <?php if (empty ( $this->_tpl_vars['product'] )): ?>value='0'<?php else: ?>value="<?php echo $this->_tpl_vars['product']['content']['height']; ?>
"<?php endif; ?>/>
                    </div>
                  </div> 
                </div>

                <div class="row-fluid" style="margin-top:10px;">
                  <div class="span4" >
                    <label class="control-label">毛重(g)</label>
                    <div class="controls">
                      <input type="text" <?php if ($this->_tpl_vars['act'] == 2): ?>disabled="disabled"<?php endif; ?> class="span12 m-wrap" name="mz" <?php if (empty ( $this->_tpl_vars['product'] )): ?>value='0'<?php else: ?>value="<?php echo $this->_tpl_vars['product']['content']['mz']; ?>
"<?php endif; ?>/>
                    </div>
                  </div>

                  <div class="span4" >
                    <label class="control-label">净重(g)</label>
                    <div class="controls">
                      <input type="text" <?php if ($this->_tpl_vars['act'] == 2): ?>disabled="disabled"<?php endif; ?> class="span12 m-wrap" name="jz" <?php if (empty ( $this->_tpl_vars['product'] )): ?>value='0'<?php else: ?>value="<?php echo $this->_tpl_vars['product']['content']['jz']; ?>
"<?php endif; ?>/>
                    </div> 
                  </div> 
                </div>
                
                <div class="row-fluid" style="margin-top:10px;">
                  <div class="span4" >
                    <label class="control-label">主要成分<span class="required">*</span></label>
                    <div class="controls">
                      <input type="text" <?php if ($this->_tpl_vars['act'] == 2): ?>disabled="disabled"<?php endif; ?> class="span12 m-wrap" name="cf" value="<?php echo $this->_tpl_vars['product']['content']['cf']; ?>
"/>
                    </div>
                  </div>

                  <div class="span4" >
                    <label class="control-label">功能/用途<span class="required">*</span></label>
                    <div class="controls">
                      <input type="text" <?php if ($this->_tpl_vars['act'] == 2): ?>disabled="disabled"<?php endif; ?> class="span12 m-wrap" name="gn" value="<?php echo $this->_tpl_vars['product']['content']['gn']; ?>
"/>
                    </div> 
                  </div> 
                </div>

                <div class="row-fluid" style="margin-top:10px;">
                  <div class="span4" >
                    <label class="control-label">规格/型号<span class="required">*</span></label>
                    <div class="controls">
                      <input type="text" <?php if ($this->_tpl_vars['act'] == 2): ?>disabled="disabled"<?php endif; ?> class="span12 m-wrap" name="gg" value="<?php echo $this->_tpl_vars['product']['content']['gg']; ?>
"/>
                    </div> 
                  </div> 

                  <div class="span4">
                    <label class="control-label">食品/非食品<span class="required">*</span></label>
                      <div class="controls">  
                        <label class="radio inline">
                          <input <?php if ($this->_tpl_vars['act'] == 2): ?>disabled="disabled"<?php endif; ?>  type="radio" value="食品" <?php if ($this->_tpl_vars['product']['content']['type'] == '食品'): ?>checked="checked"<?php endif; ?> name="type">食品</label>
                        <label class="radio inline">
                          <input <?php if ($this->_tpl_vars['act'] == 2): ?>disabled="disabled"<?php endif; ?> type="radio" value="非食品" <?php if ($this->_tpl_vars['product']['content']['type'] == '非食品'): ?>checked="checked"<?php endif; ?> name="type">非食品</label>
                      </div>
                  </div>    
                </div>
                
               <div class="row-fluid" style="margin-top:10px;">
                  <div class="span12" >
                    <label class="control-label">主图<span class="required">*</span></label>
                    <div class="controls" >
                      <div  style="width:300px; height:300px; border:1px solid red; display:block;"> <img width="100%"  id='upload_pic_bg' src="<?php if ($this->_tpl_vars['product']['content']['pic']): ?><?php echo $this->_tpl_vars['product']['content']['pic']; ?>
<?php else: ?>/pt_image/default.png<?php endif; ?>"/> </div>

                         <span class="btn"  id='upload_image' style="width:300px;padding:0px; ">上传主图</span>
                         <input  type="hidden"  id='upload_pic' name="pic" value="<?php echo $this->_tpl_vars['product']['content']['pic']; ?>
"/>

                    </div>
                  </div>
                </div>
                  
                <div class="row-fluid" style="margin-top:10px;">
                  <div class="span12" >
                    <label class="control-label">详情描述<span class="required">*</span></label>
                    <div class="controls" >
                    

                        <script>
                        	  var server_auth="<?php echo $this->_tpl_vars['ueditor_auth']; ?>
";
                        </script>
						<script type="text/javascript" charset="utf-8" src="/lib/ueditor/ueditor.config.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
                        <script type="text/javascript" charset="utf-8" src="/lib/ueditor/ueditor.all.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"> </script>
                        <script type="text/javascript" charset="utf-8" src="/lib/ueditor/lang/zh-cn/zh-cn.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
                        <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
                        <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
                        <textarea id="editor" style="width:100%; height:200px"  name="con"><?php echo $this->_tpl_vars['product']['content']['con']; ?>
</textarea>
                        <script>
                        	var ue = UE.getEditor('editor');
                        </script>
                        <!--script id="editor" type="text/plain" style="width:1024px;height:200px;"></script-->
                    </div>
                  </div>
                </div>
                
                <div class="form-actions">
                  <input type="hidden" name="<?php echo $this->_tpl_vars['csrf']['name']; ?>
" value="<?php echo $this->_tpl_vars['csrf']['hash']; ?>
">
                  <?php if (! empty ( $this->_tpl_vars['product'] )): ?>
                    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['product']['info']['id']; ?>
">
                  <?php endif; ?>			  
                  <button type="button" id='submit_product_add' class="btn green">提交</button>
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

var server_auth="<?php echo $this->_tpl_vars['ueditor_auth']; ?>
";
$('.form_2_select2').select2({
            placeholder: "请选择",
            allowClear: true
});
function  set_back_pic(pic)
{ 
	$('#upload_pic').val(pic);
	$('#upload_pic_bg').attr('src',pic);
	$('body').modalmanager('removeLoading');
}
function load_ini()
{
  var error1=$('#alert-error_1'); 
  var success1=$('#alert-success_1'); 
  var form1 = $('#form_product_add');
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
  
  $("#submit_product_add").click(function(){
    if(form1.valid()==true)
    {
      //encodeURI(msg)
      $modal=$('#ajax-modal');
      error1.hide();
      success1.show();
      success1.find('span').html('正在提交...........');
      $('body').modalmanager('loading');
      $.post('<?php echo ((is_array($_tmp="product/product_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form1.serialize(),function(msg){
        //alert(msg);
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
            error1.hide();
            success1.show();
			window.location='<?php echo ((is_array($_tmp="product/product_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
';
            return true;
          }
          
         
          setTimeout(function(){
           $modal.load('<?php echo ((is_array($_tmp="sp_index/sp_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
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
   $('#upload_image').bind('click',function(){
	     $.fn.modal.defaults.width='80%';
	     $.fn.modal.defaults.height='400px'; 
		 $modal=$('#ajax-modal');
		 $modal.load('<?php echo ((is_array($_tmp=1)) ? $this->_run_mod_handler('get_ueditor_image_url', true, $_tmp) : get_ueditor_image_url($_tmp)); ?>
<?php echo $this->_tpl_vars['ueditor_auth']; ?>
&back_id=upload_pic&config_width=600&config_height=600','', function(){
		    $modal.modal();
		 });
  });	
 
}

</script>   
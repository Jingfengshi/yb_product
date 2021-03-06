<?php /* Smarty version 2.6.20, created on 2017-07-11 17:11:21
         compiled from D:%5Cphpstudy%5CWWW%5Cyb_product%5Capplication%5Ctemplates/seller/sproduct_selected.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'D:\\phpstudy\\WWW\\yb_product\\application\\templates/seller/sproduct_selected.htm', 270, false),)), $this); ?>
<div class="modal-header" style="height:30px; background:#000;">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; height:1em; line-height:1em; width:1em;">x</button>
  <h4 style="color:#fff; margin-top:5px;">加入购物车-<?php echo $this->_tpl_vars['de']['id']; ?>
</h4>
</div>
<div class="modal-body">
  <div class="tabbable tabbable-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1_1" data-toggle="tab">商品详情</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab_1_1">
        <table class="table">
           <tr >
            <td  style="border-top:0px;color:#999;" width="80">平台编号</td>
            <td style="border-top:0px;" ><?php echo $this->_tpl_vars['de']['stock_id']; ?>
</td>
            <td  style="border-top:0px;color:#999;" width="80">商品编号</td>
            <td style="border-top:0px;"><?php echo $this->_tpl_vars['de']['id']; ?>
</td>
          </tr>
          <tr >
            <td  width="80">产品中文</td>
            <td><?php echo $this->_tpl_vars['de']['cname']; ?>
</td>
            <td  width="80">拿货价</td>
            <td><?php if ($this->_tpl_vars['de']['price'] > 0): ?><?php echo $this->_tpl_vars['de']['price']; ?>
<?php else: ?>未定价<?php endif; ?></td>
          </tr>
          <tr>
            <td style="color:#999;">产地</td>
            <td><?php echo $this->_tpl_vars['de']['country']; ?>
</td>
            <td style="color:#999;">食品/非食品</td>
            <td><?php echo $this->_tpl_vars['de']['type']; ?>
</td>
          </tr>
          <tr>
            <td style="color:#999;">功能/用途</td>
            <td colspan="3"><?php echo $this->_tpl_vars['de']['gn']; ?>
</td>
          </tr>
          <tr>
            <td colspan="4"><form action="#" id="form_sample_1" onsubmit="return false;" class="form-horizontal">
                <div id='alert-error_1' class="alert alert-error hide">
                  <button class="close" data-dismiss="alert"></button>
                  <span>请填写订单数量</span></div>
                <div id='alert-success_1' class="alert alert-success hide">
                  <button class="close" data-dismiss="alert"></button>
                  <span>申请成功..........请等待管理员审核</span></div>
                <div class="control-group">
                  <label class="control-label">可订购数<span class="required">*</span></label>
                  <div class="controls chzn-controls">
                       <input type="text"   disabled="disabled" class="span2 smallwrap" value="<?php echo $this->_tpl_vars['de']['c_num']; ?>
"/>
                  </div>
                </div>  
                <div class="control-group">
                  <label class="control-label">订购数量<span class="required">*</span></label>
                  <div class="controls chzn-controls">
                       <input type="text" name="num" data-required="1" class="span2 smallwrap"/>
                  </div>
                </div>
                <div class="form-actions" style="padding-bottom:0px;">
                  <input type="hidden"  name="id" value="<?php echo $this->_tpl_vars['de']['id']; ?>
" />
                  <input type="hidden"  name="hg_type" value="1" />
                  <input type="submit" id='form_sample_1_sub' class="btn red" value="加入购物车">
                  <button type="button" data-dismiss="modal"  class="btn">Cancel</button>
                </div>
              </form></td>
          </tr>
        </table>
      </div>
     
    </div>
  </div>
</div>
<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script>
  var error1=$('#alert-error_1'); 
  var success1=$('#alert-success_1'); 
  var form1 = $('#form_sample_1');
    jQuery.validator.addMethod("isNum", function (value, element) {  
		var RegExp = /^\d+$/;  
		return RegExp.test(value);  
	}, $.validator.format("只能为数字!"));  
	jQuery.validator.addMethod("isNum_mim", function (value, element ,param) {  
		var RegExp = /^\d+$/;  
		return RegExp.test(value)&&param<=value;  
	}, $.validator.format("数字必须大于等于{0}"));   
	jQuery.validator.addMethod("isNum_max", function (value, element ,param) {  
		var RegExp = /^\d+$/;  
		return RegExp.test(value)&&param>=value;  
	}, $.validator.format("数字必须小于等于{0}"));   
	
    /*  
	jQuery.validator.addMethod("notEqualTo", function (value, element, param) {  
		return value != $(param).val();  
	}, $.validator.format("两次输入不能相同!"));  
	  
	  
	//只能输入数字  
	jQuery.validator.addMethod("isNum", function (value, element) {  
		var RegExp = /^\d+$/;  
		return RegExp.test(value);  
	}, $.validator.format("只能为数字!"));  
	
	jQuery.validator.addMethod("isNun_max", function (value, element ,param) {  
		var RegExp = /^\d+$/;  
		return RegExp.test(value)&&isNun_max<=value;  
	}, $.validator.format("数字必须小于等于 {0}"));   
	  
	  
	//规则名：buga,value检测对像的值    
	$.validator.addMethod("buga", function (value) {  
		return value == "buga";  
	}, 'Please enter "buga"!');  
	  
	  
	//规则名：chinese，value检测对像的值，element检测的对像    
	$.validator.addMethod("chinese", function (value, element) {  
		var chinese = /^[\u4e00-\u9fa5]+$/;  
		return (chinese.test(value)) || this.optional(element);  
	}, "只能输入中文");  
	  
	  
	//规则名：byteRangeLength，value检测对像的值，element检测的对像,param参数    
	jQuery.validator.addMethod("byteRangeLength", function (value, element, param) {  
		var length = value.length;  
		for (var i = 0; i < value.length; i++) {  
			if (value.charCodeAt(i) > 127) {  
				length++;  
			}  
		}  
		return this.optional(element) || (length >= param[0] && length <= param[1]);  
	}, $.validator.format("请确保输入的值在{0}-{1}个字节之间(一个中文字算2个字节)"));  
	  
	  
	// 联系电话(手机/电话皆可)验证  
	jQuery.validator.addMethod("isPhone", function (value, element) {  
		var length = value.length;  
		var mobile = /^(((13[0-9]{1})|(15[0-9]{1}))+\d{8})$/;  
		var tel = /^\d{3,4}-?\d{7,9}$/;  
		return this.optional(element) || (tel.test(value) || mobile.test(value));  
	  
	  
	}, "请正确填写您的联系电话");  
	  
	  
	// 邮政编码验证  
	jQuery.validator.addMethod("isZipCode", function (value, element) {  
		var tel = /^[0-9]{6}$/;  
		return this.optional(element) || (tel.test(value));  
	}, "请正确填写您的邮政编码");  
	  

	// 字符验证  
	jQuery.validator.addMethod("string", function (value, element) {  
		return this.optional(element) || /^[\u0391-\uFFE5\w]+$/.test(value);  
	}, "不允许包含特殊符号!");  
	  
	  
	// 必须以特定字符串开头验证  
	jQuery.validator.addMethod("begin", function (value, element, param) {  
		var begin = new RegExp("^" + param);  
		return this.optional(element) || (begin.test(value));  
	}, $.validator.format("必须以 {0} 开头!"));  
	  
	  
	// 验证两次输入值是否不相同  
	jQuery.validator.addMethod("notEqualTo", function (value, element, param) {  
		return value != $(param).val();  
	}, $.validator.format("两次输入不能相同!"));  
	  
	  
	// 验证值不允许与特定值等于  
	jQuery.validator.addMethod("notEqual", function (value, element, param) {  
		return value != param;  
	}, $.validator.format("输入值不允许为{0}!"));  
	  
	  
	// 验证值必须大于特定值(不能等于)  
	jQuery.validator.addMethod("gt", function (value, element, param) {  
		return value > param;  
	}, $.validator.format("输入值必须大于{0}!"));  
	  
	  
	// 验证值小数位数不能超过两位  
	jQuery.validator.addMethod("decimal", function (value, element) {  
		var decimal = /^-?\d+(\.\d{1,2})?$/;  
		return this.optional(element) || (decimal.test(value));  
	}, $.validator.format("小数位数不能超过两位!"));  
	  
	  
	//字母数字  
	jQuery.validator.addMethod("alnum", function (value, element) {  
		return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);  
	}, "只能包括英文字母和数字");  
	  
	  
	// 汉字  
	jQuery.validator.addMethod("chcharacter", function (value, element) {  
		var tel = /^[\u4e00-\u9fa5]+$/;  
		return this.optional(element) || (tel.test(value));  
	}, "请输入汉字");  
	  
	  
	// 身份证号码验证（加强验证）  
	jQuery.validator.addMethod("isIdCardNo", function (value, element) {  
		return this.optional(element) || /^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$/.test(value) || /^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])((\d{4})|\d{3}[A-Z])$/.test(value);  
	}, "请正确输入您的身份证号码");  
	  
	  
	// 手机号码验证  
	jQuery.validator.addMethod("isMobile", function (value, element) {  
		var length = value.length;  
		var mobile = /^(((13[0-9]{1})|(15[0-9]{1}))+\d{8})$/;  
		return this.optional(element) || (length == 11 && mobile.test(value));  
	}, "请正确填写您的手机号码");  
	  
	  
	// 电话号码验证  
	jQuery.validator.addMethod("isTel", function (value, element) {  
		var tel = /^\d{3,4}-?\d{7,9}$/;    //电话号码格式010-12345678  
		return this.optional(element) || (tel.test(value));  
	}, "请正确填写您的电话号码"); 
	*/
	 
  form1.validate({
	  errorElement: 'span', //default input error message container
	  errorClass: 'help-inline', // default input error message class
	  focusInvalid: false, // do not focus the last invalid input
	  ignore: "",
	  rules: {
		      num: {
			  isNum: true,
			  isNum_max:'<?php echo $this->_tpl_vars['de']['c_num']*1; ?>
'*1,
			  isNum_mim:1
			  
		  }
	  },
	  messages : {
			num:{}
	  }
	  ,
	  invalidHandler: function (event, validator) { //display error alert on form submit              
		  success1.hide();
		  error1.find('span').html('请填写数量');
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
	  } ,
       
	  submitHandler: function (form) {
		  error1.hide();
		  success1.show();
		  success1.find('span').html('正在提交请稍等...........');
		  //$('#ajax-modal').modal('hide');
		  //显示进度条
		  $('body').modalmanager('loading');
		   //关闭对话框
		  setTimeout(function(){
				  $.post('<?php echo ((is_array($_tmp="sproduct/sproduct_selected")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id=<?php echo $_GET['id']; ?>
',form1.serialize(),function(msg){
						success1.hide();
						try
						{
						  eval("var str="+msg);
						  //操作成功
						  if(str.type==1)
						  {
							$('body').modalmanager('removeLoading');  
							//错误提示
							error1.show();
							success1.hide();
							error1.find('span').html(str.msg);
						  }
						  else if(str.type==2)
						  {
							$('#data_<?php echo $_GET['id']; ?>
').unbind('click').removeClass('red');
							$('#ajax-modal').modal('hide');
							$('body').modalmanager('removeLoading');
							//提交成功
							error1.hide();
							success1.show();
							success1.find('span').html('提交成功');
						  }
						  else if(str.type==3)
						  {
							 window.location='';
							 return true;
						  }
						}catch(e){ 
							$('body').modalmanager('removeLoading');
							success1.hide();
							error1.find('span').html('系统异常');
							error1.show();
						};
				 	 })
			 },300)
	  }
  });
 
</script> 
<!--div class="modal-footer">
  <button type="button" data-dismiss="modal" class="btn">Close</button>
</div--> 
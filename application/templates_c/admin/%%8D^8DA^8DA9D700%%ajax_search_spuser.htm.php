<?php /* Smarty version 2.6.20, created on 2017-07-11 17:06:07
         compiled from D:%5Cphpstudy%5CWWW%5Cyb_product%5Capplication%5Ctemplates/admin/ajax_search_spuser.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'D:\\phpstudy\\WWW\\yb_product\\application\\templates/admin/ajax_search_spuser.htm', 58, false),)), $this); ?>
<div class="modal-header" style="height:30px; background:#000;" >
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; height:1em; line-height:1em; width:1em;">x</button>
  <h4 style="color:#fff; margin-top:5px;">供应商查询</h4>
</div>
<div class="modal-body" >
  <div class="tabbable tabbable-custom"> 
    <div class="tab-content">
      <div class="tab-pane active" id="tab_1_1">
        <table class="table" >
          <tr>
            <td colspan="4">
              <form  method="post" >
                  <input type="text" id='shopname' 
                   class="m-wrap small"  autocomplete="off" autocorrect="off"  autocapitalize="off" spellcheck="false"  value="">
                  <input type="button" id='form_add_pro' class="btn red"  value="查询商户">
                  <button type="button" data-dismiss="modal"  class="btn">关闭窗口</button>
              </form>
              </td>
          </tr>
          <tr>
            <td colspan="4">
            <div style="height:210px; overflow-y:auto;" >
                  <table class="table table-striped table-bordered table-hover dataTable" id="product_3" >
                    <thead>
                      <tr >
                        <th class="sorting_disabled" style="width:80px;">UID</th>
                        <th class="sorting_disabled" width="*">商户名称</th>
                        <th class="sorting_disabled" width="*">操作</th>
                      </tr>
                    </thead>
                    <tbody role="alert" id='ajax_search_spuser_con' class="" aria-live="polite" aria-relevant="all">
                       <tr>
                        <th class="sorting_disabled" style="width:80px;"></th>
                        <th class="sorting_disabled" width="*"></th>
                        <th class="sorting_disabled" width="*"></th>
                       
                       </tr>
                    </tbody>
                  </table>
            </div>
            </td>
          </tr>
        </table>
      </div>
     </div>
    </div>
  </div>
</div>
<script>
function up_ajax_search_spuser_con(uid,company)
{
    $('.ajax_search_spuser_company').val(decodeURIComponent(company));
	$('.ajax_search_spuser_uid').val(uid);
    $('#ajax-modal_1').modal('hide');
}
//重新获取数据
$('#form_add_pro').bind('click',function(){
     $.post("<?php echo ((is_array($_tmp='base_ajax/search_spuser')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
",{ajax:1,name:$('#shopname').val()},function(data){
		    $('#ajax_search_spuser_con tr').remove();
			try
			{
				eval('var data='+data);
				for(var j in data)
				{
					str='<tr><td>'+data[j].userid+'</td>'+
					   '<td>'+data[j].name+'</td>'+
					   '<td><a href="javascript:;" onclick="up_ajax_search_spuser_con('+data[j].userid+',\''+encodeURIComponent(data[j].name)+'\')">选择</a> </td></tr>';
					$('#ajax_search_spuser_con').append(str);
				}
			}catch(e){};
		
	});
});

</script> 
<!--div class="modal-footer">
  <button type="button" data-dismiss="modal" class="btn">Close</button>
</div--> 
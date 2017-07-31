<?php /* Smarty version 2.6.20, created on 2017-07-11 17:47:37
         compiled from logccom_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'logccom_list.htm', 21, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li><i class="icon-home"></i> <a>物流企业管理</a> <span class="icon-angle-right"></span></li>
        <li><a href="#">物流企业</a> <span class="icon-angle-right"></span></li>
        <li><a href="#">物流企业列表</a></li>
      </ul>
      <!-- END PAGE TITLE & BREADCRUMB--> 
    </div>
  </div>
  <!-- END PAGE HEADER--> 
  <!-- BEGIN PAGE CONTENT-->
  <div class="row-fluid">

    <div class="span12">
      <div>
          <span onclick="alertWin('添加物流企业',800,400,'<?php echo ((is_array($_tmp="logistics/logccom_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/')" class="btn red">添加物流企业</span>
        <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
          <thead>
            <tr role="heading">
              <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
              <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">ID</th>
              <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">物流企业编号</th>
              <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">物流企业名称</th>
            </tr>
          </thead>
          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php if ($this->_tpl_vars['res']): ?>
            <?php $_from = $this->_tpl_vars['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <tr>
              <td width="100"><a href="#" onclick="alertWin('编辑运费模版',800,400,'<?php echo ((is_array($_tmp="logistics/logccom_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn green mini">编辑</a></td>
              <td width="70"><?php echo $this->_tpl_vars['item']['id']; ?>
</span></td>                  
              <td width="150"><?php echo $this->_tpl_vars['item']['type']; ?>
</td>
              <td width="*"><?php echo $this->_tpl_vars['item']['company']; ?>
</td> 
            </tr>
            <?php endforeach; endif; unset($_from); ?>
          <?php else: ?>
            <tr>
              <td colspan="99">暂时无数据</td>
            </tr>
          <?php endif; ?>
          </tbody> 
        </table>
      </div>
    </div>
  </div>
  <!-- END PAGE CONTENT--> 
</div>
<link href="/static/css/jquery.fancybox.css" rel="stylesheet">
<script src="/static/js/jquery.fancybox.pack.js"></script> 
<script>
$('.form_2_select2').select2({
            placeholder: "请选择",
            allowClear: true
});
var bind_window=function()
{
	 App.initFancybox();
	$.fn.modalmanager.defaults.resize = true;
	$.fn.modalmanager.defaults.spinner = '<div class="loading-spinner fade" style="width: 200px; margin-left: -100px;"><img src="/static/ajax-modal-loading.gif" align="middle">&nbsp;<span style="font-weight:300; color: #eee; font-size: 18px; font-family:Open Sans;">&nbsp;Loading...</div>';
	var $modal = $('#ajax-modal');
	$('#product_1 .show_detail').each(function(index, element) {
		  var  select_id=$(this).attr('data-id');
		  $(this).on('click', function(){
			  // create the backdrop and wait for next modal to be triggered
			  $('body').modalmanager('loading');
				setTimeout(function(){
				 $modal.load('?m=product&s=bs_pro&select_id='+ select_id, '', function(){
					$modal.modal();
					//$modal.css('margin-top','0');
				 });
				}, 200);
		});
	});
}
//row-details row-details-close
var initTable1 = function() {
        /* Formating function for row details */
      
        /*
         * Insert a 'details' column to the table
         */

         
		var oTable = $('#product_1').dataTable( {
           "aoColumnDefs": [
               {"bSortable": false, "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']],
            "aLengthMenu": [
               [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
           ],
		    "oLanguage": {
					"sProcessing": "正在加载中......",
					"sLengthMenu": "每页显示 _MENU_ 条记录",
					"sZeroRecords": "正在加载中......",
					"sEmptyTable": "查询无数据！",
					"sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录",
					"sInfoEmpty": "显示0到0条记录",
					"sInfoFiltered": "数据表中共为 _MAX_ 条记录",
					"sSearch": "当前页数据搜索",
					"oPaginate": {
					 "sFirst": "首页",
					 "sPrevious": "上一页",
					 "sNext": "下一页",
					 "sLast": "末页"
					}
  			},
			"bSort":false,
			"bInfo":false,
			"bPaginate":false,
			"bAutoWidth":true,
			"bStateSave":false,
			"sScrollX":'1690px',
			//"sScrollY":"300px",
            // set the initial value
            "iDisplayLength": 10,
			//'sScrollXInner':true,
			//"bSortCellsTop":true,
        });
        
      
    }


function load_ini()
{
	bind_window();
	/* <?php if ($this->_tpl_vars['re']['list']): ?> */
	initTable1();
	/* <?php endif; ?> */
	/*
	jQuery('.group-checkable').change(function () {
	  var set = jQuery(this).attr("data-set");
	  var checked = jQuery(this).is(":checked");
	  jQuery(set).each(function () {
		  if (checked) {
			  $(this).attr("checked", true);
		  } else {
			  $(this).attr("checked", false);
		  }
	  });
	  jQuery.uniform.update(set);
	});
	*/
	
}

</script> 
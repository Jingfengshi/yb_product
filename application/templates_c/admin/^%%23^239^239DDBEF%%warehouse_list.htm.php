<?php /* Smarty version 2.6.20, created on 2017-07-11 15:17:24
         compiled from warehouse_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'warehouse_list.htm', 55, false),array('modifier', 'get_hg_name', 'warehouse_list.htm', 84, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>仓库管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">仓库管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">仓库列表</a></li>
      </ul>
      <!-- END PAGE TITLE & BREADCRUMB--> 
    </div>
  </div>
  <!-- END PAGE HEADER--> 
  <!-- BEGIN PAGE CONTENT-->
  <div class="row-fluid">
    <div class="span12">
      <div class="portlet box blue">
        <div class="portlet-title">
          <div class="caption"><i class="icon-search"></i>仓库搜素</div>
          <div class="tools"> <a href="javascript:;" class="collapse"></a> </div>
        </div>
        <div class="portlet-body" style="display: block;">
          <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <form action="" method="get" onsubmit="return load_sub();">
              <div class="row-fluid">
                <span class="span1" style="display:block;">
                <div id="span_label">每页显示</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_page_num" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option <?php if ($_GET['search_page_num'] == 'all'): ?>selected="selected"<?php endif; ?> value="all">每页显示</option>
                    <option <?php if ($_GET['search_page_num'] == '1'): ?>selected="selected"<?php endif; ?> value="1">15</option>
                    <option <?php if ($_GET['search_page_num'] == '2'): ?>selected="selected"<?php endif; ?> value="2">30</option>
                    <option <?php if ($_GET['search_page_num'] == '3'): ?>selected="selected"<?php endif; ?> value="3">50</option>
                  </select>
                </div>
                
                <span class="span1" style="display:block;">
                <div id="span_label">供应商UID</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <div class="input-append">
                    <input class="m-wrap small" type="text" name="search_sp_uid" value="<?php echo $_GET['search_sp_uid']; ?>
">
                    <button class="btn green" type="submit">Search</button>
                  </div>
                </div>                              
              </div>
            </form>
          </div>
           
        </div>
      </div>
       <span onclick="alertWin('添加供应商',800,400,'<?php echo ((is_array($_tmp="warehouse/warehouse_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
')" class="btn red">添加仓库</span>
      <div> 
        <form action="" method="post">
          <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
            <thead>
              <tr role="heading">
                <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                <th width="90" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">平台仓库号</th>
                <th width="90" class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">供应商UID</th>
                <th width="120" class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">对应接仓号</th>
                <th width="80" class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">批发运费</th>
                <th width="80" class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">零售运费</th>
                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">发货地区</th>
                <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">所属类型</th>
                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">仓库别称</th>
                <th width="*" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1" >供应商名称</th>
              </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
            <?php if ($this->_tpl_vars['re']): ?>
              <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <tr>
                  <td><a href="#" onclick="alertWin('编辑仓库',800,400,'<?php echo ((is_array($_tmp="warehouse/warehouse_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn green mini"><i class="icon-edit"></i> 编辑</a></td>
                  <td><?php echo $this->_tpl_vars['item']['id']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['sp_uid']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['out_warehouse_id']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['logistics_temp_id']; ?>
</td>      
                   <td><?php echo $this->_tpl_vars['item']['logistics_temp_id_ls']; ?>
</td>                  
                  <td><?php echo $this->_tpl_vars['item']['hg_name']; ?>
</td>
                  <td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['type'])) ? $this->_run_mod_handler('get_hg_name', true, $_tmp) : get_hg_name($_tmp)); ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['company']; ?>
</td>
                </tr>
              <?php endforeach; endif; unset($_from); ?>
            <?php else: ?>
              <tr>
                <td colspan="99">暂时无数据</td>
              </tr>
            <?php endif; ?>
          </table>
          <div class="row-fluid">
            <div class="span6"> </div>
            <div class="clear"></div>
            <div class="span6">
              <div class="dataTables_paginate paging_bootstrap pagination"> <?php echo $this->_tpl_vars['re']['page']; ?>
 </div>
            </div>
          </div>
        </form>
      </div>
      <!--show window-->    
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
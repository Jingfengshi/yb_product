<?php /* Smarty version 2.6.20, created on 2017-07-11 15:17:24
         compiled from spuser_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'spuser_list.htm', 77, false),array('modifier', 'get_login_auth', 'spuser_list.htm', 95, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>供货订阅管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">供应商管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">供应商列表</a></li>
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
          <div class="caption"><i class="icon-search"></i>供应商搜素</div>
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
                <div id="span_label">登录状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2"  name="search_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all">所有状态</option>
                    <option value="0" <?php if ($_GET['search_status'] == 0 && isset ( $_GET['search_status'] ) && $_GET['search_status'] != 'all'): ?>selected="selected"<?php endif; ?> >已关闭</option>
                    <option value="1" <?php if ($_GET['search_status'] == 1): ?>selected="selected"<?php endif; ?> >待提交</option>
                    <option value="2" <?php if ($_GET['search_status'] == 2): ?>selected="selected"<?php endif; ?> >待审核</option>
                    <option value="3" <?php if ($_GET['search_status'] == 3): ?>selected="selected"<?php endif; ?> >已审核</option>
                  </select>
                </div>          
              </div>
              
              <div class="row-fluid" style="margin-top:20px;">
                <span class="span1" style="display:block;">
                <div id="span_label">用户帐号</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input type="text" class="m-wrap small" name="search_user" value="<?php echo $_GET['search_user']; ?>
" />
                </div>          
                
                <span class="span1" style="display:block;">
                <div id="span_label">公司名称</div>
                </span>
                <div class="span2" style="margin-left:0px;">
                  <div class="input-append">
                    <input class="m-wrap small" type="text" name="search_company" value="<?php echo $_GET['search_company']; ?>
">
                    <button class="btn green" type="submit">Search</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div>
          <span onclick="alertWin('添加供应商',800,400,'<?php echo ((is_array($_tmp="spuser/spuser_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/')" class="btn red">添加供应商</span>
        <form action="" method="post">
          <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
            <thead>
              <tr role="heading">
                <th width="120" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                <th width="40" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">状态</th>
                <th width="70" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">供应商ID</th>
                <th width="80" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">用户帐号</th>
                <th width="80" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1" >手机号码</th>
                <th width="*" class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">公司名称</th>
                <th width="120" class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">添加时间</th>
              </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
            <?php if ($this->_tpl_vars['re']): ?>
              <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <tr>
                  <td><a href="#" onclick="alertWin('编辑供应商',800,400,'<?php echo ((is_array($_tmp="spuser/spuser_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn green mini"><i class="icon-edit"></i> 编辑</a> <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['id'])) ? $this->_run_mod_handler('get_login_auth', true, $_tmp, 'sp', $this->_tpl_vars['item']['user']) : get_login_auth($_tmp, 'sp', $this->_tpl_vars['item']['user'])); ?>
"  class="btn green mini" target="_blank">登陆</a>
                  </td>
                  <td>
                    <?php if ($this->_tpl_vars['item']['status'] == 1): ?>
                      <span class="label label-important">待提交</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == 2): ?>
                      <span class="label label-success">待审核</span>
                    <?php elseif ($this->_tpl_vars['item']['status'] == 3): ?>
                      <span class="label label-success">已审核</span>
                    <?php else: ?>
                      <span class="label label-success">已关闭</span>
                    <?php endif; ?>
                  </td>
                  <td><?php echo $this->_tpl_vars['item']['id']; ?>
</td>                  
                  <td><?php echo $this->_tpl_vars['item']['user']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['mobile']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['company']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['addtime']; ?>
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
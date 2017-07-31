<?php /* Smarty version 2.6.20, created on 2017-07-13 11:27:51
         compiled from order_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'f_get_status', 'order_list.htm', 149, false),array('modifier', 'site_url', 'order_list.htm', 217, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>首页</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">订单管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">批发订单</a></li>
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
          <div class="caption"><i class="icon-search"></i>批发订单搜素</div>
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
                    <option <?php if ($_GET['search_page_num'] == '1'): ?>selected="selected"<?php endif; ?>  value="1">15</option>
                    <option <?php if ($_GET['search_page_num'] == '2'): ?>selected="selected"<?php endif; ?>  value="2">30</option>
                    <option <?php if ($_GET['search_page_num'] == '3'): ?>selected="selected"<?php endif; ?>  value="3">50</option>
                  </select>
                </div>
                
                <span class="span1" style="display:block;">
                <div id="span_label">发货状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2"  name="search_delivery_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all" >所有状态</option>
                    <?php $_from = $this->_tpl_vars['delivery_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                      <option <?php if ($_GET['search_delivery_status'] == $this->_tpl_vars['k'] && isset ( $_GET['search_delivery_status'] ) && $_GET['search_delivery_status'] != 'all'): ?>selected = "selected"<?php endif; ?> value = "<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['v']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                </div>    
              </div>
              
              <div class="row-fluid" style="margin-top:20px;">  
                <span class="span1" style="display:block;">
                <div id="span_label">发货开始时间</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <div class="controls">
                    <div class="input-append date date-picker" data-date="<?php echo $_GET['search_stime']; ?>
" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                      <input  name="search_stime" class="m-wrap m-ctrl-medium date-picker small" size="16" type="text" 
                     value="<?php echo $_GET['search_stime']; ?>
">
                      <span class="add-on"><i class="icon-calendar"></i></span> </div>
                  </div>  
                </div>
                  
                <span class="span1" style="display:block;">
                <div id="span_label">结束时间</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <div class="controls">
                    <div class="input-append date date-picker" data-date="<?php echo $_GET['search_etime']; ?>
" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                      <input  name="search_etime" class="m-wrap m-ctrl-medium date-picker small" size="16" type="text" value="<?php echo $_GET['search_etime']; ?>
">
                      <span class="add-on"><i class="icon-calendar"></i></span> </div>
                  </div>
                </div>
              </div>
              
              <div class="row-fluid" style="margin-top:20px; ">
                <span class="span1" style="display:block;">
                <div id="span_label">对账状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2"  name="search_reconciliation_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all"  >所有状态</option>
                    <?php $_from = $this->_tpl_vars['reconciliation_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                      <option <?php if ($_GET['search_reconciliation_status'] == $this->_tpl_vars['k'] && isset ( $_GET['search_reconciliation_status'] ) && $_GET['search_reconciliation_status'] != 'all'): ?>selected = "selected"<?php endif; ?> value = "<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['v']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                </div>
                
                 <span class="span1" style="display:block;">
                <div id="span_label">订单编号</div>
                </span>
                  <div class="span3" style="margin-left:0px;">
                      <input type="text"  name="search_id"   value="<?php echo $_GET['search_id']; ?>
" class="m-wrap small"/>
                  </div>

              </div>
              <div class="row-fluid" style="margin-top:20px; ">
                       <span class="span1" style="display:block;">
                <div id="span_label">手机号码</div>
                </span>
                  <div class="span3" style="margin-left:0px;">
                      <input type="text"  name="search_consignee_mobile"   value="<?php echo $_GET['search_consignee_mobile']; ?>
" class="m-wrap small"/>
                      <button class="btn green" type="submit">Search</button>
                  </div>
              </div>

            </form>
           </div>
        </div>
      </div>
      <div>
        <div>
          <div>
            <form action="" method="post">
              <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
                <thead>
                  <tr role="heading">
                    <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                    <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订单编号</th>
                    <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">仓库号</th>
                    <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订单状态</th>
                    <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">对账状态</th>
                    <th width="80" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订单金额</th>
                    <th width="80" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运费</th>
                    <th width="120" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">联系方式</th>
                    <th  width="120" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">收货人姓名</th>
                    <th width="*" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">收货地址</th>
                    <th width="120" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">发货时间</th>
                    <th width="120" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运单号</th>
                  </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                <?php if ($this->_tpl_vars['re']['list']): ?>
                <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <tr >
                  <td>
                      <button type="button" onclick="modal_iframe('order/order_info','查看订单--【<?php echo $this->_tpl_vars['item']['id']; ?>
】详情','800','400','id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn mini blue ">查看</button>
                      <?php if ($this->_tpl_vars['item']['status'] == 1): ?>
                      <!--<button type="button" data-action="shenhe" data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
" data-box-size="800|250" class="btn mini green order_detail">审核</button>-->
                      <?php endif; ?>
                      <?php if ($this->_tpl_vars['item']['delivery_status'] == 0 && $this->_tpl_vars['item']['payment_status'] == 2 && ( $this->_tpl_vars['item']['status'] == 2 || $this->_tpl_vars['item']['status'] == 3 )): ?>
                      <button type="button"  onclick="modal_iframe('order/order_delivery','订单【<?php echo $this->_tpl_vars['item']['id']; ?>
】发货','800','600','id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn mini red ">发货</button>
                      <?php endif; ?>
                  </td>
                  <td ><?php echo $this->_tpl_vars['item']['id']; ?>
</td>
                  <td ><?php echo $this->_tpl_vars['item']['warehouse_id']; ?>
</td>
                  <td ><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['delivery_status'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'delivery_status') : f_get_status($_tmp, 'delivery_status')); ?>
</td>
                  <td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['reconciliation_status'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'reconciliation_status') : f_get_status($_tmp, 'reconciliation_status')); ?>
</td>
                  <td ><?php echo $this->_tpl_vars['item']['sp_total']; ?>
</td>
                  <td ><?php echo $this->_tpl_vars['item']['logcs_price']; ?>
</td>
                  <td ><?php echo $this->_tpl_vars['item']['consignee_mobile']; ?>
</td>
                  <td ><?php echo $this->_tpl_vars['item']['consignee']; ?>
</td>
                  <td ><?php echo $this->_tpl_vars['item']['consignee_address']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['delivery_time']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['logcs_num']; ?>
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
    </div>
  </div>
  <!-- END PAGE CONTENT--> 
</div>
<link href="/static/css/jquery.fancybox.css" rel="stylesheet">
<script src="/static/js/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" type="text/css" href="/static/css/datepicker.css">
<script type="text/javascript" src="/static/js/bootstrap-datepicker.js"></script>  
<script>

$('.date-picker').datepicker({
  format:'yyyy-mm-dd',
  language: 'cn',
  weekStart: 1,
  todayBtn:  1,
  autoclose: 1,
  todayHighlight: 0,
  startView: 0,
  forceParse: 0,
  showMeridian: 1
});

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
    $('#product_1 .order_detail').each(function(index, element) {
        var  select_id=$(this).attr('data-id');
        var  size = $(this).attr('data-box-size').split("|");
        var  action = $(this).attr('data-action');
        if(action=='check_info')
        {
            var url="<?php echo ((is_array($_tmp='order/order_info')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id="+ select_id;
        }
        else if(action =='fahuo')
        {
            var url="<?php echo ((is_array($_tmp='order/order_delivery')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id="+ select_id;
        }


        $(this).on('click',function(){
            $('body').modalmanager('loading');
            setTimeout(function(){
                $.fn.modal.defaults.width  = size[0]+'px';
                $.fn.modal.defaults.height = size[1]+'px';
                $modal.load(url, '', function(){
                    $modal.modal();
                });
            }, 200);
        })



    });
}
//row-details row-details-close
var initTable1 = function() {
        /* Formating function for row details */
        function fnFormatDetails ( oTable, nTr )
        {
            var aData = oTable.fnGetData( nTr );
            var sOut = '<table>';
            sOut += '<tr><td>平台编号:</td><td>'+(aData[1].replace('row-details-close','')).replace('row-details','')+'</td></tr>';
            sOut += '<tr><td>品牌:</td><td>'+aData[3]+'</td></tr>';
            sOut += '<tr><td>中文名称:</td><td>'+aData[4]+'</td></tr>';
            sOut += '<tr><td>规格:</td><td>'+aData[5]+'</td></tr>';
			sOut += '<tr><td>产地:</td><td>'+aData[6]+'</td></tr>';
			sOut += '<tr><td>成分:</td><td>'+aData[7]+'</td></tr>';
			sOut += '<tr><td>用途:</td><td>'+aData[8]+'</td></tr>';
            sOut += '</table>';
            return sOut;
        }

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
			"sScrollX":'100%',
			//"sScrollY":"300px",
            // set the initial value
            "iDisplayLength": 10,
			//'sScrollXInner':true,
			//"bSortCellsTop":true,
        });
        
        $('#product_1').on('click', ' tbody td .row-details', function () {
            var nTr = $(this).parents('tr')[0];
            if ( oTable.fnIsOpen(nTr) )
            {
                /* This row is already open - close it */
                $(this).addClass("row-details-close").removeClass("row-details-open");
                oTable.fnClose( nTr );
            }
            else
            {
                /* Open this row */                
                $(this).addClass("row-details-open").removeClass("row-details-close");
                oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
            }
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
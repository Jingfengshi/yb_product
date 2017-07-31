<?php /* Smarty version 2.6.20, created on 2017-07-11 15:21:55
         compiled from product_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'get_product_image', 'product_list.htm', 157, false),array('modifier', 'site_url', 'product_list.htm', 211, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>首页</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">产品库</a></li>
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
          <div class="caption"><i class="icon-search"></i>产品库搜素</div>
          <div class="tools"> <a href="javascript:;" class="collapse"></a> </div>
        </div>
        <div class="portlet-body" style="display: block;">
          <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <form action="" method="get" onsubmit="return load_sub();">
              <div class="row-fluid"> <span class="span1" style="display:block;">
                <div id="span_label">每页显示</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_page_num" aria-controls="sample_1" class="form_2_select2 m-wrap small">
                    <option <?php if ($_GET['search_page_num'] == 'all'): ?>selected="selected"<?php endif; ?> value="all">每页显示
                    </option>
                    <option <?php if ($_GET['search_page_num'] == '1'): ?>selected="selected"<?php endif; ?>  value="1">15
                    </option>
                    <option <?php if ($_GET['search_page_num'] == '2'): ?>selected="selected"<?php endif; ?>  value="2">30
                    </option>
                    <option <?php if ($_GET['search_page_num'] == '3'): ?>selected="selected"<?php endif; ?>  value="3">50
                    </option>
                  </select>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">商品产地</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2" name="search_countryid" aria-controls="sample_1" class="form_2_select2 m-wrap small">
                    <option value="all" selected="selected" >所有产地</option>
                    <?php $_from = $this->_tpl_vars['res_country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?> <option <?php if ($_GET['search_countryid'] == $this->_tpl_vars['v']['c_id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['v']['c_id']; ?>
"><?php echo $this->_tpl_vars['v']['c_name']; ?>

                    </option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                </div>
              </div>
              <div class="row-fluid" style="margin-top:10px;"> 
              
                 <span class="span1" style="display:block;">
                <div id="span_label">条形码</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input type="text"  name="search_barcode" class="m-wrap small" value="<?php echo $_GET['search_barcode']; ?>
"  />
                </div>
                
                <span class="span1" style="display:block;">
                <div id="span_label">商品名称</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input class="m-wrap small" type="text" name="search_cname" value="<?php echo $_GET['search_cname']; ?>
" placeholder="搜索中文品名">
                  <input type="hidden" name="act" value="seach" />
                  <input type="hidden" name="m" value="<?php echo $_GET['m']; ?>
" />
                  <input type="hidden" name="s" value="<?php echo $_GET['s']; ?>
" />
                </div>
                
              </div>
              
              <div class="row-fluid" style="margin-top:10px;">
            
                <span class="span1" style="display:block;">
                	<div id="span_label">平台编号</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                   <input type="text"  class="m-wrap small" name="search_id"  value="<?php echo $_GET['search_id']; ?>
"/>
                </div>
                
                 <span class="span1" style="display:block;">
                	<div id="span_label">商品品牌</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                   <input type="text"  name="search_brand"   value="<?php echo $_GET['search_brand']; ?>
" class="m-wrap small"/>
                </div>

              </div>
              
              <div class="row-fluid" style="margin-top:10px; ">
                 
                 <span class="span1" style="display:block;">
                	<div id="span_label">贸易类型</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                     <select size="1" id="form_2_select2"  name="search_hg_type" aria-controls="sample_1" class="form_2_select2 m-wrap small">
                      <option value="all" >所有产品</option>
                      <option <?php if ($_GET['search_hg_type'] == '2'): ?>selected="selected"<?php endif; ?>  value="1">直邮</option>
                      <option <?php if ($_GET['search_hg_type'] == '3'): ?>selected="selected"<?php endif; ?>  value="0">一般贸易</option>
                    </select>
                </div> 
                <span class="span1" style="display:block;">
                	<div id="span_label">选品状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                         <select size="1" id="form_2_select2"  name="search_is_dy" aria-controls="sample_1" class="form_2_select2 m-wrap small">
                          <option value="all" >所有产品</option>
                          <option <?php if ($_GET['search_is_dy'] == '1'): ?>selected="selected"<?php endif; ?>  value="1">已选品
                          
                          </option>
                          <option <?php if ($_GET['search_is_dy'] == '0'): ?>selected="selected"<?php endif; ?>  value="0">未选品
                          
                          </option>
                        </select>
                        <button class="btn green" type="submit">Search</button>
                </div>
              </div>
              
            </form>
          </div>
        </div>
      </div>
      <div>
        <div>
          <div id='product_all'>
            <form action="" id="form_product_select" method="post">
              <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
                <thead>
                  <tr role="heading">
                    <th width="40" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1"> <input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable' />
                    </th>
                    <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">平台编码</th>
                    <th width="40" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">仓号</th>
                    <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">图片</th>
                    <th width="80" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">条形码</th>
                    <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">品牌</th>
                    <th  width="*" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">中文名称</th>
                    <th width="200" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">规格</th>
                    <th width="50" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">产地</th>
                    <th style="display:none; width:0px;" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">成分</th>
                    <th style="display:none; width:0px;"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">用途</th>
                  </tr>
                </thead>
                <tbody role="alert"  aria-live="polite" aria-relevant="all">
                <?php if ($this->_tpl_vars['re']['list']): ?>
                <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <tr>
                  <td ><?php if (! $this->_tpl_vars['item']['s_id']): ?>
                    <input type="checkbox" name="item[]"  value="<?php echo $this->_tpl_vars['item']['id']; ?>
" class="list-checkable" />
                    <?php else: ?>
                    已订阅
                    <?php endif; ?> </td>
                  <td><?php echo $this->_tpl_vars['item']['id']; ?>
 <span style="margin-left:5px;" class="row-details row-details-close"></span></td>
                  <td><?php echo $this->_tpl_vars['item']['warehouse_id']; ?>
</td>
                  <td><a class="fancybox-button" target="_blank" href="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['id'])) ? $this->_run_mod_handler('get_product_image', true, $_tmp) : get_product_image($_tmp)); ?>
">查看图片</a></td>
                  <td><?php echo $this->_tpl_vars['item']['barcode']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['brand']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['cname']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['gg']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['country']; ?>
</td>
                  <td style="display:none; width:0px;"><?php echo $this->_tpl_vars['item']['cf']; ?>
 </td>
                  <td style="display:none; width:0px;" ><?php echo $this->_tpl_vars['item']['gn']; ?>
</td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
                <?php else: ?>
                <tr style="height:0px;">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td style="display:none; width:0px;"></td>
                  <td style="display:none; width:0px;" ></td>
                </tr>
                <?php endif; ?>
              </table>
              <div class="row-fluid">
                <div class="span6">
                  <input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable' />
                  <span id="sub_product_select" class="btn red">选品</span> </div>
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
<script>
$('.form_2_select2').select2({
            placeholder: "请选择",
            allowClear: true
});

var form_product_select=function()
{
	$("#sub_product_select").bind('click',function(){
		$.post('<?php echo ((is_array($_tmp="product/product_select")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',$('#form_product_select').serialize(),function(msg){
			try
			{
				eval("var str="+msg);
				var $modal = $('#ajax-modal');
				setTimeout(function(){
				 $modal.load('<?php echo ((is_array($_tmp="seller_index/seller_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg)
				 ,'', function(){
					$modal.modal();
					if(str.type==3)
					{
						setTimeout(function(){
							window.location='';
						},1000);
					}
				 });
				}, 300);
				
			}catch(e){ 
				$('body').modalmanager('removeLoading');
				success1.hide();
				error1.find('span').html('系统异常');
				error1.show();
			};
		});
	});
}

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
        function fnFormatDetails ( oTable, nTr )
        {
            var aData = oTable.fnGetData( nTr );
            var sOut = '<table width="100%">';
            sOut += '<tr><td width="60">平台编号:</td><td >'+(aData[1].replace('row-details-close','')).replace('row-details','')+'</td></tr>';
			sOut += '<tr><td>品牌:</td><td>'+aData[5]+'</td></tr>';
            sOut += '<tr><td>中文名称:</td><td>'+aData[6]+'</td></tr>';
            sOut += '<tr><td>规格:</td><td>'+aData[7]+'</td></tr>';
			sOut += '<tr><td>产地:</td><td>'+aData[8]+'</td></tr>';
			sOut += '<tr><td>成分:</td><td>'+aData[9]+'</td></tr>';
			sOut += '<tr><td>用途:</td><td>'+aData[10]+'</td></tr>';
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
			"sScrollX":'98%',
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
	form_product_select();

}

</script> 
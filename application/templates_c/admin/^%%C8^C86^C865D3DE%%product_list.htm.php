<?php /* Smarty version 2.6.20, created on 2017-07-13 15:08:18
         compiled from product_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'product_list.htm', 138, false),array('modifier', 'get_erp_img_url', 'product_list.htm', 139, false),array('modifier', 'f_get_status', 'product_list.htm', 140, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>订阅产品</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">订阅产品库</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">产品订阅库</a></li>
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
          <div class="caption"><i class="icon-search"></i>产品订阅库搜素</div>
          <div class="tools"> <a href="javascript:;" class="collapse"></a> </div>
        </div>
        <div class="portlet-body" style="display: block;">
          <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <form action="" method="get" onsubmit="return load_sub();">
              <div class="row-fluid"> <span class="span1" style="display:block;">
                <div id="span_label">每页显示</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_page_num" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option <?php if ($_GET['search_page_num'] == 'all'): ?>selected="selected"<?php endif; ?> value="all">每页显示
                    </option>
                    <option <?php if ($_GET['search_page_num'] == '1'): ?>selected="selected"<?php endif; ?> value="1">15
                    </option>
                    <option <?php if ($_GET['search_page_num'] == '2'): ?>selected="selected"<?php endif; ?> value="2">30
                    </option>
                    <option <?php if ($_GET['search_page_num'] == '3'): ?>selected="selected"<?php endif; ?> value="3">50
                    </option>
                  </select>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">商品产地</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2" name="search_countryid" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all" selected="selected" >所有产地</option>
                    <?php $_from = $this->_tpl_vars['country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?> <option <?php if ($_GET['search_countryid'] == $this->_tpl_vars['v']['c_id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['v']['c_id']; ?>
"><?php echo $this->_tpl_vars['v']['c_name']; ?>

                    </option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                </div>
              </div>
              <div class="row-fluid" style="margin-top:20px;"> <span class="span1" style="display:block;">
                <div id="span_label">订阅状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2" name="search_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all">所有状态</option>
                    <?php $_from = $this->_tpl_vars['stock_d_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['item']):
?> <option <?php if ($_GET['search_status'] != 'all' && $_GET['search_status'] == $this->_tpl_vars['k'] && isset ( $_GET['search_status'] )): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['item']; ?>

                    </option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">供货状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2"  name="search_is_shop" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all" >所有状态</option>
                    <?php $_from = $this->_tpl_vars['stock_k_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['item']):
?> <option  <?php if ($_GET['search_is_shop'] != 'all' && $_GET['search_is_shop'] == $this->_tpl_vars['k'] && isset ( $_GET['search_is_shop'] )): ?>selected="selected"<?php endif; ?>  value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['item']; ?>

                    </option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                </div>
              </div>
              <div class="row-fluid" style="margin-top:20px;"> <span class="span1" style="display:block;">
                <div id="span_label">平台编号</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input type="text" name="search_id" value="<?php echo $_GET['search_id']; ?>
" class="m-wrap small"/>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">商品品牌</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input type="text" name="search_brand" value="<?php echo $_GET['search_brand']; ?>
" class="m-wrap small"/>
                </div>
              </div>
              <div class="row-fluid" style="margin-top:20px;"> <span class="span1" style="display:block;">
                <div id="span_label">所属仓库</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input type="text" name="search_warehouse_id" value="<?php echo $_GET['search_warehouse_id']; ?>
" class="m-wrap small"/>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">商品名称</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <div class="input-append">
                    <input type="text" name="search_cname" value="<?php echo $_GET['search_cname']; ?>
"  class="m-wrap small">
                    <button class="btn green" type="submit">Search</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div id='product_all'>
        <form action="" id='form_product_list' method="post">
          <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
            <thead>
              <tr role="heading">
                <th width="20"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1"><input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable'/></th>
                <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">图片</th>
                <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订阅状态</th>
                <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">销售状态</th>
                <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">公共编码</th>
                <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">贸易类型</th>
                <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">所属仓库</th>
                <th width="180" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">中文名称</th>
                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">品牌</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品类别</th>
                <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">产地</th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">售价</th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运营成本</th>
                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">供应商价</th>
                <th width="*"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">毛重(g)</th>
              </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
            <?php if ($this->_tpl_vars['re']['list']): ?>
            <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <tr>
              <td><input type="checkbox" name="item[]"  value="<?php echo $this->_tpl_vars['item']['id']; ?>
" class="list-checkable" /></td>
              <td><a href="#" onclick="alertWin('编辑公共产品',800,400,'<?php echo ((is_array($_tmp="product/product_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn green mini"><i class="icon-edit"></i>编辑</a></td>
              <td><a class="fancybox-button" data-rel="fancybox-button"  title='<?php echo $this->_tpl_vars['item']['id']; ?>
' href="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['id'])) ? $this->_run_mod_handler('get_erp_img_url', true, $_tmp) : get_erp_img_url($_tmp)); ?>
"> <img  class="load_img" src="/static/load_img.gif"   data-original='<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['id'])) ? $this->_run_mod_handler('get_erp_img_url', true, $_tmp) : get_erp_img_url($_tmp)); ?>
' width="50" height="50" /> </a></td>
              <td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['status'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'stock_d_status') : f_get_status($_tmp, 'stock_d_status')); ?>
</td>
              <td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['is_shop'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'stock_k_status') : f_get_status($_tmp, 'stock_k_status')); ?>
</td>
              <td><?php echo $this->_tpl_vars['item']['id']; ?>
</td>
              <td><?php if ($this->_tpl_vars['item']['hg_type'] == 0): ?><?php endif; ?>
                <?php if ($this->_tpl_vars['item']['hg_type'] == 1): ?>保税<?php endif; ?>
                <?php if ($this->_tpl_vars['item']['hg_type'] == 2): ?>直邮<?php endif; ?>
                <?php if ($this->_tpl_vars['item']['hg_type'] == 3): ?>一般贸易<?php endif; ?> </td>
              <td><?php echo $this->_tpl_vars['item']['warehouse_id']; ?>
</td>
              <td><?php echo $this->_tpl_vars['item']['cname']; ?>
</td>
              <td><?php echo $this->_tpl_vars['item']['brand']; ?>
</td>
              <td><?php echo $this->_tpl_vars['item']['catname']; ?>
</td>
              <td><?php echo $this->_tpl_vars['item']['country']; ?>
</td>
              <td><?php echo $this->_tpl_vars['item']['price']; ?>
</td>
              <td><?php echo $this->_tpl_vars['item']['cb_price']; ?>
</td>
              <td><?php echo $this->_tpl_vars['item']['price']-$this->_tpl_vars['item']['cb_price']; ?>
</td>
              <td><?php echo $this->_tpl_vars['item']['mz']; ?>
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
            <div class="input-append">
              <input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable' />
            </div>
            <div class="input-append">
              <select id='supply_status' class="m-wrap small">
                <option value="no">供货状态</option>
                <option value="1">开启申请</option>
                <option value="0">暂停申请</option>
                <option value="-1">暂停销售</option>
              </select>
              <button type="button"  data-id='#supply_status' data-url='<?php echo ((is_array($_tmp='product/product_edit_shop_status')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
'  class="btn green btn_from_status">修改状态</button>
            </div>
            <div class="input-append">
              <select id='product_status' style="margin-left:20px;" class="m-wrap small">
                <option value="no">产品状态</option>
                <option value="1">开启订阅</option>
                <option value="0">关闭订阅</option>
              </select>
              <button type="button"  data-id='#product_status' data-url='<?php echo ((is_array($_tmp='product/product_edit_status')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
'  class="btn green btn_from_status">修改状态</button>
            </div>
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
			"sScrollX":'1690px',
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
     App.initFancybox();
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
   chang_status(); 

}

var chang_status=function(){
    $('.btn_from_status').bind('click',function(){
		$modal=$('#ajax-modal');
		$('body').modalmanager('loading');
		$.fn.modal.defaults.width='';
		$.fn.modal.defaults.height='';
		var url=$(this).attr('data-url');   
		$.post(url+"?status="+$($(this).attr('data-id')).val(),$('#form_product_list').serialize(),function(msg){
		  try
		  {
			eval("var str="+msg);
			//操作成功
			if(str.type==1)
			{
	
			}
			else if(str.type==2)
			{
	
			
			}
			else if(str.type==3)
			{
			  //刷新主页面
			  f_main_index();
			  return true;
			}s
			setTimeout(function(){
			 $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function(){
			  $modal.modal();
			 });
			}, 300);
		  }catch(e){ 
			
			$('body').modalmanager('removeLoading');
			  setTimeout(function(){
			   $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI('系统异常'),'', function(){
			  $modal.modal();
			 });
			}, 300);
		  };
		});
    });
}
</script> 
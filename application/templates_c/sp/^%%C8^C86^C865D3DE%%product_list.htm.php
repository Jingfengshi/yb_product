<?php /* Smarty version 2.6.20, created on 2017-07-13 13:55:33
         compiled from product_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'product_list.htm', 74, false),array('modifier', 'count', 'product_list.htm', 97, false),array('modifier', 'site_url', 'product_list.htm', 177, false),array('modifier', 'check_img_url', 'product_list.htm', 205, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>首页</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">我的商品</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">我的商品</a></li>
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
          <div class="caption"><i class="icon-search"></i>我的商品搜素</div>
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
                <div id="span_label">商品状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2"  name="search_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all" >所有状态</option>
                    <option <?php if ($_GET['search_status'] == '1'): ?>selected="selected"<?php endif; ?> value="1">上架</option>
                    <option <?php if ($_GET['search_status'] == '0'): ?>selected="selected"<?php endif; ?> value="0">下架</option>
                    <option <?php if ($_GET['search_status'] == '-1'): ?>selected="selected"<?php endif; ?> value="-1">待审核</option>
                    <option <?php if ($_GET['search_status'] == '-2'): ?>selected="selected"<?php endif; ?> value="-2">审核不通过</option>
                  </select>
                </div>  
              </div>
              <div class="row-fluid" style="margin-top:20px; ">               
                <span class="span1" style="display:block;">
                <div id="span_label">商品产地</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2"  name="search_countryid" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all" selected="selected" >所有产地</option>
                    <?php $_from = $this->_tpl_vars['res_country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> 
                      <option <?php if ($_GET['search_countryid'] == $this->_tpl_vars['item']['c_id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['c_id']; ?>
">
                        <?php echo $this->_tpl_vars['item']['c_name']; ?>

                      </option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">商品类别</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2"  name="search_cat_id" aria-controls="sample_1" style="width:200px;" class="form_2_select2 m-wrap span5">
                    <option value="all" selected="selected" >所有类别</option>
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
                      </option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                </div>      
              </div>
              <div class="row-fluid" style="margin-top:20px; ">
                     <span class="span1" style="display:block;">
                        <div id="span_label">有无库存</div>
                     </span>
                     <div class="span3" style="margin-left:0px;">
                          <select size="1" id="form_2_select2"  name="search_has" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                              <option value="all" selected="selected" >请选择</option>
                              <option <?php if (isset ( $_GET['search_has'] ) && $_GET['search_has'] == 1 && $_GET['search_has'] != 'all'): ?>selected="selected"<?php endif; ?> value="1">
                              有</option>
                              <option <?php if (isset ( $_GET['search_has'] ) && $_GET['search_has'] == -1 && $_GET['search_has'] != 'all'): ?>selected="selected"<?php endif; ?> value="-1">
                              无</option>
                          </select>
                         <?php if (( ((is_array($_tmp=$this->_tpl_vars['warehouse'])) ? $this->_run_mod_handler('count', true, $_tmp) : count($_tmp)) ) == 1): ?>
                          <button class="btn green" type="submit">Search</button>
                         <?php endif; ?>
                      </div>
                  <?php if (( ((is_array($_tmp=$this->_tpl_vars['warehouse'])) ? $this->_run_mod_handler('count', true, $_tmp) : count($_tmp)) ) > 1): ?>
                  <span class="span1" style="display:block;">
                        <div id="span_label">商品仓库</div>
                  </span>
                  <div class="span3" style="margin-left:0px;">
                      <select size="1" id="form_2_select2"  name="search_warehouse_id" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                          <option value="all" selected="selected" >请选择</option>
                          <?php $_from = $this->_tpl_vars['warehouse']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                          <option <?php if ($_GET['search_warehouse_id'] == $this->_tpl_vars['item']['id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['id']; ?>
">
                          <?php echo $this->_tpl_vars['item']['id']; ?>
-<?php echo $this->_tpl_vars['item']['name']; ?>

                          </option>
                         <?php endforeach; endif; unset($_from); ?>
                      </select>
                  </div>
                  <?php endif; ?>
              </div>
              <div class="row-fluid" style="margin-top:20px; ">
                    <span class="span1" style="display:block;">
                        <div id="span_label">平台编号</div>
                    </span>
                    <div class="span3" style="margin-left:0px;">
                      <input type="text"  name="search_stock_id"   value="<?php echo $_GET['search_stock_id']; ?>
" class="m-wrap small"/>

                    </div>
                   <span class="span1" style="display:block;">
                        <div id="span_label">图片状态</div>
                  </span>
                  <div class="span3" style="margin-left:0px;">
                      <select size="1" id="form_2_select2"  name="search_pic_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                          <option value="all" selected="selected" >请选择</option>
                          <option <?php if (isset ( $_GET['search_pic_status'] ) && $_GET['search_pic_status'] == 0): ?>selected="selected"<?php endif; ?> value="0">不通过</option>
                          <option <?php if (isset ( $_GET['search_pic_status'] ) && $_GET['search_pic_status'] == 1): ?>selected="selected"<?php endif; ?> value="1">待审核</option>
                          <option <?php if (isset ( $_GET['search_pic_status'] ) && $_GET['search_pic_status'] == 2): ?>selected="selected"<?php endif; ?> value="2">已审核</option>

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
            <form action="" id='sub_from' method="post">
              <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
                <thead>
                  <tr role="heading">
                    <th width="20" class="sorting_disabled"   role="columnheader" tabindex="0" aria-controls="sample_1"><input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable'/></th>
                    <th  width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                    <th  width="40"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">状态</th>
                    <th  width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">图片状态</th>
                    <th  width="40"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">图片</th>
                    <th  width="40"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">仓号</th>
                    <th  width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品ID</th>
                    <th  width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">平台编号</th>
                    <th  width="*"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">中文名称</th>
                    <th  width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">品牌</th>
                    <th  width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品类别</th>
                    <th  width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">规格/型号</th>
                    <th  width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">市场价</th>
                    <th  width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">售价</th>
                    <th  width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">库存</th>
                    <th  width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">批发锁定库存</th>
                    <th  width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">零售锁定库存</th>
                    <th  width="80" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">毛重(g)</th>                
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
                      <td>
                       <?php if (! $this->_tpl_vars['item']['stock_id']): ?>
                      	  <a href="<?php echo ((is_array($_tmp="product/product_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
&act=1" class="btn green mini"><i class="icon-edit"></i> 编辑</a>
                       <?php else: ?>
                          <a href="<?php echo ((is_array($_tmp="product/product_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
&act=2" class="btn green mini"><i class="icon-edit"></i> 修改库存</a>
                       <?php endif; ?>
                      </td>
                      <td>
                        <?php if ($this->_tpl_vars['item']['status'] == 1): ?>
                          <span class="label label-important">上架</span>
                        <?php elseif ($this->_tpl_vars['item']['status'] == 0): ?>
                          <span class="label label-success">下架</span>
                        <?php elseif ($this->_tpl_vars['item']['status'] == -1): ?>
                          <span class="label label-success">待审核</span>
                        <?php elseif ($this->_tpl_vars['item']['status'] == -2): ?>
                          <span class="label label-success">审核不通过</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <?php if ($this->_tpl_vars['item']['pic_status'] == 0): ?>
                        <span class="label label-important">不通过</span>
                        <?php elseif ($this->_tpl_vars['item']['pic_status'] == 1): ?>
                        <span class="label label-success">待审核</span>
                        <?php elseif ($this->_tpl_vars['item']['pic_status'] == 2): ?>
                        <span class="label label-success">已审核</span>

                        <?php endif; ?>
                      </td>
                      <td>
                          <a class="fancybox-button"   href="<?php echo $this->_tpl_vars['item']['pic']; ?>
">
                          	 <img  class="load_img" src="/static/load_img.gif"    data-original="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['pic'])) ? $this->_run_mod_handler('check_img_url', true, $_tmp) : check_img_url($_tmp)); ?>
" />
                          </a>
                      </td>
                      <td><?php echo $this->_tpl_vars['item']['warehouse_id']; ?>
</td> 
                      <td><?php echo $this->_tpl_vars['item']['id']; ?>
</td> 
                      <td><?php echo $this->_tpl_vars['item']['stock_id']; ?>
</td>                     
                      <td><?php echo $this->_tpl_vars['item']['name']; ?>
</td>                                 
                      <td><?php echo $this->_tpl_vars['item']['brand']; ?>
</td>
                      <td><?php echo $this->_tpl_vars['item']['catname']; ?>
</td>
                      <td><?php echo $this->_tpl_vars['item']['gg']; ?>
</td>                                             
                      <td><?php echo $this->_tpl_vars['item']['mark_price']; ?>
</td>
                      <td><?php echo $this->_tpl_vars['item']['price']; ?>
</td>
                      <td><?php echo $this->_tpl_vars['item']['c_num']; ?>
</td>                 
                      <td><?php echo $this->_tpl_vars['item']['online_num']-$this->_tpl_vars['item']['ls_lock_num']; ?>
</td>
                      <td><?php echo $this->_tpl_vars['item']['ls_lock_num']; ?>
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
                   <input name="act" type="hidden" id='op_act' value="" />
                   <span id='sub_del'  class="red mini btn"  > 删除 </span>
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

$( ".fancybox-button").fancybox({
    'showNavArrows':false
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
			"sScrollX":'1800',
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
	$('#sub_del').bind('click',function(){
		modal_confirm('确认删除吗？只能删除【平台编号】为 0 的商品，删除后不可恢复',function(){
			$('#op_act').val('删除');
			$('#sub_from').submit();
		})
	});
	
	
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

	
}

</script> 
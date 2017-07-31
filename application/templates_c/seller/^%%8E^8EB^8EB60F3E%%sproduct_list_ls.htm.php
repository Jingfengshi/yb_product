<?php /* Smarty version 2.6.20, created on 2017-07-18 09:46:11
         compiled from sproduct_list_ls.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'f_get_status', 'sproduct_list_ls.htm', 171, false),array('modifier', 'get_product_image', 'sproduct_list_ls.htm', 178, false),array('modifier', 'site_url', 'sproduct_list_ls.htm', 250, false),)), $this); ?>
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
                  <select size="1" name="search_page_num" aria-controls="sample_1" class="form_2_select2 m-wrap small">
                    <option <?php if ($_GET['search_page_num'] == 'all'): ?>selected="selected"<?php endif; ?> value="all">每页显示</option>
                    <option <?php if ($_GET['search_page_num'] == '1'): ?>selected="selected"<?php endif; ?>  value="1">15</option>
                    <option <?php if ($_GET['search_page_num'] == '2'): ?>selected="selected"<?php endif; ?>  value="2">30</option>
                    <option <?php if ($_GET['search_page_num'] == '3'): ?>selected="selected"<?php endif; ?>  value="3">50</option>
                  </select>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">商品产地</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2"  name="search_countryid" aria-controls="sample_1" class="form_2_select2 m-wrap small">
                    <option value="all" selected="selected" >所有产地</option>
                    <?php $_from = $this->_tpl_vars['res_country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?> 
                    		<option <?php if ($_GET['search_countryid'] == $this->_tpl_vars['v']['c_id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['v']['c_id']; ?>
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
                  <input type="text"  name="search_barcode"   value="<?php echo $_GET['search_barcode']; ?>
" class="m-wrap small"/>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">平台编号</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input type="text"  name="search_stock_id"   value="<?php echo $_GET['search_stock_id']; ?>
" class="m-wrap small"/>
                </div> 
              </div>
              <div class="row-fluid" style="margin-top:10px;">
                <span class="span1" style="display:block;">
                <div id="span_label">商品类型</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                   <select size="1" id="form_2_select2"  style="width:200px;" name="search_cat_id" aria-controls="sample_1" class="form_2_select2 m-wrap">
                    <option value="all" selected="selected" >所有类型</option>
                    <?php $_from = $this->_tpl_vars['res_stock_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                       <?php if ($this->_tpl_vars['item']['pid'] == 0): ?>
                            <option disabled="disabled" value="<?php echo $this->_tpl_vars['item']['id']; ?>
">======<?php echo $this->_tpl_vars['item']['cat']; ?>
=======</option>
                       <?php else: ?>
                      		 <option <?php if ($this->_tpl_vars['item']['id'] == $_GET['search_cat_id']): ?>selected="selected"<?php endif; ?>  value="<?php echo $this->_tpl_vars['item']['id']; ?>
">
                                 .<?php echo $this->_tpl_vars['item']['cat']; ?>

                            </option>
                       <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                </div>
               <span class="span1" style="display:block;">
                <div id="span_label">库存状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                   <select size="1" id="form_2_select2"  name="search_nums" aria-controls="sample_1" class="form_2_select2 m-wrap small">
                     <option value="all" selecteds="selected" >锁库状态</option>
                     <option <?php if ($_GET['search_nums'] == 1): ?>selected="selected"<?php endif; ?> 
                       value="1">无锁定商品</option>
                     <option <?php if ($_GET['search_nums'] == 2): ?>selected="selected"<?php endif; ?> 
                     value="2">有库存锁定</option>  
                     <option <?php if ($_GET['search_nums'] == 3): ?>selected="selected"<?php endif; ?> 
                     value="3">库存锁定超库</option>  
                  </select>
                 </div>
                 
              </div>
              <div class="row-fluid" style="margin-top:10px;">
                <span class="span1" style="display:block;">
                <div id="span_label">上架状态</div>
                </span>                
                <div class="span3" style="margin-left:0px;">                
                  <select size="1" id="form_2_select2"  name="search_status" aria-controls="sample_1" class="form_2_select2 m-wrap small">
                    <option value="all"  >全部</option>
                    <option <?php if ($_GET['search_status'] == '1'): ?>selected="selected"<?php endif; ?> value="1">已上架</option>
                    <option <?php if ($_GET['search_status'] == '0'): ?>selected="selected"<?php endif; ?> value="0">未上架</option>
                  </select>
                </div>
                
                <span class="span1" style="display:block;">
                <div id="span_label">产品名称</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input class="m-wrap small" type="text" name="search_cname" value="<?php echo $_GET['search_cname']; ?>
">
                  <button class="btn green" type="submit">Search</button> 
                </div>
              </div>
              
               <div class="row-fluid" style="margin-top:10px;">
                 <!--
                <span class="span1" style="display:block;">
                <div id="span_label">操作</div>
                </span>
               
                <div class="span3" style="margin-left:0px;">
                  <button class="btn green" type="submit" onclick="return confirm('清零后不能再导出数据');" name="clear">清空锁定库存</button>
                  <button class="btn red" type="submit" onclick="return confirm('确认导出数据吗');"  name="explode">导出已锁定清单</button> 
             
                </div>
                -->
              </div>
              
            </form>
           </div>
        </div>
      </div>
      <div >下架库存只能减不能加</div>
      <div>
        <div>
          <div id='product_input'>
            <form action="" id='form_product' method="post">
              <table class="table table-striped table-bordered table-hover dataTable" id="product_all" >
                <thead>
                  <tr role="heading">
                    <th width="20" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1"><input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable'/></th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">上架状态</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">贸易类型</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品编号</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">仓库号</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">条形码</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">平台编号</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">图片</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">中文名称</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">拿货价格</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">可用库存</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">阀拨最大值</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">零售库存</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">待发货</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">销售数量</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">产地</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">市场价</th>
                  </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                <?php if ($this->_tpl_vars['re']['list']): ?>
                <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <tr>
                  <td><input type="checkbox" name="item[<?php echo $this->_tpl_vars['item']['id']; ?>
]"   value="<?php echo $this->_tpl_vars['item']['id']; ?>
" class="list-checkable item_v" /></td>
                  <td width="70">
                  	<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['status'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'ls_product_status') : f_get_status($_tmp, 'ls_product_status')); ?>

                  </td>    
                  <td width="70"><?php if ($this->_tpl_vars['item']['hg_type'] == 1): ?>保税<?php elseif ($this->_tpl_vars['item']['hg_type'] == 2): ?>直邮<?php elseif ($this->_tpl_vars['item']['hg_type'] == 3): ?>一般贸易<?php endif; ?></td> 
                  <td width="70"><button  type="button" class=" btn mini blue show_detail" data-box-size="800|600" data-action="1" data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['id']; ?>
</button></td>
                  <td width="50"><?php echo $this->_tpl_vars['item']['warehouse_id']; ?>
</td>  
                  <td width="100"><?php echo $this->_tpl_vars['item']['barcode']; ?>
</td>                   
                  <td width="100"><?php echo $this->_tpl_vars['item']['stock_id']; ?>
</td>     
                  <td width="60"><a class="fancybox-button" target="_blank" href="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['stock_id'])) ? $this->_run_mod_handler('get_product_image', true, $_tmp) : get_product_image($_tmp)); ?>
">查看图片</a></td>              
                  <td width="*"><?php echo $this->_tpl_vars['item']['name']; ?>
</td>                               
                  <td width="80"><?php if ($this->_tpl_vars['item']['price'] <= 0): ?>未定价<?php else: ?><?php echo $this->_tpl_vars['item']['price']; ?>
<?php endif; ?></td>
                  <td width="100"><?php echo $this->_tpl_vars['item']['s_num']; ?>

                  	<input type="hidden" class="span12" id='snum_<?php echo $this->_tpl_vars['item']['id']; ?>
' name="s_num[<?php echo $this->_tpl_vars['item']['id']; ?>
]"  value="<?php echo $this->_tpl_vars['item']['s_num']+$this->_tpl_vars['item']['ls_lock_num']; ?>
"/>
                  </td>
                  <td width="100">
                  	<?php echo $this->_tpl_vars['item']['s_num']+$this->_tpl_vars['item']['ls_lock_num']; ?>

                  </td>
                  <td width="80" style="color:red;">
                  <input type="text" <?php if ($this->_tpl_vars['item']['price']*1 == 0): ?>disabled="disabled"<?php endif; ?> data-id='<?php echo $this->_tpl_vars['item']['id']; ?>
' id='ls_num_<?php echo $this->_tpl_vars['item']['id']; ?>
' class="span12 input_v" name="ls_lock_num[<?php echo $this->_tpl_vars['item']['id']; ?>
]"  value="<?php echo $this->_tpl_vars['item']['ls_lock_num']; ?>
"/> 
                  </td>
                  <td width="80" style="color:red;"><?php echo $this->_tpl_vars['item']['online_num']; ?>

                  	<input type="hidden" class="span12" id='lock_num_<?php echo $this->_tpl_vars['item']['id']; ?>
'  value="<?php echo $this->_tpl_vars['item']['online_num']; ?>
"/>
                  </td>   
                  <td width="80" style="color:blue;"><?php echo $this->_tpl_vars['item']['sell_num']; ?>
</td>                                      
                  <td width="100"><?php echo $this->_tpl_vars['item']['country']; ?>
</td>
                  <td width="100"><?php echo $this->_tpl_vars['item']['mark_price']; ?>
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
                <div class="span6"> 
                    <div class="input-append">
                      <input value="0" type="checkbox"  class="group-checkable list-checkable"  data-set='#product_all .list-checkable' />
                      <input type="hidden" name="act" id='sub_act' value="" />
                      <button type="button" data-id='<?php echo $this->_tpl_vars['item']['id']; ?>
' data-action="2" data-box-size="800|400" class="btn red show_detail mini ">批量调拨</button>
                      <button type="button" style=" margin-left:10px;" data-id='<?php echo $this->_tpl_vars['item']['id']; ?>
' data-action="2" data-box-size="800|400" class="btn red show_detail mini ">推送物流系统</button>
                    </div> 
                </div>
                
                <div class="clear"></div>
                <div class="span6" >
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

var bind_window=function()
{
	
	 App.initFancybox();
	$.fn.modalmanager.defaults.resize = true;
	$.fn.modalmanager.defaults.spinner = '<div class="loading-spinner fade" style="width: 200px; margin-left: -100px;"><img src="/static/ajax-modal-loading.gif" align="middle">&nbsp;<span style="font-weight:300; color: #eee; font-size: 18px; font-family:Open Sans;">&nbsp;Loading...</div>';
	var $modal = $('#ajax-modal');
	$('.show_detail').each(function(index, element) {
              $(this).on('click', function(){
                  var size= $(this).attr('data-box-size').split("|");
                  var action = $(this).attr('data-action');
				  $('body').modalmanager('loading');
				  var id = $(this).attr('data-id');
				  var url=new Array();
				  url[1]='<?php echo ((is_array($_tmp="sproduct/goods_info")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id='+id;
				  if(action==2)
				  {
					   var ids='';
					   var msg_error='';
					   $('#product_all .item_v').each(function(index, element) {
                       		if($(this).attr('checked'))
							{
								var id=$(this).val();
								ids=ids!=''?id:'';
								
								if($("#snum_"+id).val()*1<$('#ls_num_'+id).val()*1)
								{
									msg_error='2';
									$('#ls_num_'+id).css({border:"1px solid red"});
								}
								
								if($("#lock_num_"+id).val()*1>$('#ls_num_'+id).val()*1)
								{
									$('#ls_num_'+id).css({border:"1px solid red"});
									msg_error='2';
								}
							}
							
                    	});
						if(msg_error!='')
						{
							modal_msg('<font color="red">红色部分</font>【调拨异常】,调拨后库存不能大于可用库存,小于待发货库存');
							return '';
						}
						else
						{
							$.post('<?php echo ((is_array($_tmp="sproduct/product_ls_edit_stock")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',$('#form_product').serialize(),function(msg){
								modal_msg(msg);

								setTimeout(function(){
									window.location.reload(true);
								},1000);

							});
							return '';
						}

				  }
				  else if(url[action]!='')
				  {
					  $('body').modalmanager('loading');
					  setTimeout(function(){
						  $.fn.modal.defaults.width  = size[0]+'px';
						  $.fn.modal.defaults.height = size[1]+'px';
						  $modal.load(url[1], '', function(){
							  $modal.modal();
							  //$modal.css('margin-top','0');
						  });
					  }, 200);		
				  }
              });


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

         
		var oTable = $('#product_all').dataTable( {
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
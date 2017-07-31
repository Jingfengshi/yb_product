<?php /* Smarty version 2.6.20, created on 2017-07-11 15:41:51
         compiled from order_list_ls.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'f_get_status', 'order_list_ls.htm', 45, false),array('modifier', 'site_url', 'order_list_ls.htm', 155, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>订单管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">订单列表</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">零售订单</a></li>
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
          <div class="caption"><i class="icon-search"></i>零售订单搜素</div>
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
                    <option <?php if ($_GET['search_page_num'] == '1'): ?>selected="selected"<?php endif; ?>  value="1">15
                    </option>
                    <option <?php if ($_GET['search_page_num'] == '2'): ?>selected="selected"<?php endif; ?>  value="2">30
                    </option>
                    <option <?php if ($_GET['search_page_num'] == '3'): ?>selected="selected"<?php endif; ?>  value="3">50
                    </option>
                  </select>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">订单状态</div>
                </span>
                <div class="span3" style="margin-left:0px;"> <?php $this->assign('ls_status', ((is_array($_tmp=$this->_tpl_vars['item']['status'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'ls_order_status', 1) : f_get_status($_tmp, 'ls_order_status', 1))); ?>
                  <select size="1" id="form_2_select2" name="search_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all"  >所有状态</option>
                    <?php $_from = $this->_tpl_vars['ls_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?> <option <?php if (isset ( $_GET['search_status'] ) && $_GET['search_status'] == $this->_tpl_vars['k'] && $_GET['search_status'] != 'all'): ?>selected = "selected"<?php endif; ?> value = "<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['v']; ?>

                    </option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                </div>
              </div>
              <div class="row-fluid" style="margin-top:20px;"> <span class="span1" style="display:block;">
                <div id="span_label">下单时间</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <div class="controls">
                    <div class="input-append date date-picker" data-date="<?php echo $_GET['search_stime']; ?>
" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                      <input name="search_stime" class="m-wrap m-ctrl-medium date-picker small" type="text" value="<?php echo $_GET['search_stime']; ?>
">
                      <span class="add-on"><i class="icon-calendar"></i></span> </div>
                  </div>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">下单时间</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <div class="controls">
                    <div class="input-append date date-picker" data-date="<?php echo $_GET['search_etime']; ?>
" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                      <input name="search_etime" class="m-wrap m-ctrl-medium date-picker small" type="text" value="<?php echo $_GET['search_etime']; ?>
">
                      <span class="add-on"><i class="icon-calendar"></i></span> </div>
                  </div>
                </div>
              </div>
              <div class="row-fluid" style="margin-top:20px;"> <span class="span1" style="display:block;">
                <div id="span_label">手机号码</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input type="text"  name="search_consignee_mobile"  value="<?php echo $_GET['search_consignee_mobile']; ?>
" class="m-wrap small"/>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">订单号码</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input type="text"  name="search_id" value="<?php echo $_GET['search_id']; ?>
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
            <form action="" method="post" id="form_product_select">
              <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
                <thead>
                  <tr role="heading">
                    <th width="20" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1"><input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#form_product_select .list-checkable'/></th>
                    <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                    <th width="50" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">编号</th>
                    <th width="50"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">状态</th>
                    <th width="80" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">供应UID</th>
                    <th width="80" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">分销商</th>
                    <th width="50" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订单号</th>
                    <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">渠道销售</th>
                    <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">渠道名称</th>
                    <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">平台货值</th>
                    <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">供应货值</th>
                    <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运单重量</th>
                    <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运费</th>
                    <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">姓名</th>
                    <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">手机</th>
                    <th width="300" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">地址</th>
                    <th width="110" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">作废原因</th>
                    <th width="*"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">下单时间</th>
                  </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                <?php if ($this->_tpl_vars['re']['list']): ?>
                <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <tr >
                  <td><input type="checkbox" name="item[]"  value="<?php echo $this->_tpl_vars['item']['id']; ?>
" class="list-checkable"/></td>
                  <td ><button type="button" class="btn mini green" onclick="modal_iframe('order/order_ls_info','查看订单详情','600','400','id=<?php echo $this->_tpl_vars['item']['id']; ?>
')">查看</button></td>
                  <td><?php echo $this->_tpl_vars['item']['id']; ?>
 </td>
                  <td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['status'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'ls_order_status') : f_get_status($_tmp, 'ls_order_status')); ?>
 </td>
                  <td><?php echo $this->_tpl_vars['item']['sp_userid']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['seller']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['order_id']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['payment_money']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['company']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['seller_price']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['product_price']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['logcs_weight']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['logcs_price']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['consignee']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['consignee_mobile']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['consignee_address']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['close_con']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['add_time']; ?>
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
                  <input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#form_product_select .list-checkable' />
                </div>
                <div class="input-append">
                  <button type="button" data-url='<?php echo ((is_array($_tmp="package/package_batches_create")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
' data-action="invalid"  data-box-size="800|500" class="modify_popup btn red">作废订单</button>
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
<div id="sub_close" style="display: none">
  <div id="{id}"> 作废原因：
    <select name="reaseon" class="" >
      <?php $_from = ((is_array($_tmp='')) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'ls_order_close_type', 1) : f_get_status($_tmp, 'ls_order_close_type', 1)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
      <option value="<?php echo $this->_tpl_vars['item']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
      <?php endforeach; endif; unset($_from); ?>
    </select>
  </div>
</div>
<div id="sub_close" style="display: none"> </div>
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


//row-details row-details-close
var initTable1 = function() {
        /* Formating function for row details */
//        function fnFormatDetails ( oTable, nTr )
//        {
//            var aData = oTable.fnGetData( nTr );
//            var sOut = '<table>';
//            sOut += '<tr><td>平台编号:</td><td>'+(aData[1].replace('row-details-close','')).replace('row-details','')+'</td></tr>';
//            sOut += '<tr><td>品牌:</td><td>'+aData[3]+'</td></tr>';
//            sOut += '<tr><td>中文名称:</td><td>'+aData[4]+'</td></tr>';
//            sOut += '<tr><td>规格:</td><td>'+aData[5]+'</td></tr>';
//			sOut += '<tr><td>产地:</td><td>'+aData[6]+'</td></tr>';
//			sOut += '<tr><td>成分:</td><td>'+aData[7]+'</td></tr>';
//			sOut += '<tr><td>用途:</td><td>'+aData[8]+'</td></tr>';
//            sOut += '</table>';
//            return sOut;
//        }

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
			"sScrollX":'2290px',
			//"sScrollY":"2290px",
            // set the initial value
            "iDisplayLength": 10,
			//'sScrollXInner':true,
			//"bSortCellsTop":true,
        });
        
//        $('#product_1').on('click', ' tbody td .row-details', function () {
//            var nTr = $(this).parents('tr')[0];
//            if ( oTable.fnIsOpen(nTr) )
//            {
//                /* This row is already open - close it */
//                $(this).addClass("row-details-close").removeClass("row-details-open");
//                oTable.fnClose( nTr );
//            }
//            else
//            {
//                /* Open this row */
//                $(this).addClass("row-details-open").removeClass("row-details-close");
//                oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
//            }
//        });
    }


function load_ini()
{
    process_order_ls();
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

var process_order_ls = function ()
{
    $('.modify_popup').click(function(){
        var url=$(this).attr('data-url');
        var act=$(this).attr('data-action');
        if(act=='invalid')
        {
            var ids='';
            $('input[type="checkbox"]:checked').each(function(index,element){
                if($(this).val()!='0')
                {
                    ids+=','+$(this).val();
                }
            });

            if(ids=='')
            {
                return;
            }
            var reg = new RegExp("{id}","g");//g,表示全部替换。
            modal_confirm(($('#sub_close').html()).replace(reg,"close_con"),function(){
                var rea=$('#close_con select').val();
                $('body').modalmanager('loading');
                $.post('<?php echo ((is_array($_tmp="order/order_ls_invalid")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',{id:ids,rea:rea},function(msg){
                    try
                    {
                        //alert(msg);
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
                            window.location='';
                            return true;
                        }
                        setTimeout(function(){modal_msg(str.msg)}, 300);
                    }catch(e){
                        $('body').modalmanager('removeLoading');
                        setTimeout(function(){modal_msg('系统异常')}, 300);
                    };
                })
            });
        }

    })
}


</script> 
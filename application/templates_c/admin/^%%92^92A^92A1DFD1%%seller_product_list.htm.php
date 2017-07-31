<?php /* Smarty version 2.6.20, created on 2017-07-11 15:21:36
         compiled from seller_product_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'f_get_status', 'seller_product_list.htm', 81, false),array('modifier', 'site_url', 'seller_product_list.htm', 148, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>分销管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">分销产品管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">订阅产品列表</a></li>
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
          <div class="caption"><i class="icon-search"></i>分销商品搜素</div>
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
                <div id="span_label">商品名称</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input type="text" class="m-wrap small" name="search_cname" value="<?php echo $_GET['search_cname']; ?>
" />
                </div>
              </div>

              <div class="row-fluid" style="margin-top:20px;">
                <span class="span1" style="display:block;">
                <div id="span_label">产品状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option <?php if ($_GET['search_status'] == 'all'): ?>selected="selected"<?php endif; ?> value="all">全部状态</option>

                    <option <?php if ($_GET['search_status'] === '0'): ?>selected="selected"<?php endif; ?> value="0">下架</option>
                    <option <?php if ($_GET['search_status'] == '1'): ?>selected="selected"<?php endif; ?> value="1">上架</option>
                  </select>
                </div>

                <span class="span1" style="display:block;">
                <div id="span_label">条形码</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input type="text" class="m-wrap small" name="search_barcode" value="<?php echo $_GET['search_barcode']; ?>
" />
                </div>
              </div>

              <div class="row-fluid" style="margin-top:20px;">
                <span class="span1" style="display:block;">
                <div id="span_label">仓库号</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                   <input type="text" class="m-wrap small"  name="search_warehouse_id"  value="<?php echo $_GET['search_warehouse_id']; ?>
" />
                </div>
                <span class="span1" style="display:block;">
               		 <div id="span_label">供货状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_is_shop" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <?php $this->assign('is_shop_ar', ((is_array($_tmp='')) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'is_shop', 1) : f_get_status($_tmp, 'is_shop', 1))); ?>
                    <option <?php if ($_GET['search_is_shop'] == 'all'): ?>selected="selected"<?php endif; ?> value="all">全部状态</option>
                    <?php $_from = $this->_tpl_vars['is_shop_ar']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['v']):
?>
                       <option <?php if ($_GET['search_is_shop'] != 'all' && $_GET['search_is_shop'] == $this->_tpl_vars['key'] && isset ( $_GET['search_is_shop'] )): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['v']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
                  </select>
                </div>
                
              </div>


              <div class="row-fluid" style="margin-top:20px;">
                <span class="span1" style="display:block;">
                <div id="span_label">分销商</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_userid" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option  value="all">请选择</option>
                    <?php $_from = $this->_tpl_vars['re']['seller_user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option <?php if ($_GET['search_userid'] == $this->_tpl_vars['item']['id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['company']; ?>
</option>
                   <?php endforeach; endif; unset($_from); ?>
                  </select>
                </div>

                <span class="span1" style="display:block;">
                <div id="span_label">平台编号</div>
                </span>
                <div class="span2" style="margin-left:0px;">
                  <div class="input-append">
                    <input type="text" class="m-wrap small" name="search_id" value="<?php echo $_GET['search_id']; ?>
" />
                    <button class="btn green" type="submit">Search</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div>
        <div>
          <div>
            <form action="" id='product_all' method="post">
              <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
                <thead>
                  <tr role="heading">
                    <th width="20" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1"><input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable'/></th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">状态</th>  
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">供货状态</th> 
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">分销商</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品编号</th>                   
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">平台编码</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">仓库号</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">贸易类型</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">中文名称</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">分销价</th>
                     <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">供应价</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">平台定价</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">已申请库存</th>
                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">税率</th>
                  </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                <?php if ($this->_tpl_vars['re']): ?>
                  <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                    <tr>
                      <td><input type="checkbox" name="item[]"  value="<?php echo $this->_tpl_vars['item']['id']; ?>
" class="list-checkable item_v" /></td>
                      <td width="60"><span onclick="alertWin('审核分销产品 【<?php echo $this->_tpl_vars['item']['id']; ?>
】',800,400,'<?php echo ((is_array($_tmp="seller_product/seller_product_check")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn mini green"><i class="icon-edit"></i>操作</span></td> 
                      <td width="40">
                        <?php if ($this->_tpl_vars['item']['price'] <= 0): ?>未定价审核<?php elseif ($this->_tpl_vars['item']['status'] == 1): ?>
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['status'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'ls_product_status') : f_get_status($_tmp, 'ls_product_status')); ?>
<?php elseif ($this->_tpl_vars['item']['status'] == 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['status'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'ls_product_status') : f_get_status($_tmp, 'ls_product_status')); ?>

                        <?php endif; ?>
                      </td>   
                      <td width="60"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['is_shop'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'is_shop') : f_get_status($_tmp, 'is_shop')); ?>
</td>           
                      <td width="80"><?php echo $this->_tpl_vars['item']['company']; ?>
</td>
                      <td width="60"><?php echo $this->_tpl_vars['item']['id']; ?>
</td>                  
                      <td width="60"><?php echo $this->_tpl_vars['item']['stock_id']; ?>
</td>
                      <td width="60"><?php echo $this->_tpl_vars['item']['warehouse_id']; ?>
</td>
                      <td width="60"><?php if ($this->_tpl_vars['item']['hg_type'] == 1): ?>保税<?php endif; ?> <?php if ($this->_tpl_vars['item']['hg_type'] == 2): ?>直邮<?php endif; ?> <?php if ($this->_tpl_vars['item']['hg_type'] == 3): ?>一般贸易<?php endif; ?></td>
                      <td width="*"><?php echo $this->_tpl_vars['item']['cname']; ?>
</td>
                      <td width="80"><?php echo $this->_tpl_vars['item']['price']; ?>
</td>                  
                      <td width="80"><?php echo $this->_tpl_vars['item']['s_price']; ?>
</td>
                      <td width="80"><?php echo $this->_tpl_vars['item']['ss_price']; ?>
</td>
                      <td width="80"><?php echo $this->_tpl_vars['item']['c_num']; ?>
</td>              
                      <td width="70"><?php echo $this->_tpl_vars['item']['rate']; ?>
</td>
                    </tr>
                  <?php endforeach; endif; unset($_from); ?>
                <?php else: ?>
                  <tr>
                    <td colspan="99">暂时无数据</td>
                  </tr>
                <?php endif; ?>
              </table>
              <div  class="row-fluid">
                <div class="input-append">
                  <input value="0" type="checkbox"  class="group-checkable list-checkable"  data-set='#product_all .list-checkable' />
                </div>
                <div class="input-append">
                  <button type="button"  data-id='#supply_status'  data-action="batch" data-url='<?php echo ((is_array($_tmp='seller_product/product_edit_batch')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
'  class="btn green btn_from_status">批量编辑</button>
                </div>

              </div>
              <div class="row-fluid">
                <div class="span6">
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

//row-details row-details-close
var initTable1 = function() {
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

    $.fn.modal.defaults.width='';
    $.fn.modal.defaults.height='';
    var url=$(this).attr('data-url');
    var action=$(this).attr('data-action');
    if(action=='batch')
    {
	  var ids='0';
	  $('#product_all .item_v').each(function(index, element) {
		  if( $(this).attr('checked'))
             ids+=','+$(this).val();
      });
	  
      if(!ids=='')
      {
        alertWin('批量编辑分销产品',800,200,'<?php echo ((is_array($_tmp="seller_product/product_edit_batch")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?ids='+ids);
      }
    }
    else if( action = 'edit_status')
    {
      $modal=$('#ajax-modal');
      $('body').modalmanager('loading');
      $.post(url+"?status="+$($(this).attr('data-id')).val(),$('#product_all').serialize(),function(msg){
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
          // alert(msg);
          $('body').modalmanager('removeLoading');
          setTimeout(function(){
            $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI('系统异常'),'', function(){
              $modal.modal();
            });
          }, 300);
        };
      });
    }

  });
}

</script> 
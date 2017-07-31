<?php /* Smarty version 2.6.20, created on 2017-07-13 10:39:17
         compiled from spuser_product.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'spuser_product.htm', 181, false),array('modifier', 'get_erp_img_url', 'spuser_product.htm', 185, false),array('modifier', 'check_img_url', 'spuser_product.htm', 188, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>供货订阅管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">供应商管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">供应商品列表</a></li>
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
          <div class="caption"><i class="icon-search"></i>供应商品搜素</div>
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
                <div id="span_label">商品名称</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input type="text" class="m-wrap small" name="search_name" value="<?php echo $_GET['search_name']; ?>
" />
                </div>
              </div>
              <div class="row-fluid" style="margin-top:20px;"> <span class="span1" style="display:block;">
                <div id="span_label">产品状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option <?php if ($_GET['search_status'] == 'all'): ?>selected="selected"<?php endif; ?> value="all">全部状态
                    
                    </option>
                    <option <?php if ($_GET['search_status'] === '0'): ?>selected="selected"<?php endif; ?> value="0">下架
                    
                    </option>
                    <option <?php if ($_GET['search_status'] == '1'): ?>selected="selected"<?php endif; ?> value="1">上架
                    
                    </option>
                    <option <?php if ($_GET['search_status'] === '-1'): ?>selected="selected"<?php endif; ?> value="-1">待审核入库
                    
                    </option>
                    <option <?php if ($_GET['search_status'] === '-2'): ?>selected="selected"<?php endif; ?> value="-2">审核不通过
                    
                    </option>
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
               
                <div id="span_label">供应商</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_userid" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option <?php if ($_GET['search_userid'] == 'all'): ?>selected="selected"<?php endif; ?> value="all">全部供应商
                    
                    </option>
                    <?php $_from = $this->_tpl_vars['re']['sp_user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> <option  value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $_GET['search_userid']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_tpl_vars['item']['company']; ?>

                    </option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">供应编号</div>
                </span>
                <div class="span2" style="margin-left:0px;">
                  <input type="text" class="m-wrap small" name="search_id" value="<?php echo $_GET['search_id']; ?>
" />
                </div>
              </div>
              <div class="row-fluid" style="margin-top:20px;"> <span class="span1" style="display:block;">
                <div id="span_label">平台编号</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <input type="text" class="m-wrap small" name="search_stock_id" value="<?php echo $_GET['search_stock_id']; ?>
" />
                </div>
                
                <span class="span1" style="display:block;">
               		 <div id="span_label">图片状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_pic_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option <?php if ($_GET['search_pic_status'] == 'all'): ?>selected="selected"<?php endif; ?> value="all">全部状态</option>
                    <option value="1" <?php if (is_numeric ( $_GET['search_pic_status'] ) && 1 == $_GET['search_pic_status']): ?>selected="selected"<?php endif; ?> >待审核</option>
                    <option value="2" <?php if (is_numeric ( $_GET['search_pic_status'] ) && 2 == $_GET['search_pic_status']): ?>selected="selected"<?php endif; ?> >已审核</option>
                 	<option value="0" <?php if (is_numeric ( $_GET['search_pic_status'] ) && 0 == $_GET['search_pic_status']): ?>selected="selected"<?php endif; ?> >不通过</option>
                  </select>
                </div>  
                
                
                
             </div>   
              <div class="row-fluid" style="margin-top:20px;">
              

                <span class="span1" style="display:block;">
                <div id="span_label">所属仓库</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_warehouse_id" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option <?php if ($_GET['search_warehouse_id'] == 'all'): ?>selected="selected"<?php endif; ?> value="all">全部仓库
                    
                    </option>
                    <?php $_from = $this->_tpl_vars['res_warehouse']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> <option  value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $_GET['search_warehouse_id']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_tpl_vars['item']['id']; ?>
-<?php echo $this->_tpl_vars['item']['name']; ?>

                    </option>
                    <?php endforeach; endif; unset($_from); ?>
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
            <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
              <thead>
                <tr role="heading">
                  <th width="20"  class="sorting_disabled"  width="20" >
                  <input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable' />
                  </th>
                  <th width="50"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                  <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">上架状态</th>
                  <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">图片状态</th>
                  <th width="120"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">平台库-供应</th>
                  <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">平台编号</th>
                  <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">供应商</th>
                  <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">所属仓库</th>
                  <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">条形码</th>
                   <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">供应价</th>
                    <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">毛重</th>
                  <th width="*"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品名称</th>
                  <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">库存</th>
                 
                  <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">批发锁定</th>
                  <th width="90"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">零售锁定</th>
                 
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
              <?php if ($this->_tpl_vars['re']): ?>
              <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
              <tr>
                <td><input type="checkbox" name="item[]"  value="<?php echo $this->_tpl_vars['item']['id']; ?>
" class="list-checkable" /></td>
                <td><a href="javascript:;" onclick="alertWin('审查',800,400,'<?php echo ((is_array($_tmp="spuser/spuser_product_check")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn mini green">审查</a></td>
                <td><?php if ($this->_tpl_vars['item']['status'] == 1): ?> <span  class="label label-info">上架</span> <?php elseif ($this->_tpl_vars['item']['status'] == 0): ?> <span class="label label-important">下架</span> <?php elseif ($this->_tpl_vars['item']['status'] == -1): ?> <span class="label label-important">待审核入库</span> <?php elseif ($this->_tpl_vars['item']['status'] == -2): ?> <span class="label label-important">审核不通过</span> <?php endif; ?> </td>
                <td><?php if ($this->_tpl_vars['item']['pic_status'] == 0): ?> <span class="label">不通过</span> <?php elseif ($this->_tpl_vars['item']['pic_status'] == 1): ?> <span class="label label-info">待审核</span> <?php elseif ($this->_tpl_vars['item']['pic_status'] == 2): ?> <span class="label label-important">已审核</span> <?php endif; ?> </td>
                <td>
                <a class="fancybox-button" data-rel="fancybox-button" title="<b style='color:red; font-size:18px; ' >平台图片 </b> <?php if ($this->_tpl_vars['item']['stock_id']): ?><?php echo $this->_tpl_vars['item']['stock_id']; ?>
<?php else: ?>未入订阅库<?php endif; ?> " href="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['stock_id'])) ? $this->_run_mod_handler('get_erp_img_url', true, $_tmp) : get_erp_img_url($_tmp)); ?>
"> 
                <img  class="load_img" src="/static/load_img.gif"   data-original='<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['stock_id'])) ? $this->_run_mod_handler('get_erp_img_url', true, $_tmp) : get_erp_img_url($_tmp)); ?>
' width="50" height="50" />
                </a> 
                <a class="fancybox-button" data-rel="fancybox-button" title="<b style='color:red; font-size:18px; ' >商家图片 </b> <?php if ($this->_tpl_vars['item']['stock_id']): ?><?php echo $this->_tpl_vars['item']['stock_id']; ?>
 <?php if ($this->_tpl_vars['item']['pic']): ?> <span onclick=tb_img('<?php echo $this->_tpl_vars['item']['stock_id']; ?>
','<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['pic'])) ? $this->_run_mod_handler('check_img_url', true, $_tmp) : check_img_url($_tmp)); ?>
')  class='btn red mini'>同步</span>  <?php endif; ?> <?php else: ?>未入订阅库<?php endif; ?>   <span onclick=not_pass_img('<?php echo $this->_tpl_vars['item']['id']; ?>
') class='btn red mini'>不通过</span> " href="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['pic'])) ? $this->_run_mod_handler('check_img_url', true, $_tmp) : check_img_url($_tmp)); ?>
"> <img  class="load_img" src="/static/load_img.gif"    data-original="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['pic'])) ? $this->_run_mod_handler('check_img_url', true, $_tmp) : check_img_url($_tmp)); ?>
"  width="50"  height="50" /> </a></td>
                <td><?php if ($this->_tpl_vars['item']['stock_id']): ?><?php echo $this->_tpl_vars['item']['stock_id']; ?>
<?php else: ?>未入订阅库<?php endif; ?></td>
                <td><?php echo $this->_tpl_vars['item']['user_company']['company']; ?>
</td>
                
                <td><?php echo $this->_tpl_vars['item']['ware_house']['name']; ?>
</td>
                <td><?php echo $this->_tpl_vars['item']['barcode']; ?>
</td>
                <td><font color="red"><?php echo $this->_tpl_vars['item']['price']; ?>
</font></td>
                    <td><?php echo $this->_tpl_vars['item']['mz']; ?>
</td>
                <td><?php echo $this->_tpl_vars['item']['name']; ?>
</td>
                <td><?php echo $this->_tpl_vars['item']['c_num']; ?>
</td>
            
                <td><?php echo $this->_tpl_vars['item']['online_num']-$this->_tpl_vars['item']['ls_lock_num']; ?>
</td>
                <td><?php echo $this->_tpl_vars['item']['ls_lock_num']; ?>
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
              <div class="span6" id='sub_submit'>
                <input type="checkbox"  value="0" class="group-checkable list-checkable" data-set="#product_all .list-checkable">
                <input type="button" class="btn red df_sub" data-type="2" value="审核不通过">
                <input type="button" class="btn green df_sub" data-type="1" value="加入订阅库">
              </div>
              <div class="clear"></div>
              <div class="span6">
                <div class="dataTables_paginate paging_bootstrap pagination"> <?php echo $this->_tpl_vars['re']['page']; ?>
 </div>
              </div>
            </div>
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
function tb_img(sid,pic)
{
	modal_confirm('确认同步吗',function(){
		$.post('<?php echo ((is_array($_tmp="spuser/spuser_product")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',{sid:sid,pic:pic,up_pic:1},function(msg){
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
			  window.location.reload(true);
			  return ;
			  modal_msg(str.msg);
			}catch(e){ 
			   modal_msg(msg);
			};
		 });
	});	
} 

function not_pass_img(id)
{
	$.post('<?php echo ((is_array($_tmp="spuser/spuser_product")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',{id:id,not_up_pic:1},function(msg){
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
			  window.location.reload(true);
			  return ;
			  modal_msg(str.msg);
			}catch(e){ 
			   modal_msg(msg);
			};
		 });

}


$('.form_2_select2').select2({
     placeholder: "请选择",
     allowClear: true
});

$('#sub_submit .df_sub').each(function(index, element) {
     var type=$(this).attr('data-type');
});

var bind_window=function()
{
  App.initFancybox();
  $.fn.modalmanager.defaults.resize = true;
  $.fn.modalmanager.defaults.spinner = '<div class="loading-spinner fade" style="width: 200px; margin-left: -100px;"><img src="/static/ajax-modal-loading.gif" align="middle">&nbsp;<span style="font-weight:300; color: #eee; font-size: 18px; font-family:Open Sans;">&nbsp;Loading...</div>';
  var $modal = $('#ajax-modal');
  $('#sub_submit .df_sub').each(function(index, element) {
      var  select_id=$(this).attr('data-type');
      $(this).bind('click', function(){
		$.fn.modal.defaults.width='1600px';
	    $.fn.modal.defaults.height='600px';
		var ids='0';
		$('#product_all .list-checkable').each(function(index, element) {
			  if($(this).attr('checked')&&$(this).val()!=0)
				  ids+=','+$(this).val();
		});  
		
		if(select_id==1)
		{
			var  url='<?php echo ((is_array($_tmp="spuser/spuser_product_check_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
'+"?ids="+ids; //批量加入订阅库
			// create the backdrop and wait for next modal to be triggered
			$('body').modalmanager('loading');
			setTimeout(function(){
				 alertWin('加入订阅库',800,400,url);
			}, 100);
		}
	    else if(select_id==2)
		{
			var  url='<?php echo ((is_array($_tmp="spuser/spuser_product_check_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
'+"?nopass=1&ids="+ids; //审核不通过
			$('body').modalmanager('loading');
			$.post(url,'',function(msg){
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
				  window.parent.location.reload(true);
				  return true;
				}
				
				setTimeout(function(){
				 $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function(){
				  $modal.modal();
				 });
				}, 100);
			  }catch(e){ 
				setTimeout(function(){
				 $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(msg),'', function(){
				  $modal.modal();
				 });
				}, 100);
			  };
			});
			
		}

    });
  });
}
//row-details row-details-close
var initTable= function() {
        /* Formating function for row details */
      
        /*
         * Insert a 'details' column to the table
         */
		$('#product_1').dataTable( {
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
			"sScrollX":'1890px',
			//"sScrollY":"100%",
            // set the initial value
            //"iDisplayLength": 10,
			//'sScrollXInner':true,
			//"bSortCellsTop":true,
        });
        
      
    }


function load_ini()
{
	bind_window(); 
	/* <?php if ($this->_tpl_vars['re']): ?> */
	initTable();
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
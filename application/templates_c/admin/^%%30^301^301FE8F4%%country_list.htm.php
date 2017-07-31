<?php /* Smarty version 2.6.20, created on 2017-07-11 17:50:22
         compiled from country_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'country_list.htm', 120, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>网站管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">公共参数管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">产地管理</a></li>
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
          <div class="caption"><i class="icon-search"></i>产地管理搜素</div>
          <div class="tools"> <a href="javascript:;" class="collapse"></a> </div>
        </div>
        <div class="portlet-body" style="display: block;">
          <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <form action="" method="get" onsubmit="return load_sub();">
              <div class="row-fluid">
                <div class="span5">
                  <span class="span2" style="display:block;">
                  <div id="span_label">每页显示</div>
                  </span>
                  <div class="span5" style="margin-left:0px;">
                    <select size="1" name="search_page_num" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                      <option <?php if ($_GET['search_page_num'] == 'all'): ?>selected="selected"<?php endif; ?> value="all">每页显示</option>
                        <option <?php if ($_GET['search_page_num'] == '1'): ?>selected="selected"<?php endif; ?> value="1">15</option>
                        <option <?php if ($_GET['search_page_num'] == '2'): ?>selected="selected"<?php endif; ?> value="2">30</option>
                        <option <?php if ($_GET['search_page_num'] == '3'): ?>selected="selected"<?php endif; ?> value="3">50</option>
                    </select>
                  </div>

                  <span class="span2" style="display:block;">
                  <div id="span_label" style="margin-right:8px;">产地名称</div>
                  </span>
                  <div class="span2" style="margin-left:0px;">
                    <div class="input-append">
                      <input class="m-wrap small" type="text" name="search_c_name" value="<?php echo $_GET['search_c_name']; ?>
">
                      <button class="btn green" type="submit">Search</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div id='product_all'>
        <form action="" id='form_country_list' method="post">
          <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
            <thead>
              <tr role="heading">
                <th class="sorting_disabled"  width="20" ><input type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable' /></th>
                <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">状态</th>
                <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">产地编码</th>
                <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">产地名称</th>
                <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">英文名称</th>
              </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
            <?php if ($this->_tpl_vars['res_country']): ?>
            <?php $_from = $this->_tpl_vars['res_country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
              <tr>
                <td width="20">
                  <input type="checkbox" name="<?php echo $this->_tpl_vars['item']['c_id']; ?>
"  value="<?php echo $this->_tpl_vars['item']['c_display']; ?>
" class="list-checkable" />
                </td>
                <td width="40">
                  <?php if ($this->_tpl_vars['item']['c_display'] == 0): ?>
                    <span class="label label-important">开启</span>
                  <?php else: ?>
                    <span class="label label-success">关闭</span>
                  <?php endif; ?>
                </td>
                <td width="60"><?php echo $this->_tpl_vars['item']['c_id']; ?>
</td>
                <td width="150"><?php echo $this->_tpl_vars['item']['c_name']; ?>
</td>                  
                <td width="*"><?php echo $this->_tpl_vars['item']['c_enname']; ?>
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
              <input type="checkbox" class="group-checkable list-checkable" data-set="#product_all .list-checkable">
              <input type="button" class="btn green df_submit" data-type="0" value="开启">
              <input type="button" class="btn red df_submit" data-type="1" value="关闭">  
            </div>
            <div class="clear"></div>
            <div class="span6">
              <div class="dataTables_paginate paging_bootstrap pagination"> <?php echo $this->_tpl_vars['re']['page']; ?>
 </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END PAGE CONTENT--> 
</div>
<link href="/static/css/jquery.fancybox.css" rel="stylesheet">
<script src="/static/js/jquery.fancybox.pack.js"></script> 
<script>
var checkchange=function(){
	$('.df_submit').bind('click',function(){
	  $modal=$('#ajax-modal');
      $('body').modalmanager('loading');
	  $.fn.modal.defaults.width='';
	  $.fn.modal.defaults.height='';
	  var type=$(this).attr('data-type');
      $.post('<?php echo ((is_array($_tmp='country/update_country_display')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?type='+type,$('#form_country_list').serialize(),function(msg){
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
          }
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
 

};
var initTable = function() {
        
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
      "sScrollX":'1690px',
      //"sScrollY":"300px",
            // set the initial value
            //"iDisplayLength": 10,
      //'sScrollXInner':true,
      //"bSortCellsTop":true,
        }); 
    }

function load_ini()
{
  checkchange();	
  /* <?php if ($this->_tpl_vars['res_country']): ?> */
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
<?php /* Smarty version 2.6.20, created on 2017-07-11 16:20:12
         compiled from logistics_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'logistics_list.htm', 175, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>供货订阅管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">运费管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">运费模版列表</a></li>
      </ul>
      <!-- END PAGE TITLE & BREADCRUMB--> 
    </div>
  </div>
  <!-- END PAGE HEADER--> 
  <!-- BEGIN PAGE CONTENT-->
  <div class="row-fluid">
    <div class="span12">
      
      <div>
        <div>
          <div><table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
                <thead>
                  <tr role="heading">
                    <th  width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                    <th  width="50" class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">模板ID</th>
                    <th  width="60" class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">状态</th>
                    <th  width="60" class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">UID</th>
                    <th  width="120" class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">供应商</th>
                    <th  width="60"  class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">类型</th>
                    <th  width="60"  class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">仓号</th>
                    <th  width="100"  class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">物流公司</th>
                    <th  width="100"  class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">首重(克)</th>
                    <th  width="100"  class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">运费(元)</th>
                    <th  width="100"  class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">每件加(克)</th>
                    <th  width="100"  class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">增加运费(元)</th>
                    <th  width="*"  class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">可运送区域</th>
                  </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                <?php if ($this->_tpl_vars['re']): ?>
                 <?php $_from = $this->_tpl_vars['re']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?><tr>
                  <th width="100">
                      <?php if ($this->_tpl_vars['item']['status'] == 0): ?>
                      	 <button class="btn mini green shenhe" data-action="pass" data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
" type="button" >通过</button>
                      <?php elseif ($this->_tpl_vars['item']['status'] == 1): ?>
                     	 <button class="btn mini red shenhe"  data-action="nopass"  data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
" type="button" >不通过</button>
                      <?php endif; ?>
                  </th>
                      <td><?php echo $this->_tpl_vars['item']['temp_id']; ?>
</td>
                      <td>
                          <?php if ($this->_tpl_vars['item']['status'] == 0): ?>
                          <span class="label label-default">待审核</span>
                          <?php elseif ($this->_tpl_vars['item']['status'] == 1): ?>
                          <span class="label label-warning">已审核</span>
                          <?php endif; ?>
                      </td>
 				      <td><?php echo $this->_tpl_vars['item']['userid']; ?>
 </td>
                       <td><?php echo $this->_tpl_vars['item']['com']; ?>
</td>
                      <td><font color="<?php if ($this->_tpl_vars['item']['c_type'] == '批发'): ?>red<?php else: ?>blue<?php endif; ?>"><?php echo $this->_tpl_vars['item']['c_type']; ?>
</font></td>
                      <td><?php echo $this->_tpl_vars['item']['warehouse_id']; ?>
</td>
                      <td><?php echo $this->_tpl_vars['item']['company']; ?>
</td>
                      <td><?php echo $this->_tpl_vars['item']['default_num']; ?>
</td>
                      <td><?php echo $this->_tpl_vars['item']['default_price']; ?>
 </td>
                      <td><?php echo $this->_tpl_vars['item']['add_num']; ?>
</td>
                      <td><?php echo $this->_tpl_vars['item']['add_price']; ?>
</td>
                      <td><?php echo $this->_tpl_vars['item']['city_names']; ?>
</td>
                    </tr>
                  <?php endforeach; endif; unset($_from); ?>
                <?php else: ?>
                  <tr>
                    <td colspan="99">暂时无数据</td>
                  </tr>
                <?php endif; ?>
               </tbody> 
              </table>
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

    check_logistics();
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

var check_logistics=function()
{
    $('.shenhe').click(function(){
        var action=$(this).attr('data-action');
        var id=$(this).attr('data-id');
        $('body').modalmanager('loading');
        var url="<?php echo ((is_array($_tmp='logistics/logistics_list')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?act=check&action="+action+"&id="+id;
        $.post(url,'',function(msg){
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
                    window.location.reload(true);
                    return true;
                }
                setTimeout(modal_msg(str.msg),300);
            }catch(e){
                $('body').modalmanager('removeLoading');
                setTimeout(modal_msg('系统异常'),300);
            };
        });
    })
}

</script> 
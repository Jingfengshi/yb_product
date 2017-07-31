<?php /* Smarty version 2.6.20, created on 2017-07-11 16:07:57
         compiled from order_info1.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'f_get_status', 'order_info1.htm', 44, false),array('modifier', 'site_url', 'order_info1.htm', 87, false),)), $this); ?>
<div class="tabbable tabbable-custom" style="">
  <div class="tab-content">
    <div class="container-fluid"> 
      <!-- BEGIN PAGE CONTENT-->
      <div class="portlet-body form">
        <form action="" id="form_order_pro_change" class="form-horizontal" method="post" >
                    <div id='alert-error_1' class="alert alert-error hide">
            <button class="close" data-dismiss="alert"></button>
            <span>提交失败</span> </div>
          <div id='alert-success_1' class="alert alert-success hide">
            <button class="close" data-dismiss="alert"></button>
            <span>提交成功</span> </div>
          <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
            <thead>
              <tr role="heading">
                <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">产品名</th>
                <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">供应商</th>
                <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">销售价</th>
                <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">供应价</th>
                <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">数量</th>
                <?php if ($this->_tpl_vars['re']['status'] == 3 || $this->_tpl_vars['re']['status'] == 4): ?>
                <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">状态</th>
                <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运单号</th>
                <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">发货时间</th>
                <?php endif; ?> </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
            <?php if ($this->_tpl_vars['re']['order_info']): ?>
            <?php $_from = $this->_tpl_vars['re']['order_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <tr >
              <td width="*"><?php echo $this->_tpl_vars['item']['name']; ?>
</td>
              <td width="120"><?php echo $this->_tpl_vars['item']['sp_company']; ?>
</td>
              <td width="120"><?php echo $this->_tpl_vars['item']['price']; ?>
</td>
              <td width="120"><?php echo $this->_tpl_vars['item']['sp_price']; ?>
</td>
              <td width="120"><?php echo $this->_tpl_vars['item']['num']; ?>
 
                <!--<?php if ($this->_tpl_vars['re']['status'] == 1): ?>--> 
                <!--<input type="text" name="<?php echo $this->_tpl_vars['item']['id']; ?>
" value="<?php echo $this->_tpl_vars['item']['num']; ?>
">--> 
                
                <!--<?php else: ?>--> 
                
                <!--<?php endif; ?>--></td>
              <?php if ($this->_tpl_vars['re']['status'] == 3 || $this->_tpl_vars['re']['status'] == 4): ?>
              <td width="120"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['status'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp, 'order_pro_status') : f_get_status($_tmp, 'order_pro_status')); ?>
</td>
              <td width="120"><?php echo $this->_tpl_vars['item']['logcs_num']; ?>
</td>
              <td width="120"><?php echo $this->_tpl_vars['item']['delivery_time']; ?>
</td>
              <?php endif; ?> </tr>
            <?php endforeach; endif; unset($_from); ?>
            <?php else: ?>
            <tr>
              <td colspan="99">暂时无数据</td>
            </tr>
            <?php endif; ?>
            </tbody>
          </table>
          <!--<?php if ($this->_tpl_vars['re']['status'] == 1): ?>--> 
          <!--<div class="form-actions" style="float: right;background: white;border: none;">--> 
          <!--<input type="hidden" name="order_id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
">--> 
          <!--<input type="hidden" name="<?php echo $this->_tpl_vars['csrf']['name']; ?>
" value="<?php echo $this->_tpl_vars['csrf']['hash']; ?>
">--> 
          <!--<button type="button" id='submit_order_pro_change' class="btn red">提交</button>--> 
          <!--</div>--> 
          <!--<?php endif; ?>-->
        </form>
      </div>
      <!-- END FORM--> 
      
    </div>
    <!-- END PAGE CONTENT--> 
  </div>
</div>
<script>
    function load_ini()
    {
        initTable1();
        var error1=$('#alert-error_1');
        var success1=$('#alert-success_1');

        var form1 = $('#form_order_pro_change');
        $("#submit_order_pro_change").click(function(){

            //encodeURI(msg)
            $modal=$('#ajax-modal');
            error1.hide();
            success1.show();
            success1.find('span').html('正在提交...........');
            $('body').modalmanager('loading');
            $.post('<?php echo ((is_array($_tmp="order/order_pro_change")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form1.serialize(),function(msg){
                try
                {
                    //alert(msg);
                    eval("var str="+msg);
                    //操作成功
                    if(str.type==1)
                    {
                        //错误提示
                        error1.show();
                        success1.hide();
                        error1.find('span').html(str.msg);
                    }
                    else if(str.type==2)
                    {
                        //提交成功
                        error1.hide();
                        success1.show();
                        success1.find('span').html('提交成功');
                    }
                    else if(str.type==3)
                    {
                        //刷新主页面
                       window.parent.location.reload(true);
                        return true;
                    }
                    setTimeout(function(){
                        $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function(){
                            $modal.modal();
                        });
                    }, 300);
                }catch(e){
                    alert(msg);
                    $('body').modalmanager('removeLoading');
                    success1.hide();
                    error1.find('span').html('系统异常');
                    error1.show();
                };
            });

        });

    }

    var initTable1 = function() {
        /*
         * Insert a 'details' column to the table
         */
        var oTable = $('#product_1').dataTable({
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [0]}
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
            "bSort": false,
            "bInfo": false,
            "bPaginate": false,
            "bAutoWidth": true,
            "bStateSave": false,
           // "sScrollX": '2100px',
            //"sScrollY":"300px",
            // set the initial value
            "iDisplayLength": 10,
            //'sScrollXInner':true,
            //"bSortCellsTop":true,
        });
    }
</script>
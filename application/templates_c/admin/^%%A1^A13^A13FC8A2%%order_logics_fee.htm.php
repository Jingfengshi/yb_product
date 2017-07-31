<?php /* Smarty version 2.6.20, created on 2017-07-11 16:07:57
         compiled from order_logics_fee.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'order_logics_fee.htm', 91, false),)), $this); ?>
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
                            <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">编号</th>

                            <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">供应总价</th>
                            <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">分销总价</th>
                            <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运费</th>
                            <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运单重量(克)</th>
                            <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">供应商</th>

                        </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        <?php if ($this->_tpl_vars['re']['sp_order']): ?>
                        <?php $_from = $this->_tpl_vars['re']['sp_order']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                        <tr >

                            <td width="30"><?php echo $this->_tpl_vars['item']['id']; ?>
</td>

                            <td width="60"><?php echo $this->_tpl_vars['item']['sp_total']; ?>
</td>
                            <td width="60"><?php echo $this->_tpl_vars['item']['seller_total']; ?>
</td>
                            <td width="80">
                                <?php if (( $this->_tpl_vars['order_status']['status'] == 1 || $this->_tpl_vars['order_status']['status'] == 2 ) && $this->_tpl_vars['order_status']['payment_status'] == 0): ?>
                                <input type="text" name="logcs_price|<?php echo $this->_tpl_vars['item']['id']; ?>
" value="<?php echo $this->_tpl_vars['item']['logcs_price']; ?>
">
                                <?php else: ?>
                                <?php echo $this->_tpl_vars['item']['logcs_price']; ?>

                                <?php endif; ?>
                            </td>
                            <td width="100">
                                <?php echo $this->_tpl_vars['item']['logcs_total_weight']; ?>

                                <!--<input type="text" name="logcs_total_weight|<?php echo $this->_tpl_vars['item']['id']; ?>
" value="<?php echo $this->_tpl_vars['item']['logcs_total_weight']; ?>
">-->

                            </td>
                            <td width="*"><?php echo $this->_tpl_vars['item']['sp_company']; ?>
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
                    <div class="form-actions" style="float: right;background: white;border: none;">
                        <input type="hidden" name="order_id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
">
                        <input type="hidden" name="<?php echo $this->_tpl_vars['csrf']['name']; ?>
" value="<?php echo $this->_tpl_vars['csrf']['hash']; ?>
">
                        <button type="button" id='submit_order_pro_change' class="btn red">提交</button>
                    </div>
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
		<?php if ($this->_tpl_vars['re']['sp_order']): ?> 
        initTable1();
		<?php endif; ?>
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
            $.post('<?php echo ((is_array($_tmp="order/order_logics_fee")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
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
<?php /* Smarty version 2.6.20, created on 2017-07-17 14:50:02
         compiled from cart_index.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'cart_index.htm', 168, false),)), $this); ?>
<div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <h3 class="page-title"> <small> </small> </h3>
            <ul class="breadcrumb">
                <li> <i class="icon-home"></i> <a>我的商品</a> <span class="icon-angle-right"></span> </li>
                <li> <a href="#">购物车</a> <span class="icon-angle-right"></span> </li>
                <li><a href="#">购物车列表</a></li>
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
                    <div>
                        <form action="" method="post" id="product_all">
                            <table class="table table-striped table-bordered table-hover dataTable"  >
                                <thead>
                                <tr role="heading">
                                    <th width="20" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1"><input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable'/></th>
                                    <th width="120" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                                    <th width="120"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品编号</th>
                                    <th width="120"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">仓库号</th>
                                    <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">拿货价格</th>
                                    <th width="400" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订购数</th>
                                    <th width="*"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">中文名称</th>

                                </tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                <?php if ($this->_tpl_vars['re']['cart_list']): ?>


                                <?php $_from = $this->_tpl_vars['re']['warehouse']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
                                    <tr class="warehouse_<?php echo $this->_tpl_vars['i']['warehouse_id']; ?>
">
                                        <td colspan="99">仓库号:<?php echo $this->_tpl_vars['i']['warehouse_id']; ?>
</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['re']['cart_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                    <?php if ($this->_tpl_vars['i']['warehouse_id'] == $this->_tpl_vars['item']['warehouse_id']): ?>
                                    <tr class="goods_<?php echo $this->_tpl_vars['i']['warehouse_id']; ?>
" >
                                        <td><input type="checkbox" name="item[]"  value="<?php echo $this->_tpl_vars['item']['id']; ?>
" class="list-checkable"  <?php if ($this->_tpl_vars['item']['status'] == 0): ?> disabled="disabled"<?php endif; ?>/></td>
                                        <td >
                                            <button type="button" data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
"  class="btn mini red cart_del">删除</button>
                                        </td>
                                        <td>
                                            <?php echo $this->_tpl_vars['item']['id']; ?>

                                        </td>
                                        <td>
                                            <?php echo $this->_tpl_vars['item']['warehouse_id']; ?>

                                        </td>

                                        <td>
                                            <?php echo $this->_tpl_vars['item']['price']; ?>

                                        </td>
                                        <td>
                                            <button type="button" class="btn mini green add  <?php if ($this->_tpl_vars['item']['status'] == 0): ?>disabled<?php endif; ?>"><font size="4" >+</font></button>  <div  class="cart_num" style="display: inline-block;width: 40px;margin: 0 20px 0 20px;text-align: center;" data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
" data-max-num="<?php echo $this->_tpl_vars['item']['num']-$this->_tpl_vars['item']['online_num']; ?>
" >
                                            <input   <?php if ($this->_tpl_vars['item']['status'] == 0): ?> disabled="disabled"<?php endif; ?> type="text" value="<?php echo $this->_tpl_vars['item']['c_num']; ?>
" style="width: 40px;"> </div>  <button type="button" class="btn mini green jian <?php if ($this->_tpl_vars['item']['status'] == 0): ?>disabled<?php endif; ?>"><font  size="4" >-</font></button>
                                            <style>
                                                .pfont{
                                                    color:red;
                                                }
                                            </style>
                                            <div style="display: inline-block;margin-left: 20px;">可用库存：<p style="display: inline-block"><?php echo $this->_tpl_vars['item']['num']-$this->_tpl_vars['item']['online_num']; ?>
</p></div>
                                        </td>
                                        <td>
                                            <?php echo $this->_tpl_vars['item']['name']; ?>

                                        </td>

                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; endif; unset($_from); ?>
                                <?php endforeach; endif; unset($_from); ?>

                                <?php else: ?>
                                <tr>
                                    <td colspan="99">暂时无数据</td>
                                </tr>
                                <?php endif; ?>
                            </table>
                            <div class="span3" style="margin-left: 0px">
                                <input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable' />
                                <button class="btn red show_detail" data-box-size="800|250" data-action="order_done"  type="button" >下一步</button>
                            </div>
                            <div class="row-fluid">
                                <div class="span6"> </div>
                                <div class="clear"></div>

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
<link rel="stylesheet" type="text/css" href="/static/css/datepicker.css">
<script type="text/javascript" src="/static/js/bootstrap-datepicker.js"></script>
<script>
    function load_ini()
    {
        check_num();
        cart_change();
        cart_del();
        input_blur();
        bind_window();
        /* <?php if ($this->_tpl_vars['re']['cart_list']): ?> */
        initTable1();
        proj_table_upload();


        /* <?php endif; ?> */

        jQuery('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    if(!$(this).attr('disabled'))
                    {
                        $(this).attr("checked", true);
                    }

                } else {
                    if(!$(this).attr('disabled'))
                    {
                        $(this).attr("checked", false);
                    }

                }
            });
            jQuery.uniform.update(set);
        });


    }
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

    var proj_table_upload = function()
    {
        $('.table_upload').click(function()
        {
            var temp_id = $(this).attr('data-id');
            window.location.href = "<?php echo ((is_array($_tmp='order/order_table_upload')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?temp_id="+temp_id;
        });
    }
    var cart_change = function()
    {
        $('.add').click(function(){
            var max_num=parseInt($(this).next().attr('data-max-num'));

            var num=parseInt($(this).next().find('input').val());
            var id =$(this).next().attr('data-id');
            if(num>=max_num){
                new_num=max_num;
            }else{
                new_num=num+1;
            }
            $(this).next().find('input').val(new_num);
           change_num('add',new_num,id);
        })
        $('.jian').click(function(){
            var max_num=parseInt($(this).prev().attr('data-max-num'));
            var num=parseInt($(this).prev().find('input').val());
            var id =$(this).prev().attr('data-id');
            if(num-1<=max_num)
            {
                $(this).nextUntil('p').find('p').removeClass('pfont').next('div').remove()
                $(this).parents('tr').find('div.checker span input').attr('disabled',false);
            }
            if(num-1<=0)
            {
                $(this).parents('tr').remove();
                var warehouse_id=$(this).parents('tr').attr('class').substr(6);
                warehouse_has_goods(warehouse_id);

            }
            $(this).prev().find('input').val(num-1);
            change_num('jian',num-1,id);

        });
    }
    var change_num =function(type,num,id)
    {
        if(type=='add')
        {
            new_num= num;

        }
        if(type=='jian')
        {
           new_num= num;
        }
        $.post('<?php echo ((is_array($_tmp="order/cart_change")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',{id:id,num:new_num},function(msg){

        })
    }

    var cart_del=function()
    {
        $('.cart_del').click(function(){
            var warehouse_id=$(this).parents('tr').attr('class').substr(6);
            $(this).parents('tr').remove();
            warehouse_has_goods(warehouse_id);
            var id = $(this).attr('data-id');
            $.post('<?php echo ((is_array($_tmp="order/cart_del")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',{id:id},function(){

            });
        })
    }

    var warehouse_has_goods=function(warhouse_id)
    {

        var goods=$('tr.goods_'+warhouse_id);
        if(goods.length<=0)
        {
            $('tr.warehouse_'+warhouse_id).remove();
        }
    }

    var bind_window=function()
    {
        App.initFancybox();
        $.fn.modalmanager.defaults.resize = true;
        $.fn.modalmanager.defaults.spinner = '<div class="loading-spinner fade" style="width: 200px; margin-left: -100px;"><img src="/static/ajax-modal-loading.gif" align="middle">&nbsp;<span style="font-weight:300; color: #eee; font-size: 18px; font-family:Open Sans;">&nbsp;Loading...</div>';
        var $modal = $('#ajax-modal');

        $('.show_detail').each(function(index, element) {

            $(this).on('click', function(){
                var  size     =  $(this).attr('data-box-size').split("|");
                var  action   =  $(this).attr('data-action');
                if(action=='order_done')
                {
                    if($('#product_all').serialize()=='')
                    {
                        return ;
                    }
                    // create the backdrop and wait for next modal to be triggered
					$('#product_all').submit();  
                }

            });


        });
    }
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
            "sScrollX":'100%',
            //"sScrollY":"1690px",
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

    var check_num=function()
    {

        var tr_set=$('.cart_num');
        for(var i=0;i<tr_set.length;i++)
        {
           var  num=$(tr_set[i]).nextUntil('p').find('p').text();
           var  num1=$(tr_set[i]).find('input').val();
           if(parseInt(num1)>parseInt(num))
           {
               $(tr_set[i]).nextUntil('p').find('p').addClass('pfont').after("<div style='display:inline-block;color: red;'>　库存不足</div>");
               $(tr_set[i]).parents('tr').find('div.checker span input').attr('disabled','disabled');
           }
        }

    }

    var input_blur=function()
    {
        $('.cart_num input').on('change',function(){
            var max_num=parseInt($(this).parent().attr('data-max-num'));
            var num_input=$(this).val().replace(/\D|^0/g,'1');
            var num = parseInt(num_input);
            if(num<=0){
                num=1
                $(this).val(num);
            }
            if(num>=max_num){
                num=max_num;
                $(this).val(num);
            }
            if(num<=max_num)
            {
                $(this).parent().nextUntil('p').find('p').removeClass('pfont').next('div').remove()
                $(this).parents('tr').find('div.checker span input').attr('disabled',false);
            }
            var id =$(this).parent().attr('data-id');
            $.post('<?php echo ((is_array($_tmp="order/cart_change")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',{id:id,num:num},function(msg){

            })
        })
    }




</script>
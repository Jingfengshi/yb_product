<?php /* Smarty version 2.6.20, created on 2017-07-11 16:18:48
         compiled from delivery_address.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'delivery_address.htm', 123, false),)), $this); ?>
<div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <h3 class="page-title"> <small> </small> </h3>
            <ul class="breadcrumb">
                <li> <i class="icon-home"></i> <a>首页</a> <span class="icon-angle-right"></span> </li>
                <li> <a href="#">订单管理</a> <span class="icon-angle-right"></span> </li>
                <li><a href="#">我的收货地址</a></li>
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
                        <form action="" method="post">
                            <button class="btn red" type="button" onclick="modal_iframe('order/delivery_address','新增收货地址','800','500','act=add_delivery')">新增收货地址</button>
                            <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
                                <thead>
                                <tr role="heading">
                                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">收货人</th>
                                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">手机</th>
                                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">邮编</th>
                                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">省市县区</th>
                                    <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">详细地址</th>

                                </tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                <?php if ($this->_tpl_vars['re']['list']): ?>
                                <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <tr >
                                    <td width="300">
                                        <button type="button" data-action="delete" data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
"  class="btn mini red process">删除</button>
                                        <button type="button" onclick="modal_iframe('order/delivery_address','编辑收货地址','800','500','act=edit&id=<?php echo $this->_tpl_vars['item']['id']; ?>
')"  class="btn mini green ">编辑</button>
                                        <?php if ($this->_tpl_vars['item']['default'] == 1): ?>
                                            <button type="button" class="btn mini blue">默认收货地址</button>
                                        <?php else: ?>
                                            <button type="button"  data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
" data-action="setting_default" class="btn mini yellow process">设置为默认收货地址</button>
                                        <?php endif; ?>
                                    </td>
                                    <td width="80"><?php echo $this->_tpl_vars['item']['name']; ?>
</td>
                                    <td width="120"><?php echo $this->_tpl_vars['item']['mobile']; ?>
</td>
                                    <td width="120"><?php echo $this->_tpl_vars['item']['zip']; ?>
</td>
                                    <td width="200"><?php echo $this->_tpl_vars['item']['area']; ?>
</td>
                                    <td width="*"><?php echo $this->_tpl_vars['item']['address']; ?>
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
                                <div class="span6"> </div>
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
    var bind_window=function()
    {
        App.initFancybox();
        $.fn.modalmanager.defaults.resize = true;
        $.fn.modalmanager.defaults.spinner = '<div class="loading-spinner fade" style="width: 200px; margin-left: -100px;"><img src="/static/ajax-modal-loading.gif" align="middle">&nbsp;<span style="font-weight:300; color: #eee; font-size: 18px; font-family:Open Sans;">&nbsp;Loading...</div>';
        var $modal = $('#ajax-modal');
        $('#product_1 .process').each(function(index, element) {
            var  select_id=$(this).attr('data-id');
            var  action = $(this).attr('data-action');
            $(this).on('click',function(){
            if(action=='delete')
            {
                var tips='确定要删除该收货地址吗？删除后将无法找回';
            }
            else if(action=='setting_default')
            {
                var tips='确定要将该地址设为默认收货地址吗？'
            }

            modal_confirm(tips,function(){
                    $('body').modalmanager('loading');
                    $.post("<?php echo ((is_array($_tmp='order/delivery_address')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?act="+action+"&id="+ select_id, '', function(msg){
                        try
                        {
                           // alert(msg)
                            eval("var str="+msg);
                            //操作成功
                            if(str.type==1)
                            {

                            }
                            else if(str.type==2)
                            {
                                window.location='';
                            }
                            else if(str.type==3)
                            {
                                //刷新主页面
                                window.location.reload(true);
                                return true;
                            }

                            setTimeout(function(){
                                $modal.load('<?php echo ((is_array($_tmp="seller_index/seller_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function(){
                                    $modal.modal();
                                });
                            }, 300);
                        }catch(e){
                            // alert(msg);
                            $('body').modalmanager('removeLoading');
                            setTimeout(function(){
                                $modal.load('<?php echo ((is_array($_tmp="seller_index/seller_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function(){
                                    $modal.modal();
                                });
                            }, 300);
                        };
                    });

                })
            })




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

</script>
<?php /* Smarty version 2.6.20, created on 2017-07-11 15:10:00
         compiled from logistics_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'logistics_list.htm', 236, false),)), $this); ?>
<div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <h3 class="page-title"> <small> </small> </h3>
            <ul class="breadcrumb">
                <li> <i class="icon-home"></i> <a>首页</a> <span class="icon-angle-right"></span> </li>
                <li> <a href="#">运费模板</a> <span class="icon-angle-right"></span> </li>
                <li><a href="#">运费模板</a></li>
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
                            <div class="row-fluid">
                                  <span class="span1" style="display:block;">
                                    <div id="span_label">仓库名称</div>
                                  </span>
                                <div class="span3" style="margin-left:0px;">
                                    <select size="1" id="form_2_select2"  name="warehouse" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                                        <option value="all"  >请选择仓库</option>
                                        <?php $_from = $this->_tpl_vars['warehouse']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                                        <option  value = "<?php echo $this->_tpl_vars['v']['id']; ?>
" <?php if ($this->_tpl_vars['v']['id'] == $this->_tpl_vars['warehouse_con']['id']): ?>selected="selected"<?php endif; ?>  ><?php echo $this->_tpl_vars['v']['id']; ?>
--<?php echo $this->_tpl_vars['v']['name']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                    <button class="btn green" type="submit">Search</button>
                                </div>
                            </div>
                            <div class="row-fluid" style="margin-top: 20px;">
                            <?php if (! empty ( $this->_tpl_vars['warehouse_con'] )): ?>
                            <table class="table table-hover table-bordered" >
                                <tbody>
                                <!-- DATAITEM -start-->
                                <tr class="rows_title" style="background:#EEE;">
                                    <th colspan="5" class="tdleft">&nbsp;&nbsp;&nbsp;批发运费模板--仓库号:<?php echo $this->_tpl_vars['warehouse_con']['id']; ?>
 | 仓库:<?php echo $this->_tpl_vars['warehouse_con']['name']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="HassFree"><span class="HassFree"></span></span></th>
                                    <th colspan="2" style="text-align:right;padding-right:10px">

                                        <button type="button" class="btn mini green" onclick="modal_iframe('logistics/logistics_add','仓库:<?php echo $this->_tpl_vars['warehouse_con']['name']; ?>
-批发-运费','800','600','act=add&temp_id=<?php echo $this->_tpl_vars['warehouse_con']['logistics_temp_id']; ?>
')">新增</button>

                                        <!--<a class="btn btn-info btn-xs" href="EditShippingTemplate.aspx?TemplateId=6">修改</a>　-->

                                        <!--<input type="submit" name="ctl00$ContentPlaceHolder1$ListTemplates$ctl00$lkDelete" value="删除" onclick="return HiConform('<strong>确定要删除选择的模板吗？</strong><p>删除后不可恢复！</p>',this);" id="ctl00_ContentPlaceHolder1_ListTemplates_ctl00_lkDelete" class="btn btn-danger btn-xs">-->
                                    </th>
                                </tr>

                                <tr>

                                    <th  width="*">运送区域</th>
                                    <th width="100">物流公司</th>
                                    <th width="100">首件(克)</th>
                                    <th width="100">运费(元)</th>
                                    <th width="100">每增加(克)</th>
                                    <th width="100">增加运费(元)</th>
                                    <th width="200">操作</th>
                                </tr>
                                <?php $_from = $this->_tpl_vars['re']['logistics_retail_show']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <tr>
                                    <td class="Regions" data-trigger="focus" data-toggle="popover" data-container="body" data-placement="bottom" title="地址详情" data-content=""><?php echo $this->_tpl_vars['item']['city_names']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['company']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['default_num']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['default_price']; ?>
元</td>
                                    <td><?php echo $this->_tpl_vars['item']['add_num']; ?>
</td>
                                    <td>
                                        <?php echo $this->_tpl_vars['item']['add_price']; ?>
元

                                    </td>
                                    
                                    <td>
                                        <button type="button" style="float:right;" onclick="modal_iframe('logistics/logistics_add','仓库:<?php echo $this->_tpl_vars['warehouse_con']['id']; ?>
-零售-修改运费','800','600','act=edit&id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn mini yellow process">修改</button>
                                    	 <?php if ($this->_tpl_vars['item']['status'] == 0): ?>
                                        <button type="button" style="float:right;margin-right: 10px" data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
"  data-action="del" class="btn mini red process">删除</button>
                                        <span style="float:right;margin-right: 10px;" class="label label-default">待审核</span>
                                        <?php elseif ($this->_tpl_vars['item']['status'] == 1): ?>
                                        <span style="float:right;margin-right: 10px;" class="label label-success">已审核</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; endif; unset($_from); ?>


                                <tr class="rows_title" style="background:#EEE;">
                                    <th colspan="5" class="tdleft">&nbsp;&nbsp;&nbsp;零售运费模板--仓库号: <?php echo $this->_tpl_vars['warehouse_con']['id']; ?>
 | 仓库:<?php echo $this->_tpl_vars['warehouse_con']['name']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="HassFree"><span class="HassFree"></span></span></th>
                                    <th colspan="2" style="text-align:right;padding-right:10px">
                                        <button type="button" class="btn mini green" onclick="modal_iframe('logistics/logistics_add','仓库号:<?php echo $this->_tpl_vars['warehouse_con']['id']; ?>
-零售-新建运费','800','600','act=add&temp_id=<?php echo $this->_tpl_vars['warehouse_con']['logistics_temp_id_ls']; ?>
')">新增</button>
                                        <!--<a class="btn btn-info btn-xs" href="EditShippingTemplate.aspx?TemplateId=1">修改</a>　-->

                                        <!--<input type="submit" name="ctl00$ContentPlaceHolder1$ListTemplates$ctl04$lkDelete" value="删除" onclick="return HiConform('<strong>确定要删除选择的模板吗？</strong><p>删除后不可恢复！</p>',this);" id="ctl00_ContentPlaceHolder1_ListTemplates_ctl04_lkDelete" class="btn btn-danger btn-xs">-->
                                    </th>
                                </tr>

                                <tr>

                                    <th >运送区域</th>
                                    <th>物流公司</th>
                                    <th>首件(克)</th>
                                    <th >运费(元)</th>
                                    <th >每增加(克)</th>
                                    <th >增加运费(元)</th>
                                    <th>操作</th>
                                </tr>
                                <?php $_from = $this->_tpl_vars['re']['logistics_wholesale_show']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <tr>
                                    <td class="Regions" data-trigger="focus" data-toggle="popover" data-container="body" data-placement="bottom" title="地址详情" data-content=""><?php echo $this->_tpl_vars['item']['city_names']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['company']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['default_num']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['default_price']; ?>
元</td>
                                    <td><?php echo $this->_tpl_vars['item']['add_num']; ?>
</td>
                                    <td>
                                        <?php echo $this->_tpl_vars['item']['add_price']; ?>
元
                                       
                                    </td>
                                    <td>
                                        <button type="button" style="float:right;" onclick="modal_iframe('logistics/logistics_add','仓库:<?php echo $this->_tpl_vars['warehouse_con']['id']; ?>
-批发-修改运费','800','600','act=edit&id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn mini yellow process">修改</button>
                                        <?php if ($this->_tpl_vars['item']['status'] == 0): ?>

                                        <button type="button" style="float:right;margin-right: 10px" data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
"  data-action="del" class="btn mini red process">删除</button>
                                        <span style="float:right;margin-right: 10px;" class="label label-default">待审核</span>
                                        <?php elseif ($this->_tpl_vars['item']['status'] == 1): ?>
                                        <span style="float:right;margin-right: 10px;" class="label label-success">已审核</span>
                                        <?php endif; ?></td>
                                </tr>
                                <?php endforeach; endif; unset($_from); ?>


                                <!-- DATAITEM -end-->

                                </tbody>
                            </table>
                            <?php endif; ?>
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
        add_logistics_temp();

        process_logistics_temp_con();
        /* <?php if ($this->_tpl_vars['re']['list']): ?> */
        initTable1();
        /* <?php endif; ?> */

    }

    /**
     * 新建运费模板（零售或批发）
     */
    var add_logistics_temp=function()
    {
        $('.add_temp').click(function()
        {
            var act=$(this).attr('data-action');
            if(act=='wholesale')
            {
                var url="<?php echo ((is_array($_tmp='logistics/logistics_add')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?act=new_add&action="+act;
            }else if(act=='retail')
            {
                var url="<?php echo ((is_array($_tmp='logistics/logistics_add')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?act=new_add&action="+act;
            }
            post_ajax(url);
        })
    }

    /**
     * 删除运费内容
     * @param url
     */
    var process_logistics_temp_con=function()
    {
        $('.process').click(function(){
            var act=$(this).attr('data-action');
            var id=$(this).attr('data-id');
            if(act=='del')
            {
                var url="<?php echo ((is_array($_tmp='logistics/logistics_add')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?act="+act+"&id="+id;
                post_ajax(url);
            }

        })
    }

    var post_ajax=function(url)
    {
        $('body').modalmanager('loading');
        $.post(url,{},function(msg){
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
                    window.location.reload();
                    return true;
                }
                setTimeout(modal_msg(str.msg),300);
            }catch(e){
                $('body').modalmanager('removeLoading');
                setTimeout(modal_msg('系统异常'),300);
            };
        });
    }





</script>
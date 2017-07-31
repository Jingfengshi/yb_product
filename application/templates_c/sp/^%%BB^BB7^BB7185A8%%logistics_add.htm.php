<?php /* Smarty version 2.6.20, created on 2017-07-11 16:17:58
         compiled from logistics_add.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'logistics_add.htm', 172, false),)), $this); ?>
<div class="container-fluid">

    <!-- BEGIN PAGE HEADER-->

    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title"> <small> </small> </h3>
            <ul class="breadcrumb">
                <li> <i class="icon-home"></i> <a>运费模板</a> <span class="icon-angle-right"></span> </li>
                <li> <a href="#">运费模板</a> <span class="icon-angle-right"></span> </li>
                <li><a href="#"><?php if (empty ( $this->_tpl_vars['de'] )): ?>添加模板<?php else: ?>修改模板<?php endif; ?></a></li>
            </ul>
        </div>
    </div>
    <!-- END PAGE HEADER-->

    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-reorder"></i><?php if (empty ( $this->_tpl_vars['de'] )): ?>添加模板<?php else: ?>修改模板<?php endif; ?></div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action=""  id='admin_logistics_add' class="form-horizontal" method="post" >
                        <div id='alert-error_1' class="alert alert-error hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交失败</span></div>
                        <div id='alert-success_1' class="alert alert-success hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交成功</span></div>
                        <div class="control-group">
                            <label class="control-label">物流公司<span class="required">*</span></label>
                            <div class="controls ">
                                <select name="company" class="span6 m-wrap">
                                    <option value='all'>请选择</option>
                                    <?php $_from = $this->_tpl_vars['re']['logistics_com']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <option value="<?php echo $this->_tpl_vars['item']['company']; ?>
" <?php if ($this->_tpl_vars['de']['company'] == $this->_tpl_vars['item']['company']): ?>selected = "selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['company']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">首重（克）<span class="required">*</span></label>
                            <div class="controls">
                                <input type="text" name="default_num" value="<?php echo $this->_tpl_vars['de']['default_num']; ?>
"  class="span6 m-wrap"/>

                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">首重费(元)<span class="required">*</span></label>
                            <div class="controls">
                                <input type="text" name="default_price" value="<?php echo $this->_tpl_vars['de']['default_price']; ?>
"  class="span6 m-wrap"/>

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">续重（克）<span class="required">*</span></label>
                            <div class="controls">
                                <input type="text" name="add_num" value="<?php echo $this->_tpl_vars['de']['add_num']; ?>
"  class="span6 m-wrap"/>

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">续重费(元)<span class="required">*</span></label>
                            <div class="controls">
                                <input type="text" name="add_price" value="<?php echo $this->_tpl_vars['de']['add_price']; ?>
"  class="span6 m-wrap"/>
                            </div>
                        </div>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th align="center">地区</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>
                                <?php $_from = $this->_tpl_vars['re']['district']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <?php if (! in_array ( $this->_tpl_vars['item']['id'] , $this->_tpl_vars['re']['exists_district'] )): ?>
                                        <span class="span1" style="min-width: 150px; margin-left: 15px;">
                                             <label class="checkbox" >
                                                 <input type="checkbox" name="district_id[]"   <?php if (! empty ( $this->_tpl_vars['cids'] ) && in_array ( $this->_tpl_vars['item']['id'] , $this->_tpl_vars['cids'] )): ?>checked="checked"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['id']; ?>
|<?php echo $this->_tpl_vars['item']['name']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>

                                             </label>
                                        </span>
                                    <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                        <div class="form-actions">
                            <?php if (! empty ( $this->_tpl_vars['de'] )): ?>
                            <input type="hidden" name="id"  value="<?php echo $this->_tpl_vars['de']['id']; ?>
" />
                            <input type="hidden" name="temp_id" value="<?php echo $this->_tpl_vars['de']['temp_id']; ?>
">
                            <?php endif; ?>
                            <?php if (! empty ( $this->_tpl_vars['re']['temp_id'] )): ?>
                            <input type="hidden" name="temp_id" value="<?php echo $this->_tpl_vars['re']['temp_id']; ?>
">
                            <?php endif; ?>
                            <button type="button"  id='submit_logistics_add' class="btn green">提交</button>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
    <!-- END PAGE CONTENT-->
</div>

<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
<script>
    var initTable1 = function() {
        /* Formating function for row details */
        /*
         * Insert a 'details' column to the table
         */
        var oTable = $('#product_2').dataTable( {
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
            "sScrollY":"300px",
            // set the initial value
            "iDisplayLength": 10,
            //'sScrollXInner':true,
            //"bSortCellsTop":true,
        });
    }

    /**
     * 添加运费内容
     */
    var add_logistics_con=function()
    {
        $('#submit_logistics_add').click(function(){
            var form=$('#admin_logistics_add');
            $('body').modalmanager('loading');
            var url="<?php echo ((is_array($_tmp='logistics/logistics_add')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?act=do_add";
            $.post(url,form.serialize(),function(msg){
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
                        window.location='';
                    }
                    else if(str.type==3)
                    {
                        //刷新主页面
                        window.parent.location.reload(true);
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



    function load_ini()
    {

        initTable1();
        add_logistics_con();
    }


</script>
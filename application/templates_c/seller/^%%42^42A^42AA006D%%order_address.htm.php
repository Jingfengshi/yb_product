<?php /* Smarty version 2.6.20, created on 2017-07-11 16:36:40
         compiled from order_address.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'order_address.htm', 64, false),)), $this); ?>
<div class="tabbable tabbable-custom" style="">
    <div class="tab-content">
        <div class="container-fluid">
            <form action="" id="product_all">
            <!-- BEGIN PAGE CONTENT-->
            <div class="portlet-body form">

                <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
                    <th style="background-color: #eee;" >地址</th>
                    <th colspan="6">收货人:<?php echo $this->_tpl_vars['re']['address']['consignee']; ?>
|手机:<?php echo $this->_tpl_vars['re']['address']['consignee_mobile']; ?>
|收货地址:<?php echo $this->_tpl_vars['re']['address']['consignee_address']; ?>
</th>
                    <tr role="heading">
                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">选择</th>
                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">收货人</th>
                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">手机</th>
                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">邮编</th>
                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">省市县区</th>
                        <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">详细地址</th>
                    </tr>
                    <?php if (! empty ( $this->_tpl_vars['re']['district'] )): ?>
                    <?php $_from = $this->_tpl_vars['re']['district']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                    <tr >
                        <td width="30">
                            <label class="radio">
                                <input type="radio"    name="sh_address"   value="<?php echo $this->_tpl_vars['item']['id']; ?>
">
                            </label>

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

                <div class="span3" style="margin-left: 0px">
                    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['re']['address']['id']; ?>
">
                    <button class="btn red show_detail" id="df_submit"    type="button" >提交</button>
                </div>
            </div>
            </form>
            <!-- END FORM-->
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>

<script>


    $('#df_submit').bind('click',function(){

        $modal = $('#ajax-modal');
        $('body').modalmanager('loading');
        $.fn.modal.defaults.width='';
        $.fn.modal.defaults.height='';
        $.post('<?php echo ((is_array($_tmp="order/order_address")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',$('#product_all').serialize(),function(msg){
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
                    window.parent.location.reload(true);
                    return;

                }
                setTimeout(modal_msg(str.msg), 300);
            }
            catch(e)
            {

                $('body').modalmanager('removeLoading');
                //alert(msg);
                setTimeout(modal_msg('系统异常'),300);
            };
        });

    });
</script>
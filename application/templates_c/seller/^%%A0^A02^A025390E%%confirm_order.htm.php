<?php /* Smarty version 2.6.20, created on 2017-07-17 13:53:06
         compiled from confirm_order.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'is_numeric', 'confirm_order.htm', 51, false),array('modifier', 'site_url', 'confirm_order.htm', 122, false),)), $this); ?>

<div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <h3 class="page-title"> <small> </small> </h3>
            <ul class="breadcrumb">
                <li> <i class="icon-home"></i> <a>我的商品</a> <span class="icon-angle-right"></span> </li>
                <li> <a href="#">购物车</a> <span class="icon-angle-right"></span> </li>
                <li><a href="#">确认订单</a></li>
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
                    <label>
                        <form action="" method="post" id="product_all">
                                                        <div id='alert-error_1' class="alert alert-error hide">
                                <button class="close" data-dismiss="alert"></button>
                                <span>提交失败</span></div>
                            <div id='alert-success_1' class="alert alert-success hide">
                                <button class="close" data-dismiss="alert"></button>
                                <span>提交成功</span></div>
                            <table class="table  table-bordered table-hover dataTable" >


                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                <?php if (! empty ( $this->_tpl_vars['re']['cart_list'] )): ?>
                                <?php $_from = $this->_tpl_vars['re']['cart_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['i']):
?>


                                    <?php if (key != 'warehouse_logstics'): ?>
                                    <tr>
                                        <td style="background-color: #eee;">仓库号:<?php echo $this->_tpl_vars['key']; ?>
</td><td style="background-color: #eee;" colspan="5">总计:<?php echo $this->_tpl_vars['i']['total_price']; ?>
(元) | 合计:<?php echo $this->_tpl_vars['i']['total_weight']; ?>
(克) | 运费:<?php echo $this->_tpl_vars['i']['logistics_fee']; ?>
（元） <?php if (isset ( $this->_tpl_vars['i']['warehouse_logstics'] )): ?> <font color="red"><?php echo $this->_tpl_vars['i']['warehouse_logstics']; ?>
</font><?php endif; ?></td>
                                    </tr>
                                    <tr role="heading" >
                                        <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品编号</th>

                                        <th width="60" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">拿货价格</th>
                                        <th width="200" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订购数</th>
                                        <th width="*"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1" colspan="3">中文名称</th>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['i']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['item']):
?>
                                        <?php if (( ((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('is_numeric', true, $_tmp) : is_numeric($_tmp)) )): ?>
                                        <tr >
                                            <td>
                                                <?php echo $this->_tpl_vars['item']['id']; ?>

                                            </td>

                                            <td>
                                                <?php echo $this->_tpl_vars['item']['price']; ?>

                                            </td>
                                            <td>
                                                  <p style="display: inline-block;width: 15px;" data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['c_num']; ?>
</p>
                                            </td>
                                            <td colspan="3">
                                                <?php echo $this->_tpl_vars['item']['name']; ?>

                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                    <?php endforeach; endif; unset($_from); ?>
                                <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="99">暂时无数据</td>
                                </tr>
                                <?php endif; ?>

                                <th colspan="7" style="background-color: #eee;" >选择收货地址</th>
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
                                            <input type="radio"    name="sh_address"  <?php if ($this->_tpl_vars['re']['district_select'] == $this->_tpl_vars['item']['id']): ?>checked="checked" <?php endif; ?> value="<?php echo $this->_tpl_vars['item']['id']; ?>
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
                                <th colspan="7" style="background-color: #eee;" >订单详情</th>
                                <tr>
                                    <td colspan="99">重量：<?php echo $this->_tpl_vars['re']['total_weight']; ?>
克  |  运费：<?php echo $this->_tpl_vars['re']['total_logistics_fee']; ?>
元  |  总价：<?php echo $this->_tpl_vars['re']['total_price']; ?>
元   </td>
                                </tr>
                                <tr>
                                    <td colspan="99" style="color: red;"> 订单共计：<?php echo $this->_tpl_vars['re']['total_logistics_fee']+$this->_tpl_vars['re']['total_price']; ?>
元</td>
                                </tr>



                            </table>
                            <div class="span3" style="margin-left: 0px">
                                <input type="hidden" name="item" value="<?php echo $this->_tpl_vars['re']['item']; ?>
">
                                <button class="btn <?php if (isset ( $this->_tpl_vars['re']['msg'] )): ?><?php else: ?> red<?php endif; ?> show_detail" id="df_submit"   <?php if (isset ( $this->_tpl_vars['re']['msg'] )): ?> disabled="disabled"<?php endif; ?>  type="button" >确认订单</button>
                                <?php if ($this->_tpl_vars['re']['disable'] == 1): ?> <?php endif; ?> <button class="btn yellow" type="button" onclick="window.location='<?php echo ((is_array($_tmp='order/cart_list')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
'">返回</button>
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
<script type="text/javascript" src="/static/js/jquery.validate.min.js"></script>
<script>



   function load_ini()
   {
       /* <?php if (! empty ( $this->_tpl_vars['re']['warning'] )): ?>*/

       modal_msg('<?php echo $this->_tpl_vars['re']['warning']; ?>
',function(){
           setTimeout(function(){
               window.location="<?php echo ((is_array($_tmp='order/cart_list')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
";
           },10000)

       })
       /* <?php endif; ?>*/
   }

    $("input[type='radio']").click(function(){
        var form1 = $('#product_all');
        load_sub();
        form1.submit();
    })


    $('#df_submit').bind('click',function(){

            $modal = $('#ajax-modal');
            $('body').modalmanager('loading');
            $.fn.modal.defaults.width='';
            $.fn.modal.defaults.height='';
            $.post('<?php echo ((is_array($_tmp="order/order_done")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',$('#product_all').serialize(),function(msg){
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

                    }
                    else if(str.type==3)
                    {
                        //刷新主页面
                        //f_main_index();

                        window.location='<?php echo ((is_array($_tmp="order/order_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
';
                        return;
                    }
                    setTimeout(modal_msg(str.msg), 300);
                }
                catch(e)
                {

                    $('body').modalmanager('removeLoading');
                    //alert(msg);
                    setTimeout(modal_msg('系统异常'), 300);
                };
            });

    });






</script>
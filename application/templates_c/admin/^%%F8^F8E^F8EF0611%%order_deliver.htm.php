<?php /* Smarty version 2.6.20, created on 2017-07-11 16:08:06
         compiled from order_deliver.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'order_deliver.htm', 109, false),)), $this); ?>
<div class="container-fluid">
<div class="row-fluid">
  <div class="span12">
    <div class="form">       <div id='alert-error_1' class="alert alert-error hide">
        <button class="close" data-dismiss="alert"></button>
        <span>提交失败</span> </div>
      <div id='alert-success_1' class="alert alert-success hide">
        <button class="close" data-dismiss="alert"></button>
        <span>提交成功</span> </div>
      <!-- BEGIN FORM-->
      <form action="" id="form_eidt" class="form-horizontal" method="post" >
        <table class="table table-bordered table-hover dataTable" id="table_1">
          <thead>
            <tr>
              <th bgcolor="#E2EEFE" colspan="99">订单信息</th>
            </tr>
          </thead>
          <tr>
            <th width="250px">订单编号：<?php echo $this->_tpl_vars['re']['id']; ?>
</th>
            <th width="250px">分销商：<?php echo $this->_tpl_vars['re']['company']; ?>
</th>
          </tr>
          <tr>
            <th width="250px">收货人姓名：<?php echo $this->_tpl_vars['re']['order']['consignee']; ?>
</th>
            <th width="250px">收货人地址：<?php echo $this->_tpl_vars['re']['order']['consignee_address']; ?>
</th>
            <th width="250px">收货人电话：<?php echo $this->_tpl_vars['re']['order']['consignee_mobile']; ?>
</th>
          </tr>
        </table>
        <table class="table table-bordered table-hover dataTable">
          <thead>
            <tr>
              <th bgcolor="#E2EEFE" colspan="99">订单信息修改</th>
            </tr>
          </thead>
          <tr>
          <tr role="heading">
            <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">编号</th>
            <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">供应总价</th>
            <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">分销总价</th>
            <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运单号</th>
            <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运单类型</th>
            <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">发货状态</th>
            <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运费</th>
            <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运单重量(克)</th>
            <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">供应商</th>
            <th class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">备注信息</th>
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
            <td width="80"><input type="text" name="logcs_num[<?php echo $this->_tpl_vars['item']['id']; ?>
]"   <?php if ($this->_tpl_vars['item']['delivery_status'] == 1 || $this->_tpl_vars['item']['delivery_status'] == -1): ?>disabled="disabled"<?php endif; ?>  value="<?php echo $this->_tpl_vars['item']['logcs_num']; ?>
"> </td>
            <td width="160"><select name="logistics_type[<?php echo $this->_tpl_vars['item']['id']; ?>
]"   <?php if ($this->_tpl_vars['item']['delivery_status'] == 1 || $this->_tpl_vars['item']['delivery_status'] == -1): ?>disabled="disabled"<?php endif; ?>  aria-controls="sample_1" class="form_2_select2 m-wrap span1">
              <option value=''>请选择</option>
              <?php $_from = $this->_tpl_vars['re']['logistics']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?> <option <?php if ($this->_tpl_vars['item']['logistics_type'] == $this->_tpl_vars['i']['type']): ?>selected<?php endif; ?>  value="<?php echo $this->_tpl_vars['i']['type']; ?>
"><?php echo $this->_tpl_vars['i']['company']; ?>

              </option>
              <?php endforeach; endif; unset($_from); ?>
              </select></td>
            <td width="160"><select name="delivery_status[<?php echo $this->_tpl_vars['item']['id']; ?>
]"   <?php if ($this->_tpl_vars['item']['delivery_status'] == 1 || $this->_tpl_vars['item']['delivery_status'] == -1): ?>disabled="disabled"<?php endif; ?>   aria-controls="sample_1" class="form_2_select2 m-wrap span1">
              <option value=''>请选择</option>
              <option <?php if ($this->_tpl_vars['item']['delivery_status'] == 1): ?>selected<?php endif; ?>  value="1">已发货
              </option>
              <option <?php if ($this->_tpl_vars['item']['delivery_status'] == -1): ?>selected<?php endif; ?>  value="-1">已作废
              </option>
              </select></td>
            <td width="80"><?php echo $this->_tpl_vars['item']['logcs_price']; ?>
 </td>
            <td width="80"><?php echo $this->_tpl_vars['item']['logcs_total_weight']; ?>
 </td>
            <td width="100"><?php echo $this->_tpl_vars['item']['sp_company']; ?>
</td>
            <td width="*"><?php echo $this->_tpl_vars['item']['remark']; ?>
</td>
          </tr>
          <?php endforeach; endif; unset($_from); ?>
          
          <?php else: ?>
          <tr>
            <td colspan="99">暂时无数据</td>
          </tr>
          <?php endif; ?>
            </tbody>
          
            </tr>
          
        </table>
        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['re']['id']; ?>
"/>
        <div class="form-actions">
          <button type="button" id='submit_eidt' class="btn red">提交</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script>

        var form1=$('#form_eidt');
        var error1  =$('#alert-error_1');
        var success1=$('#alert-success_1');
        $("#submit_eidt").click(function(){

                $modal=$('#ajax-modal');
                error1.hide();
                success1.show();
                success1.find('span').html('正在提交...........');
                $('body').modalmanager('loading');
                $.post('<?php echo ((is_array($_tmp="order/order_deliver_done")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form1.serialize(),function(msg)
                {
                    try
                    {
                        //alert(msg)
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
                            location.reload();
                        }
                        else if(str.type==3)
                        {
                            //刷新主页面
                           window.parent.location.reload(true);
                            return true;
                        }
                        setTimeout(function()
                        {
                            $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function()
                            {
                                $modal.modal();
                            });
                        }, 300);
                    }
                    catch(e)
                    {
                        $('body').modalmanager('removeLoading');
                        success1.hide();
                        error1.find('span').html('系统异常');
                        error1.show();
                    };
                });

        });


  </script>
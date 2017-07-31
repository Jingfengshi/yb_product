<?php /* Smarty version 2.6.20, created on 2017-07-11 15:17:42
         compiled from spuser_product_check_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'spuser_product_check_list.htm', 64, false),)), $this); ?>

  <div class="tabbable tabbable-custom">
    <div class="tab-content">
      <div class="control-group"> 
         <form id="sub_check_list" method="post">
          <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
            <thead>
              <tr role="heading">
                 <th width="40" class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">ID</th>
                <th width="80" class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">【供】UID</th>
                <th width="80" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">供应库存</th>
                <th width="80" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">供应价格</th>
                <th width="80" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">平台定价</th>
                <th width="150" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">上下架状态</th>
                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">仓库</th>
                <th width="80" class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">商品规格</th>
                <th width="*" class="sorting_disabled" role="columnheader" tabindex="0"  aria-controls="sample_1">商品名称</th>
              </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
            <?php $_from = $this->_tpl_vars['re']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <tr>
              <td><?php echo $this->_tpl_vars['item']['id']; ?>
</td>
              <td><?php echo $this->_tpl_vars['item']['userid']; ?>
</td>
              <td><input type="text" name="num[<?php echo $this->_tpl_vars['item']['id']; ?>
]" class="span1" value="<?php echo $this->_tpl_vars['item']['c_num']; ?>
" /></td>
              <td><input type="text" name="gprice[<?php echo $this->_tpl_vars['item']['id']; ?>
]" class="span1" value="<?php echo $this->_tpl_vars['item']['price']; ?>
" /></td>
              <td><input type="text" name="price[<?php echo $this->_tpl_vars['item']['id']; ?>
]" class="span1" value="<?php echo $this->_tpl_vars['item']['g_price']; ?>
" /></td>
              <td> 
                    <label class="radio inline">
                      <input type="radio" name="status[<?php echo $this->_tpl_vars['item']['id']; ?>
]"  value="0" <?php if ($this->_tpl_vars['item']['status'] == 0): ?>checked="checked"<?php endif; ?> >
                下架 </label>
              <label class="radio inline">
                <input type="radio" name="status[<?php echo $this->_tpl_vars['item']['id']; ?>
]"  value="1" <?php if ($this->_tpl_vars['item']['status'] == 1): ?>checked="checked"<?php endif; ?>>
                上架</label>
             </td>
             <td>
                 <select style="width:120px;" name="warehouse_id[<?php echo $this->_tpl_vars['item']['id']; ?>
]">
                      <option value="">未选仓库</option>
                     <?php $_from = $this->_tpl_vars['item']['warehouse_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
                 		 <option  <?php if ($this->_tpl_vars['v']['id'] == $this->_tpl_vars['item']['warehouse_id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['v']['id']; ?>
"><?php echo $this->_tpl_vars['v']['id']; ?>
-<?php echo $this->_tpl_vars['v']['name']; ?>
</option>
                     <?php endforeach; endif; unset($_from); ?>
                 </select>
             </td>
             <td><?php echo $this->_tpl_vars['item']['gg']; ?>
  </td>
             <td><?php echo $this->_tpl_vars['item']['name']; ?>
  </td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
            </tbody>
          </table>
        </form>  
      </div>
    </div>
  </div>
<div class="modal-footer">
  <button type="button" id="sub_spuser_product_check_list"  class="btn red">提交</button> <button type="button"   onclick="f_main_index()" class="btn">Close</button>
</div>
<script>
$('#sub_spuser_product_check_list').bind('click',function(){

	  $modal=$('#ajax-modal_2');
      $('body').modalmanager('loading');
	  $.fn.modal.defaults.width='';
	  $.fn.modal.defaults.height='';
      $.post('<?php echo ((is_array($_tmp='spuser/spuser_product_check_list')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?ids=<?php echo $_GET['ids']; ?>
',$('#sub_check_list').serialize(),function(msg){
        try
        {
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
            f_main_index();
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
		  setTimeout(function(){
           $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI('系统异常'),'', function(){
            $modal.modal();
           });
          }, 300);
        };
      });
});
 
</script>
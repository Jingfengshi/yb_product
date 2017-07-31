<?php /* Smarty version 2.6.20, created on 2017-07-11 15:22:04
         compiled from D:%5Cphpstudy%5CWWW%5Cyb_product%5Capplication%5Ctemplates/seller/seller_msg.htm */ ?>
<div class="modal-header" style="height:30px; background:#000;">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; height:1em; line-height:1em; width:1em;">x</button>
  <h4 style="color:#fff; margin-top:5px;">消息提示</h4>
</div>
<div class="modal-body">
  <div class="tabbable tabbable-custom">
    <div class="tab-content">
          <?php if ($_GET['msg']): ?><?php echo $_GET['msg']; ?>
<?php else: ?>操作成功<?php endif; ?>
          <?php if ($_GET['ss']): ?> <?php echo $this->_tpl_vars['ss']; ?>
 ,<?php echo $_GET['ss']; ?>
秒后关闭 <?php endif; ?>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" data-dismiss="modal" class="btn">Close</button>
</div>
<script>

<?php if ($_GET['ss']): ?>
    setTimeout(function()
    {
	  //F5 刷新效果
      window.location.reload(true);
    },<?php echo $_GET['ss']*1000; ?>
);
<?php endif; ?>	
</script>
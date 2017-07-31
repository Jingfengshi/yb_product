<?php /* Smarty version 2.6.20, created on 2017-07-11 15:51:46
         compiled from D:%5Cphpstudy%5CWWW%5Cyb_product%5Capplication%5Ctemplates/sp/iframe.htm */ ?>

<div class="base_msg">
  <div class="modal-header" style="padding:0px;">
    <h3 id="myModalLabel" class="modal-title" > <span style="margin-left:8px;"><?php echo $this->_tpl_vars['title']; ?>
</span> </h3>
  </div>
  <iframe src="<?php echo $this->_tpl_vars['url']; ?>
" style="width:<?php echo $this->_tpl_vars['width']; ?>
;height:<?php echo $this->_tpl_vars['height']; ?>
; border:0" ></iframe>
  <a title="Close" class="msg-modal-close" data-dismiss="modal" aria-hidden="true" href="javascript:;"></a> </div>
</div>
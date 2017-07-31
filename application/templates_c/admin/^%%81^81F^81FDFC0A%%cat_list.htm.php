<?php /* Smarty version 2.6.20, created on 2017-07-11 15:17:24
         compiled from cat_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'cat_list.htm', 36, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>网站管理</a> <span class="icon-angle-right"></span> </li>
        <li> <a href="#">公共参数管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">产品类型列表</a></li>
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
              <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
                <thead>
                  <tr role="heading">
                    <th width="80" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                    <th width="40" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">ID</th>
                    <th width="80" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">上级分类ID</th>
                    <th width="*" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">分类名</th>
                  </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                <?php if ($this->_tpl_vars['res_cat']): ?>
                    <?php $_from = $this->_tpl_vars['res_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                    <tr>
                      <td width="80"><a href="<?php echo ((is_array($_tmp="cat/cat_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?del_id=<?php echo $this->_tpl_vars['item']['id']; ?>
"  style="<?php if ($this->_tpl_vars['item']['pid'] != 0): ?>margin-left:15px;<?php endif; ?>"  
                       class="btn <?php if ($this->_tpl_vars['item']['pid'] == 0): ?>red<?php endif; ?> mini">删除</a></td>
                      <td width="80"><?php echo $this->_tpl_vars['item']['id']; ?>
<input type="hidden"  name="id[<?php echo $this->_tpl_vars['item']['id']; ?>
]" value="<?php echo $this->_tpl_vars['item']['id']; ?>
" /></td>
                      <td width="80"><?php echo $this->_tpl_vars['item']['pid']; ?>

                      </td>
                      <td width="*"><input type="text"  name="cat[<?php echo $this->_tpl_vars['item']['id']; ?>
]" value="<?php echo $this->_tpl_vars['item']['cat']; ?>
" /></td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?>
                </tbody>
                <thead>
                  <tr role="heading">
                    <th colspan="4">
                    <input type="hidden" name="act" value="edit_cat" />
                     <button class="btn green" type="submit" style="float:left;"  name="edit_sub">修改分类</button>
                    </th>
                  </tr>
                </thead>
              </table>
            </form>
            <form action="" method="post">
              <table class="table table-striped table-bordered table-hover dataTable">
                <tr role="heading">
                  <th colspan="4"> <select class="form_2_select2 m-wrap" style="float:left;" name="new_pid">
                      <option value="0">顶级分类</option>
                      <?php $_from = $this->_tpl_vars['res_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> <?php if ($this->_tpl_vars['item']['pid'] == 0): ?>
                      <option value="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['cat']; ?>
</option>
                      <?php endif; ?> <?php endforeach; endif; unset($_from); ?>
                    </select>
                    <div class="span2" >
                      <div class="input-append">
                        <input class="m-wrap small" style="border:1px solid red; background:#fff;" type="text" name="new_cat" value="">
                        <input type="hidden" name="act" value="add_cat" />
                        <button class="btn green" type="submit" name="new_sub">添加分类</button>
                      </div>
                    </div>
                  </th>
                </tr>
              </table>
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
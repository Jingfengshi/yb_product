<?php /* Smarty version 2.6.20, created on 2017-07-11 15:18:30
         compiled from spuser_product_check.htm */ ?>
<div class="container-fluid">

<!-- BEGIN PAGE HEADER--> 

<!-- END PAGE HEADER--> 
<!-- BEGIN PAGE CONTENT-->
<div class="row-fluid">
  <div class="span12"> 
    <!-- BEGIN VALIDATION STATES--> 
    
    <!-- BEGIN FORM-->
    <form action="" id="form_logccom_add" class="form-horizontal" method="post" >
            <div id='alert-error_1' class="alert alert-error hide">
        <button class="close" data-dismiss="alert"></button>
        <span>提交失败</span> </div>
      <div id='alert-success_1' class="alert alert-success hide">
        <button class="close" data-dismiss="alert"></button>
        <span>提交成功</span> </div>
      <table class="table table-bordered table-hover dataTable">
        <thead>
          <tr>
            <th bgcolor="#E2EEFE" colspan="4">产品名称</th>
          </tr>
          <tr>
            <th width="100">供应商</th>
            <td colspan="3"><?php echo $this->_tpl_vars['de']['userid']; ?>
 </td>
          </tr>
          <tr>
            <th width="100" style="color:red;">供应商定价</th>
            <td width="240"><?php echo $this->_tpl_vars['de']['price']; ?>
</td>
            <th width="100">市场指导价</th>
            <td><?php echo $this->_tpl_vars['de']['pro']['mark_price']; ?>
</td>
          </tr>
          <tr>
            <th style="color:red;">毛重</th>
            <td><?php echo $this->_tpl_vars['de']['pro']['mz']; ?>
</td>
            <th>净重</th>
            <td><?php echo $this->_tpl_vars['de']['pro']['jz']; ?>
</td>
          </tr>
          <tr>
            <th>商品条码</th>
            <td><?php echo $this->_tpl_vars['de']['pro']['barcode']; ?>
</td>
            <th>产品名称</th>
            <td><?php echo $this->_tpl_vars['de']['pro']['name']; ?>
</td>
          </tr>
          <tr>
            <th>产地</th>
            <td><?php echo $this->_tpl_vars['de']['pro']['country']; ?>
</td>
            <th>是否是食品</th>
            <td><?php echo $this->_tpl_vars['de']['pro']['type']; ?>
</td>
          </tr>
          <tr>
            <th>品牌</th>
            <td><?php echo $this->_tpl_vars['de']['pro']['brand']; ?>
</td>
            <th>商品类型</th>
            <td><?php echo $this->_tpl_vars['de']['pro']['catname']; ?>
</td>
          </tr>
          <tr>
            <th>规格</th>
            <td><?php echo $this->_tpl_vars['de']['pro']['gg']; ?>
</td>
            <th>商品简述</th>
            <td><?php echo $this->_tpl_vars['de']['pro']['desc']; ?>
</td>
          </tr>
          <tr>
            <th>功能/用途</th>
            <td colspan="3"><?php echo $this->_tpl_vars['de']['pro']['gn']; ?>
</td>
          </tr>
          <tr>
            <th>成分</th>
            <td colspan="3"><?php echo $this->_tpl_vars['de']['pro']['cf']; ?>
</td>
          </tr>
          <tr>
            <th>主图</th>
            <td colspan="3"><?php if (! $this->_tpl_vars['de']['pro']['pic']): ?>无主图<?php else: ?><img width="200" src="<?php echo $this->_tpl_vars['de']['pro']['pic']; ?>
"  /><?php endif; ?></td>
          </tr>
          <tr>
            <th>默认详情</th>
            <td colspan="3"><script>
                        	var server_auth="<?php echo $this->_tpl_vars['ueditor_auth']; ?>
";
                        </script> 
              <script type="text/javascript" charset="utf-8" src="/lib/ueditor/ueditor.config.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
              <script type="text/javascript" charset="utf-8" src="/lib/ueditor/ueditor.all.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"> </script> 
              <script type="text/javascript" charset="utf-8" src="/lib/ueditor/lang/zh-cn/zh-cn.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
              <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败--> 
              <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
              
              <textarea id="editor" style="width:100%; height:200px"  name="con"><?php echo $this->_tpl_vars['de']['pro']['con']; ?>
</textarea>
              <script>
                        	 UE.getEditor('editor').setHeight(300);
                        </script></td>
          </tr>
      </table>
    </form>
    <!-- END FORM--> 
    
    <!-- END VALIDATION STATES--> 
  </div>
</div>

<!-- END PAGE CONTENT--> 

</div
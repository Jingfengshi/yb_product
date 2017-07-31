<?php /* Smarty version 2.6.20, created on 2017-07-12 09:42:33
         compiled from info.htm */ ?>
<div class="container-fluid"> 
  
  <!-- BEGIN PAGE HEADER-->
  
  <div class="row-fluid">
    <div class="span12">
    <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a href="#">首页</a> </li>
      </ul>
    </div>
  </div>
  
  <!-- END PAGE HEADER--> 
  
  <!-- BEGIN PAGE CONTENT-->
  
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN VALIDATION STATES-->
      <div class="row-fluid">
        <div class="span3 responsive" data-tablet="span6  fix-offset" data-desktop="span3">
          <div class="dashboard-stat purple">
            <div class="visual"> <i class="icon-globe"></i> </div>
            <div class="details">
              <div class="number">10000个</div>
              <div class="desc">平台可订阅产品</div>
            </div>
            <a class="more" href="#"> View more <i class="m-icon-swapright m-icon-white"></i> </a> </div>
        </div>
        <div class="span3 responsive" data-tablet="span6" data-desktop="span3">
          <div class="dashboard-stat blue">
            <div class="visual"> <i class="icon-comments"></i> </div>
            <div class="details"> 
              <div class="number" style="font-size:14px; "></div>
              <div class="desc"> 已订阅 <?php echo $this->_tpl_vars['cash']['d_num']; ?>
 </div>
            </div>
            <a class="more" href="#"> View more <i class="m-icon-swapright m-icon-white"></i> </a> </div>
        </div>
        <div class="span3 responsive" data-tablet="span6 fix-offset" data-desktop="span3">
          <div class="dashboard-stat green">
            <div class="visual"> <i class="icon-shopping-cart"></i> </div>
            <div class="details">
              <div class="number" style="font-size:14px;"></div>
              <div class="desc">
                 <p>待发货 <?php echo $this->_tpl_vars['cash']['o_num']; ?>
</p>
              </div>
            </div>
            <a class="more" href="#"> View more <i class="m-icon-swapright m-icon-white"></i> </a> </div>
        </div>
        <div class="span3 responsive" data-tablet="span6" data-desktop="span3">
          <div class="dashboard-stat green">
            <div class="visual"> <i class="icon-yen"></i> </div>
            <div class="details">
              <div class="number" style="font-size:14px; font-weight:bold;"></div>
              <div class="desc">
              <p>余额 <?php echo $this->_tpl_vars['cash']['money']; ?>
</p>
              <p>交易中 <?php echo $this->_tpl_vars['cash']['d_money']; ?>
</p>
              </div>
            </div>
            <a class="more" href="#"> View more <i class="m-icon-swapright m-icon-white"></i> </a> </div>
        </div>
      </div>
      <!-- END VALIDATION STATES--> 
    </div>

  </div>
  
  <!-- END PAGE CONTENT--> 
  
</div>
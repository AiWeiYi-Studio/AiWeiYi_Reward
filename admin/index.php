<?php
include("../system/core/core.php");
$title='后台主页';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$user=$DB->count("SELECT count(*) from reward_user");
$orders=$DB->count("SELECT count(*) from reward_orders");
$query_en = curl_get("https://web.857xx.cn/api/auth/check.php?app=19&uuid=".$_SERVER["HTTP_HOST"]."&code=4B229696700B7FF118B9683366ABD9B8");
	$query=json_decode($query_en,true);
    if ($query["code"] != 1) {
        showmsg("<h3>".$query["msg"]."</h3>", true);
}
?>
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-sm-6 col-lg-6">
            <div class="card bg-primary">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">注册用户</p>
                  <p class="h3 text-white m-b-0"><?php echo $user ?>/个</p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-amazon-clouddrive fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-6">
            <div class="card bg-danger">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">系统订单</p>
                  <p class="h3 text-white m-b-0"><?php echo $orders ?>/个</p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-account fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>        
          </div>

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>用户资料</h4>
</div>
<div class="card-body">
<a href="javascript:void(0)" class="widget">
<div class="widget-content text-center">
<img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['qq']?>&amp;spec=100" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar-2x">
<h2 class="widget-heading h3 text-muted"></h2>
</div>
<div class="widget-content themed-background-muted text-dark text-center">
</div>
<div class="widget-content">
<div class="row text-center">

<div class="col-xs-6">
<h3 class="widget-heading"><i class="fa fa-plus-square text-primary"></i> <br><small>全站用户</br><font><span class='label label-info'><?php echo $numrows ?>个</span></font></small></h3>
</div>

<div class="col-xs-6">
<h3 class="widget-heading"><i class="fa fa-vimeo-square text-primary"></i><br><small>用户权限</br><font STYLE='color:green;'><span class='label label-warning'>超级管理</span></font></small></h3>
</div>
</div>
</div>

</div>
</div>
</div>
<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>

<script src="../assets/Layer/layer.js"></script>

</body>
</html>
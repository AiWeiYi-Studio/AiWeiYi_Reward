<?php
include("../system/core/core.php");
$title='后台主页';
$url='index.php';
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?url=".$url."';</script>");
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
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
                  <p class="h6 text-white m-t-0">正版授权</p>
                  <p class="h3 text-white m-b-0"><?php echo $sites ?>/个</p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-amazon-clouddrive fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-6">
            <div class="card bg-danger">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">盗版站点</p>
                  <p class="h3 text-white m-b-0"><?php echo $blocks ?>/个</p>
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

<?php if($udata['token']==null){?>
<script>
var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_my.php?act=my_edit_token",
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 1){
				   layer.msg('当前用户TOKEN为空，已自动生成', {
                time: 2000, //2s后自动关闭
                });
				}
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
		}
	});
</script>
<?php }?>

</body>
</html>
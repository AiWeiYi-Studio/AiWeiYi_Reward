<?php
include("../system/core/core.php");
$title='快捷登录配置';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:null;
?>

<!--页面主要内容-->
    <main class="lyear-layout-content">
      <div class="container-fluid">
                  
<?php if($mod=='qq'){?>

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>QQ快捷登录配置</h4>
</div>
<div class="card-body">

<div class="form-group">
<label>APPID</label>
<input type="appid" id="appid" name="appid" class="form-control" value="<?php echo $conf['oauth_qq_appid'];?>">
</div>

<div class="form-group">
<label>APPKEY</label>
<input type="appkey" id="appkey" name="appkey" class="form-control" value="<?php echo $conf['oauth_qq_appkey'];?>">
</div>

<div class="form-group">
<label>CALLBACK</label>
<input type="callback" id="callback" name="callback" class="form-control" value="<?php echo $conf['oauth_qq_callback'];?>">
</div>

<div class="form-group">
<a href="javascript:set_qqoauth()" class="btn-block btn-round btn btn-success">确定</a>
</div>

<?php }?>
</div>
</div>
</div>
</div> 
</div> 

    </main>
    <!--End 页面主要内容-->


<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>

<script src="../assets/Layer/layer.js"></script>


<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
$(items[i]).val($(items[i]).attr("default")||0);
}

function set_qqoauth(){
	var appid=$("#appid").val();
	var appkey=$("#appkey").val();
	var callback=$("#callback").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=set_qqoauth",
			data : {appid:appid,appkey:appkey,callback:callback},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
			}
		});
	};
</script>

</body>
</html>
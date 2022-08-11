<?php
$title='QQ注册';
$token=$_GET['token'];
include("../system/core/core.php");
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
    }
?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title><?php echo $title;?> - <?php echo $conf['site_title'];?></title>
<link rel="icon" href="../assets/System/icon/favicon.ico" type="image/ico">
<meta name="keywords" content="<?php echo $conf['site_keywords'];?>">
<meta name="description" content="<?php echo $conf['site_description'];?>">
<link href="../assets/LightYear/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/LightYear/css/materialdesignicons.min.css" rel="stylesheet">
<link href="../assets/LightYear/css/style.min.css" rel="stylesheet">
</head>
<body>
<div class="container" style="padding-top:60px;">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>QQ注册</h4>
</div>
<div class="card-body">

<div class="input-group">
<span class="input-group-addon">唯一密钥</span>
<input type="text" id="token" class="form-control" value="<?=$token?>" disabled="disabled">
</div><br/>

<div class="input-group">
<span class="input-group-addon">绑定账号</span>
<input type="text" id="user" class="form-control">
</div><br/>

<div class="input-group">
<span class="input-group-addon">账号密码</span>
<input type="password" id="pass" class="form-control">
</div><br/>

<pre>如没有绑定QQ可输入账号密码后点击绑定账号</pre>

<pre>如没有注册过可点击快捷注册免输入生成账号密码</pre>

<br/>

<div class="text-center">
<a href="javascript:reg()" class="btn btn-w-md btn-round btn-primary">快捷注册</a>
<a href="javascript:bd()" class="btn btn-w-md btn-round btn-success">绑定账号</a>
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

<script>
function reg(){
    var token=$("#token").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_reg.php?act=qq_reg",
			data : {token:token},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
						setTimeout(function () {
							location.href="./index.php";
						}, 1000); 
					  }
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
		}
	});
};
</script>
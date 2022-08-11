<?php
include("../system/core/core.php");
$title='用户信息';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
if($udata['active']=='1'){
$user_active = '正常';
}else{
$user_active = '封禁';
}
if($udata['qq_token']!=='' && $udata['qq_token']!==NULL){
$qq_token = '<a href="javascript:jiebang()"><span class="mdi mdi-verified">已绑定</span>（点击解绑）</a>';
}else{
$qq_token = '<a href="./login_qqbd.php" target="_blank">未绑定（点击绑定）</a>';
}
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>我的个人信息</h4>
</div>
<div class="card-body">
                  
<div class="edit-avatar">
<img src="<?php echo $udata['avatar'];?>" alt="<?php echo $udata['name'];?>" class="img-avatar">
<div class="avatar-divider"></div>
<div class="edit-avatar-content">
<p class="m-0">用户昵称：<?php echo $udata['name'];?></p>
<br>
<p class="m-0">快捷登陆：<?php echo $qq_token;?></p>
</div>
</div>
<hr>

<div class="row">
<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="uid">UID</label>
<input type="text" class="form-control" value="<?php echo $udata['uid'];?>" disabled="disabled" />
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="user">用户账号</label>
<input type="text" class="form-control" value="<?php echo $udata['user'];?>" disabled="disabled">
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="name">用户昵称</label>
<input type="text" class="form-control" value="<?php echo $udata['name'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="qq">用户QQ</label>
<input type="text" class="form-control" value="<?php echo $udata['qq'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="mail">用户邮箱</label>
<input type="text" class="form-control" value="<?php echo $udata['mail'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="phone">用户电话</label>
<input type="text" class="form-control" value="<?php echo $udata['phone'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="time">添加时间</label>
<input type="text" class="form-control" value="<?php echo $udata['reg_time'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="time">登录时间</label>
<input type="text" class="form-control" value="<?php echo $udata['login_time'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="ip">登录IP</label>
<input type="text" class="form-control" value="<?php echo $udata['login_ip'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="ip">绑定IP</label>
<input type="text" class="form-control" value="<?php echo $udata['client_ip'];?>" disabled="disabled" >
</div>
</div>

</div>

<div class="form-group">
<a href="./my_edit.php" class="btn-block btn-round btn btn-success">信息更改</a>
</div>

</div>
</div>
</div>
      
    </main>
    <!--End 页面主要内容-->
  </div>
</div>

<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>

<script src="../assets/Layer/layer.js"></script>

<script>
function jiebang(){
layer.confirm('确定解绑？',{btn:['确定','取消'],closeBtn:0,icon:3},function(){
var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_login.php?act=qq_jiebang",
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
						setTimeout(function () {
							location.href="./my_info.php";
						}, 1000); 
					  }
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
			}
		});
    });
};
</script>

</body>
</html>
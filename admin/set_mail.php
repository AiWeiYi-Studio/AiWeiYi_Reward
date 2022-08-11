<?php
include("../system/core/core.php");
$title='网站信息配置';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:NULL;
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>网站信息配置</h4>
</div>
<div class="card-body">

<div class="form-group">
<label for="text">SMTP服务器：</label>
<input type="text" id="mail_smtp" name="mail_smtp" class="form-control" value="<?=$conf['mail_smtp']?>">
</div>

<div class="form-group">
<label for="text">SMTP端口：</label>
<input type="text" id="mail_port" name="mail_port" class="form-control" value="<?=$conf['mail_port']?>">
</div>

<div class="form-group">
<label for="text">邮箱账号：</label>
<input type="text" id="mail_name" name="mail_name" class="form-control" value="<?=$conf['mail_name']?>">
</div>

<div class="form-group">
<label for="text">发信邮箱：</label>
<input type="text" id="mail_user" name="mail_user" class="form-control" value="<?=$conf['mail_user']?>">
</div>

<div class="form-group">
<label for="text">加密类型：</label>
<input type="text" id="mail_encrypt" name="mail_encrypt" class="form-control" value="<?=$conf['mail_encrypt']?>">
</div>

<div class="form-group">
<label for="text">邮箱密码(授权码)：</label>
<input type="text" id="mail_pwd" name="mail_pwd" class="form-control" value="<?php echo $conf['mail_pwd']; ?>">
</div>
                    
<div class="form-group">
<label for="text">收信邮箱：</label>
<input type="text" id="mail_recv" name="mail_recv" class="form-control" value="<?=$conf['mail_recv']?>">
</div>

<div class="form-group">
<label for="text">邮箱发信模板：</label>
<select id="mail_view" name="mail_view" class="form-control" default="<?=$conf['mail_view']?>">
    <option value="1">HTML_EMAIL模板1</option>
    <option value="2">HTML_EMAIL模板2</option>
    <option value="3">HTML_EMAIL模板3</option>
    <option value="4">HTML_EMAIL模板4</option>
    <option value="5">纯文本_EMAIL模板</option>
</select>
</div>
                    
<div class="form-group">
<a href="javascript:set_mail()" class="btn-block btn-round btn btn-success">确定修改</a>
</div>
            <div class="card-footer">
                <span class="layui-icon layui-icon-tips"></span>
                <?php if($conf['mail_name']){?><a href="javascript:send_mail_test()">给 <?php echo $conf['mail_recv']?$conf['mail_recv']:$conf['mail_name']?> 发一封测试邮件</a><hr><?php }?>
                使用QQ邮箱，SMTP服务器smtp.qq.com，端口465，密码不是QQ密码也不是邮箱独立密码，是QQ邮箱设置界面生成的<a href="https://service.mail.qq.com/cgi-bin/help?subtype=1&&no=1001256&&id=28"  target="_blank" rel="noreferrer">授权码</a>
            </div>
        </div>
    </div>
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
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
$(items[i]).val($(items[i]).attr("default")||0);
}

function set_mail(){
	var mail_smtp=$("#mail_smtp").val();
	var mail_port=$("#mail_port").val();
	var mail_name=$("#mail_name").val();
	var mail_pwd=$("#mail_pwd").val();
	var mail_recv=$("#mail_recv").val();
	var mail_view=$("#mail_view").val();
	var mail_user=$("#mail_user").val();
	var mail_encrypt=$("#mail_encrypt").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=set_mail",
			data : {mail_smtp:mail_smtp,mail_port:mail_port,mail_name:mail_name,mail_pwd:mail_pwd,mail_recv:mail_recv,mail_view:mail_view,mail_user:mail_user,mail_encrypt:mail_encrypt},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
				if(data.code==1){
						setTimeout(function () {
							location.href="./set_mail.php";
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
	
function send_mail_test(){
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=send_mail",
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
						setTimeout(function () {
							location.href="./set_mail.php";
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

</body>
</html>
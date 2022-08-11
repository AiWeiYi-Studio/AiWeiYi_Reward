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

<div class="input-group">
<span class="input-group-addon">网站标题</span>
<input type="text" id="site_title" name="site_title" class="form-control" placeholder="网站主要标题" value="<?=$conf['site_title']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">网站词字</span>
<input type="text" id="site_keywords" name="site_keywords" class="form-control" placeholder="网站关键词字" value="<?=$conf['site_keywords']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">网站信息</span>
<input type="text" id="site_description" name="site_description" class="form-control" placeholder="网站信息" value="<?=$conf['site_description']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">网站版权</span>
<input type="text" id="site_copyright" name="site_copyright" class="form-control" placeholder="网站版权" value="<?=$conf['site_copyright']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">网站备案</span>
<input type="text" id="site_beian" name="site_beian" class="form-control" placeholder="网站备案号" value="<?=$conf['site_beian']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">站点ＱＱ</span>
<input type="text" id="site_qq" name="site_qq" class="form-control" placeholder="网站联系QQ" value="<?=$conf['site_qq']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">站点邮箱</span>
<input type="text" id="site_mail" name="site_mail" class="form-control" placeholder="网站联系邮箱" value="<?=$conf['site_mail']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">站点号码</span>
<input type="text" id="site_phone" name="site_phone" class="form-control" placeholder="网站联系手机" value="<?=$conf['site_phone']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">QQ微信跳转</span>
<select id="site_jump" name="site_jump" class="form-control" default="<?=$conf['site_jump']?>">
<option value="0">关闭</option>
<option value="1">开启</option>
</select>
</div><br/>

<div class="input-group">
<span class="input-group-addon">全站维护(后台不维护)</span>
<select id="site_active" name="site_active" class="form-control" default="<?=$conf['site_active']?>">
<option value="0">关闭</option>
<option value="1">开启</option>
</select>
</div><br/>

<div class="form-group">
<a href="javascript:set_site()" class="btn-block btn-round btn btn-success">确定修改</a>
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

function set_site(){
	var site_title=$("#site_title").val();
	var site_keywords=$("#site_keywords").val();
	var site_description=$("#site_description").val();
    var site_beian=$("#site_beian").val();
	var site_copyright=$("#site_copyright").val();
	var site_jump=$("#site_jump").val();
	var site_active=$("#site_active").val();
	var site_qq=$("#site_qq").val();
	var site_mail=$("#site_mail").val();
	var site_phone=$("#site_phone").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=set_site",
			data : {site_title:site_title,site_keywords:site_keywords,site_description:site_description,site_beian:site_beian,site_copyright:site_copyright,site_jump:site_jump,site_active:site_active,site_qq:site_qq,site_mail:site_mail,site_phone:site_phone},
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
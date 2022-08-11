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
        
<?php if($mod=='user'){?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>用户聊天室配置</h4>
</div>
<div class="card-body">

<div class="input-group">
<span class="input-group-addon">聊天室开关</span>
<select id="chat_user_active" name="chat_user_active" class="form-control" default="<?=$conf['chat_user_active']?>">
<option value="0">关闭</option>
<option value="1">开启</option>
</select>
</div><br/>

<div class="input-group">
<span class="input-group-addon">黑名单字词</span>
<textarea class="form-control" id="chat_user_word" name="chat_user_word" placeholder="英文逗号隔开，用户发言触及则禁言，留空则不开启" rows="4"><?php echo htmlspecialchars($conf['chat_user_word']); ?></textarea>
</div><br/>

<div class="form-group">
<a href="javascript:set_chat_user()" class="btn-block btn-round btn btn-success">确定修改</a>
</div>

<?php }?>

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

function set_chat_user(){
	var chat_user_active=$("#chat_user_active").val();
	var chat_user_word=$("#chat_user_word").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=set_chat_user",
			data : {chat_user_active:chat_user_active,chat_user_word:chat_user_word},
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
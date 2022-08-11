<?php
include("../system/core/core.php");
$title='商城价格配置';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>商城价格配置</h4>
</div>
<div class="card-body">
    
<pre>设置0元则免费秒杀</pre>

<div class="input-group">
<span class="input-group-addon">跑手加盟</span>
<input type="text" id="money1" class="form-control" placeholder="跑手加盟价格" value="<?=$conf['shop_reward_money']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">发言权限</span>
<input type="text" id="money2" class="form-control" placeholder="发言权限价格" value="<?=$conf['shop_chat_money']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">商城开关</span>
<select id="active" class="form-control" default="<?=$conf['shop_active']?>">
<option value="0">关闭</option>
<option value="1">开启</option>
</select>
</div><br/>

<div class="form-group">
<a href="javascript:set_shop()" class="btn-block btn-round btn btn-success">确定修改</a>
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

function set_shop(){
	var money1=$("#money1").val();
	var money2=$("#money2").val();
	var active=$("#active").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=set_shop",
			data : {money1:money1,money2:money2,active:active},
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
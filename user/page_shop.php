<?php
include("../system/core/core.php");
$title='商城';
$url='page_shop.php';
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?url=".$url."';</script>");
if($conf['shop_active']=='0'){
    showmsg('<h2>商城功能未开启，请等待！</h2>',true);
    }
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        
        <div class="row">
<div class="col-sm-6">       
<div class="card">
<div class="card-header">
<h4>加盟跑手</h4>
</div>
<div class="card-body">
<li>商品金额：<b><?php if($conf['shop_reward_money']!==''){echo $conf['shop_reward_money'];}else{echo '0';}?></b> 元</li>
<li>商品详情：加盟跑手后可在线抢单，业余赚钱必备！</li>
<br/>
<?php if($conf['shop_reward_money']=='0'  or $conf['shop_reward_money']==NULL){?>
<img src="../assets/System/img/kill.gif">
<div class="text-right">
<a href="javascript:shop_reward()" class="btn btn-w-md btn-round btn-danger">马上秒杀</a>
</div>
<?php }else{?>
<div class="text-right">
<a href="javascript:shop_reward()" class="btn btn-w-md btn-round btn-danger">确定购买</a>
</div>
<?php }?>
                
</div>
</div>
</div>

<div class="col-sm-6">       
<div class="card">
<div class="card-header">
<h4>发言权限</h4>
</div>
<div class="card-body">
<li>商品金额：<b><?php if($conf['shop_chat_money']!==''){echo $conf['shop_chat_money'];}else{echo '0';}?></b> 元</li>
<li>商品详情：用户违规发言被封禁后可通过此恢复！</li>
<br/>
<?php if($conf['shop_chat_money']=='0'  or $conf['shop_chat_money']==NULL){?>
<img src="../assets/System/img/kill.gif">
<div class="text-right">
<a href="javascript:shop_chat()" class="btn btn-w-md btn-round btn-danger">马上秒杀</a>
</div>
<?php }else{?>
<div class="text-right">
<a href="javascript:shop_chat()" class="btn btn-w-md btn-round btn-danger">确定购买</a>
</div>
<?php }?>
                
</div>
</div>
</div>
</div>
        
    </div>
</main>



<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>


<script src="../assets/Layer/layer.js"></script>

<script>
function shop_reward(){
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=shop_reward",
			data : {},
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

function shop_chat(){
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=shop_chat",
			data : {},
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
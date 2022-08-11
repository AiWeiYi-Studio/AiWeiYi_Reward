<?php
include("../system/core/core.php");
$title='用户钱包';
$url='my_money.php';
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?url=".$url."';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:index;
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
   
<?php if($mod=='index'){?>  
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>我的个人钱包</h4>
</div>
<div class="card-body">

<div class="row">

<div class="col-sm-6 col-lg-6">
<div class="card bg-primary">
<div class="card-body clearfix">
<div class="pull-right"align="right">
<p class="h6 text-white m-t-0"> 账号余额</p>
<p class="h3 text-white m-b-0"><?php echo $udata['money'];?> 元</p>
</div>
<div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-currency-cny fa-1-5x"></i></span> </div>
</div>
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="card bg-primary">
<div class="card-body clearfix">
<div class="pull-right"align="right">
<p class="h6 text-white m-t-0"> 积分余额</p>
<p class="h3 text-white m-b-0"><?php echo $udata['integral'];?> 分</p>
</div>
<div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-currency-cny fa-1-5x"></i></span> </div>
</div>
</div>
</div>
</div>

<div class="form-group">
<center>
<a href="?mod=chongzhi" class="btn-round btn btn-success">余额充值</a>
<a href="?mod=jifen" class="btn-round btn btn-success">积分兑换</a>
</center>
</div>

<?php }elseif($mod=='chongzhi'){?>
<div class="row">
    
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>余额充值</h4>
</div>
<div class="card-body">
    
<?php if($conf['pay_notice']!==NULL){?>
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong><?php echo $conf['pay_notice'];?></strong>
</div>
<?php }?>
    
<div class="form-group">
<label for="text">在线充值</label>
<input class="form-control" type="text"  id="money" name="money" value="<?php echo $conf['pay_money_number'];?>" placeholder="输入你要充值的余额">
</div>

<?php if($conf['pay_alipay_api']!=='0' || $conf['pay_qqpay_api']!=='0' || $conf['pay_wxpay_api']!=='0'){?>

<div class="form-group">
<label for="text">支付方式</label>

	<select class="form-control" id="type" name="type" default="">
<?php if($conf['pay_qqpay_api']!=='0'){?>
<option value="qqpay">QQ</option>
<?php }if($conf['pay_wxpay_api']!=='0'){?>
<option value="wxpay">微信</option>
<?php }if($conf['pay_alipay_api']!=='0'){?>
<option value="alipay">支付宝</option>
<?php }?>
</select>
</div>
<pre>最低充值：<?php echo $conf['pay_money_little'];?> 元，最高充值：<?php echo $conf['pay_money_big'];?> 元</pre>

<div class="form-group">
<a href="javascript:my_chongzhi()" class="btn-block btn-round btn btn-success">确定</a>
</div>

<?php }elseif($conf['pay_alipay_api']=='0' && $conf['pay_qqpay_api']=='0' && $conf['pay_wxpay_api']=='0'){?>
<pre>系统未开启任何支付接口</pre>
<?php }?>

</div>
</div>
</div>
</div>

<?php }?>

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
function my_chongzhi(){
	var money=$("#money").val();
	var type=$("#type").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_my.php?act=my_chongzhi",
			data : {money:money,type:type},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code == 1){
			    window.location.href='../system/pay/submit.php?type='+type+'&orderid='+data.trade_no;
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
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
          
<?php if($mod=='epay'){
$data=get_curl(pay_api().'api.php?act=query&pid='.$conf['pay_epay_pid'].'&key='.$conf['pay_epay_key'].'&url='.$_SERVER['HTTP_HOST']);
$arr=json_decode($data,true);?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>商户信息查看</h4>
</div>
<div class="card-body">
    
  <ul class="nav nav-tabs">
      <li class="active"><a href="#">官方易支付设置</a></li>
      <li><a href="./set_pay.php?mod=order">订单记录</a></li>
      <li><a href="./set_pay.php?mod=list">结算记录</a></li>
      </ul>  

<h4>商户信息查看：</h4>

<?php if($arr['code']=='-2' || $arr['active']=='0'){
if($arr['code']=='-2'){
$tip = '易支付KEY校验失败';
}elseif($arr['active']=='0'){
$tip= '该商户已被封禁';
}
?>
<div class="input-group">
<span class="input-group-addon">温馨提醒</span>
<input type="text" class="form-control" value="<?php echo $tip;?>"disabled/>
</div><br/>
<?php }else{?>
    
<div class="input-group">
<span class="input-group-addon">商户ID</span>
<input type="text" class="form-control" value="<?php echo $arr['pid'];?>"disabled/>
</div><br/>

<div class="input-group">
<span class="input-group-addon">商户KEY</span>
<input type="text" class="form-control" value="<?php echo substr($arr['key'],0,8).'****************'.substr($arr['key'],24,32);?>"disabled/>
</div><br/>

<div class="input-group">
<span class="input-group-addon">商户余额</span>
<input type="text" class="form-control" value="<?php echo $arr['money'];?>"disabled/>
</div><br/>

<h4>收款账号设置：</h4>

<div class="input-group">
<span class="input-group-addon">结算方式</span>
<input type="text" class="form-control" value="<?php echo ($arr['stype']?$arr['stype']:'支付宝');?>"disabled/>
</div><br/>

<div class="input-group">
<span class="input-group-addon">结算账号</span>
<input type="text" class="form-control" value="<?php echo $arr['account'];?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">真实姓名</span>
<input type="text" class="form-control" value="<?php echo $arr['username'];?>">
</div><br/>

<div class="form-group">
<a href="javascript:set_epay()" class="btn-block btn-round btn btn-success">确定修改</a>
</div>

<a href="set_pay.php?mod=list">进入易支付设置和订单查询页面</a>

<?php }?>
    
<h4><span class="glyphicon glyphicon-info-sign"></span> 注意事项</h4>
1.结算账号和真实姓名请仔细核对，一旦错误将无法结算到账！<br/>
2.每笔交易会有<?php echo 100-$arr['money_rate'];?>%的手续费，这个手续费是支付宝、微信和财付通收取的，非本接口收取。<br/>
3.结算为T+1规则，当天满<?php $arr['settle_money'];?>元在第二天会自动结算
</div>
</div>
    
<?php }elseif($mod=='list'){?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>官方易支付结算记录</h4>
</div>
<div class="card-body">
    
	<div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>结算账号</th><th>结算金额</th><th>手续费</th><th>结算时间</th></tr></thead>
          <tbody>
<?php 

$data=get_curl(pay_api().'api.php?act=orders&pid='.$conf['pay_epay_pid'].'&key='.$conf['pay_epay_key'].'&limit=30&url='.$_SERVER['HTTP_HOST']);
$arr=json_decode($data,true);
foreach($arr['data'] as $res){
    echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['account'].'</td><td><b>'.$res['money'].'</b></td><td><b>'.$res['fee'].'</b></td><td>'.$res['time'].'</td></tr>';
}?>
          </tbody>
        </table>
      </div>
	</div>
<?php }elseif($mod=='order'){?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>官方易支付结算记录</h4>
</div>
<div class="card-body">
    订单只展示前30条[<a href="set_pay.php?mod=epay">返回</a>]
	<div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>交易号/商户订单号</th><th>付款方式</th><th>商品名称/金额</th><th>创建时间/完成时间</th><th>状态</th></tr></thead>
          <tbody>
<?php
$data=get_curl(pay_api().'api.php?act=orders&pid='.$conf['pay_epay_pid'].'&key='.$conf['pay_epay_key'].'&limit=30&url='.$_SERVER['HTTP_HOST']);
$arr=json_decode($data,true);
foreach($arr['data'] as $res){echo '<tr><td>'.$res['trade_no'].'<br/>'.$res['out_trade_no'].'</td><td>'.$res['type'].'</td><td>'.$res['name'].'<br/>￥ <b>'.$res['money'].'</b></td><td>'.$res['addtime'].'<br/>'.$res['endtime'].'</td><td>'.($res['status']==1 ? '<font color=green>已完成</font>' : '<font color=red>未完成</font>').'</td></tr>';
}?>
</tbody>
        </table>
      </div>
	  </div>
    
<?php }else{?>
          
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>系统支付配置</h4>
</div>
<div class="card-body">

            <div class="input-group">
                <span class="input-group-addon">官方易支付接入商</span>
			<select class="form-control" id="api" name="api" default="<?php echo $conf['pay_epay_api'];?>">
			    <option value="0">爱唯逸云支付</option>
			    <option value="1">我爱云支付</option>
                <option value="-1">其它（手动输入）</option>
                </select>
	</div><br/>
	
	
	<?php if ($conf['pay_epay_api']=='-1') {?>
	     <div class="input-group">
	    <span class="input-group-addon">官方易支付接口网址</span>
			<input type="text" id="url" name="url" class="form-control" value="<?php echo $conf['pay_epay_url'];?>" placeholder="请输入易支付网址"/>
		</div><br/>
	<?php }?>
	
	
	<div class="input-group">
	    <span class="input-group-addon">官方易支付商户ID</span>
			<input type="text" id="pid" name="pid" class="form-control" value="<?php echo $conf['pay_epay_pid'];?>">
		</div><br/>
	
	
	<div class="input-group">
	    <span class="input-group-addon">官方易支付商户密钥</span>
			<input type="text" id="key" name="key" class="form-control" value="<?php echo $conf['pay_epay_key'];?>">
		</div><br/>
		
		<div class="input-group">
	    <span class="input-group-addon">最低充值金额</span>
			<input type="text" id="little" name="little" class="form-control" value="<?php echo $conf['pay_money_little'];?>">
		</div><br/>
		
		<div class="input-group">
	    <span class="input-group-addon">最大充值金额</span>
			<input type="text" id="big" name="big" class="form-control" value="<?php echo $conf['pay_money_big'];?>">
		</div><br/>

<div class="form-group">
<a href="javascript:set_pay()" class="btn-block btn-round btn btn-success">确定修改</a>
</div>
<a href="set_pay.php?mod=epay">进入易支付结算设置查询页面</a>

<?php }?>

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
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
$(items[i]).val($(items[i]).attr("default")||0);
}
</script>

<script>
function set_pay(){
    var api=$("#api").val();
    var url=$("#url").val();
    var pid=$("#pid").val();
    var key=$("#key").val();
    var little=$("#little").val();
    var big=$("#big").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=set_pay",
			data : {api:api,url:url,pid:pid,key:key,little:little,big:big},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code == 1){
				   window.location.href="./set_pay.php"; 
				}
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
			}
		});
	};
function set_epay(){
    var account=$("#account").val();
    var username=$("#username").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=set_epay",
			data : {account:account,username:username},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code == 1){
				   window.location.href="./set_pay.php?mod=epay"; 
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
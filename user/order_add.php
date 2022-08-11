<?php
include("../system/core/core.php");
$title='发表订单';
$url='order_add.php';
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?url=".$url."';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:'1';
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      <div class="container-fluid">
          
<div class="row">
<div class="col-lg-12">
    
<?php if($mod=='1'){?>
<div class="card">
<ul class="nav nav-tabs page-tabs">
<li style="width: 25%;" class="active"> <a href="?mod=1">送货</a> </li>
<li style="width: 25%;"> <a href="?mod=2">取货</a> </li>
<li style="width: 25%;"> <a href="?mod=3">取快递</a> </li>
<li style="width: 25%;"> <a href="?mod=4">买餐</a> </li>
</ul>
<div class="tab-content">
<div class="tab-pane active">
    
<div class="input-group">
<span class="input-group-addon">取货地址</span>
<input type="text" id="place1" class="form-control" placeholder="填写取货的地址">
</div><br/>
    
<div class="input-group">
<span class="input-group-addon">送货地址</span>
<input type="text" id="place2" class="form-control" placeholder="填写取完货需要送的地址">
</div><br/>

<div class="input-group">
<span class="input-group-addon">取货联系</span>
<input type="text" id="phone1" class="form-control" placeholder="填写取货地址的联系方式">
</div><br/>

<div class="input-group">
<span class="input-group-addon">收货联系</span>
<input type="text" id="phone2" class="form-control" placeholder="填写收货地址的联系方式">
</div><br/>

<div class="input-group">
<span class="input-group-addon">路费红包</span>
<input type="text" id="money2" class="form-control" placeholder="红包越多，跑手更得劲">
</div><br/>

<div class="input-group">
<span class="input-group-addon">订单要求</span>
<textarea class="form-control" id="text" name="text" placeholder="订单备注与要求" rows="4"><?php echo htmlspecialchars(); ?></textarea>
</div><br/>

<div class="input-group">
<span class="input-group-addon">订单类型</span>
<input type="text" id="type" class="form-control" value="1" disabled="disabled">
</div><br/>

<div class="form-group">
<a href="javascript:add()" class="btn-block btn-round btn btn-success">确定添加</a>
</div>

</div>
</div>
</div>
</div> 
</div>
<?php }elseif($mod=='2'){?>
<div class="card">
<ul class="nav nav-tabs page-tabs">
<li style="width: 25%;"> <a href="?mod=1">送货</a> </li>
<li style="width: 25%;" class="active"> <a href="?mod=2">取货</a> </li>
<li style="width: 25%;"> <a href="?mod=3">取快递</a> </li>
<li style="width: 25%;"> <a href="?mod=4">买餐</a> </li>
</ul>
<div class="tab-content">
<div class="tab-pane active">
    
<div class="input-group">
<span class="input-group-addon">取货地址</span>
<input type="text" id="place1" class="form-control" placeholder="填写取货的地址">
</div><br/>
    
<div class="input-group">
<span class="input-group-addon">送货地址</span>
<input type="text" id="place2" class="form-control" placeholder="填写取货后送货的地址">
</div><br/>

<div class="input-group">
<span class="input-group-addon">取货联系</span>
<input type="text" id="phone1" class="form-control" placeholder="填写取货地址的联系方式">
</div><br/>

<div class="input-group">
<span class="input-group-addon">收货联系</span>
<input type="text" id="phone2" class="form-control" placeholder="填写收货地址联系方式">
</div><br/>

<div class="input-group">
<span class="input-group-addon">订单要求</span>
<textarea class="form-control" id="text" name="text" placeholder="订单备注与要求" rows="4"><?php echo htmlspecialchars(); ?></textarea>
</div><br/>

<div class="input-group">
<span class="input-group-addon">预计花费</span>
<input type="text" id="money1" class="form-control" placeholder="估计需要花费的金额">
</div><br/>

<div class="input-group">
<span class="input-group-addon">路费红包</span>
<input type="text" id="money2" class="form-control" placeholder="红包越多，跑手更得劲">
</div><br/>

<div class="input-group">
<span class="input-group-addon">订单类型</span>
<input type="text" id="type" class="form-control" value="2" disabled="disabled">
</div><br/>

<div class="form-group">
<a href="javascript:add()" class="btn-block btn-round btn btn-success">确定添加</a>
</div>

</div>
</div>
</div>
</div> 
</div>

<?php }elseif($mod=='3'){?>
<div class="card">
<ul class="nav nav-tabs page-tabs">
<li style="width: 25%;"> <a href="?mod=1">送货</a> </li>
<li style="width: 25%;"> <a href="?mod=2">取货</a> </li>
<li style="width: 25%;" class="active"> <a href="?mod=3">取快递</a> </li>
<li style="width: 25%;"> <a href="?mod=4">买餐</a> </li>
</ul>
<div class="tab-content">
<div class="tab-pane active">
    
<div class="input-group">
<span class="input-group-addon">快递地址</span>
<input type="text" id="place1" class="form-control" placeholder="填写快递的地址（备注注明快递类型）">
</div><br/>
    
<div class="input-group">
<span class="input-group-addon">送货地址</span>
<input type="text" id="place2" class="form-control" placeholder="填写取完快递后送货的地址">
</div><br/>

<div class="input-group">
<span class="input-group-addon">取货电话</span>
<input type="text" id="phone1" class="form-control" placeholder="填写快递手机号或后四位">
</div><br/>

<div class="input-group">
<span class="input-group-addon">收货联系</span>
<input type="text" id="phone2" class="form-control" placeholder="填写送货地址联系方式，送到后联系">
</div><br/>

<div class="input-group">
<span class="input-group-addon">预计花费</span>
<input type="text" id="money1" class="form-control" placeholder="估计需要花费的金额">
</div><br/>

<div class="input-group">
<span class="input-group-addon">路费红包</span>
<input type="text" id="money2" class="form-control" placeholder="红包越多，跑手更得劲">
</div><br/>

<div class="input-group">
<span class="input-group-addon">订单要求</span>
<textarea class="form-control" id="text" name="text" placeholder="订单备注与要求（务必备注快递类型）" rows="4"><?php echo htmlspecialchars(); ?></textarea>
</div><br/>

<div class="input-group">
<span class="input-group-addon">订单类型</span>
<input type="text" id="type" class="form-control" value="3" disabled="disabled">
</div><br/>

<div class="form-group">
<a href="javascript:add()" class="btn-block btn-round btn btn-success">确定添加</a>
</div>

</div>
</div>
</div>
</div> 
</div>
<?php }elseif($mod=='4'){?>
<div class="card">
<ul class="nav nav-tabs page-tabs">
<li style="width: 25%;"> <a href="?mod=1">送货</a> </li>
<li style="width: 25%;"> <a href="?mod=2">取货</a> </li>
<li style="width: 25%;"> <a href="?mod=3">取快递</a> </li>
<li style="width: 25%;" class="active"> <a href="?mod=4">买餐</a> </li>
</ul>
<div class="tab-content">
<div class="tab-pane active">
    
<div class="input-group">
<span class="input-group-addon">购餐地址</span>
<input type="text" id="place1" class="form-control" placeholder="如无指定地址购买可留空">
</div><br/>
    
<div class="input-group">
<span class="input-group-addon">收货地址</span>
<input type="text" id="place2" class="form-control" placeholder="填写取完快递后送货的地址">
</div><br/>

<div class="input-group">
<span class="input-group-addon">收货联系</span>
<input type="text" id="phone2" class="form-control" placeholder="填写收货地址联系方式，送到后联系">
</div><br/>

<div class="input-group">
<span class="input-group-addon">预计花费</span>
<input type="text" id="money1" class="form-control" placeholder="估计需要花费的金额">
</div><br/>

<div class="input-group">
<span class="input-group-addon">路费红包</span>
<input type="text" id="money2" class="form-control" placeholder="红包越多，跑手更得劲">
</div><br/>

<div class="input-group">
<span class="input-group-addon">订单要求</span>
<textarea class="form-control" id="text" name="text" placeholder="订单备注与要求（务必备注买什么）" rows="4"><?php echo htmlspecialchars(); ?></textarea>
</div><br/>

<div class="input-group">
<span class="input-group-addon">订单类型</span>
<input type="text" id="type" class="form-control" value="4" disabled="disabled">
</div><br/>

<div class="form-group">
<a href="javascript:add()" class="btn-block btn-round btn btn-success">确定添加</a>
</div>

</div>
</div>
</div>
</div> 
</div>
<?php }?>
    </main>
    <!--End 页面主要内容-->

<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>

<script src="../assets/Layer/layer.js"></script>

<script>
function add(){
	var type=$("#type").val();
	var place1=$("#place1").val();
	var place2=$("#place2").val();
	var phone1=$("#phone1").val();
	var phone2=$("#phone2").val();
	var text=$("#text").val();
	var money1=$("#money1").val();
	var money2=$("#money2").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=orders_add",
			data : {type:type,place1:place1,place2:place2,phone1:phone1,phone2:phone2,text:text,money1:money1,money2:money2},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code == 1){
				   window.location.href="./order_list.php"; 
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

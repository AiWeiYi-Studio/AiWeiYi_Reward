<?php
include("../system/core/core.php");
$title='旗下程序列表';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:'list';
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      <div class="container-fluid">
    
<?php if($mod=='list'){
$orders=$DB->count("SELECT count(*) from reward_orders");
$ok=$DB->count("SELECT count(*) from reward_orders WHERE active='0'");
$no=$DB->count("SELECT count(*) from reward_orders WHERE active='1'");
?>
        <div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>程序列表</h4>
</div>
<div class="card-body">

<div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>系统目前有</strong> <?php echo $orders;?> <strong>个订单，其中未完成 </strong><?php echo $no;?><strong> 个，已完成 </strong><?php echo $ok;?> <strong>个</strong>
                </div>
                      <a href="?mod=add" class="btn btn-primary">添加订单</a> 

     <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>订单要求</th><th>发布时间</th><th>结单时间</th><th>发布者</th><th>接单者</th><th>订单状态</th><th>操作</th></tr></thead>
          <tbody>
<?php
$rs=$DB->query("SELECT * FROM reward_orders");
while($res = $DB->fetch($rs))
{
if($res['active']=='1'){$active='进行中';}else{$active='已结单';}
echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['text'].'</td><td>'.$res['add'].'</td><td>'.$res['end'].'</td><td>'.$res['user'].'</td><td>'.$res['users'].'</td><td>'.$active.'</td><td><a href="?mod=edit&uid='.$res['uid'].'" class="btn btn-info btn-xs">编辑</a> <a href="/page/program/page.php?id='.$res['id'].'" class="btn btn-info btn-xs">查看</a></td></tr>';
}
?>
          </tbody>
        </table>
      </div>
      
<?php }elseif($mod=='edit'){
$uid = $_GET['uid'];
$row = $DB->get_row("SELECT * FROM website_template WHERE uid='$uid' limit 1");
?>
        <div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>信息修改</h4>
</div>
<div class="card-body">
    
<div class="input-group">
<span class="input-group-addon">模板UID</span>
<input type="text" id="uid" name="uid" class="form-control" value="<?=$row['uid']?>" disabled="disabled" />
</div><br/>

<div class="input-group">
<span class="input-group-addon">模板目录</span>
<input type="text" id="path" name="path" class="form-control" placeholder="请输入模板目录" value="<?=$row['path']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">模板昵称</span>
<input type="text" id="name" name="name" class="form-control" placeholder="请输入标识的模板名称" value="<?=$row['name']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">模板类型</span>
<select id="type" name="type" class="form-control" default="<?=$row['type']?>">
<option value="index">网站首页页面</option>
<option value="user_login">用户登录页面</option>
<option value="user_reg">用户注册页面</option>
<option value="admin_login">站长登录页面</option>
</select>
</div><br/>

<div class="form-group">
<a href="javascript:edit()" class="btn-block btn-round btn btn-success">确定修改</a>
</div>

</div>
</div>
</div>

<?php }elseif($mod=='add'){?>
        <div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>发布订单</h4>
</div>
<div class="card-body">
    
<div class="input-group">
<span class="input-group-addon">取货地址</span>
<input type="text" id="place1" class="form-control" placeholder="填写取货的地址，无特殊要求可留空">
</div><br/>
    
<div class="input-group">
<span class="input-group-addon">送货地址</span>
<input type="text" id="place2" class="form-control" placeholder="填写收货的地址，无特殊要求可留空">
</div><br/>

<div class="input-group">
<span class="input-group-addon">联系方式</span>
<input type="text" id="phone" class="form-control" placeholder="填写电话、微信、QQ，供订单完成后联系">
</div><br/>

<div class="input-group">
<span class="input-group-addon">订单要求</span>
<textarea class="form-control" id="text" name="text" placeholder="订单备注与要求" rows="4"><?php echo htmlspecialchars(); ?></textarea>
</div><br/>

<div class="input-group">
<span class="input-group-addon">订单类型</span>
<select id="type" class="form-control" default="">
    <option value="1">帮我送货</option>
    <option value="2">帮我取货</option>
    <option value="3">帮我买货</option>
</select>
</div><br/>

<div class="form-group">
<a href="javascript:add()" class="btn-block btn-round btn btn-success">确定添加</a>
</div>

</div>
</div>
</div>

<?php }?>
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
function add(){
	var text=$("#text").val();
	var active=$("#active").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=orders_add",
			data : {text:text,active:active},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code == 1){
				   window.location.href="./set_orders.php"; 
				}
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
			}
		});
	};
	
function edit(){
    var uid=$("#uid").val();
	var path=$("#path").val();
	var name=$("#name").val();
	var type=$("#type").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=template_edit",
			data : {uid:uid,path:path,name:name,type:type},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code == 1){
				   window.location.href="./set_template.php?mod=list"; 
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

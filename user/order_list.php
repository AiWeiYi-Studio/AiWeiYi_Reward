<?php
include("../system/core/core.php");
$title='订单列表';
include './page_head.php';
$url='order_list.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?url=".$url."';</script>");
$orders=$DB->count("SELECT count(*) from reward_orders");
$ok=$DB->count("SELECT count(*) from reward_orders WHERE active='1'");
$no=$DB->count("SELECT count(*) from reward_orders WHERE active='0'");
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      <div class="container-fluid">
          
        <div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>订单列表</h4>
</div>
<div class="card-body">

<div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>系统目前有</strong> <?php echo $orders;?> <strong>个订单，其中未完成 </strong><?php echo $no;?><strong> 个，已完成 </strong><?php echo $ok;?> <strong>个</strong>
                </div>
                      <a href="order_add.php" class="btn btn-primary">发布订单</a> 

     <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>类型</th><th>时间</th><th>发布者</th><th>花费</th><th>红包</th><th>操作</th></tr></thead>
          <tbody>
<?php
$rs=$DB->query("SELECT * FROM reward_orders WHERE active='0'");
while($res = $DB->fetch($rs))
{
$row = $DB->get_row("SELECT * FROM reward_user WHERE uid='{$res['user']}' limit 1");
if($res['type']=='1'){$type='帮我送货';}elseif($res['type']=='2'){$type='帮我取货';}elseif($res['type']=='3'){$type='帮取快递';}elseif($res['type']=='4'){$type='帮我买餐';}
if($res['money1']=='' || $res['money1']==NULL){$money1='无需或未知';}else{$money1=$res['money1'];}
if($res['money2']=='' || $res['money2']==NULL){$money2='无红包';}else{$money2=$res['money2'];}
echo '<tr><td><b>'.$res['id'].'</b></td><td><b><font color="red">'.$type.'</font></b></td><td>'.$res['add'].'</td><td>'.$row['name'].'</td><td><b><font color="red">'.$money1.'</font></b></td><td><b><font color="red">'.$money2.'</font></b></td><td><a href="./order_view.php?id='.$res['id'].'" class="btn btn-info btn-xs">查看</a> <a href="order_go.php?id='.$res['id'].'" class="btn btn-info btn-xs">接单</a></td></tr>';
}
?>
          </tbody>
        </table>
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

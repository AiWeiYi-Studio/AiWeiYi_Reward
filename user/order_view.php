<?php
include("../system/core/core.php");
$title='订单详情';
$id = $_GET['id'];
$url='order_view.php';
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?url=".$url."';</script>");
$row = $DB->get_row("SELECT * FROM reward_orders WHERE id='$id' limit 1");
if($udata['reward']!=='1'){
showmsg('<h2>您当前未加盟跑手功能，无法抢单！</h2>');
}
if($row['type']=='1'){$type='帮我送货';}elseif($row['type']=='2'){$type='帮我取货';}elseif($row['type']=='3'){$type='帮取快递';}elseif($row['type']=='4'){$type='帮我买餐';}
if($row['money1']=='' || $row['money1']==NULL){$money1='无需或未知';}else{$money1=$row['money1'];}
if($row['money2']=='' || $row['money2']==NULL){$money2='无红包';}else{$money2=$row['money2'];}
?>
<style> 
a.test
{
word-break:break-all;
}
</style>

  <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
          
<div class="card">
<div class="card-header">
<h4>订单详情</h4>
</div>
<div class="card-body">

<div class="alert alert-success" role="alert">订单ID：<font color="black"><?php echo $row['id'];?></font></div>
<div class="alert alert-danger" role="alert">订单类型：<font color="black"><?php echo $type;?></font></div>
<div class="alert alert-warning" role="alert">备注要求：<a class="test"><?php echo $row['text'] ?></a></div>

<div class="text-center">
<a href="./order_list.php" class="btn btn-w-md btn-round btn-warning">返回抢单</a>
<a href="./order_ok.php?id=<?php echo $id;?>" class="btn btn-w-md btn-round btn-danger">确定接单</a>
</div>
            
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
<?php
require_once("../core/core.php");
require_once("epay.config.php");
require_once("lib/epay_notify.class.php");
?>
<?php
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码
	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

	//商户订单号

	$out_trade_no = $_GET['out_trade_no'];

	//支付宝交易号

	$trade_no = $_GET['trade_no'];

	//交易状态
	$trade_status = $_GET['trade_status'];

	//支付方式
	$type = $_GET['type'];


    if($_GET['trade_status'] == 'TRADE_SUCCESS') {
		//判断该笔订单是否在商户网站中已经做过处理
		//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
		//如果有做过处理，不执行商户的业务程序
    }else {
      echo "trade_status=".$_GET['trade_status'];
    }
    $row = $DB->get_row("SELECT * FROM reward_pay WHERE trade_no='$out_trade_no' limit 1");
    $sql="update reward_user set money=money+'".$row['money']."' where uid='".$row['user']."'";
    $sqls="update reward_pay set status='1' where trade_no='$out_trade_no'";
    if($DB->query($sql) && $DB->query($sqls)){
    echo '<meta charset="utf-8"/><script>alert("用户金额充值成功");window.location.href="'.$row['domain'].'";</script>';
    }else{
    echo '<meta charset="utf-8"/><script>alert("用户金额充值失败");window.location.href="'.$row['domain'].'";</script>';
    }
	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
}else {
    //验证失败
    //如要调试，请看alipay_notify.php页面的verifyReturn函数
    echo "验证成功失败";
}
?>
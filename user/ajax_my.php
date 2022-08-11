<?php
include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
if($islogins==1){}else exit('{"code":-1,"msg":"你还没有登录"}');
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    
case 'my_edit':
    $user=$_POST['user'];
    $ip=$_POST['ip'];
    $name=$_POST['name'];
    $qq=$_POST['qq'];
    $mail=$_POST['mail'];
    $phone=$_POST['phone'];
    $sql="update reward_user set user='$user',client_ip='$ip',name='$name',qq='$qq',mail='$mail',phone='$phone' where user='{$udata['user']}'";
    if($DB->query($sql)){
    $city=get_ip_city($clientip);
	$DB->query("insert into `reward_user_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改个人信息','".$date."')");
		exit('{"code":1,"msg":"修改成功"}');
	}else{
        exit('{"code":-1,"msg":"修改失败'.$DB->error().'}');
	}
break;

case 'my_chongzhi':
    $money = $_POST['money'];
    $type = $_POST['type'];
    $trade_no = get_trade_no();
    $domain = $siteurl.'my_money.php?mod=chongzhi';
    $city=get_ip_city($clientip);
    $sql="insert into `reward_pay` (`trade_no`,`type`,`addtime`,`name`,`money`,`ip`,`city`,`user`,`domain`,`status`) values ('".$trade_no."','".$type."','".$date."','".$conf['site_title']."在线充值余额','".$money."','".$clientip."','".$city."','".$udata['uid']."','".$domain."','0')";
    if(!$money){
        exit('{"code":-1,"msg":"金额不能为空"}');
    }elseif($money<$conf['pay_money_little'] && $conf['pay_money_little']!=='' && $conf['pay_money_LITTLE']!==NULL){
        exit('{"code":-1,"msg":"充值金额低于最低充值"}');
    }elseif($money>$conf['pay_money_big'] && $conf['pay_money_big']!=='' && $conf['pay_money_big']!==NULL){
        exit('{"code":-1,"msg":"充值金额大于最高充值"}');
    }elseif(!$type){
        exit('{"code":-1,"msg":"支付方式不能为空"}');
    }elseif($DB->query($sql)){
        $city=get_ip_city($clientip);
	    $DB->query("insert into `reward_user_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$udata['uid']."','".$clientip."','".$city."','充值','创建充值订单：".$trade_no."','".$date."')");
		exit('{"code":1,"msg":"创建充值订单成功","trade_no":"'.$trade_no.'"}');
	}else{
        exit('{"code":-1,"msg":"创建充值订单失败'.$DB->error().'}');
	}
break;

case 'my_edit_token':
    $token = get_token();
    $sql="update reward_user set token='$token' where user='{$udata['user']}'";
    if($DB->query($sql)){
        $city=get_ip_city($clientip);
	    $DB->query("insert into `reward_user_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改个人专属TOKEN为 ‘".$token."’','".$date."')");
		exit('{"code":1,"msg":"修改成功"}');
	}else{
        exit('{"code":-1,"msg":"修改失败'.$DB->error().'}');
	}
break;

default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}
?>
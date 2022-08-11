<?php
include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    
case 'qq_jiebang':
	$sql="update reward_user set qq_token='' where user='{$udata['user']}'";
	if($islogins!==1){
	exit('{"code":-1,"msg":"您还未登录"}');
    }elseif(!$udata['qq_token']){
	exit('{"code":-1,"msg":"未绑定"}');
	}elseif($DB->query($sql)){
	$city=get_ip_city($clientip);
	$DB->query("insert into `reward_user_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$udata['uid']."','".$clientip."','".$city."','解绑','解绑QQ快捷登录','".$date."')");
	exit('{"code":1,"msg":"解绑成功"}');
	}else{
	exit('{"code":-1,"msg":"解绑失败'.$DB->error().'}');
	}
break;

case 'login':
	$user=daddslashes($_POST['user']);
	$pass=daddslashes($_POST['pass']);
	$row = $DB->get_row("SELECT * FROM reward_user WHERE user='$user' limit 1");
	if($user == ''){
	exit('{"code":-1,"msg":"用户名为空"}');
	}elseif($pass == ''){
	exit('{"code":-1,"msg":"密码为空"}');
	}elseif (!$row['user']) {
	exit('{"code":-1,"msg":"用户不存在"}');
	}elseif($islogins==1){
	exit('{"code":1,"msg":"你已登录过系统"}');
    }elseif ($pass != $row['pass']) {
	exit('{"code":-1,"msg":"用户名或密码不正确"}');
	}elseif($row['user']==$user && $row['pass']==$pass){
	$city=get_ip_city($clientip);
	$DB->query("insert into `reward_user_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$row['uid']."','".$clientip."','".$city."','登陆','登录用户后台','".$date."')");
	$session=md5($user.$pass.$password_hash);
	$token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
	setcookie("token_user", $token, time() + 604800);
	exit('{"code":1,"msg":"登录成功"}');
	}
break;

case 'logout':
    if($islogins==1){
    $city=get_ip_city($clientip);
	$DB->query("insert into `reward_user_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$udata['uid']."','".$clientip."','".$city."','退出','注销用户后台登录','".$date."')");
    setcookie("token_user", "", time() - 604800);
	exit('{"code":1,"msg":"注销成功"}');
    }else{
    exit('{"code":-1,"msg":"注销失败"}');
    }
break;

default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}
?>
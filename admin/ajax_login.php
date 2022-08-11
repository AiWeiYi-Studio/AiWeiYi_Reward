<?php
include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    
case 'login':
    if(isset($_POST['user']) && isset($_POST['pass'])){
	$user=daddslashes($_POST['user']);
	$pass=daddslashes($_POST['pass']);
	$ip=$clientip;
	$sql="update reward_users set login_time='$date',login_ip='$ip' where user='{$user}'";
	$row = $DB->get_row("SELECT * FROM reward_users WHERE user='$user' limit 1");
	if($pass !== $row['pass']) {
	exit('{"code":-1,"msg":"用户名或密码不正确"}');
	}elseif($row['active_ip']=='1' && $ip!=$row['client_ip']) {
	exit('{"code":-1,"msg":"IP'.$ip.'不在白名单"}');
	}elseif($islogin==1){
	exit('{"code":1,"msg":"你已登录过系统"}');
    }elseif($row['user']==$user && $row['pass']==$pass){
    $city=get_ip_city($clientip);
    $DB->query("insert into `reward_users_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$row['uid']."','".$clientip."','".$city."','登录','登录站长后台','".$date."')");
    $DB->query($sql);
	$session=md5($user.$pass.$password_hash);
	$token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
	setcookie("token_users", $token, time() + 604800);
	exit('{"code":1,"msg":"登录成功"}');
	}else{
	exit('{"code":-1,"msg":"登录失败');
	}
}
break;

case 'logout':
    if($islogin!==1){
    exit('{"code":-1,"msg":"您还未登录"}');
    }elseif($islogin==1){
    $city=get_ip_city($clientip);
    $DB->query("insert into `reward_users_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$udata['uid']."','".$clientip."','".$city."','注销','自动注销登录','".$date."')");
    setcookie("token_users", "", time() - 604800);
	exit('{"code":1,"msg":"注销成功"}');
    }else{
    exit('{"code":-1,"msg":"注销失败"}');
    }
break;

case 'qq_jiebang':
	$sql="update reward_users set qq_token='' where user='{$udata['user']}'";
	if($islogin!==1){
	exit('{"code":-1,"msg":"您还未登录"}');
    }elseif(!$udata['qq_token']){
	exit('{"code":-1,"msg":"未绑定"}');
	}elseif($DB->query($sql)){
	$city=get_ip_city($clientip);
    $DB->query("insert into `reward_users_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$udata['uid']."','".$clientip."','".$city."','解绑','解绑QQ快捷登录','".$date."')");
	exit('{"code":1,"msg":"解绑成功"}');
	}else{
	exit('{"code":-1,"msg":"解绑失败'.$DB->error().'}');
	}
break;

default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}
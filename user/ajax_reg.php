<?php
include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    
case 'qq_reg':
{
	exit('{"code":-1,"msg":"注册失败'.$DB->error().'}');
	}
break;

case 'reg':
	$user=daddslashes($_POST['user']);
    $pass=daddslashes($_POST['pass']);
    $name=daddslashes($_POST['name']);
    $qq = daddslashes($_POST['qq']);
    $city=get_ip_city($clientip);
    $avatar = 'https://q1.qlogo.cn/g?b=qq&nk='.$qq.'&s=640';
    $sql="insert into `reward_user` (`user`,`pass`,`name`,`qq`,`reg_time`,`reg_ip`,`reg_city`,`client_ip`,`money`,`integral`,`mail_time`,`iphone_time`,`active`,`active_ip`,`avatar`) values ('".$user."','".$pass."','".$name."','".$qq."','".$date."','".$clientip."', '".$city."','".$clientip."','0','0','0','0','1','0','".$avatar."')";
    $row = $DB->get_row("SELECT * FROM reward_user WHERE user='$user' limit 1");
    $rows = $DB->get_row("SELECT * FROM reward_user WHERE qq='$qq' limit 1");
    if($islogins==1){
	exit('{"code":1,"msg":"您已登陆"}');
	}elseif ($user == $row['user']) {
	exit('{"code":-1,"msg":"用户名已存在"}');
    }elseif ($qq == $rows['qq']) {
	exit('{"code":-1,"msg":"QQ已存在"}');
    }elseif ($user == $pass) {
	exit('{"code":-1,"msg":"用户名与密码相同"}');
    }elseif($DB->query($sql)){
	$session=md5($user.$pass.$password_hash);
	$token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
	setcookie("token_user", $token, time() + 604800);
	exit('{"code":1,"msg":"注册用户成功"}');
	$city=get_ip_city($clientip);
	}else{
	exit('{"code":-1,"msg":"注册用户失败！'.$DB->error().'"}');
	}
break;

default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}
?>
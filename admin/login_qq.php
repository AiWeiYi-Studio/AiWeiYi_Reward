<?php
$title='QQ登录';
include("../system/core/core.php");
$token = $_GET['openid'];
$url = $siteurl.'login_qq.php';
if(!$token){
header('location: ../api/qq_auth.php?url='.$url.'');
}else{
$row = $DB->get_row("SELECT * FROM website_users WHERE qq_token='$token' limit 1");
$user = $row['user'];
$pass = $row['pass'];
if($row['qq_token']){
	$session=md5($user.$pass.$password_hash);
	$token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
	setcookie("token_users", $token, time() + 604800);
	exit("<script language='javascript'>alert('QQ快捷登录成功');window.location.href='./';</script>");
	}
}
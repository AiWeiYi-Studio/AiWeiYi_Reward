<?php
if(!defined('IN_CRONLITE'))exit();

$clientip=real_ip();

if(isset($_COOKIE["token_users"])){
    $token=authcode(daddslashes($_COOKIE['token_users']), 'DECODE', SYS_KEY);
    list($user, $sid) = explode("\t", $token);
    $udata = $DB->get_row("SELECT * FROM reward_users WHERE user='$user' limit 1");
    $session=md5($udata['user'].$udata['pass'].$password_hash);
	if($session==$sid){
		$islogin=1;
	}
}

if(isset($_COOKIE["token_user"])){
    $token=authcode(daddslashes($_COOKIE['token_user']), 'DECODE', SYS_KEY);
    list($user, $sid) = explode("\t", $token);
    $udata = $DB->get_row("SELECT * FROM reward_user WHERE user='$user' limit 1");
    $session=md5($udata['user'].$udata['pass'].$password_hash);
	if($session==$sid){
      	$DB->query("UPDATE reward_user SET logintime='$date' WHERE user='$user'");
		$islogins=1;
	}
}
?>
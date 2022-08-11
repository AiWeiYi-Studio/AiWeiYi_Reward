<?php 
include("../system/core/core.php");
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$token = $_GET['openid'];
$url = $siteurl.'login_qqbd.php';
if(!$token){
header('location: ../api/oauth/qq/api.php?url='.$url.'');
}else{
$sql="update website_users set qq_token='$token' where user='{$udata['user']}'";
if($DB->query($sql)){
    exit("<script language='javascript'>alert('绑定QQ快捷登录成功');window.location.href='./';</script>");
	}else{
	exit("<script language='javascript'>alert('绑定QQ快捷登录失败');window.location.href='./';</script>");
	}
}
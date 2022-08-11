<?php
include("../system/core/core.php");
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
    }
$allapi ='http://api.cccyun.cc/';
class Oauth{
    function __construct(){
        global $siteurl;
        global $conf;
        $this->callback = $siteurl.'login_qqsign.php';//登录回调地址
    }
    public function login(){
        global $allapi;
        $state = md5(uniqid(rand(), TRUE));
        $_SESSION['Oauth_state'] = $state;
        $keysArr = array("act" => "login","media_type" => $_GET['type'],"redirect_uri" => $this->callback,"state" => $state);
        $login_url = $allapi.'social/connect.php?'.http_build_query($keysArr);
        header("Location:$login_url");
    }
    public function callback(){
        global $allapi;
        //--------验证state防止CSRF攻击
        if($_GET['state'] != $_SESSION['Oauth_state']){
            sysmsg("状态不匹配。你可能是csrf的受害者。",2,'./login.php',true);
        }
        $keysArr = array("act" => "callback","code" => $_GET['code'],"redirect_uri" => $this->callback);
        $token_url = $allapi.'/social/connect.php?'.http_build_query($keysArr);
        $response = get_curl($token_url);
        $arr = json_decode($response,true);
        if(isset($arr['error_code'])){
            sysmsg("error:".$arr['error_code']."msg:".$arr['error_msg'],2,'./login.php',true);
        }
        $_SESSION['Oauth_access_token']=$arr["access_token"];
        $_SESSION['Oauth_social_uid']=$arr["social_uid"];
        return $arr;
    }
}
$Oauth = new Oauth();
header("Content-Type: text/html; charset=UTF-8");
if($_GET['code']){
    $array = $Oauth->callback();
    $media_type = $array['media_type'];
    $access_token = $array['access_token'];
    $social_uid = $array['social_uid'];
    $nickname = $array['nickname'];
    $row = $DB->get_row("SELECT * FROM reward_user WHERE qq_token='$access_token' limit 1");
    if(!$row['qq_token']) {
    exit("<script language='javascript'>alert('登录失败：当前QQ未绑定账号');window.location.href='./login_qqreg.php?token=".$access_token."';</script>");
    }elseif($row['active']==0){
    exit("<script language='javascript'>alert('登录失败：当前账号已被冻结');window.location.href='./login_index.php';</script>");
    }elseif($row['qq_token']==$access_token){
    $user=daddslashes($row['user']);
	$pass=daddslashes($row['pass']);
    $city=get_ip_city($clientip);
	$DB->query("insert into `reward_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$row['uid']."','".$clientip."','".$city."','登陆','登录用户后台','".$date."','user')");
	$session=md5($user.$pass.$password_hash);
	$token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
	setcookie("token_user", $token, time() + 604800);
	exit("<script language='javascript'>alert('登录成功：欢迎回家！');window.location.href='./index.php';</script>");
    }
}else{
    $Oauth->login();
}
?>
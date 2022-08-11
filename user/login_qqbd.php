<?php 
include("../system/core/core.php");
$allapi ='http://api.cccyun.cc/';
class Oauth{
    function __construct(){
        global $siteurl;
        global $conf;
        $this->callback = $siteurl.'login_qqbd.php';//登录回调地址
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
        if($_GET['state'] !== $_SESSION['Oauth_state']){
            sysmsg("状态不匹配。你可能是csrf的受害者。",2,'./',true);
        }
        $keysArr = array("act" => "callback","code" => $_GET['code'],"redirect_uri" => $this->callback);
        $token_url = $allapi.'/social/connect.php?'.http_build_query($keysArr);
        $response = get_curl($token_url);
        $arr = json_decode($response,true);
        if(isset($arr['error_code'])){
            sysmsg("error:".$arr['error_code']."msg:".$arr['error_msg'],2,'./',true);
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
    if($row['qq_token']==$access_token) {
    exit("<script language='javascript'>alert('绑定失败：当前QQ已被其他用户绑定');window.location.href='./my_info.php';</script>");
    }else{
    $DB->query("update `reward_user` set `qq_token` ='".$access_token."' where `uid`='".$udata['uid']."'");
    exit("<script language='javascript'>alert('绑定成功：当前QQ已跟当前账号绑定');window.location.href='./my_oauth.php';</script>");
    }
}else{
    $Oauth->login();
}
<?php
include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
if($islogin==1){}else exit('{"code":-1,"msg":"你还没有登录"}');
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    
case 'orders_add':
	$text=daddslashes($_POST['text']);
	$active=daddslashes($_POST['active']);
	$sql="insert into `reward_orders` (`text`,`add`,`user`,`active`) values ('".$text."','".$date."','".$udata['uid']."','".$active."')";
	if($DB->query($sql)){
	$city=get_ip_city($clientip);
    $DB->query("insert into `reward_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','添加','发布跑腿订单成功','admin')");
	exit('{"code":1,"msg":"发布成功"}');
	}else{
	exit('{"code":-1,"msg":"发布失败'.$DB->error().'"}');
	}
break;
    
case 'send_mail':
    $mail_user=($conf['mail_recv'] ? $conf['mail_recv'] : $conf['mail_name']);
    $mail_title = '邮件发送测试。';
    $mail_text = '这是一封测试邮件！<br/><br/>来自：'.$siteurl;
    if (!empty($mail_user)) {
        $text = send_mail_view($mail_title,$mail_text);
        $result=send_mail($mail_user,$mail_title,$text);
        if ($result==1) {
            exit('{"code":1,"msg":"邮件发送成功！"}');
        } else {
            exit('{"code":-1,"msg":"邮件发送失败！"}');
        }
    } else {
        exit('{"code":-1,"msg":"您还未设置邮箱！"}');
    }
break;

case 'set_shop':
    $money1 = $_POST['money1'];
    $money2 = $_POST['money2']; 
    $active = $_POST['active'];
	saveSetting('shop_reward_money',$money1);
	saveSetting('shop_chat_money',$money2);
	saveSetting('shop_active',$active);
	$ad=$CACHE->clear();
    if($ad){
    $city=get_ip_city($clientip);
    $DB->query("insert into `reward_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改商城商品价格','".$date."','admin')");
	exit('{"code":1,"msg":"修改成功"}');
	}else{
    exit('{"code":-1,"msg":"修改失败'.$DB->error().'}');
	}
break;

case 'set_mail':
    $mail_smtp = $_POST['mail_smtp'];
    $mail_port = $_POST['mail_port']; 
    $mail_name = $_POST['mail_name'];
    $mail_pwd = $_POST['mail_pwd'];
    $mail_recv = $_POST['mail_recv'];
    $mail_view = $_POST['mail_view'];
    $mail_user = $_POST['mail_user'];
    $mail_encrypt = $_POST['mail_encrypt'];
	saveSetting('mail_smtp',$mail_smtp);
	saveSetting('mail_port',$mail_port);
	saveSetting('mail_name',$mail_name);
	saveSetting('mail_pwd',$mail_pwd);
	saveSetting('mail_recv',$mail_recv);
	saveSetting('mail_view',$mail_view);
	saveSetting('mail_user',$mail_user);
	saveSetting('mail_encrypt',$mail_encrypt);
	$ad=$CACHE->clear();
    if($ad){
    $city=get_ip_city($clientip);
    $DB->query("insert into `reward_users_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改邮箱发信配置','".$date."')");
	exit('{"code":1,"msg":"修改成功"}');
	}else{
    exit('{"code":-1,"msg":"修改失败'.$DB->error().'}');
	}
break;

case 'set_qqoauth':
    $appid = $_POST['appid'];
    $appkey = $_POST['appkey'];
    $callback = $_POST['callback'];
	saveSetting('oauth_qq_appid',$appid);
	saveSetting('oauth_qq_appkey',$appkey);
	saveSetting('oauth_qq_callback',$callback);
	$ad=$CACHE->clear();
	if($appid==null){
	exit('{"code":-1,"msg":"APPID为空"}');
	}elseif($appkey==null){
    exit('{"code":-1,"msg":"APPID为空"}');
	}elseif($callback==null){
    exit('{"code":-1,"msg":"CALLBACK为空"}');
	}elseif($ad){
	$city=get_ip_city($clientip);
    $DB->query("insert into `reward_users_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改QQ快捷登录信息：APPID：".$appid."，APPKEY：".$appkey."，CALLBACK：".$callback."','".$date."')");
	exit('{"code":1,"msg":"修改成功"}');
	}else{
    exit('{"code":-1,"msg":"修改失败'.$DB->error().'}');
	}
break;

case 'set_chat_user':
    $chat_user_word = $_POST['chat_user_word'];
    $chat_user_active = $_POST['chat_user_active'];
	saveSetting('chat_user_word',$chat_user_word);
	saveSetting('chat_user_active',$chat_user_active);
	$ad=$CACHE->clear();
	if($ad){
	$city=get_ip_city($clientip);
    $DB->query("insert into `reward_users_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改用户聊天室配置','".$date."')");
	exit('{"code":1,"msg":"修改成功"}');
	}else{
    exit('{"code":-1,"msg":"修改失败'.$DB->error().'}');
	}
break;

case 'set_notice':
    $site_notice = $_POST['site_notice'];
    $site_active_notice = $_POST['site_active_notice'];
    $pay_notice = $_POST['pay_notice'];
    $chat_user_notice = $_POST['chat_user_notice'];
    $chat_user_active_notice = $_POST['chat_user_active_notice'];
    saveSetting('site_notice',$site_notice);
	saveSetting('site_active_notice',$site_active_notice);
	saveSetting('pay_notice',$pay_notice);
	saveSetting('chat_user_notice',$chat_user_notice);
	saveSetting('chat_user_active_notice',$chat_user_active_notice);
	$ad=$CACHE->clear();
	if($ad){
	$city=get_ip_city($clientip);
    $DB->query("insert into `reward_users_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改网站公告','".$date."')");
	exit('{"code":1,"msg":"修改成功"}');
	}else{
    exit('{"code":-1,"msg":"修改失败'.$DB->error().'}');
	}
break;

case 'set_site':
	saveSetting('site_title',$_POST['site_title']);
	saveSetting('site_keywords',$_POST['site_keywords']);
	saveSetting('site_description',$_POST['site_description']);
	saveSetting('site_jump',$_POST['site_jump']);
	saveSetting('site_active',$_POST['site_active']);
	saveSetting('site_qq',$_POST['site_qq']);
	saveSetting('site_mail',$_POST['site_mail']);
	saveSetting('site_phone',$_POST['site_phone']);
	saveSetting('site_beian',$_POST['site_beian']);
	saveSetting('site_copyright',$_POST['site_copyright']);
	$ad=$CACHE->clear();
	if($ad){
	$city=get_ip_city($clientip);
    $DB->query("insert into `reward_users_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改网站信息','".$date."')");
	exit('{"code":1,"msg":"修改成功"}');
	}else{
    exit('{"code":-1,"msg":"修改失败'.$DB->error().'}');
	}
break;

case 'set_pay':
	$api = $_POST['api'];
	$url = $_POST['url'];
	$pid = $_POST['pid'];
	$key = $_POST['key'];
    $little = $_POST['little'];
    $big = $_POST['big'];
	saveSetting('pay_epay_api',$api);
	saveSetting('pay_epay_url',$url);
	saveSetting('pay_epay_pid',$pid);
	saveSetting('pay_epay_key',$key);
	saveSetting('pay_money_little',$little);
	saveSetting('pay_money_big',$big);
	$ad=$CACHE->clear();
	if($ad){
	$city=get_ip_city($clientip);
    $DB->query("insert into `reward_users_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改支付接口','".$date."')");
	exit('{"code":1,"msg":"修改成功"}');
	}else{
    exit('{"code":-1,"msg":"修改失败'.$DB->error().'}');
	}
break;

case 'set_epay':
	$account = $_POST['account'];
	$username = $_POST['username'];
    $data=get_curl(pay_api().'api.php?act=change&pid='.$conf['pay_epay_pid'].'&key='.$conf['pay_epay_key'].'&account='.$account.'&username='.$username.'&url='.$_SERVER['HTTP_HOST']);
    $arr=json_decode($data,true);
	if($arr['code']==1){
	$city=get_ip_city($clientip);
    $DB->query("insert into `reward_users_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改支付接口提现信息','".$date."')");
	exit('{"code":1,"msg":"修改成功"}');
	}else{
    exit('{"code":-1,"msg":"'.$arr['msg'].'"}');
	}
break;

case 'huancun':
    $city=get_ip_city($clientip);
    $DB->query("insert into `reward_users_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$udata['uid']."','".$clientip."','".$city."','清除','清除系统缓存','".$date."')");
	exit('{"code":1,"msg":"无意义操作"}');
break;

default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}
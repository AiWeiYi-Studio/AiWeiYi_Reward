<?php
include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
if($islogins==1){}else exit('{"code":-1,"msg":"你还没有登录"}');
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    
case 'shop_chat':
    $city=get_ip_city($clientip);
	$money=$udata['money']-$conf['shop_reward_money'];
	if($money<0){
	exit('{"code":-1,"msg":"购买失败：余额不足"}'); 
	}elseif($udata['active_chat']=='1'){
	exit('{"code":-1,"msg":"购买失败：未被禁言"}'); 
	}elseif($money>=0){
	$DB->query("update reward_user set active_chat='1',money='$money' where uid='{$udata['uid']}'");
    $DB->query("insert into `reward_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user1`) values ('".$udata['uid']."','".$clientip."','".$city."','购买','购买商品“加盟跑手”成功','admin')");
	exit('{"code":1,"msg":"购买成功：余额 '.$money.' 元"}');
	}
break;
    
case 'shop_reward':
    $city=get_ip_city($clientip);
	$money=$udata['money']-$conf['shop_reward_money'];
	if($money<0){
	exit('{"code":-1,"msg":"购买失败：余额不足"}'); 
	}elseif($udata['reward']=='1'){
	exit('{"code":-1,"msg":"购买失败：已是跑手"}'); 
	}elseif($money>=0){
	$DB->query("update reward_user set reward='1',money='$money' where uid='{$udata['uid']}'");
    $DB->query("insert into `reward_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user1`) values ('".$udata['uid']."','".$clientip."','".$city."','购买','购买商品“加盟跑手”成功','admin')");
	exit('{"code":1,"msg":"购买成功：余额 '.$money.' 元"}');
	}
break;
    
case 'orders_add':
	$type=daddslashes($_POST['type']);
	$place1=daddslashes($_POST['place1']);
	$place2=daddslashes($_POST['place2']);
	$phone1=daddslashes($_POST['phone1']);
	$phone2=daddslashes($_POST['phone2']);
	$text=daddslashes($_POST['text']);
	$money1=daddslashes($_POST['money1']);
	$money2=daddslashes($_POST['money2']);
	$sql="insert into `reward_orders` (`type`,`place1`,`place2`,`phone1`,`phone2`,`text`,`money1`,`money2`,`add`,`user`,`active`,`actives`) values ('".$type."','".$place1."','".$place2."','".$phone1."','".$phone2."','".$text."','".$money1."','".$money2."','".$date."','".$udata['uid']."','0','0')";
	if($DB->query($sql)){
	$city=get_ip_city($clientip);
    $DB->query("insert into `reward_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','添加','发布跑腿订单成功','admin')");
	exit('{"code":1,"msg":"发布成功"}');
	}else{
	exit('{"code":-1,"msg":"发布失败'.$DB->error().'"}');
	}
break;

case 'send_message':
    $colour=daddslashes($_POST['colour']);
    $message=daddslashes($_POST['message']);
    $city=get_ip_city($clientip);
    $sql="insert into `reward_user_chat` (`colour`,`addtime`,`message`,`ip`,`city`,`user`,`active`) values ('".$colour."','".$date."','".$message."','".$clientip."','".$city."','".$udata['uid']."','1')";
    if(in_array($message,explode(",",$conf['chat_user_word']))){
    $DB->query("update reward_user set active_chat='0' where uid='{$udata['uid']}'");
    exit('{"code":1,"msg":"发言存在违规，已被拉黑"}');
    }elseif($conf['chat_user_active']=='0'){
    exit('{"code":-1,"msg":"聊天功能已关闭"}');
    }elseif($DB->query($sql)){
    $city=get_ip_city($clientip);
	$DB->query("insert into `reward_user_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$udata['uid']."','".$clientip."','".$city."','发言','聊天室发言：".$message."','".$date."')");
	exit('{"code":1,"msg":"发送成功"}');
	}else{
	exit('{"code":-1,"msg":"发送失败！'.$DB->error().'"}');
	}
break;

default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}
?>
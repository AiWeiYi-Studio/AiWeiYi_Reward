<?php
include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
if($islogin==1){}else exit('{"code":-1,"msg":"你还没有登录"}');
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    
case 'my_avatars':
    $avatar=$_POST['avatar'];
    $sql="update reward_users set avatar='".$avatar."' where uid='{$udata['uid']}'";
    if($avatar==null){
        exit('{"code":-1,"msg":"自定义头像外链为空"}');
	}elseif($DB->query($sql)){
	$city=get_ip_city($clientip);
    $DB->query("insert into `reward_users_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改个人头像','".$date."')");
		exit('{"code":1,"msg":"修改成功"}');
	}else{
        exit('{"code":-1,"msg":"修改失败'.$DB->error().'}');
	}
break;
    
case 'my_avatar':
    if($_POST['do']=='upload'){
        $filename = $_FILES['file']['name'];
        $ext = substr($filename, strripos($filename, '.') + 1);
        $arr = array('png', 'jpg', 'gif', 'jpeg', 'webp', 'bmp');
        $row = $DB->get_row("SELECT * FROM reward_users WHERE uid='".$udata['uid']."' limit 1");//获取用户数据
        $sql="update reward_users set avatar_number=avatar_number+'1' where uid='{$udata['uid']}'";//更新用户头像总数
        $s = $row['avatar_number']+1;
        $filename = $s.'.png';
        $fileurl = ROOT.'file/admin/avatar/'.$udata['uid'].'/'.$filename;
        $fileurls = 'file/admin/avatar/'.$udata['uid'].'/'.$filename;
        $sqls="update reward_users set avatar='".$siteurls.$fileurls."' where uid='{$udata['uid']}'";//更新用户头像总数
        if (!in_array($ext , $arr)) {
            exit('{"code":-1,"msg":"只支持上传图片文件"}');
        }elseif(!$DB->query($sql)){
        exit('{"code":-1,"msg":"用户头像总数记录失败'.'"}');
        }elseif(!$DB->query($sqls)){
        exit('{"code":-1,"msg":"用户头像更新失败'.'"}');
        }elseif(copy($_FILES['file']['tmp_name'], $fileurl)){
            exit('{"code":1,"msg":"头像上传成功，已更新数据"}');
        }else{
            exit('{"code":-1,"msg":"请确保有本地写入权限'.'"}');
        }
    }
break;
    
case 'my_edit':
    $uid=$udata['uid'];
    $user=$_POST['user'];
    $ip=$_POST['ip'];
    $name=$_POST['name'];
    $qq=$_POST['qq'];
    $mail=$_POST['mail'];
    $phone=$_POST['phone'];
    $sql="update reward_users set user='$user',client_ip='$ip',name='$name',qq='$qq',mail='$mail',phone='$phone' where uid='{$uid}'";
    if($user==null){
        exit('{"code":-1,"msg":"用户名为空"}');
	}elseif($ip==null){
        exit('{"code":-1,"msg":"IP为空"}');
	}elseif($name==null){
        exit('{"code":-1,"msg":"昵称为空"}');
	}elseif($qq==null){
        exit('{"code":-1,"msg":"QQ为空"}');
	}elseif($mail==null){
        exit('{"code":-1,"msg":"邮箱为空"}');
	}elseif($phone==null){
        exit('{"code":-1,"msg":"手机号为空"}');
	}elseif($DB->query($sql)){
	$city=get_ip_city($clientip);
    $DB->query("insert into `reward_users_log` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改个人资料','".$date."')");
		exit('{"code":1,"msg":"修改成功"}');
	}else{
        exit('{"code":-1,"msg":"修改失败'.$DB->error().'}');
	}
break;

default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}
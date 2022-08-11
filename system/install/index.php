<?php
error_reporting(0);
session_start();
@header('Content-Type: text/html; charset=UTF-8');
$do=isset($_GET['do'])?$_GET['do']:'0';
if(file_exists('install.lock')){
	$installed=true;
	$do='0';
}

function checkfunc($f,$m = false) {
	if (function_exists($f)) {
	    return '<font color="green">可用</font>';
	} else {
		if ($m == false) {
			return '<font color="black">不支持</font>';
		} else {
			return '<font color="red">不支持</font>';
		}
	}
}
function checkclass($f,$m = false) {
	if (class_exists($f)) {
		return '<font color="green">可用</font>';
		$checkclass = 1;
	} else {
		if ($m == false) {
			return '<font color="black">不支持</font>';
		} else {
			return '<font color="red">不支持</font>';
		}
	}
}
function random($length, $numeric = 0)
{
	$seed = base_convert(md5(microtime() . $_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
	$seed = $numeric ? str_replace('0', '', $seed) . '012340567890' : $seed . 'zZ' . strtoupper($seed);
	$hash = '';
	$max = strlen($seed) - 1;
	for ($i = 0; $i < $length; $i++) {
		$hash .= $seed[mt_rand(0, $max)];
	}
	return $hash;
}
function deldir($dir){
  if(!is_dir($dir))return false;
  $dh=opendir($dir);
  while ($file=readdir($dh)) {
    if($file!="." && $file!="..") {
      $fullpath=$dir."/".$file;
      if(!is_dir($fullpath)) {
          unlink($fullpath);
      } else {
          deldir($fullpath);
      }
    }
  }
  closedir($dh);
  if(rmdir($dir)) {
    return true;
  } else {
    return false;
  }
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title>爱唯逸网络科技</title>
<link rel="icon" href="../../assets/System/icon/favicon.ico" type="image/ico">
<meta name="author" content="AiWeiYi_Studio">
<link href="../../assets/LightYear/css/bootstrap.min.css" rel="stylesheet">
<link href="../../assets/LightYear/css/materialdesignicons.min.css" rel="stylesheet">
<link href="../../assets/LightYear/css/style.min.css" rel="stylesheet">
</head>
  
<body>
  
<div class="container" style="padding-top:60px;">

<?php if($do=='0'){
$_SESSION['checksession']=1;
?>
    <div class="card">
      <div class="panel panel-primary">
        <div class="card-header"><h4>爱唯逸网络科技</h4></div>
          <div class="card-body">
              
		<p><iframe src="./agreement.html" style="width:100%;height:600px;"></iframe></p>
		
		<?php if($installed){ ?>
		<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>提示：</strong>您已经安装过，如需重新安装请删除安装锁后再安装！<a href="./tool.php">快捷删除</a>
          </div>
		<?php }else{?>
		<p><span><a class="btn btn-w-md btn-round btn-danger" href="../../">不同意</a></span>
<span style="float:right"><a class="btn btn-w-md btn-round btn-info" href="index.php?do=1" align="right">同意</a></span></p>
		<?php }?>
		</div>
	</div>
</div>

<?php }elseif($do=='1'){?>
    <div class="card">
      <div class="panel panel-primary">
        <div class="card-header"><h4>环境检查</h4></div>
          <div class="card-body">
<div class="progress progress-striped">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 10%">
	<span class="sr-only">10%</span>
  </div>
</div>
<table class="table table-striped">
	<thead>
		<tr>
			<th style="width:20%">函数检测</th>
			<th style="width:15%">需求</th>
			<th style="width:15%">当前</th>
			<th style="width:50%">用途</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>PHP 5.6+</td>
			<td>必须</td>
			<td><?php if(PHP_VERSION<'7.2'){echo '<font color="red">'.PHP_VERSION.'</font>';}else{echo '<font color="green">'.PHP_VERSION.'</font>';}?></td>
			<td>PHP版本支持</td>
		</tr>
		<tr>
			<td>curl_exec()</td>
			<td>必须</td>
			<td><?php echo checkfunc('curl_exec',true); ?></td>
			<td>抓取网页</td>
		</tr>
		<tr>
			<td>file_get_contents()</td>
			<td>必须</td>
			<td><?php echo checkfunc('file_get_contents',true); ?></td>
			<td>读取文件</td>
		</tr>
		<tr>
			<td>session</td>
			<td>必须</td>
			<td><?php echo $_SESSION['checksession']==1?'<font color="green">可用</font>':'<font color="red">不支持</font>'; ?></td>
			<td>PHP必备功能</td>
		</tr>
	</tbody>
</table>
<p><span><a class="btn btn-w-md btn-round btn-info" href="index.php">上一步</a></span>
<?php if ($_SESSION['checksession']==1 && PHP_VERSION>='7.2' && checkfunc('curl_exec',true)=='<font color="green">可用</font>' && checkfunc('file_get_contents',true)=='<font color="green">可用</font>'){
echo'<span style="float:right"><a class="btn btn-w-md btn-round btn-warning" href="index.php?do=2" align="right">下一步</a></span></p>';
}else{
echo'<span style="float:right"><a class="btn btn-w-md btn-round btn-danger" href="index.php?do=1" align="right">刷新</a></span></p>';
}?>
</div>
</div>
</div>

<?php }elseif($do=='2'){?>
    <div class="card">
      <div class="panel panel-primary">
        <div class="card-header"><h4>数据库配置</h4></div>
          <div class="card-body">
<div class="progress progress-striped">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
	<span class="sr-only">30%</span>
  </div>
</div>
	<?php
if(defined("SAE_ACCESSKEY"))
echo <<<HTML
检测到您使用的是SAE空间，支持一键安装，请点击 <a href="?do=3">下一步</a>
HTML;
else
echo <<<HTML
		<form action="?do=3" class="form-sign" method="post">
		<label for="name">数据库地址:</label>
		<input type="text" class="form-control" name="db_host" value="localhost">
		<label for="name">数据库端口:</label>
		<input type="text" class="form-control" name="db_port" value="3306">
		<label for="name">数据库用户名:</label>
		<input type="text" class="form-control" name="db_user">
		<label for="name">数据库密码:</label>
		<input type="text" class="form-control" name="db_pwd">
		<label for="name">数据库名:</label>
		<input type="text" class="form-control" name="db_name">
		<label for="name">系统密钥:</label>
		<input type="text" class="form-control" name="token">
		<br><p align="center"><input type="submit" class="btn btn-w-md btn-round btn-info" name="submit" value="保存配置"></p>
		</form><br/>
		（如果已事先填写好config.php相关数据库配置，请 <a href="?do=3&jump=1">点击此处</a> 跳过这一步！）
HTML;
?>
	    </div>
	</div>
</div>

<?php }elseif($do=='3'){
?>
    <div class="card">
      <div class="panel panel-primary">
        <div class="card-header"><h4>保存数据库</h4></div>
          <div class="card-body">
<div class="progress progress-striped">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
	<span class="sr-only">50%</span>
  </div>
</div>

<?php
require './db.class.php';
if(defined("SAE_ACCESSKEY") || $_GET['jump']==1){
	include_once '../core/config.php';
	if(!$dbconfig['user']||!$dbconfig['pwd']||!$dbconfig['dbname']) {
		echo '<div class="alert alert-danger">请先填写好数据库并保存后再安装！<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
	} else {
		if(!$con=DB::connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['dbname'],$dbconfig['port'])){
			if(DB::connect_errno()==2002)
				echo '<div class="alert alert-warning">连接数据库失败，数据库地址填写错误！</div>';
			elseif(DB::connect_errno()==1045)
				echo '<div class="alert alert-warning">连接数据库失败，数据库用户名或密码填写错误！</div>';
			elseif(DB::connect_errno()==1049)
				echo '<div class="alert alert-warning">连接数据库失败，数据库名不存在！</div>';
			else
				echo '<div class="alert alert-warning">连接数据库失败，['.DB::connect_errno().']'.DB::connect_error().'</div>';
		}else{
			echo ' <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>提示：</strong>数据库配置文件保存成功！
          </div>';
			if(DB::query("select * from reward_config where 1")==FALSE)
				echo '<p align="right"><a class="btn btn-w-md btn-round btn-info" href="?do=4">创建数据表>></a></p>';
			else
				echo '<div class="list-group-item list-group-item-info">系统检测到你已安装过</div>
				<div class="list-group-item">
					<a href="?do=7" class="btn btn-block btn-info">跳过安装</a>
				</div>
				<div class="list-group-item">
					<a href="?do=4" onclick="if(!confirm(\'全新安装将会清空所有数据，是否继续？\')){return false;}" class="btn btn-block btn-warning">强制全新安装</a>
				</div>';
		}
	}
}else{
	$db_host=isset($_POST['db_host'])?$_POST['db_host']:NULL;
	$db_port=isset($_POST['db_port'])?$_POST['db_port']:NULL;
	$db_user=isset($_POST['db_user'])?$_POST['db_user']:NULL;
	$db_pwd=isset($_POST['db_pwd'])?$_POST['db_pwd']:NULL;
	$db_name=isset($_POST['db_name'])?$_POST['db_name']:NULL;
	$token=isset($_POST['token'])?$_POST['token']:NULL;

	if($db_host==null || $db_port==null || $db_user==null || $db_pwd==null || $db_name==null || $token==null){
		echo '<div class="alert alert-danger">保存错误,请确保每项都不为空<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
	}else{
		$config="<?php
/*数据库配置*/
\$dbconfig=array(
	'host' => '{$db_host}', //数据库服务器
	'port' => {$db_port}, //数据库端口
	'user' => '{$db_user}', //数据库用户名
	'pwd' => '{$db_pwd}', //数据库密码
	'dbname' => '{$db_name}', //数据库名
);
/*系统配置*/
\$system=array(
	'token' => '{$token}', //系统密钥
);
?>";
		if(!$con=DB::connect($db_host,$db_user,$db_pwd,$db_name,$db_port)){
			if(DB::connect_errno()==2002)
				echo '<div class="alert alert-warning">连接数据库失败，数据库地址填写错误！</div>';
			elseif(DB::connect_errno()==1045)
				echo '<div class="alert alert-warning">连接数据库失败，数据库用户名或密码填写错误！</div>';
			elseif(DB::connect_errno()==1049)
				echo '<div class="alert alert-warning">连接数据库失败，数据库名不存在！</div>';
			else
				echo '<div class="alert alert-warning">连接数据库失败，['.DB::connect_errno().']'.DB::connect_error().'</div>';
		}elseif(file_put_contents('../core/config.php',$config)){
			echo '<div class="alert alert-success">数据库配置文件保存成功！</div>';
			if(DB::query("select * from reward_config where 1")==FALSE)
				echo '<p align="right"><a class="btn btn-primary btn-block" href="?do=4">创建数据表>></a></p>';
			else
				echo '<div class="list-group-item list-group-item-info">系统检测到你已安装过</div>
				<div class="list-group-item">
					<a href="?do=7" class="btn btn-block btn-info">跳过安装</a>
				</div>
				<div class="list-group-item">
					<a href="?do=4" onclick="if(!confirm(\'全新安装将会清空所有数据，是否继续？\')){return false;}" class="btn btn-block btn-warning">强制全新安装</a>
				</div>';
		}else
			echo '<div class="alert alert-danger">保存失败，请确保网站根目录有写入权限<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
	}
}
?>
        </div>
	</div>
</div>
<?php }elseif($do=='4'){?>
    <div class="card">
      <div class="panel panel-primary">
        <div class="card-header"><h4>创建数据表</h4></div>
          <div class="card-body">
<div class="progress progress-striped">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
	<span class="sr-only">70%</span>
  </div>
</div>
<?php
include_once '../core/config.php';
if(!$dbconfig['user']||!$dbconfig['pwd']||!$dbconfig['dbname']) {
	echo '<div class="alert alert-danger">请先填写好数据库并保存后再安装！<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
} else {
	require './db.class.php';
	$sql=file_get_contents("../../system/database/install/install.sql");
	$sql=explode(';',$sql);
	$cn = DB::connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['dbname'],$dbconfig['port']);
	if (!$cn) die('err:'.DB::connect_error());
	DB::query("set sql_mode = ''");
	DB::query("set names utf8");
	$t=0; $e=0; $error='';
	for($i=0;$i<count($sql);$i++) {
		if ($sql[$i]=='')continue;
		if(DB::query($sql[$i])) {
			++$t;
		} else {
			++$e;
			$error.=DB::error().'<br/>';
		}
	}
}
if($e==0) {
	echo '<div class="alert alert-success">安装成功！<br/>SQL成功'.$t.'句/失败'.$e.'句</div><p align="right"><a class="btn btn-block btn-primary" href="index.php?do=5">下一步>></a></p>';
} else {
	echo '<div class="alert alert-danger">安装失败<br/>SQL成功'.$t.'句/失败'.$e.'句<br/>错误信息：'.$error.'</div><p align="right"><a class="btn btn-block btn-primary" href="index.php?do=4">点此进行重试</a></p>';
}
?>
	</div>
</div>
<?php }elseif($do=='5'){?>
    <div class="card">
      <div class="panel panel-primary">
        <div class="card-header"><h4>网站信息配置</h4></div>
          <div class="card-body">
<div class="progress progress-striped">
<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 85%">
<span class="sr-only">85%</span>
</div>
</div>
<div class="panel-body">
<form action="?do=6" class="form-sign" method="post">
<label for="name">管理员账号:</label>
<input type="text" class="form-control" name="user" value="admin">
<label for="name">管理员密码:</label>
<input type="password" class="form-control" name="pass" maxlength="32" value="123456">
<br><input type="submit" class="btn btn-primary btn-block" name="submit" value="保存配置">
</form>
</div>
</div>
<?php }elseif($do=='6'){?>
    <div class="card">
      <div class="panel panel-primary">
        <div class="card-header"><h4>安装完成</h4></div>
          <div class="card-body">
<div class="progress progress-striped">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
	<span class="sr-only">100%</span>
  </div>
</div>
<?php
$user=isset($_POST['user'])?$_POST['user']:NULL;
$pass=isset($_POST['pass'])?$_POST['pass']:NULL;

if($user==NULL or $pass==NULL){
	echo '<div class="alert alert-danger">保存错误,请确保每项都不为空<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
}else{
	include_once './core.php';
	$date = date("Y-m-d H:i:s");
    $DB->query("insert into `reward_users` (`user`,`pass`,`reg_time`) values ('".$user."','".$pass."','".$date."')");
	@file_put_contents("install.lock",'安装锁');
	echo '<div class="alert alert-info"><font color="green">安装完成！管理账号和密码是:'.$user.'/'.$pass.'</font><br/><br/><a href="../../">>>网站首页</a>｜<a href="../../admin/">>>后台管理</a><hr/>更多设置选项请登录后台管理进行修改。<br/><br/><font color="#FF0033">如果你的空间不支持本地文件读写，请自行在install/ 目录建立 install.lock 文件！</font></div>';
}
?>
	</div>
</div>

<?php }elseif($do=='6'){ ?>
    <div class="card">
      <div class="panel panel-primary">
        <div class="card-header"><h4>安装完成</h4></div>
          <div class="card-body">
<div class="progress progress-striped">
<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
<span class="sr-only">100%</span>
</div>
</div>
<?php
	@file_put_contents("install.lock",'程序安装锁');
	echo '<div class="alert alert-info"><font color="green">安装完成！管理账号和密码是:admin/123456</font><br/><br/><a href="../../">>>网站首页</a>｜<a href="../../admin/">>>后台管理</a><hr/>更多设置选项请登录后台管理进行修改。<br/><br/><font color="#FF0033">如果你的空间不支持本地文件读写，请自行在install/ 目录建立 install.lock 文件！</font></div>';
?>
</div>
</div>
<?php }elseif($do=='7'){ ?>
    <div class="card">
      <div class="panel panel-primary">
        <div class="card-header"><h4>安装完成</h4></div>
          <div class="card-body">
<div class="progress progress-striped">
<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
<span class="sr-only">100%</span>
</div>
</div>
<?php
	@file_put_contents("install.lock",'程序安装锁');
	echo '<div class="alert alert-info"><font color="green">安装完成！管理账号和密码不改变</font><br/><br/><a href="../../">>>网站首页</a>｜<a href="../../admin/">>>后台管理</a><hr/>更多设置选项请登录后台管理进行修改。<br/><br/><font color="#FF0033">如果你的空间不支持本地文件读写，请自行在install/ 目录建立 install.lock 文件！</font></div>';
?>
</div>
</div>


<?php }?>

</div>

<script type="text/javascript" src="../../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../assets/LightYear/js/main.min.js"></script>
</body>
</html>
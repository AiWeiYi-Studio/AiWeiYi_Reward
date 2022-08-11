<?php
error_reporting(0);
define("CACHE_FILE",0);
define("IN_CRONLITE",true);
date_default_timezone_set('PRC');
define("SYSTEM_ROOT",dirname(__FILE__)."/");
define("CORE",dirname(SYSTEM_ROOT)."/");
define("ROOT",dirname(CORE)."/");
$date = date('Y-m-d H:i:s');

if(is_file(SYSTEM_ROOT."360safe/360webscan.php")){
    require_once(SYSTEM_ROOT."360safe/360webscan.php");
}

session_start();
$scriptpath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$siteurl = ($_SERVER['SERVER_PORT']==443?'https://':'http://') . $_SERVER['HTTP_HOST'].$sitepath.'/';
$siteurls = ($_SERVER['SERVER_PORT']==443?'https://':'http://') . $_SERVER['HTTP_HOST'].'/';

include_once(SYSTEM_ROOT."config.php");
if(!defined("SQLITE") && (!$dbconfig["user"] || !$dbconfig["pwd"] || !$dbconfig["dbname"])){
    echo '您还未安装，<a href="./system/install/">点此安装系统</a>';
	exit(0);
}

include_once(SYSTEM_ROOT."db.class.php");
$DB = new DB($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['dbname'],$dbconfig['port']);
if($DB->query('select * from reward_config where 1')==false){
    sysmsg('<font size="4">如果您尚未安装本程序，请<a href="../system/install/">前往安装</a></font>',true);
    exit(0);
}

include(SYSTEM_ROOT."cache.class.php");
$CACHE = new CACHE();
$conf = $CACHE->pre_fetch();

if($conf['site_jump'] == '1' && (!strpos($_SERVER['HTTP_USER_AGENT'],'QQ/') === false || !strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')===false)){
    if($_GET['open'] == 1 && !strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')===false){
        header('Content-Disposition: attachment; filename="load.doc"');
        header('Content-Type: application/vnd.ms-word;charset=utf-8');
    }else{
        header('Content-type:text/html;charset=utf-8');
    }
    require(SYSTEM_ROOT."jump.php");
    exit(0);
}

$password_hash = '!@#%!s!0';
include_once SYSTEM_ROOT."authcode.php";
define("authcode", $authcode);
include_once SYSTEM_ROOT."function.php";
include_once SYSTEM_ROOT."func.msg.php";
include_once SYSTEM_ROOT."func.get.php";
include_once SYSTEM_ROOT."func.send.php";
include_once SYSTEM_ROOT."member.php";
include_once SYSTEM_ROOT."version.php";
include_once SYSTEM_ROOT."deploy.php";

if(!file_exists(SYSTEM_ROOT."authcode.php")){
sysmsg('<h2>检测到您的站点缺少了最核心的授权码文件</h2><ul><li><font size="4">请认真检测授权码文件是否存在</font></li><li><font size="4"><b>为了程序的安全，在没有检测到授权码文件之前我们不会工作。</b></font></li></ul><br/><h4>Ps：如果检测不到它，那么我们会认为您现在使用的程序未被授权使用</h4>',true);
    exit(0);
}

if($authcode=='' || $authcode==NULL){
sysmsg('<h2>检测到您的站点缺少了最核心的授权码</h2><ul><li><font size="4">请认真检测授权码是否留空</font></li><li><font size="4"><b>为了程序的安全，在没有检测到授权码之前我们不会工作。</b></font></li></ul><br/><h4>Ps：如果检测不到它，那么我们会认为您现在使用的程序未被授权使用</h4>',true);
    exit(0);
}

if(!file_exists(CORE."install/install.lock") && file_exists(CORE."install/index.php")){
    sysmsg('<h2>检测到无 install.lock 文件</h2><ul><li><font size="4">如果您尚未安装本程序，请<a href="/system/install/">前往安装</a></font></li><li><font size="4">如果您已经安装本程序，请<a href="/system/install/tool.php">前往上锁</a></font></li><li><font size="4"><b>为了您站点安全，在您完成它之前我们不会工作。</b></font></li></ul><br/><h4>Ps：为什么必须建立 install.lock 文件？</h4>如果检测不到它，就会认为站点还没安装，此时任何人都可以安装/重装</h4>',true);
    exit(0);
}

if($conf['system_version']!==DB_VERSION && $lock!=='666'){
	header('Content-type:text/html;charset=utf-8');
	echo '请先完成网站升级！<a href="/system/update/index.php"><font color=red>点此升级</font></a>';
	exit(0);
}
/*
$check_config = file_get_contents($aiweiyi['api_url'].'/api/auth/one/check_config.php?url='.$_SERVER['HTTP_HOST'].'&authcode='.$authcode);
$check_config=json_decode($check_config,true);
if($check_config['code']!='1'){
    sysmsg('<h2>'.$check_config['code'].'系统检测到云端无法连接</h2><ul><li><font size="4">请查看系统配置是否正确</font></li><li><font size="4"><b>为了系统正确配置防止篡改破解，系统已停止运行</b></font></li></ul><br/><h4>Ps：请不要尝试篡改程序绕过授权非法使用</h4>',true);
    exit(0);
}
*/

if(!file_exists(ROOT.'Copyright_爱唯逸网络科技')) {
	@file_put_contents(ROOT.'Copyright_爱唯逸网络科技','爱唯逸网络科技版权文件切勿删除');
	sysmsg('<h2>系统检测不到版权文件</h2><ul><li><font size="4">请尊重程序版权，请勿删除版权文件</font></li><li><font size="4"><b>为了系统正确配置防止篡改破解，系统已生成版权文件，请刷新</b></font></li></ul><br/><h4>Ps：请不要尝试篡改程序非法使用，尊重程序版权</h4>',true);
}
?>
<?php
$lock='666';
require_once('../core/core.php');
@header('Content-Type: text/html; charset=UTF-8');
if(!defined("SQLITE") && (!$dbconfig["user"] || !$dbconfig["pwd"] || !$dbconfig["dbname"])){
    echo '您还未安装，<a href="./system/install/">点此安装系统</a>';
	exit(0);
}
if(file_exists('update.lock')){
echo '您已经安装过，如需重新安装请删除安装锁后再安装！<a href="./tool.php">快捷删除</a>';
exit(0);
}

if($conf['system_version']<1000){
	exit('网站程序版本太旧，不支持直接升级');
}elseif($conf['system_version']<1001){
	$version = 1001;
	$sqls = file_get_contents('../database/update/update_'.$version.'.sql');
}elseif($conf['system_version']<1002){
	$version = 1002;
	$sqls = file_get_contents('../database/update/update_'.$version.'.sql');
}elseif($conf['system_version']<1003){
	$version = 1003;
	$sqls = file_get_contents('../database/update/update_'.$version.'.sql');
	file_put_contents("update.lock",'网站数据库更新锁');
}else{
    exit("<script language='javascript'>alert('你的网站已经升级到最新版本了');window.location.href='/';</script>");
}
$explode = explode(';', $sqls);
$num = count($explode);
foreach ($explode as $sql) {
    if ($sql = trim($sql)) {
        $DB->query($sql);
    }
}
saveSetting('system_version',$version);
$CACHE->clear();
exit("<script language='javascript'>alert('网站数据库".$version."升级完成！');window.location.href='/';</script>");
?>
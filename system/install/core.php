<?php
error_reporting(0);
define("CACHE_FILE",0);
define("IN_CRONLITE",true);
date_default_timezone_set('PRC');
$date = date('Y-m-d H:i:s');
session_start();

include_once '../core/config.php';

if (!defined('SQLITE') && (!$dbconfig['user'] || !$dbconfig['pwd'] || !$dbconfig['dbname'])) {
	header('Content-type:text/html;charset=utf-8');
	echo '数据库连接失败';
	exit;
}
$scriptpath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$siteurl = ($_SERVER['SERVER_PORT']==443?'https://':'http://') . $_SERVER['HTTP_HOST'].$sitepath.'/';

include_once '../core/db.class.php';
$DB = new DB($dbconfig['host'], $dbconfig['user'], $dbconfig['pwd'], $dbconfig['dbname'], $dbconfig['port']);

include_once "../core/cache.class.php";
$CACHE = new CACHE();
$conf = $CACHE->pre_fetch();

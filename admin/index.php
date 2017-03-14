<?php
date_default_timezone_set("PRC");//所有文件必须从这里引入
define ('APPPATH', substr(dirname(__FILE__), 0, -6));

require APPPATH.'/Config/config.php';
require APPPATH.'/admin/aInclude/arouter.class.php';
require APPPATH.'/admin/aInclude/aWORK.class.php';
require APPPATH.'/Include/DB.class.php';
require APPPATH.'/Include/function.php';

if(!privilege_check())
	die("privilege error");
$router = new arouter ();
$controlClass = $router->control;
$action = $router->action;

if (file_exists ( APPPATH.'/admin/aInclude/' . $controlClass . '.php' )) {
	require APPPATH.'/admin/aInclude/' . $controlClass . '.php';
	$control = aWORK::create ( $controlClass );
	$control->$action ();
} else {
	require APPPATH.'/admin/aInclude/aindexControl.php';
	$control = new aindexControl ();
	$control->index ();
}
?>
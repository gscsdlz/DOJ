<?php
$stime = microtime ( true );
date_default_timezone_set("PRC");
define ( "APPPATH", dirname(__FILE__) );
require APPPATH.'/Config/config.php';
require APPPATH.'/Include/router.class.php';
require APPPATH.'/Include/WORK.class.php';
require APPPATH.'/Include/DB.class.php';
require APPPATH.'/Include/function.php';
session_check();
$router = new router ();
$controlClass = $router->control;
$action = $router->action;

if (file_exists ( APPPATH.'/Include/' . $controlClass . '.php' )) {
	require APPPATH.'/Include/' . $controlClass . '.php';
	$control = WORK::create ( $controlClass );
	$control->$action ();
} else {
	require APPPATH.'/Include/indexControl.php';
	$control = new indexControl ();
	$control->index ();
}
?>
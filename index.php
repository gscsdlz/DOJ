<?php
$stime = microtime ( true );
session_start();
date_default_timezone_set("PRC");
define ( "APPPATH", dirname ( __FILE__ ) );
require_once 'Include/router.class.php';
require_once 'Include/WORK.class.php';
$router = new router ();
$controlClass = $router->control;
$action = $router->action;
if (file_exists ( 'Include/' . $controlClass . '.php' )) {
	require_once 'Include/' . $controlClass . '.php';
	$control = WORK::create ( $controlClass );
	$control->$action ();
} else {
	require_once 'Include/indexControl.php';
	$control = new indexControl ();
	$control->index ();
}
?>
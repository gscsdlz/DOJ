<?php
$stime = microtime ( true );
session_start();
date_default_timezone_set("PRC");
define ( "APPPATH", dirname ( __FILE__ ) );

require 'Include/router.class.php';
require 'Include/WORK.class.php';
require 'Include/DB.class.php';
require 'Include/function.php';
$router = new router ();
$controlClass = $router->control;
$action = $router->action;
if (file_exists ( 'Include/' . $controlClass . '.php' )) {
	require 'Include/' . $controlClass . '.php';
	$control = WORK::create ( $controlClass );
	$control->$action ();
} else {
	require 'Include/indexControl.php';
	$control = new indexControl ();
	$control->index ();
}
?>
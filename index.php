<?php
$stime = microtime ( true );
date_default_timezone_set ( "PRC" );
define ( "APPPATH", dirname ( __FILE__ ) );
require APPPATH . '/Config/config.php';
require APPPATH . '/Include/router.class.php';
require APPPATH . '/Include/WORK.class.php';
require APPPATH . '/Include/DB.class.php';
require APPPATH . '/Include/function.php';
require APPPATH . '/Include/redisDB.class.php';
global $redisInfo;
extract ( $redisInfo );
ini_set("session.save_handler", "redis");
ini_set("session.save_path", "tcp://".$host.":".$port."?auth=".$auth);
ini_set("session.cookie_httponly", "On");
header('X-Frame-Options: sameorigin');
session_check ();
$router = new router ();
$controlClass = $router->control;
$action = $router->action;
new redisDB (); // redis只包含一个类静态成员 直接实例化一次就好
if (reload_check ()) {
	require APPPATH . '/View/VIEW.class.php';
	VIEW::show ( 'error', array (
			'errorInfo' => 'refresh Error' 
	) );
} else {
	if (file_exists ( APPPATH . '/Include/' . $controlClass . '.php' )) {
		require APPPATH . '/Include/' . $controlClass . '.php';
		$control = WORK::create ( $controlClass );
		$control->$action ();
	} else {
		require APPPATH . '/Include/indexControl.php';
		$control = new indexControl ();
		$control->index ();
	}
}
?>

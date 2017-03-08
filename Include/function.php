<?php
function get($arg) { // 获取GET['']
	if (isset ( $_GET [$arg] )) {
		return $_GET [$arg];
	} else {
		return null;
	}
}
function post($arg) {
	if (isset ( $_POST [$arg] )) {
		return $_POST [$arg];
	} else {
		return null;
	}
}
/**
 * 格式化时间为小时:分钟:秒
 */
function format_time($t) {
	if ($t < 0)
		return;
	$h = ( int ) ($t / 60 / 60);
	$t -= $h * 60 * 60;
	$m = ( int ) ($t / 60);
	$t -= $m * 60;
	return $h . ':' . $m . ':' . $t;
}
/**
 * 登录超时检测
 */
function session_check() {
	session_start ();
	if (isset ( $_SESSION ['timeout'] )) {
		if ($_SESSION ['timeout'] < time ()) {
			$_SESSION = array ();
			session_destroy ();
			setcookie ( 'PHPSESSID', '', time () - 3600, '/', '', 0, 0 );
		}
		$_SESSION ['timeout'] = time () + LOGINTIMEOUT; // 刷新时间戳 @config.php
	}
}
?>
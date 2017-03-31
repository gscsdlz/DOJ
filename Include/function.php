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

function get_ip_location($ip) {
	if(strlen($ip) <= 7)
		return '未知地址';
	else {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://ip.chinaz.com/".$ip);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		$location = strrpos($output, "Whwtdhalf w50-0");
		$i = 0;
		for($i = $location; $i < $location + 100; $i++) {
			if($output[$i] == '<') 
				break;
		}
		return substr($output, $location + 17, $i - ($location + 17));
		
	}
	return $ip;
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
	if (isset ( $_SESSION ['timeout'] )) { //检查登录情况
		if ($_SESSION ['timeout'] < time ()) {  //登录超时
			$_SESSION = array ();
			session_destroy ();
			setcookie ( 'PHPSESSID', '', time () - 3600, '/', '', 0, 0 );
			return false;
		}
		$_SESSION ['timeout'] = time () + LOGINTIMEOUT; // 刷新时间戳 @config.php
		return true;
	}
	return false;
}

/**
 * 登录权限检测 专用于后台模块
 */
function privilege_check() {
	if(session_check()) {
		if($_SESSION['privilege'][0] == 1 || isset($_SESSION['privilege'][1])) {
			return true;
		}
	}
	return false;
}
?>
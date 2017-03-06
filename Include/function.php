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
function format_time($t){
	if($t < 0)
		return;
	$h = (int)($t / 60 / 60);
	$t -= $h * 60 * 60;
	$m = (int)($t / 60);
	$t -= $m * 60;
	return $h.':'.$m.':'.$t;
}
?>
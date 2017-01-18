<?php
	function get($arg) { //获取GET['']
		if(isset($_GET[$arg])) {
			return $_GET[$arg];
		} else {
			return false;
		}
	}
	
	function post($arg) {
		if(isset($_POST[$arg])){
			return $_POST[$arg];
		} else {
			return false;
		}
	}
?>
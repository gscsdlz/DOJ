<?php
if(defined('APPPATH')) {
	require APPPATH.'/admin/aView/aVIEW.class.php';
} else {
	die();
}
class aindexControl {
	public function __construct() {
	}
	public function index() {
		aVIEW::loopshow ( 'default', array () );
	}
	public function __call($method, $args) {
		aVIEW::show ( 'error', array (
				'errorInfo' => 'Invalid Action'
		) );
	}
}
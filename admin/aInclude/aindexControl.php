<?php
if(!defined('APPPATH')) {
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
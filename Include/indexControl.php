<?php
if(defined('APPPATH')) {
	require APPPATH.'/View/VIEW.class.php';
} else {
	die();
}
class indexControl {
	public function __construct() {
	}
	public function index() {
		VIEW::loopshow ( 'default', array () );
	}
	public function help(){
		VIEW::loopshow ( 'help', array () );
	}
	public function __call($method, $args) {
		VIEW::show ( 'error', array (
				'errorInfo' => 'Invalid Action'
		) );
	}
}
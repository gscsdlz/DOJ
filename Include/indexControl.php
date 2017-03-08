<?php
require 'View/VIEW.class.php';
class indexControl {
	public function __construct() {
	}
	public function index() {
		VIEW::loopshow ( 'default', array () );
	}
	public function __call($method, $args) {
		VIEW::show ( 'error', array (
				'errorInfo' => 'Invalid Action'
		) );
	}
}
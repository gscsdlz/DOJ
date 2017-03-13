<?php
require '../Include/router.class.php';
class arouter{
	public $control;
	public $action;
	
	public function __construct() {
		if (isset ( $_SERVER ['REQUEST_URI'] ) && $_SERVER ['REQUEST_URI'] != '/') {
			$_SERVER ['REQUEST_URI'] = substr($_SERVER ['REQUEST_URI'], 7);  // /admin/.....
			$r = new router();
			$this->control = $r->control;
			$this->action = $r->action;
		}	
	}
}
<?php
namespace DOJ;
class router{
	
	public $control;
	public $action;
	
	public function __construct() {
		$this->control = 'indexControl';
		$this->action = 'index';
		if(isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
			$path = $_SERVER['REQUEST_URI'];
			$paths = explode('/', trim($path, '/'));
			if(isset($paths[0])) {
				$this->control = $paths[0]."Control";
			}
			if(isset($paths[1])) {
				$this->action = $paths[1];
			}
		}
	}
}
?>
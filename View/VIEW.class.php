<?php

class VIEW{
	
	static private $assignMap = array();
	
	static public function show($fileName, $args){
		extract($args);
		require_once 'Template/header.html';
		require_once 'Template/'.$fileName.'.php';
		require_once 'Template/footer.html';
	}
	
	static public function assign($key, $value) {
		$this->assignMap[$key] = $value;
	}
	
	static public function loopshow($fileName, $args) {
		require_once 'Template/header.html';
		require_once 'Template/'.$fileName.'.php';
		require_once 'Template/footer.html';
	}
	
}
?>
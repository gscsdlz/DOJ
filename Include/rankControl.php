<?php

require 'Model/rankModel.php';
require 'View/VIEW.class.php';
class rankControl {
	private static $model = null;
	public function __construct() {
		if (self::$model == null) {
			self::$model = new rankModel ();
		}
	}
	
	public function contest() {
		
	}
	
	public function page() {
		$page = (int)get('id');
		$args = self::$model->getRank();
		VIEW::loopshow('ranklist', $args);
	}
}
?>

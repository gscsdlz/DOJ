<?php
require_once 'Include/function.php';
require_once 'Model/rankModel.php';
require_once 'View/VIEW.class.php';
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

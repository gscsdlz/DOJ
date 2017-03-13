<?php
if (defined ( 'APPPATH' )) {
	require APPPATH.'/Model/rankModel.php';
	require APPPATH.'/View/VIEW.class.php';
} else {
	die ();
}

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

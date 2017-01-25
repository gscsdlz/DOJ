<?php
require_once 'Include/function.php';
require_once 'Model/statusModel.php';
require_once 'View/VIEW.class.php';

class statusControl {
	private static $model = null;
	public function __construct() {
		if (self::$model == null) {
			self::$model = new statusModel();
		}
	}
	
	public function __call($method, $args) {
		VIEW::show('error', array('errorInfo' => 'Invalid action'));
	}
	
	public function index() {
		$submit_id = get('rid');
		$pro_id = get('pid');
		$username = get('Programmer');
		$lang = get('lang');
		$status = get('status');
		$results = self::$model->getStatus($submit_id, $pro_id, $username, $lang, $status);
		VIEW::loopshow('status', $results);
	}
}
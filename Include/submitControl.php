<?php
require_once 'Include/function.php';
require_once 'Model/submitModel';

class submitControl {
	private static $model = null;
	public function __construct(){
		if(self::$model == null)
			self::$model = new submitModel();
	}
	
	public function submit() {
		if($_SERVER['REMOTE_METHOD'] == 'POST' || !isset($_SESSION['user_id'])) {
			$pro_id = post('pro_id');
			$lang = post('lang');
			$codes = post('codes');
			$user_id = $_SESSION['user_id'];
			$res = self::$model->insert($user_id, $pro_id, $lang, $codes);
			
		}
		echo json_encode(array('status' => false));
	}
}
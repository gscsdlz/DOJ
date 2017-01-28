<?php
require_once 'Include/function.php';
require_once 'Model/submitModel.php';
class submitControl {
	private static $model = null;
	public function __construct() {
		if (self::$model == null)
			self::$model = new submitModel ();
	}
	public function index() {
		$this->submit ();
	}
	public function submit() {
		session_start ();
		if ($_SERVER ['REQUEST_METHOD'] == 'POST' || ! isset ( $_SESSION ['user_id'] )) {
			$pro_id = (int)post ( 'pro_id' );
			$lang = (int)post ( 'lang' );
			$codes = post ( 'codes' );
			$user_id = $_SESSION ['user_id'];
			$res = self::$model->insert ( $user_id, $pro_id, $lang, $codes );
			
			if ($res) {
				echo json_encode ( array (
						'status' => true 
				) );
				return;
			}
		}
		echo json_encode ( array (
				'status' => false 
		) );
	}
}
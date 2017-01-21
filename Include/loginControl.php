<?php
///处理登录
require_once 'Include/function.php';
require_once 'Model/loginModel.php';
class loginControl {
	private static $model = null;
	public function __construct() {
		if(self::$model == null)
			self::$model = new loginModel();
	}
	public function login() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			$username = post ( 'username' );
			$password = post ( 'password' );
			if(self::$model->login($username, $password)) {
				echo json_encode(array('status' => true));
				return;
			}
		}
		echo json_encode(array('status' => false));
	}
	public function logout() {
	}
	public function register() {
	}
}
?>

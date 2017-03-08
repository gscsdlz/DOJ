<?php
// /处理登录

require 'Model/loginModel.php';
require 'Include/vcode.class.php';

class loginControl {
	private static $model = null;
	public function __construct() {
		if (self::$model == null)
			self::$model = new loginModel ();
	}
	public function index() {
		$this->login ();
	}
	public function __call($method, $args) {
		;
	}
	public function login() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			$username = post ( 'username' );
			$password = post ( 'password' );
			$vcode = post('vcode');
			if($vcode != $_SESSION['vcode']) {
				echo json_encode ( array (
						'status' => 'vcode error' 
				) );
				return;
			}
			if ($uid = self::$model->login ( $username, $password )) {
				$_SESSION ['username'] = $username;
				$_SESSION ['user_id'] = $uid;
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
	
	public function vcode() {
		echo new vcode();
	}
	
	public function logout() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			if (isset ( $_SESSION ['username'] )) {
				$_SESSION = array ();
				session_destroy ();
				setcookie ( 'PHPSESSID', '', time () - 3600, '/', '', 0, 0 );
			}
			echo json_encode ( array (
					'status' => true 
			) );
			return;
		}
		echo json_encode ( array (
				'status' => false 
		) );
	}
	public function register() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			$username = post ( 'newUsername' );
			$password = post ( 'newPassword' );
			$password2 = post ( 'newPassword2' );
			$email = post ( 'email' );
			$nickname = post ( 'newNickname' );
			$vcode = post('vcode');
			if($vcode != $_SESSION['vcode']) {
				echo json_encode ( array (
						'status' => 'vcode error'
				) );
				return;
			}
			$status = self::$model->register ( $username, $password, $password2, $nickname, $email );
			if ($status == - 1)
				echo json_encode ( array (
						'status' => 'username error' 
				) );
			else if ($status == - 2)
				echo json_encode ( array (
						'status' => 'email error' 
				) );
			else if ($status == 1)
				echo json_encode ( array (
						'status' => 'error' 
				) );
			else {
				$_POST ['username'] = $username;
				$_POST ['password'] = $password;
				$this->login ( $username, $password );
			}
			return;
		}
		echo json_encode ( array (
				'status' => false 
		) );
	}
	public function update() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			$password = post ( 'password' );
			$password2 = post ( 'password2' );
			$email = post ( 'email' );
			$nickname = post ( 'nickname' );
			$qq = ( int ) post ( 'qq' );
			$motto = post ( 'motto' );
			$group = ( int ) ('group');
			if (isset ( $_SESSION ['user_id'] )) {
				$userid = $_SESSION ['user_id'];
				$status = self::$model->update ( $userid, $password, $password2, $nickname, $email, $qq, $motto, $group );
				if($status == -1)
					echo json_encode(array('status' => 'email error'));
				else if($status == -2)
					echo json_encode(array('status' => 'group error'));
				else 
					echo json_encode(array('status' => true));
			} else {
				echo json_encode ( array (
						'status' => false 
				) );
			}
		}
	}
}
?>

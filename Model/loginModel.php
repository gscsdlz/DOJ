<?php
require_once 'Include\DB.class.php';
class loginModel extends DB {
	public function __construct() {
		parent::__construct ();
	}
	public function login($username, $password) {
		if (! empty ( $username ) && ! empty ( $password )) {
			$res = parent::query ( "SELECT password FROM users WHERE username=?", $username );
			if ($res->rowCount () != 0 && sha1 ( $password ) == $res->fetch ( PDO::FETCH_NUM ) [0]) {
				return true;
			}
		}
		return false;
	}
	public function logout() {
	}
	public function register() {
	}
}
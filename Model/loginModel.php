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
	public function register($username, $password, $password2, $nickname, $email) {
		if (! empty ( $username ) && ! empty ( $password ) && $password == $password2 && ! empty ( $email )) {
			$res = parent::query ( "SELECT user_id FROM users WHERE username=?", $username );
			if ($res->rowCount () != 0) {
				return - 1; // username has already been used
			}
			$res = parent::query ( "SELECT user_id FROM users WHERE email=?", $email );
			if ($res->rowCount () != 0) {
				return - 2; // email has already been used
			}
			parent::query ( "INSERT INTO users (username, password, nickname, email) VALUES (?, ?, ? ,?)", $username, sha1 ( $password ), $nickname, $email );
			return 0;
		}
		return 1;
	}
}
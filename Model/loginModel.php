<?php

class loginModel extends DB {
	public function __construct() {
		parent::__construct ();
	}
	
	private function get_privilege($user_id) {
		$res = parent::query("SELECT contest_id FROM contest WHERE user_id = ?", $user_id);
		$args = array();
		while($row = $res->fetch(PDO::FETCH_NUM)) {
			$args[$row[0]] = 1;
		}
		return $args;
	}
	
	public function login($username, $password) {
		if (! empty ( $username ) && ! empty ( $password )) {
			$res = parent::query ( "SELECT password, user_id, privilege FROM users WHERE username=?", $username );
			$arr = $res->fetch ( PDO::FETCH_NUM );
			
			if ($res->rowCount () != 0  && sha1 ( $password ) == $arr [0]) { //通过修改username字段为binary类型 解决
				if($arr[2] == -1)
					return array($arr[1], $this->get_privilege($arr[1]));
				return array($arr [1], 1);
			}
		}
		return null;
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
	public function updateInfo($userid, $password, $password2, $nickname, $email, $qq, $motto, $group) {
		if ($password && $password == $password2) {
			parent::query ( "UPDATE users SET password = sha1(?)	 WHERE user_id = ? LIMIT 1", $password, $userid );
		}
		$res = parent::query ( "SELECT user_id FROM users WHERE email=? AND user_id != ?", $email, $userid );
		if ($res->rowCount () != 0) {
			return - 1; // 邮箱已经被使用过了
		}
		$res = parent::query ( "SELECT * FROM group WHERE group_id = ?", $group );
		if ($res->rowCount () != 0) {
			return - 2; // groupID不合法
		}
		/**
		 * 这个地方需要调整
		 */
		if ($nickname) {			
			parent::query ( "UPDATE users SET nickname=? WHERE user_id = ? LIMIT 1", $nickname, $userid);
		}
		if ($email) {
			parent::query ( "UPDATE users SET email=? WHERE user_id = ? LIMIT 1", $email, $userid );
		}
		if ($qq) {
			parent::query ( "UPDATE users SET qq=? WHERE user_id = ? LIMIT 1", $qq, $userid );
		}
		if($motto) {
			parent::query("UPDATE users SET motto=? WHERE user_id = ? LIMIT 1", $motto, $userid);
		}
		if($group) {
			parent::query("UPDATE users SET group=? WHERE user_id = ? LIMIT 1", $group, $userid);
		}
		return 0;
	}
}
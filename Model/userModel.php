<?php
require_once 'Include/DB.class.php';
class userModel extends DB {
	public function __construct() {
		parent::__construct ();
	}
	public function getId($username) {
		$result = parent::query ( "SELECT user_id FROM users WHERE username = ? LIMIT 1", $username );
		return $result->fetch ( PDO::FETCH_NUM ) [0];
	}
	
	public function getStatus($user_id) {
		$result = parent::query ( "SELECT status, count(*) FROM `status` where user_id = ? group BY (status)", $user_id );
		$arr = array (
				0,
				0,
				0,
				0,
				0,
				0,
				0,
				0 
		);
		if ($result->rowCount () != 0) {
			while ( $row = $result->fetch ( PDO::FETCH_NUM ) ) {
					$arr[$row[0] - 4] = $row [1];
			}
		}
		return $arr;
	}
}
?>
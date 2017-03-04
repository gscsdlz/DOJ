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
		$result = parent::query ( "SELECT status, count(*) FROM `status` where user_id = ? AND contest_id = 0 group BY (status)", $user_id );
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
	
	public function get_ac_problem($user_id) {
		$result = parent::query("SELECT DISTINCT pro_id FROM status WHERE user_id = ? AND status = 4 AND contest_id=0", $user_id);
		$arr = null;
		while($row = $result->fetch(PDO::FETCH_NUM)) {
			$arr[] = $row[0];
		}
		return $arr;
	}
	
	public function get_nac_problem($user_id) {
		$result = parent::query("SELECT DISTINCT pro_id FROM status WHERE user_id = ? AND status != 4 AND contest_id = 0 AND pro_id NOT IN (SELECT DISTINCT pro_id FROM status WHERE user_id = ? AND status = 4)", $user_id, $user_id);
		$arr = null;
		while($row = $result->fetch(PDO::FETCH_NUM)) {
			$arr[] = $row[0];
		}
		return $arr;
	}
	
	public function get_user_info($user_id) {
		$result = parent::query("SELECT * FROM `users` lEFT JOIN `group` ON `group`.group_id = `users`.group_id WHERE user_id = ?", $user_id);
		return $result->fetch(PDO::FETCH_NAMED);
	}
	
	public function get_contest_info($user_id){
		$result = parent::query("SELECT contest_name, COUNT(DISTINCT pro_id), contest.contest_id FROM contest INNER JOIN status ON (contest.contest_id = status.contest_id) WHERE status.user_id = ? AND status.status = 4 GROUP BY status.contest_id", $user_id);
		if($result->rowCount() != 0) {
			while($row = $result->fetch(PDO::FETCH_NUM)){
				$args[] = $row;
			}
			return $args;
		} else {
			return null;
		}
	}
	
	public function get_group_info() {
		$result = parent::query("SELECT * FROM `group`");
		while($row = $result->fetch(PDO::FETCH_NUM)){
			$arg[] = $row;
		}
		return $arg;
	}
	
	public function save_filename($filename, $user_id) {
		parent::query("UPDATE users SET headerpath = ? WHERE user_id = ?", $filename, $user_id);
		return true;
	}
	
	public function get_filename($user_id) {
		$res = parent::query_one("SELECT headerpath FROM users WHERE user_id = ?", $user_id);
		return $res[0];
	}
}
?>
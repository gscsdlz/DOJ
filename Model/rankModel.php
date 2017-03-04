<?php
require_once 'Include/DB.class.php';
class rankModel extends DB {
	private $users = array ();
	public function __construct() {
		parent::__construct ();
	}
	private function get_users() {
		$res = parent::query ( "SELECT user_id, username, motto FROM users" );
		while ( $row = $res->fetch ( PDO::FETCH_NUM ) ) {
			
			$this->users [$row [0]] = array (
					$row [1],
					$row [2],
					0,
					0 
			);
		}
	}
	public function getRank($page = 0) {
		$this->get_users ();
		$this->getAcNum ();
		$this->getnAcNum ();
		function cmp($a, $b) {
			if ($a [2] == $b [2]) {
				if ($a [3] == $b [3])
					return $a [0] < $b [0] ? - 1 : 1;
				if ($a [2] == 0)
					return $a [3] > $b [3] ? -1 : 1;
				else
					return $a [3] > $b [3] ? 1 : - 1;
			} else {
				return $a [2] < $b [2] ? 1 : - 1;
			}
		}
		uasort ( $this->users, "cmp" );
		return $this->users;
	}
	private function getAcNum() {
		$res = parent::query ( "SELECT COUNT(DISTINCT pro_id), users.user_id FROM users LEFT JOIN status ON (users.user_id = status.user_id) WHERE status=4 AND contest_id=0 GROUP BY (status.user_id)" );
		while ( $row = $res->fetch ( PDO::FETCH_NUM ) ) {
			$this->users [$row [1]] [2] += ( int ) $row [0];
		}
	}
	private function getnAcNum() {
		$res = parent::query ( "SELECT COUNT(pro_id), users.user_id FROM users LEFT JOIN status ON (users.user_id = status.user_id) WHERE contest_id = 0 GROUP BY (status.user_id)" );
		while ( $row = $res->fetch ( PDO::FETCH_NUM ) ) {
			$this->users [$row [1]] [3] += ( int ) $row [0];
		}
	}
	public function contest_rank($cid) {
	}
}
?>
<?php
require_once 'Include/DB.class.php';
class contestModel extends DB{
	public function __construct() {
		parent::__construct();
	}
	
	public function get_lists() {
		$result = parent::query("SELECT contest.*, users.username FROM contest LEFT JOIN users ON (contest.user_id = users.user_id) ORDER BY contest_id DESC");
		if($result->rowCount() != 0) {
			while($row = $result->fetch(PDO::FETCH_NAMED)) {
				$arr[] = $row;
			}
			return $arr;
		} else {
			return null;
		}
	}
}
?>
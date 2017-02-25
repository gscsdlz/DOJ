<?php
require_once 'Include/DB.class.php';
class rankModel extends DB {
	public function __construct() {
		parent::__construct ();
	}
	
	public function getRank($page = 0) {
		$result = parent::query("SELECT COUNT(DISTINCT pro_id), users.username FROM users LEFT JOIN status ON (users.user_id = status.user_id) WHERE status=4 AND contest_id=0 GROUP BY (status.user_id)");
	}
	
	public function contest_rank($cid) {
		
	}
}
?>
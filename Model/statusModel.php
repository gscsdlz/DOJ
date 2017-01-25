<?php
require_once 'Include\DB.class.php';
class statusModel extends DB {
	public function __construct() {
		parent::__construct();
	}
	
	public function getStatus($submit_id, $pro_id, $username, $lang, $status) {
		return parent::query("SELECT submit_id, submit_time, pro_id, run_time, run_memory, length, lang FROM status");
		
	}
}
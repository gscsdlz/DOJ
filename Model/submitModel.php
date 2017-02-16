<?php
require_once 'Include/DB.class.php';
class submitModel extends DB {
	public function __construct() {
		parent::__construct ();
	}
	
	public function get_real_id($pro_id, $contestId){
		$res = parent::query("SELECT pro_id FROM contest_pro WHERE contest_id = ? AND inner_id = ?", $contestId, $pro_id);
		if($res->rowCount() != 0){
			return $res->fetch(PDO::FETCH_NUM)[0];
		} else {
			return -1;
		}
	}
	
	public function insert($user_id, $pro_id, $lang, $codes, $contestId) {
		if($contestId) {
			$pro_id = $this->get_real_id($pro_id, $contestId);
		}
		$result = parent::query ( "SELECT MAX(pro_id) FROM problem" );
		$maxId = $result->fetch ( PDO::FETCH_NUM ) [0];
		if ($pro_id > $maxId || $pro_id < 1000)
			return false;
		global $langArr;
		if ($lang <= 0 || $lang >= count ( $langArr ))
			return false;
		$time = time ();
		
		$q1 = "INSERT INTO status VALUES (NULL, $pro_id, $user_id, $time, 0, 0, 1, $lang, $contestId)";
		$code_length = strlen ( $codes );
		$codes = addslashes($codes);
		$q2 = "INSERT INTO codes VALUES (NULL, '$codes', $code_length)";
		return parent::transaction_query ( $q1, $q2 );
	}
}
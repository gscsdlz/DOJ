<?php
require_once 'Include\DB.class.php';
class statusModel extends DB {
	public function __construct() {
		parent::__construct();
	}
	
	public function getStatus($submit_id, $pro_id, $username, $lang, $status) {
		$q = "SELECT status.submit_id, submit_time, status.pro_id, run_time, run_memory, codes.code_length, lang, status.status, username FROM";
		$q .= " status LEFT JOIN codes ON (status.submit_id = codes.submit_id), users WHERE users.user_id = status.user_id ";
		if($submit_id)
			$q .= "AND status.submit_id = $submit_id ";
		if($pro_id)
			$q .="AND status.pro_id = $pro_id ";
		if($username)
			$q .= "AND username = '$username' "; 
		if($lang)
			$q .= "AND lang = $lang ";
		if($status)
			$q .= "AND status = $status ";
		$result = parent::query($q.= "ORDER BY status.submit_id DESC");
		if ($result->rowCount () != 0) {
			while ( $row = $result->fetch ( PDO::FETCH_NUM ) ) {
				$arr [] = $row;
			}
			return $arr;
		} else {
			return null;
		}
	}
}
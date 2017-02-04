<?php
require_once 'Include/DB.class.php';
class codeModel extends DB{
	public function __construct() {
		parent::__construct();
	}
	
	public function getCode($submit_id) {
		$result = parent::query("SELECT status.*, codes.code FROM codes LEFT JOIN status ON (status.submit_id = codes.submit_id) WHERE status.submit_id = ?", $submit_id);
		if($result->rowCount() != 0) {
			return $result->fetch(PDO::FETCH_NAMED);
		} else {
			return null;
		}
	}
	
	public function getCEInfo($submit_id) {
		$result = parent::query("SELECT status.*, ce_info.info FROM ce_info LEFT JOIN status ON (status.submit_id = ce_info.submit_id) WHERE status.submit_id = ?", $submit_id);
		if($result->rowCount() != 0) {
			return $result->fetch(PDO::FETCH_NAMED);
		} else {
			return null;
		}
	}
}
?>
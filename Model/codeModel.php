<?php
require_once 'Include/DB.class.php';
class codeModel extends DB {
	public function __construct() {
		parent::__construct ();
	}
	public function get_inner_id($contest_id, $pro_id) {
		$res = parent::query ( "SELECT inner_id FROM contest_pro WHERE contest_id = ? AND pro_id = ?", $contest_id, $pro_id );
		if ($res->rowCount () != 0)
			return $res->fetch ( PDO::FETCH_NUM ) [0];
	}
	public function getCode($submit_id, $contest_id = 0) {
		$result = parent::query ( "SELECT status.*, codes.code FROM codes LEFT JOIN status ON (status.submit_id = codes.submit_id) WHERE status.submit_id = ?", $submit_id );
		if ($result->rowCount () != 0) {
			$args = $result->fetch ( PDO::FETCH_NAMED );
			if ($contest_id) {
				$args ['pro_id'] = $this->get_inner_id ( $contest_id, $args ['pro_id'] );
			}
			return $args;
		} else {
			return null;
		}
	}
	public function getCEInfo($submit_id, $contest_id = 0) {
		$result = parent::query ( "SELECT status.*, ce_info.info FROM ce_info LEFT JOIN status ON (status.submit_id = ce_info.submit_id) WHERE status.submit_id = ?", $submit_id );
		if ($result->rowCount () != 0) {
			$args = $result->fetch ( PDO::FETCH_NAMED );
			if ($contest_id) {
				$args ['pro_id'] = $this->get_inner_id ( $contest_id, $args ['pro_id'] );
			}
			return $args;
		} else {
			return null;
		}
	}
}
?>
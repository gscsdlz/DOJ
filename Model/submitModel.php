<?php

class submitModel extends DB {
	public function __construct() {
		parent::__construct ();
	}
	public function get_real_id($pro_id, $contestId) {
		$res = parent::query_one ( "SELECT pro_id FROM contest_pro WHERE contest_id = ? AND inner_id = ?", $contestId, $pro_id );
		if ($res) {
			return $res[0];
		} else {
			return - 1;
		}
	}
	/**
	 * 该函数用于检查当前的比赛提交是否满足时间要求
	 * 返回值说明
	 * 
	 * @param unknown $contestId        	
	 * @return boolean
	 */
	public function timeCheck($contestId) {
		$timeNow = time ();
		$times = parent::query ( "SELECT c_stime, c_etime FROM contest WHERE contest_id = ? ", $contestId );
		if ($times->rowCount () != 0) {
			$row = $times->fetch ( PDO::FETCH_NUM );
			if ($timeNow < $row [0])
				return false;
			if ($timeNow > $row [1])
				return false;
			return true;
		}
		return false;
	}
	public function insertCode($user_id, $pro_id, $lang, $codes, $contestId) {
		if ($contestId) {
			if (!$this->timeCheck ( $contestId )) {
				return false;
			}
			$pro_id = $this->get_real_id ( $pro_id, $contestId );
		}
		$result = parent::query_one ( "SELECT MAX(pro_id) FROM problem" );
		$maxId = $result[0];
		if ($pro_id > $maxId || $pro_id < 1000)
			return false;
		global $langArr;
		if ($lang <= 0 || $lang >= count ( $langArr ))
			return false;
		$time = time ();
		$acflag = mt_rand(1, 100);
		if($acflag < 80)
			$acflag = 4;
		else
			$acflag = mt_rand(5, 10);
		$q1 = "INSERT INTO status VALUES (NULL, $pro_id, $user_id, $time, 0, 0, $acflag, $lang, $contestId, 0)";
		$code_length = strlen ( $codes );
		$codes = addslashes ( $codes );
		$q2 = "INSERT INTO codes VALUES (NULL, '$codes', $code_length)";
		return parent::transaction_query ( $q1, $q2 );
	}
}
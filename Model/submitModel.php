<?php
require_once 'Include/DB.class.php';
class submitModel extends DB {
	public function __construct() {
		parent::__construct ();
	}
	public function insert($user_id, $pro_id, $lang, $codes) {
		$result = parent::query ( "SELECT MAX(pro_id) FROM problem" );
		$maxId = $result->fetch ( PDO::FETCH_NUM ) [0];
		if ($pro_id > $maxId || $pro_id < 1000)
			return false;
		global $langArr;
		if ($lang <= 0 || $lang >= count ( $langArr ))
			return false;
		$time = time ();
		$q1 = "INSERT INTO status VALUES (NULL, $pro_id, $user_id, $time, 0, 0, 1, $lang)";
		$code_length = strlen ( $codes );
		$q2 = "INSERT INTO codes VALUES (NULL, '$codes', $code_length)";
		//////暂时无法解决 SQL注入
		return parent::transaction_query ( $q1, $q2 );
	}
}
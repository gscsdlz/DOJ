<?php
require_once 'Include\DB.class.php';
class problemModel extends DB {
	public function __construct() {
		parent::__construct ();
	}
	public function get_problem($problemId) { // 从数据库选择指定ID的题目详情
		$result = parent::query ( "SELECT * FROM problem WHERE pro_id = ? LIMIT 1", $problemId );
		if ($result->rowCount () != 0) {
			return $result->fetch ( PDO::FETCH_NAMED );
		} else {
			return null;
		}
	}
	public function get_list($listId) {
		$listId *= 50;
		$result = parent::query ( "SELECT pro_id, pro_title FROM problem LIMIT $listId, 50" );
		if ($result->rowCount () != 0) {
			$arr = array ();
			while ( $row = $result->fetch ( PDO::FETCH_NUM ) ) {
				$arr [] = array (
						$row [0],
						$row [1] 
				);
			}
			return $arr;
		} else {
			return null;
		}
	}
}
?>
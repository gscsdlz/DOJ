<?php

class problemModel extends DB {
	public function __construct() {
		parent::__construct ();
	}
	/**
	 * 
	 * @param unknown $problemId
	 * @return mixed|NULL
	 */
	public function get_problem($problemId) { // 从数据库选择指定ID的题目详情
		$result = parent::query ( "SELECT * FROM problem WHERE pro_id = ? LIMIT 1", $problemId );
		if ($result->rowCount () != 0) {
			return $result->fetch ( PDO::FETCH_NAMED );
		} else {
			return null;
		}
	}
	/**
	 * 获取总提交数 $contest_id = 0是表示非比赛的提交
	 * @param int $problemId 题目真实ID
	 * @param int $contest_id 比赛ID
	 * @return number[]|mixed[] 返回两个数字 包括AC提交数，总提交数
	 */
	public function get_submits($problemId, $contest_id = 0) {
		$result = parent::query_one ( "SELECT COUNT(*) FROM status LEFT JOIN problem ON (status.pro_id = problem.pro_id) WHERE problem.pro_id = ? AND status = 4 AND contest_id = ?", $problemId, $contest_id );
		$aSubmit = $result[0];
		if (! $aSubmit)
			$aSubmit = 0;
		$result = parent::query_one ( "SELECT COUNT(*) FROM status WHERE pro_id = ? AND contest_id = ?", $problemId, $contest_id);
		$tSubmit = $result[0];
		if (! $tSubmit)
			$tSubmit = 0;
		
		return array (
				$aSubmit,
				$tSubmit 
		);
	}
	/**
	 * 
	 * @param unknown $problemId
	 * @param unknown $user_id
	 * @param unknown $contest_id
	 * @return NULL[]|boolean[]|mixed[]
	 */
	public function get_my_submits($problemId, $user_id, $contest_id = 0) {
		$result = parent::query_one ( "SELECT COUNT(*) FROM status WHERE pro_id = ? AND status = 4 AND user_id = ? AND contest_id = ? ", $problemId, $user_id, $contest_id);
		$aSubmit = null;
		$wSubmit = null;
		if ($result && $result[0] > 0) {
			$aSubmit = true;
		} else {
			$result2 = parent::query_one ( "SELECT COUNT(*) FROM status WHERE pro_id = ? AND user_id = ? AND contest_id = ?", $problemId, $user_id, $contest_id );
			if ($result2) {
				$wSubmit = $result2[0];
			}
		}
		return array (
				$aSubmit,
				$wSubmit 
		);
	}
	/**
	 * 
	 * @param unknown $listId
	 * @return string[]|unknown[][]|NULL[]|number[][]|mixed[][]|NULL[][]|boolean[][]|NULL
	 */
	public function get_list($listId) {
		$pms = PROBLEMPAGEMAXSIZE;
		$listId *= $pms;
		
		$result = parent::query ( "SELECT pro_id, pro_title FROM problem WHERE visible=1 LIMIT $listId, $pms" );
		if ($result->rowCount () != 0) {
			$arr [] = array (
					$this->get_maxProblem (),
					$pms 
			);
			$needGets = false; // 获取用户每道题的提交记录
			if (isset ( $_SESSION ['user_id'] )) {
				$needGets = true;
				$user_id = $_SESSION ['user_id'];
			}
			while ( $row = $result->fetch ( PDO::FETCH_NUM ) ) {
				$submits = $this->get_submits ( $row [0]);
				if ($needGets) {
					$mySubmits = $this->get_my_submits ( $row [0], $user_id);
					$arr [] = array (
							$row [0],
							$row [1],
							$submits [0],
							$submits [1],
							$mySubmits [0],
							$mySubmits [1] 
					);
				} else {
					$arr [] = array (
							$row [0],
							$row [1],
							$submits [0],
							$submits [1]
					);
				}
			}
			return $arr;
		} else {
			return null;
		}
	}
	/**
	 * 
	 * @return mixed
	 */
	public function get_maxProblem() {
		$result = parent::query_one ( "SELECT count(*) FROM problem" );
		return $result[0];
	}
	/**
	 * 
	 * @param unknown $key
	 * @return unknown[]|number[]|mixed[]|NULL
	 */
	public function get_search_result($key) {
		$pms = PROBLEMPAGEMAXSIZE;
		
		$result = parent::query ( "SELECT pro_id, pro_title FROM problem WHERE pro_title like '%$key%' OR author like '%$key%'" );
		
		if ($result->rowCount () != 0) {
			
			while ( $row = $result->fetch ( PDO::FETCH_NUM ) ) {
				$submits = $this->get_submits ( $row [0] );
				$arr [] = array (
						$row [0],
						$row [1],
						$submits [0],
						$submits [1] 
				);
			}
			return $arr;
		} else {
			return null;
		}
	}
}
?>
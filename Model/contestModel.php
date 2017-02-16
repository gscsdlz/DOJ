<?php
require_once 'Include/DB.class.php';
require_once 'Model/problemModel.php';
class contestModel extends DB {
	private $model;
	public function __construct() {
		parent::__construct ();
		$this->model = new problemModel();
	}
	public function get_lists($cid = 0) {
		if($cid){
			$result = parent::query ( "SELECT contest.*, users.username FROM contest LEFT JOIN users ON (contest.user_id = users.user_id) WHERE contest_id = ? ORDER BY contest_id DESC", $cid);
		} else {
			$result = parent::query ( "SELECT contest.*, users.username FROM contest LEFT JOIN users ON (contest.user_id = users.user_id)  ORDER BY contest_id DESC");
		}
		
		if ($result->rowCount () != 0) {
			while ( $row = $result->fetch ( PDO::FETCH_NAMED ) ) {
				$arr [] = $row;
			}
			return $arr;
		} else {
			return null;
		}
	}
	public function get_problem_list($contest_id) {
		$result = parent::query ( "SELECT inner_id, problem.pro_title, contest_pro.pro_id FROM contest_pro LEFT JOIN problem ON (problem.pro_id = contest_pro.pro_id) WHERE contest_id = ? ORDER BY inner_id", $contest_id );
		if ($result->rowCount () != 0) {
			$needGets = false; // 获取用户每道题的提交记录
			if (isset ( $_SESSION ['user_id'] )) {
				$needGets = true;
				$user_id = $_SESSION ['user_id'];
			}
			$arr[] = array($contest_id);
			while ( $row = $result->fetch ( PDO::FETCH_NUM ) ) {
				$Submits = $this->model->get_submits ( $row [2], $contest_id );
				if ($needGets) {
					$mySubmits = $this->model->get_my_submits($row[2], $user_id, $contest_id);
					$arr [] = array (
							$row [0],
							$row [1],
							$Submits [0],
							$Submits [1],
							$mySubmits[0],
							$mySubmits[1]
					);
				} else {
					$arr [] = array (
							$row [0],
							$row [1],
							$Submits [0],
							$Submits [1] 
					);
				}
			}
			return $arr;
		} else {
			return null;
		}
	}
	
	public function get_real_Id($pid, $contest_id) {
		$result = parent::query("SELECT pro_id FROM contest_pro WHERE contest_id = ? AND inner_id = ? LIMIT 1", $contest_id, $pid);
		if($result->rowCount() != 0) {
			 return $result->fetch(PDO::FETCH_NUM)[0];
		} else {
			return -1;
		}
	}
	
	public function get_problem($pid, $inner_id) {
		$body = $this->model->get_problem($pid);
		if(isset($body['pro_id'])) {
			$body['pro_id'] = $inner_id;
		}
		return $body;
	}
	
}
?>
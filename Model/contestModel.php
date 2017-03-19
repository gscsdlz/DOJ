<?php
require_once APPPATH.'/Model/problemModel.php';
class contestModel extends DB {
	private $model;
	public function __construct() {
		parent::__construct ();
		$this->model = new problemModel ();
	}
	public function timeCheck($contestId) {
		$timeNow = time ();
		$times = parent::query ( "SELECT c_stime, c_etime FROM contest WHERE contest_id = ? ", $contestId );
		if ($times->rowCount () != 0) {
			$row = $times->fetch ( PDO::FETCH_NUM );
			if ($timeNow < $row [0])
				return -1;
			return 0;
		}
		return -1;
	}
	public function privilege_check($cid, $uid) {
		$res = parent::query_one ( "SELECT contest_pass FROM contest WHERE contest_id = ?", $cid );
		/**
		 * contest_pass = 1 不需要密码
		 * 				= 2 指定用户可进入
		 * 				= 其他6位以上字符 输入密码可进入
		 * 返回值 1 需要密码 0 一切正常 -1 比赛未开始 -2 权限不足
		 */
		
		if ($res) {
			$contest_pass = $res [0];
			if ($contest_pass != 1) {
				$res2 = parent::query_one ( "SELECT user_id FROM contest_user WHERE contest_id = ? AND user_id = ?", $cid, $uid );
				if (!$res2) {
					if(strlen($contest_pass) > 1) {
						return 1;
					} else {
						return -2;
					}
				}
			}
		} else { //找不到这个比赛
			return -1;
		}
		return $this->timeCheck($cid);
	}
	
	public function check($user_id, $cid, $password) {
		$res = parent::query_one("SELECT contest_pass FROM contest WHERE contest_id = ?", $cid);
		if($res) {
			if($password == $res[0]) {
				parent::query("INSERT INTO contest_user (user_id, contest_id) VALUES (?, ?)", $user_id, $cid);
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	/**
	 * 返回比赛的详细信息，提供cid则返回该比赛的信息
	 * 否则返回所有比赛信息
	 * @param number $cid
	 * @return mixed|NULL
	 */
	public function get_lists($cid = 0) {
		if ($cid) {
			$result = parent::query ( "SELECT contest.*, users.username FROM contest LEFT JOIN users ON (contest.user_id = users.user_id) WHERE contest_id = ? ORDER BY contest_id DESC", $cid );
		} else {
			$result = parent::query ( "SELECT contest.*, users.username FROM contest LEFT JOIN users ON (contest.user_id = users.user_id)  ORDER BY contest_id DESC" );
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
	/**
	 * 获取比赛中题目的列表
	 * @param int $contest_id
	 * @return unknown[]|unknown[][]|number[][]|mixed[][]|NULL
	 */
	public function get_problem_list($contest_id, $needGets = 0) {
		$result = parent::query ( "SELECT inner_id, problem.pro_title, contest_pro.pro_id FROM contest_pro LEFT JOIN problem ON (problem.pro_id = contest_pro.pro_id) WHERE contest_id = ? ORDER BY inner_id", $contest_id );
		if ($result->rowCount () != 0) {
			// 获取用户每道题的提交记录
			if (isset ( $_SESSION ['user_id'] ) && $needGets == 0) {
				$needGets = 1;
				$user_id = $_SESSION ['user_id'];
			}
			$arr [] = array (
					$contest_id 
			);
			while ( $row = $result->fetch ( PDO::FETCH_NUM ) ) {
				$Submits = $this->model->get_submits ( $row [2], $contest_id );
				if ($needGets == 1) {
					$mySubmits = $this->model->get_my_submits ( $row [2], $user_id, $contest_id );
					$arr [] = array (
							$row [0],
							$row [1],
							$Submits [0],
							$Submits [1],
							$mySubmits [0],
							$mySubmits [1]
					);
				} else {
					$arr [] = array (
							$row [0],
							$row [1],
							$Submits [0],
							$Submits [1],
							$row[2]//专门用于/admin/contestM/edit
					);
				}
			}
			return $arr;
		} else {
			return null;
		}
	}
	
	public function get_all_inner_id($contest_id) {
		$res = parent::query("SELECT inner_id FROM contest_pro WHERE contest_id = ? ORDER BY inner_id", $contest_id);
		if($res->rowCount() != 0) {
			while($row = $res->fetch(PDO::FETCH_NUM)) {
				$args[] = $row[0];
			}
			return $args;
		} else {
			return null;
		}
	}
	
	public function get_real_Id($pid, $contest_id) {
		$result = parent::query_one( "SELECT pro_id FROM contest_pro WHERE contest_id = ? AND inner_id = ? LIMIT 1", $contest_id, $pid );
		if ($result) {
			return $result[0];
		} else {
			return - 1;
		}
	}
	public function get_problem($pid, $inner_id) {
		$body = $this->model->get_problem ( $pid );
		if (isset ( $body ['pro_id'] )) {
			$body ['pro_id'] = $inner_id;
		}
		return $body;
	}
}
?>
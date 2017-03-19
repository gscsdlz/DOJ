<?php
if (defined ( 'APPPATH' )) {
	require APPPATH . '/Model/contestModel.php';
} else {
	die ( 'aContestModel' );
}
class aContestModel extends contestModel {
	public function __construct() {
		parent::__construct ();
	}
	public function get_problem_info($pro_id) {
		$res = parent::query_one ( "SELECT pro_title FROM problem WHERE pro_id = ?", $pro_id );
		if ($res) {
			return $res [0];
		} else {
			return null;
		}
	}
	public function add_problem($prolist, $cid, $contest_name, $username, $contest_pass, $c_stime, $c_etime) {
		$user_id = $this->check_user ( $username );
		if ($cid == 0) {
			$newContest = true; // 避免再次检查题目问题
			$cid = parent::insert ( "INSERT INTO contest (contest_name, user_id, contest_pass, c_stime, c_etime) VALUES (?, ? ,? ,? ,?)", $contest_name, $user_id, $contest_pass, $c_stime, $c_etime );
			if ($cid <= 0)
				return - 1;
		} else {
			$status = parent::update ( "UPDATE contest SET contest_name = ?, user_id= ?, contest_pass= ?, c_stime = ? , c_etime = ? WHERE contest_id = ?", $contest_name, $user_id, $contest_pass, $c_stime, $c_etime, $cid );
		}
		$pro_arr = array ();
		if (count ( $prolist ))
			foreach ( $prolist as $row ) {
				$inner_id = $row [0];
				$pro_id = $row [1];
				$pro_arr [] = $pro_id;
				$res = parent::query_one ( "SELECT inner_id FROM contest_pro WHERE contest_id = ? AND pro_id = ?", $cid, $pro_id );
				if ($res) {
					if ($res [0] != $inner_id) {
						parent::update ( "UPDATE contest_pro SET inner_id = ? WHERE contest_id = ? AND pro_id = ?", $inner_id, $cid, $pro_id );
					}
				} else {
					parent::insert ( "INSERT INTO contest_pro (contest_id, inner_id, pro_id) VALUES (?, ? ,?)", $cid, $inner_id, $pro_id );
				}
			}
		if (! isset ( $newContest )) {
			$res = parent::query ( "SELECT pro_id FROM contest_pro WHERE contest_id = ?", $cid );
			while ( $row = $res->fetch ( PDO::FETCH_NUM ) ) {
				if (! in_array ( $row [0], $pro_arr )) {
					parent::query ( "DELETE FROM contest_pro WHERE contest_id = ? AND pro_id = ? LIMIT 1", $cid, $row[0] );
				}
			}
		}
		return $cid;
	}
	
	public function del_contest($cid) {
		return parent::update("DELETE FROM contest WHERE contest_id = ? LIMIT 1", $cid);
	}
	public function check_user($username) {
		$res = parent::query_one ( "SELECT user_id FROM users WHERE username = ?", $username );
		if ($res) {
			return $res [0];
		}
		return false;
	}
}
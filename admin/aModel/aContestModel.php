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
	
	public function get_users($cid) {
		$res = parent::query("SELECT users.user_id, username FROM contest_user LEFT JOIN users ON(contest_user.user_id = users.user_id) WHERE contest_id = ?", $cid);
		$args = array();
		while($row = $res->fetch(PDO::FETCH_NUM)) {
			$args[] = $row;
		}
		return $args;
	}
	
	public function save_users($cid, $lists) {
		if(count($lists) == 0)
			return false;
		$res = parent::query("SELECT user_id FROM contest_user WHERE contest_id = ?", $cid);
		$ids = array();
		while($row = $res->fetch(PDO::FETCH_NUM)) {
			$ids[] = $row[0];
		}
		
		foreach($lists as $id) {
			if(!in_array($id, $ids))
				parent::insert("INSERT INTO contest_user VALUES  (?, ?) ", $id, $cid);	
		}
		foreach($ids as $id) {
			if(!in_array($id, $lists)) 
				parent::update("DELETE FROM contest_user WHERE contest_id = ? AND user_id = ? LIMIT 1", $cid, $id);
		}
		return true;
	}
	
	
	
	public function balloon($cid) {
		
		$res =  parent::query("SELECT username, seat, pro_id, users.user_id, submit_time, submit_id FROM users LEFT JOIN `status` ON (`status`.user_id = users.user_id) WHERE contest_id = ? AND status = 4 AND balloon = 0 ", $cid);
		$args = array();
		while($row = $res->fetch(PDO::FETCH_NUM)) {
			$args[$row[5]] = $row;
			$args[$row[5]][2] = parent::get_inner_Id($row[2], $cid);
			$args[$row[5]][] = 0;
		}

		$fb = array();
		foreach ($args as $row) {
			if(!isset($fb[$row[2]])) {
				$fb[$row[2]][0] = $row[4];
				$fb[$row[2]][1] = $row[5];
			} else {
				if($fb[$row[2]] > $row[4]) {
					$fb[$row[2]][0] = $row[4];
					$fb[$row[2]][1] = $row[5];
				}
			}
		}
		foreach ($fb as $f) {
			$args[$f[1]][] = 1;
		}
		return $args;
	}
}

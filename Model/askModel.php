<?php
class askModel extends DB {
	public function __construct() {
		parent::__construct ();
	}
	
	public function get_list_by_cid($cid) {
		$res = parent::query("SELECT question.*, users.username FROM users LEFT JOIN question ON(users.user_id = question.user_id) WHERE contest_id = ?", $cid);
		if($res->rowCount() != 0) {
			while($row = $res->fetch(PDO::FETCH_NUM)) {
				$args[] = $row;
			}
			return $args;
		}
		return null;
	}
	
	
	
	public function put_ask($pro_id, $user_id, $topic, $cid = 0) {
		$time = time();
		return parent::query("INSERT INTO question (pro_id, user_id, topic_question, contest_id, ask_time) VALUES(?,?,?,?,?)", $pro_id, $user_id, $topic, $cid, $time);
	}
}
?>
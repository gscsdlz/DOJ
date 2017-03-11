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
	
	public function put_answer($question_id, $user_id, $topic) {
		$time = time();
		return parent::query("INSERT INTO answer (user_id, topic_answer, question_id, replay_time) VALUES(?,?,?,?)", $user_id, $topic, $question_id, $time);
		
	}
	
	public function put_question($pro_id, $user_id, $topic, $cid = 0) {
		$time = time();
		return parent::query("INSERT INTO question (pro_id, user_id, topic_question, contest_id, ask_time) VALUES(?,?,?,?,?)", $pro_id, $user_id, $topic, $cid, $time);
	}
	
	public function delete_question($ask_id, $user_id) {
		$realId = parent::query("SELECT user_id FROM question WHERE question_id = ? AND user_id = ?", $ask_id, $user_id);
		if($realId->rowCount() != 0) {
			return parent::query("DELETE FROM question WHERE question_id = ?", $ask_id);
		}
		return false;
	}
	
	public function delete_answer($question_id, $user_id) {
		$realId = parent::query("SELECT user_id FROM answer WHERE answer_id = ? AND user_id = ?", $question_id, $user_id);
		if($realId->rowCount() != 0) {
			return parent::query("DELETE FROM answer WHERE answer_id = ?", $question_id);
		}
		return false;
	}
	
	
	public function get_answer($question_id) {
		$args[] = parent::query_one("SELECT question.*, users.username FROM users LEFT JOIN question ON(users.user_id = question.user_id) WHERE question.question_id = ?", $question_id);
		$res = parent::query("SELECT answer.*, users.username FROM  users LEFT JOIN answer ON(users.user_id = answer.user_id) WHERE question_id = ?", $question_id);
		if($res->rowCount() != 0) {
			while($row = $res->fetch(PDO::FETCH_NUM)) {
				$args[] = $row;
			}
		}
		return $args;
	}
}
?>
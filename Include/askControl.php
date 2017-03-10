<?php
require 'Model/askModel.php';

class askControl {
	private static $model = null;
	public function __construct() {
		if (self::$model == null) {
			self::$model = new askModel ();
		}
	}
	public function asklist() {
		global $contest;
		$cid = ( int ) post ( 'id' );
		$contest = $cid;
		$args = self::$model->get_list_by_cid ( $cid );
		var_dump ( $args );
	}
	public function submit() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST' && isset ( $_SESSION ['user_id'] )) {
			$pro_id = ( int ) post ( 'pro_id' );
			$topic = post ( 'topic' );
			$cid = ( int ) post ( 'contest' );
			$user_id = $_SESSION['user_id'];
			global $contest;
			$contest = $cid;
			if (self::$model->put_ask ( $pro_id, $user_id, $topic, $cid )) {
				echo json_encode ( array (
						'status' => true 
				) );
				return;
			}
		}
		echo json_encode ( array (
				'status' => false 
		) );
	}
}
?>
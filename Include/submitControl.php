<?php
if (defined ( 'APPPATH' )) {
	require APPPATH . '/Model/submitModel.php';
	require APPPATH . '/Model/contestModel.php';
} else {
	die ();
}
class submitControl {
	private static $model = null;
	private static $contestModel = null;
	public function __construct() {
		if (self::$model == null)
			self::$model = new submitModel ();
		if (self::$contestModel == null)
			self::$contestModel = new contestModel ();
	}
	public function index() {
		$this->submit ();
	}
	public function submit() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST' && isset ( $_SESSION ['user_id'] )) {
			$pro_id = ( int ) post ( 'pro_id' );
			$lang = ( int ) post ( 'lang' );
			$codes = post ( 'codes' );
			$cid = ( int ) post ( 'contestId' );
			$uid = $_SESSION ['user_id'];
			if ($cid == 0 || self::$contestModel->privilege_check ( $cid, $uid )) {
				$res = self::$model->insertCode ( $uid, $pro_id, $lang, $codes, $cid );
				if ($res) {
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
}
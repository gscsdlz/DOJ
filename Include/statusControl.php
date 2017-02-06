<?php
require_once 'Include/function.php';
require_once 'Model/statusModel.php';
require_once 'View/VIEW.class.php';
class statusControl {
	private static $model = null;
	public function __construct() {
		if (self::$model == null) {
			self::$model = new statusModel ();
		}
	}
	public function __call($method, $args) {
		VIEW::show ( 'error', array (
				'errorInfo' => 'Invalid action' 
		) );
	}
	public function index() {
		$submit_id = ( int ) get ( 'rid' );
		$pro_id = ( int ) get ( 'pid' );
		$username = get ( 'Programmer' );
		$lang = ( int ) get ( 'lang' );
		$status = ( int ) get ( 'status' );
		$start = ( int ) get ( 'start' );
		$end = ( int ) get ( 'end' );
		$results = self::$model->getStatus ( $submit_id, $pro_id, $username, $lang, $status, $start, $end, 0);
		VIEW::loopshow ( 'status', $results );
	}
}
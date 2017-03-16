<?php
if (defined ( 'APPPATH' )) {
	require APPPATH . '/admin/aView/aVIEW.class.php';
	require APPPATH . '/admin/aModel/aContestModel.php';
} else {
	die ( 'contestMControl' );
}
class contestMControl {
	private static $model = null;
	public function __construct() {
		if (self::$model == null) {
			self::$model = new aContestModel ();
		}
	}
	public function page() {
		if (isset ( $_SESSION ['user_id'] ) && ($_SESSION ['privilege'] [0] == 1 || isset ( $_SESSION ['privilege'] [1] ))) {
			$args = self::$model->get_lists ();
			aVIEW::loopshow ( 'contest_list', $args );
		} else {
			aVIEW::show ( 'error', array (
					'errorInfo' => 'Admin Error' 
			) );
		}
	}
	public function edit() {
		$cid = (int)get('id');
		
		if($cid == 0) {
			if(isset($_SESSION['user_id']) && $_SESSION['privilege'][0] == 1) {
				aVIEW::loopshow('contest_edit', array());
			}
		} else {
			if(isset($_SESSION['user_id']) && ($_SESSION['privilege'][0] == 1 || isset($_SESSION['privilege'][1][$cid]))) {
				$args[] = self::$model->get_lists($cid);
				$args[] = self::$model->get_problem_list($cid, -2);
				aVIEW::loopshow('contest_edit', $args);
			}
		}
	}
}
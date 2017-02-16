<?php
require_once 'Include/function.php';
require_once 'Model/contestModel.php';
require_once 'Model/problemModel.php';
require_once 'Model/statusModel.php';
require_once 'Model/codeModel.php';
require_once 'View/VIEW.class.php';

class contestControl {
	private static $model = null;
	private static $problemModel = null;
	private static $statusModel = null;
	private static $codeModel = null;
	public function __construct() {
		if (self::$model == null) {
			self::$model = new contestModel ();
		}
		if (self::$problemModel == null) {
			self::$problemModel = new problemModel ();
		}
		if (self::$statusModel == null) {
			self::$statusModel = new statusModel ();
		}
		if (self::$codeModel == null) {
			self::$codeModel = new codeModel ();
		}
	}
	public function page() {
		$args = self::$model->get_lists ();
		VIEW::loopshow ( 'contest_list', $args );
	}
	public function show() {
		global $contest;
		$cid = get ( 'id' );
		$contest = $cid;
		$args[] = self::$model->get_lists($cid);
		$args[] = self::$model->get_problem_list ( $cid );
		VIEW::loopshow ( 'problem_list', $args );
	}
	public function problem() {
		global $contest;
		
		$innerId = get ( 'pid' );
		$contestId = get ( 'id' );
		$contest = $contestId;
		$problemId = self::$model->get_real_id ( $innerId, $contestId );
		$body = self::$model->get_problem ( $problemId, $innerId );
		$submits = self::$problemModel->get_submits ( $problemId, $contest );
		
		if ($body) {
			$body ['aSubmit'] = $submits [0];
			$body ['tSubmit'] = $submits [1];
			VIEW::show ( 'problem', $body );
		} else
			VIEW::show ( 'error', array (
					'errorInfo' => 'Invalid Id' 
			) );
	}
	
	public function code() {
		global $contest;
		
		$submit_id = (int)get ( 'pid' );
		$contestId = (int)get ( 'id' );
		$contest = $contestId;
		$res = self::$codeModel->getCode ( $submit_id );
		if ($res) {
			VIEW::show ( 'code', $res );
		} else {
			VIEW::show ( 'error', array (
					'errorInfo' => 'Invalid Id' 
			) );
		}
	}
}
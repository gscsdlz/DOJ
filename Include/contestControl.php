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
		if (isset ( $_SESSION ['user_id'] ))
			$uid = $_SESSION ['user_id'];
		else
			$uid = 0;
		$status = self::$model->privilege_check ( $cid, $uid );
		/**
		 * $status = 0 一切正常开始显示
		 * = 1弹出需要输入密码框
		 * = -1比赛未开始
		 * = -2 比赛权限不足
		 */
		$args [] = self::$model->get_lists ( $cid );
		if ($status == 0) { // 检查用户权限以及比赛是否开始			
			$args [] = self::$model->get_problem_list ( $cid );
			VIEW::loopshow ( 'contest_problem_list', $args );
		} else if ($status == 1) {
			$args[] = array('pass' => true);
			VIEW::loopshow ( 'contest_problem_list', $args);
		} else if($status == -1) {
			$args[] = array('timeError' => true);
			VIEW::loopshow ( 'contest_problem_list', $args);
		} else {
			$args[] = array('privilegeError' => true);
			VIEW::loopshow ( 'contest_problem_list', $args);
		}
	}
	public function check() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			$cid = ( int ) get ( 'id' );
			$password = post ( 'contestpass' );
			if (isset ( $_SESSION ['user_id'] )) {
				$user_id = $_SESSION ['user_id'];
				if (self::$model->check ( $user_id, $cid, $password ))
					echo json_encode ( array (
							'status' => true 
					) );
				else
					echo json_encode ( array (
							'status' => false 
					) );
			}
		}
	}
	public function problem() {
		global $contest;
		
		$innerId = get ( 'pid' );
		$contestId = get ( 'id' );
		$contest = $contestId;
		if (self::$model->timeCheck ( $contestId ) == 0) { // 检查比赛是否开始
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
		} else {
			VIEW::show ( 'error', array (
					'errorInfo' => 'Time Error' 
			) );
		}
	}
	public function code() {
		global $contest;
		
		$submit_id = ( int ) get ( 'pid' );
		$contestId = ( int ) get ( 'id' );
		$contest = $contestId;
		$res = self::$codeModel->getCode ( $submit_id, $contest );
		if ($res) {
			VIEW::show ( 'code', $res );
		} else {
			VIEW::show ( 'error', array (
					'errorInfo' => 'Invalid Id' 
			) );
		}
	}
	public function ce() {
		global $contest;
		
		$submit_id = ( int ) get ( 'pid' );
		$contestId = ( int ) get ( 'id' );
		$contest = $contestId;
		$res = self::$codeModel->getCEInfo ( $submit_id, $contest );
		if ($res) {
			VIEW::show ( 'code', $res );
		} else {
			VIEW::show ( 'error', array (
					'errorInfo' => 'Invalid Id' 
			) );
		}
	}
	
	public function ranklist() {
		$cid = (int)get('id');
		VIEW::show('contest_ranklist', array());
	}
}
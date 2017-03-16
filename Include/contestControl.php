<?php
if (defined ( 'APPPATH' )) {
	require APPPATH.'/Model/contestModel.php';
	require_once APPPATH.'/Model/problemModel.php';
	require APPPATH.'/Model/statusModel.php';
	require APPPATH.'/Model/codeModel.php';
	require APPPATH.'/Model/rankModel.php';
	require APPPATH.'/View/VIEW.class.php';
	require APPPATH.'/Model/askModel.php';
} else {
	die ();
}
class contestControl {
	private static $model = null;
	private static $problemModel = null;
	private static $statusModel = null;
	private static $codeModel = null;
	private static $rankModel = null;
	private static $askModel = null;
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
		if (self::$rankModel == null) {
			self::$rankModel = new rankModel ();
		}
		if (self::$askModel == null) {
			self::$askModel = new askModel ();
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
		if (isset ( $_SESSION ['privilege'] ) && ($_SESSION ['privilege'] [0] == 1 || isset ( $_SESSION ['privilege'] [1] [$contest] )))
			$status = 0;
		$args [] = self::$model->get_lists ( $cid );
		if ($status == 0) { // 检查用户权限以及比赛是否开始
			$args [] = self::$model->get_problem_list ( $cid );
			VIEW::loopshow ( 'contest_problem_list', $args );
		} else if ($status == 1) {
			$args [] = array (
					'pass' => true 
			);
			VIEW::loopshow ( 'contest_problem_list', $args );
		} else if ($status == - 1) {
			$args [] = array (
					'timeError' => true 
			);
			VIEW::loopshow ( 'contest_problem_list', $args );
		} else {
			$args [] = array (
					'privilegeError' => true 
			);
			VIEW::loopshow ( 'contest_problem_list', $args );
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
		global $contest;
		
		$cid = ( int ) get ( 'id' );
		$contest = $cid;
		$args [] = self::$model->get_all_inner_id ( $cid );
		if ($args) {
			$args [] = self::$rankModel->contest_rank ( $cid );
			VIEW::loopshow ( 'contest_ranklist', $args );
		} else {
			VIEW::show ( 'error', array (
					'errorInfo' => 'Time Error' 
			) );
		}
	}
	public function asklist() {
		$cid = get ( 'id' );
		global $contest;
		$contest = $cid;
		$args [] = self::$model->get_problem_list ( $cid );
		$args [] = self::$askModel->get_list_by_cid ( $cid );
		VIEW::show ( 'contest_asklist', $args );
	}
	public function ask() {
		$cid = ( int ) get ( 'id' );
		$topic = ( int ) get ( 'pid' );
		global $contest;
		$contest = $cid;
		$args = self::$askModel->get_answer ( $topic );
		VIEW::loopshow ( 'contest_ask', $args );
	}
}
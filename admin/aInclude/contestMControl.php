<?php
if (defined ( 'APPPATH' )) {
	require APPPATH . '/admin/aModel/aContestModel.php';
	require APPPATH . '/admin/aModel/aUserModel.php';
} else {
	die ( 'contestMControl' );
}
class contestMControl {
	private static $model = null;
	private static $userModel = null;
	public function __construct() {
		if (self::$model == null) {
			self::$model = new aContestModel ();
		}
		if (self::$userModel == null) {
			self::$userModel = new aUserModel ();
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
	public function del_contest() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST' && isset ( $_SESSION ['user_id'] ) && $_SESSION ['privilege'] [0] == 1) {
			$cid = ( int ) post ( 'contestId' );
			$status = self::$model->del_contest ( $cid );
			if ($status == 1)
				echo json_encode ( array (
						'status' => true 
				) );
			else
				echo json_encode ( array (
						'status' => false,
						'info' => '删除失败' 
				) );
		}
	}
	public function edit() {
		$cid = ( int ) get ( 'id' );
		
		if ($cid == 0) {
			if (isset ( $_SESSION ['user_id'] ) && $_SESSION ['privilege'] [0] == 1) {
				aVIEW::loopshow ( 'contest_edit', array () );
			} else {
				aVIEW::show ( 'error', array (
						'errorInfo' => 'Admin Error' 
				) );
			}
		} else {
			if (isset ( $_SESSION ['user_id'] ) && ($_SESSION ['privilege'] [0] == 1 || isset ( $_SESSION ['privilege'] [1] [$cid] ))) {
				$args [] = self::$model->get_lists ( $cid );
				$args [] = self::$model->get_problem_list ( $cid, - 2 );
				$args [] = self::$userModel->get_group_info ();
				$args [] = self::$model->get_users ( $cid );
				aVIEW::loopshow ( 'contest_edit', $args );
			} else {
				aVIEW::show ( 'error', array (
						'errorInfo' => 'Admin Error' 
				) );
			}
		}
	}
	public function pro_check() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST' && isset ( $_SESSION ['user_id'] )) {
			$pro_id = ( int ) post ( 'pro_id' );
			$args = self::$model->get_problem_info ( $pro_id );
			if ($args) {
				echo json_encode ( array (
						'status' => true,
						'pro_title' => $args 
				) );
				return;
			}
		}
		echo json_encode ( array (
				'status' => false 
		) );
	}
	public function save() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST' && isset ( $_SESSION ['user_id'] )) {
			$cid = ( int ) post ( "contest_id" );
			$contest_name = post ( 'contest_name' );
			$username = post ( 'username' );
			$c_stime = ( int ) post ( 'c_stime' );
			$c_etime = ( int ) post ( 'c_etime' );
			$contest_pass = post ( 'contest_pass' );
			$prolist = post ( 'prolist' );
			$info = '';
			if (! strlen ( $contest_name ))
				$info .= '比赛名称为空<br/>';
			if (! strlen ( $username ) || ! self::$model->check_user ( $username ))
				$info .= '比赛管理员为空或者非法<br/>';
			if (! (strlen ( $contest_pass ) >= 6 || $contest_pass == '1' || $contest_pass == ' 2'))
				$info .= '比赛权限没有设置正确请检查<br/>';
			if ($c_stime < '1407064249' || $c_etime < $c_stime)
				$info .= '比赛时间不正确<br/>';
			if ($info == '') {
				if ($_SESSION ['privilege'] [0] == 1 || isset ( $_SESSION ['privilege'] [1] [$cid] )) {
					$status = self::$model->add_problem ( $prolist, $cid, $contest_name, $username, $contest_pass, $c_stime, $c_etime );
					if ($status > 0)
						echo json_encode ( array (
								'status' => true,
								'contest_id' => $status 
						) );
					else
						echo json_encode ( array (
								'status' => false,
								'info' => '修改失败' 
						) );
				} else {
					echo json_encode ( array (
							'status' => false,
							'info' => 'Privilege Error' 
					) );
				}
			} else {
				echo json_encode ( array (
						'status' => false,
						'info' => $info 
				) );
			}
		}
	}
	public function save_user() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			$cid = ( int ) post ( 'cid' );
			if ($cid) {
				if (isset ( $_SESSION ['username'] ) && ($_SESSION ['privilege'] [0] == 1 || isset ( $_SESSION ['privilege'] [1] [$cid] ))) {
					$userlist = post ( 'users' );
					$status = self::$model->save_users ( $cid, $userlist );
					if ($status)
						echo json_encode ( array (
								'status' => true 
						) );
					else
						echo json_encode ( array (
								'status' => false,
								'info' => '' 
						) );
				}
			}
		}
	}
	public function get_balloon() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			$cid = ( int ) post ( 'cid' );
			if ($cid != 0 && isset ( $_SESSION ['user_id'] ) && ($_SESSION ['privilege'] [0] == 1 || isset ( $_SESSION ['privilege'] [1] [$cid] ))) {
				$args = self::$model->balloon ( $cid );
				if ($args)
					echo json_encode ( array (
							'status' => true,
							'info' => $args 
					) );
				else
					echo json_encode ( array (
							'status' => false 
					) );
			}
		}
	}
	
	public function send_balloon() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			$cid = ( int ) post ( 'cid' );
			if ($cid != 0 && isset ( $_SESSION ['user_id'] ) && ($_SESSION ['privilege'] [0] == 1 || isset ( $_SESSION ['privilege'] [1] [$cid] ))) {
				$submit_id = (int)post('sid');
				$args = self::$model->setballoon ( $submit_id);
				if ($args == 1)
					echo json_encode ( array (
							'status' => true,
					) );
					else
						echo json_encode ( array (
								'status' => false,
								'info' => '操作失败，请重试'
						) );
			}
		}
	}
}
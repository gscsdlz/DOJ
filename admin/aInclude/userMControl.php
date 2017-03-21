<?php
if (defined ( 'APPPATH' )) {
	require APPPATH . '/admin/aModel/aUserModel.php';
} else {
	die ( 'UserMControl' );
}
class userMControl {
	private static $model = null;
	public function __construct() {
		if (self::$model == null) {
			self::$model = new aUserModel ();
		}
	}
	public function group() {
		if (isset ( $_SESSION ['user_id'] ) && $_SESSION ['privilege'] [0] == 1) {
			$args = self::$model->get_group_info ();
			aVIEW::loopshow ( 'group', $args );
		}
	}
	public function groupList() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST' && isset ( $_SESSION ['user_id'] ) && $_SESSION ['privilege'] [0] == 1) {
			$gid = ( int ) post ( 'gid' );
			$args = self::$model->get_group_list ( $gid );
			echo json_encode ( $args );
		}
	}
	public function groupAdd() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST' && isset ( $_SESSION ['user_id'] ) && $_SESSION ['privilege'] [0] == 1) {
			$groupName = post ( 'groupName' );
			$status = self::$model->add_group ( $groupName );
			if ($status == 0) {
				echo json_encode ( array (
						'status' => true 
				) );
			} else if ($status == - 1) {
				echo json_encode ( array (
						'status' => false,
						'info' => '已有同名小组' 
				) );
			} else {
				echo json_encode ( array (
						'status' => false,
						'info' => '未知错误，请重试' 
				) );
			}
		}
	}
	public function groupChange() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST' && isset ( $_SESSION ['user_id'] ) && $_SESSION ['privilege'] [0] == 1) {
			$gid = ( int ) post ( 'gid' );
			$users = post ( 'users' );
			if ($gid < 0 || count ( $users ) == 0) {
				echo json_encode ( array (
						'status' => false,
						'info' => '空数据' 
				) );
			} else {
				$status = self::$model->change_group( $gid, $users );
				if ($status == 0)
					echo json_encode ( array (
							'status' => true 
					) );
				else
					echo json_encode ( array (
							'status' => false,
							'info' => '修改失败'
					));
			}
		}
	}
}
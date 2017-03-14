<?php
if (defined ( 'APPPATH' )) {
	require APPPATH . '/admin/aModel/aProblemModel.php';
	require APPPATH . '/admin/aView/aVIEW.class.php';
} else {
	die ( 'problemMControl' );
}
class problemMControl {
	private static $model = null;
	public function __construct() {
		if (self::$model == null) {
			self::$model = new aProblemModel ();
		}
	}
	public function page() {
		$pageId = get ( 'id' );
		if (! $pageId)
			$pageId = 0;
		$_GET ['pageid'] = $pageId; // 这里重新设置ID的意义在于 @problem_list:4 需要通过读取GET数组确定分页单元的显示
		$lists = self::$model->get_list ( $pageId );
		if ($lists)
			aVIEW::loopshow ( 'problem_list', $lists );
		else
			aVIEW::show ( 'error', array (
					'errorInfo' => 'Invalid Id' 
			) );
	}
	public function show_problem() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST' && isset ( $_SESSION ['user_id'] ) && $_SESSION ['privilege'] [0] == 1) {
			$id = ( int ) post ( 'id' );
			$status = self::$model->set_problem ( $id, 1 );
			if ($status)
				echo json_encode ( array (
						'status' => true 
				) );
		}
	}
	public function hide_problem() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST' && isset ( $_SESSION ['user_id'] ) && $_SESSION ['privilege'] [0] == 1) {
			$id = ( int ) post ( 'id' );
			$status = self::$model->set_problem ( $id, 0 );
			if ($status)
				echo json_encode ( array (
						'status' => true 
				) );
		}
	}
	public function hidden() {
		$lists = self::$model->get_all_hidden ();
		aVIEW::loopshow ( 'problem_list', $lists );
	}
	public function edit() {
		$id = ( int ) get ( 'id' );
		$body = array ();
		if ($id != 0) { // 不是新增题目
			$body = self::$model->get_problem ( $id );
			if ($body)
				aVIEW::show ( 'problem_edit', $body );
			else
				aVIEW::show ( 'error', array (
						'errorInfo' => 'Invalid Id' 
				) );
		} else {
			aVIEW::loopshow('problem_edit', array());
		}
	}
}
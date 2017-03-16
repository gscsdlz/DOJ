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
		if (isset ( $_SESSION ['user_id'] ) && $_SESSION ['privilege'] [0] == 1) {
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
		} else {
			aVIEW::show ( 'error', array (
					'errorInfo' => 'Admin Error' 
			) );
		}
	}
	public function del_problem() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST' && isset ( $_SESSION ['user_id'] ) && $_SESSION ['privilege'] [0] == 1) {
			$id = ( int ) post ( 'pro_id' );
			$status = self::$model->del_problem ( $id );
			if ($status)
				echo json_encode ( array (
						'status' => true 
				) );
			else
				echo json_encode ( array (
						'status' => '删除失败' 
				) );
		}
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
		if (isset ( $_SESSION ['user_id'] ) && $_SESSION ['privilege'] [0] == 1) {
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
				aVIEW::loopshow ( 'problem_edit', array () );
			}
		} else {
			aVIEW::show ( 'error', array (
					'errorInfo' => 'Admin Error' 
			) );
		}
	}
	public function editPost() {
		if ($_SERVER ['REQUEST_METHOD'] == 'POST' && isset ( $_SESSION ['user_id'] ) && $_SESSION ['privilege'] [0] == 1) {
			$id = ( int ) post ( 'id' );
			$body = self::$model->get_problem ( $id );
			echo json_encode ( $body );
		}
	}
	public function savePro() {
		if (isset ( $_SESSION ['user_id'] ) && $_SESSION ['privilege'] [0] == 1) {
			$pro_id = ( int ) post ( 'pro_id' );
			$pro_title = post ( 'pro_title' );
			$time_limit = ( int ) post ( 'time_limit' );
			$memory_limit = ( int ) post ( 'memory_limit' );
			$pro_descrip = post ( 'pro_descrip' );
			$pro_in = post ( 'pro_in' );
			$pro_out = post ( 'pro_out' );
			$pro_dataIn = post ( 'pro_dataIn' );
			$pro_dataOut = post ( 'pro_dataOut' );
			$hint = post ( 'hint' );
			$author = post ( 'author' );
			
			if ($pro_id == 0) {
				$status = self::$model->insert_pro ( $pro_title, $time_limit, $memory_limit, $pro_descrip, $pro_in, $pro_out, $pro_dataIn, $pro_dataOut, $hint, $author );
				if ($status) {
					echo json_encode ( array (
							'status' => true,
							'pro_id' => self::$model->get_maxId()
					) );
				}
			} else {
				$status = self::$model->update_pro ( $pro_id, $pro_title, $time_limit, $memory_limit, $pro_descrip, $pro_in, $pro_out, $pro_dataIn, $pro_dataOut, $hint, $author );
				if ($status) {
					echo json_encode ( array (
							'status' => '更新成功' 
					) );
				} else {
					echo json_encode ( array (
							'status' => '更新失败，请重试' 
					) );
				}
			}
		}
	}
}
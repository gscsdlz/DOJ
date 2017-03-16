<?php
if (defined ( 'APPPATH' )) {
	require APPPATH . '/Model/problemModel.php';
	require APPPATH . '/View/VIEW.class.php';
} else {
	die ();
}
class problemControl {
	private static $model = null;
	public function __construct() {
		if (self::$model == null) {
			self::$model = new problemModel ();
		}
	}
	public function index() {
		$this->page ();
	}
	public function __call($method, $args) {
		VIEW::show ( 'error', array (
				'errorInfo' => 'Invalid Action' 
		) );
	}
	public function show() {
		$problemId = get ( 'id' );
		if (! $problemId)
			$problemId = '1000';
		$body = self::$model->get_problem ( $problemId ); // 获取页面主体
		$submits = self::$model->get_submits ( $problemId );
		/**
		 * 管理员添加题目以后 允许查看隐藏题目 @/admin/aView/problem_list.php
		 */
		if($body['visible'] == 0)
			if(!(isset($_SESSION['user_id']) && $_SESSION['privilege'][0] == 1))
				$body = null;   
		if ($body) {
			$body ['aSubmit'] = $submits [0];
			$body ['tSubmit'] = $submits [1];
			VIEW::show ( 'problem', $body );
		} else
			VIEW::show ( 'error', array (
					'errorInfo' => 'Invalid Id' 
			) );
	}
	public function page() {
		$pageId = get ( 'id' );
		if (! $pageId)
			$pageId = 0;
		$_GET ['pageid'] = $pageId; // 这里重新设置ID的意义在于 @problem_list:4 需要通过读取GET数组确定分页单元的显示
		$lists = self::$model->get_list ( $pageId );
		if ($lists)
			VIEW::loopshow ( 'problem_list', $lists );
		else
			VIEW::show ( 'error', array (
					'errorInfo' => 'Invalid Id' 
			) );
	}
	public function search() {
		$key = get ( 'key' );
		$lists = self::$model->get_search_result ( $key );
		VIEW::loopshow ( 'problem_list', $lists );
	}
}
?>

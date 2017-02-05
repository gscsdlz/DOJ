<?php
require_once 'Include/function.php';
require_once 'Model/problemModel.php';
require_once 'View/VIEW.class.php';
class problemControl {
	private static $model = null;
	public function __construct() {
		if (self::$model == null) {
			self::$model = new problemModel ();
		}
	}
	public function index() {
		$this->show ();
	}
	public function __call($method, $args) {
		VIEW::show ( 'error', array (
				'errorInfo' => 'Invalid action' 
		) );
	}
	public function show() {
		$problemId = get ( 'id' );
		if (! $problemId)
			$problemId = '1000';
		$body = self::$model->get_problem ( $problemId ); // 获取页面主体
		$submits = self::$model->get_submits ( $problemId );
		$body ['aSubmit'] = $submits [0];
		$body ['tSubmit'] = $submits [1];
		if ($body)
			VIEW::show ( 'problem', $body );
		else
			VIEW::show ( 'error', array (
					'errorInfo' => 'Invalid Page' 
			) );
	}
	public function page() {
		$pageId = get ( 'id' );
		if(!$pageId)
			$pageId = 0;
		$_GET ['id'] = $pageId; // 有用
		$lists = self::$model->get_list ( $pageId );
		if ($lists)
			VIEW::loopshow ( 'problem_list', $lists );
		else
			VIEW::show ( 'error', array (
					'errorInfo' => 'Invalid Index' 
			) );
	}
	public function search() {
		$key = get ( 'key' );
		$lists = self::$model->get_search_result ( $key );
		if ($lists)
			VIEW::loopshow ( 'problem_list', $lists );
		else
			VIEW::show ( 'error', array (
					'errorInfo' => 'Invalid Key' 
			) );
	}
}
?>

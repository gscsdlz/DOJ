<?php

require'Model/problemModel.php';
require 'View/VIEW.class.php';
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
		$submits = self::$model->get_submits ( $problemId);
		
		if ($body) {
			$body ['aSubmit'] = $submits [0];
			$body ['tSubmit'] = $submits [1];
			VIEW::show ( 'problem', $body );
		}
		else
			VIEW::show ( 'error', array (
					'errorInfo' => 'Invalid Id' 
			) );
	}
	public function page() {
		$pageId = get ( 'id' );
		if(!$pageId)
			$pageId = 0;
		$_GET ['pageid'] = $pageId; // 这里重新设置ID的意义在于 @problem_list:4 需要通过读取GET数组确定分页单元的显示
		$lists = self::$model->get_list ( $pageId);
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

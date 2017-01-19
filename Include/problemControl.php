<?php
require_once 'Include/function.php';
require_once 'Model/problemModel.php';
require_once 'View/VIEW.class.php';
class problemControl{
	
	static private $model = null;
	public function __construct() {
		if(self::$model == null) {
			self::$model = new problemModel();
		}
	}
	public function index() {
		$this->show();
	}
	
	public function show() {
		$problemId = get('id');
		if(!$problemId)
			$problemId = '1000';
		$body = self::$model->get_problem($problemId); //获取页面主体
		if($body)
			VIEW::show('problem', $body);
		else
			VIEW::show('error', array('errorInfo' => 'Invalid Page'));
	}
	
	public function page() {
		$pageId = get('id');
		var_dump($pageId);
		$lists = self::$model->get_list($pageId);
		if($lists)
			VIEW::loopshow('problem_list', $lists);
		else 
			VIEW::show('error', array('errorInfo' => 'Invalid Index'));
	}
}
?>

<?php
require_once 'Include/function.php';
require_once 'Model/contestModel.php';
require_once 'View/VIEW.class.php';
class contestControl {
	private static $model = null;
	public function __construct() {
		if (self::$model == null) {
			self::$model = new contestModel ();
		}
	}
	public function page() {
		$args = self::$model->get_lists ();
		VIEW::loopshow ( 'contest_list', $args );
	}
	
	public function show() {
		$cid = get('id');
		$args = self::$model->get_problem_list($cid);
		
		global $contest;
		$contest = true;
		
		VIEW::loopshow('problem_list', $args);
	}
}
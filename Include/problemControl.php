<?php
namespace DOJ;

class problemControl{
	
	static private $model = null;
	public function __construct() {
		if(self::$model == null) {
			self::$model = new problemModel();
		}
	}
	
	public function problem() {
		$problemId = get('pro_id');
		$body = self::$model->get_problem($problemId); //获取页面主体
		if($body)
			VIEW::show('problem', $body);
		else
			VIEW::show('error', array($error => 'Invalid Page'));
	}
	
	public function page($list) {
		$lists = self::$model->get_list(0);
		if($lists)
			VIEW::loopshow('problem_list', $lists);
		else 
			VIEW::show('error', array($error => 'Invalid Index'));
	}
}
?>

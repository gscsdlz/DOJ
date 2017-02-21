<?php
require_once 'Include/function.php';
require_once 'View/VIEW.class.php';
require_once 'Model/userModel.php';
class userControl{
	private static $model = null;
	public function __construct() {
		if(self::$model == null) {
			self::$model = new userModel();
		}
	}
	
	public function show() {
		$username = get('id');
		$user_id = self::$model->getId($username);
		$arg[] = self::$model->getStatus($user_id);
		$arg[] = self::$model->get_ac_problem($user_id);
		$arg[] = self::$model->get_nac_problem($user_id);
		$arg[] = self::$model->get_user_info($user_id);
		$arg[] = self::$model->get_contest_info($user_id);
		$arg[] = self::$model->get_group_info();
		if($arg[3] != null)
			VIEW::loopshow('user', $arg);
		else
			VIEW::show('error', array('errorInfo' => 'Invalid User'));
	}
}
<?php
require_once 'Include/function.php';
require_once 'Model/codeModel.php';
require_once 'View/VIEW.class.php';
class codeControl{
	private static $model = null;
	public function __construct() {
		if(self::$model == null) {
			self::$model = new codeModel();
		}
	}
	
	public function show() {
		$submit_id = (int)get("id");
		$res = self::$model->getCode($submit_id);
		if($res) {
			VIEW::show('code', $res);
		} else {
			VIEW::show('error', array('errorInfo' => 'Invalid Id'));
		}
		
	}
	
	public function ce() {
		$submit_id = (int)get("id");
		$res = self::$model->getCEInfo($submit_id);
		if($res) {
			VIEW::show('code', $res);
		} else {
			VIEW::show('error', array('errorInfo' => 'Invalid Id'));
		}
	}
}
?>
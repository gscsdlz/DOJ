<?php
if(defined('APPPATH')) {
	require_once APPPATH.'/Model/codeModel.php';
	require_once APPPATH.'/View/VIEW.class.php';
} else {
	die ();
}
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
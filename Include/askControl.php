<?php
require 'Model/askModel.php';
require 'View/VIEW.class.php';
class askControl{
	private static $model = null;
	public function __construct() {
		if(self::$model == null) {
			self::$model = new askModel();
		}
	}
}
?>
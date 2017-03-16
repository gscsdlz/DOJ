<?php
if(defined('APPPATH')) {
	require APPPATH.'/Model/contestModel.php';
} else {
	die('aContestModel');
}

class aContestModel extends contestModel{
	public function __construct() {
		parent::__construct();
	}
	
	
}
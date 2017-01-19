<?php

require_once 'View/VIEW.class.php';
class indexControl{
	public function __construct() {
		
	}
	
	public function index() {
		VIEW::loopshow('default', array());
	}
}
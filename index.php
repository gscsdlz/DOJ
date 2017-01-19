<?php
	require_once 'Include/router.class.php';
	require_once 'Include/WORK.class.php';
	$router = new router();
	$controlClass = $router->control;
	$action = $router->action;
	
	require_once 'Include/'.$controlClass.'.php';
	$control = WORK::create($controlClass);
	$control->$action();
	
?>
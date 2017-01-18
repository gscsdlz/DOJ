<?php
namespace DOJ;
require_once 'Include/router.class.php';
$router = new router();
$controlClass = $router->control;
$action = $router->action;
include 'Include\\'.$controlClass.'.php';
$control = new $controlClass();
$control->$action();
?>
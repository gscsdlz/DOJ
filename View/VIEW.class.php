<?php
if(!defined('APPPATH')) {
	die();
}
class VIEW {
	static public function show($fileName, $args) {
		extract ( $args );
		if($fileName == 'error')
			header('HTTP/1.1 404 Not Found');
		require APPPATH.'/View/Template/header.php';
		require APPPATH.'/View/Template/navbar.php';
		require APPPATH.'/View/Template/' . $fileName . '.php';
		require APPPATH.'/View/Template/footer.php';
	}

	static public function loopshow($fileName, $args) {
		require APPPATH.'/View/Template/header.php';
		require APPPATH.'/View/Template/navbar.php';
		require APPPATH.'/View/Template/' . $fileName . '.php';
		require APPPATH.'/View/Template/footer.php';
	}
	
}
?>
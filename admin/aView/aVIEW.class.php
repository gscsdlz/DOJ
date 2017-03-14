<?php
if(!defined('APPPATH')) {
	die();
}
class aVIEW {
	static public function show($fileName, $args) {
		extract ( $args );
		if($fileName == 'error')
			header('HTTP/1.1 404 Not Found');
		require APPPATH.'/admin/aView/Template/header.php';
		require APPPATH.'/admin/aView/Template/navbar.php';
		if($fileName == 'error')
			require APPPATH.'/View/Template/error.php';
		else
			require APPPATH.'/admin/aView/Template/' . $fileName . '.php';
		require APPPATH.'/admin/aView/Template/footer.php';
	}

	static public function loopshow($fileName, $args) {
		require APPPATH.'/admin/aView/Template/header.php';
		require APPPATH.'/admin/aView/Template/navbar.php';
		require APPPATH.'/admin/aView/Template/' . $fileName . '.php';
		require APPPATH.'/admin/aView/Template/footer.php';
	}
	
}
?>
<?php
class VIEW {
	static public function show($fileName, $args) {
		extract ( $args );
		if($fileName == 'error')
			header('HTTP/1.1 404 Not Found');
		require_once 'Template/header.php';
		require_once 'Template/' . $fileName . '.php';
		require_once 'Template/footer.php';
	}

	static public function loopshow($fileName, $args) {
		require_once 'Template/header.php';
		require_once 'Template/' . $fileName . '.php';
		require_once 'Template/footer.php';
	}
	
}
?>
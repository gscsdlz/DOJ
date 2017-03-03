<?php
class VIEW {
	static public function show($fileName, $args) {
		extract ( $args );
		if($fileName == 'error')
			header('HTTP/1.1 404 Not Found');
		require 'Template/header.php';
		require 'Template/navbar.php';
		require 'Template/' . $fileName . '.php';
		require 'Template/footer.php';
	}

	static public function loopshow($fileName, $args) {
		require 'Template/header.php';
		require 'Template/navbar.php';
		require 'Template/' . $fileName . '.php';
		require 'Template/footer.php';
	}
	
}
?>
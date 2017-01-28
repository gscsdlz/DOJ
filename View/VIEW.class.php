<?php
class VIEW {
	static public function show($fileName, $args) {
		extract ( $args );
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
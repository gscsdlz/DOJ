<?php
class router {
	public $control;
	public $action;
	public function __construct() {
		$this->control = 'indexControl';
		$this->action = 'index';
		if (isset ( $_SERVER ['REQUEST_URI'] ) && $_SERVER ['REQUEST_URI'] != '/') {
			$path = $_SERVER ['REQUEST_URI'];
			$paths = explode ( '/', trim ( $path, '/' ) );
			if (isset ( $paths [0] )) {
				$this->control = $paths [0] . "Control";
			}
			if (isset ( $paths [1] )) {
				$this->action = $paths [1];
			}
			$pathstmp = explode('?',trim($path, '/'));
			if(isset($pathstmp[1])) {
				$paths = explode('&', $pathstmp[1]);
				$i = 0;
				$count = count ( $paths );
				while ( $i < $count ) {
					if(isset($paths[$i + 1])) {
						$_GET [$path[$i]] = $paths [$i + 1];
					}
					$i+=2;
				}
			} else {
				$i = 2;
				$count = count ( $paths );
				while ( $i < $count ) {					
					$_GET ['id'] = $paths [$i];					
					$i++;
				}
			}
		}
	}
}
?>
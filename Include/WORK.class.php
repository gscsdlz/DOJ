<?php
class WORK {
	static function create($className) {
		if ($className == 'problemControl')
			return new problemControl ();
		else if ($className == 'contestControl')
			return new contestControl ();
		else if ($className == "loginControl")
			return new loginControl ();
		else if ($className == 'statusControl')
			return new statusControl ();
		else if ($className == 'submitControl')
			return new submitControl ();
		else {
			require_once 'index.php';
			return new indexControl ();
		}
	}
}
?>
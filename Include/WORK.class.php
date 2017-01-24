<?php
class WORK {
	static function create($className) {
		if ($className == 'problemControl')
			return new problemControl ();
		else if ($className == 'contestControl')
			return new contestControl ();
		else if ($className == "loginControl")
			return new loginControl ();
		else
			return new indexControl ();
	}
}
?>
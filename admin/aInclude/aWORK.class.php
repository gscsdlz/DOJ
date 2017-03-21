<?php
class aWORK {
	static function create($className) {
		if ($className == 'problemMControl')
			return new problemMControl ();
		else if ($className == 'contestMControl')
			return new contestMControl ();
		else if($className == 'userMControl')
			return new userMControl();
	}
}
?>
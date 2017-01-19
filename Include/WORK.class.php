<?php

class WORK{
	static function create($className) {
		if($className == 'problemControl')
			return new problemControl();
		else if($className == 'contestControl')
			return new contestControl();
		else
			return new indexControl();
	}
}
?>
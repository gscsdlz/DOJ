<?php
namespace DOJ;
require_once 'Config/config.php';

class DB{
	static private $pdo = null;
	
	public function __construct(){
		global $dbname;
		global $dbhost;
		global $dbuser;
		global $dbpass;
		if(self::$pdo == null)
		{
			try {
				self::$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass);
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
			
	}
	
	public function query($args) {
		$argArray = func_get_args();
		$q = array_shift($argArray);  //去掉第一个查询字符串
		try {
			$result = self::$pdo->prepare($q);				
			$result->execute($argArray);
			return $result;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
}

?>
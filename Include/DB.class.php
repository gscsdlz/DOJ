<?php
require_once APPPATH . '/Config/config.php';
class DB {
	private static $pdo = null;
	public function __construct() {
		global $dbInfo;
		extract ( $dbInfo );
		if (self::$pdo == null) {
			try {
				self::$pdo = new PDO ( "mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass );
			} catch ( PDOException $e ) {
				echo $e->getMessage ();
			}
		}
	}
	public function query($args) {
		$argArray = func_get_args ();
		$q = array_shift ( $argArray );
		try {
			$result = self::$pdo->prepare ( $q );
			$result->execute ( $argArray );
			return $result;
		} catch ( PDOException $e ) {
			echo $e->getMessage ();
		}
	}
	public function transaction_query($args) {
		$argArray = func_get_args ();
		self::$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		self::$pdo->beginTransaction ();
		try {
			foreach ( $argArray as $q ) {
				$affectRow = self::$pdo->exec ( $q );
				if (! $affectRow) {
					throw new PDOException ( "ERROR" );
				}
			}
			self::$pdo->commit ();
		} catch ( PDOException $e ) {
			echo $e->getMessage ();
			self::$pdo->rollback ();
			return false;
		}
		return true;
	}
}

?>
<?php
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
	public function query_one($args) {
		$argArray = func_get_args ();
		$q = array_shift ( $argArray );
		try {
			$result = self::$pdo->prepare ( $q );
			$result->execute ( $argArray );
		} catch ( PDOException $e ) {
			echo $e->getMessage ();
		}
		
		if ($result->rowCount () != 0) {
			$row = $result->fetch ( PDO::FETCH_NUM );
			return $row;
		} else {
			return null;
		}
	}
	/**
	 * 支持事务处理的函数
	 * 提交的语句必须经过转义
	 * $args形式为字符串数组
	 *
	 * @var array $argArray
	 */
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
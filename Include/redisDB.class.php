<?php
class redisDB{
	public static $conn = null;
	public function __construct() {
		if(self::$conn == null) {
			self::$conn = new Redis();
			try {
				self::$conn->connect('127.0.0.1', 6379);
			} catch (RedisException $e) {
				echo 'RedisException';
			}
		}
	}
}
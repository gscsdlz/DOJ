<?php
if (defined ( 'APPPATH' )) {
	require APPPATH . '/Model/userModel.php';
} else {
	die ( 'aUserModel' );
}
class aUserModel extends userModel {
	public function __construct() {
		parent::__construct ();
	}
	
	
	public function get_group_info() {
		@override;
		$res = parent::query("SELECT `group`.*, COUNT(user_id) FROM users RIGHT JOIN `group` ON (users.group_id = `group`.`group_id`) GROUP BY `group`.`group_id`");
		while($row = $res->fetch(PDO::FETCH_NUM )) {
			$args[] = $row;
		}
		return $args;
	}
	
	public function get_group_list($gid) {
		$res = parent::query("SELECT users.username, users.user_id FROM users RIGHT JOIN `group` ON (users.group_id = `group`.`group_id`) WHERE `group`.`group_id` = ?", $gid);
		while($row = $res->fetch(PDO::FETCH_NUM)) {
			$args[]  = $row;
		}
		if($args[0][0])
			return $args;
		return null;
	}
	
	public function add_group($groupName) {
		$res = parent::query("SELECT * FROM `group` WHERE group_name = ?", $groupName);
		if($res->rowCount() != 0)
			return -1;
		$id = parent::insert("INSERT INTO `group` VALUES (NULL, ?)", $groupName);
		if($id > 0)
			return 0;
		else
			return -2;
	}
	
	public function change_group($gid, $users) {
		$tmp = parent::query("SELECT * FROM `group` WHERE group_id = ?", $gid);
		if($tmp->rowCount() != 0) {
			for($i = 0; $i < count($users); ++$i) {
				parent::update("UPDATE users SET `group_id` = ? WHERE user_id = ?", $gid, $users[$i]);
			}
			return 0;
		} else {
			return -1;
		}
	}
}
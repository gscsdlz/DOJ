<?php
if (defined ( 'APPPATH' )) {
	require APPPATH . '/Model/problemModel.php';
} else {
	die ( 'aProblemModel' );
}
class aProblemModel extends problemModel {
	public function __construct() {
		parent::__construct ();
	}
	public function get_list($listId) {
		@override;
		$pms = PROBLEMPAGEMAXSIZE;
		$listId *= $pms;
		
		$arr [] = array (
				parent::get_maxProblem (),
				$pms 
		);
		$result = parent::query ( "SELECT pro_id, pro_title, visible FROM problem LIMIT $listId, $pms" );
		if ($result->rowCount () != 0) {
			while ( $row = $result->fetch ( PDO::FETCH_NUM ) ) {
				$arr [] = $row;
			}
			return $arr;
		} else
			return null;
	}
	public function get_all_hidden() {
		$result = parent::query ( "SELECT pro_id, pro_title, visible FROM problem WHERE visible = 0");
		if ($result->rowCount () != 0) {
			while ( $row = $result->fetch ( PDO::FETCH_NUM ) ) {
				$arr [] = $row;
			}
			return $arr;
		} else
			return null;
	}
	public function set_problem($pro_id, $visible) {
		return parent::update ( "UPDATE problem SET visible = ? WHERE pro_id = ? LIMIT 1", $visible, $pro_id );
	}
}
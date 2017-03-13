<?php
if (defined ( 'APPPATH' )) {
	require APPPATH . '/Model/problemModel.php';
} else {
	die ('aProblemModel');
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
				parent::get_maxProblem(),
				$pms 
		);
		$result = parent::query ( "SELECT pro_id, pro_title FROM problem LIMIT $listId, $pms" );
		if ($result->rowCount () != 0) {
			while ( $row = $result->fetch ( PDO::FETCH_NUM ) ) {
				$arr [] = array (
						$row [0],
						$row [1] 
				);
			}
			return $arr;
		} else
			return null;
	}
}
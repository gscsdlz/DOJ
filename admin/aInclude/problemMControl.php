<?php
if (defined ( 'APPPATH' )) {
	require APPPATH . '/admin/aModel/aProblemModel.php';
	require APPPATH . '/admin/aView/aVIEW.class.php';
} else {
	die ('problemMControl');
}
class problemMControl {
	private static $model = null;
	public function __construct() {
		if (self::$model == null) {
			self::$model = new aProblemModel ();
		}
	}
	public function page() {
		$pageId = get ( 'id' );
		if (! $pageId)
			$pageId = 0;
		$_GET ['pageid'] = $pageId; // 这里重新设置ID的意义在于 @problem_list:4 需要通过读取GET数组确定分页单元的显示
		$lists = self::$model->get_list ( $pageId );
		if ($lists)
			aVIEW::loopshow ( 'problem_list', $lists );
		else
			aVIEW::show ( 'error', array (
					'errorInfo' => 'Invalid Id' 
			) );
	}
}
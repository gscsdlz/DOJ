<?php
require_once 'Include/function.php';
require_once 'View/VIEW.class.php';
require_once 'Model/userModel.php';
class userControl {
	private static $model = null;
	public function __construct() {
		if (self::$model == null) {
			self::$model = new userModel ();
		}
	}
	public function show() {
		$username = get ( 'id' );
		$user_id = self::$model->getId ( $username );
		$arg [] = self::$model->getStatus ( $user_id );
		$arg [] = self::$model->get_ac_problem ( $user_id );
		$arg [] = self::$model->get_nac_problem ( $user_id );
		$arg [] = self::$model->get_user_info ( $user_id );
		$arg [] = self::$model->get_contest_info ( $user_id );
		$arg [] = self::$model->get_group_info ();
		if ($arg [3] != null)
			VIEW::loopshow ( 'user', $arg );
		else
			VIEW::show ( 'error', array (
					'errorInfo' => 'Invalid User' 
			) );
	}
	public function uploadHeader() {
		$allowType = array (
				"jpg",
				"png",
				"gif" 
		);
		$allowMIME = array (
				"image/png",
				"image/jpeg",
				"image/gif" 
		);
		if ($_SERVER ['REQUEST_METHOD'] == 'POST' && isset ( $_SESSION ['user_id'] )) {
			if (isset ( $_FILES ['file'] )) {
				$file = $_FILES ['file'];
				/**
				 * error {
				 * 0 成功
				 * 1超过upload_max_filesize
				 * 2超过MAX_FILE_SIZE
				 * 3部分上传
				 * 4无文件
				 * }
				 */
				$fileinfo = explode ( '.', $file ['name'] )[1];
				if ($file ['error'] == 0 
						&& in_array ( strtolower ( $fileinfo), $allowType )
						&& in_array ( $file ['type'], $allowMIME )) {
					$filename = $_SESSION ['user_id'] . time () . rand ( 0, 255 ) . '.' .$fileinfo;
					$oldfile = self::$model->get_filename($_SESSION['user_id']);
					
					if(move_uploaded_file ( $file ['tmp_name'], APPPATH.'\Src\Image\header\\'.$filename )) {
						if($oldfile != 'default.jpg') {
							unlink(APPPATH.'\Src\Image\header\\'.$oldfile);
						}
						self::$model->save_filename ( $filename, $_SESSION ['user_id'] );
						echo json_encode ( array (
								'status' => $filename
						) );
					}
					
				}
			}
		} else {
			echo json_encode ( array (
					'status' => false 
			) );
		}
	}
}
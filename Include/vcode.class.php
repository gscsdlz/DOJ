<?php
class vcode {
	
	private $width;
	private $height;
	private $codeNum;
	private $disturbColorNum;
	private $checkCode;
	private $imageHandle;
	
	public function __construct($width = 80, $height = 20, $codeNum = 4) {
		$this->width = $width;
		$this->height = $height;
		$this->codeNum = $codeNum;
		$number = floor($height / $width / 15);
		if($number > 240 - $codeNum)
			$this->disturbColorNum = 240 - $codeNum;
		else 
			$this->disturbColorNum = $number;
		$this->checkCode = $this->createCheckCode();
	}
	
	public function __destruct() {
		imagedestroy($this->imageHandle);
	}
	
	public function __toString() {
		$_SESSION['vcode'] = strtolower($this->checkCode);
		$this->outImg();
		return '';
	}
	
	private function outImg() {
		$this->getCreateImage();
		$this->setDisturbcolor();
		$this->outputText();
		$this->outputImage();
	}
	
	private function getCreateImage(){
		$this->imageHandle = imagecreatetruecolor($this->width, $this->height);
		$backcolor = imagecolorallocate($this->imageHandle, 255, 255, 255);
		imagefill($this->imageHandle, 0, 0, $backcolor);
		$border = imagecolorallocate($this->imageHandle, 0, 0, 0);
		imagerectangle($this->imageHandle, 0, 0, $this->width-1, $this->height-1, $border);
	}
	
	private function createCheckCode(){
		$code = "3456789abcdefghijklmnpqrstuvwxyABCDEFGHIJKLMNPQRSTUVWXYZ";
		for($i = 0; $i < $this->codeNum; $i++) {
			$char = $code{rand(0, strlen($code) - 1)};
			$ascii .= $char;
		}
		return $ascii;
	}
	
	private function setDisturbcolor(){
		for($i = 0; $i < $this->disturbColorNum; ++$i) {
			$color = imagecolorallocate($this->imageHandle, rand(0, 255), rand(0, 255), rand(0, 255));
			imagesetpixel($this->imageHandlege, $this->width, $thid->height, $color);
		}
		
		for($i = 0; $i < 10; ++$i) {
			$color = imagecolorallocate($this->imageHandle, rand(0, 128), rand(0, 128), rand(0, 128));
			imagearc($this->imageHandle, rand(-10, $this->width), rand(-10, $this->height), rand(30, 300), rand(20, 200), 55, 44, $color);
		}
	}
	
	private function outputText(){
		for($i = 0; $i <= $this->codeNum; ++$i) {
			$fontcolor = imagecolorallocate($this->imageHandle, rand(0, 128), rand(0, 128), rand(0, 128));
			$fontsize = rand(3, 5);
			$x = floor($this->width / $this->codeNum) * $i + 3;
			$y = rand(0, $this->height-imagefontheight($fontsize));
			imagechar($this->imageHandle, $fontsize, $x, $y, $this->checkCode{$i}, $fontcolor);
		}
	}
	
	private function outputImage(){
		ob_clean();
		if(imagetypes() & IMG_GIF) {
			header("Content-type: image/gif");
			imagegif($this->imageHandle);
		} else if(imagetypes() & IMG_JPG) {
			header("Content-type: image/jpeg");
			imagegif($this->imageHandle, "", 0.5);
		} else if(imagetypes() & IMG_PNG) {
			header("Content-type: image/png");
			imagegif($this->imageHandle);
		} else if(imagetypes() & IMG_WBMP) {
			header("Content-type: image/vnd.wap.wbmp");
			imagegif($this->imageHandle);
		} else {
			die;
		}
	}
}
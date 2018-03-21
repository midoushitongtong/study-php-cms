<?php 




class Image {
	private $file;						//img地址
	private $width;						//img宽度
	private $height;					//img高度
	private $type;						//img类型
	private $img;							//原img
	private $new;							//新img
	
	//构造方法初始化
	public function __construct($_file) {
		$this->file = $_SERVER["DOCUMENT_ROOT"].$_file;
		list($this->width, $this->height, $this->type) = getimagesize($this->file);
		$this->img = $this->getFromImg($this->file, $this->type);
	}
	
	//cke
	public function cheImg($new_width = 0, $new_height) {
		list($_water_width, $_water_height, $_water_type) = getimagesize(MARK);
		$_water = $this->getFromImg(MARK, $_water_type);
		if (empty($new_width) && empty($new_height)) {
			$new_width = $this->width;
			$new_height = $this->height;
		}
		if (!is_numeric($new_width) || !is_numeric($new_height)) {
			$new_width = $this->width;
			$new_height = $this->height;
		}
		//等比例缩放
		if ($this->width < $this->height) {
			$new_width = ($new_height / $this->height) * $this->width;
		} else {
			$new_height = ($new_width / $this->width) * $this->height;
		}
		$_water_x = $new_width - $_water_width - 13;
		$_water_y = $new_height - $_water_height - 6;		
		$this->new = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($this->new, $this->img, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->height);
		if ($new_width > $_water_width && $new_height > $_water_height) {
			imagecopy($this->new, $_water, $_water_x, $_water_y, 0, 0, $_water_width, $_water_height);
		}
		imagepng($this->new, $this->file);
	}
	
	//缩略图判断类
	public function thumb($new_width = 0, $new_height = 0) {
		if (empty($new_width) && empty($new_height)) {
			$new_width = $this->width;
			$new_height = $this->height;
		}
		if (!is_numeric($new_width) || !is_numeric($new_height)) {
			$new_width = $this->width;
			$new_height = $this->height;
		}
		//创建容器
		$_n_w = $new_width;
		$_n_h = $new_height;
		//创建容器位置
		$_cut_width = 0;
		$_cut_height = 0;
		//等比例缩放
		if ($this->width < $this->height) {
			$new_width = ($new_height / $this->height) * $this->width;
		} else {
			$new_height = ($new_width / $this->width) * $this->height;
		}
		//如果新的宽高比参数的宽高要小那么就要扩张
		if ($new_width < $_n_w) {//如果新的高度小于参数的宽度
			$r = $_n_w / $new_width;
			$new_width *= $r;
			$new_height *= $r;
			$_cut_height = ($new_height - $_n_h) / 2;
		}
		if ($new_height < $_n_h) {//如果新的高度小于参数的高度
			$r = $_n_h / $new_height;
			$new_width *= $r;
			$new_height *= $r;
			$_cut_width = ($new_width - $_n_w) / 2;
		}
		$this->new = imagecreatetruecolor($_n_w, $_n_h);
		imagecopyresampled($this->new, $this->img, 0, 0, $_cut_width, $_cut_height, $new_width, $new_height, $this->width, $this->height);
	}
	
	//判断类型
	private function getFromImg($_file, $_type) {
		switch ($_type) {
			case 1 :
				$img = imagecreatefromgif($_file);
				break;
			case 2 :
				$img = imagecreatefromjpeg($_file);
				break;
			case 3 :
				$img = imagecreatefrompng($_file);
				break;
			default : 
				Tool::alertBack('图片类型不支持');
		}
		return $img;
	}
	
	//图像输出
	public function out() {
		imagepng($this->new, $this->file);
		imagedestroy($this->img);
	}
	
}




?>
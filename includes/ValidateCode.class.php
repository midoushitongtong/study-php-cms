<?php
	//验证码类
	class ValidateCode {
		
		
		private $charset = 'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789';	//随机因子
		private $code;									//验证码
		private $codelen = 4;						//验证码长度
		private $width = 133;						//宽度
		private $height = 49;						//高度
		private $img;										//图形资源句柄
		private $font;									//字体
		private $fontsize = 23;					//随机字体大小
		private $fontcolor;							//随机字体颜色
	
		public function __construct() {
			$this->font = ROOT_PATH.'/font/elephant.ttf';
		}
		
		//生成随代码
		private function createCode() {
			$_len = strlen($this->charset) -1;
			for ($i = 0; $i < $this->codelen; $i ++) {
				$this->code .= $this->charset[mt_rand(0, $_len)];
			}
		}
		
		//随机生成代码
		private function createFont() {
			$_x = $this->width / $this->codelen;
			for ($i = 0; $i < $this->codelen; $i ++) {
				$this->fontcolor = imagecolorallocate($this->img, mt_rand(0, 166), mt_rand(0, 166), mt_rand(0, 166));
				imagettftext($this->img, $this->fontsize, mt_rand(-33, 33), $_x * $i + mt_rand(0, 6), $this->height / 1.3, $this->fontcolor, $this->font, $this->code[$i]);
			}
		}
		
		//随机生成雪花
		private function createLine() {
			for ($i = 0; $i < 6; $i ++) {
				$color = imagecolorallocate($this->img, mt_rand(0, 166), mt_rand(0, 166), mt_rand(0, 166));
				imageline($this->img, mt_rand(0, $this->width), mt_rand(0, $this->height), mt_rand(0, $this->width), mt_rand(0, $this->height), $color);
			}
			for ($i = 0; $i < 6; $i ++) {
				$color = imagecolorallocate($this->img, mt_rand(200, 233), mt_rand(200, 233), mt_rand(0, 166));
				imagestring($this->img, mt_rand(0, 6), mt_rand(0, $this->width), mt_rand(0, $this->height), '*', $color);
			}
		}
		
		//随机生成背景
		private function createBg() {
			$this->img = imagecreatetruecolor($this->width, $this->height);
			$color = imagecolorallocate($this->img, mt_rand(166, 253), mt_rand(166, 253), mt_rand(166, 253));
			imagefilledrectangle($this->img, 0, $this->height, $this->width, 0, $color);
		}
		
		//输出验证图形
		private function outPut() {
			header('Content-type: image/png');
			imagepng($this->img);
			imagedestroy($this->img);
		}
		
		//对外生成图形
		public function doimg() {
			ob_end_clean();
			$this->createBg();
			$this->createCode();
			$this->createFont();
			$this->createLine();
			$this->outPut();
		}
		
		//获取验证图形
		public function getCode() {
			return strtolower($this->code);
		}
		
	}
	
	
	
?>
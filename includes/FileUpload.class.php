<?php 




class FileUpload {
	private $error;
	private $maxsize;
	private $type;
	private $typeArr = array('image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png', 'image/gif');
	private $path;
	private $today;
	private $name;
	private $tmp;
	private $linkpath;
	private $linktoday;
	
	public function __construct($_file, $_maxsize) {
		$this->error = $_FILES[$_file]['error'];
		$this->maxsize = $_maxsize / 1024;
		$this->type = $_FILES[$_file]['type'];
		$this->path = ROOT_PATH.UPDIR;
		$this->linktoday = date('Ymd');
		$this->today = $this->path.$this->linktoday.'/';
		$this->name = $_FILES[$_file]['name'];
		$this->tmp = $_FILES[$_file]['tmp_name'];
		$this->checkError();
		$this->checkType();
		$this->checkPath();
		$this->setNewName();
		$this->UploadFile();
	}
	
	public function getPath() {
		$_path = $_SERVER["SCRIPT_NAME"];
		$_dir = dirname(dirname($_path));
		if ($_dir == '\\') $_dir = '/';
		$this->linkpath = $_dir.$this->linkpath;
		return $this->linkpath;
	}
	
	private function UploadFile() {
		if (is_uploaded_file($this->tmp)) {
			if (!move_uploaded_file($this->tmp, $this->setNewName())) {
				Tool::alertBack('文件纯放失败');
			}
		} else {
			Tool::alertBack('文件不存在请检查');
		}
	}
	
	private function setNewName() {
		$_nameArr = explode('.', $this->name);
		$_postfix = $_nameArr[count($_nameArr) - 1];
		$_newName = date('YmdHis').mt_rand(66, 233).'.'.$_postfix;
		$this->linkpath = UPDIR.$this->linktoday.'/'.$_newName;
		return $this->today.$_newName;		
	}
	
	private function checkPath() {
		if (!is_dir($this->path) || !is_writable($this->path)) {
			if (!mkdir($this->path)) {
				Tool::alertBack('纯放路径创建不成功');
			}
		}
		if (!is_dir($this->today) || !is_writable($this->today)) {
			if (!mkdir($this->today)) {
				Tool::alertBack('纯放子路径创建不成功');
			}
		}
	}
	
	private function checkType() {
		if (!in_array($this->type, $this->typeArr)) {
			Tool::alertBack('上传类型必须是图片或GIF');
		}
	}
	
	private function checkError() {
		if (!empty($this->error)) {
			switch ($this->error) {
				case 1 :
					Tool::alertBack('上传大小超出配置大小');
					break;
				case 2 :
					Tool::alertBack('上传大小超过'.$this->maxsize.'KB');
					break;
				case 3 :
					Tool::alertBack('只有部分文件上传成功');
					break;
				case 4 :
					Tool::alertBack('没有任何文件上传成功');
					break;
				case 5 :
					Tool::alertBack('文件上传错误信息未知');
			}
		}
	}
	
}



?>
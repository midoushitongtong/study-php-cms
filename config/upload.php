<?php 




require substr(dirname(__FILE__), 0, -7).'/init.inc.php';
if (isset($_POST['send'])) {
	switch ($_POST['type']) {
		case 'content' : 
			$_width = 150;
			$_height = 100;
			break;
		case 'rotation' : 
			$_width = 268;
			$_height = 193;
			break;
		case 'adver' : 
			switch ($_POST['size']) {
				case '690x80' :
					$_width = 690;
					$_height = 80;
					break;
				case '270x200' :
					$_width = 270;
					$_height = 200;
					break;
			}
			break;
		default :
			Tool::alertBack('上传失败');
	}
	$_fileupload = new FileUpload('pic', $_POST['MAX_FILE_SIZE']);
	$_path = $_fileupload->getPath();
	$_img = new Image($_path);
	$_img->thumb($_width, $_height);
	$_img->out();
	Tool::alertOpenClose('上传成功', $_path);
} else {
	Tool::alertBack('上传文件过大');
}



?>
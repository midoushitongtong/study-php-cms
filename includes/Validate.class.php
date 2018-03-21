<?php 




class Validate {
	//是否为空
	static public function checkNull($_data) {
		if (trim($_data) == '') return true;
		return false;
	}
	
	//判断是否为空
	static public function checkNum($_data) {
		if (!is_numeric($_data)) return true;
		return false;
	}
	
	//长度是否合法
	static public function checkLength($_data, $_length, $_flag) {
		if ($_flag == 'min') {
			if (mb_strlen(trim($_data), 'utf-8') < $_length) return true;
			return false;
		} else if ($_flag == 'max') {
			if (mb_strlen(trim($_data), 'utf-8') > $_length) return true;
			return false;
		} else if ($_flg = 'equals') {
			if (mb_strlen(trim($_data), 'utf-8') != $_length) return true;
			return false;
		} else {
			Tool::alertBack('参数传递错误');				
		}
	}
	
	//是否一致
	static public function checkEquals($_data, $_otherdata) {
		if (trim($_data) != trim($_otherdata)) return true;
		return false;
	}
	
	//判断邮箱验证
	static public function checkEmail($_data) {
		if (!preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/', $_data)) return true;
		return false;
	}
	
	//session验证
	static public function checkSession() {
		if (!isset($_SESSION['admin'])) Tool::alertBack('请登录后尝试');
	}
	
	//是否足够权限
	static public function checkPermission($_data, $_info) {
		if (!in_array($_data, $_SESSION['admin']['permission'])) Tool::alertBack($_info);
	}
	
}



?>
<?php 




class LoginAction extends Action {
	//构造方法初始化
	public function __construct(&$_tpl) {
		parent::__construct($_tpl, new ManageModel());
	}
	
	//action
	public function _action() {
		switch (@$_GET['action']) {
			case 'login' :
				$this->login();
				break;
			case 'logout' :
				$this->logout();
				break;
		}
	}
	
	//login
	private function login() {
		if (isset($_POST['send'])) {
			if (Validate::checkLength($_POST['code'], 4, 'equals')) Tool::alertBack('验证码必须是四位');
			if (Validate::checkEquals(strtolower($_POST['code']), $_SESSION['code'])) Tool::alertBack('验证码不正确');
			if (Validate::checkNull($_POST['admin_user'])) Tool::alertBack('用户名不得为空');
			if (Validate::checkLength($_POST['admin_user'], 2, 'min')) Tool::alertBack('用户名不得小于2位');
			if (Validate::checkLength($_POST['admin_user'], 23, 'max')) Tool::alertBack('用户名不得大于23位');
			if (Validate::checkNull($_POST['admin_pass'])) Tool::alertBack('密码不能为空');
			if (Validate::checkLength($_POST['admin_pass'], 6, 'min')) Tool::alertBack('密码不得小于6位');
			$this->_model->admin_user = $_POST['admin_user'];
			$this->_model->admin_pass = sha1($_POST['admin_pass']);
			$_login = $this->_model->getLoginManage();
			if ($_login) {
				$_perArr = explode(',', $_login->permission);
				if (in_array('1', $_perArr)) {
					$this->_model->last_ip = $_SERVER['REMOTE_ADDR'];
					$this->_model->setLoginCount();
					$_SESSION['admin']['admin_user'] = $_login->admin_user;
					$_SESSION['admin']['level_name'] = $_login->level_name;
					$_SESSION['admin']['permission'] = $_perArr;
					Tool::alertLocation(null, 'admin.php');
				} else {
					Tool::alertBack('权限无法登陆');					
				}
			} else {
				Tool::alertBack('用户名或密码不正确');
			}
		}
	}
	
	//logout
	private function logout() {
		Tool::unSession();
		Tool::alertLocation(null, 'admin_login.php');
	}
	
}






?>
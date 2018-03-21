<?php 




class RegisterAction extends Action {
	//构造方法,初始化
	public function __construct(&$_tpl) {
		parent::__construct($_tpl);
	}
	
	//action
	public function _action() {
		switch ($_GET['action']) {
			case 'reg' : 
				$this->reg();
				break;
			case 'login' : 
				$this->login();
				break;
			case 'logout' : 
				$this->logout();
				break;
			default : 
				Tool::alertBack('非法操作');
		}		
	}
	
	//reg
	private function reg() {
		if (isset($_POST['send'])) {
			parent::__construct($this->_tpl, new UserModel());
			if (Validate::checkNull($_POST['user'])) Tool::alertBack('用户名不得为空');
			if (Validate::checkLength($_POST['user'], 2, 'min')) Tool::alertBack('用户名不得小于2位');
			if (Validate::checkLength($_POST['user'], 23, 'max')) Tool::alertBack('用户名不得大于23位');
			if (Validate::checkNull($_POST['pass'])) Tool::alertBack('密码不得为空');
			if (Validate::checkLength($_POST['pass'], 6, 'min')) Tool::alertBack('密码不得小于6位');
			if (Validate::checkEquals($_POST['pass'], $_POST['notpass'])) Tool::alertBack('密码和确认密码不一致');
			if (Validate::checkNull($_POST['email'])) Tool::alertBack('电子邮件不得为空');
			if (Validate::checkEmail($_POST['email'])) Tool::alertBack('电子邮件不正确');
			if (!Validate::checkNull($_POST['question']) && !Validate::checkNull($_POST['anwser'])) {
				$this->_model->question = $_POST['question'];
				$this->_model->anwser = $_POST['anwser'];
			}
			if (Validate::checkLength($_POST['code'], 4, 'min')) Tool::alertBack('验证码必须是四位');
			if (Validate::checkEquals($_POST['code'], $_SESSION['code'])) Tool::alertBack('验证码不正确');
			$this->_model->user = $_POST['user'];
			$this->_model->pass = sha1($_POST['pass']);
			$this->_model->email = $_POST['email'];
			$this->_model->face = $_POST['face'];
			$this->_model->state = 1;
			$this->_model->time = time();
			if ($this->_model->checkUser()) Tool::alertBack('用户名已经存在');
			if ($this->_model->checkEmail()) Tool::alertBack('电子邮件已存在');
			if ($this->_model->addUser()) {
				$_cookie = new Cookie('user', $this->_model->user, 0);
				$_cookie->setCookie();
				$_cookie = new Cookie('face', $this->_model->face, 0);
				$_cookie->setCookie();
				Tool::alertLocation('数据新增成功', './');
			} else {
				Tool::alertBack('数据新增失败');
			}
		}
		$this->_tpl->assign('reg', true);
		$this->_tpl->assign('OptionFaceOne', range(1, 9));
		$this->_tpl->assign('OptionFaceTwo', range(10, 24));
	}
	
	//登陆进
	private function login() {
		if (isset($_POST['send'])) {
			parent::__construct($this->_tpl, new UserModel());
			if (Validate::checkNull($_POST['user'])) Tool::alertBack('用户名不得为空');
			if (Validate::checkLength($_POST['user'], 2, 'min')) Tool::alertBack('用户名不得小于2位');
			if (Validate::checkLength($_POST['user'], 23, 'max')) Tool::alertBack('用户名不得大于23位');
			if (Validate::checkNull($_POST['pass'])) Tool::alertBack('密码不得为空');
			if (Validate::checkLength($_POST['pass'], 6, 'min')) Tool::alertBack('密码不得小于6位');
			if (Validate::checkLength($_POST['code'], 4, 'min')) Tool::alertBack('验证码必须是四位');
			if (Validate::checkEquals($_POST['code'], $_SESSION['code'])) Tool::alertBack('验证码不正确');
			$this->_model->user = $_POST['user'];
			$this->_model->pass = sha1($_POST['pass']);
			if ($_user = $this->_model->checkLogin()) {
				$_cookie = new Cookie('user', $_user->user, $_POST['time']);
				$_cookie->setCookie();
				$_cookie = new Cookie('face', $_user->face, $_POST['time']);
				$_cookie->SetCookie();
				$this->_model->id = $_user->id;
				$this->_model->time = time();
				$this->_model->setLaterUser();
				Tool::alertLocation(null, './');
			} else {
				Tool::alertBack('用户名或者密码错误');
			}
		}
		$this->_tpl->assign('login', true);
	}
	
	//退出
	private function logout() {
		$_cookie = new Cookie('user');
		$_cookie->unCookie();
		Tool::alertLocation(null, 'register.php?action=login');
	}
	
}

	

?>
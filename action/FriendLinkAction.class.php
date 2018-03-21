<?php 




class FriendLinkAction extends Action {
	//构造方法,初始化
	public function __construct(&$_tpl) {
		parent::__construct($_tpl, new LinkModel());
	}
	
	//action
	public function _action() {
		//业务流程控制器
		switch (@$_GET['action']) {
			case 'frontshow' : 
				$this->frontshow();
				break;
			case 'frontadd' : 
				$this->frontadd();
				break;
			default :
				Tool::alertBack('非法操作');
		}
	}
	
	//frontshow
	private function frontshow() {
		$this->_tpl->assign('frontshow', true);
		$this->_tpl->assign('Alltext', $this->_model->getAllTextLink());
		$this->_tpl->assign('AllLogo', $this->_model->getAllLogoLink());
	}
	
	//frontadd
	private function frontadd() {
		if (isset($_POST['send'])) {
			if (Validate::checkNull($_POST['webname'])) Tool::alertBack('网站名称不得为空');
			if (Validate::checkLength($_POST['weburl'], 23, 'max')) Tool::alertBack('网站名称不得大于23位');
			if (Validate::checkNull($_POST['weburl'])) Tool::alertBack('网站地址不得为空');
			if (Validate::checkLength($_POST['weburl'], 233, 'max')) Tool::alertBack('网站地址不得大于233位');
			if (Validate::checkLength($_POST['user'], 23, 'max')) Tool::alertBack('站长名称不得大于23位');
			if ($_POST['type'] == 2) {
				if (Validate::checkNull($_POST['weblogo'])) Tool::alertBack('网站logo地址不得为空');
				if (Validate::checkLength($_POST['weblogo'], 233, 'max')) Tool::alertBack('网站logo地址不得为空');
			}
			if (Validate::checkEquals($_POST['code'], $_SESSION['code'])) Tool::alertBack('验证码不正确');
			$this->_model->webname = $_POST['webname'];
			$this->_model->weburl = $_POST['weburl'];
			$this->_model->weblogo = $_POST['weblogo'];
			$this->_model->user = $_POST['user'];
			$this->_model->state = $_POST['state'];
			$this->_model->type = $_POST['type'];
			$this->_model->addLink() ? Tool::alertClose('数据申请成功') : Tool::alertBack('数据申请失败');
		}
		$this->_tpl->assign('frontadd', true);
	}
	
	//index
	public function index() {
		$this->text();
		$this->logo();
	}
	
	//text
	private function text() {
		$this->_tpl->assign('text', $this->_model->getTwentyTextLink());
	}
	
	//logo
	private function logo() {
		$this->_tpl->assign('logo', $this->_model->getNineLogoLink());
	}
	
	
	
}



?>
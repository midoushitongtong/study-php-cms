<?php 




class LinkAction extends Action {
	//构造方法,初始化
	public function __construct(&$_tpl) {
		parent::__construct($_tpl, new LinkModel());
	}
	
	//action
	public function _action() {
		//业务流程控制器
		switch (@$_GET['action']) {
			case 'show' :
				$this->show();
				break;
			case 'add' :
				$this->add();
				break;
			case 'update' :
				$this->update();
				break;
			case 'state' : 
				$this->state();
				break;
			case 'delete' :
				$this->delete();
				break;
			default :
				Tool::alertBack('非法操作');
		}
	}
		
	//show
	private function show() {
		parent::page($this->_model->getLinkTotal());
		$_object = $this->_model->getAllLink();
		Tool::subStr($_object, 'weburl', 23, 'utf-8');
		Tool::subStr($_object, 'logourl', 23, 'utf-8');
		if ($_object) {
			foreach ($_object as $_value) {
				switch ($_value->type) {
					case 1 :
						$_value->type = '文字链接';
						break;
					case 2 :
						$_value->type = 'logo链接';
						break;
				}
				if (empty($_value->state)) {
					$_value->state = '<span style="color: #06f;">[未审核]</span> | <a href="link.php?action=state&type=ok&id='.$_value->id.'">通过</a>';
				} else {
					$_value->state = '<span style="color: #06f;">[已通过]</span> | <a href="link.php?action=state&type=cancel&id='.$_value->id.'">取消</a>';
				}
			}
		}
		$this->_tpl->assign('AllLink', $_object);
		$this->_tpl->assign('show', true);
		$this->_tpl->assign('title', '管理友情列表');
	}
	
	//add
	private function add() {
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
			$this->_model->webname = $_POST['webname'];
			$this->_model->weburl = $_POST['weburl'];
			$this->_model->weblogo = $_POST['weblogo'];
			$this->_model->user = $_POST['user'];
			$this->_model->state = $_POST['state'];
			$this->_model->type = $_POST['type'];
			$this->_model->addLink() ? Tool::alertLocation('数据新增成功', '?action=show') : Tool::alertBack('数据新增失败');
		}
		$this->_tpl->assign('add', true);
		$this->_tpl->assign('title', '新增友情链接');
		$this->_tpl->assign('prev_url', PREV_URL);
	}
	
	//update
	private function update() {
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
			$this->_model->id = $_POST['id'];
			$this->_model->webname = $_POST['webname'];
			$this->_model->weburl = $_POST['weburl'];
			$this->_model->weblogo = $_POST['weblogo'];
			$this->_model->user = $_POST['user'];
			$this->_model->state = $_POST['state'];
			$this->_model->type = $_POST['type'];
			$this->_model->updateLink() ? Tool::alertLocation('数据修改成功', $_POST['prev_url']) : Tool::alertBack('数据修改失败');
		}
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			$_link = $this->_model->getOneLink();
			if (!$_link) Tool::alertBack('等级id有误');
			$this->_tpl->assign('id', $_link->id);
			$this->_tpl->assign('webname', $_link->webname);
			$this->_tpl->assign('weburl', $_link->weburl);
			$this->_tpl->assign('logourl', $_link->logourl);
			$this->_tpl->assign('user', $_link->user);
			$this->_tpl->assign('state', $_link->state);
			if ($_link->type == 1) {
				$this->_tpl->assign('text_type', 'checked="checked"');
				$this->_tpl->assign('logo_type', '');
				$this->_tpl->assign('logo', 'style="display: none;"');
			} else {
				$this->_tpl->assign('logo_type', 'checked="checked"');
				$this->_tpl->assign('text_type', '');
				$this->_tpl->assign('logo', 'style="display: block"');
			}
			$this->_tpl->assign('prev_url', PREV_URL);
		} else {
			Tool::alertBack('非法操作');
		}
		$this->_tpl->assign('update', true);
		$this->_tpl->assign('title', '修改友情链接');
	}
	
	//state
	private function state() {
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			if (!$this->_model->getOneLink()) Tool::alertBack('此链接不存在');
			if ($_GET['type'] == 'ok') {
				$this->_model->setStateOk() ? Tool::alertLocation(NULL, '?action=show') : Tool::alertBack('数据修改失败');
			} else if ($_GET['type'] == 'cancel') {
				$this->_model->setStateCancel() ? Tool::alertLocation(NULL, '?action=show') : Tool::alertBack('数据修改失败');
			} else {
				Tool::alertBack('状态传值有误');				
			}
		} else {
			Tool::alertBack('id传值有误');
		}
	}
	
	//delete
	private function delete() {
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			$_object = $this->_model->getOneLink();
			if (!$_object) Tool::alertBack('将要删除的链接不存在');
			$this->_model->deleteLink() ? Tool::alertLocation('数据删除成功', '?action=show') : Tool::alertBack('数据删除失败');
		} else {
			Tool::alertBack('非法操作');
		}
	}
	
}



?>
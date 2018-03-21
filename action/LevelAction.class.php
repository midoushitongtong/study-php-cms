<?php 




class LevelAction extends Action {
	//构造方法,初始化
	public function __construct(&$_tpl) {
		parent::__construct($_tpl, new LevelModel());
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
			case 'delete' :
				$this->delete();
				break;
			default :
				Tool::alertBack('非法操作');
		}
	}
		
	//show
	private function show() {
		$this->_tpl->assign('show', true);
		$this->_tpl->assign('title', '管理等级列表');
		parent::page($this->_model->getLevelTotal(), PAGE_SIZE);
		$this->_tpl->assign('AllLevel', $this->_model->getAllLimitLevel());
	}
	
	//add
	private function add() {
		if (isset($_POST['send'])) {
			if (Validate::checkNull($_POST['level_name'])) Tool::alertBack('等级名称不得为空');
			if (Validate::checkLength($_POST['level_name'], 2, 'min')) Tool::alertBack('等级名称不得小于2位');
			if (Validate::checkLength($_POST['level_name'], 23, 'max')) Tool::alertBack('等级名称不得大于23位');
			if (Validate::checkLength($_POST['level_info'], 233, 'max')) Tool::alertBack('等级描述不得大于233位');
			$this->_model->level_name = $_POST['level_name'];
			if ($this->_model->getOneLevel()) Tool::alertBack('等级名称已经存在');
			$this->_model->level_info = $_POST['level_info'];
			if (!empty($_POST['permission'])) {
				$this->_model->permission = implode(',', $_POST['permission']);
			}
			$this->_model->addLevel() ? Tool::alertLocation('数据新增成功', 'level.php?action=show') : Tool::alertBack('数据新增失败');
		}
		$this->_tpl->assign('add', true);
		$_permission = new PermissionModel();
		$this->_tpl->assign('AllPermission', $_permission->getAllPermission());
		$this->_tpl->assign('title', '新增管理等级');
		$this->_tpl->assign('prev_url', PREV_URL);
	}
	
	//update
	private function update() {
		if (isset($_POST['send'])) {
			$this->_model->permission = implode(',', $_POST['permission']);
			if (Validate::checkNull($_POST['level_name'])) Tool::alertBack('等级名称不得为空');
			if (Validate::checkLength($_POST['level_name'], 2, 'min')) Tool::alertBack('等级名称不得小于2位');
			if (Validate::checkLength($_POST['level_name'], 23, 'max')) Tool::alertBack('等级名称不得大于23位');
			if (Validate::checkLength($_POST['level_info'], 233, 'max')) Tool::alertBack('等级描述不得大于233位');
			$this->_model->id = $_POST['id'];
			$this->_model->level_name = $_POST['level_name'];
			$this->_model->level_info = $_POST['level_info'];
			$this->_model->updateLevel() ? Tool::alertLocation('数据修改成功', $_POST['prev_url']) : Tool::alertBack('数据修改失败');
		}
		if (isset($_GET['id'])) {
			$_permission = new PermissionModel();
			$this->_tpl->assign('AllPermission', $_permission->getAllPermission());
			$this->_model->id = $_GET['id'];
			$_level = $this->_model->getOneLevel();
			is_object($_level) ? true : Tool::alertBack('等级id有误');
			$this->_tpl->assign('id', $_level->id);
			$this->_tpl->assign('level_name', $_level->level_name);
			$this->_tpl->assign('level_info', $_level->level_info);
			$this->_tpl->assign('prev_url', PREV_URL);
		} else {
			Tool::alertBack('非法操作');
		}
		$this->_tpl->assign('update', true);
		$this->_tpl->assign('title', '修改管理等级');
	}
	
	//delete
	private function delete() {
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			$_manage = new ManageModel();
			$_manage->level = $this->_model->id;
			if ($_manage->getOneManage()) Tool::alertBack('等级名称正在被用户使用,请先删除用户');
			$this->_model->deleteLevel() ? Tool::alertLocation('删除等级成功', PREV_URL) : Tool::alertBack('删除等级失败') ;
		} else {
			Tool::alertBack('非法操作');
		}
	}
	
}



?>
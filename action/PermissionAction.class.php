<?php 




class PermissionAction extends Action {
	//构造方法,初始化
	public function __construct(&$_tpl) {
		parent::__construct($_tpl, new PermissionModel());
	}
	
	//action
	public function _action() {
		switch ($_GET['action']) {
			case 'add' : 
				$this->add();
				break;
			case 'show' : 
				$this->show();
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
		parent::page($this->_model->getPermissionTotal());
		$this->_tpl->assign('AllPermission', $this->_model->getAllLimitPermission());
		$this->_tpl->assign('show', true);
		$this->_tpl->assign('title', '管理权限列表');
		$this->_tpl->assign('prev_url', PREV_URL);
	}
	
	//add
	private function add() {
		if (isset($_POST['send'])) {
			if (Validate::checkNull($_POST['name'])) Tool::alertBack('权限名称不得为空');
			if (Validate::checkLength($_POST['name'], 2, 'min')) Tool::alertBack('权限名称不得小于两位');
			if (Validate::checkLength($_POST['name'], 103, 'max')) Tool::alertBack('权限名称不得大于103位');
			if (Validate::checkLength($_POST['info'], 233, 'max')) Tool::alertBack('权限描述不得大于233位');
			$this->_model->name = $_POST['name'];
			if ($this->_model->getOnePermission()) Tool::alertBack('此权限名称已存在');
			$this->_model->info = $_POST['info'];
			$this->_model->addPermission() ? Tool::alertLocation('数据新增成功', '?action=show') : Tool::alertBack('数据新增失败');
		}
		$this->_tpl->assign('add', true);
		$this->_tpl->assign('title', '新增管理权限');
		$this->_tpl->assign('prev_url', PREV_URL);
	}
	
	//update
	private function update() {
		if (isset($_POST['send'])) {
			if (Validate::checkNull($_POST['name'])) Tool::alertBack('权限名称不得为空');
			if (Validate::checkLength($_POST['name'], 2, 'min')) Tool::alertBack('权限名称不得小于两位');
			if (Validate::checkLength($_POST['name'], 103, 'max')) Tool::alertBack('权限名称不得大于103位');
			if (Validate::checkLength($_POST['info'], 233, 'max')) Tool::alertBack('权限描述不得大于233位');
			$this->_model->id = $_POST['id'];
			$this->_model->name = $_POST['name'];
			$this->_model->info = $_POST['info'];
			$this->_model->updatePermission() ? Tool::alertLocation('数据修改成功', '?action=show') : Tool::alertBack('数据修改失败');
		}
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			$_permission = $this->_model->getOnePermission();
			if (!$_permission) Tool::alertBack('修改数据不存在');
			$this->_tpl->assign('id', $_permission->id);
			$this->_tpl->assign('name', $_permission->name);
			$this->_tpl->assign('info', $_permission->info);
			$this->_tpl->assign('prev_url', PREV_URL);
		} else {
			Tool::alertBack('id传值失败');
		}
		$this->_tpl->assign('update', true);
		$this->_tpl->assign('title', '修改管理权限');
	}
	
	//delete
	private function delete() {
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			$this->_model->deletePermission() ? Tool::alertLocation('数据删除成功', '?action=show') : Tool::alertBack('数据删除失败');
		} else {
			Tool::alertBack('id传值失败');
		}
	}
	
}



?>
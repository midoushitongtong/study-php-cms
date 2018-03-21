<?php 




class NavAction extends Action {
	
	//构造方法,初始化
	public function __construct(&$_tpl) {
		parent::__construct($_tpl, new NavModel());
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
			case 'showchild' :
				$this->showchild();
				break;
			case 'addchild' :
				$this->addchild();
				break;
			case 'sort' :
				$this->sort();
				break;
			default :
				Tool::alertBack('非法操作');
		}
	}

	//show
	private function show() {
		$this->_tpl->assign('show', true);
		$this->_tpl->assign('title', '管理导航列表');
		parent::page($this->_model->getNavTotal(), PAGE_SIZE);
		$this->_tpl->assign('AllNav', $this->_model->getAllNav());
	}
		
	//showchild
	private function showchild() {
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			$_nav = $this->_model->getOneNav();
			is_object($_nav) ? true : Tool::alertBack('导航ID有误');
			$this->_tpl->assign('id', $_nav->id);
			$this->_tpl->assign('prev_name', $_nav->nav_name);
			parent::page($this->_model->getNavChildTotal(), PAGE_SIZE);
			$this->_tpl->assign('AllNavChild', $this->_model->getAllChildNav());
		}
		$this->_tpl->assign('showchild', true);
		$this->_tpl->assign('title', '查看子导航');
		$this->_tpl->assign('prev_url', PREV_URL);
	}
	
	//add
	private function add() {
		if (isset($_POST['send'])) {
			if (Validate::checkNull($_POST['nav_name'])) Tool::alertBack('导航名称不得为空');
			if (Validate::checkLength($_POST['nav_name'], 2, 'min')) Tool::alertBack('导航名称不得小于2位');
			if (Validate::checkLength($_POST['nav_name'], 23, 'max')) Tool::alertBack('导航名称不得大于23位');
			if (Validate::checkLength($_POST['nav_info'], 233, 'max')) Tool::alertBack('导航描述不得大于233位');
			$this->_model->pid = $_POST['pid'];
			$this->_model->nav_name = $_POST['nav_name'];
			if ($this->_model->getOneNav()) Tool::alertBack('导航名称已经存在');
			$this->_model->nav_info = $_POST['nav_info'];
			$_returnurl = $this->_model->pid ? 'nav.php?action=showchild&id='.$this->_model->pid : 'nav.php?action=show';
			$this->_model->addNav() ? Tool::alertLocation('数据新增成功', $_returnurl) : Tool::alertBack('数据新增失败');
		}
		$this->_tpl->assign('add', true);
		$this->_tpl->assign('title', '新增导航列表');
		$this->_tpl->assign('prev_url', PREV_URL);
	}
	
	//addchild
	private function addchild() {
		if (isset($_POST['send'])) {
			$this->add();
		}
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			$_nav = $this->_model->getOneNav();
			is_object($_nav) ? true : Tool::alertBack('导航id有误');
			$this->_tpl->assign('id', $_nav->id);
			$this->_tpl->assign('prev_name', $_nav->nav_name);
		}
		$this->_tpl->assign('addchild', true);
		$this->_tpl->assign('title', '新增子导航');
		$this->_tpl->assign('prev_url', PREV_URL);
	}
	
	//update
	private function update() {
		if (isset($_POST['send'])) {
			if (Validate::checkNull($_POST['nav_name'])) Tool::alertBack('等级名称不得为空');
			if (Validate::checkLength($_POST['nav_name'], 2, 'min')) Tool::alertBack('等级名称不得小于2位');
			if (Validate::checkLength($_POST['nav_name'], 23, 'max')) Tool::alertBack('等级名称不得大于23位');
			if (Validate::checkLength($_POST['nav_info'], 233, 'max')) Tool::alertBack('等级描述不得大于233位');
			$this->_model->id = $_POST['id'];
			$this->_model->nav_name = $_POST['nav_name'];
			$this->_model->nav_info = $_POST['nav_info'];
			$this->_model->updateNav() ? Tool::alertLocation('数据修改成功', $_POST['prev_url']) : Tool::alertBack('数据修改失败');
		}
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			$_nav = $this->_model->getOneNav();
			is_object($_nav) ? true : Tool::alertBack('等级id有误');
			$this->_tpl->assign('id', $_nav->id);
			$this->_tpl->assign('nav_name', $_nav->nav_name);
			$this->_tpl->assign('nav_info', $_nav->nav_info);
		} else {
			Tool::alertBack('非法操作');
		}
		$this->_tpl->assign('update', true);
		$this->_tpl->assign('title', '修改导航列表');
		$this->_tpl->assign('prev_url', PREV_URL);
	}
	
	//delete
	private function delete() {
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			$this->_model->deleteNav() ? Tool::alertLocation('删除数据成功', PREV_URL) : Tool::alertBack('删除数据失败') ;
		} else {
			Tool::alertBack('非法操作');
		}
	}
	
	//前台显示导航
	public function showfront() {
		$this->_tpl->assign('FrontNav', $this->_model->getFrontNav());
	}
	
	//修改前台导航
	private function sort() {
		if (isset($_POST['send'])) {
			$this->_model->sort = $_POST['sort'];
			if ($this->_model->setNavSort()) Tool::alertLocation(NULL, PREV_URL);
		}
	}
	
}



?>
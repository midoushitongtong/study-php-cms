<?php 




class VoteAction extends Action {
	//构造方法,初始化
	public function __construct(&$_tpl) {
		parent::__construct($_tpl, new VoteModel());
	}
	
	//action
	public function _action() {
		//业务流程控制器
		switch (@$_GET['action']) {
			case 'show' :
				$this->show();
				break;
			case 'showchild' : 
				$this->showchild();
				break;
			case 'add' :
				$this->add();
				break;
			case 'addchild' : 
				$this->addchild();
				break;
			case 'update' :
				$this->update();
				break;
			case 'state' :
				$this->setState();
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
		parent::page($this->_model->getVoteTotal());
		$_object = $this->_model->getAllVote();
		if ($_object) {
			foreach ($_object as $_value) {
				if (empty($_value->state)) {
					$_value->state = '<span style="color: #06f">[否]</span> | <a href="vote.php?action=state&type=ok&id='.$_value->id.'">确定</a>';
				} else {
					$_value->state = '<span style="color: #06f">[是]</span>';
				}
				if (empty($_value->pcount)) {
					$_value->pcount = 0;
				}
			}
		}
		$this->_tpl->assign('AllVote', $_object);
		$this->_tpl->assign('show', true);
		$this->_tpl->assign('prev_url', PREV_URL);
		$this->_tpl->assign('title', '投票主题列表');
	}
	
	//showchild
	private function showchild() {
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			$_vote = $this->_model->getOneVote();
			if (!$_vote) Tool::alertBack('主题值不存在');
			parent::page($this->_model->getChildVoteTotal());
			$this->_tpl->assign('id', $_vote->id);
			$this->_tpl->assign('titlec', $_vote->title);
			$this->_tpl->assign('AllChildVote', $this->_model->getAllChildVote());
			$this->_tpl->assign('showchild', true);
			$this->_tpl->assign('prev_url', PREV_URL);
			$this->_tpl->assign('title', '投票项目列表');
		} else {
			Tool::alertBack('非法操作');
		}
	}
	
	//add
	private function add() {
		if (isset($_POST['send'])) {
			$this->setAdd();
			$this->_model->addVote() ? Tool::alertLocation('数据新增成功', 'vote.php?action=show') : Tool::alertBack('数据新增失败');
		}
		$this->_tpl->assign('add', true);
		$this->_tpl->assign('prev_url', PREV_URL);
		$this->_tpl->assign('title', '新增投票主题');
	}
	
	//addchild
	private function addchild() {
		if (isset($_POST['send'])) {
			$this->_model->vid = $_GET['id'];
			$this->setAdd();
			$this->_model->addVote() ? Tool::alertLocation('数据新增成功', '?action=showchild&id='.$this->_model->vid.'') : Tool::alerBack('数据新增失败');
		}
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			$_vote = $this->_model->getOneVote();
			if (!$_vote) Tool::alertBack('找不到投票主题');
			$this->_tpl->assign('id', $_vote->id);
			$this->_tpl->assign('titlec', $_vote->title);
		} else {
			Tool::alertBack('非法操作');
		}
		$this->_tpl->assign('addchild', true);
		$this->_tpl->assign('prev_url', PREV_URL);
		$this->_tpl->assign('title', '新增投票项目');
	}
	
	//getadd
	private function setAdd() {
		if (Validate::checkNull($_POST['title'])) Tool::alertBack('标题不得为空');
		if (Validate::checkLength($_POST['title'], 2, 'min')) Tool::alertBack('标题不得小于2位');
		if (Validate::checkLength($_POST['title'], 23, 'max')) Tool::alertBack('标题不得大于23位');
		if (Validate::checkLength($_POST['info'], 233, 'max')) Tool::alertBack('标题描述不得大于233位');
		$this->_model->title = $_POST['title'];
		$this->_model->info = $_POST['info'];
	}
	
	//update
	private function update() {
		if (isset($_POST['send'])) {
			$this->_model->id = $_GET['id'];
			$this->setAdd();
			$this->_model->updateVote() ? Tool::alertLocation('数据修改成功', $_POST['prev_url']) : Tool::alertBack('数据修改失败');
		}
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			$_vote = $this->_model->getOneVote();
			if (!$_vote) Tool::alertBack('主题id有误');
			$this->_tpl->assign('id', $_vote->id);
			$this->_tpl->assign('titlec', $_vote->title);
			$this->_tpl->assign('info', $_vote->info);
			$this->_tpl->assign('prev_url', PREV_URL);
		} else {
			Tool::alertBack('非法操作');
		}
		$this->_tpl->assign('update', true);
		$this->_tpl->assign('title', '修改投票主题');
	}
	
	//setState
	private function setState() {
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			$_object = $this->_model->getOneVote();
			if (!$_object) Tool::alertBack('主题不存在');
			if ($_GET['type'] == 'ok') {
				$this->_model->setStateCancel();
				$this->_model->setStateOk() ? Tool::alertLocation(null, PREV_URL) : Tool::alertBack('数据修改失败');
			}
		} else {
			Tool::alertBack('主题id有误');
		}
	}
	
	//delete
	private function delete() {
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			$this->_model->deleteVote() ? Tool::alertBack('数据删除成功') : Tool::alertBack('数据删除失败');
		} else {
			Tool::alertBack('非法操作');
		}
	}
	
}



?>
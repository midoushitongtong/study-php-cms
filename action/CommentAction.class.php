<?php 




class CommentAction extends Action {
	//构造方法,初始化
	public function __construct(&$_tpl) {
		parent::__construct($_tpl, new CommentModel);
	}
	
	//action
	public function _action() {
		//业务流程控制器
		switch (@$_GET['action']) {
			case 'show' :
				$this->show();
				break;
			case 'state' : 
				$this->state();
				break;
			case 'states' : 
				$this->states();
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
		parent::page($this->_model->getCommentListTotal());
		$_object = $this->_model->getCommentList();
		$this->_tpl->assign('CommentList', $_object);
		if ($_object) {
			foreach ($_object as $_value) {
				if (empty($_value->state)) {
					$_value->state = '<span style="color: #06f;">未审核</span> | <a href="comment.php?action=state&type=ok&id='.$_value->id.'">通过</a>';
				} else {
					$_value->state = '<span style="color: #f60;">已审核</span> | <a href="comment.php?action=state&type=cancel&id='.$_value->id.'">取消</a>';
				}
			}
		}
		Tool::subStr($_object, 'content', 13, 'utf-8');
		$this->_tpl->assign('show', true);
		$this->_tpl->assign('title', '评论列表');
	}
	
	//state
	private function state() {
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			if (!$this->_model->getOneComment()) Tool::alertBack('不存在此评论');
			if ($_GET['type'] == 'ok') {
				$this->_model->setStateOk() ? Tool::alertLocation(NULL, PREV_URL) : Tool::alertBack('审核失败');
			} else if ($_GET['type'] == 'cancel') {
				$this->_model->setStateCancel() ? Tool::alertLocation(NULL, PREV_URL) : Tool::alertBack('取消失败');
			} else {
				Tool::alertBack('操作不合法 ');
			}
		} else {
			Tool::alertBack('id传值有误');
		}
	}
	
	//states
	private function states() {
		if (isset($_POST['send'])) {
			$this->_model->states = $_POST['states'];
			if ($this->_model->setStates()) Tool::alertLocation(NULL, PREV_URL);
		}
	}

	//delete
	private function delete() {
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			$this->_model->deleteComment() ? Tool::alertLocation('数据删除成功', PREV_URL) : Tool::alertBack('数据删除失败');
		} else {
			Tool::alertBack('非法操作');
		}
	}
	
}

	

?>
<?php 




class CastAction extends Action {
	//构造方法,初始化
	public function __construct(&$_tpl) {
		parent::__construct($_tpl, new VoteModel());
	}
	
	//action
	public function _action() {
		$this->setCount();
		$this->getVote();
	}
	
	//累计
	private function setCount() {
		if (isset($_POST['send'])) {
			if (empty($_POST['vote'])) {
				Tool::alertClose('请最少选择一个项目进行投票');
			}
			$this->_model->id = $_POST['vote'];
			if (@$_COOKIE["ip"] == $_SERVER["REMOTE_ADDR"]) {
				if (time() - $_COOKIE["time"] < 23366) {
					Tool::alertLocation('请勿重复投票', 'cast.php');
				}
			}
			if ($this->_model->setCount()) {
				setcookie('ip', $_SERVER["REMOTE_ADDR"]);
				setcookie('time', time());
				Tool::alertLocation('你的投票成功', 'cast.php');
			}
		}
	}

	//获取投票数据
	private function getVote() {
		$_vote = new VoteModel();
		$_sum = $_vote->getVoteSum()->c;
		$this->_tpl->assign('vote_title', $_vote->getVoteTitle()->title);
		$_object = $_vote->getVoteItem();
		$_i = 1;
		$_width = 393;
		$this->_tpl->assign('width', $_width);
		if ($_object) {
			foreach ($_object as $_value) {
				$_value->percent = round($_value->count / $_sum * 100, 2).'%';
				$_value->picwidth = $_value->count / $_sum * $_width;
				$_value->picnum = $_i;
				$_i == 4 ? $_i = 1 : $_i ++;
			}
		}
		$this->_tpl->assign('vote_item', $_object);
	}
	
	
}



?>
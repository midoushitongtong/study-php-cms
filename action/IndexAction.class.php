<?php 





class IndexAction extends Action {
	//构造方法,初始化
	public function __construct(&$_tpl) {
		parent::__construct($_tpl, new LevelModel());
	}
	
	//action
	public function _action() {
		$this->login();
		$this->laterUser();
		$this->showList();
		$this->getVote();
	}
	
	//最新登录用户
	private function laterUser() {
		$_user = new UserModel();
		$this->_tpl->assign('AllLaterUser', $_user->getLaterUser());
	}
	
	//显示推荐,本月热点,本月评论,热点
	private function showList() {
		parent::__construct($this->_tpl, new ContentModel());
		
		$_object = $this->_model->getNewRecList();
		Tool::subStr($_object, 'title', 13, 'utf-8');
		Tool::Objdate($_object, 'date');
		$this->_tpl->assign('NewRecList', $_object);
		
		$_object = $this->_model->getMonthHotList();
		Tool::subStr($_object, 'title', 13, 'utf-8');
		Tool::Objdate($_object, 'date');
		$this->_tpl->assign('MonthHotList', $_object);
		
		$_object = $this->_model->getMonthComment();
		Tool::subStr($_object, 'title', 13, 'utf-8');
		Tool::Objdate($_object, 'date');
		$this->_tpl->assign('MonthComment', $_object);
		
		$_object = $this->_model->getPicList();
		Tool::subStr($_object, 'title', 23, 'utf-8');
		$this->_tpl->assign('PicList', $_object);
		
		$_object = $this->_model->getNewList();
		Tool::subStr($_object, 'title', 23, 'utf-8');
		Tool::Objdate($_object, 'date');
		$this->_tpl->assign('NewList', $_object);
		
		$_object = $this->_model->getNewTop();
		$this->_tpl->assign('TopTitle', Tool::subStr($_object->title, NULL, 19, 'utf-8'));
		$this->_tpl->assign('TopInfo', Tool::subStr($_object->info, NULL, 96, 'utf-8'));
		$this->_tpl->assign('TopId', @$_object->id);
		
		$_object = $this->_model->getNewTopList();
		Tool::subStr($_object, 'title', 13, 'utf-8');
		if ($_object) {
			$_i = 1;
			foreach ($_object as $_value) {
				if ($_i % 2 == 0) {
					$_value->line = '';
				} else {
					$_value->line = ' | ';
				}
				$_i ++;
			}
		}
		$this->_tpl->assign('NewTopList', $_object);
		
		$_nav = new NavModel();
		$_object = $_nav->getFourNav();
		if ($_object) {
			$_i = 1;
			foreach ($_object as $_value) {
				if ($_i % 2 == 0) {
					$_value->class = 'list right bottom';
				} else {
					$_value->class = 'list bottom';
				}
				$_i ++;
				$this->_model->nav = $_value->id;
				$_navList = $this->_model->getNewNavList();
				Tool::Objdate($_navList, 'date');
				Tool::subStr($_navList, 'title', 19, 'utf-8');
				$_value->list = $_navList;
			}
		}
		$this->_tpl->assign('FourNav', $_object);
		
	}
	
	//登陆模块
	private function login() {
		$_cookie = new Cookie('user');
		$_user = $_cookie->getCookie();
		$_cookie = new Cookie('face');
		$_face = $_cookie->getCookie();
		if ($_user && $_face) {
			$this->_tpl->assign('user', Tool::subStr($_user, null, 6, 'utf-8'));
			$this->_tpl->assign('face', $_face);
		} else {
			$this->_tpl->assign('login', true);
		}
		$this->_tpl->assign('cache', IS_CACHE);
		if (IS_CACHE) $this->_tpl->assign('member', '<script>getIndexLogin()</script>');
	}
	
	//Vote
	private function getVote() {
		$_vote = new VoteModel();
		$this->_tpl->assign('vote_title', @$_vote->getVoteTitle()->title);
		$this->_tpl->assign('vote_item', $_vote->getVoteItem());
	}
	
	

}



?>
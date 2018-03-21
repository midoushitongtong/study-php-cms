<?php 




class ListAction extends Action {
	//构造方法,初始化
	public function __construct(&$_tpl) {
		parent::__construct($_tpl);
	}
	
	//执行
	public function _action() {
		$this->getNav();
		$this->getListContent();
	}
	
	//获取前台显示列表
	private function getListContent() {
		if (isset($_GET['id'])) {
			parent::__construct($this->_tpl, new ContentModel());
			$_nav = new NavModel();
			$_nav->id = $_GET['id'];
			$_navid = $_nav->getNavChildId();
			if ($_navid) {
				$this->_model->nav = Tool::objArrOfStr($_navid, 'id');
			} else {
				$this->_model->nav = $_nav->id;
			}
			parent::page($this->_model->getListContentTotal(), ARTICLE_SIZE);
			$_object = $this->_model->getListContent();
			Tool::subStr($_object, 'info', 130, 'utf-8');
			Tool::subStr($_object, 'title', 33, 'utf-8');
			if ($_object) {
				foreach ($_object as $_value) {
					if (empty($_value->thumbnail)) $_value->thumbnail = 'images/none.jpg';
				}
			}
			$this->_tpl->assign('AllListContent', $_object);
			$_object = $this->_model->getMonthNavRec();
			$this->setObj($_object);
			$this->_tpl->assign('MonthNavRec', $_object);
			$_object = $this->_model->getMonthNavHot();
			$this->setObj($_object);
			$this->_tpl->assign('MonthNavHot', $_object);
			$_object = $this->_model->getMonthNavPic();
			$this->setObj($_object);
			$this->_tpl->assign('MonthNavPic', $_object);
		} else {
			Tool::alertBack('导航id传值有误');
		}
	}
	
	//设置obj
	private function setObj(&$_object) {
		if ($_object) {
			Tool::Objdate($_object, 'date');
			Tool::subStr($_object, 'title', 14, 'utf-8');
		}
	}
	
	//获取导航列表
	private function getNav() {
		if (isset($_GET['id'])) {
			$_nav = new NavModel();
			$_nav->id = $_GET['id'];
			if ($_nav->getOneNav()) {
				if ($_nav->getOneNav()->nnav_name) {
					$_nav1 = '<a href="list.php?id='.$_nav->getOneNav()->iid.'">'.$_nav->getOneNav()->nnav_name.'</a> &gt; ';
				}
				$_nav2 = '<a href="list.php?id='.$_nav->getOneNav()->id.'">'.$_nav->getOneNav()->nav_name.'</a>';
				$this->_tpl->assign('nav', @$_nav1.$_nav2);
				$this->_tpl->assign('childnav', $_nav->getAllChildFrontNav());
			} else {
				Tool::alertBack('导航不存在');
			}
		} else {
			Tool::alertBack('导航不存在');
		}
	}
	
}



?>
<?php 




class DetailsAction extends Action {
	//构造方法,初始化
	public function __construct(&$_tpl) {
		parent::__construct($_tpl);
	}
	
	//action
	public function _action() {
		$this->getDetails();
	}
	
	//获取文章详细内容
	private function getDetails() {
		if (isset($_GET['id'])) {
			$_comment = new CommentModel();
			$_comment->cid = $_GET['id'];
			parent::__construct($this->_tpl, new ContentModel());
			$this->_model->id = $_GET['id'];
			if (!$this->_model->getOneContent()) Tool::alertBack('文章id不存在');
			$_content = $this->_model->getOneContent();
			$this->_tpl->assign('id', $_content->id);
			$this->_tpl->assign('titlec', $_content->title);
			$this->_tpl->assign('author', $_content->author);
			$this->_tpl->assign('date', $_content->date);
			$this->_tpl->assign('source', $_content->source);
			$this->_tpl->assign('info', $_content->info);
			$this->_tpl->assign('content', Tool::unHtml($_content->content));
			$_tagArr = explode(',', $_content->tag);
			if (is_array($_tagArr)) {
				foreach ($_tagArr as $_value) {
					$_content->tag = str_replace($_value, '<a style="color: #06f;" href="search.php?type=3&inputkeyword='.$_value.'">'.$_value.'</a>', $_content->tag);
				}
			}
			$this->_tpl->assign('tag', $_content->tag);
			$this->getNav($_content->nav);
			if (IS_CACHE) {
				$this->_tpl->assign('count', '<script>getContentCount();</script>');
			} else {
				$this->_tpl->assign('count', $_content->count);
			}
			$this->_tpl->assign('comment', $_comment->getCommentTotal());
			$_comment = $_comment->getNewThreeComment();
			foreach ($_comment as $_value) {
				switch ($_value->manner) {
					case 1 :
						$_value->manner = '支持';
						break;
					case 0 :
						$_value->manner = '中立';
						break;
					case -1 :
						$_value->manner = '反对';
						break;
				}
				if (empty($_value->face)) {
					$_value->face = '00.gif';
				}
				if (!empty($_value->oppose)) {
					$_value->oppose = '-'.$_value->oppose;
				}
			}
			$this->_model->nav = $_content->nav;
			$this->_tpl->assign('NewThreeComment', $_comment);
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
			Tool::alertBack('文章id有误');
		}
	}
	
	//设置obj
	private function setObj(&$_object) {
		if ($_object) {
			Tool::Objdate($_object, 'date');
			Tool::subStr($_object, 'title', 14, 'utf-8');
		}
	}
	
	//导航
	private function getNav($_id) {
		$_nav = new NavModel();
		$_nav->id = $_id;
		if ($_nav->getOneNav()) {
			if ($_nav->getOneNav()->nnav_name) {
				$_nav1 = '<a href="list.php?id='.$_nav->getOneNav()->iid.'">'.$_nav->getOneNav()->nnav_name.'</a> &gt; ';
			}
			$_nav2 = '<a href="list.php?id='.$_nav->getOneNav()->id.'">'.$_nav->getOneNav()->nav_name.'</a>';
			$this->_tpl->assign('nav', @$_nav1.$_nav2);
		} else {
			Tool::alertBack('导航不存在');
		}
	}
	
}

	

?>
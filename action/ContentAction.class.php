<?php 




class ContentAction extends Action {
	//构造方法,初始化
	public function __construct(&$_tpl) {
		parent::__construct($_tpl, new ContentModel);
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
		$_nav = new NavModel();
		if (empty($_GET['nav'])) {
			$_id = $_nav->getAllNavChildId();
			$this->_model->nav = Tool::objArrOfStr($_id, 'id');
		} else {
			$_nav->id = $_GET['nav'];
			if (!$_nav->getOneNav()) Tool::alertBack('找不到导航id');
			$this->_model->nav = $_nav->id;
		}
		parent::page($this->_model->getListContentTotal());
		$_object = $this->_model->getListContent();
		Tool::subStr($_object, 'title', 23, 'utf-8');
		$this->nav();
		$this->_tpl->assign('SearchContent', $_object);
		$this->_tpl->assign('show', true);
		$this->_tpl->assign('title', '管理文档列表');
	}

	//add
	private function add() {
		if (isset($_POST['send'])) {
			$this->getPost();
			$this->_model->addContent() ? Tool::alertLocation('数据新增成功', 'content.php?action=show') : Tool::alertBack('数据新增失败');
		}
		$this->nav();
		$this->_tpl->assign('add', true);
		$this->_tpl->assign('title', '新增文档列表');
		$this->_tpl->assign('author', $_SESSION['admin']['admin_user']);
	}

	//update
	private function update() {
		if (isset($_POST['send'])) {
			$this->_model->id = $_POST['id'];
			$this->getPost();
			$this->_model->updateContent() ? Tool::alertLocation('数据修改成功', $_POST['prev_url']) : Tool::alertBack('数据修改失败');
		}
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			$_content = $this->_model->getOneContent();
			if ($_content) {
				$this->_tpl->assign('id', $_content->id);
				$this->_tpl->assign('titlec', $_content->title);
				$this->nav($_content->nav);
				$this->_tpl->assign('tag', $_content->tag);
				$this->attr($_content->attr);
				$this->_tpl->assign('tag', $_content->tag);
				$this->_tpl->assign('keyword', $_content->keyword);
				$this->_tpl->assign('thumbnail', $_content->thumbnail);
				$this->_tpl->assign('source', $_content->source);
				$this->_tpl->assign('author', $_content->author);
				$this->_tpl->assign('info', $_content->info);
				$this->_tpl->assign('content', $_content->content);
				$this->commend($_content->commend);
				$this->_tpl->assign('count', $_content->count);
				$this->sort($_content->sort);
				$this->_tpl->assign('gold', $_content->gold);
				$this->readlimit($_content->readlimit);
				$this->color($_content->color);
				$this->_tpl->assign('prev_url', PREV_URL);
			} else {
				Tool::alertBack('文章不存在');
			}
		} else {
			Tool::alertBack('id传值有误');
		}
		$this->_tpl->assign('update', true);
		$this->_tpl->assign('title', '修改文档列表');
	}
	
	//getpost
	private function getPost() {
		if (Validate::checkNull($_POST['title'])) Tool::alertBack('标题不得为空');
		if (Validate::checkLength($_POST['title'], 2, 'min')) Tool::alertBack('标题长度不得小于两位');
		if (Validate::checkLength($_POST['title'], 66, 'max')) Tool::alertBack('标题长度不得大于66位');
		if (Validate::checkNull($_POST['nav'])) Tool::alertBack('请选择一个栏目');
		if (Validate::checkLength($_POST['tag'], 30, 'max')) Tool::alertBack('tag标签不得大于30位');
		if (Validate::checkLength($_POST['keyword'], 30, 'max')) Tool::alertBack('关键字不得大于30位');
		if (Validate::checkLength($_POST['source'], 23, 'max')) Tool::alertBack('文章来源长度不得大于23位');
		if (Validate::checkLength($_POST['author'], 13, 'max')) Tool::alertBack('作者来源长度不得大于23位');
		if (Validate::checkLength($_POST['info'], 233, 'max')) Tool::alertBack('内容摘要不得大于233位');
		if (Validate::checkNull($_POST['content'])) Tool::alertBack('内容不得为空');
		if (Validate::checkNum($_POST['count'])) Tool::alertBack('浏览次数必须是数字');
		if (Validate::checkNum($_POST['gold'])) Tool::alertBack('消费次数必须是数字');
		$this->_model->title = $_POST['title'];
		$this->_model->nav = $_POST['nav'];
		if (isset($_POST['attr'])) {
			$_attr = implode(',', $_POST['attr']);;
			$this->_model->attr = $_attr;
		} else {
			$this->_model->attr = '无属性';
		}
		$this->_model->tag = $_POST['tag'];
		$this->_model->keyword = $_POST['keyword'];
		$this->_model->thumbnail = $_POST['thumbnail_img'];
		$this->_model->source = $_POST['source'];
		$this->_model->author = $_POST['author'];
		$this->_model->info = $_POST['info'];
		$this->_model->content = $_POST['content'];
		$this->_model->commend = $_POST['commend'];
		$this->_model->count = $_POST['count'];
		$this->_model->sort = $_POST['sort'];
		$this->_model->gold = $_POST['gold'];
		$this->_model->readlimit = $_POST['readlimit'];
		$this->_model->color = $_POST['color'];
	}
	
	//attr
	private function attr($_attr) {
		$_arrArr = array('头条', '推荐', '加粗', '跳转');
		$_arrS = explode(',', $_attr);
		$_arrNo = array_diff($_arrArr, $_arrS);
		$_html = '';
		if ($_arrS['0'] != '无属性') {
			foreach ($_arrS as $_key => $_value) {
				$_html .= '<input type="checkbox" checked="checked" name="attr[]" value="'.$_value.'" id="attr'.$_key.'"><label for="attr'.$_key.'">'.$_value.'</label>';
			}
		}
		foreach ($_arrNo as $_key => $_value) {
			$_html .= '<input type="checkbox" name="attr[]" value="'.$_value.'" id="attr2'.$_key.'"><label for="attr2'.$_key.'">'.$_value.'</label>';
		}
		$this->_tpl->assign('attr', $_html);
	}
	
	//sort
	private function sort($_sort) {
		$_sortArr = array(0=>'默认排序', 1=>'置顶一天', 2=>'置顶一周', 3=>'置顶一月', 4=>'置顶一年');
		$_html = '';
		$_selected = '';
		foreach ($_sortArr as $_key => $_value) {
			if ($_key == $_sort) $_selected = 'selected="selected"';
			$_html .= '<option '.$_selected.' value='.$_key.'>'.$_value.'</option>';
			$_selected = '';
		}
		$this->_tpl->assign('sort', $_html);
	}
	
	//readlimit
	private function readlimit($_readlimit) {
		$_readlimitArr = array(0=>'开放预览', 1=>'初级会员', 2=>'中级会员', 3=>'高级会员', 4=>'VIP会员');
		$_html = '';
		$_selected = '';
		foreach ($_readlimitArr as $_key => $_value) {
			if ($_key == $_readlimit) $_selected = 'selected="selected"';
			$_html .= '<option '.$_selected.' value='.$_key.'>'.$_value.'</option>';
			$_selected = '';
		}
		$this->_tpl->assign('readlimit', $_html);
	}
	
	//color
	private function color($_color) {
		$_colorArr = array(''=>'默认颜色', 'yellow'=>'黄色', 'orange'=>'橙色', 'blue'=>'蓝色');
		$_html = '';
		$_selected = '';
		foreach ($_colorArr as $_key => $_value) {
			if ($_key == $_color) $_selected = 'selected="selected"';
			$_html .= '<option '.$_selected.' value='.$_key.' style="color: '.$_key.'">'.$_value.'</option>';
			$_selected = '';
		}
		$this->_tpl->assign('color', $_html);
	}
	
	//commend
	private function commend($_commend) {
		$_commendArr = array(0=>'禁止评论', 1=>'允许评论');
		$_html = '';
		$_checked = '';
		foreach ($_commendArr as $_key => $_value) {
			if ($_key == $_commend) $_checked = 'checked="checked"';
			$_html .= '<input type="radio" name="commend" '.$_checked.' value="'.$_key.'" id="commend'.$_key.'"> <label for="commend'.$_key.'">'.$_value.'</label>';
			$_selected = '';
		}
		$this->_tpl->assign('commend', $_html);
	}
	
	//delete
	private function delete() {
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			$this->_model->deleteContent() ? Tool::alertLocation('数据删除成功', PREV_URL) : Tool::alertBack('数据删除失败');
		} else {
			Tool::alertBack('非法操作');
		}
	}
	
	//nav 
	private function nav($_n = 0) {
		$_nav = new NavModel();
		$_html = '';
		$_selected = '';
		foreach ($_nav->getAllFrontNav() as $_object) {
			$_html .= '<optgroup label="'.$_object->nav_name.'">'."\r\n";
			$_nav->id = $_object->id;
			if ($_childNav = $_nav->getAllChildFrontNav()) {
				foreach ($_childNav as $_object) {
					if ($_n == $_object->id) $_selected = 'selected="selected"';
						$_html .= '<option '.$_selected.' value="'.$_object->id.'">'.$_object->nav_name.'</option>';
						$_selected = '';				
				}
			}
			$_html .= '</optgroup>';
		}
		$this->_tpl->assign('nav', $_html);
	}

}

	

?>
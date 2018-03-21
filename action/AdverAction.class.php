<?php 




class AdverAction extends Action {
	//构造方法,初始化
	public function __construct(&$_tpl) {
		parent::__construct($_tpl, new AdverModel);
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
			case 'text' : 
				$this->text();
				break;
			case 'header' : 
				$this->header();
				break;
			case 'sidebar' : 
				$this->sidebar();
				break;
			case 'state' :
				$this->setState();
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
		
		if (empty($_GET['kind'])) {
			$this->_model->kind = '1,2,3';
		} else {
			$this->_model->kind = $_GET['kind'];
		}
		$this->_tpl->assign('show', true);
		$this->_tpl->assign('title', '广告列表');
		parent::page($this->_model->getAdverTotal());
		$_object = $this->_model->getAllAdver();
		Tool::subStr($_object, 'link', 23, 'utf-8');
		if ($_object) {
			foreach ($_object as $_value) {
				switch ($_value->type) {
					case 1 :
						$_value->type = '文字广告';
						break;
					case 2 :
						$_value->type = '头部广告';
						break;
					case 3 :
						$_value->type = '侧栏广告';
						break;
				}
				if (empty($_value->state)) {
					$_value->state = '<span style="color: #393939">[否] | </span>  <a href="adver.php?action=state&type=ok&id='.$_value->id.'">确定</a>';
				} else {
					$_value->state = '<span style="color: #06f">[是] | </span>  <a href="adver.php?action=state&type=cancel&id='.$_value->id.'">取消</a>';
				}
			}
		}
		$this->_tpl->assign('AllAdver', $_object);
	}

	//add
	private function add() {
		if (isset($_POST['send'])) {
			$this->_model->type = $_POST['type'];
			if (Validate::checkNull($_POST['title'])) Tool::alertBack('广告标题不得为空');
			if (Validate::checkLength($_POST['title'], 23, 'max')) Tool::alertBack('广告标题不得大于23位');
			if (Validate::checkNull($_POST['link'])) Tool::alertBack('广告连接不得为空');
			if ($_POST['type'] == '2' || $_POST['type'] == '3') {
				if (Validate::checkNUll($_POST['thumbnail_img'])) Tool::alertBack('广告图片不能为空');
			}
			if (Validate::checkLength($_POST['info'], 233, 'max')) Tool::alertBack('广告描述不得大于200位');
			$this->_model->title = $_POST['title'];
			$this->_model->info = $_POST['info'];
			$this->_model->thumbnail = $_POST['thumbnail_img'];
			$this->_model->link = $_POST['link'];
			$this->_model->type = $_POST['type'];
			$this->_model->addAdver() ? Tool::alertLocation('数据新增成功', '?action=show') : Tool::alerBack('数据新增失败');
		}
		$this->_tpl->assign('add', true);
		$this->_tpl->assign('title', '新增广告');
		$this->_tpl->assign('prev_url', PREV_URL);
	}
	
	//text
	private function text() {
		$_object = $this->_model->getNewTextAdver();
		$_js = "var text = [];\r\n";
		$_i = 0;
		if ($_object) {
			foreach ($_object as $_value) {
				$_i ++;
				$_js .= "text[$_i] = {\r\n";
				$_js .=	"\t'title' : '$_value->title',\r\n";
				$_js .=	"\t'link' : '$_value->link'\r\n";
				$_js .=	"};\r\n";
			}
		}
		$_js .= "var i = Math.floor(Math.random() * $_i + 1);\r\n";	
		$_js .= "document.write('<a href=\"' + text[i].link + '\" target=\"_blank\" style=\"color: #06f;\">' + text[i].title + '</a>');";
		if (!file_put_contents('../js/text_adver.js', $_js)) {
			Tool::alertBack('文件生成出错');
		}
		Tool::alertLocation('更新文件成功', '?action=show');
	}

	//header
	private function header() {
		$_object = $this->_model->getNewHeaderAdver();
		$_js = "var header = [];\r\n";
		$_i = 0;
		if ($_object) {
			foreach ($_object as $_value) {
				$_i ++;
				$_js .= "header[$_i] = {\r\n";
				$_js .= "\t'title' : '$_value->title',\r\n";
				$_js .= "\t'pic' : '$_value->thumbnail',\r\n";
				$_js .= "\t'link' : '$_value->link'\r\n";
				$_js .= "};\r\n";
			}
		}
		$_js .= "var i = Math.floor(Math.random() * $_i + 1);";
		$_js .= "document.write('<a href=\"' + header[i].link + '\" target=\"_blank\"><img src=\"' + header[i].pic + '\"></a>')";
		if (!file_put_contents('../js/header_adver.js', $_js)) {
			Tool::alertBack('文件生成出错');
		}
		Tool::alertLocation('文件更新成功', '?action=show');
	}
	
	//sidebar
	private function sidebar() {
		$_object = $this->_model->getNewSidebarAdver();
		$_i = 0;
		$_js = "var sidebar = [];\r\n";
		if ($_object) {
			foreach ($_object as $_value) {
				$_i ++;
				$_js .= "sidebar[$_i] = {\r\n";
				$_js .= "\t'title' : '$_value->title',\r\n";
				$_js .= "\t'pic' : '$_value->thumbnail',\r\n";
				$_js .= "\t'link' : '$_value->link'\r\n";
				$_js .= "};\r\n";
			}
		}
		$_js .= "var i = Math.floor(Math.random() * $_i + 1);\r\n";
		$_js .= "document.write('<a href=\"sidebar[i].link\" target=\"_blank\"><img src=\"' + sidebar[i].pic + '\"></a>')";
		if (!file_put_contents('../js/sidebar_adver.js', $_js)) {
			Tool::alertBack('文件更新失败');
		}
		Tool::alertLocation('文件更新成功', '?action=show');
	}
	
	//setState
	private function setState() {
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			if (!$this->_model->getOneAdver()) Tool::alertBack('早不到此广告');
			if ($_GET['type'] == 'ok') {
				$this->_model->setStateOk() ? Tool::alertLocation(NULL, PREV_URL) : Tool::alertBack('数据修改失败');
			} else if ($_GET['type'] == 'cancel') {
				$this->_model->setStateCancel() ? Tool::alertLocation(NULL, PREV_URL) : Tool::alertBack('数据修改失败');
			} else {
				Tool::alertBack('非法操作');
			}
		} else {
			Tool::alertBack('非法操作');
		}
	}

	//update
	private function update() {
		if (isset($_POST['send'])) {
			if (Validate::checkNull($_POST['title'])) Tool::alertBack('广告标题不得为空');
			if (Validate::checkLength($_POST['title'], 23, 'max')) Tool::alertBack('广告标题不得大于23位');
			if (Validate::checkNull($_POST['link'])) Tool::alertBack('广告连接不得为空');
			if ($_POST['type'] == '2' || $_POST['type'] == '3') {
				if (Validate::checkNUll($_POST['thumbnail_img'])) Tool::alertBack('广告图片不能为空');
			}
			if (Validate::checkLength($_POST['info'], 233, 'max')) Tool::alertBack('广告描述不得大于200位');
			$this->_model->id = $_POST['id'];
			$this->_model->title = $_POST['title'];
			$this->_model->info = $_POST['info'];
			$this->_model->thumbnail = $_POST['thumbnail_img'];
			$this->_model->link = $_POST['link'];
			$this->_model->type = $_POST['type'];
			$this->_model->state = $_POST['state'];
			$this->_model->updateAdver() ? Tool::alertLocation('数据修改成功', $_POST['prev_url']) : Tool::alertBack('数据修改失败');
		}
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			if (!$this->_model->getOneAdver()) Tool::alertBack('找不到这广告');
			$_adver = $this->_model->getOneAdver();
			$this->_tpl->assign('id', $_adver->id);
			$this->_tpl->assign('titlec', $_adver->title);
			$this->_tpl->assign('info', $_adver->info);
			$this->_tpl->assign('link', $_adver->link);
			$this->_tpl->assign('thumbnail', $_adver->thumbnail);
			switch ($_adver->type) {
				case 1 :
					$this->_tpl->assign('type1', 'checked="checked"');
					$this->_tpl->assign('type2', '');
					$this->_tpl->assign('type3', '');
					$this->_tpl->assign('pic', 'display: none;');
					$this->_tpl->assign('up', '');
					break;
				case 2 :
					$this->_tpl->assign('type2', 'checked="checked"');
					$this->_tpl->assign('type1', '');
					$this->_tpl->assign('type3', '');
					$this->_tpl->assign('pic', 'display: block;');
					$this->_tpl->assign('up', "<input id=\"thumbnail1\" type=\"button\" value=\"上传头部广告\">");
					break;
				case 3 :
					$this->_tpl->assign('type3', 'checked="checked"');
					$this->_tpl->assign('type1', '');
					$this->_tpl->assign('type2', '');
					$this->_tpl->assign('pic', 'display: block;');
					$this->_tpl->assign('up', "<input id=\"thumbnail2\" type=\"button\" value=\"上传侧栏广告\">");
					break;
			}
			if (empty($_adver->state)) {
				$this->_tpl->assign('right_state', 'checked="checked"');
				$this->_tpl->assign('left_state', '');
			} else {
				$this->_tpl->assign('left_state', 'checked="checked"');
				$this->_tpl->assign('right_state', '');
			}
		} else {
			Tool::alertBack('非法操作');
		}
		$this->_tpl->assign('update', true);
		$this->_tpl->assign('title', '修改广告');
		$this->_tpl->assign('prev_url', PREV_URL);
	}
	
	//delete
	private function delete() {
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			if (!$this->_model->getOneAdver()) Tool::alertBack('找不到将要删除的广告');
			$this->_model->deleteAdver() ? Tool::alertLocation('数据删除成功', '?action=show') :　Tool::alertBack('数据删除失败');
		} else {
			Tool::alertBack('非法操作');
		}
	}

}

	

?>
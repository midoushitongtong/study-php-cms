<?php 




class RotationAction extends Action {	
	//构造方法,初始化
	public function __construct(&$_tpl) {
		parent::__construct($_tpl, new RotationModel());
	}
	
	//action
	public function _action() {
		//业务流程控制器
		switch (@$_GET['action']) {
			case 'show' :
				$this->show();
				break;
			case 'state' : 
				$this->setState();
				break;
			case 'add' :
				$this->add();
				break;
			case 'xml' : 
				$this->xml();
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
		$this->_tpl->assign('show', true);
		$this->_tpl->assign('title', '管理轮播器');
		parent::page($this->_model->getRotationTotal(), PAGE_SIZE);
		$_object = $this->_model->getAllRotation();
		Tool::subStr($_object, 'thumbnail', 33, 'utf-8');
		Tool::subStr($_object, 'title', 23, 'utf-8');
		if ($_object) {
			foreach ($_object as $_value) {
				if (empty($_value->state)) {
					$_value->state = '<span>[否]</span> | <a href="rotation.php?action=state&type=ok&id='.$_value->id.'">通过</a>';
				} else {
					$_value->state = '<span style="color: #06f;">[是]</span> | <a href="rotation.php?action=state&type=cancel&id='.$_value->id.'">取消</a>';
				}
			}
		}
		$this->_tpl->assign('AllRotation', $_object);
	}
	
	//state
	private function setState() {
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			if (!$this->_model->getOneRotation()) Tool::alertBack('不存在轮播图');
			if ($_GET['type'] == 'ok') {
				$this->_model->setStateOk() ? Tool::alertLocation(NULL, PREV_URL) : Tool::alertBack('数据修改失败');
			} else if ($_GET['type'] == 'cancel') {
				$this->_model->setStateCancel() ? Tool::alertLocation(NULL, PREV_URL) : Tool::alertBack('数据修改失败');
			} else {
				Tool::alertBack('非法操作');
			}
		} else {
			Tool::alertBack('id传值有误');
		}
	}
	
	//add
	private function add() {
		if (isset($_POST['send'])) {
			if (Validate::checkNull($_POST['thumbnail_img'])) Tool::alertBack('轮播图不能为空');
			if (Validate::checkNull($_POST['link'])) Tool::alertBack('连接不得为空');
			if (Validate::checkLength($_POST['title'], 23, 'max')) Tool::alertBack('标题不得大于23位');
			if (Validate::checkLength($_POST['info'], 666, 'max')) Tool::alertBack('简介不得大于666位');
			$this->_model->thumbnail = $_POST['thumbnail_img'];
			$this->_model->link = $_POST['link'];
			$this->_model->title = $_POST['title'];
			$this->_model->info = $_POST['info'];
			$this->_model->addRotation() ? Tool::alertLocation('数据新增成功', '?action=show') : Tool::alertBack('数据新增失败');
		}
		$this->_tpl->assign('add', true);
		$this->_tpl->assign('title', '新增轮播器');
		$this->_tpl->assign('prev_url', PREV_URL);
	}
	
	//xml
	private function xml() {
		$_object = $this->_model->getNewRotation();
		
		$_xml = '';
		$_xml .= '<?xml version="1.0" encoding="utf-8"?>'."\r\n";
		$_xml .= '<bcaster autoPlayTime="'.RO_NUM.'">'."\r\n";
		if ($_object) {
			foreach ($_object as $_value) {
				$_xml .= '<item item_url="'.$_value->thumbnail.'" link="'.$_value->link.'"></item>'."\r\n";
			}
		}
		$_xml .= '</bcaster>';
		$_sex = new SimpleXMLELEMent($_xml);
		$_sex->asXML('../bcastr.xml');
		Tool::alertLocation('首页轮播更新成功', '?action=show');
	}
	
	//update
	private function update() {
		if (isset($_POST['send'])) {
			if (Validate::checkNull($_POST['thumbnail_img'])) Tool::alertBack('轮播图不能为空');
			if (Validate::checkNull($_POST['link'])) Tool::alertBack('连接不得为空');
			if (Validate::checkLength($_POST['title'], 23, 'max')) Tool::alertBack('标题不得大于23位');
			if (Validate::checkLength($_POST['info'], 666, 'max')) Tool::alertBack('简介不得大于666位');
			$this->_model->id = $_POST['id'];
			$this->_model->thumbnail = $_POST['thumbnail_img'];
			$this->_model->link = $_POST['link'];
			$this->_model->title = $_POST['title'];
			$this->_model->info = $_POST['info'];
			$this->_model->state = $_POST['state'];
			$this->_model->updateRotation() ? Tool::alertLocation('数据修改成功', $_POST['prev_url']) : Tool::alertBack('数据修改失败');
		}
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			$_rotation = $this->_model->getOneRotation();
			if (!$_rotation) Tool::alertBack('不存在此轮播器');
			$this->_tpl->assign('id', $_rotation->id);
			$this->_tpl->assign('thumbnail', $_rotation->thumbnail);
			$this->_tpl->assign('link', $_rotation->link);
			$this->_tpl->assign('titlec', $_rotation->title);
			$this->_tpl->assign('info', $_rotation->info);
			if (!empty($_rotation->state)) {
				$this->_tpl->assign('left_state', 'checked="checked"');
				$this->_tpl->assign('right_state', '');
			} else {
				$this->_tpl->assign('right_state', 'checked="checked"');
				$this->_tpl->assign('left_state', '');
			}
			$this->_tpl->assign('prev_url', PREV_URL);
		} else {
			Tool::alertBack('非法操作');
		}
		$this->_tpl->assign('update', true);
		$this->_tpl->assign('title', '修改轮播器');
		$this->_tpl->assign('prev_url', PREV_URL);
	}
	
	//delete
	private function delete() {
		if (isset($_GET['id'])) {
			$this->_model->id = $_GET['id'];
			if (!$this->_model->getOneRotation()) Tool::alertBack('找不到将要删除的数据');
			$this->_model->deleteRotation() ? Tool::alertLocation('数据删除成功', PREV_URL) : Tool::alertBack('数据删除失败') ;
		} else {
			Tool::alertBack('非法操作');
		}
	}

}



?>
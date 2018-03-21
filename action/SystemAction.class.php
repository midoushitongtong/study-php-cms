<?php 




class SystemAction extends Action {
	//构造方法,初始化
	public function __construct(&$_tpl) {
		parent::__construct($_tpl, new SystemModel());
	}
	
	//action
	public function _action() {
		$this->show();
	}
		
	//show
	private function show() {
		if (isset($_POST['send'])) {
			$this->_model->webname = $_POST['webname'];
			$this->_model->page_size = $_POST['page_size'];
			$this->_model->article_size = $_POST['article_size'];
			$this->_model->nav_size = $_POST['nav_size'];
			$this->_model->updir = $_POST['updir'];
			$this->_model->ro_time = $_POST['ro_time'];
			$this->_model->ro_num = $_POST['ro_num'];
			$this->_model->adver_text_num = $_POST['adver_text_num'];
			$this->_model->adver_logo_num = $_POST['adver_logo_num'];
			
			if ($this->_model->setSystem()) {
				$_br = "\r\n";
				$_tab = "\t";
				$_profile = '<?php'.$_br;
				$_profile .= $_br;
				$_profile .= $_br;
				$_profile .= $_br;
				$_profile .= $_br;
				$_profile .= "//分页配置信息".$_br;
				$_profile .= "define('WEBNAME', '{$this->_model->webname}');".$_br;
				$_profile .= "define('PAGE_SIZE', {$this->_model->page_size});".$_br;
				$_profile .= "define('ARTICLE_SIZE', {$this->_model->article_size});".$_br;
				$_profile .= "define('NAV_SIZE', {$this->_model->nav_size});".$_br;
				$_profile .= $_br;
				$_profile .= "//图片上传配置信息".$_br;
				$_profile .= "define('UPDIR', '/{$this->_model->updir}/');".$_br;
				$_profile .= $_br;
				$_profile .= "//轮播配置信息".$_br;
				$_profile .= "define('RO_TIME', {$this->_model->ro_time});".$_br;
				$_profile .= "define('RO_NUM', {$this->_model->ro_num});".$_br;
				$_profile .= $_br;
				$_profile .= "//广告配置信息".$_br;
				$_profile .= "define('ADVER_TEXT_NUM', {$this->_model->adver_text_num});".$_br;
				$_profile .= "define('ADVER_PIC_NUM', {$this->_model->adver_logo_num});".$_br;
				$_profile .= $_br;
				$_profile .= "//数据库信息".$_br;
				$_profile .= "define('DB_HOST', 'localhost');".$_br;
				$_profile .= "define('DB_USER', 'root');".$_br;
				$_profile .= "define('DB_PWD', '593690203');".$_br;
				$_profile .= "define('DB_NAME', 'cms');".$_br;
				$_profile .= "define('DB_PORT', 3306);".$_br;
				$_profile .= $_br;
				$_profile .= "define('GPC', get_magic_quotes_gpc());".$_br;
				$_profile .= "define('PREV_URL', @\$_SERVER[\"HTTP_REFERER\"]);".$_br;
				$_profile .= $_br;
				$_profile .= "//模板配置信息".$_br;
				$_profile .= "define('MARK', ROOT_PATH.'/images/yc.png');".$_br;
				$_profile .= "define('TPL_DIR', ROOT_PATH.'/templates/');".$_br;
				$_profile .= "define('TPL_C_DIR', ROOT_PATH.'/templates_c/');".$_br;
				$_profile .= "define('CACHE', ROOT_PATH.'/cache/');".$_br;
				$_profile .= $_br;
				$_profile .= $_br;
				$_profile .= $_br;
				$_profile .= '?>';
				if (!file_put_contents('../config/profile.inc.php', $_profile)) {
					Tool::alertBack('生成配置文件出错');
				}
				Tool::alertBack('数据修改成功');
			} else {
				Tool::alertBack('数据修改失败');
			}
		}
		$_object = $this->_model->getSystem();
		$this->_tpl->assign('webname', $_object->webname);
		$this->_tpl->assign('page_size', $_object->page_size);
		$this->_tpl->assign('article_size', $_object->article_size);
		$this->_tpl->assign('nav_size', $_object->nav_size);
		$this->_tpl->assign('updir', $_object->updir);
		$this->_tpl->assign('ro_time', $_object->ro_time);
		$this->_tpl->assign('ro_num', $_object->ro_num);
		$this->_tpl->assign('adver_text_num', $_object->adver_text_num);
		$this->_tpl->assign('adver_logo_num', $_object->adver_logo_num);
	}
}



?>
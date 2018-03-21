<?php 




class MainAction extends Action {
	//构造方法,初始化
	public function __construct(&$_tpl) {
		parent::__construct($_tpl);
	}
	
	//action
	public function _action() {
		if (!empty($_GET['action']) == 'delcache') {
			if (in_array('2', $_SESSION['admin']['permission'])) {
				$this->UnCache();
			} else {
				Tool::alertBack('你的权限不足');				
			}
		}
		$this->cacheNum();
	}
	
	//获取文件个数
	private function cacheNum() {
		$_dir = ROOT_PATH.'/cache/';
		$_num = sizeof(scandir($_dir));
		$this->_tpl->assign('cacheNum', $_num - 2);
	}
	
	//清理缓存文件
	private function UnCache() {
		$_dir = ROOT_PATH.'/cache/';
		if (!$_dh = @opendir($_dir)) return;
		while (false !== ($_obj = readdir($_dh))) {
			if ($_obj == '.' || $_obj == '..') continue;
			@unlink($_dir.'/'.$_obj);
		}
		closedir($_dh);
		Tool::alertLocation('缓存清理完毕', 'main.php');
	}
	
}

	

?>
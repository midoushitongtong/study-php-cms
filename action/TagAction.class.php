<?php




class TagAction extends Action {
	
	//构造方法，初始化 
	public function __construct(&$_tpl) {
		parent::__construct($_tpl, new TagModel());
	}
	
	//执行
	public function _action() {
		
	}
	
	//five
	public function getFiveTag() {
		$this->_tpl->assign('FiveTag', $this->_model->getFiveTag());
	}
	
}
?>
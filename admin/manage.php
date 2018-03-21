<?php 




require substr(dirname(__FILE__), 0, -6).'/init.inc.php';
Validate::checkSession();
Validate::checkPermission('3', '你的权限不足');
global $_tpl;
$_manage = new ManageAction($_tpl);
$_manage->_action();
$_tpl->display('manage.tpl');
	
?>
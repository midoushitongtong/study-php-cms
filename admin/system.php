<?php 




require substr(dirname(__FILE__), 0, -6).'/init.inc.php';
global $_tpl;
Validate::checkSession();
Validate::checkPermission('14', '你的权限不足');
$_system = new SystemAction($_tpl);
$_system->_action();
$_tpl->display('system.tpl');
	
?>
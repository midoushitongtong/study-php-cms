<?php 




require substr(dirname(__FILE__), 0, -6).'/init.inc.php';
global $_tpl;
Validate::checkSession();
Validate::checkPermission('5', '你的权限不足');
$_permission = new PermissionAction($_tpl);
$_permission->_action();
$_tpl->display('permission.tpl');
	
?>
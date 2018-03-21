<?php 




require substr(dirname(__FILE__), 0, -6).'/init.inc.php';
Validate::checkSession();
Validate::checkPermission('9', '你的权限不足');
global $_tpl;
$_rotation = new RotationAction($_tpl);
$_rotation->_action();
$_tpl->display('rotation.tpl');




?>
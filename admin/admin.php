<?php 




require substr(dirname(__FILE__), 0, -6).'/init.inc.php';
$_tpl->assign('webname', WEBNAME);
Validate::checkSession();
global $_tpl;
$_tpl->display('admin.tpl');



?>
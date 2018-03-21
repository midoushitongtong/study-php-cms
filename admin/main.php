<?php 




require substr(dirname(__FILE__), 0, -6).'/init.inc.php';
global $_tpl;
$_main = new MainAction($_tpl); 
$_main->_action();
$_tpl->display('main.tpl');


?>
<?php 




require substr(dirname(__FILE__), 0, -6).'/init.inc.php';
global $_tpl;
Validate::checkSession();
Validate::checkPermission('8', '你的权限不足');
$_comment = new CommentAction($_tpl);
$_comment->_action();
$_tpl->display('comment.tpl');


?>
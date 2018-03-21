<?php




//分页配置信息
define('WEBNAME', '内容管理系统');
define('PAGE_SIZE', 6);
define('ARTICLE_SIZE', 6);
define('NAV_SIZE', 9);

//图片上传配置信息
define('UPDIR', '/uploads/');

//轮播配置信息
define('RO_TIME', 3);
define('RO_NUM', 3);

//广告配置信息
define('ADVER_TEXT_NUM', 6);
define('ADVER_PIC_NUM', 3);

//数据库信息
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PWD', '593690203');
define('DB_NAME', 'cms');
define('DB_PORT', 3306);

define('GPC', get_magic_quotes_gpc());
define('PREV_URL', @$_SERVER["HTTP_REFERER"]);

//模板配置信息
define('MARK', ROOT_PATH.'/images/yc.png');
define('TPL_DIR', ROOT_PATH.'/templates/');
define('TPL_C_DIR', ROOT_PATH.'/templates_c/');
define('CACHE', ROOT_PATH.'/cache/');



?>
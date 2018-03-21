<?php




class Templates {
	//所以我们要动态的接受变量
	private $_vars = array();
	//保存系统变量
	private $_config = array();
	
	private $_cache = null;
	
	//创建一个构造方法，来验证各个目录是否存在
	public function __construct($_cache) {
		if (!is_dir(TPL_DIR) || !is_dir(TPL_C_DIR) || !is_dir(CACHE)) {
			exit('ERROR：模板目录或编译目录或缓存目录不存');
		}
		//保存系统变量 
		$_sxe = simplexml_load_file(ROOT_PATH.'/config/profile.xml');
		$_tagLib = $_sxe->xpath('/root/taglib');
		foreach ($_tagLib as $_tag) {
			$this->_config["$_tag->name"] = $_tag->value;
		}
		$this->_cache = $_cache;
	}
	
	public function assign($_var, $_value) {
		//$_var用于同步模板里的变量名  例如index.php是name 那么index.tpl就是{$name}
		if (isset($_var) && !empty($_var)) {
			$this->_vars[$_var] = $_value;
		} else {
			exit('ERROR：请设置模板变量');
		}
	}
	
	//cache
	public function cache($_file) {
		//设置模板的路径
		$_tplFile = TPL_DIR.$_file;
		//判断模板是否存在
		if (!file_exists($_tplFile)) {
			exit('ERROR：模板文件不存在');
		}
		//是否传递参数
		if (!empty($_SERVER["QUERY_STRING"])) {
			$_file_query = $_SERVER["QUERY_STRING"];
		} else {
			$_file_query = '';
		}
		//编译文件
		$_parFile = TPL_C_DIR.md5($_file).$_file.'.php';
		//缓存文件
		$_cacheFile = CACHE.md5($_file).$_file.$_file_query.'.html';
		//当第二次运行相同文件的时候，直接载入缓存文件，避开编译
		if (IS_CACHE) {
			//缓存文件和编译文件都要存在
			if (file_exists($_cacheFile) && file_exists($_parFile)) {
				//判断模板文件是否修改过，判断编译文件是否修改过
				if (filemtime($_parFile) >= filemtime($_tplFile) && filemtime($_cacheFile) >= filemtime($_parFile)) {
					//载入缓存文件
					include $_cacheFile;
					exit();
				}
			}
		}
	}
	
	public function display($_file) {
		//给include进来的tpl传一个模板操作的对象
		$_tpl = $this;
		//设置模板的路径
		$_tplFile = TPL_DIR.$_file;
		//判断模板是否存在
		if (!file_exists($_tplFile)) {
			exit('ERROR：模板文件不存在');
		}
		//是否传递参数
		if (!empty($_SERVER["QUERY_STRING"])) {
			$_file_query = $_SERVER["QUERY_STRING"];
		} else {
			$_file_query = '';
		}
		//编译文件
		$_parFile = TPL_C_DIR.md5($_file).$_file.'.php';
		//缓存文件
		$_cacheFile = CACHE.md5($_file).$_file.$_file_query.'.html';
		
		//当编译文件不存在，或者模板文件修改过，则生成编译文件
		if (!file_exists($_parFile) || filemtime($_parFile) < filemtime($_tplFile)) {
			//引入模板解析类
			require_once ROOT_PATH.'/includes/Parser.class.php';
			$_parser = new Parser($_tplFile);  						 //模板文件
			$_parser->compile($_parFile); 								 //编译文件
		}
		//载入编译文件
		include $_parFile;
		if (IS_CACHE && !$this->_cache->noCache()) {
			//获取缓冲区内的数据，并且创建缓存文件
			file_put_contents($_cacheFile, ob_get_contents());
			//清除缓冲区(清除了编译文件加载的内容)
			ob_end_clean();
			//载入缓存文件
			include $_cacheFile;
		}
	}

	public function create($_file) {
		//设置模板的路径
		$_tplFile = TPL_DIR.$_file;
		//判断模板是否存在
		if (!file_exists($_tplFile)) {
			exit('ERROR：模板文件不存在');
		}
		//编译文件
		$_parFile = TPL_C_DIR.md5($_file).$_file.'.php';
		//当编译文件不存在，或者模板文件修改过，则生成编译文件
		if (!file_exists($_parFile) || filemtime($_parFile) < filemtime($_tplFile)) {
			//引入模板解析类
			require_once ROOT_PATH.'/includes/Parser.class.php';
			$_parser = new Parser($_tplFile);   												//模板文件
			$_parser->compile($_parFile); 														  //编译文件
		}
		//载入编译文件
		include $_parFile;
	}
	
}



?>
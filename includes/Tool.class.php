<?php 




class Tool {
	//弹窗跳转
	static public function alertLocation($_info, $_url) {
		if (!empty($_info)) {
			echo "<script>alert('$_info');location.href='$_url'</script>";
			exit();
		} else {
			header('Location:'.$_url);
			exit();		
		}
	}
	
	//弹窗返回
	static public function alertBack($_info) {
		echo "<script>alert('$_info');history.back();</script>";
		exit();
	}
	
	//弹窗关闭
	static public function alertClose($_info) {
		echo "<script>alert('$_info');close();</script>";
	}
	
	//上传专用
	static public function alertOpenClose($_info, $_path) {
		echo "<script>alert('$_info');</script>";
		echo "<script>opener.document.content.thumbnail_img.value = '$_path'</script>";
		echo "<script>opener.document.content.pic.style.display = 'block';</script>";
		echo "<script>opener.document.content.pic.src = '$_path'</script>";
		echo "<script>window.close()</script>";
	}
	
	
	
	//转换tpl后缀
	static public function tplName() {
		$_str = explode('/', $_SERVER['SCRIPT_NAME']);
		$_str = explode('.', $_str[count($_str) - 1]);
		return $_str[0];
	}
	
	//将html字符串转换成html
	static public function unHtml($_str) {
		return htmlspecialchars_decode($_str);
	}
	
	//将对象数组转换成字符串去掉最后一个,
	static public function objArrOfStr(&$_object, $_field) {
		$_html = '';
		foreach ($_object as $_value) {
			$_html .= $_value->$_field.',';
		}
		return substr($_html, 0, strlen($_html) - 1);
	}
	
	//字符串显示长度
	static public function subStr(&$_object, $_field, $_length, $_encoding) {
		if ($_object) {
			if (is_array($_object)) {
				foreach ($_object as $_key => $_value) {
					if (mb_strlen($_value->$_field, $_encoding) > $_length) {
						$_value->$_field = mb_substr($_value->$_field, 0, $_length, $_encoding).'...';
					}
				}
			} else {
				if (mb_strlen($_object, $_encoding) > $_length) {
					return mb_substr($_object, 0, $_length, $_encoding).'...';
				}
				return $_object;
			}
		}
	}
	
	//日期转换格式
	static public function Objdate($_object, $_field) {
		foreach ($_object as $_value) {
			$_value->$_field = date('m-d', strtotime($_value->$_field));
		}
	}
	
	//显示过滤
	static public function htmlString($_data) {
		$_string = $_data;
		if (is_array($_data)) {
			foreach ($_data as $_key => $_value) {
				$_string[$_key] = Tool::htmlString($_value);
			}
		} else if (is_object($_data)) {
			foreach ($_data as $_key => $_value) {
				$_string->$_key = Tool::htmlString($_value);
			}
		} else {
			$_string = htmlspecialchars($_data);
		}
		return $_string;
	}
	
	//数据写入过滤
	static public function mysqlString($_data) {
		return !GPC ? addslashes($_data) : $_data;
	}
	
	//清理SESSION
	static public function unSession() {
		if (session_start()) {
			session_destroy();
		}
	}
	
}



?>
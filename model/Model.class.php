<?php 




class Model {
	//执行多条语句
	public function multi($_sql) {
		$_db = DB::getDB();
		$_result = $_db->multi_query($_sql);
		DB::unDB($_result, $_db);
		return true;
	}
	
	//获取下个id
	public function nextId($_table) {
		$_sql = "SHOW TABLE STATUS LIKE '$_table'";
		$_object = $this->one($_sql);
		return $_object->Auto_increment;
	}
	
	//查找单个模型
	protected function one($_sql) {
		$_db = DB::getDB();
		$_result = $_db->query($_sql);
		$_object = $_result->fetch_object();
		DB::unDB($_result, $_db);
		return Tool::htmlString($_object);
	}

	//查找多个模型
	protected function all($_sql) {
		$_db = DB::getDB();
		$_result = $_db->query($_sql);
		$_html = array();
		while ($_objects = $_result->fetch_object()) {
			$_html[] = $_objects;
		}
		DB::unDB($_result, $_db);
		return Tool::htmlString($_html);
	}		
	
	//增删修模型
	protected function aud($_sql) {
		$_db = DB::getDB();
		$_result = $_db->query($_sql);
		$_affected_rows = $_db->affected_rows;
		DB::unDB($_result, $_db);
		return $_affected_rows;
	}
	
	//查找总记录模型
	protected function total($_sql) {
		$_db = DB::getDB();
		$_result = $_db->query($_sql);
		$_total = $_result->fetch_row();
		DB::unDB($_result, $_db);
		return $_total[0];
	}
	
}



?>
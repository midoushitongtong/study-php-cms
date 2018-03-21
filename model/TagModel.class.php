<?php 



	
class TagModel extends Model {
	
	private $id;
	private $tagname;
	private $count;
	
	//访问私有变量
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
	
	public function __get($_key) {
		return $this->$_key;
	}
	
	//获取id唯一
	public function getOneTag() {
		$_sql = "SELECT 
										tagname 
							 FROM 
										cms_tag 
							WHERE 
										tagname = '$this->tagname'";
		return parent::one($_sql);
	}
	
	//前台显示标签
	public function getFiveTag() {
		$_sql = "SELECT 
										tagname,
										count 
							 FROM 
										cms_tag 
					 ORDER BY 
										count 
										DESC 
							LIMIT 
										0,5";
		return parent::all($_sql);
	}
	
	//新增
	public function addTag() {
		$_sql = "INSERT INTO cms_tag (
																		tagname
																	)
														VALUES
																	(
																		'$this->tagname'
																	)";
		return parent::aud($_sql);
	}
	
	//累积
	public function addTagCount() {
		$_sql = "UPDATE 
										cms_tag 
								SET 
										count = count + 1 
							WHERE 
										tagname = '$this->tagname'";
		return parent::aud($_sql);
	}
	
}



?>
<?php 



	
class LevelModel extends Model {
	private $id;
	private $level_name;
	private $level_info;
	private $level;
	private $permission;
	private $limit;
	
	
	//访问私有变量
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
	
	public function __get($_key) {
		return $this->$_key;
	}
	
	//查询总记录
	public function getLevelTotal() {
		$_sql = "SELECT
											COUNT(*)
								 FROM
											cms_level";
		return parent::total($_sql);
	}
	
	//查询单个管理等级
	public function getOneLevel() {
		$_sql = "SELECT 
									  id,
									  level_name,
									  level_info
							 FROM
									  cms_level
						  WHERE 
									  id = '$this->id'
								 OR
								 		level_name = '$this->level_name'
							LIMIT 
										1";
		return parent::one($_sql);
	}
	
	//查询所有管理等级
	public function getAllLevel() {
		$_sql = "SELECT 
									 	id,
										level_name,
										level_info
							 FROM 
										cms_level
				 	 ORDER BY
										id
										ASC
							LIMIT 0,666";
		return parent::all($_sql);
	}
	
	//查询所有管理分页数目等级
	public function getAllLimitLevel() {
		$_sql = "SELECT
									 	id,
										level_name,
										level_info,
										permission
							 FROM
										cms_level
				 	 ORDER BY
										id
										ASC
							$this->limit";
		return parent::all($_sql);
	}
	
	//新增管理等级
	public function addLevel() {
		$_sql = "INSERT INTO cms_level (
																			level_name,
									  									level_info,
									  									permission
																		)
															VALUES
																		(
																			'$this->level_name',
																			'$this->level_info',
																			'$this->permission'
																		)";
		return parent::aud($_sql);
	}

	//修改管理等级
	public function updateLevel() {
		$_sql = "UPDATE
										cms_level
								SET
										level_name = '$this->level_name', 
										level_info = '$this->level_info',
										permission = '$this->permission'
							WHERE 
										id = '$this->id' 
							LIMIT 
										1";
		return parent::aud($_sql);
	}
	
	//删除管理等级
	public function deleteLevel() {
		$_sql = "DELETE FROM
												cms_level 
									 WHERE
												id = '$this->id' 
									 LIMIT
											  1";
		return parent::aud($_sql);
	}
	
}



?>
<?php 



	
class PermissionModel extends Model {
	private $id;
	private $name;
	private $info;
	private $limit;

	//访问私有变量
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
	
	public function __get($_key) {
		return $this->$_key;
	}
	
	
	
	//total
	public function getPermissionTotal() {
		$_sql = "SELECT 
										COUNT(*) 
							 FROM 
										cms_permission";
		return parent::total($_sql);
	}
	
	//show
	public function getAllPermission() {
		$_sql = "SELECT 
										id,
										name
							 FROM 
										cms_permission 
					 ORDER BY 
										id 
										ASC";
		return parent::all($_sql);
	}
	
	//show
	public function getAllLimitPermission() {
		$_sql = "SELECT 
										id,
										name
							 FROM 
										cms_permission 
					 ORDER BY 
										id 
										DESC 
								$this->limit";
		return parent::all($_sql);
	}
	
	//add
	public function addPermission() {
		$_sql = "INSERT INTO
													cms_permission (
																						name,
																						info
																					) 
																	 VALUES (
																						'$this->name',
																						'$this->info'
																					)";
		return parent::aud($_sql);
	}
	
	//获取一条记录
	public function getOnePermission() {
		$_sql = "SELECT 
										id,
										name,
										info
							 FROM 
										cms_permission 
							WHERE 
										name = '$this->name'
								 OR
									 	id = '$this->id'";
		return parent::one($_sql);
	}
	
	//update
	public function updatePermission() {
		$_sql = "UPDATE 
										cms_permission 
								SET 
										name = '$this->name',
										info = '$this->info' 
							WHERE 
										id = '$this->id'
							LIMIT
											1";
		return parent::aud($_sql);
	}
	
	//delte
	public function deletePermission() {
		$_sql = "DELETE FROM 
													cms_permission 
										WHERE 
													id = '$this->id'
										LIMIT
													1";
		return parent::aud($_sql);
	}
	
}



?>
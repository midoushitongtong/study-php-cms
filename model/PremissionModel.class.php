<?php 



	
class PremissionModel extends Model {
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
	public function getPremissionTotal() {
		$_sql = "SELECT 
										COUNT(*) 
							 FROM 
										cms_premission";
		return parent::total($_sql);
	}
	
	//show
	public function getAllPremission() {
		$_sql = "SELECT 
										id,
										name
							 FROM 
										cms_premission 
					 ORDER BY 
										id 
										DESC 
								$this->limit";
		return parent::all($_sql);
	}
	
	//add
	public function addPremission() {
		$_sql = "INSERT INTO
													cms_premission (
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
	public function getOnePremission() {
		$_sql = "SELECT 
										id,
										name,
										info
							 FROM 
										cms_premission 
							WHERE 
										name = '$this->name'
								 OR
									 	id = '$this->id'";
		return parent::one($_sql);
	}
	
	//update
	public function updatePremission() {
		$_sql = "UPDATE 
										cms_premission 
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
	public function deletePremission() {
		$_sql = "DELETE FROM 
													cms_premission 
										WHERE 
													id = '$this->id'
										LIMIT
													1";
		return parent::aud($_sql);
	}
	
}



?>
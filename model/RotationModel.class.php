<?php 



	
class RotationModel extends Model {
	private $id;
	private $thumbnail;
	private $link;
	private $title;
	private $info;
	private $state;
	private $limit;
	
	//访问私有变量
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
	
	public function __get($_key) {
		return $this->$_key;
	}
	
	//通过轮播器
	public function setStateOk() {
		$_sql = "UPDATE 
										cms_rotation 
								SET 
										state = 1 
							WHERE 
										id = '$this->id' 
							LIMIT 
										1";
		return parent::aud($_sql);
	}
	
	//取消轮播器
	public function setStateCancel() {
		$_sql = "UPDATE
										cms_rotation
								SET
										state = 0
							WHERE
										id = '$this->id'
							LIMIT
										1";
		return parent::aud($_sql);
	}
	
	//获取一条轮播记录
	public function getOneRotation() {
		$_sql = "SELECT 
										id,
										thumbnail,
										link,
										title,
										info,
										state
							 FROM 
										cms_rotation 
							WHERE 
										id = '$this->id'";
		return parent::one($_sql);
	}
	
	public function getNewRotation() {
		$_sql = "SELECT 
										title,
										thumbnail,
										link 
						 	 FROM 
										cms_rotation 
							WHERE 
										state = 1 
					 ORDER BY 
										date 
										DESC 
							LIMIT 
										0,".RO_NUM;
		return parent::all($_sql);
	}
	
	//查询总记录
	public function getRotationTotal() {
		$_sql = "SELECT
											COUNT(*)
								 FROM
											cms_rotation";
		return parent::total($_sql);
	}
	
	//查询所有管理等级
	public function getAllRotation() {
		$_sql = "SELECT
									 	id,
										thumbnail,
										title,
										state,
										link,
										link full
							 FROM
										cms_rotation
				 	 ORDER BY
				 	 					state
				 	 					DESC,
										date
										DESC
							$this->limit";
		return parent::all($_sql);
	}
	
	//新增轮播器
	public function addRotation() {
		$_sql = "INSERT INTO cms_rotation (
																				thumbnail,
																				link,
																				title,
																				info,
																				state,
																				date
																		)
														 VALUES
																		(
																				'$this->thumbnail',
																				'$this->link',
																				'$this->title',
																				'$this->info',
																				1,
																				NOW()
																		)";
		return parent::aud($_sql);
	}
	
	//修改轮播器
	public function updateRotation() {
		$_sql = "UPDATE 
										cms_rotation
								SET
										thumbnail = '$this->thumbnail',
										link = '$this->link',
										title = '$this->title',
										info = '$this->info',
										state = '$this->state'
							WHERE
										id = '$this->id'";
		return parent::aud($_sql);
	}
	
	//delte轮播
	public function deleteRotation() {
		$_sql = "DELETE 
							 FROM 
										cms_rotation 
							WHERE 
										id = '$this->id'";
		return parent::aud($_sql);
	}
	
}



?>
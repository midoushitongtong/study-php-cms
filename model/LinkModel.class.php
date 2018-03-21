<?php 



	
class LinkModel extends Model {
	private $id;
	private $webname;
	private $weburk;
	private $weblogo;
	private $user;
	private $state;
	private $type;
	private $limit;
	
	//访问私有变量
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
	
	public function __get($_key) {
		return $this->$_key;
	}
	
	//add
	public function addLink() {
		$_sql = "INSERT INTO 
												cms_link (
																		webname,
																		weburl,
																		logourl,
																		user,
																		type,
																		state,
																		date
																	) 
													VALUES (
																		'$this->webname',
																		'$this->weburl',
																		'$this->weblogo',
																		'$this->user',
																		'$this->type',
																		'$this->state',
																		NOW()
																	)";
		return parent::aud($_sql);
	}
	
	//total
	public function getLinkTotal() {
		$_sql = "SELECT 
										COUNT(*) 
							 FROM 
										cms_link";
		return parent::total($_sql);
	}
	
	//前20个文字链接
	public function getTwentyTextLink() {
		$_sql = "SELECT 
										webname,
										weburl
							 FROM 
										cms_link 
							WHERE
										state = 1
								AND
										type = 1
					 ORDER BY 
										date 
										DESC
							LIMIT
										0,20";
		return parent::all($_sql);
	}
	
	//所有文字链接
	public function getAllTextLink() {
		$_sql = "SELECT
										webname,
										weburl
							 FROM
										cms_link
							WHERE
										state = 1
								AND
										type = 1
					 ORDER BY
										date
										DESC";
		return parent::all($_sql);
	}
	
	//前9个logo链接
	public function getNineLogoLink() {
		$_sql = "SELECT 
										webname,
										weburl,
										logourl
							 FROM 
										cms_link 
							WHERE
										state = 1
								AND
										type = 2
					 ORDER BY 
										date 
										DESC 
							LIMIT 
										0,6";
		return parent::all($_sql);
	}
	
	//所有logo链接
	public function getAllLogoLink() {
		$_sql = "SELECT
										webname,
										weburl,
										logourl
							 FROM
										cms_link
							WHERE
										state = 1
								AND
										type = 2
					 ORDER BY
										date
										DESC";
		return parent::all($_sql);
	}
	
	//one
	public function getOneLink() {
		$_sql = "SELECT 
										id,
										webname,
										weburl,
										logourl,
										type,
										user,
										state
							 FROM 
										cms_link 
							WHERE 
										id = '$this->id'
							LIMIT
										1";
		return parent::one($_sql);
	}
	
	//show
	public function getAllLink() {
		$_sql = "SELECT 
										id,
										webname,
										weburl,
										weburl fullweburl,
										logourl,
										logourl fulllogoul,
										user,
										type,
										state,
										date 
							 FROM 
										cms_link 
					 ORDER BY 
										date 
										DESC 
												$this->limit";
		return parent::all($_sql);
	}
	
	//ok
	public function setStateOk() {
		$_sql = "UPDATE 
										cms_link
								SET 
										state = 1 
							WHERE 
										id = '$this->id'";
		return parent::aud($_sql);
	}
	
	//cancel
	public function setStateCancel() {
		$_sql = "UPDATE 
										cms_link
								SET
										state = 0 
							WHERE 
										id = '$this->id'";
		return parent::aud($_sql);
	}
	
	//update
	public function updateLink() {
		$_sql = "UPDATE 
										cms_link 
								SET 
										webname = '$this->webname',
										weburl = '$this->weburl',
										logourl = '$this->weblogo',
										user = '$this->user',
										type = '$this->type',
										state = '$this->state'
							WHERE
										id = '$this->id'
							LIMIT
										1";
		return parent::aud($_sql);
	}
	
	//delete
	public function deleteLink() {
		$_sql = "DELETE FROM 
													cms_link 
									 WHERE 
													id = '$this->id'";
		return parent::aud($_sql);
	}
	
	
	
}



?>
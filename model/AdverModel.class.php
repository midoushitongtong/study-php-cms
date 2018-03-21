<?php 




class AdverModel extends Model {
	private $id;
	private $title;
	private $info;
	private $thumbnail;
	private $link;
	private $state;
	private $kind;
	private $type;
	private $limit;
	
	//访问私有变量
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
	
	public function __get($_key) {
		return $this->$_key;
	}
	
	//获取最新的N条文字广告
	public function getNewTextAdver() {
		$_sql = "SELECT 
										title,
										link 
							 FROM 
										cms_adver 
							WHERE 
										state = 1 
								AND
										type = 1
					 ORDER BY
										date
										DESC
							LIMIT 
										0,".ADVER_TEXT_NUM;
		return parent::all($_sql);
	}
	
	//获取最新的N条头部广告
	public function getNewHeaderAdver() {
		$_sql = "SELECT
										title,
										link,
										thumbnail
							 FROM
										cms_adver
							WHERE
										state = 1
								AND
										type = 2
					 ORDER BY
										date
										DESC
							LIMIT
										0,".ADVER_PIC_NUM;
		return parent::all($_sql);
	}
	
	//获取最新的N条侧栏广告
	public function getNewSidebarAdver() {
		$_sql = "SELECT
										title,
										link,
										thumbnail
							 FROM
										cms_adver
							WHERE
										state = 1
								AND
										type = 3
					 ORDER BY
										date
										DESC
							LIMIT
										0,".ADVER_PIC_NUM;
		return parent::all($_sql);
	}
	
	//total
	public function getAdverTotal() {
		$_sql = "SELECT 
										COUNT(*) 
							 FROM 
										cms_adver
							WHERE
										type IN ($this->kind)";
		return parent::total($_sql);
	}
	
	//one
	public function getOneAdver() {
		$_sql = "SELECT 
										id,
										title,
										info,
										link,
										type,
										state,
										thumbnail
							 FROM 
										cms_adver
							WHERE 
										id = '$this->id'
							LIMIT
										1";
		return parent::one($_sql);
	}
	
	//setStateOk
	public function setStateOk() {
		$_sql = "UPDATE 
										cms_adver 
								SET 
										state = 1 
							WHERE 
										id = '$this->id'";
		return parent::aud($_sql);
	}
	
	//setStateOk
	public function setStateCalcel() {
		$_sql = "UPDATE
										cms_adver
								SET
										state = 0
							WHERE
										id = '$this->id'";
		return parent::aud($_sql);
	}
	
	//show
	public function getAllAdver() {
		$_sql = "SELECT 
										id,
										title,
										link,
										type,
										state 
							 FROM 
										cms_adver 
							WHERE
										type IN ($this->kind)
					 ORDER BY 
										date 
										DESC
								$this->limit";
		return parent::all($_sql);
	}
	
	//add
	public function addAdver() {
		$_sql = "INSERT INTO cms_adver (
																		title,
																		info,
																		thumbnail,
																		link,
																		state,
																		type,
																		date
																	 ) 
													 VALUES (
																		'$this->title',
																		'$this->info',
																		'$this->thumbnail',
																		'$this->link',
																		'1',
																		'$this->type',
																		NOW()
																	 )";
		return parent::aud($_sql);
	}
	
	//update
	public function updateAdver() {
		$_sql = "UPDATE 
										cms_adver 
							 SET
										title = '$this->title',
										info = '$this->info',
										link = '$this->link',
										thumbnail = '$this->thumbnail',
										type = '$this->type',
										state = '$this->state'
						 WHERE
										id = '$this->id'
						 LIMIT
										1";
		return parent::aud($_sql);
	}
	
	//delte
	public function deleteAdver() {
		$_sql = "DELETE FROM 
													cms_adver 
									 WHERE 
													id = '$this->id'
									 LIMIT
													1";
		return parent::aud($_sql);
	}
	
}



?>
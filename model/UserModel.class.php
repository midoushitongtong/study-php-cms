<?php 




class UserModel extends Model {
	private $id;
	private $user;
	private $pass;
	private $email;
	private $face;
	private $question;
	private $anwser;
	private $state;
	private $time;
	private $limit;
	
	//访问私有变量
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
	
	public function __get($_key) {
		return $this->$_key;
	}
	
	//user验证
	public function checkUser() {
		$_sql = "SELECT 
										id 
							 FROM 
										cms_user 
							WHERE 
										user = '$this->user'
							LIMIT 
										1";
		return parent::one($_sql);
	}
	
	//email验证
	public function checkEmail() {
		$_sql = "SELECT
										id
							 FROM
										cms_user
							WHERE
										email = '$this->email'
							LIMIT
										1";
		return parent::one($_sql);
	}
	
	//获取所有会员
	public function getAllUser() {
		$_sql = "SELECT 
										id,
										user,
										email,
										state 
							 FROM 
										cms_user 
					 ORDER BY 
							date DESC
						 	 $this->limit";
		return parent::all($_sql);
	}
	
	//查找单一会员
	public function getOneUser() {
		$_sql = "SELECT 
										id,
										user,
										pass,
										face,
										email,
										question,
										anwser,
										state
							 FROM 
										cms_user 
							WHERE 
										id = '$this->id' 
							LIMIT 
										1";
		return parent::one($_sql);
	}
	
	//获取会员总数
	public function getUserTotal() {
		$_sql = "SELECT 
										COUNT(*) 
							 FROM 
										cms_user";
		return parent::total($_sql);
	}
	
	//修改会员
	public function updateUser() {
		$_sql = "UPDATE
										cms_user
								SET
										pass = sha1('$this->pass'),
										email = '$this->email',
										face = '$this->face',
										question = '$this->question',
										anwser = '$this->anwser',
										state = '$this->state'
							WHERE
										id = '$this->id'
							LIMIT 
										1";
		return parent::aud($_sql);
	}
	
	//删除会员
	public function deleteUser() {
		$_sql = "DELETE FROM 
					 							 cms_user 
									 WHERE 
													id = '$this->id'";
		return parent::aud($_sql);
	}
	
	//新增注册会员
	public function addUser() {
		$_sql = "INSERT INTO 
												cms_user (
																		user,
																		pass,
																		email,
																		face,
																		question,
																		anwser,
																		state,
																		time,
																		date
																	) 
												 	 VALUES (
																		'$this->user',
																		'$this->pass',
																		'$this->email',
																		'$this->face',
																		'$this->question',
																		'$this->anwser',
																		'$this->state',
																		'$this->time',
																		NOW()
																	)";
		return parent::aud($_sql);
	}
	
	//检查登陆
	public function checkLogin() {
		$_sql = "SELECT 
										id,
										user,
										pass,
										face
							 FROM 
										cms_user 
							WHERE 
										user = '$this->user' 
								AND 
										pass = '$this->pass'
							LIMIT
										1";
		return parent::one($_sql);
	}
	
	//登录或注册后更新时间
	public function setLaterUser() {
		$_sql = "UPDATE
										cms_user
							 	SET
										time = '$this->time'
							WHERE
										id = '$this->id'
							LIMIT
										1";
		return parent::aud($_sql);
	}
	
	//获取最新登录的会员
	public function getLaterUser() {
		$_sql = "SELECT
										user,
										face
							 FROM
										cms_user
					 ORDER BY
										time DESC
							LIMIT 
										0,6";
		return parent::all($_sql);
	}
	
}


?>
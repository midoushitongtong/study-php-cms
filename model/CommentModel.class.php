<?php 




class CommentModel extends Model {
	private $cid;
	private $user;
	private $manner;
	private $content;
	private $states;
	private $limit;
	
	//访问私有变量
	public function __set($_key, $_value) {
		$this->$_key = $_value;
	}
	
	public function __get($_key) {
		return $this->$_key;
	}
	
	//add
	public function addComment() {
		$_sql = "INSERT INTO cms_comment (
																			cid,
																			user,
																			content,
																			manner,
																			date
																		 )
															VALUES (
																			'$this->cid',
																			'$this->user',
																			'$this->content',
																			'$this->manner',
																			NOW()
																		 )";
		return parent::aud($_sql);
	}
	
	//批量审核
	public function setStates() {
		$_sql = '';
		foreach ($this->states as $_key => $_value) {
			if ($_value > 1) $_value = 1;
			if ($_value < 0) $_value = 0;
			$_sql .= "UPDATE cms_comment SET state = '$_value' WHERE id = '$_key';";
		}
		return parent::multi($_sql);
	}
	
	//显示最火评论
	public function getHotThreeComment() {
		$_sql = "SELECT
										c.id,
										c.cid,
										c.user,
										c.manner,
										c.content,
										c.date,
										c.sustain,
										c.oppose,
										u.face
							FROM
										cms_comment c
				 LEFT JOIN
										cms_user u
								ON
										u.user = c.user
						 WHERE
						 				c.state = 1
							 AND
										c.cid = '$this->cid'
							 AND
							 			c.sustain + c.oppose > 0
					ORDER BY
										c.sustain
										DESC
										LIMIT
										0,3";
		return parent::all($_sql);
	}
	
	//显示三条评论
	public function getNewThreeComment() {
		$_sql = "SELECT
										c.id,
										c.cid,
										c.user,
										c.manner,
										c.content,
										c.date,
										c.sustain,
										c.oppose,
										u.face
							 FROM
										cms_comment c
					LEFT JOIN
										cms_user u
						 		 ON
										u.user = c.user
					  	WHERE
					  				c.state = 1
					  		AND
										c.cid = '$this->cid'
					 ORDER BY
										c.date
										DESC
						  LIMIT
										0,3";
		return parent::all($_sql);
	}
	
	//显示all评论(admin)
	public function getCommentList() {
		$_sql = "SELECT 
										c.id,
										c.cid,
										c.content,
										c.content full,
										c.user,
										c.state,
										c.state num
							 FROM 
										cms_comment c,
										cms_content ct
							WHERE
										c.cid = ct.id
					 ORDER BY 
										c.date 
										DESC
							$this->limit";
		return parent::all($_sql);
	}
	
	//通过审核
	public function setStateOK() {
		$_sql = "UPDATE 
										cms_comment 
								SET
										state = 1 
							WHERE 
										id = '$this->id'
							LIMIT
										1";
		return parent::aud($_sql);
	}
	
	//取消审核
	public function setStateCancel() {
		$_sql = "UPDATE 
										cms_comment 
								SET 
										state = 0 
							WHERE 
										id = '$this->id' 
							LIMIT 
										1";
		return parent::aud($_sql);
	}
	
	//显示all评论(details)
	public function getAllComment() {
		$_sql = "SELECT 
										c.id,
										c.cid,
										c.user,
										c.manner,
										c.content,
										c.date,
										c.sustain,
										c.oppose,
										u.face 
							 FROM 
										cms_comment c
					LEFT JOIN
										cms_user u
								 ON
								 		u.user = c.user
							WHERE 
										c.state = 1
								AND
										c.cid = '$this->cid'
					 ORDER BY
					 					c.date
					 					DESC
													$this->limit";
		return parent::all($_sql);
	}
	
	//获取评论总量后台
	public function getCommentListTotal() {
		$_sql = "SELECT
										COUNT(*)
							 FROM
										cms_comment";
		return parent::total($_sql);
	}
	
	//获取评论总量
	public function getCommentTotal() {
		$_sql = "SELECT 
										COUNT(*) 
							 FROM 
										cms_comment 
							WHERE 
										state = 1
								AND
										cid = '$this->cid'";
		return parent::total($_sql);
	}
	
	//查找单一评论
	public function getOneComment() {
		$_sql = "SELECT 
										id 
						 	 FROM 
										cms_comment 
							WHERE 
										id ='$this->id'
							LIMIT	
										1";
		return parent::aud($_sql);
	}
	
	//支持
	public function setSustain() {
		$_sql = "UPDATE 
										cms_comment 
								SET 
										sustain = sustain + 1 
							WHERE 
										id = '$this->id'
							LIMIT
										1";
		return parent::aud($_sql);
	}
	
	//反对
	public function setOppose() {
		$_sql = "UPDATE
										cms_comment
								SET
										oppose = oppose + 1
							WHERE
										id = '$this->id'
							LIMIT
										1";
		return parent::aud($_sql);
	}
	
	//deleteComment
	public function deleteComment() {
		$_sql = "DELETE FROM 
													cms_comment 
									 WHERE 
													id = '$this->id'
									 LIMIT
													1";
		return parent::aud($_sql);
	}
	
}



?>
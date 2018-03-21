<?php 



	
class VoteModel extends Model {
	private $title;
	private $info;
	private $id;
	private $vid = 0;
	private $count;
	private $state;
	
	//访问私有变量
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
	
	public function __get($_key) {
		return $this->$_key;
	}
	
	//查询投票列表总数
	public function getVoteTotal() {
		$_sql = "SELECT 
										COUNT(*) 
							 FROM 
										cms_vote";
		parent::total($_sql);
	}
	
	//查询投票项目总数
	public function getChildVoteTotal() {
		$_sql = "SELECT 
										COUNT(*) 
							 FROM 
										cms_vote 
							WHERE 
										vid = '$this->id'";
		return parent::total($_sql);
	}
	
	//查询单一投票主题
	public function getOneVote() {
		$_sql = "SELECT 
										id,
										title,
										info
							 FROM 
										cms_vote 
							WHERE 
										id = '$this->id'";
		return parent::one($_sql);
	}
	
	//获取Vote总票数
	public function getVoteSum() {
		$_sql = "SELECT 
										SUM(count) c
							 FROM 
										cms_vote 
							WHERE 
										vid = (SELECT 
																	id 
														 FROM 
																	cms_vote 
														WHERE 
																	state = 1)";
		return parent::one($_sql);
	}
	
	//获取Vote标题
	public function getVoteTitle() {
		$_sql = "SELECT 
										title 
							 FROM 
										cms_vote 
							WHERE 
										state = 1";
		return parent::one($_sql);
	}
	
	//获取Vote项目
	public function getVoteItem() {
		$_sql = "SELECT 
										id,
										title,
										count
							 FROM 
										cms_vote 
							WHERE 
										vid = (SELECT id FROM cms_vote WHERE state = 1)";
		return parent::all($_sql);
	}
	
	//VoteCountAdd
	public function setCount() {
		$_sql = "UPDATE 
										cms_vote 
								SET 
										count = count + 1 
							WHERE 
										id = '$this->id'";
		return parent::aud($_sql);
	}
	
	//查询投票主题
	public function getAllVote() {
		$_sql = "SELECT 
										c.id,
										c.title,
										(SELECT SUM(count) FROM cms_vote WHERE vid = c.id) pcount,
										c.state 
							 FROM 
										cms_vote c
							WHERE
										c.vid = '0'
					 ORDER BY 
										c.date 
										DESC
							$this->limit";
		return parent::all($_sql);
	}
	
	//查询项目列表
	public function getAllChildVote() {
		$_sql = "SELECT
										id,
										title,
										info,
										state
							 FROM
										cms_vote
							WHERE
										vid = '$this->id'
					 ORDER BY
										date
										DESC
										$this->limit";
		return parent::all($_sql);
	}
	
	//新增投票主题
	public function addVote() {
		$_sql = "INSERT INTO cms_vote (
																		title,
								  									info,
								  									vid,
								  									date
																	)
														VALUES
																	(
																		'$this->title',
																		'$this->info',
																		'$this->vid',
																		NOW()
																	)";
		return parent::aud($_sql);
	}
	
	//update
	public function updateVote() {
		$_sql = "UPDATE 
										cms_vote 
							  SET 
										title = '$this->title',
										info = '$this->info' 
							WHERE 
										id = '$this->id'
							LIMIT
										1";
		return parent::aud($_sql);
	}
	
	//setStateCancel
	public function setStateCancel() {
		$_sql = "UPDATE 
										cms_vote 
								SET 
										state = 0 
							WHERE 
										state = 1";
		return parent::aud($_sql);
	}
	
	//setStateOk
	public function setStateOk() {
		$_sql = "UPDATE 
										cms_vote 
								SET 
										state = 1 
							WHERE 
										id = '$this->id'";
		return parent::aud($_sql);
	}
	
	//delete
	public function deleteVote() {
		$_sql = "DELETE FROM
												cms_vote 
									WHERE 
												id = '$this->id'
										 OR
												vid = '$this->id'";
		return parent::aud($_sql);
	}
	
}



?>
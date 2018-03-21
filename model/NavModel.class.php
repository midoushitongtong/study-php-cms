<?php 



	
class NavModel extends Model {
	private $id;
	private $pid;
	private $nav_name;
	private $nav_info;
	private $sort;
	private $limit;
	
	//访问私有变量
	public function __set($_key, $_value) {
		$this->$_key = $_value;
	}
	
	public function __get($_key) {
		return $this->$_key;
	}
	
	//查询单个导航
	public function getOneNav() {
		$_sql = "SELECT
										n1.id,
										n1.nav_name,
										n1.nav_info,
										n2.id iid,
										n2.nav_name nnav_name
								FROM
										cms_nav n1
					 LEFT JOIN
					 					cms_nav n2
					 				ON
					 					n1.pid = n2.id
							 WHERE
							 			n1.id = '$this->id'
							 		OR
										n1.nav_name = '$this->nav_name'
							 LIMIT
										1";
		return parent::one($_sql);
	}
		
	//查询所有导航
	public function getAllNav() {
		$_sql = "SELECT
									 	id,
										nav_name,
										nav_info,
										sort
							 FROM
										cms_nav
							WHERE
										pid = 0
					ORDER BY
					 					sort ASC
							$this->limit";
		return parent::all($_sql);
	}
	
	//获取主导航
	public function getFourNav() {
		$_sql = "SELECT 
										id,
										nav_name 
							 FROM 
										cms_nav 
							WHERE 
										pid = 0 
					 ORDER BY 
										sort 
										ASC
							LIMIT
										0,4";
		return parent::all($_sql);
	}
	
	public function getAllFrontNav() {
		$_sql = "SELECT 
									id,
									nav_name,
									nav_info 
							 FROM 
									cms_nav 
							WHERE 
									pid = 0 
					 ORDER BY 
									sort ASC";
		return parent::all($_sql);
	}
	
	//查询所有子导航
	public function getAllChildNav() {
		$_sql = "SELECT
										id,
										nav_name,
										nav_info,
										sort
							 FROM
										cms_nav
							WHERE
										pid = '$this->id'
					 ORDER BY
					 					sort ASC
								$this->limit";
		return parent::all($_sql);
	}
	
	public function getAllChildFrontNav() {
		$_sql = "SELECT
										id,
										nav_name,
										nav_info,
										sort
							 FROM
										cms_nav
							WHERE
										pid = '$this->id'
					 ORDER BY
										sort ASC
										";
		return parent::all($_sql);
	}
	
	//查询总记录
	public function getNavTotal() {
		$_sql = "SELECT
											COUNT(*)
								 FROM
											cms_nav
							  WHERE
											pid = 0";
		return parent::total($_sql);
	}
	
	//查询子导航总记录
	public function getNavChildTotal() {
		$_sql = "SELECT
										COUNT(*)
							 FROM
										cms_nav
							WHERE
										pid = '$this->id'";
		return parent::total($_sql);
	}
	
	//新增网站导航
	public function addNav() {
		$_sql = "INSERT INTO cms_nav (
																	nav_name,
																	nav_info,
																	pid,
																	sort
																 )
													 VALUES
																 (
																	'$this->nav_name',
																	'$this->nav_info',
																	'$this->pid',
																	".parent::nextId('cms_nav')."
																 )";
		return parent::aud($_sql);
	}
	
	//修改管理等级
	public function updateNav() {
		$_sql = "UPDATE
										cms_nav
							  SET
										nav_name = '$this->nav_name',
										nav_info = '$this->nav_info'
							WHERE
										id = '$this->id'
							LIMIT
										1";
		return parent::aud($_sql);
	}
	
	//删除网站导航
	public function deleteNav() {
		$_sql = "DELETE FROM
												cms_nav
									 WHERE
												id = '$this->id'
									 LIMIT
												1";
		return parent::aud($_sql);
	}
	
	//前台显示页面
	public function getFrontNav() {
		$_sql = "SELECT
										id,
										nav_name
							 FROM
										cms_nav
							WHERE
										pid = 0
					 ORDER BY
										sort ASC
							LIMIT
										0,".NAV_SIZE;
		return parent::all($_sql);
	}
	
	//导航排序执行
	public function setNavSort() {
		$_sql = '';
		foreach ($this->sort as $_key => $_value) {
			$_sql .= "UPDATE cms_nav SET sort = '$_value' WHERE id = '$_key';";
		}
		return parent::multi($_sql);
	}
	
	//获取所有非主类id
	public function getAllNavChildId() {
		$_sql = "SELECT 
										id 
							 FROM 
										cms_nav 
							WHERE 
										id <> 0";
		return parent::all($_sql);
	}
	
	//获取所有主类下的子id
	public function getNavChildId() {
		$_sql = "SELECT 
										id 
							 FROM 
										cms_nav 
							WHERE 
										pid = '$this->id'";
		return parent::all($_sql);
	}
	
}



?>
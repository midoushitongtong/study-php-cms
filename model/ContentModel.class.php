<?php 




class ContentModel extends Model {
	private $id;
	private $title;
	private $nav;
	private $attr;
	private $tag;
	private $keyword;
	private $thumbnail;
	private $source;
	private $author;
	private $info;
	private $content;
	private $commend;
	private $count;
	private $gold;
	private $sort;
	private $readlimit;
	private $color;
	private $limti;
	private $inputkeyword;
	
	//访问私有变量
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
	
	public function __get($_key) {
		return $this->$_key;
	}
	
	//获取条数
	public function searchTitleContentTotal() {
		$_sql = "SELECT 
										COUNT(*) 
							 FROM 
										cms_content c, 
										cms_nav n 
							WHERE 
										c.nav = n.id 
								AND 
										c.title LIKE '%$this->inputkeyword%'";
		return parent::total($_sql);
	}
	
	//获取条数
	public function searchKeywordContentTotal() {
		$_sql = "SELECT
										COUNT(*)
							 FROM
										cms_content c,
										cms_nav n
							WHERE
										c.nav = n.id
								AND
										c.keyword LIKE '%$this->inputkeyword%'";
		return parent::total($_sql);
	}
	
	//获取条数
	public function searchTagContentTotal() {
		$_sql = "SELECT
										COUNT(*)
							 FROM
										cms_content c,
										cms_nav n
							WHERE
										c.nav = n.id
								AND
										c.tag LIKE '%$this->inputkeyword%'";
		return parent::total($_sql);
	}
	
	//获取搜索标题的文档
	public function searchTitleContent() {
		$_sql = "SELECT 
										c.id,
										c.nav,
										c.title,
										c.title t,
										c.attr,
										c.gold,
										c.keyword,
										c.commend,
										c.thumbnail,
										c.info,
										c.content,
										c.count,
										c.date,
										n.nav_name 
							 FROM 
										cms_content c,
										cms_nav n
							WHERE
										c.nav = n.id
								AND
										c.title LIKE '%$this->inputkeyword%'
					 ORDER BY 
										date 
										DESC
					$this->limit";
		return parent::all($_sql);
	}
	
	//获取搜索标题的文档
	public function searchKeywordContent() {
		$_sql = "SELECT
										c.id,
										c.nav,
										c.title,
										c.title t,
										c.attr,
										c.gold,
										c.keyword,
										c.commend,
										c.thumbnail,
										c.info,
										c.content,
										c.count,
										c.date,
										n.nav_name
							 FROM
										cms_content c,
										cms_nav n
							WHERE
										c.nav = n.id
								AND
										c.keyword LIKE '%$this->inputkeyword%'
					 ORDER BY
										date
										DESC
						$this->limit";
		return parent::all($_sql);
	}
	
	//获取搜索标题的文档
	public function searchTagContent() {
		$_sql = "SELECT
										c.id,
										c.nav,
										c.title,
										c.title t,
										c.attr,
										c.gold,
										c.keyword,
										c.commend,
										c.thumbnail,
										c.info,
										c.content,
										c.count,
										c.date,
										n.nav_name
							 FROM
										cms_content c,
										cms_nav n
							WHERE
										c.nav = n.id
								AND
										c.tag LIKE '%$this->inputkeyword%'
					 ORDER BY
										date
										DESC
										$this->limit";
		return parent::all($_sql);
	}
	
	//获取文档列表
	public function getListContent() {
		$_sql = "SELECT 
										c.id,
										c.nav,
										c.title,
										c.title t,
										c.attr,
										c.gold,
										c.keyword,
										c.commend,
										c.thumbnail,
										c.info,
										c.content,
										c.count,
										c.date,
										n.nav_name 
							  FROM 
										cms_content c,
										cms_nav n
							 WHERE
										c.nav IN ($this->nav)
								 AND
										c.nav = n.id
						ORDER BY
										c.date DESC
							 $this->limit";
		return parent::all($_sql);
	}
	
	//获取首页新闻列表
	public function getNewNavList() {
		$_sql = "SELECT 
										id,
										title,
										date 
							 FROM 
										cms_content 
							WHERE 
										nav IN (SELECT id FROM cms_nav WHERE	pid = '$this->nav')
					 ORDER BY
					 					date
					 					DESC
							LIMIT
										0,11";
		return parent::all($_sql);
	}
	
	//获取最新的10条文档
	public function getNewList() {
		$_sql = "SELECT 
										id,
										title,
										date 
							 FROM 
										cms_content 
					 ORDER BY 
										date 
										DESC
							LIMIT
										0,10";
		return parent::all($_sql);
	}
	
	//获取最新的一条头条
	public function getNewTop() {
		$_sql = "SELECT 
										id,
										title,
										info 
							 FROM 
										cms_content
							WHERE
										attr LIKE '%头条%'
					 ORDER BY 
										date 
										DESC 
							LIMIT
										0,1";
		return parent::one($_sql);
	}
	
	//获取最新的第二条到第五条头条
	public function getNewTopList() {
			$_sql = "SELECT
										id,
										title,
										info
							 FROM
										cms_content
							WHERE
										attr LIKE '%头条%'
					 ORDER BY
										date
										DESC
							LIMIT
										1,4";
			return parent::all($_sql);
	}
	
	//获取最新图文资讯
	public function getPicList() {
		$_sql = "SELECT 
										id,
										title,
										thumbnail 
							 FROM 
										cms_content 
							WHERE 
										thumbnail <> '' 
					 ORDER BY 
										date 
										DESC 
							LIMIT 
										0,4";
		return parent::all($_sql);
	}
	
	//获取本月评论总榜7条
	public function getMonthComment() {
		$_sql = "SELECT
										ct.id,
										ct.title,
										ct.date
							 FROM
										cms_content ct
							WHERE
										MONTH(NOW()) = DATE_FORMAT(ct.date, '%c')
					 ORDER BY
										(SELECT 
														COUNT(*) 
											 FROM 
														cms_comment c 
											WHERE 
														c.cid = ct.id)
										DESC
							LIMIT
										0,7";
		return parent::all($_sql);
	}
	
	//获取本月热点排行7条
	public function getMonthHotList() {
		$_sql = "SELECT 
										id,
										title,
										date 
							 FROM 
										cms_content
							WHERE
										MONTH(NOW()) = DATE_FORMAT(date, '%c')
					 ORDER BY 
										count 
										DESC
							LIMIT
										0,7";
		return parent::all($_sql);
	}
	
	//获取推荐文档7条
	public function getNewRecList() {
		$_sql = "SELECT 
										id,
										title,
										date 
							 FROM 
										cms_content
							WHERE 
										attr LIKE '%推荐%' 
					 ORDER BY 
										date 
										DESC 
							LIMIT 
										0,7";
		return parent::all($_sql);
	}
	
	//获取本月文档,推荐
	public function getMonthNavRec() {
		$_sql = "SELECT 
										id,
										title,
										date
							 FROM 
										cms_content 
							WHERE
										nav IN($this->nav)
								AND
										attr LIKE '%推荐%'
								AND
										MONTH(NOW()) = DATE_FORMAT(date, '%c')
							LIMIT 
										0,10";
		return parent::all($_sql);
	}
	
	//获取本月文档,热点
	public function getMonthNavHot() {
		$_sql = "SELECT
										ct.id,
										ct.title,
										ct.date
							 FROM
										cms_content ct
							WHERE
										nav IN($this->nav)
								AND
										MONTH(NOW()) = DATE_FORMAT(date, '%c')
					ORDER BY
										(SELECT
														COUNT(*)
											 FROM
														cms_comment c
											WHERE
														c.cid = ct.id)
										DESC
							LIMIT
										0,10";
		return parent::all($_sql);
	}
	
	//获取本月文档,图文
	public function getMonthNavPic() {
		$_sql = "SELECT
										ct.id,
										ct.title,
										ct.date
							 FROM
										cms_content ct
							WHERE
										thumbnail <> ''
								AND
										MONTH(NOW()) = DATE_FORMAT(date, '%c')
					 ORDER BY
										date
										DESC
							LIMIT
										0,10";
		return parent::all($_sql);
	}
	
	//获取单一文章
	public function getOneContent() {
		$_sql = "SELECT
										id,
										title,
										nav,
										attr,
										tag,
										keyword,
										thumbnail,
										source,
										author,
										info,
										content,
										commend,
										count,
										sort,
										gold,
										readlimit,
										color,
										date
							 FROM
										cms_content
							WHERE
										id = '$this->id'";
		return parent::one($_sql);
	}
	
	public function getListContentTotal() {
		$_sql = "SELECT 
										COUNT(*) 
							 FROM 
										cms_content c,
										cms_nav n
							WHERE
										c.nav IN ($this->nav)
								AND
										c.nav = n.id";
		return parent::total($_sql);
	}
	
	//获取评论排行前20
	public function getTwentyComment() {
		$_sql = "SELECT
										ct.id,
										ct.title
							 FROM
										cms_content ct
					 ORDER BY
										(SELECT
														COUNT(*)
											 FROM
														cms_comment c
											WHERE
														c.cid = ct.id)
										DESC
							LIMIT
										0,20";
		return parent::all($_sql);
	}
	
	//新增文档内容
	public function addContent() {
		$_sql = "INSERT INTO
												cms_content (
																			title,
																			nav,
																			attr,
																			tag,
																			keyword,
																			thumbnail,
																			source,
																			author,
																			info,
																			content,
																			commend,
																			count,
																			gold,
																			sort,
																			readlimit,
																			color,
																			date	
																		) 
														 VALUES (
																			'$this->title',
																			'$this->nav',
																			'$this->attr',
																			'$this->tag',
																			'$this->keyword',
																			'$this->thumbnail',
																			'$this->source',
																			'$this->author',
																			'$this->info',
																			'$this->content',
																			'$this->commend',
																			'$this->count',
																			'$this->gold',
																			'$this->sort',
																			'$this->readlimit',
																			'$this->color',
																			NOW()
																	 )";
		return parent::aud($_sql);
	}
	
	//修改文档
	public function updateContent() {
		$_sql = "UPDATE 
										cms_content 
								SET 
										title = '$this->title',
										nav = '$this->nav',
										attr = '$this->attr',
										tag = '$this->tag',
										keyword = '$this->keyword',
										thumbnail = '$this->thumbnail',
										source = '$this->source',
										author = '$this->author',
										info = '$this->info',
										content = '$this->content',
										commend = 0,
										count = '$this->count',
										gold = '$this->gold',
										sort = '$this->sort',
										readlimit = '$this->readlimit',
										color = '$this->color'
							WHERE 
										id = '$this->id'";
		return parent::aud($_sql);
	}
	
	//删除文档
	public function deleteContent() {
		$_sql = "DELETE 
							 FROM 
										cms_content 
							WHERE 
										id = '$this->id'";
		return parent::aud($_sql);
	}
	
	//文章浏览次数
	public function setContentCount() {
		$_sql = "UPDATE 
										cms_content 
								SET 
										count = count + 1 
							WHERE 
										id = '$this->id' 
							";
		return parent::aud($_sql);
	}
	
}



?>
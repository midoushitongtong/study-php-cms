<?php 




class Page {
	
	private $total;												//总记录
	private $pagesize;										//每页多少记录
	private $limit;												//数据库分页数
	private $page;												//当前页面
	private $pagenum;											//总页码
	private $url;													//地址栏
	private $bothnum;											//保持分页数量
	
	//访问私有变量
	public function __get($_key) {
		return $this->$_key;
	}
	
	//构造方法初始化
	public function __construct($_total, $_pagesize) {
		$this->total = $_total ? $_total : 1;
		$this->pagesize = $_pagesize;
		$this->pagenum = ceil($this->total / $this->pagesize);
		$this->page = $this->setPage();
		$this->limit = "LIMIT ".($this->page - 1) * $this->pagesize.",".$this->pagesize;
		$this->url = $this->setUrl();
		$this->bothnum = 2;
	}
	
	//setpage
	private function setPage() {
		if (!empty($_GET['page'])) {
			if ($_GET['page'] > 0) {
				if ($_GET['page'] > $this->pagenum) {
					return $this->pagenum;
				} else {
					return $_GET['page'];
				}
			} else {
				return 1;
			}
		} else {
			return 1;
		}
	}
		
	//获取地址
	private function setUrl() {
		$_url = $_SERVER["REQUEST_URI"];
		$_par = parse_url($_url);
		if (isset($_par['query'])) {
			parse_str($_par['query'], $_query);
			unset($_query['page']);
			$_url = $_par['path'].'?'.http_build_query($_query);
		}
		return $_url;
	}
	
	//数字分页
	private function pageList() {
		$_pagelist = '';
		for ($i = $this->bothnum; $i >= 1; $i--) {
			$_page = $this->page - $i;
			if ($_page < 1) continue;
			$_pagelist .= '<a href="'.$this->url.'&page='.($this->page - $i).'">'.($this->page - $i).'</a>';
		}
		$_pagelist .= '<span class="me">'.$this->page.'</span>';
		for ($i = 1; $i <= $this->bothnum; $i++) {
			$_page = $this->page + $i;
			if ($_page > $this->pagenum) break;
			$_pagelist .= '<a href="'.$this->url.'&page='.($this->page + $i).'">'.($this->page + $i).'</a>';
		}
		return $_pagelist;
	}
	
	//首页
	private function first() {
		if ($this->page > $this->bothnum) {
			return '<a href="'.$this->url.'">1</a> ... ';
		}
	}
	
	//上一页
	private function prev() {
		if ($this->page == 1) {
			return '<span class="disabled"> 上一页 </span>';
		}
		return '<a href="'.$this->url.'&page='.($this->page - 1).'"> 上一页 </a>';
	}
	
	//下一页
	private function next() {	
		if ($this->page == $this->pagenum || $this->pagenum == 0) {
			return '<span class="disabled"> 下一页 </span>';
		}
		return '<a href="'.$this->url.'&page='.($this->page + 1).'"> 下一页 </a>';
	}
	
	//尾页
	private function last() {
		if ($this->pagenum - $this->page > $this->bothnum) {
			return ' ...  <a href="'.$this->url.'&page='.$this->pagenum.'">'.$this->pagenum.'</a>';
		}
	}
	
	//分页信息
	public function showpage() {
		$page = '';
		$page .= $this->first();
		$page .= $this->pageList();
		$page .= $this->last();
		$page .= $this->prev();
		$page .= $this->next();
		return $page;
	}
	
}



?>
<?php 




class SystemModel extends Model {
	private $webname;
	private $page_size;
	private $article_size;
	private $nav_size;
	private $updir;
	private $ro_time;
	private $ro_num;
	private $adver_text;
	private $adver_logo;
	
	//访问私有变量
	public function __set($_key, $_value) {
		$this->$_key = $_value;
	}
	
	public function __get($_key) {
		return $this->$_key;
	}
	

	
	
	//获取
	public function getSystem() {
		$_sql = "SELECT 
										webname,
										page_size,
										article_size,
										nav_size,
										updir,
										ro_time,
										ro_num,
										adver_text_num,
										adver_logo_num
							 FROM 
										cms_system 
							WHERE 
										id = 1";
		return parent::one($_sql);
	}
	
	//update
	public function setSystem() {
		$_sql = "UPDATE 
										cms_system 
								SET 
										webname = '$this->webname',
										page_size = '$this->page_size',
										article_size = '$this->article_size',
										nav_size = '$this->nav_size',
										updir = '$this->updir',
										ro_time = '$this->ro_time',
										ro_num = '$this->ro_num',
										adver_text_num = '$this->adver_text_num',
										adver_logo_num = '$this->adver_logo_num'
							WHERE
										id = 1";
		return parent::aud($_sql);
	}
	
}



?>
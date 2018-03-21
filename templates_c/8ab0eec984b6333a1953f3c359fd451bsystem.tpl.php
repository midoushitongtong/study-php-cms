<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo $this->_vars['webname'];?></title>
<link rel="stylesheet" href="../style/admin.css">
<script src="../js/admin_level.js"></script>
</head>
<body id="main">



<div class="main">
	
	<div class="map">
		管理首页&gt;&gt;管理系统配置&gt;&gt;<strong class="title">系统配置文件</strong>
	</div>

	

	<form method="post">
	<table class="left content_table">
		<tr style="text-align: center;"><th>系统配置信息</th></tr>
		<tr><th>网站标题名称：<input type="text" class="text" name="webname" value="<?php echo $this->_vars['webname'];?>"></th></tr>
		<tr><th>网站常规分页：<input type="text" class="text" name="page_size" value="<?php echo $this->_vars['page_size'];?>"></th></tr>
		<tr><th>网站文章分页：<input type="text" class="text" name="article_size" value="<?php echo $this->_vars['article_size'];?>"></th></tr>
		<tr><th>网站导航个数：<input type="text" class="text" name="nav_size" value="<?php echo $this->_vars['nav_size'];?>"></th></tr>
		<tr><th>图片上传目录：<input type="text" class="text" name="updir" value="<?php echo $this->_vars['updir'];?>"></th></tr>
		<tr><th>图片轮播速度：<input type="text" class="text" name="ro_time" value="<?php echo $this->_vars['ro_time'];?>"></th></tr>
		<tr><th>图片轮播个数：<input type="text" class="text" name="ro_num" value="<?php echo $this->_vars['ro_num'];?>"></th></tr>
		<tr><th>文字广告个数：<input type="text" class="text" name="adver_text_num" value="<?php echo $this->_vars['adver_text_num'];?>"></th></tr>
		<tr><th>图片广告个数：<input type="text" class="text" name="adver_logo_num" value="<?php echo $this->_vars['adver_logo_num'];?>"></th></tr>
	</table>
	<p><input type="submit" value="修改配置文件" class="submit" style="margin-left: 39px;" name="send" onclick="javascript:"></p>
	</form>
		
</div>



</body>
</html>

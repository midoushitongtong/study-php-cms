<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo $this->_vars['webname'];?></title>
<link rel="stylesheet" href="style/basic.css">
<link rel="stylesheet" href="style/index.css">
<script src="js/reg.js"></script>
<script src="config/static.php?type=index"></script>
</head>
<body>

<?php $_tpl->create('header.tpl')?>









<div id="user">
	<?php if (@$this->_vars['cache']) {?>
		<?php echo $this->_vars['member'];?>
	<?php } else { ?>
		<?php if (@$this->_vars['login']) {?>
		<h2 class="h2">会员登陆</h2>
		<form method="post" action="register.php?action=login" name="login">
			<label>昵　　称：<input type="text" name="user" class="text"></label>
			<label>密　　码：<input type="text" name="pass" class="text"></label>
			<label class="yzm">验 证 码 ：<input type="text" name="code" class="text code"> <img src="config/code.php" class="code_img" onclick="this.src = 'config/code.php?tm = ' + Math.random()" alt=""></label>
			<p><input type="submit" name="send" value="登陆" onclick="return checkLogin();" class="submit"><a href="register.php?action=reg">注册会员</a><a href="#">忘记密码</a></p>
		</form>
		<?php } else { ?>
		<h2 class="h2">会员信息</h2>
		<div class="a">您好，<strong><?php echo $this->_vars['user'];?></strong> 欢迎光临</div>
		<div class="b">
			<img src="images/<?php echo $this->_vars['face'];?>" alt="<?php echo $this->_vars['user'];?>">
			<a href="#">个人中心</a>
			<a href="#">我的评论</a>
			<a href="register.php?action=logout">退出</a>
		</div>
		<?php } ?>
	<?php } ?>
	<h3>最近登陆会员<span>─────────────────</span></h3>
		<?php if (@$this->_vars['AllLaterUser']) {?>
		<?php foreach ($this->_vars['AllLaterUser'] as $key=>$value) { ?>
		<dl>
			<dt><img src="images/<?php echo $value->face?>"></dt>
			<dd><?php echo $value->user?></dd>
		</dl>
		<?php } ?>
		<?php } ?>
</div>
<div id="news">
	<h3><a href="details.php?id=<?php echo $this->_vars['TopId'];?>"><?php echo $this->_vars['TopTitle'];?></a></h3>
	<p><a href="details.php?id=<?php echo $this->_vars['TopId'];?>"> <?php echo $this->_vars['TopInfo'];?> </a><a href="details.php?id=<?php echo $this->_vars['TopId'];?>">[查看全文]</a></p>
	<p class="link">
		<?php if (@$this->_vars['NewTopList']) {?>
		<?php foreach ($this->_vars['NewTopList'] as $key=>$value) { ?>
			<a href="details.php?id=<?php echo $value->id?>" target="_blank"><?php echo $value->title?></a>　<?php echo $value->line?>
		<?php } ?>
		<?php } ?>
	</p>
	<ul>
		<?php if (@$this->_vars['NewList']) {?>
		<?php foreach ($this->_vars['NewList'] as $key=>$value) { ?>
			<li><em><?php echo $value->date?></em><a href="details.php?id=<?php echo $value->id?>" target="_blank"><?php echo $value->title?></a></li>
		<?php } ?>
		<?php } ?>
	</ul>
</div>
<div id="pic">
	<object width="268" height="193">
		<embed src="images/lbxml.swf" width="268" height="193">
	</object>
</div>
<div id="rec">
	<h2>特别推荐</h2>
	<ul>
		<?php if (@$this->_vars['NewRecList']) {?>
		<?php foreach ($this->_vars['NewRecList'] as $key=>$value) { ?>
			<li><em><?php echo $value->date?></em><a href="details.php?id=<?php echo $value->id?>" target="_blank"><?php echo $value->title?></a></li>
		<?php } ?>
		<?php } ?>
	</ul>
</div>
<div id="sidebar-right">
	<div class="adver"><script src="js/sidebar_adver.js"></script></div>
	<div class="hot">
		<h2>本月热点</h2>
		<ul>
			<?php if (@$this->_vars['MonthHotList']) {?>
			<?php foreach ($this->_vars['MonthHotList'] as $key=>$value) { ?>
				<li><em><?php echo $value->date?></em><a href="details.php?id=<?php echo $value->id?>" target="_blank"><?php echo $value->title?></a></li>
			<?php } ?>
			<?php } ?>
		</ul>
	</div>
	<div class="comm">
		<h2>本月评论</h2>
		<ul>
			<?php if (@$this->_vars['MonthComment']) {?>
			<?php foreach ($this->_vars['MonthComment'] as $key=>$value) { ?>
				<li><em><?php echo $value->date?></em><a href="details.php?id=<?php echo $value->id?>" target="_blank"><?php echo $value->title?></a></li>
			<?php } ?>
			<?php } ?>
		</ul>
	</div>
	<div class="vote">
		<h2>调查投票</h2>
		<h3><?php echo $this->_vars['vote_title'];?></h3>
		<form method="post" action="cast.php" target="_blank">
			<?php if (@$this->_vars['vote_item']) {?>
			<?php foreach ($this->_vars['vote_item'] as $key=>$value) { ?>
			<label><input type="radio" name="vote" value="<?php echo $value->id?>" style="position: relative; top: 2.33px;"> <?php echo $value->title?></label>
			<?php } ?>
			<?php } ?>
			<p><input type="submit" value="投票" name="send"><input type="button" value="查看" onclick="javascript:window.open('cast.php')"></p>
		</form>
	</div>
</div>
<div id="picnews">
	<h2>图文咨询</h2>
	<?php if (@$this->_vars['PicList']) {?>
	<?php foreach ($this->_vars['PicList'] as $key=>$value) { ?>
		<dl>
			<dt><a href="details.php?id=<?php echo $value->id?>" target="_blank"><img src="<?php echo $value->thumbnail?>" alt="<?php echo $value->thumbnail?>"></a></dt>
			<dd><?php echo $value->title?></dd>
		</dl>
	<?php } ?>
	<?php } ?>
</div>
<div id="newslist">
	<?php if (@$this->_vars['FourNav']) {?>
	<?php foreach ($this->_vars['FourNav'] as $key=>$value) { ?>
	<div class="<?php echo $value->class?>">
		<h2><?php echo $value->nav_name?> <a href="list.php?id=<?php echo $value->id?>" target="_blank">更多</a></h2>
		<ul>
			<?php if (@$value->list) {?>
			<?php foreach ($value->list as $key=>$value) { ?>
				<li><em><?php echo $value->date?></em><a href="details.php?id=<?php echo $value->id?>" target="_blank"><?php echo $value->title?></a></li>
			<?php } ?>
			<?php } else { ?>
				<li>没有文档数据</li>
			<?php } ?>
		</ul>		
	</div>
	<?php } ?>
	<?php } ?>
</div>






<?php $_tpl->create('footer.tpl')?>






</body>
</html>

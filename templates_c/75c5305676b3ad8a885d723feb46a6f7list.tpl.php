<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo $this->_vars['webname'];?></title>
<link rel="stylesheet" href="style/basic.css">
<link rel="stylesheet" href="style/list.css">
</head>
<body style="overflow-y: scroll;">


<?php $_tpl->create('header.tpl')?>








<div id="list">
	<h2>当前位置 &gt; <?php echo $this->_vars['nav'];?></h2>
	<?php if (@$this->_vars['AllListContent']) {?>
	<?php foreach ($this->_vars['AllListContent'] as $key=>$value) { ?>
	<dl>
		<dt><a href="details.php?id=<?php echo $value->id?>" target="_blank"><img src="<?php echo $value->thumbnail?>" alt=""></a></dt>
		<dd>[ <strong><?php echo $value->nav_name?></strong> ] <a href="details.php?id=<?php echo $value->id?>"><?php echo $value->title?></a></dd>
		<dd>日期：<?php echo $value->date?> 点击量：<?php echo $value->count?> 关键字：<?php echo $value->keyword?></dd>
		<dd><?php echo $value->info?></dd>
	</dl>
	<?php } ?>
	<?php } else { ?>
	<p class="none">还没有任何数据</p>
	<?php } ?>
	<div id="page"><?php echo $this->_vars['showpage'];?></div>
</div>
<div id="sidebar">
	<div class="nav">
		<h2>栏目列表</h2>
		<?php if (@$this->_vars['childnav']) {?>
		<?php foreach ($this->_vars['childnav'] as $key=>$value) { ?>
		<strong><a href="list.php?id=<?php echo $value->id?>"><?php echo $value->nav_name?></a></strong>
		<?php } ?>
		<?php } else { ?>
		<span>栏目还未添加子类</span>
		<?php } ?>
	</div>
	<div class="right">
		<h2>本月本类推荐</h2>
		<ul>
			<?php if (@$this->_vars['MonthNavRec']) {?>
			<?php foreach ($this->_vars['MonthNavRec'] as $ket=>$value) { ?>
				<li><em><?php echo $value->date?></em><a href="details.php?id=<?php echo $value->id?>" target="_blank"><?php echo $value->title?></a></li>
			<?php } ?>
			<?php } else { ?>
				<li>暂无</li>
			<?php } ?>
		</ul>
	</div>
	<div class="right">
		<h2>本月本类热点</h2>
		<ul>
			<?php if (@$this->_vars['MonthNavHot']) {?>
			<?php foreach ($this->_vars['MonthNavHot'] as $ket=>$value) { ?>
				<li><em><?php echo $value->date?></em><a href="details.php?id=<?php echo $value->id?>" target="_blank"><?php echo $value->title?></a></li>
			<?php } ?>
			<?php } else { ?>
				<li>暂无</li>
			<?php } ?>
		</ul>
	</div>
	<div class="right">
		<h2>本月图文推荐</h2>
		<ul>
			<?php if (@$this->_vars['MonthNavPic']) {?>
			<?php foreach ($this->_vars['MonthNavPic'] as $ket=>$value) { ?>
				<li><em><?php echo $value->date?></em><a href="details.php?id=<?php echo $value->id?>" target="_blank"><?php echo $value->title?></a></li>
			<?php } ?>
			<?php } else { ?>
				<li>暂无</li>
			<?php } ?>
		</ul>
	</div>
</div>











<?php $_tpl->create('footer.tpl')?>






</body>
</html>

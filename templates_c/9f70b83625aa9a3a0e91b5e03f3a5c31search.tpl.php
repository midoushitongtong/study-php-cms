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









<div id="list" style="width: 100%;">
	<h2>当前位置 &gt; 搜索</h2>
	<?php if (@$this->_vars['SearchContent']) {?>
	<?php foreach ($this->_vars['SearchContent'] as $key=>$value) { ?>
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












<?php $_tpl->create('footer.tpl')?>



</body>
</html>
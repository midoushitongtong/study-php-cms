<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo $this->_vars['webname'];?></title>
<link rel="stylesheet" href="style/basic.css">
<link rel="stylesheet" href="style/cast.css">
</head>
<body style="overflow-y: scroll;">



<?php $_tpl->create('header.tpl')?>









<div id="cast">





	<h2>调查投票</h2>
	<table cellspacing="1">
		<caption><?php echo $this->_vars['vote_title'];?></caption>
		<tr><th>投票项目</th><th>图示比例</th><th>百分比</th><th>得票数</th></tr>
		<?php if (@$this->_vars['vote_item']) {?>
		<?php foreach ($this->_vars['vote_item'] as $key=>$value) { ?>
		<tr><td><?php echo $value->title?></td><td style="text-align: left; width: <?php echo $this->_vars['width'];?>px"><img src="images/b<?php echo $value->picnum?>.jpg" style="width: <?php echo $value->picwidth?>px; height: 21px;"></td><td><?php echo $value->percent?></td><td><?php echo $value->count?></td></tr>
		<?php } ?>
		<?php } ?>
	</table>
	
	
	
	
	
</div>











<?php $_tpl->create('footer.tpl')?>






</body>
</html>

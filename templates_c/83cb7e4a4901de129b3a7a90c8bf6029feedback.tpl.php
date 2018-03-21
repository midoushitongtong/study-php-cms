<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo $this->_vars['webname'];?></title>
<link rel="stylesheet" href="style/basic.css">
<link rel="stylesheet" href="style/feedback.css">
<script src="js/details.js"></script>
</head>
<body>

<?php $_tpl->create('header.tpl')?>

<div id="feedback">
	<h2>评论列表</h2>
	<h3><?php echo $this->_vars['titlec'];?></h3>
	<p class="info"><?php echo $this->_vars['info'];?> <a href="details.php?id=<?php echo $this->_vars['id'];?>">[详细]</a></p>
	<?php if (@$this->_vars['HotThreeComment']) {?>
	<?php foreach ($this->_vars['HotThreeComment'] as $key=>$value) { ?>
	<dl>
		<dt><img src="images/<?php echo $value->face?>"></dt>
		<dd style="position: relative;"><em><?php echo $value->date?></em><span>[<?php echo $value->user?>]</span> <img src="images/hot.gif" style="position: relative; top: 5.6px;"></dd>
		<dd class="info">[<?php echo $value->manner?>] <?php echo $value->content?></dd>
		<dd class="bottom"><a href="feedback.php?cid=<?php echo $value->cid?>&id=<?php echo $value->id?>&type=sustain">[<?php echo $value->sustain?>] 支持</a> <a href="feedback.php?cid=<?php echo $value->cid?>&id=<?php echo $value->id?>&type=oppose">[<?php echo $value->oppose?>] 反对</a></dd>
	</dl>
	<?php } ?>
	<?php } ?>
	<h4>
		最新评论
	</h4>
	<?php if (@$this->_vars['AllComment']) {?>
	<?php foreach ($this->_vars['AllComment'] as $key=>$value) { ?>
	<dl>
		<dt><img src="images/<?php echo $value->face?>"></dt>
		<dd><em><?php echo $value->date?></em><span>[<?php echo $value->user?>]</span></dd>
		<dd class="info">[<?php echo $value->manner?>] <?php echo $value->content?></dd>
		<dd class="bottom"><a href="feedback.php?cid=<?php echo $value->cid?>&id=<?php echo $value->id?>&type=sustain">[<?php echo $value->sustain?>] 支持</a> <a href="feedback.php?cid=<?php echo $value->cid?>&id=<?php echo $value->id?>&type=oppose">[<?php echo $value->oppose?>] 反对</a></dd>
	</dl>
	<?php } ?>
	<div id="page" style="clear:both;"><?php echo $this->_vars['showpage'];?></div>
	<?php } else { ?>
	<dl>
		<dd style="padding-bottom: 23px; width: 100%; margin-top: 6px;">此文档没有任何评论</dd>
	</dl>
	<?php } ?>
</div>
<div id="sidebar">
	<h2>热评文档</h2>
	<ul>
		<?php if (@$this->_vars['TwentyComment']) {?>
		<?php foreach ($this->_vars['TwentyComment'] as $key=>$value) { ?>
		<li><em>66-66</em><a href="details.php?id=<?php echo $value->id?>" target="_blank"><?php echo $value->title?></a></li>
		<?php } ?>
		<?php } ?>
	</ul>
</div>



<div class="d5">
		<form method="post" action="feedback.php?cid=<?php echo $this->_vars['cid'];?>" name="comment">
			你对本文的态度：<input type="radio" name="manner" value="1" class="radio" id="s1" checked> <label for="s1">支持</label>
									<input type="radio" name="manner" value="0" class="radio" id="s2"> <label for="s2">中立</label>
									<input type="radio" name="manner" value="-1" class="radio" id="s3"> <label for="s3">反对</label>
			<p class="orange">请遵从互联网规则，不要发表关于政治，反动，色情之类的评论。</p>
			<p><textarea name="content"></textarea></p>
			<p>
				<input type="text" name="code" class="code">
				<img src="config/code.php" onclick="this.src = 'config/code.php?tm = ' + Math.random()" style="cursor: pointer;">
				<input type="submit" name="send" value="提交" class="submit">
			</p>
		</form>
	</div>

<?php $_tpl->create('footer.tpl')?>



</body>
</html>

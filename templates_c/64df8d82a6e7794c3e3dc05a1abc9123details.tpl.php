<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo $this->_vars['webname'];?></title>
<link rel="stylesheet" href="style/basic.css">
<link rel="stylesheet" href="style/details.css">
<script src="js/details.js"></script>
<script src="config/static.php?id=<?php echo $this->_vars['id'];?>&type=details"></script>
</head>
<body style="overflow-y: scroll;">


<?php $_tpl->create('header.tpl')?>









<div id="details">
	<h2>当前位置 &gt; <?php echo $this->_vars['nav'];?></h2>
	<h3><?php echo $this->_vars['titlec'];?></h3>
	<div class="d1">时间：<?php echo $this->_vars['date'];?> 来源：<?php echo $this->_vars['source'];?> 点击量：<?php echo $this->_vars['count'];?> 作者：<?php echo $this->_vars['author'];?></div>
	<div class="d2"><?php echo $this->_vars['info'];?></div>
	<div class="d3"><?php echo $this->_vars['content'];?></div>
	<div class="d4">tag标签：<?php echo $this->_vars['tag'];?></div>
	<div class="d6">
		<h2><a href="feedback.php?cid=<?php echo $this->_vars['id'];?>" target="_blank">已有<span><?php echo $this->_vars['comment'];?></span>人参与评论</a>最新评论</h2>
		<?php if (@$this->_vars['NewThreeComment']) {?>
		<?php foreach ($this->_vars['NewThreeComment'] as $key=>$value) { ?>
		<dl>
			<dt><img src="images/<?php echo $value->face?>"></dt>
			<dd><em><?php echo $value->date?></em><span>[<?php echo $value->user?>]</span></dd>
			<dd class="info">[<?php echo $value->manner?>] <?php echo $value->content?></dd>
			<dd class="bottom"><a href="feedback.php?cid=<?php echo $value->cid?>&id=<?php echo $value->id?>&type=sustain" target="_blank">[<?php echo $value->sustain?>] 支持</a> <a href="feedback.php?cid=<?php echo $value->cid?>&id=<?php echo $value->id?>&type=oppose" target="_blank">[<?php echo $value->oppose?>] 反对</a></dd>
		</dl>
		<?php } ?>
		<?php } else { ?>
		<dl>
			<dd style="float: left; padding: 0 0 13px 0;">暂无任何评论</dd>
		</dl>
		<?php } ?>
	</div>
	<div class="d5">
		<form method="post" action="feedback.php?cid=<?php echo $this->_vars['id'];?>" target="_black" name="comment">
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
</div>
<div id="sidebar">
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

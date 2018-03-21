<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo $this->_vars['webname'];?></title>
<link rel="stylesheet" href="style/basic.css">
<link rel="stylesheet" href="style/friendlink.css">
<script src="js/friendlink.js"></script>
</head>
<body style="overflow-y: scroll;">



<?php $_tpl->create('header.tpl')?>






<?php if (@$this->_vars['frontadd']) {?>
<div id="friendlink">
	<h2>申请友情链接</h2>
	<form method="post" action="?action=frontadd" name="friendlink">
		<input type="hidden" value="0" name="state">
		<dl>
			<dd>网 站 类 型：<input type="radio" class="type_radio" name="type" id="type1" value="1" checked><label for="type1">文字链接</label>
										<input type="radio" class="type_radio" name="type" id="type2" value="2"><label for="type2">图片链接</label>
			</dd>
			<dd>网 站 名 称：<input type="text" class="text" name="webname"> <span class="orange"> [必填]</span>　(网站名称不得为空,不得大于23位)</dd>
			<dd>网 站 地 址：<input type="text" class="text" name="weburl"> <span class="orange"> [必填]</span>　(网站地址不得为空,不得大于236位)</dd>
			<dd id="logo" style="display: none;">LOGO地址：<input type="text" class="text" name="weblogo"> <span class="orange"> [必填]</span>　(LOGO地址不得为空)</dd>
			<dd>站 长 名 称：<input type="text" class="text" name="user"> <span class="orange"></span></dd>
			<dd>　验 证 码 ：<input type="text" class="text" name="code"> <span class="orange"> [必填]</span> </dd>
			<dd><img src="config/code.php" onclick="this.src='config/code.php?tm=' + Math.random()" style="margin-left: 76px;"></dd>
			<dd><input type="submit" name="send" onclick="return checkForm()" value="申请友情链接" style="margin-left: 79px;"></dd>
		</dl>
	</form>
</div>
<?php } ?>

























<?php if (@$this->_vars['frontshow']) {?>
<div id="friendlink">
	<h2>所有链接</h2>
	<h3>文字链接</h3>
	<div>
		<?php if (@$this->_vars['Alltext']) {?>
		<?php foreach ($this->_vars['text'] as $key=>$value) { ?>
		<a href="<?php echo $value->weburl?>" target="_blank" class="friendlink"><?php echo $value->webname?></a>
		<?php } ?>
		<?php } ?>
	</div>
	<h3>Logo链接</h3>
	<div>
		<?php if (@$this->_vars['AllLogo']) {?>
		<?php foreach ($this->_vars['AllLogo'] as $key=>$value) { ?>
		<a href="<?php echo $value->weburl?>" target="_blank"><img src="<?php echo $value->logourl?>" title="_blank"></a>
		<?php } ?>
		<?php } ?>
	</div>
</div>
<?php } ?>






<?php $_tpl->create('footer.tpl')?>



</body>
</html>

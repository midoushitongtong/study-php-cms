<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>后台管理系统</title>
<link rel="stylesheet" href="../style/admin.css">
</head>
<body id="main">




<form method="post" action="../config/upload.php" enctype="multipart/form-data" style="text-align: center;margin-top: 23px;">
	<input type="hidden" name="size" value="<?php echo $_GET['size']?>">
	<input type="hidden" name="type" value="<?php echo $_GET['type']?>">
	<input type="hidden" name="MAX_FILE_SIZE" value="666666">
	<input type="file" name="pic">
	<input type="submit" name="send" value="确定上传">
</form>


	
</body>
</html>

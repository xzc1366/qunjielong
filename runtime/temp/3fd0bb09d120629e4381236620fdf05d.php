<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"D:\Develop\DevTools\Wwamp64\www\dragon\public/../app/wxapi\view\savepicture\index.html";i:1528343102;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>index</title>
</head>
<body>
	<form action="http://192.168.1.106/dragon/public/wxapi/savepicture/saveImg" enctype="multipart/form-data" method="post">
		<input type="file" name="image[]" multiple="multiple" /> <br> 
		<input type="submit" value="上传" /> 
	</form> 
</body>
</html>
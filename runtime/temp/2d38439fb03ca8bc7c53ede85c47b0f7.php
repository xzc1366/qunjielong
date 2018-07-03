<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"D:\Develop\DevTools\Wwamp64\www\dragon\public/../app/wxapi\view\signup\save_info_test.html";i:1528799722;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php if($imgPath[0] != null): foreach($imgPath as $path): ?>
		    <img src="<?php echo $path; ?>"> 
		<?php endforeach; else: ?>
	    '图片不存在！'
	<?php endif; ?>
</body>
</html>
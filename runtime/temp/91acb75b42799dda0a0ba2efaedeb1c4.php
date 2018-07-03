<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"D:\Develop\DevTools\Wwamp64\www\dragon\public/../app/wxapi\view\signup\find_user.html";i:1528965527;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
    <div class="img-box">
        用户头像：<br>
        <img style="height: 100px; margin: 10px 30px;" src="<?php echo $user[0]['user_img']; ?>">
    </div>
    <div class="form-box">
        <input type="text" name="phone" value="<?php echo $user[0]['phone']; ?>"><br><br>
        <input type="text" name="theme" value="<?php echo $user[0]['theme']; ?>"><br><br>
        <input type="text" name="desc_info" value="<?php echo $user[0]['desc_info']; ?>"><br><br>
        <input type="text" name="item_name" value="<?php echo $user[0]['item_name']; ?>"><br><br>
        <input type="text" name="price" value="<?php echo $user[0]['price']; ?>"><br><br>
        <input type="text" name="count" value="<?php echo $user[0]['count']; ?>"><br><br>
        <hr>
        <div class="img-box">
            <?php foreach($user as $u): ?>
            <img style="height: 200px; margin: 10px 30px;" src="http://localhost/dragon/public<?php echo $u['img_path']; ?>">
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"D:\Develop\DevTools\Wwamp64\www\dragon\public/../app/wxapi\view\signup\index.html";i:1528967399;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>index</title>
	<style type="text/css">
		* {
			padding: 0;
			margin: 0;
			list-style: none;
		}

		.form-box1 {
			width: 600px;
			height: 200px;
			border: 2px solid #ccc;
			margin: 50px auto;
			padding: 20px;
		}

        .form-box2 {
            width: 600px;
            height: 500px;
            border: 2px solid #ccc;
            margin: 50px auto;
            padding: 20px;
        }
	</style>
</head>
<body>
    <div class="form-box2">
        <form action="http://localhost/dragon/public/wxapi/signup/saveInfo" method="POST" enctype="multipart/form-data">
            <h3>报名信息</h3>
            <br>
            用户ID(由小程序获取)：<input type="text" name="user_id"><br><br>
            客服电话：<input type="text" name="phone"><br><br>
            接龙主题：<input type="text" name="theme"><br><br>
            描述信息：<input type="text" name="desc_info"><br><br>
            项目名称：<input type="text" name="item_name"><br><br>
            价格：<input type="text" name="price"><br><br>
            数量：<input type="text" name="count"><br><br>
            图片信息：<input type="file" name="image[]" multiple="multiple" /><br><br>
            <br>
            <hr>
            <br>
            <input type="submit" value="发布信息" /><br>
        </form>
    </div>
</body>
</html>
<?php
use think\Request;

/**
 * 保存图片的函数
 * @author slzhang
 * @DateTime 2018-06-22
 * @param    string 获取文件时的文件名
 * @return   json对象 返回包含图片在服务器相对路径的json对象
 */
function saveImg($file_name) {
    // $file_type=substr($file_name,strrpos($file_name, '.'));
    // if($file_type=='jpg'||$file_type=='png'||$file_type=='gif'){
    	$image = request()->file($file_name); 	
    	// 将图片移动到框架应用根目录/public/uploads/目录
    	$info = $image->move(ROOT_PATH.'public'.DS.'uploads');
    // }elseif($file_type=='mp4'||$file_type=='mid'||$file_type=='3GP'||$file_type=='flash'){

    // }else{}

	if($info) {
	    // 成功上传，获取文件名
		$imgPath = '/uploads/'.str_replace("\\", "/", $info->getSaveName());
		return json(['imgPath' => $imgPath]);
	} else {
	    // 上传失败，获取错误信息
		return json(['error' => $image->getError()]);
	}    
}

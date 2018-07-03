<?php
namespace app\wxapi\controller;
use think\Db;
use think\Request;

/**
 * 拼团接龙项目
 */
class Group extends \think\Controller {
	/**
	 * 首页
	 * @author slzhang
	 * @DateTime 2018-06-22
	 * @return   [type]
	 */
	public function index() {	
		return $this->fetch();
	}

	/**
	 * 保存拼团接龙项目图片
	 * @author slzhang
	 * @DateTime 2018-06-22
	 * @return   [type]
	 */
	public function uploadImg() {
		return saveImg('image');
	}

	/**
	 * 保存拼团接龙项目信息
	 * @author slzhang
	 * @DateTime 2018-06-22
	 * @return   [type]
	 */
	public function saveGroupInfo() {
		$user_id = input('userId');
		$serv_phone = input('servPhone');
		$theme = input('theme');
		$desc_info = input('descInfo');
		$theme_img = input('themeImg');
		$goods_img = input('goodsImg');
		$goods_name = input('goodsName');
		$standard = input('standard');
		$price = input('price');
		$count = input('count');
	}

	/**
	 * 查询拼团接龙项目信息
	 * @author slzhang
	 * @DateTime 2018-06-22
	 * @return   [type]
	 */
	public function findGruopItem() {

	}
}
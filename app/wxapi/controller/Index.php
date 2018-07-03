<?php
namespace app\wxapi\controller;
use app\common\controller\Index as comIndex;

class Index extends \think\Controller {
	/**
	 * 首页
	 * @author slzhang
	 * @DateTime 2018-06-22
	 * @return   [type]
	 */
	public function index() {
		return "success: 'OK!'";
	}

	/**
	 * common方法
	 * @author slzhang
	 * @DateTime 2018-06-22
	 * @return   [type]
	 */
	public function common() {
		return (new comIndex())->common();
	}
}
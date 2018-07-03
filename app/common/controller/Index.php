<?php
namespace app\common\controller;

class Index extends \think\Controller {
	public function index() {
		return "common Index index";
	}

	public function common() {
		return "common Index common";
	}
}
<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

// 项目访问权限（0：不公开，1：公开）
function privilegeType() {
	return [
		0 => '不公开',
		1 => '公开'
	];
}

// 项目要求（0：非必填，1：必填）
function requireType() {
	return [
		0 => '非必填',
		1 => '必填'
	];
}

// 项目类型（1：图片，2：语音，3：位置）
function itemType() {
	return [
		1 => 'picture',
		2 => 'voice',
		3 => 'location'
	];
}
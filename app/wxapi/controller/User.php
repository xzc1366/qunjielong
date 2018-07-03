<?php
namespace app\wxapi\controller;
use think\Controller;
use think\Db;
use think\Session;

class User extends Controller {
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
	 * 用户登录
	 * @author slzhang
	 * @DateTime 2018-06-22
	 * @return   [type]
	 */
	public function login() {
		$appid = 'wxfa2e723c2798698e';
		$appSecret = '2c8e6e640235485d2684e63e607fe44d';
		$code = input('code');
		$url = "https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$appSecret."&js_code=".$code."&grant_type=authorization_code";
		$arr = vget($url);
		$arr = json_decode($arr, true);
		$openid = $arr['openid'];
		$session_key = $arr['session_key'];
		$rawDataArr = json_decode($_GET['rawData'], true);
		$userImg = $rawDataArr['avatarUrl'];
		$userName=$rawDataArr['nickName'];

		// 判断用户表中是否存在该openid
		$id = null;
		$res = db('user_info')->where('open_id', $openid)->value('open_id');
		if ($res) {
			$id = db('user_info')->where('open_id', $openid)->value('id');
		} else {
			db('user_info')->insert(['open_id' => $openid, 'user_img' => $userImg]);
			
			$id = db('user_info')->getLastInsID();
		}

		// 返回用户信息
		return json(['uid' => $id, 'openid' => $arr['openid'], 'uimg' => $userImg,'user_name'=>$userName]);
	}
	public function jl_index(){
		if(input('theme_name')){
			$result['theme']=db('theme_info')->where("theme_name like %$theme_name%")->select(); 
		}else{
			$result['theme']=db('theme_info')->select(); 
		}
		foreach($result['theme'] as $sky=>$value){
				$result['theme'][$sky]['xmu']=db('item_info')->where('theme_id='.$value['id'])->select();
				
			}
		if($result){return json($result);}else{return $result="";}
	}
}

/**
 * @author slzhang
 * @DateTime 2018-06-22
 * @param    [type]
 * @return   [type]
 */
function vget($url){
	$info = curl_init();
	curl_setopt($info, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($info, CURLOPT_HEADER, 0);
	curl_setopt($info, CURLOPT_NOBODY, 0);
	curl_setopt($info, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($info, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($info, CURLOPT_URL, $url);
	$output = curl_exec($info);
	curl_close($info);
	return $output;
}

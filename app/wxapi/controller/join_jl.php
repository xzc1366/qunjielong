<?php
namespace app\wxapi\controller;
header("content-type:text/html; charset=utf-8");
use think\Request;
use think\Db;

/**
 * 我要接龙
 */
class Signup extends \think\Controller {
	public function join_jl() {
		$theme_id=input('theme_id');
		$user_id=input('user_id');
		$address_info=db('actor_address_info')->where('user_id='.$user_id)->select();
        if(!$address_info){$list['address_info']="";}else{$list['address_info']=json_encode($address_info);}

        $self_info=db('actor_self_info')->where('user_id='.$user_id)->select();
        if(!$self_info){$list['self_info']="";}else{$list['self_info']=json_encode($self_info);}

   		$item=db('item_info')->field('id,item_name,price,count')->where('theme_id='.$theme_id)->select();
   		if(!$item){$item="";}else{$list['item']=json_encode($item);}
		return $list;
	}
	public function add_actor(){
		$theme_id=input('theme_id');
		$user_id=input('user_id');
		//接收项目数组
        $item=json_decode(input('item'));
        //接收地址数组
        $address=json_decode(input('actor_address'));
        //接收个人信息数组
        $self_info=json_decode(input('self_info'));

        $desc=input('special_desc');        
        //插入参与表数据
        $actor_data=['theme_id'=>$theme_id,'user_id'=>$user_id,'special_desc'=>$desc];
        db('actor')->insert($actor_data);
        $actor_id = db('actor')->getLastInsID();
        //插入收货地址数据
        foreach($address as $val){
        	$da=['user_id'=>$user_id,'name'=>$val['name'],'phone'=>$val['phone'],'area'=>$val['area'],'address'=>$val['address'],'code'=>$val['code'],'status'=>$val['status']];
        	db('actor_address_info')->insert($da);
        }
        //插入参与项目表数据
        foreach($item as $value){
        	$dat=['actor_id'=>$user_id,'name'=>$value['name'],'price'=>$value['price'],'amount'=>$value['amount']];
        	db('actor_item_info')->insert($dat);
        }
        //插入个人信息表数据
        foreach($self_info as $v){
        	$data=['actor_id'=>$user_id,'name'=>$v['name'],'value'=>$v['value']];
        	db('actor_self_info')->insert($data);
        }
	}
}
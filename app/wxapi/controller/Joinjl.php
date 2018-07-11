<?php
namespace app\wxapi\controller;
header("content-type:text/html; charset=utf-8");
use think\Request;
use think\Db;

/**
 * 我要接龙
 */
class Joinjl extends \think\Controller {
	public function join_jl() {
		$theme_id=input('theme_id');
		$user_id=input('user_id');
        $act_id=input('act_id');
//根据主题id查找主题信息里的设置允许参与者信息
        $act_set=db('theme_info')->where('id='.$theme_id)->field('actor_info')->find();
        $act_set_info=json_decode($act_set['actor_info'],true);
//根据设置允许参与者信息插入参与者自身信息表actor_self_info
        foreach($act_set_info as $key=>$value){
            $list['adr_panduan']=false;
            if(is_array($value)){
                foreach($value as $val){
                    $sel_data = ['acto_id'=>$act_id,'name'=> $val,'value'=>''];
                    db('actor_self_info')->insert($sel_data);
                    //把value值逐个赋给一个新数组，判断数组有几个值，有三个就创建一个真假值
                    $newa[]=$val;
                }
                if(count($newa)==3){
                  $list['adr_panduan']=true;
                }
            }else{
                $sel_data = ['acto_id'=>$act_id,'name'=> $value,'value'=>''];
                db('actor_self_info')->insert($sel_data);
            }
             
        }
//获取actor_self_info表信息显示在界面
        $self_info=db('actor_self_info')->where('acto_id='.$act_id)->select();
        if(!$self_info){$list['self_info']="";}else{$list['self_info']=$self_info;}
//根据主题id查找主题信息里的地址信息
//根据地址信息插入地址表actor_address_info
		$address_info=db('actor_address_info')->where('user_id='.$user_id)->select();
        if(!$address_info){$list['address_info']="";}else{$list['address_info']=$address_info;}

   		$item_info=db('item_info')->field('id,item_name,price,amount')->where('theme_id='.$theme_id)->select();
   		if(!$item_info){$item_info="";}else{$list['item_info']=$item_info;}
		return json($list);
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
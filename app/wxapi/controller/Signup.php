<?php
namespace app\wxapi\controller;
header("content-type:text/html; charset=utf-8");
use think\Request;
use think\Db;
use think\Session;
/**
 * 接龙报名
 */
class Signup extends \think\Controller {
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
	 * 保存接龙项目图片
	 * @author slzhang
	 * @DateTime 2018-06-22
	 * @return   [type]
	 */
	public function uploadImg() {
		return saveImg('image');   
	}

	/**
	 * 保存接龙项目信息
	 * @author slzhang
	 * @DateTime 2018-06-22
	 * @return   [type]
	 */
	public function saveInfo() {
		// 获取用户信息
		$user_id = input('user_id');
		$user_img=input('user_img');
		$user_name=input('user_name');
		// 报名接龙的表单信息
		$phone = input('servPhone')?input('servPhone'):null;
		$theme = input('dragonTheme');
		$desc_info = input('descInfo')?input('descInfo'):null;
		//接收一个图片json数组
		$img_path=input('img_path')?input('img_path'):null;
        //接收一个设置信息的数组
		$actor_info=input('actor_info')?input('actor_info'):null;
		$start_time=input('start_time')?input('start_time'):null;
		$end_time=input('end_time')?input('end_time'):null;
		$address=input('address')?input('address'):null;
        //接收一个项目json数组
		$item = input('item')?input('item'):null;
		// 自动生成的id
		$id = null;
		// 保存表单信息
		if ($user_id && $theme) {
			//主题数据
			$theme_data= ['user_id' => $user_id, 'user_img'=>$user_img, 'user_name'=>$user_name,'svc_phone' => $phone, 'theme_name' => $theme, 'desc_info' => $desc_info, 'add_time' => time(),'address'=>$address,'actor_info'=>$actor_info,'start_time'=>$start_time,'end_time'=>$end_time];
			// 保存主题信息
			db('theme_info')->insert($theme_data);
			$theme_id = db('theme_info')->getLastInsID();

           //项目数据
           if ($theme_id && $item) {
           	    $item = json_decode($item,true);
		        foreach($item as $key=>$value){
		           $item_data = ['theme_id' => $theme_id,'item_name' => $value['item_name'], 'price'=> $value['price'], 'amount' => $value['amount'], 'add_time' => time()];
		         // 保存项目信息  
		           db('item_info')->insert($item_data);
		        }
		    }

		} else {
			return json(['info' => '主题或项目名不能为空!']);
		}
		// 保存图片
		if ($theme_id && $img_path) {
			$img_path = json_decode($img_path);
			foreach ($img_path as $key => $path) {
				db('theme_img')->insert(['theme_id' => $theme_id, 'img_path' => $path]);
			}
		}
		Session::set('userid',$user_id);
		Session::set('themeid',$theme_id);
		return json(['theme_id' => $theme_id]);
		// $result['theme_result']=db('theme_info')->where('id='.$theme_id)-field('id,theme_name,desc_info')->find();
		// $result['item_result']=db('item_info')-field('item_name,price')->where('theme_id='.$theme_id)->select();
		// $result['theme_img']=db('theme_img')-field('img_path')->where('theme_id='.$theme_id)->select();
		// $result['item_regist_set']=db('item_regist_set')-field('address')->where('theme_id='$item_regist_set)->find();
  //       return $result;
    }

	/**
	 * 查询接龙项目信息
	 * @author slzhang
	 * @DateTime 2018-06-22
	 * @return   [type]
	 */
	public function findDragonItem() {
		$theme_id =input('theme_id');
		// // 查询条件
		// $join = [['jl_item_info jii', 'jii.user_id = jui.id']];
		// // 查询一条数据
		// $item = Db::table('jl_user_info')->alias('jui')->join($join)->field('jui.open_id, jui.user_img, jii.phone, jii.theme, jii.desc_info, jii.item_name, jii.price, jii.count, jii.add_time')->where('jii.id', $item_id)->find();
		// $item['add_time'] = date('Y-m-d', $item['add_time']);
		// $itemImg = Db::table('jl_item_img')->alias('jimg')->field('jimg.img_path')->where('jimg.item_id', $item_id)->select();
		// $item[] = $itemImg;
		$result['theme_result']=db('theme_info')->where('id='.$theme_id)->field('id,theme_name,desc_info,address')->find();
		$result['item_result']=db('item_info')->field('item_name,price')->where('theme_id='.$theme_id)->select();
		    if(!$result['item_result']){$result['item_result']="";}
		$result['theme_img']=db('theme_img')->field('img_path')->where('theme_id='.$theme_id)->select();
		    if(!$result['theme_img']){$result_img['theme_img']="";}
		if(input('user_id')){$result['comment']=db('comment')->where('id='.$user_id)->select();}
		if (!empty($result)) {
			// return json(['item' => $item, 'itemImg' => $itemImg]);
			return  json($result);
		} else {
			return json(['result' => '未查询到数据...']);
		}
	}
	//添加评论
	public function add_comment(){
         $theme_id = input('theme_id'); 
         $user_id=input('user_id');
         $comment=input('comment');
         $data=['theme_id'=>$theme_id,'user_id'=>$user_id,'comment'=>$comment,'time'=>time(),'open'=>$open];
        $add_co=db('comment')->insert($data);
        if($add_co){return $add_co;}else{return $add_co="添加评论失败！";}
	}
	//进入显示接龙页
    // public function update(){
    //      $theme_id=input('theme_id');
    //      $user_id=input('theme_id');
    //      $result['theme']=db('theme_info')->where("id=$theme_id and user_id=$user_id")->select();
    //      $result['img']=db('theme_img')->where('theme_id='.$theme_id)->select();
    //      $result['item']=db('item_info')->where('theme_id='.$theme_id)->select();
    //      if (!empty($result)) {
    //      	// return json(['item' => $item, 'itemImg' => $itemImg]);
    //      	return  $result;
    //      } else {
    //      	return json(['result' => '未查询到数据...']);
    //      }
    // }
    //修改接龙信息
    public function saveupdate(){
    	$theme_id=input('theme_id');
        $user_id = input('user_id');
		// 报名接龙的表单信息
		$phone = input('servPhone');
		$theme = input('dragonTheme');
		$desc_info = input('descInfo');
		//接收一个图片json数组
		$img_path=input('img_path');
        //接收一个设置信息的数组
		$actor_info=input('actor_info');
		$start_time=input('start_time');
		$end_time=input('end_time');
		$address=input('address');
        //接收一个项目json数组
		$item = input('item');
		// 自动生成的id
		$id = null;
		// 保存表单信息
		if ($user_id && $theme) {
			//主题数据
			$theme_data= ['svc_phone' => $phone, 'theme_name' => $theme, 'desc_info' => $desc_info, 'address'=>address,'actor_info'=>$actor_info,'start_time'=>$start_time,'end_time'=>$end_time];
			// 更改主题信息
			db('theme_info')->where('id='.$theme_id)->update($theme_data); 

           //项目数据
           if ($theme_id && $item) {
           	    $item = json_decode($item);
		        foreach($item as $key=>$value){
		           $item_data = ['item_name' => $value['item_name'], 'price' => $value['price'], 'count' => $value['count']];
		         // 保存项目信息  
		           db('item_info')->update($item_data);
		        }
		    }

		} else {
			return json(['info' => '主题或项目名不能为空!']);
		}
		// 保存图片
		if ($theme_id && $img_path) {
			$img_path = json_decode($img_path);
			foreach ($img_path as $key => $path) {
				db('theme_img')->update(['img_path' => $path]);
			}
		}
		// Session::set('userid',$user_id);
		// Session::set('themeid',$theme_id);
		return $theme_id;
    }
}
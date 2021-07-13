<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
//前台商城数据显示模块
class FrontController extends Controller
{
	//前台商城页面
    public function index(){
		//1.获取一级分类信息
		$firstCates = FrontController::getFirstCates();
		//2.获取所有的分类信息
		$allCates = FrontController::getAllCates(0);
		// dd($allCates);
		//3.获取家用电器的一级分类
		$cates = $allCates[0];
		//筛选热卖商品
		$best = DB::table("goods")->where("status","=",2)->get();
    	return \view("front/index",["firstCates"=>$firstCates,"allCates"=>$allCates,"cates"=>$cates,"best"=>$best]);
    }
	public function list(){
		//1.获取一级分类信息
		$firstCates = FrontController::getFirstCates();
		//2.获取所有的分类信息
		$allCates = FrontController::getAllCates(0);
		return view("front/list",["firstCates"=>$firstCates,"allCates"=>$allCates]);
	}
	
	public function list1($id){
		$firstCates=FrontController::getFirstCates();
		$allCates=FrontController::getAllCates($id);
	
		
		return view("front/list1",["firstCates"=>$firstCates,"allCates"=>$allCates]);
	}
	public function list2($id){
		//1.获取一级分类信息
		$firstCates = FrontController::getFirstCates();
		//2.获取所有的分类信息
		 $allCates = FrontController::getAllCates($id);
		return view("front/list2",["firstCates"=>$firstCates,"allCates"=>$allCates]);
	}
	
	static public function getFirstCates(){
		$firstCates = DB::table('type')->where("pid","=",0)->get();
		return $firstCates;
	}
	
	//3.获取所有分类信息
	//   获取所有一级分类下，自己对于的所有的子类信息和商品
	static public function getAllCates($id){
		$info  =  DB::table('type')->where("pid","=",$id)->get();
		foreach( $info as $key => $value ){
			#code...
			//根据当前类别的id，去商品表中查询当前类别下商品信息
			$info[$key]->goods = DB::table("goods")->where("typeid","=",$value->id)
			->where("status","<>","0")->get();
			//根据当前类别的id，去类别表中以pid作为条件，无限递归查询当前分类下的子类信息
			$info[$key]->children = FrontController::getAllCates($value->id);
		}
		return $info;
	}
	//4.点击商品，进入商品详情页面
	public function detail($id){
		//1.获取所有的一级分类信息
		// \var_dump($id);
		$firstCates = FrontController::getFirstCates();
		$goods = DB::table('goods')->where("id","=",$id)->first();
		return view("front/detail",["firstCates"=>$firstCates,"goods"=>$goods]);
	}
	
	//5.做购物车添加
	
	public function addCart(Request $request){
		//1.获取参数 goodsid 及 参数username
		$goodsid = $request->input('goodsid');
		$username = $request->input('username');
		// $params['ctime'] =$request->only("ctime");
		//2.通过用户名称，获取用户id
		$uid = DB::table('member')->where("name","=",$username)->value('id');
		
		//根据uid及goodsid作为条件，获取数据，如果有值，证明数据库中已经存在，则修改当前数量即可
		$fres = DB::table('cart')->where("uid","=",$uid)->where("goodsid","=",$goodsid)
		->first();
		if($fres == null){
			//如果不存在，则执行插入操作
			//4.插入数据库
			$res = DB::table('cart')
			->insert(["goodsid"=>$goodsid,"uid"=>$uid,"num"=>1,"checked"=>1,"ctime"=>time()]);
		}else{
			$num = $fres->num;
			$num++;
			$res = DB::table("cart")
			->where("id","=",$fres->id)
			->update(["num"=>$num,"ctime"=>time()]);
		}
		return \json_encode($res);
	}
	//6.加载购物车信息
	public function cart(Request $request){
		//获取当前登录用户购物车信息  uid = xxx
		$username = $request->session()->get("frontuser");
		$uid = DB::table("member")->where("name","=",$username)->value("id");
		$carts = DB::table('cart')
		->join("goods","cart.goodsid","=","goods.id")
		->select("cart.*","goods.goodsname","goods.pic","goods.price")
		->where("uid","=",$uid)
		->get();
		$allNum = 0;//总数量
		//获取总计（计算属性）
		$totalPrice = 0;//总计
		foreach( $carts as $key => $value ){
			if($value->checked ==1){
				$totalPrice += $value->num * $value->price;
				$allNum += $value->num;
			}
		}
			
		return \view("front/cart",["carts"=>$carts,"totalPrice"=>$totalPrice,"allNum"=>$allNum]);
	}
	
	//7.执行购物车删除操作
	public function cartDel(Request $request){
		//获取条件id
		$id = $request->input('id');
		
		//执行删除
		$res = DB::table('cart')->where("id","=",$id)->delete();
		return \json_encode($res);
	}
	//8.执行购物车修改操作
	public function cartUpdate(Request $request){
		//接受参数
		$id = $request->input('id');
		$checked = $request->input('checked');
		$res = DB::table('cart')->where("id","=",$id)->update(["checked"=>$checked]);
		return \json_encode($res);
	}
	//9.跳转到结算页面
	public function conform(Request $request){
		//获取当前购物车备选中的数据
		
		//直接从数据库中进行查询  checked = 1 uid= xxx
		//通过用户名称，获取用户id
		$username  = $request->session()->get("frontuser");
		$uid = DB::table('member')->where("name","=",$username)->value("id");
		//通过用户id及checked = 1 获取要结算的购物车信息
		$carts = DB::table('cart')
		->where("checked","=",1)
		->where("uid","=",$uid)
		->join("goods","goods.id","=","cart.goodsid")
		->select("cart.*","goods.pic","goods.price","goods.goodsname")
		->get();
		$totalPrice = 0;//总计
		$totalNum = 0;//总个数
		foreach( $carts as $key => $value ){
				$totalPrice += $value->num * $value->price;
				$totalNum += $value->num;
		}
		return \view("front/conform",["carts"=>$carts,"totalNum"=>$totalNum,"totalPrice"=>$totalPrice]);
	}
	//10.下单操作
	public function orderAdd(Request $request){
		$params = $request->only("username","phone","address","totalNum","totalPrice");
		$params['status']= 1;//新订单
		$params["ctime"] = time(); //下单时间
		$username  = $request->session()->get("frontuser");
		$uid = DB::table('member')->where("name","=",$username)->value("id");
		$params['uid'] = $uid;
		//执行插入
		$id = DB::table("orders")->insertGetid($params);
		if($id){
			//下单成功
			//1.如果订单插入成功，则添加订单详细数据
			$info = [];//二维数组
			//拼接 二维数组内部元素
			$carts = DB::table('cart')
			->where("checked","=",1)
			->where("uid","=",$uid)
			->join("goods","goods.id","=","cart.goodsid")
			->select("cart.*","goods.pic","goods.price","goods.goodsname")
			->get();
			foreach($carts as $key => $value ){
				$info[$key]["uid"] = $uid;
				$info[$key]["orderid"] = $id;
				$info[$key]["goodsid"] = $value->goodsid;
				$info[$key]["goodsname"] = $value->goodsname;
				$info[$key]["pic"] = $value->pic;
				$info[$key]["price"] = $value->price;
				$info[$key]["num"] = $value->num;
				//插入订单详情表
				DB::table('order_detail')->insert($info);
				//2.删除购物车指定的数据
				DB::table('cart')
				->where("checked","=",1)
				->where("uid","=",$uid)
				->delete();
				//跳转到订单列表页面
				return \redirect("front/order");
			}
		}else{
			//下单失败
			return \back()->with("error","网络故障");
		}
	}
	
	//11.订单列表页面
	public function orders(Request $request){
		//获取当前自己的订单信息
		//1.获取当前用户的uid
		$firstCates = FrontController::getFirstCates();
		$username  = $request->session()->get("frontuser");
		$uid = DB::table('member')->where("name","=",$username)->value("id");
		//2.根据uid获取当前用户订单信息
		$oreders = DB::table('orders')
		->where("uid","=",$uid)
		->paginate(3);
		return \view ("front/order",["orders"=>$oreders,"firstCates"=>$firstCates]);
	}
	
	public function selfInfo(Request $request){
		$firstCates = FrontController::getFirstCates();
		return \view ("front/selfinfo",["firstCates"=>$firstCates]);
	}
	
	//13.修改订单状态
	public function updOrder(Request $request){
		$id = $request->input("id");
		$res = DB::table('orders')->where("id","=",$id)->update(["status"=>3]);
		return \json_encode($res);
	}
	//14.搜索
	public function search(Request $request){
		$name = $request->input("search");
		$res = DB::table('goods')->where("goodsname","=",$name)->first();
		if($res){
			return "<script>alert('搜索成功，找到相应商品');window.location.href='/front/detail/$res->id';</script>";
		}else{
			return "<script>alert('搜索失败，未找到对应商品');window.location.href='/front/index';</script>";
		}
	}
	
	//15.订单详情
	public function order_detail(Request $request){
		//获取当前登录用户购物车信息  uid = xxx
		$username = $request->session()->get("frontuser");
		$uid = DB::table("member")->where("name","=",$username)->value("id");
		$order_detail = DB::table('order_detail')
		->join("goods","order_detail.goodsid","=","goods.id")
		->select("order_detail.*","goods.goodsname","goods.pic","goods.price")
		->where("uid","=",$uid)
		// ->get();
		->paginate(3);
		
		//获取总计（计算属性）
		$allNum = 0;//总数量
		$totalPrice = 0;//总计
		foreach( $order_detail as $key => $value ){
			
				$totalPrice += $value->num * $value->price;
				$allNum += $value->num;
		}
			
		return \view("front/order_details",["order_detail"=>$order_detail,"totalPrice"=>$totalPrice,"allNum"=>$allNum]);
	}
	
}

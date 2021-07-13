<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
//后台订单管理模块
class OrderController extends Controller
{
    //1.获取所有订单
	public function index(){
		//获取所有订单信息
		$orders = DB::table("orders")
		->join("member","orders.uid","=","member.id")
		->select("orders.*","member.name")
		->paginate(5);
		return \view("orders/index",["orders"=>$orders]);
	}
	//2.加载修改页面
	public function edit($id){
		return \view("orders/edit",["id"=>$id]);
	}
	//3.执行修改
	public function doEdit(Request $request){
		$id = $request->input('id');
		$status = $request->input('status');
		$res = DB::table('orders')->where("id","=",$id)->update(["status"=>$status]);
		if($res == 1){
			return "<script>alert('修改订单信息成功！');window.close();parent.location.reload();</script>";
		}else{
			return "<script>alert('修改订单信息失败！');window.close();parent.location.reload();</script>";
		}
	}
	
}
<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
//前端登录注册模块
class HloginController extends Controller
{
    //1.加载注册页面
    public function reg(){
    	return view("front/reg");
    }
    //2.执行注册操作
    public function doReg(Request $request){
    	//获取注册会员信息
    	$name = $request->input("name");
    	$pass = $request->input("pass");
    	//先根据会员名称查询当前会员是否已经注册过
    	$res = DB::table('member')->where("name","=",$name)->first();
    	// null
    	if($res != null){
    		//证明注册过
    		return \json_encode(["code"=>1001,"msg"=>"当前会员已经注册过了，请去登录即可"]);
    	}else{
    		//证明没注册过
    		$addres  =  DB::table("member")->insert(["name"=>$name,"pass"=>$pass]);
    		if($addres){
    			return \json_encode(["code"=>1000,"msg"=>"注册成功"]);
    		}else{
    			return \json_encode(["code"=>1002,"msg"=>"网络故障，注册失败"]);
    		}
    	}
    }
    //3.加载登录界面
    public function login(){
    	return \view("front/login");
    }
    //4.执行登录操作
    public function doLogin(Request $request){
    	//获取注册会员信息
    	$name = $request->input("name");
    	$pass = $request->input("pass");
		//查询
    	$res = DB::table('member')
    	->where([["name","=",$name],["pass","=",$pass]])
    	->first();
    	if($res == null){
    		return \json_encode(["code"=>1002,"msg"=>"账号或密码错误!请重新输入"]);
    	}else{
    		//登录成功，将用户名称存入session
    		$request->session()->put("frontuser",$name);
    		//登录成功
			return \json_encode(["code"=>1000,"msg"=>"登录成功"]);
    	}
    }
    //5.退出登录
    public function outLogin(Request $request){
    	if($request->session()->has("frontuser")){
    		$request->session()->forget("frontuser");
    		return \redirect("front/index");
    	}else{
    		return "<script>alert('您还未登录');
			window.location.href='/front/index'</script>";
    	}
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class LoginController extends Controller
{
    //1.加载登录界面
    public function login(){
    	return view("login");
    }
    //2.执行登录操作
    public function doLogin(Request $request){
    	$username = $request->input("username");
    	$password = $request->input("password");
    	$res = DB::table('user')
    	->where([["username","=",$username],["password","=",$password]])
    	->first();
    	if($res == null){
    		return \back()->with("error","账号或密码错误!请重新输入");
    	}else{
    		//登录成功，将用户名称存入session
    		$request->session()->put("adminuser",$username);
    		//登录成功
    		return \redirect("/admin/index");
    	}
    }
    //3.执行注销操作
    public function outLogin(Request $request){
    	if($request->session()->has("adminuser")){
    		$request->session()->forget("adminuser");
    		return \redirect("/admin/login");
    	}else{
    		return "<script>alert('您还未登录');window.location.href='/admin/login'</script>";
    	}
    }
}

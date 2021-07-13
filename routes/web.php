<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/


Route::group(["middleware"=>"login","namespace"=>"Admin"],function(){
	
	Route::get("/admin/index","IndexController@index");
	// 1.设置分类模块路由
	Route::resource("/type","TypeController");
	
	//2.设置商品模块路由
	Route::resource("/goods","GoodsController");
	
	//3.设置管理员模块路由
	Route::resource("/user","UserController");
		
	//4.设置会员模块路由
	Route::resource("/member","MemberController");
	
	//5.设置购物车管理模块路由
	Route::resource("/trolley","TrolleyController");
	
	//6.设置订单管理模块路由
	Route::get("/order","OrderController@index");
	Route::get("/order/edit/{id}","OrderController@edit");
	Route::post("/order/doEdit","OrderController@doEdit");
	Route::get("/detail","FrontController@detail");
	
	//8.其他模块
	Route::get("/unicode","OtherController@unicode");
});
//7.后台登录模块路由
	Route::group(["prefix"=>"admin","namespace"=>"Admin"],function(){
		Route::get("/login","LoginController@login");
		Route::post("/doLogin","LoginController@doLogin");
		Route::get("/outLogin","LoginController@outLogin");
	});	



//前台路由设置
Route::group(["prefix"=>"front","namespace"=>"Front"],function(){
	// 1.登录注册路由模块
	Route::get("/login","HloginController@login");
	Route::post("/doLogin","HloginController@doLogin");
	Route::get("/outLogin","HloginController@outLogin");
	Route::get("/reg","HloginController@reg");
	Route::post("/doReg","HloginController@doReg");
	//2.商城数据的控制器路由
	Route::get("/index","FrontController@index");
	Route::get("/list","FrontController@list");
	Route::get("/list1/{id}","FrontController@list1");
	Route::get("/list2/{id}","FrontController@list2");
	Route::get("/detail/{id}","FrontController@detail");
	Route::post("/addCart","FrontController@addCart");
	Route::get("/cart","FrontController@cart");
	Route::post("/cartDel","FrontController@cartDel");
	Route::post("/cartUpdate","FrontController@cartUpdate");
	Route::get("/conform","FrontController@conform");
	Route::post("/orderAdd","FrontController@orderAdd");
	Route::get("/selfinfo","FrontController@selfInfo");
	Route::get("/order","FrontController@orders");
	Route::post("/updOrder","FrontController@updOrder");
	Route::post("/search","FrontController@search");
	Route::get("/order_detail","FrontController@order_detail");
});	


Route::get('/{other?}', function () {
     return redirect('front/index');
 }); 
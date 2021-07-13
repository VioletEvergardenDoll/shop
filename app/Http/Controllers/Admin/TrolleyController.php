<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
//购物车管理
class TrolleyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取全部的商品信息
        $carts = DB::table('cart')
        	->join("goods","cart.goodsid","=","goods.id")
			->join("member","cart.uid","=","member.id")
        	->select("cart.*","goods.goodsname","goods.pic","goods.price","member.name")
    		// ->orderBy('id','asc')
        	// ->where("status","!=",0)
        	->paginate(5);
        return  view("trolley/index",["carts"=>$carts]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		//
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //修改
    	//获取所有的分类信息
		$carts = DB::table('cart')
			->where("id","=",$id)
			->first();
    	return view("trolley/edit",["carts"=>$carts]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //执行修改
        $params = $request->only('num');
    	
    	
        $res = DB::table('cart')->where("id","=",$id)->update($params);
    	// \dd($res);
        if($res==1){
        	return "<script>alert('修改商品信息成功！');window.close();parent.location.reload();</script>";
        }else{
        	return "<script>alert('修改商品信息失败！');window.close();parent.location.reload();</script>";
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
    	//1.删除数据库中的数据
    	$res = DB::table('cart')->where("id","=",$id)->delete();
    	if($res){
    		//删除成功
    		return \json_encode(["code"=>1000]);
    	}else{
    		//删除失败
    		return \json_encode(["code"=>1001]);
    	}
    }
}

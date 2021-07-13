<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
//类别管理
class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取所有全部分类  DB::raw 使用原生数据库命令
        $types = DB::table('type')
        ->select(DB::raw("*,concat(path,',',id) as paths"))
        ->orderBy('paths','asc')
        ->paginate(5);
        //根据path长度，给每一个typename前面添加指定的字符串  ---|
        foreach($types as $k => $v){
        	$path = $v->path; //获取path路径
        	$parr = explode(",",$path);//将字符串分割成数组
        	$len = count($parr)-1;//获取数组的长度 -1，求出字符串循环次数
        	$types[$k]->typename = str_repeat("---|",$len).$v->typename;
        	
        	if($v->pid == 0){
        		$types[$k]->pname = "一级分类";
        	}else{
        		$types[$k]->pname = DB::table("type")->where("id","=",$v->pid)->value('typename');
        	}
        }
        return \view("type/index",["types"=>$types]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取所有的分类信息
        $types = DB::table('type')
    	->select(DB::raw("*,concat(path,',',id) as paths"))
    	->orderBy('paths','asc')
    	->get();
    	foreach($types as $k => $v){
    		$path = $v->path; //获取path路径
    		$parr = explode(",",$path);//将字符串分割成数组
    		$len = count($parr)-1;//获取数组的长度 -1，求出字符串循环次数
    		$types[$k]->typename = str_repeat("---|",$len).$v->typename;
    	}
    	return \view("type/add",["types"=>$types]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //执行添加操作
    	$params = $request->except("_token");
    	if($params['pid'] == 0){
    		//一级分类
    		$params["path"] = "0";
    	}else{
    		//下一级分类
    		//path 应该是父级的path 拼接 父级的 id
    		//value 获取某一个字段的值
    		$path = DB::table("type")->where("id","=",$params['pid'])->value('path');
    		$params["path"] = $path.",".$params['pid'];
    	}
    	//执行插入操作
    	$res = DB::table('type')->insert($params);
    	
    	if($res){
    		return "<script>alert('添加信息成功！');window.close();parent.location.reload();</script>";
    	}else{
    		return "<script>alert('添加信息失败！');window.close();parent.location.reload();</script>";
    	}
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		
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
    	$type = DB::table('type')->where("id","=",$id)->first();
    	return view("type/edit",["type"=>$type]);
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
		$id = $request->input("id");
    	$param = $request->only('typename');
    	$res = DB::table('type')->where("id","=",$id)->update($param);
    	if($res==1){
    		return "<script>alert('修改信息成功！');window.close();parent.location.reload();</script>";
    	}else{
    		return "<script>alert('修改信息失败！');window.close();parent.location.reload();</script>";
    	}
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //执行删除操作
    	//1.如果当前类别下有子类，则不能进行删除
    	$type = DB::table("type")->where("pid","=",$id)->first();
    	if($type == null){
    		//没有子类，可以进行删除
    		//判断当前类别下是否有商品信息
    		$goodres = DB::table('goods')->where("typeid","=",$id)->first();
    		if($goodres == null){
    			//没有商品可以删除
    			$res = DB::table("type")->where("id","=",$id)->delete();
    			if($res){
    				//删除成功
    				return \json_encode(["code"=>1000]);
    			}else{
    				//删除失败
    				return \json_encode(["code"=>1001]);
    			}
    		}else{
    			return \json_encode(["code"=>1003]);
    		}
    	}else{
    		//有子类，不能进行删除
    		return \json_encode(["code"=>1002]);
    	}
    }
}

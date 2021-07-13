<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
//后台管理员
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	//列表页
        $users = DB::table("user")->orderBy("id","asc")->paginate(5);
        return view("user/index",["user"=>$users]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    	return view("user/add");
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr = $request->only('username','password');
		$res = DB::table('user')->insert($arr);//参数是数组
		if($res){
			//删除成功
			return \json_encode(["code"=>1000]);
		}else{
			//删除失败
			return \json_encode(["code"=>1001]);
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
        $user = DB::table("user")->where("id","=",$id)->first(); //获取一条
        return view("user/edit",["user"=>$user]);
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
		$id = $request->input("id");
        $arr = $request->only("username","password");
		// 使用构造器进行修改
		$res = DB::table("user")->where('id',"=",$id)->update($arr);
		if($res){
			return "<script>alert('修改成功！');window.close();parent.location.reload(); </script>";
		}else{
			return "<script>alert('修改失败！');window.close();parent.location.reload(); </script>";
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
    	$res = DB::table("user")->where("id","=",$id)->delete();
    	if($res){
    		//删除成功
    		return \json_encode(["code"=>1000]);
    	}else{
    		//删除失败
    		return \json_encode(["code"=>1001]);
    	}
    }
}

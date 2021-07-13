<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
//会员
class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	//列表页
        $members = DB::table("member")->orderBy("id","asc")->paginate(5);
        return view("member/index",["members"=>$members]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    	return view("member/add");
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
    	$arr = $request->only('name','pass');
    	//使用构造器进行添加
    	
    	// \dd($arr);
    		$res = DB::table('member')->insert($arr);//参数是数组
    		if($res){
    			//添加成功
    			return "<script>alert('添加成功！'); window.close();parent.location.reload();</script>";
    		}else{
    			//失败
    			return "<script>alert('添加失败！');window.close();parent.location.reload(); </script>";
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
        $member = DB::table("member")->where("id","=",$id)->first(); //获取一条
        return view("member/edit",["member"=>$member]);
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
        $arr = $request->only("name","pass");
        // 使用构造器进行修改
        $res = DB::table("member")->where('id',"=",$id)->update($arr);
        if($res){
        	return "<script>alert('修改成功！');window.close();
window.parent.location.replace(location.href); </script>";
        }else{
        	return "<script>alert('修改失败！'); window.close();
window.parent.location.replace(location.href); </script>";
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
    	$res = DB::table("member")->where("id","=",$id)->delete();
    	if($res){
    		//删除成功
    		return \json_encode(["code"=>1000]);
    	}else{
    		//删除失败
    		return \json_encode(["code"=>1001]);
    	}
    }
}

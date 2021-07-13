<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取全部的商品信息
        $goods = DB::table('goods')
        	->join("type","goods.typeid","=","type.id")
        	->select("goods.*","type.typename")
			->orderBy('id','asc')
        	// ->where("status","!=",0)
        	->paginate(4);
        return  view("goods/index",["goods"=>$goods]);
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
			
			if($len >= 2){
				//三级分类
				$types[$k]->pd = 1; //pd=1 代表三级分类
			}else{
				//一级分类或者二级分类
				$types[$k]->pd = 0;//pd = 0 代表是一级或者二级分类
			}
		}
		return view("goods/add",["types"=>$types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1.处理参数问题
		$params = $request->except("_token","pic");
		$params['ctime'] = time();//临时给数组添加一个时间参数	
		// 2.处理图片问题
		// 2.1判断是否有文件上传
		// \var_dump($request->hasFile($pic));
		if(!$request->hasFile("pic")){
			//没有文件上传
			//关闭当前页window.close();
			//刷新父级页面window.parent.location.replace(location.href)
			return "<script>alert('缺少有效的上传文件,请重新选择!');window.close();parent.location.reload();</script>";
		}else{
			//有文件上传
			//2.2获取上传文件的拓展名
			$ext = $request->pic->extension();
			//2.3重新编写图片新的名称
			$newpic = date("Y-m-d").'-'.rand(10000,99999).'.'.$ext;
			//2.4执行文件的移动上传
			$request->file('pic')->move("./uploads/goods",$newpic);
			$params['pic'] = "uploads/goods/".$newpic;
		}
		//3.执行插入
		$res = DB::table('goods')->insert($params);
		if($res == 1){
			return "<script>alert('添加商品信息成功！');window.close();parent.location.reload();</script>";
		}else{
			return "<script>alert('添加商品信息失败！');window.close();parent.location.reload();</script>";
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
        //修改
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
			
			if($len >= 2){
				//三级分类
				$types[$k]->pd = 1; //pd=1 代表三级分类
			}else{
				//一级分类或者二级分类
				$types[$k]->pd = 0;//pd = 0 代表是一级或者二级分类
			}
		}

        $goods = DB::table('goods')->where("id","=",$id)->first();
		return view("goods/edit",["types"=>$types,"goods"=>$goods]);
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
        $params = $request->except('_token','_method','pic','oldpic');
		$oldpic = $request->input("oldpic");
		if(!$request->hasFile('pic')){
			//没有文件上传
			$params['pic'] = $oldpic;
		}else{
			//有文件上传  获取上传文件的拓展名
			$ext = $request->pic->extension();
			//重新编写图片的名称
			$newpic = date("Y-m-d").'-'.\rand(10000,99999).'.'.$ext;
			//执行文件移动上传
			$request -> file('pic')->move("./uploads/goods",$newpic);
			$params['pic'] = "uploads/goods/".$newpic;
			//删除原来的图片
			unlink(public_path($oldpic));
		}
		
        $res = DB::table('goods')->where("id","=",$id)->update($params);
		// \dd($res);
        if($res == 1){
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
        //$id 是删除商品信息的条件
		//unlink(filename);filename 是当前删除图片的地址
		$oldpic = $request->input("oldpic");
		//1.删除数据库中的数据
		$res = DB::table('goods')->where("id","=",$id)->delete();
		if($res){
			//删除成功
			unlink(public_path($oldpic));
			return \json_encode(["code"=>1000]);
		}else{
			//删除失败
			return \json_encode(["code"=>1001]);
		}
    }
}

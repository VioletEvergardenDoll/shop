@extends('common.common')
@section('title','商品修改')
<style>
	.photo{
		width: 200px;
		
		height: 100px;
	
		border: 1px dashed #000;
	
		display: table-cell; /*主要是这个属性*/
	
		vertical-align: middle;
	
		text-align: center;
		
	}
	.photo img{

		width: 200px;

		height: 110px;

	}
</style>
@section('body')
        <div class="layui-fluid">
            <div class="layui-row">
                <form class="layui-form" action='{{URL("/goods/{$goods->id}")}}' method="post" enctype="multipart/form-data">
        		<!-- <form class="layui-form"> -->
        			{{ csrf_field() }}
					{{ method_field('put') }}
					<input type="hidden" name="oldpic" value="{{$goods->pic}}">
                    <div class="layui-form-item">
                        <label for="goodsname" class="layui-form-label">
                            <span class="x-red">*</span>商品名称</label>
                        <div class="layui-input-inline">
                            <input type="text" id="goodsname" name="goodsname" required="" lay-verify="goodsname" 
        					class="layui-input" placeholder="商品名称" value="{{ $goods->goodsname }}">
        				</div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_username" class="layui-form-label">
                            <span class="x-red">*</span>商品分类</label>
                        <div class="layui-input-inline">
                            <select class="layui-input" name="typeid" id="">
                            	<option value="0">---请选择---</option>
                            	<!-- 一级分类和二级分类是禁用状态，三级分类可以添加商品信息 -->
                            	@foreach($types as $k=>$v)
                            		<option  {{ $goods->typeid == $v->id ? 'selected' : "" }} {{ $v->pd ? '' : 'disabled'}} value="{{ $v->id }}">{{ $v->typename }}</option>
                            	@endforeach
                            </select>
        				</div>
                    </div>
        			<div class="layui-form-item">
        			    <label for="pic" class="layui-form-label">
        			        <span class="x-red">*</span>商品图片</label>
        			    <div class="layui-input-inline">
						    <input type="file" id="pic" name="pic" value="{{$goods->pic}}">
        			    </div>
						<div class="photo">
						    <img src='{{ asset("{$goods->pic}") }}' alt="">
						</div>
        			</div>
        			<div class="layui-form-item">
        			    <label for="price" class="layui-form-label">
        			        <span class="x-red">*</span>商品单价</label>
        			    <div class="layui-input-inline">
        			        <input type="text" id="price" name="price" required="" 
        					class="layui-input" placeholder="商品单价" value="{{ $goods->price }}">
        				</div>
        			</div>
        			<div class="layui-form-item">
        			    <label for="num" class="layui-form-label">
        			        <span class="x-red">*</span>商品数量</label>
        			    <div class="layui-input-inline">
        			        <input type="text" id="num" name="num" required="" 
        					class="layui-input" placeholder="商品数量" value="{{ $goods->num }}">
        				</div>
        			</div>
        			<div class="layui-form-item">
        			    <label for="desc" class="layui-form-label">
        			        <span class="x-red">*</span>商品描述</label>
        			    <div class="layui-input-inline">
        			        <input type="text" id="desc" name="desc" required="" 
        					class="layui-input" placeholder="商品描述" value="{{ $goods->desc }}">
        				</div>
        			</div>
        			<div class="layui-form-item">
        			    <label for="status" class="layui-form-label">
        			        <span class="x-red">*</span>商品状态</label>
        			    <div class="layui-input-inline">
        			        <select name="status" id="status"  class="form-control">
        			        				  <option value="1" {{ $goods->status == 1 ? 'selected' : "" }} >新品</option>
        			        				  <option value="2" {{ $goods->status == 2 ? 'selected' : "" }} >热卖</option>
        			        				  <option value="0" {{ $goods->status == 0 ? 'selected' : "" }} >下架</option>
        			        </select>
        				</div>
        			</div>
                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label"></label>
                        <button class="layui-btn" lay-filter="add" lay-submit="">修改</button>
        			</div>
					
                </form>
            </div>
			
        </div>
		<script>
		layui.use(['form', 'layedit', 'laydate'], function(){
		  var form = layui.form
		  ,layer = layui.layer
		  ,layedit = layui.layedit
		  ,laydate = layui.laydate;
		  
		 
		});
		</script>
        <script>var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();</script>
@endsection

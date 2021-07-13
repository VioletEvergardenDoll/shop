@extends('common.common')
@section('title','购物车修改')

@section('body')
        <div class="layui-fluid">
            <div class="layui-row">
                <form class="layui-form" action='{{URL("/trolley/{$carts->id}")}}' method="post" enctype="multipart/form-data">
        		<!-- <form class="layui-form"> -->
        			{{ csrf_field() }}
					{{ method_field('put') }}
        			<div class="layui-form-item">
        			    <label for="num" class="layui-form-label">
        			        <span class="x-red">*</span>商品数量</label>
        			    <div class="layui-input-inline">
        			        <input type="text" id="num" name="num" required="" 
        					class="layui-input" placeholder="商品数量" value="{{ $carts->num }}">
        				</div>
        			</div>
                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label"></label>
                        <button class="layui-btn" lay-filter="add" lay-submit="">修改</button>
        			</div>
					
                </form>
            </div>
			
        </div>
		<script>layui.use(['form', 'layer'],
		    function() {
		        $ = layui.jquery;
		        var form = layui.form,
		        layer = layui.layer;
		    });</script>
        <script>var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();</script>
@endsection

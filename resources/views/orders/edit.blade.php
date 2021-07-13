@extends('common.common')
@section('title','订单修改')

@section('body')
        <div class="layui-fluid">
            <div class="layui-row">
                <form class="layui-form" action='{{ URL("/order/doEdit") }}' method="post">
        		<!-- <form class="layui-form"> -->
        			{{ csrf_field() }}
					<input type="hidden"  id="id" name="id" value="{{$id}}"/>
        			<div class="layui-form-item">
        			    <label for="num" class="layui-form-label">
        			        <span class="x-red">*</span>发货状态</label>
        			    <div class="layui-input-inline">
        			        <select class="layui-input" name="status" id="" >
        			        	<option value="1" name="status">新订单</option>
        			        	<option value="2" name="status">发货</option>
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

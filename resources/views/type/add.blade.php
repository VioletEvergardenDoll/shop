@extends('common.common')
@section('title','类别添加')
@section('body')
	        <div class="layui-fluid">
	            <div class="layui-row">
	                <form class="layui-form" action="{{URL('/type')}}" method="post" >
					<!-- <form class="layui-form"> -->
						{{ csrf_field() }}
	                    <div class="layui-form-item">
	                        <label for="typename" class="layui-form-label">
	                            <span class="x-red">*</span>类别名称</label>
	                        <div class="layui-input-inline">
	                            <input type="text" id="typename" name="typename" required="" lay-verify="typename" 
								class="layui-input" placeholder="类别名称">
							</div>
	                    </div>
	                    <div class="layui-form-item">
	                        <label for="L_username" class="layui-form-label">
	                            <span class="x-red">*</span>父级分类</label>
	                        <div class="layui-input-inline">
	                            <select class="form-control" name="pid" id="">
	                            	<option value="0">---请选择---</option>
	                            	@foreach($types as $k=>$v)
	                            		<option value="{{ $v->id }}">{{ $v->typename }}</option>
	                            	@endforeach
	                            </select>
							</div>
	                    </div>
	                    <div class="layui-form-item">
	                        <label for="L_repass" class="layui-form-label"></label>
	                        <button class="layui-btn" lay-filter="add" lay-submit="">增加</button>
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
			  
			  //日期
			  laydate.render({
			    elem: '#date'
			  });
			  laydate.render({
			    elem: '#date1'
			  });  
			 
			});
			</script>
	        <script>var _hmt = _hmt || []; (function() {
	                var hm = document.createElement("script");
	                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
	                var s = document.getElementsByTagName("script")[0];
	                s.parentNode.insertBefore(hm, s);
	            })();</script>
	
@endsection
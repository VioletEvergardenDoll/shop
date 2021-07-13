@extends('common.common')
@section('title','会员添加')
@section('body')
        <div class="layui-fluid">
            <div class="layui-row">
				<form class="layui-form" action="{{ URL('/member') }}"  method="post" >
                <!-- <form class="layui-form"  > -->
					{{ csrf_field() }}
                  <div class="layui-form-item">  
                      <label for="username" class="layui-form-label">
                          <span class="x-red">*</span>会员名称
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="name" name="name" required="" lay-verify="required"
                          autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>将会成为您唯一的登入名
                      </div>
                  </div>
                  <div class="layui-form-item">
                      <label for="password" class="layui-form-label">
                          <span class="x-red">*</span>会员密码
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="pass" name="pass" required="" lay-verify="pass"
                          autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          6到16个字符
                      </div>
                  </div>
               <!--   <div class="layui-form-item">
                      <label for="L_repass" class="layui-form-label">
                          <span class="x-red">*</span>确认密码
                      </label>
                      <div class="layui-input-inline">
                          <input type="password" id="L_repass" name="repass" required="" lay-verify="repass"
                          autocomplete="off" class="layui-input">
                      </div>
                  </div> -->
                  <div class="layui-form-item">
                      <label for="L_repass" class="layui-form-label">
                      </label>
                      <button  class="layui-btn" lay-filter="add" lay-submit="" >
                            增加
                      </button>
                  </div>
              </form>
            </div>
        </div>
        
		<script>layui.use(['form', 'layer','jquery'],
		            function() {
		                $ = layui.jquery;
		                var form = layui.form,
		                layer = layui.layer;
		
		                //自定义验证规则
		                form.verify({
		                    pass: [/(.+){6,12}$/, '密码必须6到12位'],
		                });
					}
				);
		</script>
       <script>var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();</script>
@endsection

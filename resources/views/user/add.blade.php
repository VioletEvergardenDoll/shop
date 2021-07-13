@extends('common.common')
@section('title','管理员添加')
@section('body')
        <div class="layui-fluid">
            <div class="layui-row">
				<!-- <form class="layui-form" action="{{ URL('/user') }}"  method="post" > -->
                <form class="layui-form"  >
					<!-- {{ csrf_field() }} -->
                  <div class="layui-form-item">  
                      <label for="username" class="layui-form-label">
                          <span class="x-red">*</span>管理员名称
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="username" name="username" required="" lay-verify="required"
                          autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>将会成为您唯一的登入名
                      </div>
                  </div>
                  <div class="layui-form-item">
                      <label for="password" class="layui-form-label">
                          <span class="x-red">*</span>密码
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="password" name="password" required="" lay-verify="pass"
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
        
		<script>
			layui.use(['form','layer'], function(){
			        $ = layui.jquery;
			        var form = layui.form
			            ,layer = layui.layer;
			        //监听提交
			        form.on('submit(add)', function(data){
			            console.log(data);
			            var username,password;
			            username    = $('input[name="username"]').val();
			            password    = $('input[name="password"]').val();
			            $.ajax({
			                url:"/user",
			                data:{'username':username,'password':password,_token:"{{ csrf_token() }}",},
			                type: "post" ,
			                dataType:'json',
			                success:function(res){
			                    console.log(res);
								// var obj = JSON.parse(res);
			                    if(res.code == 1000){
			                        layer.alert("增加成功", {
										icon: 6
									},
									function() {
										//关闭当前frame
										xadmin.close();
				
										// 可以对父窗口进行刷新 
										xadmin.father_reload();
									});
			                    }else{
			                        layer.alert("增加失败", {
			                        	icon: 6,
			                        });
			                    }
			                }
			            })
			            return false;
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

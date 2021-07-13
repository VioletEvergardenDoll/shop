<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>会员登录</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/frontlogin.css') }}">
	</head>
	<body>
		<!-- login -->
		<div class="top center">
			<div class="logo center">
				<a href="/front/index" target="_blank"><img src="{{ asset('images/mistore_logo.png') }}" alt=""></a>
			</div>
		</div>
		<div  class="form center">
			{{ csrf_field() }}
			<div class="login">
				<div class="login_center">
					<div class="login_top">
						<div class="left fl">会员登录</div>
						<div class="right fr">您还不是我们的会员？
							<a href="{{ URL('/front/reg') }}">立即注册</a>
						</div>
						<div class="clear"></div>
						<div class="xian center"></div>
					</div>
					<div class="login_main center">
						<span style="color: red;" id="span"></span>
						<div class="username">用户名:&nbsp;
							<input class="shurukuang" type="text" id="name" name="name" placeholder="请输入你的用户名"/>
						</div>
						<div class="username">密&nbsp;&nbsp;&nbsp;&nbsp;码:&nbsp;
							<input class="shurukuang" type="password" id="pass" name="pass" placeholder="请输入你的密码"/>
						</div>
					</div>
					<div class="login_submit">
						<button class="submit" onclick="login()">登录</button>
					</div>
				</div>
			</div>
		</div>
		<footer>
			<div class="copyright">简体 | 繁体 | English | 常见问题</div>
			<div class="copyright">小米公司版权所有-京ICP备10046444-<img src="{{ asset('images/ghs.png') }}" alt="">京公网安备11010802020134号-京ICP证110507号</div>

		</footer>
	</body>
</html>
		<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
			//实现登录操作
			function login(){
				//获取用户名，密码，确认密码的值
				var name = $("#name").val();//用户名称
				var pass = $("#pass").val();//密码
				//注册信息不全
				if(!(name && pass )){
					//至少有一个没有值
					$("#span").html("缺少必要信息");
					return ;
				}
				
				//执行注册操作
				$.ajax({
					url:"/front/doLogin",
					type:"post",
					data:{
						_token:"{{ csrf_token() }}",
						name,
						pass,
					},
					success(res){
						var obj = JSON.parse(res);
						if(obj.code == 1000){
							//登录成功
							window.location.href="/front/index";
						}else{
							$("#span").html(obj.msg);
						}
					}
				})
				// console.log(name,pass,cpass);
			}
		</script>
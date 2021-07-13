<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>用户注册</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/frontlogin.css') }}">
		<script src="{{ asset('js/jquery.min.js') }}"></script>
	</head>
	<body>
		<div class="regist">
			<div class="regist_center">
				<div class="regist_top">
					<div class="left fl">会员注册</div>
					<div class="right fr">
						<a href="{{ URL('/front/index') }}" >小米商城</a>
					</div>
					<div class="clear"></div>
					<div class="xian center"></div>
				</div>
				<div class="regist_main center">
					<span style="color: red;" id="span"></span>
					<div class="username">用&nbsp;&nbsp;户&nbsp;&nbsp;名:&nbsp;&nbsp;
						<input class="shurukuang" type="text" name="name" id="name" placeholder="请输入你的用户名"/>
						<span>请不要输入汉字</span>
					</div>
					<div class="username">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码:&nbsp;&nbsp;
						<input class="shurukuang" type="text" name="pass" id="pass" placeholder="请输入你的密码"/>
						<span>请输入6位以上字符</span>
					</div>
					
					<div class="username">确认密码:&nbsp;&nbsp;
						<input class="shurukuang" type="text" name="confirmPass" id="confirmPass" placeholder="请确认你的密码"/>
						<span>两次密码要输入一致哦</span>
					</div>
				</div>
				<div class="regist_submit">
					<button class="submit" onclick="doReg()">立即注册</button>
				</div>
				
			</div>
		</div>
		<script>
			//实现注册操作
			function doReg(){
				//获取用户名，密码，确认密码的值
				var name = $("#name").val();//用户名称
				var pass = $("#pass").val();//密码
				var cpass = $("#confirmPass").val();//获取确认密码
				//注册信息不全
				if(!(name && pass && cpass)){
					//至少有一个没有值
					$("#span").html("缺少必要信息");
					return ;
				}
				//判断当前 密码和确认密码是否一致
				if(pass != cpass){
					$("#span").html("两次密码不一致");
					return ;
				}
				
				//执行注册操作
				$.ajax({
					url:"/front/doReg",
					type:"post",
					data:{
						_token:"{{ csrf_token() }}",
						name,
						pass,
					},
					success(res){
						var obj = JSON.parse(res);
						if(obj.code == 1000){
							//注册成功
							alert(obj.msg);
							window.location.href="/front/login"
						}else{
							$("#span").html(obj.msg);
						}
					}
				})
				// console.log(name,pass,cpass);
			}
		</script>
	</body>
</html>
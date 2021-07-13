<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>@yield('title')</title>
		
		<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
		
		<script src="{{ asset('js/jquery.min.js' )}}" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
	<!-- start header -->
		<header>
			<div class="top center">
				<div class="left fl">
					<ul>
						<li>
							<a href="http://www.mi.com/" target="_blank">小米商城</a>
						</li>
						<li>|</li>
						<li><a href="">MIUI</a></li>
						<li>|</li>
						<li><a href="">米聊</a></li>
						<li>|</li>
						<li><a href="">游戏</a></li>
						<li>|</li>
						<li><a href="">多看阅读</a></li>
						<li>|</li>
						<li><a href="">云服务</a></li>
						<li>|</li>
						<li><a href="">金融</a></li>
						<li>|</li>
						<li><a href="">小米商城移动版</a></li>
						<li>|</li>
						<li><a href="">问题反馈</a></li>
						<li>|</li>
						<li><a href="">Select Region</a></li>
						<div class="clear"></div>
					</ul>
				</div>
				<div class="right fr">
					<div class="gouwuche fr"><a href="/front/cart">购物车</a></div>
					<div class="fr">
						<ul>
							@if(session("frontuser"))
								<li>欢迎：{{session("frontuser")}}</li>
								<li><a href="{{ URL('/front/outLogin') }}" >注销</a></li>
							@else
								<li><a href="{{ URL('/front/login') }}" >登录</a></li>
							@endif
							<li>|</li>
							<li><a href="{{ URL('/front/reg') }}" target="_blank" >注册</a></li>
							<li>|</li>
							<li><a href="">消息通知</a></li>
							<li>|</li>
							<li><a href="{{ URL('/front/selfinfo') }}">个人中心</a></li>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
		</header>
	<!--end header -->

<!-- start banner_x -->
		<div class="banner_x center">
			<a href="{{ URL('/front/index') }}" target="_blank"><div class="logo fl"></div></a>
			<a href="{{ URL('/front/index') }}"><div class="ad_top fl"></div></a>
			<div class="nav fl">
				<ul>
					<li><a href="/front/index" target="_blank">首页</a></li>
					@foreach( $firstCates as $k => $v )
						<li><a href="/front/list1/{{$v->id}}" >{{ $v->typename }}</a></li>
					@endforeach
					<li><a href="./liebiao.html" target="_blank">社区</a></li>
				</ul>
			</div>
			<div class="search fr">
				<form action="{{ URL('/front/search')}}" method="post">
					{{ csrf_field() }}
					<div class="text fl">
						<input type="text" class="shuru"  placeholder="请输入商品名称" id="search"  name="search">
					</div>
					<div class="submit fl">
						<input type="submit" class="sousuo"  value="搜索"/>
					</div>
					<div class="clear"></div>
				</form>
				<div class="clear"></div>
			</div>
		</div>
<!-- end banner_x -->
		@section('body')
		
		@show
<footer class="mt20 center">			
			<div class="mt20">小米商城|MIUI|米聊|多看书城|小米路由器|视频电话|小米天猫店|小米淘宝直营店|小米网盟|小米移动|隐私政策|Select Region</div>
			<div>©mi.com 京ICP证110507号 京ICP备10046444号 京公网安备11010802020134号 京网文[2014]0059-0009号</div> 
			<div>违法和不良信息举报电话：185-0130-1238，本网站所列数据，除特殊说明，所有数据均出自我司实验室测试</div>
		</footer>
	</body>
</html>
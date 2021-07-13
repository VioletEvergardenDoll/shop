<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>订单详情-小米商城</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
		<script src="{{ asset('js/jquery.min.js' )}}" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="{{ asset('css/xadmin.css') }}">
	</head>
	
	<body>
	<!-- start header -->
	<!--end header -->

<!-- start banner_x -->
		<div class="banner_x center">
			<a href="/front/index" ><div class="logo fl"></div></a>
			
			<div class="wdgwc fl ml40">订单详情</div>
			<!-- <div class="wxts fl ml20">温馨提示：产品是否购买成功，以最终下单为准哦，请尽快结算</div> -->
			<div class="dlzc fr">
				<ul>
					@if(session("frontuser"))
						<li>欢迎：{{session("frontuser")}}</li>
						<li><a href="{{ URL('/front/outLogin') }}" >注销</a></li>
					@else
						<li><a href="{{ URL('/front/login') }}">登录</a></li>
					@endif
					<li>|</li>
					<li><a href="{{ URL('/front/reg') }}" target="_blank" >注册</a></li>
				</ul>
				
			</div>
			<div class="clear"></div>
		</div>
		<div class="xiantiao"></div>
		@if(session("frontuser"))
		<div class="gwcxqbj" style="height: 100vh;">
			<div class="gwcxd center" >
				<div class="top2 center">
					<div class="sub_top fl">单价</div>
					<div class="sub_top fl">商品名称</div>
					<div class="sub_top fl">数量</div>
					<div class="sub_top fl">小计</div>
					<div class="clear"></div>
				</div>
				@foreach( $order_detail as $k =>$v )
				<div class="content2 center">
					<div class="sub_content fl ">{{ $v->price }}元</div>
					<div class="sub_content fl"><img style="width: 100%; height: 100%;" src='{{ URL("$v->pic") }}'></div>
					<div class="sub_content fl ft20">{{ $v->goodsname }}</div>
					<div class="sub_content fl">
						<input class="shuliang" type="text" value="{{ $v->num }}" disabled >
					</div>
					<div class="sub_content fl">{{ $v->price * $v->num}}元</div>
					<!-- <div class="sub_content fl"><a onclick="cartDel({{ $v->id }})">×</a></div> -->
					<div class="clear"></div>
				</div>
				
				@endforeach
				<div class="layui-card-body ">
				    <div class="page">
				        <div>
							{{ $order_detail->links() }}
						</div>                                    
				    </div>
				</div>
				
			</div>
			<div class="jiesuandan mt20 center">
				<div class="tishi fl ml20">
					<ul>
						<li><a href="/front/list">继续购物</a></li>
						<li>|</li>
						<li>共<span>{{ $allNum }}</span>件商品
						<div class="clear"></div>
					</ul>
				</div>
			</div>
		</div>
		@else
			请先去登录
		@endif

	</body>
</html>

